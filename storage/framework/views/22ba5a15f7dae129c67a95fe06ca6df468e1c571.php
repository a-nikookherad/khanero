<style>
	.owl-city img {
		border-radius: 6px;
	}
</style>
<div class="owl-carousel owl-theme owl-city">
	<?php $__currentLoopData = $slideShowModel; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $key => $value): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
		<item>
		    <div class="Box-11">
		        <a href="<?php if($value->township_id != 0): ?> <?php echo e(route('VisitedCity', ['id' => $value->township_id])); ?> <?php else: ?> <?php echo e($value->link); ?> <?php endif; ?>" target="_blank">
    				<img src="<?php echo e(asset('Uploaded/SlideShow/Img/'.$value->img)); ?>"/>
    				<div class="welcome-popular-cities-desc bx-contect">
    					<div class="name"><?php echo e($value->title); ?></div>
    					
    				</div>
    			</a>
		    </div>
			
		</item>
	<?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
</div>

<script>
    var owl = $('.owl-city');
    owl.owlCarousel({
        loop:true,
        rtl:true,
        dots:false,
        navText: ["<i class='fas fa-angle-left'></i>", "<i class='fas fa-angle-right'></i>"],
        autoplayTimeout: 3000,
        autoplayHoverPause: true,
        responsiveClass:true,

        responsive:{
            0:{
                items:1,
                nav:false
            },

            320:{
                items:2,
                nav:false,
                stagePadding: 30,
                margin:8
            },
            800:{
                items:3,
                nav:false,
                stagePadding: 20,
                margin: 12
            },
            1000:{
                items:5,
                nav:true,
                stagePadding: 30,
                margin: 10
            }
        }
    });
</script>