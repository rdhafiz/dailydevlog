<!doctype html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport"
          content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
</head>
<body dir="rtl" style="text-align: center">

<p>لقد طلبت تسجيل حساب في وهج.<br>
    <br>
    <br>
    لتنشيط هذا الحساب ، يرجى النقر فوق الارتباط التالي في غضون الأيام العشرة القادمة: <br>

    <a href="{{env('APP_URL')}}/activation/{{$user->verified_token}}">
        {{env('APP_URL')}}/activation/{{$user->verified_token}}
    </a>

    <br>
    <br>
    مع تحيات الدعم الفني لمنصة وهج

</p>

</body>
</html>
