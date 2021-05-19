@extends('backend.MasterPage.Layout')
@section('title')
    ویلا :: اسلایدشو
@endsection

@section('style')
    <link rel="stylesheet" href="{{asset('backend/css/dataTables.bootstrap.css')}}">
    <link rel="stylesheet" href="{{asset('backend/css/TableTools.css')}}">
    <style>
        #ToolTables_DataTables_Table_0_0{
            display: none;
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
        .img-advertising {
            width: 20%;
            transition: 0.5s;
        }
        .img-advertising:hover {
            width: 40%;
            transition: 0.5s;
        }
    </style>
@endsection

@section('content')
    <div class="row back-url">
        <div class="col-md-12">
            <a class="" href="{{ route('AdminDashboard') }}">صفحه اصلی</a><span class="now-url"> / اسلایدشو</span>
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
                    <h3 class="panel-title">اسلایدشو</h3>
                </div>
                <div class="panel-body">
                    <form role="form" action="{{ route('StoreSlideShow') }}" method="post" enctype="multipart/form-data" id="FormCreatePositionType">
                        {{ csrf_field() }}
                        <div class="row">
                            <div class="col-md-2">
                                <div class="form-group">
                                    <label for="InputTitle">عنوان</label><span style="font-size: 18px;" class="text-danger">*</span>
                                    <input type="text" name="title" value="{{ old('title') }}" class="form-control primary" dir="rtl" id="InputTitle" placeholder="عنوان را وارد کنید" autofocus>
                                </div>
                                @if($errors->has('title'))
                                    <span style="color:red;">{{ $errors->first('title') }}</span>
                                @endif
                            </div>
                            <div class="col-md-2">
                                <div class="form-group">
                                    <label>استان</label><span style="font-size: 18px;" class="text-danger">*</span>
                                    <select name="province_id" id="SelectProvince" class="form-control SelectProvince">
                                        <option value="" hidden>انتخاب کنید</option>
                                        @foreach($provinceModel as $key => $value)
                                            <option value="{{$value->id}}">{{ $value->name }}</option>
                                        @endforeach
                                    </select>
                                </div>
                            </div>
                            <div class="col-md-2">
                                <div class="form-group">
                                    <label>شهرستان</label><span style="font-size: 18px;" class="text-danger">*</span>
                                    <select name="township_id" id="SelectTownship" class="form-control SelectTownship">
                                        <option value="" hidden></option>
                                        {{--@foreach($townshipModel as $key => $value)--}}
                                        {{--<option value="{{$value->id}}" @if($value->id == 1) selected @endif>{{ $value->name }}</option>--}}
                                        {{--@endforeach--}}
                                    </select>
                                </div>
                            </div>
                            <div class="col-md-2">
                                <div class="form-group">
                                    <label for="InputFileImg">تصویر</label><span style="font-size: 18px;" class="text-danger">*</span>
                                    <br />
                                    <span class="btn btn-primary btn-file">
                                        انتخاب کنید ...
                                        <input type="file" name="img" value="{{ old('img') }}" dir="rtl" id="InputFileImg" />
                                    </span>
                                </div>
                                @if($errors->has('img'))
                                    <span style="color:red;">{{ $errors->first('img') }}</span>
                                @endif
                            </div>
                            <div class="col-md-3">
                                <div class="form-group">
                                    <label for="InputLink">لینک</label><span style="font-size: 18px;" class="text-danger">*</span>
                                    <input type="text" name="link" value="{{ old('link') }}" class="form-control primary" dir="ltr" id="InputLink" placeholder="http://">
                                </div>
                                @if($errors->has('link'))
                                    <span style="color:red;">{{ $errors->first('link') }}</span>
                                @endif
                            </div>
                            <div class="col-md-1">
                                <label for="BtnCreatePosition">&nbsp;</label>
                                <button type="submit" id="BtnCreatePosition" class="btn btn-default BtnRegAll btn-block ">ثبت</button>
                            </div>
                        </div>
                    </form>

                    <hr />

                    <table cellpadding="0" cellspacing="0" border="0"
                           class="table table-striped table-bordered editable-datatable">
                        <thead>
                        <tr>
                            <th>ردیف</th>
                            <th>تصویر</th>
                            <th>عنوان</th>
                            <th>ویرایش</th>
                            <th>تاریخ ایجاد</th>
                        </tr>
                        </thead>
                        <tbody>
                        @foreach($slideShowModel as $key => $value)
                            <tr class="1">
                                <td>
                                    {{ $key+1 }}
                                </td>
                                <td>
                                    <img class="img-advertising" src="{{asset('Uploaded/SlideShow/Img').'/'.$value->img}}" alt="">
                                </td>
                                <td>
                                    {{ $value->title }}
                                </td>
                                <td>
                                    <label data-toggle="modal" data-target="#myModal" onclick="ajaxEditSlideShow('{{$value->id}}');" class="btn btn-default btn-block"><i class="fa fa-edit"></i> </label>
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
                    {{--edit menu modal--}}
                    <div class="modal fade" id="myModal" role="dialog">
                        <div class="modal-dialog modal-md">
                            <!-- Modal content-->
                            <div class="modal-content">
                                <div class="modal-header">
                                    <button type="button" class="close" data-dismiss="modal">&times;</button>
                                    <h4 class="modal-title">ویرایش</h4>
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

    <script>
        $(document).ready(function () {
    
            //get township
            $("body").delegate(".SelectProvince", "change", function (e) {
        
                var id = $(this).val();
                getTownship(id);
            });
    
            //get township
            function getTownship(id) {
                $.ajaxSetup({
                    headers: {
                        'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                    }
                });
                $.ajax({
                    url: '{{route('GetAjaxTownship')}}',
                    type: 'post',
                    data: {
                        id: id
                    },
                    success: function (data) {
                        $(".SelectTownship").html(data);
                    }
                });
        
            }
        });
        function ajaxEditSlideShow(id) {
            // console.log(id);
            var img = '<div class="text-center"><img style="height:50px;width:auto;" src="{{ asset('backend/img/img_loading/orange_circles.gif') }}" /></div>';
            $('#ExtraModalEdit').html(img);
            $.ajax({
                url:"{{ url('edit/slide-show').'/'}}"+id,
                method:"get",
            }).done(function(returnData) {
                console.log(returnData);
                $('#ExtraModalEdit').html(returnData);
            })
        }


    </script>
@endsection