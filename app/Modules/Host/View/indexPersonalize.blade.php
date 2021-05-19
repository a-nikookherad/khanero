@extends('backend.MasterPage.Layout')
@section('title', TitlePage('شخصی سازی روزها'))
@section('style')
    <link rel="stylesheet" href="{{asset('backend/css/dataTables.bootstrap.css')}}">
    <link rel="stylesheet" href="{{asset('backend/css/TableTools.css')}}">
    <style>
        #ToolTables_DataTables_Table_0_0{
            display: none;
        }
        .tabletools-btn {
            display: none;
        }
        .panel-title {
            cursor: pointer;
            color: #666;
        }

        .panel-success > .panel-heading {
            background-color: #dadada;
        }

        .panel-success > .panel-heading i {
            color: #666;
        }
        .box-calendar-special {
            max-height: 345px;
            overflow-y: scroll;
        }
        #InputPrice {
            display: none;
        }
        span.host-name {
            margin: 0px 10px;
            color: #a2a2a2;
            font-size: 12px;
        }
    </style>
    <link rel="stylesheet" href="{{ asset('backend/css/bootstrap-datepicker.min.css')}}"/>
@endsection

@section('content')
{{--    <div class="row back-url">--}}
{{--        <div class="col-md-12">--}}
{{--            <a class="" href="{{ route('UserDashboard') }}">صفحه اصلی</a> /--}}
{{--            <a class="" href="{{ route('IndexHost') }}">اقامتگاه های من</a>--}}
{{--            <span class="now-url"> / شخصی سازی روزها</span>--}}
{{--        </div>--}}
{{--    </div>--}}
    <div class="row">
        <div class="col-md-12">
            @include('message.Message')
            @include('message.ErrorReporting')
        </div>
    </div>
{{--    <div class="row">--}}
{{--        <div class="col-md-12">--}}
{{--            <div class="panel panel-default">--}}
{{--                <div class="panel-heading">--}}
{{--                    <h3 class="panel-title">ثبت تخفیفات</h3>--}}
{{--                </div>--}}
{{--                <div class="panel-body">--}}
{{--                    <form role="form" action="{{ route('StoreDiscount') }}" method="post" enctype="multipart/form-data" id="FormCreateDiscount">--}}
{{--                        {{ csrf_field() }}--}}
{{--                        <input type="hidden" name="host_id" value="{{$hostModel->id}}" />--}}
{{--                        <div class="row">--}}
{{--                            <div class="col-md-6">--}}
{{--                                <div class="form-group">--}}
{{--                                    شما میتوانید برای--}}
{{--                                    <input type="text" style="width: 40px;display: inline-block;" id="InputDayDiscount" value="{{ old('number_days') }}" name="number_days" maxlength="2" class="text-center form-control" placeholder="00" />--}}
{{--                                    روز--}}
{{--                                    <input type="text" style="width: 40px;display: inline-block;" id="InputNumberPercent" value="{{ old('percent') }}" name="percent" maxlength="2" class="text-center form-control" placeholder="00" />--}}
{{--                                    درصد تخفیف بگیرید--}}
{{--                                    <button type="submit" id="BtnCreateDiscount" class="btn btn-success ">ثبت</button>--}}

{{--                                </div>--}}
{{--                                @if($errors->has('price'))--}}
{{--                                    <span style="color:red;">{{ $errors->first('price') }}</span>--}}
{{--                                @endif--}}
{{--                            </div>--}}
{{--                            <div class="col-md-3">--}}
{{--                                <label for="BtnCreateDiscount">&nbsp;</label>--}}
{{--                            </div>--}}
{{--                        </div>--}}
{{--                    </form>--}}

