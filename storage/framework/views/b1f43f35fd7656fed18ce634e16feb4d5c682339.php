<?php if(auth()->check()): ?>
    <?php if(auth()->user()->role_id == 1): ?>
        <span>
        <a href="<?php echo e(route('AdminDashboard')); ?>">
             پنل مدیریتی
        </a>
    </span>
    <?php else: ?>
        <span>
        <a class="menu-user">
          <?php echo e(auth()->user()->first_name . ' ' . auth()->user()->last_name); ?>

        </a>
    </span>
    <?php endif; ?>
<?php endif; ?>