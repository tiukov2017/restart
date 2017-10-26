<?php
/**
 * Created by PhpStorm.
 * User: eran
 * Date: 10/07/16
 * Time: 16:47
 */

namespace App\Entities;


use App\User;

class Customer implements IEntity
{
    /** @var  int */
    private $id;
    /** @var  string
     @desc crm id */
    private $account_id;
    /** @var  string */
    private $account_name;
    /** @var  User */
    private $owner;
    /** @var  User */
    private $primary_contact;
    /** @var  string */
    private $phone1;
    /** @var  string */
    private $phone2;
    /** @var  string */
    private $phone3;
    /** @var  string */
    private $fax;
    /** @var  string */
    private $email1;
    /** @var  string */
    private $email2;
    /** @var  string */
    private $email3;
    /** @var  string */
    private $company_id;
    /** @var  string */
    private $status;
    /** @var  string */
    private $site;
    /** @var  string */
    private $source;
    /** @var  string */
    private $billing_state;
    /** @var  string */
    private $description;
    /** @var  string */
    private $account_status;

    /**
     * Customer constructor.
     * @param string $account_id
     * @param string $account_name
     * @param User $owner
     * @param User $primary_contact
     */
    public function __construct($account_id, $account_name, User $owner=null, User $primary_contact=null)
    {
        $this->account_id = $account_id;
        $this->account_name = $account_name;
        $this->owner = $owner;
        $this->primary_contact = $primary_contact;
    }

    /**
     * @return int
     */
    public function getId()
    {
        return $this->id;
    }

    /**
     * @param int $id
     */
    public function setId($id)
    {
        $this->id = $id;
    }

    /**
     * @return string
     */
    public function getAccountId()
    {
        return $this->account_id;
    }

    /**
     * @param string $account_id
     */
    public function setAccountId($account_id)
    {
        $this->account_id = $account_id;
    }

    /**
     * @return string
     */
    public function getAccountName()
    {
        return $this->account_name;
    }

    /**
     * @param string $account_name
     */
    public function setAccountName($account_name)
    {
        $this->account_name = $account_name;
    }

    /**
     * @return User
     */
    public function getOwner()
    {
        return $this->owner;
    }

    /**
     * @param User $owner
     */
    public function setOwner($owner)
    {
        $this->owner = $owner;
    }

    /**
     * @return User
     */
    public function getPrimaryContact()
    {
        return $this->primary_contact;
    }

    /**
     * @param User $primary_contact
     */
    public function setPrimaryContact($primary_contact)
    {
        $this->primary_contact = $primary_contact;
    }

    /**
     * @return string
     */
    public function getPhone1()
    {
        return $this->phone1;
    }

    /**
     * @param string $phone1
     */
    public function setPhone1($phone1)
    {
        $this->phone1 = $phone1;
    }

    /**
     * @return string
     */
    public function getPhone2()
    {
        return $this->phone2;
    }

    /**
     * @param string $phone2
     */
    public function setPhone2($phone2)
    {
        $this->phone2 = $phone2;
    }

    /**
     * @return string
     */
    public function getPhone3()
    {
        return $this->phone3;
    }

    /**
     * @param string $phone3
     */
    public function setPhone3($phone3)
    {
        $this->phone3 = $phone3;
    }

    /**
     * @return string
     */
    public function getFax()
    {
        return $this->fax;
    }

    /**
     * @param string $fax
     */
    public function setFax($fax)
    {
        $this->fax = $fax;
    }

    /**
     * @return string
     */
    public function getEmail1()
    {
        return $this->email1;
    }

    /**
     * @param string $email1
     */
    public function setEmail1($email1)
    {
        $this->email1 = $email1;
    }

    /**
     * @return string
     */
    public function getEmail2()
    {
        return $this->email2;
    }

    /**
     * @param string $email2
     */
    public function setEmail2($email2)
    {
        $this->email2 = $email2;
    }

    /**
     * @return string
     */
    public function getEmail3()
    {
        return $this->email3;
    }

    /**
     * @param string $email3
     */
    public function setEmail3($email3)
    {
        $this->email3 = $email3;
    }

    /**
     * @return string
     */
    public function getCompanyId()
    {
        return $this->company_id;
    }

    /**
     * @param string $company_id
     */
    public function setCompanyId($company_id)
    {
        $this->company_id = $company_id;
    }

    /**
     * @return string
     */
    public function getStatus()
    {
        return $this->status;
    }

    /**
     * @param string $status
     */
    public function setStatus($status)
    {
        $this->status = $status;
    }

    /**
     * @return string
     */
    public function getSite()
    {
        return $this->site;
    }

    /**
     * @param string $site
     */
    public function setSite($site)
    {
        $this->site = $site;
    }

    /**
     * @return string
     */
    public function getSource()
    {
        return $this->source;
    }

    /**
     * @param string $source
     */
    public function setSource($source)
    {
        $this->source = $source;
    }

    /**
     * @return string
     */
    public function getBillingState()
    {
        return $this->billing_state;
    }

    /**
     * @param string $billing_state
     */
    public function setBillingState($billing_state)
    {
        $this->billing_state = $billing_state;
    }

    /**
     * @return string
     */
    public function getDescription()
    {
        return $this->description;
    }

    /**
     * @param string $description
     */
    public function setDescription($description)
    {
        $this->description = $description;
    }

    /**
     * @return string
     */
    public function getAccountStatus()
    {
        return $this->account_status;
    }

    /**
     * @param string $account_status
     */
    public function setAccountStatus($account_status)
    {
        $this->account_status = $account_status;
    }


}