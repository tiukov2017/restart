<?php
/**
 * Created by PhpStorm.
 * User: eran
 * Date: 28/11/16
 * Time: 10:24
 */

namespace App\DAO;


use App\Entities\GoogleResult;
use Carbon\Carbon;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Support\Facades\DB;

class GoogleResultDAO extends BaseDao
{
    use SoftDeletes;

    const REPORT_FK_FIELD="report_fk";
    protected $table = 'google_results';
    protected  $guarded = ['query_fk', 'url' ,'query','is_checked' ,'url' ,'summary' ,'title' , 'description' ,'user_comments'];


    public function toEntity()
    {
        $entity = new GoogleResult($this->report_fk,$this->query,$this->title,$this->url,$this->description,$this->summary);
        $entity->setId($this->id);
        $entity->setQueryId($this->query_fk);
        $this->setDeletedAt($entity);
        $entity->setIsChecked($this->is_checked);
        $entity->setUserComments($this->user_comments);
        return $entity;
    }

    public function fillFromEntity(GoogleResult $entity)
    {
        $this->report_fk = $entity->getReportFk();
        $this->query = $entity->getQuery();
        $this->title = $entity->getTitle();
        $this->url = $entity->getUrl();
        $this->description = $entity->getDescription();
        $this->results_summary = $entity->getSummary();
        $this->query_fk = $entity->getQueryId();
        $this->is_checked = $entity->getIsChecked();
        $this->user_comments = $entity->getUserComments();
    }

    /**
     * @param $reportId
     * @param $query
     * @return bool
     */
    public function isNewQueryResults($reportId,$query){
        return count($this::where(['report_fk'=>$reportId])->where(['query' => $query])->first()) == 0;
    }

    /**
     * @param $resultId
     */
    public function restoreResult($resultId){
        $this::withTrashed()->where(['id'=> $resultId])->restore();
    }

    /**
     * @param $reportId
     * @param $query
     * @return mixed
     */
    public function getWithTrashedResults($reportId,$query){
       return $this::withTrashed()
            ->where(['reportId' => $reportId])
            ->where(['query' => $query])
            ->get();
    }

    /**
     * @desc Get all results that wasn't reviewed by user,
     * with restricted domains substracted.
     * @param $reportId
     * @param $query
     * @return mixed
     */
    public function getUncheckedResultsPaginator($reportId,$query){
        $reportDao = new ReportDAO();
        $results = $reportDao
            ->find($reportId)
            ->getResultsForQueryWithTrashed($query)
            ->whereNotIn('google_results.url',function ($query){
                $query
                    ->select('google_results.url')
                    ->from('google_results')
                    ->join('restricted_domains','google_results.url','LIKE',DB::raw('CONCAT("%",restricted_domains.domain,"%")'));
            })->orderBy('created_at')
            ->paginate(10);
        return $results;
    }

    /**
     * @desc Get all results related to report and query
     * with no conditions (with trashed and checked)
     * @param $reportId
     * @param $query
     */
    public function getAllResultsByReportAndQuery($reportId,$query){
        $reportDao = new ReportDAO();
        $results = $reportDao
            ->find($reportId)
            ->getResultsForQueryWithTrashed($query)
            ->get();
        return $results;
    }

    /**
     * @param $query
     * @return mixed
     */
    public function getQueryFk($query){
        return $this::withTrashed()->where(['query' => $query])->pluck('query_fk')->first();
    }

    /**
     * @param GoogleResult $entity
     */
    private function setDeletedAt(GoogleResult $entity){
        if(isset($this->deleted_at))
            $entity->setDeleted($this->deleted_at);
        else{
            $entity->setDeleted(null);
        }
    }

    /**
     * @param $resultId
     * @return mixed
     */
    public function getResultById($resultId){
        return $this::withTrashed()->where(['id'=>$resultId])->first()->toEntity();
    }

    /**
     * @param $url
     * @param $reportId
     * @return mixed
     */
    public function getResultByUrl($url,$reportId){
        return $this::withTrashed()->where(['url' => $url])->where(['report_fk' => $reportId])->get()->toEntities();
    }

    /**
     * @param $resultId
     */
    public function updateIsChecked($resultId){
        $this::withTrashed()->where(['id'=> $resultId])->update(['is_checked' => true]);
    }

    public static function getRestrictedDomain($url){
        $domainDao = new DomainDAO();
        return $domainDao::where(['url','LIKE','%'.$url])->get()->pluck('url');
    }

    public function isDomainRestricted(){
        return count($this->getRestrictedDomain($this->url)) == 0;
    }


//    public function isDomainRestricted(){
//        $domainDao = new DomainDAO();
//        $restrictedDomains = $domainDao->getDomains();
//        foreach ($re)
//    }

}