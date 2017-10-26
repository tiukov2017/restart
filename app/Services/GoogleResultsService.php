<?php
/**
 * Created by PhpStorm.
 * User: eran
 * Date: 14/03/16
 * Time: 14:06
 */

namespace App\Services;


use App\DAO\GoogleResultDAO;
use App\DAO\ReportDAO;
use App\Entities\GoogleResult;
use App\Entities\IEntity;
use Illuminate\Support\Facades\DB;
use Mockery\CountValidator\Exception;
use stdClass;

class GoogleResultsService extends DbUpdateService
{

    private $domainService;
    protected $dao;

    /**
     * GoogleSearchApiService constructor.
     * @param $domainService
     */
    public function __construct(DomainService $domainService)
    {
        $this->domainService = $domainService;
    }

    /**
     * @param $results
     * @param $reportId
     * @param $query
     * @return array
     */
    public function filterResults($results,$reportId,$query){
        $apiResults = $this->filterCachedResults($results);
        $removedResults = $this->getTrashedResults($reportId,$query);

        $apiResults = self::getObjectArraysDifference($apiResults,$removedResults);
        $apiResults = $this->filterResultsByDomain($apiResults);

        return $apiResults;
    }

    /**
     * @param $results
     * @return array
     */
    public function filterResultsByDomain($results){
        $restrictedDomains = $this->domainService->getDomainsArray();
        $filteredResults = [];

        foreach($results as $result){
            if(!$this->isRestricted($restrictedDomains,$result->url)){
               array_push($filteredResults,$result);
            }
        }
        return $filteredResults;
    }

    /**
     * @param $filterArr
     * @param $url
     * @return bool
     */
    private function isRestricted($filterArr,$url){

        foreach($filterArr as $filterWord){
            if(strrpos($url,$filterWord)!==false){
                return true;
            }
        }
        return false;
    }

    /**
     * @param $googleResults
     * @return array
     */
    private function filterCachedResults($googleResults){
        $cachedResults = self::getCachedResults();

        if(!is_null($cachedResults)){
         $cachedResults = $this->mergeCachedAndNewResults($cachedResults,$googleResults);
        }
        else {
            $cachedResults = $googleResults;
        }
        self::setCachedResults($cachedResults);
        return $googleResults;
    }

    /**
     * @param $array1
     * @param $array2
     * @return array
     */
    private static function getObjectArraysDifference($array1,$array2){
        if(empty($array2))
            return $array1;
        $array1 = self::convertAraysArrayToObjectArray($array1);
        $array2 = self::convertAraysArrayToObjectArray($array2);
        $apiResults = array_udiff($array1,$array2 ,'App\Services\GoogleResultsService::compareGoogleResults');
        return $apiResults;
    }

    /**
     * @param $result1
     * @param $result2
     * @return bool
     */
    public static function compareGoogleResults($result1,$result2){
        $result1 = self::convertArrayToObject($result1);
        $result2 = self::convertArrayToObject($result2);
        return $result1->url == $result2->url ? 0 : 1;
    }

    /**
     * @param $array
     * @return StdClass
     */
    private static function convertArrayToObject($array){
        if(is_array($array)){
            $array = json_decode(json_encode($array));
        }
        return $array;
    }

    private static function convertAraysArrayToObjectArray($array){
        $newArray = [];
        foreach($array as $a){
            $newObject = self::convertArrayToObject($a);
            array_push($newArray,$newObject);
        }
        return $newArray;
    }

    /**
     * @param $googleResultsObjects
     * @return array
     */
    public function makeArrayOfUrls($googleResultsObjects){

        $results=[];
        foreach($googleResultsObjects as $result){
            array_push($results,$result->url);
        }
        return $results;
    }

    /**
     * @param $results
     * @param $reportFk
     * @return bool
     */
    public function saveResultsForQuery($results,$reportFk){
        foreach($results as $result) {
                $this->saveResult($result, $reportFk);
        }
    }

    /**
     * @param $result
     * @param $reportFk
     */
    private function saveResult($result,$reportFk){
        $this->dao = new GoogleResultDAO();
        if(!isset($result->id) && $this->resultIsNotExists($result,$reportFk)){
            $queryFk = isset($result->queryFk) ? $result->queryFk : null;

            $googleResult = new GoogleResult($reportFk,$result->query,$result->title,
                $result->url,$result->description,0,$queryFk);

            $googleResult->setIsChecked(false);
            $googleResult = $this->create($googleResult);
            $this->delete($googleResult->getId());
        }
    }

    private function resultIsNotExists($result,$reportFk){
       return count($this->dao->getResultByUrl($result->url,$reportFk)) == 0;
    }

