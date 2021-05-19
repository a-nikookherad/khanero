<?php
$contactInfo = App\Modules\ContactUs\Controllers\ContactUsController::BottomInfo()
?>

<p>
	<img src="<?php echo e(asset('frontend/images/map.png')); ?>" alt="">
	<span><?php echo e($contactInfo->address); ?> </span>
</p>
<p>
	<img src="<?php echo e(asset('frontend/images/tel.png')); ?>" alt="">&nbsp;
	<span><?php echo e($contactInfo->phone); ?></span>
</p>
<p>
	<img src="<?php echo e(asset('frontend/images/email.png')); ?>" alt="">&nbsp;
	<span>
        <a href="mailto:<?php echo e($contactInfo->email); ?>"><?php echo e($contactInfo->email); ?></a>
    </span>
</p>