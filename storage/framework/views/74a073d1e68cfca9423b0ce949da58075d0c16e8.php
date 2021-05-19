<?php
$contentModel = App\Modules\Content\Controllers\ContentController::Magazine()
?>
<style>
    .magazine span {
        color: #a4c5caad;
    }
</style>

<?php $__currentLoopData = $contentModel; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $key => $value): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
    <li class="magazine">
        <a href="<?php echo e(route('PageContent', ['alias' => $value->alias])); ?>"> <span>#</span> <?php echo e($value->title); ?></a>
    </li>
<?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>

