<?php
/**
 * Created by PhpStorm.
 * User: eran
 * Date: 27/06/16
 * Time: 17:45
 */

namespace App\Http\Controllers\Reports;


use App\Entities\Report;
use App\Http\Controllers\Controller;
use App\Http\Requests\Reports\UpdateReportRequest;
use App\Services\ReportService;

class UpdateReportController extends  Controller
{
    /**
     * @param UpdateReportRequest $request
     * @param ReportService $reportService
     * @return \Illuminate\Http\RedirectResponse|\Illuminate\Routing\Redirector
     */
   public function updateReport(UpdateReportRequest $request,ReportService $reportService){

       $reportId = $request->get('reportId');
       /** @var Report  $report */
       $report = $reportService->getById($reportId);
       $request->proccessReportUpdateRequest($report);
       $reportService->update($report);

       return redirect()->back();
   }

    /**
     * @param $id
     * @param ReportService $reportService
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function getUpdateReportForm($id,ReportService $reportService){

        $report = $reportService->getById($id);
        return view('reports_forms.update_report_view',['report'=>$report,'dropdown'=>'true']);
    }
}