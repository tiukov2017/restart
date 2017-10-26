<?php
/**
 * Created by PhpStorm.
 * User: eran
 * Date: 16/05/16
 * Time: 12:59
 */

namespace App\Http\Requests\Google;


use App\Http\Requests\SimpleRequest;

class DeleteDomainRequest extends SimpleRequest
{

    function rules(){
        return ['id'=>'required'];
    }

    function authorize(){
        return true;
    }

    function getId()
    {
        $domainId = $this->get("id");
        return $domainId;

    }
}