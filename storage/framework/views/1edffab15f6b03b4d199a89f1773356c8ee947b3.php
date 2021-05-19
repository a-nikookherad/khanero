
<?php $__env->startSection('title',TitlePage('ویرایش پروفایل')); ?>
<?php $__env->startSection('style'); ?>
    <link rel="stylesheet" href="<?php echo e(asset('backend/css/datepicker.css')); ?>">
    <link rel="stylesheet" href="<?php echo e(asset('backend/css/bootstrap-datepicker.min.css')); ?>"/>
    <link rel="stylesheet" href="<?php echo e(asset('backend/assets/crop-image/css/picedit.min.css')); ?>"/>
    <style>
        .btn-file {
            position: relative;
            overflow: hidden;
        }

        .btn-file input[type=file] {
            position: absolute;
            top: 0;
            right: 0;
            min-width: 100%;
            min-height: 100%;
            font-size: 100px;
            text-align: right;
            filter: alpha(opacity=0);
            opacity: 0;
            outline: none;
            background: white;
            cursor: inherit;
            display: block;
        }

        .alert p {
            line-height: 25px;
        }

        .img-profile {
            width: 50%;
            border-radius: 50%;
            padding: 3px;
            /*box-shadow: 0px 0px 19px #ff6c60;*/
        }

        span.alert-input {
            color: #ff6c60;
            font-size: 11px;
        }
        li.li-profile {
            background: #ffe9cf;
        }
    </style>
<?php $__env->stopSection(); ?>

