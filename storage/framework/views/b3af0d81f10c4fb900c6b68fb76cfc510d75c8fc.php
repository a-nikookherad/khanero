<?php ($cancelRuleModel = App\Modules\Rules\Controllers\RulesController::GetCancelRules()); ?>

<style>
    .progress .bar {
        width: 95%;
        background-color: #76b485;
    }
</style>

<div class="address">
    <div class="col-md-12">
        <p>
            <button data-value="1" id="BtnEditStep1" class="btn BtnEditStep">اطلاعات اولیه</button>
            <button data-value="2" id="BtnEditStep2" class="btn BtnEditStep">موقعیت اقامتگاه</button>
            <button data-value="3" id="BtnEditStep3" class="btn BtnEditStep">چیدمان اتاق ها</button>
            <button data-value="4" id="BtnEditStep4" class="btn BtnEditStep">امکانات</button>
            <button data-value="5" id="BtnEditStep5" class="btn BtnEditStep">قوانین خانه</button>
            <button data-value="6" id="BtnEditStep6" class="btn BtnEditStep">قیمت و تاریخ</button>
            <button data-value="7" id="BtnEditStep7" class="btn BtnEditStep" disabled>اطلاعات اقامتگاه</button>
        </p>
    </div>
</div>
<div class="row">
    <div class="col-md-12">
        <div class="panel panel-default">
            <div class="panel-heading">
                <h3 class="panel-title">اطلاعات اقامتگاه<span class="information-step"><i
                                class="fas fa-info-circle"></i></span></h3>
                <div class="box-information">
                    <p>
                        اطلاعات اقامتگاه<br/>

                    </p>
                </div>
            </div>
            <div class="panel-body">
                <div class="row">
                    <div class="col-md-4">
                        <div class="">
                            <label>نام اقامتگاه</label><span>(نامی انتخاب کنید که گویای اقامتگاه باشد)</span>
                        </div>
                        <div class="">
                            <div class="form-group">
                                <input type="text" class="form-control" name="" id="InputHostName"
                                       placeholder="نام اقامتگاه - برای مثال : ویلای ۴۰۰ متری دوبلکس دماوند"/>
                            </div>
                        </div>
                    </div>
                    <div class="col-md-8">
                        <div class="alert alert-warning msg">
                            <p>
                                به هیچ عنوان شماره تماس ، ایمیل ، تلگرام و هرگونه راه ارتباطی نگذارید . در صورت مشاهده
                                آگهی حذف خواهد شد .
                            </p>
                        </div>
                    </div>
                </div>
                <div class="row">
                    <div class="col-md-12">
                        <label>توضیحات اقامتگاه</label><span>(توضیح درباره ملک)</span>
                    </div>
                </div>
                <div class="row">
                    <div class="col-md-12">
                        <div class="form-group">
                            <textarea class="form-control textarea" id="InputDescription"
                                      placeholder="هر آنچه گفته نشده را توضیح دهید"></textarea>
                        </div>
                    </div>
                </div>
                <br/>
                <div class="row">
                    <div class="col-md-12">
                        <div class="form-group">
                            <label>قوانین لغو رزرو</label><span style="font-size: 18px;" class="text-danger">*</span>
                            <select name="cancel_rule_id" id="SelectCancelRule" class="form-control CancelRule">
                                <option hidden>انتخاب کنید</option>
                                <?php $__currentLoopData = config('setting.CancelReserveRule'); $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $key => $value): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                    <option value="<?php echo e($value['id']); ?>"><?php echo e($value['name']); ?></option>
                                <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                            </select>
                        </div>
                    </div>
                    <div class="col-md-12">
                        <div class="form-group">
                            <?php $__currentLoopData = config('setting.CancelReserveRule'); $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $key => $value): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                <div class="description-rule<?php echo e($value['id']); ?> desc-rule" style="display: none;">
                                    <div class="alert alert-info">
                                        <?php $__currentLoopData = $value['time']; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $key2 => $value2): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                            <p><?php echo e($value2['description']); ?><p>
                                        <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                                    </div>
                                </div>
                            <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                        </div>
                    </div>
                </div>
                <br />
                <div class="row">
                    <div class="col-md-4 col-md-offset-4">
                        <button type="button" id="step7" class="btn btn-green BtnRegAll btn-block">&nbsp; میزبان
                            شدیم
                        </button>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>


<script>

    $('#SelectCancelRule').change(function () {
        switch($(this).val()) {
            case '1': $('.desc-rule').css('display', 'none');
                $('.description-rule1').css('display', 'block');
            break;
            case '2': $('.desc-rule').css('display', 'none');
                $('.description-rule2').css('display', 'block');
            break;
            case '3': $('.desc-rule').css('display', 'none');
                $('.description-rule3').css('display', 'block');
            break;
            default: $('.desc-rule').css('display', 'none'); break;
        }
    });

    $('#step7').click(function () {
        $(".box-loading-step").fadeIn("slow", function () {
            $(this).show();
        });

        var formData = new FormData();
        formData.append('host_id', $('#host_id').val());
        formData.append('host_name', $('#InputHostName').val());
        formData.append('description', $('#InputDescription').val());
        formData.append('cancel_rule_id', $('#SelectCancelRule').val());
        $.ajaxSetup({
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            }
        });
        $.ajax({
            url: '<?php echo e(route('StoreHostStep7')); ?>',
            type: 'post',
            data: formData,
            processData: false,
            contentType: false,
            success: function (data) {
                console.log(data);
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
                    window.location.replace('<?php echo e(url(route('IndexHost'))); ?>');
                }
                else if (data.Success == 100) {
                    window.location.replace('<?php echo e(url(route('IndexHost'))); ?>');
                }
            }
        });
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
</script>