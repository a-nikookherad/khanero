<?php
$contactInfo = App\Modules\ContactUs\Controllers\ContactUsController::BottomInfo()
?>
<ul>
    <li>
        <a href="<?php echo e($contactInfo->telegram); ?>">
            <span class="flip"><img src="<?php echo e(asset('frontend/images/telegaram.png')); ?>" data-loaded="true"></span>
            <span class="flop"><img src="<?php echo e(asset('frontend/images/telegaram.png')); ?>" data-loaded="true"></span>
        </a>

    </li>
    <li>
        <a href="<?php echo e($contactInfo->instagram); ?>">
            <span class="flip"><img src="<?php echo e(asset('frontend/images/instagram.png')); ?>" data-loaded="true"></span>
            <span class="flop"><img src="<?php echo e(asset('frontend/images/instagram.png')); ?>" data-loaded="true"></span>
        </a>
    </li>
    <li>
        <a href="<?php echo e($contactInfo->aparat); ?>">
            <span class="flip"><img src="<?php echo e(asset('frontend/images/aparat.png')); ?>" data-loaded="true"></span>
            <span class="flop"><img src="<?php echo e(asset('frontend/images/aparat.png')); ?>" data-loaded="true"></span>
        </a>
    </li>
    <li>
        <a href="<?php echo e($contactInfo->whatsapp); ?>">
            <span class="flip"><img src="<?php echo e(asset('frontend/images/whatasapp.png')); ?>" data-loaded="true"></span>
            <span class="flop"><img src="<?php echo e(asset('frontend/images/whatasapp.png')); ?>" data-loaded="true"></span>
        </a>
    </li>
</ul>