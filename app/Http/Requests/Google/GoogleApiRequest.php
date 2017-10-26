<?php
namespace App\Http\Requests\Google;

use App\Http\Requests\ReportRequest;



class GoogleApiRequest extends ReportRequest
{

    function getResults()
    {
        return json_decode($this->get('googleResults'));
    }

    function getQueries()
    {
        $queriesArray = [];
        $queries = json_decode($this->get('queries'));

        foreach($queries as $query){
            array_push($queriesArray,$query->phrase);
        }
        return  array_values(array_filter(array_unique($queriesArray)));
    }
    function getQuery(){
        return $this->get('query');
    }

    function getCurrentQuery()
    {
        return intval($this->get('currentQueryIndex'));
    }

    function getIsNewQuery()
    {
        return $this->get('isNewQuery');
    }

    function getStartIndex()
    {
        return $this->get('startIndex');
    }

}