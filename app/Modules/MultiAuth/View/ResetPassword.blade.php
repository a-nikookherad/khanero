@extends('frontend.MasterPage.Layout')
<meta name="viewport" content="width=device-width, initial-scale=1">
@section('title','بازیابی رمز عبور')

@section('content')

    <form method="post" id="forgotform" class="form-vertical no-padding no-margin" action="{{route('ResetLink')}}">
        {{csrf_field()}}
        <p class="center">ایمیل خود را برای بازیابی رمز عبور وارد کنید</p>
        <div class="control-group">
            <div class="controls">
                <div class="input-prepend">
                    <span class="add-on"><i class="icon-envelope"></i></span><input id="input-email" name="email" type="text" placeholder="ایمیل"  />
                </div>
            </div>
            <div class="space20"></div>
        </div>
        <input type="submit"  class="btn btn-block login-btn" value="بازیابی" />
    </form>

@endsection
