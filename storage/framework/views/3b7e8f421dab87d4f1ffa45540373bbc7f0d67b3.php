<?php $__env->startSection('title'); ?>
    <?php echo e(TitlePage('اقامتگاه های من')); ?>

<?php $__env->stopSection(); ?>

<?php $__env->startSection('style'); ?>
    <link rel="stylesheet" href="<?php echo e(asset('backend/css/datepicker.css')); ?>">
    <link rel="stylesheet" href="<?php echo e(asset('backend/css/bootstrap-datepicker.min.css')); ?>"/>
    <link rel="stylesheet" href="<?php echo e(asset('backend/css/dataTables.bootstrap.css')); ?>">
    <link rel="stylesheet" href="<?php echo e(asset('backend/css/TableTools.css')); ?>">
    <style>
        .bx-Residence .btn-vzyt-2 {
            display: inline-block;
            width: 100%;
            border-radius: 0 0 7px 7px;
            text-align: center;
            padding: 9px 0;
            color: #31ab44;
            border: 1px solid #e4f9c2;
            position: absolute;
            bottom: 0;
            background: #c1f994;
            font-size: 15px;
        }

        li.li-host {
            background: #ffe9cf;
        }
        .host-id-box {
            padding: 3px 6px;
            background: #f7f7f7;
            border: 1px solid #d4d4d4;
            border-radius: 5px;
            font-size: 11px;
            color: #8e8e8e;
        }
        .status-host {
            margin-top: 30px;
        }
    </style>
<?php $__env->stopSection(); ?>

