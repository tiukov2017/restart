<?php
/**
 * Created by PhpStorm.
 * User: eran
 * Date: 03/05/16
 * Time: 13:05
 */

namespace App\Http\Requests\Google;


use App\Entities\Domain;
use App\Http\Requests\EntityRelatedRequest;

class UpdateDomainRequest extends EntityRelatedRequest
{
    function rules(){
        return ['id'=>'required','domain'=>'required'];
    }

    function authorize(){
        return true;
    }

    function requestToEntity(){

        $domainId = $this->get("id");

        $domainUrl = $this->get("domain");

        $description = $this->get("description");

        $user = $this->user();

        $domain = new Domain($domainUrl, $user);

        $domain->setId($domainId);

        $domain->setDescription($description);

        return $domain;
    }

}