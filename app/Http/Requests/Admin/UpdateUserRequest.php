<?php
/**
 * Created by PhpStorm.
 * User: eran
 * Date: 01/06/16
 * Time: 14:59
 */

namespace App\Http\Requests\Admin;


use App\Http\Requests\SimpleRequest;

class UpdateUserRequest extends SimpleRequest
{
    function rules(){

        return ['id'=>'required','email'=>'unique:users'];
    }

}