    /**
     * @param $reportId
     * @param $query
     * @return mixed
     */
    public function getUncheckedResultsPaginator($reportId,$query){
        $this->dao = new GoogleResultDAO();
        $results = $this->dao->getUncheckedResultsPaginator($reportId,$query);
        return $results;
    }

    /**
     * @param $reportId
     * @param $query
     * @return mixed
     */
    public function getNotTrashedResultsPaginator($reportId,$query){
        $this->dao = new ReportDAO();
        $results = $this->dao
            ->find($reportId)
            ->getResultsForQuery($query)
            ->paginate(10);
        return $results;
    }

    /**
     * @param $query
     * @return mixed
     */
    public function getQueryFk($query){
         $this->dao = new GoogleResultDAO();
        return $this->dao->getQueryFk($query);
    }

    public function getTrashedResults($reportId,$query){
        $this->dao = new ReportDAO();
        $removedResults = $this->dao
            ->find($reportId)
            ->googleResults()
            ->onlyTrashed()
            ->where(['query'=>$query])
            ->get()
            ->toArray();
        return $removedResults;
    }

    /**
     * @param $reportId
     * @param $query
     * @return Array
     */
    public function getCheckedWithTrashedResults($reportId,$query){
        $this->dao = new ReportDAO();
        $results = $this->dao
            ->find($reportId)
            ->googleResults()
            ->withTrashed()
            ->where(['query'=> $query])
            ->where(['is_checked' => true])
            ->get()
            ->toEntities();
        return $results;
    }

    /**
     * @param $reportFk
     * @param $query
     * @return int
     */
    public function countTotalResults($reportFk,$query){
        return count($this->getAllResults($reportFk,$query));
    }

    /**
     * @param $reportFk
     * @param $query
     * @return mixed
     */
    private function getAllResults($reportFk,$query){
        $this->dao = new GoogleResultDAO();
        return $this->dao->getAllResultsByReportAndQuery($reportFk,$query);
    }

    /**
     * @return mixed
     */
    private static function getCachedResults(){
       return session('googleResults');
    }

    /**
     * @param $results
     */
    private static function setCachedResults($results){
        session('googleResults',$results);
    }

    /**
     * @param $cachedResults
     * @param $newResults
     * @return array
     */
    private static function mergeCachedAndNewResults($cachedResults,$newResults){
        $newResults = array_diff($newResults,$cachedResults);
        $cachedResults = array_merge($cachedResults,$newResults);
        return $cachedResults;
    }

    /**
     * @param $resultId
     */
    public function removeResult($resultId){
        $this->dao = new GoogleResultDAO();
        $this->dao ->updateIsChecked($resultId);
        $this->delete($resultId);
    }

    public function removeResultsByUrl($resultId){
        $this->dao = new GoogleResultDAO();
        $result = $this->dao->getResultById($resultId);
        $results = $this->dao->getResultByUrl($result->getUrl(),$result->getReportFK());

        foreach($results as $result){
            $this->removeResult($result->getId());
        }
    }

    /**
     * @param $resultId
     */
    public function restoreResultsByUrl($resultId){
        $this->dao = new GoogleResultDAO();
        $result = $this->dao->getResultById($resultId);
        $results = $this->dao->getResultByUrl($result->getUrl(),$result->getReportFK());

        foreach($results as $result){
            $this->restoreResult($result->getId());
        }
    }

    /**
     * @param $resultId
     */
    public function restoreResult($resultId){
        $this->dao = new GoogleResultDAO();
        $this->dao ->restoreResult($resultId);
        $this->dao ->updateIsChecked($resultId);
    }

    /**
     * @param $resultId
     * @return mixed
     */
    public function getResult($resultId){
        $this->dao = new GoogleResultDAO();
        return $this->dao->getResultById($resultId);
    }

    /**
     * @param $reportId
     * @return Array
     */
    public function getCheckedResultsByReport($reportId){
        $this->dao = new ReportDAO();
        $results = $this->dao->getCheckedResultsByReport($reportId);
        return $results;
    }

    public function update(IEntity $entity){
        try{
            $dao = $this->dao->withTrashed()->findOrFail($entity->getId());
            $dao->fillFromEntity($entity);
            $dao->save();
            return true;
        }
        catch(Exception $e){
            return $e->getMessage();
        }
    }

    /**
     * @param $id
     * @return bool|string
     */
    public function delete($id){

        try{
            $dao = $this->dao->withTrashed()->findOrFail($id);
            $dao->delete();
            return true;
        }
        catch(Exception $e){
            return $e->getMessage();
        }
    }

}