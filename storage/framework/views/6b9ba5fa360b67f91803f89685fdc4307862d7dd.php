<?php $__env->startSection('title',TitlePage('صفحه اصلی')); ?>
<?php $__env->startSection('style'); ?>
    <link rel="stylesheet" type="text/css" href="<?php echo e(asset('frontend/css/edit-home-page.css')); ?>">
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



                </div>
            </div>
        </div>
    </div>
    <div class="container-fluid section1">
        <div class="container-section gap-col-mob">

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