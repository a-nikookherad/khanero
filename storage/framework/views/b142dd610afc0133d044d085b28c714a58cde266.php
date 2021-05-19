<table cellpadding="0" cellspacing="0" border="0" class="table table-bordered editable-datatable">
    <thead>
        <tr>
            <th>ردیف</th>
            <th>تاریخ درخواست</th>
            <th>روز هفته</th>
            <th>قیمت</th>
            <th>روز ویژه</th>
            <th>قیمت روز ویژه</th>
            <th>درصد تخفیف</th>
            <th>نفرات اضافی</th>
            <th>قیمت نهایی</th>
        </tr>
    </thead>
    <tbody>
    <?php 
        $total_price = 0;
        $total_price1 = 0;
     ?>
        <?php $__currentLoopData = $reserveModel; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $key => $value): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
            <tr class="text-center">
                <td><?php echo e($key++); ?></td>
                <td><?php echo e(\Morilog\Jalali\Facades\jDate::forge($value->reserve_date)->format('Y/m/d')); ?></td>
                <td><?php echo e(GetNameDayOfWeek($value['week_id'])); ?></td>
                <td><?php echo e(number_format($value->day_price)); ?></td>
                <td><?php if($value->special == 1): ?> بله <?php else: ?> خیر <?php endif; ?></td>
                <td><?php if($value->special == 1): ?> <?php echo e(number_format($value->special_price)); ?> <?php else: ?> -- <?php endif; ?></td>
                <td><?php echo e($value->percent); ?> %</td>
                <td><?php echo e(number_format($value->extra_price_person)); ?></td>
                <td><?php echo e(number_format($value->final_price)); ?></td>
            </tr>
            <?php 
                $total_price = $total_price + $value->final_price;
             ?>
        <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
        <tr>
            <td colspan="1" class="text-center"><?php echo e($key); ?></td>
            <td colspan="4" class="text-center text-danger">قیمت کل</td>
            <td colspan="4" class="text-danger text-left"><?php echo e(number_format($total_price)); ?> تومان</td>
        </tr>
    </tbody>
</table>
<?php if($value->status == -2 && $value->description == '' && $value->user_id == auth()->user()->id): ?>
    <form action="<?php echo e(route('DescriptionCancel')); ?>" method="post" id="FormCanceledDescription">
        <?php echo e(csrf_field()); ?>

        <input type="hidden" value="<?php echo e($value->group_code); ?>" name="group_code" />
        <div class="row">
            <div class="col-md-12">
                <div class="form-group">
                    <label for="">
                        دلیل انصراف از رزرو خود را بنویسید
                    </label>
                    <textarea name="description" placeholder="توضیحات" rows="3" class="form-control description-canceled"></textarea>
                </div>
            </div>
            <div class="col-md-12">
                <button type="button" id="BtnCanceledDescription" class="btn btn-default btn-block">ثبت</button>
            </div>
        </div>
    </form>
    <script>
        $('#BtnCanceledDescription').click(function () {
            if($('.description-canceled').val() != '') {
                $('#FormCanceledDescription').submit();
            } else {
                alert('توضیحات انصراف نمیتواند خالی باشد');
            }
        });
    </script>
<?php elseif($value->status == -2 && $value->description != ''): ?>
    <p><span class="text-danger">توضیحات انصراف :</span> <?php echo e($value->description); ?></p>
<?php endif; ?>


<?php if($value->step == 3): ?>
    <?php if($value->user_id == auth()->user()->id): ?>
        <p><span class="text-info">نام میزبان :</span> <?php echo e($value->getHost->getUser->first_name. ' ' .$value->getHost->getUser->last_name); ?></p>
        <p><span class="text-info">آدرس :</span> <?php echo e($value->getHost->address); ?></p>
        <p><span class="text-info">تلفن تماس :</span> <?php echo e($value->getHost->getUser->mobile); ?></p>
        <div class="row box-icon section">
            <link rel="stylesheet" href="https://unpkg.com/leaflet@1.4.0/dist/leaflet.css"
                  integrity="sha512-puBpdR0798OZvTTbP4A8Ix/l+A4dHDD0DGqYW6RQ+9jxkRFclaxxQb/SJAWZfWAkuyeQUytO7+7N4QKrDh+drA=="
                  crossorigin=""/>
            <div class="col-md-12 text-center">
                <div id="map-markers" style="height:300px"></div>
            </div>
            <script src="http://www.rentt.ir/frontend/js/jquery-3.2.1.min.js"></script>
            <script src="https://unpkg.com/leaflet@1.4.0/dist/leaflet.js"
                    integrity="sha512-QVftwZFqvtRNi0ZyCtsznlKSWOStnDORoefr1enyq5mVL4tmKB3S/EnC3rRJcxCPavG10IcrVGSmPh6Qw5lwrg=="
                    crossorigin=""></script>
    
            <script>
                $(function () {
                    var curLocation = [0, 0];
                    if (curLocation[0] == 0 && curLocation[1] == 0) {
                        curLocation = [36.5361 , 52.0038];
                    }
                    var map = L.map('map-markers').setView(curLocation, 14);
                    L.tileLayer('http://{s}.tile.osm.org/{z}/{x}/{y}.png', {
                        attribution: ''
                    }).addTo(map);
                    map.attributionControl.setPrefix(false);
                    var marker = new L.marker(curLocation, {
                        draggable: false
                    });
                    map.addLayer(marker);
                })
            </script>
        </div>
    <?php else: ?>
        <p><span class="text-info">نام میهمان :</span> <?php echo e($value->getUser->first_name. ' ' .$value->getUser->last_name); ?></p>
        <p><span class="text-info">تلفن تماس :</span> <?php echo e($value->getUser->mobile); ?></p>
        <div class="row box-icon section">
            <link rel="stylesheet" href="https://unpkg.com/leaflet@1.4.0/dist/leaflet.css"
                  integrity="sha512-puBpdR0798OZvTTbP4A8Ix/l+A4dHDD0DGqYW6RQ+9jxkRFclaxxQb/SJAWZfWAkuyeQUytO7+7N4QKrDh+drA=="
                  crossorigin=""/>
            <div class="col-md-12 text-center">
                <div id="map-markers" style="height:300px"></div>
            </div>
            <script src="http://www.rentt.ir/frontend/js/jquery-3.2.1.min.js"></script>
            <script src="https://unpkg.com/leaflet@1.4.0/dist/leaflet.js"
                    integrity="sha512-QVftwZFqvtRNi0ZyCtsznlKSWOStnDORoefr1enyq5mVL4tmKB3S/EnC3rRJcxCPavG10IcrVGSmPh6Qw5lwrg=="
                    crossorigin=""></script>
            <script>
                $(function () {
                    var curLocation = [0, 0];
                    if (curLocation[0] == 0 && curLocation[1] == 0) {
                        curLocation = [36.5361 , 52.0038];
                    }
                    var map = L.map('map-markers').setView(curLocation, 14);
                    L.tileLayer('http://{s}.tile.osm.org/{z}/{x}/{y}.png', {
                        attribution: ''
                    }).addTo(map);
                    map.attributionControl.setPrefix(false);
                    var marker = new L.marker(curLocation, {
                        draggable: false
                    });
                    map.addLayer(marker);
                })
            </script>
        </div>
    <?php endif; ?>
<?php endif; ?>
