
<?php $__env->startSection('title', TitlePage('علاقه مندی ها')); ?>
<?php $__env->startSection('style'); ?>
    <link rel="stylesheet" href="<?php echo e(asset('backend/css/dataTables.bootstrap.css')); ?>">
    <link rel="stylesheet" href="<?php echo e(asset('backend/css/TableTools.css')); ?>">
    <style>
        #ToolTables_DataTables_Table_0_0{
            display: none;
        }

        li.li-favorite {
            background: #ffe9cf;
        }
    </style>
    <link rel="stylesheet" href="<?php echo e(asset('backend/css/bootstrap-datepicker.min.css')); ?>"/>
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
                    <h3 class="panel-title">نمایش علاقه مندی ها</h3>
                </div>
                <div class="panel-body">
                    <?php ($i = 1); ?>
                    <?php $__currentLoopData = $favoriteModel; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $key => $value): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                        <?php if($i == 5): ?>
                            <?php ($i = 1); ?>
                        <?php endif; ?>
                        <?php if($i == 1): ?>
                            <div class="row">
                        <?php endif; ?>
                            <div class="col-md-3 box-favorite">
                                <div class="bx-favor">
                                    <label data-toggle="modal" data-target="#myModal" onclick="ajaxDeleteFavorite('<?php echo e($value->id); ?>');" class="btn btn-default btn-block btn-dlet"><i class="fa fa-trash-o"></i></label>
                                    <a href="<?php echo e(route('DetailHost', ['id' => $value->host_id])); ?>" target="_blank"><img src="<?php echo e(asset('Uploaded/Gallery/Img').'/'.$value->getHost->getGallery[0]->img); ?>" /></a>
                                    <a href="<?php echo e(route('DetailHost', ['id' => $value->host_id])); ?>" target="_blank"><h5 class="name-qw"><?php echo e($value->getHost->name); ?></h5></a>
                                </div>
                            </div>

                            <?php ($i++); ?>
                        <?php if($i == 5): ?>
                            </div>
                        <?php endif; ?>
                    <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                    <?php if(count($favoriteModel) == 0): ?>
                        <div class="row">
                            <div class="alert alert-warning">
                                <p>هیچ گونه علاقه مندی در سیستم به ثبت نرسیده است .</p>
                            </div>
                        </div>
                    <?php endif; ?>
                    
                    <div class="modal fade" id="myModal" role="dialog">
                        <div class="modal-dialog modal-md">
                            <!-- Modal content-->
                            <div class="modal-content">
                                <div class="modal-header">
                                    <button type="button" class="close" data-dismiss="modal">&times;</button>
                                    <h4 class="modal-title">حذف علاقه مندی</h4>
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
    <script src="<?php echo e(asset('backend/js/bootstrap-datepicker.min.js')); ?>"></script>
    <script src="<?php echo e(asset('backend/js/bootstrap-datepicker.fa.min.js')); ?>"></script>

    <script>


        $("#InputDateSpecial").datepicker({
            minDate: 0,
            changeMonth: true,
            changeYear: true,
            isRTL: true,
            dateFormat: "yy/mm/dd",
            EnableTimePicker: true,
        });

        function ajaxDeleteFavorite(id) {
            console.log(id);
            var img = '<div class="text-center"><img style="height:50px;width:auto;" src="<?php echo e(asset('backend/img/img_loading/orange_circles.gif')); ?>" /></div>';
            $('#ExtraModalEdit').html(img);
            $.ajax({
                url:"<?php echo e(url('delete/favorite').'/'); ?>"+id,
                method:"get",
            }).done(function(returnData) {
                $('#ExtraModalEdit').html(returnData);
            })
        }
        
    </script>
<?php $__env->stopSection(); ?>
<?php echo $__env->make('backend.MasterPage.Layout', array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>