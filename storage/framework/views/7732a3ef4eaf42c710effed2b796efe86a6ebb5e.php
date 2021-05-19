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
                <img src="<?php echo e(asset('Uploaded/User/Profile'.'/'.$avatar)); ?>" class="img-responsive" alt="">
                <span class="name">  پروفایل </span>
            </a>
        </li>
        <li>
            <a target="_blank" href="<?php echo e(route('HomePage')); ?>">
                <img src="<?php echo e(asset('frontend/images/logo.png')); ?>" class="img-responsive" />
                <span class="name">صفحه اصلی سایت</span>
            </a>
        </li>
        <li>
            <a target="" href="<?php echo e(route('IndexReserve')); ?>">
                <img src="<?php echo e(asset('frontend/icons/10rentt-chamedan.png')); ?>" class="img-responsive" />
                <span class="name">سفرهای من</span>
            </a>
        </li>
        <li>
            <a target="" href="<?php echo e(route('IndexHost')); ?>">
                <img src="<?php echo e(asset('frontend/icons/10rentt-agahihaye-man.png')); ?>" class="img-responsive" />
                <span class="name">اقامتگاه های من</span>
            </a>
        </li>
        <li>
            <a target="" href="<?php echo e(route('IndexReserveMyHost')); ?>">
                <img src="<?php echo e(asset('frontend/icons/10rentt-mehmanhaye-man.png')); ?>" class="img-responsive" />
                <span class="name">مهمان های من</span>
            </a>
        </li>
        <li>
            <a target="" href="<?php echo e(route('CreateHost')); ?>">
                <img src="<?php echo e(asset('frontend/icons/10rentt-eghamatgahejadid.png')); ?>" class="img-responsive" />
                <span class="name">ثبت اقامتگاه جدید</span>
            </a>
        </li>






        <li>
            <a target="" href="<?php echo e(route('IndexMessage')); ?>">
                <img src="<?php echo e(asset('frontend/icons/10rentt-payamhayeman.png')); ?>" class="img-responsive" />
                <span class="name">پیام ها</span>
            </a>
        </li>
        <li>
            <a target="" href="<?php echo e(route('IndexFavorite')); ?>">
                <img src="<?php echo e(asset('frontend/icons/10rentt-alaghemandihaye-man.png')); ?>" class="img-responsive" />
                <span class="name">علاقه مندی ها</span>
            </a>
        </li>
        <li>
            <a target="" href="<?php echo e(route('IndexPayment')); ?>">
                <img src="<?php echo e(asset('frontend/icons/10rentt-omouremali.png')); ?>" class="img-responsive" />
                <span class="name">امور مالی</span>
            </a>
        </li>
        <li>
            <a target="" href="<?php echo e(route('IndexReagentUser')); ?>">
                <img src="<?php echo e(asset('frontend/icons/702c5998-ac90-4769-aef6-7dcb04df6846.png')); ?>" class="img-responsive" />
                <span class="name">کاربران زیر مجموعه</span>
            </a>
        </li>
        <li>
            <a target="" href="<?php echo e(route('Logout')); ?>">
                <img src="<?php echo e(asset('frontend/icons/10rentt-khoroji.png')); ?>" class="img-responsive" />
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