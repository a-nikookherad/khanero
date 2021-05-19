
<?php $__env->startSection('title',TitlePage('جستجوی اقامتگاه')); ?>
<?php $__env->startSection('style'); ?>
<style>
    .d-sm-none{display:none;}
    .d-sm-inline-block{display:inline-block;}
    .fa, .far, .fas {font-family: "Font Awesome 5 Free" !important;}
    #main1 p {font-size: 14px;line-height: 35px;}
    .text-theme1 {color: #007dec ;}
    .Q-bx {border: 0;background: transparent;}
    .date-enter {border-left: 1px solid #9a9a9a;}
    .date-exit,.date-enter{    width: 80px;text-align: center;}
    .title-main {color: #007e8d;}
    .item-right {display: flex;align-items: center;}
    .each-filter.filter-open {border: 1px solid #007dec;    z-index: 111;}
    .each-filter {border: 1px solid #dcdcdc;border-radius: 50px;margin: 5px;padding: 8px;background: white;position: relative;}
    .row-head-S {position: relative;padding: 18px 0 9px 0;background: #e8e8e8;border-bottom: 1px solid #eaeaea;margin: 0 0 24px;z-index: 12;}
    .profiledropdown .number {float: right;width: 100%;}
    .profiledropdown span.minus, .profiledropdown span.plus {color: #007dec;border: 1px solid #007dec;    font-size: 14px;display: flex;align-items: center;justify-content: center;}
    .profiledropdown span.minus:hover, .profiledropdown span.plus:hover {background: #007dec00;}
    .row.ft-bx {font-size: 12px;border-top: 1px solid #e4e4e4;padding: 6px 0 0;margin: 12px 0 0;float: right;width: 100%;}
    .more-filter {width: 450px;font-size: 12px;height: 300px;overflow: auto;}
    .more-filter::-webkit-scrollbar {width: 8px;background-color: #F5F5F5;}
    .more-filter::-webkit-scrollbar-thumb {background: #c0c0c0;border-radius: 9px;}
    .nav-tabs {border-bottom: 0;}
    .head-tab .Tb-Lnk {background: #eaeaea;margin: 5px;padding: 3px 15px;border-radius: 40px;    cursor: pointer;color: #212121;font-size: 13px;}
    .head-tab .Tb-Lnk.active {background: #007dec;color: white;}
    .each-filter.dif-other {border-radius: 50px;background: #eaf2f7;color: #3081b0;border: 1px solid #eaf2f7;}
    .each-filter.dif-other i , .filter-open.each-filter.dif-other i{color: white;}
    #demos {float: none;}
    .overlay1 {background: #ffffff2e;position: fixed;top: 0;bottom: 0;right: 0;left: 0;display:none;}
    .overlay1.can-see{display:block;}

    /*=*=*=*=*=*= * --- open-filter ---  * ======================== */
    .top-item {cursor: pointer;font-size: 14px;}
    .top-item svg {margin: 4px 34px 0 2px;float: left;fill: var(--primary-normal,#3081b0);}
    .top-item i {float: left;margin: 4px 38px 0 6px;color: #777777;    transition: all 0.3s;transform: rotate( 0deg);}
    .filter-open .top-item i {transform: rotate(180deg);color: #007dec;transition: all 0.3s;}
    .avatar {overflow: hidden;width: 26px;height: 26px;border-radius: 50%;}
    .avatar img {width: 100%;}
    .profiledropdown {min-width: 222px;font-size: 15px;padding: 9px;background-color: #fff;border: 1px solid rgba(0, 0, 0, 0.1);border-radius: 3px;box-shadow: 0 2px 4px rgb(0 0 0 / 10%);opacity: 0;position: absolute;top: 103%;right: 0;display:none;}
    .profiledropdown ul {list-style: none;margin: 0;padding: 0;}
    .profiledropdown ul .option {display: block;position: relative;padding: 5px 16px;color: #555;white-space: nowrap;overflow: hidden;}
    @keyframes  fade {
      0% {opacity: 0;}
      100% {opacity: 1;}
    }
    @keyframes  slide {
      0% {margin-top: -10px;}
      100% {margin-top: 0px;}
    }
    @keyframes  fade_reverse {
      0% {opacity: 1;}
      100% {opacity: 0;}
    }
    @keyframes  slide_reverse {
      0% {margin-top: 0px;}
      100% {margin-top: -10px;}
    }
    .filter-open .profiledropdown {display:block;animation-name: fade, slide;animation-duration: 200ms, 400ms;animation-fill-mode: forwards;animation-timing-function: linear, cubic-bezier(0.23, 1, 0.32, 1);animation-delay: 200ms, 0;}
    .profiledropdown {animation-name: fade_reverse, slide_reverse;animation-duration: 100ms, 200ms;animation-timing-function: linear, cubic-bezier(0.23, 1, 0.32, 1);animation-delay: 100ms, 0;}
    /*=*=*=*=*=*= * --- FILTER-items ---  * ======================== */
    .check {display: block;position: relative;cursor: pointer;-webkit-user-select: none;-moz-user-select: none;-ms-user-select: none;user-select: none;padding: 10px 19px 10px 0;color: #444444;}
    .check input {position: absolute;opacity: 0;cursor: pointer;top: 0;right: 0;z-index: 1;bottom: 0;margin: auto;}
    .check .checkmark {position: absolute;top: 0;bottom: 0;margin: auto;right: 0;height: 16px;width: 16px;background-color: #fff;border-color: #c1c1c1;border-style: solid;border-width: 1px;}
    .check input:checked ~ .checkmark {background-color: #fff  ;}
    .check .checkmark::after {content: "";position: absolute;display: none;}
    .check input:checked ~ .checkmark:after {display: block;}
    .check .checkmark::after {left: 5px;top: 0px;width: 5px;height: 11px;border: solid;border-color: #007dec;border-width: 0 2px 2px 0;-webkit-transform: rotate(45deg);-ms-transform: rotate(45deg);transform: rotate(45deg);}
    /*=*=*=*=*=*= * --- FILTER-price ---  * ======================== */
    .price-field {height: 36px;box-sizing: border-box;    width: 270px;}
    .price-field input[type=range] {background: #d8d8d8;    width: 91%;margin: 15px auto;height: 2px; border: 0;outline: 0;box-sizing: border-box;border-radius: 5px;pointer-events: none;-webkit-appearance: none;position: absolute;}
    .price-field input[type=range]::-webkit-slider-thumb {-webkit-appearance: none;}
    .price-field input[type=range]:active,
    .price-field input[type=range]:focus {outline: 0;}
    .price-field input[type=range]::-ms-track {background: #8ec9fd;width: 100%;height: 2px; border: 0;outline: 0;box-sizing: border-box;border-radius: 5px;pointer-events: none;background: transparent;border-color: transparent;color: transparent;border-radius: 5px;}
    .price-field input[type=range]::-webkit-slider-thumb { position: relative;-webkit-appearance: none;margin: 0;border: 0;outline: 0;border-radius: 50%;height: 10px;width: 10px;margin-top: -4px;background-color: #007dec;box-shadow: 0 0 1px 3px #97ceff;cursor: pointer;pointer-events: all;z-index: 100;}
    .price-field input[type=range]::-moz-range-thumb ,
    .price-field input[type=range]::-ms-thumb  { position: relative;appearance: none;margin: 0;border: 0;outline: 0;border-radius: 50%;height: 10px;width: 10px;margin-top: -5px;background-color: #007dec;box-shadow: 0 0 1px 3px #97ceff;cursor: pointer;cursor: pointer;pointer-events: all;z-index: 100;}
    .price-field input[type=range]::-webkit-slider-runnable-track ,
    .price-field input[type=range]::-moz-range-track,
    .price-field input[type=range]::-ms-track { background: #8ec9fd;width: 100%;height: 2px;cursor: pointer;background: #fff;border-radius: 5px;}
    .price-wrap #one,
    .price-wrap #two {width: 33px;color: #3d79bd;font-size: 18px;}
    .unit-price {font-size: 13px;}
    .price-field input[type=range]:hover::-webkit-slider-thumb {box-shadow: 0 0 0 0.5px #000;transition-duration: 0.3s;}
    .price-field input[type=range]:active::-webkit-slider-thumb {box-shadow: 0 0 0 0.5px #000;transition-duration: 0.3s;}
    /*=*=*=*=*=*= * --- main-info ---  * ======================== */
    .title-search {margin: 0 0 17px;}
    .select-inMob {background: #007dec0f;border-radius: 4px;border: 1px solid #007dec;color: #00529a;margin: 0 11px 0 0;}
    .order-mob {background: transparent;padding: 5px 18px;}
    .set-order {display: flex;align-items: center;justify-content: flex-end;font-size: 15px;}
    .set-order .title-order {padding: 5px 11px;border-radius: 4px;margin: 0 8px 0 0;cursor: pointer;}
    .set-order .title-order.active{border: 1px solid #007dec;}
    .set-order .title-row ,.number-Found{font-weight: bold;}
    .number-Found {color: #7b7b7b;}
    .about-search {border-top: 1px solid #e2e2e2;padding: 18px 0;margin: 37px 0 17px;text-align: justify;font-size: 14px;line-height: 28px;}
    /*=*=*=*=*=*= * --- box-01 ---  * ======================== */
    .box-01 {    color: #6e6e6e;font-weight: 500;transition: all 0.3s;position: relative;display: block;box-shadow: 0 0 13px -1px #e2dede;border-radius: 7px;overflow: hidden;    font-size: 13px;margin: 8px;}
    .box-01:hover {transition: all 0.3s;transform: translateY(-2px);box-shadow: 0 0 10px 0px #d8d8d8;}
    .box-01 .pc-01 {transition: all 1s;}
    .box-01:hover .pc-01 {transition: all 1.9s;transform: scale(1.09);}
    .address {color: #6e6e6e;font-weight: 500;}
    .lnk-bx{display:block;overflow:hidden;}
    .contact-01 {padding: 9px;}
    .main-name {font-weight: bold;font-size: 15px;margin: 7px 0 0;    color: #007dec;}
    .itm-01 {padding: 1px 0;}
    .rating-home {margin: 0;padding: 0;font-size: 12px;}
    .pt-0 {padding-top: 0 !important;}
    .ftr-01 {margin: 27px 0 0;}
    .num-reserve {padding: 2px 0;border: 1px solid #dedede;border-radius: 3px;text-align: center;font-size: 12px;color: #3e3e3e;box-shadow: 0 0 6px -3px #cecece;}
    .night-price {justify-content: flex-end;}
    .num-price {font-weight: bold;font-size: 18px;padding: 0 5px;color: #f7941d;}
    .some-info i {color: #949494;margin: 0 0 0 3px;font-size: 12px;}
    .prop {margin: 0 0 0 9px;}
    .abs-item {z-index: 1;position: absolute;right: 5px;top: 5px;}
    .abs-item .itm-social {background: white;width: 31px;height: 31px;display: flex;align-items: center;justify-content: space-around;border-radius: 50%;font-size: 16px;box-shadow: 0 0 7px #9c9c9c;}
    /*=*=*=*=*=*= * --- box-02 ---  * ======================== */
    .bx-02 {position: relative;border: 1px solid #e6e6e6;padding: 9px;border-radius: 4px;    margin: 5px;background: white;}
    .pc-serch {width: 100px !important;height: 75px;object-fit: cover;border-radius: 3px;margin: 0 0 0 9px;}
    .relate-search {border-top: 1px solid #e2e2e2;padding: 18px 0;margin: 0 0 25px;}
    /*=*=*=*=*=*= * --- btn-map ---  * ======================== */
    .map-active {display: flex;align-items: center;justify-content: flex-end;padding: 9px 19px;}
    .titl-map {margin: 0 0 0 11px;}
    .osman {float: left;margin:0 0 !important;appearance: none;outline: none;width: 60px;height: 28px;position: relative;background: linear-gradient(#ccc,#eee);border-radius: 40px;border-top: solid 2px #bbb;border-bottom: solid 2px #fff;cursor: pointer;box-shadow: inset 0 0 5px rgba(0,0,0,.2) inset 0 0 10px rgba(0,0,0,.2) inset 0 0 15px rgba(0,0,0,.2);}
    .osman:checked{background: linear-gradient(#eee,#ccc) ; }
    .osman{background: linear-gradient(rgb(0 227 245),rgb(0 125 236)) ; }
    .osman:checked::before {left: -5px;}
    .osman::before {background: linear-gradient(#eee,#ccc);content: '';position: absolute;width: 31px;height: 31px;top: -3px;left: 31px;border-radius: 50%;border-bottom: solid 2px #bbb;border-top: solid 2px #fff;transition: .3s;box-shadow: 0 0 5px #00000033;}

    /*=*=*=*=*=*= * --- open-map ---  * ======================== */
    #map-markers {height: 100vh !important;}
    .main-map {width: 0;position: absolute;left: 0;transition:all 0.3s;top: 142px;}
    .main-item-s {width: 100%;transition:all 0.3s;}
    .hand-col {-ms-flex: 0 0 25%;flex: 0 0 25%;max-width: 25%;float: right;transition:all 0.3s;}
    .another-stl .main-map {width: 40%;transition:all 0.3s;}
    .another-stl .main-item-s {width: 60%;height: 100vh;overflow: auto;transition:all 0.3s;}
    .another-stl .hand-col {-ms-flex: 0 0 49.333333%;flex: 0 0 49.333333%;max-width: 49.333333%;float: right;transition:all 0.3s;}
    /*=*=*=*=*=*= * --- responsive ---  * ======================== */
    @media (max-width: 700px){
        .row-head-S {overflow: auto;}
        .row.row-head-S.add-cls {overflow: inherit;}
        .d-inline-block{display:inline-block;}
        .d-none{display:none;}
        .each-filter {margin: 1px;padding: 5px 8px;white-space: nowrap;}
        .top-item {font-size: 13px;display: flex;}
        .top-item i {display: none;}
        .each-filter i.far.fa-calendar-alt {font-size: 13px;margin: 0 1px 0 5px;}
        .Q-bx {width: 65px;}
        .hand-col {-ms-flex: 0 0 100%;flex: 0 0 100%;max-width: 100%;}
        .set-order {font-size: 11px;position: relative;z-index: 1;margin: -23px 0 0;}
        .number-Found {font-size: 11px;margin: 19px 0 0;}
        .set-order .title-row {    font-size: 9px;
    margin: 0 0 0 -6px;}
        .order-mob {padding: 3px 5px;font-weight: bold;}
        .ftr-01 .col-sm-2 {width: 16.66666667%;float: right;}
        .ftr-01 .col-sm-10 {width: 83.33333333%;float: right;}
        .profiledropdown {min-width: 79%;left: 0;right: 0;margin: auto;top: 124%;max-width: 94%;}
        .price-field {width: 100%;}
        .price-wrap .col-sm-6 {width: 50%;float: right;}
        .price-wrap #one, .price-wrap #two {font-size: 15px;}
        .unit-price {font-size: 11px;}
        .profiledropdown span.minus, .profiledropdown span.plus {font-size: 11px;width: 23px;height: 23px;margin-right: 3px;}
        .each-filter {position: initial;}
        .more-filter {width: 100%;    height: auto;min-height: 300px;max-height: 59vh;}
        .profiledropdown ul li.col-sm-4,
        .profiledropdown ul li.col-sm-3 {float: right;width: 50%;}
        .ft-bx .col-sm-6 {width: 50%;float: right;padding: 0;}
        .contact-01 .rating-home{width: 39%;float: right;}
        .contact-01 .address {width: 61%;float: right;}
        .pc-serch {width: 46px !important;height: 44px;margin: 0 0 0 4px;}
        .name-serch {font-size: 11px;margin: 0;}
        .bx-02 {padding: 4px;margin: 2px;}
    }

    </style>
<?php $__env->stopSection(); ?>

<?php $__env->startSection('content'); ?>
<div class="Pg-Search-1">
    <div class="container-fluid">
        <?php echo $__env->make('frontend.Filter.Filter', array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>
        <div class="d-flex all-body">
            <div class="main-item-s">
                <div class="container row-body-S">
                    <div class="row main-info">
                        <div class="col-sm-6">
                            <h2 class="title-search">اجاره ویلا در تهران</h2>
                            <p class="number-Found"><?php echo e(count($hostModel)); ?> مورد یافت شد</p>
                        </div>
                        <div class="col-sm-6 text-left">

                            <ul class="set-order">
                                <li class="title-row"> مرتب سازی بر اساس :</li>
                                <li class="select-inMob">
                                    <select class="order-mob">
                                        <option>پیشنهادی</option>
                                        <option>محبوب ترین</option>
                                        <option>ارزان ترین</option>
                                        <option>گران ترین</option>
                                    </select>
                                </li>
                            </ul>
                        </div>
                    </div>
                    <div class="row item-search">
                        <?php $__currentLoopData = $hostModel; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $key => $value): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                            <?php echo $__env->make('frontend.Content.HostBoxSearch', array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>
                        <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                    </div>
                    <div class="about-search">
                        <h4 class="title-describe">اجاره روزانه خانه، سوئیت و آپارتمان مبله در تهران</h4>
                        <p class="describe-search">
                            برای اجاره روزانه خانه در تهران یا اجاره روزانه و ماهانه سوئیت، اتاق و منزل مبله می توانید از طریق فیلترها و جستجوی بالای سایت نتایج دقیق تری را بدست آورید، هم اکنون صدها مورد برای اجاره سوئیت یک روزه، یک ماهه و بلند مدت  ارزان یا لوکس در تهران یا برای اجاره روزانه یا شبانه خانه و آپارتمان مبله در غرب تهران، شرق تهران، شمال و جنوب و مرکز تهران در مناطقی همانند پونک، سعادت آباد، بلوار فردوس، زعفرانیه، کامرانیه، تجریش، شریعتی، ولی عصر، تهران پارس، میرداماد، ونک و سایر مناطق در این سایت موجود است. تمامی مراحل رزرو و اجاره روزانه خانه در تهران و اجاره ماهانه و اجاره بلند مدت بصورت آنلاین انجام می گردد.
                        </p>
                    </div>
                    <div class="relate-search">
                        <h4 class="title-describe">جستجوی مرتبط</h4>
                        <div class="owl-carousel owl-theme sl-1">
                            <div class="item">
                                <a class="bx-02 d-flex align-items-center" href="#">
                                    <img class="pc-serch" src="https://mcdn.mihmansho.com/products/310/home_6971_27911_13990123103256_310.jpg" alt="image"/>
                                    <h4 class="name-serch">اجاره سوئیت و آپارتمان مبله در تهران </h4>
                                </a>
                            </div>
                            <div class="item">
                                <a class="bx-02 d-flex align-items-center" href="#">
                                    <img class="pc-serch" src="https://mcdn.mihmansho.com/products/310/home_6971_27911_13990123103256_310.jpg" alt="image"/>
                                    <h4 class="name-serch">اجاره سوئیت و آپارتمان مبله در تهران </h4>
                                </a>
                            </div>
                            <div class="item">
                                <a class="bx-02 d-flex align-items-center" href="#">
                                    <img class="pc-serch" src="https://mcdn.mihmansho.com/products/310/home_6971_27911_13990123103256_310.jpg" alt="image"/>
                                    <h4 class="name-serch">اجاره سوئیت و آپارتمان مبله در تهران </h4>
                                </a>
                            </div>
                            <div class="item">
                                <a class="bx-02 d-flex align-items-center" href="#">
                                    <img class="pc-serch" src="https://mcdn.mihmansho.com/products/310/home_6971_27911_13990123103256_310.jpg" alt="image"/>
                                    <h4 class="name-serch">اجاره سوئیت و آپارتمان مبله در تهران </h4>
                                </a>
                            </div>
                            <div class="item">
                                <a class="bx-02 d-flex align-items-center" href="#">
                                    <img class="pc-serch" src="https://mcdn.mihmansho.com/products/310/home_6971_27911_13990123103256_310.jpg" alt="image"/>
                                    <h4 class="name-serch">اجاره سوئیت و آپارتمان مبله در تهران </h4>
                                </a>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="main-map">
                <link rel="stylesheet" href="https://unpkg.com/leaflet@1.7.1/dist/leaflet.css" integrity="sha512-xodZBNTC5n17Xt2atTPuE1HxjVMSvLVW9ocqUKLsCC5CXdbqCmblAshOMAS6/keqq/sMZMZ19scR4PsZChSR7A==" crossorigin=""/>
                <script src="https://unpkg.com/leaflet@1.7.1/dist/leaflet.js" integrity="sha512-XQoYMqMTK8LvdxXYG3nZ448hOEQiglfqkJs1NOQV44cWnUrBc8PkAOcXy20w0vlaXaVUearIOBhiXZ5V3ynxwA==" crossorigin=""></script>
                <div id="map-markers" style="height:300px; z-index: 0;"></div>
                <script>
                var tiles = L.tileLayer('https://{s}.tile.openstreetmap.org/{z}/{x}/{y}.png', {
                        maxZoom: 18,
                        attribution: '&copy; <a href="https://www.openstreetmap.org/copyright">OpenStreetMap</a> contributors, Points &copy 2012 LINZ'
                    }),
                    latlng = L.latLng(37.563004, 45.078049); // tehran
                var map = L.map('map-markers', {center: latlng, zoom: 17, layers: [tiles]});
                var title = 'عنوان مارکر';
                var marker = L.marker(new L.LatLng(37.563004, 45.078049), {title: title});
                marker.bindPopup(title);
                map.addLayer(marker);
                map.addLayer(markers);
                </script>
            </div>
        </div>

    </div>
    <div class="overlay1"></div>
</div>

<script>
    //============ open-filter -->
    $(document).ready(function(){
        $('.top-item').click(function () {
            $('.each-filter').removeClass('filter-open');
        	$(this).parent().addClass('filter-open');
        	$('.overlay1').addClass('can-see');
        });
        $('.overlay1').click(function () {
        	$('.top-item').parent().removeClass('filter-open');
        	$(this).removeClass('can-see');
        	$('.row-head-S').removeClass('add-cls');
        });
        $('.osman:checked').click(function () {
        	$('.all-body').toggleClass('another-stl');
        });
        $('.row-head-S').click(function () {
            $(this).addClass('add-cls');
        });
    });
    //============ slider-price -->
    var lowerSlider = document.querySelector('#lower');
    var  upperSlider = document.querySelector('#upper');
    document.querySelector('#two').value=upperSlider.value;
    document.querySelector('#one').value=lowerSlider.value;
    var  lowerVal = parseInt(lowerSlider.value);
    var upperVal = parseInt(upperSlider.value);
    upperSlider.oninput = function () {
        lowerVal = parseInt(lowerSlider.value);
        upperVal = parseInt(upperSlider.value);
        if (upperVal < lowerVal + 4) {
            lowerSlider.value = upperVal - 4;
            if (lowerVal == lowerSlider.min) {
                upperSlider.value = 4;
            }
        }
        document.querySelector('#two').value=this.value
    };
    lowerSlider.oninput = function () {
        lowerVal = parseInt(lowerSlider.value);
        upperVal = parseInt(upperSlider.value);
        if (lowerVal > upperVal - 4) {
            upperSlider.value = lowerVal + 4;
            if (upperVal == upperSlider.max) {
                lowerSlider.value = parseInt(upperSlider.max) - 4;
            }
        }
        document.querySelector('#one').value=this.value
    };
    //============ relat-search -->
    $(document).ready(function() {
    	$('.owl-carousel.sl-1').owlCarousel({
    		rtl:true,
    		nav: false,
    		dots:true,
    		margin: 0,
    		responsiveClass: true,
    		responsive: {
    			0: {
    				items: 2
    			},
    			600: {
    				items: 3
    			},
    			1000: {
    				items: 4
    			},
    			1250: {
    				items: 5
    			}
    		}
    	})
    });
</script>
<?php $__env->stopSection(); ?>

<?php echo $__env->make('frontend.MasterPage.Layout', array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>