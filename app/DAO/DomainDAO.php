<?php
/**
 * Created by PhpStorm.
 * User: eran
 * Date: 02/05/16
 * Time: 14:27
 */

namespace App\DAO;

use App\Entities\Domain;
use Illuminate\Database\Eloquent\Model;


class DomainDAO extends BaseDao
{
  protected $table ='restricted_domains';

    function user(){
        $user = $this->hasOne('App\User','id','user_fk');

        return $user->first();
    }


    /**
     * @return Domain
     */
    function toEntity()
    {
        $entity = new Domain($this->domain,$this->user());

        $entity->setId($this->id);

        $entity->setDescription($this->description);

        return $entity;

    }

    function fillFromEntity(Domain $domain)
    {

        $this->domain = $domain->getDomain();

        $this->user_fk = $domain->getUser()->id;

        $this->description = $domain->getDescription();

    }

    function getDomains(){
        return $this::all()->pluck('domain');
    }

}