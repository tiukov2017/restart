<?php
/**
 * Created by PhpStorm.
 * User: eran
 * Date: 05/05/16
 * Time: 14:25
 */

namespace App\Entities;


use App\Entities\Report;

class Reference implements IEntity
{
    private $id;
    /** @var  Report */
    private $report;
    /** @var  string */
    private $image_url;
    /** @var  string */
    private $header;
    /** @var  string */
    private $category;
    /** @var  string */
    private $reference_url;

    /**
     * @param Report $report
     * @param $image_url
     * @param $header
     * @param $category
     * @param $reference_url
     */
    public function __construct(Report $report, $image_url, $header, $category,$reference_url)
    {
        $this->report = $report;
        $this->image_url = $image_url;
        $this->header = $header;
        $this->category = $category;
        $this->reference_url=$reference_url;

    }
    /**
     * @return mixed
     */
    public function getReferenceUrl()
    {
        return $this->reference_url;
    }

    /**
     * @param mixed $reference_url
     */
    public function setReferenceUrl($reference_url)
    {
        $this->reference_url = $reference_url;
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
     * @return \App\Entities\Report
     */
    public function getReport()
    {
        return $this->report;
    }

    /**
     * @param \App\Entities\Report $report
     */
    public function setReport($report)
    {
        $this->report = $report;
    }

    /**
     * @return mixed
     */
    public function getImageUrl()
    {
        return $this->image_url;
    }

    /**
     * @param mixed $image_url
     */
    public function setImageUrl($image_url)
    {
        $this->image_url = $image_url;
    }

    /**
     * @return mixed
     */
    public function getHeader()
    {
        return $this->header;
    }

    /**
     * @param mixed $header
     */
    public function setHeader($header)
    {
        $this->header = $header;
    }

    /**
     * @return mixed
     */
    public function getCategory()
    {
        return $this->category;
    }
    /**
     * @param mixed $category
     */
    public function setCategory($category)
    {
        $this->category = $category;
    }

}