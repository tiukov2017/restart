<?php
/**
 * Created by PhpStorm.
 * User: eran
 * Date: 05/05/16
 * Time: 14:48
 */

namespace App\Http\Requests\Reports;


use App\Entities\Reference;
use App\Entities\Report;
use App\Http\Requests\EntityRelatedRequest;
use App\Http\Requests\SimpleRequest;

class AddReferencesRequest extends SimpleRequest
{
    function rules(){
        return ['id'=>'required','reference'=>'required'];
    }

    function authorize(){
        return true;
    }

    function getReferences(){

       $references = $this->get("reference");

       return  $references = json_decode($references);

    }

}