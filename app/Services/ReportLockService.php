<?php
/**
 * Created by PhpStorm.
 * User: eran
 * Date: 16/06/16
 * Time: 16:22
 */

namespace App\Services;

use App\Entities\Report;
use App\User;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Cache;


class ReportLockService
{

    /**
     * @param Report $report
     * @param User $user
     */
    public function lockReport(Report $report,User $user){

       Cache::put($report->getId(),$user,config('constants.lock_expiry_minutes'));

   }

    /**
     * @param Report $report
     */
    public function unlockReport(Report $report){

        Cache::forget($report->getId());
    }

    /**
     * @param Report [] $reports
     * @return  Report []
     */
    public function addLockFlagToReports( $reports ){

        foreach($reports as $report){

            if($this->isLocked($report)){
             $report->setLock();
              $user = $this->getReportLockUser($report);
              $report->setlockMessage($this->prepareLockMessage($user));
          }
        }
        return $reports;
    }

    /**
     * @param Report $report
     * @return bool
     */
    public function isLocked(Report $report){

        if(Cache::has($report->getId())){
            $user = Cache::get($report->getId());
            return $user->id!=Auth::User()->id;
        }
         return false;
    }

    /**
     * @param Report $report
     * @return User
     */
    public function getReportLockUser(Report $report){

        return Cache::get($report->getId());
    }

    public function prepareLockMessage(User $user){

        $message =$user->name;
        return $message;
    }

    /**
     * @param Report $report
     * @param User $user
     *
     */
    public function updateTimeout(Report $report,User $user){

        $this->lockReport($report,$user);
    }

}