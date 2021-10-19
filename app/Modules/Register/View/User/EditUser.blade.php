@extends('backend.MasterPage.Layout')
@section('title',TitlePage('ویرایش پروفایل'))
@section('style')
    <link rel="stylesheet" href="{{asset('backend/css/datepicker.css')}}">
    <link rel="stylesheet" href="{{asset('backend/css/bootstrap-datepicker.min.css')}}"/>
    <link rel="stylesheet" href="{{asset('backend/assets/crop-image/css/picedit.min.css')}}"/>
    <style>
        .btn-file {
            position: relative;
            overflow: hidden;
        }

        .btn-file input[type=file] {
            position: absolute;
            top: 0;
            right: 0;
            min-width: 100%;
            min-height: 100%;
            font-size: 100px;
            text-align: right;
            filter: alpha(opacity=0);
            opacity: 0;
            outline: none;
            background: white;
            cursor: inherit;
            display: block;
        }

        .alert p {
            line-height: 25px;
        }

        .img-profile {
            width: 50%;
            border-radius: 50%;
            padding: 3px;
            /*box-shadow: 0px 0px 19px #ff6c60;*/
        }

        span.alert-input {
            color: #ff6c60;
            font-size: 11px;
        }
        li.li-profile {
            background: #ffe9cf;
        }
    </style>
@endsection

