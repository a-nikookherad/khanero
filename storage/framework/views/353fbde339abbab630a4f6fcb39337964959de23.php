<?php
    $contactInfo = App\Modules\ContactUs\Controllers\ContactUsController::BottomInfo();
    $contentModel = App\Modules\Content\Controllers\ContentController::BottomLink();
    $contentModel_2 = App\Modules\Content\Controllers\ContentController::BottomLink_2();
?>
<div class="row">
    <div class="col-xs-12 col-sm-12 col-md-4 footer0 pr-md-0 px-0">
        <div class="row">
            <div class="col-lg-10 pr-md-0 px-0">
                <div class="d-block logo-footer">
                    <img src="<?php echo e(asset('frontend/images/logo-f.png')); ?>" alt="logo" class="img-footer">
                </div>
                <div class="d-block about-company">
                    <?php echo e($contactInfo->about); ?>

                </div>
            </div>
        </div>
    </div>

    <div class="col-lg-4 col-md-4 col-sm-6 px-0 pupiular-service accordion-container">
        <div class="set">
        			<span class="service-icon">
						 <span class="title-footer lnk-footer un-link"><span> ارتباط با ما</span></span>

						 <i class="fa-chevron-down fas fa-chevron-up" aria-hidden="false"></i>
					</span>
            <div class="content">
                <?php $__currentLoopData = $contentModel->chunk(4); $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $key => $value): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                    <ul class="lnk-footers">
                        <?php $__currentLoopData = $value; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $index => $item): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                            <li><a href="<?php echo e(route('PageContent', ['alias' => $item->alias])); ?>"><?php echo e($item->title); ?></a></li>
                        <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                    </ul>
                <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>

            </div>
        </div>
    </div>

    <div class="col-lg-4 col-md-4 col-sm-6 px-0 pupiular-service accordion-container">
        <div class="set">
        			<span class="service-icon">
						 <span class="title-footer lnk-footer un-link"><span> دسترسی سریع</span></span>

						 <i class="fa-chevron-down fas fa-chevron-up" aria-hidden="false"></i>
				     </span>
            <div class="content">
                <?php $__currentLoopData = $contentModel_2->chunk(4); $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $key => $value): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                    <ul class="lnk-footers">
                        <?php $__currentLoopData = $value; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $index => $item): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                            <li><a href="<?php echo e(route('PageContent', ['alias' => $item->alias])); ?>"><?php echo e($item->title); ?></a></li>
                        <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                    </ul>
                <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
            </div>
        </div>
    </div>

</div>