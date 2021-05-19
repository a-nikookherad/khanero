<form role="form" action="<?php echo e(route('UpdateRule')); ?>" method="post" enctype="multipart/form-data" id="FormUpdate">
    <?php echo e(csrf_field()); ?>

    <input type="hidden" name="rule_id" value="<?php echo e($ruleModel->id); ?>" />
    <input type="text" name="name" value="<?php echo e($ruleModel->name); ?>" class="form-control" />
    <br />
    <input type="submit" class="btn btn-primary btn-block" value="ثبت ویرایش" />

</form>