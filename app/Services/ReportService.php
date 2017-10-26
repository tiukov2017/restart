<?php
namespace  App\Services;

use App\DAO\BaseDao;
use App\DAO\Collections\EntityModelCollection;
use App\DAO\ReportDAO;
use App\DAO\ReportStatusDAO;
use App\Entities\IEntity;
use App\Entities\Report;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Facades\Storage;
use League\Flysystem\Config;
use Mockery\CountValidator\Exception;

class ReportService extends DbUpdateService
{

    public function __construct(ReportDAO $reportDAO)
    {
        $this->dao = $reportDAO;

    }

    /**
     * @param IEntity $report
     * @return Report
     */
    public function create(IEntity $report){

        $this->dao = new ReportDAO();
        $path = $this->generateReportDataPath($report);
        $report->setUrl($path);
        $this->dao->fillFromEntity($report);
        $this->dao->save();
        $entity = $this->dao->toEntity();

        Storage::put($path,$this->generateReport($entity));

        $this->sendReportNotificationMail($report->getUser(),route('editor',['id' => $entity->getId()]));
        return $entity;
    }
    /**
     * @desc Updates the report content
     * @param Report $report
     * @param $content
     * @return bool
     */
    public function updateReportContent(Report $report,$content){

        Storage::put($report->getUrl(),$content);
        return true;
    }

    /**
     * @desc Updates the report client version content
     * @param Report $report
     * @param $content
     * @return bool
     */
    public function publishReport(Report $report, $content){

        /** we have to call the upload like this and not via put, to allow to put custom headers on the file */
        $config = new Config();
        $config->set('mimetype', 'text/html');
        $config->set('CacheControl', 'max-age=1');
        Storage::disk('s3')->getAdapter()->write($report->getPublishedVersionPath(), $content, $config);
        return true;
    }
    /**
     * @desc Return all the reports
     * @return Report[]
     */
    public function getAll(){

        /** @var EntityModelCollection $reports */
        $reports = $this->dao->all();
        return $reports->toEntities();
    }

    /**
     * @param $id
     * @return /App/Entities/Report $report
     */
    public function getById($id){

        $report = $this->dao->findOrFail($id)->toEntity();
        return $report;
    }

    public function getDao($id){

        return $this->dao->findOrFail($id);
    }

    /**
     * @param Report $report
     * @return string
     */
    public function generateReportDataPath(Report $report){

        return ((int)$report->getObjectId() + time() ).'/extended.html';
    }

    /**
     * @param Report $report
     * @return mixed
     */
    public function loadReportContents(Report $report){

            $report_content = Storage::get($report->getUrl());
            return $report_content;
    }

    /**
     * @param Report $report
     * @return string
     */
    private function generateReport(Report $report){

        $view = \Illuminate\Support\Facades\View::make('reports/report',[

            'shareUrl' =>config('filesystems.shareUrl'). $report->getPublishedVersionPath(),
            'object_first_name'=> $report->getObjectFirstName(),
            'object_last_name' => $report->getObjectLastName(),
            'english_first_name'=>$report->getEnglishFirstName(),
            'english_last_name'=>$report->getEnglishLastName(),
            'object_id'=>$report->getObjectId(),
            'english_fullname'=> $report->getEnglishFirstName() . ' ' . $report->getEnglishLastName(),
            'object_fullname' => $report->getObjectFirstName() . ' ' . $report->getObjectLastName()])->render();

        ob_start();
        echo $view;
        $reportContent = ob_get_clean();
        return $reportContent;
    }

    /**
     * @param Report $report
     * @return string
     */
    public function getReportStorageFolder(Report $report){

        $url = $report->getUrl();
        $folder = substr($url,0,strpos($url,'/'));
        return $folder;
    }

    /**
     * @param string $userId
     * @param string[] $statuses
     * @return Report
     */
    public function getReportsByUserAndStatus($userId,$statuses){

        $statuses = ReportStatusDAO::whereIn('name',$statuses)->pluck('id');
        $reports = $this->dao->where('user_fk','=',$userId)->whereNotIn('status_fk',$statuses->toArray())->get();

        return $reports->toEntities();
    }

    /**
     * @param /App/User $user
     * @param string $reportLink
     */
    public function sendReportNotificationMail($user,$reportLink){

        Mail::send('emails.report_reminder', ['user' => $user,'link' => $reportLink], function ($m) use ($user) {

            $m->to($user->email, $user->name)->subject('דוח חדש הוקצה עבורך');
        });
    }

}