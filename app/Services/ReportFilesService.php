<?php
/**
 * Created by PhpStorm.
 * User: eran
 * Date: 23/06/16
 * Time: 15:42
 */

namespace App\Services;


use App\DAO\ReportFileDAO;
use App\Entities\Report;
use App\Entities\ReportFile;
use Symfony\Component\HttpFoundation\File\UploadedFile;


class ReportFilesService extends DbUpdateService
{
    /**
     * @param ReportFileDAO $reportFileDAO
     */
    public function __construct(ReportFileDAO $reportFileDAO)
    {
      $this->dao=$reportFileDAO;
    }

    /**
     * @param $id
     * @return array
     */
    public function getReportFiles($id){

        $files = $this->dao->where('report_fk','=',$id)->get();
        return $files;
    }


    public function attachFilesToReport(UploadedFile $file,Report $report,ReportService $reportService,UploadService $uploadService){

        $this->dao = new ReportFileDAO();
        $reportFolder = $reportService->getReportStorageFolder($report);
        $fileFolder = $reportFolder.'/attachments';

        //Upload to s3
        $fileUrl=  $uploadService->uploadFile($file,$fileFolder,false,'/'.$file->getClientOriginalName());
        $reportFile = new ReportFile($report,$file->getClientOriginalName(),$fileUrl);

        //Insert to db
        $this->create($reportFile);
        return $reportFile;
    }

    /**
     * @param $reportId
     * @param $fileId
     * @param ReportService $reportService
     * @param UploadService $uploadService
     */
    public function deleteReport($fileId,$reportId,ReportService $reportService,UploadService $uploadService){

        $report = $reportService->getById($reportId);

        /** @var  ReportFile $file */
        $file = $this->getById($fileId);
        $fileName = $file->getName();

        //Delete from db
        $this->delete($fileId);
        $storageFolder = $reportService->getReportStorageFolder($report);

        //Delete from external storage
        $uploadService->deleteFile($fileName,$storageFolder.'/attachments/');
    }

    public function getById($id){

        $file = $this->dao->findOrFail($id)->toEntity();
        return $file;
    }


}