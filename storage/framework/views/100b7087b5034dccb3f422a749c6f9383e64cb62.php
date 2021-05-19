
<?php $__env->startSection('title'); ?>
	ویلا :: <?php echo e($townshipModel->name); ?>

<?php $__env->stopSection(); ?>
<?php $__env->startSection('style'); ?>
	<style>
		.col-md-4.items img {
			border-top-right-radius: 8px;
			border-top-left-radius: 8px;
		}
		.col-md-4.items {
			box-shadow: 0px 8px 8px 2px #d8d8d82e;
		}
	</style>
<?php $__env->stopSection(); ?>
<?php $__env->startSection('content'); ?>
	<?php echo $__env->make('frontend.Partial.Filter', array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>
	<div class="container-section content-home">
		<h3 class="title-name">
			اجاره ویلا و سوئیت در <?php echo e($townshipModel->name); ?>

		</h3>
		<div class="row">
			<?php $__currentLoopData = $hostModel; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $key => $value): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
				<div class="col-md-3 items">
					<a href="<?php echo e(route('DetailHost', ['id' => $value->id])); ?>" class="thumbnail">
						<div class="owl-carousel owl-theme owl-slider">
							<?php $__currentLoopData = $value->getGallery; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $item => $index): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
								<div class="item">
									<div class="img-product">
										<img src="<?php echo e(asset(\App\ImageManager::resize('Uploaded/Gallery/Img/'.$index->img,['width' => 300, 'height' => 200]))); ?>">
									</div>
								</div>
							<?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
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
						<div class="">
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
                                                <?php $__currentLoopData = $value->getPriceDay; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $index => $item): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
		                                            <?php ($price_array[] = ($item->price)); ?>
	                                            <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
	                                            <?php echo e(min($price_array)); ?>

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
			<?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
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