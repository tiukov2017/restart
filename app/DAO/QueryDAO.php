<?php
/**
 * Created by PhpStorm.
 * User: eran
 * Date: 13/03/16
 * Time: 13:31
 */

namespace App\DAO;


use App\Entities\Query;

class QueryDAO extends BaseDao
{
    protected $table ='google_queries';



    /**
     * @return Query
     */
    function toEntity()
    {
        $entity = new Query($this->ids,$this->params,$this->templates);

        return $entity;
    }

    public function getAll(){

        return $this->all();
    }

    public function getQueryById($id){

        return $this->find($id)->first();
    }

}