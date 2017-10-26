<div style="direction:rtl">
    <p>{{$user->name}} שלום </p>

    <p>על מנת ליצור סיסמא חדשה לחץ על הקישור הבא:</p>

    <p>
        <a href="{{ $link = url('password/reset', $token).'?email='.urlencode($user->getEmailForPasswordReset()) }}"> {{ $link }} </a>
    </p>
    <p>
        שם משתמש הוא כתובת המייל שלך.
    </p>
    <p>
        לאחר הכניסה תתבקש להזין סיסמא
    </p>
    <p>
     בהצלחה,
    </p>
</div>

