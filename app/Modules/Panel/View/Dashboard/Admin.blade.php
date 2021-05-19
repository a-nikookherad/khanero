@extends('backend.MasterPage.Layout')

@section('title')
    داشبورد
@endsection

@section('style')
    <link href="{{ url('backend/css/style-custom-panel.css') }}" type="text/css" rel="stylesheet" />
@endsection

@section('headerSection')

@endsection

@section('content')
    <div class="row">
        <div class="col-md-12">
            @include('message.Message')
            @include('message.ErrorReporting')
        </div>
    </div>
    <div class="row text-center row-link-dashboard">
        <div class="col-md-2">
            <a href="{{ route('EditUser') }}">
                <div class="box-panel">
                    <i class="fa fa-edit"></i>
                    <h5>
                        اطلاعات کاربری
                    </h5>
                </div>
            </a>
        </div>
        <div class="col-md-2">
            <a href="{{ route('IndexUser') }}">
                <div class="box-panel">
                    <i class="fa fa-users"></i>
                    <h5>
                        نمایش اعضا
                    </h5>
                </div>
            </a>
        </div>
        <div class="col-md-2">
            <a href="{{ route('IndexMessage') }}">
                <div class="box-panel">
                    <i class="fa fa-dropbox"></i>
                    <h5>
                        پیام ها <span class="text-info numberMessageUser"></span>
                    </h5>
                </div>
            </a>
        </div>
        <div class="col-md-2">
            <a href="{{ route('ContactUsFormAdmin') }}">
                <div class="box-panel">
                    <i class="fa fa-phone"></i>
                    <h5>
                        تماس با ما
                    </h5>
                </div>
            </a>
        </div>
        <div class="col-md-2">
            <a href="{{ route('IndexContent') }}">
                <div class="box-panel">
                    <i class="fa fa-chain-broken"></i>
                    <h5>
                        مدیریت محتوا
                    </h5>
                </div>
            </a>
        </div>
        <div class="col-md-2">
            <a href="{{ route('SendSms') }}">
                <div class="box-panel">
                    <i class="fa fa-chain-broken"></i>
                    <h5>
                        ارسال پیامک
                    </h5>
                </div>
            </a>
        </div>
    </div>
    
    <div class="row text-center row-link-dashboard">
        <div class="col-md-2">
            <a href="{{route('IndexRateAndComment')}}">
                <div class="box-panel">
                    <i class="fa fa-comments-o"></i>
                    <h5>
                        نظرات
                    </h5>
                </div>
            </a>
        </div>
{{--        <div class="col-md-2">--}}
{{--            <a href="{{route('IndexInfoCity')}}">--}}
{{--                <div class="box-panel">--}}
{{--                    <i class="fa fa-comments-o"></i>--}}
{{--                    <h5>--}}
{{--                        درباره شهر ها--}}
{{--                    </h5>--}}
{{--                </div>--}}
{{--            </a>--}}
{{--        </div>--}}
    </div>

@endsection

@section('script')
    <script type="text/javascript">
        var id = {{ auth()->user()->id }};
        $.ajax({
            url:"{{ url('message/get/number').'/'}}"+id,
            method:"get",
        }).done(function(returnData){
            $('.numberMessageUser').text(returnData);
        });
    </script>
@endsection