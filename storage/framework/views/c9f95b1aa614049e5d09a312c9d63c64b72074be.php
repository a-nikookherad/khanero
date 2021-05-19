<?php $__env->startSection('title',TitlePage('نمایش اطلاعات')); ?>
<?php $__env->startSection('style'); ?>
    <link href="<?php echo e(url('backend/css/style-custom-panel.css')); ?>" type="text/css" rel="stylesheet"/>
    <style>
        .color-text-section {
            color: #3ba0ff;
        }
    </style>
<?php $__env->stopSection(); ?>
<?php $__env->startSection('content'); ?>
    <div class="row back-url">
        <div class="col-md-12">
            <a class="" href="<?php echo e(route('AdminDashboard')); ?>">صفحه اصلی</a> /
            <a class="" href="<?php echo e(route('IndexUser')); ?>">نمایش کاربران</a>
            <span class="now-url"> / نمایش جزئیات</span>
        </div>
    </div>
    <div class="row">
        <div class="col-md-12">
            <?php echo $__env->make('message.Message', array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>
            <?php echo $__env->make('message.ErrorReporting', array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>
        </div>
    </div>
    <div class="row">
        <div class="col-md-12">
            <div class="card hovercard">
                <div class="card-background">
                    <img class="card-bkimg" alt="" src="<?php echo e(asset('Uploaded/User/Profile').'/'. $userModel->avatar); ?>">
                </div>
                <div class="useravatar">
                    <img alt="" src="<?php echo e(asset('Uploaded/User/Profile').'/'. $userModel->avatar); ?>">
                </div>
                <div class="card-info"><span class="card-title"><?php echo e($userModel->first_name); ?></span>

                </div>
            </div>
            <div class="btn-pref btn-group btn-group-justified btn-group-lg" role="group" aria-label="...">
                <div class="btn-group" role="group">
                    <button type="button" id="stars"
                            class="btn <?php if(!$errors->has('title')): ?> btn-primary <?php else: ?> btn-default <?php endif; ?> " href="#tab1"
                            data-toggle="tab">
                        <span class="fa fa-user" aria-hidden="true"></span>
                        <div class="hidden-xs">جزئیات کاربر</div>
                    </button>
                </div>
                <div class="btn-group" role="group">
                    <button type="button" id="favorites"
                            class="btn <?php if($errors->has('title')): ?> btn-primary <?php else: ?> btn-default <?php endif; ?>" href="#tab2"
                            data-toggle="tab">
                        <span class="fa fa-dropbox" aria-hidden="true"></span>
                        <div class="hidden-xs">ارسال پیام</div>
                    </button>
                </div>
                <div class="btn-group" role="group">
                    <button type="button" id="following" class="btn btn-default" href="#tab3" data-toggle="tab">
                        <span class="fa fa-star-o" aria-hidden="true"></span>
                        <div class="hidden-xs">سابقه فعالیت</div>
                    </button>
                </div>
            </div>

            <div class="well">
                <div class="tab-content">
                    <div class="tab-pane fade <?php if(!$errors->has('title')): ?> in active <?php endif; ?>" id="tab1">
                        <div class="form-group">
                            <div class="row">
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label class="color-text-section">نام کاربر : </label>
                                        <label> <?php echo e($userModel->first_name); ?> </label>
                                    </div>
                                    <div class="form-group">
                                        <label class="color-text-section">شناسه کاربری : </label>
                                        <label> <?php echo e($userModel->user_name); ?> </label>
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label class="color-text-section">تلفن تماس : </label>
                                        <label> <?php echo e($userModel->mobile); ?> </label>
                                    </div>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label class="color-text-section">تاریخ تولد : </label>
                                        <?php (
                                            $birth_date = \Morilog\Jalali\Facades\jDate::forge($userModel->birth_date)->format('Y/m/d')
                                        ); ?>
                                        <label> <?php echo e($birth_date); ?> </label>
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label class="color-text-section">ایمیل : </label>
                                        <label> <?php echo e($userModel->email); ?> </label>
                                    </div>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-md-3">
                                    <div class="form-group">
                                        <label class="color-text-section">استان : </label>
                                        <?php if($userModel->getTownship != null): ?>
                                            <label> <?php echo e($userModel->getTownship->provinceGet->name); ?> </label>
                                        <?php else: ?>
                                            ثبت نشده
                                        <?php endif; ?>
                                    </div>
                                </div>
                                <div class="col-md-3">
                                    <div class="form-group">
                                        <label class="color-text-section">شهر : </label>
                                        <?php if($userModel->getTownship != null): ?>
                                            <label> <?php echo e($userModel->getTownship->name); ?> </label>
                                        <?php else: ?>
                                            ثبت نشده
                                        <?php endif; ?>
                                    </div>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-md-12">
                                    <div class="form-group">
                                        <label class="color-text-section">آدرس : </label>
                                        <label> <?php echo e($userModel->address); ?> </label>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>

                    <div class="tab-pane fade <?php if($errors->has('title')): ?> in active <?php endif; ?>" id="tab2">
                        <form action="<?php echo e(route('StoreMessage')); ?>" id="FormSendMessage" method="post">
                            <?php echo e(csrf_field()); ?>

                            <input type="hidden" name="receiver_id" value="<?php echo e($userModel->id); ?>">
                            <div class="form-group">
                                <label for="InputTitleMessage">عنوان پیام</label>
                                <input type="text" name="title" class="form-control" id="InputTitleMessage"
                                       placeholder="عنوان"/>
                                <?php if($errors->has('title')): ?>
                                    <span style="color:red;"><?php echo e($errors->first('title')); ?></span>
                                <?php endif; ?>
                            </div>
                            <div class="form-group">
                                <label for="InputContentMessage">متن پیام</label>
                                <textarea name="message" class="form-control" placeholder="متن پیام را وارد کنید"
                                          id="InputContentMessage" style="min-height: 100px;"></textarea>
                                <?php if($errors->has('message')): ?>
                                    <span style="color:red;"><?php echo e($errors->first('message')); ?></span>
                                <?php endif; ?>
                            </div>
                            <div class="form-group">
                                <button type="button" id="BtnSendMessage" class="btn btn-success btn-block">ارسال پیام
                                </button>
                            </div>
                        </form>
                    </div>

                    <div class="tab-pane fade in" id="tab3">
                        
                        
                        
                        
                        
                        
                        
                        
                        
                        <div class="alert alert-warning">
                            این کاربر هیچ فعالیتی در سیستم ندارد .
                        </div>
                    </div>
                </div>
            </div>

        </div>
    </div>




<?php $__env->stopSection(); ?>


<?php $__env->startSection('script'); ?>
    <script type="text/javascript">
        $(document).ready(function () {
            $(".btn-pref .btn").click(function () {
                $(".btn-pref .btn").removeClass("btn-primary").addClass("btn-default");
                // $(".tab").addClass("active"); // instead of this do the below
                $(this).removeClass("btn-default").addClass("btn-primary");
            });

            $('#BtnSendMessage').click(function () {
                var titleMessage = $('#InputTitleMessage').val();
                var contentMessage = $('#InputContentMessage').val();
                if (titleMessage == "" && contentMessage == "") {
                    alert('یک یا چند فیلد خالی میباشد');
                } else {
                    $('#FormSendMessage').submit();
                }
            });
        });
    </script>
<?php $__env->stopSection(); ?>
<?php echo $__env->make('backend.MasterPage.Layout', array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>