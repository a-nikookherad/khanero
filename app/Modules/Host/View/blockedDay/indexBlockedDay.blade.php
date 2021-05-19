@extends('backend.MasterPage.Layout')
@section('title')
    ویلا :: نمایش روزهای مسدود شده
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
            <a class="" href="{{ route('AdminDashboard') }}">صفحه اصلی</a><span class="now-url"> / نمایش روزهای مسدود شده</span>
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
                    <h3 class="panel-title">نمایش روزهای مسدود شده</h3>
                </div>
                <div class="panel-body">
                    <form role="form" action="{{ route('StoreBlockedDays') }}" method="post" enctype="multipart/form-data" id="FormCreateBlockedDay">
                        {{ csrf_field() }}
                        <div class="row">
                            <div class="col-md-3">
                                <div class="form-group">
                                    <label for="SelectHost">اقامتگاه</label><span style="font-size: 18px;" class="text-danger">*</span>
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
                            <div class="col-md-3">
                                <div class="form-group">
                                    <label for="InputTitleBlockedDay">تاریخ</label><span style="font-size: 18px;" class="text-danger">*</span>
                                    <input type="text" readonly style="cursor: pointer;" value="{{ old('date') }}" name="date" id="InputDateBlockedDay" class="form-control" placeholder="تاریخ مورد نظر را وارد کنید" />
                                </div>
                                @if($errors->has('date'))
                                    <span style="color:red;">{{ $errors->first('date') }}</span>
                                @endif
                            </div>
                            <div class="col-md-3">
                                <label for="BtnCreateBlockedDay">&nbsp;</label>
                                <button type="submit" id="BtnCreateBlockedDay" class="btn btn-success btn-block ">ثبت</button>
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
                            <th>تاریخ مسدود شده</th>
                            <th>حذف</th>
                            <th>تاریخ ثبت</th>
                        </tr>
                        </thead>
                        <tbody>
                        @foreach($blockedDayModel as $key => $value)
                            <tr class="1">
                                <td>
                                    {{ $key+1 }}
                                </td>
                                <td>
                                    {{$value->getHost->name}}
                                </td>
                                <td>
                                    @php(
                                        $date = \Morilog\Jalali\Facades\jDate::forge($value->date)->format('Y/m/d')
                                    )
                                    {{ $date }}
                                </td>
                                <td>
                                    <label data-toggle="modal" data-target="#myModal" onclick="ajaxDeleteBlockedDay('{{$value->id}}');" class="btn btn-default btn-block">
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
                                    <h4 class="modal-title">حذف تاریخ</h4>
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


        $("#InputDateBlockedDay").datepicker({
            minDate: 0,
            changeMonth: true,
            changeYear: true,
            isRTL: true,
            dateFormat: "yy/mm/dd",
            EnableTimePicker: true,
        });

        function ajaxDeleteBlockedDay(id) {
            // console.log(id);
            var img = '<div class="text-center"><img style="height:50px;width:auto;" src="{{ asset('backend/img/img_loading/orange_circles.gif') }}" /></div>';
            $('#ExtraModalEdit').html(img);
            $.ajax({
                url:"{{ url('delete/blocked-days').'/'}}"+id,
                method:"get",
            }).done(function(returnData) {
                $('#ExtraModalEdit').html(returnData);
            })
        }

    </script>
@endsection