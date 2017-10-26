<?php

namespace App\Services;

use App\DAO\ReportQueryDAO;
use App\Entities\ReportQuery;


class ReportQueriesService extends DbUpdateService
{

    public function __construct(ReportQueryDAO $reportQueries) {
        $this->dao = $reportQueries;
    }

    /**
     * Get all Report queries by report id
     *
     * @param $id
     * @return array
     */
    public function getAllQueriesByReportId($id) {

        $reportQueries = $this->dao->findByReportId($id)->get();
        $reportQueryArr = [];

        foreach($reportQueries as $reportQuery) {
            array_push($reportQueryArr, $reportQuery->toEntity());
        }

        return $reportQueryArr;
    }

    public function getQueryByPhrase($phrase) {
       return $this->dao->getQueryByPhrase($phrase);
    }

    public function getQueryId($phrase){
        $query = $this->getQueryByPhrase($phrase);
        if(!is_null($query)){
            return $query->getId();
        }
        return 0;
    }


    /**
     * Remove report query by id
     *
     * @param $id
     * @return bool|string
     */
    public function removeById($id) {
        return $this->delete($id);
    }

    public function updateQuery(ReportQuery $reportQuery){
        $this->dao = new ReportQueryDAO();
        $this->update($reportQuery);
    }


}