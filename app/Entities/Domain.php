<?php
/**
 * Created by PhpStorm.
 * User: eran
 * Date: 02/05/16
 * Time: 15:50
 */

namespace App\Entities;


class Domain implements IEntity
{
    /** @var  int */
    private $id;
    /** @var  string */
    private $domain;
    /** @var  string */
    private $description;

    /** @var  \App\User */
    private $user;
    /**
     * Domain constructor.
     * @param $domain
     * @param \App\User $user
     */
    public function __construct($domain, \App\User $user)
    {
        $this->domain = $domain;
        $this->user = $user;
    }
    /**
     * @return mixed
     */
    public function getDescription()
    {
        return $this->description;
    }

    /**
     * @param mixed $description
     */
    public function setDescription($description)
    {
        $this->description = $description;
    }

    /**
     * @return mixed
     */
    public function getId()
    {
        return $this->id;
    }

    /**
     * @param mixed $id
     */
    public function setId($id)
    {
        $this->id = $id;
    }
    /**
     * @return mixed
     */
    public function getDomain()
    {
        return $this->domain;
    }

    /**
     * @param mixed $domain
     */
    public function setDomain($domain)
    {
        $this->domain = $domain;
    }

    /**
     * @return \App\User
     */
    public function getUser()
    {
        return $this->user;
    }

    /**
     * @param \App\User $user
     */
    public function setUser($user)
    {
        $this->user = $user;
    }


}