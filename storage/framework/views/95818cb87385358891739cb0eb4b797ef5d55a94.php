<?php $__env->startSection('title'); ?>
    <?php echo e(TitlePage('نمایش اقامتگاه ها')); ?>

<?php $__env->stopSection(); ?>

<?php $__env->startSection('style'); ?>
    <link rel="stylesheet" href="<?php echo e(asset('backend/css/dataTables.bootstrap.css')); ?>">
    <link rel="stylesheet" href="<?php echo e(asset('backend/css/TableTools.css')); ?>">
    <style>
        #ToolTables_DataTables_Table_0_0{
            display: none;
        }
        .btn-group.pull-right.tabletools-btn {
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
        .border-red {
            border: 1px solid #f17676;
            background: #fff7f7;
        }
        .border-green {
            border: 1px solid #2ece31;
            background: #f7fff7;
        }
        .border-blue {
            border: 1px solid #2ececc;
            background: #f3fdff;
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
                    <h3 class="panel-title">نمایش اقامتگاه ها</h3>
                </div>
                <div class="panel-body">
                    <ul class="nav nav-tabs">
                        <li class="active"><a data-toggle="tab" href="#menu1">نمایش اقامتگاه ها</a></li>



                    </ul>

                    <div class="tab-content">
                        <div id="menu1" class="tab-pane fade in active">
                            <?php if(count($hostModel) == 0 && auth()->user()->role_id != 1 && count($integratedModel) == 0): ?>
                                <div class="row">
                                    <div class="col-md-12">
                                        <a href="<?php echo e(route('CreateHost')); ?>" class="btn btn-default">ثبت اقامتگاه جدید</a>
                                    </div>
                                </div>
                            <?php else: ?>
                                <table cellpadding="0" cellspacing="0" border="0"
                                       class="table table-striped table-bordered editable-datatable">
                                    <thead>
                                    <tr>
                                        <th>ردیف</th>
                                        <th>نام اقامتگاه</th>
                                        <th>استان</th>
                                        <?php if(auth()->user()->role_id != 1): ?>
                                            <th>تقویم</th>
                                        <?php endif; ?>
                                        <th>ویرایش</th>
                                        <th>وضعیت</th>
                                        <th>حذف</th>
                                        <th>تایید مدیریت</th>
                                        <?php if(auth()->user()->role_id == 1): ?>
                                            <th>ارسال پیامک</th>
                                        <?php endif; ?>
                                        <th>تاریخ ایجاد</th>
                                    </tr>
                                    </thead>
                                    <tbody>
                                    <?php $__currentLoopData = $hostModel; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $key => $value): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                        <tr class="1">
                                            <td>
                                                <?php echo e($key+1); ?>

                                            </td>
                                            <td>
                                                <?php echo e($value->name); ?>

                                            </td>
                                            <td>
                                                <?php if($Province = $value->getProvince): ?>
                                                    <?php echo e($Province->name); ?>

                                                <?php else: ?>
                                                    -
                                                <?php endif; ?>
                                            </td>
                                            <?php if(auth()->user()->role_id != 1): ?>
                                                <td>
                                                    <a href="<?php echo e(route('IndexPersonalize', ['id' => $value->id])); ?>" class="btn btn-default btn-block"><i class="fa fa-briefcase"></i> </a>
                                                </td>
                                            <?php endif; ?>
                                            <td>
                                                <a href="<?php echo e(route('EditHost', ['id' => $value->id])); ?>" class="btn btn-default btn-block">
                                                    <i class="fa fa-edit"></i>
                                                </a>
                                            </td>
                                            <td>
                                                <label id="btnActiveHost<?php echo e($key+1); ?>" onclick="ajaxActiveHost('<?php echo e($value->id); ?>','<?php echo e($key+1); ?>');" class="<?php if($value->active == 1): ?> btn btn-default btn-block <?php else: ?> btn btn-default btn-block <?php endif; ?>">
                                                    <?php if($value->active == 1): ?> فعال <?php else: ?> غیرفعال <?php endif; ?>
                                                </label>
                                            </td>
                                            <td>
                                                <button class="btn btn-danger" onclick="DeleteHost(<?php echo e($value->id); ?>)">حذف</button>
                                            </td>
                                            <td>
                                                <label <?php if(auth()->user()->role_id == 1): ?> id="btnStatusHost<?php echo e($key+1); ?>" onclick="ajaxStatusHost('<?php echo e($value->id); ?>','<?php echo e($key+1); ?>');" <?php endif; ?> class="btn btn-default btn-block <?php if($value->status == 1): ?> border-green <?php elseif($value->status == 2): ?> border-red <?php else: ?> border-blue <?php endif; ?>">
                                                    <?php if($value->status == 0): ?> درانتظار تایید <?php elseif($value->status == 1): ?> تایید شده<?php else: ?> تایید نشده <?php endif; ?>
                                                </label>
                                            </td>
                                            <?php if(auth()->user()->role_id == 1): ?>
                                                <td>
                                                    <label onclick="ajaxStatusSuccessHost('<?php echo e($value->id); ?>');" class="btn btn-default text-success btn-block">
                                                        ارسال پیام تایید
                                                    </label>
                                                </td>
                                            <?php endif; ?>
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
                            <?php endif; ?>
                        </div>





















































                    </div>


                </div>
            </div>
        </div>
    </div>

    <!-- Modal -->
    <div id="myModal" class="modal fade" role="dialog">
        <div class="modal-dialog">

            <!-- Modal content-->
            <div class="modal-content">
                <div class="modal-header">
                    <button type="button" class="close" data-dismiss="modal">&times;</button>
                    <h4 class="modal-title">اقامتگاه ها</h4>
                </div>
                <div class="modal-body">
                    <div id="ExtraIndexHost">

                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-default" data-dismiss="modal">بستن</button>
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


        function ajaxActiveHost(id,idInput) {
            $.ajax({
                url:"<?php echo e(url('active/host').'/'); ?>"+id,
                method:"get",
            }).done(function(returnData){
                // console.log(returnData);
                if(returnData == 'active')
                {
                    // console.log('active');
                    $("#btnActiveHost"+idInput).addClass('btn-default');
                    $("#btnActiveHost"+idInput).removeClass('btn-default');
                    $("#btnActiveHost"+idInput).css("transition", "0.5s");
                    $("#btnActiveHost"+idInput).text('');
                    $("#btnActiveHost"+idInput).append('فعال');
                }
                else if(returnData == 'deactive')
                {
                    // console.log('deactive');
                    $("#btnActiveHost"+idInput).addClass('btn-default');
                    $("#btnActiveHost"+idInput).removeClass('btn-default');
                    $("#btnActiveHost"+idInput).css("transition", "0.5s");
                    $("#btnActiveHost"+idInput).text('');
                    $("#btnActiveHost"+idInput).append('غیرفعال');
                }
            });
        }

        function DeleteHost(id) {
            if (confirm("آیا اطمینان از حذف اقامتگاه را دارید؟")) {
                window.location.href = 'http://www.rentt.ir/delete/host/'+id;
            } else {
                console.log('22222222222222');
                return false;
            }
        }



        <?php if(auth()->user()->role_id == 1): ?>
        function ajaxStatusHost(id,idInput) {
            $.ajax({
                url:"<?php echo e(url('status/host').'/'); ?>"+id,
                method:"get",
            }).done(function(returnData){
                // console.log(returnData);
                if(returnData == '0')
                {
                    // console.log('0');
                    $("#btnStatusHost"+idInput).addClass('border-blue');
                    $("#btnStatusHost"+idInput).removeClass('border-red');
                    $("#btnStatusHost"+idInput).removeClass('border-green');
                    $("#btnStatusHost"+idInput).css("transition", "0.5s");
                    $("#btnStatusHost"+idInput).text('');
                    $("#btnStatusHost"+idInput).append('در انتظار تایید');
                }
                else if(returnData == '1')
                {
                    // console.log('1');
                    $("#btnStatusHost"+idInput).addClass('border-green');
                    $("#btnStatusHost"+idInput).removeClass('border-red');
                    $("#btnStatusHost"+idInput).removeClass('border-blue');
                    $("#btnStatusHost"+idInput).css("transition", "0.5s");
                    $("#btnStatusHost"+idInput).text('');
                    $("#btnStatusHost"+idInput).append('تایید شده');
                }
                else if(returnData == '2')
                {
                    // console.log('2');
                    $("#btnStatusHost"+idInput).addClass('border-red');
                    $("#btnStatusHost"+idInput).removeClass('border-blue');
                    $("#btnStatusHost"+idInput).removeClass('border-green');
                    $("#btnStatusHost"+idInput).css("transition", "0.5s");
                    $("#btnStatusHost"+idInput).text('');
                    $("#btnStatusHost"+idInput).append('تایید نشده');
                }
            });
        }


        function ajaxStatusSuccessHost(id) {
            $.ajax({
                url:"<?php echo e(url('status/host/success-sms').'/'); ?>"+id,
                method:"get",
            }).done(function(returnData){
                // console.log(returnData);
                if(returnData == 'success')
                {
                    // check data and view popup for send sms
                    $.Toast("<p>ارسال پیامک</p>", "<p>پیام تاییدیه با موفقیت ارسال شد .</p>", "success", {
                        has_icon: true,
                        has_close_btn: true,
                        stack: true,
                        fullscreen: false,
                        timeout: 4000,
                        sticky: false,
                        has_progress: true,
                        rtl: true,
                    });
                }
            });
        }
        <?php endif; ?>




        function ajaxHostIntegrated(id) {
            var img = '<div class="text-center box-loading"><img style="height:50px;width:auto;" src="<?php echo e(asset('backend/img/img_loading/orange_circles.gif')); ?>" /></div>';
            $('#myModal').modal('show');
            $('#ExtraIndexHost').html(img);

            $.ajax({
                url:"<?php echo e(url('index/host-integrated').'/'); ?>"+id,
                method:"get",
            }).done(function(returnData){
                if(returnData.Success == 1) {
                    $('#ExtraIndexHost').html(returnData.Message.original);
                }
            });
        }

    </script>
<?php $__env->stopSection(); ?>
<?php echo $__env->make('backend.MasterPage.Layout', array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>