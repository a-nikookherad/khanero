<?php
$contactInfo = App\Modules\ContactUs\Controllers\ContactUsController::BottomInfo()
?>

<p>
	<img src="{{ asset('frontend/images/map.png') }}" alt="">
	<span>{{ $contactInfo->address }} </span>
</p>
<p>
	<img src="{{ asset('frontend/images/tel.png') }}" alt="">&nbsp;
	<span>{{ $contactInfo->phone }}</span>
</p>
<p>
	<img src="{{ asset('frontend/images/email.png') }}" alt="">&nbsp;
	<span>
        <a href="mailto:{{$contactInfo->email}}">{{ $contactInfo->email }}</a>
    </span>
</p>