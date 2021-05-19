@extends('backend.MasterPage.Layout')
@section('title',TitlePage('نمایش اطلاعات'))
@section('style')
    <link href="{{ url('backend/css/style-custom-panel.css') }}" type="text/css" rel="stylesheet"/>
    <style>
        .color-text-section {
            color: #3ba0ff;
        }

        img.user-avatar {
            width: 100px;
        }
    </style>
@endsection
@section('content')
    <div class="row back-url">
        <div class="col-md-12">
            <a class="" href="{{ route('AdminDashboard') }}">صفحه اصلی</a> /
            <a class="" href="{{ route('IndexUserConfirm') }}">نمایش کاربران ویژه</a>
            <span class="now-url"> / نمایش کاربران ویژه</span>
        </div>
    </div>
    <div class="row">
        <div class="col-md-12">
            @include('message.Message')
            @include('message.ErrorReporting')
        </div>
    </div>
    <div class="row">
        <div class="col-md-12">
            <div class="panel panel-default">
                <div class="panel-heading">
                    @if($userModel->avatar != 'default-user.png')
                        <img src="{{asset('Uploaded/User/Profile').'/'.$userModel->avatar}}" class="user-avatar">
                    @else
                        <img src="{{asset('Uploaded/User/Profile/default-user.png')}}" class="user-avatar">
                    @endif
                    <h3 class="panel-title">حساب کاربری {{$userModel->first_name . ' '. $userModel->last_name}}</h3>

                </div>
                <div class="panel-body">
                    <div class="row">
                        <div class="col-md-6">
                            <div class="form-group">
                                <p>نام : {{$userModel->first_name}}</p>
                                <p>نام خانوادگی : {{$userModel->last_name}}</p>
                                <p>تلفن همراه : {{$userModel->mobile}}</p>
                                <p>تلفن ثابت : {{$userModel->telephone}}</p>
                                <p>آدرس : {{$userModel->address}}</p>
                                <p>پست الکترونیکی : {{$userModel->email}}</p>
                                <p>تاریخ تولد : {{Morilog\Jalali\Facades\jDate::forge($userModel->birth_date)->format('Y/m/d')}}</p>
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="form-group">
                                <p>درباره کاربر : {{$userModel->about}}</p>
                                <p>تلفن اضطراری : {{$userModel->emergency}}</p>
                                <p>زبان خارجه : {{$userModel->language}}</p>
                                <p>شماره کارت : {{$userModel->card_bank_number}}</p>
                                <p>نام صاحب حساب : {{$userModel->account_name}}</p>
                                <p>شماره شبا : {{$userModel->shaba_number}}</p>
                                <a href="{{route('ConfirmUserToSpecial', ['id' => $userModel->id, 'type' => 'confirm'])}}" class="btn btn-default">تایید کاربر</a>
                                <a href="{{route('DetailUser', ['id' => $userModel->id])}}" class="btn btn-default">ارسال پیام</a>
                                <a href="{{route('ConfirmUserToSpecial', ['id' => $userModel->id, 'type' => 'reject'])}}" class="btn btn-default">بررسی مجدد</a>
                            </div>
                        </div>
                        <div class="col-md-12">
                            <img class="image-national-card" alt=""
                                 src="{{ asset('Uploaded/User/Profile').'/'. $userModel->img_national_card  }}">

                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

@endsection


@section('script')
    <script type="text/javascript">

    </script>
@endsection