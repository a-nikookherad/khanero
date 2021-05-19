@extends('backend.MasterPage.Layout')
@section('title', TitlePage('تراکنش ها'))
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
            <a class="" href="{{ route('AdminDashboard') }}">صفحه اصلی</a>/
            <a class="" href="{{ route('ContactUsFormAdmin') }}">تماس با ما</a>
            <span class="now-url"> / نمایش پیام های دریافتی</span>
        </div>
    </div>
    <div class="row">
        <div class="col-md-12">
            <div class="panel panel-primary">
                <div class="panel-heading">
                    <h3 class="panel-title">پیام های دریافتی</h3>
                </div>
                <div class="panel-body">

                    <table cellpadding="0" cellspacing="0" border="0" class="table table-striped table-bordered editable-datatable">
                        <thead>
                        <tr>
                            <th>ردیف</th>
                            <th>نام</th>
                            <th>موضوع</th>
                            <th>تلفن تماس</th>
                            <th>ایمیل</th>
                            <th>مشاهده پیام</th>
                            <th>وضعیت</th>
                            <th>تاریخ ارسال</th>
                        </tr>
                        </thead>
                        <tbody>
                        @foreach($contactModel as $key => $value)
                            <tr class="1 @if($value->view == 1) text-muted @endif">
                                <td>
                                    {{ $key+1 }}
                                </td>
                                <td>
                                    {{ $value->name }}
                                </td>
                                <td>
                                    {{ $value->subject }}
                                </td>
                                <td>
                                    {{ $value->phone }}
                                </td>
                                <td>
                                    {{ $value->email }}
                                </td>
                                <td>
                                    <a href="{{ url('read/contact/message').'/'.$value->id }}" class="btn btn-default btn-block"><i class="fa fa-eye"></i></a>
                                </td>
                                <td>
                                    <label class="@if($value->view == 0) btn btn-success btn-block @else btn btn-default btn-block @endif">
                                        @if($value->view == 1) خوانده شده @else جدید @endif
                                    </label>
                                </td>
                                <td class="">
                                    @php(
                                        $register_date = \Morilog\Jalali\Facades\jDate::forge($value->created_at)->format('Y/m/d')
                                    )
                                    {{ $register_date }}
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
    <script type="text/javascript" src="{{asset('backend/js/jquery.dataTables.min.js')}}"></script>
    <script type="text/javascript" src="{{asset('backend/js/TableTools.min.js')}}"></script>
    <script type="text/javascript" src="{{asset('backend/js/dataTables.bootstrap.js')}}"></script>
    <script type="text/javascript" src="{{asset('backend/js/editable-datatables.js')}}"></script>
@endsection