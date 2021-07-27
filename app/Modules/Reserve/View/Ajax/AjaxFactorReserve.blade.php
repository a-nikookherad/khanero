<style>
	span.total-price-factor {
		padding-right: 15px;
		border-right: 2px solid #cdcdcd;
		margin-right: 15px;
	}
</style>
<div class="box-factor-reserve">
	<div class="row">
		<div class="col-md-12 text-right">
			<p class="title-price">
				<span class="">
					{{count($array_price_date)}} روز اقامت
				</span>
				<span class="total-price-factor">
					{{number_format($total_price_reserve + ($extraPriceForPerson * count($array_price_date)))}} تومان
				</span>
				@if($total_sum_guest > 0)
					<span class="total-price-factor">
						نفرات اضافی ({{$total_sum_guest}} نفر)
					</span>
					<span class="total-price-factor">
						هزینه هر نفر اضافه {{number_format($hostModel->one_person_price)}} تومان
					</span>
				@endif
			</p>
		</div>
	</div>
</div>
<br />

<table class="table table-bordered text-center">
	<thead>
		<tr>
			<th>ردیف</th>
			<th>تاریخ رزرو</th>
			<th>روز هفته</th>
			<th>قیمت پایه</th>
			<th>روز خاص</th>
			<th>قیمت روز خاص</th>
			<th>درصد تخفیف</th>
			<th>توضیحات</th>
			<th>نفرات اضافی هرشب</th>
			<th>قیمت نهایی</th>
		</tr>
	</thead>
	<tbody>
		@php
			$total_price = 0;
		@endphp
		@foreach($array_price_date as $key => $value)
			<tr>
				<td>{{$key+1}}</td>
				<td>{{\Morilog\Jalali\Jalalian::forge($value['date'])->format('Y/m/d')}}</td>
				<td>{{$value['day_name']}}</td>
				<td>{{number_format($value['day_price'])}}</td>
				<td>
					@if($value['special'] == 1)
						<i class="fas fa-check-circle text-success"></i>
					@else
						<i class="fas fa-times-circle text-danger"></i>
					@endif
				</td>
				<td>
					@if($value['special'] == 1)
						{{number_format($value['special_price'])}}
					@else
						------
					@endif
				</td>
				<td>{{$value['percent']}}</td>
				<td>
					<a class="text-primary" title="{{$value['description']}}">
						<i class="fas fa-info-circle"></i>
					</a>
				</td>
				<td>
					@if($value['extra_price_person'] == 0)
						ظرفیت استاندارد
					@else
						{{number_format($value['extra_price_person'])}}
					@endif
				</td>
				<td>
					@if($value['extra_price_person'] == 0)
						{{number_format($value['final_price'])}}
					@else
						{{number_format($value['final_price'] + $value['extra_price_person'])}}
					@endif
				</td>
			</tr>
		@endforeach
		<tr>
			<td colspan="1">{{$key+2}}</td>
			<td colspan="7" class="text-danger">نفرات اضافی</td>
			<td colspan="2" class="text-danger">
				{{number_format($extraPriceForPerson * count($array_price_date))}} تومان
			</td>
		</tr>
		<tr>
			<td colspan="1">{{$key+3}}</td>
			<td colspan="7" class="text-danger">قیمت کل</td>
			<td colspan="2" class="text-danger">
				{{number_format($total_price_reserve + ($extraPriceForPerson * count($array_price_date)))}} تومان
			</td>
		</tr>
	</tbody>
</table>