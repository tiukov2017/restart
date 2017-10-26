<?php
/**
 * Created by PhpStorm.
 * User: eran
 * Date: 10/07/16
 * Time: 16:45
 */

namespace App\DAO;


use App\Entities\Customer;

class CustomerDAO extends BaseDao
{
    protected $table = 'customers';

    private function owner(){

        $user = $this->hasOne('App\User','id','owner_user_fk');

        return $user->first();
    }
    private function primary_contact(){

        $user = $this->hasOne('App\User','id','primary_contact_user_fk');

        return $user->first();
    }

    function toEntity()
    {
        $entity = new Customer($this->account_id,$this->account_name,$this->owner(),$this->primary_contact());

        $entity->setAccountStatus($this->status);

        $entity->setEmail1($this->email1);

        $entity->setEmail2($this->email2);

        $entity->setEmail3($this->email3);

        $entity->setPhone1($this->phone1);

        $entity->setPhone2($this->phone2);

        $entity->setPhone3($this->phone3);

        $entity->setBillingState($this->billing_state);

        $entity->setDescription($this->description);

        $entity->setSite($this->site);

        $entity->setFax($this->fax);

        $entity->setCompanyId($this->company_id);

        $entity->setSource($this->source);

        return $entity;

    }

    function fillFromEntity(Customer $customer)
    {

          $this->account_id = $customer->getAccountId();

          $this->account_name = $customer->getAccountName();

          $this->owner_user_fk = $customer->getOwner()->id;

          $this->primary_contact_user_fk = $customer->getPrimaryContact()->id;

          $this->status = $customer->getAccountStatus();

          $this->email1 = $customer->getEmail1();

          $this->email2 = $customer->getEmail2();

          $this->email3 = $customer->getEmail3();

          $this->phone1 = $customer->getPhone1();

          $this->phone2 = $customer->getPhone2();

//          $this->phone3 = $customer->getPhone3();

          $this->billing_state = $customer->getBillingState();

          $this->description = $customer->getDescription();

          $this->site = $customer->getSite();

          $this->fax = $customer->getFax();

          $this->company_id = $customer->getCompanyId();

          $this->source = $customer->getSource();

    }

}