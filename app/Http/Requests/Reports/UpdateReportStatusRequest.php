<?php
/**
 * Created by PhpStorm.
 * User: eran
 * Date: 13/06/16
 * Time: 10:24
 */

namespace App\Http\Requests\Reports;


use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Http\Request;

class UpdateReportStatusRequest extends FormRequest
{
    function rules(){
        return ['reportId'=>'required','status'=>'required'];
    }

    function authorize(){
        return true;
    }


}