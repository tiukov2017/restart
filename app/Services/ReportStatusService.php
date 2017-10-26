<?php
/**
 * Created by PhpStorm.
 * User: eran
 * Date: 13/06/16
 * Time: 10:00
 */

namespace App\Services;


use App\DAO\Collections\EntityModelCollection;
use App\DAO\ReportDAO;
use App\DAO\ReportStatusDAO;
use App\Entities\Report;
use App\Entities\ReportStatus;
use \App\User;
use Illuminate\Support\Facades\Auth;

class ReportStatusService extends DbUpdateService
{
    /**
     * @param ReportDAO $reportDAO
     * @param ReportStatusDAO $statusDAO
     */
    public function __construct(ReportDAO $reportDAO,ReportStatusDAO $statusDAO)
    {
        $this->dao = $reportDAO;
        $this->statusDao = $statusDAO;
    }

    /**
     * @return ReportStatus[]
     */
    public function getStatuses(){

        /** @var EntityModelCollection $statuses */
        $statuses = $this->statusDao->all();
        return $statuses->toEntities();
    }

    /**
     * @param User $user
     * @param UserService $userService
     * @return ReportStatus[]
     * @desc Get statuses collection ,by user role
     */
    public function getStatusesToEdit(User $user,UserService $userService){

       if($userService->hasRole($user,'admin')){
       /** @var EntityModelCollection $statuses */
        $statuses = $this->statusDao->all();
        }
        else{
            /** @var EntityModelCollection $statuses */
            $statuses = $this->statusDao->where('name','=',config('constants.waiting'))->get();
        }
        return $statuses->toEntities();
    }

    /**
     * @param $id
     * @return ReportStatus $status
     */
    public function getStatusById($id){

       $status = $this->statusDao->find($id);
        return $status;
    }

    /**
     * @param $name
     * @return ReportStatusDAO $status
     */
    public function getStatusByName($name){

        $status = $this->statusDao->where('name','=',$name)->first();
        return $status;
    }
    /**
     * @param $statusId
     * @param ReportService $reportService
     * @param UserService $userService
     * @param User $user
     * @param Report $report
     * @param ReportStatusService $statusService
     * @param User $authUser
     * @return ReportStatus $status
     */
    public function getUpdateStatus($statusId,ReportService $reportService,UserService $userService,User $user,User $authUser,Report $report,ReportStatusService $statusService){

        if(is_null($statusId)){
            $currentStatus = $report->getStatus();
            $role = $userService->getRole($authUser);
            $status = $this->getStatusByRole($currentStatus,$role,$statusService);

            if($status!=$currentStatus && $status==config('constants.in_progress')){
                $reportService->sendReportNotificationMail($user,route('editor',['id' => $report->getId()]));
            }
        }
        else{
            $status = $this->getStatusById($statusId);
        }
        return $status;
    }

    /**
     * @param ReportStatusDAO $status
     * @param string $userRole
     * @param ReportStatusService $statusService
     * @return ReportStatus
     */
    public function getStatusByRole(ReportStatusDAO $status,$userRole,ReportStatusService $statusService){

        switch($status->name){

            case config('constants.returned'):
                //Worker passed the report to admin after returning by admin
                if($userRole=='worker'){

                    $status = $statusService->getStatusByName(config('constants.waiting'));
                }
                break;

            case config('constants.in_progress'):
                //Worker passed the report to admin
                if($userRole=='worker'){

                    $status = $statusService->getStatusByName(config('constants.waiting'));
                }

                break;

            case config('constants.waiting'):
                //Admin returned the report to worker
                if($userRole=='admin'){
                    $status = $statusService->getStatusByName(config('constants.returned'));
                }
                break;
        }
        return $status;
    }

    public function updateOrderCrmStatus($orderId,ReportStatusDAO $status,CrmApiService $crmApiService){

        if($status->name != config('constants.new_status')){
            $crmStatusId = $this->getCrmStatusId($status);
            $crmApiService->updateOrderStatus($orderId,$crmStatusId);
        }
    }

    private function getCrmStatusId(ReportStatusDAO $status){

        switch($status->name){

            case config('constants.new_status'):
                $crmStatus = config('crm-api.new');
                break;
            case config('constants.in_progress'):
                $crmStatus = config('crm-api.in_progress');
                break;
            case config('constants.waiting'):
                $crmStatus = config('crm-api.in_progress');
                break;
            case config('constants.returned'):
                $crmStatus = config('crm-api.in_progress');
                break;
            case config('constants.canceled'):
                $crmStatus = config('crm-api.closed');
                break;
            case config('constants.ready'):
                $crmStatus = config('crm-api.closed');
                break;
            default :
                $crmStatus = config('crm-api.in_progress');
        }
        return $crmStatus;
    }
}