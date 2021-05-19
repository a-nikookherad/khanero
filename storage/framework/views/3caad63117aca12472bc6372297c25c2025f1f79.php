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

<div class="row text-center">
    <div class="col-md-12">
        <div class="row rows-address">
            <div class="col-md-2">
                <div class="poly active">
                    <span>
                        <?php if($hostModel->step >= 0): ?>
                            <a href="<?php echo e(route('EditHost', ['id' => $hostModel->id, 'step' => 1])); ?>">مشخصات اقامتگاه</a>
                        <?php else: ?>
                            <a>مشخصات اقامتگاه</a>
                        <?php endif; ?>
                    </span>
                </div>
            </div>
            <div class="col-md-2">
                <div class="poly">
                    <span>
                        <?php if($hostModel->step > 1): ?>
                            <a href="<?php echo e(route('EditHost', ['id' => $hostModel->id, 'step' => 2])); ?>">موقعیت</a>
                        <?php else: ?>
                            <a>موقعیت</a>
                        <?php endif; ?>
                    </span>
                </div>
            </div>
            <div class="col-md-2">
                <div class="poly">
                    <span>
                        <?php if($hostModel->step > 2): ?>
                            <a href="<?php echo e(route('EditHost', ['id' => $hostModel->id, 'step' => 3])); ?>">امکانات</a>
                        <?php else: ?>
                            <a>امکانات</a>
                        <?php endif; ?>
                    </span>
                </div>
            </div>
            <div class="col-md-2">
                <div class="poly">
                    <span>
                        <?php if($hostModel->step > 3): ?>
                            <a href="<?php echo e(route('EditHost', ['id' => $hostModel->id, 'step' => 4])); ?>">تصاویر</a>
                        <?php else: ?>
                            <a>تصاویر</a>
                        <?php endif; ?>
                    </span>
                </div>
            </div>
            <div class="col-md-2">
                <div class="poly">
                    <span>
                        <?php if($hostModel->step > 4): ?>
                            <a href="<?php echo e(route('EditHost', ['id' => $hostModel->id, 'step' => 5])); ?>">قوانین صاحبخانه</a>
                        <?php else: ?>
                            <a>قوانین صاحبخانه</a>
                        <?php endif; ?>
                    </span>
                </div>
            </div>
            <div class="col-md-2">
                <div class="poly">
                    <span>
                        <?php if($hostModel->step > 5): ?>
                            <a href="<?php echo e(route('EditHost', ['id' => $hostModel->id, 'step' => 6])); ?>">قیمت گذاری</a>
                        <?php else: ?>
                            <a>قیمت گذاری</a>
                        <?php endif; ?>
                    </span>
                </div>
            </div>
        </div>
    </div>
