<div class="panel-heading">
    <h3 class="panel-title">نمایش پیام های ارسالی(<?php echo e($userModel->first_name.' '.$userModel->last_name); ?>)</h3>

</div>
<div class="panel-body">
    <div class="col-md-12">
        <div class="box-message scrollbar" id="style-6">
            <?php $__currentLoopData = $messageModel; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $key => $value): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                <div class="row <?php if($value->sender_id == auth()->user()->id): ?> text-right <?php else: ?> text-left <?php endif; ?>">
                    <p class="<?php if($value->sender_id == auth()->user()->id): ?> text-right bg-success <?php else: ?> text-left bg-info <?php endif; ?>">
                        <?php echo e($value->message); ?>

                    </p>
                    <h6>
                        <?php echo e(\Morilog\Jalali\Facades\jDate::forge($value->created_at)->format('Y/m/d - H:i:s')); ?>

                    </h6>
                </div>
            <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
            <div id="SendMessageBox">

            </div>
            <div id="LinkMessage"></div>
        </div>
    </div>
    <div class="col-md-12">
        <div class="row">
            <div class="col-md-2">
                <div class="row">
                    <input type="text" id="InputTitleText" class="form-control" placeholder="عنوان پیام" />
                </div>
            </div>
            <div class="col-md-8">
                <div class="row">
                    <input type="text" id="InputMessageText" class="form-control" placeholder="متن مورد نظر را بنویسید ..." />
                </div>
            </div>
            <div class="col-md-2">
                <div class="row">
                    <a href="#LinkMessage" class="btn btn-block btn-send-message">ارسال<i class="fa fa-location-arrow"></i> </a>
                </div>
            </div>
        </div>
    </div>
</div>
<script>
    $(".box-message").animate({ scrollTop: $('.box-message').prop("scrollHeight")}, 3000);
    $("body").delegate(".btn-send-message","click",function (e) {
        var title = $('#InputTitleText').val();
        var message = $('#InputMessageText').val();
        var receiver_id = <?php echo e($userModel->id); ?>;
        var h = '<div class="row text-right">\n' +
            '        <p class="text-right bg-success">\n' +
            '            '+ message +'\n' +
            '        </p>\n' +
            '        <h6>\n' +
            '            <?php echo e(\Morilog\Jalali\Facades\jDate::forge(date('Y/m/d H:i:s'))->format('Y/m/d - H:i:s')); ?> \n' +
            '        </h6>\n' +
            '    </div>';

        $.ajaxSetup({
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            }
        });
        $.ajax({
            url: '<?php echo e(route('StoreMessage')); ?>',
            type: 'post',
            data: {
                title:title,
                message:message,
                receiver_id:receiver_id,
            },
            success: function (data) {
                if(data.Success == 1) {
                    $('#SendMessageBox').append(h);
                    $.Toast("<p>پیام</p>", "<p>"+ data.Message +" .</p>", "success", {
                        has_icon: true,
                        has_close_btn: true,
                        stack: true,
                        fullscreen: false,
                        timeout: 4000,
                        sticky: false,
                        has_progress: true,
                        rtl: true,
                    });
                    $('#InputTitleText').val("");
                    $('#InputMessageText').val("");
                } else {
                    $.Toast("<p>پیام</p>", "<p>"+ data.Message +" .</p>", "warning", {
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