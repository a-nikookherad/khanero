<?php if(session('Errors')): ?>

    <div class="alert alert-<?php echo e(session('AlertType')); ?> alert-dismissable">

        <a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a>
        <?php echo e(session('Errors')); ?>

    </div>
<?php endif; ?>
