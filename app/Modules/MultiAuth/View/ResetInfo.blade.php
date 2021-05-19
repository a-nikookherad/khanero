@extends('backend.MasterPage.Auth')
<meta name="viewport" content="width=device-width, initial-scale=1">

@section('content')

    <form role="form" method="POST" action="{{route('ResetPassword',['token'=>$Token])}}">
        <div class="lock">
            <i class="icon-lock"></i>
        </div>
        <div class="control-wrap">

            {{csrf_field()}}

            <h4>تغییر رمز عبور</h4>
            <div class="control-group">
                <div class="controls">
                    <div class="input-prepend">
                        <span class="add-on"><i class="icon-user"></i></span>
                        <input id="input-username" name="email" value="{{old('email')}}" type="text" class="form-control en" placeholder="ایمیل خود را وارد کنید">
                    </div>
                </div>
            </div>
            <div class="control-group">
                <div class="controls">
                    <div class="input-prepend">
                        <span class="add-on"><i class="icon-key"></i></span>
                        <input id="input-password" name="password" type="password" class="form-control en" placeholder="رمز عبور خود را وارد کنید">
                    </div>
                </div>

            </div>
            <div class="control-group">
                <div class="controls">
                    <div class="input-prepend">
                        <span class="add-on"><i class="icon-key"></i></span>
                        <input id="input-password" name="password_confirmation" type="password" class="form-control en" placeholder="تکرار رمز عبور را وارد کنید">
                    </div>

                    <div class="clearfix space5"></div>
                </div>

            </div>

        </div>

        <input type="submit" id="login-btn" class="btn btn-block login-btn" value="ورود به سیستم" />
    </form>

@endsection
