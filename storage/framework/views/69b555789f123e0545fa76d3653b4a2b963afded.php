<?php
$contentModel = App\Modules\Content\Controllers\ContentController::TopLink()
?>
<?php $__currentLoopData = $contentModel; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $key => $value): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
    <li class="sub-menu-parent" tab-index="0">
        <a href="<?php echo e(route('PageContent', ['alias' => $value->alias])); ?>"><?php echo e($value->title); ?></a>
    </li>
<?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>

