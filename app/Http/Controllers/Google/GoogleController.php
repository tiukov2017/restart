<?php

namespace App\Http\Controllers\Google;


use App\Entities\Query;
use App\Entities\ReportQuery;
use App\Http\Controllers\Controller;
use App\Http\Requests;
use App\Http\Requests\Google\GoogleApiRequest;
use App\Services\BookmarkService;
use App\Services\CheckService;
use App\Services\GoogleResultsService;
use App\Services\ReportQueriesService;
use Illuminate\Http\Request;

class GoogleController extends Controller{

    protected $reportQueriesService;
    protected $googleResultsService;

    public function __construct(ReportQueriesService $reportQueriesService,GoogleResultsService $googleResultsService) {
        $this->reportQueriesService = $reportQueriesService;
        $this->googleResultsService = $googleResultsService;
    }

    /**
     * @desc Show google queries view
     * @param $reportId
     * @param $id
     * @param GoogleApiRequest $request
     * @param CheckService $checkService
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    function display($reportId ,$id ,GoogleApiRequest $request,CheckService $checkService) {
        $this->clear($request);
        $reportQueries = $this->reportQueriesService->getAllQueriesByReportId($reportId);

        /** @var Query $queries */
        $queries=$checkService->getQueryByCheckId($id);
        return view('google_search.google_search_container',[
            'ids'=>$queries->getIds(),
            'paramsArr'=>$queries->getParams(),
            'templates'=>$queries->getTemplates(),
            'reportQueries' => $reportQueries
        ]);
    }
    /**
     * @param GoogleApiRequest $request
     * @param BookmarkService $bookmarkService
     * @return string
     */
    function search(GoogleApiRequest $request,BookmarkService $bookmarkService) {
         $reportId = $request->getReportId();
         $queriesArr = $request->getQueries();
         $currentQuery = $this->getCurrentQuery($request);
         $results = $request->getResults();

         $apiResults = $this->getResults($results,$reportId,$currentQuery);
         $resultsArr = $this->googleResultsService->makeArrayOfUrls($apiResults);
         $bookmarks = $bookmarkService->getReportBookmarks($reportId);

         $request->session()->put('pageResults',$apiResults);
         $request ->session()->put('bookmarks',$bookmarks);

         return route('googlePagesResults',
            [
                'resultsArr' => $resultsArr,
                'reportId' => $reportId,
                'bookmarks' => $bookmarks,
                'queriesArr' => $queriesArr,
                'currentQuery' => $currentQuery
            ]);
    }

    /**
     * @param $results
     * @param $reportId
     * @param $query
     * @return array|mixed
     */
    private function getResults($results,$reportId,$query){
        if(!is_array($results)){
            return  $this->googleResultsService->filterResults(json_decode($results),$reportId,$query);
        }
        else{
            return $this->googleResultsService->getNotTrashedResultsPaginator($reportId,$query);
        }
    }

    /**
     * @param GoogleApiRequest $request
     * @return mixed
     */
    private function getCurrentQuery(GoogleApiRequest $request){
        $queryIndex=$request->getCurrentQuery();
        $queriesArr = $request->getQueries();
        return $queriesArr[$queryIndex];
    }

    /**
     * @desc Clear session from previous results
     * @param GoogleApiRequest $request
     */
    public function clear(GoogleApiRequest $request){
        $request->session()->forget('resultsArr',null);
        $request->session()->forget('pageResults',null);
    }

    /**
     * Duplicate report query
     *
     * @param Request $request
     * @return \Illuminate\Http\JsonResponse
     */
    public function duplicateReportQuery(Request $request) {
        $reportName = $request->get('reportName');
        $reportId = $request->get('reportId');

        $reportQuery = new ReportQuery();
        $reportQuery->setName($reportName);
        $reportQuery->setReportId($reportId);
        $reportQuery = $this->reportQueriesService->create($reportQuery);

        if(!empty($reportQuery)) {
            return response()->json([$reportQuery]);
        }
        return response()->json([null]);
    }

    /**
     * Remove report query by id
     *
     * @param $reportQueryId
     * @return bool|string
     */
    public function removeReportQueryById($reportQueryId) {
        $this->reportQueriesService->removeById($reportQueryId);
    }

    /**
     * Update report query
     * @param Request $request
     */
    public function updateReportQuery(Request $request) {
        $reportQuery = new ReportQuery();
        $reportQuery->setId($request->get('id'));
        $reportQuery->setName($request->get('name'));
        $reportQuery->setReportId($request->get('report_id'));

        $this->reportQueriesService->updateQuery($reportQuery);
    }

}