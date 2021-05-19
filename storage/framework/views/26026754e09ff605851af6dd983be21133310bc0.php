
<?php $__env->startSection('title',TitlePage($hostModel->name)); ?>
<?php $__env->startSection('style'); ?>
    <link rel="stylesheet" href="<?php echo e(asset('backend/css/bootstrap-datepicker.min.css')); ?>"/>
    <link rel="stylesheet" href="<?php echo e(asset('frontend/css/style-detail.css')); ?>"/>
    <style>
        .display-none {
            display: none;
        }
        div#PreFactor {
            text-align: center;
        }

    </style>
<?php $__env->stopSection(); ?>

<?php $__env->startSection('content'); ?>

    <script>
        function CalculateFactor(type) { // type => محاسبه یا ثبت رزرو

            if (type == 'calculate') {

                $('#PreFactor').html('<img style="width: 55px;" src="<?php echo e(asset('backend/img/img_loading/orange_circles.gif')); ?>" />');

            } else if (type == 'reserve') {

                $('.form-reserve').css('opacity', '0.6');
                $('.display-block').css('display', 'block');
                $('#SpanLoading').html('<img style="width: 80px;" src="<?php echo e(asset('backend/img/img_loading/orange_circles.gif')); ?>" />');

            }

            $.ajaxSetup({
                headers: {
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                }
            });
            $.ajax({
                url: '<?php echo e(route('CalculateReserveHostByDateAjax')); ?>',
                type: 'post',
                data: {
                    type: type,
                    from_date: $('#InputDateFrom').val(),
                    to_date: $('#InputDateTo').val(),
                    count_guest: $('#CountGuest').val(),
                    host_id: <?php echo e($hostModel->id); ?>,
                },
                success: function (data) {
                    if (type == 'reserve') {
                        $('.display-block').css('display', 'none');
                        $('#SpanLoading').html('');
                        $('.form-reserve').css('opacity', '1');
                        if (data.Success == -1) { // login
                            $('#myModalRegister').modal('show');
                            AlertMessage('خطا در ارسال اطلاعات', data.Message, 'warning');
                        } else if (data.Success == 0) {
                            AlertMessage('خطا در ارسال اطلاعات', data.Message, 'warning');
                        } else {
                            AlertMessage('رزرو اقامتگاه', 'رزرو اقامتگاه با موفقیت انجام شد ، برای مشاهده وضعیت رزرو به پنل کاربری مراجعه کنید .', 'success');
                            $('#InputDateTo').val('');
                            $('#InputDateFrom').val('');
                            $('#MsgCalculatePrice').html('');
                            $('#PreFactor').html('');
                        }
                    } else if (type == 'calculate') {
                        $('#PreFactor').html('');
                        $('#PreFactor').html(data.Message.original);
                        if (data.Success == 0) {
                            AlertMessage('ثبت رزرو', data.Message, 'warning');
                        }
                    }
                }
            });
        }
    </script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>
    <!-- Add fancyBox -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/fancybox/3.5.2/jquery.fancybox.min.css" type="text/css" media="screen"/>
    <script type="text/javascript" src="https://cdnjs.cloudflare.com/ajax/libs/fancybox/3.5.2/jquery.fancybox.min.js"></script>

    <div class="content-home">
        <div class="request-reserve">
            <a class="d-block" href="#onwe">درخواست رزرو</a>
            <p class="text-prt">
                هر شب از <?php echo e(GetMinPrice($hostModel->id)); ?> تومان
                (حداقل تعداد روز رزرو : <?php echo e($hostModel->min_reserve_day); ?>)
            </p>
        </div>
        <div class="row">
            <div class="btn-left">
                <div class="dropdown btn1">
                    <button class="btn btn-primary dropdown-toggle" type="button" data-toggle="dropdown">
                        <i class="fas fa-share-alt"></i>
                        <span class=" btn3"></span>
                    </button>
                    <ul class="dropdown-menu">
                        <li class="whatsapp">
                            <a target="_blank" href="https://wa.me/?text=<?php echo e(URL::current()); ?>"><i
                                        class="fab fa-whatsapp"></i>ارسال در واتس آپ</a>
                        </li>
                        <li class="telegram">
                            <a target="_blank"
                               href="https://t.me/share/url?url=<?php echo e(URL::current()); ?>&amp;text=<?php echo e($hostModel->name); ?>"><i
                                        class="fab fa-telegram"></i>ارسال در تلگرام</a>
                        </li>
                    </ul>
                </div>
                <span class="btn1 btn2 btn-favorite-detail-host" data-id="<?php echo e($hostModel->id); ?>">
                    <?php if(auth()->check() && $hostModel->getFavorite == null): ?>
                        <i class="far fa-heart"></i>
                    <?php else: ?>
                        <i class="fas fa-heart" style="color: red"></i>
                    <?php endif; ?>
                </span>


            </div>
            <div class="slideshow">

                <div class="imglist">
                    <div class="box-right col-xs-12 col-sm-6 no-pad">
                    <!--					<img class="image-right"
					     src="<?php echo e(asset('Uploaded/Gallery/Img'.'/'.$hostModel->getGallery[0]->img)); ?>"/>-->


                        <a class="col-xs-12 no-pad"
                           href="<?php echo e(asset('Uploaded/Gallery/Img'.'/'.$hostModel->getGallery[0]->img)); ?>"
                           data-fancybox="images">
                            <img class="image-right"
                                 src="<?php echo e(asset('Uploaded/Gallery/Img'.'/'.$hostModel->getGallery[0]->img)); ?>">
                        </a>
                        <?php $__currentLoopData = $hostModel->getGallery; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $key => $value): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                            <div class="hidden">
                                <a class="col-xs-12 no-pad image-slide-show"
                                   href="<?php echo e(asset('Uploaded/Gallery/Img'.'/'.$value->img)); ?>" data-fancybox="images">
                                    <img class=" image-slide-show"
                                         src="<?php echo e(asset('Uploaded/Gallery/Img'.'/'.$value->img)); ?>">
                                </a>
                            </div>
                        <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                    </div>

                </div>
                <div class="box-left col-xs-12 col-sm-6 no-pad">
                    <?php $__currentLoopData = $hostModel->getGallery; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $key => $value): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                        <div class="left col-xs-12 col-sm-6 no-pad">
                        <!--						      <a class="col-xs-12 no-pad image-slide-show" href="<?php echo e(asset('Uploaded/Gallery/Img'.'/'.$value->img)); ?>" data-fancybox="images">
      <img  class=" image-slide-show" src="<?php echo e(asset('Uploaded/Gallery/Img'.'/'.$value->img)); ?>">
  </a>-->
                            <img class="image-slide-show" src="<?php echo e(asset('Uploaded/Gallery/Img'.'/'.$value->img)); ?>"/>
                        </div>
                    <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                </div>
            </div>
            <div class="container-fluid container-detail">
                <div class="col-md-8">
                    <hr/>
                    <div class="row">
                        <div class="col-md-9 box-detail-host">
                            <div class="row">
                                <h2><?php echo e($hostModel->name); ?></h2>
                            </div>
                            <div class="row">
                                <h5><?php if($hostModel->home_type_id == 1): ?> دربستی <?php elseif($hostModel->home_type_id == 2): ?>اتاق
                                    شخصی <?php else: ?> اتاق مشترک <?php endif; ?> - <?php echo e($hostModel->getBuildingType->name); ?></h5>
                            </div>
                            <div class="row">
                                <h5><?php echo e($hostModel->getProvince->name); ?> - <?php echo e($hostModel->getTownship->name); ?>

                                    - <?php echo e($hostModel->district); ?></h5>
                                <br/>
                                <br/>
                                <span><?php echo e($hostModel->count_reserve); ?> بار رزرو شده | کد اقامتگاه : <?php echo e($hostModel->id); ?></span>
                            </div>
                        </div>
                        <div class="col-md-3 box-detail-user">
                            <div class="row">
                                <?php if($hostModel->getUser->avatar != 'default-user.png'): ?>
                                    <img src="<?php echo e(asset('Uploaded/User/Profile').'/'.$hostModel->getUser->avatar); ?>"
                                         class="user-avatar">
                                <?php else: ?>
                                    <img src="<?php echo e(asset('Uploaded/User/Profile/default-user.png')); ?>" class="user-avatar">
                                <?php endif; ?>
                                <div class="row">
                                    <h5>
                                        <a href="<?php echo e(route('DetailUserProfile', ['id' => $hostModel->getUser->id])); ?>"><?php echo e($hostModel->getUser->first_name); ?>

                                            <div class="box-medal">
                                                <?php if($hostModel->getUser->confirm_user == 3): ?>
                                                    <img src="<?php echo e(asset('frontend/images/medal.png')); ?>" class="medal">
                                                <?php endif; ?>
                                            </div>
                                        </a>
                                    </h5>
                                </div>
                            </div>
                        </div>
                    </div>
                    <hr/>
                    <?php 
                        $countBed = 0;
                     ?>
                    <?php $__currentLoopData = $hostModel->getRoom; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $index => $item): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                        <?php 
                            $countBed = $countBed + $item->single_beds + $item->double_beds * 2;
                         ?>
                    <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>

                    <div class="row box-icon text-center">
                        <div class="col-md-3">
                            <p>
                                <?php  $count = $hostModel->count_traditional_bed;  ?>
                                <?php $__currentLoopData = $hostModel->getRoom; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $key => $value): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                    <?php 
                                        $single_beds = $value->single_beds;
                                        $double_beds = $value->double_beds*2;
                                        $count = $count + $single_beds + $double_beds;
                                     ?>
                                <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                                <?php if($count == 1): ?>
                                    <img src="<?php echo e(asset('frontend/icons/1person.jpg')); ?>"
                                         class="img-responsive icon-detail"/>
                                <?php elseif($count ==2): ?>
                                    <img src="<?php echo e(asset('frontend/icons/2person.jpg')); ?>"
                                         class="img-responsive icon-detail"/>
                                <?php elseif($count ==3): ?>
                                    <img src="<?php echo e(asset('frontend/icons/3person.jpg')); ?>"
                                         class="img-responsive icon-detail"/>
                                <?php elseif($count ==4): ?>
                                    <img src="<?php echo e(asset('frontend/icons/4person.jpg')); ?>"
                                         class="img-responsive icon-detail"/>
                                <?php elseif($count ==5): ?>
                                    <img src="<?php echo e(asset('frontend/icons/5person.jpg')); ?>"
                                         class="img-responsive icon-detail"/>
                                <?php elseif($count ==6): ?>
                                    <img src="<?php echo e(asset('frontend/icons/6person.jpg')); ?>"
                                         class="img-responsive icon-detail"/>
                                <?php elseif($count == 0): ?>
                                    <img src="<?php echo e(asset('frontend/icons/1person.jpg')); ?>"
                                         class="img-responsive icon-detail"/>
                                <?php else: ?>
                                    <img src="<?php echo e(asset('frontend/icons/7person.jpg')); ?>"
                                         class="img-responsive icon-detail"/>
                                <?php endif; ?>






                                    <?php echo e($hostModel->standard_guest); ?> مهمان
                                <?php if($hostModel->count_guest != 0): ?>
                                    + <?php echo e($hostModel->count_guest); ?> مهمان اضافه
                                <?php endif; ?>


                            </p>
                        </div>
                        <div class="col-md-3">
                            <img style="width: 60px!important;" src="<?php echo e(asset('frontend/icons/otagh.jpg')); ?>"
                                 class="img-responsive icon-detail"/>
                            <p><?php echo e($hostModel->count_room); ?> اتاق </p>
                        </div>
                        <div class="col-md-3">
                            <img src="<?php echo e(asset('frontend/icons/bed.jpg')); ?>" class="img-responsive icon-detail"/>
                            <p><?php echo e($countBed); ?> تخت </p>
                        </div>
                        <div class="col-md-3">
                            <img src="<?php echo e(asset('frontend/icons/bath.jpg')); ?>" class="img-responsive icon-detail"/>
                            <p> <?php echo e($hostModel->count_bathroom); ?>حمام و <?php echo e($hostModel->count_toilet); ?>دستشویی </p>
                        </div>
                    </div>
                    <hr/>


                    <div class="row box-icon section">
                        <div class="col-md-12">
                            <h4 style="display: inline-block;"> درباره خانه</h4>
                        </div>
                        <div class="col-md-offset-1">
                            <div class="row">
                                <div class="col-md-12">
                                    <p class="about-host">
                                        <?php if($hostModel->description == ''): ?> اطلاعاتی درباره خانه ثبت نشده است
                                        . <?php else: ?> <?php echo e($hostModel->description); ?> <?php endif; ?>
                                    </p>

                                    <div class="form-group">
                                        <br/>
                                        <?php if(auth()->check()): ?>
                                            <button class="btn btn-default btn-sm" data-toggle="modal"
                                                    <?php if(auth()->user()->id != $hostModel->getUser->id): ?> data-target="#myModalMessage" <?php endif; ?>>
                                                گفت و گو با میزبان
                                            </button>
                                        <?php else: ?>
                                            <p>برای گفت و گو با میزبان ابتدا <a href="<?php echo e(route('Register')); ?>">وارد</a>
                                                شوید .</p>
                                        <?php endif; ?>
                                    </div>
                                    <div class="row">
                                        
                                        
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <hr/>


                    <div class="row section text-center">
                        <div class="col-md-4">
                            <h5>
                                متراژ : <?php echo e($hostModel->meter); ?>

                            </h5>
                        </div>
                        <div class="col-md-4">
                            <h5 class="detail-reserve">موقعیت خانه :
                                <?php ($i = 0); ?>
                                <?php $__currentLoopData = unserialize($hostModel->position_array); $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $key => $value): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                    <?php $__currentLoopData = $positionTypeModel; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $item => $index): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                        <?php if($index->id == $value): ?>
                                            <?php if($i > 0): ?> | <?php endif; ?>
                                            <?php echo e($index->name); ?>

                                            <?php ($i++); ?>
                                        <?php endif; ?>
                                    <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                                <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                            </h5>
                        </div>
                        <div class="col-md-4">
                            <h5>
                                حیاط اشتراکی :
                                <?php if($hostModel->shared_yard == 1): ?> بله <?php else: ?> خیر <?php endif; ?>
                            </h5>
                        </div>
                    </div>
                    <hr/>


                    <?php if(!empty($hostModel->getRoomCommon)): ?>
                        <div class="row section text-center">
                            <div class="col-md-12 text-right">
                                <h4>
                                    کسانی که در این اقامتگاه زندگی میکنند
                                </h4>
                            </div>
                            <div class="col-md-4">
                                <h5>
                                    تعداد زن :<?php echo e($hostModel->getRoomCommon->count_woman); ?>

                                </h5>
                            </div>
                            <div class="col-md-4">
                                <h5>
                                    تعداد مرد :<?php echo e($hostModel->getRoomCommon->count_man); ?>

                                </h5>
                            </div>
                            <div class="col-md-4">
                                <h5>
                                    تعداد بچه :<?php echo e($hostModel->getRoomCommon->count_child); ?>

                                </h5>
                            </div>
                        </div>
                        <hr/>
                    <?php endif; ?>

                    <div class="row section box-option">
                        <div class="col-md-12">
                            <h4> امکانات </h4>
                        </div>
                        <div class="col-md-offset-1">
                            <div class="row">
                                <?php $__currentLoopData = $hostModel->getHostPossibilities; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $key => $value): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                    <div class="col-md-6" style="margin-bottom: 10px;">
                                        <img src="<?php echo e(asset('Uploaded/Possibilities/Option').'/'.$value->getOption->img); ?>">
                                        <?php echo e($value->getOption->name); ?>

                                        <?php if($value->description != ''): ?>
                                            <span class="tooltip-span" data-toggle="tooltip" data-placement="left"
                                                  title="<?php echo e($value->description); ?>">؟</span>
                                        <?php endif; ?>
                                    </div>
                                <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                            </div>
                        </div>
                    </div>
                    <hr/>


                    <div class="row box-icon section">
                        <div class="col-md-12">
                            <h4> قیمت خانه</h4>
                        </div>
                        <div class="row">
                            <div class="col-md-8 col-md-offset-1">
                                <h5>وسط هفته<p class="price"> <?php echo e(number_format($priceModelFirstWeek->price)); ?> </p>تومان
                                </h5>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-md-8 col-md-offset-1">
                                <h5>آخر هفته<p class="price"> <?php echo e(number_format($priceModelLastWeek->price)); ?> </p>تومان
                                </h5>
                            </div>
                        </div>
                        <?php if($hostModel->special_price != 0): ?>
                            <div class="row">
                                <div class="col-md-8 col-md-offset-1">
                                    <h5>قیمت ویژه<p class="price"> <?php echo e(number_format($hostModel->special_price)); ?> </p>
                                        تومان
                                    </h5>
                                </div>
                            </div>
                        <?php endif; ?>
                        <?php if($hostModel->one_person_price != 0): ?>
                            <div class="row">
                                <div class="col-md-8 col-md-offset-1">
                                    <h5>قیمت هر نفر اضافه<p
                                                class="price"> <?php echo e(number_format($hostModel->one_person_price)); ?> </p>تومان
                                    </h5>
                                </div>
                            </div>
                        <?php endif; ?>
                        <div class="row">
                            <div class="col-md-11 col-md-offset-1">
                                <p class="detail-reserve"> هنگام رزرو باید تاریخ رفت و
                                    برگشت را وارد کنید که زیر هر تاریخ قیمت آن روز برای راحتی شما درج شده است .</p>
                                <p class="detail-reserve"> سایت به صورت خودکار با در نظر
                                    گرفتن (تاریخ ، تعداد و تخفیف) قیمت تمام شده هر شب را در فاکتور (جزئیات بیشتر) نشان
                                    می دهد .</p>
                            </div>
                        </div>
                        
                        
                        
                        
                        
                        
                        
                        
                        
                        
                        
                        
                        
                    </div>
                    <hr/>


                    <div class="row section">
                        <div class="col-md-12">
                            <h4> تخفیف ها</h4>
                        </div>
                        <?php $__currentLoopData = $hostModel->getDiscount; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $key => $value): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                            <div class="col-md-8 col-md-offset-1">
                                <h5><p class="price"> <?php echo e($value->number_days); ?> </p> روز <p
                                            class="price"> <?php echo e($value->percent); ?> </p> درصد
                                </h5>
                            </div>
                        <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                        <div class="col-md-11 col-md-offset-1">

                        </div>
                    </div>
                    <hr/>


                    <div class="row box-icon section">
                        <div class="col-md-12">
                            <h4> قوانین اقامتگاه</h4>
                        </div>
                        <div class="col-md-offset-1">
                            <div class="row">
                                <div class="col-md-6">
                                    <?php  $count = 0;  ?>
                                    <?php $__currentLoopData = $ruleModel; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $key => $value): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                        <?php  $count++;  ?>
                                        <?php if($count == 5): ?>
                                </div>
                                <div class="col-md-6">
                                    <?php  $count = 0;  ?>
                                    <?php endif; ?>
                                    <div class="row">
                                        <div class="col-md-7">
                                            <p class="detail-reserve"><?php echo e($value->name); ?></p>
                                        </div>
                                        <div class="col-md-5">
                                            <?php if((in_array($value->id, $arr_rule))): ?>
                                                <div class="fas fa-check"></div>
                                            <?php else: ?>
                                                <div class="fas fa-times"></div>
                                            <?php endif; ?>
                                        </div>
                                    </div>
                                    <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-md-12">
                            <?php $__currentLoopData = config('setting.CancelReserveRule'); $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $key => $value): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                <?php if($hostModel->cancel_rule_id == $value['id']): ?>
                                    <h4 style="display: inline-block;"><?php echo e($value['name']); ?></h4>
                                    <div class="col-md-offset-1">
                                        <?php $__currentLoopData = $value['time']; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $key2 => $value2): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                            <p><?php echo e($value2['description']); ?><p>
                                                <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                                            </p>
                                            <?php endif; ?>
                                        <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                                    </div>
                        </div>


                        <?php if($hostModel->new_rule != ''): ?>
                            <div class="row box-icon section">
                                <div class="col-md-12">
                                    <h4 style="display: inline-block;"> قوانین اضافه</h4>
                                </div>
                                <div class="col-md-offset-1">
                                    <div class="row">
                                        <div class="col-md-12">
                                            <p class="about-host">
                                                <?php echo e($hostModel->new_rule); ?>

                                            </p>
                                            <div class="form-group">
                                                <br/>
                                                <button class="btn btn-default btn-sm" data-toggle="modal"
                                                        data-target="#myModal1"> قوانین سایت
                                                </button>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        <?php endif; ?>


                        <br/>
                        <div class="row box-icon section">
                            <div class="col-md-12 text-center">
                                <div class="col-md-6">
                                    
                                    <h5 class="box-time">ساعت ورود : <?php echo e($hostModel->time_enter); ?></h5>
                                </div>
                                <div class="col-md-6">
                                    
                                    <h5 class="box-time"> ساعت خروج :<?php echo e($hostModel->time_exit); ?></h5>
                                </div>
                            </div>
                        </div>
                        <hr/>


                        <div class="row section">
                            <div class="col-md-12">
                                <h4 style="display: inline-block;"> چیدمان اتاق ها</h4>
                                <p> رخت خواب سنتی <?php echo e($hostModel->count_traditional_bed); ?> </p>
                            </div>
                            <div class="col-md-offset-1">
                                <div class="row">
                                    <div class="col-md-12 text-center">
                                        <?php $__currentLoopData = $hostModel->getRoom; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $key => $value): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                            <div class="col-md-4" style="padding: 2px;">
                                                <div class="box-room">
                                                    <p class="">اتاق <?php echo e($key+1); ?></p>
                                                    <br/>
                                                    <div class="boxs room">
                                                        <div class="col-md-4">
                                                            <img src="<?php echo e(asset('frontend/icons/bed-80-2.jpg')); ?>" alt="">
                                                            <div class="row">
                                                                <h5 class="price"><?php echo e($value->double_beds); ?></h5>
                                                            </div>
                                                        </div>
                                                        <div class="col-md-4">
                                                            <img src="<?php echo e(asset('frontend/icons/bed-80-1.jpg')); ?>" alt="">
                                                            <div class="row">
                                                                <h5 class="price"><?php echo e($value->single_beds); ?></h5>
                                                            </div>
                                                        </div>
                                                        <div class="col-md-4">
                                                            <img src="<?php echo e(asset('frontend/icons/bath.jpg')); ?>" alt="">
                                                            <div class="row">
                                                                <h5 class="price"><?php echo e($value->toilet_bathroom); ?></h5>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                                    </div>
                                </div>
                            </div>
                        </div>

                        <div class="row box-icon section">
                            <div class="col-md-12 text-center">
                                <div id="map-markers" style="height:300px"></div>
                            </div>
                        </div>
                        <br/>


                        <div class="row box-icon section">
                            <div class="col-md-5 col-md-offset-1"></div>
                        </div>
                        <hr/>


                        <div class="row section-comment">
                            <div class="row">

                                <?php if(count($hostModel->getRate) > 0): ?>
                                    <?php 
                                        $rate1 = 0;
                                        $rate2 = 0;
                                        $rate3 = 0;
                                        $rate4 = 0;
                                        $rate5 = 0;

                                        $total = 0;
                                        $count = count($hostModel->getRate);
                                     ?>
                                    <?php $__currentLoopData = $hostModel->getRate; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $key => $value): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                        <?php 
                                            $rate1 = $rate1 + $value->rate1;
                                            $rate2 = $rate2 + $value->rate2;
                                            $rate3 = $rate3 + $value->rate3;
                                            $rate4 = $rate4 + $value->rate4;
                                            $rate5 = $rate5 + $value->rate5;
                                         ?>
                                    <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                                    <?php 
                                        $width1 = ($rate1/$count);
                                        $width2 = ($rate2/$count);
                                        $width3 = ($rate3/$count);
                                        $width4 = ($rate4/$count);
                                        $width5 = ($rate5/$count);
                                        $total = $width1+$width2+$width3+$width4+$width5;
                                     ?>
                                    <div class="col-md-12">
                                        امتیاز میهمانان
                                        <span class="event_star star_big" data-starnum="<?php echo e($total/5); ?>">
                                       <i></i>
                                    </span>
                                    </div>
                                    <hr />
                                    <div class="col-md-6 text-left">
                                        محیط اطراف
                                        <span class="event_star star_big" data-starnum="<?php echo e($width1); ?>">
                                               <i></i>
                                            </span>
                                    </div>
                                    <div class="col-md-6 text-left">
                                        سهولت دسترسی
                                        <span class="event_star star_big" data-starnum="<?php echo e($width2); ?>">
                                               <i></i>
                                            </span>
                                    </div>
                                    <div class="col-md-6 text-left">
                                        نظافت
                                        <span class="event_star star_big" data-starnum="<?php echo e($width3); ?>">
                                               <i></i>
                                            </span>
                                    </div>
                                    <div class="col-md-6 text-left">
                                        ارزش نسبت به قیمت
                                        <span class="event_star star_big" data-starnum="<?php echo e($width4); ?>">
                                               <i></i>
                                            </span>
                                    </div>
                                    <div class="col-md-6 text-left">
                                        کیفیت میزبانی
                                        <span class="event_star star_big" data-starnum="<?php echo e($width5); ?>">
                                               <i></i>
                                            </span>
                                    </div>
                                <?php endif; ?>
                                <div class="col-md-6 text-left">
                                    <?php if(!empty($reserveModel)): ?>
                                        <button data-toggle="modal" data-target="#myModalRate"
                                                onclick="AjaxRateReserve(<?php echo e($reserveModel->id); ?>)"
                                                class="btn btn-default"><i
                                                    class="fa fa-star"></i> ثبت نظر شما
                                        </button>
                                    <?php endif; ?>
                                </div>
                            </div>
                            <?php $__currentLoopData = $hostModel->getRate; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $key => $value): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                <?php if($value->active == 1): ?>
                                    <div class="row">
                                        <div class="col-md-1 col-md-offset-1">
                                            <img src="<?php echo e(asset('frontend/images/user-img.png')); ?>"
                                                 class="img-responsive img-comment" alt="">
                                        </div>
                                        <div class="col-md-10">
                                            <h5><?php echo e($value->getUser->first_name); ?></h5>
                                        </div>
                                        <div class="col-md-11 col-md-offset-1">
                                            <p><?php echo e($value->comment); ?></p>
                                        </div>
                                    </div>
                                    <br/>
                                <?php endif; ?>
                            <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                            <?php if(count($hostModel->getRate) == 0): ?>
                                <div class="row">
                                    <div class="col-md-10 col-md-offset-1">
                                        <p>ثبت نشده</p>
                                    </div>
                                </div>
                            <?php endif; ?>
                        </div>


                        <br/>
                        <br/>
                    </div>

                    <div class="row">
                        اقامتگاه های مشابه
                        <?php if(count($hostLike) > 0): ?>
                            <div class="slider main-slide1">
                                <?php $__currentLoopData = $hostLike; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $key => $value): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                    <div class="item box-host-slide" style="margin: 0px 10px;">
                                        <div class="Box-34">
                                            <a href="<?php echo e(route('DetailHost', ['id' => $value->id])); ?>" class="thumbnail">
                                                <div class="owl-carousel owl-theme owl-slider">
                                                    <?php if(count($value->getGallery) > 0): ?>
                                                        <?php $__currentLoopData = $value->getGallery; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $item => $index): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                                            <div class="item">
                                                                <div class="img-product">
                                                                    <img src="<?php echo e(asset(\App\ImageManager::resize('Uploaded/Gallery/Img/'.$index->img,['width' => 300, 'height' => 200]))); ?>">
                                                                </div>
                                                            </div>
                                                        <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                                                    <?php else: ?>
                                                        <div class="item">
                                                            <div class="img-product">
                                                                <img src="<?php echo e(asset(\App\ImageManager::resize('frontend/images/logo-rent-latin.png',['width' => 300, 'height' => 200]))); ?>">
                                                            </div>
                                                        </div>
                                                    <?php endif; ?>
                                                </div>
                                                <?php if(auth()->check()): ?>
                                                    <div class="quick-btn">
                                                        <div class="list btn-favorite" data-id="<?php echo e($value->id); ?>">
                                                            <p class="list-menu">
                                                                <button type="button" data-toggle="tooltip" title=""
                                                                        onclick="wishlist.add('#');"
                                                                        data-original-title="افزودن به لیست دلخواه">
                                                                    <i class="fas fa-heart" style="color: #fff;"></i>
                                                                </button>
                                                            </p>
                                                        </div>
                                                    </div>
                                                <?php endif; ?>
                                            </a>
                                            <div class="row">
                                                <div class="box-texts">
                                                    <h4 class="product-name">
                                                        <?php echo e($value->name); ?>

                                                    </h4>
                                                    <p class="short-desc">
                                                        <i class="fa fa-location-arrow"></i>
                                                        <?php if($Province = $value->getProvince): ?>
                                                            <?php echo e($Province->name); ?>

                                                        <?php else: ?>
                                                            -
                                                        <?php endif; ?>
                                                        -
                                                        <?php if($Township = $value->getTownship): ?>
                                                            <?php echo e($Township->name); ?>

                                                        <?php else: ?>
                                                            -
                                                        <?php endif; ?>
                                                        -
                                                        <?php echo e($value->district); ?>

                                                    </p>
                                                    <p class="cost-product">

                                                    </p>
                                                    <p class="rate">
                                                        <?php if(count($value->getRate) > 0): ?>
                                                            <?php 
                                                                $total = 0;
                                                                $count = count($value->getRate);
                                                             ?>
                                                            <?php $__currentLoopData = $value->getRate; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $index => $item): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                                                <?php  $total = $total+$item->rate;  ?>
                                                            <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                                                            <?php ($width = ($total/$count)*30); ?>
                                                            <span class="event_star star_small" data-starnum="2">
                                                                <i></i>
                                                            </span>
                                                        <?php else: ?>
                                                            <span class="event_star star_small" data-starnum="2">
                                                               <i></i>
                                                            </span>
                                                        <?php endif; ?>
                                                    </p>
                                                </div>
                                            </div>
                                        </div>

                                    </div>
                                <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>

                            </div>
                        <?php else: ?>
                            <div class="row">
                                <div class="col-md-12">
                                    <div class="alert alert-warning">
                                        <p>اقامتگاه مشابهی در سیستم به ثبت نرسیده است.</p>
                                    </div>
                                </div>
                            </div>
                        <?php endif; ?>
                    </div>


                    <div id="onwe" class="col-md-4 dd form-reserve1">
                        <form class="form-reserve">
                            <div class="row">
                                <div class="col-md-12">
                                    <label class="form-label animation-color">
                                        هر شب از <?php echo e(GetMinPrice($hostModel->id)); ?> تومان
                                        (حداقل تعداد روز رزرو : <?php echo e($hostModel->min_reserve_day); ?>)
                                    </label>
                                </div>
                            </div>

                            <div class="row row-date">
                                <div class="col-md-5">
                                    <label for="InputDateFrom" style="font-weight: 200;">تاریخ سفر</label>
                                    <input type="text" autocomplete="off" readonly
                                           value="<?php if(session()->has('date_from')): ?> <?php echo e(session('date_from')); ?> <?php endif; ?>"
                                           class="form-control input-date-reserve" id="InputDateFrom"
                                           placeholder="تاریخ رفت "/>
                                </div>
                                <div class="col-md-5">
                                    <label for="InputDateTo" style="font-weight: 200;"></label>
                                    <input type="text" autocomplete="off" readonly
                                           value="<?php if(session()->has('date_to')): ?> <?php echo e(session('date_to')); ?> <?php endif; ?>"
                                           class="form-control input-date-reserve" id="InputDateTo"
                                           placeholder="تاریخ برگشت"/>
                                </div>
                                <div class="col-md-1">
                                    <label for="BtnClear">&nbsp;</label>
                                    <i id="BtnClear" class="fas fa-sync-alt"></i>
                                </div>
                            </div>
                            <div class="row box-calendar">
                                <div class="col-md-12">
                                    <?php echo $calendar; ?>

                                </div>
                            </div>
                            <div class="row row-count">
                                <div class="col-md-12">
                                    <label class="input-sm" style="font-weight: 200;">تعداد مهمان</label>
                                </div>
                                <div class="col-md-12">
                                    <div class="box-count-guest">
                                        <div class="sub-box">
                                            <button class="btn-add"><i class="fas fa-plus"></i></button>
                                            <div class="number">
                                                <input type="text" value="1" id="CountGuest"
                                                       class="input-text"
                                                       readonly/>نفر
                                            </div>
                                            <button class="btn-sub"><i class="fas fa-minus"></i></button>
                                        </div>
                                    </div>
                                    <div id="PreFactor">

                                    </div>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-md-12">
                                    <br/>
                                    <div id="MsgCalculatePrice">

                                    </div>
                                </div>
                                <div class="col-md-12">
                                    <?php if(auth()->check()): ?>
                                        <?php if($hostModel->user_id == auth()->user()->id): ?>
                                            <input type="button" id="BtnReserveHost"
                                                   class="btn btn-block btn-reserve disabled"
                                                   value="شما دسترسی به رزرو اقامتگاه خود را ندارید"/>
                                        <?php elseif(auth()->user()->role_id == 1): ?>
                                            <input type="button" id="" class="btn btn-block btn-reserve disabled"
                                                   value="شما دسترسی به رزرو اقامتگاه را ندارید"/>
                                        <?php else: ?>
                                            <input type="button" id="BtnReserveHost" class="btn btn-block btn-reserve"
                                                   value="ارسال درخواست رزرو"/>
                                        <?php endif; ?>
                                    <?php else: ?>
                                        <input type="button" id="BtnReserveHost" class="btn btn-block btn-reserve"
                                               value="ارسال درخواست رزرو"/>
                                    <?php endif; ?>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-md-12">
                                    <div class="text-center">
                                        <p><span id="SpanLoading"></span>ثبت درخواست رزرو کاملا رایگان می باشد</p>
                                        <p><a target="_blank" href="<?php echo e(route('PageContent', ['alias' => 'چگونه-مهمان-شویم؟'])); ?>">راهنمای رزرو</a></p>
                                    </div>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-md-12 text-center">

                                </div>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>

        <!-- Modal -->
        <div class="modal fade" id="myModal1" role="dialog">
            <div class="modal-dialog" style="margin-top: 100px;">

                <!-- Modal content-->
                <div class="modal-content">
                    <div class="modal-header">
                        <button type="button" class="close" data-dismiss="modal">&times;</button>
                        <h5 class="modal-title">قوانین سایت</h5>
                        <img src="<?php echo e(asset('frontend/images/logo.png')); ?>"/>
                    </div>
                    <div class="modal-body">
                        <p>لغو کردن رزرو چنانچه بیش از 48 ساعت مانده به شروع اقامت انجام شود بازگشت کل مبلغ ودیعه بدون
                            هیچ
                            کسری انجام خواهد شد .</p>
                        <p>برای ایام خاص 5 روز قبل از رزرو می باشد .</p>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-default" data-dismiss="modal">متوجه شدم</button>
                    </div>
                </div>

            </div>
        </div>


        
        <div class="modal fade" id="myModalRate" role="dialog" style="margin-top: 80px;">
            <div class="modal-dialog modal-md">
                <!-- Modal content-->
                <div class="modal-content">
                    <div class="modal-header">
                        <button type="button" class="close" data-dismiss="modal">&times;</button>
                        <h5 class="modal-title">ثبت نظر دهی</h5>
                        <img src="<?php echo e(asset('frontend/images/logo.png')); ?>"/>
                    </div>
                    <div class="modal-body" id="ExtraModalRate">

                    </div>
                </div>
            </div>
        </div>


        
        <div class="modal fade" id="myModalMessage" role="dialog" style="margin-top: 80px;">
            <div class="modal-dialog modal-md">
                <!-- Modal content-->
                <div class="modal-content">
                    <div class="modal-header">
                        <button type="button" class="close" data-dismiss="modal">&times;</button>
                        <h5 class="modal-title">ارسال پیام</h5>
                        <img src="<?php echo e(asset('frontend/images/logo.png')); ?>"/>
                    </div>
                    <?php if(auth()->check()): ?>
                        <form action="<?php echo e(route('StoreMessage')); ?>" method="post">
                            <?php echo e(csrf_field()); ?>

                            <input type="hidden" value="<?php echo e($hostModel->getUser->id); ?>" name="receiver_id"/>
                            <div class="modal-body">
                                <div class="row">
                                    <div class="col-md-12">
                                        <div class="form-group">
                                            <label for="">عنوان پیام</label>
                                            <input class="form-control" id="InputTitle" name="title"
                                                   placeholder="عنوان پیام را وارد کنید"/>
                                        </div>
                                        <div class="form-group">
                                            <label for="InputTextArea">متن پیام</label>
                                            <textarea class="form-control" id="InputTextArea" rows="4" name="message"
                                                      placeholder="متن پیام را وارد کنید"></textarea>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="modal-footer">
                                <div class="col-md-12">
                                    <button type="submit" class="btn btn-success">ارسال</button>
                                    <button type="button" class="btn btn-default" data-dismiss="modal">بستن</button>
                                </div>
                            </div>
                        </form>
                    <?php else: ?>
                        <div class="modal-body">
                            <div class="row">
                                <p>برای ارسال پیام ابتدا باید <a style="text-decoration: underline!important"
                                                                 href="<?php echo e(route('Login')); ?>">وارد</a> سایت شوید.</p>
                            </div>
                        </div>
                        <div class="modal-footer">
                            <div class="col-md-12">
                                <button type="button" class="btn btn-default" data-dismiss="modal">بستن</button>
                            </div>
                        </div>
                    <?php endif; ?>
                </div>
            </div>
        </div>


        <!-- Modal -->
        <div class="modal fade" id="myModalRegister" role="dialog">
            <div class="modal-dialog">

                <!-- Modal content-->
                <div class="modal-content" style="margin-top: 100px">
                    <div class="modal-header">
                        <button type="button" class="close" data-dismiss="modal">&times;</button>
                        <h5 class="modal-title">ثبت نام | ورود <span>(لطفا فیلدهای زیر را با دقت پر نمایید)</span></h5>
                        <img src="<?php echo e(asset('frontend/images/logo.png')); ?>"/>
                    </div>
                    <div class="modal-body">
                        <ul class="nav nav-tabs">
                            <li class="tab1 <?php if(!session()->has('login_error')): ?> active <?php endif; ?>"><a data-toggle="tab"
                                                                                                  href="#RegisterForm">ثبت
                                    نام</a></li>
                            <li class="tab2 <?php if(session()->has('login_error')): ?> active <?php endif; ?>"><a data-toggle="tab"
                                                                                                 href="#LoginForm">ورود</a>
                            </li>
                        </ul>
                        <div class="tab-content">
                            <div id="RegisterForm"
                                 class="tab-pane fade <?php if(!session()->has('login_error')): ?> in active <?php endif; ?>">
                                <form action="<?php echo e(route('StoreNewUser')); ?>" method="post" autocomplete="off">
                                    <?php echo e(csrf_field()); ?>

                                    <input type="hidden" value="ajax" name="login_ajax">
                                    <input type="hidden"
                                           value="<?php if(session()->has('date_from')): ?> <?php echo e(session('date_from')); ?> <?php endif; ?>"
                                           name="date_from" id="DateFromRegister">
                                    <input type="hidden"
                                           value="<?php if(session()->has('date_to')): ?> <?php echo e(session('date_to')); ?> <?php endif; ?>"
                                           name="date_to" id="DateToRegister">
                                    <div class="row">
                                        <div class="col-md-6">
                                            <div class="row">
                                                <div class="form-group">
                                                    <div class="input-group">
                                                    <span class="input-group-addon"><i class="far fa-user"
                                                                                       style="font-size: 10px;"></i></span>
                                                        <input type="text" dir="rtl" id="FirstName" name="first_name"
                                                               value="<?php echo e(old('first_name')); ?>" autocomplete="off"
                                                               placeholder="نام خود را وارد کنید"
                                                               class="form-control primary input-sm" autofocus="">
                                                    </div>
                                                    <?php if($errors->has('first_name')): ?>
                                                        <span style="color:red;"><?php echo e($errors->first('first_name')); ?></span>
                                                    <?php endif; ?>
                                                </div>
                                            </div>
                                            <div class="row">
                                                <div class="form-group">
                                                    <div class="input-group">
                                                    <span class="input-group-addon"><i
                                                                class="fas fa-mobile-alt"></i></span>
                                                        <input type="text" dir="rtl" id="Mobile" name="mobile"
                                                               placeholder="شماره موبایل خود را وارد کنید"
                                                               autocomplete="off" class="form-control primary input-sm"
                                                               autofocus="">
                                                    </div>
                                                    <?php if($errors->has('mobile')): ?>
                                                        <span style="color:red;"><?php echo e($errors->first('mobile')); ?></span>
                                                    <?php endif; ?>
                                                </div>
                                            </div>
                                            <div class="row">
                                                <div class="form-group">
                                                    <div class="input-group">
                                                    <span class="input-group-addon"><i class="fa fa-key"
                                                                                       style="font-size: 10px;"></i></span>
                                                        <input dir="rtl" id="Password" type="password" name="password"
                                                               placeholder="رمز عبور خود را وارد کنید"
                                                               autocomplete="off"
                                                               class="form-control primary input-sm" autofocus="">
                                                    </div>
                                                    <?php if($errors->has('password')): ?>
                                                        <span style="color:red;"><?php echo e($errors->first('password')); ?></span>
                                                    <?php endif; ?>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="col-md-6">
                                            <div class="row">
                                                <p class="alert alert-warning text-register" style="font-size: 11px">
                                                    یک رمز عبور باید حداقل ۸ کاراکتر داشته باشد .
                                                    <br/>
                                                    این رمز را برای همیشه به خاطر بسپارید تا هنگام ورود به حساب کاربری
                                                    خود
                                                    استفاده کنید .
                                                </p>
                                            </div>
                                            <div class="row">
                                                <div class="col-md-12">
                                                    <div class="form-group">
                                            <span class="add-on">
                                                <a class="captcha-button" id="captcha">
                                                    <i class="fas fa-sync-alt"></i>
                                                </a>
                                            </span>
                                                        <span class="captcha" id="input-password"
                                                              style="margin-right: 30px;">
                                                <?php echo Captcha::img('inverse'); ?>

                                            </span>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="row">
                                        <div class="col-md-6">
                                            <div class="row">
                                                <div class="form-group">
                                                    <div class="input-group">
                                                    <span class="input-group-addon"><i class="fa fa-key"
                                                                                       style="font-size: 10px;"></i></span>
                                                        <input type="password" dir="rtl" id="InputConfirmPassword"
                                                               name="confirm_password" autocomplete="off"
                                                               placeholder="تایید رمز عبور"
                                                               class="form-control primary input-sm">
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="col-md-6">
                                            <div class="row">
                                                <div class="form-group">
                                                    <div class="input-group">
													<span class="input-group-addon">
														<i class="fas fa-shield-alt" style="font-size: 10px;"></i>
													</span>
                                                        <input type="text" dir="rtl" autocomplete="off"
                                                               id="input-captcha2"
                                                               name="captcha" placeholder="کد امنیتی را وارد کنید"
                                                               class="form-control primary input-sm">
                                                    </div>
                                                    <?php if($errors->has('captcha')): ?>
                                                        <span style="color:red;"><?php echo e($errors->first('captcha')); ?></span>
                                                    <?php endif; ?>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="row">
                                        <div class="col-md-12">
                                            <button type="submit" id="BtnRegister" class="btn btn-register btn-block ">
                                                ثبت
                                                نام
                                            </button>
                                        </div>
                                    </div>
                                </form>
                            </div>
                            <div id="LoginForm"
                                 class="tab-pane fade <?php if(session()->has('login_error')): ?> in active <?php endif; ?>">
                                <form action="<?php echo e(route('Login')); ?>" method="post">
                                    <?php echo e(csrf_field()); ?>

                                    <input type="hidden" value="ajax" name="login_ajax">
                                    <input type="hidden" value="" name="date_from" id="DateFromLogin">
                                    <input type="hidden" value="" name="date_to" id="DateToLogin">
                                    <div class="col-md-12">
                                        <div class="form-group">
                                            <div class="input-group">
                                                <span class="input-group-addon"><i class="fas fa-mobile-alt"></i></span>
                                                <input type="text" dir="rtl" id="Mobile2" name="mobile"
                                                       placeholder="شماره موبایل خود را وارد کنید"
                                                       class="form-control primary input-sm" autofocus="">
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-md-12">
                                        <div class="form-group">
                                            <div class="input-group">
                                            <span class="input-group-addon"><i class="fa fa-key"
                                                                               style="font-size: 10px;"></i></span>
                                                <input type="password" dir="rtl" id="Password" name="password"
                                                       placeholder="کلمه عبور" class="form-control primary input-sm">
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-md-12">
                                        <div class="input-group">
                                        <span class="input-group-addon"><i class="fas fa-shield-alt"
                                                                           style="font-size: 10px;"></i></span>
                                            <input id="input-captcha" name="captcha" type="text"
                                                   class="form-control primary input-sm" autocomplete="off"
                                                   placeholder="کد امنیتی را وارد کنید">
                                        </div>
                                    </div>
                                    <div class="col-md-12">
                                        <div class="form-group icon-form-group">
						                <span class="add-on">
						                    <a class="captcha-button" id="captcha2">
						                        <i class="fas fa-sync-alt"></i>
						                    </a>
						                </span>
                                            <span class="captcha" id="input-password" style="margin-right: 30px;">
											<?php echo Captcha::img('inverse'); ?></span>
                                        </div>
                                    </div>
                                    <div class="row">
                                        <div class="col-md-12">
                                            <button class="btn btn-block btn-login">
                                                ورود
                                            </button>
                                        </div>
                                    </div>
                                </form>
                            </div>
                        </div>
                    </div>
                    
                    
                    
                </div>

            </div>
        </div>


        <button type="button" class="btn btn-info btn-lg" data-toggle="modal" id="BtnShowFactor"
                style="opacity: 0;width: 0px;height: 0px" data-target="#myModalFactor"></button>
        <!-- Modal -->
        <div class="modal fade" id="myModalFactor" role="dialog">
            <div class="modal-dialog modal-lg">

                <!-- Modal content-->
                <div class="modal-content" style="margin-top: 100px">
                    <div class="modal-header">
                        <button type="button" class="close" data-dismiss="modal">&times;</button>
                        <h5 class="modal-title">فاکتور رزرو</h5>
                        <img src="<?php echo e(asset('frontend/images/logo.png')); ?>"/>
                    </div>
                    <div class="modal-body">
                        <div id="ExtraFactorReserve">

                        </div>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-default btn-block btn-reserve" data-dismiss="modal">ارسال
                            درخواست رزرو
                        </button>
                    </div>
                </div>

            </div>
        </div>


        <input type="hidden" id="MonthNumberNow" value="<?php echo e($monthModel->id); ?>"/>

        <div class="display-block"></div>
    <?php $__env->stopSection(); ?>

    <?php $__env->startSection('script'); ?>

        <script src="<?php echo e(asset('frontend/js/edit-detail-host.js')); ?>"></script>

        <!--======= SCROLL-BOTTOM =======-->
            <script>
                $(function () {
                    // use below if you want to specify the path for leaflet's images
                    //L.Icon.Default.imagePath = '@Url.Content("~/Content/img/leaflet")';

                    var curLocation = [0, 0];
                    // use below if you have a model
                    // var curLocation = [@Model.Location.Latitude, @Model.Location.Longitude];

                    if (curLocation[0] == 0 && curLocation[1] == 0) {
                        curLocation = [<?php echo e($hostModel->latitude); ?>, <?php echo e($hostModel->longitude); ?>];
                    }

                    var map = L.map('map-markers').setView(curLocation, 15);

                    L.tileLayer('https://{s}.tile.osm.org/{z}/{x}/{y}.png', {
                        attribution: '&copy; <a href="https://osm.org/copyright">OpenStreetMap</a> contributors'
                    }).addTo(map);

                    map.attributionControl.setPrefix(false);

                    var marker = new L.marker(curLocation, {
                        draggable: 'true'
                    });

                    marker.on('dragend', function (event) {
                        var position = marker.getLatLng();
                        marker.setLatLng(position, {
                            draggable: 'true'
                        }).bindPopup(position).update();
                        $("#Latitude").val(position.lat);
                        $("#Longitude").val(position.lng).keyup();
                    });

                    $("#Latitude, #Longitude").change(function () {
                        var position = [parseInt($("#Latitude").val()), parseInt($("#Longitude").val())];
                        marker.setLatLng(position, {
                            draggable: 'true'
                        }).bindPopup(position).update();
                        map.panTo(position);
                    });

                    // map.addLayer(marker);
                    L.circle([<?php echo e($hostModel->latitude); ?>, <?php echo e($hostModel->longitude); ?>], {radius: 100}).addTo(map);
                })


                $(document).ready(function () {
                    <?php if(session()->has('login_error')): ?>
                    $('#myModalRegister').modal('show');
                    AlertMessage('ورود به سیستم', 'نام کاربری یا رمز عبور اشتباه است.', 'warning');
                    <?php elseif(session()->has('login_status')): ?>
                    $('#myModalRegister').modal('show');
                    AlertMessage('ورود به سیستم', 'کاربر غیر فعال می باشد.', 'warning');
                    <?php elseif(session()->has('active_code')): ?>
                    $('#myModalRegister').modal('show');
                    AlertMessage('ثبت نام', 'کد تاییدیه برای شما ارسال شد، لطفا منتظر بمانید.', 'warning');
                    <?php elseif(session()->has('success_register')): ?>
                    $('#myModalRegister').modal('show');
                    AlertMessage('ثبت نام', 'ثبت نام با موفقیت انجام شد.', 'warning');
                    <?php elseif(session()->has('confirm_password')): ?>
                    $('#myModalRegister').modal('show');
                    AlertMessage('ثبت نام', 'تاییدیه رمز ورود اشتباه می باشد.', 'warning');
                    <?php elseif(session()->has('error_register')): ?>
                    $('#myModalRegister').modal('show');
                    AlertMessage('ثبت نام', 'خطا در ثبت نام، لطفا مجددا تلاش نمایید.', 'warning');
                    <?php endif; ?>
                    <?php if(session()->has('errors')): ?>
                    $('#myModalRegister').modal('show');
                    <?php endif; ?>





                    /** ************************************************** */
                    /** ******************* Reserve Host****************** */
                    /** ************************************************** */

                    $('#BtnReserveHost, .btn-reserve').click(function () {
                        CalculateFactor('reserve');
                    });


                    function AjaxRateReserve(id) {
                        var img = '<div class="text-center"><img style="height:50px;width:auto;" src="<?php echo e(asset('backend/img/img_loading/orange_circles.gif')); ?>" /></div>';
                        $('#ExtraModalRate').html(img);
                        $.ajax({
                            url: "<?php echo e(url('rate/rate-reserve').'/'); ?>" + id,
                            method: "get",
                        }).done(function (returnData) {
                            console.log(returnData);
                            $('#ExtraModalRate').html(returnData);
                        })
                    }


                    $('.image-slide-show').on('click', function () {
                        var src = $(this).attr('src');
                        $('.image-right').attr('src', src);
                    });


                    $(document).on('click', '.btn-add', function () {
                        var textbox = $(this).parent().parent().find('.input-text');
                        var value = textbox[0].defaultValue;
                        if (value >= (<?php echo e($hostModel->count_guest + $hostModel->standard_guest); ?>)) {
                            return false;
                        }
                        textbox[0].defaultValue = parseFloat(value) + 1;
                        CalculateFactor('calculate');
                        return false;
                    });
                    $(document).on('click', '.btn-sub', function () {
                        var textbox = $(this).parent().parent().find('.input-text');
                        var value = textbox[0].defaultValue;
                        if (value == 1) {
                            value = 2;
                        }
                        textbox[0].defaultValue = parseFloat(value) - 1;
                        CalculateFactor('calculate');
                        return false;
                    });




                });

            </script>
<?php $__env->stopSection(); ?>
<?php echo $__env->make('frontend.MasterPage.Layout', array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>