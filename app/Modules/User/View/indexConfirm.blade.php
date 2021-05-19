@extends('backend.MasterPage.Layout')
@section('title',TitlePage('نمایش کاربران ویژه'))
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
            <span class="now-url"> / نمایش کاربران ویژه</span>
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
                    <h3 class="panel-title">گزارش کاربران ویژه</h3>

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
                                    <a href="{{ route('DetailConfirmUser', ['id' => $value->id]) }}" class="btn btn-default btn-block"><i class="fa fa-list-alt"></i>&nbsp;</a>
                                </td>
                                <td>
                                    <label class="btn btn-block @if($value->confirm_user == 2) btn-primary @elseif($value->confirm_user == 3) btn-success @elseif($value->confirm_user == -1) btn-warning @endif">
                                        @if($value->confirm_user == 2) در حال بررسی @elseif($value->confirm_user == 3) تایید شده @elseif($value->confirm_user == -1) بررسی مجدد @endif
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





@endsection

@section('script')
    <script src="{{asset('frontend/js/script.js')}}" type="text/javascript"></script>
    <script type="text/javascript" src="{{asset('backend/js/jquery.dataTables.min.js')}}"></script>
    <script type="text/javascript" src="{{asset('backend/js/TableTools.min.js')}}"></script>
    <script type="text/javascript" src="{{asset('backend/js/dataTables.bootstrap.js')}}"></script>
    <script type="text/javascript" src="{{asset('backend/js/editable-datatables.js')}}"></script>
@endsection

<script>


    $( "h3" ).parent( ".panel-heading" ).css( "background", "red" );
    $( "label" ).parent( "#DataTables_Table_0_length" ).css( "background", "yellow" );

    $('label').parent('#DataTables_Table_0_length').innerHTML = 'your tip has been submitted!';



    function ajaxActive(id,idInput) {
        $.ajax({
            url:"{{ url('active/user').'/'}}"+id+"/active",
            method:"get",
        }).done(function(returnData){
            if(returnData == 'active')
            {
                // console.log('active');
                $("#btnActiveUser"+idInput).addClass('btn-default');
                $("#btnActiveUser"+idInput).removeClass('btn-default');
                $("#btnActiveUser"+idInput).css("transition", "0.5s");
                $("#btnActiveUser"+idInput).text('');
                $("#btnActiveUser"+idInput).append('<i class="fa fa-check text-success"></i>');
            }
            else if(returnData == 'deactive')
            {
                // console.log('deactive');
                $("#btnActiveUser"+idInput).addClass('btn-default');
                $("#btnActiveUser"+idInput).removeClass('btn-default');
                $("#btnActiveUser"+idInput).css("transition", "0.5s");
                $("#btnActiveUser"+idInput).text('');
                $("#btnActiveUser"+idInput).append('<i class="fa fa-plus text-danger" style="transform: rotate(45deg)"></i>');
            }
        });
    }










    var ss = $('label').parent('#DataTables_Table_0_length');
    console.log('***************');
    console.log(ss);
    console.log('***************');



    $( "h3" ).parent( ".panel-heading" ).css( "background", "red" );
    $( "label" ).parent( "#DataTables_Table_0_length" ).css( "background", "yellow" );

    $('label').parent('#DataTables_Table_0_length').innerHTML = 'your tip has been submitted!';



</script>