
<?php $__env->startSection('title'); ?>
    ویلا :: ویرایش محتوا
<?php $__env->stopSection(); ?>

<?php $__env->startSection('style'); ?>
    <link rel="stylesheet" href="<?php echo e(asset('backend/css/bootstrap3-wysiwyg5.css')); ?>">
    <link rel="stylesheet" href="<?php echo e(asset('backend/css/select2-bootstrap.css')); ?>">
    <link rel="stylesheet" href="<?php echo e(asset('backend/css/select2.css')); ?>">
    <link rel="stylesheet" href="<?php echo e(asset('backend/css/switchery.min.css')); ?>">
    <style>
        body .mce-ico {
            font-family: 'tinymce', Arial !important;
        }
    </style>
<?php $__env->stopSection(); ?>

<?php $__env->startSection('content'); ?>
    <script src="<?php echo e(asset('backend/assets/tinymcenew/tinymce.min.js')); ?>"></script>
    <script src="<?php echo e(asset('backend/assets/tinymcenew/editor.js')); ?>"></script>
    <div class="row back-url">
        <div class="col-md-12">
            <a class="" href="<?php echo e(route('AdminDashboard')); ?>">صفحه اصلی</a>/
            <a class="" href="<?php echo e(route('IndexContent')); ?>">مدیریت محتوا</a>
            <span class="now-url"> / ویرایش محتوا</span>
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
            <div class="panel panel-info">
                <div class="panel-heading">
                    <h3 class="panel-title">ویرایش محتوا</h3>
                </div>
                <div class="panel-body">
                    <form role="form" action="<?php echo e(route('UpdateContent')); ?>" method="post" enctype="multipart/form-data" id="FormUpdateContent">
                        <?php echo e(csrf_field()); ?>

                        <input type="hidden" name="content_id" value="<?php echo e($contentModel->id); ?>" />
                        <div class="row">
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label for="InputTitleContent">عنوان محتوا</label><span style="font-size: 18px;" class="text-danger">*</span>
                                    <input type="text" name="title" value="<?php echo e($contentModel->title); ?>" class="form-control primary" dir="rtl" id="InputTitleContent" placeholder="عنوان خبر را وارد کنید" autofocus>
                                    <?php if($errors->has('title')): ?>
                                        <span style="color:red;"><?php echo e($errors->first('title')); ?></span>
                                    <?php endif; ?>
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label for="InputTypeContent">نوع محتوا</label><span style="font-size: 18px;" class="text-danger">*</span>
                                    <select class="form-control" name="type" id="InputTypeContent">
                                        <option value="1" <?php if($contentModel->type == 1): ?> selected <?php endif; ?>>دسترسی سریع</option>
                                        <option value="2" <?php if($contentModel->type == 2): ?> selected <?php endif; ?>>مجله</option>
                                    </select>
                                </div>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-md-12">
                                <div class="form-group">
                                    <label for="editor">محتوا</label><span style="font-size: 18px;" class="text-danger">*</span>
                                    <textarea class="editor" style="height: 300px;" name="content">
                                        <?php echo e($contentModel->content); ?>

                                    </textarea>
                                    <?php if($errors->has('content')): ?>
                                        <span style="color:red;"><?php echo e($errors->first('content')); ?></span>
                                    <?php endif; ?>
                                </div>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-md-12">
                                <form class="form-horizontal" role="form">

                                    <div class="form-group">
                                        <label for="InputCheckBoxActive">نمایش محتوا</label>
                                        <input type="checkbox" name="active" <?php if($contentModel->active == 1): ?> checked <?php endif; ?> id="InputCheckBoxActive" class="js-switch-blue"  />
                                    </div>
                                </form>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-md-12">
                                <button type="button" id="BtnUpdateContent" class="btn btn-success btn-block ">ثبت محتوا</button>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>

<?php $__env->stopSection(); ?>

<?php $__env->startSection('script'); ?>
    <script type="text/javascript" src="<?php echo e(asset('backend/js/select2.min.js')); ?>"></script>
    <script type="text/javascript" src="<?php echo e(asset('backend/js/switchery.min.js')); ?>"></script>
    <script type="text/javascript" src="<?php echo e(asset('backend/js/form-advancecomponents.js')); ?>"></script>
    <script>
        $(document).ready(function () {
            $('#BtnUpdateContent').click(function () {
                var titleUpdateContent = $('#titleUpdateContent').val();
                var contentUpdateContent = $('#editor').val();
                if(titleUpdateContent == "" || contentUpdateContent == "")
                {
                    alert('پر کردن فیلدهای ستاره دار الزامی میباشد');
                }
                else
                {
                    $('#FormUpdateContent').submit();
                }
            });
        });
    </script>

<?php $__env->stopSection(); ?>
<?php echo $__env->make('backend.MasterPage.Layout', array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>