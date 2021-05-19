
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
                        <li class="<?php if(!$errors->has('password')): ?> active <?php endif; ?>"><a href="#profile_tab"
                                                                                    data-toggle="tab"><i
                                        class="fa fa-home"></i> پروفایل</a></li>
                        
                        <li class=""><a href="#special_tab" data-toggle="tab"><i class="fa fa-gears"></i> کاربر تایید
								شده <?php if($userModel->confirm_user == -1): ?> <span class="text-danger">*</span> <?php endif; ?></a></li>
                        <li class="<?php if($errors->has('password')): ?> active <?php endif; ?>"><a href="#settings_tab"
                                                                                   data-toggle="tab"><i
                                        class="fa fa-gears"></i> تنظیمات رمز ورود</a></li>
                    </ul>
                    <div id="myTabContent" class="tab-content">


                        <div class="tab-pane fade <?php if(!$errors->has('password')): ?> active in <?php endif; ?>" id="profile_tab">
                            <form role="form" action="<?php echo e(route('UpdateUser')); ?>" method="post"
                                  enctype="multipart/form-data" id="">
                                <?php echo e(csrf_field()); ?>

                                <div class="row">
                                    <div class="col-md-3">
                                        <div class="form-group">
                                            <label for="InputFirstName">نام</label><span style="font-size: 18px;"
                                                                                         class="text-danger">*</span>
                                            <input type="text" name="first_name" value="<?php echo e($userModel->first_name); ?>"
                                                   class="form-control primary input-sm" dir="rtl" id="InputFirstName"
                                                   placeholder="نام را وارد کنید" autofocus>
                                            <?php if($errors->has('first_name')): ?>
                                                <span style="color:red;"><?php echo e($errors->first('first_name')); ?></span>
                                            <?php endif; ?>
                                        </div>
                                    </div>
                                    <div class="col-md-3">
                                        <div class="form-group">
                                            <label for="InputLastName">نام خانوادگی</label><span
                                                    style="font-size: 18px;" class="text-danger">*</span>
                                            <input type="text" name="last_name" value="<?php echo e($userModel->last_name); ?>"
                                                   class="form-control primary input-sm" dir="rtl" id="InputLastName"
                                                   placeholder="نام خانوادگی را وارد کنید">
                                            <span class="alert-input">تنها پس از نهایی شدن رزرو برای مهمان-میزبان نشان داده میشود</span>
                                            <?php if($errors->has('last_name')): ?>
                                                <span style="color:red;"><?php echo e($errors->first('last_name')); ?></span>
                                            <?php endif; ?>
                                        </div>
                                    </div>
                                    <div class="col-md-3">
                                        <div class="form-group">
                                            <label for="InputMobile">تلفن همراه</label><span style="font-size: 18px;"
                                                                                             class="text-danger">*</span>
                                            <input type="text" name="mobile" readonly value="<?php echo e($userModel->mobile); ?>"
                                                   class="form-control primary input-sm" dir="rtl" id="InputMobile"
                                                   placeholder="شماره همراه را وارد کنید">
                                            <span class="alert-input">این شماره نام کاربری شما برای ورود به سیستم می باشد</span>
                                            <?php if($errors->has('mobile')): ?>
                                                <span style="color:red;"><?php echo e($errors->first('mobile')); ?></span>
                                            <?php endif; ?>
                                        </div>
                                    </div>
                                    <div class="col-md-3">
                                        <label for="InputBirthDate">تاریخ تولد</label><span style="font-size: 18px;"
                                                                                            class="text-danger">*</span>
                                        <?php (
                                            $birth_date = \Morilog\Jalali\Facades\jDate::forge($userModel->birth_date)->format('Y/m/d')
                                        ); ?>
                                        <input type="text" name="birth_date" autocomplete="off"
                                               value="<?php if($userModel->birth_date == null): ?> انتخاب کنید <?php else: ?> <?php echo e($birth_date); ?> <?php endif; ?>"
                                               class="form-control primary input-sm" readonly
                                               style="cursor: pointer;" dir="rtl" id="InputBirthDate"
                                               placeholder="تاریخ تولد خود را وارد کنید">
                                        <span class="alert-input">محرمانه - برای تحلیل های آماری و هدایا</span>
                                        <?php if($errors->has('birth_date')): ?>
                                            <span style="color:red;"><?php echo e($errors->first('birth_date')); ?></span>
                                        <?php endif; ?>
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="col-md-3">
                                        <label>جنسیت</label><span style="font-size: 18px;" class="text-danger">*</span>
                                        <div class="">
                                            <label for="InputMan" style="cursor: pointer;">مرد</label>
                                            <input type="radio" name="sex" id="InputMan" value="1"
                                                   <?php if($userModel->sex == 1): ?> checked <?php endif; ?> />
                                            &nbsp;
                                            <label for="InputWoman" style="cursor: pointer;">زن</label>
                                            <input type="radio" name="sex" id="InputWoman" value="2"
                                                   <?php if($userModel->sex == 2): ?> checked <?php endif; ?> />
                                        </div>
                                    </div>
                                    <div class="col-md-3">
                                        <div class="">
                                            <div class="form-group">
                                                <label>استان</label><span style="font-size: 18px;"
                                                                          class="text-danger">*</span>
                                                <select id="SelectProvince" name="" value="<?php echo e(old('province_id')); ?>"
                                                        class="form-control input-sm">
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
                                        </div>
                                    </div>
                                    <div class="col-md-3">
                                        <div class="">
                                            <div class="form-group">
                                                <label>شهر</label><span style="font-size: 18px;"
                                                                        class="text-danger">*</span>
                                                <select id="SelectTownship" name="city_id" value="<?php echo e(old('city_id')); ?>"
                                                        class="form-control input-sm">
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
                                        </div>
                                    </div>
                                </div>
                                <br/>
                                <div class="row">
                                    <div class="col-md-2">
                                        <div class="form-group">
                                            <label for="InputImg">تصویر</label>
                                            <br/>
                                            <span class="btn btn-danger btn-file btn-select-img">
												انتخاب کنید
												 <input type="file" onchange="readURLAvarat(this)" name="img" id="InputImg"/>
                                            </span>
                                        </div>
                                    </div>
                                    <div class="col-md-2">
                                        <?php 
                                            if(auth()->user()->avatar != '') {
                                                $avatar = auth()->user()->avatar;
                                            } else {
                                                $avatar = 'default-user.png';
                                            }
                                         ?>
                                        <div id="ExtraBoxUpload">
                                            <img id="" class="img-profile"
                                                 src="<?php echo e(asset('Uploaded/User/Profile').'/'.$avatar); ?>" alt="">
                                        </div>
                                    </div>
                                </div>
                                <br/>
                                <div class="row">
                                    <div class="col-md-12">
                                        <span class="alert-input">لطفا تصویری از چهره خود آپلود کنید. کاربران با مشاهده چهره واقعی شما به عنوان مهمان-میزبان به شما بیشتر اعتماد می کنند</span>
                                    </div>
                                </div>
                                <br/>
                                <div class="row">
                                    <div class="col-md-12">
                                        <button type="submit" id="BtnRegister" class="btn btn-green btn-block ">ثبت
                                            اطلاعات
                                        </button>
                                    </div>
                                </div>
                            </form>
                        </div>

                        
                        
                        
                        
                        
                        

                        <div class="tab-pane fade" id="special_tab">
							<?php if($userModel->confirm_user == 0): ?>
								<div class="row">
									<div class="col-md-12">
										<div class="alert alert-info">
											<p>
												ابتدا باید پروفایل را تکمیل کنید
											</p>
										</div>
										<div class="alert alert-success">

											<div class="row">
												<div class="col-md-12">
													شما با پرکردن فیلد کاربر تایید شده تا 24 ساعت می توانید به کاربر
													تایید
													شده تبدیل شوید (حتما فیلدهای ستاره دار را پر کنید)
												</div>
												<br/>
												<div class="col-md-6">
													<p>

													<h5>کاربر عادی</h5>  <br/> امکان رزرو اقامتگاه های سایت به عموان
													مهمان <br/>
													فقط امکان ثبت اقامتگاه <br/> امکان گفت و گو با سایر کاربران <br/>
													افزودن به
													لیست مورد علاقه های من <br/> استفاده دعوت از دوستان و پولدار شدن
													<br/>


													</p>
												</div>

												<div class="col-md-6">
													<p>
													<h5>کاربر تایید شده</h5> <br/> سطوح کاربری عادی +<br/> امکان ثبت و
													انتشار
													اقامتگاه خود به عنوان میزبان <br/> بالا رفتن اعتماد کاربران به شما
													<br/>
													چنانچه مهمانی تایید شده باشید احتمال تایید درخواست رزرو بیشتر است
													</p>

												</div>
											</div>
										</div>
									</div>
								</div>
							<?php elseif($userModel->confirm_user == 1): ?>
								<form action="<?php echo e(route('UpdateConfirmUser')); ?>" id="ConfirmUser" method="post"
									  enctype="multipart/form-data">
									<?php echo e(csrf_field()); ?>

									<div class="row">
										<div class="col-md-12">
											<div class="alert alert-success">

												<div class="row">
													<div class="col-md-12">
														شما با پرکردن فیلد کاربر تایید شده تا 24 ساعت می توانید به کاربر
														تایید
														شده تبدیل شوید (حتما فیلدهای ستاره دار را پر کنید)
													</div>
													<br/>
													<div class="col-md-6">
														<p>

														<h5>کاربر عادی</h5>  <br/> امکان رزرو اقامتگاه های سایت به عموان
														مهمان <br/>
														فقط امکان ثبت اقامتگاه <br/> امکان گفت و گو با سایر کاربران
														<br/> افزودن به
														لیست مورد علاقه های من <br/> استفاده دعوت از دوستان و پولدار شدن
														<br/>


														</p>
													</div>

													<div class="col-md-6">

														<p>
														<h5>کاربر تایید شده</h5> <br/> سطوح کاربری عادی +<br/> امکان ثبت
														و انتشار
														اقامتگاه خود به عنوان میزبان <br/> بالا رفتن اعتماد کاربران به
														شما
														<br/>
														چنانچه مهمانی تایید شده باشید احتمال تایید درخواست رزرو بیشتر
														است
														</p>

													</div>
												</div>
											</div>
										</div>
										<div class="col-md-3">
											<div class="">
												<div class="form-group">
													<label for="InputEmail">پست الکترونیکی</label>
													<input type="text" name="email"
														   value="<?php echo e(old('email', $userModel->email)); ?>"
														   class="form-control primary input-sm" dir="rtl"
														   id="InputEmail"
														   placeholder="ایمیل خود را وارد کنید">
													<span class="alert-input">محرمانه</span>
													<?php if($errors->has('email')): ?>
														<span style="color:red;"><?php echo e($errors->first('email')); ?></span>
													<?php endif; ?>
												</div>
											</div>
										</div>
										<div class="col-md-3">
											<div class="form-group">
												<label for="InputTelephone">تلفن ثابت</label>
												<input type="text" name="telephone"
													   value="<?php echo e(old('telephone', $userModel->telephone)); ?>"
													   class="form-control primary input-sm" dir="rtl"
													   id="InputTelephone"
													   placeholder="تلفن ثابت خود را وارد کنید">
												<span class="alert-input">محرمانه - برای موارد خاص اگر در دسترس نباشید</span>
												<?php if($errors->has('telephone')): ?>
													<span style="color:red;"><?php echo e($errors->first('telephone')); ?></span>
												<?php endif; ?>
											</div>
										</div>
										<div class="col-md-6">
											<div class="form-group">
												<label for="InputAddress">آدرس</label>
												<input name="address" value="<?php echo e(old('address', $userModel->address)); ?>"
													   type="text"
													   class="form-control primary input-sm" dir="rtl" id="InputAddress"
													   placeholder="آدرس محل خود را وارد کنید">
												<span class="alert-input">محرمانه</span>
												<?php if($errors->has('address')): ?>
													<span style="color:red;"><?php echo e($errors->first('address')); ?></span>
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
												<span class="alert-input">"رنت" بر پایه روابط انسانی و بر اساس اعتماد متقابل شکل گرفته است</span>
												<?php if($errors->has('about')): ?>
													<span style="color:red;"><?php echo e($errors->first('about')); ?></span>
												<?php endif; ?>
											</div>
										</div>
										<div class="col-md-3">
											<div class="form-group">
												<label for="InputMobileEmergency">شماره تماس اضطراری</label><span
														style="font-size: 18px;" class="text-danger">*</span>
												<input name="emergency"
													   value="<?php echo e(old('emergency', $userModel->emergency)); ?>" type="text"
													   class="form-control primary input-sm" dir="rtl"
													   id="InputMobileEmergency"
													   placeholder="شماره تماس اضطراری خود را وارد کنید">
												<span class="alert-input">محرمانه - برای مواقع اضطراری</span>
												<?php if($errors->has('emergency')): ?>
													<span style="color:red;"><?php echo e($errors->first('emergency')); ?></span>
												<?php endif; ?>
											</div>
										</div>
										<div class="col-md-3">
											<div class="form-group">
												<label for="InputLanguage">زبان خارجه</label>
												<input name="language"
													   value="<?php echo e(old('language', $userModel->language)); ?>" type="text"
													   class="form-control primary input-sm" dir="rtl"
													   id="InputLanguage"
													   placeholder="ترکی / عربی / انگلیسی / ...">
												<span class="alert-input">به چه زبان هایی به جز فارسی میتوانید صحبت کنید</span>
												<?php if($errors->has('language')): ?>
													<span style="color:red;"><?php echo e($errors->first('language')); ?></span>
												<?php endif; ?>
											</div>
										</div>
										<div class="col-md-2">
											<div class="form-group">
												<label for="InputImgNationalCard">تصویر کارت ملی</label><span
														style="font-size: 18px;"
														class="text-danger">*</span>
												<br/>
												<span class="btn btn-danger btn-file">
                                            انتخاب کنید ...
                                            <input type="file" onchange="readURL(this)" name="img_national_card"
												   id="InputImgNationalCard"/>
                                        </span>
											</div>
										</div>
										<div class="col-md-4">

											<?php if($userModel->img_national_card != ''): ?>
												<img id="ImageNationalCard" style=""
													 src="<?php echo e(asset('Uploaded/User/Profile/').'/'.$userModel->img_national_card); ?>"
													 alt="">
											<?php else: ?>

												<img id="ImageNationalCard" style="width: 50%;"
													 src="<?php echo e(asset('Uploaded/User/NationalCard/').'/'.'default.png'); ?>"
													 alt="">
											<?php endif; ?>
										</div>
										<div class="col-md-12">
											<div class="form-group">
												<input type="submit" id="BtnConfirmUserSpecial" value="ثبت اطلاعات"
													   class="btn btn-green btn-block"/>
											</div>
										</div>
									</div>
								</form>
							<?php elseif($userModel->confirm_user == 2): ?>
								<div class="row">
									<div class="col-md-12">
										<div class="alert alert-warning">
											<p>
												پروفایل شما در حال بررسی می باشد، از صبر شما متشکریم.
											</p>
										</div>
									</div>
								</div>
							<?php elseif($userModel->confirm_user == 3): ?>
								<div class="row">
									<div class="col-md-12">
										<div class="alert alert-success">
											<p>
												تبریک! حساب کاربری شما توسط تیم رنت تایید شده است.
											</p>
										</div>
									</div>
								</div>

                                <form action="<?php echo e(route('UpdateConfirmUser')); ?>" id="ConfirmUser" method="post"
                                      enctype="multipart/form-data">
                                    <?php echo e(csrf_field()); ?>

                                    <input type="hidden" name="img_national_card"  value="0">
                                    <div class="row">
                                        <div class="col-md-3">
                                            <div class="">
                                                <div class="form-group">
                                                    <label for="InputEmail">پست الکترونیکی</label>
                                                    <input type="text" name="email"
                                                           value="<?php echo e(old('email', $userModel->email)); ?>"
                                                           class="form-control primary input-sm" dir="rtl"
                                                           id="InputEmail"
                                                           placeholder="ایمیل خود را وارد کنید">
                                                    <span class="alert-input">محرمانه</span>
                                                    <?php if($errors->has('email')): ?>
                                                        <span style="color:red;"><?php echo e($errors->first('email')); ?></span>
                                                    <?php endif; ?>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="col-md-3">
                                            <div class="form-group">
                                                <label for="InputTelephone">تلفن ثابت</label>
                                                <input type="text" name="telephone"
                                                       value="<?php echo e(old('telephone', $userModel->telephone)); ?>"
                                                       class="form-control primary input-sm" dir="rtl"
                                                       id="InputTelephone"
                                                       placeholder="تلفن ثابت خود را وارد کنید">
                                                <span class="alert-input">محرمانه - برای موارد خاص اگر در دسترس نباشید</span>
                                                <?php if($errors->has('telephone')): ?>
                                                    <span style="color:red;"><?php echo e($errors->first('telephone')); ?></span>
                                                <?php endif; ?>
                                            </div>
                                        </div>
                                        <div class="col-md-6">
                                            <div class="form-group">
                                                <label for="InputAddress">آدرس</label>
                                                <input name="address" value="<?php echo e(old('address', $userModel->address)); ?>"
                                                       type="text"
                                                       class="form-control primary input-sm" dir="rtl" id="InputAddress"
                                                       placeholder="آدرس محل خود را وارد کنید">
                                                <span class="alert-input">محرمانه</span>
                                                <?php if($errors->has('address')): ?>
                                                    <span style="color:red;"><?php echo e($errors->first('address')); ?></span>
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
                                                <span class="alert-input">"رنت" بر پایه روابط انسانی و بر اساس اعتماد متقابل شکل گرفته است</span>
                                                <?php if($errors->has('about')): ?>
                                                    <span style="color:red;"><?php echo e($errors->first('about')); ?></span>
                                                <?php endif; ?>
                                            </div>
                                        </div>
                                        <div class="col-md-3">
                                            <div class="form-group">
                                                <label for="InputMobileEmergency">شماره تماس اضطراری</label><span
                                                        style="font-size: 18px;" class="text-danger">*</span>
                                                <input name="emergency"
                                                       value="<?php echo e(old('emergency', $userModel->emergency)); ?>" type="text"
                                                       class="form-control primary input-sm" dir="rtl"
                                                       id="InputMobileEmergency"
                                                       placeholder="شماره تماس اضطراری خود را وارد کنید">
                                                <span class="alert-input">محرمانه - برای مواقع اضطراری</span>
                                                <?php if($errors->has('emergency')): ?>
                                                    <span style="color:red;"><?php echo e($errors->first('emergency')); ?></span>
                                                <?php endif; ?>
                                            </div>
                                        </div>
                                        <div class="col-md-3">
                                            <div class="form-group">
                                                <label for="InputLanguage">زبان خارجه</label>
                                                <input name="language"
                                                       value="<?php echo e(old('language', $userModel->language)); ?>" type="text"
                                                       class="form-control primary input-sm" dir="rtl"
                                                       id="InputLanguage"
                                                       placeholder="ترکی / عربی / انگلیسی / ...">
                                                <span class="alert-input">به چه زبان هایی به جز فارسی میتوانید صحبت کنید</span>
                                                <?php if($errors->has('language')): ?>
                                                    <span style="color:red;"><?php echo e($errors->first('language')); ?></span>
                                                <?php endif; ?>
                                            </div>
                                        </div>
                                        <div class="col-md-4">
                                            <?php if($userModel->img_national_card != ''): ?>
                                                <img id="ImageNationalCard" style=""
                                                     src="<?php echo e(asset('Uploaded/User/Profile/').'/'.$userModel->img_national_card); ?>"
                                                     alt="">
                                            <?php else: ?>

                                                <img id="ImageNationalCard" style="width: 50%;"
                                                     src="<?php echo e(asset('Uploaded/User/NationalCard/').'/'.'default.png'); ?>"
                                                     alt="">
                                            <?php endif; ?>
                                        </div>
                                        <div class="col-md-12">
                                            <div class="form-group">
                                                <input type="submit" id="BtnConfirmUserSpecial" value="ثبت اطلاعات"
                                                       class="btn btn-green btn-block"/>
                                            </div>
                                        </div>
                                    </div>
                                </form>
							<?php elseif($userModel->confirm_user == -1): ?>
								<div class="row">
									<div class="col-md-12">
										<div class="alert alert-danger">
											<p>
												درخواست شما پس از بررسی کارشناسان سایت به حالت معلق درامده است، لطفا پس از بررسی مجدد اطلاعات و ارسال دوباره کارت ملی خود دوباره تلاش کنید.
											</p>
										</div>
									</div>
								</div>
								<form action="<?php echo e(route('UpdateConfirmUser')); ?>" id="ConfirmUser" method="post"
									  enctype="multipart/form-data">
									<?php echo e(csrf_field()); ?>

									<div class="row">
										<div class="col-md-12">
											<div class="alert alert-success">

												<div class="row">
													<div class="col-md-12">
														شما با پرکردن فیلد کاربر تایید شده تا 24 ساعت می توانید به کاربر
														تایید
														شده تبدیل شوید (حتما فیلدهای ستاره دار را پر کنید)
													</div>
													<br/>
													<div class="col-md-6">
														<p>

														<h5>کاربر عادی</h5>  <br/> امکان رزرو اقامتگاه های سایت به عموان
														مهمان <br/>
														فقط امکان ثبت اقامتگاه <br/> امکان گفت و گو با سایر کاربران
														<br/> افزودن به
														لیست مورد علاقه های من <br/> استفاده دعوت از دوستان و پولدار شدن
														<br/>


														</p>
													</div>

													<div class="col-md-6">

														<p>
														<h5>کاربر تایید شده</h5> <br/> سطوح کاربری عادی +<br/> امکان ثبت
														و انتشار
														اقامتگاه خود به عنوان میزبان <br/> بالا رفتن اعتماد کاربران به
														شما
														<br/>
														چنانچه مهمانی تایید شده باشید احتمال تایید درخواست رزرو بیشتر
														است
														</p>

													</div>
												</div>
											</div>
										</div>
										<div class="col-md-3">
											<div class="">
												<div class="form-group">
													<label for="InputEmail">پست الکترونیکی</label>
													<input type="text" name="email"
														   value="<?php echo e(old('email', $userModel->email)); ?>"
														   class="form-control primary input-sm" dir="rtl"
														   id="InputEmail"
														   placeholder="ایمیل خود را وارد کنید">
													<span class="alert-input">محرمانه</span>
													<?php if($errors->has('email')): ?>
														<span style="color:red;"><?php echo e($errors->first('email')); ?></span>
													<?php endif; ?>
												</div>
											</div>
										</div>
										<div class="col-md-3">
											<div class="form-group">
												<label for="InputTelephone">تلفن ثابت</label>
												<input type="text" name="telephone"
													   value="<?php echo e(old('telephone', $userModel->telephone)); ?>"
													   class="form-control primary input-sm" dir="rtl"
													   id="InputTelephone"
													   placeholder="تلفن ثابت خود را وارد کنید">
												<span class="alert-input">محرمانه - برای موارد خاص اگر در دسترس نباشید</span>
												<?php if($errors->has('telephone')): ?>
													<span style="color:red;"><?php echo e($errors->first('telephone')); ?></span>
												<?php endif; ?>
											</div>
										</div>
										<div class="col-md-6">
											<div class="form-group">
												<label for="InputAddress">آدرس</label>
												<input name="address" value="<?php echo e(old('address', $userModel->address)); ?>"
													   type="text"
													   class="form-control primary input-sm" dir="rtl" id="InputAddress"
													   placeholder="آدرس محل خود را وارد کنید">
												<span class="alert-input">محرمانه</span>
												<?php if($errors->has('address')): ?>
													<span style="color:red;"><?php echo e($errors->first('address')); ?></span>
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
												<span class="alert-input">"رنت" بر پایه روابط انسانی و بر اساس اعتماد متقابل شکل گرفته است</span>
												<?php if($errors->has('about')): ?>
													<span style="color:red;"><?php echo e($errors->first('about')); ?></span>
												<?php endif; ?>
											</div>
										</div>
										<div class="col-md-3">
											<div class="form-group">
												<label for="InputMobileEmergency">شماره تماس اضطراری</label><span
														style="font-size: 18px;" class="text-danger">*</span>
												<input name="emergency"
													   value="<?php echo e(old('emergency', $userModel->emergency)); ?>" type="text"
													   class="form-control primary input-sm" dir="rtl"
													   id="InputMobileEmergency"
													   placeholder="شماره تماس اضطراری خود را وارد کنید">
												<span class="alert-input">محرمانه - برای مواقع اضطراری</span>
												<?php if($errors->has('emergency')): ?>
													<span style="color:red;"><?php echo e($errors->first('emergency')); ?></span>
												<?php endif; ?>
											</div>
										</div>
										<div class="col-md-3">
											<div class="form-group">
												<label for="InputLanguage">زبان خارجه</label>
												<input name="language"
													   value="<?php echo e(old('language', $userModel->language)); ?>" type="text"
													   class="form-control primary input-sm" dir="rtl"
													   id="InputLanguage"
													   placeholder="ترکی / عربی / انگلیسی / ...">
												<span class="alert-input">به چه زبان هایی به جز فارسی میتوانید صحبت کنید</span>
												<?php if($errors->has('language')): ?>
													<span style="color:red;"><?php echo e($errors->first('language')); ?></span>
												<?php endif; ?>
											</div>
										</div>
										<div class="col-md-2">
											<div class="form-group">
												<label for="InputImgNationalCard">تصویر کارت ملی</label><span
														style="font-size: 18px;"
														class="text-danger">*</span>
												<br/>
												<span class="btn btn-danger btn-file">
                                            انتخاب کنید ...
                                            <input type="file" onchange="readURL(this)" name="img_national_card"
												   id="InputImgNationalCard"/>
                                        </span>
											</div>
										</div>
										<div class="col-md-4">

											<?php if($userModel->img_national_card != ''): ?>
												<img id="ImageNationalCard" style=""
													 src="<?php echo e(asset('Uploaded/User/Profile/').'/'.$userModel->img_national_card); ?>"
													 alt="">
											<?php else: ?>

												<img id="ImageNationalCard" style="width: 50%;"
													 src="<?php echo e(asset('Uploaded/User/NationalCard/').'/'.'default.png'); ?>"
													 alt="">
											<?php endif; ?>
										</div>
										<div class="col-md-12">
											<div class="form-group">
												<input type="submit" id="BtnConfirmUserSpecial" value="ثبت اطلاعات"
													   class="btn btn-green btn-block"/>
											</div>
										</div>
									</div>
								</form>
							<?php endif; ?>
                        </div>


                        <div class="tab-pane fade <?php if($errors->has('password')): ?> active in <?php endif; ?>" id="settings_tab">
                            <form action="<?php echo e(route('ResetPassword')); ?>" method="post" id="FormResetPassword">
                                <?php echo e(csrf_field()); ?>

                                <div class="row">
                                    <div class="col-md-12">
                                        <div class="form-group">
                                            <label for="InputNewPassword">رمز عبور جدید</label><span
                                                    style="font-size: 18px;" class="text-danger">*</span>
                                            <input type="password" name="password" class="form-control primary input-sm"
                                                   dir="rtl" id="InputNewPassword"
                                                   placeholder="رمز عبور جدید را وارد کنید">
                                            <?php if($errors->has('password')): ?>
                                                <span style="color:red;"><?php echo e($errors->first('password')); ?></span>
                                            <?php endif; ?>
                                        </div>
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="col-md-12">
                                        <div class="form-group">
                                            <label for="InputNewConfirmPassword">تکرار رمز عبور</label><span
                                                    style="font-size: 18px;" class="text-danger">*</span>
                                            <input type="password" name="confirm_password"
                                                   class="form-control primary input-sm" dir="rtl"
                                                   id="InputNewConfirmPassword"
                                                   placeholder="تکرار رمز عبور را وارد کنید">
                                            <span class="" style="color: red;" id="span-alert-password-confirm"></span>
                                        </div>
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="col-md-12">
                                        <div class="form-group">
                                            <input type="button" id="BtnChangePassword" value="ثبت ویرایش"
                                                   class="btn btn-green btn-block"/>
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