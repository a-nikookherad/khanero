<!DOCTYPE>
<html>
<?php  $actual_link = "http://$_SERVER[HTTP_HOST]$_SERVER[REQUEST_URI]";  ?>
<head>
    <meta http-equiv="Content-Type" content="text/html; charset=utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="csrf-token" content="<?php echo e(csrf_token()); ?>">
    <title><?php echo $__env->yieldContent('title'); ?></title>
    <meta name="twitter:image" content="<?php echo e(asset('frontend/images/logo.png')); ?>">
    <meta property="og:type" content="website">
    <meta property="og:image" content="<?php echo e(asset('frontend/images/logo.png')); ?>">
    <meta property="og:site_name" content="">
    <meta property="business:contact_data:locality" content="">
    <meta property="business:contact_data:street_address" content="">
    <meta property="og:url" content="<?php echo e($actual_link); ?>">
<?php echo $__env->yieldContent('meta'); ?>
<!-- Bootstrap -->
    <link href="<?php echo e(asset('frontend/css/bootstrap.min.css')); ?>" rel="stylesheet">
    <link href="<?php echo e(asset('frontend/css/bootstrap.css')); ?>" rel="stylesheet">
    <link href="<?php echo e(asset('frontend/css/bootstrap-theme.css')); ?>" rel="stylesheet">
    <link href="<?php echo e(asset('frontend/css/custom.css')); ?>" rel="stylesheet">
    <link href="<?php echo e(asset('frontend/css/font-awesome.css')); ?>" rel="stylesheet">
    <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.8.1/css/all.css"
          integrity="sha384-50oBUHEmvpQ+1lW4y57PTFmhCaXp0ML5d60M1M7uH2+nqUivzIebhndOJK28anvf" crossorigin="anonymous">
    <link rel="stylesheet" href="<?php echo e(asset('frontend/css/owl.carousel.min.css')); ?>">
    <link rel="stylesheet" href="<?php echo e(asset('frontend/css/owl.theme.default.min.css')); ?>">
    <link rel="stylesheet"
          href="http://babakhani.github.io/PersianWebToolkit/doc/lib/persian-datepicker/dist/css/persian-datepicker.css">
    <?php echo $__env->yieldContent('style'); ?>

    <script src="<?php echo e(asset('frontend/js/jquery.min.js')); ?>"></script>
    <script src="<?php echo e(asset('frontend/js/owl.carousel.js')); ?>"></script>
    <script language="javascript">
        (function ($) {
            $(window).scroll(function () {
                var $heightScrolled = $(window).scrollTop();
                var $defaultHeight = 300;

                if ($heightScrolled < $defaultHeight) {
                    $('.top1').removeClass("fixedLinks-fx")
                } else {
                    $('.top1').addClass("fixedLinks-fx")
                }
            });
        })(jQuery);
    </script>

</head>
<body>

