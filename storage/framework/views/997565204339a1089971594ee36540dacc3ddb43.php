
<?php $__env->startSection('title',TitlePage('دعوت از دوستان')); ?>
<?php $__env->startSection('style'); ?>

    <link rel="stylesheet" href="<?php echo e(asset('backend/css/dataTables.bootstrap.css')); ?>">
    <link rel="stylesheet" href="<?php echo e(asset('backend/css/TableTools.css')); ?>">
    <style>
        #ToolTables_DataTables_Table_0_0{
            display: none;
        }
        li.li-invite {
            background: #ffe9cf;
        }
    </style>
<?php $__env->stopSection(); ?>
<?php $__env->startSection('content'); ?>
    <div class="row back-url">
        <div class="col-md-12">
            <a class="" href="<?php echo e(route('AdminDashboard')); ?>">صفحه اصلی</a>
            <span class="now-url"> / دعوت از دوستان</span>
        </div>
    </div>
    <div class="row">
        <div class="col-md-12">
            <?php echo $__env->make('message.Message', array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>
            <?php echo $__env->make('message.ErrorReporting', array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>
        </div>
    </div>
    <div class="row">
        <div class="col-md-12">
            <div class="panel panel-default">
                <div class="panel-heading">
                    <h3 class="panel-title">دعوت از دوستان</h3>

                </div>
                <div class="panel-body">
                    <div class="row">
                        <div class="col-md-12">
                            <?php if(auth()->user()->parent_id != 0): ?>
                                معرف شما : <?php echo e(GetUserById(auth()->user()->parent_id)->first_name. ' ' .GetUserById(auth()->user()->parent_id)->last_name); ?>

                            <?php endif; ?>
                        </div>
                        <div class="col-md-12">
                            برای کپی کردن بر روی لینک کلیک کنید
                            <p onclick="copyToClipboard(this)" class="btn btn-default"><?php echo e(route('InviteFriend', ['code' => GenerateCodeIntroduction(auth()->user()->id)])); ?></p>
                            <span class="text-copy"></span>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>





<?php $__env->stopSection(); ?>

<?php $__env->startSection('script'); ?>
    <script src="<?php echo e(asset('frontend/js/script.js')); ?>" type="text/javascript"></script>
    <script type="text/javascript" src="<?php echo e(asset('backend/js/jquery.dataTables.min.js')); ?>"></script>
    <script type="text/javascript" src="<?php echo e(asset('backend/js/TableTools.min.js')); ?>"></script>
    <script type="text/javascript" src="<?php echo e(asset('backend/js/dataTables.bootstrap.js')); ?>"></script>
    <script type="text/javascript" src="<?php echo e(asset('backend/js/editable-datatables.js')); ?>"></script>
    <script>
        function copyToClipboard(element) {
            var $temp = $("<input>");
            $("body"). append($temp);
            $temp. val($(element). html()). select();
            document. execCommand("copy");
            $temp. remove();
            $('.text-copy').html('کپی شد');
        }
    </script>
<?php $__env->stopSection(); ?>

<?php echo $__env->make('backend.MasterPage.Layout', array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>