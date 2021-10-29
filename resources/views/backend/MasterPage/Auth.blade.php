

<!DOCTYPE html>
<html><head>
    <meta charset="utf-8">
    <!--<meta http-equiv="X-UA-Compatible" content="IE=edge">-->
    <title>@yield('title')</title>
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <link rel="shortcut icon" type="image/x-icon" href="{{asset('frontend/images/logo.png')}}" />
    <link rel="stylesheet" href="{{ asset('backend/css/bootstrap.min.css') }}">
    <link rel="stylesheet" href="{{ asset('backend/css/offline-theme-dark.css') }}">
    <link rel="stylesheet" href="{{ asset('backend/css/font-awesome.min.css') }}">
    <link rel="stylesheet" href="{{ asset('backend/css/layout.css') }}">
    <link rel="stylesheet" type="text/css" href="{{asset('backend/assets/Popup-jQuery/toast.style.min.css')}}"/>
    <link rel="stylesheet" href="{{ asset('backend/css/library.css') }}">
    <link rel="stylesheet" href="{{ asset('backend/css/style.css') }}">
    @yield('style')
    <style>
        .navbar-brand img {
            width: 90px;
            position: absolute;
            top: -16px;
            left: 30px;
            filter: grayscale(100%);
            opacity: 0.5;
        }
        .navbar-default.navbar-alt {
            background: #efefef;
            border-color: #d4d4d4;
        }
        .navbar-default.navbar-alt .navbar-nav>li>a {
            color: #838383;
        }
        .navbar-default.navbar-alt .navbar-nav>li>a:hover, .navbar-default.navbar-alt .navbar-nav>li>a:focus {
            color: #527970;
        }

        body {
            animation:myanim 0.5s;
            -webkit-animation:myanim 0.5s;
            /* Safari and Chrome */
        }

        @keyframes body {
            0% {
                background-position:0 0;
            }
            50% {
                background-position:20px 0;
            }
            100% {
                background-position:0 0;
            }
        }
        .fa, .far, .fas {
            font-family: "Font Awesome 5 Free" !important;
        }
    </style>
</head>
<body id="login-body">

<nav class="navbar navbar-default navbar-fixed-top navbar-alt" role="navigation">
    <div class="container-fluid">
        <div class="navbar-header">
            <button type="button" class="navbar-toggle" data-toggle="collapse" data-target="#navbar-collapse">
                <span class="sr-only">Toggle navigation</span>
                <span class="icon-bar"></span>
                <span class="icon-bar"></span>
                <span class="icon-bar"></span>
            </button>
            <a class="navbar-brand" href="{{ route('HomePage') }}">
                <img src="{{asset('frontend/images/logo.png')}}" />
            </a>
        </div>

        <div class="collapse navbar-collapse navbar-right" id="navbar-collapse">
            <ul class="nav navbar-nav">
                <li class=""><a href="{{ route('HomePage') }}">صفحه اصلی سایت</a></li>
                <li class=""><a href="{{ route('Login') }}">ورود</a></li>
                <li><a href="{{ route('Register') }}">ثبت نام</a></li>
            </ul>
        </div>
    </div>

</nav>

<div class="login-container col-sm-8 col-sm-offset-2" dir="rtl">

    @yield('content')

    {{--<h5 class="text-center">تمامی حقوق این اثر محفوظ می باشد</h5>--}}
</div>

<script type="text/javascript" src="{{ asset('backend/js/jquery-1.11.0.min.js') }}"></script>
<script src="{{asset('backend/assets/Popup-jQuery/toast.script.js')}}"></script>
<script type="text/javascript" src="{{ asset('backend/js/bootstrap.min.js') }}"></script>
@yield('script')
</body>
</html>
