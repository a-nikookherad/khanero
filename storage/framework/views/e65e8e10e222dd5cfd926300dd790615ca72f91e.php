
<style>
    .panel-heading.text-right img {
        position: absolute;
        width: 40px;
        float: left;
        left: 25px;
        top: 0px;
    }
</style>

<div class="row">
    <div class="col-md-6 col-md-offset-3">
        <div class="panel panel-default">
            <div class="panel-heading text-right">
                <h3 class="panel-title">ورود اعضا</h3>
                <img src="<?php echo e(asset('frontend/images/logo.png')); ?>" />
            </div>
            <div class="panel-body">

        <form action="<?php echo e(route('Login')); ?>" method="post" role="form">
            <?php echo e(csrf_field()); ?>

            <div class="row">
                <div class="col-md-12">
                    <div class="form-group">
                        <label for="Mobile">شماره موبایل</label>
                        <input type="text" dir="rtl" id="Mobile" autocomplete="off" name="mobile" placeholder="شماره موبایل خود را وارد کنید" class="form-control primary input-sm" autofocus />
                    </div>
                </div>
            </div>
            <div class="row">
                <div class="col-md-12">
                    <div class="form-group">
                        <label for="Password">کلمه عبور</label>
                        <input type="password" dir="rtl" id="Password" name="password"  placeholder="کلمه عبور" class="form-control primary input-sm">
                    </div>
                </div>
            </div>
            
            
                
                    
                        
                        
                    
                
            
            
            
                
                    
                        
                            
                                
                            
                        
                        
                    
                
            
            <div class="row">
                <div class="col-md-12">
                    <div class="form-group">
                        <?php echo $__env->make('message.Message', array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>
                        <?php echo $__env->make('message.ErrorReporting', array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>
                    </div>
                </div>
            </div>
            <div class="row">
                <div class="col-md-12">
                    <div class="form-group">
                        <button type="submit" class="btn btn-login btn-warning btn-block">ورود</button>
                    </div>
                </div>
            </div>
            <div class="row">
                <div class="col-md-12">
                    <div class="form-group">
                        <p>رمز ورود رو فراموش کردی؟ <a href="<?php echo e(route('RecoveryPassword')); ?>">فراموش کردم</a> </p>
                    </div>
                    <div class="form-group">
                        <p>هنوز ثبت نام نکردی؟ <a href="<?php echo e(route('Register')); ?>">ثبت نام</a></p>
                    </div>
                </div>
            </div>
        </form>
    </div>
</div>



