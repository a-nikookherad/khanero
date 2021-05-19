<div class="panel-body">
    <div class="row">
        <div class="col-md-5 boxRooms">
            <div class="row">
                <div class="form-group">
                    <div class="col-md-6">
                        تعداد میهمان
                    </div>
                    <div class="col-md-6">
                        <label class="BtnAddSub BtnAdd" id="">+</label>

                        <input type="text" value="<?php echo e($hostModel->standard_guest); ?>" name="standard_guest" id="InputStandardGuest"
                               class="input-text" readonly/>

                        <label class="BtnAddSub BtnSub" id="">-</label>
                    </div>
                </div>
            </div>
            <br/>
            <div class="row">
                <div class="form-group">
                    <div class="col-md-6">
                        میهمان اضافه
                    </div>
                    <div class="col-md-6">
                        <label class="BtnAddSub BtnAdd" id="">+</label>

                        <input type="text" value="<?php echo e($hostModel->count_guest); ?>" name="count_guest" id="InputGuest"
                               class="input-text" readonly/>

                        <label class="BtnAddSub BtnSub" id="">-</label>
                    </div>
                </div>
            </div>
            <br/>
            <div class="row">
                <div class="form-group">
                    <div class="col-md-6">
                        اتاق خواب
                    </div>
                    <div class="col-md-6">
                        <label class="BtnAddSub" id="BtnAddCountRoom">+</label>

                        <input type="text" value="<?php echo e($hostModel->count_room); ?>" name="count_room" id="InputCountRoom"
                               class="input-text" readonly/>

                        <label class="BtnAddSub" id="BtnSubCountRoom1">-</label>
                    </div>
                </div>
            </div>
            <br/>
            <div class="row">
                <div class="form-group">
                    <div class="col-md-6">
                        دستشویی
                    </div>
                    <div class="col-md-6">
                        <label class="BtnAddSub BtnAdd" id="">+</label>

                        <input type="text" value="<?php echo e($hostModel->count_toilet); ?>" name="count_toilet" id="InputToilet"
                               class="input-text" readonly/>

                        <label class="BtnAddSub BtnSub" id="">-</label>
                    </div>
                </div>
            </div>
            <br/>
            <div class="row">
                <div class="form-group">
                    <div class="col-md-6">
                        حمام
                    </div>
                    <div class="col-md-6">
                        <label class="BtnAddSub BtnAdd" id="">+</label>

                        <input type="text" value="<?php echo e($hostModel->count_bathroom); ?>" name="count_bathroom"
                               id="InputBathroom" class="input-text" readonly/>

                        <label class="BtnAddSub BtnSub" id="">-</label>
                    </div>
                </div>
            </div>
            <br/>
            <div class="row">
                <div class="form-group">
                    <div class="col-md-6">
                        رخت خواب سنتی
                    </div>
                    <div class="col-md-6">
                        <label class="BtnAddSub BtnAdd" id="">+</label>

                        <input type="text" value="<?php echo e($hostModel->count_traditional_bed); ?>" name="count_traditional_bed"
                               id="InputTraditionalBed" class="input-text" readonly/>

                        <label class="BtnAddSub BtnSub" id="">-</label>
                    </div>
                </div>
            </div>
            <br/>
            <div class="row">
                <div class="form-group">
                    <div class="col-md-6">
                        تعداد تخت دو نفره
                    </div>
                    <div class="col-md-6">
                        <label class="BtnAddSub BtnAdd" id="">+</label>

                        <input type="text" value="<?php echo e($hostModel->double_bed); ?>" name="count_double_bed"
                               id="InputDoubleBedTotal" class="input-text" readonly/>

                        <label class="BtnAddSub BtnSub" id="">-</label>
                    </div>
                </div>
            </div>
            <br/>
            <div class="row">
                <div class="form-group">
                    <div class="col-md-6">
                        تعداد تخت یک نفره
                    </div>
                    <div class="col-md-6">
                        <label class="BtnAddSub BtnAdd" id="">+</label>

                        <input type="text" value="<?php echo e($hostModel->single_bed); ?>" name="count_single_bed"
                               id="InputSingleBedTotal" class="input-text" readonly/>

                        <label class="BtnAddSub BtnSub" id="">-</label>
                    </div>
                </div>
            </div>
        </div>
        <div class="col-md-7">
            <br/>
            <div class="boxRoom text-center">
                <?php $__currentLoopData = $roomModel; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $key => $value): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                    <div class="col-md-6 box">
                        <p class="">اتاق شماره <?php echo e($key+1); ?></p>
                        <div class="boxs">
                            <div class="col-md-4">
                                <img src="<?php echo e(asset('frontend/images/img2.png')); ?>" alt="">
                                <div class="row">
                                    <label class="BtnAddSub BtnAdds" id=""><i class="fa fa-angle-up"></i></label>
                                </div>
                                <div class="row">
                                    <input type="text" value="<?php echo e($value->double_beds); ?>" name="double_bed"
                                           id="InputDoubleBed" class="input-text" readonly/>
                                </div>
                                <div class="row">
                                    <label class="BtnAddSub BtnSubs" id=""><i class="fa fa-angle-down"></i></label>
                                </div>
                            </div>
                            <div class="col-md-4">
                                <img src="<?php echo e(asset('frontend/images/img1.png')); ?>" alt="">
                                <div class="row">
                                    <label class="BtnAddSub BtnAdds" id=""><i class="fa fa-angle-up"></i></label>
                                </div>
                                <div class="row">
                                    <input type="text" value="<?php echo e($value->single_beds); ?>" name="single_bed"
                                           id="InputSingleBed" class="input-text" readonly/>
                                </div>
                                <div class="row">
                                    <label class="BtnAddSub BtnSubs" id=""><i class="fa fa-angle-down"></i></label>
                                </div>
                            </div>
                            <div class="col-md-4">
                                <img src="<?php echo e(asset('frontend/images/img3.png')); ?>" alt="">
                                <div class="row">
                                    <label class="BtnAddSub BtnAdds" id=""><i class="fa fa-angle-up"></i></label>
                                </div>
                                <div class="row">
                                    <input type="text" value="<?php echo e($value->toilet_bathroom); ?>" name="shower" id="Shower"
                                           class="input-text" readonly/>
                                </div>
                                <div class="row">
                                    <label class="BtnAddSub BtnSubs" id=""><i class="fa fa-angle-down"></i></label>
                                </div>
                            </div>
                        </div>
                    </div>
                <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
            </div>
        </div>
    </div>