</div>
<div class="row">
    <div class="col-md-12">
        <div class="panel panel-default">
            <div class="panel-heading">
                <h3 class="panel-title">
                    مشخصات اقامتگاه
                    <span class="information-step"><i class="fas fa-info-circle"></i></span>
                </h3>
            </div>
            <div class="panel-body">
                <div class="row">
                    <div class="col-md-8">
                        <div class="row">
                            <div class="col-md-12">
                                <div class="form-group">
                                    <label for="SelectBuildingType">نوع اقامتگاه خود را مشخص کنید</label>
                                    <select class="form-control" id="SelectBuildingType" name="building_type">
                                        <option hidden value="">انتخاب کنید</option>
                                        <?php $__currentLoopData = $buildingTypeModel; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $key => $value): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                            <option value="<?php echo e($value->id); ?>"
                                                    <?php if($value->id == $hostModel->building_type_id): ?> selected <?php endif; ?> >
                                                <?php echo e($value->name); ?>

                                            </option>
                                        <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                                    </select>
                                </div>
                                <?php if($errors->has('building_type')): ?>
                                    <span style="color:red;"><?php echo e($errors->first('building_type')); ?></span>
                                <?php endif; ?>
                            </div>
                            <div class="col-md-12">
                                <div class="">
                                    <label>عنوان اقامتگاه خود را مشخص کنید</label>
                                </div>
                                <div class="">
                                    <div class="form-group">
                                        <input type="text" class="form-control" value="<?php echo e($hostModel->name); ?>" name=""
                                               id="InputHostName"
                                               placeholder="نام اقامتگاه - برای مثال : ویلای ۴۰۰ متری دوبلکس دماوند"/>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-md-4">
                                <div class="form-group">
                                    <label for="InputMeter">متراژ اقامتگاه</label>
                                    <input type="text" name="meter" value="<?php echo e($hostModel->meter); ?>" class="form-control"
                                           id="InputMeter"
                                           placeholder="متراژ را وارد کنید"/>
                                </div>
                            </div>
                            <div class="col-md-4 meter-total" style="display: none">
                                <div class="form-group">
                                    <label for="InputMeterTotal">متراژ کل زمین</label>
                                    <input type="text" name="meter_total" value="<?php echo e($hostModel->meter_total); ?>"
                                           class="form-control" id="InputMeterTotal"
                                           placeholder="متراژ کل بنا را وارد کنید"/>
                                </div>
                            </div>
                            <div class="col-md-4">
                                <div class="form-group">
                                    <label for="InputYear">سال ساخت</label>
                                    <select class="form-control" id="InputYear">
                                        <?php for($i = 1350; $i <= 1400; $i++): ?>
                                            <option value="<?php echo e($i); ?>" <?php if($i == $hostModel->year): ?> selected <?php endif; ?>>
                                                <?php echo e($i); ?>

                                            </option>
                                        <?php endfor; ?>
                                    </select>
                                </div>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-md-4">
                                <div class="form-group">
                                    <label for="">بازسازی شده؟</label>
                                    <br/>
                                    <input type="radio" value="1" name="reconstruction"
                                           <?php if($hostModel->reconstruction == 1): ?> checked
                                           <?php endif; ?> id="InputReconstruction1"/>
                                    <label for="InputReconstruction1"> بله </label>
                                    <input type="radio" value="2" name="reconstruction"
                                           <?php if($hostModel->reconstruction == '' || $hostModel->reconstruction == 2): ?> checked
                                           <?php endif; ?> id="InputReconstruction2"/>
                                    <label for="InputReconstruction2"> خیر </label>
                                </div>
                            </div>
                            <div class="col-md-4">
                                <div class="form-group">
                                    <label for="InputBuildingFloors">تعداد طبقات کل ساختمان</label>
                                    <select class="form-control" id="InputBuildingFloors">
                                        <?php for($i = 1; $i <= 30; $i++): ?>
                                            <option value="<?php echo e($i); ?>"
                                                    <?php if($i == $hostModel->building_floor): ?> selected <?php endif; ?>><?php echo e($i); ?>

                                            </option>
                                        <?php endfor; ?>
                                    </select>
                                </div>
                            </div>
                            <div class="col-md-4">
                                <div class="form-group">
                                    <label for="InputUnitsPerFloor">تعداد واحد در هر طبقه</label>
                                    <select class="form-control" id="InputUnitsPerFloor">
                                        <?php for($i = 1; $i <= 6; $i++): ?>
                                            <option value="<?php echo e($i); ?>"
                                                    <?php if($i == $hostModel->units_per_floor): ?> selected <?php endif; ?>><?php echo e($i); ?>

                                            </option>
                                        <?php endfor; ?>
                                    </select>
                                </div>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-md-4">
                                <div class="form-group">
                                    <label for="">نوع مورد اجاره</label>
                                    <br/>
                                    <input type="radio" value="1" name="type_rent"
                                           <?php if($hostModel->type_rent == 1): ?> checked <?php elseif($hostModel->type_rent == null): ?> checked <?php endif; ?> id="InputTypeRent1"/> <label
                                            for="InputTypeRent1"> مجزا </label>
                                    <input type="radio" value="2" name="type_rent"
                                           <?php if($hostModel->type_rent == 2): ?> checked <?php endif; ?> id="InputTypeRent2"/> <label
                                            for="InputTypeRent2"> دربستی </label>
                                    <input type="radio" value="3" name="type_rent"
                                           <?php if($hostModel->type_rent == 3): ?> checked <?php endif; ?> id="InputTypeRent3"/> <label
                                            for="InputTypeRent3"> اتاق خصوصی </label>
                                </div>
                            </div>
                            <div class="col-md-4">
                                <div class="form-group">
                                    <label for="">ثبت اقامتگاه توسط</label>
                                    <br/>
                                    <input type="radio" value="1" name="register_by"
                                           <?php if($hostModel->register_by == 1): ?> checked <?php endif; ?> id="InputRegisterBy1"/>
                                    <label
                                            for="InputRegisterBy1"> مالک </label>
                                    <input type="radio" value="2" name="register_by"
                                           <?php if($hostModel->register_by == 2): ?> checked <?php endif; ?> id="InputRegisterBy2"/>
                                    <label
                                            for="InputRegisterBy2"> تحویل دار یا نماینده </label>
                                </div>
                            </div>
                            <div class="col-md-4">
                                <div class="form-group">
                                    <label for="">شکل اقامتگاه</label>
                                    <br/>
                                    <input type="radio" value="1" name="shape_host"
                                           <?php if($hostModel->shape_host == 1): ?> checked <?php elseif($hostModel->shape_host == null): ?> checked <?php endif; ?> id="InputShapeHost1"/> <label
                                            for="InputShapeHost1"> مسطح </label>
                                    <input type="radio" value="2" name="shape_host"
                                           <?php if($hostModel->shape_host == 2): ?> checked <?php endif; ?> id="InputShapeHost2"/> <label
                                            for="InputShapeHost2"> دوبلکس </label>
                                    <input type="radio" value="3" name="shape_host"
                                           <?php if($hostModel->shape_host == 3): ?> checked <?php endif; ?> id="InputShapeHost3"/> <label
                                            for="InputShapeHost3"> تریبلکس </label>
                                </div>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-md-4">
                                <div class="form-group">
                                    <label for="InputStandardCapacity">ظرفیت استاندارد</label>
                                    <div class="number">
                                        <span class="icon-number"></span>
                                        <span class="plus oo"><i class="fas fa-plus"></i></span>
                                        <input type="text" value="<?php echo e($hostModel->standard_guest); ?>" class="input-text"
                                               id="InputStandardCapacity" readonly>
                                        <span class="minus oo"><i class="fas fa-minus"></i></span>
                                    </div>
                                </div>
                            </div>
                            <div class="col-md-4">
                                <div class="form-group">
                                    <label for="InputMaximumCapacity">حداکثر ظرفیت</label>
                                    <div class="number">
                                        <span class="icon-number"></span>
                                        <span class="plus"><i class="fas fa-plus"></i></span>
                                        <input type="text" value="<?php echo e($hostModel->count_guest); ?>" class="input-text"
                                               id="InputMaximumCapacity" readonly>
                                        <span class="minus gg"><i class="fas fa-minus"></i></span>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <hr/>
                        <div class="row form-room">
                            <hr/>
                            <div class="col-md-12">
                                <label for="">تعداد اتاق</label>
                                <div class="number">
                                    <span class="icon-number"></span>
                                    <span class="plus plus-room"><i class="fas fa-plus"></i></span>
                                    <input type="text" value="<?php echo e(count($hostModel->getRoom)); ?>" class="input-text" id="InputCountRoom" readonly
                                           placeholder="تعداد نفرات">
                                    <span class="minus minus-room"><i class="fas fa-minus"></i></span>
                                </div>
                            </div>

                            <script>
                                $(document).ready(function () {
                                    $('.minus').click(function () {
                                        var $input = $(this).parent().find('input');
                                        if($(this).hasClass('gg')) {
                                            if($input.val() <= $('#InputStandardCapacity').val()) {
                                                return false;
                                            }
                                        }
                                        var count = parseInt($input.val()) - 1;
                                        count = count < 1 ? 0 : count;
                                        $input.val(count);
                                        $input.change();
                                        if($(this).hasClass('oo')) {
                                            $('#InputMaximumCapacity').val($input.val());
                                        }

                                        return false;
                                    });
                                    $('.plus').click(function () {
                                        var $input = $(this).parent().find('input');
                                        $input.val(parseInt($input.val()) + 1);
                                        $input.change();
                                        if($(this).hasClass('oo')) {
                                            $('#InputMaximumCapacity').val($input.val());
                                        }
                                        return false;
                                    });
                                });

                                $('.plus-room').click(function () {
                                    // var textbox = $(this).parent().find('.input-text');
                                    // var value  = textbox[0].defaultValue;
                                    var numItems = $('.box').length + 1;
                                    // textbox[0].defaultValue = parseFloat(value)+1;
                                    var box = '<div class="col-md-12 box">\n' +
                                        '          <p class="">اتاق شماره ' + numItems + '</p>\n' +
                                        '          <div class="boxs">\n' +
                                        '              <div class="col-md-3">\n' +
                                        '                  <label>تخت یک نفره</label>\n' +
                                        '                  <div class="row">\n' +
                                        '                      <select class="form-control" name="single_bed" id="InputSingleBed">\n' +
                                        '                           <option value="0" selected>ندارد</option>' +
                                        '                           <?php for($i = 1; $i <= 6; $i++): ?>\n' +
                                        '                               <option value="<?php echo e($i); ?>"><?php echo e($i); ?></option>\n' +
                                        '                           <?php endfor; ?> \n' +
                                        '                       </select>' +
                                        '                  </div>\n' +
                                        '              </div>\n' +
                                        '              <div class="col-md-3">\n' +
                                        '                  <label>تخت دونفره</label>\n' +
                                        '                  <div class="row">\n' +
                                        '                      <select class="form-control" name="double_bed" id="InputDoubleBed">\n' +
                                        '                           <option value="0" selected>ندارد</option>' +
                                        '                           <?php for($i = 1; $i <= 6; $i++): ?>\n' +
                                        '                               <option value="<?php echo e($i); ?>"><?php echo e($i); ?></option>\n' +
                                        '                           <?php endfor; ?> \n' +
                                        '                       </select>' +
                                        '                  </div>\n' +
                                        '              </div>\n' +
                                        '              <div class="col-md-3">\n' +
                                        '                  <label>مبل تخت خواب شو</label>\n' +
                                        '                  <div class="row">\n' +
                                        '                      <select class="form-control" name="sofa_bed" id="InputSofaBed">\n' +
                                        '                           <option value="0" selected>ندارد</option>' +
                                        '                           <?php for($i = 1; $i <= 6; $i++): ?>\n' +
                                        '                               <option value="<?php echo e($i); ?>"><?php echo e($i); ?></option>\n' +
                                        '                           <?php endfor; ?> \n' +
                                        '                       </select>' +
                                        '                  </div>\n' +
                                        '              </div>\n' +
                                        '              <div class="col-md-3">\n' +
                                        '                  <label>رخت خواب کف</label>\n' +
                                        '                  <div class="row">\n' +
                                        '                      <select class="form-control" name="traditional_bedding" id="InputTraditionalBedding">\n' +
                                        '                           <option value="0" selected>ندارد</option>' +
                                        '                           <?php for($i = 1; $i <= 6; $i++): ?>\n' +
                                        '                               <option value="<?php echo e($i); ?>"><?php echo e($i); ?></option>\n' +
                                        '                           <?php endfor; ?> \n' +
                                        '                       </select>' +
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
                                <?php $__currentLoopData = $hostModel->getRoom; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $key => $value): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                    <div class="col-md-12 box">
                                        <p class="">اتاق شماره <?php echo e($key++); ?></p>
                                        <div class="boxs">
                                            <div class="col-md-3">
                                                <label>تخت یک نفره</label>
                                                <div class="row">
                                                    <select class="form-control" name="single_bed" id="InputSingleBed">
                                                        <option value="0" selected>ندارد</option>
                                                        <?php for($i = 1; $i <= 6; $i++): ?>
                                                            <option value="<?php echo e($i); ?>" <?php if($value->single_beds == $i): ?> selected <?php endif; ?>><?php echo e($i); ?></option>
                                                        <?php endfor; ?>
                                                    </select>
                                                </div>
                                            </div>
                                            <div class="col-md-3">
                                                <label>تخت دونفره</label>
                                                <div class="row">
                                                    <select class="form-control" name="double_bed" id="InputDoubleBed">
                                                        <option value="0" selected>ندارد</option>
                                                        <?php for($i = 1; $i <= 6; $i++): ?>
                                                            <option value="<?php echo e($i); ?>" <?php if($value->double_beds == $i): ?> selected <?php endif; ?>><?php echo e($i); ?></option>
                                                        <?php endfor; ?>
                                                    </select>
                                                </div>
                                            </div>
                                            <div class="col-md-3">
                                                <label>مبل تخت خواب شو</label>
                                                <div class="row">
                                                    <select class="form-control" name="sofa_bed" id="InputSofaBed">
                                                        <option value="0" selected>ندارد</option>
                                                        <?php for($i = 1; $i <= 6; $i++): ?>
                                                            <option value="<?php echo e($i); ?>" <?php if($value->sofa_beds == $i): ?> selected <?php endif; ?>><?php echo e($i); ?></option>
                                                        <?php endfor; ?>
                                                    </select>
                                                </div>
                                            </div>
                                            <div class="col-md-3">
                                                <label>رخت خواب کف</label>
                                                <div class="row">
                                                    <select class="form-control" name="traditional_bedding"
                                                            id="InputTraditionalBedding">
                                                        <option value="0" selected>ندارد</option>
                                                        <?php for($i = 1; $i <= 6; $i++): ?>
                                                            <option value="<?php echo e($i); ?>" <?php if($value->traditional_beds == $i): ?> selected <?php endif; ?>><?php echo e($i); ?></option>
                                                        <?php endfor; ?>
                                                    </select>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                            </div>

                        </div>

                        <div class="row">
                            <div class="col-md-12 box-reception">
                                <label class="">فضای حال</label>
                                <div class="boxs_reception">
                                    <div class="col-md-3">
                                        <label>تخت یک نفره</label>
                                        <div class="row">
                                            <div class="form-group">
                                                <select class="form-control" name="single_bed_reception"
                                                        id="InputSingleBedReception">
                                                    <option value="0"
                                                            <?php if($hostModel->single_bed_reception == 0): ?> selected <?php endif; ?>>
                                                        ندارد
                                                    </option>
                                                    <?php for($i = 1; $i <= 6; $i++): ?>
                                                        <option value="<?php echo e($i); ?>"
                                                                <?php if($hostModel->single_bed_reception == $i): ?> selected <?php endif; ?>>
                                                            <?php echo e($i); ?>

                                                        </option>
                                                    <?php endfor; ?>
                                                </select>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-md-3">
                                        <label>تخت دونفره</label>
                                        <div class="row">
                                            <div class="form-group">
                                                <select class="form-control" name="double_bed_reception"
                                                        id="InputDoubleBedReception">
                                                    <option value="0"
                                                            <?php if($hostModel->double_bed_reception == 0): ?> selected <?php endif; ?>>
                                                        ندارد
                                                    </option>
                                                    <?php for($i = 1; $i <= 6; $i++): ?>
                                                        <option value="<?php echo e($i); ?>"
                                                                <?php if($hostModel->double_bed_reception == $i): ?> selected <?php endif; ?>>
                                                            <?php echo e($i); ?>

                                                        </option>
                                                    <?php endfor; ?>
                                                </select>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-md-3">
                                        <label>مبل تخت خواب شو</label>
                                        <div class="row">
                                            <div class="form-group">
                                                <select class="form-control" name="sofa_bed_reception"
                                                        id="SofaBedReception">
                                                    <option value="0"
                                                            <?php if($hostModel->sofa_bed_reception == 0): ?> selected <?php endif; ?>>
                                                        ندارد
                                                    </option>
                                                    <?php for($i = 1; $i <= 6; $i++): ?>
                                                        <option value="<?php echo e($i); ?>"
                                                                <?php if($hostModel->sofa_bed_reception == $i): ?> selected <?php endif; ?>>
                                                            <?php echo e($i); ?>

                                                        </option>
                                                    <?php endfor; ?>
                                                </select>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-md-3">
                                        <label>رخت خواب کف</label>
                                        <div class="row">
                                            <div class="form-group">
                                                <select class="form-control" name="traditional_bedding_reception"
                                                        id="TraditionalBeddingReception">
                                                    <option value="0"
                                                            <?php if($hostModel->traditional_bedding_reception == 0): ?> selected <?php endif; ?>>
                                                        ندارد
                                                    </option>
                                                    <?php for($i = 1; $i <= 6; $i++): ?>
                                                        <option value="<?php echo e($i); ?>"
                                                                <?php if($hostModel->traditional_bedding_reception == $i): ?> selected <?php endif; ?>>
                                                            <?php echo e($i); ?>

                                                        </option>
                                                    <?php endfor; ?>
                                                </select>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="col-md-4">
                        <div class="box-information">
                            <p class="title-info">
                                مشخصات ملک
                            </p>
                            <p>
                                لورم ایپسوم متن ساختگی با تولید سادگی نامفهوم از صنعت چاپ و با استفاده از طراحان گرافیک
                                است چاپگرها و متون بلکه روزنامه و مجله در ستون و سطرآنچنان که لازم است و برای شرایط فعلی
                                تکنولوژی مورد نیاز و کاربردهای متنوع با هدف بهبود ابزارهای کاربردی می باشد کتابهای زیادی
                                در شصت و سه درصد گذشته حال و آینده شناخت فراوان جامعه و متخصصان را می طلبد تا با نرم
                                افزارها شناخت بیشتری را برای طراحان رایانه ای علی الخصوص طراحان خلاقی و فرهنگ پیشرو در
                                زبان فارسی ایجاد کرد
                            </p>
                            <p class="title-info">
                                فضای حال
                            </p>
                            <p>
                                در این صورت می توان امید داشت که تمام و دشواری موجود در ارائه راهکارها و شرایط سخت تایپ
                                به پایان رسد و زمان مورد نیاز شامل حروفچینی دستاوردهای اصلی و جوابگوی سوالات پیوسته اهل
                                دنیای موجود طراحی اساسا مورد استفاده قرار گیرد. و جوابگوی سوالات پیوسته اهل دنیای موجود
                                طراحی اساسا مورد استفاده قرار گیرد. و جوابگوی سوالات پیوسته اهل دنیای موجود طراحی اساسا
                                مورد استفاده قرار گیرد.
                            </p>
                        </div>
                    </div>
                </div>

                <br/>
                <div class="row">
                    <div class="col-md-2 col-md-offset-5">
                        <button type="button" id="step1" class="btn btn-primary BtnRegAll btn-block">&nbsp; ثبت ویرایش
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


    $('#SelectBuildingType').change(function () {
        if ($(this).val() == 6 || $(this).val() == 7) {
            $('.form-room').css('display', 'block');
            $('.meter-total').css('display', 'block');
        } else if ($(this).val() == 2) {
            $('.form-room').css('display', 'none');
        } else {
            $('.form-room').css('display', 'block');
            $('.room').css('display', 'none');
        }
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
        formData.append('reconstruction', $('input[name="reconstruction"]:checked').val()); // مدل بازسازی
        formData.append('building_floor', $('#InputBuildingFloors').val()); // تعداد طبقات کل ساختمان
        formData.append('units_per_floor', $('#InputUnitsPerFloor').val()); // تعداد واحد در هر طبقه
        formData.append('type_rent', $('input[name="type_rent"]:checked').val()); // نوع فضای اجاره
        formData.append('register_by', $('input[name="register_by"]:checked').val()); // ثبت شده توسط
        formData.append('shape_host', $('input[name="shape_host"]:checked').val()); // شکل اقامتگاه
        formData.append('standard_guest', $('#InputStandardCapacity').val()); // ظرفیت استاندارد
        formData.append('count_guest', $('#InputMaximumCapacity').val()); // حداکثر ظرفیت
        formData.append('count_room', $('#InputCountRoom').val()); // تعداد اتاق خواب
        formData.append('single_bed_reception', $('#InputSingleBedReception').val()); // تخت یک نفره
        formData.append('double_bed_reception', $('#InputDoubleBedReception').val()); // تخت دو نفره
        formData.append('sofa_bed_reception', $('#SofaBedReception').val()); // مبل تخت خواب شو
        formData.append('traditional_bedding_reception', $('#TraditionalBeddingReception').val()); // رخت خواب سنتی پذیرایی
        formData.append('edit_host',1);

        // محاسبه تعداد اتاق خواب
        var countRoom = $('#InputCountRoom').val();
        var arrayBox = $(".boxs");

        var myArray = [];
        for (var i = 0; i < countRoom; i++) {
            myArray.push([]);
        }
        for (var i = 0; i < countRoom; i++) {
            for (var j = 0; j < 3; j++) {
                myArray[i][0] = (arrayBox.eq(i).find('#InputSingleBed').val());
                myArray[i][1] = (arrayBox.eq(i).find('#InputDoubleBed').val());
                myArray[i][2] = (arrayBox.eq(i).find('#InputSofaBed').val());
                myArray[i][3] = (arrayBox.eq(i).find('#InputTraditionalBedding').val());
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
                } else if(data.Success == 1) {
                    $(".box-loading-step").fadeOut("slow", function () {
                        $('.box-loading-step').hide();
                    });
                    AlertToast('ویرایش اقامتگاه', data.Message, 'success');
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
