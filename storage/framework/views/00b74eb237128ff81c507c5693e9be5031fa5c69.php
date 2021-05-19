
<!DOCTYPE html>
<html lang="fa">
    <head><meta http-equiv="Content-Type" content="text/html; charset=utf-8">
    
    <!--<meta http-equiv="X-UA-Compatible" content="IE=edge">-->
    <title><?php echo $__env->yieldContent('title'); ?></title>
    <meta name="description" content="Flatter - Flat Admin Theme">
    <meta name="viewport" content="width=device-width, user-scalable=no, initial-scale=1.0">
    <meta name="csrf-token" content="<?php echo e(csrf_token()); ?>">
    <link rel="apple-touch-icon-precomposed" sizes="144x144" href="image/touch/apple-touch-icon-144x144-precomposed.png">
    <link rel="apple-touch-icon-precomposed" sizes="114x114" href="image/touch/apple-touch-icon-114x114-precomposed.png">
    <link rel="apple-touch-icon-precomposed" sizes="72x72" href="image/touch/apple-touch-icon-72x72-precomposed.png">
    <link rel="apple-touch-icon-precomposed" href="image/touch/apple-touch-icon-57x57-precomposed.png">
    <link rel="shortcut icon" href="image/touch/apple-touch-icon.png">
    <link rel="stylesheet" href="<?php echo e(asset('backend/css/bootstrap.min.css')); ?>">
        <link rel="stylesheet" href="<?php echo e(asset('frontend/css/owl.carousel.min.css')); ?>">
    <link rel="stylesheet" href="<?php echo e(asset('frontend/css/owl.theme.default.css')); ?>">
    <link rel="stylesheet" href="<?php echo e(asset('backend/css/c3.css')); ?>">
    <link rel="stylesheet" href="<?php echo e(asset('backend/css/switchery.min.css')); ?>">
    <link rel="stylesheet" href="<?php echo e(asset('backend/css/weather-icons.min.css')); ?>">
    <link rel="stylesheet" href="<?php echo e(asset('backend/css/calendar.css')); ?>">
    <link rel="stylesheet" href="<?php echo e(asset('backend/css/offline-theme-dark.css')); ?>">
    <link rel="stylesheet" href="<?php echo e(asset('backend/css/bootstrap-override.css')); ?>">
    <link rel="stylesheet" type="text/css" href="<?php echo e(asset('backend/assets/Popup-jQuery/toast.style.min.css')); ?>"/>
    <link rel="stylesheet" href="<?php echo e(asset('backend/css/font-awesome.min.css')); ?>">
    <link rel="stylesheet" href="<?php echo e(asset('backend/css/layout.css')); ?>">
    
    <link rel="stylesheet" href="<?php echo e(asset('backend/css/library.css')); ?>">
    <link rel="stylesheet" href="<?php echo e(asset('backend/css/style.css?v=1.0.3')); ?>">
    <link rel="stylesheet" href="<?php echo e(asset('backend/css/custom.css')); ?>">
    <link rel="stylesheet" href="<?php echo e(asset('backend/assets/progress/css/progress.css')); ?>">
    <link rel="stylesheet" href="<?php echo e(asset('backend/assets/rateStar/voteStar.css')); ?>">
    <link rel="shortcut icon" type="image/x-icon" href="<?php echo e(asset('frontend/images/logo.png')); ?>" />

    <?php echo $__env->yieldContent('style'); ?>

    <style>
    html,body {
	font-family: 'iranyekanwebregular11' !important;
}
        .BtnRegAll {
            transition: 0.2s;
        }
        .BtnRegAll:hover {
            border-color: #3ba0ff;
            box-shadow: 0 0 7px 0px #3ba0ffb5;
            transition: 0.2s;
        }
        .fa, .far, .fas {
            font-family: FontAwesome !important;
        }
        .sidetabs img {
            width: 30px;
            height: 30px;
            border-radius: 50%;
            display: inline;
        }
        table {
            font-size: 13px;
        }
        table tr td {
            cursor: unset!important;
        }
    .sidebar .sidemenu li {
        padding: 5px 0px;
    }
    </style>
    <script type="text/javascript" src="<?php echo e(asset('backend/js/jquery-1.11.0.min.js')); ?>"></script>
    <script type="text/javascript" src="<?php echo e(asset('backend/js/jquery-ui-1.10.4.custom.min.js')); ?>"></script>
    
</head>
<body id="body">
    <!-- Header -->
