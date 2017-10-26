<?php
/**
 * Created by PhpStorm.
 * User: eran
 * Date: 23/06/16
 * Time: 15:17
 */

namespace App\Entities;


class ReportFile  implements IEntity
{
    /** @var  int */
    private $id;
    /** @var  Report */
    private $report;
    /** @var  string */
    private $name;
    /** @var  string */
    private $description;
    /** @var  string */
    private $url;

    /**
     * ReportFile constructor.
     * @param Report $report
     * @param $name
     * @param $url
     */
    public function __construct(Report $report, $name, $url)
    {
        $this->report = $report;
        $this->name = $name;
        $this->url = $url;
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
     * @return Report
     */
    public function getReport()
    {
        return $this->report;
    }

    /**
     * @param Report $report
     */
    public function setReport($report)
    {
        $this->report = $report;
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

}