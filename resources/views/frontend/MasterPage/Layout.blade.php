<!DOCTYPE html>
<html lang="fa">
@php $actual_link = "http://$_SERVER[HTTP_HOST]$_SERVER[REQUEST_URI]"; @endphp
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0, maximum-scale=1.0, user-scalable=no">
    <meta name="theme-color" content="#007dec">
    <title>@yield('title')</title>
    <meta property="og:url" content="{{$actual_link}}">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    @yield('meta')
    <link href="{{asset('frontend/css/bootstrap.css')}}" rel="stylesheet">
    <link href="{{asset('frontend/css/bootstrap-theme.css')}}" rel="stylesheet">
    <link rel="stylesheet" href="{{asset('frontend/css/owl.carousel.min.css')}}">
    <link rel="stylesheet" href="{{asset('frontend/css/owl.theme.default.css')}}">
<!-- <link rel="stylesheet" href="{{asset('frontend/css/persian-datepicker.css')}}"> -->
    <link href="{{asset('frontend/css/fontawesome-all.min.css')}}" rel="stylesheet">
    <link rel="stylesheet" type="text/css" href="{{asset('backend/assets/Popup-jQuery/toast.style.min.css')}}"/>
    <link href="{{asset('frontend/css/custom.css')}}" rel="stylesheet">
    <link href="{{asset('frontend/css/persian-datepicker.min.css')}}" rel="stylesheet">
    <link rel="stylesheet" href="{{asset('backend/css/datepicker.css')}}">
    <link rel="stylesheet" href="{{asset('backend/css/bootstrap-datepicker.min.css')}}"/>
    <script src="{{asset('frontend/js/jquery.min.js')}}"></script>
    @yield('style')
