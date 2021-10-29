<div>
    <div >
        <div class="form-group">
            <p class="text-right">رمز ورود را وارد کنید.</p>
        </div>
    </div>
    <div >
        <div class="form-group mb-0">
            <input type="password" autocomplete="off" class="form-control" id="InputPassword" placeholder="رمز ورود">
            <span class="message text-danger mb-3 float-right"></span>
        </div>
    </div>
    <div class="d-flex justify-content-between">
        <div class="form-group text-right">
            <a class="btn-edit-mobile ">ویرایش شماره همراه</a>
        </div>
        <div class="form-group text-right">
            <a class="btn-forget-pass ">فراموشی رمز عبور</a>
        </div>
    </div>
    <div >
        <div class="form-group">
            <button type="button" id="BtnLogin" class="btn btn-block btn_bgCustom">ورود</button>
        </div>
    </div>
    <div class="text-right border-top mt-2 pt-3">
        <a class="text_actionlogin">ورود با رمز یکبار مصرف  </a>
    </div>
</div>

<script>
    $('#BtnLogin').click(function () {
        var loading = '<img class="load-register" src="{{asset('backend/img/img_loading/loading-register.gif')}}" />'
        $(this).html(loading);
        $.ajaxSetup({
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            }
        });
        $.ajax({
            url: "{{route('LoginAjax')}}",
            method: "post",
            data: {
                mobile: $('#MobileUser').val(),
                password: $('#InputPassword').val(),
            },
        }).done(function (returnData) {
            if(returnData.Message == 'empty') {
                AlertToast('ورود', 'رمز ورود اجباری است', 'warning');
            } else if(returnData.Message == 'de-active') {
                AlertToast('ورود', 'کاربر غیر فعال می باشد', 'warning');
                // $('#myModal').modal('hide');
                // $('.modal-backdrop.fade.in').css('display', 'none');
            } else if(returnData.Message == 'not-found') {
                AlertToast('ورود', 'رمز ورود اشتباه است', 'warning');
            } else if(returnData.Message == 'success') {
                $('.box-login').html(returnData.Content);
                AlertToast('ورود', 'خوش آمدید');
                $('#myModal').modal('hide');
                $('.modal-backdrop.fade.in').css('display', 'none');
                $('.list-login').html(returnData.Content2);
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

    $('.btn-forget-pass').click(function () {
        $.ajax({
            url: "",
            method: "post",
            data: {
                mobile: $('#MobileUser').val(),
            }
        }).done(function (returnData) {
            $('.box-login-register').html(returnData.Content);
        });
    });

    $('.text_actionlogin').click(function () {
        $.ajax({
            url: "",
            method: "post",
            data: {
                mobile: $('#MobileUser').val(),
            }
        }).done(function (returnData) {
            $('.box-login-register').html(returnData.Content);
        });
    });
</script>