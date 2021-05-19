<?php ($buildingTypeModel = App\Modules\Possibilities\Controllers\PossibilitiesController::GetBuildingType()); ?>
<?php ($homeTypeModel = App\Modules\Possibilities\Controllers\PossibilitiesController::GetHomeType()); ?>

<style>
    .progress .bar {
        width: 5%;
        background-color: #a7a7a7;
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

    .number {
        display: flex;
    }

    .number input[type=text] {
        background-color: white;
        border: 1px solid #ddd;
        width: 40px;
        text-align: center;
        margin: 0px 10px 0px 5px;
    }

    span.minus, span.plus {
        float: left;
        background: #fff;
        width: 30px;
        height: 30px;
        margin-top: 7px;
        border-radius: 50%;
        line-height: 29px;
        font-size: 14px;
        font-weight: bold;
        margin-right: 6px;
        color: #000;
        cursor: pointer;
        border: 1px solid #9f9c9c;
        text-align: center;
    }

</style>

<div class="address">
    <div class="col-md-12">
        <p>
            <button data-value="1" id="BtnEditStep1" class="btn btn-enable">فضای اقامتگاه</button>
            <button data-value="4" id="BtnEditStep4" class="btn btn-disable" disabled>امکانات</button>
            <button data-value="2" id="BtnEditStep2" class="btn btn-disable" disabled>تصاویر</button>
            <button data-value="7" id="BtnEditStep7" class="btn btn-disable" disabled>اطلاعات اقامتگاه</button>
            <button data-value="3" id="BtnEditStep3" class="btn btn-disable" disabled>ظرفیت</button>
            <button data-value="6" id="BtnEditStep6" class="btn btn-disable" disabled>قیمت گذاری</button>
            <button data-value="2" id="BtnEditStep2" class="btn btn-disable" disabled>آدرس</button>
            <button data-value="5" id="BtnEditStep5" class="btn btn-disable" disabled>قوانین اقامتگاه</button>
        </p>
    </div>
</div>
<div class="row">
    <div class="col-md-12">
        <div class="panel panel-default">
            <div class="panel-heading">
                <h3 class="panel-title">اطلاعات اولیه<span class="information-step"><i
                                class="fas fa-info-circle"></i></span></h3>
                <div class="box-information show-information">
                    <p>
                        <span class="title-information">اطلاعات ثبت</span> : در این حالت اقامتگاه به صورت یکجا در اختیار
                        مهمان قرار می گیرد.<br/>
                    </p>
                </div>
            </div>
            <div class="panel-body">
                
                
                
                
                
                
                
                
                
                
                
                

                
                
                
                
                
                
                
                
                
                
                
                
                
                
                
                
                
                
                
                
                
                
                
                
                
                
                
                

                
                <div class="row">
                    <div class="col-md-9">
                        <div class="form-group">
                            <label for="SelectBuildingType">نوع اقامتگاه خود را مشخص کنید</label>
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
                    <div class="col-md-9">
                        <div class="">
                            <label>عنوان اقامتگاه خود را مشخص کنید</label>
                        </div>
                        <div class="">
                            <div class="form-group">
                                <input type="text" class="form-control" name="" id="InputHostName"
                                       placeholder="نام اقامتگاه - برای مثال : ویلای ۴۰۰ متری دوبلکس دماوند"/>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="row">
                    <div class="col-md-3">
                        <div class="form-group">
                            <label for="InputMeter">متراژ اقامتگاه</label>
                            <input type="text" name="meter" class="form-control" id="InputMeter"
                                   placeholder="متراژ را وارد کنید"/>
                        </div>
                    </div>
                    <div class="col-md-3">
                        <div class="form-group">
                            <label for="InputMeterTotal">متراژ کل زمین</label>
                            <input type="text" name="meter_total" class="form-control" id="InputMeterTotal"
                                   placeholder="متراژ کل بنا را وارد کنید"/>
                        </div>
                    </div>
                    <div class="col-md-3">
                        <div class="form-group">
                            <label for="InputYear">سال ساخت</label>
                            <input type="text" name="year" class="form-control" id="InputYear"
                                   placeholder="سال ساخت بنا را وارد کنید"/>
                        </div>
                    </div>
                </div>
                <div class="row">
                    <div class="col-md-3">
                        <div class="form-group">
                            <label for="InputReconstruction">مدل بازسازی</label>
                            <input type="text" name="reconstruction" class="form-control" id="InputReconstruction"
                                   placeholder="اختیاری"/>
                        </div>
                    </div>
                    <div class="col-md-3">
                        <div class="form-group">
                            <label for="InputBuildingFloors">تعداد طبقات کل ساختمان</label>
                            <input type="text" name="building_floor" class="form-control" id="InputBuildingFloors"
                                   placeholder="تعداد طبقات کل ساختمان"/>
                        </div>
                    </div>
                    <div class="col-md-3">
                        <div class="form-group">
                            <label for="InputUnitsPerFloor">تعداد واحد در هر طبقه</label>
                            <input type="text" name="units_per_floor" class="form-control" id="InputUnitsPerFloor"
                                   placeholder="تعداد واحد در هر طبقه"/>
                        </div>
                    </div>
                </div>
                <div class="row">
                    <div class="col-md-3">
                        <div class="form-group">
                            <label for="">نوع فضای اجاره</label>
                            <br/>
                            <input type="radio" value="1" name="type_rent" checked id="InputTypeRent1"/> <label
                                    for="InputTypeRent1"> مجزا </label>
                            <input type="radio" value="2" name="type_rent" id="InputTypeRent2"/> <label
                                    for="InputTypeRent2"> اشتراکی </label>
                        </div>
                    </div>
                    <div class="col-md-3">
                        <div class="form-group">
                            <label for="">شکل اقامتگاه</label>
                            <br/>
                            <input type="radio" value="1" name="shape_host" checked id="InputShapeHost1"/> <label
                                    for="InputShapeHost1"> مسطح </label>
                            <input type="radio" value="2" name="shape_host" id="InputShapeHost2"/> <label
                                    for="InputShapeHost2"> دوبلکس </label>
                            <input type="radio" value="3" name="shape_host" id="InputShapeHost3"/> <label
                                    for="InputShapeHost3"> تریبلکس </label>
                        </div>
                    </div>
                </div>
                <div class="row">

                    <div class="col-md-12">
                        <label for="">تعداد اتاق</label>
                        <div class="number">
                            <span class="icon-number"></span>
                            <span class="minus minus-room"><i class="fas fa-minus"></i></span>
                            <input type="text" value="0" class="input-text" id="InputCountRoom" readonly placeholder="تعداد نفرات">
                            <span class="plus plus-room"><i class="fas fa-plus"></i></span>
                        </div>
                    </div>

                    <script>
                        $(document).ready(function () {
                            $('.minus').click(function () {
                                var $input = $(this).parent().find('input');
                                var count = parseInt($input.val()) - 1;
                                count = count < 1 ? 0 : count;
                                $input.val(count);
                                $input.change();
                                return false;
                            });
                            $('.plus').click(function () {
                                var $input = $(this).parent().find('input');
                                $input.val(parseInt($input.val()) + 1);
                                $input.change();
                                return false;
                            });
                        });

                        $('.plus-room').click(function () {
                            // var textbox = $(this).parent().find('.input-text');
                            // var value  = textbox[0].defaultValue;
                            var numItems = $('.box').length + 1;
                            // textbox[0].defaultValue = parseFloat(value)+1;
                            var box = '<div class="col-md-6 box">\n' +
                                '          <p class="">اتاق شماره ' + numItems + '</p>\n' +
                                '          <div class="boxs">\n' +
                                '              <div class="col-md-3">\n' +
                                '                  تخت یک نفره\n' +
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
                                '              <div class="col-md-3">\n' +
                                '                  تخت دونفره\n' +
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
                                '              <div class="col-md-3">\n' +
                                '                  مبل تخت خواب شو\n' +
                                '                  <div class="row">\n' +
                                '                      <label class="BtnAddSub BtnAdds" id=""><i class="fa fa-angle-up"></i></label>\n' +
                                '                  </div>\n' +
                                '                  <div class="row">\n' +
                                '                      <input type="text" value="0" name="sofa_bed" id="InputSofaBed" class="input-text" readonly />\n' +
                                '                  </div>\n' +
                                '                  <div class="row">\n' +
                                '                      <label class="BtnAddSub BtnSubs" id=""><i class="fa fa-angle-down"></i></label>\n' +
                                '                  </div>\n' +
                                '              </div>\n' +
                                '              <div class="col-md-3">\n' +
                                '                  رخت خواب کف\n' +
                                '                  <div class="row">\n' +
                                '                      <label class="BtnAddSub BtnAdds" id=""><i class="fa fa-angle-up"></i></label>\n' +
                                '                  </div>\n' +
                                '                  <div class="row">\n' +
                                '                      <input type="text" value="0" name="traditional_bedding" id="InputTraditionalBedding" class="input-text" readonly />\n' +
                                '                  </div>\n' +
                                '                  <div class="row">\n' +
                                '                      <label class="BtnAddSub BtnSubs" id=""><i class="fa fa-angle-down"></i></label>\n' +
                                '                  </div>\n' +
                                '              </div>\n' +
                                '          </div>\n' +
                                '       </div>';
                            $('.boxRoom').append(box);

                        });


                        $('.minus-room').click(function () {
                            var textbox = $(this).parent().parent().find('.input-text');
                            var value = textbox[0].defaultValue;
                            if (value == 0) {
                                value = 1;
                            }
                            textbox[0].defaultValue = parseFloat(value) - 1;
                            var element = $('.boxRoom .box:last-child');
                            element.remove();
                        });
                    </script>


                    <div class="boxRoom">

                    </div>

                    <br />
                    <div class="col-md-6 box-reception">
                        <label class="">فضای حال</label>
                        <div class="boxs_reception">
                            <div class="col-md-3">
                                تخت یک نفره
                                <div class="row">
                                    <label class="BtnAddSub BtnAdds" id=""><i class="fa fa-angle-up"></i></label>
                                </div>
                                <div class="row">
                                    <input type="text" value="0" name="single_bed_reception" id="InputSingleBedReception"
                                           class="input-text" readonly/>
                                </div>
                                <div class="row">
                                    <label class="BtnAddSub BtnSubs" id=""><i class="fa fa-angle-down"></i></label>
                                </div>
                            </div>
                            <div class="col-md-3">
                                تخت دونفره
                                <div class="row">
                                    <label class="BtnAddSub BtnAdds" id=""><i class="fa fa-angle-up"></i></label>
                                </div>
                                <div class="row">
                                    <input type="text" value="0" name="double_bed_reception" id="InputDoubleBedReception"
                                           class="input-text" readonly/>
                                </div>
                                <div class="row">
                                    <label class="BtnAddSub BtnSubs" id=""><i class="fa fa-angle-down"></i></label>
                                </div>
                            </div>
                            <div class="col-md-3">
                                مبل تخت خواب شو
                                <div class="row">
                                    <label class="BtnAddSub BtnAdds" id=""><i class="fa fa-angle-up"></i></label>
                                </div>
                                <div class="row">
                                    <input type="text" value="0" name="sofa_bed_reception" id="SofaBedReception" class="input-text" readonly/>
                                </div>
                                <div class="row">
                                    <label class="BtnAddSub BtnSubs" id=""><i class="fa fa-angle-down"></i></label>
                                </div>
                            </div>
                            <div class="col-md-3">
                                رخت خواب کف
                                <div class="row">
                                    <label class="BtnAddSub BtnAdds" id=""><i class="fa fa-angle-up"></i></label>
                                </div>
                                <div class="row">
                                    <input type="text" value="0" name="traditional_bedding_reception" id="TraditionalBeddingReception" class="input-text" readonly/>
                                </div>
                                <div class="row">
                                    <label class="BtnAddSub BtnSubs" id=""><i class="fa fa-angle-down"></i></label>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="row">
                    <div class="col-md-2 col-md-offset-5">
                        <button type="button" id="step1" class="btn btn-default BtnRegAll btn-block">&nbsp; بعدی
                            <i class="fa fa-angle-left"></i><i class="fa fa-angle-left"></i>
                        </button>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

<script>

    $('#InputFileImg').on('change', function () {
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


    $('#step1').click(function () {
        $(".box-loading-step").fadeIn("slow", function () {
            $(this).show();
        });
        var formData = new FormData();
        formData.append('host_id', $('#host_id').val());
        // formData.append('home_type_id', $('#SelectHomeType option:selected').val());
        formData.append('building_type_id', $('#SelectBuildingType option:selected').val()); // نوع اقامتگاه
        formData.append('meter', $('#InputMeter').val()); // متراژ اقامتگاه
        formData.append('meter_total', $('#InputMeterTotal').val()); // متراژ کل زمین
        formData.append('host_name', $('#InputHostName').val()); // عنوان اقامتگاه
        formData.append('year', $('#InputYear').val()); // سال ساخت
        formData.append('reconstruction', $('#InputReconstruction').val()); // مدل بازسازی
        formData.append('building_floor', $('#InputBuildingFloors').val()); // تعداد طبقات کل ساختمان
        formData.append('units_per_floor', $('#InputUnitsPerFloor').val()); // تعداد واحد در هر طبقه
        formData.append('type_rent', $('input[name="type_rent"]:checked').val()); // نوع فضای اجاره
        formData.append('shape_host', $('input[name="shape_host"]:checked').val()); // شکل اقامتگاه
        formData.append('count_room', $('#InputCountRoom').val()); // تعداد اتاق خواب
        formData.append('single_bed_reception', $('#InputSingleBedReception').val()); // تخت یک نفره
        formData.append('double_bed_reception', $('#InputDoubleBedReception').val()); // تخت دو نفره
        formData.append('sofa_bed_reception', $('#SofaBedReception').val()); // مبل تخت خواب شو
        formData.append('traditional_bedding_reception', $('#TraditionalBeddingReception').val()); // رخت خواب سنتی پذیرایی

        // محاسبه تعداد اتاق خواب
        var countRoom = $('#InputCountRoom').val();
        var arrayBox = $(".boxs");

        var myArray = [];
        for( var i=0; i<countRoom; i++ ) {
            myArray.push( [] );
        }
        for (var i = 0; i < countRoom; i++)
        {
            for (var j =  0; j < 3; j++)
            {
                myArray[i][0]=(arrayBox.eq(i).find('#InputSingleBed').val());
                myArray[i][1]=(arrayBox.eq(i).find('#InputDoubleBed').val());
                myArray[i][2]=(arrayBox.eq(i).find('#InputSofaBed').val());
                myArray[i][3]=(arrayBox.eq(i).find('#InputTraditionalBedding').val());
            }
        }


        formData.append('rooms', JSON.stringify(myArray));

        $.ajaxSetup({
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            }
        });
        $.ajax({
            url: '<?php echo e(route('StoreHostStep1')); ?>',
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


    $('#BtnSubCountRoom').click(function () {
        var textbox = $(this).parent().parent().find('.input-text');
        var value = textbox[0].defaultValue;
        if (value == 0) {
            value = 1;
        }
        textbox[0].defaultValue = parseFloat(value) - 1;
        var element = $('.boxRoom .box:last-child');
        element.remove();
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
    $('span.information-step').click(function () {
        $('.box-information').toggleClass('show-information');
    });

</script>
