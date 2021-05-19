<?php $__env->startSection('title'); ?>
    داشبورد
<?php $__env->stopSection(); ?>

<?php $__env->startSection('style'); ?>
    <link href="<?php echo e(url('backend/css/style-custom-panel.css')); ?>" type="text/css" rel="stylesheet" />
<?php $__env->stopSection(); ?>

<?php $__env->startSection('headerSection'); ?>

<?php $__env->stopSection(); ?>

<?php $__env->startSection('content'); ?>
    <div class="row text-center">
        <div class="col-md-2">
            <a href="<?php echo e(route('EditUser')); ?>">
                <div class="box-panel">
                    <i class="fa fa-user"></i>
                    <h5>
                        ویرایش اطلاعات
                    </h5>
                </div>
            </a>
        </div>
        <div class="col-md-2">
            <a href="<?php echo e(route('IndexMessage')); ?>">
                <div class="box-panel">
                    <i class="fa fa-dropbox"></i>
                    <h5>
                        پیام ها <span class="text-info numberMessageUser"></span>
                    </h5>
                </div>
            </a>
        </div>
        <div class="col-md-2">
            <a href="<?php echo e(route('HostFactor')); ?>">
                <div class="box-panel">
                    <i class="fa fa-user"></i>
                    <h5>
                        خرید بسته
                    </h5>
                </div>
            </a>
        </div>
        <div class="col-md-2">
            <a href="<?php echo e(route('IndexChargeWallet')); ?>">
                <div class="box-panel">
                    <i class="fa fa-user"></i>
                    <h5>
                        شارژ کیف پول
                    </h5>
                </div>
            </a>
        </div>
    </div>
<?php $__env->stopSection(); ?>


<?php $__env->startSection('script'); ?>
    <script type="text/javascript">
        var id = <?php echo e(auth()->user()->id); ?>;
        $.ajax({
            url:"<?php echo e(url('message/get/number').'/'); ?>"+id,
            method:"get",
        }).done(function(returnData){
            $('.numberMessageUser').text(returnData);
        });
    </script>
<?php $__env->stopSection(); ?>
<?php echo $__env->make('backend.MasterPage.Layout', array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>