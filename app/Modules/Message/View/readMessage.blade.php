@extends('backend.MasterPage.Layout')
@section('title', TitlePage('جزئیات پیام'))
@section('style')
    <link rel="stylesheet" href="{{asset('backend/css/dataTables.bootstrap.css')}}">
    <link rel="stylesheet" href="{{asset('backend/css/TableTools.css')}}">
    <style>
        #ToolTables_DataTables_Table_0_0{
            display: none;
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
    <div class="row back-url">
        <div class="col-md-12">
            @if(auth()->user()->role_id == 1)
                <a class="" href="{{ route('AdminDashboard') }}">صفحه اصلی</a><span class="now-url"> / نمایش پیام های ارسالی</span>
            @else
                <a class="" href="{{ route('UserDashboard') }}">صفحه اصلی</a><span class="now-url"> / نمایش پیام های ارسالی</span>
            @endif
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
                    <h3 class="panel-title">نمایش پیام های ارسالی({{$userModel->first_name.' '.$userModel->last_name}})</h3>

                </div>
                <div class="panel-body">
                    <div class="col-md-12">
                        <div class="box-message scrollbar" id="style-6">
                            @foreach($messageModel as $key => $value)
                                <div class="row @if($value->sender_id == auth()->user()->id) text-right @else text-left @endif">
                                    <p class="@if($value->sender_id == auth()->user()->id) text-right bg-success @else text-left bg-info @endif">
                                        {{$value->message}}
                                    </p>
                                    <h6>
                                        {{\Morilog\Jalali\Facades\jDate::forge($value->created_at)->format('Y/m/d - H:i:s')}}
                                    </h6>
                                </div>
                            @endforeach
                            <div id="SendMessageBox">

                            </div>
                            <div id="LinkMessage"></div>
                        </div>
                    </div>
                    <div class="col-md-12">
                        <div class="row">
                            <div class="col-md-2">
                                <div class="row">
                                    <input type="text" id="InputTitleText" class="form-control" placeholder="عنوان پیام" />
                                </div>
                            </div>
                            <div class="col-md-8">
                                <div class="row">
                                    <input type="text" id="InputMessageText" class="form-control" placeholder="متن مورد نظر را بنویسید ..." />
                                </div>
                            </div>
                            <div class="col-md-2">
                                <div class="row">
                                    <a href="#LinkMessage" class="btn btn-block btn-send-message">ارسال<i class="fa fa-location-arrow"></i> </a>
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
    <script src="{{asset('frontend/js/script.js')}}" type="text/javascript"></script>
    <script type="text/javascript" src="{{asset('backend/js/jquery.dataTables.min.js')}}"></script>
    <script type="text/javascript" src="{{asset('backend/js/TableTools.min.js')}}"></script>
    <script type="text/javascript" src="{{asset('backend/js/dataTables.bootstrap.js')}}"></script>
    <script type="text/javascript" src="{{asset('backend/js/editable-datatables.js')}}"></script>



    <script>
        $(".box-message").animate({ scrollTop: $('.box-message').prop("scrollHeight")}, 3000);
        $("body").delegate(".btn-send-message","click",function (e) {
            var title = $('#InputTitleText').val();
            var message = $('#InputMessageText').val();
            var receiver_id = {{$userModel->id}};
            var h = '<div class="row text-right">\n' +
                '        <p class="text-right bg-success">\n' +
                '            '+ message +'\n' +
                '        </p>\n' +
                '        <h6>\n' +
                '            {{\Morilog\Jalali\Facades\jDate::forge(date('Y/m/d H:i:s'))->format('Y/m/d - H:i:s')}} \n' +
                '        </h6>\n' +
                '    </div>';

            $.ajaxSetup({
                headers: {
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                }
            });
            $.ajax({
                url: '{{route('StoreMessage')}}',
                type: 'post',
                data: {
                    title:title,
                    message:message,
                    receiver_id:receiver_id,
                },
                success: function (data) {
                    if(data.Success == 1) {
                        $('#SendMessageBox').append(h);
                        $.Toast("<p>پیام</p>", "<p>"+ data.Message +" .</p>", "success", {
                            has_icon: true,
                            has_close_btn: true,
                            stack: true,
                            fullscreen: false,
                            timeout: 4000,
                            sticky: false,
                            has_progress: true,
                            rtl: true,
                        });
                        $('#InputTitleText').val("");
                        $('#InputMessageText').val("");
                    } else {
                        $.Toast("<p>پیام</p>", "<p>"+ data.Message +" .</p>", "warning", {
                            has_icon: true,
                            has_close_btn: true,
                            stack: true,
                            fullscreen: false,
                            timeout: 4000,
                            sticky: false,
                            has_progress: true,
                            rtl: true,
                        });
                    }
                }
            });

        });
    </script>

@endsection