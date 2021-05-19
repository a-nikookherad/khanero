@extends('backend.MasterPage.Layout')
@section('title', TitlePage('نمایش محتوا'))
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
            <span class="now-url"> / مدیریت محتوا</span>
        </div>
    </div>
    <div class="row">
        <div class="col-md-12">
            @include('message.Message')
            @include('message.ErrorReporting')
        </div>
    </div>
    <div class="row">
        <div class="col-md-12" style="margin-bottom: 10px;">
            <a href="{{ route('CreateContent') }}" class="btn btn-default">ایجاد محتوای جدید<i style="font-size: 18px;" class="text-success fa fa-plus-square-o"></i> </a>
        </div>
        <div class="col-md-12">
            <div class="panel panel-default">
                <div class="panel-heading">
                    <h3 class="panel-title">نمایش محتویات</h3>
                </div>
                <div class="panel-body">
                    <table cellpadding="0" cellspacing="0" border="0" class="table table-striped table-bordered editable-datatable">
                        <thead>
                            <tr>
                                <th>ردیف</th>
                                <th>عنوان محتوا</th>
                                <th>ویرایش محتوا</th>
                                <th>وضعیت</th>
                                <th>تاریخ ثبت</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach($contentModel as $key => $value)
                                <tr class="1">
                                    <td>
                                        {{ $key+1 }}
                                    </td>
                                    <td>
                                        {{ $contentModel[$key]->title }}
                                    </td>
                                    <td>
                                        <a href="{{ url('edit/content').'/'.$value->id }}" class="btn btn-default btn-block">
                                            <i class="fa fa-edit"></i>&nbsp;
                                        </a>
                                    </td>
                                    <td>
                                        <label id="btnActiveContent{{$key+1}}" onclick="ajaxActiveContent('{{ $value->id }}','{{$key+1}}');" class="btn btn-default btn-block">
                                            @if($value->active == 1) <i class="fa fa-check text-success"></i> @else <i class="fa fa-plus text-danger" style="transform: rotate(45deg)"></i> @endif
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

    <script type="text/javascript">
        function ajaxActiveContent(id,idInput) {
            $.ajax({
                url:"{{ url('active/content').'/'}}"+id+"/active",
                method:"get",
            }).done(function(returnData){
                if(returnData == 'active')
                {
                    $("#btnActiveContent"+idInput).addClass('btn-default');
                    $("#btnActiveContent"+idInput).removeClass('btn-default');
                    $("#btnActiveContent"+idInput).css("transition", "0.5s");
                    $("#btnActiveContent"+idInput).text('');
                    $("#btnActiveContent"+idInput).append('<i class="fa fa-check text-success"></i>');
                }
                else if(returnData == 'deactive')
                {
                    // console.log('deactive');
                    $("#btnActiveContent"+idInput).addClass('btn-default');
                    $("#btnActiveContent"+idInput).removeClass('btn-default');
                    $("#btnActiveContent"+idInput).css("transition", "0.5s");
                    $("#btnActiveContent"+idInput).text('');
                    $("#btnActiveContent"+idInput).append('<i class="fa fa-plus text-danger" style="transform: rotate(45deg)"></i>');
                }
            });
        }
    </script>
