<?php
/**
 * Created by PhpStorm.
 * User: eran
 * Date: 18/04/16
 * Time: 17:39
 */

namespace App\Http\Requests\Reports;

use App\Http\Requests\Request;

class UploadImageRequest extends Request
{
    function authorize(){
        return true;
    }
    function rules(){
        return [
            'upload'=>'mimes:jpeg,bmp,png',
            'image'=>'mimes:jpeg,bmp,png',
             'id' => 'required'
        ];
    }
}