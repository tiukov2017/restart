<?php

namespace App\DAO;

use App\Entities\ReportQuery;


class ReportQueryDAO extends BaseDao
{

    protected $table = 'report_queries';
    protected $fillable = ['report_id', 'name'];



    /**
     * Find report queries by report id
     *
     * @param $query
     * @param $id
     * @return mixed
     */
    public static function scopeFindByReportId($query, $id) {
        return $query->where('report_id', '=', $id);
    }


    /**
     * Convert report queries dao to entity
     *
     * @return ReportQuery
     */
    public function toEntity()
    {
        $reportQuery = new ReportQuery();

        $reportQuery->setId($this->id);
        $reportQuery->setReportId($this->report_id);
        $reportQuery->setName($this->name);

        return $reportQuery;
    }


    /**
     * Convert report queries entity to dao
     *
     * @param ReportQuery $reportQuery
     */
    public function fillFromEntity(ReportQuery $reportQuery) {
        $this->report_id = $reportQuery->getReportId();
        $this->name = $reportQuery->getName();
    }

    /**
     * @param $phrase
     * @return mixed
     */
    public function getQueryByPhrase($phrase){
        $query =  $this->where(['name'=>$phrase])->first();
        if(!empty($query)){
            return $query->toEntity();
        }
        return null;
    }



}