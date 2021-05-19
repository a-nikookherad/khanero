<html>
<head>
    <link rel="stylesheet" href="{{asset('frontend/css/bootstrap.min.css')}}">
</head>
<body>
<div class="container">
    <div class="register-leftbox ">
        <div class="row">
            <div class="col-md-8 col-md-offset-2">
                <div class="panel panel-default">

                    <div class="panel-heading">
                        <img src="{{asset('frontend/images/logo.png')}}">
                    </div>

                    <div class="panel-body">
                        باسلام
                        این ایمیل جهت فعال سازی حساب کاربری شما ارسال گردیده است.
                        <br/>
                        <p>
                            برای فعال سازی حساب کاربری خود بر روی لینک زیر کلیک نمایید
                        </p>
                        <a href="{{route('ActiveAccount',['token'=>$Token])}}" class="btn btn-primary">بازیابی رمز عبور</a>

                    </div>

                </div>
            </div>
        </div>
    </div>
</div>

</body>
</html>
