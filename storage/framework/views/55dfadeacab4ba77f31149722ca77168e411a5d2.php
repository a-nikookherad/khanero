<link rel="stylesheet" href="<?php echo e(asset('backend/css/bootstrap-datepicker.min.css')); ?>"/>
<style>
    .progress .bar {
        width: 78%;
        background-color: #7cbebc;
    }

    .box-type-price span, .box-blocked-days span {
        padding-left: 10px;
        font-size: 16px;
        color: #3c763d;
    }

    .box-blocked-days p {
        margin-top: 10px;
    }

    .box-type-price {
        margin-bottom: 10px;
    }

    .box-type-price input, .box-type-price label {
        cursor: pointer;
    }

    .box-price:first-child {
        border-left: 1px solid #eee;
    }
    .box-none-1 {
        pointer-events: none;
        background: #f5f5f5;
    }
    .box-none-2 {
        pointer-events: none;
        background: #f5f5f5;
    }
    .box-none-3 {
        pointer-events: none;
        background: #f5f5f5;
    }

    #InputMinReserveDay {
        width: 20px;
    }
</style>

<div class="row text-center">
    <div class="col-md-12">
        <div class="row rows-address">
            <div class="col-md-2">
                <div class="poly">
                    <span>
                        <?php if($hostModel->step >= 0): ?>
                            <a href="<?php echo e(route('EditHost', ['id' => $hostModel->id, 'step' => 1])); ?>">مشخصات اقامتگاه</a>
                        <?php else: ?>
                            <a>مشخصات اقامتگاه</a>
                        <?php endif; ?>
                    </span>
                </div>
            </div>
            <div class="col-md-2">
                <div class="poly">
                    <span>
                        <?php if($hostModel->step > 1): ?>
                            <a href="<?php echo e(route('EditHost', ['id' => $hostModel->id, 'step' => 2])); ?>">موقعیت</a>
                        <?php else: ?>
                            <a>موقعیت</a>
                        <?php endif; ?>
                    </span>
                </div>
            </div>
            <div class="col-md-2">
                <div class="poly">
                    <span>
                        <?php if($hostModel->step > 2): ?>
                            <a href="<?php echo e(route('EditHost', ['id' => $hostModel->id, 'step' => 3])); ?>">امکانات</a>
                        <?php else: ?>
                            <a>امکانات</a>
                        <?php endif; ?>
                    </span>
                </div>
            </div>
            <div class="col-md-2">
                <div class="poly">
                    <span>
                        <?php if($hostModel->step > 3): ?>
                            <a href="<?php echo e(route('EditHost', ['id' => $hostModel->id, 'step' => 4])); ?>">تصاویر</a>
                        <?php else: ?>
                            <a>تصاویر</a>
                        <?php endif; ?>
                    </span>
                </div>
            </div>
            <div class="col-md-2">
                <div class="poly">
                    <span>
                        <?php if($hostModel->step > 4): ?>
                            <a href="<?php echo e(route('EditHost', ['id' => $hostModel->id, 'step' => 5])); ?>">قوانین صاحبخانه</a>
                        <?php else: ?>
                            <a>قوانین صاحبخانه</a>
                        <?php endif; ?>
                    </span>
                </div>
            </div>
            <div class="col-md-2">
                <div class="poly active">
                    <span>
                        <?php if($hostModel->step > 5): ?>
                            <a href="<?php echo e(route('EditHost', ['id' => $hostModel->id, 'step' => 6])); ?>">قیمت گذاری</a>
                        <?php else: ?>
                            <a>قیمت گذاری</a>
                        <?php endif; ?>
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
                <h3 class="panel-title">قیمت گذاری
                    <span class="information-step"><i class="fas fa-info-circle"></i></span>
                </h3>
            </div>
            <div class="panel-body">
                <div class="row">
                    <div class="col-md-12">
                        <div class="row">
                            <div class="col-md-12">
                                <div class="form-group">
                                    <label for="InputMaxDaysForShowCalendar">مهمانان تا چند روز بعد میتوانند رزرو کنند؟</label>
                                    <select class="form-control" name="" id="InputMaxDaysForShowCalendar">
                                        <option value="45" <?php if($hostModel->max_day_show_calendar == 45): ?> selected <?php endif; ?>>45 روز</option>
                                        <option value="90" <?php if($hostModel->max_day_show_calendar == 90): ?> selected <?php endif; ?>>سه ماه</option>
                                        <option value="180" <?php if($hostModel->max_day_show_calendar == 180): ?> selected <?php endif; ?>>شش ماه</option>
                                    </select>
                                </div>
                            </div>
                            <div class="col-md-12">
                                <div class="form-group">
                                    <label for="InputPriceFirstWeek">از شنبه تا سه شنبه</label>
                                    <input type="text" onkeyup="Seprator(this);" class="form-control" value="<?php echo e($hostModel->getPriceDay[0]->price / 1000); ?>"
                                           id="InputPriceFirstWeek" name=""
                                           placeholder=""/> <span class="text-danger" style="float: left">هزار تومان</span>
                                </div>
                            </div>
                            <div class="col-md-4">
                                <label for="InputPriceLastWeek_0">قیمت چهار شنبه</label>
                                <div class="form-group">
                                    <input type="text" onkeyup="Seprator(this);" class="form-control" value="<?php echo e($hostModel->getPriceDay[4]->price / 1000); ?>"
                                           id="InputPriceLastWeek_0" name=""
                                           placeholder=""/><span class="text-danger" style="float: left">هزار تومان</span>
                                </div>
                            </div>
                            <div class="col-md-4">
                                <label for="InputPriceLastWeek_1">قیمت پنج شنبه</label>
                                <div class="form-group">
                                    <input type="text" onkeyup="Seprator(this);" class="form-control" value="<?php echo e($hostModel->getPriceDay[5]->price / 1000); ?>"
                                           id="InputPriceLastWeek_1" name=""
                                           placeholder=""/><span class="text-danger" style="float: left">هزار تومان</span>
                                </div>
                            </div>
                            <div class="col-md-4">
                                <label for="InputPriceLastWeek_2">قیمت جمعه</label>
                                <div class="form-group">
                                    <input type="text" onkeyup="Seprator(this);" class="form-control" value="<?php echo e($hostModel->getPriceDay[6]->price / 1000); ?>"
                                           id="InputPriceLastWeek_2" name=""
                                           placeholder=""/><span class="text-danger" style="float: left">هزار تومان</span>
                                </div>
                            </div>
                            
                            
                            
                            
                            
                            
                            
                            
                            <div class="col-md-12">
                                <div class="form-group">
                                    <label for="InputOnePersonPrice">قیمت نفرات بیشتر از ظرفیت استاندارد</label>
                                    <input type="text" onkeyup="Seprator(this);" name="one_person_price" value="<?php echo e($hostModel->one_person_price / 1000); ?>"
                                           id="InputOnePersonPrice" class="form-control" placeholder="قیمت هر نفر اضافه"/><span class="text-danger" style="float: left">هزار تومان</span>
                                </div>
                            </div>
                            <h4>تخفیف ها</h4>
                            <hr />
                            <div class="col-md-3">
                                <input type="checkbox" id="InputCheck1"> تخفیف کوتاه مدت
                            </div>
                            <?php if(count($hostModel->getDiscount) > 0): ?>
                                <?php if(count($hostModel->getDiscount) == 1): ?>
                                    <?php 
                                        $number_days_1 = $hostModel->getDiscount[0]->number_days;
                                        $percent_1 = $hostModel->getDiscount[0]->percent;

                                        $number_days_2 = 0;
                                        $percent_2 = 0;
                                     ?>
                                <?php else: ?>
                                    <?php 
                                        $number_days_1 = $hostModel->getDiscount[0]->number_days;
                                        $percent_1 = $hostModel->getDiscount[0]->percent;

                                        $number_days_2 = $hostModel->getDiscount[1]->number_days;
                                        $percent_2 = $hostModel->getDiscount[1]->percent;
                                     ?>
                                <?php endif; ?>
                            <?php else: ?>
                                <?php 
                                    $number_days_1 = 0;
                                    $percent_1 = 0;

                                    $number_days_2 = 0;
                                    $percent_2 = 0;
                                 ?>
                            <?php endif; ?>
                            <div class="col-md-9 b-1 <?php if(count($hostModel->getDiscount) < 1): ?> box-none-1 <?php endif; ?>">
                                <div class="form-group">
                                    بیشتر از
                                    <select id="InputDayDiscount" style="width: 200px; display: inline-block;" class="form-control" name="number_days">
                                        <?php for($i = 1; $i < 30; $i++): ?>
                                            <option id="<?php echo e($i); ?>" <?php if($number_days_1 == $i): ?> selected <?php endif; ?>><?php echo e($i); ?></option>
                                        <?php endfor; ?>
                                    </select>
                                    روز
                                    <input type="number" style="width: 60px;display: inline-block;" id="InputNumberPercent" value="<?php echo e($percent_1); ?>" name="percent" maxlength="2" class="text-center form-control" placeholder="00" />
                                    درصد تخفیف
                                </div>
                            </div>
                            <div class="col-md-3">
                                <input type="checkbox" id="InputCheck2"> تخفیف بلند مدت
                            </div>
                            <div class="col-md-9 b-2 <?php if(count($hostModel->getDiscount) < 2): ?> box-none-2 <?php endif; ?>">
                                <div class="form-group">
                                    بیشتر از
                                    <select id="InputDayDiscount2" style="width: 200px; display: inline-block;" class="form-control" name="number_days_2">
                                        <?php for($i = 1; $i < 30; $i++): ?>
                                            <option id="<?php echo e($i); ?>" <?php if($number_days_2 == $i): ?> selected <?php endif; ?>><?php echo e($i); ?></option>
                                        <?php endfor; ?>
                                    </select>                                    روز
                                    <input type="number" style="width: 60px;display: inline-block;" id="InputNumberPercent2" value="<?php echo e($percent_2); ?>" name="percent_2" maxlength="2" class="text-center form-control" placeholder="00" />
                                    درصد تخفیف
                                </div>
                            </div>
                            <div class="col-md-3">
                                <input type="checkbox" id="InputCheck3"> تخفیف بازه زمانی خاص
                            </div>
                            <div class="col-md-9 b-3 box-none-3">
                                <div class="form-group">
                                    تخفیف بازه زمانی خاص از
                                    <input readonly type="text" style="width: 100px;display: inline-block;" id="InputDayTurnDiscountFrom" class="text-center form-control" placeholder="از تاریخ" />
                                    تا
                                    <input readonly type="text" style="width: 100px;display: inline-block;" id="InputDayTurnDiscountTo" class="text-center form-control" placeholder="تا تاریخ" />
                                    تخفیف
                                    <input type="number" style="width: 60px;display: inline-block;" id="InputTurnDiscount" maxlength="2" class="text-center form-control" placeholder="00" />
                                    درصد
                                </div>
                            </div>
                        </div>
                    </div>
                    
                    
                    
                    
                    
                    
                    
                    
                    
                    
                </div>
                <hr/>
                <div class="row">
                    <div class="col-md-2 col-md-offset-5">
                        <button type="button" id="step6" class="btn btn-primary BtnRegAll btn-block">ثبت ویرایش</button>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

