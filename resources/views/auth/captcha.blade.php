<div class="form-group {{ $errors->has('captcha') ? ' has-error' : '' }}">
    <p class="col-md-6 col-md-offset-4">   {!! captcha_img() !!}</p>
    <p class="col-md-6 col-md-offset-4"><input  class="form-control" type="text" name="captcha">
        @if ($errors->has('captcha'))
            <span class="help-block">
           <strong>{{ $errors->first('captcha') }}</strong>
            </span>
        @endif
    </p>
</div>