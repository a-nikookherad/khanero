<div class="row">
    <div class="col-md-12">
        <div class="form-group">
            <p class="text-right">یک کد 5 رقمی برای شماره شما ارسال کردیم لطفا آن را در فرم زیر وارد کنید.</p>
        </div>
    </div>
    <div class="col-md-12">
        <div class="form-group text-right">
            <input type="text" autocomplete="off" class="form-control" id="InputCode" placeholder="کد ارسال شده">
            <span class="message text-danger"></span>
        </div>
    </div>
    <div class="col-md-12">
        <div class="form-group text-right">
            <a class="btn-edit-mobile text-success">ویرایش شماره همراه</a>
        </div>
    </div>
    <div class="col-md-12">
        <div class="form-group">
            <button type="button" id="BtnSendSms" class="btn btn-block">بررسی</button>
        </div>
    </div>
</div>

<script>
    $('#BtnSendSms').click(function () {
        var loading = '<img class="load-register" src="<?php echo e(asset('backend/img/img_loading/loading-register.gif')); ?>" />'
        $(this).html(loading);
        $.ajaxSetup({
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            }
        });
        $.ajax({
            url: "<?php echo e(route('CheckCodeLogin')); ?>",
            method: "post",
            data: {
                mobile: $('#MobileUser').val(),
                code: $('#InputCode').val(),
            },
        }).done(function (returnData) {
            if(returnData.Message == 'empty') {
                AlertToast('ورود', 'رمز ورود اجباری است', 'warning');
            } else if(returnData.Message == 'success') {
                $('.box-login-register').html(returnData.Content);
            } else if(returnData.Message == 'de-active') {
                AlertToast('ورود', 'کاربر غیر فعال می باشد', 'warning');
                $('#myModal').modal('hide');
                $('.modal-backdrop.fade.in').css('display', 'none');
            } else {
                AlertToast('ورود', 'error', 'warning');
            }
        });
    });

    $('.btn-edit-mobile').click(function () {
        $.ajax({
            url: "<?php echo e(route('DefaultLoginAjax')); ?>",
            method: "post",
            data: {
                mobile: $('#MobileUser').val(),
            }
        }).done(function (returnData) {
            $('.box-login-register').html(returnData.Content);
        });
    });
</script>