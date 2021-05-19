<?php 
    $priceModelFilter = App\Modules\Host\Controllers\HostController::GetRangePrice();
    $buildingTypeModel = App\Modules\Possibilities\Controllers\PossibilitiesController::GetBuildingType();
    $optionModel = App\Modules\Possibilities\Controllers\PossibilitiesController::GetOption();
    $homeTypeModel = App\Modules\Possibilities\Controllers\PossibilitiesController::GetHomeType()
 ?>
<link rel="stylesheet" href="<?php echo e(asset('backend/assets/noUiSlider/nouislider.min.css')); ?>">
<style>
    .navbar-toggle .icon-bar{
        color: #fff;
        background: #fff;
    }
    .menu .nav.navbar-nav li > a {
        color: #555;
    }
    .box-filter {
        height: 135px;
        /* width: 200%; */
        box-shadow: 0 0 19px 0px #a5a5a5;
        border-radius: 5px;
        margin-top: 5px;
        width: 305px;
        overflow: hidden;
        background-color: #fff;
    }
    .dropdown-menu {
        background: #ff000000;
        border: none;
        box-shadow: none;
    }
    .highcharts-axis-title,
    .highcharts-credits,
    .highcharts-exporting-group,
    .highcharts-axiss-labels,
    .highcharts-yaxis-labels,
    .highcharts-xaxis-labels,
    .highcharts-tick,
    .highcharts-grid-line {
        display: none;
    }
    .noUi-handle.noUi-handle-lower,
    .noUi-handle.noUi-handle-upper{
        width: 15px!important;
        height: 15px;
        background: #313131;
        border: 2px solid #59b7ff;
    }
    .noUi-handle.noUi-handle-lower:after,
    .noUi-handle.noUi-handle-upper:after{
        display: none;
    }
    .noUi-connect {
        background: #444444;
        border-color: transparent;
        height: 5px;
        top: -3px;
    }
    .noUi-base {
        height: 6px;
        background: #fff6ec;
    }
    .highcharts-tooltip {
        color: red;
        display: none;
    }
    div#slider-snap {
        padding: 0 20px;
    }
    .box-filter.date {
        padding: 15px 0px;
        height: 130px;
    }
    .BtnAddSub {
        border: 1px solid white;
        /*background: #f1c40f;*/
        background: transparent;
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
        border: 1px solid #3ba0ff;
        color: #3ba0ff;
        transition: 0.5s;
    }
    .box-filter.count-guest input {
        width: 15px;
        text-align: center;
    }
    .box-filter.count-guest {
        padding: 15px 0px;
        height: 130px;
    }
    .box-filter.building-type {
        padding: 15px 0px;
        height: 137px;
    }
    .box-filter.fast-reserve {
        padding: 15px 0px;
        height: 125px;
        width: 500px;
    }
    .box-filter.more-filter {
        padding: 15px 0px;
        height: 325px;
        width: 500px;
        overflow-y: scroll;
    }
    .box-filter.more-filter input {
        width: 15px;
        text-align: center;
    }
    .box-filter.more-filter .rows-btn {
        position: sticky;
        bottom: -15px;
        background: #fff;
        /* height: 30px; */
        padding: 10px 0;
    }
    .noUi-base {
        position: absolute;
        top: -36px;
        left: 0;
    }
    .noUi-tooltip{
        display: none;
    }
    .highcharts-series.highcharts-series-0.highcharts-area-series.highcharts-color-0 path {
        fill: #444;
    }
    .highcharts-markers.highcharts-series-0.highcharts-area-series.highcharts-color-0.highcharts-tracker path {
        display: none;
    }
    nav .btn-success {
        background-color: #383838;
        border-color: #383838;
    }
    nav .btn-success:hover,
    nav .btn-success.focus,
    nav .btn-success:focus,
    nav .btn-success:active {
        color: #383838;
        background-color: #ffffff;
        border-color: #383838;
    }
    nav .btn-success.active.focus,
    nav .btn-success.active:focus,
    nav.btn-success.active:hover,
    nav.btn-success:active.focus,
    nav.btn-success:active:focus,
    nav.btn-success:active:hover,
    nav.open>.dropdown-toggle.btn-success.focus,
    nav.open>.dropdown-toggle.btn-success:focus,
    nav.open>.dropdown-toggle.btn-success:hover {
        color: #fff;
        background-color: #383838;
        border-color: #384b3e;
    }
    .ul-sort li {
        display: inline-block;
    }
    .ul-sort .li-sort {
        margin: 0px 3px;
        padding: 3px 7px;
        border: 1px solid #d6d6d6;
        border-radius: 3px;
    }
    .ul-sort .li-sort {
        cursor: pointer;
        transition: .2s;
    }
    .ul-sort .li-sort:hover {
        background-color: #007e8d17;
        transition: .2s;
    }
