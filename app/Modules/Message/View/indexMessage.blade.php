@extends('backend.MasterPage.Layout')
@section('title', TitlePage('نمایش مخاطبین'))
@section('style')
    <link rel="stylesheet" href="{{asset('backend/css/dataTables.bootstrap.css')}}">
    <link rel="stylesheet" href="{{asset('backend/css/TableTools.css')}}">
    <style>
        #ToolTables_DataTables_Table_0_0{
            display: none;
        }
        li.li-message {
            background: #ffe9cf;
        }
        .box-message {
            max-height: 400px;
            overflow-y: scroll;
            overflow-x: hidden;
            border: 1px solid #dedede;
            padding: 20px;
            border-radius: 7px;
        }
        .box-message p {
            display: inline-block;
            border-radius: 10px;
            max-width: 450px;
            text-align: right;
        }
        .scrollbar
        {
            float: left;
            height: 600px;
            width: 100%;
            overflow-y: scroll;
            margin-bottom: 25px;
            background: #fafafa;
        }

        .force-overflow
        {
            min-height: 450px;
        }

        /*
 *  STYLE 6
 */

        #style-6::-webkit-scrollbar-track
        {
            -webkit-box-shadow: inset 0 0 6px rgba(0,0,0,0.3);
            background-color: #F5F5F5;
        }

        #style-6::-webkit-scrollbar
        {
            width: 10px;
            background-color: #F5F5F5;
        }

        #style-6::-webkit-scrollbar-thumb
        {
            background-color: #13a9a0;
            background-image: -webkit-linear-gradient(45deg,
            rgba(255, 255, 255, .2) 25%,
            transparent 25%,
            transparent 50%,
            rgba(255, 255, 255, .2) 50%,
            rgba(255, 255, 255, .2) 75%,
            transparent 75%,
            transparent);
        }

        .btn-send-message {
            background-color: #13a9a0;
            border-color: #0a7d77;
            color: #fff;
        }
    </style>
@endsection

@section('content')
    {{--<div class="row back-url">--}}
        {{--<div class="col-md-12">--}}
            {{--@if(auth()->user()->role_id == 1)--}}
                {{--<a class="" href="{{ route('AdminDashboard') }}">صفحه اصلی</a><span class="now-url"> / نمایش مخاطبین</span>--}}
            {{--@else--}}
                {{--<a class="" href="{{ route('UserDashboard') }}">صفحه اصلی</a><span class="now-url"> / نمایش مخاطبین</span>--}}
            {{--@endif--}}
        {{--</div>--}}
    {{--</div>--}}
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
                    <h3 class="panel-title">نمایش مخاطبین</h3>

                </div>
                <div class="panel-body">
                    <div class="row">
                        <div class="col-md-3">
                            <div class="row">
                                @foreach($array_user as $key => $value)
                                    <div class="col-md-12">
                                        <div class="form-group">
                                            <a class="btn btn-block btn-default read-message" data-id="{{$value['id']}}">{{$value['name']}}</a>
                                        </div>
                                    </div>
                                @endforeach
                            </div>
                        </div>
                        <div class="col-md-9">
                            <div id="ExtraContent"></div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection


@section('script')
    <script src="{{asset('frontend/js/script.js')}}" type="text/javascript"></script>
    <script type="text/javascript" src="{{asset('backend/js/jquery.dataTables.min.js')}}"></script>
    <script type="text/javascript" src="{{asset('backend/js/TableTools.min.js')}}"></script>
    <script type="text/javascript" src="{{asset('backend/js/dataTables.bootstrap.js')}}"></script>
    <script type="text/javascript" src="{{asset('backend/js/editable-datatables.js')}}"></script>

    <script>
        $('.read-message').click(function () {
            $.ajax({
                url: "{{ url('read/message').'/'}}" + $(this).attr('data-id'),
                method: "get",
            }).done(function (returnData) {
                $('#ExtraContent').html(returnData);
            });
        });
    </script>

    

@endsection