<div class="top">
    <div class="top1">
        <div class="container">
            <div class="row fix-w">
                <div class="col-xs-12 col-sm-12">
                    <div class="phone">
                        <img src="<?php echo e(asset('frontend/images/icon-t1.png')); ?>" alt="logo">
                        <a href=""> 09118116155 </a>

                    </div>

                </div>
                <div class="col-xs-12 col-sm-12 ">
                    <div class="sabt">
                        <img src="<?php echo e(asset('frontend/images/icon-t2.png')); ?>" alt="logo">
                        <a href=""> ثبت اقامتگاه </a>
                    </div>
                    <div class="box-login">
                        <i class="fa fa-user"></i>
                        <?php if(!auth()->check()): ?>
                            <a href="<?php echo e(route('Login')); ?>">
                                <span> ورود </span>
                            </a>
                            <span class="line-login">
                                    </span>
                            <a href="<?php echo e(route('Register')); ?>">
                                <span> عضویت  </span>
                            </a>
                        <?php else: ?>
                            <?php if(auth()->user()->role_id == 1): ?>
                                <a href="<?php echo e(route('AdminDashboard')); ?>">
                                    <span> پنل مدیریتی </span>
                                </a>
                            <?php else: ?>
                                <a href="<?php echo e(route('UserDashboard')); ?>">
                                    <span> پنل کاربری </span>
                                </a>
                            <?php endif; ?>
                        <?php endif; ?>
                    </div>
                </div>

            </div>
            <div class="box-search fix-se">
                <div id="logo"><img src="<?php echo e(asset('frontend/images/logo.png')); ?>" alt="logo"></div>
                <span class="btn"> <i class="fas fa-search"></i></span>
                <div id="search" class="search">
                    <form class="search" action="/action_page.php">
                        <input class="input-search" type="text" placeholder=" مقصد" name="search2">
                        <div class="date">

                            <input class="input-date1 datepersian" type="" placeholder=" تاریخ ورود" name="">

                            <input class="input-date2 datepersian" type="" placeholder=" تاریخ خروج" name="">

                            <div class="number">
                                <span class="minus">-</span>
                                <input type="text" value="1" placeholder="تعداد نفرات">
                                <span class="text-number"> مسافر</span>
                                <span class="plus">+</span>
                            </div>


                            <!--                                      <div class="dropdown">
                                                                    <button class="btn-dropdown1 dropdown-toggle" type="button" data-toggle="dropdown">
                            تاریخ خروج
                                                                <span class="caret"></span></button>
                                                                    <ul class="dropdown-menu">
                                                                      <li><a href="#">دسته بندی 1</a></li>
                                                                      <li><a href="#">دسته بندی 2</a></li>
                                                                      <li><a href="#">دسته بندی 3</a></li>
                                                                    </ul>
                                                                  </div> -->
                        </div>


                        <button class="btn-search" type="submit">جستجو</button>
                    </form>
                </div>
                <script>
                    $(document).ready(function () {
                        $(".btn").click(function () {
                            $("#search").toggleClass("open");
                        });
                    });
                </script>


            </div>


        </div>


    </div>
    <?php echo $__env->yieldContent('slide'); ?>
</div>

<?php echo $__env->yieldContent('content'); ?>

<script>
    $(document).ready(function () {
        $('body').append('<div id="scrollTop" class="btn btn-success"><div class="circle"><div class="wave"><i class="fas fa-angle-double-up"></i><span class="glyphicon glyphicon glyphicon-arrow-up"></span></div></div></div>');
        $(window).scroll(function () {
            if ($(this).scrollTop() != 0) {
                $('#scrollTop').fadeIn();
            } else {
                $('#scrollTop').fadeOut();
            }
        });

        $('#scrollTop').on('click', function (e) {
            e.preventDefault();
            $('html, body').animate({scrollTop: 0}, '3000');
        });
    });

</script>

