<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Traits\CaptchaValidation;
use App\User;
use DateTime;
use \Illuminate\Http\Request;
use Illuminate\Foundation\Auth\ResetsPasswords;
use Illuminate\Support\Facades\Cookie;
use Illuminate\Support\Facades\Lang;
use Illuminate\Support\Facades\Password;

class PasswordController extends Controller
{
    /*
    |--------------------------------------------------------------------------
    | Password Reset Controller
    |--------------------------------------------------------------------------
    |
    | This controller is responsible for handling password reset requests
    | and uses a simple trait to include this behavior. You're free to
    | explore this trait and override any methods you wish to tweak.
    |
    */
    use CaptchaValidation;
    use ResetsPasswords {
        showResetForm as defaultShowResetForm;
        reset as defaultReset;
        getResetSuccessResponse as defaultGetResetSuccessResponse;
        getResetValidationRules as defaultgetResetValidationRules;
        getResetValidationMessages as defaultResetValidationMessages;
        sendResetLinkEmail as defaultResetLinkEmail;
    }

    protected  $redirectPath='/';


    public function __construct()
    {
        $this->middleware('guest');
    }


    /**
     * Display the password reset view for the given token.
     * Check cookie existance,if not present add captcha to the form
     *
     * If no token is present, display the link request form.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  string|null  $token
     * @return \Illuminate\Http\Response
     */
    public function showResetForm(Request $request, $token = null)
    {
        if (is_null($token)){
            return $this->getEmail();
        }

        $email = $request->input('email');
        $cookie = Cookie::get('lastLogin');

        if (property_exists($this, 'resetView')) {

            if( !is_null($cookie)){
                return view($this->resetView)->with(compact('token', 'email'));
            }
            return view($this->resetView,['captcha'=>true])->with(compact('token', 'email'));
        }

        if (view()->exists('auth.passwords.reset')) {

            if( !is_null($cookie)){
                return view('auth.passwords.reset')->with(compact('token', 'email'));
            }
            return view('auth.passwords.reset',['captcha'=>true])->with(compact('token', 'email'));
        }
        return view('auth.reset')->with(compact('token', 'email'));
    }

    /**
     * Send a reset link to the given user ,check if user's status is active.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function sendResetLinkEmail(Request $request)
    {
        $this->validate($request, ['email' => 'required|email']);

        $email = $request->input('email');
        $user = User::where('email','=',$email)->first();

        if(!is_null($user) && $user->status!='active'){
            return $this->getSendResetLinkEmailFailureResponse('passwords.inactive_user');
        }

        $broker = $this->getBroker();
        $response = Password::broker($broker)->sendResetLink(
            $request->only('email'), $this->resetEmailBuilder()
        );
        switch ($response) {
            case Password::RESET_LINK_SENT:
                return $this->getSendResetLinkEmailSuccessResponse($response);
            case Password::INVALID_USER:
            default:
                return $this->getSendResetLinkEmailFailureResponse($response);
        }
    }
    /**
     * Reset the given user's password with captcha validation.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function reset(Request $request)
    {
        $cookie = Cookie::get('lastLogin');

        if( is_null($cookie)){

           if(!$this->captchaFailure($request)){

              return $this->defaultReset($request);
           }
            else{
                return $this->sendCaptchaFailedResponse($request);
            }
        }
        else{
          return  $this->defaultReset($request);
        }
    }

    /**
     * Get the response for after a successful password reset.
     *
     * @param  string  $response
     * @return \Symfony\Component\HttpFoundation\Response
     */
    protected function getResetSuccessResponse($response)
    {
        return redirect($this->redirectPath())->withCookie('lastLogin',new DateTime());
    }

    /**
     * Get the password reset validation rules.
     *
     * @return array
     */
    protected function getResetValidationRules()
    {
        return [
            'token' => 'required',
            'email' => 'required|email',
            'password' => array('required','confirmed','min:8','regex:/(?=^.{8,}$)((?=.*\d)|(?=.*\W+))(?![.\n])(?=.*[a-z]).*$/'),
        ];
    }

    /**
     * Get the password reset validation messages.
     *
     * @return array
     */
    protected function getResetValidationMessages()
    {
        return [
            'password.regex'=>Lang::get('passwords.password')
        ];
    }



}
