
<!DOCTYPE html>
<html lang="fa">
<head><meta http-equiv="Content-Type" content="text/html; charset=utf-8">

    <!--<meta http-equiv="X-UA-Compatible" content="IE=edge">-->
    <title>@yield('title')</title>
    <meta name="description" content="Flatter - Flat Admin Theme">
    <meta name="viewport" content="width=device-width, user-scalable=no, initial-scale=1.0">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <link rel="apple-touch-icon-precomposed" sizes="144x144" href="image/touch/apple-touch-icon-144x144-precomposed.png">
    <link rel="apple-touch-icon-precomposed" sizes="114x114" href="image/touch/apple-touch-icon-114x114-precomposed.png">
    <link rel="apple-touch-icon-precomposed" sizes="72x72" href="image/touch/apple-touch-icon-72x72-precomposed.png">
    <link rel="apple-touch-icon-precomposed" href="image/touch/apple-touch-icon-57x57-precomposed.png">
    <link rel="shortcut icon" href="image/touch/apple-touch-icon.png">
    <link rel="stylesheet" href="{{ asset('backend/css/bootstrap.min.css') }}">
    <link rel="stylesheet" href="{{ asset('backend/css/c3.css') }}">
    <link rel="stylesheet" href="{{ asset('backend/css/switchery.min.css') }}">
    <link rel="stylesheet" href="{{ asset('backend/css/weather-icons.min.css') }}">
    <link rel="stylesheet" href="{{ asset('backend/css/calendar.css') }}">
    <link rel="stylesheet" href="{{ asset('backend/css/offline-theme-dark.css') }}">
    <link rel="stylesheet" href="{{ asset('backend/css/bootstrap-override.css') }}">
    <link rel="stylesheet" type="text/css" href="{{asset('backend/assets/Popup-jQuery/toast.style.min.css')}}"/>
    <link rel="stylesheet" href="{{ asset('backend/css/font-awesome.min.css') }}">
    <link rel="stylesheet" href="{{ asset('backend/css/layout.css') }}">
    {{--<link rel="stylesheet" href="{{ asset('backend/css/template.css') }}">--}}
    <link rel="stylesheet" href="{{ asset('backend/css/library.css') }}">
    <link rel="stylesheet" href="{{ asset('backend/css/style.css?v=1.0.3') }}">
    <link rel="stylesheet" href="{{ asset('backend/css/custom.css') }}">
    <link rel="stylesheet" href="{{ asset('backend/assets/progress/css/progress.css') }}">
    <link rel="stylesheet" href="{{ asset('backend/assets/rateStar/voteStar.css') }}">
    <link rel="shortcut icon" type="image/x-icon" href="{{asset('frontend/images/logo.png')}}" />

    @yield('style')

    <style>
        .BtnRegAll {
            transition: 0.2s;
        }
        .BtnRegAll:hover {
            border-color: #3ba0ff;
            box-shadow: 0 0 7px 0px #3ba0ffb5;
            transition: 0.2s;
        }
        .fa, .far, .fas {
            font-family: FontAwesome !important;
        }
        .sidetabs img {
            width: 30px;
            height: 30px;
            border-radius: 50%;
            display: inline;
        }
        table {
            font-size: 13px;
        }
        table tr td {
            cursor: unset!important;
        }
        
        body {
            overflow-x: hidden;
        }
        .logo-site {
            width: 100px;
            padding-top: 10px;
            padding-right: 15px;
        }
        input.box-search {
            margin-top: 10px;
        }
        img.box-avatar {
            width: 50px;
            height: 50px;
            border-radius: 50%;
        }
        li.dropdown {
            list-style-type: none;
        }
        header.navbar.main-header {
            background: #67a4da !important;
        }
        #main-wrapper {padding: 20px 170px !important;}
        
        @media (max-width:1024px){
            section#main-wrapper {padding: 20px 50px !important;}
        }
        @media (max-width:768px){
        }
        @media (max-width: 500px){
            section#main-wrapper {padding: 20px 6px !important;}
        }
    </style>
    <script type="text/javascript" src="{{ asset('backend/js/jquery-1.11.0.min.js') }}"></script>
    <script type="text/javascript" src="{{ asset('backend/js/jquery-ui-1.10.4.custom.min.js') }}"></script>
    {{--<script type="text/javascript" src="{{ asset('backend/js/vue.js') }}"></script>--}}
