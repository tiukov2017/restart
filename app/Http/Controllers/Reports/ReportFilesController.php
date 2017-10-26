<?php
/**
 * Created by PhpStorm.
 * User: eran
 * Date: 26/06/16
 * Time: 16:05
 */

namespace App\Http\Controllers\Reports;


use App\DAO\ReportFileDAO;
use App\Entities\ReportFile;
use App\Http\Controllers\Controller;
use App\Http\Requests\Reports\DeleteFileRequest;
use App\Http\Requests\Reports\UploadReportFileRequest;
use App\Services\ReportFilesService;
use App\Http\Requests\SimpleRequest;
use App\Services\ReportService;
use App\Services\UploadService;
use GuzzleHttp\Psr7\UploadedFile;

class ReportFilesController extends Controller
{
    /**
     * @desc Get All files for report
     * @param SimpleRequest $request
     * @param ReportFilesService $filesService
     * @return string
     */
    public function getReportFiles(SimpleRequest $request,ReportFilesService $filesService){

        $reportId = $request->get('reportId');
        $files = $filesService->getReportFiles($reportId);
        return  json_encode($files);
    }

    /**
     * @param DeleteFileRequest $request
     * @param ReportService $reportService
     * @param ReportFilesService $reportFilesService
     * @param UploadService $uploadService
     */
    function deleteFile(DeleteFileRequest $request,ReportService $reportService,ReportFilesService $reportFilesService,UploadService $uploadService){

        $fileId = $request->get('fileId');
        $reportId = $request->get('reportId');
        $reportFilesService->deleteReport($fileId,$reportId,$reportService,$uploadService);
    }

    /**
     * @param SimpleRequest $request
     * @param ReportFilesService $filesService
     * @param ReportService $reportService
     */
    function editFile(SimpleRequest $request,ReportFilesService $filesService,ReportService $reportService){

        $fileId = $request->get('fileId');
        $reportId = $request->get('reportId');
        $name = $request->get('fileName');
        $description = $request->get('fileDescription');
        $url = $request->get('url');

        $file = new ReportFile($reportService->getById($reportId),$name,$url);
        $file->setDescription($description);
        $file->setId($fileId);
        $filesService->update($file);
    }

    /**
     * @param UploadReportFileRequest $request
     * @param ReportFilesService $filesService
     * @param ReportService $reportService
     * @param UploadService $uploadService
     * @return string
     */
    function addFile(UploadReportFileRequest $request,ReportFilesService $filesService,ReportService $reportService,UploadService $uploadService){

        $reportId = $request->get('reportId');
        $report = $reportService->getById($reportId);
        /** UploadedFile[]  $file */
        $files = $request->file();

        foreach($files as $file){
            $filesService->attachFilesToReport($file,$report,$reportService,$uploadService);
        }

        $files = $filesService->getReportFiles($reportId);
        return  json_encode($files);
    }
}