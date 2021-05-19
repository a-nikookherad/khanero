<?php $__env->startSection('title',TitlePage('صفحه اصلی')); ?>
<?php $__env->startSection('style'); ?>
    
    
<style>
.box {
    border-radius: 7px;
    padding: 15px;
    position: relative;
    text-align: center;
}
.m-auto {
    margin: auto;
}
    .box img {width: 31%;margin: 0 auto;}
    .title-section {text-align: center;margin: 56px 0 38px;padding: 0 0 12px;box-shadow: 0 10px 11px -15px #cecece;}
    .col-sm-6.hidden-xs.gap-col.l-section ul {margin: 13px 0;font-size: 15px;}
    #top-section {margin: 0 auto 50px;width: 100%;height: 600px;background-image: url(../frontend/images/55.jpg);position: relative; background-attachment: fixed; background-position: center;background-size: cover;}
    /*#top-section:before {content: "";background-image: inherit;position: absolute;top: 100%;left: 0;right: 0;bottom: -100%;transform: rotateX(180deg);background-position: center;background-size: cover;}*/
    /*#top-section:after {content: "";position: absolute;width: 100%;height: 100%;bottom: -100%;background: linear-gradient(0deg, #fff ,#fff ,#ffffffeb,#ffffff1f);z-index: 2;}*/
    .list-menu:hover {background-color: #ffaeab;}
    .box-filter input {text-align: right;}
    .product-name a {color: #333;font-size: 15px;}
    .short-desc {color: #888;font-size: 12px;}
    .top-section {margin: 0 -10px !important;}
    .top-section .box-section {border: 1px solid #ddd;border-radius: 5px;float: left;padding: 8px 0px;}
    .top-section img {width: 165px;}
    .top-section a {color: #555;}
    .main-slide1 i.fas.fa-angle-left,
    .main-slide1 i.fas.fa-angle-right,
    .main-slide1 .owl-next,
    .main-slide1 .owl-prev,
    .main-slide2 i.fas.fa-angle-left,
    .main-slide2 i.fas.fa-angle-right,
    .main-slide2 .owl-next,
    .main-slide2 .owl-prev {display: none !important;}
    .bx-contect {transition:all 0.6s;position: absolute;left: 0;right: 0;bottom: -200px;}
    .Box-11 {position: relative;overflow: hidden; }
    .Box-11:hover .bx-contect {transition: all 0.6s;bottom: 0;background: linear-gradient(0deg, #242424, transparent);padding: 26px 0;}
    .Box-11:hover img {transform: scale(1.09);transition: all 0.6s;}
    .Box-11 img {transition: all 0.6s;}
    .l-section ul li a {color: #000000;}
    .Box-34 {margin: 12px 0;transition: all 0.3s;}
    .Box-34:hover {box-shadow: 0 0 6px 0px #d7d7d7;transform: translateY(-6px);transition: all 0.3s;}
    .box-texts {padding: 0 16px 11px;}
    
    .box-tab-search {margin: 23% 0 0;}
    .tab-content {background: #ffffff9e;padding: 21px;color: black;}
    h4.tite-b-x {padding: 10px 0;margin: 0 0 18px;border-bottom: 1px solid white;}
    .inbx-prt {background: white;border: 1px solid white;position: relative;padding: 0 29px 0 0;}
    .inbx-prt i {position: absolute;right: 15px;top: 11px;font-size: 22px;color: #fe5213;}
    input.search-tp,
    button.btn-data-tp,
    button.sub-search{width: 100%;padding: 11px 15px;background: transparent;}
    .inbx-prt-submit {background: #fe5213;color: white;border-radius: 33px; transition: all 0.3s;}
    .inbx-prt-submit:hover {border-radius: 0;transition: all 0.3s;}
    button:focus {outline:0;}
    .box-tab-search a {color: white;font-size: 17px;border: 0 !important;}
    .box-tab-search li.active a {background: #ffffff9e !important;border-top: 2px solid #fe5213 !important;margin: 0;}
    .nav-tabs {border-bottom: 0;}
    .nav-tabs>li {margin-bottom: 0;}
    
    @media (max-width: 800px){
        .description-section .box .box-img {padding: 19px 0 13px !important;width: 21% !important;position: absolute;top: 0;bottom: 0;margin: auto;height: 118px;}
        .container-section ,.description-section .box .box-img {padding: 0;}
        #top-section {height: 440px;    margin: 0;background-attachment: inherit;}
        .box-tab-search li.active a {font-size: 13px;padding: 6px 11px 0;}
        .tab-content {padding: 12px;}
        h4.tite-b-x {padding: 7px 0;margin: 0 0 15px;}
        input.search-tp, button.btn-data-tp, button.sub-search {padding: 6px 0px;font-size: 12px;}
        .inbx-prt i {right: 8px;top: 9px;font-size: 14px;}
        .inbx-prt {padding: 0 27px 0 0;border-radius: 30px;overflow: hidden;margin: 0 0 5px 0;}
        .box-tab-search {margin: 27% 0 0;}
        .box h4 {margin: 9px 0 5px;font-size: 15px;}
        .box p {font-size: 12px;}
        .title-section {margin: 0px 0 22px;padding: 0 0 1px;}.container-section.content-home {margin: 0 17px;}
        .footer .col-xs-12.col-sm-6.col-md-6 .col-md-9 {padding: 0;}
        footer.footer h5 {margin: 16px 0 7px;}
        .footer img.logo {width: 58%;margin: auto;}
        .description-section .col-md-4.col-sm-4.p-0:nth-child(odd) .box .box-img{right: 0;}
        .description-section .col-md-4.col-sm-4.p-0:nth-child(even) .box .box-img{left: 0;}
        .container-section.content-home {margin: 0 auto;width: 100%;overflow-x: hidden;}
    }
    
</style>
<?php $__env->stopSection(); ?>

<?php $__env->startSection('content'); ?>

    <div id="top-section">
        <div class="front-section">
            <div class="container">
                <div class="box-tab-search">
                    <div class="tab">
                        <ul class="nav nav-tabs">
                            <li class="active"><a data-toggle="tab" href="tab1">اقامتگاه ها</a></li>
                            <!--<li><a data-toggle="tab" href="#tab2">Menu 1</a></li>-->
                        </ul>
                    </div>
                    <div class="tab-content">
                        <div id="tab1" class="tab-pane fade in active">
                            <div class="row-title">
                                <h4 class="tite-b-x">اجاره اقامتگاه در سراسر ایران</h4>
                            </div>
                            <div class="row rw-search">
                                <div class="col-sm-10">
                                    <div class="inbx-prt">
                                        <i class="fas fa-map-marker-alt"></i>
                                        <input class="search-tp" placeholder="کجا میری ؟ (جستجوی مقصد)" />
                                    </div>
                                </div>
                                <!--<div class="col-sm-2"><div class="inbx-prt"><i class="fas fa-calendar-alt"></i><button class="btn-data-tp" >تاریخ ورود</button></div></div>-->
                                <!--<div class="col-sm-2"><div class="inbx-prt"><i class="fas fa-calendar-alt"></i><button class="btn-data-tp" >تاریخ ورود</button></div></div>-->
                                <div class="col-sm-2"><div class="inbx-prt-submit"><button class="sub-search"><i class="fas fa-search"></i><span class="txt-search">جستجو</span></button></div></div>
                            </div>
                        </div>
                        <div id="tab2" class="tab-pane fade">
                            <div class="row-title">
                                <h4 class="tite-b-x">رزرو هتل و اقامتگاه داخلی</h4>
                            </div>
                            <div class="row rw-search">
                                <div class="col-sm-10">
                                    <div class="inbx-prt">
                                        <i class="fas fa-map-marker-alt"></i>
                                        <input class="search-tp" placeholder="کجا میری ؟ (جستجوی مقصد)" />
                                    </div>
                                </div>
                                <!--<div class="col-sm-2"><div class="inbx-prt"><i class="fas fa-calendar-alt"></i><button class="btn-data-tp" >تاریخ ورود</button></div></div>-->
                                <!--<div class="col-sm-2"><div class="inbx-prt"><i class="fas fa-calendar-alt"></i><button class="btn-data-tp" >تاریخ ورود</button></div></div>-->
                                <div class="col-sm-2"><div class="inbx-prt-submit"><button class="sub-search">جستجو</button></div></div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <div class="container-section content-home" style="position: relative;z-index: 9;">
        <div class="row">
            <?php echo $__env->make('frontend.Section.TopSectionDescription', array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>
        </div>
        <br>
        <div class="row">
            <div class="col-sm-12 col-xs-12">
                <div class="title-section">
                    <h3>شهرهای پربازدید</h3>
                </div>
                <?php echo $__env->make('frontend.Section.VisitedCity', array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>
            </div>
        </div>
        <div class="row flex-row" id="ExtraContentSearch">
            <div class="col-sm-12 col-xs-12 gap-col result right-section">
                <div class="row row-slider">
                    <div class="title-section">
                        <h3 class="">جدید ترین ها</h3>
                        <span>جدیدترین اقامتگاه های ثبت شده در کشور</span>
                    </div>
                    
                    <?php echo $__env->make('frontend.Section.NewHost', array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>

                </div>
            </div>
        </div>
        <div class="row flex-row" id="ExtraContentSearch">
            <div class="col-sm-12 col-xs-12 gap-col result right-section">
                <div class="row row-slider">
                    <div class="title-section">
                        <h3 class="">جدید ترین مجتمع ها</h3>
                        <span>جدیدترین مجتمع های ثبت شده در کشور</span>
                    </div>

                    <?php echo $__env->make('frontend.Section.NewIntegrated', array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>

                </div>
            </div>
        </div>
    </div>
    <div class="container-fluid section1">
        <div class="container-section gap-col-mob">
            <?php echo $__env->make('frontend.Section.AboutSection', array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>
        </div>
    </div>



<?php $__env->stopSection(); ?>

<?php $__env->startSection('script'); ?>
    <script>


        $(document).ready(function () {

            var owlCarouselTimeout = 1000;
            var owl = $('.owl-slider');
            owl.owlCarousel({
                items: 1,
                loop: false,
                rtl: true,
                navText: ["<i class='fas fa-angle-left'></i>", "<i class='fas fa-angle-right'></i>"],
                autoplay: false,
                autoplayTimeout: 5000,
                autoplayHoverPause: true,


                responsive: {
                    767: {
                        dots: true,
                        nav: false
                    },
                    768: {
                        nav: true
                    }

                }
            });


            $('.dropdown-toggle').click(function () {
                if (!$('.dropdown-toggle').parent().hasClass('open')) {
                    $('.grid_page').addClass('cover');
                }
            });
            $('.grid_page').click(function () {
                $('.grid_page').removeClass('cover');
            });
        });

        $(".k-switch").click(function () {

            // Simple Code
            var self = $(this);

            if (self.hasClass("on")) {
                self.removeClass("on");
                self.addClass("off");
                $('.left-section').addClass('h');
                $('.right-section').addClass('f');
                $('.owl-carousel').trigger('refresh.owl.carousel');
            } else {
                self.addClass("on");
                self.removeClass("off");
                $('.left-section').removeClass('h');
                $('.right-section').removeClass('f');
                $('.owl-carousel').trigger('refresh.owl.carousel');
            }
        });
    </script>
<?php $__env->stopSection(); ?>
<?php echo $__env->make('frontend.MasterPage.Layout', array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>