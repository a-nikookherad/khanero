<style>
    .sidemenu img {
        width: 40px;
        height: 40px;
        border-radius: 50%;
        display: inline;
        margin-left: 3px;
    }
</style>
<div class="tab-content sidetabs">
    <ul class="sidemenu">
        <li>
            <a href="<?php echo e(route('EditUser')); ?>">
                <?php 
                    if(auth()->user()->avatar != '') {
						$avatar = auth()->user()->avatar;
					} else {
						$avatar = 'default-user.png';
					}
                 ?>
                <span class="name">  پروفایل </span>
            </a>
        </li>
        <li>
            <a target="_blank" href="<?php echo e(route('HomePage')); ?>">
                <span class="name">صفحه اصلی سایت</span>
            </a>
        </li>
        <li>
            <a target="" href="<?php echo e(route('IndexReserve')); ?>">
                <span class="name">سفرهای من</span>
            </a>
        </li>
        <li>
            <a target="" href="<?php echo e(route('IndexHost')); ?>">
                <span class="name">اقامتگاه های من</span>
            </a>
        </li>
        <li>
            <a target="" href="<?php echo e(route('IndexReserveMyHost')); ?>">
                <span class="name">مهمان های من</span>
            </a>
        </li>
        <li>
            <a target="" href="<?php echo e(route('CreateHost')); ?>">
                <span class="name">ثبت اقامتگاه جدید</span>
            </a>
        </li>






        <li>
            <a target="" href="<?php echo e(route('IndexMessage')); ?>">
                <span class="name">پیام ها</span>
            </a>
        </li>
        <li>
            <a target="" href="<?php echo e(route('IndexFavorite')); ?>">
                <span class="name">علاقه مندی ها</span>
            </a>
        </li>
        <li>
            <a target="" href="<?php echo e(route('IndexPayment')); ?>">
                <span class="name">امور مالی</span>
            </a>
        </li>






        <li>
            <a target="" href="<?php echo e(route('Logout')); ?>">
                <span class="name">خروج</span>
            </a>
        </li>
    </ul>
</div>
<?php $__env->startSection('script'); ?>
    <script type="text/javascript">
        var id = <?php echo e(auth()->user()->id); ?>;
        $.ajax({
            url:"<?php echo e(url('message/get/number').'/'); ?>"+id,
            method:"get",
        }).done(function(returnData){
            $('.numberMessageUser').text(returnData);
        });
    </script>
<?php $__env->stopSection(); ?>