<?php 
    $optionModel = App\Modules\Possibilities\Controllers\PossibilitiesController::GetOption();
    $serviceModel = App\Modules\Possibilities\Controllers\PossibilitiesController::GetService();
 ?>

<style>
    .progress .bar {
        width: 35%;
        background-color: #9987c0;
    }
    .box-description .right {
        display: inline-block;
    }
    .none {
        cursor: default;
        opacity: 0;
        transition: .2s;
    }
    .show {
        cursor: auto;
        opacity: 1;
        transition: .2s;
    }
    .line-height-35 {
        line-height: 35px;
    }
</style>


<div class="row text-center">
    <div class="col-md-12">
        <div class="row rows-address">
            <div class="col-md-2">
                <div class="poly">
                    <span>
                        <a href="<?php echo e(route('EditHost', ['id' => $hostModel->id, 'step' => 1])); ?>">مشخصات اقامتگاه</a>
                    </span>
                </div>
            </div>
            <div class="col-md-2">
                <div class="poly">
                    <span>
                        <a href="<?php echo e(route('EditHost', ['id' => $hostModel->id, 'step' => 2])); ?>">موقعیت</a>
                    </span>
                </div>
            </div>
            <div class="col-md-2">
                <div class="poly active">
                    <span>
                        <a href="<?php echo e(route('EditHost', ['id' => $hostModel->id, 'step' => 3])); ?>">امکانات</a>
                    </span>
                </div>
            </div>
            <div class="col-md-2">
                <div class="poly">
                    <span>
                        <a href="<?php echo e(route('EditHost', ['id' => $hostModel->id, 'step' => 4])); ?>">تصاویر</a>
                    </span>
                </div>
            </div>
            <div class="col-md-2">
                <div class="poly">
                    <span>
                        <a href="<?php echo e(route('EditHost', ['id' => $hostModel->id, 'step' => 5])); ?>">قوانین صاحبخانه</a>
                    </span>
                </div>
            </div>
            <div class="col-md-2">
                <div class="poly">
                    <span>
                        <a href="<?php echo e(route('EditHost', ['id' => $hostModel->id, 'step' => 6])); ?>">قیمت گذاری</a>
                    </span>
                </div>
            </div>
        </div>
    </div>
</div>


<div class="row">
    <div class="col-md-12">
        <div class="panel panel-default">
            <div class="panel-heading">
                <h3 class="panel-title">امکانات و خدمات<span class="information-step"><i class="fas fa-info-circle"></i></span></h3>
            </div>
            <?php 
                $g = $hostModel->getHostPossibilities;
                $arr = [];
                $arr_description = [];
                foreach ($g as $key => $value) {
                    $arr[] = $value->option_id;
                    $arr_description[] = $value->description;
                }
             ?>

            <div class="panel-body">
                <?php ($counter = 0); ?>
                <div class="row">
                    <div class="col-md-12">
                        <div class="row line-height-35">
                            <div class="col-md-12">
                                <h4 class="text-primary">امکانات اقامتگاه</h4>
                            </div>
                            <?php $__currentLoopData = $optionModel; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $key => $value): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                <?php if($counter == 2): ?>
                                    <?php ($counter = 0); ?>
                        </div>
                        <div class="row line-height-35">
                            <?php endif; ?>
                            <div class="col-md-6 rows">
                                <div class="row">
                                    <div class="col-md-1 text-right">
                                        <input type="checkbox" value="<?php echo e($value->id); ?>" <?php if(in_array($value->id, $arr)): ?> checked <?php endif; ?> class="chk check-description" data-value="<?php echo e($key+1); ?>" id="slideThree<?php echo e($key+1); ?>" name="check<?php echo e($key+1); ?>" />
                                    </div>
                                    <div class="col-md-3">
                                        <label title="<?php echo e($value->description); ?>" for="slideThree<?php echo e($key+1); ?>"><?php echo e($value->name); ?></label>
                                    </div>
                                    <div class="col-md-8">
                                        <input type="text" value="" class="form-control <?php if(!in_array($value->id, $arr)): ?> none <?php endif; ?> description input<?php echo e($key+1); ?>" name="" id="" placeholder="<?php echo e($value->description); ?>" />
                                    </div>
                                </div>
                            </div>
                            <?php ($counter++); ?>
                            <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                        </div>
                        <hr />

                        <?php ($counter = 0); ?>
                        <div class="row line-height-35">
                            <div class="col-md-12">
                                <h4 class="text-primary">خدمات و موارد بهداشتی</h4>
                            </div>
                            <?php $__currentLoopData = $serviceModel; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $key => $value): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                <?php if($counter == 2): ?>
                                    <?php ($counter = 0); ?>
                        </div>
                        <div class="row line-height-35">
                            <?php endif; ?>
                            <div class="col-md-12 rows">
                                <div class="row">
                                    <div class="col-md-1 text-right">
                                        <input type="checkbox" value="<?php echo e($value->id); ?>" class="chk check-description" data-value="<?php echo e($key+1); ?>" id="slideThree_<?php echo e($key+1); ?>" name="check<?php echo e($key+1); ?>" />
                                    </div>
                                    <div class="col-md-3">
                                        <label title="<?php echo e($value->description); ?>" for="slideThree_<?php echo e($key+1); ?>"><?php echo e($value->name); ?></label>
                                    </div>
                                    <div class="col-md-8">
                                        <input type="text" value="" class="form-control none description input<?php echo e($key+1); ?>" name="" id="" placeholder="<?php echo e($value->description); ?>" />
                                    </div>
                                </div>
                            </div>
                            <?php ($counter++); ?>
                            <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                        </div>
                    </div>
                </div>
                <div class="row line-height-35">

                </div>
                <br />
                <div class="row">
                    <div class="col-md-2 col-md-offset-5">
                        <button type="button" id="step3" class="btn btn-primary BtnRegAll btn-block">ثبت ویرایش</button>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

