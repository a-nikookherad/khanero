<form method="post" action="{{route('PaymentReserve')}}">
	{{csrf_field()}}
	<input type="hidden" value="{{$arrayPrice['code']}}" name="code">
	<h5>کل هزینه : {{number_format($arrayPrice['totalPrice'])}}</h5>
	<h5>پیش پرداخت : {{number_format($arrayPrice['prePrice'])}}</h5>
	<h5>درصد سایت : {{number_format($arrayPrice['wage'])}}</h5>
	<hr />
	<div class="row">
		<div class="col-md-6">
			<div class="form-group">
				<input type="radio" name="type" value="1" id="AllPrice" checked>
				<label for="AllPrice">کل مبلغ {{number_format($arrayPrice['totalPrice'])}} تومان</label>
			</div>
		</div>
		@if($arrayPrice['prePrice'] != 0)
			<div class="col-md-6">
				<div class="form-group">
					<input type="radio" name="type" value="2" id="PrePrice">
					<label for="PrePrice">پیش پرداخت {{number_format($arrayPrice['prePrice']+$arrayPrice['wage'])}} تومان</label>
				</div>
			</div>
		@endif
	</div>
	<button type="submit" class="btn btn-green btn-block">پرداخت</button>
</form>