@section('content')
    <div class="row back-url">
        <div class="col-md-12">
            @if(auth()->user()->role_id != 1)
                <a class="" href="{{ route('UserDashboard') }}">صفحه اصلی</a>
            @else
                <a class="" href="{{ route('AdminDashboard') }}">صفحه اصلی</a>
            @endif
            <span class="now-url"> / ویرایش پروفایل</span>
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
                    <h3 class="panel-title">ویرایش پروفایل</h3>
                    {{--<div class="panel-options pull-left">--}}
                    {{--<i class="fa fa-chevron-down"></i>--}}
                    {{--<i class="fa fa-times"></i>--}}
                    {{--</div>--}}
                </div>
                <div class="panel-body">
                    <ul id="myTab" class="nav nav-tabs">
                        <li class="@if(!$errors->has('password')) active @endif">
                            <a href="#profile_tab" data-toggle="tab"><i class="fa fa-home"></i>اطلاعات کاربری</a>
                        </li>
                        <li class="@if($errors->has('password')) active @endif">
                            <a href="#settings_tab" data-toggle="tab"><i class="fa fa-gears"></i>تنظیمات رمز ورود</a>
                        </li>
                        @if(auth()->user()->role_id != 1)
                            <li class="">
                                <a href="#special_tab" data-toggle="tab"><i class="fa fa-gears"></i>ارسال مدارک</a>
                            </li>
                        @endif
                        <li class="">
                            <a href="#profile_completed_tab" data-toggle="tab"><i class="fa fa-user"></i>نمایه</a>
                        </li>
                    </ul>
                    <div id="myTabContent" class="tab-content">
                        <div class="tab-pane fade @if(!$errors->has('password')) active in @endif" id="profile_tab">
                            <form role="form" action="{{ route('UpdateUser') }}" method="post"
                                  enctype="multipart/form-data" id="">
                                {{ csrf_field() }}
                                <div class="row">
                                    <div class="each-item col-md-3">
                                            <label class="title-S" for="InputFirstName">نام</label>
                                            <input type="text" name="first_name" value="{{ $userModel->first_name }}"
                                                   class="each-Qt form-control primary input-sm" dir="rtl" id="InputFirstName"
                                                   placeholder="نام را وارد کنید" autofocus>
                                            @if($errors->has('first_name'))
                                                <span style="color:red;">{{ $errors->first('first_name') }}</span>
                                            @endif
                                    </div>
                                    <div class="each-item col-md-3">
                                            <label class="title-S" for="InputLastName">نام خانوادگی</label>
                                            <input type="text" name="last_name" value="{{ $userModel->last_name }}"
                                                   class="each-Qt form-control primary input-sm" dir="rtl" id="InputLastName"
                                                   placeholder="نام خانوادگی را وارد کنید">
                                            {{--                                            <span class="alert-input">تنها پس از نهایی شدن رزرو برای مهمان-میزبان نشان داده میشود</span>--}}
                                            @if($errors->has('last_name'))
                                                <span style="color:red;">{{ $errors->first('last_name') }}</span>
                                            @endif
                                    </div>
                                    <div class="each-item col-md-3">
                                            <label class="title-S" for="InputMobile">تلفن همراه</label>
                                            <input type="text" name="mobile" readonly value="{{ $userModel->mobile }}"
                                                   class="each-Qt form-control primary input-sm" dir="rtl" id="InputMobile"
                                                   placeholder="شماره همراه را وارد کنید">
                                            {{--                                            <span class="alert-input">این شماره نام کاربری شما برای ورود به سیستم می باشد</span>--}}
                                            @if($errors->has('mobile'))
                                                <span style="color:red;">{{ $errors->first('mobile') }}</span>
                                            @endif
                                    </div>
                                    <div class="each-item col-md-3">
                                            <label class="title-S">جنسیت</label>
                                            <select class="each-Qt form-control" name="sex">
                                                <option value="1" @if($userModel->sex == 1) selected @endif>مرد</option>
                                                <option value="2" @if($userModel->sex == 2) selected @endif>زن</option>
                                            </select>
                                    </div>
                                    <div class="each-item col-md-3">
                                            <label class="title-S">وضعیت تاهل</label>
                                            <select class="each-Qt form-control" name="marital_status">
                                                <option value="1" @if($userModel->marital_status == 1) selected @endif>
                                                    مجرد
                                                </option>
                                                <option value="2" @if($userModel->marital_status == 2) selected @endif>
                                                    متاهل
                                                </option>
                                            </select>
                                    </div>
                                    <div class="each-item col-md-3">
                                            <label class="title-S" for="InputNtCode">کد ملی</label>
                                            <input type="text" name="nt_code" value="{{ $userModel->nt_code }}"
                                                   class="each-Qt form-control primary input-sm" dir="rtl" id="InputNtCode"
                                                   placeholder="کد ملی را وارد کنید">
                                            @if($errors->has('nt_code'))
                                                <span style="color:red;">{{ $errors->first('nt_code') }}</span>
                                            @endif
                                    </div>
                                    <div class="each-item col-md-3">
                                            <label class="title-S" for="InputNtCode">شماره شناسنامه</label>
                                            <input type="text" name="n_number" value="{{ $userModel->n_number }}"
                                                   class="each-Qt form-control primary input-sm" dir="rtl" id="InputNtCode"
                                                   placeholder="شماره شناسنامه را وارد کنید">
                                            @if($errors->has('n_number'))
                                                <span style="color:red;">{{ $errors->first('n_number') }}</span>
                                            @endif
                                    </div>
                                    <div class="each-item col-md-3">
                                            <label class="title-S" for="InputJob">شغل</label>
                                            <input type="text" name="job" value="{{ $userModel->job }}"
                                                   class="each-Qt form-control primary input-sm" dir="rtl" id="InputJob"
                                                   placeholder="شغل را وارد کنید">
                                            @if($errors->has('job'))
                                                <span style="color:red;">{{ $errors->first('job') }}</span>
                                            @endif
                                    </div>
                                    <div class="each-item col-md-3">
                                            <label class="title-S" for="InputEmail">ایمیل</label>
                                            <input type="text" name="email" value="{{ $userModel->email }}"
                                                   class="each-Qt form-control primary input-sm" dir="rtl" id="InputEmail"
                                                   placeholder="ایمیل را وارد کنید">
                                            @if($errors->has('email'))
                                                <span style="color:red;">{{ $errors->first('email') }}</span>
                                            @endif
                                    </div>
                                    <div class="each-item col-md-3">
                                        <label class="title-S" for="InputBirthDate">تاریخ تولد</label>
                                        @php(
                                            $birth_date = \Morilog\Jalali\Facades\jDate::forge($userModel->birth_date)->format('Y/m/d')
                                        )
                                        <input type="text" name="birth_date" autocomplete="off"
                                               value="@if($userModel->birth_date == null) انتخاب کنید @else {{ $birth_date }} @endif"
                                               class="each-Qt form-control primary input-sm" readonly
                                               style="cursor: pointer;" dir="rtl" id="InputBirthDate"
                                               placeholder="تاریخ تولد خود را وارد کنید">
                                        @if($errors->has('birth_date'))
                                            <span style="color:red;">{{ $errors->first('birth_date') }}</span>
                                        @endif
                                    </div>
                                    <div class="each-item col-md-3">
                                                <label class="title-S"><span class="nececery">*</span>استان</label>
                                                <select id="SelectProvince" name="" value="{{ old('province_id') }}"
                                                        class="each-Qt form-control">
                                                    <option value="0" hidden>انتخاب کنید</option>
                                                    @foreach($provinceModel as $key => $value)
                                                        <option value="{{ $value->id }}"
                                                                @if($city->province_id == $value->id && auth()->user()->city_id != 0) selected @endif>
                                                            {{ $value->name }}
                                                        </option>
                                                    @endforeach
                                                </select>
                                                @if($errors->has('province_id'))
                                                    <span style="color:red;">{{ $errors->first('province_id') }}</span>
                                                @endif
                                    </div>
                                    <div class="each-item col-md-3">
                                            <label class="title-S"><span class="nececery">*</span>شهر</label>
                                            <select id="SelectTownship" name="city_id" value="{{ old('city_id') }}"
                                                    class="each-Qt form-control">
                                                <option value="0" hidden>انتخاب کنید</option>
                                                @foreach($cityModel as $key => $value)
                                                    <option value="{{ $value->id }}"
                                                            @if($city->id == $value->id && auth()->user()->city_id != 0) selected @endif>
                                                        {{ $value->name }}
                                                    </option>
                                                @endforeach
                                            </select>
                                            @if($errors->has('city_id'))
                                                <span style="color:red;">{{ $errors->first('city_id') }}</span>
                                            @endif
                                    </div>
                                    <div class="each-item col-md-9">
                                            <label class="title-S" for="InputAddress">آدرس</label>
                                            <input type="text" name="address" value="{{ $userModel->address }}"
                                                   class="each-Qt form-control primary input-sm" dir="rtl" id="InputAddress"
                                                   placeholder="آدرس را وارد کنید">
                                            @if($errors->has('address'))
                                                <span style="color:red;">{{ $errors->first('address') }}</span>
                                            @endif
                                    </div>
                                    <div class="each-item col-md-3">
                                            <label class="title-S" for="InputInstagram">آی دی اینستاگرام</label>
                                            <input type="text" name="instagram" value="{{ $userModel->instagram }}"
                                                   class="each-Qt form-control primary input-sm" dir="rtl" id="InputInstagram"
                                                   placeholder="آی دی اینستاگرام را وارد کنید">
                                            @if($errors->has('instagram'))
                                                <span style="color:red;">{{ $errors->first('instagram') }}</span>
                                            @endif
                                    </div>
                                </div>
                                <br/>
                                <div class="row">

                                </div>
                                <br/>
                                <div class="row">
                                    <div class="col-md-12">
                                        {{--                                        <span class="alert-input">لطفا تصویری از چهره خود آپلود کنید. کاربران با مشاهده چهره واقعی شما به عنوان مهمان-میزبان به شما بیشتر اعتماد می کنند</span>--}}
                                    </div>
                                </div>
                                <br/>
                                <div class="row">
                                    <div class="col-md-12">
                                        <button type="submit" id="BtnRegister" class="btn btn-green regstr-btn regstr-btn ">ثبت
                                            اطلاعات
                                        </button>
                                    </div>
                                </div>
                            </form>
                        </div>

                        <div class="tab-pane fade " id="profile_completed_tab">
                            <form role="form" action="{{ route('UpdateUser') }}" method="post"
                                  enctype="multipart/form-data" id="">
                                {{ csrf_field() }}
                                <input type="hidden" value="1" name="image_form">
                                <div class="row">
                                    <div class="col-md-2">
                                        <div class="form-group">
                                            <label for="InputImg">تصویر</label>
                                            <br/>
                                            <span class="btn btn-danger btn-file btn-select-img">
												انتخاب کنید
												 <input type="file" onchange="readURLAvarat(this)" name="img"
                                                        id="InputImg"/>
                                            </span>
                                        </div>
                                    </div>
                                    <div class="col-md-2">
                                        <div id="ExtraBoxUpload">
                                            @if(auth()->user()->avatar == 'default-user.png')
                                                <img id="" class="img-profile" src="{{ asset('backend/img/avatar.png')}}" alt="">
                                            @else
                                                <img id="" class="img-profile" src="{{asset('Uploaded/User/Profile/'.auth()->user()->avatar)}}" alt="">
                                            @endif
                                        </div>
                                    </div>
                                    <div class="col-md-12">
                                        <div class="form-group">
                                            <label for="InputAbout">درباره خودتان</label>
                                            <textarea name="about" rows="6"
                                                      class="form-control primary input-sm" dir="rtl"
                                                      id="InputAbout"
                                                      placeholder="اهل سفر / اهل طبیعت / ...">{{ old('about', $userModel->about) }}</textarea>
                                            @if($errors->has('about'))
                                                <span style="color:red;">{{ $errors->first('about') }}</span>
                                            @endif
                                        </div>
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="col-md-12">
                                        <button type="submit" id="BtnRegister" class="btn btn-green regstr-btn ">ثبت
                                            اطلاعات
                                        </button>
                                    </div>
                                </div>
                            </form>
                        </div>

                        <div class="tab-pane fade" id="special_tab">
                            <form action="{{route('UpdateConfirmUser')}}" id="ConfirmUser" method="post" enctype="multipart/form-data">
                                {{csrf_field()}}
                                <div class="row">
                                    <div class="each-item col-md-3">
                                        <div class="form-group">
                                            <label class="title-S" for="SelectConfirmUser">مدرک</label>
                                            <select id="SelectConfirmUser" class="each-Qt form-control" name="type">
                                                <option value="0" hidden>انتخاب کنید</option>
                                                @foreach(DocumentsHost() as $key => $value)
                                                    <option value="{{$value['id']}}">{{$value['name']}}</option>
                                                @endforeach
                                            </select>
                                        </div>
                                    </div>
                                    <div class="each-item col-md-3">
                                        <label for="InputFile" class="title-S">فایل انتخابی</label>
                                        <input type="file" name="file" id="InputFile">
                                    </div>

                                    <div class="col-md-12">
                                        <br/>
                                        <div class="form-group">
                                            <input type="submit" id="BtnConfirmUserSpecial" value="ثبت اطلاعات"
                                                   class="btn btn-green regstr-btn"/>
                                        </div>
                                    </div>
                                </div>
                            </form>
                            <div class="row">
                                @foreach($userModel->getDocument as $key => $value)
                                    <div class="col-md-3">
                                        <img style="width: 100%" src="{{asset('Uploaded/Document/File/'.$value->file)}}" />
                                        <p class="text-center">{{GetTypeDocument($value->type)}}</p>
                                    </div>
                                @endforeach
                            </div>
                        </div>


                        <div class="tab-pane fade @if($errors->has('password')) active in @endif" id="settings_tab">
                            <form action="{{ route('ResetPassword') }}" method="post" id="FormResetPassword">
                                {{ csrf_field() }}
                                <div class="row">
                                    <div class="each-item col-md-4">
                                            <label class="title-S" for="InputNewPassword"><span class="nececery">*</span>رمز  فعلی</label>
                                            <input type="password" name="current_password" class="each-Qt form-control primary input-sm"
                                                   dir="rtl" id="InputCurrentPassword"
                                                   placeholder="رمز عبور فعلی را وارد کنید">
                                    </div>
                                    <div class="each-item col-md-4">
                                            <label class="title-S" for="InputNewPassword"><span class="nececery">*</span>رمز عبور جدید</label>
                                            <input type="password" name="new_password" class="each-Qt form-control primary input-sm"
                                                   dir="rtl" id="InputNewPassword"
                                                   placeholder="رمز عبور جدید را وارد کنید">
                                            @if($errors->has('password'))
                                                <span style="color:red;">{{ $errors->first('password') }}</span>
                                            @endif
                                    </div>
                                    <div class="each-item col-md-4">
                                            <label class="title-S" for="InputNewConfirmPassword"><span class="nececery">*</span>تکرار رمز عبور</label>
                                            <input type="password" name="confirm_password"
                                                   class="each-Qt form-control primary input-sm" dir="rtl"
                                                   id="InputNewConfirmPassword"
                                                   placeholder="تکرار رمز عبور را وارد کنید">
                                            <span class="" style="color: red;" id="span-alert-password-confirm"></span>
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="col-md-12">
                                        <div class="form-group">
                                            <input type="button" id="BtnChangePassword" value="ثبت ویرایش"
                                                   class="btn btn-green regstr-btn"/>
                                        </div>
                                    </div>
                                </div>
                            </form>
                            <form method="post" accept-charset="utf-8" name="form1">
                                <input name="hidden_data" id='hidden_data' type="hidden"/>
                            </form>
                        </div>

                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection

