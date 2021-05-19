@extends('frontend.MasterPage.Layout')

@section('title',' سرمه :: ورود به سیستم')

@section('style')
<style>
    .row{padding-top: 10px;}
    .panel{padding-bottom: 30px;}
    .page-header{
        padding: 10px;
        border-bottom: 1px solid #CCC;
    }
</style>
@endsection

@section('content')


    <div class="container">

        <div class="row">
            <div class="col-sm-12 col-xs-12">

                @include('message.Message')
                @include('message.ErrorReporting')

                <div class="panel panel-default">
                    <form method="post" action="{{route('UserLogin')}}">
                        {{csrf_field()}}

                        <div class="page-header">
                            <h3>
                                <i class="fa fa-user"></i>
                                ورود به سیستم
                            </h3>
                        </div>
                        <div class="row">
                            <div class="col-sm-2 col-xs-12"> شماره موبایل :</div>
                            <div class="col-sm-7 col-xs-12">
                                <input type="text" name="mobile" class="form-control"  value="{{old('mobile')}}" placeholder=" شماره موبایل خود را وارد کنید ">
                            </div>
                        </div>

                        <div class="row">
                            <div class="col-sm-2 col-xs-12"> رمز عبور :</div>
                            <div class="col-sm-7 col-xs-12">
                                <input type="password" name="password" class="form-control" placeholder="رمز عبور" >
                            </div>
                        </div>

                        <div class="row">
                            <div class="col-sm-2 col-xs-12">کدامنیتی :</div>
                            <div class="col-sm-7 col-xs-12">
                                <input type="text" name="captcha" class="form-control" placeholder="کد امنیتی" >
                            </div>
                            <div class="col-sm-3 col-xs-12">
                                <div class="row">
                                    <div class="col-sm-2 col-xs-12 text-center">
                                        <a class="captcha-button" id="captcha">
                                            <i class="fa fa-refresh"></i>
                                        </a>
                                    </div>
                                    <div class="col-sm-10 col-xs-12 captcha">
                                        {!! Captcha::img('inverse') !!}
                                    </div>
                                </div>
                            </div>
                        </div>

                        <div class="row">
                            <div class="col-sm-2 col-xs-12"></div>
                            <div class="col-sm-7 col-xs-12">
                                <a href="{{route('ResetLinkForm')}}"> رمز عبور خود را فراموش کرده ام</a>
                            </div>
                        </div>

                        <div class="row">
                            <div class="col-sm-12 col-xs-12 text-center">
                                <button type="submit" class="btn btn-info">
                                    ورود به سیستم
                                </button>
                            </div>
                        </div>

                    </form>
                </div>
            </div>
        </div>

    </div>

@endsection

@section('script')

    <script type="text/javascript">
        $(document).ready(function (e) {
            //recaptcha
            $("body").delegate("#captcha","click",function (e) {
                e.preventDefault();


                $('.captcha-button').find('i').addClass('fa-spin');
                $.ajaxSetup({
                    headers: {
                        'X-CSRF-TOKEN': $('meta[name="_token"]').attr('content')
                    }});

                $.ajax({
                    url:'{{route('Captcha')}}',
                    type:'get',
                    success:function(data) {
                        $('.captcha-button').find('i').removeClass('fa-spin');
                        $('.captcha').html(data);
                    }
                });

            });
        });
    </script>

@endsection
