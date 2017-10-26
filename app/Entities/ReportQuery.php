<?php

namespace App\Entities;

use JsonSerializable;

class ReportQuery implements IEntity, JsonSerializable
{

    protected $id;
    protected $reportId;
    protected $name;



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
    public function getReportId()
    {
        return $this->reportId;
    }

    /**
     * @param mixed $reportId
     */
    public function setReportId($reportId)
    {
        $this->reportId = $reportId;
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

    public function jsonSerialize()
    {
        return [
            'id' => $this->id,
            'reportId' => $this->reportId,
            'name' => $this->name
        ];
    }

}