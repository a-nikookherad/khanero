<?php 
    $priceModelFilter = App\Modules\Host\Controllers\HostController::GetRangePrice();
    $buildingTypeModel = App\Modules\Possibilities\Controllers\PossibilitiesController::GetBuildingType();
    $optionModel = App\Modules\Possibilities\Controllers\PossibilitiesController::GetOption();
    $homeTypeModel = App\Modules\Possibilities\Controllers\PossibilitiesController::GetHomeType()
 ?>
<div class="row row-head-S">
    <ul class="col-sm-10 item-right">
        <li class="each-filter d-flex align-items-center">
            <i class="far fa-calendar-alt"></i>
            <input class="Q-bx date-moble d-inline-block d-sm-none" type="text" placeholder="تاریخ سفر"/>
            <input class="Q-bx date-enter d-none d-sm-inline-block" id="InputFromDate" type="text" placeholder="تاریخ ورود"/>
            <input class="Q-bx date-exit d-none d-sm-inline-block" id="InputToDate" type="text" placeholder="تاریخ خروج"/>
        </li>
        <li class="each-filter d-none d-sm-inline-block">
            <div class='top-item'>نوع اقامتگاه<i class="fas fa-chevron-down"></i></div>
            <div class='profiledropdown'>
                <ul class="nav nav-tabs head-tab">
                    <li class="Tb-Lnk A-ctive building_type active" data-value="0" data-toggle="tab">همه اقامتگاه ها</li>
                    <?php $__currentLoopData = $buildingTypeModel; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $key => $value): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                        <li class="Tb-Lnk A-ctive building_type" data-value="<?php echo e($value->id); ?>" data-toggle="tab"><?php echo e($value->name); ?></li>
                    <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                </ul>
            </div>
        </li>
        <li class="each-filter">
            <div class='top-item'> 1 نفر<i class="fas fa-chevron-down"></i></div>
            <div class='profiledropdown'>
                <div class="number">
                    <span class="minus"><i class="fas fa-minus"></i></span>
                    <input type="text" value="1" placeholder="تعداد نفرات">
                    <span class="text-number"> نفر</span>
                    <span class="plus"><i class="fas fa-plus"></i></span>
                </div>
                <div class="row ft-bx">
                    <div class="col-sm-6 text-right"><a class="lnk-1" href="#">حذف</a></div>
                    <div class="col-sm-6 text-left"><a class="lnk-1 text-theme1" href="#">تایید</a></div>
                </div>
            </div>
        </li>
        <li class="each-filter">
            <div class='top-item'> محدوده قیمت <i class="fas fa-chevron-down"></i></div>
            <div class='profiledropdown'>
                <div class="price-field position-relative w-100 d-flex justify-content-center align-items-center">
                    <input class="position-absolute border-0" type="range" min="100" max="500" value="100" id="lower">
                    <input class="position-absolute border-0" type="range" min="100" max="500" value="500" id="upper">
                </div>
                <div class="price-wrap row align-items-center mt-2">
                    <div class="price-wrap-1 text-right col-sm-6 p-0">
                        <input class="font-weight-bold border-0 text-center" id="one"><span class="unit-price" for="one">تومان</span>
                    </div>
                    <div class="price-wrap-2 text-left col-sm-6 p-0">
                        <input class="font-weight-bold border-0 text-center" id="two"><span class="unit-price" for="two">تومان</span>
                    </div>
                </div>
                <div class="row ft-bx">
                    <div class="col-sm-6 text-right"><a class="lnk-1" href="#">حذف</a></div>
                    <div class="col-sm-6 text-left"><a class="lnk-1 text-theme1" href="#">تایید</a></div>
                </div>
            </div>
        </li>
        <li class="each-filter d-none d-sm-inline-block">
            <div class='top-item'> تعداد اتاق<i class="fas fa-chevron-down"></i></div>
            <div class='profiledropdown'>
                <div class="number">
                    <span class="minus"><i class="fas fa-minus"></i></span>
                    <input type="text" value="1" placeholder="تعداد نفرات">
                    <span class="text-number"> اتاق</span>
                    <span class="plus"><i class="fas fa-plus"></i></span>
                </div>
                <div class="row ft-bx">
                    <div class="col-sm-6 text-right"><a class="lnk-1" href="#">حذف</a></div>
                    <div class="col-sm-6 text-left"><a class="lnk-1 text-theme1" href="#">تایید</a></div>
                </div>
            </div>
        </li>
        <li class="each-filter dif-other">
            <div class='top-item'>
                فیلتر های بیشتر
                <svg width="16" height="16" viewBox="0 0 15 15" icon="settings-vertical" class="f-primary-normal"><path fill-rule="evenodd" clip-rule="evenodd" d="M1.6 11.0667V12.2833C1.6 12.6833 1.91667 13 2.33333 13C2.75 13 3.06667 12.6833 3.06667 12.2833V11.0667C4.01667 10.75 4.66667 9.86667 4.66667 8.88333C4.66667 7.9 4.01667 7.01667 3.06667 6.7V0.716667C3.06667 0.316667 2.75 0 2.33333 0C1.91667 0 1.6 0.316667 1.6 0.716667V6.7C0.65 7.01667 0 7.9 0 8.88333C0 9.86667 0.65 10.75 1.6 11.0667ZM1.45 8.88333C1.45 8.4 1.83333 8.01667 2.31667 8.01667C2.8 8.01667 3.18333 8.4 3.18333 8.88333C3.18333 9.36667 2.8 9.75 2.31667 9.75C1.86667 9.75 1.45 9.35 1.45 8.88333ZM6.43337 6.25V12.2833C6.43337 12.6833 6.75004 13 7.16671 13C7.56671 13 7.90004 12.6833 7.90004 12.2833V6.25C8.85004 5.93333 9.50004 5.05 9.50004 4.06667C9.50004 3.08333 8.85004 2.2 7.90004 1.88333V0.716667C7.90004 0.316667 7.58337 0 7.16671 0C6.76671 0 6.43337 0.316667 6.43337 0.716667V1.88333C5.48337 2.2 4.83337 3.08333 4.83337 4.06667C4.85004 5.05 5.50004 5.93333 6.43337 6.25ZM6.30004 4.06667C6.30004 3.58333 6.68337 3.2 7.16671 3.2C7.65004 3.2 8.03337 3.58333 8.03337 4.06667C8.03337 4.55 7.65004 4.93333 7.16671 4.93333C6.68337 4.93333 6.30004 4.55 6.30004 4.06667ZM11.2833 12.2833V11.0667C10.3333 10.75 9.68335 9.86667 9.68335 8.88333C9.68335 7.9 10.3333 7.01667 11.2833 6.7V0.716667C11.2833 0.316667 11.6167 0 12.0167 0C12.4333 0 12.75 0.316667 12.75 0.716667V6.7C13.7 7.01667 14.35 7.9 14.35 8.88333C14.35 9.86667 13.7 10.75 12.75 11.0667V12.2833C12.75 12.6833 12.4167 13 12.0167 13C11.6 13 11.2833 12.6833 11.2833 12.2833ZM12 8.01667C11.5167 8.01667 11.1334 8.4 11.1334 8.88333C11.1334 9.36667 11.5167 9.75 12 9.75C12.4833 9.75 12.8667 9.36667 12.8667 8.88333C12.8667 8.4 12.4833 8.01667 12 8.01667Z"></path></svg>
            </div>
            <div class='profiledropdown'>
                <div class="more-filter">
                    <h5 class="tile-1">ویژه ها</h5>
                    <ul class="nav nav-tabs head-tab">
                        <li class="Tb-Lnk A-ctive" data-toggle="tab">همه</li>
                        <li class="Tb-Lnk A-ctive" data-toggle="tab">لحظه آخری</li>
                        <li class="Tb-Lnk A-ctive" data-toggle="tab">اجاره ماهیانه</li>
                        <li class="Tb-Lnk A-ctive" data-toggle="tab">تخفیف دار</li>
                    </ul>
                    <h5 class="tile-1">ویژگی های خاص</h5>
                    <ul class="row other-item">
                        <li class="col-sm-4 check">
                            <div class="prt-txt">دسترسی به مترو</div>
                            <input type="checkbox" name="is_name" class="option_check" value="">
                            <span class="checkmark"></span>
                        </li>
                        <li class="col-sm-4 check">
                            <div class="prt-txt">  دسترسی به بی آر تی</div>
                            <input type="checkbox" name="is_name" class="option_check" value="">
                            <span class="checkmark"></span>
                        </li>
                        <li class="col-sm-4 check">
                            <div class="prt-txt"> مناسب جشن و میهمانی</div>
                            <input type="checkbox" name="is_name" class="option_check" value="">
                            <span class="checkmark"></span>
                        </li>
                        <li class="col-sm-4 check">
                            <div class="prt-txt"> استخردار</div>
                            <input type="checkbox" name="is_name" class="option_check" value="">
                            <span class="checkmark"></span>
                        </li>
                        <li class="col-sm-4 check">
                            <div class="prt-txt">جکوزی</div>
                            <input type="checkbox" name="is_name" class="option_check" value="">
                            <span class="checkmark"></span>
                        </li>
                        <li class="col-sm-4 check">
                            <div class="prt-txt">کوهستانی</div>
                            <input type="checkbox" name="is_name" class="option_check" value="">
                            <span class="checkmark"></span>
                        </li>
                    </ul>
                    <h5 class="tile-1">امکانات اصلی</h5>
                    <ul class="row other-item">
                        <li class="col-sm-3 check">
                            <div class="prt-txt">پارکینگ</div>
                            <input type="checkbox" name="is_name" class="option_check" value="">
                            <span class="checkmark"></span>
                        </li>
                        <li class="col-sm-3 check">
                            <div class="prt-txt">  آسانسور</div>
                            <input type="checkbox" name="is_name" class="option_check" value="">
                            <span class="checkmark"></span>
                        </li>
                        <li class="col-sm-3 check">
                            <div class="prt-txt">حیاط</div>
                            <input type="checkbox" name="is_name" class="option_check" value="">
                            <span class="checkmark"></span>
                        </li>
                        <li class="col-sm-3 check">
                            <div class="prt-txt">یخچال</div>
                            <input type="checkbox" name="is_name" class="option_check" value="">
                            <span class="checkmark"></span>
                        </li>
                        <li class="col-sm-3 check">
                            <div class="prt-txt"> اجاق گاز</div>
                            <input type="checkbox" name="is_name" class="option_check" value="">
                            <span class="checkmark"></span>
                        </li>
                        <li class="col-sm-3 check">
                            <div class="prt-txt">پتو</div>
                            <input type="checkbox" name="is_name" class="option_check" value="">
                            <span class="checkmark"></span>
                        </li>
                        <li class="col-sm-3 check">
                            <div class="prt-txt">تشک</div>
                            <input type="checkbox" name="is_name" class="option_check" value="">
                            <span class="checkmark"></span>
                        </li>
                        <li class="col-sm-3 check">
                            <div class="prt-txt">سرویس فرنگی</div>
                            <input type="checkbox" name="is_name" class="option_check" value="">
                            <span class="checkmark"></span>
                        </li>
                    </ul>
                    <h5 class="tile-1">چشم انداز</h5>
                    <ul class="row other-item">
                        <li class="col-sm-3 check">
                            <div class="prt-txt">جنگل</div>
                            <input type="checkbox" name="is_name" class="option_check" value="">
                            <span class="checkmark"></span>
                        </li>
                        <li class="col-sm-3 check">
                            <div class="prt-txt">کوهستان</div>
                            <input type="checkbox" name="is_name" class="option_check" value="">
                            <span class="checkmark"></span>
                        </li>
                        <li class="col-sm-3 check">
                            <div class="prt-txt">روستا </div>
                            <input type="checkbox" name="is_name" class="option_check" value="">
                            <span class="checkmark"></span>
                        </li>
                        <li class="col-sm-3 check">
                            <div class="prt-txt">دریا</div>
                            <input type="checkbox" name="is_name" class="option_check" value="">
                            <span class="checkmark"></span>
                        </li>
                    </ul>
                    <h5 class="tile-1">قوانین صاحبخانه</h5>
                    <ul class="row other-item">
                        <li class="col-sm-12 check">
                            <div class="prt-txt">اجازه ورود حیوانات خانگی</div>
                            <input type="checkbox" name="is_name" class="option_check" value="">
                            <span class="checkmark"></span>
                        </li>
                        <li class="col-sm-12 check">
                            <div class="prt-txt">اجازه برگزاری جشن و میهمانی</div>
                            <input type="checkbox" name="is_name" class="option_check" value="">
                            <span class="checkmark"></span>
                        </li>
                        <li class="col-sm-12 check">
                            <div class="prt-txt"> اجازه ورود به خانه با کفش</div>
                            <input type="checkbox" name="is_name" class="option_check" value="">
                            <span class="checkmark"></span>
                        </li>
                    </ul>
                </div>
                <div class="row ft-bx">
                    <div class="col-sm-6 text-right"><a class="lnk-1" href="#">حذف</a></div>
                    <div class="col-sm-6 text-left"><a class="lnk-1 text-theme1" href="#">تایید</a></div>
                </div>
            </div>
        </li>
        <li class="each-filter dif-other">
            <button id="BtnFilter">اعمال تغییرات</button>
        </li>
    </ul>
    <div class="col-sm-2 map-active d-none d-sm-inline-block">
        <label class="titl-map">نقشه</label>
        <input type="checkbox" name="ne" id="" class="osman" checked>
    </div>
