<?php
/**
 * Created by PhpStorm.
 * User: eran
 * Date: 27/11/16
 * Time: 15:26
 */

namespace App\Http\Requests\Google;


use App\Http\Requests\ReportRequest;

class GooglePreviewRequest extends ReportRequest
{

    function getGoogleResults(){
       return $this->get('googleResults');
    }

}