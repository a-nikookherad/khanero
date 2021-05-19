<style>
    .progress .bar {
        width: 35%;
        background-color: #9987c0;
    }

    .box-description .right {
        display: inline-block;
    }

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

    .line-height-35 {
        line-height: 35px;
    }
</style>
<div class="address">
    <div class="col-md-12">
        <p>
            <button data-value="1" id="BtnEditStep1" class="btn btn-enable">مشخصات اقامتگاه</button>
            <button data-value="4" id="BtnEditStep4" class="btn btn-enable">موقعیت</button>
            <button data-value="2" id="BtnEditStep2" class="btn btn-enable">امکانات</button>
            <button data-value="7" id="BtnEditStep7" class="btn btn-enable">تصاویر</button>
            <button data-value="3" id="BtnEditStep3" class="btn btn-disable" disabled>قوانین صاحبخانه</button>
            <button data-value="6" id="BtnEditStep6" class="btn btn-disable" disabled>قیمت گذاری</button>
        </p>
    </div>
</div>
<div class="row">
    <div class="col-md-12">
        <div class="panel panel-default">
            <div class="panel-heading">
                <h3 class="panel-title">تصاویر اقامتگاه<span class="information-step"><i class="fas fa-info-circle"></i></span>
                </h3>
                <div class="box-information">
                    <p>
                        تصاویر اقامتگاه<br/>

                    </p>
                </div>
            </div>
            <div class="panel-body">
                <div class="row">
                    <div class="col-md-3">
                        <div class="form-group">
                            <label for="InputFileImgIndex">تصویر شاخص</label><span style="font-size: 18px;"
                                                                                   class="text-danger">*</span>(<span
                                    class="msgLabel">وارد کردن تصویر شاخص الزامی می باشد</span>)
                            <br/>
                            <img src="" style="width: 100%" class="images">
                            <span class="btn btn-primary btn-file btn-green">
                                انتخاب کنید ...
                                <input type="file" onchange="readURL(this)" name="file" value="<?php echo e(old('img')); ?>"
                                       dir="rtl" id="InputFileImgIndex"/>
                            </span>
                            <p class="text-danger count-upload"></p>
                        </div>
                    </div>
                </div>
                <div class="row">
                    <div class="col-md-4">
                        <div class="form-group">
                            <label for="InputFileImg">گالری</label><span style="font-size: 18px;"
                                                                         class="text-danger">*</span>(<span
                                    class="msgLabel">وارد کردن حداقل یک عکس الزامی می باشد</span>)
                            <br/>
                            <span class="btn btn-primary btn-file btn-green">
                                انتخاب کنید ...
                                <input type="file" name="file" value="<?php echo e(old('file')); ?>" dir="rtl" id="InputFileImg"/>
                                <span class="PercentUpload"></span>
                                <span class="Loading"></span>
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
                                    <div class="col-md-3 box-gallery-selector box-gallery<?php echo e($value->id); ?>"
                                         data-first-img="<?php if($key == 0): ?> 1 <?php else: ?> 0 <?php endif; ?>">
                                        <div class="box-img-host">
                                            <img src="<?php echo e(asset('Uploaded/Gallery/Img').'/'.$value->img); ?>"/>
                                            <?php if($key == 0): ?>
                                                <span class="first-img">
                                                    تصویر اصلی
                                                </span>
                                            <?php endif; ?>
                                        </div>
                                        <div class="box-img-remove">
                                            <button onclick="removeGalleryHost(<?php echo e($value->id); ?>,<?php echo e($hostModel->id); ?>)">حذف
                                            </button>
                                        </div>
                                    </div>
                                <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                            </div>
                        </div>
                    </div>
                </div>
                <br/>
                <div class="row">
                    <div class="col-md-2 col-md-offset-5">
                        <button type="button" id="step3" class="btn btn-default BtnRegAll btn-block">&nbsp; بعدی <i
                                    class="fa fa-angle-left"></i><i class="fa fa-angle-left"></i></button>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

