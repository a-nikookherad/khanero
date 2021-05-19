<link rel="stylesheet" href="<?php echo e(asset('backend/css/bootstrap-datepicker.min.css')); ?>"/>

    <div class="panel-body">
        <div id="row">
            <div class="col-md-12">
                <h4 class="text-success">قیمت گذاری روزهای هفته </h4>
                <br />
                <div class="row">
                    <?php $__currentLoopData = $weekModel; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $key => $value): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                        <div class="col-md-3">
                            <div class="form-group">
                                <label for="Input<?php echo e($value->e_day); ?>day"><?php echo e($value->day); ?></label>
                                <?php $__currentLoopData = $priceDayModel; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $item => $index): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                    <?php if($index->week_id == $value->id): ?>
                                        <input type="number" name="<?php echo e($value->e_day); ?>" id="Input<?php echo e($value->e_day); ?>" class="form-control" value="<?php echo e($index->price); ?>" placeholder="0" />
                                    <?php endif; ?>
                                <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                            </div>
                        </div>
                    <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                </div>
            </div>
            <div class="col-md-12">
                <div class="row">
                    <div class="col-md-3">
                        <div class="form-group">
                            <label for="InputPriceSpecialDay">قیمت روزهای خاص</label>
                            <input type="number" class="form-control" id="InputPriceSpecialDay" value="<?php echo e($hostModel->special_price); ?>" name=""
                                   placeholder="قیمت روزهای خاص تقویم"/>
                        </div>
                    </div>
                </div>
            </div>
            <hr />
        </div>
        <hr/>

        
            
                
                    
                
            
        
        <hr />
        <div class="row">
            <div class="form-group">
                <div class="col-md-4">
                    <h4 class="text-success">مهمانان از چند روز قبل میتوانند رزرو کنند ؟</h4>
                </div>
                <div class="col-md-8">
                    <h6>
                        <label class="BtnAddSub BtnAdd" id="">+</label>

                        <input type="text" value="<?php echo e($hostModel->closest_time_reserve); ?>" name="closest_time_reserve" style="text-align: center;"
                               id="InputMinReserveDay" class="input-text"/>

                        <label class="BtnAddSub BtnSub" id="BtnSubCountRoom">-</label>
                    </h6>
                </div>
                <div class="col-md-12">
                    <p>
                        میزبانان هنگام ثبت اقامتگاه خود می توانند انتخاب کنند که مهمانان از چند روز قبل می توانند رزرو کنند
                        (این برای میزبانانی است که حداقل از چند روز قبل باید مطلع از امدن مهمان باشند تا اقامتگاه را اماده کنند)(مثال: اگر 2 روز را انتخاب کنند یعنی مهمان امشب و فردا نمی تواند اقامتگاه شما را رزرو کند)
                        - حال اگر میزبان 0 روز را انتخاب کند یعنی برای همین امشب هم اقامتگاه خود را اجاره میدهد یعنی رزرو برای همین امشب فعال شده است و در سکشن صفحه اصلی می اید که این یک امتیاز ویژه برای میزبانان هست.
                        - در صورت انتخاب 0 روز ما از میزبان می خواهیم که برای رزرو های از 10 تا 12 شب تخفیف بدهند برای همین اگر شما 10 شب به بعد اقامتگا هایی را که در سکشن برای همین امشب هستند بروید میتوانید امشب را با تخفیف رزرو کنید

                    </p>
                    <h4 class="text-danger" id="MsgSuccessReserve">
                        <?php if($hostModel->closest_time_reserve == 0): ?> رزرو برای همین امشب فعال شد <?php endif; ?>
                    </h4>
                    <p class="" style="<?php if($hostModel->closest_time_reserve == 0): ?> display: block; <?php else: ?> display: none; <?php endif; ?>" id="MsgPercentReserve">
                        صورتی که ساعت 10 تا 12 شب اجاره رفت <input type="number" style="width: 40px" value="20" id="PercentReserve"/> درصد کمتر حساب شود
                    </p>
                </div>
            </div>
        </div>
    </div>

    <div class="row">
        <div class="col-md-3 col-md-offset-3">
            <button type="button" id="BtnEdit" class="btn btn-default  btn-block">ثبت ویرایش</button>
        </div>
        <div class="col-md-3">
            <button type="button" id="BtnCancelUpdate" class="btn btn-default btn-block" data-dismiss="modal">انصراف
            </button>
        </div>
    </div>
    <br/>

