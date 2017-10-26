<?php
/**
 * Created by PhpStorm.
 * User: eran
 * Date: 24/07/16
 * Time: 16:55
 */

namespace App\Http\Controllers\Manual;


use App\Http\Controllers\Controller;

class ManualController extends Controller
{
    /**
     * @desc Show user manual view containing pdf user guide file
     * @return \Illuminate\Http\Response
     */
public function getManual(){
    return response()->make(file_get_contents('https://s3-eu-west-1.amazonaws.com/checknet-assets/checknet_doc.pdf'),200, [
        'Content-Type' => 'application/pdf',
        'Content-Disposition' => 'inline; filename=""'
    ]);
}
}