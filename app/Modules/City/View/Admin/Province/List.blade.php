@extends('backend.MasterPage.Layout')

@section('title','لیست استان ها')
@section('page_title','لیست استان ها')


@section('breadCrumb')

    <ul class="breadcrumb">

        <li>
            <a href="{{route('AdminDashboard')}}"><i class="icon-home"></i></a><span class="divider">&nbsp;</span>
        </li>

        <li>
            <a href="{{route('CountryList')}}"> لیست کشورها </a> <span class="divider-last">&nbsp;</span>
        </li>



    </ul>

@endsection

@section('style')
    <link rel="stylesheet" href="{{asset('backend/css/checkbox.css')}}">
    <link rel="stylesheet" type="text/css" href="{{asset('backend/assets/chosen-bootstrap/chosen/chosen.css')}}" />
    <style>
        .Messaging,.MessageBox{
            display: none;}
        .AddNewModal,.EditModal{
            min-height:350px;
        }
    </style>
@endsection

@section('content')




    <!-- Edit Modal -->
    <div id="EditModal" class="modal fade" role="dialog">
        <div class="modal-dialog">

            <!-- Modal content-->
            <div class="modal-content">
                <div class="modal-header">
                    <button type="button" class="close" data-dismiss="modal">&times;</button>
                    <h4 class="modal-title">ویرایش </h4>
                </div>
                <div class="modal-body EditModal">
                    <div class="alert alert-info MessageBox">

                    </div>

                    <input type="hidden" name="id" value="" id="EditProvinceID">

                    <div class="row-fluid">
                        <div class="span2">نام کشور :</div>
                        <div class="span10">
                            <select name="Country" id="EditCountry"  data-placeholder="نام کشور مورد نظر را انتخاب کنید" class="chosen  span10" id="selS0V">
                                @foreach($Country as $Item)
                                    <option value="{{$Item->id}}"  @if($Item->id==$ID) selected @endif >{{$Item->country_name}}</option>
                                @endforeach
                            </select>
                        </div>
                    </div>

                    <div class="row-fluid">

                        <div class="span2">نام استان:</div>
                        <div class="span10">
                            <input type="text" name="title" id="EditProvinceName" class="span10" placeholder="نام استان را وارد کنید">
                        </div>

                    </div>

                    <div class="row-fluid">
                        <div class="span12 text-center">
                            <button class="btn btn-info" id="SubmitProvinceInfo">ویرایش </button>
                        </div>
                    </div>


                </div>
            </div>

        </div>
    </div>


    <!-- Modal -->
    <div id="AddNewModal" class="modal fade" role="dialog">
        <div class="modal-dialog">

            <!-- Modal content-->
            <div class="modal-content">
                <div class="modal-header">
                    <button type="button" class="close" data-dismiss="modal">&times;</button>
                    <h4 class="modal-title">ثبت استان جدید</h4>
                </div>
                <div class="modal-body AddNewModal">
                    <div class="alert alert-info MessageBox">
                        d
                    </div>

                    <div class="row-fluid">
                        <div class="span2">نام کشور :</div>
                        <div class="span10">
                            <select name="Country" id="Country"  data-placeholder="نام کشور مورد نظر را انتخاب کنید" tabindex="-1" class="chosen-with-diselect  span10" id="selCSI">
                                @foreach($Country as $Item)
                                    <option value="{{$Item->id}}" @if($Item->id==$ID) selected @endif>{{$Item->country_name}}</option>
                                @endforeach
                            </select>
                        </div>
                    </div>

                    <div class="row-fluid">

                        <div class="span2">نام استان:</div>
                        <div class="span10">
                            <input type="text" id="ProvinceName" class="span10" placeholder="نام استان را وارد کنید">
                        </div>
                    </div>

                    <div class="row-fluid">
                        <div class="span12 text-center">
                            <button class="btn btn-info" id="AddNewProvince">ثبت استان</button>
                        </div>
                    </div>
                </div>
            </div>

        </div>
    </div>




    @include('message.Message')
    <div class="alert alert-info Messaging">c</div>

    <div class="widget">

        <div class="widget-title">
            <h4>
                <i class="icon-map-marker"></i>
                مدیریت کشورها
            </h4>
        </div>

        <div class="widget-body">

            <div class="row-fluid" style="margin-bottom: 20px;">
                <div class="span12 text-left">
                    <button class="btn btn-info" data-toggle="modal" data-target="#AddNewModal" >ثبت استان/ایالت جدید</button>
                    <a href="{{route('AddCityForm')}}" class="btn btn-info">ثبت شهر جدید</a>
                </div>
            </div>

            @if(count($List)>0)

                <table class="table table-striped" id="sample_1">

                    <thead>
                    <tr>
                        <th></th>
                        <th>نام استان</th>
                        <th class="span1">وضعیت</th>
                        <th class="span2">شهر</th>
                        <th class="span2">عملیات</th>
                    </tr>
                    </thead>

                    <tbody>
                    @foreach($List as $Item)
                        <tr>
                            <td></td>
                            <td>{{$Item->name}}</td>
                            <td>
                                <label class="switch">
                                    <input type="checkbox" class="ChangeStatus" value="{{$Item->id}}" @if($Item->active=='1') checked @endif>
                                    <span class="slider round"></span>
                                </label>
                            </td>
                            <td>
                                <a href="{{route('CityList',['id'=>$Item->id])}}" class="btn btn-info">لیست شهرها</a>
                            </td>
                            <td>
                                <a href="{{route('DeleteProvince',['id'=>$Item->id])}}" class="btn btn-danger">
                                    <i class="icon-trash"></i>
                                </a>

                                <button class="btn btn-info EditProvinceItem" data-value="{{$Item->id}}" data-content="{{$Item->name}}">
                                    <i class="icon-edit"></i>
                                </button>
                            </td>
                        </tr>
                    @endforeach
                    </tbody>
                </table>

            @else
                <div class="alert alert-info">
                    استان یا ایالتی تا کنون ثبت نگردیده است
                </div>
            @endif

        </div>

    </div>

