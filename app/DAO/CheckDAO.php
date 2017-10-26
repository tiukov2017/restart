<?php
/**
 * Created by PhpStorm.
 * User: eran
 * Date: 13/03/16
 * Time: 13:30
 */

namespace App\DAO;


use App\Entities\Check;
use App\Entities\GoogleCheck;

class CheckDAO extends BaseDao
{
    protected $table ='checks';

    function type(){

        $type = $this->hasOne('App\DAO\ReportTypeDAO','id','type_fk');

        return $type->first();

    }

     public function googleQuery(){

        $query = $this->hasOne('App\DAO\QueryDAO','id','google_query_fk');

        return $query->first();
    }

    /**
     * @return Check
     */
    function toEntity()
    {
        $entity = new Check($this->url,$this->check_number,$this->field,$this->check_name,$this->location,$this->input_fields,$this->type(),$this->guidelines);

        $entity->setId($this->id);

        $entity->setQuery($this->googleQuery());

        return $entity;
    }

    function fillFromEntity(Check $check)
    {

        $this->url = $check->getUrl();

        $this->field= $check->getField();

        $this->check_number = $check->getCheckNumber();

        $this->check_name = $check->getCheckName();

        $this->location = $check->getLocation();

        $this->input_fields = $check->getInput();

        $this->type_fk = $check->getType()->id;

        $this->guidelines = $check->getGuidelines();

    }

}