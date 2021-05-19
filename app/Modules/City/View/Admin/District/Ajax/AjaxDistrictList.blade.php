@if(count($List) != 0)
    @foreach($List as $Item)
        <option hidden>انتخاب کنید</option>
        <option value="{{$Item->id}}">{{$Item->name}}</option>
    @endforeach
@else
    <option hidden>محله ای ثبت نشده است</option>
@endif