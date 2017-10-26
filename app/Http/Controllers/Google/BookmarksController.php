<?php
/**
 * Created by PhpStorm.
 * User: eran
 * Date: 16/05/16
 * Time: 10:53
 */

namespace App\Http\Controllers\Google;


use App\Entities\Bookmark;
use App\Http\Controllers\Controller;
use App\Http\Requests\DeleteRequest;
use App\Http\Requests\Reports\AddBookmarkRequest;
use App\Services\BookmarkService;
use App\Services\ReportService;

class BookmarksController extends Controller
{
    /**
     * @param AddBookmarkRequest $request
     * @param ReportService $reportService
     * @param BookmarkService $bookmarkService
     * @return \Illuminate\Http\JsonResponse
     */
    function addBookmark(AddBookmarkRequest $request,ReportService $reportService,BookmarkService $bookmarkService){

       $reportId = $request->getReportId();
       $url = $request->getUrl();
       $title = $request->getTitle();
       $report = $reportService->getById($reportId);
       $entity = new Bookmark($report,$title,$url);

        /** @var Bookmark $entity */
        $entity = $bookmarkService->create($entity);
        return response()->json(['url'=>$entity->getUrl(),'id'=>$entity->getId(),'title'=>$entity->getTitle()]);

    }

    /**
     * @param DeleteRequest $request
     * @param BookmarkService $bookmarkService
     * @return \Illuminate\Http\JsonResponse
     */
    function removeBookmark(DeleteRequest $request,BookmarkService $bookmarkService){

        $response = $bookmarkService->delete($request->getId());
        return response()->json($response);
    }

}