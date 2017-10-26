<?php
/**
 * Created by PhpStorm.
 * User: eran
 * Date: 31/05/16
 * Time: 14:13
 */

namespace App\Http\Controllers\Admin;


use App\Http\Controllers\Controller;
use App\Http\Requests\Admin\RegisterUserRequest;
use App\Services\ResetPasswordMailService;
use App\Services\UserService;
use App\User;
use Illuminate\Support\Facades\Validator;
use Illuminate\Database\QueryException;


class RegisterUserController extends Controller
{

    /**
     * @desc  Create new user
     * @param RegisterUserRequest $request
     * @param ResetPasswordMailService $service
     * @param UserService $userService
     * @return \Illuminate\Http\JsonResponse
     */
    public function create(RegisterUserRequest $request,ResetPasswordMailService $service,UserService $userService)
    {
        //Check if the admin user have the permission to create users
        //  check AuthServiceProvider for all abilities
        $this->authorize('create-user');

        $role = $request->get('role');

            $user = User::create([
                'name' =>  $request->get('name'),
                'email' => $request->get('email'),
                'password' => bcrypt(bcrypt(str_random(6))),
                'role' => $request->get('role'),
                'phone' => $request->get('user-phone'),
                'status' => $request->get('user-status')
            ]);

        if(!is_null($user)){
            $userService->assignRole($user,$role);
        }
       return response()->json(json_encode($service->postEmail($request)));

    }




}