<?php

namespace App\Http\Controllers\Auth;

use App\Traits\CaptchaValidation;
use App\User;
use DateTime;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Foundation\Auth\ThrottlesLogins;
use Illuminate\Foundation\Auth\AuthenticatesAndRegistersUsers;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Cookie;
use Illuminate\Support\Facades\Lang;
use Illuminate\Support\Facades\Password;
use Illuminate\Support\Facades\Validator;


class AuthController extends Controller
{
    /*
    |--------------------------------------------------------------------------
    | Registration & Login Controller
    |--------------------------------------------------------------------------
    |
    | This controller handles the registration of new users, as well as the
    | authentication of existing users. By default, this controller uses
    | a simple trait to add these behaviors. Why don't you explore it?
    |
    */

    use ThrottlesLogins;
    use CaptchaValidation;
    use AuthenticatesAndRegistersUsers {
        login as defaultLogin;
        showLoginForm as defaultShowLoginForm;
    }

    /**
     * Where to redirect users after login / registration.
     *
     * @var string
     */
    protected $redirectTo = '/';

    /**
     *
     */
    public function __construct()
    {
        $this->middleware($this->guestMiddleware(), ['except' => 'logout']);
    }

    /**
     * Show the application login form.Return captcha for new user
     *
     * @return \Illuminate\Http\Response
     */
    public function showLoginForm()
    {
        $view = property_exists($this, 'loginView')
            ? $this->loginView : 'auth.authenticate';

        if (view()->exists($view)) {
            return view($view);
        }

        $cookie = Cookie::get('lastLogin');

        if(!is_null($cookie)){
            return view('auth.login');
        }
        else{
            //Return view with captcha for new user
            return view('auth.login', ['captcha' => true]);
        }
    }
    /**
     * @param Request $request
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\Http\Response|\Illuminate\View\View
     */
    public function login(Request $request)
    {

        if (is_null(Cookie::get('lastLogin'))) {
            //Check captcha validity for new user
            if (!$this->captchaIsValid($request)){
             return $this->sendCaptchaFailedResponse($request);
            }
            else{
                return $this->loginUserIfActive($request);
            }
        }
            return $this->loginUserIfActive($request);
    }

    /**
     * @param Request $request
     * @return \Illuminate\Http\Response
     */
    private function loginUserIfActive(Request $request){

        if (Auth::attempt(['email' => $request->get('email'), 'password' =>  $request->get('password'), 'status' => 'active'])) {
            // The user is active, not suspended, and exists.
            return $this->defaultLogin($request)->withCookie(cookie()->forever('lastLogin',new DateTime()));
        }
        else{
           return $this->sendFailedLoginResponse($request);
        }
    }

    /**
     * Get a validator for an incoming registration request.
     *
     * @param  array  $data
     * @return \Illuminate\Contracts\Validation\Validator
     */
    protected function validator(array $data)
    {
        return Validator::make($data, [
            'name' => 'required|max:255',
            'email' => 'required|email|max:255|unique:users'
        ]);
    }

}
