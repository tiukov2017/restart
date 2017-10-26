<?php
/**
 * Created by PhpStorm.
 * User: eran
 * Date: 05/05/16
 * Time: 14:29
 */

namespace App\DAO;


use App\Entities\Reference;

use App\Entities\Report;

 class ReferenceDAO extends ReportRelatedDAO
{

    const REPORT_FK_FIELD="report_fk";

    protected $table = "references";

    /**
     * @return Reference
     */
    function toEntity()
    {
        $entity = new Reference($this->report(),$this->image_url,$this->header,$this->category,$this->reference_url);

        $entity->setId($this->id);

        return $entity;

    }

    /**
     * @param Reference $reference
     */
    function fillFromEntity(Reference $reference)
    {
        $this->report_fk = $reference->getReport()->getId();

        $this->image_url = $reference->getImageUrl();

        $this->header = $reference->getHeader();

        $this->category = $reference->getCategory();

        $this->reference_url = $reference->getReferenceUrl();

        $this->id = $reference->getId();

    }
}