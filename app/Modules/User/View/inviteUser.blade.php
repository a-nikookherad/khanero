@extends('backend.MasterPage.Layout')
@section('title',TitlePage('دعوت از دوستان'))
@section('style')

    <link rel="stylesheet" href="{{asset('backend/css/dataTables.bootstrap.css')}}">
    <link rel="stylesheet" href="{{asset('backend/css/TableTools.css')}}">
    <style>
        #ToolTables_DataTables_Table_0_0{
            display: none;
        }
        li.li-invite {
            background: #ffe9cf;
        }
    </style>
@endsection
@section('content')
    <div class="row back-url">
        <div class="col-md-12">
            <a class="" href="{{ route('AdminDashboard') }}">صفحه اصلی</a>
            <span class="now-url"> / دعوت از دوستان</span>
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
                    <h3 class="panel-title">دعوت از دوستان</h3>

                </div>
                <div class="panel-body">
                    <div class="row">
                        <div class="col-md-12">
                            @if(auth()->user()->parent_id != 0)
                                معرف شما : {{GetUserById(auth()->user()->parent_id)->first_name. ' ' .GetUserById(auth()->user()->parent_id)->last_name}}
                            @endif
                        </div>
                        <div class="col-md-12">
                            برای کپی کردن بر روی لینک کلیک کنید
                            <p onclick="copyToClipboard(this)" class="btn btn-default">{{route('InviteFriend', ['code' => GenerateCodeIntroduction(auth()->user()->id)])}}</p>
                            <span class="text-copy"></span>
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
        function copyToClipboard(element) {
            var $temp = $("<input>");
            $("body"). append($temp);
            $temp. val($(element). html()). select();
            document. execCommand("copy");
            $temp. remove();
            $('.text-copy').html('کپی شد');
        }
    </script>
@endsection
