<?php
/**
 * Created by PhpStorm.
 * User: eran
 * Date: 20/04/16
 * Time: 15:43
 */

namespace App\Services;


use App\Http\Requests\Reports\UploadImageRequest;
use Exception;
use League\Flysystem\Config;
use Illuminate\Support\Facades\Storage;
use League\Flysystem\AwsS3v3\AwsS3Adapter;
use Symfony\Component\HttpFoundation\File\UploadedFile;


class UploadService
{
    /**
     * @param UploadedFile $file
     * @param string $storageFolder
     * @param bool|false $isRaw
     * @param null $uploadedFileName
     * @return string
     */
    public function uploadFile($file,$storageFolder,$isRaw=false,$uploadedFileName=null){

           try{
               $mimeType = $isRaw  ? 'application/pdf' : $file->getClientMimeType();
               $fileContent = $isRaw ? $file : file_get_contents($file);
               $fileName = !is_null($uploadedFileName)? $uploadedFileName :( $isRaw ?time().'.pdf' :time(). '.' . $file->getClientOriginalExtension());
               $s3 = Storage::disk('s3');
               $filePath = $storageFolder . $fileName;
               $config = new Config();
               $config->set('mimetype', $mimeType);
               $s3->getAdapter()->write($filePath, $fileContent, $config);
               $url=config('filesystems.shareUrl').$filePath;
           }
           catch(Exception $e){
               $url = "";
           }
        return $url;
    }

    public function deleteFile($fileName,$storageFolder){

        $s3 = Storage::disk('s3');
        $filePath = $storageFolder . $fileName;
        $config = new Config();
        $s3->getAdapter()->delete($filePath, $config);
    }

}