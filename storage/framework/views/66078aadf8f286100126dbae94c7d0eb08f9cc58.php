
<?php ($buildingTypeModel = App\Modules\Possibilities\Controllers\PossibilitiesController::GetBuildingType()); ?>
<?php ($homeTypeModel = App\Modules\Possibilities\Controllers\PossibilitiesController::GetHomeType()); ?>

<style>
    .box-img img{
        width: 200px;
        height: 80px;
        margin-bottom: 10px;
    }
    <?php if($hostModel->home_type_id == 1): ?>
    #ExtraBuildingType {
        display: none;
    }
    <?php endif; ?>
</style>
<div class="modal-body">
    <div class="row">
        <?php $__currentLoopData = $galleryModel; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $key => $value): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
            <div class="col-md-2 box-img box-img<?php echo e($key+1); ?>">
                <img src="<?php echo e(asset('Uploaded/Gallery/Img').'/'.$value->img); ?>" class="img-responsive" />
                <p>
                    <label class="btn btn-block" onclick="ajaxDeleteImg('<?php echo e($value->id); ?>','<?php echo e($key+1); ?>');">
                        <i class="text-danger fa fa-trash-o"></i>
                    </label>
                </p>
            </div>
        <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
    </div>
    <div class="row">
        <div class="col-md-12">
            <p class="text-msg-delete-img text-danger">
            </p>
        </div>
    </div>
    <div class="row">
        <div class="col-md-3">
            <div class="form-group">
                <label for="SelectHomeType">نوع خانه</label><span style="font-size: 18px;" class="text-danger">*</span>
                <br />
                <select class="form-control" id="SelectHomeType" name="home_type">
                    <option hidden value="">انتخاب کنید</option>
                    <?php $__currentLoopData = $homeTypeModel; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $key => $value): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                        <option value="<?php echo e($value->id); ?>" <?php if($value->id == $hostModel->home_type_id): ?> selected <?php endif; ?>><?php echo e($value->name); ?></option>
                    <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                </select>
            </div>
            <?php if($errors->has('home_type')): ?>
                <span style="color:red;"><?php echo e($errors->first('home_type')); ?></span>
            <?php endif; ?>
        </div>
        <div class="col-md-3">
            <div class="form-group">
                <label for="SelectBuildingType">نوع ساختمان</label><span style="font-size: 18px;" class="text-danger">*</span>
                <br />
                <select class="form-control" id="SelectBuildingType" name="building_type">
                    <option hidden value="">انتخاب کنید</option>
                    <?php $__currentLoopData = $buildingTypeModel; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $key => $value): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                        <option value="<?php echo e($value->id); ?>" <?php if($value->id == $hostModel->building_type_id): ?> selected <?php endif; ?>><?php echo e($value->name); ?></option>
                    <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                </select>
            </div>
            <?php if($errors->has('building_type')): ?>
                <span style="color:red;"><?php echo e($errors->first('building_type')); ?></span>
            <?php endif; ?>
        </div>
        <div class="col-md-2">
            <div class="form-group">
                <label for="InputMeter">متراژ زیر بنا</label><span style="font-size: 18px;" class="text-danger">*</span>
                <br />
                <input type="number" value="<?php echo e($hostModel->meter); ?>" name="meter" class="form-control" id="InputMeter" placeholder="متراژ را وارد کنید" />
            </div>
            <?php if($errors->has('meter')): ?>
                <span style="color:red;"><?php echo e($errors->first('meter')); ?></span>
            <?php endif; ?>
        </div>
        <div class="col-md-2">
            <div class="form-group">
                <label for="InputMeterTotal">متراژ کل</label><span style="font-size: 18px;" class="text-danger">*</span>
                <input type="number" name="meter_total" value="<?php echo e($hostModel->meter_total); ?>" class="form-control" id="InputMeterTotal" placeholder="متراژ کل بنا را وارد کنید" />
            </div>
            <?php if($errors->has('meter_total')): ?>
                <span style="color:red;"><?php echo e($errors->first('meter_total')); ?></span>
            <?php endif; ?>
        </div>
        <div class="col-md-4">
            <div class="form-group">
                <label for="">&nbsp;</label>
                <br />
                آیا حیاط به صورت مشترک است؟
                <input type="radio" value="0" name="shared_yard" class="" <?php if($hostModel->shared_yard == 0): ?> checked <?php endif; ?> />خیر
                <input type="radio" value="1" name="shared_yard" class="" <?php if($hostModel->shared_yard == 1): ?> checked <?php endif; ?> />بله
            </div>
            <?php if($errors->has('meter')): ?>
                <span style="color:red;"><?php echo e($errors->first('meter')); ?></span>
            <?php endif; ?>
        </div>
    </div>
    <div class="row">
        <div id="ExtraBuildingType">
            <hr />
            <div class="col-md-5">
                <div class="alert alert-warning">
                    <p>لطفاً کسانی که در این خانه زندگی می کنند را  برای راحتی و اطمینان خاطر مهمان بگویید .</p>
                </div>
            </div>
            <div class="col-md-7">
                <div class="form-group">
                    <div class="col-md-4">
                        <div class="row">
                            مرد
                            <label class="BtnAddSub BtnAdd" id="">+</label>

                            <input type="text" value="<?php if($hostModel->getRoomCommon != null): ?> <?php echo e($hostModel->getRoomCommon->count_man); ?> <?php else: ?> 0 <?php endif; ?>" name="count_man" id="InputMan" class="input-text" readonly />

                            <label class="BtnAddSub BtnSub" id="">-</label>
                        </div>
                    </div>
                    <div class="col-md-4">
                        <div class="row">
                            زن
                            <label class="BtnAddSub BtnAdd" id="">+</label>

                            <input type="text" value="<?php if($hostModel->getRoomCommon != null): ?> <?php echo e($hostModel->getRoomCommon->count_woman); ?> <?php else: ?> 0 <?php endif; ?>" name="count_woman" id="InputWoman" class="input-text" readonly />

                            <label class="BtnAddSub BtnSub" id="">-</label>
                        </div>
                    </div>
                    <div class="col-md-4">
                        <div class="row">
                            بچه
                            <label class="BtnAddSub BtnAdd" id="">+</label>

                            <input type="text" value="<?php if($hostModel->getRoomCommon != null): ?> <?php echo e($hostModel->getRoomCommon->count_child); ?> <?php else: ?> 0 <?php endif; ?>" name="count_child" id="InputChild" class="input-text" readonly />

                            <label class="BtnAddSub BtnSub" id="">-</label>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <br />
