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
    <div class="d-flex border-bottom mb-2">
        <div class="form-group text-right">
            <a class="btn-edit-mobile ">ویرایش شماره همراه</a>
        </div>
    </div>
</div>
{{--
 send to route : LoginWithSmsCode
 data: mobile and code
 method post


--}}