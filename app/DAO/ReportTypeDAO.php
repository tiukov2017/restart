<?php
/**
 * Created by PhpStorm.
 * User: eran
 * Date: 07/06/16
 * Time: 15:37
 */

namespace App\DAO;


use App\Entities\ReportType;

class ReportTypeDAO extends BaseDao
{

    protected $table = 'report_types';
    protected $fillable = ['name'];

    /**
     * @return ReportType
     */
    function toEntity()
    {
        $entity = new ReportType($this->name);

        $entity->setId($this->id);

        return $entity;

    }

    function fillFromEntity(ReportType $reportType)
    {

        $this->name = $reportType->getName();

    }



}