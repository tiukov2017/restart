<?php
/**
 * Created by PhpStorm.
 * User: barakdr
 * Date: 03/03/2016
 * Time: 6:42 PM
 */

namespace App\Http\Requests;


class SimpleRequest extends  Request
{
    function authorize(){
        return true;
    }

    function rules(){
        return [];
    }

}