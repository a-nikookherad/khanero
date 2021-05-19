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
                <form method="post" action="{{route('ResetLink')}}">
                    {{csrf_field()}}

                    <div class="page-header">
                        <h3>
                            <i class="fa fa-user"></i>
                            نام کاربری را وارد کنید
                        </h3>
                    </div>
                    <div class="row">
                        <div class="col-sm-2 col-xs-12"> نام کاربری :</div>
                        <div class="col-sm-7 col-xs-12">
                            <input type="text" name="user_name" class="form-control"  value="{{old('mobile')}}" placeholder="نام کاربری">
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
                                ارسال کد فعال سازی
                            </button>
                        </div>
                    </div>

                </form>
            </div>
        </div>
    </div>





@endsection
