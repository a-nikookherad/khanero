
<?php $__env->startSection('title'); ?>
    ویلا :: قوانین ثبت نام
<?php $__env->stopSection(); ?>

<?php $__env->startSection('style'); ?>
    <link rel="stylesheet" href="<?php echo e(asset('backend/css/dataTables.bootstrap.css')); ?>">
    <link rel="stylesheet" href="<?php echo e(asset('backend/css/TableTools.css')); ?>">
    <style>
        #ToolTables_DataTables_Table_0_0{
            display: none;
        }
        .img-advertising {
            width: 20%;
            transition: 0.5s;
        }
        .img-advertising:hover {
            width: 40%;
            transition: 0.5s;
        }
    </style>
<?php $__env->stopSection(); ?>

<?php $__env->startSection('content'); ?>
    <div class="row back-url">
        <div class="col-md-12">
            <a class="" href="<?php echo e(route('AdminDashboard')); ?>">صفحه اصلی</a><span class="now-url"> / قوانین ثبت نام</span>
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
            <div class="panel panel-primary">
                <div class="panel-heading">
                    <h3 class="panel-title">قوانین ثبت نام</h3>
                </div>
                <div class="panel-body">
                    <form role="form" action="<?php echo e(route('StoreRule')); ?>" method="post" enctype="multipart/form-data" id="FormCreateRule">
                        <?php echo e(csrf_field()); ?>

                        <div class="row">
                            <div class="col-md-3">
                                <div class="form-group">
                                    <label for="InputTitleRule">عنوان</label><span style="font-size: 18px;" class="text-danger">*</span>
                                    <input type="text" name="name" value="<?php echo e(old('name')); ?>" class="form-control primary" dir="rtl" id="InputTitleRule" placeholder="عنوان را وارد کنید" autofocus>
                                </div>
                                <?php if($errors->has('name')): ?>
                                    <span style="color:red;"><?php echo e($errors->first('name')); ?></span>
                                <?php endif; ?>
                            </div>
                            <div class="col-md-2">
                                <label for="BtnCreateRule">&nbsp;</label>
                                <button type="submit" id="BtnCreateRule" class="btn btn-default BtnRegAll btn-block ">ثبت</button>
                            </div>
                        </div>
                    </form>

                    <table cellpadding="0" cellspacing="0" border="0"
                           class="table table-striped table-bordered editable-datatable">
                        <thead>
                        <tr>
                            <th>ردیف</th>
                            <th>عنوان</th>
                            <th>ویرایش</th>
                            <th>وضعیت</th>
                            <th>تاریخ ایجاد</th>
                        </tr>
                        </thead>
                        <tbody>
                        <?php $__currentLoopData = $ruleModel; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $key => $value): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                            <tr class="1">
                                <td>
                                    <?php echo e($key+1); ?>

                                </td>
                                <td>
                                    <?php echo e($value->name); ?>

                                </td>
                                <td>
                                    <label data-toggle="modal" data-target="#myModal" onclick="ajaxEditName('<?php echo e($value->id); ?>');" class="btn btn-default btn-block"><i class="fa fa-edit"></i> </label>
                                </td>
                                <td>
                                    <label id="btnActiveRule<?php echo e($key+1); ?>" onclick="ajaxActiveRule('<?php echo e($value->id); ?>','<?php echo e($key+1); ?>');" class="<?php if($value->active == 1): ?> btn btn-default btn-block <?php else: ?> btn btn-default btn-block <?php endif; ?>">
                                        <?php if($value->active == 1): ?> <i class="fa fa-check text-success"></i> <?php else: ?> <i class="fa fa-plus text-danger" style="transform: rotate(45deg)"></i> <?php endif; ?>
                                    </label>
                                </td>
                                <td>
                                    <?php (
                                        $created_date = \Morilog\Jalali\Facades\jDate::forge($value->created_at)->format('Y/m/d')
                                    ); ?>
                                    <?php echo e($created_date); ?>

                                </td>
                            </tr>
                        <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                        </tbody>

                    </table>
                    
                    <div class="modal fade" id="myModal" role="dialog">
                        <div class="modal-dialog modal-md">
                            <!-- Modal content-->
                            <div class="modal-content">
                                <div class="modal-header">
                                    <button type="button" class="close" data-dismiss="modal">&times;</button>
                                    <h4 class="modal-title">ویرایش نام</h4>
                                </div>
                                <div class="modal-body" id="ExtraModalEdit">

                                </div>
                            </div>
                        </div>
                    </div>
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

        function ajaxEditName(id) {
            // console.log(id);
            var img = '<div class="text-center"><img style="height:50px;width:auto;" src="<?php echo e(asset('backend/img/img_loading/orange_circles.gif')); ?>" /></div>';
            $('#ExtraModalEdit').html(img);
            $.ajax({
                url:"<?php echo e(url('edit/rule').'/'); ?>"+id,
                method:"get",
            }).done(function(returnData) {
                console.log(returnData);
                $('#ExtraModalEdit').html(returnData);
            })
        }


        function ajaxActiveRule(id,idInput) {
            $.ajax({
                url:"<?php echo e(url('active/rule').'/'); ?>"+id,
                method:"get",
            }).done(function(returnData){
                // console.log(returnData);
                if(returnData == 'active')
                {
                    // console.log('active');
                    $("#btnActiveRule"+idInput).addClass('btn-default');
                    $("#btnActiveRule"+idInput).removeClass('btn-default');
                    $("#btnActiveRule"+idInput).css("transition", "0.5s");
                    $("#btnActiveRule"+idInput).text('');
                    $("#btnActiveRule"+idInput).append('<i class="fa fa-check text-success"></i>');
                }
                else if(returnData == 'deactive')
                {
                    // console.log('deactive');
                    $("#btnActiveRule"+idInput).addClass('btn-default');
                    $("#btnActiveRule"+idInput).removeClass('btn-default');
                    $("#btnActiveRule"+idInput).css("transition", "0.5s");
                    $("#btnActiveRule"+idInput).text('');
                    $("#btnActiveRule"+idInput).append('<i class="fa fa-plus text-danger" style="transform: rotate(45deg)"></i>');
                }
            });
        }

    </script>
<?php $__env->stopSection(); ?>
<?php echo $__env->make('backend.MasterPage.Layout', array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>