<?php if(session('errors')): ?>

    <div class="alert alert-danger alert-dismissable">

        <a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a>
        <?php echo e($errors->first()); ?>

    </div>
<?php endif; ?>

