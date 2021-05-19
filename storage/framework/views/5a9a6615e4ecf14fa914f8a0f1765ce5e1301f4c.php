
<?php $__env->startSection('title', TitlePage('نظرات و امتیازات')); ?>
<?php $__env->startSection('style'); ?>
    <link rel="stylesheet" href="<?php echo e(asset('backend/css/dataTables.bootstrap.css')); ?>">
    <link rel="stylesheet" href="<?php echo e(asset('backend/css/TableTools.css')); ?>">
    <style>
        #ToolTables_DataTables_Table_0_0{
            display: none;
        }
        .img-host {
            width: 50%;
            transition: 0.5s;
        }
        .img-host:hover {
            width: 100%;
            transition: 0.5s;
        }
        li.li-comment {
            background: #ffe9cf;
        }
    </style>
    <link rel="stylesheet" href="<?php echo e(asset('backend/css/bootstrap-datepicker.min.css')); ?>"/>
<?php $__env->stopSection(); ?>

<?php $__env->startSection('content'); ?>
    <div class="row back-url">
        <div class="col-md-12">
            <a class="" href="<?php if(auth()->user()->role_id == 1): ?> <?php echo e(route('AdminDashboard')); ?> <?php else: ?> <?php echo e(route('UserDashboard')); ?> <?php endif; ?>">صفحه اصلی</a><span class="now-url"> / اقامتگاه های رزرو شده</span>
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
                    <h3 class="panel-title">اقامتگاه های رزرو شده</h3>
                </div>
                <div class="panel-body">
                    <table cellpadding="0" cellspacing="0" border="0"
                           class="table table-bordered editable-datatable">
                        <thead>
                        <tr>
                            <th>ردیف</th>
                            <th>اطلاعات اقامتگاه</th>
                            <th>اطلاعات میهمان</th>
                            <th>مشاهده نظرات و امتیازات</th>
                            <th>میانگین امتیازات</th>
                            <th>وضعیت</th>
                            <th>تاریخ ثبت</th>
                        </tr>
                        </thead>
                        <tbody>
                        <?php $__currentLoopData = $rateModel; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $key => $value): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                            <tr class="1">
                                <td>
                                    <?php echo e($key+1); ?>

                                </td>
                                <td>
                                    <button data-toggle="modal" data-target="#detailHostModal" onclick="AjaxDetailHost(<?php echo e($value->id); ?>)" class="btn btn-default btn-block" >
                                        <span class="text-info"><i class="fa fa-info-circle"></i> <?php echo e($value->getHost->name); ?>  </span>
                                    </button>
                                </td>
                                <td>
                                    <button data-toggle="modal" data-target="#detailGuestModal" onclick="AjaxDetailGuest(<?php echo e($value->id); ?>)" class="btn btn-default btn-block" >
                                        <span class="text-info"><i class="fa fa-info-circle"></i> <?php echo e($value->getUser->first_name.' '.$value->getUser->last_name); ?>  </span>
                                    </button>
                                </td>
                                <td>
                                    <button data-toggle="modal" data-target="#detailCommentAndRateModal" onclick="AjaxCommentAndRate(<?php echo e($value->id); ?>)" class="btn btn-default btn-block" >
                                        <span class="text-success"><i class="fa fa-star-o"></i><i class="fa fa-star-o"></i><i class="fa fa-star-half-o"></i><i class="fa fa-star"></i><i class="fa fa-star"></i></span>
                                    </button>
                                </td>
                                <td class="text-center">
                                    <?php 
                                        $avg = ($value->rate1+$value->rate2+$value->rate3+$value->rate4+$value->rate5)/5;
                                     ?>
                                    <span class="event_star<?php echo e($key+1); ?> star_big" data-starnum="<?php echo e($key+1); ?>">
                                       <i></i>
                                    </span>
                                    <style>
                                        .star_big[data-starnum="<?php echo e($key+1); ?>"] i {
                                            width: <?php echo e($avg*30); ?>px;
                                        }
                                    </style>
                                </td>
                                <td>
                                    <button id="btnActiveComment<?php echo e($key+1); ?>" onclick="ajaxActiveComment('<?php echo e($value->id); ?>','<?php echo e($key+1); ?>');" class="btn btn-default btn-block">
                                        <?php if($value->status == 1): ?> <i class="fa fa-check text-success"></i> <?php else: ?> <i class="fa fa-plus text-danger" style="transform: rotate(45deg)"></i> <?php endif; ?>
                                    </button>
                                </td>
                                <td>
                                    <?php (
                                        $date = \Morilog\Jalali\Facades\jDate::forge($value->reserve_date)->format('Y/m/d')
                                    ); ?>
                                    <?php echo e($date); ?>

                                </td>
                            </tr>
                        <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                        </tbody>
                    </table>


                    
                    <div class="modal fade" id="detailHostModal" role="dialog">
                        <div class="modal-dialog modal-md">
                            <!-- Modal content -->
                            <div class="modal-content">
                                <div class="modal-header">
                                    <button type="button" class="close" data-dismiss="modal">&times;</button>
                                    <h4 class="modal-title">مشخصات اقامتگاه</h4>
                                </div>
                                <div class="modal-body" id="ExtraModalDetailHost">

                                </div>
                            </div>
                        </div>
                    </div>


                    
                    <div class="modal fade" id="detailGuestModal" role="dialog">
                        <div class="modal-dialog modal-md">
                            <!-- Modal content -->
                            <div class="modal-content">
                                <div class="modal-header">
                                    <button type="button" class="close" data-dismiss="modal">&times;</button>
                                    <h4 class="modal-title">مشخصات مهمان</h4>
                                </div>
                                <div class="modal-body" id="ExtraModalDetailGuest">

                                </div>
                            </div>
                        </div>
                    </div>


                    
                    <div class="modal fade" id="detailCommentAndRateModal" role="dialog">
                        <div class="modal-dialog modal-md">
                            <!-- Modal content -->
                            <div class="modal-content">
                                <div class="modal-header">
                                    <button type="button" class="close" data-dismiss="modal">&times;</button>
                                    <h4 class="modal-title">مشاهده نظرات و امتیازات</h4>
                                </div>
                                <div class="modal-body" id="ExtraModalRateAndComment">

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
    <script src="<?php echo e(asset('backend/js/bootstrap-datepicker.min.js')); ?>"></script>
    <script src="<?php echo e(asset('backend/js/bootstrap-datepicker.fa.min.js')); ?>"></script>

    <script>



        function ajaxActiveComment(id,idInput) {
            $.ajax({
                url:"<?php echo e(url('active/comment-rate').'/'); ?>"+id,
                method:"get",
            }).done(function(returnData){
                if(returnData == 'active')
                {
                    // console.log('active');
                    $("#btnActiveComment"+idInput).addClass('btn-default');
                    $("#btnActiveComment"+idInput).removeClass('btn-default');
                    $("#btnActiveComment"+idInput).css("transition", "0.5s");
                    $("#btnActiveComment"+idInput).text('');
                    $("#btnActiveComment"+idInput).append('<i class="fa fa-check text-success"></i>');
                }
                else if(returnData == 'deActive')
                {
                    // console.log('deActive');
                    $("#btnActiveComment"+idInput).addClass('btn-default');
                    $("#btnActiveComment"+idInput).removeClass('btn-default');
                    $("#btnActiveComment"+idInput).css("transition", "0.5s");
                    $("#btnActiveComment"+idInput).text('');
                    $("#btnActiveComment"+idInput).append('<i class="fa fa-plus text-danger" style="transform: rotate(45deg)"></i>');
                }
            });
        }


        function AjaxDetailHost(id) {
            var img = '<div class="text-center"><img style="height:50px;width:auto;" src="<?php echo e(asset('backend/img/img_loading/orange_circles.gif')); ?>" /></div>';
            $('#ExtraModalDetailHost').html(img);
            $.ajax({
                url:"<?php echo e(url('get/detail-host').'/'); ?>"+id,
                method:"get",
            }).done(function(returnData) {
                console.log(returnData);
                $('#ExtraModalDetailHost').html(returnData);
            })
        }


        function AjaxDetailGuest(id) {
            var img = '<div class="text-center"><img style="height:50px;width:auto;" src="<?php echo e(asset('backend/img/img_loading/orange_circles.gif')); ?>" /></div>';
            $('#ExtraModalDetailGuest').html(img);
            $.ajax({
                url:"<?php echo e(url('get/detail-guest').'/'); ?>"+id,
                method:"get",
            }).done(function(returnData) {
                console.log(returnData);
                $('#ExtraModalDetailGuest').html(returnData);
            })
        }


        function AjaxCommentAndRate(id) {
            var img = '<div class="text-center"><img style="height:50px;width:auto;" src="<?php echo e(asset('backend/img/img_loading/orange_circles.gif')); ?>" /></div>';
            $('#ExtraModalRateAndComment').html(img);
            $.ajax({
                url:"<?php echo e(url('get/comment-rate').'/'); ?>"+id,
                method:"get",
            }).done(function(returnData) {
                console.log(returnData);
                $('#ExtraModalRateAndComment').html(returnData);
            })
        }

    </script>
<?php $__env->stopSection(); ?>
<?php echo $__env->make('backend.MasterPage.Layout', array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>