<link rel="stylesheet" href="<?php echo e(asset('backend/css/bootstrap-datepicker.min.css')); ?>"/>

<div class="Titl-step-S rows-address row">
    <div class="col-md-2 each-step register"><div class="Numbr-Step">1</div><span class="after-finish"><i class="far fa-check"></i></span><div class="poly"><a href="<?php echo e(route('CreateHostStep', ['id' => $hostModel->id, 'step' => 0])); ?>">مشخصات اقامتگاه</a></div></div>
    <div class="col-md-2 each-step register"><div class="Numbr-Step">2</div><span class="after-finish"><i class="far fa-check"></i></span><div class="poly"><a href="<?php echo e(route('CreateHostStep', ['id' => $hostModel->id, 'step' => 1])); ?>">موقعیت</a></div></div>
    <div class="col-md-2 each-step register"><div class="Numbr-Step">3</div><span class="after-finish"><i class="far fa-check"></i></span><div class="poly"><a href="<?php echo e(route('CreateHostStep', ['id' => $hostModel->id, 'step' => 2])); ?>">امکانات و خدمات</a></div></div>
    <div class="col-md-2 each-step register"><div class="Numbr-Step">4</div><span class="after-finish"><i class="far fa-check"></i></span><div class="poly"><a href="<?php echo e(route('CreateHostStep', ['id' => $hostModel->id, 'step' => 3])); ?>">تصاویر</a></div></div>
    <div class="col-md-2 each-step register"><div class="Numbr-Step">5</div><span class="after-finish"><i class="far fa-check"></i></span><div class="poly"><a href="<?php echo e(route('CreateHostStep', ['id' => $hostModel->id, 'step' => 4])); ?>">قوانین صاحبخانه</a></div></div>
    <div class="col-md-2 each-step active"><div class="Numbr-Step">6</div><div class="poly">قیمت گذاری</div></div>
