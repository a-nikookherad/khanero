@if(auth()->check())
    @if(auth()->user()->role_id == 1)
        <span>
        <a href="{{route('AdminDashboard')}}">
             پنل مدیریتی
        </a>
    </span>
    @else
        <span>
        <a class="menu-user">
          {{auth()->user()->first_name . ' ' . auth()->user()->last_name}}
        </a>
    </span>
    @endif
@endif