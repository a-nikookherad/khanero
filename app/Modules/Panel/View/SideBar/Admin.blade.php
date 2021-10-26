<div class="tab-content sidetabs">
    <div class="tab-pane active" id="home">
        <ul class="sidemenu">
            {{--<li class="sidebar-header">منو</li>--}}
            <li>
                <a href="{{ route('AdminDashboard') }}">
                    <span class="icon"><i class="fa fa-dashboard"></i></span>
                    <span class="name">داشبورد</span>
                    {{--<span class="number pull-left"><span class="label label-primary">5</span></span>--}}
                </a>
            </li>
            <li>
                <a target="_blank" href="{{ route('HomePage') }}">
                    <span class="icon"><i class="fa fa-dashboard"></i></span>
                    <span class="name">صفحه اصلی سایت</span>
                </a>
            </li>

            <li>
                <a href="{{ route('IndexHost', ['type' => 'all']) }}">
                    <span class="icon"><i class="fa fa-home"></i></span>
                    <span class="name">اقامتگاه ها</span>
                    {{--<span class="number pull-left"><span class="label label-primary">5</span></span>--}}
                </a>
            </li>


            <li>
                <a href="{{ route('IndexReserve') }}">
                    <span class="icon"><i class="fa fa-home"></i></span>
                    <span class="name">رزروها</span>
                    {{--<span class="number pull-left"><span class="label label-primary">5</span></span>--}}
                </a>
            </li>

{{--            <li>--}}
{{--                <a href="javascript:void(0);">--}}
{{--                    <span class="icon"><i class="fa fa-envelope-o"></i></span>--}}
{{--                    <span class="name">مجتمع ها</span>--}}
{{--                    <span class="arrow"><i class="arrow fa fa-angle-left pull-left"></i></span>--}}
{{--                </a>--}}
{{--                <ul class="sidebar-dropdown">--}}
{{--                    <li class="sidebar-dropdown-title"><p>مجتمع ها</p></li>--}}
{{--                    <li><a href="{{ route('IndexIntegrated') }}">مجتمع های ثبت شده</a></li>--}}

{{--                </ul>--}}
{{--            </li>--}}


            <li>
                <a href="{{ route('IndexUser') }}">
                    <span class="icon"><i class="fa fa-users"></i></span>
                    <span class="name">کاربرها</span>
                    {{--<span class="number pull-left"><span class="label label-primary">5</span></span>--}}
                </a>
            </li>


            <li>
                <a href="javascript:void(0);">
                    <span class="icon"><i class="fa fa-chain-broken"></i></span>
                    <span class="name">گزارشات</span>
                    <span class="arrow"><i class="arrow fa fa-angle-left pull-left"></i></span>
                </a>
                <ul class="sidebar-dropdown">
                    <li class="sidebar-dropdown-title"><p>گزارشات</p></li>
                    <li><a href="">واریزی ها</a></li>
{{--                    <li><a href="{{ route('IndexReportCredit') }}">کیف پول</a></li>--}}
{{--                    <li><a href="{{ route('IndexAllCredit') }}">حساب های کل</a></li>--}}
{{--                    <li><a href="{{ route('IndexReportReserve') }}">رزروها</a></li>--}}
{{--                    <li><a href="{{ route('IndexReportChart') }}">نمودار</a></li>--}}
                </ul>
            </li>

            <li>
                <a href="javascript:void(0);">
                    <span class="icon"><i class="fa fa-chain-broken"></i></span>
                    <span class="name">مدیریت محتوا</span>
                    <span class="arrow"><i class="arrow fa fa-angle-left pull-left"></i></span>
                </a>
                <ul class="sidebar-dropdown">
                    <li class="sidebar-dropdown-title"><p>مدیریت محتوا</p></li>
                    <li><a href="{{ route('IndexContent') }}">نمایش محتویات</a></li>
                </ul>
            </li>

            <li>
                <a href="javascript:void(0);">
                    <span class="icon"><i class="fa fa-gears"></i></span>
                    <span class="name">تنظیمات</span>
                    <span class="arrow"><i class="arrow fa fa-angle-left pull-left"></i></span>
                </a>
                <ul class="sidebar-dropdown">
                    <li class="sidebar-dropdown-title"><p>تنظیمات</p></li>
                    <li><a href="">مدیریت صفحه اصلی</a></li>
                    <li><a href="">مدیریت اسلاید شهرها</a></li>
{{--                    <li><a href="{{route('IndexSection')}}">مدیریت صفحه اصلی</a></li>--}}
{{--                    <li><a href="{{route('IndexSlideShow')}}">مدیریت اسلاید شهرها</a></li>--}}
                </ul>
            </li>

