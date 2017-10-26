<?php
/**
 * Created by PhpStorm.
 * User: eran
 * Date: 04/12/16
 * Time: 11:39
 */

namespace App\Http\Controllers\Google;

use App\Entities\GoogleResult;
use App\Http\Controllers\Controller;
use App\Http\Requests\Google\GoogleApiRequest;
use App\Http\Requests\Google\RemoveResultRequest;
use App\Services\ReportQueriesService;
use Illuminate\Http\Request;
use App\Services\GoogleResultsService;
use App\Http\Requests;

class ResultsController extends Controller
{
    protected $resultsService;
    protected $reportQueryService;

    /**
     * ResultsController constructor.
     * @param $resultsService
     */
    public function __construct(GoogleResultsService $resultsService,ReportQueriesService $reportQueriesService)
    {
        $this->resultsService = $resultsService;
        $this->reportQueryService = $reportQueriesService;
    }

    /**
     * @param Request $request
     */
    public function updateResult(Request $request){
        /** @var GoogleResult $result */
        $result = $this->resultsService->getResult(intval($request->get('id')));
        $result->setDescription($request->get('description'));
        $result->setTitle($request->get('title'));
        $result->setUserComments($request->get('user_comments'));
        $result->setIsChecked(true);
        $this->resultsService->update($result);
    }

    /**
     * @param Request $request
     */
    public function updateSummary(Request $request){
        /** @var GoogleResult $result */
        $result = $this->resultsService->getResult(intval($request->get('id')));
        $result->setUserComments($request->get('user_comments'));
        $this->resultsService->update($result);
    }

    /**
     * @param Request $request
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function displayFirstPage(Request $request){
        $bookmarks = isset($request->query()['bookmarks']) ? $request->query()['bookmarks']: [];
        $resultArr = isset($request->query()['resultsArr']) ? $request->query()['resultsArr']: [];
        $queriesArr = isset($request->query()['queriesArr']) ? $request->query()['queriesArr']: [];

        return view('google_search.google_results_viewer',
            [
                'resultsArr' => $resultArr,
                'reportId' => $request->query()['reportId'],
                'bookmarks' => $bookmarks,
                'queriesArr' => $queriesArr,
                'currentQuery' => $request->query()['currentQuery']
            ]);
    }

    /**
     * @param GoogleApiRequest $request
     * @return string
     */
    public function saveResults(GoogleApiRequest $request) {
        $reportId = $request->getReportId();
        $query = $request->getQuery()['phrase'];

        $this->saveResultsForQuery($request,$reportId);
        return route('previewResults',['reportId'=>$reportId,'query'=>$query]);
    }

    /**
     * @param GoogleApiRequest $request
     * @param $reportId
     */
    private function saveResultsForQuery(GoogleApiRequest $request,$reportId){
        if( !is_array($request->getResults()) ){
            $results = json_decode($request->getResults());
            $this->resultsService->saveResultsForQuery($results,$reportId);
        }
    }

    /**
     * @param $reportId
     * @param $query
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function getFilteredResultsForQuery($reportId,$query){
        $results = $this->resultsService->getCheckedWithTrashedResults($reportId,$query);
        $queryFk = $this->resultsService->getQueryFk($query) | "";
        return view('google_search.google_filtered_results',['results' => $results , 'reportId' => $reportId ,'queryFk' => $queryFk,'query' => $query ]);
    }

    /**
     * @param $reportId
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function getFilteredResultsForReport($reportId) {
        $results = $this->resultsService->getCheckedResultsByReport($reportId);
        return view('google_search.google_filtered_results',['results' => $results , 'reportId' => $reportId ]);
    }

    /**
     * @param $reportId
     * @param $query
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function showResultsPreview($reportId,$query) {
        $queryFk = $this->reportQueryService->getQueryId($query);
        $results = $this->resultsService->getUncheckedResultsPaginator($reportId,$query);
        $resultsCount = $this->resultsService->countTotalResults($reportId,$query);
        return view('google_search.google_results_preview',['results'=>$results,'reportId'=>$reportId,'queryFk' => $queryFk,'query' => $query,'resultsCount'=>$resultsCount]);
    }

    public function getPaginator($reportId,$query){
        $results = $this->resultsService->getUncheckedResultsPaginator($reportId,$query);
        return $results;
    }
    /**
     * @param RemoveResultRequest $request
     */
    public function removeResult(RemoveResultRequest $request) {
        $this->resultsService->removeResultsByUrl($request->getResultId());
    }

    /**
     * @param RemoveResultRequest $request
     */
    public function restoreResult(RemoveResultRequest $request){
        $this->resultsService->restoreResultsByUrl($request->getResultId());
    }

    /**
     * @param GoogleApiRequest $request
     * @return array
     */
    public function filterResults(GoogleApiRequest $request){
        $results = $this
            ->resultsService
            ->filterResults($request->getResults(),$request->getReportId(),$request->getQueries()[$request->getCurrentQuery()]);
        return $results;
    }

    /**
     * @param GoogleApiRequest $request
     * @return mixed
     */
    public function getNextPageResults(GoogleApiRequest $request){
        $reportId = $request->getReportId();
        $query = $request->getQuery()['phrase'];
        return $this->resultsService->getNotTrashedResultsPaginator($reportId,$query);
    }

}