@section('script')
    <script type="text/javascript" src="{{ asset('backend/js/number.js') }}"></script>

    <script src="{{asset('backend/js/bootstrap-datepicker.min.js')}}"></script>
    <script src="{{asset('backend/js/bootstrap-datepicker.fa.min.js')}}"></script>
    <script type="text/javascript">

        $("#InputBirthDate").datepicker({
            changeMonth: true,
            changeYear: true,
            isRTL: true,
            dateFormat: "yy/mm/dd",
            EnableTimePicker: true,
            yearRange: '1327:1397',
            defaultDate: '1370/01/01',
        });

        //get township
        $("body").delegate("#SelectProvince", "change", function (e) {

            var id = $(this).val();
            getTownship(id);
        });

        //get township
        function getTownship(id) {
            $.ajaxSetup({
                headers: {
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                }
            });
            $.ajax({
                url: '{{route('GetAjaxTownship')}}',
                type: 'post',
                data: {
                    id: id
                },
                success: function (data) {
                    $("#SelectTownship").html(data);
                }
            });
        }

        $(document).ready(function () {

            $("#InputBirthDate").datepicker({
                minDate: 0,
                changeMonth: true,
                changeYear: true,
                isRTL: true,
                dateFormat: "yy/mm/dd",
                EnableTimePicker: true,
            });

            /* -_-_-_-_-_-_-_-_-_-_-_-_-_-_-_-_-_-_-_-_-_-_-_-_-_-_-_-_-_-_-_-_- */

            $("#BtnChangePassword").click(function () {
                var InputNewPassword = $('#InputNewPassword').val();
                var InputNewConfirmPassword = $('#InputNewConfirmPassword').val();
                if (InputNewPassword != InputNewConfirmPassword) {
                    $('#span-alert-password-confirm').text('مقدار رمز ورود و تکرار آن باید یکی باشد .');
                } else {
                    $('#FormResetPassword').submit();
                }
            });

        });

    </script>

    <script type="text/javascript" src="{{asset('backend/assets/crop-image/js/picedit.min.js')}}"></script>
    <script type="text/javascript">
        $(function () {
            $('#thebox').picEdit({
                imageUpdated: function (img) {
                },
                formSubmitted: function () {
                },
                redirectUrl: false,
                defaultImage: false
            });
        });

        $('.btn-select-img').click(function () {
            $.ajax({
                url: '{{route('CreateBoxUploadImageProfile')}}',
                type: 'get',
                success: function (data) {
                    // $('#ExtraBoxUpload').html(data);
                }
            });
        });

        function readURL(input) {
            if (input.files && input.files[0]) {
                var reader = new FileReader();
                reader.onload = function (e) {
                    $('#ImageNationalCard').attr('src', e.target.result);
                };
                reader.readAsDataURL(input.files[0]);
            }
        }

        function readURLAvarat(input) {
            if (input.files && input.files[0]) {
                var reader = new FileReader();
                reader.onload = function (e) {
                    $('.img-profile').attr('src', e.target.result);
                };
                reader.readAsDataURL(input.files[0]);
            }
        }

    </script>
@endsection