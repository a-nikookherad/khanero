@extends('backend.MasterPage.Layout')
@section('title',TitlePage('نمایش کاربران'))
@section('style')

    <link rel="stylesheet" href="{{asset('backend/css/dataTables.bootstrap.css')}}">
    <link rel="stylesheet" href="{{asset('backend/css/TableTools.css')}}">
    <style>
        #ToolTables_DataTables_Table_0_0{
            display: none;
        }
    </style>
@endsection
@section('content')
    <div class="row back-url">
        <div class="col-md-12">
            <a class="" href="{{ route('AdminDashboard') }}">صفحه اصلی</a>
            <span class="now-url"> / نمایش کاربران</span>
        </div>
    </div>
    <div class="row">
        <div class="col-md-12">
            <div class="panel panel-default">
                <div class="panel-heading">
                    <h3 class="panel-title">گزارش کاربران(زیر مجموعه)</h3>

                </div>
                <div class="panel-body">

                    <table cellpadding="0" cellspacing="0" border="0"
                           class="table table-striped table-bordered editable-datatable">
                        <thead>
                        <tr>
                            <th>ردیف</th>
                            <th>نام</th>
                            <th>شماره موبایل</th>
                            <th>نمایش جزئیات</th>
                            <th>وضعیت</th>
                            <th>تاریخ ثبت نام</th>
                        </tr>
                        </thead>
                        <tbody>
                        @foreach($userModel as $key => $value)
                            <tr class="1">
                                <td>
                                    {{ $key+1 }}
                                </td>
                                <td>
                                    {{ $value->first_name.' '.$value->last_name }}
                                </td>
                                <td>
                                    {{ $value->mobile }}
                                </td>
                                <td>
                                    <label class="btn btn-default" onclick="ShowChart({{$value->id}})">
                                        <i class="fa fa-bar-chart-o"></i>
                                    </label>
                                </td>
                                <td>
                                    <label class="text-default">
                                        @if($value->active == 1)
                                            فعال
                                        @else
                                            غیر فعال
                                        @endif
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

                </div>
            </div>
        </div>
    </div>

    <!-- Modal -->
    <div class="modal fade" id="myModal" role="dialog">
        <div class="modal-dialog modal-sm">

            <!-- Modal content-->
            <div class="modal-content">
                <div class="modal-header">
                    <button type="button" class="close" data-dismiss="modal">&times;</button>
                    <h4 class="modal-title">test</h4>
                </div>
                <div class="modal-body">
                    <p>test body.</p>
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

    <script>
        $(document).ready(function (e) {

            $.ajaxSetup({
                headers: {
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                }
            });


        });
        function ShowChart(id) {
            {{--$.ajax({--}}
                {{--url: "{{route('ChartReagentUser')}}",--}}
                {{--method: "post",--}}
                {{--data: {--}}
                    {{--id: id,--}}
                {{--},--}}
            {{--}).done(function (returnData) {--}}
                {{--//$('#myModal').modal('show');--}}
                {{--console.log(returnData);--}}
            {{--});--}}
        }
    </script>
@endsection
