@extends('backend.MasterPage.Layout')

@section('title')
    ویلا :: مدیریت شهر ها
@endsection

@section('style')
    <link rel="stylesheet" href="{{asset('backend/css/dataTables.bootstrap.css')}}">
    <link rel="stylesheet" href="{{asset('backend/css/TableTools.css')}}">



    <link rel="stylesheet" href="{{asset('backend/css/dataTables.bootstrap.css')}}">
    <link rel="stylesheet" href="{{asset('backend/css/TableTools.css')}}">
    <link rel="stylesheet" href="{{asset('backend/css/bootstrap.min.css')}}">
    <link rel="stylesheet" href="{{asset('backend/css/offline-theme-dark.css')}}">
    <link rel="stylesheet" href="{{asset('backend/css/bootstrap-override.css')}}">
    <link rel="stylesheet" href="{{asset('backend/css/font-awesome.min.css')}}">
    <link rel="stylesheet" href="{{asset('backend/css/layout.css')}}">
    <link rel="stylesheet" href="{{asset('backend/css/library.css')}}">
    <link rel="stylesheet" href="{{asset('backend/css/style.css')}}">


    <style>
        #ToolTables_advancetable_0{
            display: none;
        }
        form {
            border: 1px solid #ccc;
            padding: 10px;
            border-radius: 5px;
            margin-bottom: 20px;
            background-color: #efefef;
        }
    </style>
@endsection

