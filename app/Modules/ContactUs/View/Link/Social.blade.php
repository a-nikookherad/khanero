<?php
$contactInfo = App\Modules\ContactUs\Controllers\ContactUsController::BottomInfo()
?>
<ul>
    <li>
        <a href="{{$contactInfo->telegram}}">
            <span class="flip"><img src="{{asset('frontend/images/telegaram.png')}}" data-loaded="true"></span>
            <span class="flop"><img src="{{asset('frontend/images/telegaram.png')}}" data-loaded="true"></span>
        </a>

    </li>
    <li>
        <a href="{{$contactInfo->instagram}}">
            <span class="flip"><img src="{{asset('frontend/images/instagram.png')}}" data-loaded="true"></span>
            <span class="flop"><img src="{{asset('frontend/images/instagram.png')}}" data-loaded="true"></span>
        </a>
    </li>
    <li>
        <a href="{{$contactInfo->aparat}}">
            <span class="flip"><img src="{{asset('frontend/images/aparat.png')}}" data-loaded="true"></span>
            <span class="flop"><img src="{{asset('frontend/images/aparat.png')}}" data-loaded="true"></span>
        </a>
    </li>
    <li>
        <a href="{{$contactInfo->whatsapp}}">
            <span class="flip"><img src="{{asset('frontend/images/whatasapp.png')}}" data-loaded="true"></span>
            <span class="flop"><img src="{{asset('frontend/images/whatasapp.png')}}" data-loaded="true"></span>
        </a>
    </li>
</ul>