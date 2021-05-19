
<?php $__env->startSection('title'); ?>
    <?php echo e(TitlePage('ویرایش '.$hostModel->name)); ?>

<?php $__env->stopSection(); ?>
<?php ($buildingTypeModel = App\Modules\Possibilities\Controllers\PossibilitiesController::GetBuildingType()); ?>
<?php ($homeTypeModel = App\Modules\Possibilities\Controllers\PossibilitiesController::GetHomeType()); ?>
<?php ($positionTypeModel = App\Modules\Possibilities\Controllers\PossibilitiesController::GetPositionType()); ?>
<?php ($optionModel = App\Modules\Possibilities\Controllers\PossibilitiesController::GetOption()); ?>
<?php ($rulesModel = App\Modules\Rules\Controllers\RulesController::GetRules()); ?>
<?php ($cancelRuleModel = App\Modules\Rules\Controllers\RulesController::GetCancelRules()); ?>
<?php $__env->startSection('style'); ?>
    <link rel="stylesheet" href="https://unpkg.com/leaflet@1.4.0/dist/leaflet.css"/>
    <link rel="stylesheet" href="<?php echo e(asset('backend/css/dataTables.bootstrap.css')); ?>">
    <link rel="stylesheet" href="<?php echo e(asset('backend/css/TableTools.css')); ?>">
    <link rel="stylesheet" href="<?php echo e(asset('backend/assets/checkbox/css/style.css')); ?>">
    <style>
        .box-img img {
            width: 200px;
            height: 90px;
            margin-bottom: 10px;
            border-radius: 3px;
        }

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

        .icon-adds {
            font-size: 20px;
            cursor: pointer;
            -webkit-transition: 0.5s;
            -moz-transition: 0.5s;
            -ms-transition: 0.5s;
            -o-transition: 0.5s;
            transition: 0.5s;
            position: absolute;
            left: -10px;
            top: 0px;
        }

        .msgLabel {
            font-size: 11px;
            color: #3c763d;
        }

        .BtnAddSub {
            border: 1px solid white;
            /*background: #f1c40f;*/
            color: #253341;
            border-radius: 50%;
            width: 20px;
            height: 20px;
            text-align: center;
            line-height: 18px;
            font-size: 19px;
            margin: 0 10px;
            cursor: pointer;
            transition: 0.5s;
        }

        .BtnAddSub:hover {
            background: white;
            border: 1px solid #007b8c;
            color: #007b8c;
            transition: 0.5s;
        }

        #ExtraBuildingType input[type="text"], .boxRooms input[type="text"], .boxRoom input[type="text"] {
            width: 25px;
            text-align: center;
        }

        .rows {
            margin: 3px 0px;
        }

        .boxRoom {
            border: 1px solid #ddd;
            border-radius: 5px;
            padding-top: 8px;
            padding-left: 12px;
            min-height: 183px;
            max-height: 381px;
            overflow-y: scroll;
        }

        .boxRoom i {
            font-size: 16px;
        }

        .boxs {
            border: 1px solid #ddd;
            border-radius: 5px;
            padding: 5px;
            /*background-color: #fff6eb;*/
            float: right;
            width: 100%;
            margin-bottom: 10px;
        }

        .boxs img {
            width: 40px;
            margin-bottom: 10px;
        }

        .textarea {
            height: 120px;
        }

        .msg {
            padding: 10px 15px;
            line-height: 25px;
        }

        .box-days {
            display: inline;
        }

        .box-days input {
            width: 14%;
            display: inline;
        }

        .box-loading-step {
            display: none;
            background-color: #00000070;
            height: 100%;
            position: absolute;
            width: 100%;
            left: 0;
            top: 0;
            z-index: 9999;
        }

        .box-loading-step img {
            height: 80px;
            position: absolute;
            top: 50%;
            left: 50%;
            width: auto;
            transform: translate(-50%, -50%);
        }

        .address button {
            color: #444;
            font-size: 13px;
        }

        .panel-title {
            cursor: pointer;
            color: #666;
        }

        .border-green > .panel-heading {
            background-color: #007b8c17;
        }

        .border-green > .panel-heading i {
            color: #007b8c;
        }

        .border-green .panel-title {
            color: #007b8c;
        }

        .panel {
            background-color: #ffffff94;
        !important;
        }

        .box-information {
            /*display: none;*/
            z-index: 9999;
            max-width: 300px;
            background: #fcfcfcbf;
            padding: 8px;
            border: 1px solid #16808fb8;
            border-radius: 5px;
            box-shadow: 0px 0px 15px #e8e8e8;
        }

        .box-information p {
            text-align: justify;
            line-height: 20px;
            color: #777777;
        }

        .box-information .title-information {
            color: #007b8c;
            font-weight: bold;
            line-height: 25px;
        }

        .box-img-host img {
            width: 100%;
            border-radius: 5px;
        }

        .box-img-remove {
            position: absolute;
            bottom: 0px;
        }

        .box-img-remove button {
            background: #ff3b3b8c;
            color: #cecece;
            border: 1px solid #c7c7c7;
            border-radius: 10px 0px 0px 0px;
        }

        <?php if($hostModel->home_type_id == 1): ?>
        #ExtraBuildingType {
            display: none;
        }

        <?php endif; ?>
        .none {
            cursor: default;
            opacity: 0;
            transition: .2s;
        }

        .show {
            cursor: auto;
            opacity: 1;
            transition: .2s;
        }

        .btn.bg-green {
            color: #fff;
        }

        .btn.bg-green:hover {
            color: #333;
        }

        span.first-img {
	        position: absolute;
	        top: 0;
	        background: #007b8c;
	        padding: 2px;
	        border-radius: 0px 0px 0px 8px;
	        color: #ececec;
	        border: 1px solid;
	        right: 14px;
        }
        .box-img-host img:hover {
	        cursor: pointer;
	        transform: scale(1.05);
	        transition: .5s;
        }
    </style>
<?php $__env->stopSection(); ?>

