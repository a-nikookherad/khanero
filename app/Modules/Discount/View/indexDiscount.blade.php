@extends('backend.MasterPage.Layout')
@section('title')
    ویلا :: نمایش تخفیفات
@endsection

@section('style')
    <link rel="stylesheet" href="{{asset('backend/css/dataTables.bootstrap.css')}}">
    <link rel="stylesheet" href="{{asset('backend/css/TableTools.css')}}">
    <style>
        #ToolTables_DataTables_Table_0_0{
            display: none;
        }
    </style>
    <link rel="stylesheet" href="{{ asset('backend/css/bootstrap-datepicker.min.css')}}"/>
@endsection

@section('content')
    <div class="row back-url">
        <div class="col-md-12">
            <a class="" href="{{ route('UserDashboard') }}">صفحه اصلی</a><span class="now-url"> / نمایش تخفیفات</span>
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
                    <h3 class="panel-title">نمایش تخفیفات</h3>
                </div>
                <div class="panel-body">
                    <form role="form" action="{{ route('StoreDiscount') }}" method="post" enctype="multipart/form-data" id="FormCreateDiscount">
                        {{ csrf_field() }}
                        <div class="row">
                            <div class="col-md-3">
                                <div class="form-group">
                                    <select name="host_id" id="SelectHost" class="form-control">
                                        @foreach($hostModel as $key => $value)
                                            <option value="{{$value->id}}">{{$value->name}}</option>
                                        @endforeach
                                    </select>
                                </div>
                                @if($errors->has('host_id'))
                                    <span style="color:red;">{{ $errors->first('host_id') }}</span>
                                @endif
                            </div>
                            <div class="col-md-6">
                                <div class="form-group">
                                    شما میتوانید برای
                                    <input type="text" style="width: 40px;display: inline-block;" id="InputDayDiscount" value="{{ old('number_days') }}" name="number_days" maxlength="2" class="text-center form-control" placeholder="00" />
                                    روز
                                    <input type="text" style="width: 40px;display: inline-block;" id="InputNumberPercent" value="{{ old('percent') }}" name="percent" maxlength="2" class="text-center form-control" placeholder="00" />
                                    درصد تخفیف بگیرید
                                    <button type="submit" id="BtnCreateDiscount" class="btn btn-success ">ثبت</button>

                                </div>
                                @if($errors->has('price'))
                                    <span style="color:red;">{{ $errors->first('price') }}</span>
                                @endif
                            </div>
                            <div class="col-md-3">
                                <label for="BtnCreateDiscount">&nbsp;</label>
                            </div>
                        </div>
                    </form>

                    <div class="row">
                        <div class="col-md-12">
                            <hr />
                        </div>
                    </div>

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
                    {{--edit menu modal--}}
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


        $("#InputDateDiscount").datepicker({
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


    </script>
@endsection