<?php $__env->startSection('content'); ?>
    <div class="row back-url">
        <div class="col-md-12">
            <?php if(auth()->user()->role_id != 1): ?>
                <a class="" href="<?php echo e(route('UserDashboard')); ?>">صفحه اصلی</a>
            <?php else: ?>
                <a class="" href="<?php echo e(route('AdminDashboard')); ?>">صفحه اصلی</a>
            <?php endif; ?>
            <span class="now-url"> / ویرایش پروفایل</span>
        </div>
    </div>

    <div class="row">
        <div class="col-md-12">
            <?php echo $__env->make('message.Message', array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>
            <?php echo $__env->make('message.ErrorReporting', array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>
        </div>
    </div>
    <div class="row">
        <div class="col-md-12">
            <div class="panel panel-default">
                <div class="panel-heading">
                    <h3 class="panel-title">ویرایش پروفایل</h3>
                    
                    
                    
                    
                </div>
                <div class="panel-body">
                    <ul id="myTab" class="nav nav-tabs">
                        <li class="<?php if(!$errors->has('password')): ?> active <?php endif; ?>">
                            <a href="#profile_tab" data-toggle="tab"><i class="fa fa-home"></i>اطلاعات کاربری</a>
                        </li>
                        <li class="<?php if($errors->has('password')): ?> active <?php endif; ?>">
                            <a href="#settings_tab" data-toggle="tab"><i class="fa fa-gears"></i>تنظیمات رمز ورود</a>
                        </li>
                        <?php if(auth()->user()->role_id != 1): ?>
                            <li class="">
                                <a href="#special_tab" data-toggle="tab"><i class="fa fa-gears"></i>ارسال مدارک</a>
                            </li>
                        <?php endif; ?>
                        <li class="">
                            <a href="#profile_completed_tab" data-toggle="tab"><i class="fa fa-user"></i>نمایه</a>
                        </li>
                    </ul>
                    <div id="myTabContent" class="tab-content">
                        <div class="tab-pane fade <?php if(!$errors->has('password')): ?> active in <?php endif; ?>" id="profile_tab">
                            <form role="form" action="<?php echo e(route('UpdateUser')); ?>" method="post"
                                  enctype="multipart/form-data" id="">
                                <?php echo e(csrf_field()); ?>

                                <div class="row">
                                    <div class="each-item col-md-3">
                                            <label class="title-S" for="InputFirstName">نام</label>
                                            <input type="text" name="first_name" value="<?php echo e($userModel->first_name); ?>"
                                                   class="each-Qt form-control primary input-sm" dir="rtl" id="InputFirstName"
                                                   placeholder="نام را وارد کنید" autofocus>
                                            <?php if($errors->has('first_name')): ?>
                                                <span style="color:red;"><?php echo e($errors->first('first_name')); ?></span>
                                            <?php endif; ?>
                                    </div>
                                    <div class="each-item col-md-3">
                                            <label class="title-S" for="InputLastName">نام خانوادگی</label>
                                            <input type="text" name="last_name" value="<?php echo e($userModel->last_name); ?>"
                                                   class="each-Qt form-control primary input-sm" dir="rtl" id="InputLastName"
                                                   placeholder="نام خانوادگی را وارد کنید">
                                            
                                            <?php if($errors->has('last_name')): ?>
                                                <span style="color:red;"><?php echo e($errors->first('last_name')); ?></span>
                                            <?php endif; ?>
                                    </div>
                                    <div class="each-item col-md-3">
                                            <label class="title-S" for="InputMobile">تلفن همراه</label>
                                            <input type="text" name="mobile" readonly value="<?php echo e($userModel->mobile); ?>"
                                                   class="each-Qt form-control primary input-sm" dir="rtl" id="InputMobile"
                                                   placeholder="شماره همراه را وارد کنید">
                                            
                                            <?php if($errors->has('mobile')): ?>
                                                <span style="color:red;"><?php echo e($errors->first('mobile')); ?></span>
                                            <?php endif; ?>
                                    </div>
                                    <div class="each-item col-md-3">
                                            <label class="title-S">جنسیت</label>
                                            <select class="each-Qt form-control" name="sex">
                                                <option value="1" <?php if($userModel->sex == 1): ?> selected <?php endif; ?>>مرد</option>
                                                <option value="2" <?php if($userModel->sex == 2): ?> selected <?php endif; ?>>زن</option>
                                            </select>
                                    </div>
                                    <div class="each-item col-md-3">
                                            <label class="title-S">وضعیت تاهل</label>
                                            <select class="each-Qt form-control" name="marital_status">
                                                <option value="1" <?php if($userModel->marital_status == 1): ?> selected <?php endif; ?>>
                                                    مجرد
                                                </option>
                                                <option value="2" <?php if($userModel->marital_status == 2): ?> selected <?php endif; ?>>
                                                    متاهل
                                                </option>
                                            </select>
                                    </div>
                                    <div class="each-item col-md-3">
                                            <label class="title-S" for="InputNtCode">کد ملی</label>
                                            <input type="text" name="nt_code" value="<?php echo e($userModel->nt_code); ?>"
                                                   class="each-Qt form-control primary input-sm" dir="rtl" id="InputNtCode"
                                                   placeholder="کد ملی را وارد کنید">
                                            <?php if($errors->has('nt_code')): ?>
                                                <span style="color:red;"><?php echo e($errors->first('nt_code')); ?></span>
                                            <?php endif; ?>
                                    </div>
                                    <div class="each-item col-md-3">
                                            <label class="title-S" for="InputNtCode">شماره شناسنامه</label>
                                            <input type="text" name="n_number" value="<?php echo e($userModel->n_number); ?>"
                                                   class="each-Qt form-control primary input-sm" dir="rtl" id="InputNtCode"
                                                   placeholder="شماره شناسنامه را وارد کنید">
                                            <?php if($errors->has('n_number')): ?>
                                                <span style="color:red;"><?php echo e($errors->first('n_number')); ?></span>
                                            <?php endif; ?>
                                    </div>
                                    <div class="each-item col-md-3">
                                            <label class="title-S" for="InputJob">شغل</label>
                                            <input type="text" name="job" value="<?php echo e($userModel->job); ?>"
                                                   class="each-Qt form-control primary input-sm" dir="rtl" id="InputJob"
                                                   placeholder="شغل را وارد کنید">
                                            <?php if($errors->has('job')): ?>
                                                <span style="color:red;"><?php echo e($errors->first('job')); ?></span>
                                            <?php endif; ?>
                                    </div>
                                    <div class="each-item col-md-3">
                                            <label class="title-S" for="InputEmail">ایمیل</label>
                                            <input type="text" name="email" value="<?php echo e($userModel->email); ?>"
                                                   class="each-Qt form-control primary input-sm" dir="rtl" id="InputEmail"
                                                   placeholder="ایمیل را وارد کنید">
                                            <?php if($errors->has('email')): ?>
                                                <span style="color:red;"><?php echo e($errors->first('email')); ?></span>
                                            <?php endif; ?>
                                    </div>
                                    <div class="each-item col-md-3">
                                        <label class="title-S" for="InputBirthDate">تاریخ تولد</label>
                                        <?php (
                                            $birth_date = \Morilog\Jalali\Facades\jDate::forge($userModel->birth_date)->format('Y/m/d')
                                        ); ?>
                                        <input type="text" name="birth_date" autocomplete="off"
                                               value="<?php if($userModel->birth_date == null): ?> انتخاب کنید <?php else: ?> <?php echo e($birth_date); ?> <?php endif; ?>"
                                               class="each-Qt form-control primary input-sm" readonly
                                               style="cursor: pointer;" dir="rtl" id="InputBirthDate"
                                               placeholder="تاریخ تولد خود را وارد کنید">
                                        <?php if($errors->has('birth_date')): ?>
                                            <span style="color:red;"><?php echo e($errors->first('birth_date')); ?></span>
                                        <?php endif; ?>
                                    </div>
                                    <div class="each-item col-md-3">
                                                <label class="title-S"><span class="nececery">*</span>استان</label>
                                                <select id="SelectProvince" name="" value="<?php echo e(old('province_id')); ?>"
                                                        class="each-Qt form-control">
                                                    <option value="0" hidden>انتخاب کنید</option>
                                                    <?php $__currentLoopData = $provinceModel; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $key => $value): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                                        <option value="<?php echo e($value->id); ?>"
                                                                <?php if($city->province_id == $value->id && auth()->user()->city_id != 0): ?> selected <?php endif; ?>>
                                                            <?php echo e($value->name); ?>

                                                        </option>
                                                    <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                                                </select>
                                                <?php if($errors->has('province_id')): ?>
                                                    <span style="color:red;"><?php echo e($errors->first('province_id')); ?></span>
                                                <?php endif; ?>
                                    </div>
                                    <div class="each-item col-md-3">
                                            <label class="title-S"><span class="nececery">*</span>شهر</label>
                                            <select id="SelectTownship" name="city_id" value="<?php echo e(old('city_id')); ?>"
                                                    class="each-Qt form-control">
                                                <option value="0" hidden>انتخاب کنید</option>
                                                <?php $__currentLoopData = $cityModel; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $key => $value): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                                    <option value="<?php echo e($value->id); ?>"
                                                            <?php if($city->id == $value->id && auth()->user()->city_id != 0): ?> selected <?php endif; ?>>
                                                        <?php echo e($value->name); ?>

                                                    </option>
                                                <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                                            </select>
                                            <?php if($errors->has('city_id')): ?>
                                                <span style="color:red;"><?php echo e($errors->first('city_id')); ?></span>
                                            <?php endif; ?>
                                    </div>
                                    <div class="each-item col-md-9">
                                            <label class="title-S" for="InputAddress">آدرس</label>
                                            <input type="text" name="address" value="<?php echo e($userModel->address); ?>"
                                                   class="each-Qt form-control primary input-sm" dir="rtl" id="InputAddress"
                                                   placeholder="آدرس را وارد کنید">
                                            <?php if($errors->has('address')): ?>
                                                <span style="color:red;"><?php echo e($errors->first('address')); ?></span>
                                            <?php endif; ?>
                                    </div>
                                    <div class="each-item col-md-3">
                                            <label class="title-S" for="InputInstagram">آی دی اینستاگرام</label>
                                            <input type="text" name="instagram" value="<?php echo e($userModel->instagram); ?>"
                                                   class="each-Qt form-control primary input-sm" dir="rtl" id="InputInstagram"
                                                   placeholder="آی دی اینستاگرام را وارد کنید">
                                            <?php if($errors->has('instagram')): ?>
                                                <span style="color:red;"><?php echo e($errors->first('instagram')); ?></span>
                                            <?php endif; ?>
                                    </div>
                                </div>
                                <br/>
                                <div class="row">

                                </div>
                                <br/>
                                <div class="row">
                                    <div class="col-md-12">
                                        
                                    </div>
                                </div>
                                <br/>
                                <div class="row">
                                    <div class="col-md-12">
                                        <button type="submit" id="BtnRegister" class="btn btn-green regstr-btn regstr-btn ">ثبت
                                            اطلاعات
                                        </button>
                                    </div>
                                </div>
                            </form>
                        </div>

                        <div class="tab-pane fade " id="profile_completed_tab">
                            <form role="form" action="<?php echo e(route('UpdateUser')); ?>" method="post"
                                  enctype="multipart/form-data" id="">
                                <?php echo e(csrf_field()); ?>

                                <input type="hidden" value="1" name="image_form">
                                <div class="row">
                                    <div class="col-md-2">
                                        <div class="form-group">
                                            <label for="InputImg">تصویر</label>
                                            <br/>
                                            <span class="btn btn-danger btn-file btn-select-img">
												انتخاب کنید
												 <input type="file" onchange="readURLAvarat(this)" name="img"
                                                        id="InputImg"/>
                                            </span>
                                        </div>
                                    </div>
                                    <div class="col-md-2">
                                        <div id="ExtraBoxUpload">
                                            <?php if(auth()->user()->avatar == 'default-user.png'): ?>
                                                <img id="" class="img-profile" src="<?php echo e(asset('backend/img/avatar.png')); ?>" alt="">
                                            <?php else: ?>
                                                <img id="" class="img-profile" src="<?php echo e(asset('Uploaded/User/Profile/'.auth()->user()->avatar)); ?>" alt="">
                                            <?php endif; ?>
                                        </div>
                                    </div>
                                    <div class="col-md-12">
                                        <div class="form-group">
                                            <label for="InputAbout">درباره خودتان</label>
                                            <textarea name="about" rows="6"
                                                      class="form-control primary input-sm" dir="rtl"
                                                      id="InputAbout"
                                                      placeholder="اهل سفر / اهل طبیعت / ..."><?php echo e(old('about', $userModel->about)); ?></textarea>
                                            <?php if($errors->has('about')): ?>
                                                <span style="color:red;"><?php echo e($errors->first('about')); ?></span>
                                            <?php endif; ?>
                                        </div>
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="col-md-12">
                                        <button type="submit" id="BtnRegister" class="btn btn-green regstr-btn ">ثبت
                                            اطلاعات
                                        </button>
                                    </div>
                                </div>
                            </form>
                        </div>

                        <div class="tab-pane fade" id="special_tab">
                            <form action="<?php echo e(route('UpdateConfirmUser')); ?>" id="ConfirmUser" method="post" enctype="multipart/form-data">
                                <?php echo e(csrf_field()); ?>

                                <div class="row">
                                    <div class="each-item col-md-3">
                                        <div class="form-group">
                                            <label class="title-S" for="SelectConfirmUser">مدرک</label>
                                            <select id="SelectConfirmUser" class="each-Qt form-control" name="type">
                                                <option value="0" hidden>انتخاب کنید</option>
                                                <?php $__currentLoopData = DocumentsHost(); $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $key => $value): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                                    <option value="<?php echo e($value['id']); ?>"><?php echo e($value['name']); ?></option>
                                                <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                                            </select>
                                        </div>
                                    </div>
                                    <div class="each-item col-md-3">
                                        <label for="InputFile" class="title-S">فایل انتخابی</label>
                                        <input type="file" name="file" id="InputFile">
                                    </div>

                                    <div class="col-md-12">
                                        <br/>
                                        <div class="form-group">
                                            <input type="submit" id="BtnConfirmUserSpecial" value="ثبت اطلاعات"
                                                   class="btn btn-green regstr-btn"/>
                                        </div>
                                    </div>
                                </div>
                            </form>
                            <div class="row">
                                <?php $__currentLoopData = $userModel->getDocument; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $key => $value): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                    <div class="col-md-3">
                                        <img style="width: 100%" src="<?php echo e(asset('Uploaded/Document/File/'.$value->file)); ?>" />
                                        <p class="text-center"><?php echo e(GetTypeDocument($value->type)); ?></p>
                                    </div>
                                <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                            </div>
                        </div>


                        <div class="tab-pane fade <?php if($errors->has('password')): ?> active in <?php endif; ?>" id="settings_tab">
                            <form action="<?php echo e(route('ResetPassword')); ?>" method="post" id="FormResetPassword">
                                <?php echo e(csrf_field()); ?>

                                <div class="row">
                                    <div class="each-item col-md-4">
                                            <label class="title-S" for="InputNewPassword"><span class="nececery">*</span>رمز  فعلی</label>
                                            <input type="password" name="password" class="each-Qt form-control primary input-sm"
                                                   dir="rtl" id="InputNewPassword"
                                                   placeholder="رمز عبور فعلی را وارد کنید">
                                    </div>
                                    <div class="each-item col-md-4">
                                            <label class="title-S" for="InputNewPassword"><span class="nececery">*</span>رمز عبور جدید</label>
                                            <input type="password" name="password" class="each-Qt form-control primary input-sm"
                                                   dir="rtl" id="InputNewPassword"
                                                   placeholder="رمز عبور جدید را وارد کنید">
                                            <?php if($errors->has('password')): ?>
                                                <span style="color:red;"><?php echo e($errors->first('password')); ?></span>
                                            <?php endif; ?>
                                    </div>
                                    <div class="each-item col-md-4">
                                            <label class="title-S" for="InputNewConfirmPassword"><span class="nececery">*</span>تکرار رمز عبور</label>
                                            <input type="password" name="confirm_password"
                                                   class="each-Qt form-control primary input-sm" dir="rtl"
                                                   id="InputNewConfirmPassword"
                                                   placeholder="تکرار رمز عبور را وارد کنید">
                                            <span class="" style="color: red;" id="span-alert-password-confirm"></span>
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="col-md-12">
                                        <div class="form-group">
                                            <input type="button" id="BtnChangePassword" value="ثبت ویرایش"
                                                   class="btn btn-green regstr-btn"/>
                                        </div>
                                    </div>
                                </div>
                            </form>
                            <form method="post" accept-charset="utf-8" name="form1">
                                <input name="hidden_data" id='hidden_data' type="hidden"/>
                            </form>
                        </div>

                    </div>
                </div>
            </div>
        </div>
    </div>
