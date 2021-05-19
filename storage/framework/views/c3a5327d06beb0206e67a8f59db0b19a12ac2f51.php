<?php 
    $reserveModel = GetReserveByCode($key);
    $hostModel = GetHostByCode($key);
 ?>
<div class="bx-Residence my-trip row">
    <div class="col-sm-4">
        <div class="slid-1">
            <a class="d-block box-sl slide" href="#">
                <img class="mw-100" src="<?php echo e(asset('Uploaded/Gallery/Img/'.$hostModel->getGalleryFirst->img)); ?>" alt="image" />
                <div class="info-code-1"><span>کد اقامتگاه   :</span><label><?php echo e($hostModel->id + 5000); ?></label></div>
            </a>
        </div>
    </div>
    <div class="col-sm-8">
        <div class="row">
            <div class="col-sm-7 px-0">
                <div class="bx-subject row">
                    <h2 class="col-sm-12 px-0 title-Rsdnc"><?php echo e($hostModel->name); ?></h2>
                    <p class="col-sm-12 loc-Rsdnc"><i class="fas fa-map-marker-alt"></i>
                        <?php echo e($hostModel->getTownship->provinceGet->name); ?> - <?php echo e($hostModel->getTownship->name); ?>

                    </p>
                </div>
                <ul class="col-sm-7 px-0 som-inf">
                    <li class="info-Rsdnc"><span>شماره رزرو  :</span><label><?php echo e($reserveModel[0]->id + 100000); ?></label></li>
                    <li class="info-Rsdnc"><span>وضعیت رزرو  :</span><label>در انتظار تایید </label></li>
                </ul>
                <div class="col-sm-5 paymnt-not">
                    <a class="btn-pay" href="#">پرداخت</a>










                </div>
                <div class="col-sm-12 px-0 d-flex align-items-center host-info">
                    <?php if($reserveModel[0]->getUser->avatar == 'default-user.png'): ?>
                        <img class="pc-host" src="<?php echo e(asset('backend/img/avatar.png')); ?>" alt="avatar">
                    <?php else: ?>
                        <img class="pc-host" src="<?php echo e(asset('Uploaded/User/Profile/'.$reserveModel[0]->getUser->avatar)); ?>" alt="avatar">
                    <?php endif; ?>
                    <h5 class="name-host"><?php echo e($reserveModel[0]->getUser->first_name); ?> <?php echo e($reserveModel[0]->getUser->last_name); ?></h5>
                </div>
            </div>
            <div class="col-sm-5">
                <ul class="each-011">
                    <li class="info-trip">
                        <p class="from">
                            از <?php echo e(GetNameDayOfWeek($reserveModel[0]->week_id)); ?>  <?php echo e(\Morilog\Jalali\Facades\jDate::forge($reserveModel[0]->reserve_date)->format('Y/m/d')); ?>


                            تا <?php echo e(GetNameDayOfWeek($reserveModel[count($reserveModel) - 1]->week_id)); ?>  <?php echo e(\Morilog\Jalali\Facades\jDate::forge(date('Y-m-d H:i:s', strtotime($reserveModel[0]->reserve_date . ' +'. (count($reserveModel) - 1) .' day')))->format('Y/m/d')); ?>

                            به مدت <?php echo e(count($reserveModel)); ?> روز
                        </p>
                        <p>
                            ساعت تحویل : <?php echo e($hostModel->time_enter_from); ?>

                        </p>
                    </li>
                    <li class="info-trip">تعداد <?php echo e($reserveModel[0]->count_person); ?> نفر</li>
                </ul>
                <ul class="each-01">
                    <li class="info-trip">
                        مبلغ کل تسویه :
                        <label>
                            <span class="price">
                                <?php 
                                    $total_price = 0;
                                    foreach ($reserveModel as $key => $value) {
                                        $total_price += $value->final_price;
                                    }
                                 ?>
                                <?php echo e(number_format($total_price)); ?>

                            </span>
                            <span class="unit">تومان</span>
                        </label>
                    </li>


                </ul>
                <ul class="can-click row">
                    <li class="col-sm-6 clck-btn clck-01"><a class="each-clck" data-toggle="modal" data-target="#myModal<?php echo e($reserveModel[0]->id); ?>"> پیام به میزبان</a></li>
                    <li class="col-sm-6 clck-btn clck-01"><a class="each-clck" href="#"> جزئیات رزرو</a></li>
                </ul>
            </div>
        </div>
    </div>
</div>

<div class="modal" id="myModal<?php echo e($reserveModel[0]->id); ?>">
    <div class="modal-dialog">
        <div class="modal-content">

            <!-- Modal Header -->
            <div class="modal-header">
                <h4 class="modal-title">ارسال پیام به مهمان</h4>
                <button type="button" class="close" data-dismiss="modal">&times;</button>
            </div>

            <!-- Modal body -->
            <div class="modal-body">
                <form action="<?php echo e(route('StoreMessageForHostUser')); ?>" method="post">
                    <?php echo e(csrf_field()); ?>

                    <div class="row">
                        <div class="col-md-12">
                            <div class="form-group">
                                <label for="TextAreaMessage">متن پیام</label>
                                <textarea id="TextAreaMessage" placeholder="متن پیام به مهمان را وارد کنید" class="form-control" name="message"></textarea>
                            </div>
                            <div class="form-group">
                                <button type="submit" class="btn btn-success">
                                    ثبت و ارسال
                                </button>
                            </div>
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>