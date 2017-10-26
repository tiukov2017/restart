<?php
/**
 * Created by PhpStorm.
 * User: eran
 * Date: 16/05/16
 * Time: 10:54
 */

namespace App\Http\Requests\Reports;


use App\Http\Requests\EntityRelatedRequest;
use App\Http\Requests\SimpleRequest;

class AddBookmarkRequest extends SimpleRequest
{

    function rules(){
        return ['report_id'=>'required','url'=>'required','title'=>'required'];
    }

    function authorize(){
        return true;
    }


    function getTitle(){

        return  $title = $this->get('title');
    }

    function getUrl(){

        return $this->get('url');
    }

    function getReportId(){

        return $this->get('report_id');
    }


}