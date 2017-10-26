<?php
/**
 * Created by PhpStorm.
 * User: eran
 * Date: 23/06/16
 * Time: 15:19
 */

namespace App\DAO;


use App\Entities\ReportFile;

class ReportFileDAO extends ReportRelatedDAO
{

    const REPORT_FK_FIELD="report_fk";

    protected $table = "report_files";

    protected $hidden =['report_fk','updated_at','created_at'];

    /**
     * @return ReportFile
     */
    function toEntity()
    {
        $entity = new ReportFile($this->report(),$this->name,$this->url);

        $entity->setId($this->id);

        return $entity;
    }

    /**
     * @param ReportFile $reportFile
     */
    function fillFromEntity(ReportFile $reportFile)
    {
        $this->report_fk = $reportFile->getReport()->getId();

        $this->name = $reportFile->getName();

        $this->description = $reportFile->getDescription();

        $this->url = $reportFile->getUrl();

    }


}