<script src="<?php echo e(asset('backend/js/bootstrap-datepicker.min.js')); ?>"></script>
<script src="<?php echo e(asset('backend/js/bootstrap-datepicker.fa.min.js')); ?>"></script>
<script type="text/javascript" src="<?php echo e(asset('backend/js/number.js')); ?>"></script>
<script>

    $('#InputCheck1').click(function() {
        if($('input[id="InputCheck1"]:checked').length == 1) {
            $('.b-1').removeClass('box-none-1');
        } else {
            $('.b-1').addClass('box-none-1');
        }
    });

    $('#InputCheck2').click(function() {
        if($('input[id="InputCheck2"]:checked').length == 1) {
            $('.b-2').removeClass('box-none-2');
        } else {
            $('.b-2').addClass('box-none-2');
        }
    });

    $('#InputCheck3').click(function() {
        if($('input[id="InputCheck3"]:checked').length == 1) {
            $('.b-3').removeClass('box-none-3');
        } else {
            $('.b-3').addClass('box-none-3');
        }
    });

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


    $('.date-msg, .date-msg-special').click(function () {
        $(this).text('');
    });

    var array = [];

    $("#InputDateBlocked").datepicker({
        minDate: 0,
        changeMonth: true,
        changeYear: true,
        isRTL: true,
        dateFormat: "yy/mm/dd",
        EnableTimePicker: true,
        beforeShowDay: function (date) {
            var string = jQuery.datepicker.formatDate('yy-mm-dd', date);
            return [array.indexOf(string) == -1]
        }
    });


    $("#InputDayTurnDiscountFrom").datepicker({
        minDate: 0,
        changeMonth: true,
        changeYear: true,
        isRTL: true,
        dateFormat: "yy/mm/dd",
        EnableTimePicker: true,
    });


    $("#InputDayTurnDiscountTo").datepicker({
        minDate: 0,
        changeMonth: true,
        changeYear: true,
        isRTL: true,
        dateFormat: "yy/mm/dd",
        EnableTimePicker: true,
    });


    $('#buttonBlocked').click(function () {
        var host_id = $('#host_id').val();
        var date = $("#InputDateBlocked").val();
        if (date) {
            $.ajaxSetup({
                headers: {
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                }
            });
            $.ajax({
                url: '<?php echo e(route('BlockedDays')); ?>',
                type: 'post',
                data: {
                    host_id: host_id,
                    date: date,
                },
                success: function (data) {

                    if (data.Success == 1) {
                        $('#ExtraBlockDay').empty();
                        var h = '<input type="text" readonly style="cursor: pointer;" id="InputDateBlocked"\n' +
                            '        class="form-control" placeholder="تاریخ مورد نظر را وارد کنید">';
                        ;

                        $('#ExtraBlockDay').html(h);
                        $("#InputDateBlocked").datepicker({
                            minDate: 0,
                            changeMonth: true,
                            changeYear: true,
                            isRTL: true,
                            dateFormat: "yy/mm/dd",
                            EnableTimePicker: true,
                            beforeShowDay: function (date) {
                                var string = jQuery.datepicker.formatDate('yy-mm-dd', date);
                                return [data.Date.indexOf(string) == -1]
                            }
                        });
                        $('.date-msg').removeClass('text-danger');
                        $('.date-msg').addClass('text-success');
                        $('.date-msg').text(data.Message);
                    } else {
                        $('.date-msg').removeClass('text-success');
                        $('.date-msg').addClass('text-danger');
                        $('.date-msg').text(data.Message);
                    }
                }
            });
        }
    });


    $('#buttonSpecial').click(function () {
        var host_id = $('#host_id').val();
        var date = $("#InputDateSpecial").val();
        var price = $("#InputPriceSpecial").val();
        if (date) {
            $.ajaxSetup({
                headers: {
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                }
            });
            $.ajax({
                url: '<?php echo e(route('SpecialDays')); ?>',
                type: 'post',
                data: {
                    host_id: host_id,
                    date: date,
                    price: price
                },
                success: function (data) {
                    console.log(data);
                    if (data.Success == 1) {
                        $('.date-msg-special').removeClass('text-danger');
                        $('.date-msg-special').addClass('text-success');
                        $('.date-msg-special').text(data.Message);
                    } else {
                        $('.date-msg-special').removeClass('text-success');
                        $('.date-msg-special').addClass('text-danger');
                        $('.date-msg-special').text(data.Message);
                    }
                }
            });
        }
    });


    $('.radio-type').click(function () {
        var loading = '<img style="width:45px; margin-right:50px;" src="<?php echo e(asset('backend/img/img_loading/orange_circles.gif')); ?>" />';
        $('#ExtraPriceDays').html(loading);
        var radioValue = $("input[name='days']:checked").val();
        if (radioValue) {
            $.ajaxSetup({
                headers: {
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                }
            });
            $.ajax({
                url: '<?php echo e(route('PriceSetType')); ?>',
                type: 'post',
                data: {type: radioValue},
                success: function (data) {
                    console.log(data);
                    $('#ExtraPriceDays').html(data);
                }
            });
        }
    });


    $('#step6').click(function () {
        $(".box-loading-step").fadeIn("slow", function () {
            $(this).show();
        });
        if($('#InputPriceFirstWeek').val() != '' && $('#InputPriceLastWeek_1').val() != '' && $('#InputPriceLastWeek_2').val() != '') {
            var formData = new FormData();
            formData.append('host_id', $('#host_id').val());
            formData.append('max_day_show_calendar', $('#InputMaxDaysForShowCalendar').val());

            formData.append('price_saturday', $('#InputPriceFirstWeek').val());
            formData.append('price_sunday', $('#InputPriceFirstWeek').val());
            formData.append('price_monday', $('#InputPriceFirstWeek').val());
            formData.append('price_tuesday', $('#InputPriceFirstWeek').val());
            formData.append('price_wednesday', $('#InputPriceLastWeek_0').val());
            formData.append('price_thursday', $('#InputPriceLastWeek_1').val());
            formData.append('price_friday', $('#InputPriceLastWeek_2').val());

            formData.append('price_special_day', 0); // روز های ویژه
            // formData.append('price_special_day', $('#InputPriceSpecialDay').val()); // روز های ویژه
            formData.append('price_one_person', $('#InputOnePersonPrice').val()); // قیمت نفر اضافه
            formData.append('day_discount', $('#InputDayDiscount').val()); // تعداد روزهای تخفیف دار
            formData.append('percent_discount', $('#InputNumberPercent').val()); // درصد تخفیف

            formData.append('day_discount_2', $('#InputDayDiscount2').val()); // تعداد روزهای تخفیف دار بلند مدت
            formData.append('percent_discount_2', $('#InputNumberPercent2').val()); // درصد تخفیف بلند مدت


            formData.append('day_turn_discount_from', $('#InputDayTurnDiscountFrom').val()); // تخفیف بازه زمانی
            formData.append('day_turn_discount_to', $('#InputDayTurnDiscountTo').val()); // تخفیف بازه زمانی
            formData.append('turn_discount', $('#InputTurnDiscount').val()); // تخفیف بازه زمانی

            formData.append('edit_host',1);
            $.ajaxSetup({
                headers: {
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                }
            });
            $.ajax({
                url: '<?php echo e(route('StoreHostStep6')); ?>',
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
            $(".box-loading-step").fadeOut("slow", function () {
                $('.box-loading-step').hide();
            });
            $('#myModal').modal('show');
            $('#MsgErrorStep').text('وارد کردن قیمت روزهای هفته اجباری می باشد .');
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

    // store discount ajax
    $('#BtnCreateDiscount').click(function () {
        if($('#InputDayDiscount').val() == '' || $('#InputNumberPercent').val() == '') {
            $.Toast("<p>تخفیف</p>", "<p>پر کردن فیلد ها اجباری است .</p>", "warning", {
                has_icon: true,
                has_close_btn: true,
                stack: true,
                fullscreen: false,
                timeout: 4000,
                sticky: false,
                has_progress: true,
                rtl: true,
            });
            return  false;
        }
        var loading = '<img style="width:45px; margin-right:50px;" src="<?php echo e(asset('backend/img/img_loading/orange_circles.gif')); ?>" />';
        $('#ExtraDiscount').html(loading);
        var host_id = $('#host_id').val();
        $.ajaxSetup({
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            }
        });
        $.ajax({
            url: '<?php echo e(route('StoreDiscountAjax')); ?>',
            type: 'post',
            data: {
                host_id: host_id,
                number_days: $('#InputDayDiscount').val(),
                percent: $('#InputNumberPercent').val(),
            },
            success: function (data) {
                if (data.Success == 1) {
                    $('#ExtraDiscount').html(data.Content.original);
                    $.Toast("<p>تخفیف</p>", "<p>" + data.Message + " .</p>", "success", {
                        has_icon: true,
                        has_close_btn: true,
                        stack: true,
                        fullscreen: false,
                        timeout: 4000,
                        sticky: false,
                        has_progress: true,
                        rtl: true,
                    });
                } else {
                    $('#ExtraDiscount').html('');
                    $.Toast("<p>تخفیف</p>", "<p>" + data.Message + " .</p>", "warning", {
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
            }
        });
    });



</script>