</head>
<body id="body">
<!-- Header -->
<header class="navbar main-header">
    <div class="row">
        <ul class="col-md-1 text-right">
            <a href="{{route('HomePage')}}"><img class="logo-site" src="{{asset('frontend/images/LOGO0.png')}}" alt="avatar" /></a>
        </ul>
        <ul class="col-md-8">
            <input type="text" placeholder="جستجو ..." class="form-control box-search" />
        </ul>
        <ul class="col-md-2 text-center">
        </ul>
        <ul class="col-md-1 text-left">
            <li class="dropdown">
                <a href="#" class="dropdown-toggle" data-toggle="dropdown">{{ auth()->user()->name }} <img class="box-avatar" src="@if(!file_exists(asset('Uploaded/User/Profile').'/'. auth()->user()->avatar)) {{ asset('Uploaded/User/Profile').'/'. auth()->user()->avatar }} @else {{ asset('backend/img/avatar.png') }} @endif" alt="avatar" /> <b class="caret"></b></a>
                <ul class="dropdown-menu">
                    {{--<li><a href="#"><i class="fa fa-globe"></i> اعلان ها <span class="label label-danger"> 5</span></a></li>--}}
                    <li><a href="{{ route('EditUser') }}"><i class="fa fa-user"></i> پروفایل</a></li>
                    {{--<li><a href="#"><i class="fa fa-gear"></i> تنظیمات</a></li>--}}
                    <li><a href="{{ route('Logout') }}"><i class="fa fa-share"></i> خروج</a></li>
                </ul>
            </li>
        </ul>
    </div>
</header>

<!-- Header -->
<section id="main-wrapper">

    <h4>@yield('headerSection')</h4>
    @yield('content')

</section>

<script src="{{asset('backend/assets/Popup-jQuery/toast.script.js')}}"></script>
<script type="text/javascript" src="{{ asset('backend/js/bootstrap.min.js') }}"></script>
<script type="text/javascript" src="{{ asset('backend/js/jquery.easypiechart.min.js') }}"></script>
<script type="text/javascript" src="{{ asset('backend/js/d3.min.js') }}" charset="utf-8"></script>
<script type="text/javascript" src="{{ asset('backend/js/c3.min.js') }}"></script>
<script type="text/javascript" src="{{ asset('backend/js/switchery.min.js') }}"></script>
<script type="text/javascript" src="{{ asset('backend/js/jquery.mCustomScrollbar.concat.min.js') }}"></script>
<script type="text/javascript" src="{{ asset('backend/js/jquery.easing.1.3.js') }}"></script>
<script type="text/javascript" src="{{ asset('backend/js/jquery.calendario.js') }}"></script>
<script type="text/javascript" src="{{ asset('backend/js/offline.min.js') }}"></script>
<script type="text/javascript" src="{{ asset('backend/js/script.js') }}"></script>
<script type="text/javascript" src="{{ asset('backend/js/dashboard.js') }}"></script>
<script type="text/javascript" src="{{ asset('backend/assets/rateStar/jquery.voteStar.js') }}"></script>
@yield('script')
<script>
    function AlertToast(title, message, status = 'success') {
        $.Toast("<p>"+ title +"</p>", "<p>" + message + " .</p>", status, {
            has_icon: true,
            has_close_btn: true,
            stack: true,
            fullscreen: false,
            timeout: 4000,
            sticky: false,
            has_progress: true,
            rtl: true,
        });
    }
</script>
</body>
</html>