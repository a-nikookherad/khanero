<div id="BoxCalendar">
    <link href="<?php echo e(asset('frontend/css/all.min.css')); ?>" rel="stylesheet">
    <link href="<?php echo e(asset('frontend/css/style-calendar.css')); ?>" rel="stylesheet">
    
    
    
    
    <?php 
        //dd($detailMonth);
        $past_day = $detailMonth['start_day_month']['day_id'] - 1; // تعداد روز های گذشته شده از هفته برای محاسبه شروع تقویم
        $future = end($detailMonth['detail_days']); // تعداد روز برای تکمیل کردن اخر هفته که خالی نباشد
        $future_day = abs($future['day_id'] - 7);
     ?>
    <div class="set__calendar">
        <header class="header__calendar">
            <button class="btn__right">
                <i class="fas fa-angle-right"></i>
            </button>
            <div class="title__calendar">
                <?php echo e($detailMonth['today']['day'].' '.$detailMonth['today']['name_month'].' '.$detailMonth['today']['year']); ?>

                <input type="hidden" value="<?php echo e($detailMonth['today']['year']); ?>" id="InputYear"/>
                <input type="hidden" value="<?php echo e($detailMonth['today']['num_month']); ?>" id="InputMonth"/>
            </div>
            <button class="btn__left">
                <i class="fas fa-angle-left"></i>
            </button>
        </header>
        <section class="body__calendar">
            <div class="ring-left"></div>
            <div class="ring-right"></div>
            <div class="calendar-body">
                <div class="month-container">

                    <div id="RowLoading" class="text-center"></div>
                    <div class="calendar-day-row" id="daysOfWeek">
                        <?php $__currentLoopData = $week; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $key => $value): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                            <main class="<?php if($value == 'جمعه'): ?> calendar-day-holidays <?php endif; ?>">
                                <div class="info-container">
                                    <?php if($value == 'شنبه'): ?>
                                        ش
                                    <?php elseif($value == 'یکشنبه'): ?>
                                        ی
                                    <?php elseif($value == 'دوشنبه'): ?>
                                        د
                                    <?php elseif($value == 'سه شنبه'): ?>
                                        س
                                    <?php elseif($value == 'چهارشنبه'): ?>
                                        چ
                                    <?php elseif($value == 'پنجشنبه'): ?>
                                        پ
                                    <?php elseif($value == 'جمعه'): ?>
                                        ج
                                    <?php endif; ?>
                                </div>
                            </main>
                        <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                    </div>
                    <div class="spinner calendarLoading" style="display: none;">
                        <div class="bounce1"></div>
                        <div class="bounce2"></div>
                        <div class="bounce3"></div>
                    </div>
                    <div class="calendar-month">
                        <div class="calendar-day-row">
                            <?php for($i = 0; $i < $past_day; $i++): ?>
                                <main class="calendar-day-noItem"></main>
                            <?php endfor; ?>

                            <?php $__currentLoopData = $detailMonth['detail_days']; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $key => $value): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                <main class="calendar-day-item <?php if($value['day_id'] == 7): ?> calendar-day-holidays <?php endif; ?> <?php if($value['day'] == $detailMonth['today']['day']): ?> calendar-day-today <?php endif; ?>">
                                    <div class="info-container">
                                        <div class="calendar-day-item-date"><?php echo e($value['day']); ?></div>
                                        <div class="calendar-day-item-price">۳۶۰</div>
                                    </div>
                                </main>


                                <?php if($value['day_id'] == 7): ?>
                        </div>
                        <div class="calendar-day-row">
                            <?php endif; ?>
                            <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>

                            <?php for($i = 0; $i < $future_day; $i++): ?>
                                <main class="calendar-day-noItem"></main>
                            <?php endfor; ?>
                        </div>
                    </div>
                </div>
                <div class="calendar-footer">
                    <div class="calendar-footer-txt">
                        <div class="calendar-price-tip">
                            
                            
                        </div>
                        
                    </div>
                    <div class="footer-last-update">
                        
                        
                    </div>
                </div>
            </div>
        </section>
    </div>

    <script>
    
        $('.calendar-day-item').click(function () {
            var selectedDate = $('#InputYear').val()+'/'+$('#InputMonth').val()+'/'+$(this).find('.calendar-day-item-date').text();
            $('#InputDate').val(selectedDate);
        });
        
        
        $('.btn__left').click(function () {
            $('#RowLoading').html('<img style="width:50px;" src="<?php echo e(asset('backend/img/img_loading/loading_calendar.gif')); ?>"/>');
            $('.calendar-month').css('opacity', '0.2');
            var year = $('#InputYear').val();
            var day_id = '<?php echo e($future['day_id']); ?>';
            var name_day = '<?php echo e($future['name_day']); ?>';
            var num_month = '<?php echo e($detailMonth['today']['num_month']); ?>';
            var formData = new FormData();
            formData.append('year', year);
            formData.append('day_id', day_id);
            formData.append('name_day', name_day);
            formData.append('num_month', num_month);
            // Send data with ajax
            $.ajaxSetup({
                headers: {
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                }
            });
            $.ajax({
                url: '<?php echo e(route('CalendarChange')); ?>',
                type: 'post',
                data: formData,
                processData: false,
                contentType: false,
                success: function (data) {
                    // console.log(data);
                    $('#BoxCalendar').html(data)
                }
            });
        });

        
        $('.btn-eraser-date').click(function () {
            $('#InputDate').val('');
        });


        $('.btn-eraser-description').click(function () {
            $('#InputDescription').val('');
        });

    </script>


</div>