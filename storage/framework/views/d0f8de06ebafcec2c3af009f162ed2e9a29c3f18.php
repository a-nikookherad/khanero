
<?php $__env->startSection('title'); ?>
    ویلا :: نمایش پیام های دریافتی
<?php $__env->stopSection(); ?>
<?php $__env->startSection('titleSection'); ?>
    نمایش پیام های دریافتی
<?php $__env->stopSection(); ?>
<?php $__env->startSection('style'); ?>

    <link rel="stylesheet" href="<?php echo e(asset('backend/css/dataTables.bootstrap.css')); ?>">
    <link rel="stylesheet" href="<?php echo e(asset('backend/css/TableTools.css')); ?>">
    <style>
        #ToolTables_DataTables_Table_0_0{
            display: none;
        }
    </style>
<?php $__env->stopSection(); ?>
<?php $__env->startSection('content'); ?>
    <div class="row back-url">
        <div class="col-md-12">
            <a class="" href="<?php echo e(route('AdminDashboard')); ?>">صفحه اصلی</a>/
            <a class="" href="<?php echo e(route('ContactUsFormAdmin')); ?>">تماس با ما</a>
            <span class="now-url"> / نمایش پیام های دریافتی</span>
        </div>
    </div>
    <div class="row">
        <div class="col-md-12">
            <div class="panel panel-primary">
                <div class="panel-heading">
                    <h3 class="panel-title">پیام های دریافتی</h3>
                </div>
                <div class="panel-body">

                    <table cellpadding="0" cellspacing="0" border="0" class="table table-striped table-bordered editable-datatable">
                        <thead>
                        <tr>
                            <th>ردیف</th>
                            <th>نام</th>
                            <th>موضوع</th>
                            <th>تلفن تماس</th>
                            <th>ایمیل</th>
                            <th>مشاهده پیام</th>
                            <th>وضعیت</th>
                            <th>تاریخ ارسال</th>
                        </tr>
                        </thead>
                        <tbody>
                        <?php $__currentLoopData = $contactModel; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $key => $value): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                            <tr class="1 <?php if($value->view == 1): ?> text-muted <?php endif; ?>">
                                <td>
                                    <?php echo e($key+1); ?>

                                </td>
                                <td>
                                    <?php echo e($value->name); ?>

                                </td>
                                <td>
                                    <?php echo e($value->subject); ?>

                                </td>
                                <td>
                                    <?php echo e($value->phone); ?>

                                </td>
                                <td>
                                    <?php echo e($value->email); ?>

                                </td>
                                <td>
                                    <a href="<?php echo e(url('read/contact/message').'/'.$value->id); ?>" class="btn btn-default btn-block"><i class="fa fa-eye"></i></a>
                                </td>
                                <td>
                                    <label class="<?php if($value->view == 0): ?> btn btn-success btn-block <?php else: ?> btn btn-default btn-block <?php endif; ?>">
                                        <?php if($value->view == 1): ?> خوانده شده <?php else: ?> جدید <?php endif; ?>
                                    </label>
                                </td>
                                <td class="">
                                    <?php (
                                        $register_date = \Morilog\Jalali\Facades\jDate::forge($value->created_at)->format('Y/m/d')
                                    ); ?>
                                    <?php echo e($register_date); ?>

                                </td>
                            </tr>
                        <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                        </tbody>

                    </table>

                </div>
            </div>
        </div>
    </div>





<?php $__env->stopSection(); ?>

<?php $__env->startSection('script'); ?>
    <script type="text/javascript" src="<?php echo e(asset('backend/js/jquery.dataTables.min.js')); ?>"></script>
    <script type="text/javascript" src="<?php echo e(asset('backend/js/TableTools.min.js')); ?>"></script>
    <script type="text/javascript" src="<?php echo e(asset('backend/js/dataTables.bootstrap.js')); ?>"></script>
    <script type="text/javascript" src="<?php echo e(asset('backend/js/editable-datatables.js')); ?>"></script>
<?php $__env->stopSection(); ?>
<?php echo $__env->make('backend.MasterPage.Layout', array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>