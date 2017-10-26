<?php
/**
 * Created by PhpStorm.
 * User: eran
 * Date: 01/06/16
 * Time: 14:58
 */

namespace App\Http\Controllers\Admin;



use App\Http\Controllers\Controller;
use App\Http\Requests\Admin\UpdateUserRequest;
use App\Services\UserService;

class UpdateUserController extends Controller
{
    /**
     * @param UpdateUserRequest $request
     * @param UserService $service
     * @return bool
     */
    function updateUser(UpdateUserRequest $request,UserService $service){

        $this->authorize('update-user');
        $id = $request->get('id');
         $service->update($id,$request);

        return view('admin/user_manager',['users'=>$service->getAll()]);
    }

}