<style>
    .box-host-slide.item img {
        border-top-right-radius: 8px;
        border-top-left-radius: 8px;
    }
    .slick-dots {
        display: none !important;
    }
</style>
<div class="slider main-slide10">
    <?php $__currentLoopData = $integratedModel; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $key => $value): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
        <div class="item box-host-slide" style="margin: 0px 10px;">
            <div class="Box-34">
                <a href="<?php echo e(route('DetailIntegrated', ['id' => $value->id])); ?>" class="thumbnail">
                    <div class="owl-carousel owl-theme owl-slider">
                        <?php $__currentLoopData = $value->getGallery; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $item => $index): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                            <div class="item">
                                <div class="img-product">
                                    <img src="<?php echo e(asset(\App\ImageManager::resize('Uploaded/Gallery/Integrated/File/'.$index->url,['width' => 300, 'height' => 200]))); ?>">
                                </div>
                            </div>
                        <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                    </div>













                </a>
                <div class="row">
                    <div class="box-texts">
                        <h4 class="product-name">
                            <?php echo e($value->title); ?>

                        </h4>
                        <span class="low-price">از <?php echo e(getMinPriceIntegrated($value->id)); ?></span>
                        <p class="short-desc">
                            <i class="fa fa-location-arrow"></i>
                            <?php if($Province = $value->getHost[0]->getProvince): ?>
                                <?php echo e($Province->name); ?>

                            <?php else: ?>
                                -
                            <?php endif; ?>
                            -
                            <?php if($Township = $value->getHost[0]->getTownship): ?>
                                <?php echo e($Township->name); ?>

                            <?php else: ?>
                                -
                            <?php endif; ?>
                            تعداد اقامتگاه : <?php echo e($value->count_host); ?>

                        </p>
                    </div>
                </div>
            </div>

        </div>
    <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>

</div>

<script>
    $('.main-slide10').slick({
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