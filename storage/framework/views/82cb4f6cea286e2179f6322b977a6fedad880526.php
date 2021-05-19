
<?php $__env->startSection('title'); ?>
    ویلا :: مشاهده پیام های ارسالی
<?php $__env->stopSection(); ?>

<?php $__env->startSection('style'); ?>
    <link rel="stylesheet" href="<?php echo e(asset('backend/css/dataTables.bootstrap.css')); ?>">
    <link rel="stylesheet" href="<?php echo e(asset('backend/css/TableTools.css')); ?>">
    <style>
        #ToolTables_DataTables_Table_0_0{
            display: none;
        }
        .box-message {
            max-height: 400px;
            overflow-y: scroll;
            overflow-x: hidden;
            border: 1px solid #dedede;
            padding: 20px;
            border-radius: 7px;
        }
        .box-message p {
            display: inline-block;
            border-radius: 10px;
            max-width: 450px;
            text-align: right;
        }
        .scrollbar
        {
            float: left;
            height: 600px;
            width: 100%;
            overflow-y: scroll;
            margin-bottom: 25px;
            background: #fafafa;
        }

        .force-overflow
        {
            min-height: 450px;
        }

        /*
 *  STYLE 6
 */

        #style-6::-webkit-scrollbar-track
        {
            -webkit-box-shadow: inset 0 0 6px rgba(0,0,0,0.3);
            background-color: #F5F5F5;
        }

        #style-6::-webkit-scrollbar
        {
            width: 10px;
            background-color: #F5F5F5;
        }

        #style-6::-webkit-scrollbar-thumb
        {
            background-color: #13a9a0;
            background-image: -webkit-linear-gradient(45deg,
            rgba(255, 255, 255, .2) 25%,
            transparent 25%,
            transparent 50%,
            rgba(255, 255, 255, .2) 50%,
            rgba(255, 255, 255, .2) 75%,
            transparent 75%,
            transparent);
        }

        .btn-send-message {
            background-color: #13a9a0;
            border-color: #0a7d77;
            color: #fff;
        }
    </style>
<?php $__env->stopSection(); ?>

<?php $__env->startSection('content'); ?>
    <div class="row back-url">
        <div class="col-md-12">
            <?php if(auth()->user()->role_id == 1): ?>
                <a class="" href="<?php echo e(route('AdminDashboard')); ?>">صفحه اصلی</a><span class="now-url"> / نمایش پیام های ارسالی</span>
            <?php else: ?>
                <a class="" href="<?php echo e(route('UserDashboard')); ?>">صفحه اصلی</a><span class="now-url"> / نمایش پیام های ارسالی</span>
            <?php endif; ?>
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
            <div class="panel panel-default">
                <div class="panel-heading">
                    <h3 class="panel-title">نمایش پیام های ارسالی(<?php echo e($userModel->first_name.' '.$userModel->last_name); ?>)</h3>

                </div>
                <div class="panel-body">
                    <div class="col-md-12">
                        <div class="box-message scrollbar" id="style-6">
                            <?php $__currentLoopData = $messageModel; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $key => $value): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                <div class="row <?php if($value->sender_id == auth()->user()->id): ?> text-right <?php else: ?> text-left <?php endif; ?>">
                                    <p class="<?php if($value->sender_id == auth()->user()->id): ?> text-right bg-success <?php else: ?> text-left bg-info <?php endif; ?>">
                                        <?php echo e($value->message); ?>

                                    </p>
                                    <h6>
                                        <?php echo e(\Morilog\Jalali\Facades\jDate::forge($value->created_at)->format('Y/m/d - H:i:s')); ?>

                                    </h6>
                                </div>
                            <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                            <div id="SendMessageBox">

                            </div>
                            <div id="LinkMessage"></div>
                        </div>
                    </div>
                    <div class="col-md-12">
                        <div class="row">
                            <div class="col-md-2">
                                <div class="row">
                                    <input type="text" id="InputTitleText" class="form-control" placeholder="عنوان پیام" />
                                </div>
                            </div>
                            <div class="col-md-8">
                                <div class="row">
                                    <input type="text" id="InputMessageText" class="form-control" placeholder="متن مورد نظر را بنویسید ..." />
                                </div>
                            </div>
                            <div class="col-md-2">
                                <div class="row">
                                    <a href="#LinkMessage" class="btn btn-block btn-send-message">ارسال<i class="fa fa-location-arrow"></i> </a>
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



    <script>
        $(".box-message").animate({ scrollTop: $('.box-message').prop("scrollHeight")}, 3000);
        $("body").delegate(".btn-send-message","click",function (e) {
            var title = $('#InputTitleText').val();
            var message = $('#InputMessageText').val();
            var receiver_id = <?php echo e($userModel->id); ?>;
            var h = '<div class="row text-right">\n' +
                '        <p class="text-right bg-success">\n' +
                '            '+ message +'\n' +
                '        </p>\n' +
                '        <h6>\n' +
                '            <?php echo e(\Morilog\Jalali\Facades\jDate::forge(date('Y/m/d H:i:s'))->format('Y/m/d - H:i:s')); ?> \n' +
                '        </h6>\n' +
                '    </div>';

            $.ajaxSetup({
                headers: {
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                }
            });
            $.ajax({
                url: '<?php echo e(route('StoreMessage')); ?>',
                type: 'post',
                data: {
                    title:title,
                    message:message,
                    receiver_id:receiver_id,
                },
                success: function (data) {
                    if(data.Success == 1) {
                        $('#SendMessageBox').append(h);
                        $.Toast("<p>پیام</p>", "<p>"+ data.Message +" .</p>", "success", {
                            has_icon: true,
                            has_close_btn: true,
                            stack: true,
                            fullscreen: false,
                            timeout: 4000,
                            sticky: false,
                            has_progress: true,
                            rtl: true,
                        });
                        $('#InputTitleText').val("");
                        $('#InputMessageText').val("");
                    } else {
                        $.Toast("<p>پیام</p>", "<p>"+ data.Message +" .</p>", "warning", {
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
                }
            });

        });
    </script>

<?php $__env->stopSection(); ?>
<?php echo $__env->make('backend.MasterPage.Layout', array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>