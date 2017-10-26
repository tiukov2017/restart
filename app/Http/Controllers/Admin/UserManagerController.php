<?php
/**
 * Created by PhpStorm.
 * User: eran
 * Date: 30/05/16
 * Time: 19:13
 */

namespace App\Http\Controllers\Admin;


use App\Http\Controllers\Controller;
use App\Services\UserService;

class UserManagerController extends Controller
{
    /**
     * @desc Show all users
     * @param UserService $service
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    function display(UserService $service){

        return view('admin/user_manager',['users'=>$service->getAll()]);
    }
}