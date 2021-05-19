
<?php ($optionModel = App\Modules\Possibilities\Controllers\PossibilitiesController::GetOption()); ?>

    <div class="panel-body">
        <div class="row">
            <?php $__currentLoopData = $optionModel; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $key => $value): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                <div class="col-md-6 rows">
                    <label for="slideThree<?php echo e($key+1); ?>"><?php echo e($value->name); ?></label>
                    <div class="slideThree">
                        <?php if(in_array($value->id,$arr_option)): ?>
                            <input type="checkbox" value="<?php echo e($value->id); ?>" class="chk" id="slideThree<?php echo e($key+1); ?>" name="check<?php echo e($key+1); ?>" checked />
                            <label for="slideThree<?php echo e($key+1); ?>"></label>
                        <?php else: ?>
                            <input type="checkbox" value="<?php echo e($value->id); ?>" class="chk" id="slideThree<?php echo e($key+1); ?>" name="check<?php echo e($key+1); ?>" />
                            <label for="slideThree<?php echo e($key+1); ?>"></label>
                        <?php endif; ?>
                    </div>
                </div>
            <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
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

    /* Get the checkboxes values based on the class attached to each check box */
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

        // alert(selected);
        /* check if there is selected checkboxes, by default the length is 1 as it contains one single comma */
        if(selected.length > 0){
            var formData = new FormData();
            formData.append('host_id', <?php echo e($hostModel->id); ?>);
            formData.append('step', 4);
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
        }else{
            $(".box-loading-step").fadeOut("slow", function() {
                $('.box-loading-step').hide();
            });
            $.Toast("<p>ویرایش</p>", "<p>حداقل انتخاب یکی از فیلد های زیر اجباری میباشد .</p>", "warning", {
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



    });
</script>

