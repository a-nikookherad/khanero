<style>
	.border-hover {
		/*border: 2px solid rgb(0, 123, 140) !important;*/
		/*border-radius: 5px;*/
		background-color: #fe884a;
		color: white!important;
	}
</style>
<div id="BoxCalendar">
	<link href="<?php echo e(asset('frontend/css/all.min.css')); ?>" rel="stylesheet">
	<link href="<?php echo e(asset('frontend/css/style-calendar.css')); ?>" rel="stylesheet">
	
	
	
	
	<?php 
		//dd($detailMonth);
		$past_day = $detailMonth['start_day_month']['day_id'] - 1; // تعداد روز های گذشته شده از هفته برای محاسبه شروع تقویم
		$future = end($detailMonth['detail_days']); // تعداد روز برای تکمیل کردن اخر هفته که خالی نباشد
		$prev = $detailMonth['detail_days'][0];
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
			<button type="button" class="btn__left">
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
								<main class="calendar-day-item <?php if($value['day_id'] == 7 || in_array($value['day'], $holidays_now_month)): ?> calendar-day-holidays <?php endif; ?> <?php if($value['day'] == $detailMonth['today']['day']): ?> calendar-day-today <?php endif; ?> <?php if($value['day'] < $detailMonth['today']['day'] || $value['block_day'] == 1): ?>last-day-item block_day <?php endif; ?> date<?php echo e($value['day']); ?>">
									<div class="info-container">
										<div class="calendar-day-item-date"><?php echo e($value['day']); ?></div>
										<div class="calendar-day-item-price"><?php echo e(substr($value['price'],0,-3)); ?></div>
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
							<i aria-hidden="true" class="fa fa-info-circle"></i>
							<main> قیمت‌ به هزار تومان</main>
						</div>
						
					</div>
					<div class="footer-last-update">
						
						
					</div>
				</div>
			</div>
		</section>
	</div>
	
	<script>

        var numHover,
			start_date,
			num = null;
        var year = $('#InputYear').val();
        var month = $('#InputMonth').val();
        var calendar_day_item = $('.calendar-day-item');
        var last_day_item = $('.last-day-item');
        var check_block_day = 0;

        console.log(check_block_day);
        $('#BoxCalendar .calendar-day-item').click(function () { // item calendar
			if($('#InputDateFrom').val() != '' && $(this).hasClass('last-day-item')) {
				AlertMessage('رزرو اقامتگاه', 'امکان ثبت این تاریخ وجود ندارد', 'warning');
				return false;
			}
            $('.calendar-day-item').removeClass('border-hover');
            $(this).addClass('border-hover');
            $(this).addClass('calendar-hover');
            num = parseInt($(this).find('.calendar-day-item-date').text());
            if ($('#InputDateFrom').val() != '')
            {
                /** for check block day when change calendar */
                start_day = 0;
                start_month = 0;
                start_year = 0;
                /** **************************************** */
                $('#InputDateTo').val(year + '/' + month + '/' + num);
                $('.box-calendar').hide("slow");
                var date_from = $('#InputDateFrom').val();
                var date_to = $('#InputDateTo').val();
                // fill input date in form login and register
                $('#DateFromRegister').val(date_from);
                $('#DateToRegister').val(date_to);
                $('#DateFromLogin').val(date_from);
                $('#DateToLogin').val(date_to);
                /** *************************************/
                var host_id = <?php echo e($hostModel->id); ?>;
                $('.calendar-day-item').removeClass('calendar-hover');
                var img = '<div class="text-center"><img style="height:50px;width:auto;margin-bottom: 15px;transition: 0.5s;" src="<?php echo e(asset('backend/img/img_loading/orange_circles.gif')); ?>" /></div>';
                $('#MsgCalculatePrice').html(img);
                $.ajax({
                    url: '<?php echo e(route('CalculateReserveHostByDateAjax')); ?>',
                    type: 'get',
                    data: {
                        date_from: date_from,
                        date_to: date_to,
						count_person: $('#CountGuest').val(),
                        host_id: host_id
                    },
                    success: function (data) {
                    	// console.log(data.Message.original);
                    	if(data.Success == 1) {
							// $('#ExtraFactorReserve').html(data.Message.original);
							// $('#BtnShowFactor').click();
							$('#MsgCalculatePrice').html(data.Message.original);
							// $('#myModalFactor').modal('show');
						} else {
							$.Toast("<p>رزرو</p>", "<p>"+data.Message+" .</p>", "warning", {
								has_icon: true,
								has_close_btn: true,
								stack: true,
								fullscreen: false,
								timeout: 4000,
								sticky: false,
								has_progress: true,
								rtl: true,
							});
							$('#MsgCalculatePrice').html('');
						}
                    }
                });
            } else {
                $('#InputDateFrom').val(year + '/' + month + '/' + num);
                start_day = num;
                start_month = month;
                start_year = year;
            }

            /** block date after first reserve*/
			start_date = parseInt($(this).find('.calendar-day-item-date').text());

            /** before first date */
            $.each(calendar_day_item, function(index_2, element_2){
                var num_2 = parseInt($(element_2).find('.calendar-day-item-date').text());
                if(num_2 < start_date) {
                    $(element_2).addClass('last-day-item');
                    $(element_2).addClass('temporary-block'); // temporary-block for change again calendar
                }
            });


            /** after first date */
			$.each(last_day_item, function(index, element){
				var element_number_block_day = $(element);
				var number_block_day = parseInt($(element).find('.calendar-day-item-date').text());
				if(number_block_day > num) {
					$.each(calendar_day_item, function(index_2, element_2){
						var num_2 = parseInt($(element_2).find('.calendar-day-item-date').text());
						if(num_2 > number_block_day) {
                            check_block_day = number_block_day; // for block days after first day block
							element_number_block_day.removeClass('last-day-item');
							$(element_2).addClass('last-day-item');
							$(element_2).addClass('temporary-block'); // temporary-block for change again calendar
						}
					});
					return false;
				}
			});
        });

        $('#BoxCalendar .calendar-day-item').hover(function () {
        	/** remove bg orange from all object calendar */
            $('.calendar-day-item').removeClass('border-hover');
            $(this).addClass('border-hover');
            /** *******************************************/
            $('.calendar-day-item').removeClass('calendar-hover');
            if($('#InputDateFrom').val() != '') {
				numHover = parseInt($(this).find('.calendar-day-item-date').text());
				for (var i = num; i <= numHover; i++) {
					$('.date' + i).addClass('calendar-hover');
				}
			}
        });

		$('#InputDateFrom').click(function () {
			$('.calendar-day-item').removeClass('calendar-hover');
			$('#InputDateTo').val('');
			$('#InputDateFrom').val('');
			$('.box-calendar').show("slow");
			$('#MsgCalculatePrice').html('');
			ClearCalendar();
		});

        $('.btn__left').click(function () {
            $('#RowLoading').html('<img style="width:50px;" src="<?php echo e(asset('backend/img/img_loading/loading_calendar.gif')); ?>"/>');
            $('.calendar-month').css('opacity', '0.2');
            // var year = $('#InputYear').val();
            var day_id = '<?php echo e($future['day_id']); ?>';
            var name_day = '<?php echo e($future['name_day']); ?>';
            var num_month = '<?php echo e($detailMonth['today']['num_month']); ?>';
            var formData = new FormData();
            formData.append('year', year);
            formData.append('day_id', day_id);
            formData.append('name_day', name_day);
            formData.append('num_month', num_month);
            formData.append('host_id', <?php echo e($hostModel->id); ?>);
            // Send data with ajax
            $.ajaxSetup({
                headers: {
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                }
            });
            $.ajax({
                url: '<?php echo e(route('CalendarChangeUserNext')); ?>',
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

		$('.btn__right').click(function () {
			if($('#MonthNumberNow').val() == $('#InputMonth').val()) {
				return false;
			}
			$('#RowLoading').html('<img style="width:50px;" src="<?php echo e(asset('backend/img/img_loading/loading_calendar.gif')); ?>"/>');
			$('.calendar-month').css('opacity', '0.2');
			// var year = $('#InputYear').val();
			var day_id = '<?php echo e($prev['day_id']); ?>';
			var name_day = '<?php echo e($prev['name_day']); ?>';
			var num_month = '<?php echo e($detailMonth['today']['num_month']); ?>';
			var formData = new FormData();
			formData.append('year', year);
			formData.append('day_id', day_id);
			formData.append('name_day', name_day);
			formData.append('num_month', num_month);
			formData.append('host_id', <?php echo e($hostModel->id); ?>);
			// Send data with ajax
			$.ajaxSetup({
				headers: {
					'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
				}
			});
			$.ajax({
				url: '<?php echo e(route('CalendarChangeUserPrev')); ?>',
				type: 'post',
				data: formData,
				processData: false,
				contentType: false,
				success: function (data) {
					// console.log(data);
					$('#BoxCalendar').html(data)
				}
			});
			return false;
		});

		$('.calendar-day-item').click(function () {
			// if ($(this).hasClass('last-day-item')) {
			// 	AlertMessage('روز های خاص', 'امکان ثبت این تاریخ وجود ندارد', 'warning');
			// 	return false;
			// 	// $('#InputDateFrom').val('');
			// 	// $('.calendar-day-item').removeClass('calendar-hover');
			// } else {
			// 	var day = $(this).find('.calendar-day-item-date').text();
			// 	// var month = $('#InputMonth').val();
			// 	// var year = $('#InputYear').val();
			// 	var date = year + '/' + month + '/' + day;
			// 	$('#InputDateSpecial').val(date);
			// }
		});

        $('.btn-eraser-date').click(function () {
            $('#InputDate').val('');
        });

        $('.btn-eraser-description').click(function () {
            $('#InputDescription').val('');
        });

		$('#BtnClear').click(function () {
			ClearCalendar();
		});

		function ClearCalendar() {
			check_block_day = 0;
			/** for check block day when change calendar */
			start_day = 0;
			start_month = 0;
			start_year = 0;
			/** **************************************** */
			num = null;
			var day_item = $('.temporary-block');
			$.each(day_item, function(index, element) {
				$(element).removeClass('temporary-block');
				$(element).removeClass('last-day-item');
			});
			var block_day = $('.block_day');
			$.each(block_day, function(index, element) {
				$(element).addClass('last-day-item');
			});
			$('.calendar-day-item').removeClass('calendar-hover');
			$('#InputDateTo').val('');
			$('#InputDateFrom').val('');
			// $('.box-calendar').hide("slow");
			$('.box-calendar').show("slow");
		}
	
	</script>


</div>