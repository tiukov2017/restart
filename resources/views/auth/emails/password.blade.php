@if($user->remember_token)
    @include('auth.emails.reset_password_email')
@else
    @include('auth.emails.profile_created_reminder')
    @endif


