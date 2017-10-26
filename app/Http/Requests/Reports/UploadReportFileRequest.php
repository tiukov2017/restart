<?php
/**
 * Created by PhpStorm.
 * User: eran
 * Date: 29/06/16
 * Time: 14:34
 */

namespace App\Http\Requests\Reports;


use App\Http\Requests\SimpleRequest;

class UploadReportFileRequest extends  SimpleRequest
{
    function authorize(){
        return true;
    }
    function rules(){
        $rules = [];
        //Add rules for each file in array
        $nbr = count($this->file()) - 1;
        foreach(range(0, $nbr) as $index) {
            $rules['file-' . $index] = 'mimes:jpeg,bmp,png,pdf,application/msword,application/vnd.ms-excel,docx';
        }
        return $rules;
    }

}