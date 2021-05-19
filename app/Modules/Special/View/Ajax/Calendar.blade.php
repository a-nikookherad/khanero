<div id="BoxCalendar">
    <link href="{{asset('frontend/css/all.min.css')}}" rel="stylesheet">
    <link href="{{asset('frontend/css/style-calendar.css')}}" rel="stylesheet">
    {{--روز های گذشته  calendar-day-past--}}
    {{--امروز  calendar-day-today--}}
    {{--تعطیل  calendar-day-holidays--}}
    {{--خالی  calendar-day-noItem--}}
    @php
        //dd($detailMonth);
        $past_day = $detailMonth['start_day_month']['day_id'] - 1; // تعداد روز های گذشته شده از هفته برای محاسبه شروع تقویم
        $future = end($detailMonth['detail_days']); // تعداد روز برای تکمیل کردن اخر هفته که خالی نباشد
        $future_day = abs($future['day_id'] - 7);
    @endphp
    <div class="set__calendar">
        <header class="header__calendar">
            <button class="btn__right">
                <i class="fas fa-angle-right"></i>
            </button>
            <div class="title__calendar">
                {{$detailMonth['today']['day'].' '.$detailMonth['today']['name_month'].' '.$detailMonth['today']['year']}}
                <input type="hidden" value="{{$detailMonth['today']['year']}}" id="InputYear"/>
                <input type="hidden" value="{{$detailMonth['today']['num_month']}}" id="InputMonth"/>
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
                                <main class="calendar-day-item @if($value['day_id'] == 7) calendar-day-holidays @endif @if($value['day'] == $detailMonth['today']['day']) calendar-day-today @endif">
                                    <div class="info-container">
                                        <div class="calendar-day-item-date">{{$value['day']}}</div>
                                        <div class="calendar-day-item-price">۳۶۰</div>
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
                <div class="calendar-footer">
                    <div class="calendar-footer-txt">
                        <div class="calendar-price-tip">
                            {{--<i aria-hidden="true" class="fa fa-info-circle"></i>--}}
                            {{--<main> قیمت‌ به هزار تومان</main>--}}
                        </div>
                        {{--<div class="calendar-bookedDays">حداقل مدت رزرو: ۱ شب</div>--}}
                    </div>
                    <div class="footer-last-update">
                        {{--<main>آخرین بروزرسانی تقویم توسط میزبان:</main>--}}
                        {{--<main class="footer-last-update-date">۱۳۹۷/۰۹/۲۱</main>--}}
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
            // Send data with ajax
            $.ajaxSetup({
                headers: {
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                }
            });
            $.ajax({
                url: '{{route('CalendarChange')}}',
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