</style>
<script src="<?php echo e(asset('backend/assets/noUiSlider/nouislider.min.js')); ?>"></script>
<script src="<?php echo e(asset('backend/assets/noUiSlider/wNumb.js')); ?>"></script>
<script src="<?php echo e(asset('backend/assets/highcharts/highcharts.js')); ?>"></script>
<script src="<?php echo e(asset('backend/assets/highcharts/exporting.js')); ?>"></script>
<script src="<?php echo e(asset('backend/assets/highcharts/export-data.js')); ?>"></script>



<nav class="navbar navbar-default">
    <div class="container">
        <div id="navbar" class="navbar-collapse collapse">
            <div class="col-md-7">
                <ul class="nav navbar-nav">
                    <li class=" dropdown1">
                        <a href="#" id="toggle-button1" class="dropdown-toggle " data-toggle="dropdown" role="button" aria-haspopup="true" aria-expanded="false">قیمت <span class="caret"></span></a>
                        <ul class="dropdown-menu" id="toggle-menu1">
                            <li>
                                <div class="box-filter">
                                    <?php 
                                        // dd($priceModelFilter['priceModel']);
                                     ?>
                                    
                                    
                                    
                                    <div id="container" style="width: 354px; overflow: hidden; height: 120px; margin: 0 auto"></div>
                                    <div class="col-md-12">
                                        <div id="slider-snap"></div>
                                    </div>
                                    <br />
                                    <div class="row">
                                        <div class="col-md-6">
                                            <p style="font-size: 11px;position: absolute;top: -40px;">
                                                بیشترین : <span class="example-val" id="slider-snap-value-upper"><?php if($priceModelFilter != 0): ?> <?php echo e(max($priceModelFilter['priceMax'])); ?> <?php endif; ?></span>
                                            </p>
                                        </div>
                                        <div class="col-md-6">
                                            <p style="font-size: 11px;position: absolute;top: -40px;">
                                                کمترین : <span class="example-val" id="slider-snap-value-lower"><?php if($priceModelFilter != 0): ?> <?php echo e(min($priceModelFilter['priceMax'])); ?> <?php endif; ?></span>
                                            </p>
                                        </div>
                                    </div>
                                </div>
                            </li>
                        </ul>
                    </li>
                    <li class=" dropdown">
                        <a href="#" id="toggle-button2" class="dropdown-toggle " data-toggle="dropdown" role="button" aria-haspopup="true" aria-expanded="false">تاریخ <span class="caret"></span></a>
                        <ul class="dropdown-menu" id="toggle-menu2">
                            <li>
                                <div class="box-filter date">
                                    <div class="row">
                                        <div class="col-md-6">
                                            <input type="text" dir="rtl" value="" class="form-control" id="InputDateFromFilter" placeholder="تاریخ رفت">
                                        </div>
                                        <div class="col-md-6">
                                            <input type="text" dir="rtl" value="" class="form-control" id="InputDateToFilter" placeholder="تاریخ برگشت">
                                        </div>
                                    </div>
                                    <hr />
                                    <div class="row">
                                        <div class="col-md-6">
                                            <button class="btn btn-cancel-filter btn-default input-sm">انصراف</button>
                                        </div>
                                        <div class="col-md-6 text-left">
                                            <button class="btn btn-confirm-filter btn-success input-sm">ثبت</button>
                                        </div>
                                    </div>
                                </div>
                            </li>
                        </ul>
                    </li>
                    <li class=" dropdown">
                        <a href="#" id="toggle-button3" class="dropdown-toggle active" data-toggle="dropdown" role="button" aria-haspopup="true" aria-expanded="false">تعداد مهمان <span class="caret"></span></a>
                        <ul class="dropdown-menu" id="toggle-menu3">
                            <li>
                                <div class="box-filter count-guest">
                                    <div class="row">
                                        <div class="col-md-6">
                                            <label class="input-sm">تعداد مهمان</label>
                                        </div>
                                        <div class="col-md-6 text-left">
                                            <label class="BtnAddSub BtnAdds" id="">+</label>
                                
                                            <input type="text" value="0" id="CapacityFilter" class="input-text" readonly />
                                
                                            <label class="BtnAddSub BtnSubs" id="">-</label>
                                        </div>
                                    </div>
                                    <hr />
                                    <div class="row">
                                        <div class="col-md-6">
                                            <button class="btn btn-cancel-filter btn-default input-sm">انصراف</button>
                                        </div>
                                        <div class="col-md-6 text-left">
                                            <button class="btn btn-confirm-filter btn-success input-sm">ثبت</button>
                                        </div>
                                    </div>
                                </div>
                            </li>
                        </ul>
                    </li>
                    <li class=" dropdown">
                        <a href="#" id="toggle-button4" class="dropdown-toggle active" data-toggle="dropdown" role="button" aria-haspopup="true" aria-expanded="false">نوع ساختمان <span class="caret"></span></a>
                        <ul class="dropdown-menu" id="toggle-menu4">
                            <li>
                                <div class="box-filter building-type">
                                    <div class="row">
                                        <div class="col-md-6">
                                            <label class="input-sm">نوع ساختمان</label>
                                        </div>
                                        <div class="col-md-6">
                                            <select class="form-control input-sm" id="BuildingType">
                                                <option value="0"> همه موارد</option>
                                                <?php $__currentLoopData = $buildingTypeModel; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $key => $value): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                                    <option value="<?php echo e($value->id); ?>"><?php echo e($value->name); ?></option>
                                                <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                                            </select>
                                        </div>
                                    </div>
                                    <hr />
                                    <div class="row">
                                        <div class="col-md-6">
                                            <button class="btn btn-cancel-filter btn-default input-sm">انصراف</button>
                                        </div>
                                        <div class="col-md-6 text-left">
                                            <button class="btn btn-confirm-filter btn-success input-sm">ثبت</button>
                                        </div>
                                    </div>
                                </div>
                            </li>
                        </ul>
                    </li>
                    <li class=" dropdown">
                        <a href="#" id="toggle-button5" class="dropdown-toggle active" data-toggle="dropdown" role="button" aria-haspopup="true" aria-expanded="false">رزرو فوری <span class="caret"></span></a>
                        <ul class="dropdown-menu" id="toggle-menu5">
                            <li>
                                <div class="box-filter fast-reserve">
                                    <div class="row">
                                        <div class="col-md-10">
                                            <p class="input-sm">
                                                رزرو فوری شامل خانه هایی میشود که برای امروز وقت رزرو دارند .
                                            </p>
                                        </div>
                                        <div class="col-md-2">
                                            <input type="checkbox" value="1" class="" id="FastReserve" />
                                        </div>
                                    </div>
                                    <hr />
                                    <div class="row">
                                        <div class="col-md-6">
                                            <button class="btn btn-cancel-filter btn-default input-sm">انصراف</button>
                                        </div>
                                        <div class="col-md-6 text-left">
                                            <button class="btn btn-confirm-filter btn-success input-sm">ثبت</button>
                                        </div>
                                    </div>
                                </div>
                            </li>
                        </ul>
                    </li>
                    <li class=" dropdown">
                        <a href="#" id="toggle-button6" class="dropdown-toggle active" data-toggle="dropdown" role="button" aria-haspopup="true" aria-expanded="false">فیلترهای بیشتر <span class="caret"></span></a>
                        <ul class="dropdown-menu" id="toggle-menu6">
                            <li>
                                <div class="box-filter more-filter">
                                    <div class="row">
                                        <div class="col-md-6">
                                            <label class="input-sm">نوع خانه</label>
                                        </div>
                                        <div class="col-md-6 text-left">
                                            <select class="form-control input-sm" id="HomeType">
                                                <option value="0">همه موارد</option>
                                                <?php $__currentLoopData = $homeTypeModel; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $key => $value): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                                    <option value="<?php echo e($value->id); ?>"><?php echo e($value->name); ?></option>
                                                <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                                            </select>
                                        </div>
                                    </div>
                                    <hr />
                                    <div class="">
                                        <div class="row">
                                            <div class="col-md-12">
                                                <label class="input-sm">
                                                    اتاق و تخت خواب
                                                </label>
                                            </div>
                                        </div>
                                        <div class="row">
                                            <div class="col-md-6">
                                                <label class="input-sm">تعداد اتاق خواب</label>
                                            </div>
                                            <div class="col-md-6 text-left">
                                                <label class="BtnAddSub BtnAdds" id="">+</label>
                                    
                                                <input type="text" value="0" name="count_man" id="CountRoom" class="input-text" readonly />
                                    
                                                <label class="BtnAddSub BtnSubs" id="">-</label>
                                            </div>
                                        </div>
                                        <div class="row">
                                            <div class="col-md-6">
                                                <label class="input-sm">تعداد تخت خواب</label>
                                            </div>
                                            <div class="col-md-6 text-left">
                                                <label class="BtnAddSub BtnAdds" id="">+</label>
                                    
                                                <input type="text" value="0" name="count_man" id="CountBed" class="input-text" readonly />
                                    
                                                <label class="BtnAddSub BtnSubs" id="">-</label>
                                            </div>
                                        </div>
                                        <div class="row">
                                            <div class="col-md-6">
                                                <label class="input-sm">تعداد حمام</label>
                                            </div>
                                            <div class="col-md-6 text-left">
                                                <label class="BtnAddSub BtnAdds" id="">+</label>
                                    
                                                <input type="text" value="0" name="count_man" id="CountBathroom" class="input-text" readonly />
                                    
                                                <label class="BtnAddSub BtnSubs" id="">-</label>
                                            </div>
                                        </div>
                                        <div class="row">
                                            <div class="col-md-6">
                                                <label class="input-sm">تعداد سرویس بهداشتی</label>
                                            </div>
                                            <div class="col-md-6 text-left">
                                                <label class="BtnAddSub BtnAdds" id="">+</label>
                                    
                                                <input type="text" value="0" name="count_man" id="CountToilet" class="input-text" readonly />
                                    
                                                <label class="BtnAddSub BtnSubs" id="">-</label>
                                            </div>
                                        </div>
                                    </div>
                                    <hr />
                                    <div class="row">
                                        <div class="col-md-12">
                                            <label class="input-sm">امکانات</label>
                                        </div>
                                        <div class="row">
                                            <?php $__currentLoopData = $optionModel; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $key => $value): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                                <div class="col-md-4">
                                                    <label class="input-sm" for="Option<?php echo e($key+1); ?>"><?php echo e($value->name); ?></label>
                                                </div>
                                                <div class="col-md-2">
                                                    <input type="checkbox" class="chk" value="<?php echo e($value->id); ?>" id="Option<?php echo e($key+1); ?>" />
                                                </div>
                                            <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                                        </div>
                                    </div>
                                    <hr />
                                    <div class="row rows-btn">
                                        <div class="col-md-6">
                                            <button class="btn btn-cancel-filter btn-default input-sm">انصراف</button>
                                        </div>
                                        <div class="col-md-6 text-left">
                                            <button class="btn btn-confirm-filter btn-success input-sm">ثبت</button>
                                        </div>
                                    </div>
                                </div>
                            </li>
                        </ul>
                    </li>
                </ul>
            </div>
            <div class="col-md-5">
                <ul class="ul-sort">
                    <li class="">
                        <p>مرتب سازی بر اساس</p>
                    </li>
                    <li class="li-sort">
                        <span>گران ترین</span>
                    </li>
                    <li class="li-sort">
                        <span>ارزان ترین</span>
                    </li>
                    <li class="li-sort">
                        <span>بیشترین سفر</span>
                    </li>
                    <li class="li-sort">
                        <span>بیشترین امتیاز</span>
                    </li>
                </ul>
            </div>
        </div>
    </div>
