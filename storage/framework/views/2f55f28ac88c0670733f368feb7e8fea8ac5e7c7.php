
<?php $__env->startSection('title',TitlePage('مدیریت شهرستان ها')); ?>
<?php $__env->startSection('style'); ?>
    <link rel="stylesheet" href="<?php echo e(asset('backend/css/dataTables.bootstrap.css')); ?>">
    <link rel="stylesheet" href="<?php echo e(asset('backend/css/TableTools.css')); ?>">
    <link rel="stylesheet" href="<?php echo e(asset('backend/css/dataTables.bootstrap.css')); ?>">
    <link rel="stylesheet" href="<?php echo e(asset('backend/css/TableTools.css')); ?>">
    <link rel="stylesheet" href="<?php echo e(asset('backend/css/bootstrap.min.css')); ?>">
    <link rel="stylesheet" href="<?php echo e(asset('backend/css/offline-theme-dark.css')); ?>">
    <link rel="stylesheet" href="<?php echo e(asset('backend/css/bootstrap-override.css')); ?>">
    <link rel="stylesheet" href="<?php echo e(asset('backend/css/font-awesome.min.css')); ?>">
    <link rel="stylesheet" href="<?php echo e(asset('backend/css/layout.css')); ?>">
    <link rel="stylesheet" href="<?php echo e(asset('backend/css/library.css')); ?>">
    <link rel="stylesheet" href="<?php echo e(asset('backend/css/style.css')); ?>">
    <style>
        #ToolTables_advancetable_0{
            display: none;
        }
        form {
            border: 1px solid #ccc;
            padding: 10px;
            border-radius: 5px;
            margin-bottom: 20px;
            background-color: #efefef;
        }
    </style>
<?php $__env->stopSection(); ?>

