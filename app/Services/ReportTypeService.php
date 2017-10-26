<?php
/**
 * Created by PhpStorm.
 * User: eran
 * Date: 07/06/16
 * Time: 17:39
 */

namespace App\Services;


use App\DAO\Collections\EntityModelCollection;
use App\DAO\ReportTypeDAO;
use App\Entities\ReportType;

class ReportTypeService
{
    /**
     * @param ReportTypeDAO $reportTypeDAO
     */
    public function __construct(ReportTypeDAO $reportTypeDAO)
    {
        $this->dao = $reportTypeDAO;
    }

    /**
     * @return ReportType[]
     */
    public function getAllTypes(){

        /** @var EntityModelCollection $types */
        $types = $this->dao->all();
        return $types->toEntities();
    }

    public function getTypeByName($typeName){

        return $this->dao->where('name','=',$typeName)->first();
    }
}