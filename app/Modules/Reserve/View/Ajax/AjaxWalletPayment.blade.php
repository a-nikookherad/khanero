@if(auth()->user()->credit >= $arrayPrice['totalPrice'])
	<form method="post" action="{{route('PaymentReserveWithWallet')}}">
		{{csrf_field()}}
		<input type="hidden" value="{{$arrayPrice['code']}}" name="code">
		<h4 class="text-success">موجودی کافی</h4>
		<h5>موجودی شما : {{number_format(auth()->user()->credit)}} تومان</h5>
		<h5>هزینه پرداختی : {{$arrayPrice['totalPrice']}} تومان</h5>
		<button type="submit" class="btn btn-green btn-block">پرداخت</button>
	</form>
@else
	<h4 class="text-danger">موجودی کافی نیست</h4>
	<h5>موجودی شما : {{number_format(auth()->user()->credit)}} تومان</h5>
	<h5>هزینه پرداختی : {{$arrayPrice['totalPrice']}} تومان</h5>
	<h5>میزان اعتبار مورد نیاز : {{number_format($arrayPrice['totalPrice'] - auth()->user()->credit)}} تومان </h5>
	<a href="{{route('IndexChargeWallet')}}" class="btn btn-green btn-block">افزایش اعتبار</a>
@endif
