<style>
    .sidemenu img {
        width: 40px;
        height: 40px;
        border-radius: 50%;
        display: inline;
        margin-left: 3px;
    }
</style>
<div class="tab-content sidetabs">
    <ul class="sidemenu">
        <li>
            <a>
                @if(auth()->user()->avatar == 'default-user.png')
                    <img class="img-avatar" src="{{ asset('backend/img/avatar.png')}}" alt="avatar">
                @else
                    <img class="img-avatar" src="{{asset('Uploaded/User/Profile/'.auth()->user()->avatar)}}" alt="avatar">
                @endif
                <span class="full-name">{{auth()->user()->first_name . ' ' . auth()->user()->last_name}}</span>
            </a>
        </li>
        <li>
            <a target="_blank" href="{{ route('HomePage') }}">
                <span class="name">بازگشت به صفحه نخست</span>
            </a>
        </li>
        <li class="li-profile">
            <a href="{{ route('EditUser') }}">
                @php
                    if(auth()->user()->avatar != '') {
						$avatar = auth()->user()->avatar;
					} else {
						$avatar = 'default-user.png';
					}
                @endphp
                <span class="name">حساب کاربری</span>
            </a>
        </li>
        <li class="li-reserve">
            <a target="" href="{{ route('IndexReserve') }}">
                <span class="name">لیست رزرو ها</span>
            </a>
        </li>
        <li class="li-message">
            <a target="" href="{{ route('IndexMessage') }}">
                <span class="name">پیام ها</span>
            </a>
        </li>
        <li class="li-favorite">
            <a target="" href="{{ route('IndexFavorite') }}">
                <span class="name">علاقه مندی ها</span>
            </a>
        </li>

        <li class="li-comment">
            <a target="" href="{{ route('IndexRateAndComment') }}">
                <span class="name">نظر ها</span>
            </a>
        </li>

        <li class="li-host">
            <a target="" href="{{ route('IndexHost', ['type' => 'all']) }}">
                <span class="name">اقامتگاه های من</span>
            </a>
        </li>
        <li class="li-create-host">
            <a target="" href="{{ route('CreateHost') }}">
                <span class="name">ثبت اقامتگاه</span>
            </a>
        </li>
        <li class="li-invite">
            <a target="" href="{{route('InviteUser')}}">
                <span class="name">دعوت از دوستان</span>
            </a>
        </li>
        <li class="li-payment">
            <a target="" href="{{route('IndexPayment')}}">
                <span class="name">امور مالی</span>
            </a>
        </li>
        <li>
            <a target="" href="{{ route('Logout') }}">
                <span class="name">خروج</span>
            </a>
        </li>
    </ul>
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