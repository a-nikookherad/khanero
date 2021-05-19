
<select id="{{$Name}}" name="{{$Name}}"  data-placeholder="نتیجه ای برای نمایش وجود ندارد" tabindex="-1" class="chosen-with-diselect  span10 EditProvince" id="selCSI">
    @foreach($Province as $Item)
        <option value="{{$Item->id}}" @if($Old==$Item->id) selected @endif>{{$Item->name}}</option>
    @endforeach
</select>

<script type="text/javascript" src="{{asset('backend/assets/chosen-bootstrap/chosen/chosen.jquery.min.js')}}"></script>
<script type="text/javascript">
    $("#"+'{{$Name}}').chosen();
</script>
