<div class="row">
    <div class="col-md-12">
        <div class="form-group">
            <p class="text-right">جهت ورود یا ثبت نام شماره همراه خود را وارد کنید</p>
        </div>
    </div>
    <div class="col-md-12">
        <div class="form-group text-right">
            <input type="text" autocomplete="off" value="<?php echo e($request->mobile); ?>" maxlength="11" class="form-control" id="InputMobile" placeholder="شماره همراه">
            <span class="message text-danger"></span>
        </div>
    </div>
    <div class="col-md-12">
        <div class="form-group">
            <button type="button" id="BtnCheckUser" class="btn btn-block">ادامه</button>
        </div>
    </div>
</div>
<script>
    $('#InputMobile').click(function () {
        $('span.message').text('');
    });
    $('#BtnCheckUser').click(function () {
        var loading = '<img class="load-register" src="<?php echo e(asset('backend/img/img_loading/loading-register.gif')); ?>" />'
        $(this).html(loading);
        var mobile = $('#InputMobile').val();
        if (mobile.length != 11 || Number.isInteger(parseInt(mobile)) != true) {
            $('span.message').text('فرمت تلفن همراه صحیح نیست.');
            return false;
        }
        $.ajaxSetup({
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            }
        });
        $.ajax({
            url: "<?php echo e(route('CheckUserAjax')); ?>",
            method: "post",
            data: {
                mobile: mobile,
            },
        }).done(function (returnData) {
            if(returnData.Message == 'found') {
                $('#MobileUser').val(mobile);
                $('.box-login-register').html(returnData.Content);
            } else if(returnData.Message == 'sms') {
                $('#MobileUser').val(mobile);
                $('.box-login-register').html(returnData.Content);
            } else {
                alert('error');
            }
        });
    });
</script>