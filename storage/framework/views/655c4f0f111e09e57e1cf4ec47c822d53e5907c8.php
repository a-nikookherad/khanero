<style>
    .progress .bar {
        width: 35%;
        background-color: #87c0af;
    }
</style>
<div class="address">
    <div class="col-md-12">
        <p>
            <button data-value="1" id="BtnEditStep1" class="btn BtnEditStep">اطلاعات اولیه</button>
            <button data-value="2" id="BtnEditStep2" class="btn BtnEditStep">موقعیت اقامتگاه</button>
            <button data-value="4" id="BtnEditStep4" class="btn" disabled>چیدمان اتاق ها</button>
        </p>
    </div>
</div>
<div class="row">
    <div class="col-md-12">
        <div class="panel panel-default">
            <div class="panel-heading">
                <h3 class="panel-title">چیدمان اتاق ها<span class="information-step"><i class="fas fa-info-circle"></i></span></h3>
                <div class="box-information show-information">
                    <p>
                        <span class="title-information">تعداد مهمان</span> : در این قسمت حداکثر ظرفیت اقامتگاه خود را وارد کنید(بر اساس فضا ، امکانات خواب).<br />
                        <span class="title-information">دستشویی</span> : در این قسمت تعداد کل دستشویی ها را وارد کنید، حتی دستشویی هایی که با حمام مشترک هستند .<br />
                        <span class="title-information">حمام</span>  : در این قسمت تعداد کل حمام ها را وارد کنید، حتی حمام هایی که با حمام مشترک هستند .<br />
                        <span class="title-information">چیدمان اتاق</span> : در این قسمت اتاق ها نام گذاری شده اند و برای هر اتاق وارد کنید که چه تعداد تخت دو نفره یا یک نفره یا رختخواب سنتی و یا چه تعداد حمام و ودسشویی .<br />
                        <span class="title-information">ظرفیت</span> : ظرفیت استاندارد با محاسبه تعداد تخت خواب و رخت خواب سنتی محاسبه میشود .
                    </p>
                </div>
            </div>
            <div class="panel-body">
                <div class="row">
                    <div class="col-md-4 boxRooms">
                        <div class="row">
                            <div class="form-group">
                                <div class="col-md-6">
                                    ظرفیت استاندارد
                                </div>
                                <div class="col-md-6">
                                    <label class="BtnAddSub BtnAdd" id="">+</label>

                                    <input type="text" value="1" name="standard_guest" id="InputStandardGuest" class="input-text" readonly />

                                    <label class="BtnAddSub BtnSub" id="">-</label>
                                </div>
                            </div>
                        </div>
                        <br />
                        <div class="row">
                            <div class="form-group">
                                <div class="col-md-6">
                                    تعداد میهمان(حداکثر ظرفیت)
                                </div>
                                <div class="col-md-6">
                                    <label class="BtnAddSub BtnAdd" id="">+</label>

                                    <input type="text" value="1" name="count_guest" id="InputGuest" class="input-text" readonly />

                                    <label class="BtnAddSub BtnSub" id="">-</label>
                                </div>
                            </div>
                        </div>
                        <br />
                        <div class="row">
                            <div class="form-group">
                                <div class="col-md-6">
                                    اتاق خواب
                                </div>
                                <div class="col-md-6">
                                    <label class="BtnAddSub" id="BtnAddCountRoom">+</label>

                                    <input type="text" value="0" name="count_room" id="InputCountRoom" class="input-text" readonly />

                                    <label class="BtnAddSub" id="BtnSubCountRoom">-</label>
                                </div>
                            </div>
                        </div>
                        <br />
                        <div class="row">
                            <div class="form-group">
                                <div class="col-md-6">
                                    دستشویی
                                </div>
                                <div class="col-md-6">
                                    <label class="BtnAddSub BtnAdd" id="">+</label>

                                    <input type="text" value="0" name="count_toilet" id="InputToilet" class="input-text" readonly />

                                    <label class="BtnAddSub BtnSub" id="">-</label>
                                </div>
                            </div>
                        </div>
                        <br />
                        <div class="row">
                            <div class="form-group">
                                <div class="col-md-6">
                                    حمام
                                </div>
                                <div class="col-md-6">
                                    <label class="BtnAddSub BtnAdd" id="">+</label>

                                    <input type="text" value="0" name="count_bathroom" id="InputBathroom" class="input-text" readonly />

                                    <label class="BtnAddSub BtnSub" id="">-</label>
                                </div>
                            </div>
                        </div>
                        <br />
                        <div class="row">
                            <div class="form-group">
                                <div class="col-md-6">
                                    رخت خواب سنتی
                                </div>
                                <div class="col-md-6">
                                    <label class="BtnAddSub BtnAdd" id="">+</label>

                                    <input type="text" value="0" name="count_traditional_bed" id="InputTraditionalBed" class="input-text" readonly />

                                    <label class="BtnAddSub BtnSub" id="">-</label>
                                </div>
                            </div>
                        </div>
                        <br />
                        <div class="row">
                            <div class="form-group">
                                <div class="col-md-6">
                                    تعداد تخت دو نفره
                                </div>
                                <div class="col-md-6">
                                    <label class="BtnAddSub BtnAdd" id="">+</label>

                                    <input type="text" value="0" name="count_double_bed" id="InputDoubleBedTotal" class="input-text" />

                                    <label class="BtnAddSub BtnSub" id="">-</label>
                                </div>
                            </div>
                        </div>
                        <br />
                        <div class="row">
                            <div class="form-group">
                                <div class="col-md-6">
                                    تعداد تخت یک نفره
                                </div>
                                <div class="col-md-6">
                                    <label class="BtnAddSub BtnAdd" id="">+</label>

                                    <input type="text" value="0" name="count_single_bed" id="InputSingleBedTotal" class="input-text" />

                                    <label class="BtnAddSub BtnSub" id="">-</label>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="col-md-5">
                        <br />
                        <div class="boxRoom text-center">

                        </div>
                    </div>
                </div>
                <br />
                <div class="row">
                    <div class="col-md-2 col-md-offset-5">
                        <button type="button" id="step4" class="btn btn-default BtnRegAll btn-block">&nbsp; بعدی  <i class="fa fa-angle-left"></i><i class="fa fa-angle-left"></i></button>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