<?php $__env->stopSection(); ?>

<?php $__env->startSection('script'); ?>
    <script type="text/javascript" src="<?php echo e(asset('backend/js/number.js')); ?>"></script>

    <script src="<?php echo e(asset('backend/js/bootstrap-datepicker.min.js')); ?>"></script>
    <script src="<?php echo e(asset('backend/js/bootstrap-datepicker.fa.min.js')); ?>"></script>
    <script type="text/javascript">

        $("#InputBirthDate").datepicker({
            changeMonth: true,
            changeYear: true,
            isRTL: true,
            dateFormat: "yy/mm/dd",
            EnableTimePicker: true,
            yearRange: '1327:1397',
            defaultDate: '1370/01/01',
        });

        //get township
        $("body").delegate("#SelectProvince", "change", function (e) {

            var id = $(this).val();
            getTownship(id);
        });

        //get township
        function getTownship(id) {
            $.ajaxSetup({
                headers: {
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                }
            });
            $.ajax({
                url: '<?php echo e(route('GetAjaxTownship')); ?>',
                type: 'post',
                data: {
                    id: id
                },
                success: function (data) {
                    $("#SelectTownship").html(data);
                }
            });
        }

        $(document).ready(function () {

            $("#InputBirthDate").datepicker({
                minDate: 0,
                changeMonth: true,
                changeYear: true,
                isRTL: true,
                dateFormat: "yy/mm/dd",
                EnableTimePicker: true,
            });

            /* -_-_-_-_-_-_-_-_-_-_-_-_-_-_-_-_-_-_-_-_-_-_-_-_-_-_-_-_-_-_-_-_- */

            $("#BtnChangePassword").click(function () {
                var InputNewPassword = $('#InputNewPassword').val();
                var InputNewConfirmPassword = $('#InputNewConfirmPassword').val();
                if (InputNewPassword != InputNewConfirmPassword) {
                    $('#span-alert-password-confirm').text('مقدار رمز ورود و تکرار آن باید یکی باشد .');
                } else {
                    $('#FormResetPassword').submit();
                }
            });

        });

    </script>

    <script type="text/javascript" src="<?php echo e(asset('backend/assets/crop-image/js/picedit.min.js')); ?>"></script>
    <script type="text/javascript">
        $(function () {
            $('#thebox').picEdit({
                imageUpdated: function (img) {
                },
                formSubmitted: function () {
                },
                redirectUrl: false,
                defaultImage: false
            });
        });

        $('.btn-select-img').click(function () {
            $.ajax({
                url: '<?php echo e(route('CreateBoxUploadImageProfile')); ?>',
                type: 'get',
                success: function (data) {
                    // $('#ExtraBoxUpload').html(data);
                }
            });
        });

        function readURL(input) {
            if (input.files && input.files[0]) {
                var reader = new FileReader();
                reader.onload = function (e) {
                    $('#ImageNationalCard').attr('src', e.target.result);
                };
                reader.readAsDataURL(input.files[0]);
            }
        }

        function readURLAvarat(input) {
            if (input.files && input.files[0]) {
                var reader = new FileReader();
                reader.onload = function (e) {
                    $('.img-profile').attr('src', e.target.result);
                };
                reader.readAsDataURL(input.files[0]);
            }
        }

    </script>
<?php $__env->stopSection(); ?>
<?php echo $__env->make('backend.MasterPage.Layout', array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>