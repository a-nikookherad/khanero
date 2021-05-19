@extends('backend.MasterPage.Layout')
@section('title', TitlePage('امکانات'))
@section('style')
    <link rel="stylesheet" href="{{asset('backend/css/dataTables.bootstrap.css')}}">
    <link rel="stylesheet" href="{{asset('backend/css/TableTools.css')}}">
    <style>
        #ToolTables_DataTables_Table_0_0{
            display: none;
        }
        .box-table {
            max-height: 250px;
            min-height: 250px;
            overflow-x: scroll;
        }
        .margin-top-28 {
            margin-top: 28px;
        }
        .btn-file {
            position: relative;
            overflow: hidden;
        }
        .btn-file input[type=file] {
            position: absolute;
            top: 0;
            right: 0;
            min-width: 100%;
            min-height: 100%;
            font-size: 100px;
            text-align: right;
            filter: alpha(opacity=0);
            opacity: 0;
            outline: none;
            background: white;
            cursor: inherit;
            display: block;
        }
        table img {
            width: 30px;
            height: 30px;
        }
    </style>
@endsection

@section('content')
    <div class="row back-url">
        <div class="col-md-12">
            <a class="" href="{{ route('AdminDashboard') }}">صفحه اصلی</a><span class="now-url"> / مدیریت امکانات</span>
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
                    <h3 class="panel-title">امکانات</h3>
                </div>
                <div class="panel-body">
                    <form role="form" action="{{ route('StoreOption') }}" method="post" enctype="multipart/form-data" id="FormCreateOption">
                        {{ csrf_field() }}
                        <div class="row">
                            <div class="col-md-2">
                                <div class="form-group">
                                    <label for="InputTitleOption">عنوان</label><span style="font-size: 18px;" class="text-danger">*</span>
                                    <input type="text" name="option" value="{{ old('option') }}" class="form-control primary" dir="rtl" id="InputTitleOption" placeholder="عنوان را وارد کنید" autofocus>
                                </div>
                                @if($errors->has('option'))
                                    <span style="color:red;">{{ $errors->first('option') }}</span>
                                @endif
                            </div>
                            <div class="col-md-2">
                                <div class="form-group">
                                    <label for="SelectType">نوع</label><span style="font-size: 18px;" class="text-danger">*</span>
                                    <select name="type" id="SelectType" class="form-control">
                                        <option value="1">امکانات</option>
                                        <option value="2">خدمات</option>
                                    </select>
                                </div>
                                @if($errors->has('option'))
                                    <span style="color:red;">{{ $errors->first('option') }}</span>
                                @endif
                            </div>
                            <div class="col-md-4">
                                <div class="form-group">
                                    <label for="InputDescription">توضیحات</label>
                                    <input type="text" name="description" class="form-control" value="{{ old('description') }}" dir="rtl" id="InputDescription" />
                                </div>
                            </div>
                            <div class="col-md-2">
                                <div class="form-group">
                                    <span class="btn btn-primary btn-file margin-top-28">
                                        انتخاب کنید ...
                                        <input type="file" name="file" value="{{ old('file') }}" dir="rtl" id="InputFileImg" />
                                    </span>
                                </div>
                            </div>
                            <div class="col-md-2">
                                <label for="BtnCreateOption">&nbsp;</label>
                                <button type="submit" id="BtnCreateOption" class="btn btn-default BtnRegAll btn-block ">ثبت</button>
                            </div>
                        </div>
                    </form>

                    <table cellpadding="0" cellspacing="0" border="0" class="table table-striped table-bordered editable-datatable">
                            <thead>
                            <tr>
                                <th>ردیف</th>
                                <th>تصویر</th>
                                <th>عنوان</th>
                                <th>توضیحات</th>
                                <th>اولویت</th>
                                <th>ویرایش</th>
                                <th>وضعیت</th>
                                <th>تاریخ ثبت</th>
                            </tr>
                            </thead>
                            <tbody>
                            @foreach($optionModel as $key => $value)
                                <tr class="1">
                                    <td>
                                        {{ $key+1 }}
                                    </td>
                                    <td>
                                        <img src="{{asset('Uploaded/Possibilities/Option').'/'.$value->img}}" alt="">
                                    </td>
                                    <td>
                                        {{ $value->name }}
                                    </td>
                                    <td>
                                        @if($value->description != '')
                                            <label style="cursor:pointer;" title="{{$value->description}}"><i class="fa fa-info-circle"></i></label>
                                        @endif
                                    </td>
                                    <td>
                                        {{ $value->priority }}
                                    </td>
                                    <td>
                                        <label data-toggle="modal" data-target="#myModal" onclick="ajaxEditName('{{$value->id}}');" class="btn btn-default btn-block"><i class="fa fa-edit"></i> </label>
                                    </td>
                                    <td>
                                        <label id="btnActiveOption{{$key+1}}" onclick="ajaxActiveOption('{{ $value->id }}','{{$key+1}}');" class="@if($value->active == 1) btn btn-default btn-block @else btn btn-default btn-block @endif">
                                            @if($value->active == 1) <i class="fa fa-check text-success"></i> @else <i class="fa fa-plus text-danger" style="transform: rotate(45deg)"></i> @endif
                                        </label>
                                    </td>
                                    <td class="">
                                        @php(
                                            $birth_date = \Morilog\Jalali\Facades\jDate::forge($value->created_at)->format('Y/m/d')
                                        )
                                        {{ $birth_date }}
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
                                    <h4 class="modal-title">ویرایش امکانات</h4>
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


    <script type="text/javascript">
        $(document).ready(function () {

            //

        });


        function ajaxEditName(id) {
            // console.log(id);
            var img = '<div class="text-center"><img style="height:50px;width:auto;" src="{{ asset('backend/img/img_loading/orange_circles.gif') }}" /></div>';
            $('#ExtraModalEdit').html(img);
            $.ajax({
                url:"{{ url('edit/option').'/'}}"+id,
                method:"get",
            }).done(function(returnData) {
                console.log(returnData);
                $('#ExtraModalEdit').html(returnData);
            })
        }



        function ajaxActiveOption(id,idInput) {
            $.ajax({
                url:"{{ url('active/option').'/'}}"+id,
                method:"get",
            }).done(function(returnData){
                // console.log(returnData);
                if(returnData == 'active')
                {
                    // console.log('active');
                    $("#btnActiveOption"+idInput).addClass('btn-default');
                    $("#btnActiveOption"+idInput).removeClass('btn-default');
                    $("#btnActiveOption"+idInput).css("transition", "0.5s");
                    $("#btnActiveOption"+idInput).text('');
                    $("#btnActiveOption"+idInput).append('<i class="fa fa-check text-success"></i>');
                }
                else if(returnData == 'deactive')
                {
                    // console.log('deactive');
                    $("#btnActiveOption"+idInput).addClass('btn-default');
                    $("#btnActiveOption"+idInput).removeClass('btn-default');
                    $("#btnActiveOption"+idInput).css("transition", "0.5s");
                    $("#btnActiveOption"+idInput).text('');
                    $("#btnActiveOption"+idInput).append('<i class="fa fa-plus text-danger" style="transform: rotate(45deg)"></i>');
                }
            });
        }
    </script>
@endsection