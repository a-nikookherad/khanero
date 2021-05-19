<div class="tab-content sidetabs">
    <div class="tab-pane active" id="home">
        <ul class="sidemenu">
            
            <li>
                <a href="<?php echo e(route('AdminDashboard')); ?>">
                    <span class="icon"><i class="fa fa-dashboard"></i></span>
                    <span class="name">داشبورد</span>
                    
                </a>
            </li>
            <li>
                <a target="_blank" href="<?php echo e(route('HomePage')); ?>">
                    <span class="icon"><i class="fa fa-dashboard"></i></span>
                    <span class="name">صفحه اصلی سایت</span>
                </a>
            </li>
            <li>
                <a href="javascript:void(0);">
                    <span class="icon"><i class="fa fa-envelope-o"></i></span>
                    <span class="name">میزبانی ها</span>
                    <span class="arrow"><i class="arrow fa fa-angle-left pull-left"></i></span>
                </a>
                <ul class="sidebar-dropdown">
                    <li class="sidebar-dropdown-title"><p>اقامتگاه ها</p></li>

                    <li><a href="<?php echo e(route('IndexHost', ['type' => 'all'])); ?>">اقامتگاه های ثبت شده</a></li>

                </ul>
            </li>












            <li>
                <a href="javascript:void(0);">
                    <span class="icon"><i class="fa fa-envelope-o"></i></span>
                    <span class="name">مدیریت کاربران</span>
                    <span class="arrow"><i class="arrow fa fa-angle-left pull-left"></i></span>
                </a>
                <ul class="sidebar-dropdown">
                    <li class="sidebar-dropdown-title"><p>مدیریت کاربران</p></li>
                    <li><a href="<?php echo e(route('IndexUser')); ?>">کاربران سایت</a></li>



                </ul>
            </li>

            <li>
                <a href="javascript:void(0);">
                    <span class="icon"><i class="fa fa-chain-broken"></i></span>
                    <span class="name">گزارشات</span>
                    <span class="arrow"><i class="arrow fa fa-angle-left pull-left"></i></span>
                </a>
                <ul class="sidebar-dropdown">
                    <li class="sidebar-dropdown-title"><p>گزارشات</p></li>
                    <li><a href="">واریزی ها</a></li>




                </ul>
            </li>

            <li>
                <a href="javascript:void(0);">
                    <span class="icon"><i class="fa fa-chain-broken"></i></span>
                    <span class="name">مدیریت محتوا</span>
                    <span class="arrow"><i class="arrow fa fa-angle-left pull-left"></i></span>
                </a>
                <ul class="sidebar-dropdown">
                    <li class="sidebar-dropdown-title"><p>مدیریت محتوا</p></li>
                    <li><a href="<?php echo e(route('IndexContent')); ?>">نمایش محتویات</a></li>
                </ul>
            </li>

            <li>
                <a href="javascript:void(0);">
                    <span class="icon"><i class="fa fa-gears"></i></span>
                    <span class="name">تنظیمات</span>
                    <span class="arrow"><i class="arrow fa fa-angle-left pull-left"></i></span>
                </a>
                <ul class="sidebar-dropdown">
                    <li class="sidebar-dropdown-title"><p>تنظیمات</p></li>
                    <li><a href="">مدیریت صفحه اصلی</a></li>
                    <li><a href="">مدیریت اسلاید شهرها</a></li>


                </ul>
            </li>













            <li>
                <a href="javascript:void(0);">
                    <span class="icon"><i class="fa fa-gears"></i></span>
                    <span class="name">امکانات</span>
                    <span class="arrow"><i class="arrow fa fa-angle-left pull-left"></i></span>
                </a>
                <ul class="sidebar-dropdown">
                    <li class="sidebar-dropdown-title"><p>امکانات</p></li>
                    <li><a href="<?php echo e(route('IndexPossibilities')); ?>">مشاهده امکانات</a></li>
                    <li><a href="<?php echo e(route('IndexHomeType')); ?>">نوع خانه</a></li>
                    <li><a href="<?php echo e(route('IndexBuildingType')); ?>">نوع ساختمان</a></li>
                    <li><a href="<?php echo e(route('IndexPositionType')); ?>">موقعیت ساختمان</a></li>

                </ul>
            </li>

            <li>
                <a href="javascript:void(0);">
                    <span class="icon"><i class="fa fa-gears"></i></span>
                    <span class="name">قوانین سایت</span>
                    <span class="arrow"><i class="arrow fa fa-angle-left pull-left"></i></span>
                </a>
                <ul class="sidebar-dropdown">
                    <li class="sidebar-dropdown-title"><p>قوانین سایت</p></li>
                    <li><a href="<?php echo e(route('IndexRule')); ?>">مشاهده قوانین</a></li>
                </ul>
            </li>

            <li>
                <a href="javascript:void(0);">
                    <span class="icon"><i class="fa fa-flag-o"></i></span>
                    <span class="name">مدیریت شهرها</span>
                    <span class="arrow"><i class="arrow fa fa-angle-left pull-left"></i></span>
                </a>
                <ul class="sidebar-dropdown">
                    <li class="sidebar-dropdown-title"><p>مدیریت شهرها</p></li>
                    <li><a href="<?php echo e(route('IndexTownship')); ?>">شهرستان ها</a></li>
                    
                    
                    
                </ul>
            </li>

            <li>
                <a href="javascript:void(0);">
                    <span class="icon"><i class="fa fa-flag-o"></i></span>
                    <span class="name">نظرات و امتیازات</span>
                    <span class="arrow"><i class="arrow fa fa-angle-left pull-left"></i></span>
                </a>
                <ul class="sidebar-dropdown">
                    <li class="sidebar-dropdown-title"><p>نظرات و امتیازات</p></li>
                    <li><a href="<?php echo e(route('IndexRateAndComment')); ?>">مشاهده نظرات و امتیازات</a></li>
                </ul>
            </li>

            <li>
                <a href="javascript:void(0);">
                    <span class="icon"><i class="fa fa-envelope-o"></i></span>
                    <span class="name">خروج</span>
                    <span class="arrow"><i class="arrow fa fa-angle-left pull-left"></i></span>
                </a>
                <ul class="sidebar-dropdown">
                    <li class="sidebar-dropdown-title"><p>خروج</p></li>
                    <li><a href="<?php echo e(route('Logout')); ?>">خروج از سیستم</a></li>

                </ul>
            </li>
        </ul>
    </div>
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