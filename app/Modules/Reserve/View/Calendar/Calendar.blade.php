<style>
    .border-hover {
        background-color: #b7d2cc;
        color: white!important;
    }
</style>
<div id="BoxCalendar">
    <link href="{{asset('frontend/css/all.min.css')}}" rel="stylesheet">
    <link href="{{asset('frontend/css/style-calendar.css')}}" rel="stylesheet">
    @php
        //dd($detailMonth);
        $past_day = $detailMonth['start_day_month']['day_id'] - 1; // تعداد روز های گذشته شده از هفته برای محاسبه شروع تقویم
        $future = end($detailMonth['detail_days']); // تعداد روز برای تکمیل کردن اخر هفته که خالی نباشد
        $prev = $detailMonth['detail_days'][0];
        $future_day = abs($future['day_id'] - 7);
    @endphp
    <div class="set__calendar">
        <header class="header__calendar">
            <button class="btn__right" type="button">
                <i class="fas fa-angle-right"></i>
            </button>
            <div class="title__calendar">
                {{$detailMonth['today']['day'].' '.$detailMonth['today']['name_month'].' '.$detailMonth['today']['year']}}
                <input type="hidden" value="{{$detailMonth['today']['year']}}" id="InputYear"/>
                <input type="hidden" value="{{$detailMonth['today']['num_month']}}" id="InputMonth"/>
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
                        @foreach($week as $key => $value)
                            <main class="@if($value == 'جمعه') calendar-day-holidays @endif">
                                <div class="info-container">
                                    @if($value == 'شنبه')
                                        ش
                                    @elseif($value == 'یکشنبه')
                                        ی
                                    @elseif($value == 'دوشنبه')
                                        د
                                    @elseif($value == 'سه شنبه')
                                        س
                                    @elseif($value == 'چهارشنبه')
                                        چ
                                    @elseif($value == 'پنجشنبه')
                                        پ
                                    @elseif($value == 'جمعه')
                                        ج
                                    @endif
                                </div>
                            </main>
                        @endforeach
                    </div>
                    <div class="spinner calendarLoading" style="display: none;">
                        <div class="bounce1"></div>
                        <div class="bounce2"></div>
                        <div class="bounce3"></div>
                    </div>
                    <div class="calendar-month">
                        <div class="calendar-day-row">
                            @for($i = 0; $i < $past_day; $i++)
                                <main class="calendar-day-noItem"></main>
                            @endfor

                            @foreach($detailMonth['detail_days'] as $key => $value)
                                <main class="calendar-day-item @if($value['day_id'] == 7 || in_array($value['day'], $holidays_now_month)) calendar-day-holidays @endif @if($value['day'] == $detailMonth['today']['day']) calendar-day-today @endif @if($value['day'] < $detailMonth['today']['day'] || $value['block_day'] == 1)last-day-item block_day @endif date{{$value['day']}}">
                                    <div class="info-container">
                                        <div class="calendar-day-item-date">{{$value['day']}}</div>
                                        <div class="calendar-day-item-price">{{substr($value['price'],0,-3)}}</div>
                                    </div>
                                </main>
                                @if($value['day_id'] == 7)
                        </div>
                        <div class="calendar-day-row">
                            @endif
                            @endforeach

                            @for($i = 0; $i < $future_day; $i++)
                                <main class="calendar-day-noItem"></main>
                            @endfor
                        </div>
                    </div>
                </div>
            </div>
        </section>
    </div>
    <script>

        var day = 0;
        var month = $('#InputMonth').val();
        var year = $('#InputYear').val();
        var from_date = $('#InputDateFrom').val();
        var to_date = $('#InputDateTo').val();
        var numHover,
            start_date,
            num = null;
        var calendar_day_item = $('.calendar-day-item');
        var last_day_item = $('.last-day-item');

        $('.calendar-day-item').click(function () {
            if($(this).hasClass('last-day-item')) {
                AlertMessage('خطا در ارسال اطلاعات', 'شما مجاز به انتخاب این تاریخ برای رزرو نیستید.', 'warning');
                return false;
            } else {
                num = parseInt($(this).find('.calendar-day-item-date').text());
                day = $(this).find('.calendar-day-item-date').text();
                var date = year + '/' + month + '/' + day;
                if($('#InputDateFrom').val() == '') {
                    $('#InputDateFrom').val(date);
                } else if($('#InputDateTo').val() == '' && $('#InputDateFrom').val() != '') {
                    $('#InputDateTo').val(date);
                    $('.box-calendar').addClass('display-none');
                }
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

            // Calculate Price After Reserve
            if($('#InputDateFrom').val() != '' && $('#InputDateTo').val() != '') {
                CalculateFactor('calculate');
            }
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




        $('.btn__left').click(function () {
            $('#RowLoading').html('<img style="width:50px;" src="{{asset('backend/img/img_loading/loading_calendar.gif')}}"/>');
            $('.calendar-month').css('opacity', '0.2');
            var year = $('#InputYear').val();
            var day_id = '{{$future['day_id']}}';
            var name_day = '{{$future['name_day']}}';
            var num_month = '{{$detailMonth['today']['num_month']}}';
            var formData = new FormData();
            formData.append('year', year);
            formData.append('day_id', day_id);
            formData.append('name_day', name_day);
            formData.append('num_month', num_month);
            formData.append('host_id', {{$hostModel->id}});
            // Send data with ajax
            $.ajaxSetup({
                headers: {
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                }
            });
            $.ajax({
                url: '{{route('CalendarChangeUserNext')}}',
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
            $('#RowLoading').html('<img style="width:50px;" src="{{asset('backend/img/img_loading/loading_calendar.gif')}}"/>');
            $('.calendar-month').css('opacity', '0.2');
            var year = $('#InputYear').val();
            var day_id = '{{$prev['day_id']}}';
            var name_day = '{{$prev['name_day']}}';
            var num_month = '{{$detailMonth['today']['num_month']}}';
            var formData = new FormData();
            formData.append('year', year);
            formData.append('day_id', day_id);
            formData.append('name_day', name_day);
            formData.append('num_month', num_month);
            formData.append('host_id', {{$hostModel->id}});
            // Send data with ajax
            $.ajaxSetup({
                headers: {
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                }
            });
            $.ajax({
                url: '{{route('CalendarChangeUserPrev')}}',
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


        $('#InputDateFrom').click(function () {
            ResetCalendar();
        });



        $('#BtnClear').click(function () {
            ResetCalendar();
        });


        /** Require Method */
        function ResetCalendar() {
            $('#PreFactor').html('');
            $('.box-calendar').removeClass('display-none');
            $('#InputDateFrom').val('');
            $('#InputDateTo').val('');
            $('.calendar-day-item').removeClass('border-hover');
            $('.calendar-day-item').removeClass('calendar-hover');
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
            // clear price previous calculate ...

        }

        function AlertMessage(title, message, status="warning") {
            $.Toast("<p>" + title + "</p>", "<p>" + message + "</p>", status, {
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
    </script>
</div>