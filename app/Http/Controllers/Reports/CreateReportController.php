<?php

namespace App\Http\Controllers\Reports;

use App\Http\Controllers\Controller;
use App\Http\Requests;
use App\Services\ReportFilesService;
use App\Services\ReportService;
use App\Services\UploadService;
use Illuminate\Http\UploadedFile;
use Illuminate\Support\Facades\Validator;

class CreateReportController extends Controller
{
    /**
     * @desc Create report file ,uploads the created view to s3 storage as html file
     * @param Requests\Reports\CreateReportRequest $request
     * @param ReportService $reportService
     * @param ReportFilesService $filesService
     * @param UploadService $uploadService
     * @return \Illuminate\Http\RedirectResponse|\Illuminate\Routing\Redirector
     */
    public function create(Requests\Reports\CreateReportRequest $request,ReportService $reportService,ReportFilesService $filesService,UploadService $uploadService){
        //Check if the admin user have the permission to create reports
        //  check AuthServiceProvider for all abilities
        $this->authorize('create-report');

        $report= $reportService->create($request->requestToEntity());

        /** UploadedFile[]  $file */
        $files = $request->file('files');
        foreach($files as $file){
               if(!is_null($file)){
                $filesService->attachFilesToReport($file,$report,$reportService,$uploadService);
             }
        }
        $reportId=$report->getId();
        return redirect('/editor/'.$reportId);
    }
}
