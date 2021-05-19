@extends('backend.MasterPage.Layout')

@section('title')
    ویلا :: مدیریت مناطق
@endsection

@section('style')
    <link rel="stylesheet" href="{{asset('backend/css/dataTables.bootstrap.css')}}">
    <link rel="stylesheet" href="{{asset('backend/css/TableTools.css')}}">
    <style>
        #ToolTables_DataTables_Table_0_0{
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
            <span class="now-url"> / مدیریت مناطق</span>
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
                    <h3 class="panel-title">مدیریت مناطق</h3>
                </div>
                <div class="panel-body">
                    <form action="{{ route('StoreArea') }}" method="post">
                        {{ csrf_field() }}
                        <div class="row">
                            <div class="col-md-2">
                                <div class="form-group">
                                    <label>استان</label><span style="font-size: 18px;" class="text-danger">*</span>
                                    <select name="province_id" class="form-control SelectProvince">
                                        <option hidden>انتخاب کنید</option>
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
                                    </select>
                                </div>
                            </div>
                            <div class="col-md-2">
                                <div class="form-group">
                                    <label>شهر</label><span style="font-size: 18px;" class="text-danger">*</span>
                                    <select name="city_id" class="form-control SelectCity">
                                    </select>
                                </div>
                            </div>
                            <div class="col-md-3">
                                <div class="form-group">
                                    <label>نام منطقه</label><span style="font-size: 18px;" class="text-danger">*</span>
                                    <input type="text" id="" class="form-control" name="name" placeholder="نام منطقه را وارد کنید" />
                                </div>
                            </div>
                            <div class="col-md-3">
                                <label for="BtnCreateArea">&nbsp;</label>
                                <button type="submit" class="btn btn-success btn-block" id="BtnCreateArea">ثبت منطقه</button>
                            </div>
                        </div>
                    </form>

                    <table cellpadding="0" cellspacing="0" border="0"
                           class="table table-striped table-bordered editable-datatable">
                        <thead>
                        <tr>
                            <th>ردیف</th>
                            <th>نام استان</th>
                            <th>نام شهر</th>
                            <th>نام منطقه</th>
                            <th>وضعیت</th>
                            <th>ویرایش</th>
                            <th>تاریخ ثبت</th>
                        </tr>
                        </thead>
                        <tbody>
                        @foreach($areaModel as $key => $value)
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
                                    @if($City = $value->cityGet)
                                        {{ $City->name }}
                                    @else
                                        -
                                    @endif
                                </td>
                                <td>
                                    {{ $value->name }}
                                </td>
                                <td>
                                    <label id="btnActiveArea{{$key+1}}" onclick="ajaxActiveArea('{{ $value->id }}','{{$key+1}}');" class="@if($value->active == 1) btn btn-default btn-block @else btn btn-default btn-block @endif">
                                        @if($value->active == 1) <i class="fa fa-check text-success"></i> @else <i class="fa fa-plus text-danger" style="transform: rotate(45deg)"></i> @endif
                                    </label>
                                </td>
                                <td>
                                    <label data-toggle="modal" onclick="ajaxEditArea('{{ $value->id }}');" data-target="#myModal" class="btn btn-default btn-block" style="cursor: pointer;" >
                                        <i class="fa fa-edit"></i>
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

                    {{--Modal--}}
                    <div class="modal fade" id="myModal" role="dialog">
                        <div class="modal-dialog modal-md">
                            <!-- Modal content-->
                            <div class="modal-content">
                                <div class="modal-header">
                                    <button type="button" class="close" data-dismiss="modal">&times;</button>
                                    <h4 class="modal-title">ویرایش منطقه</h4>
                                </div>
                                <div class="modal-body">
                                    <div id="ExtraModalEdit">

                                    </div>
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



            //get city
            $("body").delegate(".SelectTownship","change",function (e) {

                var id=$(this).val();
                getCity(id);
            });

            //get city
            function getCity(id)
            {
                console.log(id);
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
        });

        function ajaxActiveArea(id,idInput) {
            $.ajax({
                url:"{{ url('active/area').'/'}}"+id,
                method:"get",
            }).done(function(returnData){
                console.log(returnData);
                if(returnData == 'active')
                {
                    // console.log('active');
                    $("#btnActiveArea"+idInput).addClass('btn-default');
                    $("#btnActiveArea"+idInput).removeClass('btn-default');
                    $("#btnActiveArea"+idInput).css("transition", "0.5s");
                    $("#btnActiveArea"+idInput).text('');
                    $("#btnActiveArea"+idInput).append('<i class="fa fa-check text-success"></i>');
                }
                else if(returnData == 'deactive')
                {
                    // console.log('deactive');
                    $("#btnActiveArea"+idInput).addClass('btn-default');
                    $("#btnActiveArea"+idInput).removeClass('btn-default');
                    $("#btnActiveArea"+idInput).css("transition", "0.5s");
                    $("#btnActiveArea"+idInput).text('');
                    $("#btnActiveArea"+idInput).append('<i class="fa fa-plus text-danger" style="transform: rotate(45deg)"></i>');
                }
            });
        }


        function ajaxEditArea(id) {
            var img = '<div class="text-center"><img style="height:50px;width:auto;" src="{{ asset('backend/img/img_loading/orange_circles.gif') }}" /></div>';
            $('#ExtraModalEdit').html(img);
            $.ajax({
                url:"{{ url('edit/area').'/'}}"+id,
                method:"get",
            }).done(function(returnData) {
                $('#ExtraModalEdit').html(returnData);
            })
        }
    </script>
@endsection