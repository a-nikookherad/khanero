@extends('backend.MasterPage.Layout')
@section('title', TitlePage('نظرات و امتیازات'))
@section('style')
    <link rel="stylesheet" href="{{asset('backend/css/dataTables.bootstrap.css')}}">
    <link rel="stylesheet" href="{{asset('backend/css/TableTools.css')}}">
    <style>
        #ToolTables_DataTables_Table_0_0{
            display: none;
        }
        .img-host {
            width: 50%;
            transition: 0.5s;
        }
        .img-host:hover {
            width: 100%;
            transition: 0.5s;
        }
        li.li-comment {
            background: #ffe9cf;
        }
    </style>
    <link rel="stylesheet" href="{{ asset('backend/css/bootstrap-datepicker.min.css')}}"/>
@endsection

@section('content')
    <div class="row back-url">
        <div class="col-md-12">
            <a class="" href="@if(auth()->user()->role_id == 1) {{ route('AdminDashboard') }} @else {{ route('UserDashboard') }} @endif">صفحه اصلی</a><span class="now-url"> / اقامتگاه های رزرو شده</span>
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
                    <h3 class="panel-title">اقامتگاه های رزرو شده</h3>
                </div>
                <div class="panel-body">
                    <table cellpadding="0" cellspacing="0" border="0"
                           class="table table-bordered editable-datatable">
                        <thead>
                        <tr>
                            <th>ردیف</th>
                            <th>اطلاعات اقامتگاه</th>
                            <th>اطلاعات میهمان</th>
                            <th>مشاهده نظرات و امتیازات</th>
                            <th>میانگین امتیازات</th>
                            <th>وضعیت</th>
                            <th>تاریخ ثبت</th>
                        </tr>
                        </thead>
                        <tbody>
                        @foreach($rateModel as $key => $value)
                            <tr class="1">
                                <td>
                                    {{ $key+1 }}
                                </td>
                                <td>
                                    <button data-toggle="modal" data-target="#detailHostModal" onclick="AjaxDetailHost({{$value->id}})" class="btn btn-default btn-block" >
                                        <span class="text-info"><i class="fa fa-info-circle"></i> {{$value->getHost->name}}  </span>
                                    </button>
                                </td>
                                <td>
                                    <button data-toggle="modal" data-target="#detailGuestModal" onclick="AjaxDetailGuest({{$value->id}})" class="btn btn-default btn-block" >
                                        <span class="text-info"><i class="fa fa-info-circle"></i> {{$value->getUser->first_name.' '.$value->getUser->last_name}}  </span>
                                    </button>
                                </td>
                                <td>
                                    <button data-toggle="modal" data-target="#detailCommentAndRateModal" onclick="AjaxCommentAndRate({{$value->id}})" class="btn btn-default btn-block" >
                                        <span class="text-success"><i class="fa fa-star-o"></i><i class="fa fa-star-o"></i><i class="fa fa-star-half-o"></i><i class="fa fa-star"></i><i class="fa fa-star"></i></span>
                                    </button>
                                </td>
                                <td class="text-center">
                                    @php
                                        $avg = ($value->rate1+$value->rate2+$value->rate3+$value->rate4+$value->rate5)/5;
                                    @endphp
                                    <span class="event_star{{$key+1}} star_big" data-starnum="{{$key+1}}">
                                       <i></i>
                                    </span>
                                    <style>
                                        .star_big[data-starnum="{{$key+1}}"] i {
                                            width: {{$avg*30}}px;
                                        }
                                    </style>
                                </td>
                                <td>
                                    <button id="btnActiveComment{{$key+1}}" onclick="ajaxActiveComment('{{ $value->id }}','{{$key+1}}');" class="btn btn-default btn-block">
                                        @if($value->status == 1) <i class="fa fa-check text-success"></i> @else <i class="fa fa-plus text-danger" style="transform: rotate(45deg)"></i> @endif
                                    </button>
                                </td>
                                <td>
                                    @php(
                                        $date = \Morilog\Jalali\Facades\jDate::forge($value->reserve_date)->format('Y/m/d')
                                    )
                                    {{ $date }}
                                </td>
                            </tr>
                        @endforeach
                        </tbody>
                    </table>


                    {{-- detail host modal --}}
                    <div class="modal fade" id="detailHostModal" role="dialog">
                        <div class="modal-dialog modal-md">
                            <!-- Modal content -->
                            <div class="modal-content">
                                <div class="modal-header">
                                    <button type="button" class="close" data-dismiss="modal">&times;</button>
                                    <h4 class="modal-title">مشخصات اقامتگاه</h4>
                                </div>
                                <div class="modal-body" id="ExtraModalDetailHost">

                                </div>
                            </div>
                        </div>
                    </div>


                    {{-- detail host modal --}}
                    <div class="modal fade" id="detailGuestModal" role="dialog">
                        <div class="modal-dialog modal-md">
                            <!-- Modal content -->
                            <div class="modal-content">
                                <div class="modal-header">
                                    <button type="button" class="close" data-dismiss="modal">&times;</button>
                                    <h4 class="modal-title">مشخصات مهمان</h4>
                                </div>
                                <div class="modal-body" id="ExtraModalDetailGuest">

                                </div>
                            </div>
                        </div>
                    </div>


                    {{-- detail rate and comment modal --}}
                    <div class="modal fade" id="detailCommentAndRateModal" role="dialog">
                        <div class="modal-dialog modal-md">
                            <!-- Modal content -->
                            <div class="modal-content">
                                <div class="modal-header">
                                    <button type="button" class="close" data-dismiss="modal">&times;</button>
                                    <h4 class="modal-title">مشاهده نظرات و امتیازات</h4>
                                </div>
                                <div class="modal-body" id="ExtraModalRateAndComment">

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
    <script src="{{asset('backend/js/bootstrap-datepicker.min.js')}}"></script>
    <script src="{{asset('backend/js/bootstrap-datepicker.fa.min.js')}}"></script>

    <script>



        function ajaxActiveComment(id,idInput) {
            $.ajax({
                url:"{{ url('active/comment-rate').'/'}}"+id,
                method:"get",
            }).done(function(returnData){
                if(returnData == 'active')
                {
                    // console.log('active');
                    $("#btnActiveComment"+idInput).addClass('btn-default');
                    $("#btnActiveComment"+idInput).removeClass('btn-default');
                    $("#btnActiveComment"+idInput).css("transition", "0.5s");
                    $("#btnActiveComment"+idInput).text('');
                    $("#btnActiveComment"+idInput).append('<i class="fa fa-check text-success"></i>');
                }
                else if(returnData == 'deActive')
                {
                    // console.log('deActive');
                    $("#btnActiveComment"+idInput).addClass('btn-default');
                    $("#btnActiveComment"+idInput).removeClass('btn-default');
                    $("#btnActiveComment"+idInput).css("transition", "0.5s");
                    $("#btnActiveComment"+idInput).text('');
                    $("#btnActiveComment"+idInput).append('<i class="fa fa-plus text-danger" style="transform: rotate(45deg)"></i>');
                }
            });
        }


        function AjaxDetailHost(id) {
            var img = '<div class="text-center"><img style="height:50px;width:auto;" src="{{ asset('backend/img/img_loading/orange_circles.gif') }}" /></div>';
            $('#ExtraModalDetailHost').html(img);
            $.ajax({
                url:"{{ url('get/detail-host').'/'}}"+id,
                method:"get",
            }).done(function(returnData) {
                console.log(returnData);
                $('#ExtraModalDetailHost').html(returnData);
            })
        }


        function AjaxDetailGuest(id) {
            var img = '<div class="text-center"><img style="height:50px;width:auto;" src="{{ asset('backend/img/img_loading/orange_circles.gif') }}" /></div>';
            $('#ExtraModalDetailGuest').html(img);
            $.ajax({
                url:"{{ url('get/detail-guest').'/'}}"+id,
                method:"get",
            }).done(function(returnData) {
                console.log(returnData);
                $('#ExtraModalDetailGuest').html(returnData);
            })
        }


        function AjaxCommentAndRate(id) {
            var img = '<div class="text-center"><img style="height:50px;width:auto;" src="{{ asset('backend/img/img_loading/orange_circles.gif') }}" /></div>';
            $('#ExtraModalRateAndComment').html(img);
            $.ajax({
                url:"{{ url('get/comment-rate').'/'}}"+id,
                method:"get",
            }).done(function(returnData) {
                console.log(returnData);
                $('#ExtraModalRateAndComment').html(returnData);
            })
        }

    </script>
@endsection