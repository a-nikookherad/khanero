@if(count($List) != 0)
    @foreach($List as $Item)
        <option value="{{$Item->id}}">{{$Item->name}}</option>
    @endforeach
@else
    <option value="306">محله ثبت نشده</option>
@endif