<?php

namespace App\Http\Requests\Admin;

use App\Http\Requests\Request;
use Illuminate\Support\Facades\Auth;


class RegisterUserRequest extends Request
{

    function rules(){

        return ['email'=>'required|unique:users','name'=>'required','user-phone'=>'required','role'=>'required','user-status'=>'required'];
    }

    function authorize(){
       return true;
    }

}