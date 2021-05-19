<div class="hand-col px-0 bx-p">
    <div class="box-01">
        <ul class="abs-item">
            <li><a class="itm-social" href="#"><i class="far fa-heart"></i></a></li>
        </ul>
        <a class="lnk-bx" href="<?php echo e(route('DetailHost', ['id' => $value->id])); ?>">
            <img src="<?php echo e(asset('Uploaded/Gallery/Img/'. $value->getGalleryFirst->img)); ?>" alt="logo">
        </a>
        <ul class="contact-01">
            <li class="itm-01 row align-items-center pt-0">
                <span class="col-sm-8 px-0 address"><?php echo e($value->getProvince->name); ?> <i class="gp-01">,</i> <?php echo e($value->getTownship->name); ?></span>
                <span class="col-sm-4 px-0 rating-home d-flex align-items-center">
                                            <span class="idea">( <?php echo e(GetCountReserve($value->id)); ?> نظر )</span>
                                            <span class="rate">4/8</span>
                                            <span class="star"><i class="fas fa-star"></i></span>
                                        </span>
            </li>
            <li class="itm-01 main-name"><?php echo e($value->name); ?></li>
            <li class="itm-01 some-info bord-btm">
                <span class="prop">آپارتمان <?php echo e(count($value->getRoom)); ?> خواب</span>,
                <span class="prop">تا <?php echo e($value->standard_guest + $value->count_guest); ?> نفر</span>
            </li>
            <li class="ftr-01 row align-items-center">
                <span class="col-sm-2 num-reserve"><?php echo e(GetCountReserve($value->id)); ?> رزرو</span>
                <span class="col-sm-10 px-0 night-price d-flex align-items-center">
                                            هر شب از
                                            <span class="num-price">300,000</span>
                                            تومان
                                        </span>
            </li>
        </ul>
    </div>
</div>