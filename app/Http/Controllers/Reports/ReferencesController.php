<?php
/**
 * Created by PhpStorm.
 * User: eran
 * Date: 05/05/16
 * Time: 14:45
 */

namespace App\Http\Controllers\Reports;


use App\Entities\Reference;
use App\Http\Controllers\Controller;
use App\Services\ReferencesService;
use App\Http\Requests\Reports\AddReferencesRequest;
use App\Services\ReportService;
use App\Services\SnapShotService;
use App\Services\UploadService;

class ReferencesController extends Controller
{
    /**
     * @desc Show references fo report
     * @param $id
     * @param ReferencesService $service
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function show($id,ReferencesService $service){
      $references = $service->getReportReferences($id);
       return view('references/references_table',['id'=>$id,'references'=>$references]);
   }

    /**@desc Add Reference to report
     * @param AddReferencesRequest $referenceRequest
     * @param ReportService $reportService
     * @param ReferencesService $referencesService
     * @param SnapShotService $snapShotService
     * @param UploadService $uploadService
     */
    public function add(AddReferencesRequest $referenceRequest,ReportService $reportService,
        ReferencesService $referencesService,SnapShotService $snapShotService,UploadService $uploadService){

                $reference = $referenceRequest->get('reference');
                $reportId = $referenceRequest->get('id');
                $header =isset($reference["header"]) ? $reference["header"] : null ;
                $category = $reference["category"];
                $reference_url = $reference["reference_url"];
                $report = $reportService->getById($reportId);
                $storageFolder=$reportService->getReportStorageFolder($report).'/references/';
                $image_path = $snapShotService->makeScreenShot($reference_url,$storageFolder,$uploadService);
                $image_url = $image_path;

                $entity = new Reference($report,$image_url,$header,$category,$reference_url);
                $referencesService->create($entity);
    }
}