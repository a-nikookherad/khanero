<link rel="stylesheet" href="{{asset('frontend/css/calendar.css')}}" />
<style>
    .calendar-day-today {
        border: 1px solid #5a9ea7;
    }
    .left-month,
    .right-month {
        display: inline-block;
        font-size: 18px;
    }
    .left-month {
        float: left;
        margin-left: 20px;
    }
    .right-month {
        float: right;
        margin-right: 20px;
    }
    .left-month i, .right-month i {
        border: 1px solid #c2c7c8;
        padding: 4px 12px;
        border-radius: 5px;
        background: #e5edee;
        cursor: pointer;
        transition: .3s;
    }
    .left-month i:hover, .right-month i:hover {
        background: #fafbfb;
        transition: .3s;
    }
    .hover-day {
        background: #c1dbde;
    }
    .last-day-item {

    }
</style>
@php
    $past_day = $detailMonth['start_day_month']['day_id'] - 1; // تعداد روز های گذشته شده از هفته برای محاسبه شروع تقویم
    $future = end($detailMonth['detail_days']); // تعداد روز برای تکمیل کردن اخر هفته که خالی نباشد
    $prev = $detailMonth['detail_days'][0];
    $future_day = abs($future['day_id'] - 7);
@endphp
<div class="P-Calendar">
    <div class="each-mounth">
        <div class="head-Calendar">
            {{--            <h5 class="name-mounth">فروردین</h5>--}}
            <p class="number-year">
                <span class="left-month btn__left"> <i class="fas fa-arrow-left"></i> </span>
                {{$detailMonth['today']['name_month'].' '.$detailMonth['today']['year']}}
                <span class="right-month btn__right"> <i class="fas fa-arrow-right"></i> </span>
            </p>
        </div>
        <div class="body-Calendar">
            <ul class="name-week">
                <li class="Ename-week">ش</li>
                <li class="Ename-week">ی</li>
                <li class="Ename-week">د</li>
                <li class="Ename-week">س</li>
                <li class="Ename-week">چ</li>
                <li class="Ename-week">پ</li>
                <li class="Ename-week">ج</li>
            </ul>
            <ul class="day-weeks">
                @for($i = 0; $i < $past_day; $i++)
                    <li class="each-day dis-able">
                        <span class="number-day">&nbsp;</span>
                        <span class="price-day">&nbsp;</span>
                    </li>
                @endfor
                @foreach($detailMonth['detail_days'] as $key => $value)
                    <li class="each-day calendar-day-item
                        @if($value['day_id'] == 7) holy-day @endif
                    @if($value['day'] < $detailMonth['today']['day'] || $value['block_day'] == 1) last-day-item @endif
                    @if($value['day'] == $detailMonth['today']['day']) calendar-day-today @endif
                            date{{$value['day']}}"
                    >
                        <span class="number-day calendar-day-item-date">{{$value['day']}}</span>
                        <span class="price-day">{{number_format(substr($value['price'],0,-1))}}</span>
                    </li>
                @endforeach
                @for($i = 0; $i < $future_day; $i++)
                    <li class="each-day dis-able">
                        <span class="number-day">&nbsp;</span>
                        <span class="price-day">&nbsp;</span>
                    </li>
                @endfor
                {{--                <li class="each-day holy-day peyk-day dis-able">--}}
                {{--                    <span class="number-day">11</span>--}}
                {{--                    <span class="price-day">1700</span>--}}
                {{--                </li>--}}
            </ul>
        </div>
    </div>
</div>

<input type="hidden" id="MonthNumberNow" value="{{$detailMonth['today']['num_month']}}"/>

<script>

    var year = {{$detailMonth['today']['year']}};
    var month = {{$detailMonth['today']['num_month']}};

    var day = 0;
    var from_date = $('#InputDateFrom').text();
    var to_date = $('#InputDateTo').text();
    var numHover,
        start_date,
        num = null;
    var calendar_day_item = $('.calendar-day-item');
    var last_day_item = $('.last-day-item');
    var check_block_day_calendar = 0;
    var check_block_day;

    $('ul li.calendar-day-item').click(function () {

        if($(this).hasClass('last-day-item')) {
            AlertToast('خطا در ارسال اطلاعات', 'شما مجاز به انتخاب این تاریخ برای رزرو نیستید.', 'warning');
            return false;
        } else {
            num = parseInt($(this).find('.calendar-day-item-date').text());
            day = $(this).find('.calendar-day-item-date').text();
            var date = year + '/' + month + '/' + day;
            if($('#InputDateFrom').val() == '') {
                $('#InputDateFrom').val(date);
            } else if($('#InputDateTo').text() == '' && $('#InputDateFrom').val() != '') {
                $('#InputDateTo').val(date);
                $('.calendar-box').addClass('display-none');
                $('.detail-date-box').removeClass('display-none');
            }
        }

        /** block date after first reserve*/
        start_date = parseInt($(this).find('.calendar-day-item-date').text());

        /** before first date */
        $.each(calendar_day_item, function(index_2, element_2){
            var num_2 = parseInt($(element_2).find('.calendar-day-item-date').text());
            if(num_2 < start_date) {
                if(!$(element_2).hasClass('last-day-item')) {
                    $(element_2).addClass('last-day-item');
                    $(element_2).addClass('temporary-block'); // temporary-block for change again calendar
                }
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

        if(check_block_day > 0) {
            /** block date after first block date */
            $.each(calendar_day_item, function(index, element){
                var num = parseInt($(element).find('.calendar-day-item-date').text());
                if((start_month == month && num >= check_block_day) || month > start_month || year > start_year) {
                    $(element).addClass('last-day-item');
                    $(element).addClass('temporary-block'); // temporary-block for change again calendar
                }
            });
        }
        // Calculate Price After Reserve
        if($('#InputDateFrom').val() != '' && $('#InputDateTo').val() != '') {
            CalculateFactor('calculate');
        }
    });


    // calendar_day_item.length
    $('ul.day-weeks .normal-day').hover(function () {
        /** remove  from all object calendar */
        $('.each-day').removeClass('hover-day');
        $(this).addClass('border-hover');
        /** *******************************************/
        if($('#InputDateFrom').text() == 'تاریخ ورود') {
            var numHover = parseInt($(this).find('.number-day').text());
            for (var i = start_date; i <= numHover; i++) {
                $('.date' + i).addClass('hover-day');
            }
        }
    });




    $('.btn__left').click(function () {
        $('#RowLoading').html('<img style="width:50px;" src="{{asset('backend/img/img_loading/loading_calendar.gif')}}"/>');
        $('.calendar-month').css('opacity', '0.2');
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
                $('.calendar-box').html(data);
            }
        });
    });

    $('.btn__right').click(function () {
        if(month == $('#InputMonth').val()) {
            alert();
            return false;
        }
        $('#RowLoading').html('<img style="width:50px;" src="{{asset('backend/img/img_loading/loading_calendar.gif')}}"/>');
        $('.calendar-month').css('opacity', '0.2');
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
                $('.calendar-box').html(data);
            }
        });
    });

</script>