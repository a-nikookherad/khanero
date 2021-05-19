@extends('backend.MasterPage.Layout')
@section('title', TitlePage('علاقه مندی ها'))
@section('style')
    <link rel="stylesheet" href="{{asset('backend/css/dataTables.bootstrap.css')}}">
    <link rel="stylesheet" href="{{asset('backend/css/TableTools.css')}}">
    <style>
        #ToolTables_DataTables_Table_0_0{
            display: none;
        }

        li.li-favorite {
            background: #ffe9cf;
        }
    </style>
    <link rel="stylesheet" href="{{ asset('backend/css/bootstrap-datepicker.min.css')}}"/>
@endsection

@section('content')
    {{--<div class="row back-url">--}}
        {{--<div class="col-md-12">--}}
            {{--<a class="" href="{{ route('AdminDashboard') }}">صفحه اصلی</a><span class="now-url"> / نمایش علاقه مندی ها</span>--}}
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
                    <h3 class="panel-title">نمایش علاقه مندی ها</h3>
                </div>
                <div class="panel-body">
                    @php($i = 1)
                    @foreach($favoriteModel as $key => $value)
                        @if($i == 5)
                            @php($i = 1)
                        @endif
                        @if($i == 1)
                            <div class="row">
                        @endif
                            <div class="col-md-3 box-favorite">
                                <div class="bx-favor">
                                    <label data-toggle="modal" data-target="#myModal" onclick="ajaxDeleteFavorite('{{$value->id}}');" class="btn btn-default btn-block btn-dlet"><i class="fa fa-trash-o"></i></label>
                                    <a href="{{route('DetailHost', ['id' => $value->host_id])}}" target="_blank"><img src="{{asset('Uploaded/Gallery/Img').'/'.$value->getHost->getGallery[0]->img}}" /></a>
                                    <a href="{{route('DetailHost', ['id' => $value->host_id])}}" target="_blank"><h5 class="name-qw">{{$value->getHost->name}}</h5></a>
                                </div>
                            </div>

                            @php($i++)
                        @if($i == 5)
                            </div>
                        @endif
                    @endforeach
                    @if(count($favoriteModel) == 0)
                        <div class="row">
                            <div class="alert alert-warning">
                                <p>هیچ گونه علاقه مندی در سیستم به ثبت نرسیده است .</p>
                            </div>
                        </div>
                    @endif
                    {{--edit menu modal--}}
                    <div class="modal fade" id="myModal" role="dialog">
                        <div class="modal-dialog modal-md">
                            <!-- Modal content-->
                            <div class="modal-content">
                                <div class="modal-header">
                                    <button type="button" class="close" data-dismiss="modal">&times;</button>
                                    <h4 class="modal-title">حذف علاقه مندی</h4>
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
    <script src="{{asset('backend/js/bootstrap-datepicker.min.js')}}"></script>
    <script src="{{asset('backend/js/bootstrap-datepicker.fa.min.js')}}"></script>

    <script>


        $("#InputDateSpecial").datepicker({
            minDate: 0,
            changeMonth: true,
            changeYear: true,
            isRTL: true,
            dateFormat: "yy/mm/dd",
            EnableTimePicker: true,
        });

        function ajaxDeleteFavorite(id) {
            console.log(id);
            var img = '<div class="text-center"><img style="height:50px;width:auto;" src="{{ asset('backend/img/img_loading/orange_circles.gif') }}" /></div>';
            $('#ExtraModalEdit').html(img);
            $.ajax({
                url:"{{ url('delete/favorite').'/'}}"+id,
                method:"get",
            }).done(function(returnData) {
                $('#ExtraModalEdit').html(returnData);
            })
        }
        
    </script>
@endsection