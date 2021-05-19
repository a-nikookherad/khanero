

<?php $__env->startSection('title'); ?>
    داشبورد
<?php $__env->stopSection(); ?>

<?php $__env->startSection('style'); ?>
    <link href="<?php echo e(url('backend/css/style-custom-panel.css')); ?>" type="text/css" rel="stylesheet" />
<?php $__env->stopSection(); ?>

<?php $__env->startSection('headerSection'); ?>

<?php $__env->stopSection(); ?>

<?php $__env->startSection('content'); ?>
    <div class="row">
        <div class="col-md-12">
            <?php echo $__env->make('message.Message', array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>
            <?php echo $__env->make('message.ErrorReporting', array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>
        </div>
    </div>
    <div class="row text-center row-link-dashboard">
        <div class="col-md-2">
            <a href="<?php echo e(route('EditUser')); ?>">
                <div class="box-panel">
                    <i class="fa fa-edit"></i>
                    <h5>
                        اطلاعات کاربری
                    </h5>
                </div>
            </a>
        </div>
        <div class="col-md-2">
            <a href="<?php echo e(route('IndexUser')); ?>">
                <div class="box-panel">
                    <i class="fa fa-users"></i>
                    <h5>
                        نمایش اعضا
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
            <a href="<?php echo e(route('ContactUsFormAdmin')); ?>">
                <div class="box-panel">
                    <i class="fa fa-phone"></i>
                    <h5>
                        تماس با ما
                    </h5>
                </div>
            </a>
        </div>
        <div class="col-md-2">
            <a href="<?php echo e(route('IndexContent')); ?>">
                <div class="box-panel">
                    <i class="fa fa-chain-broken"></i>
                    <h5>
                        مدیریت محتوا
                    </h5>
                </div>
            </a>
        </div>
        <div class="col-md-2">
            <a href="<?php echo e(route('SendSms')); ?>">
                <div class="box-panel">
                    <i class="fa fa-chain-broken"></i>
                    <h5>
                        ارسال پیامک
                    </h5>
                </div>
            </a>
        </div>
    </div>
    
    <div class="row text-center row-link-dashboard">
        <div class="col-md-2">
            <a href="<?php echo e(route('IndexRateAndComment')); ?>">
                <div class="box-panel">
                    <i class="fa fa-comments-o"></i>
                    <h5>
                        نظرات
                    </h5>
                </div>
            </a>
        </div>
        <div class="col-md-2">
            <a href="<?php echo e(route('IndexInfoCity')); ?>">
                <div class="box-panel">
                    <i class="fa fa-comments-o"></i>
                    <h5>
                        درباره شهر ها
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