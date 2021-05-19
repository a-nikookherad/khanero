<?php if($result['status'] == 2): ?>
    <form action="<?php echo e(route('DeleteReserveByClient')); ?>" method="post">
        <?php echo e(csrf_field()); ?>

        
        <input type="hidden" value="<?php echo e($code); ?>" name="group_code" />
        
        
        
        <div class="row">
            <div class="col-md-12">
                <div class="form-group">
                    <h5>آیا از حذف مطمئن هستید ؟</h5>
                </div>
            </div>
        </div>
        <div class="row">
            <div class="col-md-6">
                <div class="form-group">
                    <h6> مبلغ کل رزرو : <?php echo e(number_format($result['total'])); ?> تومان </h6>
                </div>
            </div>
            <div class="col-md-6">
                <div class="form-group">
                    <h6> مبلغ پرداخت شده : <?php echo e(number_format($result['paid'])); ?> تومان </h6>
                </div>
            </div>
        </div>
        <div class="row">
            <div class="col-md-6">
                <div class="form-group">
                    <h6> درصد سایت + دعوت از دوستان : <?php echo e(number_format($result['site_percent'])); ?> تومان </h6>
                </div>
            </div>
            <div class="col-md-6">
                <div class="form-group">
                    <h6> مبلغ جریمه : <?php echo e(number_format($result['penalty'])); ?> تومان </h6>
                </div>
            </div>
        </div>
        <div class="row">
            <div class="col-md-6">
                <div class="form-group">
                    <h6> مبلغ کل جریمه : <?php echo e(number_format($result['site_percent']+$result['penalty'])); ?> تومان </h6>
                </div>
            </div>
        </div>
        <div class="row">
            <div class="col-md-6">
                <div class="form-group">
                    <h5 class="text-green"> مبلغ بازگشتی : <?php echo e(number_format($result['final'])); ?> تومان </h5>
                </div>
            </div>
        </div>
        <div class="row">
            <div class="col-md-12">
                <div class="form-group">
                    <h6>قوانین <?php echo e($result['cancel_rule']['name']); ?> :</h6>
                </div>
            </div>
            <div class="col-md-12">
                <div class="form-group">
                    <h6><?php echo e($result['cancel_rule']['time'][1]['description']); ?></h6>
                    <h6><?php echo e($result['cancel_rule']['time'][2]['description']); ?></h6>
                    <h6><?php echo e($result['cancel_rule']['time'][3]['description']); ?></h6>
                </div>
            </div>
        </div>
        <br />
        <div class="row">
            <div class="col-md-6">
                <div class="form-group">
                    <button type="submit" class="btn btn-block btn-danger input-sm">انصراف از رزرو</button>
                </div>
            </div>
            <div class="col-md-6">
                <div class="form-group">
                    <button type="button" class="btn btn-block btn-default input-sm" data-dismiss="modal">انصراف</button>
                </div>
            </div>
        </div>
    
    </form>
<?php elseif($result['status'] == -2): ?>
    <div class="alert alert-warning">
        <p>در خواست شما برای انصراف قبلا در سیستم ثبت شده است.</p>
    </div>
<?php elseif($result['status'] == 400): ?>
    <div class="alert alert-info">
        <p>دسترسی به انصراف با توجه به زمان رزرو بسته شده است.</p>
    </div>
<?php else: ?>
    <form action="<?php echo e(route('DeleteReserveByClient')); ?>" method="post">
        <?php echo e(csrf_field()); ?>

        <input type="hidden" value="<?php echo e($code); ?>" name="group_code" />
        <div class="row">
            <div class="col-md-12">
                <div class="alert alert-warning">
                    <p>آیا از لغو درخواست خود اطمینان دارید؟</p>
                </div>
            </div>
            <div class="col-md-6">
                <div class="form-group">
                    <button type="submit" class="btn btn-block btn-danger input-sm">بله</button>
                </div>
            </div>
            <div class="col-md-6">
                <div class="form-group">
                    <button type="button" class="btn btn-block btn-default input-sm" data-dismiss="modal">خیر</button>
                </div>
            </div>
        </div>
    </form>
<?php endif; ?>