<div class="footer">
    <div class="btn-top">
        <div id="scrollTop" class="" style="display: block;">
            <div class="circle">
                <div class="wave"><i class="fas fa-angle-double-up"></i>
                </div>
            </div>
        </div>
    </div>

    <div class="container ">
        <div class="row">
            <div class="col-xs-12 col-sm-6 col-md-3 footer0">
                <img src="<?php echo e(asset('frontend/images/logo-f.png')); ?>" alt="logo" class="img-footer">
                <p>
                    ها تجربه در این زمینه فعالیت خود را در حوزه تولید و واردات تجهیزات شمس تجهیز در زمینه تولید، واردات
                    ، مشاوره ، طراحی و صنعت تجهیزات آشپزخانه های تحولی شگرف بوجود آورده است


                </p>

            </div>
            <div class="col-xs-12 col-sm-6 col-md-3">
                <ul class="footer-ul footer4">
                    <li>
                        <a href="">
                            درباره ما
                        </a>
                    </li>
                    <li>
                        <a href="">
                            قوانین
                        </a>
                    </li>
                    <li>
                        <a href="">
                            میزبان
                        </a>
                    </li>
                    <li>
                        <a href="">
                            مجله
                        </a>
                    </li>

                </ul>


                <ul class="footer-ul footer4">
                    <li>
                        <a href="">
                            ثبت شکایت
                        </a>
                    </li>
                    <li>
                        <a href="">
                            همکاری با ما
                        </a>
                    </li>
                    <li>
                        <a href="">
                            تماس با ما </a>
                    </li>
                    <li>
                        <a href="">
                            تماس با ما
                        </a>
                    </li>

                </ul>

            </div>


            <div class="col-xs-12 col-sm-6 col-md-3">
                <div class="footer1">
                    <i class="col-xs-2 fa fa-phone"></i>
                    <div class="col-xs-10"><a href="">
                            <span>۰۲۱ ۹۱۳۰۰۶۶۵ </span>
                        </a></div>
                </div>
                <div class="footer3">
                    <i class="col-xs-2 far fa-envelope-open"></i>
                    <div class="col-xs-10">
                        <p>
                            <span>info@example.com  </span>
                        </p>
                    </div>
                </div>
                <ul class="footer5">
                    <li><a href=""> <i class="fab fa-instagram"></i></a></li>
                    <li><a href=""> <i class="fab fa-linkedin"></i></a></li>
                    <li><a href=""> <i class="fab fa-whatsapp"></i></a></li>
                    <li><a href=""><i class="fab fa-facebook-f"></i> </a></li>
                    <li><a href=""> <i class="fab fa-twitter"></i></a></li>

                </ul>


            </div>


            <div class="col-xs-12 col-sm-6 col-md-3">
                <div>
                    <h3>
                        عضویت در خبرنامه
                    </h3>

                    <form action="/action_page.php" class="newsletter">
                        <input type="text" placeholder=" پست الکترونیک" name="mail" required>
                        <input type="submit" value="عضویت">
                    </form>


                </div>
                <div class="footer5">
                    <p><img src="<?php echo e(asset('frontend/images/namad1.png')); ?>" alt="logo"></p>
                    <p><img src="<?php echo e(asset('frontend/images/namad2.png')); ?>" alt="logo"></p>
                </div>
            </div>


        </div>


    </div>
</div>

<script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.0/js/bootstrap.min.js"></script>

<script>
    $(document).ready(function () {
        $('.demos').owlCarousel({
            loop: true,
            margin: 5,
            nav: true,
            navText: ["<i class='fa fa-angle-right'></i>", "<i class='fa fa-angle-left'></i>"],
            responsiveClass: true,
            responsive: {
                0: {
                    items: 1,
                    nav: true
                },
                700: {
                    items: 2,
                    nav: false
                },
                1000: {
                    items: 4,
                    nav: true,
                    loop: true,
                    margin: 10
                }
            }
        })
    })


    $(document).ready(function () {
        $('.demos2').owlCarousel({
            loop: true,
            margin: 5,
            nav: true,
            navText: ["<i class='fa fa-angle-right'></i>", "<i class='fa fa-angle-left'></i>"],
            responsiveClass: true,
            responsive: {
                0: {
                    items: 1,
                    nav: true
                },
                700: {
                    items: 2,
                    nav: false
                },
                1000: {
                    items: 5,
                    nav: true,
                    loop: true,
                    margin: 10
                }
            }
        })
    })


</script>
<script>
    $(document).ready(function () {
        $(".navbar-toggle ").click(function () {
            $("#myNavbar ").fadeToggle(4000);
        });
    });
</script>
<script src="http://babakhani.github.io/PersianWebToolkit/doc/lib/persian-datepicker/dist/js/persian-datepicker.js"></script>
<script src="http://babakhani.github.io/PersianWebToolkit/doc/lib/persian-date/dist/persian-date.js"></script>
<script>
    $('.input-date1').persianDatepicker({
        initialValue: false
    });
    $('.input-date2').persianDatepicker({
        initialValue: false
    });
</script>
</body>
</html>