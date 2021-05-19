<!DOCTYPE html>
<html lang="fa">
<?php  $actual_link = "http://$_SERVER[HTTP_HOST]$_SERVER[REQUEST_URI]";  ?>
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0, maximum-scale=1.0, user-scalable=no">
    <meta name="theme-color" content="#007dec">

    <title><?php echo $__env->yieldContent('title'); ?></title>

    <meta property="og:url" content="<?php echo e($actual_link); ?>">
    <meta name="csrf-token" content="<?php echo e(csrf_token()); ?>">
    <?php echo $__env->yieldContent('meta'); ?>
    <link href="<?php echo e(asset('frontend/css/bootstrap.min.css')); ?>" rel="stylesheet">
    <link href="<?php echo e(asset('frontend/css/bootstrap.css')); ?>" rel="stylesheet">
    <link href="<?php echo e(asset('frontend/css/bootstrap-theme.css')); ?>" rel="stylesheet">
    <link rel="stylesheet" href="<?php echo e(asset('frontend/css/owl.carousel.min.css')); ?>">
    <link rel="stylesheet" href="<?php echo e(asset('frontend/css/owl.theme.default.css')); ?>">
    <link rel="stylesheet" href="<?php echo e(asset('frontend/css/persian-datepicker.css')); ?>">
    <link href="<?php echo e(asset('frontend/css/fontawesome-all.min.css')); ?>" rel="stylesheet">
    <link href="<?php echo e(asset('frontend/css/custom.css?v=03')); ?>" rel="stylesheet">
    <script src="<?php echo e(asset('frontend/js/jquery.min.js')); ?>"></script>
    <?php echo $__env->yieldContent('style'); ?>

