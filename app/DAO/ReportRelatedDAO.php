<?php
/**
 * Created by PhpStorm.
 * User: eran
 * Date: 15/05/16
 * Time: 16:18
 */

namespace App\DAO;


use App\Entities\Report;

use Illuminate\Database\Eloquent\Model;

abstract class ReportRelatedDAO extends BaseDao
{
    /**
     * @return Report
     */
    function report(){

        $report = $this->hasOne('App\DAO\ReportDAO','id','report_fk');

        $entity = $report->first()->toEntity();

        return $entity;
    }
}