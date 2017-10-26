<?php
/**
 * Created by PhpStorm.
 * User: eran
 * Date: 02/05/16
 * Time: 16:32
 */

namespace App\Http\Requests\Google;


use App\Entities\Domain;
use App\Http\Requests\EntityRelatedRequest;

class AddDomainRequest extends EntityRelatedRequest
{
    function rules(){
        return ['domain'=>'required'];
    }

    function authorize(){
        return true;
    }

    function requestToEntity()
    {
        $domainUrl = $this->get("domain");

        $description = $this->get('description');

        $user = $this->user();

        $domain = new Domain($domainUrl, $user);

        $domain->setDescription($description);

        return $domain;
    }
}