<?php
/**
 * Created by PhpStorm.
 * User: eran
 * Date: 15/05/16
 * Time: 16:15
 */

namespace App\Entities;


class Bookmark implements IEntity
{
    /** @var  int */
    private $id;
    /** @var  Report */
    private $report;
    /** @var  string */
    private $title;
    /** @var  string */
    private $url;

    /**
     * Bookmark constructor.
     * @param Report $report
     * @param $title
     * @param $url
     */
    public function __construct(Report $report, $title, $url)
    {
        $this->report = $report;

        $this->title = $title;

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
     * @return mixed
     */
    public function getTitle()
    {
        return $this->title;
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
     * @param mixed $title
     */
    public function setTitle($title)
    {
        $this->title = $title;
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