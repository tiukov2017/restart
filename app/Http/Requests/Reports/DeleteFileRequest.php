<?php
/**
 * Created by PhpStorm.
 * User: eran
 * Date: 06/07/16
 * Time: 11:14
 */

namespace App\Http\Requests\Reports;


use App\Http\Requests\SimpleRequest;

class DeleteFileRequest extends  SimpleRequest
{

    function rules()
    {
       return [

           'fileId'=>'required',
           'reportId'=>'required'
       ];
    }

}