<?php $__env->startSection('content'); ?>
    
    
    
    
    
    <div class="row">
        <div class="col-md-12">
            <?php echo $__env->make('message.Message', array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>
            <?php echo $__env->make('message.ErrorReporting', array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>
        </div>
    </div>
    <div class="row">
        <div class="col-md-12">
            <div class="panel panel-default">
                <div class="panel-heading">
                    <h3 class="panel-title">اقامتگاه های من</h3>

                </div>
                <div class="panel-body">
                    <!--                    <ul class="nav nav-tabs">-->
                    <!--                        <li class="active"><a data-toggle="tab" href="#menu1">نمایش اقامتگاه ها</a></li>-->
                <!---->
                <!---->
                <!---->
                    <!--                    </ul>-->

                    <form action="<?php echo e(route('SearchIndexHost')); ?>" method="post">
                        <?php echo e(csrf_field()); ?>

                        <div class="head-serach row">
                            <div class="col-sm-2 p-1 p-md-0 d-flex align-items-center vazyat-agahi">
                                <!--<label class="ttle-row">وضعیت:</label>-->
                                <select class="same-styk" name="type">
                                    <option value="all" <?php if($type == 'all'): ?> selected <?php endif; ?>>همه اقامتگاه ها</option>
                                    <option value="review" <?php if($type == 'review'): ?> selected <?php endif; ?>>در حال بررسی</option>
                                    <option value="confirm" <?php if($type == 'confirm'): ?> selected <?php endif; ?>>منتشر شده</option>
                                    <option value="imperfect" <?php if($type == 'imperfect'): ?> selected <?php endif; ?>>اطلاعات ناقص</option>
                                    <option value="disable" <?php if($type == 'disable'): ?> selected <?php endif; ?>>غیر فعال</option>
                                </select>
                            </div>
                            <div class="col-md-3 p-1 p-md-2">
                                <div class="form-group">
                                    <input type="text" class="form-control" name="id" value="<?php if(isset($request)): ?><?php echo e($request->id); ?><?php endif; ?>" id="InputId" placeholder="جستجو ID">
                                </div>
                            </div>
                            <div class="col-md-3 p-1 p-md-2">
                                <div class="form-group">
                                    <input type="text" class="form-control" name="mobile" value="<?php if(isset($request)): ?><?php echo e($request->mobile); ?><?php endif; ?>" id="InputMobile" placeholder="جستجو شماره موبایل">
                                </div>
                            </div>
                            <div class="col-md-1 p-1 p-md-2">
                                <div class="form-group">
                                    <button type="submit" class="btn btn-default">جستجو</button>
                                </div>
                            </div>
                            <?php if(auth()->user()->role_id != 1): ?>
                                <div class="col-sm-3 px-0">
                                    <a class="add-new-home" href="<?php echo e(route('CreateHost')); ?>">ثبت اقامتگاه جدید</a>
                                </div>
                            <?php endif; ?>
                        </div>
                    </form>
                    <div class="tab-content1">
                        <div id="menu1" class="tab-pane fade in active">
                            <?php if(count($hostModel) == 0 && auth()->user()->role_id != 1): ?>
                                <div class="row">
                                    <div class="col-md-12">
                                        <a href="<?php echo e(route('CreateHost')); ?>" class="btn btn-default">ثبت اقامتگاه جدید</a>
                                    </div>
                                </div>
                            <?php else: ?>
                                <?php $__currentLoopData = $hostModel; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $key => $value): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                    <div class="bx-Residence row">
                                        <div class="col-sm-4">
                                            <div class="slid-1">
                                                <a class="d-block box-sl slide" href="#">
                                                    <?php if(!empty($value->getGalleryFirst)): ?>
                                                        <img class="mw-100"
                                                             src="<?php echo e(asset('Uploaded/Gallery/Img/'.$value->getGalleryFirst->img)); ?>"
                                                             alt="image"/>
                                                    <?php else: ?>
                                                        <img class="mw-100"
                                                             src="http://nonegar14.ir/jahesh/images/pc7.jpg"
                                                             alt="image"/>
                                                    <?php endif; ?>
                                                    <?php if($value->status == 0): ?>
                                                        <li class="vzyt-Rsdnc">
                                                            <div class="btn-vzyt">اطلاعات ناقص</div>
                                                        </li>
                                                    <?php elseif($value->status == 1): ?>
                                                        <li class="vzyt-Rsdnc">
                                                            <div class="btn-vzyt">در حال بررسی</div>
                                                        </li>
                                                    <?php elseif($value->status == 2): ?>
                                                        <li class="vzyt-Rsdnc">
                                                            <div class="btn-vzyt-2">منتشر شده</div>
                                                        </li>
                                                    <?php elseif($value->status == -1): ?>
                                                        <li class="vzyt-Rsdnc">
                                                            <div class="btn-vzyt">غیر فعال</div>
                                                        </li>
                                                    <?php endif; ?>
                                                </a>
                                            </div>

                                        </div>
                                        <div class="col-sm-8">
                                            <div class="row">
                                                <div class="col-sm-7">
                                                    <div class="bx-subject row">
                                                        <h2 class="col-sm-12 px-0 title-Rsdnc"><?php echo e($value->name); ?></h2>
                                                        <p class="col-sm-12 loc-Rsdnc"><i
                                                                    class="fas fa-map-marker-alt"></i><?php echo e($value->getProvince->name . ' | ' .$value->getTownship->name); ?>

                                                        </p>

                                                    </div>

                                                </div>
                                                <div class="col-sm-5">
                                                    <li class="col-sm-12 date-Rsdnc"><span>آخرین بروزرسانی :</span>
                                                        <?php echo e(\Morilog\Jalali\Facades\jDate::forge($value->updated_at)->format('Y/m/d')); ?>

                                                    </li>

                                                </div>
                                                <div class="row">
                                                    <div class="col-sm-7">
                                                        <ul class="list-item row">
                                                            <li class="col-sm-12 info-Rsdnc">
                                                                <div class="host-id-box">
                                                                    <span>کد اقامتگاه :</span><label><?php echo e($value->id + 5000); ?></label>
                                                                </div>
                                                            </li>
                                                            <?php if(auth()->user()->role_id == 1): ?>
                                                                <li class="col-sm-12 info-Rsdnc">
                                                                    <div class="form-group">
                                                                        <select class="form-control status-host" data-host-id="<?php echo e($value->id); ?>">
                                                                            <option value="0" <?php if($value->status == 0): ?> selected <?php endif; ?>>اطلاعات ناقص</option>
                                                                            <option value="1" <?php if($value->status == 1): ?> selected <?php endif; ?>>در حال بررسی</option>
                                                                            <option value="2" <?php if($value->status == 2): ?> selected <?php endif; ?>>منتشر شده</option>
                                                                            <option value="-1" <?php if($value->status == -1): ?> selected <?php endif; ?>>غیر فعال</option>
                                                                        </select>
                                                                    </div>
                                                                </li>
                                                                <li class="col-sm-12 info-Rsdnc" style="margin-top: 15px">
                                                                    <button class="btn btn-default" id="btnDescriptionHost<?php echo e($key+1); ?>" onclick="ajaxDescriptionHost('<?php echo e($value->id); ?>');">توضیحات مدیریت</button>
                                                                </li>
                                                                <?php if($value->description_admin != ''): ?>
                                                                    <li class="col-sm-12 info-Rsdnc" style="margin-top: 15px">
                                                                        <p>
                                                                            توضیحات مدیریت : <?php echo e($value->description_admin); ?>

                                                                        </p>
                                                                    </li>
                                                                <?php endif; ?>
                                                            <?php endif; ?>
                                                        </ul>
                                                    </div>
                                                    <div class="col-sm-5">
                                                        <ul class="list-item row">
                                                            <li class="col-sm-4 info-Rsdnc">رزرو آنی :</li>
                                                            <li class="col-sm-6 info-Rsdnc"><input type="checkbox"
                                                                                                   name="ne"
                                                                                                   data-toggle="modal"
                                                                                                   data-target="#myModal<?php echo e($value->id); ?>"
                                                                                                   class="osman InputClosestTimeReserve"
                                                                                                   <?php if($value->getInstantBooking != null): ?> checked <?php endif; ?>>
                                                            </li>
                                                            <li class="col-sm-4 info-Rsdnc">لحظه آخری :</li>
                                                            <li class="col-sm-6 info-Rsdnc"><input type="checkbox"
                                                                                                   name="ne"
                                                                                                   data-toggle="modal"
                                                                                                   data-target="#myModal2000<?php echo e($value->id); ?>"
                                                                                                   class="osman InputLastMinuteReserve"
                                                                                                   <?php if($value->getLastMinuteReserve != null && $value->getLastMinuteReserve->date == date('Y-m-d 00:00:00')): ?> checked <?php endif; ?>>
                                                            </li>
                                                        </ul>
                                                    </div>
                                                </div>
                                            </div>

                                            <!-- Modal Closest Time Reserve -->
                                            <div class="modal fade" id="myModal<?php echo e($value->id); ?>" role="dialog">
                                                <div class="modal-dialog modal-sm">
                                                    <!-- Modal content-->
                                                    <div class="modal-content">
                                                        <div class="modal-header">
                                                            <button type="button" class="close" data-dismiss="modal">
                                                                &times;
                                                            </button>
                                                            <h4 class="modal-title">رزرو آنی</h4>
                                                        </div>
                                                        <div class="modal-body">
                                                            <form class="" method="post"
                                                                  action="<?php echo e(route('StoreClosestTimeReserve')); ?>">
                                                                <?php echo e(csrf_field()); ?>

                                                                <input type="hidden" name="host_id"
                                                                       value="<?php echo e($value->id); ?>">
                                                                <div class="row">
                                                                    <div class="col-md-12">
                                                                        <div class="alert alert-info">
                                                                            <p>لطفا تاریخ شروع و پایان را برای تایید
                                                                                خودکار رزرو مشخص کنید</p>
                                                                        </div>
                                                                    </div>
                                                                    <div class="col-md-12">
                                                                        <div class="form-group">
                                                                            <input type="text" autocomplete="off"
                                                                                   readonly
                                                                                   value="<?php if($value->getInstantBooking != null): ?> <?php echo e(\Morilog\Jalali\Facades\jDate::forge($value->getInstantBooking->from_date)->format('Y/m/d')); ?> <?php endif; ?>"
                                                                                   placeholder="تاریخ شروع"
                                                                                   name="from_date" id=""
                                                                                   class="form-control InputFromDate">
                                                                        </div>
                                                                        <div class="form-group">
                                                                            <input type="text" autocomplete="off"
                                                                                   readonly
                                                                                   value="<?php if($value->getInstantBooking != null): ?> <?php echo e(\Morilog\Jalali\Facades\jDate::forge($value->getInstantBooking->to_date)->format('Y/m/d')); ?> <?php endif; ?>"
                                                                                   placeholder="تاریخ پایان"
                                                                                   name="to_date" id=""
                                                                                   class="form-control InputToDate">
                                                                        </div>
                                                                        <div class="form-group">
                                                                            <label>حداقل روز قابل رزرو برای تایید
                                                                                خودکار</label>
                                                                            <div class="each-Qt number">
                                                                                <span class="icon-number"></span>
                                                                                <span class="plus"><i
                                                                                            class="fas fa-plus"></i></span>
                                                                                <input type="text"
                                                                                       value="<?php if($value->getInstantBooking != null): ?> <?php echo e($value->getInstantBooking->min_day_reserve); ?> <?php else: ?> 1 <?php endif; ?>"
                                                                                       name="min_day_reserve"
                                                                                       class="input-text"
                                                                                       id="InputMinDayReserve"
                                                                                       readonly>
                                                                                <span class="minus"><i
                                                                                            class="fas fa-minus"></i></span>
                                                                            </div>
                                                                        </div>
                                                                        <div class="form-group">
                                                                            <button id=""
                                                                                    class="btn btn-success btn-block BtnClosestTimeReserve"
                                                                                    type="button">تایید
                                                                            </button>
                                                                        </div>
                                                                        <div class="form-group">
                                                                            <a href="<?php echo e(route('DeleteClosestTimeReserve', ['id' => $value->id])); ?>"
                                                                               class="btn btn-danger btn-block">غیر فعال
                                                                                کردن</a>
                                                                        </div>

                                                                    </div>
                                                                </div>
                                                            </form>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>


                                            <!-- Modal Last Minute Reserve  -->
                                            <div class="modal fade" id="myModal2000<?php echo e($value->id); ?>" role="dialog">
                                                <div class="modal-dialog modal-sm">
                                                    <!-- Modal content-->
                                                    <div class="modal-content">
                                                        <div class="modal-header">
                                                            <button type="button" class="close" data-dismiss="modal">&times;
                                                            </button>
                                                            <h4 class="modal-title">قیمت لحظه آخری</h4>
                                                        </div>
                                                        <div class="modal-body">
                                                            <form class="" method="post" id="Form<?php echo e($value->id); ?>"
                                                                  action="<?php echo e(route('StoreLastMinuteReserve')); ?>">
                                                                <?php echo e(csrf_field()); ?>

                                                                <input type="hidden" name="host_id" value="<?php echo e($value->id); ?>">
                                                                <div class="row">
                                                                    <div class="col-md-12">
                                                                        <div class="form-group">
                                                                            <input type="text" onkeyup="Seprator(this);" autocomplete="off" placeholder="قیمت" name="price" value="<?php if($value->getLastMinuteReserve != null && $value->getLastMinuteReserve->date == date('Y-m-d 00:00:00')): ?> <?php echo e(number_format($value->getLastMinuteReserve->price)); ?> <?php endif; ?>"
                                                                                   id="" class="form-control InputPrice">
                                                                        </div>
                                                                        <div class="form-group">
                                                                            <input type="text" onkeyup="Seprator(this);" placeholder="هر نفر اضافه" name="price_person" value="<?php if($value->getLastMinuteReserve != null && $value->getLastMinuteReserve->date == date('Y-m-d 00:00:00')): ?> <?php echo e(number_format($value->getLastMinuteReserve->price_person)); ?> <?php endif; ?>"
                                                                                   id="" class="form-control InputPricePerson">
                                                                        </div>
                                                                        <div class="form-group">
                                                                            <button id=""
                                                                                    class="btn btn-success btn-block BtnLastMinuteReserve" data-id="<?php echo e($value->id); ?>"
                                                                                    type="button">تایید
                                                                            </button>
                                                                        </div>
                                                                        <div class="form-group">
                                                                            <a href="<?php echo e(route('DeleteLastMinuteReserve', ['id' => $value->id])); ?>"
                                                                               class="btn btn-danger btn-block">لغو عملیات</a>
                                                                        </div>
                                                                    </div>
                                                                </div>
                                                            </form>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>


                                            <ul class="can-click text-left">
                                                <li class="clck-btn clck-02">
                                                    <a class="each-clck" href="<?php echo e(route('IndexPersonalize', ['id' => $value->id])); ?>">ویرایش تقویم</a>
                                                </li>
                                                <li class="clck-btn clck-01">
                                                    <a class="each-clck" href="<?php echo e(route('EditHost', ['id' => $value->id, 'step' => 1])); ?>">ویرایش اقامتگاه</a>
                                                </li>
                                                <?php if($value->status == 1): ?>
                                                    <li class="clck-btn clck-03">
                                                        <a class="each-clck" href="<?php echo e(route('DetailHost', ['id' => $value->id])); ?>">پیش نمایش</a>
                                                    </li>
                                                <?php endif; ?>
                                            </ul>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                    <?php endif; ?>
                </div>
            </div>
        </div>
    </div>
    <div class="modal" id="myModalDescription">
        <div class="modal-dialog">
            <div class="modal-content">
                <!-- Modal Header -->
                <div class="modal-header">
                    <h5 class="modal-title">ثبت توضیحات اقامتگاه</h5>
                    <button type="button" class="close" data-dismiss="modal">&times;</button>
                </div>
                <div id="ExtraEdit">
                    <div class="modal-body">
                        <form action="<?php echo e(route('StoreDescriptionHost')); ?>" method="post">
                            <?php echo e(csrf_field()); ?>

                            <input type="hidden" id="HostId" name="host_id">
                            <div class="row">
                                <div class="col-md-12">
                                    <div class="form-group">
                                        <label for="TextAreaDescription">توضیحات</label>
                                        <textarea class="form-control" id="TextAreaDescription" name="description" placeholder="توضیحات را وارد کنید(قابل نمایش فقط برای مدیریت)" rows="5"></textarea>
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <button type="submit" class="btn btn-success btn-block">ثبت ویرایش</button>
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <button type="button" class="btn btn-danger btn-block" data-dismiss="modal">بستن</button>
                                    </div>
                                </div>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>

<?php $__env->stopSection(); ?>


<?php $__env->startSection('script'); ?>
    <script src="<?php echo e(asset('frontend/js/script.js')); ?>" type="text/javascript"></script>
    <script type="text/javascript" src="<?php echo e(asset('backend/js/jquery.dataTables.min.js')); ?>"></script>
    <script type="text/javascript" src="<?php echo e(asset('backend/js/TableTools.min.js')); ?>"></script>
    <script type="text/javascript" src="<?php echo e(asset('backend/js/dataTables.bootstrap.js')); ?>"></script>
    <script type="text/javascript" src="<?php echo e(asset('backend/js/editable-datatables.js')); ?>"></script>
    <script src="<?php echo e(asset('backend/js/bootstrap-datepicker.min.js')); ?>"></script>
    <script src="<?php echo e(asset('backend/js/bootstrap-datepicker.fa.min.js')); ?>"></script>
    <!--//============ Multi-gallery-slider-->
    <script>
        $(document).ready(function () {
            $('.InputClosestTimeReserve , .InputLastMinuteReserve').click(function (e) {
                e.preventDefault();
            });
            $('.minus').click(function () {
                var $input = $(this).parent().find('input');
                if ($input.val() == 1) {
                    return false;
                }
                var count = parseInt($input.val()) - 1;
                count = count < 1 ? 0 : count;
                $input.val(count);
                $input.change();
                return false;
            });
            $('.plus').click(function () {
                var $input = $(this).parent().find('input');
                $input.val(parseInt($input.val()) + 1);
                $input.change();
                return false;
            });
        });
        $(".InputFromDate").datepicker({
            changeMonth: true,
            changeYear: true,
            isRTL: true,
            dateFormat: "yy/mm/dd",
            EnableTimePicker: true,
            yearRange: '1399:1405',
            // defaultDate: '1370/01/01',
        });
        $(".InputToDate").datepicker({
            changeMonth: true,
            changeYear: true,
            isRTL: true,
            dateFormat: "yy/mm/dd",
            EnableTimePicker: true,
            yearRange: '1399:1405',
            // defaultDate: '1370/01/01',
        });

        function ajaxDescriptionHost(id) {
            $('#HostId').val(id);
            $('#myModalDescription').modal('show');
        }

        function fixNumbers(str) {
            var
                persianNumbers = [/۰/g, /۱/g, /۲/g, /۳/g, /۴/g, /۵/g, /۶/g, /۷/g, /۸/g, /۹/g];
            EnNumbers = [/0/g, /1/g, /2/g, /3/g, /4/g, /5/g, /6/g, /7/g, /8/g, /9/g];
            if (typeof str === 'string') {
                for (var i = 0; i < 10; i++) {
                    str = str.replace(persianNumbers[i], i).replace(EnNumbers[i], i);
                }
            }
            return str;
        }

        function bala(data) {
            let tarikhShoroo = fixNumbers(data).split('/');
            tarikhShoroo = tarikhShoroo[0] + tarikhShoroo[1] + tarikhShoroo[2];
            return parseInt(tarikhShoroo);
        }

        function parseNumberCustom(number_string) {
            var new_number = parseInt(number_string.indexOf(',') >= 10 ? number_string.split(',')[0] : number_string.replace(/[^0-9\.]/g, ''));
            return new_number;
        }


        $('.BtnClosestTimeReserve').click(function () {
            if ($(this).closest('form').find('.InputFromDate').val() != '' && $(this).closest('form').find('.InputToDate').val() != '') {
                if (bala($(this).closest('form').find('.InputFromDate').val()) >= $(this).closest('form').find('.InputToDate').val() != '') {
                    AlertToast('رزرو آنی', 'تاریخ شروع نباید مساوی یا بزرگتر از تاریخ پایان باشد', 'warning');
                    return false;
                }
                $(this).closest('form').submit();
            } else {
                AlertToast('رزرو آنی', 'وارد کردن تاریخ اجباری می باشد', 'warning');
                return false;
            }
        });


        $('.BtnLastMinuteReserve').click(function () {
            var price = parseNumberCustom($(this).closest('form').find('.InputPrice').val());
            var price_person = parseNumberCustom($(this).closest('form').find('.InputPricePerson').val());
            var host_id = $(this).attr('data-id');
            $.ajax({
                url: "<?php echo e(route('GetTodayPrice')); ?>",
                method: "post",
                data: {
                    id: host_id,
                }
            }).done(function (returnData) {
                var f = returnData * 20 / 100;
                var f_percent = returnData - f;
                // console.log(f_percent);
                // return false;
                if (price != '' && price_person != '') {
                    if (price > f_percent) {
                        AlertToast('رزرو لحظه آخری', 'حداقل تخفیف برای امروز 20 درصد می باشد', 'warning');
                        return false;
                    }
                    $('#Form'+host_id).submit();
                } else {
                    AlertToast('رزرو لحظه آخری', 'وارد کردن قیمت ها اجباری می باشد', 'warning');
                    return false;
                }
            });
        });
    </script>
    <script>
        $(document).ready(function () {
            $.ajaxSetup({
                headers: {
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                }
            });

            var image = $(".slide img");
            image.each(function (i) {
                var container = $(".nav-slider .item-slider");
                var imageUrl = image[i].src;

                container.append(getimage(imageUrl));
            });
            $(".nav-slider li img", this).click(function () {
                var nav = $(this);
                var url = nav.attr("src");
                image.fadeOut().fadeIn().attr("src", url);
            });

            function getimage(imageUrl) {
                return '<li class="item m-0"><img class="mw-100 p-1 rounded" src=" ' + imageUrl + ' " alt=""></li>';
            }

            $('.owl-carousel.slid-1').owlCarousel({
                rtl: true,
                loop: true,
                nav: false,
                dots: false,
                margin: 0,
                items: 1
            })
            $('.owl-carousel.R-sl1').owlCarousel({
                autoplay: true,
                autoplayTimeout: 5000,
                rtl: true,
                loop: true, smartSpeed: 3000,
                lazyLoad: true,
                margin: 0,
                responsiveClass: true,
                responsive: {
                    0: {
                        items: 4,
                        nav: true
                    },
                    600: {
                        items: 4,
                        nav: false
                    },
                    1000: {
                        items: 5,
                        nav: true
                    }
                }
            })
        });


        function ajaxClosestTimeReserve(input, id) {
            
            
            
            
            
            
            
            
            
            
            
            
            
            
        }

        function ajaxActiveHost(id, idInput) {
            $.ajax({
                url: "<?php echo e(url('active/host').'/'); ?>" + id,
                method: "get",
            }).done(function (returnData) {
                // console.log(returnData);
                if (returnData == 'active') {
                    // console.log('active');
                    $("#btnActiveHost" + idInput).addClass('btn-default');
                    $("#btnActiveHost" + idInput).removeClass('btn-default');
                    $("#btnActiveHost" + idInput).css("transition", "0.5s");
                    $("#btnActiveHost" + idInput).text('');
                    $("#btnActiveHost" + idInput).append('فعال');
                } else if (returnData == 'deactive') {
                    // console.log('deactive');
                    $("#btnActiveHost" + idInput).addClass('btn-default');
                    $("#btnActiveHost" + idInput).removeClass('btn-default');
                    $("#btnActiveHost" + idInput).css("transition", "0.5s");
                    $("#btnActiveHost" + idInput).text('');
                    $("#btnActiveHost" + idInput).append('غیرفعال');
                }
            });
        }

        function DeleteHost(id) {
            if (confirm("آیا اطمینان از حذف اقامتگاه را دارید؟")) {
                window.location.href = 'http://www.rentt.ir/delete/host/' + id;
            } else {
                console.log('22222222222222');
                return false;
            }
        }


        <?php if(auth()->user()->role_id == 1): ?>
        function ajaxStatusHost(id, idInput) {
            $.ajax({
                url: "<?php echo e(url('status/host').'/'); ?>" + id,
                method: "get",
            }).done(function (returnData) {
                // console.log(returnData);
                if (returnData == '0') {
                    // console.log('0');
                    $("#btnStatusHost" + idInput).addClass('border-blue');
                    $("#btnStatusHost" + idInput).removeClass('border-red');
                    $("#btnStatusHost" + idInput).removeClass('border-green');
                    $("#btnStatusHost" + idInput).css("transition", "0.5s");
                    $("#btnStatusHost" + idInput).text('');
                    $("#btnStatusHost" + idInput).append('در انتظار تایید');
                } else if (returnData == '1') {
                    // console.log('1');
                    $("#btnStatusHost" + idInput).addClass('border-green');
                    $("#btnStatusHost" + idInput).removeClass('border-red');
                    $("#btnStatusHost" + idInput).removeClass('border-blue');
                    $("#btnStatusHost" + idInput).css("transition", "0.5s");
                    $("#btnStatusHost" + idInput).text('');
                    $("#btnStatusHost" + idInput).append('تایید شده');
                } else if (returnData == '2') {
                    // console.log('2');
                    $("#btnStatusHost" + idInput).addClass('border-red');
                    $("#btnStatusHost" + idInput).removeClass('border-blue');
                    $("#btnStatusHost" + idInput).removeClass('border-green');
                    $("#btnStatusHost" + idInput).css("transition", "0.5s");
                    $("#btnStatusHost" + idInput).text('');
                    $("#btnStatusHost" + idInput).append('تایید نشده');
                }
            });
        }


        function ajaxStatusSuccessHost(id) {
            $.ajax({
                url: "<?php echo e(url('status/host/success-sms').'/'); ?>" + id,
                method: "get",
            }).done(function (returnData) {
                // console.log(returnData);
                if (returnData == 'success') {
                    // check data and view popup for send sms
                    $.Toast("<p>ارسال پیامک</p>", "<p>پیام تاییدیه با موفقیت ارسال شد .</p>", "success", {
                        has_icon: true,
                        has_close_btn: true,
                        stack: true,
                        fullscreen: false,
                        timeout: 4000,
                        sticky: false,
                        has_progress: true,
                        rtl: true,
                    });
                }
            });
        }

        <?php endif; ?>

        <?php if(auth()->user()->role_id == 1): ?>
            $('.status-host').change(function () {
                $.ajax({
                    url: "<?php echo e(url('status/host')); ?>"+'/'+$(this).attr('data-host-id')+'/'+$(this).val(),
                    method: "get",
                }).done(function (returnData) {
                    if(returnData == 'success') {
                        AlertToast('وضعیت اقامتگاه', 'وضعیت اقامتگاه با موفقیت به روز رسانی شد', 'success');
                    }
                });
            });
        <?php endif; ?>


        $('.same-styk').change(function () {
            window.location.href = "http://irannpco.ir/khosravi/index/host/"+$(this).val();
        });


        function ajaxHostIntegrated(id) {
            var img = '<div class="text-center box-loading"><img style="height:50px;width:auto;" src="<?php echo e(asset('backend/img/img_loading/orange_circles.gif')); ?>" /></div>';
            $('#myModal').modal('show');
            $('#ExtraIndexHost').html(img);

            $.ajax({
                url: "<?php echo e(url('index/host-integrated').'/'); ?>" + id,
                method: "get",
            }).done(function (returnData) {
                if (returnData.Success == 1) {
                    $('#ExtraIndexHost').html(returnData.Message.original);
                }
            });
        }

    </script>
<?php $__env->stopSection(); ?>
<?php echo $__env->make('backend.MasterPage.Layout', array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>