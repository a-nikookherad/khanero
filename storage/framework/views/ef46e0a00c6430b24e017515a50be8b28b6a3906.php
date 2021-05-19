
<?php $__env->startSection('title'); ?>
    ویلا :: تماس با ما
<?php $__env->stopSection(); ?>
<?php $__env->startSection('style'); ?>
    <style>
        .title-section {
            color: #fe5513;
            padding-bottom: 10px;
        }
        .title-section span {
            color: #3ba0ff;
            font-size: 22px;
            padding-left: 5px;
        }
    </style>
<?php $__env->stopSection(); ?>
<?php $__env->startSection('content'); ?>
    <div class="col-xs-12 col-sm-12">
        
            
                
                
            
        
        <div class="row">
            <div class="col-md-12 title-section">
                <h3>
                     تماس با ما
                </h3>
            </div>
        </div>
        <div class="row">
            <div class="col-md-12">
                <div class="panel panel-default"  style="margin-bottom: 50px;">
                    <div class="panel-body">
                        <form action="<?php echo e(route('StoreContactUser')); ?>" method="post" id="FormMessageContactUser">
                            <?php echo e(csrf_field()); ?>

                            <div class="row">
                                <div class="col-md-6">
                                    <div class="row">
                                        <div class="form-group">
                                            <label for="InputNameContactUser">نام و نام خانوادگی</label><span style="color: red; font-size: 20px">*</span>
                                            <input type="text" class="form-control" value="<?php echo e(old('name')); ?>" name="name" id="InputNameContactUser" placeholder="نام و نام خانوادگی خود را وارد کنید" />
                                            <?php if($errors->has('name')): ?>
                                                <span style="color:red;"><?php echo e($errors->first('name')); ?></span>
                                            <?php endif; ?>
                                        </div>
                                    </div>
                                    <div class="row">
                                        <div class="form-group">
                                            <label for="InputEmailContactUser">آدرس ایمیل</label><span style="color: red; font-size: 20px">*</span>
                                            <input type="email" class="form-control" value="<?php echo e(old('email')); ?>" name="email" id="InputEmailContactUser" placeholder="آدرس ایمیل خود را وارد کنید" />
                                            <?php if($errors->has('email')): ?>
                                                <span style="color:red;"><?php echo e($errors->first('email')); ?></span>
                                            <?php endif; ?>
                                        </div>
                                    </div>
                                    <div class="row">
                                        <div class="form-group">
                                            <label for="InputPhoneContactUser">تلفن تماس</label><span style="color: red; font-size: 20px">*</span>
                                            <input type="text" class="form-control" value="<?php echo e(old('phone')); ?>" name="phone" id="InputPhoneContactUser" placeholder="تلفن تماس خود را وارد کنید" />
                                            <?php if($errors->has('phone')): ?>
                                                <span style="color:red;"><?php echo e($errors->first('phone')); ?></span>
                                            <?php endif; ?>
                                        </div>
                                    </div>
                                    <div class="row">
                                        <div class="form-group">
                                            <label for="InputSubjectContactUser">موضوع</label><span style="color: red; font-size: 20px">*</span>
                                            <input type="text" class="form-control" name="subject" value="<?php echo e(old('subject')); ?>" id="InputSubjectContactUser" placeholder="موضوع خود را وارد کنید" />
                                            <?php if($errors->has('subject')): ?>
                                                <span style="color:red;"><?php echo e($errors->first('subject')); ?></span>
                                            <?php endif; ?>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <p style="line-height: 28px;">
                                        سایت رنت به منظور تسهیل ارتباط خود با کاربران سایت، اطلاعات تماس خود را ارائه می‌نماید. کاربران عزیز می‌توانند با استفاده از اطلاعات تماس ذیل ما را از نظرات و پیشنهادات خود مطلع سازند و همچمین ما را در جهت رسیدن به اهداف سایت یاری دهند.
                                        لطفاً در صورت امکان اطلاعات را به فارسی وارد نمایید.
                                    </p>
                                    <div class="text-center">
                                        <img style="padding: 30px;width: 50%;" src="<?php echo e(asset('frontend/images/logo.png')); ?>" />
                                    </div>
                                </div>
                            </div>

                            <div class="row">
                                <div class="col-md-12">
                                    <div class="form-group">
                                        <label for="InputContentContactUser">متن پیام</label><span style="color: red; font-size: 20px">*</span>
                                        <textarea class="form-control" name="content" id="InputContentContactUser" style="min-height: 100px;" placeholder="متن خود را وارد کنید"><?php echo e(old('content')); ?></textarea>
                                        <?php if($errors->has('content')): ?>
                                            <span style="color:red;"><?php echo e($errors->first('content')); ?></span>
                                        <?php endif; ?>
                                    </div>
                                </div>
                                <div class="col-md-12">
                                    <div class="form-group">
                                        <button type="button" id="BtnSendContactUser" class="btn btn-success btn block">ثبت پیام</button>
                                    </div>
                                </div>
                            </div>
                        </form>

                        <div class="row">
                            <div class="col-md-12 text-center">
                                <h5 style="color: #fe5513;">موقعیت دفتر بر روی نقشه </h5>
                                <br />
                                <div id="map-markers" style="height:300px"></div>
                            </div>
                        </div>
                        <br />
                        <div class="row text-center">
                            <div class="col-md-12">
                                <div class="col-md-4">
                                    <h5 style="color: #ff6600;">آدرس دفتر مرکزی </h5>
                                    <h4><?php echo e($contactModel->address); ?></h4>
                                </div>
                                <div class="col-md-4">
                                    <h5 style="color: #ff6600;">تلفن تماس </h5>
                                    <h4><?php echo e($contactModel->phone); ?></h4>
                                </div>
                                <div class="col-md-4">
                                    <h5 style="color: #ff6600;">ایمیل سازمانی رنت </h5>
                                    <h4><?php echo e($contactModel->email); ?></h4>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
<?php $__env->stopSection(); ?>

<?php $__env->startSection('script'); ?>
    <script src="https://maps.googleapis.com/maps/api/js?key=AIzaSyCBUcxNAzDyoiTXUXpLwd1a-3jOwkQpDUs&sensor=false&libraries=places&language=en"></script>

    <script type="text/javascript" src="<?php echo e(asset('backend/js/gmaps.js')); ?>"></script>
    <script type="text/javascript">
        //markers
        console.log();
        map = new GMaps({
            div: '#map-markers',
            lat: <?php echo e($contactModel->latitude); ?>,
            lng: <?php echo e($contactModel->longitude); ?>

        });
        map.addMarker({
            lat: <?php echo e($contactModel->latitude); ?>,
            lng: <?php echo e($contactModel->longitude); ?>,
            title: 'Marker with InfoWindow',
            infoWindow: {
                content: '<p><?php echo e($contactModel->phone); ?></p>'
            }
        });
    </script>

    <script>
        $(document).ready(function () {
            $('#BtnSendContactUser').click(function () {
                // var name = $('#InputNameContactUser').val();
                // var email = $('#InputEmailContactUser').val();
                // var phone = $('#InputPhoneContactUser').val();
                // var subject = $('#InputSubjectContactUser').val();
                // var content = $('#InputContentContactUser').val();
                // if(name == "" || email == "" || phone == "" || subject == "" ||  content == "")
                // {
                //     alert('یک یا چند فیلد خالی میباشد');
                // }
                // else
                // {
                $('#FormMessageContactUser').submit();
                // }
            });
        });
    </script>
<?php $__env->stopSection(); ?>

<?php echo $__env->make('frontend.MasterPage.Layout', array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>