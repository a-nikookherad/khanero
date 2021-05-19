
<?php $__env->startSection('title',TitlePage('لیست رزرو ها')); ?>

<?php $__env->startSection('style'); ?>
    <link rel="stylesheet" href="<?php echo e(asset('backend/css/dataTables.bootstrap.css')); ?>">
    <link rel="stylesheet" href="<?php echo e(asset('backend/css/TableTools.css')); ?>">
    <style>
    .itemS-pc .each-item {list-style: none;width: 50%;float: right;text-align: right;padding: 6px 0;}
    .itemS-pc .titl-e1 {color: #e95521;font-weight: bold;position: relative;}
    .itemS-pc .titl-e1:after {content: ":";padding: 0 4px;}
    .itemS-pc .del-dot:after {display:none;}
    .itemS-pc .titl-e1.del-dot {cursor: pointer;color: darkgreen;}


        #ToolTables_DataTables_Table_0_0 {
            display: none;
        }

        .img-host {
            width: 100%;
            transition: 0.5s;
            border-radius: 10px;
        }

        .img-host:hover {
            /*width: 100%;*/
            transition: 0.5s;
        }

        .box-reserve {
            padding: 15px 8px;
            border: 1px solid #ddd;
            margin: 10px 0px;
            border-radius: 5px;
            transition: .3s;
            /*cursor: pointer;*/
            background: #fcfcfc;
            box-shadow: none;
        

        }

        .box-reserve:hover {
            box-shadow: 1px 1px 4px 1px #13131340;
            transition: .3s;
            background: #fff;
        }

        .padding-top h5 {
            color: #ea6722;
            padding-top: 3px;
        }


    .progressBar-step {
        display: inline-block;
        line-height: 44px;
        text-indent: -9999px;
        width: 32px;
        height: 27px;
        background-color: #c04000;
        margin-top: 8px;
        direction: rtl;
    }

        /*progress*/

        /* ============================= */

        .progressBar {
            /*background: #e77e5c;*/
            margin: 10px 0 0 0;
            padding: 0px;
            list-style: none;
            overflow: hidden;
        }

        .progressBar-item {
            display: inline-block;
            width: 24%;
            height: 44px;
            line-height: 44px;
            background-color: #c0c0c0;
            text-align: center;
            position: relative;
        }

        .progressBar-step {
            display: inline-block;
            line-height: 44px;
            text-indent: -9999px;
            width: 32px;
            height: 27px;
            background-color: #c04000;
            margin-top: 8px;
            direction: rtl;
        }

        .progressBar-item + .progressBar-item .progressBar-step {
            margin-left: 32px;
        }

        .progressBar-item:first-child {
            width: 20%;
        }

        .progressBar-item:last-child {
            width: 30%;
        }

        @media  only screen and (min-width: 768px) {
            .progressBar-step {
                width: 75%;
                display: inline-block;
                line-height: 27px;
                text-indent: inherit;
                width: 32px;
                height: 27px;
                margin-top: 8px;
                direction: rtl;
                /*color: #c04000;*/
            }

            .progressBar-item:first-child,
            .progressBar-item:last-child {
                width: 24%;
            }
        }

        @media  only screen and (min-width: 1024px) {
            .progressBar-step {
                display: block;
                line-height: 44px;
                text-indent: 0;
                width: auto;
                height: auto;
                margin: 0;
                background-color: transparent;
            }
        }

        .progressBar-item.active {
            background-color: #36454f;
            color: #FFF;
        }

        .progressBar-item::before,
        .progressBar-item::after {
            content: " ";
            position: absolute;
            left: 0;
            top: -10px;
        }

        .progressBar-item + .progressBar-item::before {
            border-top: 32px solid transparent;
            border-bottom: 32px solid transparent;
            border-left: 32px solid #FFF;
            left: 0px;
        }

        .progressBar-item + .progressBar-item::after {
            border-top: 32px solid transparent;
            border-bottom: 32px solid transparent;
            border-left: 32px solid #c0c0c0;
            left: -10px;
        }

        .progressBar-item.active + .progressBar-item::after {
            border-left: 32px solid #36454f;
        }

        .progressBar {
            counter-reset: cartStep -1;
            direction: ltr;
        }

        .progressBar-item {
            counter-increment: cartStep;
        }

        .payment {
            padding: 4px 0px;
            font-size: 11px;
        }
        .modal-header img {
            position: absolute;
            width: 40px;
            float: left;
            left: 15px;
            top: 10px;
        }

        .tab-pane {
            display: none;
        }
        .tab-pane.active {
            display: block;
        }
        
        
        
        /*animate*/
        .animated-step {
            -webkit-animation-name: example; /* Safari 4.0 - 8.0 */
            -webkit-animation-duration: 4s; /* Safari 4.0 - 8.0 */
            -webkit-animation-iteration-count: infinite; /* Safari 4.0 - 8.0 */
            animation-name: example-animate;
            animation-duration: 2s;
            animation-iteration-count: infinite;
        }
    
        /* Safari 4.0 - 8.0 */
        @-webkit-keyframes example-animate {
            0%   {color: #e73f05;}
            50% {color:#36454f;}
            100% {color:#e73f05;}
        }
    
        /* Standard syntax */
        @keyframes  example-animate {
            0%   {color:#e73f05;}
            50% {color:#36454f;}
            100% {color:#e73f05;}
        }
        .img-host-user {
            cursor: pointer;
            display: inline-block;
            position: absolute;
            bottom: 0px;
            right: 15px;
            border-radius: 50%;
            border: 1px solid #e77e5c;
            background: #fcfcfc;
            padding: 2px;
        }
        .img-host-user img {
            border-radius: 50%;
        }
        .btn-chat {
            display: inline-block;
            width: 80px;
            color: #007b8c!important;
        }
        .same-styk {
    width: 79%;
}

    li.li-reserve {
        background: #ffe9cf;
    }
    </style>
    <link rel="stylesheet" href="<?php echo e(asset('backend/css/bootstrap-datepicker.min.css')); ?>"/>
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
                    <h3 class="panel-title">لیست رزرو ها</h3>
                </div>
                <div class="panel-body">
                    <div class="head-serach row">
                        <div class="col-sm-4 px-0 d-flex align-items-center vazyat-agahi">
                            <label class="ttle-row">جستجو:</label>
                            <input class="same-styk" placeholder="جستجو کنید ...">
                        </div>
                        <div class="col-sm-4 px-0 d-flex align-items-center vazyat-agahi">
                            <label class="ttle-row">نوع رزرو:</label>
                            <select class="same-styk">
                                <option>همه</option>
                                <option>رزرو درخواستی</option>
                                <option>رزرو دریافتی</option>
                            </select>
                        </div>
                        <div class="col-sm-4 px-0 d-flex align-items-center vazyat-agahi">
                            <label class="ttle-row">وضعیت:</label>
                            <select class="same-styk">
                                <option>همه</option>
                                <option>در انتظار تایید</option>
                                <option>در انتظار پرداخت</option>
                                <option>پرداخت شده</option>
                                <option>منقضی شده</option>
                                <option>کنسل میزبان</option>
                            </select>
                        </div>
                    </div>
                    <?php if(count($reserve) == 0): ?>
                        <div class="row">
                            <div class="alert alert-warning">
                                <p>هنوز نرفتی سفر...؟ وقتشه یه نگاه به <u><a href="<?php echo e(route('HomePage')); ?>">اینجا</a></u> بندازی تا نظرت عوض بشه!</p>
                            </div>
                        </div>
                    <?php endif; ?>
                    <?php $__currentLoopData = $reserve; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $key => $value): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                        <?php if($value['type'] == 'my-reserve'): ?>
                            <?php echo $__env->make('Reserve::TypeReserve.MyReserve', array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>
                        <?php elseif($value['type'] == 'my-guest'): ?>
                            <?php echo $__env->make('Reserve::TypeReserve.MyGuest', array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>
                        <?php endif; ?>
                    <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                    
                    <div class="modal fade" id="myModalCancel" role="dialog">
                        <div class="modal-dialog modal-md">
                            <!-- Modal content-->
                            <div class="modal-content">
                                <div class="modal-header">
                                    <button type="button" class="close" data-dismiss="modal">&times;</button>
                                    <h5 class="modal-title">انصراف رزرو</h5>
                                    <img src="<?php echo e(asset('frontend/images/logo.png')); ?>" />
                                </div>
                                <div class="modal-body" id="ExtraModalCancel">

                                </div>
                            </div>
                        </div>
                    </div>
                    
                    <div class="modal fade" id="myModalRate" role="dialog">
                        <div class="modal-dialog modal-md">
                            <!-- Modal content-->
                            <div class="modal-content">
                                <div class="modal-header">
                                    <button type="button" class="close" data-dismiss="modal">&times;</button>
                                    <h5 class="modal-title">ثبت نظر دهی</h5>
                                </div>
                                <div class="modal-body" id="ExtraModalRate">

                                </div>
                            </div>
                        </div>
                    </div>
                    
                    <div class="modal fade" id="myModalDetailPrice" role="dialog">
                        <div class="modal-dialog modal-md">
                            <!-- Modal content-->
                            <div class="modal-content">
                                <div class="modal-header">
                                    <button type="button" class="close" data-dismiss="modal">&times;</button>
                                    <h5 class="modal-title">جزئیات قیمت</h5>
                                </div>
                                <div class="modal-body">
                                    <div id="ExtraModalDetailPrice">
                                    
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    
                    <div class="modal fade" id="myModalDetailPayment" role="dialog">
                        <div class="modal-dialog modal-md">
                            <!-- Modal content-->
                            <div class="modal-content">
                                <div class="modal-header">
                                    <button type="button" class="close" data-dismiss="modal">&times;</button>
                                    <ul class="nav nav-tabs">
                                        <li class="active">
                                            <a data-toggle="tab" href="#ExtraModalDetailPayment">
                                                <h5 class="modal-title">پرداخت از طریق درگاه بانک</h5>
                                            </a>
                                        </li>
                                        <li>
                                            <a data-toggle="tab" href="#WalletPay">
                                                <h5 class="modal-title">پرداخت از طریق کیف پول</h5>
                                            </a>
                                        </li>
                                    </ul>
                                    
                                </div>
                                <div class="modal-body">
                                    <div class="">
                                        <div id="ExtraModalDetailPayment" class="tab-pane fade in active">
                                        
                                        </div>
                                        <div id="WalletPay" class="tab-pane fade">
                                        
                                        </div>
                                    </div>
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
    <script src="<?php echo e(asset('frontend/js/script.js')); ?>" type="text/javascript"></script>
    <script type="text/javascript" src="<?php echo e(asset('backend/js/jquery.dataTables.min.js')); ?>"></script>
    <script type="text/javascript" src="<?php echo e(asset('backend/js/TableTools.min.js')); ?>"></script>
    <script type="text/javascript" src="<?php echo e(asset('backend/js/dataTables.bootstrap.js')); ?>"></script>
    <script type="text/javascript" src="<?php echo e(asset('backend/js/editable-datatables.js')); ?>"></script>
    <script src="<?php echo e(asset('backend/js/bootstrap-datepicker.min.js')); ?>"></script>
    <script src="<?php echo e(asset('backend/js/bootstrap-datepicker.fa.min.js')); ?>"></script>
    <script src="https://unpkg.com/leaflet@1.4.0/dist/leaflet.js" integrity="sha512-QVftwZFqvtRNi0ZyCtsznlKSWOStnDORoefr1enyq5mVL4tmKB3S/EnC3rRJcxCPavG10IcrVGSmPh6Qw5lwrg==" crossorigin=""></script>
    <!--//============ Multi-gallery-slider-->
    <script>
        $(document).ready(function () {
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
                rtl:true,
                loop: true,
                nav: false,
                dots:false,
                margin: 0,
                items: 1
            })
            $('.owl-carousel.R-sl1').owlCarousel({
                autoplay:true,
                autoplayTimeout:5000,
                rtl:true,
                loop: true,smartSpeed:3000,
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
    </script>
    <script>


        $("#InputDateSpecial").datepicker({
            minDate: 0,
            changeMonth: true,
            changeYear: true,
            isRTL: true,
            dateFormat: "yy/mm/dd",
            EnableTimePicker: true,
        });


        function AjaxCancelReserve(id) {
            var img = '<div class="text-center"><img style="height:50px;width:auto;" src="<?php echo e(asset('backend/img/img_loading/orange_circles.gif')); ?>" /></div>';
            $('#ExtraModalCancel').html(img);
            $.ajax({
                url: "<?php echo e(url('reserve/cancel-client').'/'); ?>" + id,
                method: "get",
            }).done(function (returnData) {
                $('#ExtraModalCancel').html(returnData);
            })
        }


        function AjaxRateReserve(id) {
            var img = '<div class="text-center"><img style="height:50px;width:auto;" src="<?php echo e(asset('backend/img/img_loading/orange_circles.gif')); ?>" /></div>';
            $('#ExtraModalRate').html(img);
            $.ajax({
                url: "<?php echo e(url('rate/rate-reserve').'/'); ?>" + id,
                method: "get",
            }).done(function (returnData) {
                $('#ExtraModalRate').html(returnData);
            })
        }


        function AjaxDetailPrice(id) {
            var img = '<div class="text-center"><img style="height:50px;width:auto;" src="<?php echo e(asset('backend/img/img_loading/orange_circles.gif')); ?>" /></div>';
            $('#ExtraModalDetailPrice').html(img);
            $.ajax({
                url: "<?php echo e(url('detail/price-reserve').'/'); ?>" + id,
                method: "get",
            }).done(function (returnData) {
                $('#ExtraModalDetailPrice').html(returnData);
            })
        }


        function AjaxDetailPayment(id) {
            var img = '<div class="text-center"><img style="height:50px;width:auto;" src="<?php echo e(asset('backend/img/img_loading/orange_circles.gif')); ?>" /></div>';
            $('#ExtraModalDetailPayment').html(img);
            $.ajax({
                url: "<?php echo e(url('detail/payment-reserve').'/'); ?>" + id,
                method: "get",
            }).done(function (returnData) {
                $('#ExtraModalDetailPayment').html(returnData[0].original);
                $('#WalletPay').html(returnData[1].original);
            })
        }

    </script>
<?php $__env->stopSection(); ?>
<?php echo $__env->make('backend.MasterPage.Layout', array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>