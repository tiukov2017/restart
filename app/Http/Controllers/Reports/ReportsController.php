<?php
/**
 * Created by PhpStorm.
 * User: barakdr
 * Date: 28/02/2016
 * Time: 7:28 PM
 */

namespace App\Http\Controllers\Reports;


use App\Entities\Report;
use App\Http\Controllers\Controller;
use App\Http\Requests\Reports\UpdateReportRequest;
use App\Http\Requests\SimpleRequest;
use App\Services\ReportLockService;
use App\Services\ReportService;
use App\Services\ReportStatusService;
use App\Services\ReportTypeService;
use App\Services\UserService;
use Illuminate\Support\Facades\Auth;


class ReportsController extends  Controller
{

    /**
     * @desc Show all reports list filtered by user permissions
     * @param ReportService $reportService
     * @param ReportStatusService $statusService
     * @param ReportTypeService $reportTypeService
     * @param UserService $userService
     * @param ReportLockService $lockService
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function showAll(ReportService $reportService,ReportStatusService $statusService,
        ReportTypeService $reportTypeService,UserService $userService,ReportLockService $lockService){

        $user = Auth::user();
        if($userService->hasRole($user,'admin')){
            $reports = $reportService->getAll();
            $users = $userService->getAll();
        }
        else{

            $reports = $reportService->getReportsByUserAndStatus($user->id,['waiting']);
            $users = $userService->getUsersByRole('admin');
        }
        $statuses = $statusService->getStatusesToEdit($user,$userService);
        $reports = $lockService->addLockFlagToReports($reports);

        return view('reports/reports',['reports' => $reports,
            'users'=>$users,
            'types'=>$reportTypeService->getAllTypes(),
            'statuses'=>$statuses]);
    }

    /**
     * @desc Show single report
     * @param $id
     * @param ReportService $reportService
     * @param ReportLockService $lockService
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View|string
     */
    public function showReport($id,ReportService $reportService,ReportLockService $lockService){
        /** @var Report $report */
        $report = $reportService->getById($id);

        if(!$lockService->isLocked($report) || $lockService->getReportLockUser($report)==Auth::User()) {
            $lockService->lockReport($report, Auth::User());
            $reportContent = $reportService->loadReportContents($report);
            return view('reports/loaded_report',
                ['reportContent' => $reportContent,
                 'userName' => $report->getUser()->name,
                 'report'=>$report,
                 'shareUrl' =>config('filesystems.shareUrl').$report->getPublishedVersionPath()]);
        }
        else{
            return 'report is unavialable';
        }
    }
    /**
     * @desc Save report editor version
     * @param SimpleRequest $request
     * @param ReportService $reportService
     * @param ReportLockService $lockService
     * @return \Illuminate\Http\JsonResponse
     */
    public function saveReport(UpdateReportRequest $request,ReportService $reportService,ReportLockService $lockService){

        $currentReportId = $request->get('id');
        $report = $reportService->getById($currentReportId);
        $reportContent = $request->get('reportContent');
        $reportData = $request->get('reportData');

        if(!$lockService->isLocked($report)) {

            $reportService->updateReportContent($report, $reportContent);
            $lockService->updateTimeout($report, Auth::User());
            $request->proccessReportUpdateRequest($report);
            $reportService->update($report);
            return response()->json('ok');
        }
        else{
            return response()->json('failure');
        }
    }
    /**
     * @desc Save version of report that will be sent to report customer
     * @param SimpleRequest $request
     * @param ReportService $reportService
     * @param ReportLockService $lockService
     * @return \Illuminate\Http\JsonResponse
     */
    public function publishReport(SimpleRequest $request, ReportService $reportService,ReportLockService $lockService){

        $currentReportId = $request->get('id');
        $report = $reportService->getById($currentReportId);
        $reportContent = $request->get('reportContent');

        if(!$lockService->isLocked($report)) {

            $reportService->publishReport($report, $reportContent);
            $lockService->updateTimeout($report, Auth::User());
            return response()->json('ok');
        }
        else{
            return response()->json('report is locked by other user');
        }
    }

    /**
     * @desc Lock report ,prevents from other users to access the report while editing it
     * @param SimpleRequest $request
     * @param ReportService $reportService
     * @param ReportLockService $lockService
     */
    public function lockReport(SimpleRequest $request,ReportService $reportService,ReportLockService $lockService){

        $user = Auth::User();
        $currentReportId = $request->get('id');
        $report = $reportService->getById($currentReportId);
        $lockService->updateTimeout($report,$user);
    }

    /**
     * @desc Remove report from locked reports list
     * @param SimpleRequest $request
     * @param ReportService $reportService
     * @param ReportLockService $lockService
     */
    public function unlockReport(SimpleRequest $request,ReportService $reportService,ReportLockService $lockService){

        $currentReportId = $request->get('id');
        $report = $reportService->getById($currentReportId);
        $lockService->unlockReport($report);
    }
}