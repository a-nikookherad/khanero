<form role="form" action="<?php echo e(route('UpdateRule')); ?>" method="post" enctype="multipart/form-data" id="FormUpdate">
    <?php echo e(csrf_field()); ?>

    <div class="row">
        <input type="hidden" name="rule_id" value="<?php echo e($ruleModel->id); ?>" />
        <div class="col-md-12">
            <div class="form-group">
                <input type="text" name="name" value="<?php echo e($ruleModel->name); ?>" class="form-control" />
            </div>
        </div>
        <div class="col-md-12">
            <div class="form-group">
                <input type="text" name="description" value="<?php echo e($ruleModel->description); ?>" class="form-control" />
            </div>
        </div>
        <br />
        <div class="col-md-12">
            <div class="form-group">
                <input type="submit" class="btn btn-primary btn-block" value="ثبت ویرایش" />
            </div>
        </div>
    </div>

</form>