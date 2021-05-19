<?php $__env->startSection('title',TitlePage('مدیریت تقویم')); ?>
<?php $__env->startSection('style'); ?>
    <link rel="stylesheet" href="<?php echo e(asset('backend/css/dataTables.bootstrap.css')); ?>">
    <link rel="stylesheet" href="<?php echo e(asset('backend/css/TableTools.css')); ?>">
    <style>
        #ToolTables_DataTables_Table_0_0 {
            display: none;
        }

        .btn-eraser-date, .btn-eraser-description {
            position: absolute;
            left: -45px;
            top: 26px;
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
                    <h3 class="panel-title">مدیریت تقویم</h3>
                </div>
                <div class="panel-body">
                    <div class="col-md-8">
                        <div class="row">
                            <div class="col-md-6">
                                <div class="row">
                                    <div class="form-group" style="position:relative;">
                                        <label for="InputDate">انتخاب روزهای خاص</label>
                                        <input type="text" readonly class="form-control" id="InputDate"
                                               placeholder="تاریخ را انتخاب کنید"/>
                                        <button class="btn btn-default btn-eraser-date"><i class="fa fa-eraser"></i>
                                        </button>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-md-6">
                                <div class="row">
                                    <div class="form-group" style="position:relative;">
                                        <label for="InputDescription">توضیحات</label>
                                        <input type="text" class="form-control" id="InputDescription"
                                               placeholder="توضیحات را وارد کنید"/>
                                        <button class="btn btn-default btn-eraser-description"><i
                                                    class="fa fa-eraser"></i></button>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-md-6">
                                <div class="row">
                                    <div class="form-group" style="position:relative;">
                                        <button type="button" class="btn btn-default btn-block" id="BtnSetDateSpecial">
                                            ثبت تاریخ
                                        </button>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <hr/>
                        <div class="box-date-description">
                            <?php $__currentLoopData = $specialDateModel; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $key => $value): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                <div class="col-md-2">
                                    <div class="row">
                                        <div class="box-date">
                                            <div class="col-md-12">
                                                <p class="text-primary">
                                                    <?php echo e(\Morilog\Jalali\Facades\jDate::forge($value->date)->format('Y/m/d')); ?>

                                                </p>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-md-10">
                                    <div class="row">
                                        <div class="box-date">
                                            <div class="col-md-12">
                                                <p class="text-danger">
                                                    <?php echo e($value->description); ?> <a href="<?php echo e(route('DeleteDateCalendar', ['id' => $value->id])); ?>" class="btn text-danger">حذف</a>
                                                </p>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                        </div>
                    </div>
                    <div class="col-md-4">
                        <div class="row">
                            <?php echo $calendar; ?>

                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

<?php $__env->stopSection(); ?>


<?php $__env->startSection('script'); ?>

    <script>
               
        
        $('#BtnSetDateSpecial').click(function () {
            var date = $('#InputDate').val();
            var description = $('#InputDescription').val();
            var formData = new FormData();
            formData.append('date', date);
            formData.append('description', description);
            // Send data with ajax
            $.ajaxSetup({
                headers: {
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                }
            });
            $.ajax({
                url: '<?php echo e(route('SetDateCalendar')); ?>',
                type: 'post',
                data: formData,
                processData: false,
                contentType: false,
                success: function (data) {
                    if (data.Success == 0) {
                        $.Toast("<p>ثبت تاریخ</p>", "<p>" + data.Message + " .</p>", "warning", {
                            has_icon: true,
                            has_close_btn: true,
                            stack: true,
                            fullscreen: false,
                            timeout: 4000,
                            sticky: false,
                            has_progress: true,
                            rtl: true,
                        });
                    } else if (data.Success == 1) {
                        $.Toast("<p>ثبت تاریخ</p>", "<p>" + data.Message + " .</p>", "success", {
                            has_icon: true,
                            has_close_btn: true,
                            stack: true,
                            fullscreen: false,
                            timeout: 4000,
                            sticky: false,
                            has_progress: true,
                            rtl: true,
                        });
                        $('#InputDate').val('');
                        $('#InputDescription').val('');
                        var h = '<div class="col-md-2">\n' +
                            '                                <div class="row">\n' +
                            '                                    <div class="box-date">\n' +
                            '                                        <div class="col-md-12">\n' +
                            '                                            <p class="text-primary">\n' +
                            '                                                ' + date + '' +
                            '                                            </p>\n' +
                            '                                        </div>\n' +
                            '                                    </div>\n' +
                            '                                </div>\n' +
                            '                            </div>\n' +
                            '                            <div class="col-md-10">\n' +
                            '                                <div class="row">\n' +
                            '                                    <div class="box-date">\n' +
                            '                                        <div class="col-md-12">\n' +
                            '                                            <p class="text-danger">\n' +
                            '                                               ' + description + '' +
                            '                                            </p>\n' +
                            '                                        </div>\n' +
                            '                                    </div>\n' +
                            '                                </div>\n' +
                            '                            </div>'
                        $('.box-date-description').append(h);
                    }
                }
            });
        });
    </script>

<?php $__env->stopSection(); ?>

<?php echo $__env->make('backend.MasterPage.Layout', array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>