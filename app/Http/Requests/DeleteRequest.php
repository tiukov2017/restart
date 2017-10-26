<?php
/**
 * Created by PhpStorm.
 * User: eran
 * Date: 28/07/16
 * Time: 17:41
 */

namespace App\Http\Requests;


class DeleteRequest extends SimpleRequest
{

    function rules(){
        return ['id'=>'required'];
    }

    function authorize(){
        return true;
    }

    function getId()
    {
        $id = $this->get("id");

        return $id;

    }

}