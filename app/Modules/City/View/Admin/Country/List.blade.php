@extends('backend.MasterPage.Layout')

@section('title','لیست کشورها')
@section('page_title','لیست کشورها')


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
<style>
    .Messaging,.MessageBox{
        display: none;}
</style>
@endsection

@section('content')

    <!-- Modal -->
    <div id="AddNewModal" class="modal fade" role="dialog">
        <div class="modal-dialog">

            <!-- Modal content-->
            <div class="modal-content">
                <div class="modal-header">
                    <button type="button" class="close" data-dismiss="modal">&times;</button>
                    <h4 class="modal-title">ثبت کشور جدید</h4>
                </div>
                <div class="modal-body AddNewModal">
                    <div class="alert alert-info MessageBox">
                        d
                    </div>

                    <div class="row-fluid">

                        <div class="span2">نام کشور:</div>
                        <div class="span6">
                            <input type="text" id="CountryName" class="span12" placeholder="نام کشور را وارد کنید">
                        </div>
                        <div class="span4">
                            <button class="btn btn-info" id="AddNewCountry">ثبت کشور</button>
                        </div>

                    </div>
                </div>
            </div>

        </div>
    </div>




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
                    <div class="alert alert-info Messaging">

                    </div>

                    <input type="hidden" name="id" value="" id="EditCountryID">
                    <div class="row-fluid">

                        <div class="span2">نام کشور:</div>
                        <div class="span6">
                            <input type="text" name="title" id="EditCountryName" class="span12" placeholder="نام وسیله نقلیه را وارد کنید">
                        </div>
                        <div class="span4">
                            <button class="btn btn-info" id="SubmitCountryInfo">ویرایش </button>
                        </div>

                    </div>


                </div>
            </div>

        </div>
    </div>




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
                    <button class="btn btn-info" data-toggle="modal" data-target="#AddNewModal" >ثبت کشور جدید</button>
                    <a href="{{route('AddCityForm')}}" class="btn btn-info">ثبت شهر جدید</a>
                </div>
            </div>

            @if(count($Country)>0)

                <table class="table table-striped" id="sample_1">

                    <thead>
                      <tr>
                          <th></th>
                          <th>نام کشور</th>
                          <th class="span1">وضعیت</th>
                          <th class="span2">استان / ایالت</th>
                          <th class="span2">عملیات</th>
                      </tr>
                    </thead>

                    <tbody>
                      @foreach($Country as $Item)
                        <tr>
                            <td></td>
                            <td>{{$Item->country_name}}</td>
                            <td>
                                <label class="switch">
                                    <input type="checkbox" class="ChangeStatus" value="{{$Item->id}}" @if($Item->active=='1') checked @endif>
                                    <span class="slider round"></span>
                                </label>
                            </td>
                            <td>
                                <a href="{{route('ProvinceList',['id'=>$Item->id])}}" class="btn btn-info">استان یا ایالت</a>
                            </td>
                            <td>
                                <a href="{{route('DeleteCountry',['id'=>$Item->id])}}" class="btn btn-danger">
                                    <i class="icon-trash"></i>
                                </a>

                                <button class="btn btn-info EditCountryItem" data-value="{{$Item->id}}" data-content="{{$Item->country_name}}">
                                    <i class="icon-edit"></i>
                                </button>
                            </td>
                        </tr>
                      @endforeach
                    </tbody>
                </table>

            @else
                <div class="alert alert-info">
                    کشوری تا کنون ثبت نگردیده است
                </div>
            @endif

        </div>

    </div>

@endsection

@section('script')
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
                    url : '{{route('ChangeCountryStatus')}}',
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
            $("body").delegate(".EditCountryItem","click",function (e) {

                var id=$(this).attr('data-value');
                var title=$(this).attr('data-content');

                $("#EditCountryID").val(id);
                $("#EditCountryName").val(title);

                $("#EditModal").modal('show');

            });


            //edit country info
            $("body").delegate("#SubmitCountryInfo","click",function (e) {

                var Name=$("#EditCountryName").val();
                var id=$("#EditCountryID").val();

                if(Name.length > 0)
                {
                    $.ajaxSetup({
                        headers : {
                            'X-CSRF-TOKEN' : $('meta[name="csrf-token"]').attr('content')
                        }
                    });

                    $.ajax({
                        url : '{{route('EditCountry')}}',
                        type : 'post',
                        data : {
                            name : Name,
                            id : id
                        },
                        success : function (data) {

                            if(data.Success=='1')
                            {
                                window.location.reload();
                            }
                            else {
                                $(".Messaging").html(data.Message).slideDown(1000);
                                setTimeout(function () {
                                    $(".Messaging").html('').slideUp(1000);
                                },2000);
                            }
                        }
                    });
                }
                else
                {
                    $(".Messaging").html('وارد کردن نام کشور الزامی است').slideDown(1000);
                    setTimeout(function () {
                        $(".Messaging").html('').slideUp(1000);
                    },2000);
                }

            });


            //add new country
            $("body").delegate("#AddNewCountry","click",function(e){

                var Name=$("#CountryName").val();

                if(Name.length > 0)
                {
                    $.ajaxSetup({
                        headers : {
                            'X-CSRF-TOKEN' : $('meta[name="csrf-token"]').attr('content')
                        }
                    });

                    $.ajax({
                        url : '{{route('AddCountry')}}',
                        type : 'post',
                        data : {
                            name : Name
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
                    $(".Messaging").html('وارد کردن نام کشور الزامی است').slideDown(1000);
                    setTimeout(function () {
                        $(".MessageBox").html('').slideUp(1000);
                    },2000);
                }

            });

        });

    </script>

@endsection