
<?php $__env->startSection('title'); ?>
    ویلا :: اسلایدشو
<?php $__env->stopSection(); ?>

<?php $__env->startSection('style'); ?>
    <link rel="stylesheet" href="<?php echo e(asset('backend/css/dataTables.bootstrap.css')); ?>">
    <link rel="stylesheet" href="<?php echo e(asset('backend/css/TableTools.css')); ?>">
    <style>
        #ToolTables_DataTables_Table_0_0{
            display: none;
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
            <a class="" href="<?php echo e(route('AdminDashboard')); ?>">صفحه اصلی</a><span class="now-url"> / اسلایدشو</span>
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
                    <h3 class="panel-title">اسلایدشو</h3>
                </div>
                <div class="panel-body">
                    <form role="form" action="<?php echo e(route('StoreSlideShow')); ?>" method="post" enctype="multipart/form-data" id="FormCreatePositionType">
                        <?php echo e(csrf_field()); ?>

                        <div class="row">
                            <div class="col-md-2">
                                <div class="form-group">
                                    <label for="InputTitle">عنوان</label><span style="font-size: 18px;" class="text-danger">*</span>
                                    <input type="text" name="title" value="<?php echo e(old('title')); ?>" class="form-control primary" dir="rtl" id="InputTitle" placeholder="عنوان را وارد کنید" autofocus>
                                </div>
                                <?php if($errors->has('title')): ?>
                                    <span style="color:red;"><?php echo e($errors->first('title')); ?></span>
                                <?php endif; ?>
                            </div>
                            <div class="col-md-2">
                                <div class="form-group">
                                    <label>استان</label><span style="font-size: 18px;" class="text-danger">*</span>
                                    <select name="province_id" id="SelectProvince" class="form-control SelectProvince">
                                        <option value="" hidden>انتخاب کنید</option>
                                        <?php $__currentLoopData = $provinceModel; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $key => $value): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                            <option value="<?php echo e($value->id); ?>"><?php echo e($value->name); ?></option>
                                        <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                                    </select>
                                </div>
                            </div>
                            <div class="col-md-2">
                                <div class="form-group">
                                    <label>شهرستان</label><span style="font-size: 18px;" class="text-danger">*</span>
                                    <select name="township_id" id="SelectTownship" class="form-control SelectTownship">
                                        <option value="" hidden></option>
                                        
                                        
                                        
                                    </select>
                                </div>
                            </div>
                            <div class="col-md-2">
                                <div class="form-group">
                                    <label for="InputFileImg">تصویر</label><span style="font-size: 18px;" class="text-danger">*</span>
                                    <br />
                                    <span class="btn btn-primary btn-file">
                                        انتخاب کنید ...
                                        <input type="file" name="img" value="<?php echo e(old('img')); ?>" dir="rtl" id="InputFileImg" />
                                    </span>
                                </div>
                                <?php if($errors->has('img')): ?>
                                    <span style="color:red;"><?php echo e($errors->first('img')); ?></span>
                                <?php endif; ?>
                            </div>
                            <div class="col-md-3">
                                <div class="form-group">
                                    <label for="InputLink">لینک</label><span style="font-size: 18px;" class="text-danger">*</span>
                                    <input type="text" name="link" value="<?php echo e(old('link')); ?>" class="form-control primary" dir="ltr" id="InputLink" placeholder="http://">
                                </div>
                                <?php if($errors->has('link')): ?>
                                    <span style="color:red;"><?php echo e($errors->first('link')); ?></span>
                                <?php endif; ?>
                            </div>
                            <div class="col-md-1">
                                <label for="BtnCreatePosition">&nbsp;</label>
                                <button type="submit" id="BtnCreatePosition" class="btn btn-default BtnRegAll btn-block ">ثبت</button>
                            </div>
                        </div>
                    </form>

                    <hr />

                    <table cellpadding="0" cellspacing="0" border="0"
                           class="table table-striped table-bordered editable-datatable">
                        <thead>
                        <tr>
                            <th>ردیف</th>
                            <th>تصویر</th>
                            <th>عنوان</th>
                            <th>ویرایش</th>
                            <th>تاریخ ایجاد</th>
                        </tr>
                        </thead>
                        <tbody>
                        <?php $__currentLoopData = $slideShowModel; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $key => $value): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                            <tr class="1">
                                <td>
                                    <?php echo e($key+1); ?>

                                </td>
                                <td>
                                    <img class="img-advertising" src="<?php echo e(asset('Uploaded/SlideShow/Img').'/'.$value->img); ?>" alt="">
                                </td>
                                <td>
                                    <?php echo e($value->title); ?>

                                </td>
                                <td>
                                    <label data-toggle="modal" data-target="#myModal" onclick="ajaxEditSlideShow('<?php echo e($value->id); ?>');" class="btn btn-default btn-block"><i class="fa fa-edit"></i> </label>
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
                                    <h4 class="modal-title">ویرایش</h4>
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
        $(document).ready(function () {
    
            //get township
            $("body").delegate(".SelectProvince", "change", function (e) {
        
                var id = $(this).val();
                getTownship(id);
            });
    
            //get township
            function getTownship(id) {
                $.ajaxSetup({
                    headers: {
                        'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                    }
                });
                $.ajax({
                    url: '<?php echo e(route('GetAjaxTownship')); ?>',
                    type: 'post',
                    data: {
                        id: id
                    },
                    success: function (data) {
                        $(".SelectTownship").html(data);
                    }
                });
        
            }
        });
        function ajaxEditSlideShow(id) {
            // console.log(id);
            var img = '<div class="text-center"><img style="height:50px;width:auto;" src="<?php echo e(asset('backend/img/img_loading/orange_circles.gif')); ?>" /></div>';
            $('#ExtraModalEdit').html(img);
            $.ajax({
                url:"<?php echo e(url('edit/slide-show').'/'); ?>"+id,
                method:"get",
            }).done(function(returnData) {
                console.log(returnData);
                $('#ExtraModalEdit').html(returnData);
            })
        }


    </script>
<?php $__env->stopSection(); ?>
<?php echo $__env->make('backend.MasterPage.Layout', array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>