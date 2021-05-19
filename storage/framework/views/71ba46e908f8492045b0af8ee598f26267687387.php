<!doctype html>
<html lang="en" dir="rtl">
<head><meta http-equiv="Content-Type" content="text/html; charset=utf-8">
    <title><?php echo $__env->yieldContent('title'); ?></title>
    
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="csrf-token" content="<?php echo e(csrf_token()); ?>">
    <link rel="shortcut icon" type="image/x-icon" href="<?php echo e(asset('frontend/images/logo.png')); ?>"/>
    <link rel="stylesheet" type="text/css" href="<?php echo e(asset('frontend/css/bootstrap.min.css')); ?>"/>
    <link rel="stylesheet" type="text/css" href="<?php echo e(asset('frontend/css/bootstrap-rtl.min.css')); ?>"/>
    <link rel="stylesheet" type="text/css" href="<?php echo e(asset('backend/assets/Popup-jQuery/toast.style.min.css')); ?>"/>
    <link rel="stylesheet" type="text/css" href="<?php echo e(asset('frontend/css/fontawesome-all.min.css')); ?>"/>
    
    <link rel="stylesheet" type="text/css" href="<?php echo e(asset('frontend/css/template.css?v=1.0.6')); ?>"/>
    
    <link rel="stylesheet" type="text/css" href="<?php echo e(asset('frontend/css/animate.css')); ?>"/>
    <link rel="stylesheet" type="text/css" href="<?php echo e(asset('frontend/css/owl.carousel.min.css')); ?>"/>
    <link rel="stylesheet" type="text/css" href="<?php echo e(asset('frontend/css/owl.theme.default.min.css')); ?>"/>
    <link rel="stylesheet" type="text/css" href="<?php echo e(asset('frontend/css/uikit-rtl.min.css')); ?>">
    <link rel="stylesheet" type="text/css" href="<?php echo e(asset('frontend/css/slick.css')); ?>">
    <link rel="stylesheet" type="text/css" href="<?php echo e(asset('frontend/css/slick-theme.css')); ?>">
    <link rel="stylesheet" type="text/css" href="<?php echo e(asset('frontend/css/fotorama.css')); ?>">
    <link rel="stylesheet" type="text/css" href="<?php echo e(asset('frontend/css/foundation.css')); ?>">
    <link rel="stylesheet" type="text/css" href="<?php echo e(asset('backend/assets/range-slider/style.css')); ?>">
    <link rel="stylesheet" href="<?php echo e(asset('backend/css/bootstrap-datepicker.min.css')); ?>"/>
    <link rel="stylesheet" href="<?php echo e(asset('backend/assets/rateStar/voteStar.css')); ?>">
    <link rel="stylesheet" href="<?php echo e(asset('backend/css/font-awesome.min.css')); ?>">
    <link rel="shortcut icon" type="image/x-icon" href="docs/images/favicon.ico"/>
    <link rel="stylesheet" href="<?php echo e(asset('frontend/css/leaflet.css')); ?>"
          integrity="sha512-puBpdR0798OZvTTbP4A8Ix/l+A4dHDD0DGqYW6RQ+9jxkRFclaxxQb/SJAWZfWAkuyeQUytO7+7N4QKrDh+drA=="
          crossorigin=""/>
	<link rel="stylesheet" href="<?php echo e(asset('frontend/css/all.css')); ?>" integrity="sha384-50oBUHEmvpQ+1lW4y57PTFmhCaXp0ML5d60M1M7uH2+nqUivzIebhndOJK28anvf" crossorigin="anonymous">
    <link rel="stylesheet" href="<?php echo e(asset('frontend/css/custom2.css')); ?>">
    <link rel="stylesheet" href="<?php echo e(asset('frontend/css/custom-layout.css')); ?>">

    <?php echo $__env->yieldContent('style'); ?>

    <script src="<?php echo e(asset('frontend/js/jquery-3.2.1.min.js')); ?>"></script>
    <script src="<?php echo e(asset('frontend/js/bootstrap.min.js')); ?>"></script>
    <script src="<?php echo e(asset('frontend/js/owl.carousel.min.js')); ?>"></script>
    <script src="<?php echo e(asset('frontend/js/uikit.js')); ?>"></script>
    <script src="<?php echo e(asset('frontend/js/bootstrap-select.min.js')); ?>"></script>
    <script src="<?php echo e(asset('frontend/js/slick.min.js')); ?>"></script>
    <script src="<?php echo e(asset('frontend/js/fotorama.js')); ?>"></script>
    <script src="<?php echo e(asset('frontend/js/foundation.min.js')); ?>"></script>