{{--                    <div class="row">--}}
{{--                        <div class="col-md-12">--}}
{{--                            <hr />--}}
{{--                        </div>--}}
{{--                    </div>--}}
{{--                </div>--}}
{{--            </div>--}}
{{--        </div>--}}
{{--    </div>--}}




    <div class="row">
        <div class="col-md-12">
            <div class="panel panel-default">
                <div class="panel-heading">
                    <h3 class="panel-title">شخصی سازی روزهای تقویم<span class="host-name">({{$hostModel->name}})</span></h3>
                </div>
                <div class="panel-bodys">
                    <br />
                    <div class="col-md-12">
                        <table cellpadding="0" cellspacing="0" border="0"
                               class="table table-striped table-bordered editable-datatable">
                            <thead>
                            <tr>
                                <th>ردیف</th>
                                <th>نام اقامتگاه</th>
                                <th>تعداد روز</th>
                                <th>درصد تخفیف %</th>
                                <th>قیمت روز</th>
                                <th>حذف</th>
                                <th>تاریخ ثبت</th>
                            </tr>
                            </thead>
                            <tbody>
                            @foreach($discountModel as $key => $value)
                                <tr class="1">
                                    <td>
                                        {{ $key+1 }}
                                    </td>
                                    <td>
                                        {{$value->getHost->name}}
                                    </td>
                                    <td>
                                        {{ $value->number_days }}
                                    </td>
                                    <td>
                                        {{ $value->percent }}
                                    </td>
                                    <td>
                                        <label data-toggle="modal" data-target="#myModal" onclick="ajaxEditPrice('{{$value->id}}');" class="btn btn-default btn-block">
                                            <i class="fa fa-edit"></i>
                                        </label>
                                    </td>
                                    <td>
                                        <label data-toggle="modal" data-target="#myModal" onclick="ajaxDeleteDiscount('{{$value->id}}');" class="btn btn-default btn-block">
                                            <i class="fa fa-trash-o"></i>
                                        </label>
                                    </td>
                                    <td>
                                        @php(
                                            $created_date = \Morilog\Jalali\Facades\jDate::forge($value->created_at)->format('Y/m/d - H:i:s')
                                        )
                                        {{ $created_date }}
                                    </td>
                                </tr>
                            @endforeach
                            </tbody>

                        </table>
                        {{--                    edit menu modal--}}
                        <div class="modal fade" id="myModal" role="dialog">
                            <div class="modal-dialog modal-md">
                                <!-- Modal content-->
                                <div class="modal-content">
                                    <div class="modal-header">
                                        <button type="button" class="close" data-dismiss="modal">&times;</button>
                                        <h4 class="modal-title">ثبت تغییرات</h4>
                                    </div>
                                    <div class="modal-body" id="ExtraModalEdit">

                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <form role="form" action="{{ route('StorePersonalizeHost') }}" method="post" enctype="multipart/form-data" id="FormCreateSpecial">
                        {{ csrf_field() }}
                        <input type="hidden" value="{{$hostModel->id}}" name="host_id" />
                        <div class="row">
                            <div class="col-md-4 col-md-offset-4">
                                {!! $calendar !!}
                                <div class="row">
                                        <div class="form-group">
                                            <input class="form-control" name="date_from" id="InputDateFrom" placeholder="از تاریخ">
                                        </div>
                                        <div class="form-group">
                                            <input class="form-control" name="date_to" id="InputDateTo" placeholder="تا تاریخ">
                                        </div>
                                        <div class="form-group">
                                            <select class="form-control" name="type" id="SelectType">
                                                <option value="block">مسدود سازی</option>
                                                <option value="unblock">آزاد سازی</option>
                                                <option value="special">روز ویژه</option>
                                            </select>
                                        </div>
                                        <div class="form-group">
                                            <input class="form-control" name="price" id="InputPrice" placeholder="قیمت">
                                        </div>
                                        <div class="form-group">
                                            <button type="submit" id="" class="btn btn-block">ویرایش اطلاعات</button>
                                        </div>
                                </div>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>





    {{--<div class="row">--}}
        {{--<div class="col-md-12">--}}
            {{--<div class="panel panel-default">--}}
                {{--<div class="panel-heading">--}}
                    {{--<h3 class="panel-title">نمایش روزهای مسدود شده</h3>--}}
                {{--</div>--}}
                {{--<div class="panel-body">--}}
                    {{--<form role="form" action="{{ route('StoreBlockedDays') }}" method="post" enctype="multipart/form-data" id="FormCreateBlockedDay">--}}
                        {{--{{ csrf_field() }}--}}
                        {{--<input type="hidden" value="{{$hostModel->id}}" name="host_id" />--}}
                        {{--<div class="row">--}}
                            {{--<div class="col-md-3">--}}
                                {{--<div class="form-group">--}}
                                    {{--<label for="InputTitleBlockedDay">تاریخ</label><span style="font-size: 18px;" class="text-danger">*</span>--}}
                                    {{--<input type="text" readonly style="cursor: pointer;" value="{{ old('date') }}" name="date" id="InputDateBlockedDay" class="form-control" placeholder="تاریخ مورد نظر را وارد کنید" />--}}
                                {{--</div>--}}
                                {{--@if($errors->has('date'))--}}
                                    {{--<span style="color:red;">{{ $errors->first('date') }}</span>--}}
                                {{--@endif--}}
                            {{--</div>--}}
                            {{--<div class="col-md-3">--}}
                                {{--<label for="BtnCreateBlockedDay">&nbsp;</label>--}}
                                {{--<button type="submit" id="BtnCreateBlockedDay" class="btn btn-success btn-block ">ثبت</button>--}}
                            {{--</div>--}}
                        {{--</div>--}}
                    {{--</form>--}}

                    {{--<div class="row">--}}
                        {{--<div class="col-md-12">--}}
                            {{--<hr />--}}
                        {{--</div>--}}
                    {{--</div>--}}

                    {{--<table cellpadding="0" cellspacing="0" border="0"--}}
                           {{--class="table table-striped table-bordered editable-datatable">--}}
                        {{--<thead>--}}
                        {{--<tr>--}}
                            {{--<th>ردیف</th>--}}
                            {{--<th>نام اقامتگاه</th>--}}
                            {{--<th>تاریخ مسدود شده</th>--}}
                            {{--<th>حذف</th>--}}
                            {{--<th>تاریخ ثبت</th>--}}
                        {{--</tr>--}}
                        {{--</thead>--}}
                        {{--<tbody>--}}
                        {{--@foreach($blockedDayModel as $key => $value)--}}
                            {{--<tr class="1">--}}
                                {{--<td>--}}
                                    {{--{{ $key+1 }}--}}
                                {{--</td>--}}
                                {{--<td>--}}
                                    {{--{{$value->getHost->name}}--}}
                                {{--</td>--}}
                                {{--<td>--}}
                                    {{--@php(--}}
                                        {{--$date = \Morilog\Jalali\Facades\jDate::forge($value->date)->format('Y/m/d')--}}
                                    {{--)--}}
                                    {{--{{ $date }}--}}
                                {{--</td>--}}
                                {{--<td>--}}
                                    {{--<label data-toggle="modal" data-target="#myModal" onclick="ajaxDeleteBlockedDay('{{$value->id}}');" class="btn btn-default btn-block">--}}
                                        {{--<i class="fa fa-trash-o"></i>--}}
                                    {{--</label>--}}
                                {{--</td>--}}
                                {{--<td>--}}
                                    {{--@php(--}}
                                        {{--$created_date = \Morilog\Jalali\Facades\jDate::forge($value->created_at)->format('Y/m/d - H:i:s')--}}
                                    {{--)--}}
                                    {{--{{ $created_date }}--}}
                                {{--</td>--}}
                            {{--</tr>--}}
                        {{--@endforeach--}}
                        {{--</tbody>--}}

                    {{--</table>--}}
                    {{--edit menu modal--}}
                    {{--<div class="modal fade" id="myModal" role="dialog">--}}
                        {{--<div class="modal-dialog modal-md">--}}
                            {{--<!-- Modal content-->--}}
                            {{--<div class="modal-content">--}}
                                {{--<div class="modal-header">--}}
                                    {{--<button type="button" class="close" data-dismiss="modal">&times;</button>--}}
                                    {{--<h4 class="modal-title">حذف تاریخ</h4>--}}
                                {{--</div>--}}
                                {{--<div class="modal-body" id="ExtraModalEdit">--}}

                                {{--</div>--}}
                            {{--</div>--}}
                        {{--</div>--}}
                    {{--</div>--}}
                {{--</div>--}}
            {{--</div>--}}
        {{--</div>--}}
    {{--</div>--}}


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


        $(document).ready(function () {

            $('.panel-body').slideToggle("slow");

        });


        // $("#InputDateSpecial").datepicker({
        //     minDate: 0,
        //     changeMonth: true,
        //     changeYear: true,
        //     isRTL: true,
        //     dateFormat: "yy/mm/dd",
        //     EnableTimePicker: true,
        // });


        $("#InputDateBlockedDay").datepicker({
            minDate: 0,
            changeMonth: true,
            changeYear: true,
            isRTL: true,
            dateFormat: "yy/mm/dd",
            EnableTimePicker: true,
        });

        function ajaxEditPrice(id) {
            // console.log(id);
            var img = '<div class="text-center"><img style="height:50px;width:auto;" src="{{ asset('backend/img/img_loading/orange_circles.gif') }}" /></div>';
            $('#ExtraModalEdit').html(img);
            $.ajax({
                url:"{{ url('edit/discount').'/'}}"+id,
                method:"get",
            }).done(function(returnData) {
                $('#ExtraModalEdit').html(returnData);
            })
        }

        function ajaxDeleteDiscount(id) {
            // console.log(id);
            var img = '<div class="text-center"><img style="height:50px;width:auto;" src="{{ asset('backend/img/img_loading/orange_circles.gif') }}" /></div>';
            $('#ExtraModalEdit').html(img);
            $.ajax({
                url:"{{ url('delete/discount').'/'}}"+id,
                method:"get",
            }).done(function(returnData) {
                $('#ExtraModalEdit').html(returnData);
            })
        }


        $('#SelectType').change(function () {
            if($(this).val() == 'special') {
                $('#InputPrice').css('display', 'block');
            } else {
                $('#InputPrice').css('display', 'none');
            }
        });




        //Panel options for removing and minimising panels
        $('.panel-options .fa-chevron-down').click(function(){
            $(this).parents('.panel').children('.panel-body').slideToggle("slow");
        });

        //Panel options for removing and minimising panels
        $('.panel-title').click(function(){
            $(this).parents('.panel').children('.panel-body').slideToggle("slow");
        });

    </script>
@endsection