<header class="navbar main-header">
    <a class="navbar-brand" href="<?php echo e(route('HomePage')); ?>" target="" style="">
        <img src="<?php echo e(asset('frontend/images/LOGO0.png')); ?>" style="width: 75px;" />

    </a>
    <ul class="nav navbar-nav navbar-right sidebar-toggle-ul">

        <li class="navbar-main hidden-lg hidden-md">
            <a href="javascript:void(0);" id="sidebar-toggle">
                <span class="meta">
                    <span class="icon"><i class="fa fa-bars"></i></span>
                </span>
            </a>
        </li>

        <li class="navbar-main">
            <a href="javascript:void(0);">
                <?php if(auth()->user()->role_id == 1): ?>
                    مدیریت سایت
                <?php elseif(auth()->user()->role_id == 2): ?>
                    <?php echo e(auth()->user()->first_name); ?> (کاربر عادی)
                <?php endif; ?>

            </a>
        </li>


        <li class="navbar-main hidden-sm hidden-xs">
            <a href="javascript:void(0);" id="sidebar-collapse">
                <span class="meta">
                    <span class="icon"><i class="fa fa-outdent"></i></span>
                </span>
            </a>
        </li>


    </ul>
    <ul class="nav navbar-nav navbar-right">


        
        
        
        
        
        
        
        
        
    </ul>
    <ul class="nav navbar-nav navbar-left">
        <li class="dropdown">
            <a href="#" class="dropdown-toggle" data-toggle="dropdown"><?php echo e(auth()->user()->name); ?> <img class="img-circle" src="<?php if(auth()->user()->avatar == 'default-user.png'): ?> <?php echo e(asset('backend/img/avatar.png')); ?> <?php else: ?> <?php echo e(asset('Uploaded/User/Profile/'.auth()->user()->avatar)); ?> <?php endif; ?>" alt="avatar" /> <b class="caret"></b></a>
            <ul class="dropdown-menu">
                
                <li><a href="<?php echo e(route('EditUser')); ?>"><i class="fa fa-user"></i> پروفایل</a></li>
                
                <li><a href="<?php echo e(route('Logout')); ?>"><i class="fa fa-share"></i> خروج</a></li>
            </ul>
        </li>
    </ul>
</header>
    
<div class="sidebar sidebar-left">
    <div class="content">





















        <?php if(auth()->check()): ?>
            <?php if(auth()->user()->role_id == 1): ?>
                <?php echo $__env->make('Panel::SideBar.Admin', array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>
            <?php elseif(auth()->user()->role_id == 2): ?>
                <?php echo $__env->make('Panel::SideBar.User', array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>
            <?php endif; ?>
        <?php endif; ?>

    </div>
</div>
<!-- Header -->
<section id="main-wrapper">

    <h4><?php echo $__env->yieldContent('headerSection'); ?></h4>
        <?php echo $__env->yieldContent('content'); ?>

</section>

<script src="<?php echo e(asset('backend/assets/Popup-jQuery/toast.script.js')); ?>"></script>
<script type="text/javascript" src="<?php echo e(asset('backend/js/bootstrap.min.js')); ?>"></script>
<script type="text/javascript" src="<?php echo e(asset('backend/js/jquery.easypiechart.min.js')); ?>"></script>
<script src="<?php echo e(asset('frontend/js/owl.carousel.js')); ?>"></script>
<script type="text/javascript" src="<?php echo e(asset('backend/js/d3.min.js')); ?>" charset="utf-8"></script>
<script type="text/javascript" src="<?php echo e(asset('backend/js/c3.min.js')); ?>"></script>
<script type="text/javascript" src="<?php echo e(asset('backend/js/switchery.min.js')); ?>"></script>
<script type="text/javascript" src="<?php echo e(asset('backend/js/jquery.mCustomScrollbar.concat.min.js')); ?>"></script>
<script type="text/javascript" src="<?php echo e(asset('backend/js/jquery.easing.1.3.js')); ?>"></script>
<script type="text/javascript" src="<?php echo e(asset('backend/js/jquery.calendario.js')); ?>"></script>
<script type="text/javascript" src="<?php echo e(asset('backend/js/offline.min.js')); ?>"></script>
<script type="text/javascript" src="<?php echo e(asset('backend/js/script.js')); ?>"></script>
<script type="text/javascript" src="<?php echo e(asset('backend/js/dashboard.js')); ?>"></script>
<script type="text/javascript" src="<?php echo e(asset('backend/assets/rateStar/jquery.voteStar.js')); ?>"></script>
    <script type="text/javascript" src="<?php echo e(asset('backend/js/number.js')); ?>"></script>
<?php echo $__env->yieldContent('script'); ?>
<script>
    function AlertToast(title, message, status = 'success') {
        $.Toast("<p>"+ title +"</p>", "<p>" + message + " .</p>", status, {
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
</script>
</body>
</html>