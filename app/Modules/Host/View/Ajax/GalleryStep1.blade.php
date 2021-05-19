<div class="col-md-4 box-gallery-selector box-gallery{{$id}}" data-first-img="0">
    <div class="box-img-host">
        <img src="{{asset('Uploaded/Gallery/Img'.'/'.$title)}}"/>
    </div>
    <div class="box-img-remove">
        <button data-id="{{$id}}">حذف</button>
    </div>
</div>
<script>
    $('.box-img-remove button').click(function () {
        var id = $(this).attr('data-id');
        $.ajaxSetup({
            headers : {
                'X-CSRF-TOKEN' : $('meta[name="csrf-token"]').attr('content')
            }
        });
        $.ajax({
            url: '{{route('RemoveImageHost')}}',
            type: 'post',
            data: {
                id: id,
                host_id: {{$hostId}},
            },
            success: function (data) {
                $('.box-gallery'+data).remove();
            }
        });
    });
</script>