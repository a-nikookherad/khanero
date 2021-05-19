<div class="row">
    <div class="col-md-12">
        <div class="form-group">
            <p class="text-right">رمز خود را وارد کنید.</p>
        </div>
    </div>
    <div class="col-md-12">
        <div class="form-group text-right">
            <input type="text" autocomplete="off" class="form-control" id="InputPassword" placeholder="رمز جدید شما">
            <span class="message text-danger"></span>
        </div>
    </div>
{{--    <div class="col-md-12">--}}
{{--        <div class="form-group text-right">--}}
{{--            <a class="btn-edit-mobile">ویرایش شماره همراه</a>--}}
{{--        </div>--}}
{{--    </div>--}}
    <div class="col-md-12">
        <div class="form-group">
            <button type="button" id="BtnRegister" class="btn btn-block">ورود</button>
        </div>
    </div>
</div>

<script>
    $('#BtnRegister').click(function () {
        var loading = '<img class="load-register" src="{{asset('backend/img/img_loading/loading-register.gif')}}" />'
        $(this).html(loading);
        $.ajaxSetup({
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            }
        });
        $.ajax({
            url: "{{route('RegisterAjaxUser')}}",
            method: "post",
            data: {
                mobile: $('#MobileUser').val(),
                password: $('#InputPassword').val(),
            },
        }).done(function (returnData) {
            if(returnData.Message == 'lenght') {
                AlertToast('ورود', ''+returnData.Content+'', 'warning');
            } else if(returnData.Message == 'success') {
                $('.box-login').html(returnData.Content);
                AlertToast('ورود', 'ثبت نام شما موفقیت آمیز بود', 'success');
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