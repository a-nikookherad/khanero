
<?php $__env->startSection('title',TitlePage($contentModel->title)); ?>
<?php $__env->startSection('style'); ?>
    <style>
        #main1 p {
            font-size: 14px;
            line-height: 35px;
        }
        .title-main {
            color: #007e8d;
        }
    </style>
<?php $__env->stopSection(); ?>

<?php $__env->startSection('content'); ?>
    <div class="row">
        <div class="col-sm-10 col-md-offset-1">
            <div id="main1">
                <h3 class="title-main"><i class="fas fa-home"></i> <?php echo e($contentModel->title); ?></h3>
                <?php echo $contentModel->content; ?>

            </div>
        </div>
    </div>
<?php $__env->stopSection(); ?>

<?php echo $__env->make('frontend.MasterPage.Layout', array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>