<script>
    if (matchMedia('only screen and (min-width: 767px)').matches) {
        $(window).scroll(function () {
            var scroll = $(window).scrollTop();
            if (scroll >= 200) {
                $(".header-top").addClass("fixed-mob");
            } else {
                $(".header-top").removeClass("fixed-mob");
            }
        });
    }
</script>

</head>

<body>
<div class="body-loading">
    <img src="<?php echo e(asset('backend/img/img_loading/orange_circles.gif')); ?>"/>
</div>

<div class="header-top">
    <div class="container-section">
        <div class="row">
            <div class="col-sm-6 col-xs-5 r-section">
                <ul>
                    <li><a href="<?php echo e(route('HomePage')); ?>"><img src="<?php echo e(asset('frontend/images/logo-rent-latin.png')); ?>" class="img-responsive logo-latin"></a></li>
                </ul>
            </div>
            <div class="col-sm-6 col-xs-7 gap-col l-section">
                <ul>
                    <li>
                        <a target="_blank" href="<?php echo e(route('CreateHost')); ?>">میزبان شوید</a>
                    </li>
                    <li class="user-bx">
                        <?php if(!auth()->check()): ?>
                            <div class="login">
                                <span>
                                      <a href="<?php echo e(route('Login')); ?>">ورود</a>
                                    </span>
                                <span>/</span>
                                <span>
                                      <a href="<?php echo e(route('Register')); ?>">عضویت</a>
                                    </span>
                                <span><i class="far fa-user"></i></span>
                            </div>
                        <?php else: ?>
                            <div class="btn-group">
                                <button type="button" class="login-item dropdown-toggle" data-toggle="dropdown">

                                    <div class="profile">
                                    <span>
	                                    <?php if(auth()->user()->avatar != '' && auth()->user()->avatar != 'default-user.png'): ?>
                                            <?php  $avatar = auth()->user()->avatar;  ?>
                                        <?php else: ?>
                                            <?php  $avatar = 'default-user.png';  ?>
                                        <?php endif; ?>

                                        <?php if($avatar == 'default-user.png'): ?>
                                            <?php  $av = 'Uploaded/User/'.$avatar;  ?>
                                        <?php else: ?>
                                            <?php  $av = 'Uploaded/User/Profile/'.$avatar  ?>
                                        <?php endif; ?>

                                        <?php if(auth()->user()->role_id == 1): ?>
                                            <a href="#" class="profile-img-menu">
                                                <img src="<?php echo e(asset($av)); ?>"
                                                     class="img-responsive" alt="">
                                            </a>
                                            <a href="<?php echo e(route('AdminDashboard')); ?>"><?php echo e(auth()->user()->first_name); ?></a>
                                        <?php else: ?>
                                            <a href="#" class="profile-img-menu">
                                                <img src="<?php echo e(asset($av)); ?>"
                                                     class="img-responsive" alt="">
                                            </a>
                                            <a href="<?php echo e(route('UserDashboard')); ?>"><?php echo e(auth()->user()->first_name); ?></a>
                                        <?php endif; ?>
                                    </span>
                                    </div>
                                    <span class="caret"></span>
                                </button>
                                <?php if(auth()->user()->role_id == 1): ?>
                                    <ul class="dropdown-menu pull-right text-center" role="menu">
                                        <li><a href="<?php echo e(route('AdminDashboard')); ?>">پروفایل</a></li>
                                        <li><a href="<?php echo e(route('IndexMessage')); ?>">پیام های من</a></li>
                                        <li><a href="<?php echo e(route('IndexHost')); ?>">میزبانی های من</a></li>
                                        <li><a href="<?php echo e(route('IndexFavorite')); ?>">علاقه مندی های من</a></li>
                                        
                                        <li><a href="#">امور مالی</a></li>
                                        <li><a href="<?php echo e(route('Logout')); ?>">خروج</a></li>
                                    </ul>
                                <?php else: ?>
                                    <ul class="dropdown-menu pull-right text-center" role="menu">
                                        <li><a href="<?php echo e(route('UserDashboard')); ?>">پروفایل</a></li>
                                        <li><a href="<?php echo e(route('IndexReserve')); ?>">سفرهای من</a></li>
                                        <li><a href="<?php echo e(route('IndexHost')); ?>">اقامتگاه های من</a></li>
                                        <li><a href="<?php echo e(route('IndexReserveMyHost')); ?>">مهمان های من</a></li>
                                        <li><a href="<?php echo e(route('IndexMessage')); ?>">پیام های من</a></li>
                                        <li><a href="<?php echo e(route('IndexFavorite')); ?>">علاقه مندی های من</a></li>
                                        
                                        <li><a href="#">امور مالی</a></li>
                                        <li><a href="<?php echo e(route('Logout')); ?>">خروج</a></li>
                                    </ul>
                                <?php endif; ?>
                            </div>
                        <?php endif; ?>
                    </li>
                </ul>
            </div>
        </div>
    </div>

