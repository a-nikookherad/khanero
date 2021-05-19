<?php $__env->startSection('title', TitlePage('صفحه اصلی')); ?>
<?php $__env->startSection('meta'); ?>
    <meta name="description" content="">
    <meta name="twitter:description" content="">
    <meta name="twitter:title" content="<?php echo e(TitlePage('صفحه اصلی')); ?>">
    <meta property="og:description" content="">
    <meta property="keyword" content="">
<?php $__env->stopSection(); ?>
<?php $__env->startSection('style'); ?>

<?php $__env->stopSection(); ?>
<?php $__env->startSection('slide'); ?>
    <?php echo $__env->make('frontend.Page.SlideShow.SlideHomePage', array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>
<?php $__env->stopSection(); ?>
<?php $__env->startSection('content'); ?>

    <div class="box-item">
        <div class="container">
            <div class="row ">
                <div class="col-xs-12 col-sm-3">
                    <button type="button" class="btn-modal-emp" data-toggle="modal" data-target="#myModal1">

                        <div class="box-img"><img src="<?php echo e(asset('frontend/images/img1.png')); ?>" alt="logo"></div>
                        <h3>
                            اطالعات کامل اقامتگاه
                        </h3>
                        <p>
                            امکان گفتگوی آنلاین پیش از پرداخت رزرو
                        </p>
                    </button>
                    <div class="modal fade" id="myModal1" role="dialog">
                        <div class="modal-dialog">

                            <!-- Modal content-->
                            <div class="modal-content">
                                <div class="modal-header">
                                    <button type="button" class="close" data-dismiss="modal">&times;</button>
                                    <h4 class="modal-title">عنوان مربوطه </h4>
                                </div>
                                <div class="modal-body">
                                    <div class="box-img"><img src="<?php echo e(asset('frontend/images/img1.png')); ?>" alt="logo"></div>
                                    <h3>
                                        اطالعات کامل اقامتگاه
                                    </h3>
                                    <p>
                                        امکان گفتگوی آنلاین پیش از پرداخت رزرو
                                    </p>
                                </div>

                            </div>

                        </div>
                    </div>
                </div>

                <div class="col-xs-12 col-sm-3">
                    <button type="button" class="btn-modal-emp" data-toggle="modal" data-target="#myModal2">

                        <div class="box-img"><img src="<?php echo e(asset('frontend/images/img21.png')); ?>" alt="logo"></div>
                        <h3>
                            قیمت مناسب
                        </h3>
                        <p>
                            اقامت شما توسط بیمه سامان، رایگان بیمه می‌شود
                        </p>
                    </button>
                    <div class="modal fade" id="myModal2" role="dialog">
                        <div class="modal-dialog">

                            <!-- Modal content-->
                            <div class="modal-content">
                                <div class="modal-header">
                                    <button type="button" class="close" data-dismiss="modal">&times;</button>
                                    <h4 class="modal-title">عنوان مربوطه </h4>
                                </div>
                                <div class="modal-body">

                                    <div class="box-img"><img src="<?php echo e(asset('frontend/images/img21.png')); ?>" alt="logo"></div>
                                    <h3>
                                        قیمت مناسب
                                    </h3>
                                    <p>
                                        اقامت شما توسط بیمه سامان، رایگان بیمه می‌شود
                                    </p>
                                </div>

                            </div>

                        </div>
                    </div>
                </div>
                <div class="col-xs-12 col-sm-3">
                    <button type="button" class="btn-modal-emp" data-toggle="modal" data-target="#myModal3">

                        <div class="box-img"><img src="<?php echo e(asset('frontend/images/img3.png')); ?>" alt="logo"></div>
                        <h3>
                            ضمانت تحویل </h3>
                        <p>
                            آسودگی خاطر از نظافت و تمیزی اقامتگاه ها
                        </p>
                    </button>

                    <div class="modal fade" id="myModal3" role="dialog">
                        <div class="modal-dialog">

                            <!-- Modal content-->
                            <div class="modal-content">
                                <div class="modal-header">
                                    <button type="button" class="close" data-dismiss="modal">&times;</button>
                                    <h4 class="modal-title">عنوان مربوطه </h4>
                                </div>
                                <div class="modal-body">
                                    <div class="box-img"><img src="<?php echo e(asset('frontend/images/img3.png')); ?>" alt="logo"></div>
                                    <h3>
                                        پشتیبانی 24 ساعته </h3>
                                    <p>
                                        همراه شما در تمام مراحل از رزرو تا پایان سفر </p>

                                </div>

                            </div>

                        </div>
                    </div>

                </div>


                <div class="col-xs-12 col-sm-3">
                    <button type="button" class="btn-modal-emp" data-toggle="modal" data-target="#myModal4">

                        <div class="box-img"><img src="<?php echo e(asset('frontend/images/img2.png')); ?>" alt="logo"></div>
                        <h3>
                            پشتیبانی 24 ساعته </h3>
                        <p>
                            همراه شما در تمام مراحل از رزرو تا پایان سفر </p>

                    </button>

                    <!-- Modal -->
                    <div class="modal fade" id="myModal4" role="dialog">
                        <div class="modal-dialog">

                            <!-- Modal content-->
                            <div class="modal-content">
                                <div class="modal-header">
                                    <button type="button" class="close" data-dismiss="modal">&times;</button>
                                    <h4 class="modal-title">عنوان مربوطه </h4>
                                </div>
                                <div class="modal-body">
                                    <div class="box-img"><img src="<?php echo e(asset('frontend/images/img2.png')); ?>" alt="logo"></div>
                                    <h3>
                                        پشتیبانی 24 ساعته </h3>
                                    <p>
                                        همراه شما در تمام مراحل از رزرو تا پایان سفر </p>

                                </div>

                            </div>

                        </div>
                    </div>


                </div>


            </div>
        </div>
    </div>

    <div class="main0">
        <div class="container">
            <div class="row ">
                <div class="col-xs-12 col-sm-12">

                    <h3>
                        <img src="<?php echo e(asset('frontend/images/icon1.jpg')); ?>" alt="logo">
                        <span>
                  مروری بر دسته بندی اقامتگاه

                </span>
                    </h3>
                    <div id="demos">
                        <div class="large-12 columns">
                            <div class="owl-carousel owl-theme demos carusel1">
                                <?php echo $__env->make('frontend.Content.CategoryBox', array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>
                            </div>
                        </div>
                    </div>
                </div>


                <div class="col-xs-12 col-sm-12">

                    <h3>
                        <img src="<?php echo e(asset('frontend/images/icon2.png')); ?>" alt="logo">
                        <span>
                      اقامتگاه های شمالی
                </span>
                        <a href="" class="all-place">
                            همه اقامتگاه ها
                        </a>
                    </h3>
                    <div id="demos">
                        <div class="large-12 columns">
                            <div class="owl-carousel owl-theme demos carusel2">



                            </div>
                        </div>
                    </div>
                </div>


                <div class="col-xs-12 col-sm-12">

                    <h3>
                        <img src="<?php echo e(asset('frontend/images/icon3.png')); ?>" alt="logo">
                        <span>
                      اقامتگاه های شمالی
                </span>
                        <a href="" class="all-place">
                            همه اقامتگاه ها
                        </a>
                    </h3>
                    <div id="demos">
                        <div class="large-12 columns">
                            <div class="owl-carousel owl-theme demos carusel2">



                            </div>
                        </div>
                    </div>

                </div>


                <div class="col-xs-12 col-sm-12">

                    <h3>
                        <img src="<?php echo e(asset('frontend/images/icon1.jpg')); ?>" alt="logo">
                        <span>
محبوبترین مقصدها
</span>
                    </h3>
                    <div id="demos" class="carousel1">
                        <div class="large-12 columns">
                            <div class="owl-carousel owl-theme demos2 carusel2">
                                <div class="item">
                                    <div class="item1">
                                        <img src="<?php echo e(asset('frontend/images/img66.png')); ?>" alt="logo">

                                        <div class="description2">
                                            <a href="">
                                                <h4>
                                                    قشم
                                                </h4>
                                                <span>
			            24 خانه
			          </span>
                                            </a>
                                        </div>
                                    </div>
                                </div>

                                <div class="item">
                                    <div class="item1">
                                        <img src="<?php echo e(asset('frontend/images/img66.png')); ?>" alt="logo">

                                        <div class="description2">
                                            <a href="">
                                                <h4>
                                                    قشم
                                                </h4>
                                                <span>
			            24 خانه
			          </span>
                                            </a>
                                        </div>
                                    </div>
                                </div>

                                <div class="item">
                                    <div class="item1">
                                        <img src="<?php echo e(asset('frontend/images/img66.png')); ?>" alt="logo">

                                        <div class="description2">
                                            <a href="">
                                                <h4>
                                                    قشم
                                                </h4>
                                                <span>
			            24 خانه
			          </span>
                                            </a>
                                        </div>
                                    </div>
                                </div>

                                <div class="item">
                                    <div class="item1">
                                        <img src="<?php echo e(asset('frontend/images/img66.png')); ?>" alt="logo">

                                        <div class="description2">
                                            <a href="">
                                                <h4>
                                                    قشم
                                                </h4>
                                                <span>
			            24 خانه
			          </span>
                                            </a>
                                        </div>
                                    </div>
                                </div>

                                <div class="item">
                                    <div class="item1">
                                        <img src="<?php echo e(asset('frontend/images/img66.png')); ?>" alt="logo">

                                        <div class="description2">
                                            <a href="">
                                                <h4>
                                                    قشم
                                                </h4>
                                                <span>
			            24 خانه
			          </span>
                                            </a>
                                        </div>
                                    </div>
                                </div>


                            </div>
                        </div>
                    </div>
                </div>


                <div class="col-xs-12 col-sm-12">

                    <h3>
                        <img src="<?php echo e(asset('frontend/images/icon1.jpg')); ?>" alt="logo">
                        <span>
                      اقامتگاه های شمالی
                </span>
                        <a href="" class="all-place">
                            همه اقامتگاه ها
                        </a>
                    </h3>
                    <div id="demos">
                        <div class="large-12 columns">
                            <div class="owl-carousel owl-theme demos carusel2">



                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <div class="main">
        <div class="container-fluid">
            <div class="row ">
                <div class="col-xs-12 col-sm-6">
                    <div class="text-img">
                        <h3>
                            اقامتـــگاه‌های آنـــی
                        </h3>
                        <p>
                            بدون انتظار تایید میزبان
                        </p>
                        <p>
                            برای رزرو این اقامتگاه‌ها نیاز به تایید میزبان نیست و می‌توانید

                        </p>
                        <span>
	                  بدون انتظار اقامتگاه خود را رزرو کنید
	              </span>
                    </div>


                </div>

                <div class="col-xs-12 col-sm-6">

                    <div class="sale-inside">
                        <a href="">
                            مشاهده اقامتگاه آنی
                        </a>

                    </div>
                </div>
            </div>
        </div>
    </div>


    <div id="main1" class="main0">
        <div class="container">
            <div class="row">


                <div class="col-xs-12 col-sm-12">

                    <h3>
                        <img src="<?php echo e(asset('frontend/images/icon1.jpg')); ?>" alt="logo">
                        <span>
اقامتگاه های مقرون به صرفه                </span>
                        <a href="" class="all-place">
                            همه اقامتگاه ها
                        </a>


                    </h3>
                    <div id="demos">
                        <div class="large-12 columns">
                            <div class="owl-carousel owl-theme demos carusel2">



                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
<?php $__env->stopSection(); ?>
<?php echo $__env->make('frontend.MasterPage.Layout', array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>