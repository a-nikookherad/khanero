<div >
    <div>
        <div class="form-group mb-5">
            <p class="text-right font_14">یک کد 5 رقمی برای شماره شما ارسال کردیم لطفا آن را وارد کنید.</p>
        </div>
    </div>
    <div >
        <div class="form-group mb-0">
            <input type="text" autocomplete="off" class="form-control" id="InputCode" placeholder="کد ارسال شده">
            <span class="message text-danger float-right"></span>
        </div>
    </div>
    <div >
        <div class="form-group">
            <button type="button" id="BtnSendSms" class="btn btn-block btn_bgCustom">بررسی</button>
        </div>
    </div>
    <div class="d-flex align-items-center justify-content-between border-bottom mb-2">
        <div class="form-group text-right">
            <a class="btn-edit-mobile">فراموشی رمز عبور</a>
        </div>
        <div class="form-group text-right">
            <a class="btn-edit-mobile ">ویرایش شماره همراه</a>
        </div>
    </div>
    
    <div class="text-right">
        <a class="text_actionlogin">ورود با رمز یکبار مصرف  </a>
    </div>
</div>

<script>
    $('#BtnSendSms').click(function () {
        var loading = '<img class="load-register" src="{{asset('backend/img/img_loading/loading-register.gif')}}" />'
        $(this).html(loading);
        $.ajaxSetup({
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            }
        });
        $.ajax({
            url: "{{route('CheckCodeLogin')}}",
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
            url: "{{route('DefaultLoginAjax')}}",
            method: "post",
            data: {
                mobile: $('#MobileUser').val(),
            }
        }).done(function (returnData) {
            $('.box-login-register').html(returnData.Content);
        });
    });
</script>