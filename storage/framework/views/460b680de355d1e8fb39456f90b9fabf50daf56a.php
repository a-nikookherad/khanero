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
            <a>
                <?php if(auth()->user()->avatar == 'default-user.png'): ?>
                    <img class="img-avatar" src="<?php echo e(asset('backend/img/avatar.png')); ?>" alt="avatar">
                <?php else: ?>
                    <img class="img-avatar" src="<?php echo e(asset('Uploaded/User/Profile/'.auth()->user()->avatar)); ?>" alt="avatar">
                <?php endif; ?>
                <span class="full-name"><?php echo e(auth()->user()->first_name . ' ' . auth()->user()->last_name); ?></span>
            </a>
        </li>
        <li>
            <a target="_blank" href="<?php echo e(route('HomePage')); ?>">
                <span class="name">بازگشت به صفحه نخست</span>
            </a>
        </li>
        <li class="li-profile">
            <a href="<?php echo e(route('EditUser')); ?>">
                <?php 
                    if(auth()->user()->avatar != '') {
						$avatar = auth()->user()->avatar;
					} else {
						$avatar = 'default-user.png';
					}
                 ?>
                <span class="name">حساب کاربری</span>
            </a>
        </li>
        <li class="li-reserve">
            <a target="" href="<?php echo e(route('IndexReserve')); ?>">
                <span class="name">لیست رزرو ها</span>
            </a>
        </li>
        <li class="li-message">
            <a target="" href="<?php echo e(route('IndexMessage')); ?>">
                <span class="name">پیام ها</span>
            </a>
        </li>
        <li class="li-favorite">
            <a target="" href="<?php echo e(route('IndexFavorite')); ?>">
                <span class="name">علاقه مندی ها</span>
            </a>
        </li>

        <li class="li-comment">
            <a target="" href="<?php echo e(route('IndexRateAndComment')); ?>">
                <span class="name">نظر ها</span>
            </a>
        </li>

        <li class="li-host">
            <a target="" href="<?php echo e(route('IndexHost', ['type' => 'all'])); ?>">
                <span class="name">اقامتگاه های من</span>
            </a>
        </li>
        <li class="li-create-host">
            <a target="" href="<?php echo e(route('CreateHost')); ?>">
                <span class="name">ثبت اقامتگاه</span>
            </a>
        </li>
        <li class="li-invite">
            <a target="" href="<?php echo e(route('InviteUser')); ?>">
                <span class="name">دعوت از دوستان</span>
            </a>
        </li>
        <li class="li-payment">
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