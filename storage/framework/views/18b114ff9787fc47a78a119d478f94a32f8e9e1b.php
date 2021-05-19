

<?php $__env->startSection('title', TitlePage('تماس با ما')); ?>

<?php $__env->startSection('style'); ?>

<?php $__env->stopSection(); ?>

<?php $__env->startSection('content'); ?>

    <div class="row back-url">
        <div class="col-md-12">
            <a class="" href="<?php echo e(route('AdminDashboard')); ?>">صفحه اصلی</a><span class="now-url"> / تماس با ما</span>
        </div>
    </div>
    <div class="row">
        <div class="col-md-12">
            <?php echo $__env->make('message.Message', array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>
            <?php echo $__env->make('message.ErrorReporting', array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>
        </div>
    </div>
    <div class="row">
        <div class="col-md-12" style="margin-bottom: 10px;">
            <a href="<?php echo e(route('IndexContactMessage')); ?>" class="btn btn-default">نمایش پیام های دریافتی <i style="font-size: 18px;" class="text-success fa fa-eye"></i> </a>
        </div>
        <div class="col-md-12">
            <div class="panel panel-default">
                <div class="panel-heading text-right">
                    <h3 class="panel-title"> تماس با ما </h3>
                </div>
                <form action="<?php echo e(route('UpdateFormContactUs')); ?>" method="Post" id="FormUpdateContact">
                    <?php echo e(csrf_field()); ?>

                    <div class="panel-body">
                        <div class="widget-body">
                            <fieldset class="gllpLatlonPicker">
                                <div class="row">
                                    <div class="row-fluid">
                                        <div class="span10 col-md-9">
                                            <input type="text" class="gllpSearchField span12 autocomplete form-control" id="autocomplete" placeholder="جستجوی مکان">
                                        </div>
                                        <div class="span2 col-md-3">
                                            <input type="button" class="gllpSearchButton form-control filestyle" value="جستجو" data-icon="false" data-classbutton="btn btn-default" data-classinput="form-control inline">
                                        </div>
                                    </div>
                                </div>
                                <br />
                                <div class="row-fluid">
                                    <div class="span12">
                                        <div class="gllpMap">موقعیت مکانی</div>
                                        <input type="hidden" class="gllpZoom" value="15"/>
                                        <input type="hidden" name="latitude" class="gllpLatitude form-control" id="Latitude" value="<?php echo e($contactModel->latitude); ?>"/>
                                        <input type="hidden" name="longitude" class="gllpLongitude form-control" id="Longitude" value="<?php echo e($contactModel->longitude); ?>"/>
                                    </div>

                                </div>
                            </fieldset>
                        </div>
                        <div class="row">
                            <div class="col-md-12">
                                <div class="form-group">
                                    <label for="InputPhone">تلفن</label>
                                    <input type="text" name="phone" class="form-control" value="<?php echo e($contactModel->phone); ?>" id="InputPhone" placeholder="شماره تلفن خود را وارد کنید" />
                                    <?php if($errors->has('phone')): ?>
                                        <span style="color:red;"><?php echo e($errors->first('phone')); ?></span>
                                    <?php endif; ?>
                                </div>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-md-12">
                                <div class="form-group">
                                    <label for="InputAbout">درباره</label>
                                    <textarea name="about" rows="3" class="form-control" id="InputAbout" placeholder="درباره خانه رو ..."><?php echo e($contactModel->about); ?></textarea>
                                    <?php if($errors->has('about')): ?>
                                        <span style="color:red;"><?php echo e($errors->first('about')); ?></span>
                                    <?php endif; ?>
                                </div>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-md-12">
                                <div class="form-group">
                                    <label for="InputEmail">پست الکترونیکی</label>
                                    <input type="text" name="email" class="form-control" value="<?php echo e($contactModel->email); ?>" id="InputEmail" placeholder="پست الکترونیکی خود را وارد کنید" />
                                    <?php if($errors->has('email')): ?>
                                        <span style="color:red;"><?php echo e($errors->first('email')); ?></span>
                                    <?php endif; ?>
                                </div>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-md-12">
                                <div class="form-group">
                                    <label for="InputAddress">آدرس</label>
                                    <input type="text" name="address" class="form-control" value="<?php echo e($contactModel->address); ?>" id="InputAddress" placeholder="آدرس موقعیت خود را وارد کنید" />
                                    <?php if($errors->has('address')): ?>
                                        <span style="color:red;"><?php echo e($errors->first('address')); ?></span>
                                    <?php endif; ?>
                                </div>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label for="InputWhatsapp">Whatsapp</label>
                                    <input type="text" name="whatsapp" class="form-control" value="<?php echo e($contactModel->whatsapp); ?>" id="InputWhatsapp" placeholder="Whatsapp Link" />
                                    <?php if($errors->has('whatsapp')): ?>
                                        <span style="color:red;"><?php echo e($errors->first('whatsapp')); ?></span>
                                    <?php endif; ?>
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label for="InputAparat">Aparat</label>
                                    <input type="text" name="aparat" class="form-control" value="<?php echo e($contactModel->aparat); ?>" id="InputAparat" placeholder="Aparat Link" />
                                    <?php if($errors->has('aparat')): ?>
                                        <span style="color:red;"><?php echo e($errors->first('aparat')); ?></span>
                                    <?php endif; ?>
                                </div>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label for="InputInstagram">Instagram</label>
                                    <input type="text" name="instagram" class="form-control" value="<?php echo e($contactModel->instagram); ?>" id="InputInstagram" placeholder="Instagram Link" />
                                    <?php if($errors->has('instagram')): ?>
                                        <span style="color:red;"><?php echo e($errors->first('instagram')); ?></span>
                                    <?php endif; ?>
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label for="InputTelegram">Telegram</label>
                                    <input type="text" name="telegram" class="form-control" value="<?php echo e($contactModel->telegram); ?>" id="InputTelegram" placeholder="Instagram Link" />
                                    <?php if($errors->has('telegram')): ?>
                                        <span style="color:red;"><?php echo e($errors->first('telegram')); ?></span>
                                    <?php endif; ?>
                                </div>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-md-12">
                                <div class="form-group">
                                    <button type="button" id="BtnUpdateFormContact" class="btn btn-success btn-block">ثبت ویرایش</button>
                                </div>
                            </div>
                        </div>

                    </div>
                </form>
            </div>
        </div>
    </div>

<?php $__env->stopSection(); ?>

<?php $__env->startSection('script'); ?>

    <!-- Map -->
    <script src="https://maps.googleapis.com/maps/api/js?key=AIzaSyCBUcxNAzDyoiTXUXpLwd1a-3jOwkQpDUs&sensor=false&libraries=places&language=en"></script>
    <script type="text/javascript" src="<?php echo e(asset('backend/assets/map/jquery-gmaps-latlon-picker.js')); ?>"></script>
    <link rel="stylesheet" href="<?php echo e(asset('backend/assets/map/jquery-gmaps-latlon-picker.css')); ?>">

    <!-- search -->
    <script>
        var input = document.getElementById('autocomplete');
        var autocomplete = new google.maps.places.Autocomplete(input);

        var input = document.getElementById('autocomplete1');
        var autocomplete = new google.maps.places.Autocomplete(input);
    </script>

    <script>
        $('#BtnUpdateFormContact').click(function () {
            var inputPhone = $('#InputPhone').val();
            var inputEmail = $('#InputEmail').val();
            var inputAddress = $('#InputAddress').val();
            if(inputPhone == "" || inputEmail == "" || inputAddress == "")
            {
                alert('پر کردن فیلدهای ستاره دار الزامی میباشد');
            }
            else
            {
                $('#FormUpdateContact').submit();
            }
        });
    </script>
<?php $__env->stopSection(); ?>
<?php echo $__env->make('backend.MasterPage.Layout', array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>