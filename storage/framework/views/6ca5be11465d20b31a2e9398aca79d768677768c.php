
<?php $__env->startSection('title', TitlePage('امکانات')); ?>
<?php $__env->startSection('style'); ?>
    <link rel="stylesheet" href="<?php echo e(asset('backend/css/dataTables.bootstrap.css')); ?>">
    <link rel="stylesheet" href="<?php echo e(asset('backend/css/TableTools.css')); ?>">
    <style>
        #ToolTables_DataTables_Table_0_0{
            display: none;
        }
        .box-table {
            max-height: 250px;
            min-height: 250px;
            overflow-x: scroll;
        }
        .margin-top-28 {
            margin-top: 28px;
        }
        .btn-file {
            position: relative;
            overflow: hidden;
        }
        .btn-file input[type=file] {
            position: absolute;
            top: 0;
            right: 0;
            min-width: 100%;
            min-height: 100%;
            font-size: 100px;
            text-align: right;
            filter: alpha(opacity=0);
            opacity: 0;
            outline: none;
            background: white;
            cursor: inherit;
            display: block;
        }
        table img {
            width: 30px;
            height: 30px;
        }
    </style>
<?php $__env->stopSection(); ?>

<?php $__env->startSection('content'); ?>
    <div class="row back-url">
        <div class="col-md-12">
            <a class="" href="<?php echo e(route('AdminDashboard')); ?>">صفحه اصلی</a><span class="now-url"> / مدیریت امکانات</span>
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
                    <h3 class="panel-title">امکانات</h3>
                </div>
                <div class="panel-body">
                    <form role="form" action="<?php echo e(route('StoreOption')); ?>" method="post" enctype="multipart/form-data" id="FormCreateOption">
                        <?php echo e(csrf_field()); ?>

                        <div class="row">
                            <div class="col-md-2">
                                <div class="form-group">
                                    <label for="InputTitleOption">عنوان</label><span style="font-size: 18px;" class="text-danger">*</span>
                                    <input type="text" name="option" value="<?php echo e(old('option')); ?>" class="form-control primary" dir="rtl" id="InputTitleOption" placeholder="عنوان را وارد کنید" autofocus>
                                </div>
                                <?php if($errors->has('option')): ?>
                                    <span style="color:red;"><?php echo e($errors->first('option')); ?></span>
                                <?php endif; ?>
                            </div>
                            <div class="col-md-2">
                                <div class="form-group">
                                    <label for="SelectType">نوع</label><span style="font-size: 18px;" class="text-danger">*</span>
                                    <select name="type" id="SelectType" class="form-control">
                                        <option value="1">امکانات</option>
                                        <option value="2">خدمات</option>
                                    </select>
                                </div>
                                <?php if($errors->has('option')): ?>
                                    <span style="color:red;"><?php echo e($errors->first('option')); ?></span>
                                <?php endif; ?>
                            </div>
                            <div class="col-md-4">
                                <div class="form-group">
                                    <label for="InputDescription">توضیحات</label>
                                    <input type="text" name="description" class="form-control" value="<?php echo e(old('description')); ?>" dir="rtl" id="InputDescription" />
                                </div>
                            </div>
                            <div class="col-md-2">
                                <div class="form-group">
                                    <span class="btn btn-primary btn-file margin-top-28">
                                        انتخاب کنید ...
                                        <input type="file" name="file" value="<?php echo e(old('file')); ?>" dir="rtl" id="InputFileImg" />
                                    </span>
                                </div>
                            </div>
                            <div class="col-md-2">
                                <label for="BtnCreateOption">&nbsp;</label>
                                <button type="submit" id="BtnCreateOption" class="btn btn-default BtnRegAll btn-block ">ثبت</button>
                            </div>
                        </div>
                    </form>

                    <table cellpadding="0" cellspacing="0" border="0" class="table table-striped table-bordered editable-datatable">
                            <thead>
                            <tr>
                                <th>ردیف</th>
                                <th>تصویر</th>
                                <th>عنوان</th>
                                <th>توضیحات</th>
                                <th>اولویت</th>
                                <th>ویرایش</th>
                                <th>وضعیت</th>
                                <th>تاریخ ثبت</th>
                            </tr>
                            </thead>
                            <tbody>
                            <?php $__currentLoopData = $optionModel; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $key => $value): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                <tr class="1">
                                    <td>
                                        <?php echo e($key+1); ?>

                                    </td>
                                    <td>
                                        <img src="<?php echo e(asset('Uploaded/Possibilities/Option').'/'.$value->img); ?>" alt="">
                                    </td>
                                    <td>
                                        <?php echo e($value->name); ?>

                                    </td>
                                    <td>
                                        <?php if($value->description != ''): ?>
                                            <label style="cursor:pointer;" title="<?php echo e($value->description); ?>"><i class="fa fa-info-circle"></i></label>
                                        <?php endif; ?>
                                    </td>
                                    <td>
                                        <?php echo e($value->priority); ?>

                                    </td>
                                    <td>
                                        <label data-toggle="modal" data-target="#myModal" onclick="ajaxEditName('<?php echo e($value->id); ?>');" class="btn btn-default btn-block"><i class="fa fa-edit"></i> </label>
                                    </td>
                                    <td>
                                        <label id="btnActiveOption<?php echo e($key+1); ?>" onclick="ajaxActiveOption('<?php echo e($value->id); ?>','<?php echo e($key+1); ?>');" class="<?php if($value->active == 1): ?> btn btn-default btn-block <?php else: ?> btn btn-default btn-block <?php endif; ?>">
                                            <?php if($value->active == 1): ?> <i class="fa fa-check text-success"></i> <?php else: ?> <i class="fa fa-plus text-danger" style="transform: rotate(45deg)"></i> <?php endif; ?>
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



                    
                    <div class="modal fade" id="myModal" role="dialog">
                        <div class="modal-dialog modal-md">
                            <!-- Modal content-->
                            <div class="modal-content">
                                <div class="modal-header">
                                    <button type="button" class="close" data-dismiss="modal">&times;</button>
                                    <h4 class="modal-title">ویرایش امکانات</h4>
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


    <script type="text/javascript">
        $(document).ready(function () {

            //

        });


        function ajaxEditName(id) {
            // console.log(id);
            var img = '<div class="text-center"><img style="height:50px;width:auto;" src="<?php echo e(asset('backend/img/img_loading/orange_circles.gif')); ?>" /></div>';
            $('#ExtraModalEdit').html(img);
            $.ajax({
                url:"<?php echo e(url('edit/option').'/'); ?>"+id,
                method:"get",
            }).done(function(returnData) {
                console.log(returnData);
                $('#ExtraModalEdit').html(returnData);
            })
        }



        function ajaxActiveOption(id,idInput) {
            $.ajax({
                url:"<?php echo e(url('active/option').'/'); ?>"+id,
                method:"get",
            }).done(function(returnData){
                // console.log(returnData);
                if(returnData == 'active')
                {
                    // console.log('active');
                    $("#btnActiveOption"+idInput).addClass('btn-default');
                    $("#btnActiveOption"+idInput).removeClass('btn-default');
                    $("#btnActiveOption"+idInput).css("transition", "0.5s");
                    $("#btnActiveOption"+idInput).text('');
                    $("#btnActiveOption"+idInput).append('<i class="fa fa-check text-success"></i>');
                }
                else if(returnData == 'deactive')
                {
                    // console.log('deactive');
                    $("#btnActiveOption"+idInput).addClass('btn-default');
                    $("#btnActiveOption"+idInput).removeClass('btn-default');
                    $("#btnActiveOption"+idInput).css("transition", "0.5s");
                    $("#btnActiveOption"+idInput).text('');
                    $("#btnActiveOption"+idInput).append('<i class="fa fa-plus text-danger" style="transform: rotate(45deg)"></i>');
                }
            });
        }
    </script>
<?php $__env->stopSection(); ?>
<?php echo $__env->make('backend.MasterPage.Layout', array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>