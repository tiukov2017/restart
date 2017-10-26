<?php
/**
 * Created by PhpStorm.
 * User: eran
 * Date: 28/11/16
 * Time: 11:10
 */

namespace App\Http\Requests;


abstract class ReportRequest extends SimpleRequest
{

    public function getReportId(){
       return $this->get('reportId');
    }


}