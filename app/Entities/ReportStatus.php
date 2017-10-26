<?php
/**
 * Created by PhpStorm.
 * User: eran
 * Date: 13/06/16
 * Time: 09:52
 */

namespace App\Entities;


class ReportStatus
{
    /** @var  int */
    protected $id;
    /** @var  string */
    protected $name;

    /**
     * ReportStatus constructor.
     * @param $name
     */
    public function __construct($name)
    {
        $this->name = $name;
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
    public function getName()
    {
        return $this->name;
    }

    /**
     * @param mixed $name
     */
    public function setName($name)
    {
        $this->name = $name;
    }

}