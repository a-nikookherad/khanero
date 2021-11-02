
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
    <link href="{{asset('frontend/css/custom.css?v=03')}}" rel="stylesheet">
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
        @media (max-width: 600px){
            section#main-wrapper {padding: 20px 6px !important;}
        }
        .host-row {
            display: flex;
             align-items: center;
              height: 100%;
        }
        .mb-2 {
            margin-bottom: 1.5rem;
        }
        .d-flex {
            display: flex
        }
    </style>
    <script type="text/javascript" src="{{ asset('backend/js/jquery-1.11.0.min.js') }}"></script>
    <script type="text/javascript" src="{{ asset('backend/js/jquery-ui-1.10.4.custom.min.js') }}"></script>
    {{--<script type="text/javascript" src="{{ asset('backend/js/vue.js') }}"></script>--}}
</head>
<body id="body">
<!-- Header -->
<header class="">
<div class="top mb-2">
    <div class="top1">
        <div class="container">
            <div class="row fix-w">
                <div class="col-xs-4 col-sm-4 p-0 pr-x-0">
                    <div id="logo"><img src="{{public_path('frontend/images/LOGO0.png')}}" alt="logo"></div>
                </div>
                <div class="col-sm-8 col-xs-8 p-0 px-0">
            <div class="d-flex">
                <div class="search-wrapper">
                    <input class="form-control search-input" type="text" placeholder="جستجو">
                </div>
                <div style="margin-right: auto">
                    <div class="btn-menu"></div>
                    <ul class="link-top">
                        <li class="box-login">
                        @if(!auth()->check())
                                <!-- Modal -->
                                <div id="myModal" class="modal fade" role="dialog">
                                    <div class="modal-dialog modal-sm">
                                        <!-- Modal content-->
                                        <div class="modal-content">
                                            <div class="modal-header">
                                                <img src="{{public_path('frontend/images/LOGO0.png')}}" alt="logo">
                                                <button type="button" class="close" data-dismiss="modal">&times;</button>
                                                <h4 class="modal-title">ورود / ثبت نام</h4>
                                            </div>
                                            <input type="hidden" id="MobileUser">
                                            <div class="modal-body box-login-register">
                                                <div>
                                                    <div>
                                                        <div class="form-group mb-3">
                                                            <p class="text-right font_14">جهت ورود / ثبت نام شماره همراه خود را وارد کنید</p>
                                                        </div>
                                                    </div>
                                                    <div>
                                                        <div class="form-group mb-0 text-right">
                                                            <input type="text" autocomplete="off" maxlength="11" class="form-control" id="InputMobile" placeholder="شماره همراه">
                                                            <span class="message text-danger float-right"></span>
                                                        </div>
                                                    </div>
                                                    <div>
                                                        <div class="form-group">
                                                            <button type="button" id="BtnCheckUser" class="btn btn-block btn_bgCustom">ادامه</button>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <script>
                                    $('#InputMobile').click(function () {
                                        $('span.message').text('');
                                    });
                                    $('#BtnCheckUser').click(function () {
                                        var loading = '<img class="load-register" src="{{asset('backend/img/img_loading/loading-register.gif')}}" />'
                                        $(this).html(loading);
                                        var mobile = $('#InputMobile').val();
                                        if (mobile.length != 11 || Number.isInteger(parseInt(mobile)) != true) {
                                            $('span.message').text('فرمت تلفن همراه صحیح نیست.');
                                            return false;
                                        }
                                        $.ajaxSetup({
                                            headers: {
                                                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                                            }
                                        });
                                        $.ajax({
                                            url: "{{route('CheckUserAjax')}}",
                                            method: "post",
                                            data: {
                                                mobile: mobile,
                                            },
                                        }).done(function (returnData) {
                                            if(returnData.Message == 'found') {
                                                $('#MobileUser').val(mobile);
                                                $('.box-login-register').html(returnData.Content);
                                            } else if(returnData.Message == 'sms') {
                                                $('#MobileUser').val(mobile);
                                                $('.box-login-register').html(returnData.Content);
                                            } else {
                                                alert('error');
                                            }
                                        });
                                    });
                                </script>
                            @else
                            @if(auth()->user()->role_id == 1)
                                <span class="can-click-on">
                                    <a class="menu-user">
                                            پنل مدیریتی
                                    </a>
                                </span>
                            @else
                                <span class="can-click-on">
                                    <a class="menu-user user-style">
                                        {{auth()->user()->first_name . ' ' . auth()->user()->last_name}}
                                    </a>
                                </span>
                            @endif
                            @endif
                            <div class="list-login">
                                <ul>
                                    <li class="user-info d-flex align-items-center">
                                        <img class="pc-user mw-100" src="{{auth()->user()->avatar?auth()->user()->avatar:''}}"/>
                                        <h5 class="name-user">{{auth()->user()->first_name . ' ' . auth()->user()->last_name}}</h5>
                                    </li>
                                    <li><a class="item-login" href="{{route('EditUser')}}"><i class="far fa-user"></i>حساب کاربری</a></li>
                                    <li><a class="item-login" href="{{route('IndexReserve')}}"><i class="fas fa-suitcase-rolling"></i>لیست رزرو ها</a></li>
                                    <li><a class="item-login" href="{{route('IndexMessage')}}"><i class="far fa-envelope"></i>پیام ها</a></li>
                                    <li><a class="item-login" href="{{route('IndexFavorite')}}"><i class="far fa-heart"></i>علاقه مندی ها</a></li>
                                    <li><a class="item-login" href="#"><i class="fas fa-lightbulb"></i>نظر ها</a></li>
                                    <li><a class="item-login" href="{{route('IndexHost', ['type' => 'all'])}}"><i class="fas fa-home"></i>اقامتگاه های من</a></li>
                                    <li><a class="item-login" href="{{route('CreateHost')}}"><i class="fas fa-folder-plus"></i>ثبت اقامتگاه</a></li>
                                    <li><a class="item-login" href="#"><i class="fas fa-share-alt"></i>دعوت از دوستان</a></li>
                                    <li><a class="item-login" href="#"><i class="fas fa-money-check"></i>امور مالی</a></li>
                                    <li><a class="item-login" href="{{route('Logout')}}"><i class="fas fa-sign-out-alt"></i>خروج</a></li>
                                </ul>
                            </div>
                        </li>
                    </ul>
                </div>
            </div>
            </div>
        </div>
    </div>
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
<script>
//============ search-->
$(document).ready(function(){
	$('.menu-user').click(function () {
		$(this).parent().parent().toggleClass('open-1');
		$('.over-page').toggleClass('active');
	});
	$('.btn-menu').click(function () {
		$(this).parent().toggleClass('open-mob');
		$('.over-page').toggleClass('active');
	});
	$('.over-page').click(function () {
		$('.over-page').removeClass('active');
		$('.menu-user').parent().parent().removeClass('open-1');
		$('.btn-menu').parent().removeClass('open-mob');
	});
});

</script>
</body>
</html>