@section('content')



    <div class="row back-url">
        <div class="col-md-12">
            <a class="" href="{{ route('AdminDashboard') }}">صفحه اصلی</a>
            <span class="now-url"> / مدیریت شهر ها</span>
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
                    <h3 class="panel-title">مدیریت شهر ها</h3>
                </div>
                <div class="panel-body">

                    <form action="{{ route('StoreCity') }}" method="post">
                        {{ csrf_field() }}
                        <div class="row">
                            <div class="col-md-2">
                                <div class="form-group">
                                    <label>استان</label><span style="font-size: 18px;" class="text-danger">*</span>
                                    <select name="province_id" class="form-control SelectProvince">
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
                                    <select name="township_id" class="form-control SelectTownship">
                                        <option hidden>انتخاب کنید</option>
                                    </select>
                                </div>
                            </div>
                            <div class="col-md-4">
                                <div class="form-group">
                                    <label>نام شهر</label><span style="font-size: 18px;" class="text-danger">*</span>
                                    <input type="text" id="" class="form-control" name="name" placeholder="نام شهر را وارد کنید" />
                                </div>
                            </div>
                            <div class="col-md-2">
                                <label for="BtnCreateTownship">&nbsp;</label>
                                <button type="submit" class="btn btn-success btn-block" id="BtnCreateTownship">ثبت شهر</button>
                            </div>
                        </div>
                    </form>

                    <table cellpadding="0" cellspacing="0" border="0" class="table table-striped table-bordered" id="advancetable">
                        <thead>
                        <tr>
                            <th>ردیف</th>
                            <th>استان</th>
                            <th>شهرستان</th>
                            <th>شهر</th>
                            <th>وضعیت</th>
                            <th>ویرایش</th>
                            <th>تاریخ ثبت</th>
                        </tr>
                        </thead>
                        <tbody>
                        @foreach($cityModel as $key => $value)
                            <tr class="1">
                                <td>
                                    {{ $key+1 }}
                                </td>
                                <td>
                                    @if($Province = $value->provinceGet)
                                        {{ $Province->name }}
                                    @else
                                        -
                                    @endif
                                </td>
                                <td>
                                    @if($Township = $value->townshipGet)
                                        {{ $Township->name }}
                                    @else
                                        -
                                    @endif
                                </td>
                                <td>
                                    {{ $value->name }}
                                </td>
                                <td>
                                    <label id="btnActiveCity{{$key+1}}" onclick="ajaxActiveCity('{{ $value->id }}','{{$key+1}}');" class="@if($value->active == 1) btn btn-default btn-block @else btn btn-default btn-block @endif">
                                        @if($value->active == 1) <i class="fa fa-check text-success"></i> @else <i class="fa fa-plus text-danger" style="transform: rotate(45deg)"></i> @endif
                                    </label>
                                </td>
                                <td>
                                    <label data-toggle="modal" onclick="ajaxEditCity('{{ $value->id }}');" data-target="#myModal" class="btn btn-default btn-block" style="cursor: pointer;" >
                                        <i class="fa fa-edit"></i>
                                    </label>
                                </td>
                                <td class="">
                                    @php(
                                        $create_date = \Morilog\Jalali\Facades\jDate::forge($value->created_at)->format('Y/m/d')
                                    )
                                    {{ $create_date }}
                                </td>
                            </tr>
                        @endforeach
                        </tbody>
                    </table>
                    {{--edit district modal--}}
                    <div class="modal fade" id="myModal" role="dialog">
                        <div class="modal-dialog modal-md">
                            <!-- Modal content-->
                            <div class="modal-content">
                                <div class="modal-header">
                                    <button type="button" class="close" data-dismiss="modal">&times;</button>
                                    <h4 class="modal-title">ویرایش شهر</h4>
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
    <script type="text/javascript" src="{{asset('backend/js/jquery.dataTables.min.js')}}"></script>
    <script type="text/javascript" src="{{asset('backend/js/TableTools.min.js')}}"></script>
    <script type="text/javascript" src="{{asset('backend/js/dataTables.bootstrap.js')}}"></script>
    <script type="text/javascript" src="{{asset('backend/js/datatables.js')}}"></script>
    <script type="text/javascript" src="{{asset('backend/js/editable-datatables.js')}}"></script>
    <script>

        $(document).ready(function () {
            //get township
            $("body").delegate(".SelectProvince","change",function (e) {

                var id=$(this).val();
                getTownship(id);
            });

            //get township
            function getTownship(id)
            {
                $.ajaxSetup({
                    headers : {
                        'X-CSRF-TOKEN' : $('meta[name="csrf-token"]').attr('content')
                    }
                });
                $.ajax({
                    url: '{{route('GetAjaxTownship')}}',
                    type : 'post',
                    data : {
                        id:id
                    },
                    success : function (data) {
                        $(".SelectTownship").html(data);
                    }
                });

            }
        });

        function ajaxActiveCity(id,idInput) {
            $.ajax({
                url:"{{ url('active/city').'/'}}"+id,
                method:"get",
            }).done(function(returnData){
                console.log(returnData);
                if(returnData == 'active')
                {
                    // console.log('active');
                    $("#btnActiveCity"+idInput).addClass('btn-default');
                    $("#btnActiveCity"+idInput).removeClass('btn-default');
                    $("#btnActiveCity"+idInput).css("transition", "0.5s");
                    $("#btnActiveCity"+idInput).text('');
                    $("#btnActiveCity"+idInput).append('<i class="fa fa-check text-success"></i>');
                }
                else if(returnData == 'deactive')
                {
                    // console.log('deactive');
                    $("#btnActiveCity"+idInput).addClass('btn-default');
                    $("#btnActiveCity"+idInput).removeClass('btn-default');
                    $("#btnActiveCity"+idInput).css("transition", "0.5s");
                    $("#btnActiveCity"+idInput).text('');
                    $("#btnActiveCity"+idInput).append('<i class="fa fa-plus text-danger" style="transform: rotate(45deg)"></i>');
                }
            });
        }



        function ajaxEditCity(id) {
            var img = '<div class="text-center"><img style="height:50px;width:auto;" src="{{ asset('backend/img/img_loading/orange_circles.gif') }}" /></div>';
            $('#ExtraModalEdit').html(img);
            $.ajax({
                url:"{{ url('edit/city').'/'}}"+id,
                method:"get",
            }).done(function(returnData) {
                console.log(returnData);
                $('#ExtraModalEdit').html(returnData);
            })
        }
    </script>

@endsection