<script>


    $('#InputFileImg').on('change', function () {
        $('.PercentUpload').html('');
        $('.Loading').html('');
        $('.count-upload').text('');
        var img = '<div class="text-center box-loading"><img style="height:50px;width:auto;" src="<?php echo e(asset('backend/img/img_loading/loading_calendar.gif')); ?>" /></div>';
        $('.Loading').append(img);
        var file = $(this)[0].files[0];
        var name = file.name;
        var size = file.size;
        var extension = name.split('.').pop().toLowerCase();
        if (jQuery.inArray(extension, ['gif', 'png', 'jpg', 'jpeg']) == -1) {
            AlertToast('ارسال تصویر', 'فرمت فایل صحیح نیست.', 'warning');
            $('.Loading').html('');
            return false;
        } else if (size > 2000000) {
            AlertToast('ارسال تصویر', 'حجم فایل ارسالی بیش از حد مجاز است.', 'warning');
            $('.Loading').html('');
            return false;
        }
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
            xhr: function () {
                //upload Progress
                var xhr = $.ajaxSettings.xhr();
                if (xhr.upload) {
                    xhr.upload.addEventListener('progress', function (event) {
                        var percent = 0;
                        var position = event.loaded || event.position;
                        var total = event.total;
                        if (event.lengthComputable) {
                            percent = Math.ceil(position / total * 100);
                        }
                        //update progressbar
                        $('.PercentUpload').text(percent + "%");
                    }, true);
                }
                return xhr;
            },
            success: function (data) {
                if (data.Success == '1') {
                    $('#ExtraGallery').append(data.url.original);
                    $('.box-loading').remove();
                    $('.PercentUpload').html('');
                } else if (data.Success == '0' && data.Message == 'false') {
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


    /* Get the checkboxes values based on the class attached to each check box */
    $('#step3').click(function () {

        var formData = new FormData();
        formData.append('host_id', $('#host_id').val());

        var file = $('#InputFileImgIndex')[0].files[0];
        if(file == undefined) {
            AlertToast('تصویر شاخص', 'تصویر شاخص نمی تواند خالی باشد.', 'warning');
            return false;
        }
        var name = file.name;
        var size = file.size;
        var extension = name.split('.').pop().toLowerCase();
        if (jQuery.inArray(extension, ['gif', 'png', 'jpg', 'jpeg']) == -1) {
            AlertToast('تصویر شاخص', 'فرمت عکس شاخص صحیح نیست.', 'warning');
            $('.Loading').html('');
            return false;
        } else if (size > 2000000) {
            AlertToast('تصویر شاخص', 'حجم عکس شاخص بیش از حد مجاز است.', 'warning');
            $('.Loading').html('');
            return false;
        }

        formData.append('img', file);

        $.ajaxSetup({
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            }
        });
        $.ajax({
            url: '<?php echo e(route('StoreHostStep4')); ?>',
            type: 'post',
            data: formData,
            processData: false,
            contentType: false,
            success: function (data) {
                if (data.Success == 0) {
                    $(".box-loading-step").fadeOut("slow", function () {
                        $('.box-loading-step').hide();
                    });
                    $('#myModal').modal('show');
                    $('#MsgErrorStep').text(data.Message);
                } else {
                    $(".box-loading-step").fadeOut("slow", function () {
                        $('.box-loading-step').hide();
                    });
                    $('#ExtraFormHost').html(data.Message.original);
                }
            }
        });

    });


    /****************************************
     *         Edit By Step Address         *
     ***************************************/


    $('.BtnEditStep').click(function () {
        return false;
        $(".box-loading-step").fadeIn("slow", function () {
            $(this).show();
        });
        var step = $(this).attr('data-value');
        var host_id = $('#host_id').val();
        $.ajaxSetup({
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            }
        });
        $.ajax({
            url: '<?php echo e(route('EditStep')); ?>',
            type: 'post',
            data: {
                host_id: host_id,
                step: step
            },
            success: function (data) {
                if (data.Success == 1) {
                    $(".box-loading-step").fadeOut("slow", function () {
                        $('.box-loading-step').hide();
                    });
                    $('#myModalEdit').modal('show');
                    $('#ExtraBoxEditStep').html(data.Message.original);
                }
            }
        });
    });
    $('span.information-step').click(function () {
        $('.box-information').toggleClass('show-information');
    });

    $('.check-description').click(function () {
        var key = $(this).attr('data-value');
        var input = $(this).parent().parent().parent().find('.input' + key);
        input.toggleClass('show');
    });

    function readURL(input) {
        if (input.files && input.files[0]) {
            var reader = new FileReader();
            reader.onload = function (e) {
                $(input).parent().parent().find('.images').attr('src', e.target.result);
            };
            reader.readAsDataURL(input.files[0]);
        }
    }

</script>