<script>
    /* Get the checkboxes values based on the class attached to each check box */
    $('#step3').click(function () {
        $(".box-loading-step").fadeIn("slow", function() {
            $(this).show();
        });
        var chkArray = [];
        var descriptionArray = [];
        /* look for all checkboes that have a class 'chk' attached to it and check if it was checked */
        $(".chk:checked").each(function() {
            var description = $(this).parent().parent().parent().parent().find('.description');
            chkArray.push($(this).val());
            descriptionArray.push( description.val());
        });
        /* we join the array separated by the comma */
        var selected;
        var description;
        selected = chkArray.join(',') ;
        description = descriptionArray.join(',') ;

        // alert(selected);
        /* check if there is selected checkboxes, by default the length is 1 as it contains one single comma */
        if(selected.length > 0){
            var formData = new FormData();
            formData.append('host_id', $('#host_id').val());
            formData.append('select_array', selected);
            formData.append('description_array', description);
            formData.append('edit_host',1);
            $.ajaxSetup({
                headers: {
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                }
            });
            $.ajax({
                url: '<?php echo e(route('StoreHostStep3')); ?>',
                type: 'post',
                data: formData,
                processData: false,
                contentType: false,
                success: function (data) {
                    if (data.Success == 0) {
                        $(".box-loading-step").fadeOut("slow", function () {
                            $('.box-loading-step').hide();
                        });
                        $('#myModal').modal('show');
                        $('#MsgErrorStep').text(data.Message);
                    } else if(data.Success == 1) {
                        $(".box-loading-step").fadeOut("slow", function () {
                            $('.box-loading-step').hide();
                        });
                        AlertToast('ویرایش اقامتگاه', data.Message, 'success');
                    }
                }
            });
        } else {
            $('#myModal').modal('show');
            $('#MsgErrorStep').text('حداقل انتخاب یکی از فیلد های زیر اجباری میباشد');
            $(".box-loading-step").fadeOut("slow", function() {
                $('.box-loading-step').hide();
            });
        }

    });


    /****************************************
     *         Edit By Step Address         *
     ***************************************/


    $('.BtnEditStep').click(function () {
        $(".box-loading-step").fadeIn("slow", function () {
            $(this).show();
        });
        var step = $(this).attr('data-value');
        var host_id = $('#host_id').val();
        $.ajaxSetup({
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            }
        });
        $.ajax({
            url: '<?php echo e(route('EditStep')); ?>',
            type: 'post',
            data: {
                host_id: host_id,
                step: step
            },
            success: function (data) {
                if (data.Success == 1) {
                    $(".box-loading-step").fadeOut("slow", function () {
                        $('.box-loading-step').hide();
                    });
                    $('#myModalEdit').modal('show');
                    $('#ExtraBoxEditStep').html(data.Message.original);
                }
            }
        });
    });
    $('span.information-step').click(function () {
        $('.box-information').toggleClass('show-information');
    });

    $('.check-description').click(function () {
        var key = $(this).attr('data-value');
        var input = $(this).parent().parent().parent().find('.input'+key);
        input.toggleClass('show');
    });
</script>

