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
            background-image: url("{{asset('backend/css/5.png')}}");
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
@endsection

@section('content')
    <div class="row">
        <div class="col-md-12">
            {{--@include('message.Message')--}}
            {{--@include('message.ErrorReporting')--}}
        </div>
    </div>
    <div class="row">
        <div class="col-md-12">
            <div class="panel panel-default">
                <div class="panel-heading">
                    <h3 class="panel-title">پیش فاکتور</h3>
                </div>
                <div class="panel-body text-center">

                    <table class="table table-bordered">
                        <tr>
                            <td>
                                بسته انتخابی
                            </td>
                            <td class="text-success">
                                @if($type == 1)
                                    بسته شماره {{$type}}
                                @elseif($type == 2)
                                    بسته شماره {{$type}}
                                @else
                                    بسته شماره {{$type}}
                                @endif
                            </td>
                        </tr>
                        <tr>
                            <td>
                                هزینه بسته
                            </td>
                            <td class="text-success">
                                @if($type == 1)
                                    10,000 تومان
                                @elseif($type == 2)
                                    20,000 تومان
                                @else
                                    30,000 تومان
                                @endif
                            </td>
                        </tr>
                        <tr>
                            <td>
                                زمان خرید
                            </td>
                            <td class="text-success">
                                {{\Morilog\Jalali\Facades\jDate::forge(date('H:i:s'))->format('Y/m/d - H:i:s')}}
                            </td>
                        </tr>
                    </table>

                    <div class="row text-center">
                        <button class="btn btn-success">اتصال به درگاه بانک</button>
                    </div>

                </div>
            </div>
        </div>
    </div>
@endsection


@section('script')

@endsection