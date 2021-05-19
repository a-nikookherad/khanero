<div class="item">
    <a href="<?php echo e(route('DetailHost', ['id' => $value->id])); ?>">
    <div class="item1">
            <img src="<?php echo e(asset('Uploaded/Gallery/Img/'. $value->getGalleryFirst->img)); ?>" alt="logo">

        <div class="icon-item">

            <span class="favorite"><i class="far fa-heart"></i></span>
            <div class="card__share">
                <div class="card__social">
                    <a class="share-icon whatsapp" href="#">
                        <span class="fab fa-whatsapp"></span>
                    </a>
                    <a class="share-icon telegram" href="#">
                        <span class="fab fa-telegram-plane"></span>
                    </a>
                    <a class="share-icon instagram" href="#">
                        <span class="fab fa-instagram"></span>
                    </a>
                </div>
                <a id="share" class="share-toggle share-icon" href="#">

                </a>
            </div>

        </div>
    </div>
    <div class="description col-xs-12">
        <div class="location">
            <i class="fas fa-map-marker-alt"></i>
            <span>
                <?php echo e($value->getProvince->name); ?> ، <?php echo e($value->getTownship->name); ?>

            </span>
        </div>
        <h4>
            <a href="">
                <?php echo e($value->title); ?>

            </a>
        </h4>
        <div class="description1">
            <div class="row">
                <div class="col-xs-12 col-sm-8 padding1">
                    <div class="price-item">
                        هر شب از
                        <span><?php echo e(number_format(GetMinPrice($value->id))); ?></span>
                        تومان
                    </div>
                </div>
            </div>
            <ul class="items-des">
                <li>
                    <i class="fas fa-bed"></i>
                    <span>
                        <?php echo e($value->count_room); ?> خوابه
                    </span>
                </li>
                <li>
                    <i class="fa fa-user"></i>
                    <span> تا <?php echo e($value->count_guest); ?> نفر</span>
                </li>
            </ul>



            <ul class="starcomment">
                <li>
                    <i class="fas fa-star"></i><i class="fas fa-star"></i><i
                            class="fas fa-star"></i>
                    <i class="far fa-star"></i><i class="far fa-star"></i>
                </li>
                <li>
                    <span> ( 3 نظر) </span>
                    <span> مهمان نواز</span>
                </li>
                <li class="buy">
                    <a target="_blank" href="<?php echo e(route('DetailHost', ['id' => $value->id])); ?>">
                        درخواست رزرو
                    </a>
                </li>
            </ul>

        </div>
    </div>
    </a>
</div>