{{--            <li>--}}
{{--                <a href="javascript:void(0);">--}}
{{--                    <span class="icon"><i class="fa fa-gears"></i></span>--}}
{{--                    <span class="name">تقویم</span>--}}
{{--                    <span class="arrow"><i class="arrow fa fa-angle-left pull-left"></i></span>--}}
{{--                </a>--}}
{{--                <ul class="sidebar-dropdown">--}}
{{--                    <li class="sidebar-dropdown-title"><p>تقویم</p></li>--}}
{{--                    <li><a href="{{route('IndexCalendar')}}">مدیریت تقویم</a></li>--}}
{{--                </ul>--}}
{{--            </li>--}}

            <li>
                <a href="javascript:void(0);">
                    <span class="icon"><i class="fa fa-gears"></i></span>
                    <span class="name">امکانات</span>
                    <span class="arrow"><i class="arrow fa fa-angle-left pull-left"></i></span>
                </a>
                <ul class="sidebar-dropdown">
                    <li class="sidebar-dropdown-title"><p>امکانات</p></li>
                    <li><a href="{{route('IndexPossibilities')}}">مشاهده امکانات</a></li>
                    <li><a href="{{route('IndexHomeType')}}">نوع خانه</a></li>
                    <li><a href="{{route('IndexBuildingType')}}">نوع ساختمان</a></li>
                    <li><a href="{{route('IndexPositionType')}}">موقعیت ساختمان</a></li>
{{--                    <li><a href="{{route('IndexPositionType')}}">معرفی شهرها</a></li>--}}
                </ul>
            </li>

            <li>
                <a href="javascript:void(0);">
                    <span class="icon"><i class="fa fa-gears"></i></span>
                    <span class="name">قوانین سایت</span>
                    <span class="arrow"><i class="arrow fa fa-angle-left pull-left"></i></span>
                </a>
                <ul class="sidebar-dropdown">
                    <li class="sidebar-dropdown-title"><p>قوانین سایت</p></li>
                    <li><a href="{{route('IndexRule')}}">مشاهده قوانین</a></li>
                </ul>
            </li>

            <li>
                <a href="javascript:void(0);">
                    <span class="icon"><i class="fa fa-flag-o"></i></span>
                    <span class="name">مدیریت شهرها</span>
                    <span class="arrow"><i class="arrow fa fa-angle-left pull-left"></i></span>
                </a>
                <ul class="sidebar-dropdown">
                    <li class="sidebar-dropdown-title"><p>مدیریت شهرها</p></li>
                    <li><a href="{{ route('IndexTownship') }}">شهرستان ها</a></li>
                    {{--<li><a href="{{ route('IndexCity') }}">شهر ها</a></li>--}}
                    {{--<li><a href="{{ route('IndexArea') }}">مناطق</a></li>--}}
                    {{--<li><a href="{{ route('IndexDistrict') }}">محلات</a></li>--}}
                </ul>
            </li>

            <li>
                <a href="javascript:void(0);">
                    <span class="icon"><i class="fa fa-flag-o"></i></span>
                    <span class="name">نظرات و امتیازات</span>
                    <span class="arrow"><i class="arrow fa fa-angle-left pull-left"></i></span>
                </a>
                <ul class="sidebar-dropdown">
                    <li class="sidebar-dropdown-title"><p>نظرات و امتیازات</p></li>
                    <li><a href="{{ route('IndexRateAndComment') }}">مشاهده نظرات و امتیازات</a></li>
                </ul>
            </li>

            <li>
                <a href="javascript:void(0);">
                    <span class="icon"><i class="fa fa-envelope-o"></i></span>
                    <span class="name">خروج</span>
                    <span class="arrow"><i class="arrow fa fa-angle-left pull-left"></i></span>
                </a>
                <ul class="sidebar-dropdown">
                    <li class="sidebar-dropdown-title"><p>خروج</p></li>
                    <li><a href="{{ route('Logout') }}">خروج از سیستم</a></li>

                </ul>
            </li>
        </ul>
    </div>
</div>


@section('script')
    <script type="text/javascript">
        var id = {{ auth()->user()->id }};
        $.ajax({
            url:"{{ url('message/get/number').'/'}}"+id,
            method:"get",
        }).done(function(returnData){
            $('.numberMessageUser').text(returnData);
        });
    </script>
@endsection