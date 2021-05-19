<div class="Titl-step-S rows-address row">
    <div class="col-md-2 each-step register">
        <div class="Numbr-Step">1</div>
        <span class="after-finish"><i class="far fa-check"></i></span>
        <div class="poly"><a href="<?php echo e(route('CreateHostStep', ['id' => $hostModel->id, 'step' => 0])); ?>">مشخصات
                اقامتگاه</a></div>
    </div>
    <div class="col-md-2 each-step register">
        <div class="Numbr-Step">2</div>
        <span class="after-finish"><i class="far fa-check"></i></span>
        <div class="poly"><a href="<?php echo e(route('CreateHostStep', ['id' => $hostModel->id, 'step' => 1])); ?>">موقعیت</a></div>
    </div>
    <div class="col-md-2 each-step register">
        <div class="Numbr-Step">3</div>
        <span class="after-finish"><i class="far fa-check"></i></span>
        <div class="poly"><a href="<?php echo e(route('CreateHostStep', ['id' => $hostModel->id, 'step' => 2])); ?>">امکانات و
                خدمات</a></div>
    </div>
    <div class="col-md-2 each-step active">
        <div class="Numbr-Step">4</div>
        <div class="poly">تصاویر</div>
    </div>
    <div class="col-md-2 each-step">
        <div class="Numbr-Step">5</div>
        <div class="poly">قوانین صاحبخانه</div>
    </div>
    <div class="col-md-2 each-step">
        <div class="Numbr-Step">6</div>
        <div class="poly">قیمت گذاری</div>
    </div>
</div>
<div class="Body-step-S">
    <div class="panel-heading">
        <h3 class="panel-title">تصاویر اقامتگاه<span class="information-step"><i class="fas fa-info-circle"></i></span>
        </h3>
    </div>
    <div class="panel-body row">
        <div class="col-md-8">
            
            
            
            
            
            
            
            
            
            
            
            
            
            
            <div class="row">
                <div class="col-md-12">
                    <div class="form-group row">
                        <div class="col-sm-8">
                            <label class="title-S" for="InputFileImg">گالری</label>
                            <span class="neccry-star">*</span>
                            <span class="describ-extra">
                                           به ترتیت عکس هایی از پذیرایی , حال , آشپزخانه , اتاق ها ,سرویس بهداشتی و حمام , فضای بیرون و حیاط بارگزاری کنید
                                        </span>

                        </div>
                        <div class="col-sm-4">
                                        <span class="btn btn-primary btn-file btn-green">
                                        افزودن عکس
                                        <i class="fa fa-plus" aria-hidden="true"></i>
                                        <input type="file" name="file" value="<?php echo e(old('file')); ?>" dir="rtl"
                                               id="InputFileImg" />
                                        <span class="PercentUpload"></span>
                                        <span class="Loading"></span>
                                    </span>
                            <p class="text-danger count-upload"></p>
                        </div>
                    </div>
                    <?php if($errors->has('file')): ?>
                        <span style="color:red;"><?php echo e($errors->first('file')); ?></span>
                    <?php endif; ?>
                </div>
                <div class="col-md-12">
                    <div class="row">
                        <div id="ExtraGallery">
                            <?php $__currentLoopData = $hostModel->getGallery; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $key => $value): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                <div class="col-md-4 box-gallery-selector box-gallery<?php echo e($value->id); ?>"
                                     data-first-img="<?php if($key == 0): ?> 1 <?php else: ?> 0 <?php endif; ?>">
                                    <div class="box-img-host">
                                        <img src="<?php echo e(asset('Uploaded/Gallery/Img').'/'.$value->img); ?>"/>
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
        </div>
        <div class="col-md-4">
            <div class="box-information">
                <p class="title-info">
                    تصاویر ملک
                </p>
                <p>
                    لورم ایپسوم متن ساختگی با تولید سادگی نامفهوم از صنعت چاپ و با استفاده از طراحان گرافیک است چاپگرها
                    و متون بلکه روزنامه و مجله در ستون و سطرآنچنان که لازم است و برای شرایط فعلی تکنولوژی مورد نیاز و
                    کاربردهای متنوع با هدف بهبود ابزارهای کاربردی می باشد کتابهای زیادی در شصت و سه درصد گذشته حال و
                    آینده شناخت فراوان جامعه و متخصصان را می طلبد تا با نرم افزارها شناخت بیشتری را برای طراحان رایانه
                    ای علی الخصوص طراحان خلاقی و فرهنگ پیشرو در زبان فارسی ایجاد کرد
                </p>
            </div>
        </div>
        <div class="col-md-12 row btn-footer">
            <div class="col-md-6 text-right">
                <a href="<?php echo e(route('CreateHostStep', ['id' => $hostModel->id, 'step' => 2])); ?>"
                   class="prv-btn btn btn-default btn-block"> <i class="fa fa-angle-right"></i><i
                            class="fa fa-angle-right"></i> مرحله قبلی </a>
            </div>
            <div class="col-md-6 text-left">
                <button type="button" id="step4" class="nxt-btn btn btn-default BtnRegAll btn-block">&nbsp; بعدی <i
                            class="fa fa-angle-left"></i><i class="fa fa-angle-left"></i></button>
            </div>
        </div>
    </div>
</div>

<script>
    $('#InputFileImg').on('change', function () {

        // var formData = new FormData();
        // $.each($('#InputFileImg'), function(i, obj) {
        //     $.each(obj.files,function(i,file){
        //         formData.append('photo['+i+']', file);
        //     })
        // });
        // console.log((formData));
        // return  false;
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
        } else if (size > 20000000) {
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
    $('#step4').click(function () {

        $(".box-loading-step").fadeIn("slow", function () {
            $(this).show();
        });
        var formData = new FormData();
        formData.append('host_id', $('#host_id').val());

        // var file = $('#InputFileImgIndex')[0].files[0];
        // if(file == undefined) {
        //     AlertToast('تصویر شاخص', 'تصویر شاخص نمی تواند خالی باشد.', 'warning');
        //     return false;
        // }
        // var name = file.name;
        // var size = file.size;
        // var extension = name.split('.').pop().toLowerCase();
        // if (jQuery.inArray(extension, ['gif', 'png', 'jpg', 'jpeg']) == -1) {
        //     AlertToast('تصویر شاخص', 'فرمت عکس شاخص صحیح نیست.', 'warning');
        //     $('.Loading').html('');
        //     return false;
        // } else if (size > 2000000) {
        //     AlertToast('تصویر شاخص', 'حجم عکس شاخص بیش از حد مجاز است.', 'warning');
        //     $('.Loading').html('');
        //     return false;
        // }

        // formData.append('img', file);

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

