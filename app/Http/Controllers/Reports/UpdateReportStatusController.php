<?php
/**
 * Created by PhpStorm.
 * User: eran
 * Date: 13/06/16
 * Time: 10:14
 */

namespace App\Http\Controllers\Reports;


use App\DAO\ReportStatusDAO;
use App\Entities\Report;
use App\Entities\ReportStatus;
use App\Http\Controllers\Controller;
use App\Http\Requests\Reports\UpdateReportStatusRequest;
use App\Services\CrmApiService;
use App\Services\ReportService;
use App\Services\ReportStatusService;
use App\Services\UserService;
use Illuminate\Support\Facades\Auth;
use Mockery\CountValidator\Exception;

class UpdateReportStatusController extends Controller
{
    /**
     * @param ReportStatusService $statusService
     * @param UserService $userService
     * @param ReportService $reportService
     * @param UpdateReportStatusRequest $request
     * @param CrmApiService $crmApiService
     * @return \Illuminate\Http\JsonResponse
     */
    public function updateReportStatus(ReportStatusService $statusService,UserService $userService,ReportService $reportService,
        UpdateReportStatusRequest $request,CrmApiService $crmApiService){

        $reportId = $request->get('reportId');
        $comment = $request->get('comment');
        $requestUser = $request->get('user');
        $statusId = $request->get('status');

        try{
        $user =$this->getUpdateUser($requestUser,$userService);
        /** @var Report $report */
        $report = $reportService->getById($reportId);

        // Previous report status
        $prevStatus = $report->getStatus()->name;

        /** @var ReportStatusDAO $status */
        $status = $statusService->getStatusById($statusId);

        $report->setUser($user);
        $report->setStatus($status);
        $report->setComment($comment);

        $statusService->update($report);

        if($prevStatus==config('constants.new_status') && $user->id != Auth::User()->id){
            $path = $reportService->generateReportDataPath($report);
            $reportService->sendReportNotificationMail($user,$path);
        }
        if(!is_null($report->getCrmId())){
            $statusService->updateOrderCrmStatus($report->getCrmId(),$status,$crmApiService);
        }
        return response()->json($report);
       }
       catch(Exception $e){
         return  response()->json('failed');
       }
   }
    /**
     * @param $requestUser
     * @param $userService
     * @return /App/User
     */
    private function getUpdateUser($requestUser,$userService){
        if(!is_null($requestUser)){
            $user = $userService->getUserById($requestUser);
        }
        else{
            $user = Auth::User();
        }
        return $user;
    }
}