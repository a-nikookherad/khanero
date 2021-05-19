
<?php $__env->startSection('title',TitlePage('گزارش کیف پول کاربران')); ?>
<?php $__env->startSection('style'); ?>
    <link rel="stylesheet" href="<?php echo e(asset('backend/css/dataTables.bootstrap.css')); ?>">
    <link rel="stylesheet" href="<?php echo e(asset('backend/css/TableTools.css')); ?>">
    <style>
        #ToolTables_DataTables_Table_0_0 {
            display: none;
        }
        .align {
            direction: initial;
            text-align: center;
        }
    </style>
<?php $__env->stopSection(); ?>

<?php $__env->startSection('content'); ?>
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
                    <h3 class="panel-title">گزارش کیف پول کاربران</h3>
                </div>
                <div class="panel-body">
                    <table cellpadding="0" cellspacing="0" border="0"
                           class="table table-striped table-bordered editable-datatable">
                        <thead>
                            <tr>
                                <th scope="col">ردیف</th>
                                <th scope="col">نام کاربر</th>
                                <th scope="col">شماره حساب</th>
                                <th scope="col">نام شماره حساب</th>
                                <th scope="col">موجودی کیف پول(تومان)</th>
                                <th scope="col">در انتظار پرداخت</th>
                                <th scope="col">پرداخت</th>
                                <th scope="col">تایید پرداخت</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php $__currentLoopData = $creditModel; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $key => $value): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                <tr>
                                    <td>
                                        <?php echo e($key+1); ?>

                                    </td>
                                    <td>
                                        <?php echo e($value->first_name.' '.$value->last_name); ?>

                                    </td>
                                    <td class="align">
                                        <?php if($value->card_bank_number != ''): ?>
                                            <?php echo e($value->card_bank_number); ?>

                                        <?php else: ?>
                                            ثبت نشده
                                        <?php endif; ?>
                                    </td>
                                    <td>
                                        <?php if($value->account_name != ''): ?>
                                            <?php echo e($value->account_name); ?>

                                        <?php else: ?>
                                            ثبت نشده
                                        <?php endif; ?>
                                    </td>
                                    <td class="text-success">
                                        <?php echo e(number_format($value->credit)); ?>

                                    </td>
                                    <td class="text-success">
                                        <?php if($value->payment_wait > 0): ?>
                                            <?php echo e(number_format($value->payment_wait)); ?>

                                        <?php else: ?>
                                            -
                                        <?php endif; ?>
                                    </td>
                                    <td class="text-success">
                                        <?php if($value->payment_wait == 0 && $value->credit > 0): ?>
                                            <a class="btn btn-default" href="<?php echo e(route('ClearingCreditUser', ['id' => $value->id, 'status' => 'update'])); ?>">
                                                پرداخت
                                            </a>
                                        <?php elseif($value->payment_wait > 0 && $value->credit > 0): ?>
                                            <a class="btn btn-default" href="<?php echo e(route('ClearingCreditUser', ['id' => $value->id, 'status' => 'update'])); ?>">
                                                به روز رسانی مبلغ پرداخت
                                            </a>
                                        <?php else: ?>

                                            در انتظار پرداخت

                                        <?php endif; ?>
                                    </td>
                                    <td class="text-success">
                                        <?php if($value->payment_wait > 0): ?>
                                            <a class="btn btn-default" href="<?php echo e(route('ClearingCreditUser', ['id' => $value->id, 'status' => 'confirm'])); ?>">
                                                تایید
                                            </a>
                                            <a class="btn btn-default" href="<?php echo e(route('ClearingCreditUser', ['id' => $value->id, 'status' => 'cancel'])); ?>">
                                                عدم تایید
                                            </a>
                                        <?php endif; ?>
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
    <script>

    </script>
<?php $__env->stopSection(); ?>
<?php echo $__env->make('backend.MasterPage.Layout', array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>