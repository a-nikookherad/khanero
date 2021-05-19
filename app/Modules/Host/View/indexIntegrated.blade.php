@extends('backend.MasterPage.Layout')
@section('title')
    {{TitlePage('نمایش مجتمع ها')}}
@endsection

@section('style')
    <link rel="stylesheet" href="{{asset('backend/css/dataTables.bootstrap.css')}}">
    <link rel="stylesheet" href="{{asset('backend/css/TableTools.css')}}">
    <style>
        #ToolTables_DataTables_Table_0_0{
            display: none;
        }
        .btn-group.pull-right.tabletools-btn {
            display: none;
        }
        .img-advertising {
            width: 20%;
            transition: 0.5s;
        }
        .img-advertising:hover {
            width: 40%;
            transition: 0.5s;
        }
        .border-red {
            border: 1px solid #f17676;
            background: #fff7f7;
        }
        .border-green {
            border: 1px solid #2ece31;
            background: #f7fff7;
        }
        .border-blue {
            border: 1px solid #2ececc;
            background: #f3fdff;
        }
    </style>
@endsection

@section('content')
    {{--<div class="row back-url">--}}
    {{--<div class="col-md-12">--}}
    {{--<a class="" href="{{ route('AdminDashboard') }}">صفحه اصلی</a><span class="now-url"> / نمایش اقامتگاه ها</span>--}}
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
                    <h3 class="panel-title">نمایش مجتمع ها</h3>
                </div>
                <div class="panel-body">
                    <table cellpadding="0" cellspacing="0" border="0"
                           class="table table-striped table-bordered editable-datatable">
                        <thead>
                        <tr>
                            <th>ردیف</th>
                            <th>نام مجتمع</th>
                            <th>تصویر</th>
                            <th>تعداد اقامتگاه</th>
                            <th>ویرایش</th>
                            <th>وضعیت</th>
                            <th>تاریخ ایجاد</th>
                        </tr>
                        </thead>
                        <tbody>
                        @foreach($integratedModel as $key => $value)
                            <tr class="1">
                                <td>
                                    {{ $key+1 }}
                                </td>
                                <td>
                                    {{ $value->title }}
                                </td>
                                <td>
                                    {{--                                                {{dd($value->getGallery[0])}}--}}
                                    <img style="width: 60px;" src="{{asset('Uploaded/Gallery/Integrated/File/'.$value->getGallery[0]->url)}}" />
                                </td>
                                <td>
                                    <button type="button" class="btn btn-default" onclick="ajaxHostIntegrated({{$value->id}})">{{count($value->getHost)}}</button>
                                </td>
                                <td>
                                    <a href="{{route('EditIntegrated', ['id' => $value->id])}}" class="btn btn-default btn-block">
                                        <i class="fa fa-edit"></i>
                                    </a>
                                </td>
                                <td>
                                    <label id="btnActiveIntegrated{{$key+1}}" onclick="ajaxActiveIntegrated('{{ $value->id }}','{{$key+1}}');" class="@if($value->active == 1) btn btn-default btn-block @else btn btn-default btn-block @endif">
                                        @if($value->active == 1) فعال @else غیرفعال @endif
                                    </label>
                                </td>
                                <td>
                                    @php(
                                        $created_date = \Morilog\Jalali\Facades\jDate::forge($value->created_at)->format('Y/m/d')
                                    )
                                    {{ $created_date }}
                                </td>
                            </tr>
                        @endforeach
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>

    <!-- Modal -->
    <div id="myModal" class="modal fade" role="dialog">
        <div class="modal-dialog">

            <!-- Modal content-->
            <div class="modal-content">
                <div class="modal-header">
                    <button type="button" class="close" data-dismiss="modal">&times;</button>
                    <h4 class="modal-title">اقامتگاه ها</h4>
                </div>
                <div class="modal-body">
                    <div id="ExtraIndexHost">

                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-default" data-dismiss="modal">بستن</button>
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


        function ajaxActiveIntegrated(id,idInput) {
            $.ajax({
                url:"{{ url('active/integrated').'/'}}"+id,
                method:"get",
            }).done(function(returnData){
                // console.log(returnData);
                if(returnData == 'active')
                {
                    // console.log('active');
                    $("#btnActiveIntegrated"+idInput).addClass('btn-default');
                    $("#btnActiveIntegrated"+idInput).removeClass('btn-default');
                    $("#btnActiveIntegrated"+idInput).css("transition", "0.5s");
                    $("#btnActiveIntegrated"+idInput).text('');
                    $("#btnActiveIntegrated"+idInput).append('فعال');
                }
                else if(returnData == 'deactive')
                {
                    // console.log('deactive');
                    $("#btnActiveIntegrated"+idInput).addClass('btn-default');
                    $("#btnActiveIntegrated"+idInput).removeClass('btn-default');
                    $("#btnActiveIntegrated"+idInput).css("transition", "0.5s");
                    $("#btnActiveIntegrated"+idInput).text('');
                    $("#btnActiveIntegrated"+idInput).append('غیرفعال');
                }
            });
        }

        function DeleteHost(id) {
            if (confirm("آیا اطمینان از حذف اقامتگاه را دارید؟")) {
                window.location.href = 'http://www.rentt.ir/delete/host/'+id;
            } else {
                console.log('22222222222222');
                return false;
            }
        }



        @if (auth()->user()->role_id == 1)
        function ajaxStatusHost(id,idInput) {
            $.ajax({
                url:"{{ url('status/host').'/'}}"+id,
                method:"get",
            }).done(function(returnData){
                // console.log(returnData);
                if(returnData == '0')
                {
                    // console.log('0');
                    $("#btnStatusHost"+idInput).addClass('border-blue');
                    $("#btnStatusHost"+idInput).removeClass('border-red');
                    $("#btnStatusHost"+idInput).removeClass('border-green');
                    $("#btnStatusHost"+idInput).css("transition", "0.5s");
                    $("#btnStatusHost"+idInput).text('');
                    $("#btnStatusHost"+idInput).append('در انتظار تایید');
                }
                else if(returnData == '1')
                {
                    // console.log('1');
                    $("#btnStatusHost"+idInput).addClass('border-green');
                    $("#btnStatusHost"+idInput).removeClass('border-red');
                    $("#btnStatusHost"+idInput).removeClass('border-blue');
                    $("#btnStatusHost"+idInput).css("transition", "0.5s");
                    $("#btnStatusHost"+idInput).text('');
                    $("#btnStatusHost"+idInput).append('تایید شده');
                }
                else if(returnData == '2')
                {
                    // console.log('2');
                    $("#btnStatusHost"+idInput).addClass('border-red');
                    $("#btnStatusHost"+idInput).removeClass('border-blue');
                    $("#btnStatusHost"+idInput).removeClass('border-green');
                    $("#btnStatusHost"+idInput).css("transition", "0.5s");
                    $("#btnStatusHost"+idInput).text('');
                    $("#btnStatusHost"+idInput).append('تایید نشده');
                }
            });
        }


        function ajaxStatusSuccessHost(id) {
            $.ajax({
                url:"{{ url('status/host/success-sms').'/'}}"+id,
                method:"get",
            }).done(function(returnData){
                // console.log(returnData);
                if(returnData == 'success')
                {
                    // check data and view popup for send sms
                    $.Toast("<p>ارسال پیامک</p>", "<p>پیام تاییدیه با موفقیت ارسال شد .</p>", "success", {
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
            });
        }
        @endif


        function ajaxHostIntegrated(id) {
            var img = '<div class="text-center box-loading"><img style="height:50px;width:auto;" src="{{ asset('backend/img/img_loading/orange_circles.gif') }}" /></div>';
            $('#myModal').modal('show');
            $('#ExtraIndexHost').html(img);

            $.ajax({
                url:"{{ url('index/host-integrated').'/'}}"+id,
                method:"get",
            }).done(function(returnData){
                if(returnData.Success == 1) {
                    $('#ExtraIndexHost').html(returnData.Message.original);
                }
            });
        }

    </script>
@endsection