</div>
<div class="Body-step-S">
    <div class="panel-heading"><h3 class="panel-title">قیمت گذاری<span class="information-step"><i class="fas fa-info-circle"></i></span></h3></div>
    <div class="panel-body row">
        <div class="each-item col-md-12">
            <span class="neccry-star">*</span>
            <span class="describ-extra">
                از قیمت هایی که مشخص میکنید 10% به عنوان کارمزد سایت کسر می شود , همچنین قیمت هر نفر اضافه به تعداد بیشتر از ظرفیت استاندارد افزوده میگردد.
            </span>
        </div>
        <div class="each-item col-md-4">
            <label class="title-S" for="InputMaxDaysForShowCalendar">مهمانان تا چند روز بعد میتوانند رزرو کنند؟</label>
            <select class="each-Qt form-control" name="" id="InputMaxDaysForShowCalendar">
                <option value="45">45 روز</option>
                <option value="90">سه ماه</option>
                <option value="180">شش ماه</option>
            </select>
        </div>
        <div class="each-item col-md-4">
            <label class="title-S" for="InputPriceFirstWeek">از شنبه تا سه شنبه</label>
            <input type="text" onkeyup="Seprator(this);" class="each-Qt form-control" id="InputPriceFirstWeek" name="" placeholder=""/> <span class="text-danger" style="float: left">هزار تومان</span>
        </div>
        <div class="each-item col-md-4">
            <label class="title-S" for="InputPriceLastWeek_0">قیمت چهار شنبه</label>
            <input type="text" onkeyup="Seprator(this);" class="each-Qt form-control" id="InputPriceLastWeek_0" name="" placeholder=""/><span class="text-danger" style="float: left">هزار تومان</span>
        </div>
        <div class="each-item col-md-4">
            <label class="title-S" for="InputPriceLastWeek_1">قیمت پنج شنبه</label>
            <input type="text" onkeyup="Seprator(this);" class="each-Qt form-control" id="InputPriceLastWeek_1" name="" placeholder=""/><span class="text-danger" style="float: left">هزار تومان</span>
        </div>
        <div class="each-item col-md-4">
            <label class="title-S" for="InputPriceLastWeek_2">قیمت جمعه</label>
            <input type="text" onkeyup="Seprator(this);" class="each-Qt form-control" id="InputPriceLastWeek_2" name="" placeholder=""/><span class="text-danger" style="float: left">هزار تومان</span>
        </div>






        <div class="each-item col-md-4">
            <label class="title-S" for="InputOnePersonPrice">قیمت نفرات بیشتر از ظرفیت استاندارد</label>
            <input type="text" onkeyup="Seprator(this);" name="one_person_price" id="InputOnePersonPrice" class="each-Qt form-control" placeholder="قیمت هر نفر اضافه"/><span class="text-danger" style="float: left">هزار تومان</span>
        </div>
        <hr />
        <h4 class="some-title col-md-12">تخفیف ها</h4>
        <div class="each-item col-md-12">
            <span class="neccry-star">*</span>
            <span class="describ-extra">
            شما میتوانید برای مدت بیشتر از تعداد روز تخفیف در نظر بگیرید
            </span>
        </div>
        <div class="col-md-3 each-option-1">
            <input type="checkbox" id="InputCheck1">
            <span class="checkmark"></span>
            <label class="title-S m-0">تخفیف کوتاه مدت</label>
        </div>
        <div class="col-md-9 b-1 box-none-1">
                                <div class="form-group">
                                    بیشتر از
                                    <select id="InputDayDiscount" style="width: 200px; display: inline-block;margin:0 3px;" class="each-Qt form-control" name="number_days">
                                        <?php for($i = 1; $i < 30; $i++): ?>
                                            <option id="<?php echo e($i); ?>"><?php echo e($i); ?></option>
                                        <?php endfor; ?>
                                    </select>
                                    روز
                                    <input type="number" style="width: 60px;display: inline-block;margin:0 3px;" id="InputNumberPercent" value="<?php echo e(old('percent')); ?>" name="percent" maxlength="2" class="each-Qt text-center form-control" placeholder="00" />
                                    درصد تخفیف
                                </div>
                            </div>
        <div class="col-md-3 each-option-1">
            <input type="checkbox" id="InputCheck2">
            <span class="checkmark"></span>
            <label class="title-S m-0"> تخفیف بلند مدت</label>
        </div>
        <div class="col-md-9 b-2 box-none-2">
                                <div class="form-group">
                                    بیشتر از
                                    <select id="InputDayDiscount2" style="width: 200px; display: inline-block;margin:0 3px;" class="each-Qt form-control" name="number_days_2">
                                        <?php for($i = 1; $i < 30; $i++): ?>
                                            <option id="<?php echo e($i); ?>"><?php echo e($i); ?></option>
                                        <?php endfor; ?>
                                    </select>                                    روز
                                    <input type="number" style="width: 60px;display: inline-block;margin:0 3px;" id="InputNumberPercent2" value="<?php echo e(old('percent_2')); ?>" name="percent_2" maxlength="2" class="each-Qt text-center form-control" placeholder="00" />
                                    درصد تخفیف
                                </div>
                            </div>
        <div class="each-item col-md-12">
            <span class="neccry-star">*</span>
            <span class="describ-extra">
            شما میتوانید برای یک دوره زمانی خاص تخفیف در نظر بگیرید
            </span>
        </div>
        <div class="col-md-3 each-option-1">
            <input type="checkbox" id="InputCheck3">
            <span class="checkmark"></span>
            <label class="title-S m-0">تخفیف بازه زمانی خاص</label>
        </div>
        <div class="col-md-9 b-3 box-none-3">
                                <div class="form-group">
                                    تخفیف بازه زمانی خاص از
                                    <input readonly type="text" style="width: 100px;display: inline-block;margin:0 3px;" id="InputDayTurnDiscountFrom" class="each-Qt text-center form-control" placeholder="از تاریخ" />
                                    تا
                                    <input readonly type="text" style="width: 100px;display: inline-block;margin:0 3px;" id="InputDayTurnDiscountTo" class="each-Qt text-center form-control" placeholder="تا تاریخ" />
                                    تخفیف
                                    <input type="number" style="width: 60px;display: inline-block;margin:0 3px;" id="InputTurnDiscount" maxlength="2" class="each-Qt text-center form-control" placeholder="00" />
                                    درصد
                                </div>
                            </div>










        <div class="col-md-12 row btn-footer">
                    <div class="col-md-6 text-right">
                        <a href="<?php echo e(route('CreateHostStep', ['id' => $hostModel->id, 'step' => 4])); ?>" class="prv-btn btn btn-default btn-block"> <i class="fa fa-angle-right"></i><i class="fa fa-angle-right"></i> مرحله قبلی </a>
                    </div>
                    <div class="col-md-6 text-left">
                        <button type="button" id="step6" class="nxt-btn btn btn-default BtnRegAll btn-block">&nbsp; ثبت اقامتگاه <i class="fa fa-angle-left"></i><i class="fa fa-angle-left"></i></button>
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
                    }
                    else if (data.Success == 1) {
                        $(".box-loading-step").fadeOut("slow", function () {
                            $('.box-loading-step').hide();
                        });
                        $('.bar').css("width", "95%");
                        $('.bar').css("background-color", "#2e927e");
                        window.location.replace('<?php echo e(url(route('IndexHost', ['type' => 'all']))); ?>');
                    }
                    else if (data.Success == 100) {
                        window.location.replace('<?php echo e(url(route('IndexHost', ['type' => 'all']))); ?>');
                    } else {
                        $('#myModal').modal('show');
                        $('#MsgErrorStep').text(data.Message);
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

