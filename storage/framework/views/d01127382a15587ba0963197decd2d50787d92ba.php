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

    #InputMinReserveDay {
        width: 20px;
    }
</style>
<div class="address">
    <div class="col-md-12">
        <p>
            <button data-value="1" id="BtnEditStep1" class="btn btn-enable">مشخصات اقامتگاه</button>
            <button data-value="4" id="BtnEditStep4" class="btn btn-enable">موقعیت</button>
            <button data-value="2" id="BtnEditStep2" class="btn btn-enable">امکانات</button>
            <button data-value="7" id="BtnEditStep7" class="btn btn-enable">تصاویر</button>
            <button data-value="3" id="BtnEditStep3" class="btn btn-enable">قوانین صاحبخانه</button>
            <button data-value="6" id="BtnEditStep6" class="btn btn-enable">قیمت گذاری</button>
        </p>
    </div>
</div>
<div class="row">
    <div class="col-md-12">
        <div class="panel panel-default">
            <div class="panel-heading">
                <h3 class="panel-title">قیمت و تاریخ<span class="information-step"><i
                                class="fas fa-info-circle"></i></span></h3>
                <div class="box-information show-information">
                    <p>
                        <span class="title-information">قیمت و تاریخ</span> : بعد از ثبت اقامتگاه می توانید به قسمت(اقامتگاه های من) بروید و سپس در قسمت تقویم می توانید هر روز از سال را قیمت گذاری، تخفیف یا مسدود کنید
                        .<br/>
                    </p>
                </div>
            </div>
            <div class="panel-body">
                <div class="row">
                    <div class="col-md-3">
                        <div class="form-group">
                            <label for="InputMaximumCapacity">از تاریخ</label>
                            <input type="number" class="form-control" id="InputMaximumCapacity" name="" placeholder=" حداکثر ظرفیت" />
                        </div>
                    </div>
                    <div class="col-md-3">
                        <div class="form-group">
                            <label for="InputMaximumCapacity">تا تاریخ</label>
                            <input type="number" class="form-control" id="InputMaximumCapacity" name="" placeholder=" حداکثر ظرفیت" />
                        </div>
                    </div>
                </div>
                <div class="col-md-12">
                    <div class="row">
                        <div class="col-md-2">
                            <label for="InputPriceFirstWeek">قیمت وسط هفته</label>
                        </div>
                        <div class="col-md-4">
                            <div class="form-group">
                                <input type="text" onkeyup="Seprator(this);" class="form-control"
                                       id="InputPriceFirstWeek" name=""
                                       placeholder="از شنبه تا سه شنبه"/> تومان
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-md-2">
                            <label for="InputPriceLastWeek">قیمت آخر هفته</label>
                        </div>
                        <div class="col-md-4">
                            <div class="form-group">
                                <input type="text" onkeyup="Seprator(this);" class="form-control"
                                       id="InputPriceLastWeek" name=""
                                       placeholder="از چهارشنبه تا جمعه"/>تومان
                            </div>
                        </div>
                    </div>
                </div>
                <hr/>
                <div class="col-md-12">
                    <div class="row">
                        <div class="col-md-2">
                            <label for="InputPriceSpecialDay">قیمت روزهای خاص</label>
                        </div>
                        <div class="col-md-4">
                            <div class="form-group">
                                <input type="text" onkeyup="Seprator(this);" class="form-control"
                                       id="InputPriceSpecialDay" name=""
                                       placeholder="قیمت روزهای خاص تقویم"/>تومان
                                <p><span class="text-danger">قیمت روزهای خاص </span>این قیمت برای روزهای قبل تعطیل یا ما
                                    بین تعطیلات لحاظ میشود</p>
                            </div>
                        </div>
                    </div>

                    <div class="row">
                        <div class="col-md-2">
                            <label for="InputOnePersonPrice">هزینه اضافی به ازای هر نفر</label>
                        </div>
                        <div class="col-md-4">
                            <div class="form-group">
                                <input type="text" onkeyup="Seprator(this);" name="one_person_price"
                                       id="InputOnePersonPrice" class="form-control" placeholder="0"/>تومان
                            </div>
                        </div>
                    </div>
                    <hr />
                    <div class="row">
                        <div class="col-md-6">
                            <div class="form-group">
                                شما میتوانید برای
                                <input type="number" style="width: 80px;display: inline-block;" id="InputDayDiscount" value="<?php echo e(old('number_days')); ?>" name="number_days" maxlength="2" class="text-center form-control" placeholder="00" />
                                روز
                                <input type="number" style="width: 80px;display: inline-block;" id="InputNumberPercent" value="<?php echo e(old('percent')); ?>" name="percent" maxlength="2" class="text-center form-control" placeholder="00" />
                                درصد تخفیف بگیرید
                                <button type="button" id="BtnCreateDiscount" class="btn btn-success ">ثبت</button>

                            </div>
                        </div>
                        <div class="col-md-6">
                            <div id="ExtraDiscount">
                                <?php if(count($hostModel->getDiscount) > 0): ?>
                                    <table class="table table-bordered">
                                        <thead>
                                        <th>ردیف</th>
                                        <th>تعداد روز</th>
                                        <th>تخفیف</th>
                                        <th>حذف</th>
                                        </thead>
                                        <tbody>
                                        <?php $__currentLoopData = $hostModel->getDiscount; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $key => $value): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                            <tr class="tr<?php echo e($value->id); ?>">
                                                <td><?php echo e($key + 1); ?></td>
                                                <td><?php echo e($value->number_days); ?></td>
                                                <td><?php echo e($value->percent); ?></td>
                                                <td><button class="btn-danger btn" onclick="DeleteDiscount(<?php echo e($value->id); ?>)">حذف</button></td>
                                            </tr>
                                        <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                                        </tbody>
                                    </table>
                                    <script>
                                        function DeleteDiscount(id) {
                                            var loading = '<img style="width:45px; margin-right:50px;" src="<?php echo e(asset('backend/img/img_loading/orange_circles.gif')); ?>" />';
                                            $('#ExtraDiscount').html(loading);
                                            $.ajaxSetup({
                                                headers: {
                                                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                                                }
                                            });
                                            $.ajax({
                                                url: '<?php echo e(route('DeleteDiscountAjax')); ?>',
                                                type: 'post',
                                                data: {
                                                    id: id,
                                                    host_id: $('#host_id').val(),
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
                                                    }
                                                }
                                            });
                                        }
                                    </script>
                                <?php else: ?>
                                    <div class="row">
                                        <div class="col-md-12">
                                            <div class="alert alert-warning">
                                                <p>تخفیفی در سیستم به ثبت نرسیده است.</p>
                                            </div>
                                        </div>
                                    </div>
                                <?php endif; ?>
                            </div>
                        </div>
                    </div>
                </div>
                <hr/>

                
                
                
                
                
                
                
                
                
                
                
                
                
                
                
                
                
                
                
                
                
                
                
                
                
                
                
                
                
                
                

                
                
                
                
                
                
                
                
                
                
                
                
                
                
                
                
                
                
                
                
                
                
                
                
                
                
                
                
                
                
                
                
                































                <hr/>
                <div class="row">
                    <div class="col-md-2 col-md-offset-5">
                        <button type="button" id="step6" class="btn btn-default BtnRegAll btn-block">&nbsp; ثبت اقامتگاه <i
                                    class="fa fa-angle-left"></i><i class="fa fa-angle-left"></i></button>
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


    $("#InputDateSpecial").datepicker({
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

        var radioValue = $("input[name='days']:checked").val();
        if (radioValue == 0) {
            var formData = new FormData();
            formData.append('host_id', $('#host_id').val());
            formData.append('price_first_week', $('#InputPriceFirstWeek').val());
            formData.append('price_last_week', $('#InputPriceLastWeek').val());
            formData.append('price_special_day', $('#InputPriceSpecialDay').val());
            formData.append('one_person_price', $('#InputOnePersonPrice').val());
            formData.append('closest_time_reserve', $('#InputMinReserveDay').val());
            formData.append('percent_instantaneous', $('#PercentReserve').val());
            formData.append('type', radioValue);
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
                    } else {
                        $(".box-loading-step").fadeOut("slow", function () {
                            $('.box-loading-step').hide();
                        });
                        $('#ExtraFormHost').html(data.Message.original);
                    }
                }
            });
        } else if (radioValue == 1) {
            var formData = new FormData();
            formData.append('host_id', $('#host_id').val());
            formData.append('price_saturday', $('#InputSaturday').val());
            formData.append('price_sunday', $('#InputSunday').val());
            formData.append('price_monday', $('#InputMonday').val());
            formData.append('price_tuesday', $('#InputTuesday').val());
            formData.append('price_wednesday', $('#InputWednesday').val());
            formData.append('price_thursday', $('#InputThursday').val());
            formData.append('price_friday', $('#InputFriday').val());
            formData.append('price_special_day', $('#InputPriceSpecialDay').val());
            formData.append('one_person_price', $('#InputOnePersonPrice').val());
            formData.append('closest_time_reserve', $('#InputMinReserveDay').val());
            formData.append('percent_instantaneous', $('#PercentReserve').val());
            formData.append('type', radioValue);
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
                    } else {
                        $(".box-loading-step").fadeOut("slow", function () {
                            $('.box-loading-step').hide();
                        });
                        $('#ExtraFormHost').html(data.Message.original);
                    }
                }
            });
        } else {
            $(".box-loading-step").fadeOut("slow", function () {
                $('.box-loading-step').hide();
            });
            $('#myModal').modal('show');
            $('#MsgErrorStep').text('لطفا ابتدا نوع قیمت گذاری را تعیین کنید سپس قیمت مورد نظر را در قسمت مشخص شده وارد کنید .');
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