</div>
<div class="row">
    <div class="col-md-3 col-md-offset-3">
        <button type="button" id="BtnEdit" class="btn btn-default  btn-block">ثبت ویرایش</button>
    </div>
    <div class="col-md-3">
        <button type="button" id="BtnCancelUpdate" class="btn btn-default btn-block" data-dismiss="modal">انصراف</button>
    </div>
</div>
<br />

<script>

    $('#BtnEdit').click(function () {
        $(".box-loading-step").fadeIn("slow", function() {
            $(this).show();
        });
        var formData = new FormData();
        formData.append('host_id', <?php echo e($hostModel->id); ?>);
        formData.append('step', 1);
        formData.append('home_type_id', $('#SelectHomeType option:selected').val());
        formData.append('building_type_id', $('#SelectBuildingType option:selected').val());
        formData.append('meter', $('#InputMeter').val());
        formData.append('meter_total', $('#InputMeterTotal').val());
        formData.append('shared_yard', $('input[name=shared_yard]:checked').val());
        formData.append('count_man', $('#InputMan').val());
        formData.append('count_woman', $('#InputWoman').val());
        formData.append('count_child', $('#InputChild').val());
        // for (var pair of formData.entries()) {
        //     console.log(pair[0]+ ', ' + pair[1]);
        // }
        $.ajaxSetup({
            headers : {
                'X-CSRF-TOKEN' : $('meta[name="csrf-token"]').attr('content')
            }
        });
        $.ajax({
            url: '<?php echo e(route('UpdateHostStep')); ?>',
            type: 'post',
            data: formData,
            processData: false,
            contentType: false,
            success: function (data) {
                console.log(data);
                if(data.Success == 0)
                {
                    $(".box-loading-step").fadeOut("slow", function() {
                        $('.box-loading-step').hide();
                    });
                    $.Toast("<p>ویرایش</p>", "<p>"+data.Message+" .</p>", "warning", {
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
                else if(data.Success == 1){
                    $(".box-loading-step").fadeOut("slow", function() {
                        $('.box-loading-step').hide();
                    });
                    $.Toast("<p>ویرایش</p>", "<p>ثبت ویرایش موفقیت آمیز بود .</p>", "success", {
                        has_icon: true,
                        has_close_btn: true,
                        stack: true,
                        fullscreen: false,
                        timeout: 4000,
                        sticky: false,
                        has_progress: true,
                        rtl: true,
                    });
                    $('#BtnCancelUpdate').click();
                }
            }
        });
    });


    $('#BtnSubCountRoom').click(function () {
        var textbox = $(this).parent().parent().find('.input-text');
        var value  = textbox[0].defaultValue;
        if(value == 0)
        {
            value = 1;
        }
        textbox[0].defaultValue = parseFloat(value)-1;
        var element = $('.boxRoom .box:last-child');
        element.remove();
    });

    $('.BtnAdd').click(function() {
        var textbox = $(this).parent().parent().find('.input-text');
        var value  = textbox[0].defaultValue;
        textbox[0].defaultValue = parseFloat(value)+1;
        return false;
    });
    $('.BtnSub').click(function() {
        var textbox = $(this).parent().parent().find('.input-text');
        console.log(textbox[0].id);
        if(textbox[0].id == 'InputGuest') {
            var value  = textbox[0].defaultValue;
            if(value == 1)
            {
                value = 2;
            }
            textbox[0].defaultValue = parseFloat(value)-1;
            return false;
        }
        var value  = textbox[0].defaultValue;
        if(value == 0)
        {
            value = 1;
        }
        textbox[0].defaultValue = parseFloat(value)-1;
        return false;
    });


    function ajaxDeleteImg(id,idInput) {
        var host_id = <?php echo e($hostModel->id); ?>

        var formData = new FormData();
        formData.append('host_id', host_id);
        formData.append('img_id', id);
        $.ajaxSetup({
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            }
        });
        $.ajax({
            url:"<?php echo e(route('AjaxDeleteImg')); ?>",
            method:"post",
            data: formData,
            processData: false,
            contentType: false,
        }).done(function(data){
            console.log(data);
            if(data == 'deleted') {
                $('.box-img'+idInput).remove();
            }
            else if(data == 'limited') {
                $('.text-msg-delete-img').text('گالری نمیتواند خالی باشد .');
            }
        });
    }

    $("body").delegate("#SelectHomeType", "change", function (e) {
        var Value = $(this).val();
        if (Value == 2 || Value == 3) {
            $('#ExtraBuildingType').css('display', 'block');
        }
        else {
            $('#ExtraBuildingType').css('display', 'none');
            $('#InputMan').val(0);
            $('#InputWoman').val(0);
            $('#InputChild').val(0);
        }
    });

</script>
