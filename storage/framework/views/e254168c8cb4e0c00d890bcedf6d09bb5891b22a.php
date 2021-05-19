<?php ($rulesModel = App\Modules\Rules\Controllers\RulesController::GetRules()); ?>


    <div class="panel-body">
        <div class="row">
            <div class="col-md-3">
                <div class="form-group">ساعت ورود
                    <input type="number" class="form-control" id="InputTimeEnter" value="<?php echo e($hostModel->time_enter); ?>" max="23" name="" placeholder=" ساعت ورود 00" />
                </div>
            </div>
            <div class="col-md-3">ساعت خروج
                <div class="form-group">
                    <input type="number" class="form-control" id="InputTimeExit" value="<?php echo e($hostModel->time_exit); ?>" max="23" name="" placeholder=" ساعت خروج 00" />
                </div>
            </div>
            <div class="col-md-3">حداقل تعداد رزرو(روز)
                <div class="form-group">
                    <input type="number" class="form-control" id="InputMinReserve" value="<?php echo e($hostModel->min_reserve_day); ?>" max="30" name="" placeholder=" حداقل تعداد روز رزرو 00" />
                </div>
            </div>
        </div>
        <?php $__currentLoopData = $rulesModel; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $key => $value): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
            <div class="row rows">
                <div class="col-md-6">
                    <label for="slideThree<?php echo e($key+1); ?>"><?php echo e($value->name); ?></label>
                    <div class="slideThree">
                        <?php if(in_array($value->id,$arr_rule)): ?>
                            <input type="checkbox" value="<?php echo e($value->id); ?>" class="chk" id="slideThree<?php echo e($key+1); ?>" name="check<?php echo e($key+1); ?>" checked />
                            <label for="slideThree<?php echo e($key+1); ?>"></label>
                        <?php else: ?>
                            <input type="checkbox" value="<?php echo e($value->id); ?>" class="chk" id="slideThree<?php echo e($key+1); ?>" name="check<?php echo e($key+1); ?>" />
                            <label for="slideThree<?php echo e($key+1); ?>"></label>
                        <?php endif; ?>

                    </div>
                </div>
            </div>
        <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
        <hr />
        <div class="row">
            <div class="col-md-4">
                <label>اضافه کردن قوانین</label>
            </div>
        </div>
        <div class="row">
            <div class="col-md-12">
                <textarea class="form-control textarea" id="InputNewRules" placeholder="قوانین خود را وارد کنید"><?php echo e($hostModel->new_rule); ?></textarea>
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

<script>

    $('#BtnEdit').click(function () {
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
        formData.append('host_id', <?php echo e($hostModel->id); ?>);
        formData.append('step', 5);
        formData.append('time_enter', $('#InputTimeEnter').val());
        formData.append('time_exit', $('#InputTimeExit').val());
        formData.append('min_reserve', $('#InputMinReserve').val());
        formData.append('new_rule', $('#InputNewRules').val());
        formData.append('select_array', selected);
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

