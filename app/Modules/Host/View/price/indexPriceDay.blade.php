@extends('backend.MasterPage.Layout')
@section('title')
    ویلا :: نمایش اقامتگاه ها
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
    </style>
@endsection

@section('content')
    {{--<div class="row back-url">--}}
    {{--<div class="col-md-12">--}}
    {{--<a class="" href="{{ route('AdminDashboard') }}">صفحه اصلی</a><span class="now-url"> / نمایش اقامتگاه ها</span>--}}
    {{--</div>--}}
    {{--</div>--}}
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
                    <h3 class="panel-title">نمایش اقامتگاه ها</h3>
                </div>
                <div class="panel-body">

                    <div class="row">
                        <div class="col-md-4">
                            <div class="form-group">
                                <select id="SelectHostPrice" class="form-control">
                                    <option hidden>انتخاب کنید</option>
                                    @foreach($hostModel as $key => $value)
                                        <option id="{{$value->id}}">{{$value->name}}</option>
                                    @endforeach
                                </select>
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="box-price-host">
                            <div id="ExtraPrice">

                            </div>
                        </div>
                    </div>

                </div>
            </div>
        </div>
    </div>
@endsection


@section('script')
    <script>
        $(document).ready(function () {
            $('#SelectHostPrice'). on('change', function(){
                var loading = '<img style="width:45px; margin-right:50px;" src="{{ asset('backend/img/img_loading/orange_circles.gif') }}" />';
                $('#ExtraPrice').html(loading);
                var id = $(this).children(":selected").attr("id");
                $.ajaxSetup({
                    headers : {
                        'X-CSRF-TOKEN' : $('meta[name="csrf-token"]').attr('content')
                    }
                });
                $.ajax({
                    url: '{{route('GetPriceDay')}}',
                    type: 'post',
                    data: {id:id},
                    success: function (data) {
                        console.log(data);
                        $('#ExtraPrice').html(data);
                    }
                });
            });

            
        });
    </script>
@endsection