</nav>


<script>
    // SearchHostAjax();
    function SearchHostAjax() {
        setTimeout(function(){
            $(".box-loading-search").fadeIn("slow", function () {
                $(this).show();
            });

            var speedReserve = 0;
            if ($('#FastReserve').is(":checked"))
            {
                speedReserve = 1;
            }
            var formData = new FormData();
            var p1 = $('#slider-snap-value-lower').text()
            p1 = p1.replace(',','');
            p1 = p1.replace(',',''); // min price
            var p2 = $('#slider-snap-value-upper').text();
            p2 = p2.replace(',','');
            p2 = p2.replace(',',''); // max price
            // option array
            var chkArray = [];
            /* look for all checkboes that have a class 'chk' attached to it and check if it was checked */
            $(".chk:checked").each(function() {
                chkArray.push($(this).val());
            });
            /* we join the array separated by the comma */
            var selected;
            selected = chkArray.join(',') ;

            formData.append('range_1', p1);
            formData.append('range_2', p2);
            formData.append('date_from', $('#InputDateFromFilter').val());
            formData.append('date_to', $('#InputDateToFilter').val());
            formData.append('capacity', $('#CapacityFilter').val());
            formData.append('building_type', $('#BuildingType option:selected').val());
            formData.append('home_type', $('#HomeType option:selected').val());
            formData.append('speed_reserve', speedReserve);
            formData.append('count_room', $('#CountRoom').val());
            formData.append('count_bed', $('#CountBed').val());
            formData.append('count_bathroom', $('#CountBathroom').val());
            formData.append('count_toilet', $('#CountToilet').val());
            formData.append('option', selected);
            formData.append('word', $('#InputSearchWord').val());
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
                    console.log(data);
                    if(data.Success == 1) {
                        // initialize();
                        $('#ExtraContentSearch').html(data.Message.original);
                        // initAjax();
                        $(".box-loading-search").fadeOut("slow", function () {
                            $(this).hide();
                        });
                        init2();
                    } else if (data.Success == 2) {
                        $.Toast("<p>خطا در ارسال اطلاعات</p>", "<p>"+ data.Message +" .</p>", "warning", {
                            has_icon: true,
                            has_close_btn: true,
                            stack: true,
                            fullscreen: false,
                            timeout: 5000,
                            sticky: false,
                            has_progress: true,
                            rtl: true,
                        });
                        $(".box-loading-search").fadeOut("slow", function () {
                            $(this).hide();
                        });
                    }

                }
            });

        }, 300);
    }




    $("#toggle-button1").click(function(){
        $("#toggle-menu1").toggle();
        $("#toggle-menu2, #toggle-menu3, #toggle-menu4, #toggle-menu5, #toggle-menu6").hide();
    });

    $("#toggle-button2").click(function(){
        $("#toggle-menu2").toggle();
        $("#toggle-menu1, #toggle-menu3, #toggle-menu4, #toggle-menu5, #toggle-menu6").hide();
    });

    $("#toggle-button3").click(function(){
        $("#toggle-menu3").toggle();
        $("#toggle-menu2, #toggle-menu1, #toggle-menu4, #toggle-menu5, #toggle-menu6").hide();
    });

    $("#toggle-button4").click(function(){
        $("#toggle-menu4").toggle();
        $("#toggle-menu2, #toggle-menu3, #toggle-menu1, #toggle-menu5, #toggle-menu6").hide();
    });

    $("#toggle-button5").click(function(){
        $("#toggle-menu5").toggle();
        $("#toggle-menu2, #toggle-menu3, #toggle-menu4, #toggle-menu1, #toggle-menu6").hide();
    });

    $("#toggle-button6").click(function(){
        $("#toggle-menu6").toggle();
        $("#toggle-menu2, #toggle-menu3, #toggle-menu4, #toggle-menu5, #toggle-menu1").hide();
    });

    
    $('.btn-cancel-filter').click(function () {
        $(this).closest('.dropdown-menu').hide();
    });


    $('.btn-confirm-filter').click(function () {
        SearchHostAjax();
    });


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


    var snapSlider = document.getElementById('slider-snap');

    noUiSlider.create(snapSlider, {
        start: <?php if($priceModelFilter != 0): ?> [<?php echo e(min($priceModelFilter['priceMax'])); ?>, <?php echo e(max($priceModelFilter['priceMax'])); ?>] <?php else: ?> [0,0] <?php endif; ?>,
        connect: true,
        tooltips: [true, wNumb({decimals: 1})],
        range: {
            'min': <?php if($priceModelFilter != 0): ?> [<?php echo e(min($priceModelFilter['priceMax'])); ?>] <?php else: ?> [0] <?php endif; ?> ,
            'max': <?php if($priceModelFilter != 0): ?> <?php echo e(max($priceModelFilter['priceMax'])); ?> <?php else: ?> 0 <?php endif; ?>
        }
    });

    snapSlider.noUiSlider.on('change.one', function () {
        SearchHostAjax();
    });

    var snapValues = [
        document.getElementById('slider-snap-value-lower'),
        document.getElementById('slider-snap-value-upper')
    ];

    snapSlider.noUiSlider.on('update', function (values, handle) {
        snapValues[handle].innerHTML = values[handle];
    });
