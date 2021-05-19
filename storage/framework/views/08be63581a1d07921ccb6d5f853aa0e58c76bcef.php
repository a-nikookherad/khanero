

<?php $__env->startSection('title'); ?>
    ویلا :: نمایش پیام
<?php $__env->stopSection(); ?>

<?php $__env->startSection('style'); ?>
    <link rel="stylesheet" href="<?php echo e(asset('backend/css/datepicker.css')); ?>">
    <link rel="stylesheet" href="<?php echo e(asset('backend/css/bootstrap-datepicker.min.css')); ?>" />
    <link rel="stylesheet" href="<?php echo e(asset('backend/css/voteStar.css')); ?>">
    <style>
        #editor #editor_ifr {
            height: 200px;
        }
        .color-text-section {
            color: #ff6600;
        }
        .title-row {
            color: #aaa;
            border-bottom: 1px dashed #ccc;
            padding-bottom: 8px;
        }
        .panel-body .row {
            margin: 8px 0;
        }
    </style>
<?php $__env->stopSection(); ?>

<?php $__env->startSection('content'); ?>
    <div class="row back-url">
        <div class="col-md-12">
            <a class="" href="<?php echo e(route('AdminDashboard')); ?>">صفحه اصلی</a> /
            <a class="" href="<?php echo e(route('ContactUsFormAdmin')); ?>">تماس با ما</a>/
            <a class="" href="<?php echo e(route('IndexContactMessage')); ?>">نمایش پیام های دریافتی</a>
            <span class="now-url"> / نمایش پیام </span>
        </div>
    </div>
    <div class="row" id="DivIdToPrint">
        <div class="col-md-12">
            <div class="panel panel-default">
                <div class="panel-heading text-right">
                    <h3 class="panel-title">نمایش جزئیات</h3>
                </div>
                <div class="panel-body">
                    <h6 class="title-row">اطلاعات کاربری</h6>
                    <div class="row">
                        <div class="col-md-3">
                            <div class="form-group">
                                <h5>
                                    <span class="color-text-section"> نام کاربر : </span> <?php echo e($contactModel->name); ?>

                                </h5>
                            </div>
                        </div>
                        <div class="col-md-3">
                            <div class="form-group">
                                <h5>
                                    <span class="color-text-section"> شماره تماس : </span> <?php echo e($contactModel->phone); ?>

                                </h5>
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="form-group">
                                <h5>
                                    <span class="color-text-section"> پست الکترونیکی : </span> <?php echo e($contactModel->email); ?>

                                </h5>
                            </div>
                        </div>
                    </div>

                    <h6 class="title-row">پیام</h6>
                    <div class="row">
                        <div class="col-md-4">
                            <div class="form-group">
                                <h5>
                                    <span class="color-text-section"> موضوع : </span> <?php echo e($contactModel->subject); ?>

                                </h5>
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-md-12">
                            <div class="form-group">
                                <h5 style="line-height: 25px;">
                                    <span class="color-text-section"> متن پیام : </span> <?php echo e($contactModel->content); ?>

                                </h5>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
<?php $__env->stopSection(); ?>


<?php $__env->startSection('script'); ?>
    <script type="text/javascript">
        function printDiv()
        {
            var divToPrint=document.getElementById('DivIdToPrint');

            var newWin=window.open('','Print-Window');

            newWin.document.open();

            newWin.document.write('<html><body onload="window.print()">'+divToPrint.innerHTML+'</body></html>');

            newWin.document.close();

            setTimeout(function(){newWin.close();},10);
        }
    </script>
<?php $__env->stopSection(); ?>
<?php echo $__env->make('backend.MasterPage.Layout', array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>