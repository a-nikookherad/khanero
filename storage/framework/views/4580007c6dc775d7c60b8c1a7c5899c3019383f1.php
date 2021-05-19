
<?php ($buildingTypeModel = App\Modules\Possibilities\Controllers\PossibilitiesController::GetBuildingType()); ?>
<?php ($homeTypeModel = App\Modules\Possibilities\Controllers\PossibilitiesController::GetHomeType()); ?>

<style>
    .progress .bar {
        width: 5%; background-color: #a7a7a7;
    }
    #ExtraBuildingType {
        display: none;
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

<div class="address">
    <div class="col-md-12">
        <p>
            <button data-value="1" id="BtnEditStep1" class="btn" disabled>اطلاعات اولیه</button>
        </p>
    </div>
</div>
<div class="row">
    <div class="col-md-12">
        <div class="panel panel-default">
            <div class="panel-heading">
                <h3 class="panel-title">اطلاعات اولیه<span class="information-step"><i class="fas fa-info-circle"></i></span></h3>
                <div class="box-information show-information">
                    <p>
                        <span class="title-information">خانه دربست</span> : در این حالت اقامتگاه به صورت یکجا در اختیار مهمان قرار می گیرد.<br />
                        <span class="title-information">اتاق شخصی</span> : در این حالت یک اتاق به صورت اختصاصی به مهمان داده می شود و سایر فضاها با شما به صورت مشترک قابل استفاده است.<br />
                        <span class="title-information">اتاق مشترک</span> : در این حالت یک اتاق که حداقل دو تخت خواب دارد، هر تخت به صورت جداگانه به هر مهمان داده می شود که علاوه بر سایر فضاها، اتاق هم به صورت مشترک است. مثال:اگر اقامتگاه بوم گردی دارید که اتاق(بدون امکانات) دارد، پس جزواتاق شخصی،نوع ساختمان بوم گردی و حیاط به صورت مشترک گزینه بله.
                    </p>
                </div>
            </div>
            <div class="panel-body">
                <div class="row">
                    <div class="col-md-4">
                        <div class="form-group">
                            <label for="InputFileImg">تصویر اقامتگاه</label><span style="font-size: 18px;" class="text-danger">*</span>(<span class="msgLabel">وارد کردن حداقل یک عکس الزامی می باشد</span>)
                            <br />
                            <span class="btn btn-primary btn-file btn-green">
                                انتخاب کنید ...
                                <input type="file" name="file" value="<?php echo e(old('file')); ?>" dir="rtl" id="InputFileImg" />
                                <span class="PercentUpload"></span>
                                </span>
                            </span>
                            <p class="text-danger count-upload"></p>

                        </div>
                        <?php if($errors->has('file')): ?>
                            <span style="color:red;"><?php echo e($errors->first('file')); ?></span>
                        <?php endif; ?>
                    </div>
                    <div class="col-md-8">
                        <div class="row">
                            <div id="ExtraGallery">
                                
                                <?php $__currentLoopData = $hostModel->getGallery; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $key => $value): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                    <div class="col-md-3 box-gallery-selector box-gallery<?php echo e($value->id); ?>" data-first-img="<?php if($key == 0): ?> 1 <?php else: ?> 0 <?php endif; ?>">
                                        <div class="box-img-host">
                                            <img src="<?php echo e(asset('Uploaded/Gallery/Img').'/'.$value->img); ?>"/>
                                            <?php if($key == 0): ?>
                                                <span class="first-img">
                                                    تصویر اصلی
                                                </span>
                                            <?php endif; ?>
                                        </div>
                                        <div class="box-img-remove">
                                            <button onclick="removeGalleryHost(<?php echo e($value->id); ?>,<?php echo e($hostModel->id); ?>)">حذف</button>
                                        </div>
                                    </div>
                                <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                            </div>
                        </div>
                    </div>
                </div>

                <hr />
                <div class="row">
                    <div class="col-md-2">
                        <div class="form-group">
                            <label for="SelectHomeType">نوع خانه</label><span style="font-size: 18px;" class="text-danger">*</span>
                            <select class="form-control" id="SelectHomeType" name="home_type">
                                <option hidden value="">انتخاب کنید</option>
                                <?php $__currentLoopData = $homeTypeModel; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $key => $value): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                    <option value="<?php echo e($value->id); ?>"><?php echo e($value->name); ?></option>
                                <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                            </select>
                        </div>
                        <?php if($errors->has('home_type')): ?>
                            <span style="color:red;"><?php echo e($errors->first('home_type')); ?></span>
                        <?php endif; ?>
                    </div>
                    <div class="col-md-2">
                        <div class="form-group">
                            <label for="SelectBuildingType">نوع ساختمان</label><span style="font-size: 18px;" class="text-danger">*</span>
                            <select class="form-control" id="SelectBuildingType" name="building_type">
                                <option hidden value="">انتخاب کنید</option>
                                <?php $__currentLoopData = $buildingTypeModel; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $key => $value): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                    <option value="<?php echo e($value->id); ?>"><?php echo e($value->name); ?></option>
                                <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                            </select>
                        </div>
                        <?php if($errors->has('building_type')): ?>
                            <span style="color:red;"><?php echo e($errors->first('building_type')); ?></span>
                        <?php endif; ?>
                    </div>
                    <div class="col-md-2">
                        <div class="form-group">
                            <label for="InputMeter">متراژ زیر بنا</label><span style="font-size: 18px;" class="text-danger">*</span>
                            <input type="number" name="meter" class="form-control" id="InputMeter" placeholder="متراژ را وارد کنید" />
                        </div>
                        <?php if($errors->has('meter')): ?>
                            <span style="color:red;"><?php echo e($errors->first('meter')); ?></span>
                        <?php endif; ?>
                    </div>
                    <div class="col-md-2">
                        <div class="form-group">
                            <label for="InputMeterTotal">متراژ کل</label><span style="font-size: 18px;" class="text-danger">*</span>
                            <input type="number" name="meter_total" class="form-control" id="InputMeterTotal" placeholder="متراژ کل بنا را وارد کنید" />
                        </div>
                        <?php if($errors->has('meter_total')): ?>
                            <span style="color:red;"><?php echo e($errors->first('meter_total')); ?></span>
                        <?php endif; ?>
                    </div>
                    
                    
                    
                    
                    
                    
                    
                    
                    
                    
                    
                    
                    
                    
                    
                    
                    
                    
                    
                    
                    <div class="col-md-6">
                        <div class="form-group">
                            <label for="">&nbsp;</label>
                            <br />
                            آیا حیاط به صورت مشترک است؟
                            <input type="radio" value="0" name="shared_yard" class="" checked />خیر
                            <input type="radio" value="1" name="shared_yard" class="" />بله
                        </div>
                        <?php if($errors->has('meter')): ?>
                            <span style="color:red;"><?php echo e($errors->first('meter')); ?></span>
                        <?php endif; ?>
                    </div>
                </div>
                <div class="row">
                    <div id="ExtraBuildingType">
                        <hr />
                        <div class="col-md-12">
                            <div class="alert alert-warning">
                                <p>لطفاً کسانی که در این خانه زندگی می کنند را  برای راحتی و اطمینان خاطر مهمان بگویید .</p>
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="form-group">
                                <div class="col-md-4">
                                    <div class="row">
                                        مرد
                                        <label class="BtnAddSub BtnAdd" id="">+</label>

                                        <input type="text" value="0" name="count_man" id="InputMan" class="input-text" readonly />

                                        <label class="BtnAddSub BtnSub" id="">-</label>
                                    </div>
                                </div>
                                <div class="col-md-4">
                                    <div class="row">
                                        زن
                                        <label class="BtnAddSub BtnAdd" id="">+</label>

                                        <input type="text" value="0" name="count_woman" id="InputWoman" class="input-text" readonly />

                                        <label class="BtnAddSub BtnSub" id="">-</label>
                                    </div>
                                </div>
                                <div class="col-md-4">
                                    <div class="row">
                                        بچه
                                        <label class="BtnAddSub BtnAdd" id="">+</label>

                                        <input type="text" value="0" name="count_child" id="InputChild" class="input-text" readonly />

                                        <label class="BtnAddSub BtnSub" id="">-</label>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <br />
                <div class="row">
                    <div class="col-md-2 col-md-offset-5">
                        <button type="button" id="step1" class="btn btn-default BtnRegAll btn-block">&nbsp; بعدی  <i class="fa fa-angle-left"></i><i class="fa fa-angle-left"></i></button>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

