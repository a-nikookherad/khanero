
<?php $__env->startSection('title',TitlePage('نمایش کاربران')); ?>
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
            <a class="" href="<?php echo e(route('AdminDashboard')); ?>">صفحه اصلی</a>
            <span class="now-url"> / نمایش کاربران</span>
        </div>
    </div>
    <div class="row">
        <div class="col-md-12">
            <div class="panel panel-default">
                <div class="panel-heading">
                    <h3 class="panel-title">گزارش کاربران(زیر مجموعه)</h3>

                </div>
                <div class="panel-body">

                    <table cellpadding="0" cellspacing="0" border="0"
                           class="table table-striped table-bordered editable-datatable">
                        <thead>
                        <tr>
                            <th>ردیف</th>
                            <th>نام</th>
                            <th>شماره موبایل</th>
                            <th>نمایش جزئیات</th>
                            <th>وضعیت</th>
                            <th>تاریخ ثبت نام</th>
                        </tr>
                        </thead>
                        <tbody>
                        <?php $__currentLoopData = $userModel; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $key => $value): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                            <tr class="1">
                                <td>
                                    <?php echo e($key+1); ?>

                                </td>
                                <td>
                                    <?php echo e($value->first_name.' '.$value->last_name); ?>

                                </td>
                                <td>
                                    <?php echo e($value->mobile); ?>

                                </td>
                                <td>
                                    <label class="btn btn-default" onclick="ShowChart(<?php echo e($value->id); ?>)">
                                        <i class="fa fa-bar-chart-o"></i>
                                    </label>
                                </td>
                                <td>
                                    <label class="text-default">
                                        <?php if($value->active == 1): ?>
                                            فعال
                                        <?php else: ?>
                                            غیر فعال
                                        <?php endif; ?>
                                    </label>
                                </td>
                                <td class="">
                                    <?php (
                                        $birth_date = \Morilog\Jalali\Facades\jDate::forge($value->created_at)->format('Y/m/d')
                                    ); ?>
                                    <?php echo e($birth_date); ?>

                                </td>
                            </tr>
                        <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                        </tbody>

                    </table>

                </div>
            </div>
        </div>
    </div>

    <!-- Modal -->
    <div class="modal fade" id="myModal" role="dialog">
        <div class="modal-dialog modal-sm">

            <!-- Modal content-->
            <div class="modal-content">
                <div class="modal-header">
                    <button type="button" class="close" data-dismiss="modal">&times;</button>
                    <h4 class="modal-title">test</h4>
                </div>
                <div class="modal-body">
                    <p>test body.</p>
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
        $(document).ready(function (e) {

            $.ajaxSetup({
                headers: {
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                }
            });


        });
        function ShowChart(id) {
            
                
                
                
                    
                
            
                
                
            
        }
    </script>
<?php $__env->stopSection(); ?>

<?php echo $__env->make('backend.MasterPage.Layout', array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>