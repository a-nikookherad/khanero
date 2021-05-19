<?php if(count($List) != 0): ?>
    <?php $__currentLoopData = $List; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $Item): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
        <option value="" hidden>انتخاب کنید</option>
        <option value="<?php echo e($Item->id); ?>"><?php echo e($Item->name); ?></option>
    <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
<?php else: ?>
    <option value="0">شهرستانی ثبت نشده است</option>
<?php endif; ?>