<script>

    $('#BtnAddCountRoom').click(function () {
        var textbox = $(this).parent().parent().find('.input-text');
        var value  = textbox[0].defaultValue;
        var numItems = $('.box').length+1;
        textbox[0].defaultValue = parseFloat(value)+1;
        var box = '<div class="col-md-6 box">\n' +
            '          <p class="">اتاق شماره '+ numItems +'</p>\n' +
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
        // console.log(textbox[0].id);
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



    /* Get the checkboxes values based on the class attached to each check box */
    $('#step4').click(function () {
        $(".box-loading-step").fadeIn("slow", function() {
            $(this).show();
        });
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
                myArray[i][0]=(arrayBox.eq(i).find('#InputDoubleBed').val());
                myArray[i][1]=(arrayBox.eq(i).find('#InputSingleBed').val());
                myArray[i][2]=(arrayBox.eq(i).find('#Shower').val());
            }
        }
        // console.log(myArray);


        var formData = new FormData();
        formData.append('host_id', $('#host_id').val());
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
            url: '<?php echo e(route('StoreHostStep3')); ?>',
            type: 'post',
            data: formData,
            processData: false,
            contentType: false,
            success: function (data) {
                console.log(data);
                if (data.Success == 0) {
                    $(".box-loading-step").fadeOut("slow", function () {
                        $('.box-loading-step').hide();
                    });
                    $('#myModal').modal('show');
                    $('#MsgErrorStep').text(data.Message);
                }
                else {
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
</script>