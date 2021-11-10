<ul>
        <li class="user-info d-flex align-items-center">
            <img class="pc-user mw-100" src="{{auth()->user()->avatar?asset(auth()->user()->avatar):''}}"/>
            <h5 class="name-user">{{auth()->user()->first_name . ' ' . auth()->user()->last_name}}</h5>
        </li>

        <li><a class="item-login" href="{{route('EditUser')}}"><i
                        class="far fa-user"></i>حساب کاربری</a></li>
        <li><a class="item-login" href="{{route('IndexReserve')}}"><i
                        class="fas fa-suitcase-rolling"></i>لیست رزرو ها</a>
        </li>
        <li><a class="item-login" href="{{route('IndexMessage')}}"><i
                        class="far fa-envelope"></i>پیام ها</a></li>
        <li><a class="item-login" href="{{route('IndexFavorite')}}"><i
                        class="far fa-heart"></i>علاقه مندی ها</a></li>
        <li><a class="item-login" href="#"><i class="fas fa-lightbulb"></i>نظر
                ها</a></li>
        <li><a class="item-login"
               href="{{route('IndexHost', ['type' => 'all'])}}"><i
                        class="fas fa-home"></i>اقامتگاه های من</a></li>
        <li><a class="item-login" href="{{route('CreateHost')}}"><i
                        class="fas fa-folder-plus"></i>ثبت اقامتگاه</a></li>
        <li><a class="item-login" href="#"><i class="fas fa-share-alt"></i>دعوت
                از دوستان</a></li>
        <li><a class="item-login" href="#"><i class="fas fa-money-check"></i>امور
                مالی</a></li>
        <li><a class="item-login" href="{{route('Logout')}}"><i
                        class="fas fa-sign-out-alt"></i>خروج</a></li>
    </ul>