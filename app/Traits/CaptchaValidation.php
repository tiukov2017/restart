<?php
namespace App\Traits;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Lang;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Validator;


trait CaptchaValidation
{
    public function captchaFailureMessage(){

        return Lang::has('auth.captcha')
            ? Lang::get('auth.captcha')
            : 'Invalid code';
    }

    /**
     * @param Request $request
     * @return bool
     */
    private function captchaIsValid(Request $request)
    {

        if (is_null($request->get('captcha'))){
            return false;
        }

        if ($this->captchaFailure($request)) {
            return false;
        }
        return true;
    }
    /**
     * @param $request
     * @return mixed
     */
    private function captchaFailure($request)
    {
        $rules = ['captcha' => 'required|captcha'];
        $validator = Validator::make($request->input(), $rules);
        return $validator->fails();
    }

    /**
     * @param $request
     * @return $this
     */
    public function sendCaptchaFailedResponse($request){

        return redirect()->back()
            ->withInput($request->all())
            ->withErrors([
                'captcha' => $this->captchaFailureMessage(),
            ]);
    }

}