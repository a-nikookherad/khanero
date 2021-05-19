
<?php $__env->startSection('title', TitlePage('ایجاد محتوا')); ?>
<?php $__env->startSection('style'); ?>
    <link rel="stylesheet" href="<?php echo e(asset('backend/css/bootstrap3-wysiwyg5.css')); ?>">
    <link rel="stylesheet" href="<?php echo e(asset('backend/css/select2-bootstrap.css')); ?>">
    <link rel="stylesheet" href="<?php echo e(asset('backend/css/select2.css')); ?>">
    <link rel="stylesheet" href="<?php echo e(asset('backend/css/switchery.min.css')); ?>">


    <script type="text/javascript" src="<?php echo e(asset('backend/js/jquery-1.11.0.min.js')); ?>"></script>
    <script type="text/javascript" src="<?php echo e(asset('backend/js/jquery-ui-1.10.4.custom.min.js')); ?>"></script>


    <style>
        #ToolTables_DataTables_Table_0_0{
            display: none;
        }
    </style>
<?php $__env->stopSection(); ?>

<?php $__env->startSection('content'); ?>
    <script src="<?php echo e(asset('backend/js/ckeditor-new/ckeditor.js')); ?>"></script>
    <script src="<?php echo e(asset('backend/js/ckeditor-new/samples/js/sample.js')); ?>"></script>
    <link href="<?php echo e(asset('backend/js/ckeditor-new/samples/css/samples.css')); ?>" />
    <div class="row back-url">
        <div class="col-md-12">
            <a class="" href="<?php echo e(route('AdminDashboard')); ?>">صفحه اصلی</a>/
            <a class="" href="<?php echo e(route('IndexContent')); ?>">مدیریت محتوا</a>
            <span class="now-url"> / ایجاد محتوا</span>
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
                    <h3 class="panel-title">ایجاد محتوا</h3>
                </div>
                <div class="panel-body">
                    <form role="form" action="<?php echo e(route('StoreContent')); ?>" method="post" enctype="multipart/form-data" id="FormCreateContent">
                        <?php echo e(csrf_field()); ?>

                        <div class="row">
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label for="InputTitleContent">عنوان محتوا</label><span style="font-size: 18px;" class="text-danger">*</span>
                                    <input type="text" name="title" value="<?php echo e(old('title')); ?>" class="form-control primary" dir="rtl" id="InputTitleContent" placeholder="عنوان خبر را وارد کنید" autofocus>
                                    <?php if($errors->has('title')): ?>
                                        <span style="color:red;"><?php echo e($errors->first('title')); ?></span>
                                    <?php endif; ?>
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label for="InputTypeContent">نوع محتوا</label><span style="font-size: 18px;" class="text-danger">*</span>
                                    <select class="form-control" name="type" id="InputTypeContent">
                                        <option value="1">ارتباط با ما</option>
                                        <option value="2">دسترسی سریع</option>
                                    </select>
                                </div>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-md-12">
                                <div class="form-group">
                                    <label for="InputContent">توضیحات</label>
                                    <textarea id="editor" name="content" id="InputContent"><?php echo e(old('content')); ?></textarea>
                                </div>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-md-12">
                                <form class="form-horizontal" role="form">

                                    <div class="form-group">
                                        <label for="InputCheckBoxActive">نمایش محتوا</label>
                                        <input type="checkbox" name="active" id="InputCheckBoxActive" class="js-switch-blue" checked />
                                    </div>
                                </form>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-md-12">
                                <button type="button" id="BtnCreateContent" class="btn btn-success btn-block ">ثبت محتوا</button>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
    <script>
        initSample();
    </script>
<?php $__env->stopSection(); ?>

<?php $__env->startSection('script'); ?>
    
    
    <script type="text/javascript" src="<?php echo e(asset('backend/js/select2.min.js')); ?>"></script>
    <script type="text/javascript" src="<?php echo e(asset('backend/js/switchery.min.js')); ?>"></script>
    <script type="text/javascript" src="<?php echo e(asset('backend/js/form-advancecomponents.js')); ?>"></script>
    <script>
        $(document).ready(function () {
            $('#BtnCreateContent').click(function () {
                // var titleNewsletter = $('#InputTitleNewsletter').val();
                // var contentNewsletter = $('#editor').val();
                // if(titleNewsletter == "" || contentNewsletter == "")
                // {
                //     alert('پر کردن فیلدهای ستاره دار الزامی میباشد');
                // }
                // else
                // {
                    $('#FormCreateContent').submit();
                // }
            });
        });
    </script>

<?php $__env->stopSection(); ?>
<?php echo $__env->make('backend.MasterPage.Layout', array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>