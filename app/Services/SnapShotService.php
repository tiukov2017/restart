<?php
/**
 * Created by PhpStorm.
 * User: eran
 * Date: 05/05/16
 * Time: 10:52
 */

namespace App\Services;

use Mockery\CountValidator\Exception;
use Barryvdh\Snappy\Facades\SnappyPdf as PDF;
use \GuzzleHttp\Client;
use Illuminate\Support\Facades\App;

class SnapShotService
{

    /**
     * @param $url
     * @param $storageFolder
     * @param UploadService $uploadService
     * @return string
     * @desc Get image content from given $url and upload to s3
     */
    public function makeScreenShot($url,$storageFolder,UploadService $uploadService){

        $snappy = App::make('snappy.pdf');

        try{
            $imageContent = $snappy->getOutput($url);
        }
        catch(Exception $e){

            $snappy =  App::make('snappy.image');
            $imageContent = $snappy->getOutput($url);
        }
        $imagePath = $uploadService->uploadFile($imageContent,$storageFolder,true);

        return $imagePath;
    }

}