</head>
<body>
<div class="over-page"></div>
<div class="top">
    <div class="top1 border-bottom">
        <div class="container">
            <div class="row fix-w">
                <div class="col-xs-4 col-sm-4 p-0 pr-x-0">
                    <a href="#" id="logo"><img src="{{asset('frontend/images/LOGO.png')}}" alt="logo"></a>
                </div>
                <div class="col-sm-8 col-xs-8 p-0 px-0">
                    <div class="d-flex">
                        <div class="search-wrapper public-search">
                            <input class="form-control search-input" type="text" placeholder="جستجو">
                        </div>
                        <div style="margin-right: auto">
                            <div class="btn-menu"></div>

                            <ul class="link-top">
                                <li class="hidden-xs phone">
                                    <img src="{{asset('frontend/images/icon-t1.png')}}" alt="logo"> <a href=""> 0910 698
                                        66 86 </a>
                                </li>
                                <li class="sabt hidden-xs visible-md">
                                    <a href="{{route('CreateHost')}}">
                                        <span> <img src="{{asset('frontend/images/icon-t2.png')}}" alt="logo"></span>
                                        <span>ثبت اقامتگاه </span>
                                    </a>
                                </li>
                                <li class="box-login">
                                    @if(!auth()->check())
                                        <div class="mobileInter">
                                            <a data-toggle="modal" data-target="#myModal">
                                       
                                             ورود 
                                            </a>
                                            <span class="line-login"> </span>
                                            <a data-toggle="modal" data-target="#myModal">
                                                ثبت نام
                                            </a>
                                        </div>

                                        <!-- Modal -->
                                        {{--                                    <div id="myModal" class="modal fade" role="dialog">--}}
                                        {{--                                        <div class="modal-dialog modal-sm">--}}

                                        {{--                                            <!-- Modal content-->--}}
                                        {{--                                            <div class="modal-content">--}}
                                        {{--                                                <div class="modal-header">--}}
                                        {{--                                                    <button type="button" class="close" data-dismiss="modal">&times;</button>--}}
                                        {{--                                                    <h4 class="modal-title">ورود یا ثبت نام</h4>--}}
                                        {{--                                                </div>--}}
                                        {{--                                                <input type="hidden" id="MobileUser">--}}
                                        {{--                                                <div class="modal-body box-login-register">--}}
                                        {{--                                                    <div >--}}
                                        {{--                                                        <div >--}}
                                        {{--                                                            <div class="form-group">--}}
                                        {{--                                                                <p class="text-right">جهت ورود یا ثبت نام شماره همراه خود را وارد کنید</p>--}}
                                        {{--                                                            </div>--}}
                                        {{--                                                        </div>--}}
                                        {{--                                                        <div>--}}
                                        {{--                                                            <div class="form-group text-right">--}}
                                        {{--                                                                <input type="text" autocomplete="off" maxlength="11" class="form-control" id="InputMobile" placeholder="شماره همراه">--}}
                                        {{--                                                                <span class="message text-danger"></span>--}}
                                        {{--                                                            </div>--}}
                                        {{--                                                        </div>--}}
                                        {{--                                                        <div >--}}
                                        {{--                                                            <div class="form-group">--}}
                                        {{--                                                                <button type="button" id="BtnCheckUser" class="btn btn-block">ادامه</button>--}}
                                        {{--                                                            </div>--}}
                                        {{--                                                        </div>--}}
                                        {{--                                                    </div>--}}
                                        {{--                                                </div>--}}
                                        {{--                                            </div>--}}
                                        {{--                                        </div>--}}
                                        {{--                                    </div>--}}
                                        {{--                                    <script>--}}
                                        {{--                                        $('#InputMobile').click(function () {--}}
                                        {{--                                            $('span.message').text('');--}}
                                        {{--                                        });--}}
                                        {{--                                        $('#BtnCheckUser').click(function () {--}}
                                        {{--                                            var loading = '<img class="load-register" src="{{asset('backend/img/img_loading/loading-register.gif')}}" />'--}}
                                        {{--                                            $(this).html(loading);--}}
                                        {{--                                            var mobile = $('#InputMobile').val();--}}
                                        {{--                                            if (mobile.length != 11 || Number.isInteger(parseInt(mobile)) != true) {--}}
                                        {{--                                                $('span.message').text('فرمت تلفن همراه صحیح نیست.');--}}
                                        {{--                                                return false;--}}
                                        {{--                                            }--}}
                                        {{--                                            $.ajaxSetup({--}}
                                        {{--                                                headers: {--}}
                                        {{--                                                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')--}}
                                        {{--                                                }--}}
                                        {{--                                            });--}}
                                        {{--                                            $.ajax({--}}
                                        {{--                                                url: "{{route('CheckUserAjax')}}",--}}
                                        {{--                                                method: "post",--}}
                                        {{--                                                data: {--}}
                                        {{--                                                    mobile: mobile,--}}
                                        {{--                                                },--}}
                                        {{--                                            }).done(function (returnData) {--}}
                                        {{--                                                if(returnData.Message == 'found') {--}}
                                        {{--                                                    $('#MobileUser').val(mobile);--}}
                                        {{--                                                    $('.box-login-register').html(returnData.Content);--}}
                                        {{--                                                } else if(returnData.Message == 'sms') {--}}
                                        {{--                                                    $('#MobileUser').val(mobile);--}}
                                        {{--                                                    $('.box-login-register').html(returnData.Content);--}}
                                        {{--                                                } else {--}}
                                        {{--                                                    alert('error');--}}
                                        {{--                                                }--}}
                                        {{--                                            });--}}
                                        {{--                                        });--}}
                                        {{--                                    </script>--}}
                                    @else
                                        @if(auth()->user()->role_id == 1)
                                            <span class="can-click-on">
                                            <!--<a href="{{route('AdminDashboard')}}">-->
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
                                    @if (auth()->check())
                                        <div class="list-login">
                                            <ul>
                                                <li class="user-info d-flex align-items-center">
                                                    <img class="pc-user mw-100" src="{{auth()->user()->avatar?asset(auth()->user()->avatar):''}}"/>
                                                    <h5 class="name-user">{{auth()->user()->first_name . ' ' . auth()->user()->last_name}}</h5>
                                                </li>

                                                <li><a class="item-login" href="{{route('EditUser')}}"><i
                                                                class="far fa-user"></i>حساب کاربری</a></li>
                                                <li><a class="item-login" href="{{route('IndexReserve')}}"><i
                                                                class="fas fa-suitcase-rolling"></i>لیست رزرو ها</a>
                                                </li>
                                                <li><a class="item-login" href="{{route('IndexMessage')}}"><i
                                                                class="far fa-envelope"></i>پیام ها</a></li>
                                                <li><a class="item-login" href="{{route('IndexFavorite')}}"><i
                                                                class="far fa-heart"></i>علاقه مندی ها</a></li>
                                                <li><a class="item-login" href="#"><i class="fas fa-lightbulb"></i>نظر
                                                        ها</a></li>
                                                <li><a class="item-login"
                                                       href="{{route('IndexHost', ['type' => 'all'])}}"><i
                                                                class="fas fa-home"></i>اقامتگاه های من</a></li>
                                                <li><a class="item-login" href="{{route('CreateHost')}}"><i
                                                                class="fas fa-folder-plus"></i>ثبت اقامتگاه</a></li>
                                                <li><a class="item-login" href="#"><i class="fas fa-share-alt"></i>دعوت
                                                        از دوستان</a></li>
                                                <li><a class="item-login" href="#"><i class="fas fa-money-check"></i>امور
                                                        مالی</a></li>
                                                <li><a class="item-login" href="{{route('Logout')}}"><i
                                                                class="fas fa-sign-out-alt"></i>خروج</a></li>
                                            </ul>
                                        </div>
                                    @elseif(!auth()->check())
                                        <div class="list-login">
                                            <ul>
                                                <li data-toggle="modal" data-target="#myModal"><a class="item-login"
                                                                                                  href=""><i
                                                                class="far fa-user"></i>ورود</a></li>
                                                <li data-toggle="modal" data-target="#myModal"><a class="item-login"
                                                                                                  href=""><i
                                                                class="far fa-user"></i>ثبت نام</a></li>
                                                <li><a class="item-login" href="{{route('CreateHost')}}"><i
                                                                class="fas fa-folder-plus"></i>ثبت اقامتگاه</a></li>
                                            </ul>
                                        </div>



                                @endif






                                {{--                                <a>--}}
                                {{--                                        <span data-toggle="modal" data-target="#myModal">--}}
                                {{--                                            <span>--}}
                                {{--                                                <img src="{{asset('frontend/images/user.png')}}">--}}
                                {{--                                            </span>--}}
                                {{--                                            <span> ورود </span>--}}
                                {{--                                        </span>--}}
                                {{--                                </a>--}}
                                {{--                                <span class="line-login"> </span>--}}
                                {{--                                <a data-toggle="modal" data-target="#myModal">--}}
                                {{--                                    ثبت نام--}}
                                {{--                                </a>--}}
                                <!-- Modal -->
                                    <div id="myModal" class="modal fade" role="dialog">
                                        <div class="modal-dialog modal-sm">

                                            <!-- Modal content-->
                                            <div class="modal-content">
                                                <div class="modal-header">
                                                    <button type="button" class="close" data-dismiss="modal">&times; </button>
                                                    <img src="{{asset('frontend/images/logo-f.png')}}" alt="logo" class="img-footer mx-auto">
                                                     <!-- <h4 class="modal-title mt_10 text-center">ورود / ثبت نام</h4> -->
                                                </div>
                                                <input type="hidden" id="MobileUser">
                                                <div class="modal-body box-login-register">
                                                    <div >
                                                        <div >
                                                            <div class="form-group mb-5">
                                                                <p class="text-right font_14">جهت ورود / ثبت نام شماره همراه
                                                                    خود را وارد کنید</p>
                                                            </div>
                                                        </div>
                                                        <div >
                                                            <div class="form-group mb-0">
                                                                <input type="text" autocomplete="off" maxlength="11"
                                                                       class="form-control" id="InputMobile"
                                                                       placeholder="شماره همراه">
                                                                <span class="message text-danger mb-3 float-right"></span>
                                                            </div>
                                                        </div>
                                                        <div >
                                                            <div class="form-group">
                                                                <button type="button" id="BtnCheckUser"
                                                                        class="btn btn-block btn_bgCustom">ادامه
                                                                </button>
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
                                                if (returnData.Message == 'found') {
                                                    $('#MobileUser').val(mobile);
                                                    $('.box-login-register').html(returnData.Content);
                                                } else if (returnData.Message == 'sms') {
                                                    $('#MobileUser').val(mobile);
                                                    $('.box-login-register').html(returnData.Content);
                                                } else {
                                                    alert('error');
                                                }
                                            });
                                        });
                                    </script>


                                </li>
                            </ul>
                        </div>
                    </div>
                </div>
                <script>
                    //============ search-->
                    $(document).ready(function () {
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

            </div>

        </div>
    </div>

</div>
<!--top -->


@yield('content')


<div class="container-fluid footer-bottom">
    <div class="container">
        <div class="row social-footer hidden-lg hidden-md ">
            <div class="col-12 text-center">
                <ul>
                    <li>
                        <a href="">
                            <span class="flip"><img src="{{asset('frontend/images/telegaram.png')}}" data-loaded="true"></span>
                            <span class="flop"><img src="{{asset('frontend/images/telegaram.png')}}" data-loaded="true"></span>
                        </a>

                    </li>
                    <li>
                        <a href="">
                            <span class="flip"><img src="{{asset('frontend/images/instagram.png')}}" data-loaded="true"></span>
                            <span class="flop"><img src="{{asset('frontend/images/instagram.png')}}" data-loaded="true"></span>
                        </a>
                    </li>
                    <li>
                        <a href="">
                            <span class="flip"><img src="{{asset('frontend/images/aparat.png')}}"
                                                    data-loaded="true"></span>
                            <span class="flop"><img src="{{asset('frontend/images/aparat.png')}}"
                                                    data-loaded="true"></span>
                        </a>
                    </li>
                    <li>
                        <a href="">
                            <span class="flip"><img src="{{asset('frontend/images/whatasapp.png')}}" data-loaded="true"></span>
                            <span class="flop"><img src="{{asset('frontend/images/whatasapp.png')}}" data-loaded="true"></span>
                        </a>
                    </li>
                </ul>
            </div>
        </div>
        <div class="row row-align-items-center">
            <div class="col-lg-4 col-md-4 col-xs-12 pr-xl-0 info-col">
                <p class="title-support">
                    تماس با پشتیبانی
                    <span class="color-text">پاسخ گویی 9 صبح الی 11 شب</span>
                </p>
                <div class="d-block info-cal">
					<span class="phone-number">
						<a href="tel:09106986686">0910 698 66 86<span class="icon-phone"></span></a>
					</span>
                </div>

            </div>
            <div class="col-lg-4 col-md-4 col-xs-12 px-0 news-letter-col hidden-xs">
                <div class="row social-footer">
                    <div class="col-12 text-center">
                        @include('ContactUs::Link.Social')
                    </div>
                </div>
            </div>
            <div class="col-lg-4 col-md-4 col-xs-12 pl-xl-0 px-0">
                <ul class="namad">
                    <li>
                        <img src="{{asset('frontend/images/namad1.png')}}" class="img-responsive">
                    </li>
                    <li>
                        <img src="{{asset('frontend/images/namad2.png')}}" class="img-responsive">
                    </li>
                    <li>
                        <img src="{{asset('frontend/images/logo2.png')}}" class="img-responsive">
                    </li>
                </ul>
            </div>
        </div>
    </div>
</div>
<div class="footer">
    <div class="container ">
        @include('ContactUs::Link.Footer')
    </div>
</div>
<div class="container-fluid copy-right">
    <div class="container">
        <div class="row row-copy">
            <div class="col-md-6 col-xs-12 right-copy pr-md-0">
                © 2018 DESIGNED BY <span class="color">NO NEGARE</span> . ALL RIGHTS RESERVED
            </div>
            <div class="col-md-6 col-xs-12 left-copy pl-md-0">
                Copyright ALLORO MILANO . All rights reserved.
            </div>
        </div>
    </div>
</div>

<div class="modal fade modal-service" id="service-modal1" tabindex="-1" role="dialog" aria-labelledby="modalLabel"
     aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close btn-close" data-dismiss="modal"><span
                            aria-hidden="true">×</span><span
                            class="sr-only">Close</span></button>
                <h4 class="modal-title"> اطلاعات اقامتی</h4>
            </div>
            <div class="modal-body">
                <div class="row">
                    <div class="col-xs-12 text-center">
                        <img src="{{asset('frontend/images/img1.png')}}" class="img-responsive">

                    </div>
                    <div class="col-xs-12 service-desc">
                        لورم ایپسوم متن ساختگی با تولید سادگی نامفهوم از صنعت چاپ، و با استفاده از طراحان گرافیک است،
                        چاپگرها و متون بلکه روزنامه و مجله در ستون و سطرآنچنان که لازم است، و برای شرایط فعلی تکنولوژی
                        مورد نیاز، و کاربردهای متنوع با هدف بهبود ابزارهای کاربردی می باشد، کتابهای زیادی در شصت و سه
                        درصد گذشته حال و آینده، شناخت فراوان جامعه و متخصصان را می طلبد، تا با نرم افزارها شناخت بیشتری
                        را برای طراحان رایانه ای علی الخصوص طراحان خلاقی، و فرهنگ پیشرو در زبان فارسی ایجاد کرد، در این
                        صورت می توان امید داشت که تمام و دشواری موجود در ارائه راهکارها، و شرایط سخت تایپ به پایان رسد و
                        زمان مورد نیاز شامل حروفچینی دستاوردهای اصلی، و جوابگوی سوالات پیوسته اهل دنیای موجود طراحی
                        اساسا مورد استفاده قرار گیرد.
                    </div>
                </div>

            </div>
        </div>
    </div>
</div>
<div class="modal fade modal-service" id="service-modal2" tabindex="-1" role="dialog" aria-labelledby="modalLabel"
     aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal"><span aria-hidden="true">×</span><span
                            class="sr-only">Close</span></button>
                <h4 class="modal-title"> ضمانت بازگشت وجه</h4>
            </div>
            <div class="modal-body">
                <div class="row">
                    <div class="col-xs-12 text-center">
                        <img src="{{asset('frontend/images/img2.png')}}" class="img-responsive">

                    </div>
                    <div class="col-xs-12 service-desc">
                        لورم ایپسوم متن ساختگی با تولید سادگی نامفهوم از صنعت چاپ، و با استفاده از طراحان گرافیک است،
                        چاپگرها و متون بلکه روزنامه و مجله در ستون و سطرآنچنان که لازم است، و برای شرایط فعلی تکنولوژی
                        مورد نیاز، و کاربردهای متنوع با هدف بهبود ابزارهای کاربردی می باشد، کتابهای زیادی در شصت و سه
                        درصد گذشته حال و آینده، شناخت فراوان جامعه و متخصصان را می طلبد، تا با نرم افزارها شناخت بیشتری
                        را برای طراحان رایانه ای علی الخصوص طراحان خلاقی، و فرهنگ پیشرو در زبان فارسی ایجاد کرد، در این
                        صورت می توان امید داشت که تمام و دشواری موجود در ارائه راهکارها، و شرایط سخت تایپ به پایان رسد و
                        زمان مورد نیاز شامل حروفچینی دستاوردهای اصلی، و جوابگوی سوالات پیوسته اهل دنیای موجود طراحی
                        اساسا مورد استفاده قرار گیرد.
                    </div>
                </div>

            </div>
        </div>
    </div>
</div>
<div class="modal fade modal-service" id="service-modal3" tabindex="-1" role="dialog" aria-labelledby="modalLabel"
     aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal"><span aria-hidden="true">×</span><span
                            class="sr-only">Close</span></button>
                <h4 class="modal-title"> پشتیبانی در طول اقامت </h4>
            </div>
            <div class="modal-body">
                <div class="row">
                    <div class="col-xs-12 text-center">
                        <img src="{{asset('frontend/images/img3.png')}}" class="img-responsive">

                    </div>
                    <div class="col-xs-12 service-desc">
                        لورم ایپسوم متن ساختگی با تولید سادگی نامفهوم از صنعت چاپ، و با استفاده از طراحان گرافیک است،
                        چاپگرها و متون بلکه روزنامه و مجله در ستون و سطرآنچنان که لازم است، و برای شرایط فعلی تکنولوژی
                        مورد نیاز، و کاربردهای متنوع با هدف بهبود ابزارهای کاربردی می باشد، کتابهای زیادی در شصت و سه
                        درصد گذشته حال و آینده، شناخت فراوان جامعه و متخصصان را می طلبد، تا با نرم افزارها شناخت بیشتری
                        را برای طراحان رایانه ای علی الخصوص طراحان خلاقی، و فرهنگ پیشرو در زبان فارسی ایجاد کرد، در این
                        صورت می توان امید داشت که تمام و دشواری موجود در ارائه راهکارها، و شرایط سخت تایپ به پایان رسد و
                        زمان مورد نیاز شامل حروفچینی دستاوردهای اصلی، و جوابگوی سوالات پیوسته اهل دنیای موجود طراحی
                        اساسا مورد استفاده قرار گیرد.
                    </div>
                </div>

            </div>
        </div>
    </div>
</div>
<div class="modal fade modal-service" id="service-modal4" tabindex="-1" role="dialog" aria-labelledby="modalLabel"
     aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal"><span aria-hidden="true">×</span><span
                            class="sr-only">Close</span></button>
                <h4 class="modal-title"> پوشش تمامی شهر ها </h4>
            </div>
            <div class="modal-body">
                <div class="row">
                    <div class="col-xs-12 text-center">
                        <img src="{{asset('frontend/images/img21.png')}}" class="img-responsive">

                    </div>
                    <div class="col-xs-12 service-desc">
                        لورم ایپسوم متن ساختگی با تولید سادگی نامفهوم از صنعت چاپ، و با استفاده از طراحان گرافیک است،
                        چاپگرها و متون بلکه روزنامه و مجله در ستون و سطرآنچنان که لازم است، و برای شرایط فعلی تکنولوژی
                        مورد نیاز، و کاربردهای متنوع با هدف بهبود ابزارهای کاربردی می باشد، کتابهای زیادی در شصت و سه
                        درصد گذشته حال و آینده، شناخت فراوان جامعه و متخصصان را می طلبد، تا با نرم افزارها شناخت بیشتری
                        را برای طراحان رایانه ای علی الخصوص طراحان خلاقی، و فرهنگ پیشرو در زبان فارسی ایجاد کرد، در این
                        صورت می توان امید داشت که تمام و دشواری موجود در ارائه راهکارها، و شرایط سخت تایپ به پایان رسد و
                        زمان مورد نیاز شامل حروفچینی دستاوردهای اصلی، و جوابگوی سوالات پیوسته اهل دنیای موجود طراحی
                        اساسا مورد استفاده قرار گیرد.
                    </div>
                </div>

            </div>
        </div>
    </div>
</div>
<!--<a href="#" class="back-to-top" style=""><i class="fas fa-chevron-up"></i></a>-->
<script src="{{asset('frontend/js/owl.carousel.js')}}"></script>
<script src="{{asset('frontend/js/bootstrap.min.js')}}"></script>
<!-- <script src="{{asset('backend/js/bootstrap-datepicker.min.js')}}"></script> -->
<!-- <script src="{{asset('backend/js/bootstrap-datepicker.fa.min.js')}}"></script> -->
<script src="{{asset('frontend/js/persian-date.min.js')}}"></script>
<script src="{{asset('frontend/js/persian-datepicker.min.js')}}"></script>
<script language="javascript" src="{{asset('frontend/js/script.js')}}"></script>
<script src="{{asset('backend/assets/Popup-jQuery/toast.script.js')}}"></script>


<script>

    var to, from;
    to = $(".range-to").persianDatepicker({
        inline: false,
        altField: '.range-to-alt',
        format: 'YYYY/MM/DD',
        initialValue: false,
        autoClose: true,
        minDate: new persianDate().unix(),
        onSelect: function (unix) {
            to.touched = true;
            if (from && from.options && from.options.maxDate != unix) {
                var cachedValue = from.getState().selected.unixDate;
                from.options = {maxDate: unix};
                if (from.touched) {
                    from.setDate(cachedValue);
                }
            }
        }
    });
    // $(".range-to").persianDatepicker({
    //     minDate: new persianDate().unix()
    // });
    from = $(".range-from").persianDatepicker({
        inline: false,
        altField: '.range-from-alt',
        format: 'YYYY/MM/DD',
        initialValue: false,
        autoClose: true,
        minDate: new persianDate().unix(),
        onSelect: function (unix) {
            from.touched = true;
            if (to && to.options && to.options.minDate != unix) {
                var cachedValue = to.getState().selected.unixDate;
                to.options = {minDate: unix};
                if (to.touched) {
                    to.setDate(cachedValue);
                }
            }
        }
    });

    // $("#InputFromDate").datepicker({
    //     minDate: 0,
    //     changeMonth: true,
    //     changeYear: true,
    //     isRTL: true,
    //     dateFormat: "yy/mm/dd",
    //     EnableTimePicker: true,
    // });
    // $("#InputToDate").datepicker({
    //     minDate: 0,
    //     changeMonth: true,
    //     changeYear: true,
    //     isRTL: true,
    //     dateFormat: "yy/mm/dd",
    //     EnableTimePicker: true,
    // });

    function SetFavorite(content, id) {
        $.ajaxSetup({
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            }
        });
        $.ajax({
            url: "{{route('SetFavorite')}}",
            method: "post",
            data: {
                id: id,
            }
        }).done(function (returnData) {
            if (returnData.Success == 1) {
                $(content).find('i').removeClass('far');
                $(content).find('i').addClass('fas');
                AlertToast('علاقه مندی', returnData.Message, 'success');
            } else if (returnData.Success == -1) {
                $(content).find('i').removeClass('fas');
                $(content).find('i').addClass('far');
                AlertToast('علاقه مندی', returnData.Message, 'warning');
            } else {
                AlertToast('علاقه مندی', returnData.Message, 'info');
            }
        })
    }


    function AlertToast(title, message, status = 'success') {
        $.Toast("<p>" + title + "</p>", "<p>" + message + " .</p>", status, {
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
@yield('script')
</body>
</html>