@endsection

@section('script')
    <script type="text/javascript" src="{{asset('backend/assets/chosen-bootstrap/chosen/chosen.jquery.min.js')}}"></script>

    <script type="text/javascript" src="{{asset('backend/assets/data-tables/jquery.dataTables.js')}}"></script>
    <script type="text/javascript" src="{{asset('backend/assets/data-tables/DT_bootstrap.js')}}"></script>


    <script type="text/javascript">

        $(document).ready(function (e) {

            //change status
            $("body").delegate(".ChangeStatus","click",function (e) {

                var id=$(this).val();

                $.ajaxSetup({
                    headers : {
                        'X-CSRF-TOKEN' : $('meta[name="csrf-token"]').attr('content')
                    }
                });

                $.ajax({
                    url : '{{route('ChangeProvinceStatus')}}',
                    type : 'post',
                    data : {
                        id : id
                    },
                    success : function (data) {

                        $(".Messaging").html(data.Message).slideDown(500);
                        setTimeout(function () {
                            $(".Messaging").html('').slideUp(500);
                        },2000);
                    }
                });

            });


            //set value for edit
            $("body").delegate(".EditProvinceItem","click",function (e) {

                var id=$(this).attr('data-value');
                var title=$(this).attr('data-content');

                $("#EditProvinceID").val(id);
                $("#EditProvinceName").val(title);

                $("#EditModal").modal('show');

            });




            //edit province info
            $("body").delegate("#SubmitProvinceInfo","click",function (e) {

                var Name=$("#EditProvinceName").val();
                var Country=$("#EditCountry").val();
                var id=$("#EditProvinceID").val();

                if(Name.length > 0)
                {
                    $.ajaxSetup({
                        headers : {
                            'X-CSRF-TOKEN' : $('meta[name="csrf-token"]').attr('content')
                        }
                    });

                    $.ajax({
                        url : '{{route('EditProvince')}}',
                        type : 'post',
                        data : {
                            name : Name,
                            country : Country,
                            id : id
                        },
                        success : function (data) {

                            if(data.Success=='1')
                            {
                                window.location.reload();
                            }
                            else {
                                $(".MessageBox").html(data.Message).slideDown(1000);
                                setTimeout(function () {
                                    $(".MessageBox").html('').slideUp(1000);
                                },2000);
                            }
                        }
                    });
                }
                else
                {
                    $(".MessageBox").html('وارد کردن نام کشور الزامی است').slideDown(1000);
                    setTimeout(function () {
                        $(".MessageBox").html('').slideUp(1000);
                    },2000);
                }

            });


            //add new province
            $("body").delegate("#AddNewProvince","click",function(e){

                var Name=$("#ProvinceName").val();
                var Country=$("#Country").val();

                if(Name.length > 0)
                {
                    $.ajaxSetup({
                        headers : {
                            'X-CSRF-TOKEN' : $('meta[name="csrf-token"]').attr('content')
                        }
                    });

                    $.ajax({
                        url : '{{route('AddProvince')}}',
                        type : 'post',
                        data : {
                            name : Name,
                            country : Country
                        },
                        success : function (data) {

                            if(data.Success=='1')
                            {
                                window.location.reload();
                            }
                            else {
                                $(".MessageBox").html(data.Message).slideDown(1000);
                                setTimeout(function () {
                                    $(".MessageBox").html('').slideUp(1000);
                                },2000);
                            }
                        }
                    });
                }
                else
                {
                    $(".MessageBox").html('وارد کردن نام کشور الزامی است').slideDown(1000);
                    setTimeout(function () {
                        $(".MessageBox").html('').slideUp(1000);
                    },2000);
                }

            });





        });

    </script>

@endsection