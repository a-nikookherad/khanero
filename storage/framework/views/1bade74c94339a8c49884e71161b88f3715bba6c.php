<div class="owl-carousel R-sl owl-theme text-center">
    <?php ($sectionModel = App\Http\Controllers\AppController::SectionHomePage()); ?>
    <div class="item">
        <div class="img-info">
            <img class="m-auto" style="width: 200px" src="<?php echo e(asset('Uploaded'.'/'.$sectionModel->img1)); ?>">
            <div class="desc-info">
                <p><?php echo e($sectionModel->content1); ?></p>
            </div>
        </div>
    </div>
    <div class="item">
        <div class="img-info">
            <img class="m-auto" style="width: 200px" src="<?php echo e(asset('Uploaded'.'/'.$sectionModel->img2)); ?>">
            <div class="desc-info">
                <p><?php echo e($sectionModel->content2); ?></p>
            </div>
        </div>
    </div>
    <div class="item">
        <div class="img-info">
            <img class="m-auto" style="width: 200px" src="<?php echo e(asset('Uploaded'.'/'.$sectionModel->img3)); ?>">
            <div class="desc-info">
                <p><?php echo $sectionModel->content3; ?></p>
            </div>
        </div>
    </div>
</div>

<script>
    //============ Multi-Slider-->
$(document).ready(function() {
	$('.owl-carousel.R-sl').owlCarousel({
		rtl:true,
		loop: true,
		margin: 0, items: 3,
		responsiveClass: true,
		responsive: {
			0: {
				items: 1, margin: 0,
				nav: true
			},
			600: {
				items: 2,  margin: 0,
				nav: false
			},
			1000: {
				items: 3,
				nav: true,
				loop: false,
				margin: 0
			}
		}
	})
})
</script>