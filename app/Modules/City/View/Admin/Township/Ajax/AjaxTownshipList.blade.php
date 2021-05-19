@if(count($List) != 0)
    @foreach($List as $Item)
        <option value="" hidden>انتخاب کنید</option>
        <option value="{{$Item->id}}">{{$Item->name}}</option>
    @endforeach
@else
    <option value="0">شهرستانی ثبت نشده است</option>
@endif