<script>

    $('#InputFileImg').on('change', function(){
        $('.PercentUpload').html('');
        $('.count-upload').text('');
        var img = '<div class="text-center box-loading"><img style="height:50px;width:auto;" src="<?php echo e(asset('backend/img/img_loading/loading_calendar.gif')); ?>" /></div>';
        $('.btn-file').append(img);
        var file = $(this)[0].files[0];
        var hostId = $('#host_id').val();
        var formData = new FormData();
        formData.append('img', file);
        formData.append('id', hostId);
        $.ajaxSetup({
            headers : {
                'X-CSRF-TOKEN' : $('meta[name="csrf-token"]').attr('content')
            }
        });
        $.ajax({
            url: '<?php echo e(route('StoreImageHost')); ?>',
            type : 'post',
            data : formData,
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
            success : function (data) {
                if(data.Success == '1')
                {
                    $('#ExtraGallery').append(data.url.original);
                    $('.box-loading').remove();
                    $('.PercentUpload').html('');
                }
                else if(data.Success == '0' && data.Message == 'false') {
                    $('.count-upload').text('خطا در ذخیره سازی تصویر ، لطفا مجددا تلاش کنید');
                    $('.box-loading').remove();
                } else if(data.Success == '0' && data.Message == 'error') {
                    $('.count-upload').text('خطا در ارسال داده ها');
                    $('.box-loading').remove();
                } else if(data.Success == '0' && data.Message == 'none') {
                    $('.count-upload').text('تصویری ارسال نشده است');
                    $('.box-loading').remove();
                } else if(data.Success == '0' && data.Message == 'count_upload') {
                    $('.count-upload').text('محدودیت در تعداد ارسال تصاویر');
                    $('.box-loading').remove();
                } else if(data.Success == '0' && data.Message == 'count_upload') {
                    $('.count-upload').text('محدودیت در تعداد ارسال تصاویر');
                    $('.box-loading').remove();
                } else {
                    $('.count-upload').text(data.Message);
                    $('.box-loading').remove();
                }
            }
        });
    });



    $('#step1').click(function () {
        $(".box-loading-step").fadeIn("slow", function() {
            $(this).show();
        });
        var formData = new FormData();
        formData.append('host_id', $('#host_id').val());
        formData.append('home_type_id', $('#SelectHomeType option:selected').val());
        formData.append('building_type_id', $('#SelectBuildingType option:selected').val());
        formData.append('meter', $('#InputMeter').val());
        formData.append('meter_total', $('#InputMeterTotal').val());
        formData.append('shared_yard', $('input[name=shared_yard]:checked').val());
        formData.append('count_man', $('#InputMan').val());
        formData.append('count_woman', $('#InputWoman').val());
        formData.append('count_child', $('#InputChild').val());
        // for (var pair of formData.entries()) {
        //     console.log(pair[0]+ ', ' + pair[1]);
        // }
        $.ajaxSetup({
            headers : {
                'X-CSRF-TOKEN' : $('meta[name="csrf-token"]').attr('content')
            }
        });
        $.ajax({
            url: '<?php echo e(route('StoreHostStep1')); ?>',
            type: 'post',
            data: formData,
            processData: false,
            contentType: false,
            success: function (data) {
                if(data.Success == 0)
                {
                    $(".box-loading-step").fadeOut("slow", function() {
                        $('.box-loading-step').hide();
                    });
                    $('#myModal').modal('show');
                    $('#MsgErrorStep').text(data.Message);
                }
                else {
                    $(".box-loading-step").fadeOut("slow", function() {
                        $('.box-loading-step').hide();
                    });
                    $('#ExtraFormHost').html(data.Message.original);
                }
            }
        });
    });


    $('#BtnSubCountRoom').click(function () {
        var textbox = $(this).parent().parent().find('.input-text');
        var value  = textbox[0].defaultValue;
        if(value == 0)
        {
            value = 1;
        }
        textbox[0].defaultValue = parseFloat(value)-1;
        var element = $('.boxRoom .box:last-child');
        element.remove();
    });





    $('.BtnAdd').click(function() {
        var textbox = $(this).parent().parent().find('.input-text');
        var value  = textbox[0].defaultValue;
        textbox[0].defaultValue = parseFloat(value)+1;
        return false;
    });
    $('.BtnSub').click(function() {
        var textbox = $(this).parent().parent().find('.input-text');
        console.log(textbox[0].id);
        if(textbox[0].id == 'InputGuest') {
            var value  = textbox[0].defaultValue;
            if(value == 1)
            {
                value = 2;
            }
            textbox[0].defaultValue = parseFloat(value)-1;
            return false;
        }
        var value  = textbox[0].defaultValue;
        if(value == 0)
        {
            value = 1;
        }
        textbox[0].defaultValue = parseFloat(value)-1;
        return false;
    });
    $('span.information-step').click(function () {
        $('.box-information').toggleClass('show-information');
    });

</script>
