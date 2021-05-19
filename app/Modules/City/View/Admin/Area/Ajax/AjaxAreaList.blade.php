@if(count($List) != 0)
    @foreach($List as $Item)
        <option hidden>انتخاب کنید</option>
        <option value="{{$Item->id}}">{{$Item->name}}</option>
    @endforeach
@else
    <option value="0">منطقه ای ثبت نشده است</option>
@endif