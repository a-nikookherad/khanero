<style>
    .box-host-slide.item img {
        border-top-right-radius: 8px;
        border-top-left-radius: 8px;
    }
    .slick-dots {
        display: none !important;
    }
</style>
<div class="slider main-slide1">
    <?php $__currentLoopData = $hostModel; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $key => $value): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
        <div class="item box-host-slide" style="margin: 0px 10px;">
            <div class="Box-34">
                <a href="<?php echo e(route('DetailHost', ['id' => $value->id])); ?>" class="thumbnail">
                <div class="owl-carousel owl-theme owl-slider">
                    <?php if(count($value->getGallery) > 0): ?>
                        <?php $__currentLoopData = $value->getGallery; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $item => $index): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                            <div class="item">
                                <div class="img-product">
                                    <img src="<?php echo e(asset(\App\ImageManager::resize('Uploaded/Gallery/Img/'.$index->img,['width' => 300, 'height' => 200]))); ?>">
                                </div>
                            </div>
                        <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                    <?php else: ?>
                        <div class="item">
                            <div class="img-product">
                                <img src="<?php echo e(asset(\App\ImageManager::resize('frontend/images/logo-rent-latin.png',['width' => 300, 'height' => 200]))); ?>">
                            </div>
                        </div>
                    <?php endif; ?>
                </div>
                <?php if(auth()->check()): ?>
                    <div class="quick-btn">
                        <div class="list btn-favorite" data-id="<?php echo e($value->id); ?>">
                            <p class="list-menu">
                                <button type="button" data-toggle="tooltip" title=""
                                        onclick="wishlist.add('#');"
                                        data-original-title="افزودن به لیست دلخواه">
                                    <i class="fas fa-heart" style="color: #fff;"></i>
                                </button>
                            </p>
                        </div>
                    </div>
                <?php endif; ?>
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
                    <p class="cost-product">
                                            <span>از
                                                <?php $__currentLoopData = $priceModel; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $index => $item): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                                    <?php if($value->id == $item->host_id): ?>
                                                        <?php echo e($item->price); ?>

                                                    <?php endif; ?>
                                                <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                                            </span> تومان
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
            
        </div>
    <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>

</div>

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