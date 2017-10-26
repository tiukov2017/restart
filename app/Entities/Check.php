<?php
/**
 * Created by PhpStorm.
 * User: eran
 * Date: 10/03/16
 * Time: 11:15
 */

namespace App\Entities;


use App\DAO\QueryDAO;
use App\DAO\ReportTypeDAO;

class Check implements IEntity
{
    /** @var  int */
    protected $id;
    /** @var  string */
    protected $url;
    /** @var  string */
    protected $field;
    /** @var  string */
    protected $checkNumber;
    /** @var  string */
    protected $checkName;
    /** @var  string */
    protected $location;
    /** @var  string */
    protected $inputFields;
    /** @var  ReportTypeDAO */
    protected $type;
    /** @var  string */
    protected  $guidelines;
    /**@var QueryDAO*/
    protected $query;
    /**
     * @param $url
     * @param $checkNumber
     * @param $field
     * @param $name
     * @param $location
     * @param $inputFields
     * @param $type
     * @param $guidelines
     */
    public function __construct($url, $checkNumber, $field,$name,$location,$inputFields,$type,$guidelines)
    {
        $this->url = $url;
        $this->checkNumber = $checkNumber;
        $this->field = $field;
        $this->checkName = $name;
        $this->location =$location;
        $this->inputFields = $inputFields;
        $this->type =$type;
        $this->guidelines=$guidelines;
    }
    /**
     * @return mixed
     */
    public function getGuidelines()
    {
        return $this->guidelines;
    }

    /**
     * @param mixed $guidelines
     */
    public function setGuidelines($guidelines)
    {
        $this->guidelines = $guidelines;
    }
    /**
     * @return ReportTypeDAO
     */
    public function getType()
    {
        return $this->type;
    }

    /**
     * @param ReportTypeDAO $type
     */
    public function setType($type)
    {
        $this->type = $type;
    }
    /**
     * @return mixed
     */
    public function getLocation()
    {
        return $this->location;
    }

    /**
     * @param mixed $location
     */
    public function setLocation($location)
    {
        $this->location = $location;
    }

    /**
     * @return mixed
     */
    public function getInput()
    {
        return $this->inputFields;
    }

    /**
     * @param mixed $input
     */
    public function setInput($input)
    {
        $this->inputFields = $input;
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
    public function getCheckName()
    {
        return $this->checkName;
    }

    /**
     * @param mixed $checkName
     */
    public function setCheckName($checkName)
    {
        $this->checkName = $checkName;
    }


    /**
     * @return mixed
     */
    public function getUrl()
    {
        return $this->url;
    }

    /**
     * @param mixed $url
     */
    public function setUrl($url)
    {
        $this->url = $url;
    }

    /**
     * @return mixed
     */
    public function getField()
    {
        return $this->field;
    }


    /**
     * @param mixed $field
     */
    public function setField($field)
    {
        $this->field = $field;
    }

    /**
     * @return mixed
     */
    public function getInputFields()
    {
        return $this->inputFields;
    }

    /**
     * @param mixed $inputFields
     */
    public function setInputFields($inputFields)
    {
        $this->inputFields = $inputFields;
    }

    /**
     * @return mixed
     */
    public function getCheckNumber()
    {
        return $this->checkNumber;
    }

    /**
     * @param mixed $checkNumber
     */
    public function setCheckNumber($checkNumber)
    {
        $this->checkNumber = $checkNumber;
    }
    /**
     * @return QueryDAO
     */
    public function getQuery()
    {
        return $this->query;
    }

    /**
     * @param QueryDAO $query
     */
    public function setQuery($query)
    {
        $this->query = $query;
    }

}