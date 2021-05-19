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
                    <h3 class="panel-title">گزارش کاربران</h3>

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
                            <th>ورود</th>
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
                                    <a href="<?php echo e(url('detail/user').'/'. $value->id); ?>" class="btn btn-default btn-block"><i class="fa fa-list-alt"></i>&nbsp;</a>
                                </td>
                                <td>
                                    <label id="btnActiveUser<?php echo e($key+1); ?>" onclick="ajaxActive('<?php echo e($value->id); ?>','<?php echo e($key+1); ?>');" class="btn btn-default btn-block">
                                        <?php if($value->active == 1): ?> <i class="fa fa-check text-success"></i> <?php else: ?> <i class="fa fa-plus text-danger" style="transform: rotate(45deg)"></i> <?php endif; ?>
                                    </label>
                                </td>
                                <td>
                                    <a href="<?php echo e(route('LoginUser', ['id' => $value->id])); ?>"  class="btn btn-default btn-block">
ورود
                                    </a>
                                </td>
                                <td class="">
                                    <?php echo e(\Morilog\Jalali\Facades\jDate::forge($value->created_at)->format('Y/m/d')); ?>

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
    <script src="<?php echo e(asset('frontend/js/script.js')); ?>" type="text/javascript"></script>
    <script type="text/javascript" src="<?php echo e(asset('backend/js/jquery.dataTables.min.js')); ?>"></script>
    <script type="text/javascript" src="<?php echo e(asset('backend/js/TableTools.min.js')); ?>"></script>
    <script type="text/javascript" src="<?php echo e(asset('backend/js/dataTables.bootstrap.js')); ?>"></script>
    <script type="text/javascript" src="<?php echo e(asset('backend/js/editable-datatables.js')); ?>"></script>
<?php $__env->stopSection(); ?>

<script>

    
$( "h3" ).parent( ".panel-heading" ).css( "background", "red" );
$( "label" ).parent( "#DataTables_Table_0_length" ).css( "background", "yellow" );

$('label').parent('#DataTables_Table_0_length').innerHTML = 'your tip has been submitted!';

   

    function ajaxActive(id,idInput) {
        $.ajax({
            url:"<?php echo e(url('active/user').'/'); ?>"+id+"/active",
            method:"get",
        }).done(function(returnData){
            if(returnData == 'active')
            {
                // console.log('active');
                $("#btnActiveUser"+idInput).addClass('btn-default');
                $("#btnActiveUser"+idInput).removeClass('btn-default');
                $("#btnActiveUser"+idInput).css("transition", "0.5s");
                $("#btnActiveUser"+idInput).text('');
                $("#btnActiveUser"+idInput).append('<i class="fa fa-check text-success"></i>');
            }
            else if(returnData == 'deactive')
            {
                // console.log('deactive');
                $("#btnActiveUser"+idInput).addClass('btn-default');
                $("#btnActiveUser"+idInput).removeClass('btn-default');
                $("#btnActiveUser"+idInput).css("transition", "0.5s");
                $("#btnActiveUser"+idInput).text('');
                $("#btnActiveUser"+idInput).append('<i class="fa fa-plus text-danger" style="transform: rotate(45deg)"></i>');
            }
        });
    }










    var ss = $('label').parent('#DataTables_Table_0_length');
    console.log('***************');
    console.log(ss);
    console.log('***************');
    
    
    
$( "h3" ).parent( ".panel-heading" ).css( "background", "red" );
$( "label" ).parent( "#DataTables_Table_0_length" ).css( "background", "yellow" );

$('label').parent('#DataTables_Table_0_length').innerHTML = 'your tip has been submitted!';

    
    
</script>
<?php echo $__env->make('backend.MasterPage.Layout', array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>