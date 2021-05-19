
<?php $__env->startSection('title',TitlePage($integratedModel->title)); ?>
<?php $__env->startSection('style'); ?><?php echo e($integratedModel->title); ?>

<link rel="stylesheet" href="<?php echo e(asset('backend/css/bootstrap-datepicker.min.css')); ?>"/>
<link rel="stylesheet" href="<?php echo e(asset('frontend/css/style-detail.css')); ?>"/>
<style>
    .display-block {
        display: none;
        position: absolute;
        width: 100%;
        height: 100%;
        background: #f9fff86b;
        top: 0;
        left: 0;
        z-index: 9999999;
    }

    span.tooltip-span {
        padding: 5px;
        color: #fe5512;
        cursor: pointer;
        border: 1px solid #fe5f11;
        width: 20px;
        height: 20px;
        display: inline-block;
        line-height: 12px;
        text-align: center;
        border-radius: 50%;
        margin: 0px 5px;
    }

    .tooltip {
        font-family: Yekan !important;
    }

    .box-calendar {
        display: block;
    }



    .box-time {
        display: inline-block;
        padding: 10px;
        border: 4px solid #f5987b;
        border-radius: 5px;
    }
    .input-date-reserve {
        opacity: 1;
        border: none;
        box-shadow: none;
        background-color: #fff!important;
    }

    .box-count-guest .btn-add,
    .box-count-guest .btn-sub {
        width: 25%;
        height: 100%;
        font-size: 14px;
        padding: 5px;
        background: #fff7f3;
        color: #808080;
    }

    .box-count-guest .number input {
        width: 15px;
    }

    .box-count-guest .number {
        text-align: center;
        width: 50%;
        font-size: 15px;
        display: inline-block;
        padding: 5px;
        pointer-events: none;
    }

    .box-count-guest .btn-add {
        float: right;
        border-top-right-radius: 10px;
        border-bottom-right-radius: 10px;
        border-left: 1px solid #fe884a;
    }

    .box-count-guest .btn-sub {
        float: left;
        border-top-left-radius: 10px;
        border-bottom-left-radius: 10px;
        border-right: 1px solid #fe884a;
    }
    div#ExtraContent {
        margin-top: 75px;
    }


    .box-medal img.medal {
        width: 25px;
        height: 30px;
        border-radius: 50%;
        box-shadow: none;
        position: absolute;
        left: 10px;
        top: -26px;
    }
    .box-medal {
        position: relative;
    }
    .item-2 img{
        width: 100%;
        height: auto;
    }
    .box-margin-top {
        margin-bottom: 30px !important;
    }
    .box-user img {
        width: 50px;
        border-radius: 50%;
    }
</style>
<?php $__env->stopSection(); ?>

