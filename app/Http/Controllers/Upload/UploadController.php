<?php
/**
 * Created by PhpStorm.
 * User: eran
 * Date: 20/04/16
 * Time: 15:39
 */

namespace App\Http\Controllers\Upload;


use App\DAO\ReportDAO;
use App\Http\Requests\Reports\UploadImageRequest;
use App\Services\ReportService;
use App\Services\UploadService;
use Exception;
use Illuminate\Support\Facades\Storage;
use App\Http\Controllers\Controller;

class UploadController extends Controller
{

    /**
     * @desc  Upload image from non editor fields
     * @param UploadImageRequest $request
     * @param UploadService $uploadService
     * @param ReportService $reportService
     * @return string
     */
    public function uploadFromInput(UploadImageRequest $request,UploadService $uploadService,ReportService $reportService){

        $image = $request->file('image');
        $currentReportId = $request->get('id');
        $report = $reportService->getById($currentReportId);
        $storageFolder=$reportService->getReportStorageFolder($report).'/images/';
        $url = $uploadService->uploadFile($image,$storageFolder);

        return $url;
    }


    /**
     * @desc  Upload image from editor from upload plugin
     * @param UploadImageRequest $request
     * @param UploadService $uploadService
     * @param ReportService $reportService
     * @return mixed
     */
    public function uploadFromEditorBrowser(UploadImageRequest $request,UploadService $uploadService,ReportService $reportService){

        $image = $request->file('upload');
        $funcNum=$request->get('CKEditorFuncNum');
        $currentReportId = $request->get('id');
        $report = $reportService->getById($currentReportId);
        $storageFolder=$reportService->getReportStorageFolder($report).'/images/';
        $url = $uploadService->uploadFile($image,$storageFolder);
        $message="";

        //Ckeditor plugin excpecting text/html response
        return  response("<script type='text/javascript'> window.parent.CKEDITOR.tools.callFunction($funcNum, '$url', '$message');</script>")->header('Content-Type','text/html');
    }


    /**
     * @desc Upload image from drag and drop to editor plugin
     * @param UploadImageRequest $request
     * @param UploadService $uploadService
     * @param ReportService $reportService
     * @return \Illuminate\Http\JsonResponse
     */
    public function uploadFromDrop(UploadImageRequest $request,UploadService $uploadService,ReportService $reportService){

        $image = $request->file('upload');
        $imageFileName = time() . '.' . $image->getClientOriginalExtension();
        $currentReportId = $request->get('id');
        $report = $reportService->getById($currentReportId);
        $storageFolder=$reportService->getReportStorageFolder($report).'/images/';
        $url = $uploadService->uploadFile($image,$storageFolder);

        if($url != ''){
            return response()->json(['uploaded'=>1,'fileName'=>$imageFileName,'url'=>$url]);
        }
        else{
            return response()->json(['uploaded'=>0,'error'=>['message'=>'upload failed']]);
        }
    }
}