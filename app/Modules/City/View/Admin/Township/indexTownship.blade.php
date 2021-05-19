@extends('backend.MasterPage.Layout')
@section('title',TitlePage('مدیریت شهرستان ها'))
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
            <span class="now-url"> / مدیریت شهرستان ها</span>
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
                    <h3 class="panel-title">مدیریت شهرستان ها</h3>
                </div>
                <div class="panel-body">

                    <form action="{{ route('StoreTownship') }}" method="post">
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
                            <div class="col-md-4">
                                <div class="form-group">
                                    <label>نام شهرستان</label><span style="font-size: 18px;" class="text-danger">*</span>
                                    <input type="text" id="" class="form-control" name="name" placeholder="نام شهرستان را وارد کنید" />
                                </div>
                            </div>
                            <div class="col-md-2">
                                <label for="BtnCreateTownship">&nbsp;</label>
                                <button type="submit" class="btn btn-success btn-block" id="BtnCreateTownship">ثبت شهرستان</button>
                            </div>
                        </div>
                    </form>

                    <table cellpadding="0" cellspacing="0" border="0" class="table table-striped table-bordered" id="advancetable">
                        <thead>
                        <tr>
                            <th>ردیف</th>
                            <th>استان</th>
                            <th>شهر</th>
                            <th>اولویت</th>
                            <th>وضعیت</th>
                            <th>ویرایش</th>
                            <th>تاریخ ثبت</th>
                        </tr>
                        </thead>
                        <tbody>
                        @foreach($townshipModel as $key => $value)
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
                                    {{ $value->name }}
                                </td>
                                <td>
                                    {{$value->priority}}
                                </td>
                                <td>
                                    <label id="btnActiveTownship{{$key+1}}" onclick="ajaxActiveTownship('{{ $value->id }}','{{$key+1}}');" class="@if($value->active == 1) btn btn-default btn-block @else btn btn-default btn-block @endif">
                                        @if($value->active == 1) <i class="fa fa-check text-success"></i> @else <i class="fa fa-plus text-danger" style="transform: rotate(45deg)"></i> @endif
                                    </label>
                                </td>
                                <td>
                                    <label data-toggle="modal" onclick="ajaxEditTownship('{{ $value->id }}');" data-target="#myModal" class="btn btn-default btn-block" style="cursor: pointer;" >
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
                                    <h4 class="modal-title">ویرایش شهرستان</h4>
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
            //get city
            $("body").delegate(".SelectProvince","change",function (e) {

                var id=$(this).val();
                getCity(id);
            });

            //get city
            function getCity(id)
            {
                $.ajaxSetup({
                    headers : {
                        'X-CSRF-TOKEN' : $('meta[name="csrf-token"]').attr('content')
                    }
                });
                $.ajax({
                    url: '{{route('GetAjaxCity')}}',
                    type : 'post',
                    data : {
                        id:id
                    },
                    success : function (data) {
                        $(".SelectCity").html(data);
                    }
                });


            }


            //get area
            $("body").delegate(".SelectCity","change",function (e) {

                var id=$(this).val();
                getArea(id);
            });

            //get area
            function getArea(id)
            {
                $.ajaxSetup({
                    headers : {
                        'X-CSRF-TOKEN' : $('meta[name="csrf-token"]').attr('content')
                    }
                });
                $.ajax({
                    url: '{{route('GetAjaxArea')}}',
                    type : 'post',
                    data : {
                        id:id
                    },
                    success : function (data) {
                        $(".SelectArea").html(data);
                    }
                });

            }
        });

        function ajaxActiveTownship(id,idInput) {
            $.ajax({
                url:"{{ url('active/township').'/'}}"+id,
                method:"get",
            }).done(function(returnData){
                console.log(returnData);
                if(returnData == 'active')
                {
                    // console.log('active');
                    $("#btnActiveTownship"+idInput).addClass('btn-default');
                    $("#btnActiveTownship"+idInput).removeClass('btn-default');
                    $("#btnActiveTownship"+idInput).css("transition", "0.5s");
                    $("#btnActiveTownship"+idInput).text('');
                    $("#btnActiveTownship"+idInput).append('<i class="fa fa-check text-success"></i>');
                }
                else if(returnData == 'deactive')
                {
                    // console.log('deactive');
                    $("#btnActiveTownship"+idInput).addClass('btn-default');
                    $("#btnActiveTownship"+idInput).removeClass('btn-default');
                    $("#btnActiveTownship"+idInput).css("transition", "0.5s");
                    $("#btnActiveTownship"+idInput).text('');
                    $("#btnActiveTownship"+idInput).append('<i class="fa fa-plus text-danger" style="transform: rotate(45deg)"></i>');
                }
            });
        }



        function ajaxEditTownship(id) {
            var img = '<div class="text-center"><img style="height:50px;width:auto;" src="{{ asset('backend/img/img_loading/orange_circles.gif') }}" /></div>';
            $('#ExtraModalEdit').html(img);
            $.ajax({
                url:"{{ url('edit/township').'/'}}"+id,
                method:"get",
            }).done(function(returnData) {
                $('#ExtraModalEdit').html(returnData);
            })
        }
    </script>

    
@endsection