<?php
/**
 * Created by PhpStorm.
 * User: eran
 * Date: 10/03/16
 * Time: 11:21
 */

namespace App\Services;


use App\DAO\CheckDAO;
use App\DAO\Collections\EntityModelCollection;
use App\DAO\QueryDAO;
use App\DAO\ReportTypeDAO;
use App\Entities\Check;
use App\Entities\GoogleCheck;

class CheckService
{

    public function __construct(CheckDAO $checkDAO,QueryDAO $queryDAO)
    {
        $this->dao = $checkDAO;

        $this->queryDao =$queryDAO;

    }
    /**
     * @return Check[]
     * @desc get all checks from db
     */
    public function getCheckList(){

        /** @var EntityModelCollection $checks */
        $checks =  $this->dao->where('location','!=','google')->orWhereNull('location')->get();
        $checkEntities = $checks->toEntities();

        /** @var CheckDAO[] $googleChecks */
        $googleChecks = $this->dao->where('location','=','google')->get();

        foreach($googleChecks as $check){
            $googleCheck = new GoogleCheck($check->url,
                        $check->check_number,$check->field,$check->googleQuery(),
                             $check->check_name,$check->location,$check->input_fields,$check->type(),$check->guidelines);
            array_push($checkEntities,$googleCheck);
        }
        return $checkEntities;
    }

    /**
     * @param $reportType
     * @return array
     * @desc get check by report type
     */
    public function getChecksByReportType($reportType){

        $checksByReport =[];
        $checkEntities = $this->getCheckList();

        foreach($checkEntities as $check){
            if($check->getType()->name==$reportType){
                array_push($checksByReport,$check);
            }
        }

        $checkCollection = collect($checksByReport);
        $sortedCheckCollection =  $checkCollection->sortBy(function($check){
            return $check->getCheckNumber();
        });

        return $sortedCheckCollection;
    }

    public function getQueries($id){
      return $this->queryDao->getQueryById($id);
    }

    public  function getCheckById($id){

        $check =  $this->dao->find(intval($id))->first();

       /**@var CheckDAO $check */
       return $check->toEntity();
    }

    public function getQueryByCheckId($id){

        $check = $this->getCheckByCheckNumber($id);
        return $check->getQuery()->toEntity();
    }

    public function getCheckByCheckNumber($number){

        /**@var CheckDAO $check */
        $check =  $this->dao->where('check_number','=',$number)->first();
        return $check->toEntity();
    }

}