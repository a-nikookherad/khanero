@extends('frontend.MasterPage.Layout')
@section('title')
    ویلا :: تماس با ما
@endsection
@section('style')
    <style>
        .title-section {
            color: #fe5513;
            padding-bottom: 10px;
        }
        .title-section span {
            color: #3ba0ff;
            font-size: 22px;
            padding-left: 5px;
        }
    </style>
@endsection
@section('content')
    <div class="col-xs-12 col-sm-12">
        {{--<div class="row">--}}
            {{--<div class="col-sm-12 col-xs-12">--}}
                {{--@include('message.Message')--}}
                {{--@include('message.ErrorReporting')--}}
            {{--</div>--}}
        {{--</div>--}}
        <div class="row">
            <div class="col-md-12 title-section">
                <h3>
                     تماس با ما
                </h3>
            </div>
        </div>
        <div class="row">
            <div class="col-md-12">
                <div class="panel panel-default"  style="margin-bottom: 50px;">
                    <div class="panel-body">
                        <form action="{{ route('StoreContactUser') }}" method="post" id="FormMessageContactUser">
                            {{ csrf_field() }}
                            <div class="row">
                                <div class="col-md-6">
                                    <div class="row">
                                        <div class="form-group">
                                            <label for="InputNameContactUser">نام و نام خانوادگی</label><span style="color: red; font-size: 20px">*</span>
                                            <input type="text" class="form-control" value="{{ old('name') }}" name="name" id="InputNameContactUser" placeholder="نام و نام خانوادگی خود را وارد کنید" />
                                            @if($errors->has('name'))
                                                <span style="color:red;">{{ $errors->first('name') }}</span>
                                            @endif
                                        </div>
                                    </div>
                                    <div class="row">
                                        <div class="form-group">
                                            <label for="InputEmailContactUser">آدرس ایمیل</label><span style="color: red; font-size: 20px">*</span>
                                            <input type="email" class="form-control" value="{{ old('email') }}" name="email" id="InputEmailContactUser" placeholder="آدرس ایمیل خود را وارد کنید" />
                                            @if($errors->has('email'))
                                                <span style="color:red;">{{ $errors->first('email') }}</span>
                                            @endif
                                        </div>
                                    </div>
                                    <div class="row">
                                        <div class="form-group">
                                            <label for="InputPhoneContactUser">تلفن تماس</label><span style="color: red; font-size: 20px">*</span>
                                            <input type="text" class="form-control" value="{{ old('phone') }}" name="phone" id="InputPhoneContactUser" placeholder="تلفن تماس خود را وارد کنید" />
                                            @if($errors->has('phone'))
                                                <span style="color:red;">{{ $errors->first('phone') }}</span>
                                            @endif
                                        </div>
                                    </div>
                                    <div class="row">
                                        <div class="form-group">
                                            <label for="InputSubjectContactUser">موضوع</label><span style="color: red; font-size: 20px">*</span>
                                            <input type="text" class="form-control" name="subject" value="{{ old('subject') }}" id="InputSubjectContactUser" placeholder="موضوع خود را وارد کنید" />
                                            @if($errors->has('subject'))
                                                <span style="color:red;">{{ $errors->first('subject') }}</span>
                                            @endif
                                        </div>
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <p style="line-height: 28px;">
                                        سایت رنت به منظور تسهیل ارتباط خود با کاربران سایت، اطلاعات تماس خود را ارائه می‌نماید. کاربران عزیز می‌توانند با استفاده از اطلاعات تماس ذیل ما را از نظرات و پیشنهادات خود مطلع سازند و همچمین ما را در جهت رسیدن به اهداف سایت یاری دهند.
                                        لطفاً در صورت امکان اطلاعات را به فارسی وارد نمایید.
                                    </p>
                                    <div class="text-center">
                                        <img style="padding: 30px;width: 50%;" src="{{ asset('frontend/images/logo.png') }}" />
                                    </div>
                                </div>
                            </div>

                            <div class="row">
                                <div class="col-md-12">
                                    <div class="form-group">
                                        <label for="InputContentContactUser">متن پیام</label><span style="color: red; font-size: 20px">*</span>
                                        <textarea class="form-control" name="content" id="InputContentContactUser" style="min-height: 100px;" placeholder="متن خود را وارد کنید">{{ old('content') }}</textarea>
                                        @if($errors->has('content'))
                                            <span style="color:red;">{{ $errors->first('content') }}</span>
                                        @endif
                                    </div>
                                </div>
                                <div class="col-md-12">
                                    <div class="form-group">
                                        <button type="button" id="BtnSendContactUser" class="btn btn-success btn block">ثبت پیام</button>
                                    </div>
                                </div>
                            </div>
                        </form>

                        <div class="row">
                            <div class="col-md-12 text-center">
                                <h5 style="color: #fe5513;">موقعیت دفتر بر روی نقشه </h5>
                                <br />
                                <div id="map-markers" style="height:300px"></div>
                            </div>
                        </div>
                        <br />
                        <div class="row text-center">
                            <div class="col-md-12">
                                <div class="col-md-4">
                                    <h5 style="color: #ff6600;">آدرس دفتر مرکزی </h5>
                                    <h4>{{ $contactModel->address }}</h4>
                                </div>
                                <div class="col-md-4">
                                    <h5 style="color: #ff6600;">تلفن تماس </h5>
                                    <h4>{{ $contactModel->phone }}</h4>
                                </div>
                                <div class="col-md-4">
                                    <h5 style="color: #ff6600;">ایمیل سازمانی رنت </h5>
                                    <h4>{{ $contactModel->email }}</h4>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection

@section('script')
    <script src="https://maps.googleapis.com/maps/api/js?key=AIzaSyCBUcxNAzDyoiTXUXpLwd1a-3jOwkQpDUs&sensor=false&libraries=places&language=en"></script>

    <script type="text/javascript" src="{{ asset('backend/js/gmaps.js') }}"></script>
    <script type="text/javascript">
        //markers
        console.log();
        map = new GMaps({
            div: '#map-markers',
            lat: {{ $contactModel->latitude }},
            lng: {{ $contactModel->longitude }}
        });
        map.addMarker({
            lat: {{ $contactModel->latitude }},
            lng: {{ $contactModel->longitude }},
            title: 'Marker with InfoWindow',
            infoWindow: {
                content: '<p>{{ $contactModel->phone }}</p>'
            }
        });
    </script>

    <script>
        $(document).ready(function () {
            $('#BtnSendContactUser').click(function () {
                // var name = $('#InputNameContactUser').val();
                // var email = $('#InputEmailContactUser').val();
                // var phone = $('#InputPhoneContactUser').val();
                // var subject = $('#InputSubjectContactUser').val();
                // var content = $('#InputContentContactUser').val();
                // if(name == "" || email == "" || phone == "" || subject == "" ||  content == "")
                // {
                //     alert('یک یا چند فیلد خالی میباشد');
                // }
                // else
                // {
                $('#FormMessageContactUser').submit();
                // }
            });
        });
    </script>
@endsection