<?php $__env->startSection('content'); ?>
    <div class="row">
        <div class="col-md-12">
            <?php echo $__env->make('message.Message', array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>
            <?php echo $__env->make('message.ErrorReporting', array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>
        </div>
    </div>

    <div class="row">
        <div class="col-md-12">
            
            <div class="panel border-green">
                <div class="panel-heading">
                    <h3 class="panel-title">اطلاعات اولیه</h3>
                    <div class="panel-options pull-left">
                        <i class="fa fa-chevron-down"></i>
                        <i class=""></i>
                    </div>
                </div>
                <div class="panel-body">
                    <div class="row">
                        <div class="col-md-9">
                            <div class="form-group">
                                <input type="hidden" id="host_id" value="<?php echo e($hostModel->id); ?>"/>
                                <div class="row">
                                    <div class="col-md-3">
                                        <div class="form-group">
                                            <label for="SelectHomeType">نوع خانه</label><span style="font-size: 18px;"
                                                                                              class="text-danger">*</span>
                                            <br/>
                                            <select class="form-control" id="SelectHomeType" name="home_type">
                                                <option hidden value="">انتخاب کنید</option>
                                                <?php $__currentLoopData = $homeTypeModel; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $key => $value): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                                    <option value="<?php echo e($value->id); ?>"
                                                            <?php if($value->id == $hostModel->home_type_id): ?> selected <?php endif; ?>><?php echo e($value->name); ?></option>
                                                <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                                            </select>
                                        </div>
                                        <?php if($errors->has('home_type')): ?>
                                            <span style="color:red;"><?php echo e($errors->first('home_type')); ?></span>
                                        <?php endif; ?>
                                    </div>
                                    <div class="col-md-3">
                                        <div class="form-group">
                                            <label for="SelectBuildingType">نوع ساختمان</label><span
                                                    style="font-size: 18px;" class="text-danger">*</span>
                                            <br/>
                                            <select class="form-control" id="SelectBuildingType" name="building_type">
                                                <option hidden value="">انتخاب کنید</option>
                                                <?php $__currentLoopData = $buildingTypeModel; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $key => $value): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                                    <option value="<?php echo e($value->id); ?>"
                                                            <?php if($value->id == $hostModel->building_type_id): ?> selected <?php endif; ?>><?php echo e($value->name); ?></option>
                                                <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                                            </select>
                                        </div>
                                        <?php if($errors->has('building_type')): ?>
                                            <span style="color:red;"><?php echo e($errors->first('building_type')); ?></span>
                                        <?php endif; ?>
                                    </div>
                                    <div class="col-md-2">
                                        <div class="form-group">
                                            <label for="InputMeter">متراژ</label><span style="font-size: 18px;"
                                                                                       class="text-danger">*</span>
                                            <br/>
                                            <input type="number" name="meter" value="<?php echo e($hostModel->meter); ?>"
                                                   class="form-control" id="InputMeter"
                                                   placeholder="متراژ را وارد کنید"/>
                                        </div>
                                        <?php if($errors->has('meter')): ?>
                                            <span style="color:red;"><?php echo e($errors->first('meter')); ?></span>
                                        <?php endif; ?>
                                    </div>
                                    <div class="col-md-4">
                                        <div class="form-group">
                                            <label for="">&nbsp;</label>
                                            <br/>
                                            آیا حیاط به صورت مشترک است؟
                                            <input type="radio" value="0" name="shared_yard" class=""
                                                   <?php if($hostModel->shared_yard == 0): ?> checked <?php endif; ?> />خیر
                                            <input type="radio" value="1" name="shared_yard" class=""
                                                   <?php if($hostModel->shared_yard == 1): ?> checked <?php endif; ?> />بله
                                        </div>
                                        <?php if($errors->has('meter')): ?>
                                            <span style="color:red;"><?php echo e($errors->first('meter')); ?></span>
                                        <?php endif; ?>
                                    </div>
                                </div>
                                <div class="row">
                                    <br/>
                                    <div id="ExtraBuildingType">
                                        <div class="col-md-12">
                                            <div class="alert alert-warning">
                                                <p>لطفاً کسانی که در این خانه زندگی می کنند را برای راحتی و اطمینان خاطر
                                                    مهمان بگویید .</p>
                                            </div>
                                        </div>
                                        <div class="col-md-8 col-md-offset-2">
                                            <div class="form-group">
                                                <div class="col-md-4">
                                                    <div class="row">
                                                        مرد
                                                        <label class="BtnAddSub BtnAdd" id="">+</label>
                                                        <input type="text"
                                                               value="<?php if($hostModel->getRoomCommon != null): ?> <?php echo e($hostModel->getRoomCommon->count_man); ?> <?php else: ?> 0 <?php endif; ?>"
                                                               name="count_man" id="InputMan" class="input-text"
                                                               readonly/>
                                                        <label class="BtnAddSub BtnSub" id="">-</label>
                                                    </div>
                                                </div>
                                                <div class="col-md-4">
                                                    <div class="row">
                                                        زن
                                                        <label class="BtnAddSub BtnAdd" id="">+</label>
                                                        <input type="text"
                                                               value="<?php if($hostModel->getRoomCommon != null): ?> <?php echo e($hostModel->getRoomCommon->count_woman); ?> <?php else: ?> 0 <?php endif; ?>"
                                                               name="count_woman" id="InputWoman" class="input-text"
                                                               readonly/>
                                                        <label class="BtnAddSub BtnSub" id="">-</label>
                                                    </div>
                                                </div>
                                                <div class="col-md-4">
                                                    <div class="row">
                                                        بچه
                                                        <label class="BtnAddSub BtnAdd" id="">+</label>
                                                        <input type="text"
                                                               value="<?php if($hostModel->getRoomCommon != null): ?> <?php echo e($hostModel->getRoomCommon->count_child); ?> <?php else: ?> 0 <?php endif; ?>"
                                                               name="count_child" id="InputChild" class="input-text"
                                                               readonly/>
                                                        <label class="BtnAddSub BtnSub" id="">-</label>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="row">
                                    <hr/>
                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <label for="InputFileImg">تصویر اقامتگاه</label><span
                                                    style="font-size: 18px;"
                                                    class="text-danger">*</span>(<span
                                                    class="msgLabel">وجود حداقل یک عکس در گالری الزامی می باشد </span>)
                                            <br/>
                                            <span class="btn btn-green btn-file">
                                        انتخاب کنید ...
                                        <input type="file" name="file" value="<?php echo e(old('file')); ?>" dir="rtl"
                                               id="InputFileImg"/>
                                                <span class="PercentUpload"></span>
                                    </span>
                                            <p class="text-danger count-upload"></p>
                                        </div>
                                        <?php if($errors->has('file')): ?>
                                            <span style="color:red;"><?php echo e($errors->first('file')); ?></span>
                                        <?php endif; ?>
                                    </div>
                                </div>
                                <div class="row ExtraBoxImage">
                                    <?php $__currentLoopData = $hostModel->getGallery; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $key => $value): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
		                                <div class="col-md-3 box-gallery<?php echo e($value->id); ?>">
			                                <div class="box-img-host">
				                                <img src="<?php echo e(asset('Uploaded/Gallery/Img').'/'.$value->img); ?>"/>
				                                <?php if($key == 0): ?>
					                                <span class="first-img">
                                                    تصویر اصلی
                                                </span>
				                                <?php endif; ?>
			                                </div>
			                                <div class="box-img-remove">
				                                <button onclick="ajaxDeleteImg(<?php echo e($value->id); ?>,<?php echo e($hostModel->id); ?>)">حذف</button>
			                                </div>
		                                </div>
                                    <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                                </div>
                            </div>
                        </div>
                        <div class="col-md-3">
                            <div class="box-information">
                                <p>
                                    <span class="title-information">خانه دربست</span> : در این حالت اقامتگاه به صورت
                                    یکجا در اختیار مهمان قرار می گیرد.<br/>
                                    <span class="title-information">اتاق شخصی</span> : در این حالت یک اتاق به صورت
                                    اختصاصی به مهمان داده می شود و سایر فضاها با شما به صورت مشترک قابل استفاده
                                    است.<br/>
                                    <span class="title-information">اتاق مشترک</span> : در این حالت یک اتاق که حداقل دو
                                    تخت خواب دارد، هر تخت به صورت جداگانه به هر مهمان داده می شود که علاوه بر سایر
                                    فضاها، اتاق هم به صورت مشترک است. مثال : اگر اقامتگاه شما سوئیت باشد، پس جز خانه
                                    دربست و نوع ساختمان سوئیت می باشد و اگر حیاط به صورت مشترک استگزینه بله می باشد.
                                </p>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <div class="panel border-green">
                <div class="panel-heading">
                    <h3 class="panel-title">موقعیت اقامتگاه</h3>
                    <div class="panel-options pull-left">
                        <i class="fa fa-chevron-down"></i>
                        <i class=""></i>
                    </div>
                </div>
                <div class="panel-body">
                    <div class="row">
                        <hr/>
                        <div class="col-md-9">
                            <div class="row">
                                <div class="col-md-3">
                                    <div class="form-group">
                                        <label>استان</label><span style="font-size: 18px;" class="text-danger">*</span>
                                        <select name="province_id" id="SelectProvince"
                                                class="form-control SelectProvince">
                                            <option value="" hidden>انتخاب کنید</option>
                                            <?php $__currentLoopData = $provinceModel; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $key => $value): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                                <option value="<?php echo e($value->id); ?>"
                                                        <?php if($hostModel->province_id == $value->id): ?> selected <?php endif; ?>><?php echo e($value->name); ?></option>
                                            <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                                        </select>
                                    </div>
                                </div>
                                <div class="col-md-3">
                                    <div class="form-group">
                                        <label>شهرستان</label><span style="font-size: 18px;"
                                                                    class="text-danger">*</span>
                                        <select name="township_id" id="SelectTownship"
                                                class="form-control SelectTownship">
                                            <option value="" hidden>انتخاب کنید</option>
                                            <?php $__currentLoopData = $townshipModel; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $key => $value): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                                <option value="<?php echo e($value->id); ?>"
                                                        <?php if($value->id == $hostModel->township_id): ?> selected <?php endif; ?>><?php echo e($value->name); ?></option>
                                            <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                                        </select>
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label for="InputDistrict">محله</label><span style="font-size: 18px;"
                                                                                     class="text-danger">*</span>
                                        <input type="text" class="form-control" value="<?php echo e($hostModel->district); ?>"
                                               name="district" id="InputDistrict"
                                               placeholder="نام محله را وارد کنید"/>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="col-md-3">
                            <div class="box-information">
                                <p>
                                    موقعیت اقامتگاه<br/>
                                    وارد کردن موقعیت اقامتگاه و همچنین موقعیت در منطقه
                                </p>
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-md-12">
                            <div class="form-group">
                                <label for="InputAddress">آدرس</label><span style="font-size: 18px;"
                                                                            class="text-danger">*</span>
                                <input type="text" class="form-control" value="<?php echo e($hostModel->address); ?>" name="address"
                                       id="InputAddress"
                                       placeholder="آدرس محل را وارد کنید">
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-md-12">
                            <div class="form-group">
                                <label>موقعیت </label><span style="font-size: 18px;" class="text-danger">*</span>(حداقل
                                یک مورد را انتخاب کنید)
                                <div class="row">
                                    <?php $__currentLoopData = $positionTypeModel; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $key => $value): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                        <div class="col-md-2">
                                            <?php if(in_array($value->id,unserialize($hostModel->position_array))): ?>
                                                <input id="InputCheckBox<?php echo e($key+1); ?>" class="chk1" type="checkbox"
                                                       value="<?php echo e($value->id); ?>" checked/><label
                                                        for="InputCheckBox<?php echo e($key+1); ?>"><?php echo e($value->name); ?></label>
                                            <?php else: ?>
                                                <input id="InputCheckBox<?php echo e($key+1); ?>" class="chk1" type="checkbox"
                                                       value="<?php echo e($value->id); ?>"/><label
                                                        for="InputCheckBox<?php echo e($key+1); ?>"><?php echo e($value->name); ?></label>
                                            <?php endif; ?>
                                        </div>
                                    <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <div id="map-markers" style="height:300px"></div>
                        <div class="row">
                            <section class="col col-3">
                                <label class="input">
                                    <input id="Latitude" style="opacity: 0;" name="latitude"
                                           value="<?php echo e($hostModel->latitude); ?>"/>
                                </label>
                            </section>
                            <section class="col col-3">
                                <label class="input">
                                    <input id="Longitude" style="opacity: 0;" name="longitude"
                                           value="<?php echo e($hostModel->longitude); ?>"/>
                                </label>
                            </section>
                        </div>
                    </div>
                </div>
            </div>

            <div class="panel border-green">
                <div class="panel-heading">
                    <h3 class="panel-title">چیدمان اتاق ها</h3>
                    <div class="panel-options pull-left">
                        <i class="fa fa-chevron-down"></i>
                        <i class=""></i>
                    </div>
                </div>
                <div class="panel-body">
                    <div class="row">
                        <hr/>
                        <div class="col-md-12 boxRooms">
                            <div class="row">
                                <div class="col-md-9">
                                    <div class="row">
                                        <div class="col-md-6">
                                            <div class="form-group">
                                                <div class="col-md-6">
                                                    ظرفیت استاندارد
                                                </div>
                                                <div class="col-md-6">
                                                    <label class="BtnAddSub BtnAdd" id="">+</label>

                                                    <input type="text" value="<?php echo e($hostModel->standard_guest); ?>"
                                                           name="standard_guest" id="InputStandardGuest"
                                                           class="input-text" readonly/>

                                                    <label class="BtnAddSub BtnSub" id="">-</label>
                                                </div>
                                            </div>
                                        </div>
                                        <br/>
                                        <div class="col-md-6">
                                            <div class="form-group">
                                                <div class="col-md-6">
                                                    تعداد میهمان(حداکثر ظرفیت)
                                                </div>
                                                <div class="col-md-6">
                                                    <label class="BtnAddSub BtnAdd" id="">+</label>

                                                    <input type="text" value="<?php echo e($hostModel->count_guest); ?>"
                                                           name="count_guest" id="InputGuest"
                                                           class="input-text" readonly/>

                                                    <label class="BtnAddSub BtnSub" id="">-</label>
                                                </div>
                                            </div>
                                        </div>
                                        <br/>
                                        <div class="col-md-6">
                                            <div class="form-group">
                                                <div class="col-md-6">
                                                    اتاق خواب
                                                </div>
                                                <div class="col-md-6">
                                                    <label class="BtnAddSub" id="BtnAddCountRoom">+</label>

                                                    <input type="text" value="<?php echo e($hostModel->count_room); ?>"
                                                           name="count_room" id="InputCountRoom"
                                                           class="input-text" readonly/>

                                                    <label class="BtnAddSub" id="BtnSubCountRoom1">-</label>
                                                </div>
                                            </div>
                                        </div>
                                        <br/>
                                        <div class="col-md-6">
                                            <div class="form-group">
                                                <div class="col-md-6">
                                                    دستشویی
                                                </div>
                                                <div class="col-md-6">
                                                    <label class="BtnAddSub BtnAdd" id="">+</label>

                                                    <input type="text" value="<?php echo e($hostModel->count_toilet); ?>"
                                                           name="count_toilet" id="InputToilet"
                                                           class="input-text" readonly/>

                                                    <label class="BtnAddSub BtnSub" id="">-</label>
                                                </div>
                                            </div>
                                        </div>
                                        <br/>
                                        <div class="col-md-6">
                                            <div class="form-group">
                                                <div class="col-md-6">
                                                    حمام
                                                </div>
                                                <div class="col-md-6">
                                                    <label class="BtnAddSub BtnAdd" id="">+</label>

                                                    <input type="text" value="<?php echo e($hostModel->count_bathroom); ?>"
                                                           name="count_bathroom"
                                                           id="InputBathroom" class="input-text" readonly/>

                                                    <label class="BtnAddSub BtnSub" id="">-</label>
                                                </div>
                                            </div>
                                        </div>
                                        <br/>
                                        <div class="col-md-6">
                                            <div class="form-group">
                                                <div class="col-md-6">
                                                    رخت خواب سنتی
                                                </div>
                                                <div class="col-md-6">
                                                    <label class="BtnAddSub BtnAdd" id="">+</label>

                                                    <input type="text" value="<?php echo e($hostModel->count_traditional_bed); ?>"
                                                           name="count_traditional_bed"
                                                           id="InputTraditionalBed" class="input-text" readonly/>

                                                    <label class="BtnAddSub BtnSub" id="">-</label>
                                                </div>
                                            </div>
                                        </div>
                                        <br />
                                        <div class="col-md-6">
                                            <div class="form-group">
                                                <div class="col-md-6">
                                                    تعداد تخت یک نفره
                                                </div>
                                                <div class="col-md-6">
                                                    <label class="BtnAddSub BtnAdd" id="">+</label>

                                                    <input type="text" value="<?php echo e($hostModel->single_bed); ?>"
                                                           name="count_single_bed"
                                                           id="InputSingleBedTotal" class="input-text"/>

                                                    <label class="BtnAddSub BtnSub" id="">-</label>
                                                </div>
                                            </div>
                                        </div>
                                        <br />
                                        <div class="col-md-6">
                                            <div class="form-group">
                                                <div class="col-md-6">
                                                    تعداد تخت دو نفره
                                                </div>
                                                <div class="col-md-6">
                                                    <label class="BtnAddSub BtnAdd" id="">+</label>

                                                    <input type="text" value="<?php echo e($hostModel->double_bed); ?>"
                                                           name="count_double_bed"
                                                           id="InputDoubleBedTotal" class="input-text"/>

                                                    <label class="BtnAddSub BtnSub" id="">-</label>
                                                </div>
                                            </div>
                                        </div>
                                        <br/>
                                        <div class="col-md-12">
                                            <br/>
                                            <div class="boxRoom text-center">
                                                <?php if(!empty($hostModel->getRoom)): ?>
                                                    <?php $__currentLoopData = $hostModel->getRoom; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $key => $value): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                                        <div class="col-md-3 box">
                                                            <p class="">اتاق شماره <?php echo e($key+1); ?></p>
                                                            <div class="boxs">
                                                                <div class="col-md-4">
                                                                    <img src="<?php echo e(asset('frontend/icons/bed-80-2.jpg')); ?>"
                                                                         alt="">
                                                                    <div class="row">
                                                                        <label class="BtnAddSub BtnAdds" id=""><i
                                                                                    class="fa fa-angle-up"></i></label>
                                                                    </div>
                                                                    <div class="row">
                                                                        <input type="text"
                                                                               value="<?php echo e($value->double_beds); ?>"
                                                                               name="double_bed"
                                                                               id="InputDoubleBed" class="input-text"
                                                                               readonly/>
                                                                    </div>
                                                                    <div class="row">
                                                                        <label class="BtnAddSub BtnSubs" id=""><i
                                                                                    class="fa fa-angle-down"></i></label>
                                                                    </div>
                                                                </div>
                                                                <div class="col-md-4">
                                                                    <img src="<?php echo e(asset('frontend/icons/bed-80-1.jpg')); ?>"
                                                                         alt="">
                                                                    <div class="row">
                                                                        <label class="BtnAddSub BtnAdds" id=""><i
                                                                                    class="fa fa-angle-up"></i></label>
                                                                    </div>
                                                                    <div class="row">
                                                                        <input type="text"
                                                                               value="<?php echo e($value->single_beds); ?>"
                                                                               name="single_bed"
                                                                               id="InputSingleBed" class="input-text"
                                                                               readonly/>
                                                                    </div>
                                                                    <div class="row">
                                                                        <label class="BtnAddSub BtnSubs" id=""><i
                                                                                    class="fa fa-angle-down"></i></label>
                                                                    </div>
                                                                </div>
                                                                <div class="col-md-4">
                                                                    <img src="<?php echo e(asset('frontend/icons/bath.jpg')); ?>"
                                                                         alt="">
                                                                    <div class="row">
                                                                        <label class="BtnAddSub BtnAdds" id=""><i
                                                                                    class="fa fa-angle-up"></i></label>
                                                                    </div>
                                                                    <div class="row">
                                                                        <input type="text"
                                                                               value="<?php echo e($value->toilet_bathroom); ?>"
                                                                               name="shower" id="Shower"
                                                                               class="input-text" readonly/>
                                                                    </div>
                                                                    <div class="row">
                                                                        <label class="BtnAddSub BtnSubs" id=""><i
                                                                                    class="fa fa-angle-down"></i></label>
                                                                    </div>
                                                                </div>
                                                            </div>
                                                        </div>
                                                    <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                                                <?php endif; ?>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-md-3">
                                    <div class="box-information">
                                        <p>
                                            <span class="title-information">تعداد مهمان</span> : در این قسمت حداکثر
                                            ظرفیت اقامتگاه خود را وارد کنید(بر اساس فضا ، امکانات خواب).<br/>
                                            <span class="title-information">دستشویی</span> : در این قسمت تعداد کل
                                            دستشویی ها را وارد کنید، حتی دستشویی هایی که با حمام مشترک هستند .<br/>
                                            <span class="title-information">حمام</span> <br> /: در این قسمت تعداد کل
                                            حمام ها را وارد کنید، حتی حمام هایی که با حمام مشترک هستند .
                                            <span class="title-information">چیدمان اتاق</span> : در این قسمت اتاق ها نام
                                            گذاری شده اند و برای هر اتاق وارد کنید که چه تعداد تخت دو نفره یا یک نفره یا
                                            رختخواب سنتی و یا چه تعداد حمام و ودسشویی .
                                        </p>
                                    </div>
                                </div>
                            </div>

                        </div>
                    </div>
                </div>
            </div>

            <div class="panel border-green">
                <div class="panel-heading">
                    <h3 class="panel-title">امکانات اقامتگاه</h3>
                    <div class="panel-options pull-left">
                        <i class="fa fa-chevron-down"></i>
                        <i class=""></i>
                    </div>
                </div>
                <div class="panel-body">
                    <div class="row">
                        <hr/>
                        <?php $__currentLoopData = $optionModel; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $key => $value): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                            <div class="col-md-6 rows">
                                <div class="row">
                                    <div class="col-md-3">
                                        <label for="slideThree<?php echo e($key+1); ?>"><?php echo e($value->name); ?></label>
                                    </div>
                                    <div class="col-md-3">
                                        <div class="slideThree">
                                            <input type="checkbox" value="<?php echo e($value->id); ?>" class="chk2 check-description"
                                                   data-value="<?php echo e($key+1); ?>" id="slideThree<?php echo e($key+1); ?>"
                                                   name="check<?php echo e($key+1); ?>"
                                                   <?php if(in_array($value->id,$arr_option)): ?> checked <?php endif; ?>/>
                                            <label for="slideThree<?php echo e($key+1); ?>"></label>
                                        </div>
                                    </div>
                                    <div class="col-md-6">
                                        <?php $__currentLoopData = $arr_option2; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $index => $item): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                            <?php if($item['option_id'] == $value->id): ?>
                                                <input type="text"
                                                       class="form-control <?php if(in_array($value->id,$arr_option)): ?> show <?php else: ?> none <?php endif; ?> description input<?php echo e($key+1); ?>"
                                                       name="" value="<?php echo e($item['description']); ?>" id=""
                                                       placeholder="<?php if($value->description == ''): ?> توضیحات <?php echo e($value->name); ?> <?php else: ?> <?php echo e($value->description); ?> <?php endif; ?>"/>
                                                <?php break; ?>
                                            <?php else: ?>
                                                <input type="text"
                                                       class="form-control <?php if(in_array($value->id,$arr_option)): ?> show <?php else: ?> none <?php endif; ?> description input<?php echo e($key+1); ?>"
                                                       name="" value="" id=""
                                                       placeholder="<?php if($value->description == ''): ?> توضیحات <?php echo e($value->name); ?> <?php else: ?> <?php echo e($value->description); ?> <?php endif; ?>"/>
                                                <?php break; ?>
                                            <?php endif; ?>
                                        <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                                    </div>
                                </div>
                            </div>
                        <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                    </div>
                </div>
            </div>

            <div class="panel border-green">
                <div class="panel-heading">
                    <h3 class="panel-title">قوانین خانه</h3>
                    <div class="panel-options pull-left">
                        <i class="fa fa-chevron-down"></i>
                        <i class=""></i>
                    </div>
                </div>
                <div class="panel-body">
                    <div class="row">
                        <hr/>
                        <div class="col-md-9">
                            <div class="row">
                                <div class="col-md-4">
                                    <div class="form-group">ساعت ورود
                                        <input type="number" class="form-control" id="InputTimeEnter"
                                               value="<?php echo e($hostModel->time_enter); ?>" max="23" name=""
                                               placeholder=" ساعت ورود 00"/>
                                    </div>
                                </div>
                                <div class="col-md-4">ساعت خروج
                                    <div class="form-group">
                                        <input type="number" class="form-control" id="InputTimeExit"
                                               value="<?php echo e($hostModel->time_exit); ?>" max="23" name=""
                                               placeholder=" ساعت خروج 00"/>
                                    </div>
                                </div>
                                <div class="col-md-4">حداقل تعداد رزرو(روز)
                                    <div class="form-group">
                                        <input type="number" class="form-control" id="InputMinReserve"
                                               value="<?php echo e($hostModel->min_reserve_day); ?>" max="30" name=""
                                               placeholder=" حداقل تعداد روز رزرو 00"/>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="col-md-3">
                            <div class="box-information">
                                <p>
                                    <span class="title-information">حداقل تعداد روز رزرو</span> : در این قسمت تعداد کل
                                    دستشویی ها را وارد کنید، حتی دستشویی هایی که با حمام مشترک هستند.<br/>
                                    <span class="title-information">ساعت ورود و خروج</span> در این قسمت ساعت ورود مهمان
                                    ها را با ساعت خروج آنها مشخص کنید
                                </p>
                            </div>
                        </div>
                    </div>
                    <?php $__currentLoopData = $rulesModel; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $key => $value): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                        <div class="row rows">
                            <div class="col-md-6">
                                <label for="slideThree<?php echo e($key+1000); ?>"><?php echo e($value->name); ?></label>
                                <div class="slideThree">
                                    <?php if(in_array($value->id,$arr_rule)): ?>
                                        <input type="checkbox" value="<?php echo e($value->id); ?>" class="chk3"
                                               id="slideThree<?php echo e($key+1000); ?>" name="check<?php echo e($key+1); ?>" checked/>
                                        <label for="slideThree<?php echo e($key+1000); ?>"></label>
                                    <?php else: ?>
                                        <input type="checkbox" value="<?php echo e($value->id); ?>" class="chk3"
                                               id="slideThree<?php echo e($key+1000); ?>" name="check<?php echo e($key+1); ?>"/>
                                        <label for="slideThree<?php echo e($key+1000); ?>"></label>
                                    <?php endif; ?>

                                </div>
                            </div>
                        </div>
                    <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                    <div class="row">
                        <br/>
                        <div class="col-md-4">
                            <label>اضافه کردن قوانین</label>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-md-12">
                            <textarea class="form-control textarea" id="InputNewRules"
                                      placeholder="قوانین خود را وارد کنید"><?php echo e($hostModel->new_rule); ?></textarea>
                        </div>
                    </div>
                </div>
            </div>

            <div class="panel border-green">
                <div class="panel-heading">
                    <h3 class="panel-title">قیمت و تاریخ</h3>
                    <div class="panel-options pull-left">
                        <i class="fa fa-chevron-down"></i>
                        <i class=""></i>
                    </div>
                </div>
                <div class="panel-body">
                    <div id="row">
                        <hr/>
                        <div class="col-md-12">
                            <h4 class="text-green">قیمت گذاری روزهای هفته </h4>
                            <br/>
                            <div class="row">
                                <div class="col-md-9">
                                    <?php $__currentLoopData = $weekModel; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $key => $value): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                        <div class="col-md-4">
                                            <div class="form-group">
                                                <label for="Input<?php echo e($value->e_day); ?>day"><?php echo e($value->day); ?></label>
                                                <?php $__currentLoopData = $priceDayModel; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $item => $index): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                                    <?php if($index->week_id == $value->id): ?>
                                                        <input type="text" onkeyup="Seprator(this);"
                                                               name="<?php echo e($value->e_day); ?>" id="Input<?php echo e($value->e_day); ?>"
                                                               class="form-control"
                                                               value="<?php echo e(number_format($index->price)); ?>"
                                                               placeholder="0"/>
                                                    <?php endif; ?>
                                                <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                                            </div>
                                        </div>
                                    <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                                </div>
                                <div class="col-md-3">
                                    <div class="box-information">
                                        <p>
                                            <span class="title-information">قیمت و تاریخ</span> : بعد از ثبت اقامتگاه می
                                            توانید به قسمت(سفر های من) بروید و سپس در قسمت تقویم می توانید هر روز از سال
                                            را قیمت گذاری، تخفیف یا مسدود کنید .<br/>
                                        </p>
                                    </div>
                                </div>

                            </div>
                        </div>
                        <hr/>
                    </div>
                    
                    
                    
                    
                    
                    
                    
                    <div class="row">
                        <div class="form-group">
                            <div class="col-md-6">
                                <div class="form-group">
                                    <h4 class="text-green" style="display: inline-block;">قیمت روزهای ویژه</h4><span> (قیمت روزهای خاص تقویم) </span>
                                    <input type="text" onkeyup="Seprator(this);" name="special_price"
                                           id="InputSpecialPrice" class="form-control"
                                           value="<?php echo e(number_format($hostModel->special_price)); ?>" placeholder="0"/>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="form-group">
                            <div class="col-md-6">
                                <div class="form-group">
                                    <h4 class="text-green" style="display: inline-block;">هزینه اضافی به ازای هر نفر</h4>
                                    <input type="text" onkeyup="Seprator(this);" name="one_person_price"
                                           id="InputOnePersonPrice" class="form-control"
                                           value="<?php echo e(number_format($hostModel->one_person_price)); ?>" placeholder="0"/>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="form-group">
                            <div class="col-md-6">
                                <div class="form-group">
                                    شما میتوانید برای
                                    <input type="number" style="width: 80px;display: inline-block;" id="InputDayDiscount" value="<?php echo e(old('number_days')); ?>" name="number_days" maxlength="2" class="text-center form-control" placeholder="00" />
                                    روز
                                    <input type="number" style="width: 80px;display: inline-block;" id="InputNumberPercent" value="<?php echo e(old('percent')); ?>" name="percent" maxlength="2" class="text-center form-control" placeholder="00" />
                                    درصد تخفیف بگیرید
                                    <button type="button" id="BtnCreateDiscount" class="btn btn-success ">ثبت</button>
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div id="ExtraDiscount">
                                    <?php if(count($hostModel->getDiscount) > 0): ?>
                                        <table class="table table-bordered">
                                            <thead>
                                            <th>ردیف</th>
                                            <th>تعداد روز</th>
                                            <th>تخفیف</th>
                                            <th>حذف</th>
                                            </thead>
                                            <tbody>
                                            <?php $__currentLoopData = $hostModel->getDiscount; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $key => $value): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                                <tr class="tr<?php echo e($value->id); ?>">
                                                    <td><?php echo e($key + 1); ?></td>
                                                    <td><?php echo e($value->number_days); ?></td>
                                                    <td><?php echo e($value->percent); ?></td>
                                                    <td><button class="btn-danger btn" onclick="DeleteDiscount(<?php echo e($value->id); ?>)">حذف</button></td>
                                                </tr>
                                            <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                                            </tbody>
                                        </table>
                                        <script>
                                            function DeleteDiscount(id) {
                                                var loading = '<img style="width:45px; margin-right:50px;" src="<?php echo e(asset('backend/img/img_loading/orange_circles.gif')); ?>" />';
                                                $('#ExtraDiscount').html(loading);
                                                $.ajaxSetup({
                                                    headers: {
                                                        'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                                                    }
                                                });
                                                $.ajax({
                                                    url: '<?php echo e(route('DeleteDiscountAjax')); ?>',
                                                    type: 'post',
                                                    data: {
                                                        id: id,
                                                        host_id: $('#host_id').val(),
                                                    },
                                                    success: function (data) {
                                                        if (data.Success == 1) {
                                                            $('#ExtraDiscount').html(data.Content.original);
                                                            $.Toast("<p>تخفیف</p>", "<p>" + data.Message + " .</p>", "success", {
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
                                                    }
                                                });
                                            }
                                        </script>
                                    <?php else: ?>
                                        <div class="row">
                                            <div class="col-md-12">
                                                <div class="alert alert-warning">
                                                    <p>تخفیفی در سیستم به ثبت نرسیده است.</p>
                                                </div>
                                            </div>
                                        </div>
                                    <?php endif; ?>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="form-group">
                            <div class="col-md-4">
                                <h4 class="text-green">مهمانان از چند روز قبل میتوانند رزرو کنند ؟</h4>
                            </div>
                            <div class="col-md-8">
                                <h6>
                                    <label class="BtnAddSub BtnAdd BtnAddReserve" id="">+</label>

                                    <input type="text" style="width: 40px" value="<?php echo e($hostModel->closest_time_reserve); ?>"
                                           name="count_room" id="InputMinReserveDay" class="input-text" readonly/>

                                    <label class="BtnAddSub BtnSub BtnSubReserve" id="BtnSubCountRoom">-</label>
                                </h6>
                            </div>
                            <div class="col-md-12">
                                <p>در صورتی که (<span style="font-size: 22px">۰</span>) را انتخاب کنید منظور شما این است
                                    که شما اقامتگاه خود را برای همان روز اجاره میدهید (برای مهمانانی که نزدیک اقامتگاه
                                    شما هستند) و اگهی شما به قسمت اگهی های رزرو فوری میرود و در نظر داشته باشید که این
                                    یک ویژگی خوبی برای شما هست ولی در صورت انتخاب این گزینه باید در صورتی که اقامتگاهتان
                                    خارج از سایت پر شود باید سریعاً در سایت امده و همان روز یا تعداد روزهایی که رزور شده
                                    را خط بزنید تا در صورت درخواست رزور ، لغو درخواست را نزنید</p>
                                <p>میزبانی که رزرو فوری را انتخاب نکند متعهد میشود در کمتر از 2 ساعت به درخواست رزرو
                                    پاسخ دهد(قبول یا رد) ولی در صورت انتخاب رزرو فوری نهایتا 30 دقیقه فرصت تایید دارد
                                    .</p>
                                <h4 class="text-danger" <?php if($hostModel->closest_time_reserve > 0): ?> style="display: none"
                                    <?php endif; ?> id="MsgSuccessReserve">رزرو فوری فعال شد</h4>
                                <p class="" <?php if($hostModel->closest_time_reserve > 0): ?> style="display: none"
                                   <?php endif; ?> id="MsgPercentReserve">در صورتی که ساعت 12 شب به بعد آن روز اجاره رفت برای آن
                                    روز <input type="number" style="width: 40px"
                                               value="<?php echo e($hostModel->percent_instantaneous); ?>" id="PercentInstantaneous"/>
                                    درصد کمتر حساب شود (از 12 شب تا 8 صبح فعال بوده)</p>
                            </div>

                        </div>
                    </div>
                </div>
            </div>

            <div class="panel border-green">
                <div class="panel-heading">
                    <h3 class="panel-title">اطلاعات اقامتگاه</h3>
                    <div class="panel-options pull-left">
                        <i class="fa fa-chevron-down"></i>
                        <i class=""></i>
                    </div>
                </div>
                <div class="panel-body">
                    <div class="row">
                        <hr/>
                        <div class="col-md-4">
                            <div class="">
                                <label>نام اقامتگاه</label><span>(نامی انتخاب کنید که گویای اقامتگاه باشد)</span>
                            </div>
                            <div class="">
                                <div class="form-group">
                                    <input type="text" class="form-control" value="<?php echo e($hostModel->name); ?>" name=""
                                           id="InputHostName"
                                           placeholder="نام اقامتگاه - برای مثال : ویلای ۴۰۰ متری دوبلکس دماوند"/>
                                </div>
                            </div>
                        </div>
                        <div class="col-md-8">
                            <div class="alert alert-info msg">
                                <p>
                                    به هیچ عنوان شماره تماس ، ایمیل ، تلگرام و هرگونه راه ارتباطی نگذارید . در صورت
                                    مشاهده آگهی حذف خواهد شد .
                                </p>
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-md-12">
                            <label>توضیحات اقامتگاه</label><span>(توضیح درباره ملک)</span>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-md-12">
                            <div class="form-group">
                                <textarea class="form-control textarea" id="InputDescription"
                                          placeholder="هر آنچه گفته نشده را توضیح دهید"><?php echo e($hostModel->description); ?></textarea>
                            </div>
                        </div>
                    </div>
                    <br/>





























                    <br/>
                </div>
            </div>

            <div class="row">
                <div class="col-md-12">
                    <div class="form-group text-center">
                        <button type="submit" id="BtnUpdate" class="btn bg-green">ویرایش اطلاعات</button>
                    </div>
                </div>
            </div>
        </div>
    </div>


<?php $__env->stopSection(); ?>


<?php $__env->startSection('script'); ?>

    <!-- Map -->
    
    
    


    
    
    
    

    
    
    

    <script type="text/javascript" src="<?php echo e(asset('backend/js/jquery.dataTables.min.js')); ?>"></script>
    <script type="text/javascript" src="<?php echo e(asset('backend/js/TableTools.min.js')); ?>"></script>
    <script type="text/javascript" src="<?php echo e(asset('backend/js/dataTables.bootstrap.js')); ?>"></script>
    <script type="text/javascript" src="<?php echo e(asset('backend/js/editable-datatables.js')); ?>"></script>
    <script type="text/javascript" src="<?php echo e(asset('backend/js/editable-datatables.js')); ?>"></script>
    <script type="text/javascript" src="<?php echo e(asset('backend/assets/checkbox/js/script.js')); ?>"></script>
    <script type="text/javascript" src="<?php echo e(asset('backend/js/number.js')); ?>"></script>


    <script src="<?php echo e(asset('backend/js/leaflet.js')); ?>"
            integrity="sha512-QVftwZFqvtRNi0ZyCtsznlKSWOStnDORoefr1enyq5mVL4tmKB3S/EnC3rRJcxCPavG10IcrVGSmPh6Qw5lwrg=="
            crossorigin=""></script>
    <script type="text/javascript" src="<?php echo e(asset('backend/assets/map/jquery-gmaps-latlon-picker.js')); ?>"></script>
    <link rel="stylesheet" href="<?php echo e(asset('backend/assets/map/jquery-gmaps-latlon-picker.css')); ?>">
    <script>

        // Map
        $(function () {
            // use below if you want to specify the path for leaflet's images
            //L.Icon.Default.imagePath = '@Url.Content("~/Content/img/leaflet")';

            var curLocation = [0, 0];
            // use below if you have a model
            // var curLocation = [@Model.Location.Latitude, @Model.Location.Longitude];

            if (curLocation[0] == 0 && curLocation[1] == 0) {
                curLocation = [<?php echo e($hostModel->latitude); ?>, <?php echo e($hostModel->longitude); ?>];
            }

            var map = L.map('map-markers').setView(curLocation, 12);

            L.tileLayer('http://{s}.tile.osm.org/{z}/{x}/{y}.png', {
                attribution: '&copy; <a href="http://osm.org/copyright">OpenStreetMap</a> contributors'
            }).addTo(map);

            map.attributionControl.setPrefix(false);

            var marker = new L.marker(curLocation, {
                draggable: 'true'
            });

            marker.on('dragend', function (event) {
                var position = marker.getLatLng();
                marker.setLatLng(position, {
                    draggable: 'true'
                }).bindPopup(position).update();
                $("#Latitude").val(position.lat);
                $("#Longitude").val(position.lng).keyup();
            });

            $("#Latitude, #Longitude").change(function () {
                var position = [parseInt($("#Latitude").val()), parseInt($("#Longitude").val())];
                marker.setLatLng(position, {
                    draggable: 'true'
                }).bindPopup(position).update();
                map.panTo(position);
            });

            map.addLayer(marker);
        });
    </script>
    <script>

        $(document).ready(function () {

            $('.panel-body').slideToggle("slow");

            $('#BtnUpdate').click(function () {
                var img = '<div class="text-center box-loading"><img style="height:50px;width:auto;" src="<?php echo e(asset('backend/img/img_loading/orange_circles.gif')); ?>" /></div>';
                $("#BtnUpdate").fadeIn("slow", function () {
                    $("#BtnUpdate").animate({
                        'width': '100%',
                        'color': '#4b728f',
                        'background-color': '#FFF',
                    }, "slow");
                    $('#BtnUpdate').html('لطفا منتظر بمانید ... ');
                    $('#BtnUpdate').append(img);
                });
                /** ******************************************************************************************************************/
                /**
                 * Array Step 2
                 **/
                var chkArray1 = [];
                /* look for all checkboes that have a class 'chk1' attached to it and check if it was checked */
                $(".chk1:checked").each(function () {
                    chkArray1.push($(this).val());
                });
                /* we join the array separated by the comma */
                var selected1;
                selected1 = chkArray1.join(',');
                /**
                 * Array Step 3
                 **/
                var countRoom = $('#InputCountRoom').val();
                var arrayBox = $(".boxs");

                var myArray = [];
                for (var i = 0; i < countRoom; i++) {
                    myArray.push([]);
                }
                for (var i = 0; i < countRoom; i++) {
                    for (var j = 0; j < 3; j++) {
                        myArray[i][0] = (arrayBox.eq(i).find('#InputDoubleBed').val());
                        myArray[i][1] = (arrayBox.eq(i).find('#InputSingleBed').val());
                        myArray[i][2] = (arrayBox.eq(i).find('#Shower').val());
                    }
                }
                /**
                 * Array Step 4
                 **/
                var chkArray2 = [];
                var arrayDescription = [];
                /* look for all checkboes that have a class 'chk2' attached to it and check if it was checked */
                $(".chk2:checked").each(function () {
                    var description = $(this).parent().parent().parent().parent().find('.description');
                    chkArray2.push($(this).val());
                    arrayDescription.push(description.val());
                });
                /* we join the array separated by the comma */
                var selected2;
                var description_option;
                selected2 = chkArray2.join(',');
                description_option = arrayDescription.join(',');
                console.log(description_option);
                /**
                 * Array Step 5
                 **/
                var chkArray3 = [];
                /* look for all checkboes that have a class 'chk3' attached to it and check if it was checked */
                $(".chk3:checked").each(function () {
                    chkArray3.push($(this).val());
                });
                /* we join the array separated by the comma */
                var selected3;
                selected3 = chkArray3.join(',');
                /** ******************************************************************************************************************/
                // check array and value
                if (selected1.length > 0) { // array step 2
                    if (selected2.length > 0) { // array step 4
                        // update form
                        var formData = new FormData();
                        formData.append('host_id', <?php echo e($hostModel->id); ?>);
                        formData.append('home_type_id', $('#SelectHomeType option:selected').val());
                        formData.append('building_type_id', $('#SelectBuildingType option:selected').val());
                        formData.append('meter', $('#InputMeter').val());
                        formData.append('shared_yard', $('input[name=shared_yard]:checked').val());
                        formData.append('count_man', $('#InputMan').val());
                        formData.append('count_woman', $('#InputWoman').val());
                        formData.append('count_child', $('#InputChild').val());
                        // step 2
                        formData.append('province_id', $('#SelectProvince').val());
                        formData.append('township_id', $('#SelectTownship').val());
                        formData.append('district', $('#InputDistrict').val());
                        formData.append('address', $('#InputAddress').val());
                        formData.append('latitude', $('#Latitude').val());
                        formData.append('longitude', $('#Longitude').val());
                        formData.append('select_array1', selected1);
                        // step 3
                        formData.append('standard_guest', $('#InputStandardGuest').val());
                        formData.append('count_guest', $('#InputGuest').val());
                        formData.append('count_room', $('#InputCountRoom').val());
                        formData.append('count_toilet', $('#InputToilet').val());
                        formData.append('count_bathroom', $('#InputBathroom').val());
                        formData.append('count_traditional_bed', $('#InputTraditionalBed').val());
                        formData.append('count_double_bed', $('#InputSingleBedTotal').val());
                        formData.append('count_single_bed', $('#InputDoubleBedTotal').val());
                        formData.append('rooms', JSON.stringify(myArray));
                        // step 4
                        formData.append('select_array2', selected2);
                        formData.append('description_array', description_option);
                        // step 5
                        formData.append('time_enter', $('#InputTimeEnter').val());
                        formData.append('time_exit', $('#InputTimeExit').val());
                        formData.append('min_reserve', $('#InputMinReserve').val());
                        formData.append('new_rule', $('#InputNewRules').val());
                        formData.append('select_array3', selected3);
                        // step 6
                        formData.append('price_saturday', $('#InputSaturday').val());
                        formData.append('price_sunday', $('#InputSunday').val());
                        formData.append('price_monday', $('#InputMonday').val());
                        formData.append('price_tuesday', $('#InputTuesday').val());
                        formData.append('price_wednesday', $('#InputWednesday').val());
                        formData.append('price_thursday', $('#InputThursday').val());
                        formData.append('price_friday', $('#InputFriday').val());
                        formData.append('closest_time_reserve', $('#InputMinReserveDay').val());
                        formData.append('special_price', $('#InputSpecialPrice').val());
                        formData.append('one_person_price', $('#InputOnePersonPrice').val());
                        formData.append('percent_instantaneous', $('#PercentInstantaneous').val());
                        // step 7
                        formData.append('host_name', $('#InputHostName').val());
                        formData.append('description', $('#InputDescription').val());
                        formData.append('cancel_rule_id', $('#SelectCancelRule').val());
                        // Send data with ajax
                        $.ajaxSetup({
                            headers: {
                                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                            }
                        });
                        $.ajax({
                            url: '<?php echo e(route('UpdateHost')); ?>',
                            type: 'post',
                            data: formData,
                            processData: false,
                            contentType: false,
                            success: function (data) {
                                console.log(data);
                                if (data.Success == 0) {
                                    setTimeout(defaultBtn, 1200);
                                    $.Toast("<p>ویرایش</p>", "<p>" + data.Message + " .</p>", "warning", {
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
                                else if (data.Success == 1) {
                                    setTimeout(defaultBtn, 1200);
                                    $.Toast("<p>ویرایش</p>", "<p>" + data.Message + " .</p>", "success", {
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
                            }
                        });
                    } else {
                        setTimeout(defaultBtn, 1200);
                        $.Toast("<p>ویرایش</p>", "<p>حداقل انتخاب یکی از فیلد های امکانات اجباری میباشد .</p>", "warning", {
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
                } else {
                    setTimeout(defaultBtn, 1200);
                    $.Toast("<p>ویرایش</p>", "<p>حداقل انتخاب یکی از فیلد های موقعیت اجباری میباشد .</p>", "warning", {
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
            });
            //get township
            $("body").delegate(".SelectProvince", "change", function (e) {

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
                        $(".SelectTownship").html(data);
                    }
                });
            }

            //get city
            $("body").delegate(".SelectTownship", "change", function (e) {
                var text = $(".SelectTownship option:selected").text();
                $('.gllpSearchField').val(text);
                $('.gllpSearchButton').click();

                var id = $(this).val();
                getCity(id);
            });

            //get city
            function getCity(id) {
                $.ajaxSetup({
                    headers: {
                        'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                    }
                });
                $.ajax({
                    url: '<?php echo e(route('GetAjaxCity')); ?>',
                    type: 'post',
                    data: {
                        id: id
                    },
                    success: function (data) {
                        $(".SelectCity").html(data);
                    }
                });

            }

            //get district
            $("body").delegate(".SelectCity", "change", function (e) {

                var id = $(this).val();
                getDistrict(id);
            });

            //get district
            function getDistrict(id) {
                $.ajaxSetup({
                    headers: {
                        'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                    }
                });
                $.ajax({
                    url: '<?php echo e(route('GetAjaxDistrict')); ?>',
                    type: 'post',
                    data: {
                        id: id
                    },
                    success: function (data) {
                        $(".SelectDistrict").html(data);
                    }
                });

            }

            //send image
            $('#InputFileImg').on('change', function () {
                $('.PercentUpload').html('');
                $('.count-upload').text('');
                var img = '<div class="text-center box-loading"><img style="height:50px;width:auto;" src="<?php echo e(asset('backend/img/img_loading/orange_circles.gif')); ?>" /></div>';
                $('.btn-file').append(img);
                var file = $(this)[0].files[0];
                var hostId = $('#host_id').val();
                var formData = new FormData();
                formData.append('img', file);
                formData.append('id', hostId);
                $.ajaxSetup({
                    headers: {
                        'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                    }
                });
                $.ajax({
                    url: '<?php echo e(route('StoreImageHost')); ?>',
                    type: 'post',
                    data: formData,
                    processData: false,
                    contentType: false,
                    xhr: function(){
                        //upload Progress
                        var xhr = $.ajaxSettings.xhr();
                        if (xhr.upload) {
                            xhr.upload.addEventListener('progress', function(event) {
                                var percent = 0;
                                var position = event.loaded || event.position;
                                var total = event.total;
                                if (event.lengthComputable) {
                                    percent = Math.ceil(position / total * 100);
                                }
                                //update progressbar
                                $('.PercentUpload').text(percent +"%");
                            }, true);
                        }
                        return xhr;
                    },
                    success: function (data) {
                        if (data.Success == '1') {
                            $('.ExtraBoxImage').append(data.url.original);
                            $('.box-loading').remove();
                            $('.PercentUpload').html('');
                        }
                        else if (data.Success == '0' && data.Message == 'false') {
                            $('.count-upload').text('خطا در ذخیره سازی تصویر ، لطفا مجددا تلاش کنید');
                            $('.box-loading').remove();
                        } else if (data.Success == '0' && data.Message == 'error') {
                            $('.count-upload').text('خطا در ارسال داده ها');
                            $('.box-loading').remove();
                        } else if (data.Success == '0' && data.Message == 'none') {
                            $('.count-upload').text('تصویری ارسال نشده است');
                            $('.box-loading').remove();
                        } else if (data.Success == '0' && data.Message == 'count_upload') {
                            $('.count-upload').text('محدودیت در تعداد ارسال تصاویر');
                            $('.box-loading').remove();
                        } else if (data.Success == '0' && data.Message == 'count_upload') {
                            $('.count-upload').text('محدودیت در تعداد ارسال تصاویر');
                            $('.box-loading').remove();
                        } else {
                            $('.count-upload').text(data.Message);
                            $('.box-loading').remove();
                        }
                    }
                });
            });

            //-_-_-_-_-_-_-_-_-_-_-_-_-_-_-_-_-_-_
            $("body").delegate("#SelectHomeType", "change", function (e) {
                var Value = $(this).val();
                if (Value == 2 || Value == 3) {
                    $('#ExtraBuildingType').css('display', 'block');
                }
                else {
                    $('#ExtraBuildingType').css('display', 'none');
                    $('#InputMan').val(0);
                    $('#InputWoman').val(0);
                    $('#InputChild').val(0);
                }
            });
            //-_-_-_-_-_-_-_-_-_-_-_-_-_-_-_-_-_-_


            $('#BtnAddCountRoom').click(function () {
                var textbox = $(this).parent().parent().find('.input-text');
                var value = textbox[0].defaultValue;
                var numItems = $('.box').length + 1;
                textbox[0].defaultValue = parseFloat(value) + 1;
                var box = '<div class="col-md-3 box">\n' +
                    '          <p class="">اتاق شماره ' + numItems + '</p>\n' +
                    '          <div class="boxs">\n' +
                    '              <div class="col-md-4">\n' +
                    '                  <img src="<?php echo e(asset('frontend/icons/bed-80-2.jpg')); ?>" alt="">\n' +
                    '                  <div class="row">\n' +
                    '                      <label class="BtnAddSub BtnAdds" id=""><i class="fa fa-angle-up"></i></label>\n' +
                    '                  </div>\n' +
                    '                  <div class="row">\n' +
                    '                      <input type="text" value="0" name="double_bed" id="InputDoubleBed" class="input-text" readonly />\n' +
                    '                  </div>\n' +
                    '                  <div class="row">\n' +
                    '                      <label class="BtnAddSub BtnSubs" id=""><i class="fa fa-angle-down"></i></label>\n' +
                    '                  </div>\n' +
                    '              </div>\n' +
                    '              <div class="col-md-4">\n' +
                    '                  <img src="<?php echo e(asset('frontend/icons/bed-80-1.jpg')); ?>" alt="">\n' +
                    '                  <div class="row">\n' +
                    '                      <label class="BtnAddSub BtnAdds" id=""><i class="fa fa-angle-up"></i></label>\n' +
                    '                  </div>\n' +
                    '                  <div class="row">\n' +
                    '                      <input type="text" value="0" name="single_bed" id="InputSingleBed" class="input-text" readonly />\n' +
                    '                  </div>\n' +
                    '                  <div class="row">\n' +
                    '                      <label class="BtnAddSub BtnSubs" id=""><i class="fa fa-angle-down"></i></label>\n' +
                    '                  </div>\n' +
                    '              </div>\n' +
                    '              <div class="col-md-4">\n' +
                    '                  <img src="<?php echo e(asset('frontend/icons/bath.jpg')); ?>" alt="">\n' +
                    '                  <div class="row">\n' +
                    '                      <label class="BtnAddSub BtnAdds" id=""><i class="fa fa-angle-up"></i></label>\n' +
                    '                  </div>\n' +
                    '                  <div class="row">\n' +
                    '                      <input type="text" value="0" name="shower" id="Shower" class="input-text" readonly />\n' +
                    '                  </div>\n' +
                    '                  <div class="row">\n' +
                    '                      <label class="BtnAddSub BtnSubs" id=""><i class="fa fa-angle-down"></i></label>\n' +
                    '                  </div>\n' +
                    '              </div>\n' +
                    '          </div>\n' +
                    '       </div>';
                $('.boxRoom').append(box);

            });

            $('#BtnSubCountRoom1').click(function () {
                var textbox = $(this).parent().parent().find('.input-text');
                var value = textbox[0].defaultValue;
                if (value == 0) {
                    value = 1;
                }
                textbox[0].defaultValue = parseFloat(value) - 1;
                var element = $('.boxRoom .box:last-child');
                element.remove();
            });

            //_-_-_-_-_-_- BTN STEP _-_-_-_-_-_


            $('#step1').click(function () {
                $('#Tab1').removeClass('active');
                $('#1_tab').removeClass('active');
                // $('#1_tab').removeClass('in');

                $('#Tab2').addClass('active');
                $('#2_tab').addClass('active');
                // $('#2_tab').addClass('fade');
                // $('#2_tab').addClass('in');
            });
        });

        //Panel options for removing and minimising panels
        // $('.fa-chevron-down').click(function(){
        //     console.log(12);
        //     $(this).parents('.panel').children('.panel-body').slideToggle("slow");
        // });

        $(document).on('click', '.BtnAdds', function () {
            var textbox = $(this).parent().parent().find('.input-text');
            var value = textbox[0].defaultValue;
            textbox[0].defaultValue = parseFloat(value) + 1;
            return false;
        });
        $(document).on('click', '.BtnSubs', function () {
            var textbox = $(this).parent().parent().find('.input-text');
            var value = textbox[0].defaultValue;
            if (value == 0) {
                value = 1;
            }
            textbox[0].defaultValue = parseFloat(value) - 1;
            return false;
        });

        $('.BtnAdd').click(function () {
            var textbox = $(this).parent().parent().find('.input-text');
            var value = textbox[0].defaultValue;
            textbox[0].defaultValue = parseFloat(value) + 1;
            return false;
        });
        $('.BtnSub').click(function () {
            var textbox = $(this).parent().parent().find('.input-text');
            console.log(textbox[0].id);
            if (textbox[0].id == 'InputGuest') {
                var value = textbox[0].defaultValue;
                if (value == 1) {
                    value = 2;
                }
                textbox[0].defaultValue = parseFloat(value) - 1;
                return false;
            }
            var value = textbox[0].defaultValue;
            if (value == 0) {
                value = 1;
            }
            textbox[0].defaultValue = parseFloat(value) - 1;
            return false;
        });


        $('.BtnAddReserve,.BtnSubReserve').click(function () {
            var textboxMinReserve = $(this).parent().parent().find('#InputMinReserveDay');
            var valueMinReserve = textboxMinReserve[0].defaultValue;
            valueMinReserve = parseFloat(valueMinReserve);
            // console.log(valueMinReserve);
            if (valueMinReserve == 0) {
                $('#MsgSuccessReserve').text('رزرو فوری فعال شد');
                $('#MsgSuccessReserve').css('display', 'block');
                $('#MsgPercentReserve').css('display', 'block');
            } else {
                $('#MsgSuccessReserve').text('');
                $('#MsgSuccessReserve').css('display', 'none');
                $('#MsgPercentReserve').css('display', 'none');
            }
            var textbox = $(this).parent().parent().find('.input-text');
            var value = textbox[0].defaultValue;
            textbox[0].defaultValue = parseFloat(value);
            return false;
        });


        $('#SelectCancelRule').change(function () {
            switch ($(this).val()) {
                case '1':
                    $('.desc-rule').css('display', 'none');
                    $('.description-rule1').css('display', 'block');
                    break;
                case '2':
                    $('.desc-rule').css('display', 'none');
                    $('.description-rule2').css('display', 'block');
                    break;
                case '3':
                    $('.desc-rule').css('display', 'none');
                    $('.description-rule3').css('display', 'block');
                    break;
                default:
                    $('.desc-rule').css('display', 'none');
                    break;
            }
        });


        $('.check-description').click(function () {
            var key = $(this).attr('data-value');
            var input = $(this).parent().parent().parent().find('.input' + key);
            if (input.hasClass('show')) {
                input.removeClass('show');
                input.addClass('none');
            } else {
                input.removeClass('none');
                input.addClass('show');
            }
        });


        //_-_-_-_-_-_- Delete Image _-_-_-_-_-_

        function ajaxDeleteImg(id, idInput) {
            var host_id = <?php echo e($hostModel->id); ?>;
            var formData = new FormData();
            formData.append('host_id', host_id);
            formData.append('img_id', id);
            $.ajaxSetup({
                headers: {
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                }
            });
            $.ajax({
                url: "<?php echo e(route('AjaxDeleteImg')); ?>",
                method: "post",
                data: formData,
                processData: false,
                contentType: false,
            }).done(function (data) {
                console.log(data);
                if (data == 'deleted') {
                    $('.box-gallery'+id).remove();
                    $.Toast("<p>گالری</p>", "<p>حذف با موفقیت انجام شد .</p>", "warning", {
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
                else if (data == 'limited') {
                    $(".box-loading-step").fadeOut("slow", function () {
                        $('.box-loading-step').hide();
                    });
                    $.Toast("<p>گالری</p>", "<p>گالری نمی تواند خالی باشد .</p>", "warning", {
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
            });
        }


        //Panel options for removing and minimising panels
        $('.panel-options .fa-chevron-down').click(function(){
        	$(this).parents('.panel').children('.panel-body').slideToggle("slow");
        });

        //Panel options for removing and minimising panels
        $('.panel-title').click(function(){
        	$(this).parents('.panel').children('.panel-body').slideToggle("slow");
        });

        function defaultBtn() {
            $("#BtnUpdate").animate({
                'width': '123px',
                'color': '#FFF',
                'background-color': '#007b8c',
            }, "slow");
            $('#BtnUpdate').html('ویرایش اطلاعات');
            $('#BtnUpdate').removeClass('btn-default');
        }


        // store discount ajax
        $('#BtnCreateDiscount').click(function () {
            if($('#InputDayDiscount').val() == '' || $('#InputNumberPercent').val() == '') {
                $.Toast("<p>تخفیف</p>", "<p>پر کردن فیلد ها اجباری است .</p>", "warning", {
                    has_icon: true,
                    has_close_btn: true,
                    stack: true,
                    fullscreen: false,
                    timeout: 4000,
                    sticky: false,
                    has_progress: true,
                    rtl: true,
                });
                return  false;
            }
            var loading = '<img style="width:45px; margin-right:50px;" src="<?php echo e(asset('backend/img/img_loading/orange_circles.gif')); ?>" />';
            $('#ExtraDiscount').html(loading);
            var host_id = $('#host_id').val();
            $.ajaxSetup({
                headers: {
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                }
            });
            $.ajax({
                url: '<?php echo e(route('StoreDiscountAjax')); ?>',
                type: 'post',
                data: {
                    host_id: host_id,
                    number_days: $('#InputDayDiscount').val(),
                    percent: $('#InputNumberPercent').val(),
                },
                success: function (data) {
                    if (data.Success == 1) {
                        $('#ExtraDiscount').html(data.Content.original);
                        $.Toast("<p>تخفیف</p>", "<p>" + data.Message + " .</p>", "success", {
                            has_icon: true,
                            has_close_btn: true,
                            stack: true,
                            fullscreen: false,
                            timeout: 4000,
                            sticky: false,
                            has_progress: true,
                            rtl: true,
                        });
                    } else {
                        $('#ExtraDiscount').html('');
                        $.Toast("<p>تخفیف</p>", "<p>" + data.Message + " .</p>", "warning", {
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
                }
            });
        });

        function DeleteDiscount(id) {
            var loading = '<img style="width:45px; margin-right:50px;" src="<?php echo e(asset('backend/img/img_loading/orange_circles.gif')); ?>" />';
            $('#ExtraDiscount').html(loading);
            $.ajaxSetup({
                headers: {
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                }
            });
            $.ajax({
                url: '<?php echo e(route('DeleteDiscountAjax')); ?>',
                type: 'post',
                data: {
                    id: id,
                    host_id: $('#host_id').val(),
                },
                success: function (data) {
                    if (data.Success == 1) {
                        $('#ExtraDiscount').html(data.Content.original);
                        $.Toast("<p>تخفیف</p>", "<p>" + data.Message + " .</p>", "success", {
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
                }
            });
        }
    </script>
<?php $__env->stopSection(); ?>
<?php echo $__env->make('backend.MasterPage.Layout', array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>