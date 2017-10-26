<?php

namespace App\Http\Controllers\Editor;

use App\Http\Controllers\Controller;
use App\Http\Requests;
use App\Services\CheckService;
use App\Services\ReportLockService;
use App\Services\ReportService;


class EditorController extends Controller
{
    /**
     * @desc Show editor view ,report and check containers
     * @param $id
     * @param CheckService $checkService
     * @param ReportService $reportService
     * @param ReportLockService $lockService
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
   public function display($id,CheckService $checkService,ReportService $reportService,ReportLockService $lockService){

       $report = $reportService->getById($id);

       //Check if current report is locked by other user
       if($lockService->isLocked($report)) {
        return view('reports.report_unavialable');
       }
       $reportType = $report->getType()->name;
       $checkList=$checkService->getChecksByReportType($reportType);

       return view('editor.editor_container',['id'=>$id,'checkList'=>$checkList,'report'=>$report]);
   }
}
