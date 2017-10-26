<?php
/**
 * Created by PhpStorm.
 * User: eran
 * Date: 05/05/16
 * Time: 14:51
 */

namespace App\Services;


use App\DAO\Collections\EntityModelCollection;
use App\DAO\ReferenceDAO;
use App\Entities\Reference;

class ReferencesService extends DbUpdateService
{

    /**
     * @param ReferenceDAO $referenceDAO
     */
    public function __construct(ReferenceDAO $referenceDAO)
    {
        $this->dao = $referenceDAO;
    }

    /**
     * @param $id
     * @return array
     */
    public function getReportReferences($id){

        /** @var EntityModelCollection $references */
        $references = $this->dao->where('report_fk','=',$id)->get();
        return $references->toEntities();
    }
}