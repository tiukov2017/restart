<?php
/**
 * Created by PhpStorm.
 * User: eran
 * Date: 13/06/16
 * Time: 09:48
 */

namespace App\DAO;


use App\Entities\ReportStatus;

class ReportStatusDAO extends BaseDao
{
    protected $table = 'report_statuses';
    protected $fillable = ['new', 'in_progress', 'waiting', 'ready', 'canceled', 'returned'];

    function toEntity()
    {
        $entity = new ReportStatus($this->name);

        $entity->setId($this->id);

        return $entity;
    }

    function fillFromEntity(ReportStatus $reportStatus)
    {

        $this->name = $reportStatus->getName();

    }

}