@extends('backend.MasterPage.Auth')

@section('title')
    ورود به سیستم
@endsection
@section('style')
    <style>
        .wrap {
            width: 50px;
            height: 50px;
            border-radius: 50%;
            background-color: white;
            display: flex;
            flex-direction: column;
            align-items: center;
            justify-content: center;
            font-size: 2em;
            margin: 10px auto;
        }

        span.timer-loading img {
            position: absolute;
            top: 0px;
            left: 0px;
            width: 62px;
            transform: translate(-50%, -95%);
        }

        span.timer-loading {
            position: relative;
        }

    </style>
@endsection

@section('content')


    <div class="row box-login">
        <div class="col-sm-4 col-sm-offset-4">
            <form action="{{ route('ActivityUser') }}" method="post" role="form" class="login" id="FormLogin">
                {{ csrf_field() }}
                <div class="row text-center">
                    <div class="col-md-12">
                        <img src="{{asset('frontend/images/logo.png')}}" style="width: 30%">
                    </div>
                </div>
                <div class="row">

                    <div class="col-md-12">
                        <div class="input-group">
                            <span class="input-group-addon"><i class="fa fa-key"></i></span>
                            <input type="text" dir="rtl" id="Code" name="code"
                                   placeholder="کد ارسالی به موبایل را وارد کنید" class="form-control primary"
                                   autofocus/>
                        </div>
                    </div>
                </div>
                <div class="form-group">
                    @include('message.Message')
                    @include('message.ErrorReporting')
                </div>
                {{--<div class="text-center">--}}
                {{--<div class="wrap">--}}
                {{--<h3 style="font-family: 'Yekan'; color: #26d026;" class="timer">100</h3>--}}
                {{--<span class="timer-loading"></span>--}}
                {{--</div>--}}
                {{--</div>--}}
                <div class="row">

                    <div class="col-md-6">
                        <div class="form-group">
                            <button type="button" id="BtnSendCode" class="btn btn-login btn-block">ارسال مجدد کد
                            </button>
                        </div>
                    </div>

                    <div class="col-md-6">
                        <div class="form-group">
                            <button type="button" class="btn btn-login btn-send-code btn-block">فعالسازی</button>
                        </div>
                    </div>
                </div>
            </form>
        </div>
    </div>
@endsection


@section('script')
    <script>
        $('.btn-send-code').click(function () {
            var code = $('#Code').val();
            if(code != '') {
                $('#FormLogin').submit();
            } else {
                $.Toast("<p>کد فعالسازی</p>", "<p> کد فعالسازی نمی تواند خالی باشد </p>", "warning", {
                    has_icon: true,
                    has_close_btn: true,
                    stack: true,
                    fullscreen: false,
                    timeout: 5000,
                    sticky: false,
                    has_progress: true,
                    rtl: true,
                });
            }
        });
        $('#BtnSendCode').click(function () {
            $('.timer-loading').html('<img src="{{asset('backend/img/img_loading/orange_circles.gif')}}" />');
            $.ajaxSetup({
                headers: {
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                }
            });
            $.ajax({
                url: '{{route('SendCodeSms')}}',
                type: 'post',
                success: function (data) {
                    if (data == 'confirm') {
                        $.Toast("<p>کد فعالسازی</p>", "<p> ارسال کد فعالسازی با موفقیت انجام شد </p>", "success", {
                            has_icon: true,
                            has_close_btn: true,
                            stack: true,
                            fullscreen: false,
                            timeout: 5000,
                            sticky: false,
                            has_progress: true,
                            rtl: true,
                        });
                        setTimeout(function () {
                            window.location.href = "{{route('Login')}}";
                        }, 5000);
                    }
                }
            });
        });

        // timer();
        // function timer() {
        //     var timer = {
        //         t: '',
        //         counter: 90, // set timer value here; set at 0 to count up
        //         timer_is_on: 0,
        //         timedCount: function() {
        //             var timerElement = document.querySelector('.timer');
        //             timerElement.innerHTML = timer.counter;
        //             timer.counter--; // set count down/up here: -- to count down, ++ to count up
        //             t = setTimeout(function() {
        //                 timer.timedCount();
        //             }, 1000); // set timer speed here 1000ms = 1s
        //             if (timer.counter >= 40) {
        //                 console.log(1);
        //                 $('h3.timer').css('color', '#26d026', 'important');
        //             }
        //             else if (timer.counter >= 30) {
        //                 $('h3.timer').css('color', '#7ec117', 'important');
        //             }
        //             else if (timer.counter >= 20) {
        //                 $('h3.timer').css('color', '#ced21c', 'important');
        //             }
        //             else if (timer.counter >= 10) {
        //                 $('h3.timer').css('color', '#d2821c', 'important');
        //             }
        //             else if (timer.counter >= 0) {
        //                 $('h3.timer').css('color', '#e61919', 'important');
        //             }
        //             if (timer.counter < 0) {
        //                 // if timer hits 0
        //                 timer.stopCount();
        //                 $('.active-btn').css('display', 'none');
        //                 $('.resend-code').css('display', 'block');
        //                 $('#Code').prop('readonly', true);
        //                 $('#Code').css('background', '#e2e2e2');
        //                 setTimeout(() => {
        //                     timerElement.innerHTML = timer.counter;
        //                 }, 1000);
        //             }
        //         },
        //         startCount: function() {
        //             if (!timer.timer_is_on) {
        //                 timer.timer_is_on = 1;
        //                 timer.timedCount();
        //             }
        //         },
        //         stopCount: function() {
        //             clearTimeout(t);
        //             timer.counter = 0;
        //             timer.timer_is_on = 0;
        //         }
        //     };
        //     timer.timedCount();
        // }

        // document.querySelector('.timerButton').addEventListener('click', function() {
        //     timer.timedCount();
        // });
    </script>
@endsection
