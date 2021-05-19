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
                             باسلام، این ایمیل جهت فعال سازی حساب کاربری شما ارسال گردیده است.
                             جهت فعال سازی و تغییر رمز عبور خود بر روی لینک زیر کلیک نمایید
                             <br/>
                             <a href="{{$Url}}" class="btn btn-primary">فعال سازی حساب کاربری</a>

                         </div>

                     </div>
                 </div>
             </div>
         </div>
     </div>

    </body>
</html>
