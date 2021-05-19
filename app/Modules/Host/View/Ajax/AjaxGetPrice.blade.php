<form action="{{route('UpdatePriceHost')}}" method="post">
    {{csrf_field()}}
    <input type="hidden" value="{{$priceDayModel[0]->host_id}}" name="host_id" id="host_id" />
    @foreach($weekModel as $key => $value)
        <div class="col-md-3">
            <div class="form-group">
                <label for="Input{{$value->e_day}}day">{{$value->day}}</label>
                @foreach($priceDayModel as $item => $index)
                    @if($index->week_id == $value->id)
                        <input type="number" name="{{$value->e_day}}" id="Input{{$value->e_day}}" class="form-control" value="{{$index->price}}" placeholder="0" />
                    @endif
                @endforeach
            </div>
        </div>
    @endforeach
    <div class="col-md-12">
        <button type="submit" class="btn btn-block btn-primary" id="BtnChangePrice">ثبت تغییرات</button>
    </div>
</form>


<script>
    $('#BtnChangePrice').click(function () {
        var host_id = $('#host_id').val();
        console.log(host_id);
    });
</script>