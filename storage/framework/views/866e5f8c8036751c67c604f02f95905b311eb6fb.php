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
             پنل کاربری
        </a>
    </span>
    <?php endif; ?>
<?php endif; ?>