</div>

<div class="row">
    <div class="col-md-3 col-md-offset-3">
        <button type="button" id="BtnEdit" class="btn btn-default  btn-block">ثبت ویرایش</button>
    </div>
    <div class="col-md-3">
        <button type="button" id="BtnCancelUpdate" class="btn btn-default btn-block" data-dismiss="modal">انصراف
        </button>
    </div>
</div>
<br/>

<script>

    $('#BtnAddCountRoom').click(function () {
        var textbox = $(this).parent().parent().find('.input-text');
        var value = textbox[0].defaultValue;
        var numItems = $('.box').length + 1;
        textbox[0].defaultValue = parseFloat(value) + 1;
        var box = '<div class="col-md-6 box">\n' +
            '          <p class="">اتاق شماره ' + numItems + '</p>\n' +
            '          <div class="boxs">\n' +
            '              <div class="col-md-4">\n' +
            '                  <img src="<?php echo e(asset('frontend/images/img2.png')); ?>" alt="">\n' +
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
            '                  <img src="<?php echo e(asset('frontend/images/img1.png')); ?>" alt="">\n' +
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
            '                  <img src="<?php echo e(asset('frontend/images/img3.png')); ?>" alt="">\n' +
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

    $('.BtnAdd').click(function () {
        var textbox = $(this).parent().parent().find('.input-text');
        var value = textbox[0].defaultValue;
        textbox[0].defaultValue = parseFloat(value) + 1;
        return false;
    });

    $('.BtnSub').click(function () {
        var textbox = $(this).parent().parent().find('.input-text');
        // console.log(textbox[0].id);
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

    /* Get the checkboxes values based on the class attached to each check box */
    $('#BtnEdit').click(function () {
        $(".box-loading-step").fadeIn("slow", function () {
            $(this).show();
        });
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
        // alert(myArray);


        var formData = new FormData();
        formData.append('host_id', <?php echo e($hostModel->id); ?>);
        formData.append('step', 3);
        formData.append('standard_guest', $('#InputStandardGuest').val());
        formData.append('count_guest', $('#InputGuest').val());
        formData.append('count_room', $('#InputCountRoom').val());
        formData.append('count_toilet', $('#InputToilet').val());
        formData.append('count_bathroom', $('#InputBathroom').val());
        formData.append('count_traditional_bed', $('#InputTraditionalBed').val());
        formData.append('count_double_bed', $('#InputDoubleBedTotal').val());
        formData.append('count_single_bed', $('#InputSingleBedTotal').val());
        formData.append('rooms', JSON.stringify(myArray));
        // for (var pair of formData.entries()) {
        //     console.log(pair[0]+ ', ' + pair[1]);
        // }
        $.ajaxSetup({
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            }
        });
        $.ajax({
            url: '<?php echo e(route('UpdateHostStep')); ?>',
            type: 'post',
            data: formData,
            processData: false,
            contentType: false,
            success: function (data) {
                console.log(data);
                if(data.Success == 0)
                {
                    $(".box-loading-step").fadeOut("slow", function() {
                        $('.box-loading-step').hide();
                    });
                    $.Toast("<p>ویرایش</p>", "<p>"+data.Message+" .</p>", "warning", {
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
                else if(data.Success == 1){
                    $(".box-loading-step").fadeOut("slow", function() {
                        $('.box-loading-step').hide();
                    });
                    $.Toast("<p>ویرایش</p>", "<p>ثبت ویرایش موفقیت آمیز بود .</p>", "success", {
                        has_icon: true,
                        has_close_btn: true,
                        stack: true,
                        fullscreen: false,
                        timeout: 4000,
                        sticky: false,
                        has_progress: true,
                        rtl: true,
                    });
                    $('#BtnCancelUpdate').click();
                }
            }
        });
    });
</script>