</script>



<script>


            Highcharts.chart('container', {
                chart: {
                    zoomType: 'x',
                    // backgroundColor: '#ecf0f1',
                    // color: 'red'
                },
                title: {
                    text: ''
                },
                subtitle: {
                    // text: document.ontouchstart === undefined ?
                    //     'Click and drag in the plot area to zoom in' : 'Pinch the chart to zoom in'
                },
                xAxis: {
                    type: 'datetime'
                },
                yAxis: {
                    title: {
                        // text: 'Exchange rate'
                    }
                },
                legend: {
                    enabled: false
                },
                plotOptions: {
                    area: {
                        fillColor: {
                            linearGradient: {
                                x1: 5,
                                y1: 0,
                                x2: 6,
                                y2: 1
                            },
                            stops: [
                                [0, Highcharts.getOptions().colors[0]],
                                [1, Highcharts.Color(Highcharts.getOptions().colors[0]).setOpacity(0).get('rgba')]
                            ]
                        },
                        marker: {
                            radius: 0.2
                        },
                        lineWidth: 0.2,
                        states: {
                            hover: {
                                lineWidth: 1
                            }
                        },
                        threshold: null
                    }
                },

                plotOptions: {
                    series: {
                        dataLabels: {
                            enabled: false,
                            inside: false,
                        }
                    }
                },

                series: [{
                    type: 'area',
                    name: ' ',
                    data:
                    [
                        <?php if($priceModelFilter != 0): ?>
                            <?php $__currentLoopData = $priceModelFilter['priceMax']; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $key => $value): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                            <?php $__currentLoopData = $priceModelFilter['priceModel']; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $item => $index): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                            <?php if($value == $index->max): ?>
                            <?php if(in_array($index->host_id,$priceModelFilter['array_host_id'])): ?>
                        {
                            x: <?php echo e($key+1); ?>,
                            y: <?php echo e($index->max); ?>,
                            name: " ",
                            color: "#96ff8f"
                        },
                            <?php else: ?>
                        {
                            x: <?php echo e($key+1); ?>,
                            y: 0,
                            name: " ",
                            color: "#96ff8f"
                        },
                        <?php endif; ?>
                        <?php endif; ?>
                        <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                        <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                        <?php endif; ?>
                    ]
                }]
            });

</script>
