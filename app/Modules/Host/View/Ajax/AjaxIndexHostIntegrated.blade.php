<hr />
<h4 class="text-success">{{$integratedModel->title}}</h4>
<table cellpadding="0" cellspacing="0" border="0"
       class="table table-striped table-bordered editable-datatable">
    <thead>
    <tr>
        <th>ردیف</th>
        <th>نام اقامتگاه</th>
        <th>استان</th>
        <th>تقویم</th>
        <th>ویرایش</th>
        <th>وضعیت</th>
        <th>تایید مدیریت</th>
        @if(auth()->user()->role_id == 1)
            <th>ارسال پیامک</th>
        @endif
        <th>تاریخ ایجاد</th>
    </tr>
    </thead>
    <tbody>
    @foreach($hostModel as $key => $value)
        <tr class="1">
            <td>
                {{ $key+1 }}
            </td>
            <td>
                {{ $value->name }}
            </td>
            <td>
                @if($Province = $value->getProvince)
                    {{ $Province->name }}
                @else
                    -
                @endif
            </td>
            <td>
                <a href="{{route('IndexPersonalize', ['id' => $value->id])}}" class="btn btn-default btn-block"><i class="fa fa-briefcase"></i> </a>
            </td>
            <td>
                <a href="{{route('EditHost', ['id' => $value->id])}}" class="btn btn-default btn-block">
                    <i class="fa fa-edit"></i>
                </a>
            </td>
            <td>
                <label id="btnActiveHostIntegrated{{$key+1}}" onclick="ajaxActiveHost('{{ $value->id }}','{{$key+1}}');" class="@if($value->active == 1) btn btn-default btn-block @else btn btn-default btn-block @endif">
                    @if($value->active == 1) فعال @else غیرفعال @endif
                </label>
            </td>
            <td>
                <label @if(auth()->user()->role_id == 1) id="btnStatusHost{{$key+1}}" onclick="ajaxStatusHost('{{ $value->id }}','{{$key+1}}');" @endif class="btn btn-default btn-block @if($value->status == 1) border-green @elseif($value->status == 2) border-red @else border-blue @endif">
                    @if($value->status == 0) درانتظار تایید @elseif($value->status == 1) تایید شده@else تایید نشده @endif
                </label>
            </td>
            @if(auth()->user()->role_id == 1)
                <td>
                    <label onclick="ajaxStatusSuccessHost('{{ $value->id }}');" class="btn btn-default text-success btn-block">
                        ارسال پیام تایید
                    </label>
                </td>
            @endif
            <td>
                @php(
                    $created_date = \Morilog\Jalali\Facades\jDate::forge($value->created_at)->format('Y/m/d')
                )
                {{ $created_date }}
            </td>
        </tr>
    @endforeach
    </tbody>
</table>

<script>
    function ajaxActiveHost(id,idInput) {
        $.ajax({
            url:"{{ url('active/host').'/'}}"+id,
            method:"get",
        }).done(function(returnData){
            // console.log(returnData);
            if(returnData == 'active')
            {
                // console.log('active');
                $("#btnActiveHostIntegrated"+idInput).addClass('btn-default');
                $("#btnActiveHostIntegrated"+idInput).removeClass('btn-default');
                $("#btnActiveHostIntegrated"+idInput).css("transition", "0.5s");
                $("#btnActiveHostIntegrated"+idInput).text('');
                $("#btnActiveHostIntegrated"+idInput).append('فعال');
            }
            else if(returnData == 'deactive')
            {
                // console.log('deactive');
                $("#btnActiveHostIntegrated"+idInput).addClass('btn-default');
                $("#btnActiveHostIntegrated"+idInput).removeClass('btn-default');
                $("#btnActiveHostIntegrated"+idInput).css("transition", "0.5s");
                $("#btnActiveHostIntegrated"+idInput).text('');
                $("#btnActiveHostIntegrated"+idInput).append('غیرفعال');
            }
        });
    }
</script>