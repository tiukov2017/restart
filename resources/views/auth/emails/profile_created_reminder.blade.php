<div style="direction:rtl" >
    <p>{{$user->name}} שלום </p>

    <p>נוצר עבורך פרופיל משתמש חדש בהצלחה,</p>

    <p>
        שם המשתמש: <a href="mailto:{{$user->email}}">{{$user->email}}</a>
    </p>
    <p>לצורך כניסה למערכת היכנס לקישור הבא:</p>
    <p>
        <a href="{{ $link = url('password/reset', $token).'?email='.urlencode($user->getEmailForPasswordReset()) }}"> {{ $link }} </a>
    </p>
    <p>
        לאחר הכניסה תתבקש לבחור סיסמה
    </p>
    <p>
        <a href="{{route('manual')}}">כאן</a> ניתן לצפות במסמך הסבר התקנת המערכת
    </p>
    <p>
       בהצלחה,
    </p>
</div>