<?php
/**
 * Created by PhpStorm.
 * User: eran
 * Date: 28/11/16
 * Time: 15:39
 */

namespace App\Http\Requests\Google;


use App\Http\Requests\SimpleRequest;

class RemoveResultRequest extends SimpleRequest
{

    public function getResultId(){
        return $this->get('resultId');
    }

}