<?php $__env->startSection('content'); ?>

    <div class="content-home">
        <div class="row">

            <div class="container">
                <div class="row box-margin-top">
                    <div class="col-md-4">
                        <div id="myCarousel" class="carousel slide" data-ride="carousel">
                            <!-- Indicators -->
                            <ol class="carousel-indicators">
                                <?php $__currentLoopData = $integratedModel->getGallery; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $key => $value): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                    <li data-target="#myCarousel" data-slide-to="<?php echo e($key); ?>" class="<?php if($key == 0): ?> active <?php endif; ?>"></li>
                                <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                            </ol>

                            <!-- Wrapper for slides -->
                            <div class="carousel-inner">
                                <?php $__currentLoopData = $integratedModel->getGallery; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $key => $value): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                    <div class="item <?php if($key == 0): ?> active <?php endif; ?>">
                                        <img src="<?php echo e(asset('Uploaded/Gallery/Integrated/File/'.$value->url)); ?>" alt="Los Angeles" style="width:100%;">
                                    </div>
                                <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                            </div>

                            <!-- Left and right controls -->
                            <a class="left carousel-control" href="#myCarousel" data-slide="prev">
                                <span class="glyphicon glyphicon-chevron-left"></span>
                                <span class="sr-only">Previous</span>
                            </a>
                            <a class="right carousel-control" href="#myCarousel" data-slide="next">
                                <span class="glyphicon glyphicon-chevron-right"></span>
                                <span class="sr-only">Next</span>
                            </a>
                        </div>
                    </div>
                    <div class="col-md-8">
                        <div class="box-user">
                            <?php 
                                if($integratedModel->getUser->avatar != '') {
                                    $avatar = $integratedModel->getUser->avatar;
                                } else {
                                    $avatar = 'default-user.png';
                                }
                             ?>
                            <img src="<?php echo e(asset('Uploaded/User/Profile/'.$avatar)); ?>">
                            <span class="name-user">
                                <?php echo e($integratedModel->getUser->first_name); ?>

                            </span>
                        </div>
                        <h4><?php echo e($integratedModel->title); ?></h4>
                        <p>
                            <?php echo e($integratedModel->description); ?>

                        </p>
                    </div>
                </div>
                <hr />
                <div class="row">
                    <?php $__currentLoopData = $integratedModel->getHost; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $key => $value): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                        <div class="col-md-3 box-margin-top">
                            <a href="<?php echo e(route('DetailHost', ['id' => $value->id])); ?>" class="thumbnail">
                                <div class="">
                                    <?php if(count($value->getGallery) > 0): ?>
                                        <div class="item item-2">
                                            <div class="img-product">
                                                <img src="<?php echo e(asset(\App\ImageManager::resize('Uploaded/Gallery/Img/'.$value->getGallery[0]->img,['width' => 300, 'height' => 200]))); ?>">
                                            </div>
                                        </div>
                                    <?php else: ?>
                                        <div class="item item-2">
                                            <div class="img-product">
                                                <img src="<?php echo e(asset(\App\ImageManager::resize('frontend/images/logo-rent-latin.png',['width' => 300, 'height' => 200]))); ?>">
                                            </div>
                                        </div>
                                    <?php endif; ?>
                                </div>
                            </a>
                            <div class="row">
                                <div class="box-texts">
                                    <h4 class="product-name">
                                        <?php echo e($value->name); ?>

                                    </h4>
                                    <p class="short-desc">
                                        <i class="fa fa-location-arrow"></i>
                                        <?php if($Province = $value->getProvince): ?>
                                            <?php echo e($Province->name); ?>

                                        <?php else: ?>
                                            -
                                        <?php endif; ?>
                                        -
                                        <?php if($Township = $value->getTownship): ?>
                                            <?php echo e($Township->name); ?>

                                        <?php else: ?>
                                            -
                                        <?php endif; ?>
                                        -
                                        <?php echo e($value->district); ?>

                                    </p>
                                    <p class="rate">
                                        <?php if(count($value->getRate) > 0): ?>
                                            <?php 
                                                $total = 0;
                                                $count = count($value->getRate);
                                             ?>
                                            <?php $__currentLoopData = $value->getRate; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $index => $item): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                                <?php  $total = $total+$item->rate;  ?>
                                            <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                                            <?php ($width = ($total/$count)*30); ?>
                                            <span class="event_star star_small" data-starnum="2">
                                                   <i></i>
                                                </span>
                                        <?php else: ?>
                                            <span class="event_star star_small" data-starnum="2">
                                                   <i></i>
                                                </span>
                                        <?php endif; ?>
                                    </p>
                                </div>
                            </div>
                        </div>
                    <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                </div>
                </div>
            </div>




























































<?php $__env->stopSection(); ?>

<?php $__env->startSection('script'); ?>


<script>
    $('.main-slide1').slick({
        rtl: true,
        margin: 10,
        dots: true,
        infinite: false,
        speed: 300,
        slidesToShow: 4,
        slidesToScroll: 2,
        loop: false,
        autoplay: false,
        autoplayTimeout: 3000,
        prevArrow: '<div class="slick-prev"><</div>',
        nextArrow: '<div class="slick-next">></div>',
        responsive: [
            {
                breakpoint: 1024,
                settings: {
                    slidesToShow: 3,
                    slidesToScroll: 3,
                    infinite: true,
                    dots: true
                }
            },
            {
                breakpoint: 600,
                settings: {
                    slidesToShow: 2,
                    slidesToScroll: 2
                }
            },
            {
                breakpoint: 480,
                settings: {
                    slidesToShow: 1,
                    slidesToScroll: 1
                }
            }

        ]
    });
</script>

<?php $__env->stopSection(); ?>
<?php echo $__env->make('frontend.MasterPage.Layout', array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>