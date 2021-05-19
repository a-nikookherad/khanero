
<?php $__env->startSection('title', TitlePage('نمایش محتوا')); ?>
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
            <span class="now-url"> / مدیریت محتوا</span>
        </div>
    </div>
    <div class="row">
        <div class="col-md-12">
            <?php echo $__env->make('message.Message', array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>
            <?php echo $__env->make('message.ErrorReporting', array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>
        </div>
    </div>
    <div class="row">
        <div class="col-md-12" style="margin-bottom: 10px;">
            <a href="<?php echo e(route('CreateContent')); ?>" class="btn btn-default">ایجاد محتوای جدید<i style="font-size: 18px;" class="text-success fa fa-plus-square-o"></i> </a>
        </div>
        <div class="col-md-12">
            <div class="panel panel-default">
                <div class="panel-heading">
                    <h3 class="panel-title">نمایش محتویات</h3>
                </div>
                <div class="panel-body">
                    <table cellpadding="0" cellspacing="0" border="0" class="table table-striped table-bordered editable-datatable">
                        <thead>
                            <tr>
                                <th>ردیف</th>
                                <th>عنوان محتوا</th>
                                <th>ویرایش محتوا</th>
                                <th>وضعیت</th>
                                <th>تاریخ ثبت</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php $__currentLoopData = $contentModel; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $key => $value): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                <tr class="1">
                                    <td>
                                        <?php echo e($key+1); ?>

                                    </td>
                                    <td>
                                        <?php echo e($contentModel[$key]->title); ?>

                                    </td>
                                    <td>
                                        <a href="<?php echo e(url('edit/content').'/'.$value->id); ?>" class="btn btn-default btn-block">
                                            <i class="fa fa-edit"></i>&nbsp;
                                        </a>
                                    </td>
                                    <td>
                                        <label id="btnActiveContent<?php echo e($key+1); ?>" onclick="ajaxActiveContent('<?php echo e($value->id); ?>','<?php echo e($key+1); ?>');" class="btn btn-default btn-block">
                                            <?php if($value->active == 1): ?> <i class="fa fa-check text-success"></i> <?php else: ?> <i class="fa fa-plus text-danger" style="transform: rotate(45deg)"></i> <?php endif; ?>
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

    <script type="text/javascript">
        function ajaxActiveContent(id,idInput) {
            $.ajax({
                url:"<?php echo e(url('active/content').'/'); ?>"+id+"/active",
                method:"get",
            }).done(function(returnData){
                if(returnData == 'active')
                {
                    $("#btnActiveContent"+idInput).addClass('btn-default');
                    $("#btnActiveContent"+idInput).removeClass('btn-default');
                    $("#btnActiveContent"+idInput).css("transition", "0.5s");
                    $("#btnActiveContent"+idInput).text('');
                    $("#btnActiveContent"+idInput).append('<i class="fa fa-check text-success"></i>');
                }
                else if(returnData == 'deactive')
                {
                    // console.log('deactive');
                    $("#btnActiveContent"+idInput).addClass('btn-default');
                    $("#btnActiveContent"+idInput).removeClass('btn-default');
                    $("#btnActiveContent"+idInput).css("transition", "0.5s");
                    $("#btnActiveContent"+idInput).text('');
                    $("#btnActiveContent"+idInput).append('<i class="fa fa-plus text-danger" style="transform: rotate(45deg)"></i>');
                }
            });
        }
    </script>

<?php echo $__env->make('backend.MasterPage.Layout', array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>