</div>

<script>
    $('#BtnFilter').click(function () {
        SearchHostAjax();
    });
    $('.building_type').click(function () {
        $('.building_type').removeClass('active');
        $(this).addClass('active');
        SearchHostAjax();
    });
    // SearchHostAjax();
    function SearchHostAjax() {
        setTimeout(function(){
            // $(".box-loading-search").fadeIn("slow", function () {
            //     $(this).show();
            // });
            var fast_reserve = 0;
            if ($('#FastReserve').is(":checked"))
            {
                fast_reserve = 1;
            }
            var formData = new FormData();
            // option array
            var chkArray = [];
            /* look for all checkboes that have a class 'chk' attached to it and check if it was checked */
            $(".chk:checked").each(function() {
                chkArray.push($(this).val());
            });
            /* we join the array separated by the comma */
            var selected;
            selected = chkArray.join(',') ;

            
            
            
            
            
            
            
            
            
            
            
            
            
            
            formData.append('sort', $('.building_type.active').attr('data-value'));
            $.ajaxSetup({
                headers: {
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                }
            });
            $.ajax({
                url: '<?php echo e(route('SearchHost')); ?>',
                method: 'post',
                data: formData,
                processData: false,
                contentType: false,
                success: function (data) {
                    if(data.Success == 1) {
                        // initialize();
                        $('.item-search').html(data.Message.original);
                        // initAjax();
                        $(".box-loading-search").fadeOut("slow", function () {
                            $(this).hide();
                        });
                    }
                }
            });

        }, 300);
    }
</script>
