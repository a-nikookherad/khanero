<div >
    <div >
        <div class="form-group">
            <p class="text-right">اطلاعات خود را تکمیل کنید  </p>
        </div>
    </div>
    <div >
        <div class="form-group mb-0">
            <input type="text" autocomplete="off" class="form-control text-right" id="InputFName" placeholder="نام ">
            <span class="message text-danger mb-2 float-right"></span>
        </div>
    </div>

    <div >
        <div class="form-group mb-0">
            <input type="text" autocomplete="off" class="form-control text-right" id="InputLName" placeholder="نام خانوادگی">
            <span class="message text-danger mb-3 float-right"></span>
        </div>
    </div>

    <div >
        <div class="form-group mb-0">
            <input type="password" autocomplete="off" class="form-control" id="InputPassword" placeholder="رمز جدید شما">
            <span class="message text-danger mb-3 float-right"></span>
        </div>
    </div>
    <div class="d-flex align-items-center justify-content-between">
        <div class="item_Gender">
            <input type="radio" name="Gender" value="1" id="Gender-0" class="GenderInLogin" checked/>
            <label class="lable_GenderInLogin" for="Gender-0">آقا هستم</label>
        </div>
        <div class="item_Gender">
            <input type="radio" name="Gender" value="2" id="Gender-1" class="GenderInLogin" />
            <label class="lable_GenderInLogin" for="Gender-1">خانم هستم</label>
        </div>
    </div>
{{--    <div >--}}
{{--        <div class="form-group text-right">--}}
{{--            <a class="btn-edit-mobile">ویرایش شماره همراه</a>--}}
{{--        </div>--}}
{{--    </div>--}}
    <div >
        <div class="form-group">
            <button type="button" id="BtnRegister" class="btn btn-block btn_bgCustom">ورود</button>
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
                gender: $(":radio:checked").val(),
                firstName: $("#InputFName").val(),
                lastName: $("#InputLName").val(),
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