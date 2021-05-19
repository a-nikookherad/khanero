@extends('backend.MasterPage.Layout')
@section('title')
    ویلا :: نمایش روزهای خاص
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
            <a class="" href="{{ route('UserDashboard') }}">صفحه اصلی</a><span class="now-url"> / نمایش روزهای خاص</span>
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
                    <h3 class="panel-title">نمایش روزهای خاص</h3>
                </div>
                <div class="panel-body">
                    <form role="form" action="{{ route('StoreSpecial') }}" method="post" enctype="multipart/form-data" id="FormCreateSpecial">
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
                                    <label for="InputTitleSpecial">تاریخ</label><span style="font-size: 18px;" class="text-danger">*</span>
                                    <input type="text" readonly style="cursor: pointer;" value="{{ old('date') }}" name="date" id="InputDateSpecial" class="form-control" placeholder="تاریخ مورد نظر را وارد کنید" />
                                </div>
                                @if($errors->has('date'))
                                    <span style="color:red;">{{ $errors->first('date') }}</span>
                                @endif
                            </div>
                            <div class="col-md-3">
                                <div class="form-group">
                                    <label for="InputTitleSpecial">قیمت</label><span style="font-size: 18px;" class="text-danger">*</span>
                                    <input type="text" id="InputPriceSpecial" onkeyup="Seprator(this);" value="{{ old('price') }}" name="price" maxlength="9" class="form-control text-center" placeholder="قیمت" />
                                </div>
                                @if($errors->has('price'))
                                    <span style="color:red;">{{ $errors->first('price') }}</span>
                                @endif
                            </div>
                            <div class="col-md-3">
                                <label for="BtnCreateSpecial">&nbsp;</label>
                                <button type="submit" id="BtnCreateSpecial" class="btn btn-success btn-block ">ثبت</button>
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
                            <th>تاریخ روز خاص</th>
                            <th>قیمت</th>
                            <th>قیمت روز</th>
                            <th>حذف</th>
                            <th>تاریخ ثبت</th>
                        </tr>
                        </thead>
                        <tbody>
                        @foreach($specialModel as $key => $value)
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
                                    {{ $value->price }}
                                </td>
                                <td>
                                    <label data-toggle="modal" data-target="#myModal" onclick="ajaxEditPrice('{{$value->id}}');" class="btn btn-default btn-block">
                                        <i class="fa fa-edit"></i>
                                    </label>
                                </td>
                                <td>
                                    <label data-toggle="modal" data-target="#myModal" onclick="ajaxDeleteSpecial('{{$value->id}}');" class="btn btn-default btn-block">
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
    <script type="text/javascript" src="{{asset('backend/js/number.js')}}"></script>

    <script>


        $("#InputDateSpecial").datepicker({
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
                url:"{{ url('edit/special').'/'}}"+id,
                method:"get",
            }).done(function(returnData) {
                $('#ExtraModalEdit').html(returnData);
            })
        }

        function ajaxDeleteSpecial(id) {
            // console.log(id);
            var img = '<div class="text-center"><img style="height:50px;width:auto;" src="{{ asset('backend/img/img_loading/orange_circles.gif') }}" /></div>';
            $('#ExtraModalEdit').html(img);
            $.ajax({
                url:"{{ url('delete/special').'/'}}"+id,
                method:"get",
            }).done(function(returnData) {
                $('#ExtraModalEdit').html(returnData);
            })
        }
        
    </script>
@endsection