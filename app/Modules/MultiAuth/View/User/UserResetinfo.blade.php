@extends('frontend.MasterPage.Layout')

@section('title','سرمه :: بازیابی رمز عبور')

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

    <div class="row">
        <div class="col-sm-12 col-xs-12">

            @include('message.Message')
            @include('message.ErrorReporting')

            <div class="panel panel-default">
                <form method="post" action="{{route('ResetPassword')}}">
                    {{csrf_field()}}

                    <div class="page-header">
                        <h3>
                            <i class="fa fa-user"></i>
                            بازیابی رمز عبور
                        </h3>
                    </div>
                    <div class="row">
                        <div class="col-sm-12">
                            <div class="alert alert-info">
                                در صورتیکه کد فعال سازی به تلفن همراه شما ارسال نگردیده است
<a href="{{route('ResetLinkForm')}}">اینجا</a>
                                را کلیک کنید
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-sm-2 col-xs-12">نام کاربری :</div>
                        <div class="col-sm-7 col-xs-12">
                            <input type="text" name="user_name" class="form-control"  value="{{old('user_name')}}" placeholder="نام کاربری">
                        </div>
                    </div>

                    <div class="row">
                        <div class="col-sm-2 col-xs-12">رمز عبور :</div>
                        <div class="col-sm-7 col-xs-12">
                            <input type="password" name="password" class="form-control"   placeholder="رمز عبور">
                        </div>
                    </div>

                    <div class="row">
                        <div class="col-sm-2 col-xs-12">تکرار رمز عبور:</div>
                        <div class="col-sm-7 col-xs-12">
                            <input type="password" name="password_confirmation" class="form-control"  placeholder="تکرار رمز عبور">
                        </div>
                    </div>

                    <div class="row">
                        <div class="col-sm-2 col-xs-12">کد فعال سازی:</div>
                        <div class="col-sm-7 col-xs-12">
                            <input type="text" name="active_code" class="form-control" value="{{old('active_code')}}"  placeholder="کد فعال سازی">
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
                        <div class="col-sm-12 col-xs-12 text-center">
                            <button type="submit" class="btn btn-info">
                               تغییر رمز عبور
                            </button>
                        </div>
                    </div>

                </form>
            </div>
        </div>
    </div>





@endsection
