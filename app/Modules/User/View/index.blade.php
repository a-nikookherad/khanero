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
                    <h3 class="panel-title">گزارش کاربران</h3>

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
                            <th>ورود</th>
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
                                    <a href="{{ url('detail/user').'/'. $value->id }}" class="btn btn-default btn-block"><i class="fa fa-list-alt"></i>&nbsp;</a>
                                </td>
                                <td>
                                    <label id="btnActiveUser{{$key+1}}" onclick="ajaxActive('{{ $value->id }}','{{$key+1}}');" class="btn btn-default btn-block">
                                        @if($value->active == 1) <i class="fa fa-check text-success"></i> @else <i class="fa fa-plus text-danger" style="transform: rotate(45deg)"></i> @endif
                                    </label>
                                </td>
                                <td>
                                    <a href="{{route('LoginUser', ['id' => $value->id])}}"  class="btn btn-default btn-block">
ورود
                                    </a>
                                </td>
                                <td class="">
                                    {{\Morilog\Jalali\Facades\jDate::forge($value->created_at)->format('Y/m/d')}}
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