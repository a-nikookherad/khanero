
<?php $__env->startSection('title'); ?>
    ویلا :: تنظیمات صفحه اصلی
<?php $__env->stopSection(); ?>

<?php $__env->startSection('style'); ?>
    <link rel="stylesheet" href="<?php echo e(asset('backend/css/dataTables.bootstrap.css')); ?>">
    <link rel="stylesheet" href="<?php echo e(asset('backend/css/TableTools.css')); ?>">
    <style>
        .box-img img {
            width: 40%;
        }
    </style>
    <link rel="stylesheet" href="<?php echo e(asset('backend/css/bootstrap-datepicker.min.css')); ?>"/>
<?php $__env->stopSection(); ?>

<?php $__env->startSection('content'); ?>
    <div class="row back-url">
        <div class="col-md-12">
            <a class="" href="<?php echo e(route('UserDashboard')); ?>">صفحه اصلی</a><span
                    class="now-url"> / تنظیمات صفحه اصلی</span>
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
                    <h3 class="panel-title">تنظیمات صفحه اصلی</h3>
                </div>
                <div class="panel-body">

                    <form action="<?php echo e(route('UpdateSection')); ?>" method="post" enctype="multipart/form-data">
                        <?php echo e(csrf_field()); ?>

                        <div class="row">
                            <div class="col-md-4 text-center">
                                <div class="box-img">
                                    <img src="<?php echo e(asset('Uploaded'.'/'.$sectionModel->img1)); ?>" />
                                    <textarea rows="6" style="width: 100%" class="form-control" name="content1"><?php echo e($sectionModel->content1); ?></textarea>
                                </div>
                            </div>
                            <div class="col-md-4 text-center">
                                <div class="box-img">
                                    <img src="<?php echo e(asset('Uploaded'.'/'.$sectionModel->img2)); ?>" />
                                    <textarea rows="6" style="width: 100%" class="form-control" name="content2"><?php echo e($sectionModel->content2); ?></textarea>
                                </div>
                            </div>
                            <div class="col-md-4 text-center">
                                <div class="box-img">
                                    <img src="<?php echo e(asset('Uploaded'.'/'.$sectionModel->img3)); ?>" />
                                    <textarea rows="6" style="width: 100%" class="form-control" name="content3"><?php echo e($sectionModel->content3); ?></textarea>
                                </div>
                            </div>
                        </div>
                        <div class="row text-center">
                            <div class="col-md-4">
                                <input type="file" name="img1" multiple />
                            </div>
                            <div class="col-md-4">
                                <input type="file" name="img2" multiple />
                            </div>
                            <div class="col-md-4">
                                <input type="file" name="img3" multiple />
                            </div>
                        </div>
                        <br />
                        <div class="row">
                            <div class="col-md-12">
                                <button type="submit" class="btn btn-default btn-block">ویرایش اطلاعات</button>
                            </div>
                        </div>
                    </form>

                </div>
            </div>
        </div>
    </div>

<?php $__env->stopSection(); ?>


<?php echo $__env->make('backend.MasterPage.Layout', array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>