</div>


<div id="ExtraContent">
    <?php echo $__env->yieldContent('content'); ?>
</div>

<div class="text-center box-loading-search">
    <img style="" src="<?php echo e(asset('backend/img/img_loading/orange_circles.gif')); ?>"/>
</div>


<!-- Footer -->
<footer class="footer">
    <div class="container-section content">
        <div class="row text-center text-xs-center text-sm-left text-md-left">
            <div class="col-xs-12 col-sm-3 col-md-3">
                <h5>تماس با ما</h5>
                <ul class="list-unstyled quick-links">
                    <?php echo $__env->make('ContactUs::Link.Bottom', array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>
                </ul>
            </div>
            <div class="col-xs-12 col-sm-3 col-md-3">
                <h5>دسترسی ها</h5>
                <ul class="list-unstyled quick-links">
                    <?php echo $__env->make('Content::Link.Top', array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>
                    <li>
                        <a href="<?php echo e(route('ContactInfo')); ?>">تماس با ما</a>
                    </li>
                </ul>
            </div>
            <div class="col-xs-12 col-sm-6 col-md-6">
                <div class="row">
                    <div class="col-md-9">
                        <h5>مجله <span style="color: #a4c5caad;">"</span>رنت<span style="color: #a4c5caad;">"</span>
                        </h5>
                        <ul class="list-unstyled quick-links">
                            <?php echo $__env->make('Content::Link.Magazine', array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>
                        </ul>
                    </div>
                    <div class="col-md-3">
                        <img src="<?php echo e(asset('frontend/images/rentt-fa.png')); ?>" class="img-responsive logo logo-footer">
                    </div>
                </div>
            </div>
        </div>
        <div class="row text-center text-xs-center text-sm-left text-md-left">
            <div class="col-md-6">
                <h5 style="border-right: none;">&nbsp;</h5>
                <div class="row">
                    <div class="col-md-3 col-xs-6 box-namad">



                    </div>
                    <div class="col-md-3 col-xs-6 box-namad">
                        <script src="https://cdn.zarinpal.com/trustlogo/v1/trustlogo.js"
                                type="text/javascript"></script>
                    </div>
                    <div class="col-md-3">

                    </div>
                    <div class="col-md-3">

                    </div>
                </div>
            </div>
            <div class="col-md-6">
                <div class="row">
                    <div class="col-md-12 p-0">
                        <h5>درباره شهر ها</h5>
                        <ul class="list-unstyled quick-links">
                            <?php echo $__env->make('InfoCity::Link.InfoProvince', array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>
                        </ul>
                    </div>
                </div>
            </div>
        </div>
        
        <div class="row">
            <div class="col-xs-12 col-sm-12 col-md-12 mt-2 mt-sm-5">
                <ul class="list-unstyled list-inline social text-center">
                    <li class="list-inline-item"><a href="#"><img src="<?php echo e(asset('frontend/images/sotial/fb.png')); ?>"></a>
                    </li>
                    <li class="list-inline-item"><a href="#"><img
                                    src="<?php echo e(asset('frontend/images/sotial/telegram.png')); ?>"></a></li>
                    <li class="list-inline-item"><a href="#"><img
                                    src="<?php echo e(asset('frontend/images/sotial/instagram.png')); ?>"></a></li>
                    <li class="list-inline-item"><a href="#"><img
                                    src="<?php echo e(asset('frontend/images/sotial/whats-app.png')); ?>"></a></li>
                </ul>
            </div>
        </div>
        <div class="row">
            <div class="col-xs-12 col-sm-12 col-md-12 mt-2 mt-sm-2 text-center text-white">
                <p class="h6">&copy All right Reversed.<a class="text-green ml-2" href="https://www.npco.net"
                                                          target="_blank">npco</a></p>
            </div>
            </hr>
        </div>
    </div>
</footer>
<!-- ./Footer -->


<div class="modal fade" id="myModalCode" role="dialog">
    <div class="modal-dialog">

        <!-- Modal content-->
        <div class="modal-content" style="    margin-top: 60px;">
            <div class="modal-header bg-primary">
                <button type="button" class="close" data-dismiss="modal">&times;</button>
                <h4 class="modal-title" style="color: #efefef;">کد اقامتگاه</h4>
            </div>
            <div class="modal-body">
                <div class="row">
                    <div class="form-group">
                        <div class="col-md-12">
                            <input type="text" class="form-control" id="InputCodeHost"
                                   placeholder="کد اقامتگاه را وارد کنید"/>
                        </div>
                    </div>
                </div>
            </div>
            <div class="modal-footer">
                <div class="col-md-6">
                    <button type="button" class="btn btn-info btn-block" id="BtnSearchInput">جستجو</button>
                </div>
                <div class="col-md-6">
                    <button type="button" id="BtnCloseCode" class="btn btn-default btn-block" data-dismiss="modal">
                        بستن
                    </button>
                </div>
            </div>
        </div>

    </div>
</div>


<script src="<?php echo e(asset('backend/assets/Popup-jQuery/toast.script.js')); ?>"></script>
<script src="<?php echo e(asset('backend/assets/range-slider/script.js')); ?>"></script>
<script type="text/javascript" src="<?php echo e(asset('backend/assets/rateStar/jquery.voteStar.js')); ?>"></script>
<script src="https://unpkg.com/leaflet@1.4.0/dist/leaflet.js"
        integrity="sha512-QVftwZFqvtRNi0ZyCtsznlKSWOStnDORoefr1enyq5mVL4tmKB3S/EnC3rRJcxCPavG10IcrVGSmPh6Qw5lwrg=="
        crossorigin=""></script>

<script>

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


    // $(document).ready(function () {
    //     $('.noUi-handle-lower').mousedown(function () {
    //         $('body').mouseup(function () {
    //             console.log(110011);
    //         });
    //     });
    // });


    $(document).ready(function () {

        $('.btn-favorite').click(function () {
            var id = $(this).attr("data-id");

            $.ajaxSetup({
                headers: {
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                }
            });

            $.ajax({
                url: '<?php echo e(route('SetFavorite')); ?>',
                type: 'post',
                data: {
                    id: id
                },
                success: function (data) {
                    if (data == 'setFavorite') {
                        AlertMessage('علاقه مندی', 'اقامتگاه در علاقه مندی ها ذخیره شد', 'success');
                    } else if (data == 'hasFavorite') {
                        AlertMessage('علاقه مندی', 'اقامتگاه قبلا در علاقه مندی ها ثبت شده است', 'warning');
                    }
                }
            });
        });

        $('.btn-favorite-detail-host').click(function () {
            var id = $(this).attr("data-id");

            $.ajaxSetup({
                headers: {
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                }
            });
            $.ajax({
                url: '<?php echo e(route('SetFavorite')); ?>',
                type: 'post',
                data: {
                    id: id
                },
                success: function (data) {
                    var ok = '<i class="fas fa-heart" style="color: red"></i>';
                    var cancel = '<i class="far fa-heart"></i>';
                    if (data == 'setFavorite') {
                        $('.btn-favorite-detail-host').html(ok);
                        AlertMessage('علاقه مندی', 'اقامتگاه در علاقه مندی ها ذخیره شد', 'success');
                    } else if (data == 'delete') {
                        $('.btn-favorite-detail-host').html(cancel);
                        AlertMessage('علاقه مندی', 'اقامتگاه از لیست علاقه مندی ها حذف شد', 'warning');
                    }
                }
            });
        });
    });
</script>
<script src="<?php echo e(asset('backend/js/bootstrap-datepicker.min.js')); ?>"></script>
<script src="<?php echo e(asset('backend/js/bootstrap-datepicker.fa.min.js')); ?>"></script>
<?php echo $__env->yieldContent('script'); ?>
<script>
    $("#InputDateFromFilter").datepicker({
        minDate: 0,
        changeMonth: true,
        changeYear: true,
        isRTL: true,
        dateFormat: "yy/mm/dd",
        EnableTimePicker: true,
    });
    $("#InputDateToFilter").datepicker({
        minDate: 0,
        changeMonth: true,
        changeYear: true,
        isRTL: true,
        dateFormat: "yy/mm/dd",
        EnableTimePicker: true,
    });

    $('#BtnSearchInput').click(function () {
        var code = $('#InputCodeHost').val();
        $.ajaxSetup({
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            }
        });
        $.ajax({
            url: '<?php echo e(route('SearchHostByCode')); ?>',
            type: 'post',
            data: {
                code: code,
            },
            success: function (data) {
                if (data.Success == 1) {
                    window.location.replace(data.Message);
                }
                else {
                    $.Toast("<p>علاقه مندی</p>", "<p>" + data.Message + " .</p>", "warning", {
                        has_icon: true,
                        has_close_btn: true,
                        stack: true,
                        fullscreen: false,
                        timeout: 4000,
                        sticky: false,
                        has_progress: true,
                        rtl: true,
                    });
                }
            }
        });
    });


    $(window).on('load', function () {
        setTimeout(removeLoader, 500); //wait for page load PLUS two seconds.
    });

    function removeLoader() {
        $(".body-loading").fadeOut(500, function () {
            // fadeOut complete. Remove the loading div
            $(".body-loading").remove(); //makes page more lightweight
        });
    }

</script>
</body>
</html>