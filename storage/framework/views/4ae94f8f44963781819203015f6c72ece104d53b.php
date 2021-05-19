<meta name="viewport" content="width=device-width, initial-scale=1">
<?php $__env->startSection('title',TitlePage('ثبت نام')); ?>
<?php $__env->startSection('style'); ?>
    <link rel="stylesheet" href="<?php echo e(asset('backend/css/datepicker.css')); ?>">
    <link rel="stylesheet" href="<?php echo e(asset('backend/css/bootstrap-datepicker.min.css')); ?>" />
    <style>
        .text-register {
            font-size: 12px;
            text-align: justify;
        }
        .panel-heading.text-right img {
            position: absolute;
            width: 40px;
            float: left;
            left: 25px;
            top: 0px;
        }
        h4 span {
            color: #e83197e0;
            font-size: 12px;
            padding: 0px 5px;
        }
        span.error-code {
            color: red;
            float: right;
            margin: 10px 0px;
        }
        .loading-img-reagent {
            margin: 0 auto;
            position: absolute;
            left: 16px;
            top: 3px;
            width: 25px;
            height: 25px;
        }
    </style>
<?php $__env->stopSection(); ?>

<?php $__env->startSection('content'); ?>


    <div class="row">
        <div class="col-md-6 col-md-offset-3">
            <?php echo $__env->make('message.Message', array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>
            <?php echo $__env->make('message.ErrorReporting', array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>
        </div>
    </div>
    <div class="row">
        <div class="col-md-6 col-md-offset-3">
            <div class="panel panel-default">
                <div class="panel-heading text-right">
                    <h3 class="panel-title">ثبت نام</h3>
                    <img src="<?php echo e(asset('frontend/images/logo.png')); ?>" />
                </div>
                <div class="panel-body">

                    <form role="form" action="<?php echo e(route('StoreNewUser')); ?>" method="post" enctype="multipart/form-data" id="FormRegister">
                        <?php echo e(csrf_field()); ?>

                        <div class="row">
                            <div class="col-md-12">
                                <div class="form-group">
                                    <label for="InputFirstName">نام</label>
                                    <input type="text" name="first_name" tabindex="1" value="<?php echo e(old('first_name')); ?>" class="form-control primary input-sm" dir="rtl" id="InputFirstName" placeholder="نام را وارد کنید" autofocus>
                                    <?php if($errors->has('first_name')): ?>
                                        <span style="color:red;"><?php echo e($errors->first('first_name')); ?></span>
                                    <?php endif; ?>
                                </div>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-md-12">
                                <div class="form-group">
                                    <label for="InputMobile">شماره موبایل</label>
                                    <input type="text" name="mobile" tabindex="3" value="<?php echo e(old('mobile')); ?>" class="form-control primary input-sm" dir="rtl" id="InputMobile" placeholder="شماره همراه را وارد کنید">
                                    <?php if($errors->has('mobile')): ?>
                                        <span style="color:red;"><?php echo e($errors->first('mobile')); ?></span>
                                    <?php endif; ?>
                                </div>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-md-12">
                                <div class="form-group">
                                    <label for="InputPassword">رمز عبور </label><span style="font-size: 10px;" class="text-warning">(حداقل ۸ کاراکتر)</span>
                                    <input name="password" tabindex="5" value="" type="password" class="form-control primary input-sm" dir="rtl" id="InputPassword" placeholder="رمز عبور را وارد کنید">
                                    <?php if($errors->has('password')): ?>
                                        <span style="color:red;"><?php echo e($errors->first('password')); ?></span>
                                    <?php endif; ?>
                                </div>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-md-6">
                                <input type="checkbox" name="rules" id="InputCheckRule" class="" value="1" /> <a href="<?php echo e(route('PageContent', ['alias' => 'قوانین-و-مقررات'])); ?>" target="_blank">قوانین و مقررات</a> را پذیرفته ام
                            </div>
                            <div class="col-md-6">
                                <div class="row">
                                    <div class="col-md-12">
                                        <div class="form-group">
                                            <a data-toggle="modal" data-target="#myModal" style="cursor: pointer">کد معرف</a>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-md-12">
                                <button type="submit" disabled id="BtnRegister" class="btn btn-register btn-block ">ثبت نام</button>
                            </div>
                        </div>
                        <div class="">
                            <div class="form-group">
                                <div class="col-md-12">
                                    <p>قبلا ثبت نام کرده اید؟ <a href="<?php echo e(route('Login')); ?>">ورود</a></p>
                                </div>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>

    <!-- Modal -->
    <div class="modal fade" id="myModal" role="dialog">
        <div class="modal-dialog modal-sm">

            <!-- Modal content-->
            <div class="modal-content">
                <div class="modal-header">
                    <button type="button" class="close" data-dismiss="modal">&times;</button>
                    <h4 class="modal-title">کد معرف<span>(با دعوت کردن از دوستان خود در رنت، پولدار شوید!!!)</span></h4>
                </div>
                <div class="modal-body">
                    <div class="row">
                        <div class="col-md-12">
                            <div class="form-group">
                                <input type="text" name="code_reagent" tabindex="1" value="<?php echo e(session('reagent_code')); ?>" class="form-control primary input-sm" dir="rtl" id="InputCodeReagent" placeholder="کد معرفت رو وارد کن!">
                                <span class="error-code"></span>
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-md-12">
                            <button type="button" class="btn btn-register btn-block btn-reagent-code" data-dismiss="modal">ثبت</button>
                        </div>
                    </div>
                </div>
            </div>

        </div>
    </div>

    <!-- Modal -->

















<?php $__env->stopSection(); ?>

<?php $__env->startSection('script'); ?>

    <script type="text/javascript">



    </script>

    <script>
        $(document).ready(function (e) {

            
            $('#InputCheckRule').click(function () {
                if($('#InputCheckRule:checked').length == 1) {
                    $('#BtnRegister').attr('disabled', false);
                } else {
                    $('#BtnRegister').attr('disabled', true);
                }
            });
            $.ajaxSetup({
                headers: {
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                }
            });
            /*
             * recaptcah
             * */

            $("body").delegate("#captcha","click",function (e) {
                e.preventDefault();

                $('.captcha-button').find('i').addClass('fa-spin');

                $.ajax({
                    url:'<?php echo e(route('Captcha')); ?>',
                    type:'get',
                    success:function(data) {
                        $('.captcha-button').find('i').removeClass('fa-spin');
                        $('.captcha').html(data);
                    }
                });

            });



            $('#InputCodeReagent').keyup(function() {
                $('.error-code').html('');
                console.log(this.value);
                if (this.value.length >= 4) {
                    var code = this.value;
                    var img = '<img class="loading-img-reagent" src="http://safirdic.com/backend/img/img_loading/orange_circles.gif" />';
                    $('.error-code').html(img);
                    setTimeout(function () {

                    }, 1000);

                    $.ajax({
                        url: "<?php echo e(route('ReagentCode')); ?>",
                        method: "post",
                        data: {
                            code: code,
                        },
                    }).done(function (returnData) {
                        console.log(returnData);
                        if(returnData == 0) {
                            $('.error-code').html('کد نا معتبر');
                            $('.error-code').css('color', 'red');
                        } else {
                            $('.error-code').html(returnData);
                            $('.error-code').css('color', 'green');
                        }
                    });
                }
            });

            $('.btn-reagent-code').click(function () {
                var code = $('#InputCodeReagent').val();
                $.ajax({
                    url: "<?php echo e(route('RegisterReagentCode')); ?>",
                    method: "post",
                    data: {
                        code: code,
                    },
                }).done(function (returnData) {
                    if(returnData == 1) {
                        AlertCode('ثبت با موفقیت انجام شد', 'success');
                    } else {
                        AlertCode('خطا در وارد کردن کد معرف، لطفا دوباره تلاش نمایید', 'warning');
                    }
                });
            });
        });



        function AlertCode(message, status) {
            $.Toast("<p>کد معرف</p>", "<p>"+ message +" .</p>", ""+ status +"", {
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
    </script>
<?php $__env->stopSection(); ?>
<?php echo $__env->make('backend.MasterPage.Auth', array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>