<?php $__env->startSection('content'); ?>



    <div class="row back-url">
        <div class="col-md-12">
            <a class="" href="<?php echo e(route('AdminDashboard')); ?>">صفحه اصلی</a>
            <span class="now-url"> / مدیریت شهرستان ها</span>
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
                    <h3 class="panel-title">مدیریت شهرستان ها</h3>
                </div>
                <div class="panel-body">

                    <form action="<?php echo e(route('StoreTownship')); ?>" method="post">
                        <?php echo e(csrf_field()); ?>

                        <div class="row">
                            <div class="col-md-2">
                                <div class="form-group">
                                    <label>استان</label><span style="font-size: 18px;" class="text-danger">*</span>
                                    <select name="province_id" class="form-control SelectProvince">
                                        <option value="" hidden>انتخاب کنید</option>
                                        <?php $__currentLoopData = $provinceModel; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $key => $value): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                            <option value="<?php echo e($value->id); ?>"><?php echo e($value->name); ?></option>
                                        <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                                    </select>
                                </div>
                            </div>
                            <div class="col-md-4">
                                <div class="form-group">
                                    <label>نام شهرستان</label><span style="font-size: 18px;" class="text-danger">*</span>
                                    <input type="text" id="" class="form-control" name="name" placeholder="نام شهرستان را وارد کنید" />
                                </div>
                            </div>
                            <div class="col-md-2">
                                <label for="BtnCreateTownship">&nbsp;</label>
                                <button type="submit" class="btn btn-success btn-block" id="BtnCreateTownship">ثبت شهرستان</button>
                            </div>
                        </div>
                    </form>

                    <table cellpadding="0" cellspacing="0" border="0" class="table table-striped table-bordered" id="advancetable">
                        <thead>
                        <tr>
                            <th>ردیف</th>
                            <th>استان</th>
                            <th>شهر</th>
                            <th>اولویت</th>
                            <th>وضعیت</th>
                            <th>ویرایش</th>
                            <th>تاریخ ثبت</th>
                        </tr>
                        </thead>
                        <tbody>
                        <?php $__currentLoopData = $townshipModel; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $key => $value): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                            <tr class="1">
                                <td>
                                    <?php echo e($key+1); ?>

                                </td>
                                <td>
                                    <?php if($Province = $value->provinceGet): ?>
                                        <?php echo e($Province->name); ?>

                                    <?php else: ?>
                                        -
                                    <?php endif; ?>
                                </td>
                                <td>
                                    <?php echo e($value->name); ?>

                                </td>
                                <td>
                                    <?php echo e($value->priority); ?>

                                </td>
                                <td>
                                    <label id="btnActiveTownship<?php echo e($key+1); ?>" onclick="ajaxActiveTownship('<?php echo e($value->id); ?>','<?php echo e($key+1); ?>');" class="<?php if($value->active == 1): ?> btn btn-default btn-block <?php else: ?> btn btn-default btn-block <?php endif; ?>">
                                        <?php if($value->active == 1): ?> <i class="fa fa-check text-success"></i> <?php else: ?> <i class="fa fa-plus text-danger" style="transform: rotate(45deg)"></i> <?php endif; ?>
                                    </label>
                                </td>
                                <td>
                                    <label data-toggle="modal" onclick="ajaxEditTownship('<?php echo e($value->id); ?>');" data-target="#myModal" class="btn btn-default btn-block" style="cursor: pointer;" >
                                        <i class="fa fa-edit"></i>
                                    </label>
                                </td>
                                <td class="">
                                    <?php (
                                        $create_date = \Morilog\Jalali\Facades\jDate::forge($value->created_at)->format('Y/m/d')
                                    ); ?>
                                    <?php echo e($create_date); ?>

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
                                    <h4 class="modal-title">ویرایش شهرستان</h4>
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
    <script type="text/javascript" src="<?php echo e(asset('backend/js/jquery.dataTables.min.js')); ?>"></script>
    <script type="text/javascript" src="<?php echo e(asset('backend/js/TableTools.min.js')); ?>"></script>
    <script type="text/javascript" src="<?php echo e(asset('backend/js/dataTables.bootstrap.js')); ?>"></script>
    <script type="text/javascript" src="<?php echo e(asset('backend/js/datatables.js')); ?>"></script>
    <script type="text/javascript" src="<?php echo e(asset('backend/js/editable-datatables.js')); ?>"></script>
    <script>

        $(document).ready(function () {
            //get city
            $("body").delegate(".SelectProvince","change",function (e) {

                var id=$(this).val();
                getCity(id);
            });

            //get city
            function getCity(id)
            {
                $.ajaxSetup({
                    headers : {
                        'X-CSRF-TOKEN' : $('meta[name="csrf-token"]').attr('content')
                    }
                });
                $.ajax({
                    url: '<?php echo e(route('GetAjaxCity')); ?>',
                    type : 'post',
                    data : {
                        id:id
                    },
                    success : function (data) {
                        $(".SelectCity").html(data);
                    }
                });


            }


            //get area
            $("body").delegate(".SelectCity","change",function (e) {

                var id=$(this).val();
                getArea(id);
            });

            //get area
            function getArea(id)
            {
                $.ajaxSetup({
                    headers : {
                        'X-CSRF-TOKEN' : $('meta[name="csrf-token"]').attr('content')
                    }
                });
                $.ajax({
                    url: '<?php echo e(route('GetAjaxArea')); ?>',
                    type : 'post',
                    data : {
                        id:id
                    },
                    success : function (data) {
                        $(".SelectArea").html(data);
                    }
                });

            }
        });

        function ajaxActiveTownship(id,idInput) {
            $.ajax({
                url:"<?php echo e(url('active/township').'/'); ?>"+id,
                method:"get",
            }).done(function(returnData){
                console.log(returnData);
                if(returnData == 'active')
                {
                    // console.log('active');
                    $("#btnActiveTownship"+idInput).addClass('btn-default');
                    $("#btnActiveTownship"+idInput).removeClass('btn-default');
                    $("#btnActiveTownship"+idInput).css("transition", "0.5s");
                    $("#btnActiveTownship"+idInput).text('');
                    $("#btnActiveTownship"+idInput).append('<i class="fa fa-check text-success"></i>');
                }
                else if(returnData == 'deactive')
                {
                    // console.log('deactive');
                    $("#btnActiveTownship"+idInput).addClass('btn-default');
                    $("#btnActiveTownship"+idInput).removeClass('btn-default');
                    $("#btnActiveTownship"+idInput).css("transition", "0.5s");
                    $("#btnActiveTownship"+idInput).text('');
                    $("#btnActiveTownship"+idInput).append('<i class="fa fa-plus text-danger" style="transform: rotate(45deg)"></i>');
                }
            });
        }



        function ajaxEditTownship(id) {
            var img = '<div class="text-center"><img style="height:50px;width:auto;" src="<?php echo e(asset('backend/img/img_loading/orange_circles.gif')); ?>" /></div>';
            $('#ExtraModalEdit').html(img);
            $.ajax({
                url:"<?php echo e(url('edit/township').'/'); ?>"+id,
                method:"get",
            }).done(function(returnData) {
                $('#ExtraModalEdit').html(returnData);
            })
        }
    </script>

    
<?php $__env->stopSection(); ?>
<?php echo $__env->make('backend.MasterPage.Layout', array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>