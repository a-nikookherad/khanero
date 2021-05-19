@extends('backend.MasterPage.Layout')
@section('title', TitlePage('نظرات و امتیازات'))
@section('style')
    <link rel="stylesheet" href="{{asset('backend/css/dataTables.bootstrap.css')}}">
    <link rel="stylesheet" href="{{asset('backend/css/TableTools.css')}}">
    <style>
        #ToolTables_DataTables_Table_0_0{
            display: none;
        }

        li.li-comment {
            background: #ffe9cf;
        }
    </style>
    <link rel="stylesheet" href="{{ asset('backend/css/bootstrap-datepicker.min.css')}}"/>
@endsection

@section('content')
    <div class="row back-url">
        <div class="col-md-12">
            <a class="" href="{{ route('UserDashboard') }}">صفحه اصلی</a><span class="now-url"> / رزرو اقامتگاه های من</span>
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
            <div class="panel panel-primary">
                <div class="panel-heading">
                    <h3 class="panel-title">رزرو اقامتگاه های من</h3>
                </div>
                <div class="panel-body">
                    <table cellpadding="0" cellspacing="0" border="0"
                           class="table table-bordered editable-datatable">
                        <thead>
                        <tr>
                            <th>ردیف</th>
                            <th>نام اقامتگاه</th>
                            <th>امتیاز گرفته شده</th>
                        </tr>
                        </thead>
                        <tbody>
                        @foreach($rateModel as $key => $value)
                            <tr class="1">
                                <td>
                                    {{ $key+1 }}
                                </td>
                                <td>
                                    {{$value->getHost->name}}
                                </td>
                                <td>
                                    <span class="event_star star_big" data-starnum="{{$key+1}}">
                                       <i></i>
                                    </span>
                                    @php
                                        $avg = $value->sum/$value->count;
                                    @endphp
                                    <style>
                                        .star_big[data-starnum="{{$key+1}}"] i {
                                            width: {{$avg*30}}px;
                                        }
                                    </style>
                                </td>
                            </tr>
                        @endforeach
                        </tbody>

                    </table>
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


    <script type="text/javascript">



    </script>

@endsection


<script type="text/javascript">

</script>
