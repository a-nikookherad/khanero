@extends('backend.MasterPage.Layout')
@section('title')
    ویلا :: بسته ها
@endsection

@section('style')
    <link rel="stylesheet" href="{{asset('backend/css/dataTables.bootstrap.css')}}">
    <link rel="stylesheet" href="{{asset('backend/css/TableTools.css')}}">
    <style>
        #ToolTables_DataTables_Table_0_0{
            display: none;
        }
        .img-advertising {
            width: 20%;
            transition: 0.5s;
        }
        .img-advertising:hover {
            width: 40%;
            transition: 0.5s;
        }
        .border-red {
            border: 1px solid #f17676;
            background: #fff7f7;
        }
        .border-green {
            border: 1px solid #2ece31;
            background: #f7fff7;
        }
        .border-blue {
            border: 1px solid #2ececc;
            background: #f3fdff;
        }
    </style>
@endsection

@section('content')
    {{--<div class="row back-url">--}}
    {{--<div class="col-md-12">--}}
    {{--<a class="" href="{{ route('AdminDashboard') }}">صفحه اصلی</a><span class="now-url"> / نمایش اقامتگاه ها</span>--}}
    {{--</div>--}}
    {{--</div>--}}

    <style>
        .box h3 {
            width: 80%;
            margin: 15px auto;
            padding: 10px;
        }
        .box {
            padding: 20px;
            background: whitesmoke;
            width: 90%;
            margin: 0 auto;
            border-radius: 5px;
            transition: 0.5s;
            height: 250px;
            {{--background-image: url("{{asset('backend/css/5.png')}}");--}}
        }
        .box.b1:hover ,
        .box.b2:hover ,
        .box.b3:hover {
            background: #fff;
            transition: 0.3s;
            box-shadow: 0px 0px 15px 1px #fff;
            transition: 0.3s;
            border: 1px solid #ddd;
        }
        .box.b2 {
            box-shadow: 0px 0px 15px 1px #777;
            transition: 0.5s;
        }
        .box a {
            position: absolute;
            bottom: 15px;
            left: 30%;
        }
    </style>
    <div class="row">
        <div class="col-md-12">
            {{--@include('message.Message')--}}
            {{--@include('message.ErrorReporting')--}}
        </div>
    </div>
    <div class="row">
        <div class="col-md-12">
            <p class="alert alert-warning">
                لطفا قبل از ثبت اقامتگاه بسته مورد نظر خود را انتخاب کنید
            </p>
        </div>
    </div>
    <div class="row">
        <div class="col-md-12">
            <div class="panel panel-default">
                <div class="panel-heading">
                    <h3 class="panel-title">بسته ها</h3>
                </div>
                <div class="panel-body text-center">

                    <div class="col-md-4">
                        <div class="box b1">
                            <h3 class="text-info">بسته شماره 1</h3>
                            <p>ثبت ماهانه 1 اقامتگاه</p>
                            <p>دسترسی امکانات (پایه)</p>
                            <a href="{{route('PishFactor', ['type' => 1])}}" class="btn btn-default">خرید بسته10,000  <i class="fa fa-shopping-cart"> </i> </a>
                        </div>
                    </div>
                    <div class="col-md-4">
                        <div class="box b2">
                            <h3 class="text-success">بسته شماره 2</h3>
                            <p>ثبت ماهانه 3 اقامتگاه</p>
                            <p>دسترسی امکانات (پیشرفته)</p>
                            <p>دسترسی به گزارشات</p>
                            <a href="{{route('PishFactor', ['type' => 2])}}" class="btn btn-success">خرید بسته20,000  <i class="fa fa-shopping-cart"> </i> </a>
                        </div>
                    </div>
                    <div class="col-md-4">
                        <div class="box b3">
                            <h3 class="text-warning">بسته شماره 3</h3>
                            <p>ثبت ماهانه 5 اقامتگاه</p>
                            <p>دسترسی امکانات (پیشرفته)</p>
                            <p>دسترسی به گزارشات</p>
                            <p>ثبت تخفیفات در سیستم</p>
                            <a href="{{route('PishFactor', ['type' => 3])}}" class="btn btn-default">خرید بسته30,000 <i class="fa fa-shopping-cart"> </i> </a>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection


@section('script')

@endsection