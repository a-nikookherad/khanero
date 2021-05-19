
<?php $__env->startSection('title', TitlePage('شخصی سازی روزها')); ?>
<?php $__env->startSection('style'); ?>
    <link rel="stylesheet" href="<?php echo e(asset('backend/css/dataTables.bootstrap.css')); ?>">
    <link rel="stylesheet" href="<?php echo e(asset('backend/css/TableTools.css')); ?>">
    <style>
        #ToolTables_DataTables_Table_0_0{
            display: none;
        }
        .tabletools-btn {
            display: none;
        }
        .panel-title {
            cursor: pointer;
            color: #666;
        }

        .panel-success > .panel-heading {
            background-color: #dadada;
        }

        .panel-success > .panel-heading i {
            color: #666;
        }
        .box-calendar-special {
            max-height: 345px;
            overflow-y: scroll;
        }
        #InputPrice {
            display: none;
        }
        span.host-name {
            margin: 0px 10px;
            color: #a2a2a2;
            font-size: 12px;
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
                    <h3 class="panel-title">ثبت تخفیفات</h3>
                </div>
                <div class="panel-body">
                    <form role="form" action="<?php echo e(route('StoreDiscount')); ?>" method="post" enctype="multipart/form-data" id="FormCreateDiscount">
                        <?php echo e(csrf_field()); ?>

                        <input type="hidden" name="host_id" value="<?php echo e($hostModel->id); ?>" />
                        <div class="row">
                            <div class="col-md-6">
                                <div class="form-group">
                                    شما میتوانید برای
                                    <input type="text" style="width: 40px;display: inline-block;" id="InputDayDiscount" value="<?php echo e(old('number_days')); ?>" name="number_days" maxlength="2" class="text-center form-control" placeholder="00" />
                                    روز
                                    <input type="text" style="width: 40px;display: inline-block;" id="InputNumberPercent" value="<?php echo e(old('percent')); ?>" name="percent" maxlength="2" class="text-center form-control" placeholder="00" />
                                    درصد تخفیف بگیرید
                                    <button type="submit" id="BtnCreateDiscount" class="btn btn-success ">ثبت</button>

                                </div>
                                <?php if($errors->has('price')): ?>
                                    <span style="color:red;"><?php echo e($errors->first('price')); ?></span>
                                <?php endif; ?>
                            </div>
                            <div class="col-md-3">
                                <label for="BtnCreateDiscount">&nbsp;</label>
                            </div>
                        </div>
                    </form>

                    <div class="row">
                        <div class="col-md-12">
                            <hr />
                        </div>
                    </div>

                    <table cellpadding="0" cellspacing="0" border="0"
                           class="table table-striped table-bordered editable-datatable">
                        <thead>
                        <tr>
                            <th>ردیف</th>
                            <th>نام اقامتگاه</th>
                            <th>تعداد روز</th>
                            <th>درصد تخفیف %</th>
                            <th>قیمت روز</th>
                            <th>حذف</th>
                            <th>تاریخ ثبت</th>
                        </tr>
                        </thead>
                        <tbody>
                        <?php $__currentLoopData = $discountModel; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $key => $value): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                            <tr class="1">
                                <td>
                                    <?php echo e($key+1); ?>

                                </td>
                                <td>
                                    <?php echo e($value->getHost->name); ?>

                                </td>
                                <td>
                                    <?php echo e($value->number_days); ?>

                                </td>
                                <td>
                                    <?php echo e($value->percent); ?>

                                </td>
                                <td>
                                    <label data-toggle="modal" data-target="#myModal" onclick="ajaxEditPrice('<?php echo e($value->id); ?>');" class="btn btn-default btn-block">
                                        <i class="fa fa-edit"></i>
                                    </label>
                                </td>
                                <td>
                                    <label data-toggle="modal" data-target="#myModal" onclick="ajaxDeleteDiscount('<?php echo e($value->id); ?>');" class="btn btn-default btn-block">
                                        <i class="fa fa-trash-o"></i>
                                    </label>
                                </td>
                                <td>
                                    <?php (
                                        $created_date = \Morilog\Jalali\Facades\jDate::forge($value->created_at)->format('Y/m/d - H:i:s')
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
                                    <h4 class="modal-title">ثبت تغییرات</h4>
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
























































    <div class="row">
        <div class="col-md-12">
            <div class="panel panel-default">
                <div class="panel-heading">
                    <h3 class="panel-title">شخصی سازی روزهای تقویم<span class="host-name">(<?php echo e($hostModel->name); ?>)</span></h3>
                </div>
                <div class="panel-bodys">
                    <form role="form" action="<?php echo e(route('StorePersonalizeHost')); ?>" method="post" enctype="multipart/form-data" id="FormCreateSpecial">
                        <?php echo e(csrf_field()); ?>

                        <input type="hidden" value="<?php echo e($hostModel->id); ?>" name="host_id" />
                        <div class="row">
                            <div class="col-md-4 col-md-offset-4">
                                <?php echo $calendar; ?>

                                <div class="row">
                                    <form action="" method="post" >
                                        <?php echo e(csrf_field()); ?>

                                        <input type="hidden" value="<?php echo e($hostModel->id); ?>" id="HostId" name="host_id" />
                                        <div class="form-group">
                                            <input class="form-control" name="date_from" id="InputDateFrom" placeholder="از تاریخ">
                                        </div>
                                        <div class="form-group">
                                            <input class="form-control" name="date_to" id="InputDateTo" placeholder="تا تاریخ">
                                        </div>
                                        <div class="form-group">
                                            <select class="form-control" name="type" id="SelectType">
                                                <option value="block">مسدود سازی</option>
                                                <option value="unblock">آزاد سازی</option>
                                                <option value="special">روز ویژه</option>
                                            </select>
                                        </div>
                                        <div class="form-group">
                                            <input class="form-control" name="price" id="InputPrice" placeholder="قیمت">
                                        </div>
                                        <div class="form-group">
                                            <button type="submit" id="" class="btn btn-block">ویرایش اطلاعات</button>
                                        </div>
                                    </form>
                                </div>
                            </div>
                        </div>
                    </form>

                    
                        
                            
                        
                    

                    
                           
                        
                        
                            
                            
                            
                            
                            
                            
                            
                        
                        
                        
                        
                            
                                
                                    
                                
                                
                                    
                                
                                
                                    
                                        
                                    
                                    
                                
                                
                                    
                                
                                
                                    
                                        
                                    
                                
                                
                                    
                                        
                                    
                                
                                
                                    
                                        
                                    
                                    
                                
                            
                        
                        

                    
                    
                    
                        
                            
                            
                                
                                    
                                    
                                
                                

                                
                            
                        
                    
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


        $(document).ready(function () {

            $('.panel-body').slideToggle("slow");

        });


        // $("#InputDateSpecial").datepicker({
        //     minDate: 0,
        //     changeMonth: true,
        //     changeYear: true,
        //     isRTL: true,
        //     dateFormat: "yy/mm/dd",
        //     EnableTimePicker: true,
        // });


        $("#InputDateBlockedDay").datepicker({
            minDate: 0,
            changeMonth: true,
            changeYear: true,
            isRTL: true,
            dateFormat: "yy/mm/dd",
            EnableTimePicker: true,
        });

        function ajaxEditPrice(id) {
            // console.log(id);
            var img = '<div class="text-center"><img style="height:50px;width:auto;" src="<?php echo e(asset('backend/img/img_loading/orange_circles.gif')); ?>" /></div>';
            $('#ExtraModalEdit').html(img);
            $.ajax({
                url:"<?php echo e(url('edit/discount').'/'); ?>"+id,
                method:"get",
            }).done(function(returnData) {
                $('#ExtraModalEdit').html(returnData);
            })
        }

        function ajaxDeleteDiscount(id) {
            // console.log(id);
            var img = '<div class="text-center"><img style="height:50px;width:auto;" src="<?php echo e(asset('backend/img/img_loading/orange_circles.gif')); ?>" /></div>';
            $('#ExtraModalEdit').html(img);
            $.ajax({
                url:"<?php echo e(url('delete/discount').'/'); ?>"+id,
                method:"get",
            }).done(function(returnData) {
                $('#ExtraModalEdit').html(returnData);
            })
        }


        $('#SelectType').change(function () {
            if($(this).val() == 'special') {
                $('#InputPrice').css('display', 'block');
            } else {
                $('#InputPrice').css('display', 'none');
            }
        });




        //Panel options for removing and minimising panels
        $('.panel-options .fa-chevron-down').click(function(){
            $(this).parents('.panel').children('.panel-body').slideToggle("slow");
        });

        //Panel options for removing and minimising panels
        $('.panel-title').click(function(){
            $(this).parents('.panel').children('.panel-body').slideToggle("slow");
        });

    </script>
<?php $__env->stopSection(); ?>
<?php echo $__env->make('backend.MasterPage.Layout', array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>