</head>
<body>
<div class="top">
    <div class="top1">
        <div class="container">
            <div class="row fix-w">
                <div class="col-xs-4 col-sm-4 p-0 pr-x-0">
                    <div id="logo"><img src="<?php echo e(asset('frontend/images/LOGO0.png')); ?>" alt="logo"></div>
                </div>
                <div class="col-sm-8 col-xs-8 p-0 px-0">
                    <ul class="link-top">
                        <li class="hidden-xs phone">
                            <img src="<?php echo e(asset('frontend/images/icon-t1.png')); ?>" alt="logo"> <a href=""> 0910 698 66 86 </a>
                        </li>
                        <li class="sabt">
                            <a href="">
                                <span> <img src="<?php echo e(asset('frontend/images/icon-t2.png')); ?>" alt="logo"></span>
                                <span>ثبت اقامتگاه </span>
                            </a>
                        </li>
                        <li class="box-login">
                            <?php if(!auth()->check()): ?>
                                <span>
                                    <a href="<?php echo e(route('Login')); ?>">
                                        <span>
                                            <img src="<?php echo e(asset('frontend/images/user.png')); ?>">
                                        </span>
                                        <span> ورود </span>
                                    </a>
                                </span>
                                <span class="line-login"> </span>
                                <span>
                                    <a href="<?php echo e(route('Register')); ?>">
                                     ثبت نام
                                    </a>
                                </span>
                            <?php else: ?>
                                <?php if(auth()->user()->role_id == 1): ?>
                                    <span>
                                        <a href="<?php echo e(route('AdminDashboard')); ?>">
                                             پنل مدیریتی
                                        </a>
                                    </span>
                                <?php else: ?>
                                    <span>
                                        <a href="<?php echo e(route('UserDashboard')); ?>">
                                             پنل کاربری
                                        </a>
                                    </span>
                                <?php endif; ?>
                            <?php endif; ?>

                        </li>
                    </ul>
                </div>


            </div>

        </div>
    </div>
    <div class="slider">
        <div class="container-fluid">
            <div class="col-xs-12 col-md-12 col-sm-12 no-padding">
                <div class="phone-slide hidden-lg hidden-md hidden-sm">
                    <a href="">
                        <span><img src="<?php echo e(asset('frontend/images/icon-t1.png')); ?>" alt="logo"></span>
                        <span> 0910 698 66 86 </span>

                    </a>
                </div>
                <div id="myCarousel" class="carousel slide carousel-fade" data-ride="carousel">
                    <!-- Indicators -->

                    <!-- Wrapper for slides -->
                    <div class="carousel-inner">
                        <div class="item active" data-slide-to="0"><img src="<?php echo e(asset('frontend/images/SLIDER22.jpg')); ?>" alt="Los Angeles"
                                                                        style="width:100%;"></div>

                    </div>

                    <!-- Left and right controls
                    <a class="left carousel-control" href="#myCarousel" data-slide="prev">
                        <span class="fa fa-chevron-left"></span>
                        <span class="sr-only">Previous</span>
                      </a>
                      <a class="right carousel-control" href="#myCarousel" data-slide="next">
                          <span class="fa fa-chevron-right"></span>
                          <span class="sr-only">Next</span>
                      </a>
                      -->
                </div>
            </div>

            <div class="box-search">
                <div class="row">
                    <div class="col-xs-12">
                        <h1 class="title-site"> اجاره و رزرو آنلاین ویلا، سوییت واقامتگاه در سراسر ایران </h1>
                    </div>
                </div>
                <div class="row">
                    <div class="col-xs-12">
                        <div id="search">
                            <form class="search" action="/action_page.php">
                                <div class="input-search">
                                    <span class="icon-to"></span>
                                    <span class="search2">
					 <input class="" type="text" placeholder=" شهر مقصد یا کد اقامتگاه" name="search2">
				 </span>
                                </div>

                                <div class="date">
                                    <div class="datepersian">
                                        <span class="icon-calender"></span>
                                        <span class="input-calender">
						 <input class="input-date1" type="" placeholder=" تاریخ ورود" name="">
					 </span>
                                    </div>
                                    <div class="datepersian">
                                        <span class="icon-calender"></span>
                                        <span class="input-calender">
						   <input class="input-date2" type="" placeholder=" تاریخ خروج" name="">
					 </span>
                                    </div>
                                    <div class="number">
                                        <span class="icon-number"></span>
                                        <span class="minus"><i class="fas fa-minus"></i></span>
                                        <input type="text" value="1" placeholder="تعداد نفرات">
                                        <span class="text-number"> نفر</span>
                                        <span class="plus"><i class="fas fa-plus"></i></span>
                                    </div>


                                    <script>
                                        $(document).ready(function () {
                                            $('.minus').click(function () {
                                                var $input = $(this).parent().find('input');
                                                var count = parseInt($input.val()) - 1;
                                                count = count < 1 ? 1 : count;
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
                                    </script>

                                </div>
                                <button class="btn-search" type="submit">جستجو</button>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
<!--top -->


<?php echo $__env->yieldContent('content'); ?>


<div class="container-fluid footer-bottom">
    <div class="container">
        <div class="row social-footer hidden-lg hidden-md ">
            <div class="col-12 text-center">
                <ul>
                    <li>
                        <a href="">
                            <span class="flip"><img src="<?php echo e(asset('frontend/images/telegaram.png')); ?>" data-loaded="true"></span>
                            <span class="flop"><img src="<?php echo e(asset('frontend/images/telegaram.png')); ?>" data-loaded="true"></span>
                        </a>

                    </li>
                    <li>
                        <a href="">
                            <span class="flip"><img src="<?php echo e(asset('frontend/images/instagram.png')); ?>" data-loaded="true"></span>
                            <span class="flop"><img src="<?php echo e(asset('frontend/images/instagram.png')); ?>" data-loaded="true"></span>
                        </a>
                    </li>
                    <li>
                        <a href="">
                            <span class="flip"><img src="<?php echo e(asset('frontend/images/aparat.png')); ?>" data-loaded="true"></span>
                            <span class="flop"><img src="<?php echo e(asset('frontend/images/aparat.png')); ?>" data-loaded="true"></span>
                        </a>
                    </li>
                    <li>
                        <a href="">
                            <span class="flip"><img src="<?php echo e(asset('frontend/images/whatasapp.png')); ?>" data-loaded="true"></span>
                            <span class="flop"><img src="<?php echo e(asset('frontend/images/whatasapp.png')); ?>" data-loaded="true"></span>
                        </a>
                    </li>
                </ul>
            </div>
        </div>
        <div class="row row-align-items-center">
            <div class="col-lg-4 col-md-4 col-xs-12 pr-xl-0 info-col">
                <p class="title-support">
                    تماس با پشتیبانی
                    <span class="color-text">پاسخ گویی 9 صبح الی 11 شب</span>
                </p>
                <div class="d-block info-cal">
					<span class="phone-number">
						<a href="tel:09106986686">0910 698 66 86<span class="icon-phone"></span></a>
					</span>
                </div>

            </div>
            <div class="col-lg-4 col-md-4 col-xs-12 px-0 news-letter-col hidden-xs">
                <div class="row social-footer">
                    <div class="col-12 text-center">
                        <ul>
                            <li>
                                <a href="">
                                    <span class="flip"><img src="<?php echo e(asset('frontend/images/telegaram.png')); ?>" data-loaded="true"></span>
                                    <span class="flop"><img src="<?php echo e(asset('frontend/images/telegaram.png')); ?>" data-loaded="true"></span>
                                </a>

                            </li>
                            <li>
                                <a href="">
                                    <span class="flip"><img src="<?php echo e(asset('frontend/images/instagram.png')); ?>" data-loaded="true"></span>
                                    <span class="flop"><img src="<?php echo e(asset('frontend/images/instagram.png')); ?>" data-loaded="true"></span>
                                </a>
                            </li>
                            <li>
                                <a href="">
                                    <span class="flip"><img src="<?php echo e(asset('frontend/images/aparat.png')); ?>" data-loaded="true"></span>
                                    <span class="flop"><img src="<?php echo e(asset('frontend/images/aparat.png')); ?>" data-loaded="true"></span>
                                </a>
                            </li>
                            <li>
                                <a href="">
                                    <span class="flip"><img src="<?php echo e(asset('frontend/images/whatasapp.png')); ?>" data-loaded="true"></span>
                                    <span class="flop"><img src="<?php echo e(asset('frontend/images/whatasapp.png')); ?>" data-loaded="true"></span>
                                </a>
                            </li>
                        </ul>
                    </div>
                </div>
            </div>
            <div class="col-lg-4 col-md-4 col-xs-12 pl-xl-0 px-0">
                <ul class="namad">
                    <li>
                        <img src="<?php echo e(asset('frontend/images/namad1.png')); ?>" class="img-responsive">
                    </li>
                    <li>
                        <img src="<?php echo e(asset('frontend/images/namad2.png')); ?>" class="img-responsive">
                    </li>
                    <li>
                        <img src="<?php echo e(asset('frontend/images/logo2.png')); ?>" class="img-responsive">
                    </li>
                </ul>
            </div>
        </div>
    </div>
</div>
<div class="footer">
    <div class="container ">
        <div class="row">
            <div class="col-xs-12 col-sm-12 col-md-4 footer0 pr-md-0 px-0">
                <div class="row">
                    <div class="col-lg-10 pr-md-0 px-0">
                        <div class="d-block logo-footer">
                            <img src="<?php echo e(asset('frontend/images/logo-f.png')); ?>" alt="logo" class="img-footer">
                        </div>
                        <div class="d-block about-company">
                            تجربه در این زمینه فعالیت خود را در حوزه تولید و واردات تجهیزات شمس تجهیز در زمینه تولید،
                            واردات ، مشاوره ، طراحی و صنعت تجهیزات آشپزخانه های تحولی شگرف بوجود آورده است
                            واردات ، مشاوره ، طراحی و صنعت تجهیزات آشپزخانه های تحولی شگرف بوجود آورده است

                        </div>
                    </div>
                </div>
            </div>

            <div class="col-lg-4 col-md-4 col-sm-6 px-0 pupiular-service accordion-container">
                <div class="set">
        			<span class="service-icon">
						 <span class="title-footer lnk-footer un-link"><span> ارتباط با ما</span></span>

						 <i class="fa-chevron-down fas fa-chevron-up" aria-hidden="false"></i>
					</span>
                    <div class="content">
                        <ul class="lnk-footers">
                            <li><a href="">قوانین و مقررات </a></li>
                            <li><a href="">تماس با ما</a></li>
                            <li><a href="">ثبت شکایات</a></li>
                        </ul>
                        <ul class="lnk-footers">
                            <li><a href="">درباره ما</a></li>
                            <li><a href="">مراحل رزرو</a></li>
                        </ul>
                    </div>
                </div>
            </div>

            <div class="col-lg-4 col-md-4 col-sm-6 px-0 pupiular-service accordion-container">
                <div class="set">
        			<span class="service-icon">
						 <span class="title-footer lnk-footer un-link"><span> دسترسی سریع</span></span>

						 <i class="fa-chevron-down fas fa-chevron-up" aria-hidden="false"></i>
				     </span>
                    <div class="content">
                        <ul class="lnk-footers">
                            <li><a href="">سوئیت در تهران</a></li>
                            <li><a href="">سوئیت در اصفهان</a></li>
                            <li><a href="">اسوئیت در شیراز</a></li>
                            <li><a href="">
                                    سوئیت در مشهد</a>
                            </li>


                        </ul>
                        <ul class="lnk-footers">
                            <li><a href="">ویلاهای شمال</a></li>
                            <li><a href="">ویلاهای جنوب</a></li>
                            <li><a href="">ویلاهای اطراف تهران</a></li>


                        </ul>
                    </div>
                </div>
            </div>

        </div>
    </div>
</div>
<div class="container-fluid copy-right">
    <div class="container">
        <div class="row row-copy">
            <div class="col-md-6 col-xs-12 right-copy pr-md-0">
                © 2018 DESIGNED BY <span class="color">NO NEGARE</span> . ALL RIGHTS RESERVED
            </div>
            <div class="col-md-6 col-xs-12 left-copy pl-md-0">
                Copyright ALLORO MILANO . All rights reserved.
            </div>
        </div>
    </div>
</div>

<div class="modal fade modal-service" id="service-modal1" tabindex="-1" role="dialog" aria-labelledby="modalLabel"
     aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal"><span aria-hidden="true">×</span><span
                            class="sr-only">Close</span></button>
                <h4 class="modal-title"> اطلاعات اقامتی</h4>
            </div>
            <div class="modal-body">
                <div class="row">
                    <div class="col-xs-12 text-center">
                        <img src="<?php echo e(asset('frontend/images/img1.png')); ?>" class="img-responsive">

                    </div>
                    <div class="col-xs-12 service-desc">
                        لورم ایپسوم متن ساختگی با تولید سادگی نامفهوم از صنعت چاپ، و با استفاده از طراحان گرافیک است،
                        چاپگرها و متون بلکه روزنامه و مجله در ستون و سطرآنچنان که لازم است، و برای شرایط فعلی تکنولوژی
                        مورد نیاز، و کاربردهای متنوع با هدف بهبود ابزارهای کاربردی می باشد، کتابهای زیادی در شصت و سه
                        درصد گذشته حال و آینده، شناخت فراوان جامعه و متخصصان را می طلبد، تا با نرم افزارها شناخت بیشتری
                        را برای طراحان رایانه ای علی الخصوص طراحان خلاقی، و فرهنگ پیشرو در زبان فارسی ایجاد کرد، در این
                        صورت می توان امید داشت که تمام و دشواری موجود در ارائه راهکارها، و شرایط سخت تایپ به پایان رسد و
                        زمان مورد نیاز شامل حروفچینی دستاوردهای اصلی، و جوابگوی سوالات پیوسته اهل دنیای موجود طراحی
                        اساسا مورد استفاده قرار گیرد.
                    </div>
                </div>

            </div>
        </div>
    </div>
</div>
<div class="modal fade modal-service" id="service-modal2" tabindex="-1" role="dialog" aria-labelledby="modalLabel"
     aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal"><span aria-hidden="true">×</span><span
                            class="sr-only">Close</span></button>
                <h4 class="modal-title"> ضمانت بازگشت وجه</h4>
            </div>
            <div class="modal-body">
                <div class="row">
                    <div class="col-xs-12 text-center">
                        <img src="<?php echo e(asset('frontend/images/img2.png')); ?>" class="img-responsive">

                    </div>
                    <div class="col-xs-12 service-desc">
                        لورم ایپسوم متن ساختگی با تولید سادگی نامفهوم از صنعت چاپ، و با استفاده از طراحان گرافیک است،
                        چاپگرها و متون بلکه روزنامه و مجله در ستون و سطرآنچنان که لازم است، و برای شرایط فعلی تکنولوژی
                        مورد نیاز، و کاربردهای متنوع با هدف بهبود ابزارهای کاربردی می باشد، کتابهای زیادی در شصت و سه
                        درصد گذشته حال و آینده، شناخت فراوان جامعه و متخصصان را می طلبد، تا با نرم افزارها شناخت بیشتری
                        را برای طراحان رایانه ای علی الخصوص طراحان خلاقی، و فرهنگ پیشرو در زبان فارسی ایجاد کرد، در این
                        صورت می توان امید داشت که تمام و دشواری موجود در ارائه راهکارها، و شرایط سخت تایپ به پایان رسد و
                        زمان مورد نیاز شامل حروفچینی دستاوردهای اصلی، و جوابگوی سوالات پیوسته اهل دنیای موجود طراحی
                        اساسا مورد استفاده قرار گیرد.
                    </div>
                </div>

            </div>
        </div>
    </div>
</div>
<div class="modal fade modal-service" id="service-modal3" tabindex="-1" role="dialog" aria-labelledby="modalLabel"
     aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal"><span aria-hidden="true">×</span><span
                            class="sr-only">Close</span></button>
                <h4 class="modal-title"> پشتیبانی در طول اقامت </h4>
            </div>
            <div class="modal-body">
                <div class="row">
                    <div class="col-xs-12 text-center">
                        <img src="<?php echo e(asset('frontend/images/img3.png')); ?>" class="img-responsive">

                    </div>
                    <div class="col-xs-12 service-desc">
                        لورم ایپسوم متن ساختگی با تولید سادگی نامفهوم از صنعت چاپ، و با استفاده از طراحان گرافیک است،
                        چاپگرها و متون بلکه روزنامه و مجله در ستون و سطرآنچنان که لازم است، و برای شرایط فعلی تکنولوژی
                        مورد نیاز، و کاربردهای متنوع با هدف بهبود ابزارهای کاربردی می باشد، کتابهای زیادی در شصت و سه
                        درصد گذشته حال و آینده، شناخت فراوان جامعه و متخصصان را می طلبد، تا با نرم افزارها شناخت بیشتری
                        را برای طراحان رایانه ای علی الخصوص طراحان خلاقی، و فرهنگ پیشرو در زبان فارسی ایجاد کرد، در این
                        صورت می توان امید داشت که تمام و دشواری موجود در ارائه راهکارها، و شرایط سخت تایپ به پایان رسد و
                        زمان مورد نیاز شامل حروفچینی دستاوردهای اصلی، و جوابگوی سوالات پیوسته اهل دنیای موجود طراحی
                        اساسا مورد استفاده قرار گیرد.
                    </div>
                </div>

            </div>
        </div>
    </div>
</div>
<div class="modal fade modal-service" id="service-modal4" tabindex="-1" role="dialog" aria-labelledby="modalLabel"
     aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal"><span aria-hidden="true">×</span><span
                            class="sr-only">Close</span></button>
                <h4 class="modal-title"> پوشش تمامی شهر ها </h4>
            </div>
            <div class="modal-body">
                <div class="row">
                    <div class="col-xs-12 text-center">
                        <img src="<?php echo e(asset('frontend/images/img21.png')); ?>" class="img-responsive">

                    </div>
                    <div class="col-xs-12 service-desc">
                        لورم ایپسوم متن ساختگی با تولید سادگی نامفهوم از صنعت چاپ، و با استفاده از طراحان گرافیک است،
                        چاپگرها و متون بلکه روزنامه و مجله در ستون و سطرآنچنان که لازم است، و برای شرایط فعلی تکنولوژی
                        مورد نیاز، و کاربردهای متنوع با هدف بهبود ابزارهای کاربردی می باشد، کتابهای زیادی در شصت و سه
                        درصد گذشته حال و آینده، شناخت فراوان جامعه و متخصصان را می طلبد، تا با نرم افزارها شناخت بیشتری
                        را برای طراحان رایانه ای علی الخصوص طراحان خلاقی، و فرهنگ پیشرو در زبان فارسی ایجاد کرد، در این
                        صورت می توان امید داشت که تمام و دشواری موجود در ارائه راهکارها، و شرایط سخت تایپ به پایان رسد و
                        زمان مورد نیاز شامل حروفچینی دستاوردهای اصلی، و جوابگوی سوالات پیوسته اهل دنیای موجود طراحی
                        اساسا مورد استفاده قرار گیرد.
                    </div>
                </div>

            </div>
        </div>
    </div>
</div>
<a href="#" class="back-to-top" style=""><i class="fas fa-chevron-up"></i></a>
<script src="<?php echo e(asset('frontend/js/owl.carousel.js')); ?>"></script>
<script src="<?php echo e(asset('frontend/js/bootstrap.min.js')); ?>"></script>
<script src="<?php echo e(asset('frontend/js/persian-datepicker.js')); ?>"></script>
<script src="<?php echo e(asset('frontend/js/persian-date.js')); ?>"></script>
<script language="javascript" src="<?php echo e(asset('frontend/js/script.js')); ?>"></script>

<?php echo $__env->yieldContent('script'); ?>
</body>
</html>