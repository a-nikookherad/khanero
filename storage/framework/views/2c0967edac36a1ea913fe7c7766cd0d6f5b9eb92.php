<div class="col-md-3 box-gallery-selector box-gallery<?php echo e($id); ?>" data-first-img="0">
    <div class="box-img-host">
        <img src="<?php echo e(asset('Uploaded/Gallery/Img'.'/'.$title)); ?>"/>
        <?php if($countGallery+1 == 1): ?>
            <span class="first-img">
                تصویر اصلی
            </span>
        <?php endif; ?>
    </div>
    <div class="box-img-remove">
        <button data-id="<?php echo e($id); ?>">حذف</button>
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
            url: '<?php echo e(route('RemoveImageHost')); ?>',
            type: 'post',
            data: {
                id: id,
                host_id: <?php echo e($hostId); ?>,
            },
            success: function (data) {
                $('.box-gallery'+data).remove();
            }
        });
    });
</script>