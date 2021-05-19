@extends('backend.MasterPage.Layout')
@section('title',TitlePage('نمایش اطلاعات'))
@section('style')
    <link href="{{ url('backend/css/style-custom-panel.css') }}" type="text/css" rel="stylesheet"/>
    <style>
        .color-text-section {
            color: #3ba0ff;
        }
    </style>
@endsection
@section('content')
    <div class="row back-url">
        <div class="col-md-12">
            <a class="" href="{{ route('AdminDashboard') }}">صفحه اصلی</a> /
            <a class="" href="{{ route('IndexUser') }}">نمایش کاربران</a>
            <span class="now-url"> / نمایش جزئیات</span>
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
            <div class="card hovercard">
                <div class="card-background">
                    <img class="card-bkimg" alt="" src="{{ asset('Uploaded/User/Profile').'/'. $userModel->avatar  }}">
                </div>
                <div class="useravatar">
                    <img alt="" src="{{ asset('Uploaded/User/Profile').'/'. $userModel->avatar  }}">
                </div>
                <div class="card-info"><span class="card-title">{{ $userModel->first_name }}</span>

                </div>
            </div>
            <div class="btn-pref btn-group btn-group-justified btn-group-lg" role="group" aria-label="...">
                <div class="btn-group" role="group">
                    <button type="button" id="stars"
                            class="btn @if(!$errors->has('title')) btn-primary @else btn-default @endif " href="#tab1"
                            data-toggle="tab">
                        <span class="fa fa-user" aria-hidden="true"></span>
                        <div class="hidden-xs">جزئیات کاربر</div>
                    </button>
                </div>
                <div class="btn-group" role="group">
                    <button type="button" id="favorites"
                            class="btn @if($errors->has('title')) btn-primary @else btn-default @endif" href="#tab2"
                            data-toggle="tab">
                        <span class="fa fa-dropbox" aria-hidden="true"></span>
                        <div class="hidden-xs">ارسال پیام</div>
                    </button>
                </div>
                <div class="btn-group" role="group">
                    <button type="button" id="following" class="btn btn-default" href="#tab3" data-toggle="tab">
                        <span class="fa fa-star-o" aria-hidden="true"></span>
                        <div class="hidden-xs">سابقه فعالیت</div>
                    </button>
                </div>
            </div>

            <div class="well">
                <div class="tab-content">
                    <div class="tab-pane fade @if(!$errors->has('title')) in active @endif" id="tab1">
                        <div class="form-group">
                            <div class="row">
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label class="color-text-section">نام کاربر : </label>
                                        <label> {{ $userModel->first_name }} </label>
                                    </div>
                                    <div class="form-group">
                                        <label class="color-text-section">شناسه کاربری : </label>
                                        <label> {{ $userModel->user_name }} </label>
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label class="color-text-section">تلفن تماس : </label>
                                        <label> {{ $userModel->mobile }} </label>
                                    </div>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label class="color-text-section">تاریخ تولد : </label>
                                        @php(
                                            $birth_date = \Morilog\Jalali\Facades\jDate::forge($userModel->birth_date)->format('Y/m/d')
                                        )
                                        <label> {{ $birth_date }} </label>
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label class="color-text-section">ایمیل : </label>
                                        <label> {{ $userModel->email }} </label>
                                    </div>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-md-3">
                                    <div class="form-group">
                                        <label class="color-text-section">استان : </label>
                                        @if($userModel->getTownship != null)
                                            <label> {{ $userModel->getTownship->provinceGet->name }} </label>
                                        @else
                                            ثبت نشده
                                        @endif
                                    </div>
                                </div>
                                <div class="col-md-3">
                                    <div class="form-group">
                                        <label class="color-text-section">شهر : </label>
                                        @if($userModel->getTownship != null)
                                            <label> {{ $userModel->getTownship->name }} </label>
                                        @else
                                            ثبت نشده
                                        @endif
                                    </div>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-md-12">
                                    <div class="form-group">
                                        <label class="color-text-section">آدرس : </label>
                                        <label> {{ $userModel->address }} </label>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>

                    <div class="tab-pane fade @if($errors->has('title')) in active @endif" id="tab2">
                        <form action="{{ route('StoreMessage') }}" id="FormSendMessage" method="post">
                            {{ csrf_field() }}
                            <input type="hidden" name="receiver_id" value="{{ $userModel->id }}">
                            <div class="form-group">
                                <label for="InputTitleMessage">عنوان پیام</label>
                                <input type="text" name="title" class="form-control" id="InputTitleMessage"
                                       placeholder="عنوان"/>
                                @if($errors->has('title'))
                                    <span style="color:red;">{{ $errors->first('title') }}</span>
                                @endif
                            </div>
                            <div class="form-group">
                                <label for="InputContentMessage">متن پیام</label>
                                <textarea name="message" class="form-control" placeholder="متن پیام را وارد کنید"
                                          id="InputContentMessage" style="min-height: 100px;"></textarea>
                                @if($errors->has('message'))
                                    <span style="color:red;">{{ $errors->first('message') }}</span>
                                @endif
                            </div>
                            <div class="form-group">
                                <button type="button" id="BtnSendMessage" class="btn btn-success btn-block">ارسال پیام
                                </button>
                            </div>
                        </form>
                    </div>

                    <div class="tab-pane fade in" id="tab3">
                        {{--@if($posterCount == 0)--}}
                        {{--<div class="alert alert-warning">--}}
                        {{--این کاربر هیچ فعالیتی در سیستم ندارد .--}}
                        {{--</div>--}}
                        {{--@else--}}
                        {{--<div class="alert alert-success">--}}
                        {{--تعداد آگهی های ثبت شده : {{ $posterCount }}--}}
                        {{--</div>--}}
                        {{--@endif--}}
                        <div class="alert alert-warning">
                            این کاربر هیچ فعالیتی در سیستم ندارد .
                        </div>
                    </div>
                </div>
            </div>

        </div>
    </div>




@endsection


@section('script')
    <script type="text/javascript">
        $(document).ready(function () {
            $(".btn-pref .btn").click(function () {
                $(".btn-pref .btn").removeClass("btn-primary").addClass("btn-default");
                // $(".tab").addClass("active"); // instead of this do the below
                $(this).removeClass("btn-default").addClass("btn-primary");
            });

            $('#BtnSendMessage').click(function () {
                var titleMessage = $('#InputTitleMessage').val();
                var contentMessage = $('#InputContentMessage').val();
                if (titleMessage == "" && contentMessage == "") {
                    alert('یک یا چند فیلد خالی میباشد');
                } else {
                    $('#FormSendMessage').submit();
                }
            });
        });
    </script>
@endsection