<script src="<?php echo e(asset('backend/js/bootstrap-datepicker.min.js')); ?>"></script>
<script src="<?php echo e(asset('backend/js/bootstrap-datepicker.fa.min.js')); ?>"></script>
<script>


    $('.BtnAdd').click(function () {
        var textboxMinReserve = $(this).parent().parent().find('#InputMinReserveDay');
        var valueMinReserve = textboxMinReserve[0].defaultValue;
        valueMinReserve = parseFloat(valueMinReserve) + 1;
        // console.log(valueMinReserve);
        if (valueMinReserve == 0) {
            $('#MsgSuccessReserve').text('رزرو برای همین امشب فعال شد');
            $('#MsgPercentReserve').css('display', 'block');
        } else {
            $('#MsgSuccessReserve').text('');
            $('#MsgPercentReserve').css('display', 'none');
        }
        var textbox = $(this).parent().parent().find('.input-text');
        var value = textbox[0].defaultValue;
        textbox[0].defaultValue = parseFloat(value) + 1;
        return false;
    });

    $('.BtnSub').click(function () {
        var textboxMinReserve = $(this).parent().parent().find('#InputMinReserveDay');
        var valueMinReserve = textboxMinReserve[0].defaultValue;
        valueMinReserve = parseFloat(valueMinReserve) - 1;
        if (valueMinReserve == 0) {
            $('#MsgSuccessReserve').text('رزرو برای همین امشب فعال شد');
            $('#MsgPercentReserve').css('display', 'block');
        } else {
            $('#MsgSuccessReserve').text('');
            $('#MsgPercentReserve').css('display', 'none');
        }
        var textbox = $(this).parent().parent().find('.input-text');
        // console.log(textbox[0].id);
        var value = textbox[0].defaultValue;
        if (value == 0) {
            value = 1;
        }
        textbox[0].defaultValue = parseFloat(value) - 1;
        return false;
    });


    // $('.BtnAdd').click(function() {
    //     var textbox = $(this).parent().parent().find('.input-text');
    //     var value  = textbox[0].defaultValue;
    //     textbox[0].defaultValue = parseFloat(value)+1;
    //     return false;
    // });

    // $('.BtnSub').click(function() {
    //     var textbox = $(this).parent().parent().find('.input-text');
    //     // console.log(textbox[0].id);
    //     var value  = textbox[0].defaultValue;
    //     if(value == 0)
    //     {
    //         value = 1;
    //     }
    //     textbox[0].defaultValue = parseFloat(value)-1;
    //     return false;
    // });


    $('#BtnEdit').click(function () {
        $(".box-loading-step").fadeIn("slow", function () {
            $(this).show();
        });

        var formData = new FormData();
        formData.append('host_id', <?php echo e($hostModel->id); ?>);
        formData.append('step', 6);
        formData.append('price_saturday', $('#InputSaturday').val());
        formData.append('price_sunday', $('#InputSunday').val());
        formData.append('price_monday', $('#InputMonday').val());
        formData.append('price_tuesday', $('#InputTuesday').val());
        formData.append('price_wednesday', $('#InputWednesday').val());
        formData.append('price_thursday', $('#InputThursday').val());
        formData.append('price_friday', $('#InputFriday').val());
        formData.append('price_special_day', $('#InputPriceSpecialDay').val());
        formData.append('closest_time_reserve', $('#InputMinReserveDay').val());
        formData.append('percent_instantaneous', $('#PercentReserve').val());
        $.ajaxSetup({
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
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

</script>

