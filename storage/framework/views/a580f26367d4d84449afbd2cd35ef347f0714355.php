<?php ($rulesModel = App\Modules\Rules\Controllers\RulesController::GetRules()); ?>

<style>
    .progress .bar {
        width: 60%;
        background-color: #bcae77;
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
            <button data-value="6" id="BtnEditStep6" class="btn btn-disable" disabled>قیمت گذاری</button>
        </p>
    </div>
</div>
<div class="row">
    <div class="col-md-12">
        <div class="panel panel-default">
            <div class="panel-heading">
                <h3 class="panel-title">قوانین صاحبخانه<span class="information-step"><i class="fas fa-info-circle"></i></span></h3>
                <div class="box-information show-information">
                    <p>
                        <span class="title-information">حداقل تعداد روز رزرو</span> : حداقل تعداد روزی که میهمان می تواند اقامتگاه شما را رزرو کند، مثال : اگر 2 را انتخاب کنید میهمان نمی تواند اقامتگاه شما را برای یک شب رزرو کند.<br />
                        <span class="title-information">ساعت ورود و خروج</span> در این قسمت ساعت ورود مهمان ها را با ساعت خروج آنها مشخص کنید
                    </p>
                </div>
            </div>
            <div class="panel-body">
                <?php $__currentLoopData = $rulesModel; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $key => $value): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                    <div class="row rows">
                        <div class="col-md-5">
                            <label for="slideThree<?php echo e($key+1); ?>"><?php echo e($value->name); ?></label>
                            <div class="slideThree">
                                <input type="checkbox" value="<?php echo e($value->id); ?>" class="chk" id="slideThree<?php echo e($key+1); ?>" name="check<?php echo e($key+1); ?>" />
                                <label for="slideThree<?php echo e($key+1); ?>"></label>
                            </div>
                        </div>
                    </div>
                <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                <hr />
                <div class="row">
                    <div class="col-md-12">
                        <div class="form-group">
                            <label for="InputNewRules">اضافه کردن قوانین</label>
                            <textarea class="form-control textarea" id="InputNewRules" placeholder="قوانین خود را وارد کنید"></textarea>
                        </div>
                    </div>
                </div>
                <div class="row">
                    <div class="col-md-3">
                        <div class="form-group">
                            <label for="SelectTimeEnterFrom">ساعت ورود از</label>
                            <select id="SelectTimeEnterFrom" class="form-control">
                                <option value="0">ساعت وروداز</option>
                                <?php for($i = 1; $i<= 24; $i++): ?>
                                    <option value="<?php echo e($i); ?>"><?php echo e($i); ?></option>
                                <?php endfor; ?>
                            </select>
                        </div>
                    </div>
                    <div class="col-md-3">
                        <div class="form-group">
                            <label for="SelectTimeEnterTo">ساعت ورود تا</label>
                            <select id="SelectTimeEnterTo" class="form-control">
                                <?php for($i = 1; $i<= 24; $i++): ?>
                                    <option value="<?php echo e($i); ?>"><?php echo e($i); ?></option>
                                <?php endfor; ?>
                            </select>
                        </div>
                    </div>
                    <div class="col-md-3">
                        <div class="form-group">
                            <label for="SelectTimeExit">ساعت خروج</label>
                            <select id="SelectTimeExit" class="form-control">
                                <?php for($i = 1; $i<= 24; $i++): ?>
                                    <option value="<?php echo e($i); ?>"><?php echo e($i); ?></option>
                                <?php endfor; ?>
                            </select>
                        </div>
                    </div>
                    <div class="col-md-3">
                        <div class="form-group">
                            <label for="InputMinReserve">حداقل شب اقامت</label>
                            <input type="number" class="form-control" id="InputMinReserve" max="30" name="" placeholder=" حداقل شب اقامت" />
                        </div>
                    </div>
                </div>
                    <div class="row">
                        <div class="col-md-3">
                            <div class="form-group">
                                <label for="InputStandardCapacity">ظرفیت استاندارد</label>
                                <input type="number" class="form-control" id="InputStandardCapacity" name="" placeholder=" ظرفیت استاندارد" />
                            </div>
                        </div>
                        <div class="col-md-3">
                            <div class="form-group">
                                <label for="InputMaximumCapacity">حداکثر ظرفیت</label>
                                <input type="number" class="form-control" id="InputMaximumCapacity" name="" placeholder=" حداکثر ظرفیت" />
                            </div>
                        </div>
                    </div>
                <br />
                <div class="row">
                    <div class="col-md-2 col-md-offset-5">
                        <button type="button" id="step5" class="btn btn-default BtnRegAll btn-block">&nbsp; بعدی  <i class="fa fa-angle-left"></i><i class="fa fa-angle-left"></i></button>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>


<script>

    $('#step5').click(function () {
        $(".box-loading-step").fadeIn("slow", function() {
            $(this).show();
        });

        var chkArray = [];
        /* look for all checkboes that have a class 'chk' attached to it and check if it was checked */
        $(".chk:checked").each(function() {
            chkArray.push($(this).val());
        });
        /* we join the array separated by the comma */
        var selected;
        selected = chkArray.join(',') ;

        var formData = new FormData();
        formData.append('host_id', $('#host_id').val());
        formData.append('time_enter_from', $('#SelectTimeEnterFrom').val());
        formData.append('time_enter_to', $('#SelectTimeEnterTo').val());
        formData.append('time_exit', $('#SelectTimeExit').val());
        formData.append('min_reserve', $('#InputMinReserve').val());
        formData.append('standard_guest', $('#InputStandardCapacity').val());
        formData.append('count_guest', $('#InputMaximumCapacity').val());
        formData.append('new_rule', $('#InputNewRules').val());
        formData.append('select_array', selected);
        $.ajaxSetup({
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            }
        });
        $.ajax({
            url: '<?php echo e(route('StoreHostStep5')); ?>',
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
                else {
                    $(".box-loading-step").fadeOut("slow", function () {
                        $('.box-loading-step').hide();
                    });
                    $('#ExtraFormHost').html(data.Message.original);
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

