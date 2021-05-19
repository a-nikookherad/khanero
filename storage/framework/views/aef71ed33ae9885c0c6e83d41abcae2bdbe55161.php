<?php if(count($discountModel) > 0): ?>
    <table class="table table-bordered">
    <thead>
        <th>ردیف</th>
        <th>تعداد روز</th>
        <th>تخفیف</th>
        <th>حذف</th>
    </thead>
    <tbody>
        <?php $__currentLoopData = $discountModel; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $key => $value): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
            <tr class="tr<?php echo e($value->id); ?>">
                <td><?php echo e($key + 1); ?></td>
                <td><?php echo e($value->number_days); ?></td>
                <td><?php echo e($value->percent); ?></td>
                <td><button class="btn-danger btn" onclick="DeleteDiscount(<?php echo e($value->id); ?>)">حذف</button></td>
            </tr>
        <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
    </tbody>
</table>
<script>
    function DeleteDiscount(id) {
        var loading = '<img style="width:45px; margin-right:50px;" src="<?php echo e(asset('backend/img/img_loading/orange_circles.gif')); ?>" />';
        $('#ExtraDiscount').html(loading);
        $.ajaxSetup({
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            }
        });
        $.ajax({
            url: '<?php echo e(route('DeleteDiscountAjax')); ?>',
            type: 'post',
            data: {
                id: id,
                host_id: $('#host_id').val(),
            },
            success: function (data) {
                if (data.Success == 1) {
                    $('#ExtraDiscount').html(data.Content.original);
                    $.Toast("<p>تخفیف</p>", "<p>" + data.Message + " .</p>", "success", {
                        has_icon: true,
                        has_close_btn: true,
                        stack: true,
                        fullscreen: false,
                        timeout: 4000,
                        sticky: false,
                        has_progress: true,
                        rtl: true,
                    });
                }
            }
        });
    }
</script>
<?php else: ?>
    <div class="row">
        <div class="col-md-12">
            <div class="alert alert-warning">
                <p>تخفیفی در سیستم به ثبت نرسیده است.</p>
            </div>
        </div>
    </div>
<?php endif; ?>