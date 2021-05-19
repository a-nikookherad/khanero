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
					<?php echo e(count($array_price_date)); ?> روز اقامت
				</span>
				<span class="total-price-factor">
					<?php echo e(number_format($total_price_reserve + ($extraPriceForPerson * count($array_price_date)))); ?> تومان
				</span>
				<?php if($total_sum_guest > 0): ?>
					<span class="total-price-factor">
						نفرات اضافی (<?php echo e($total_sum_guest); ?> نفر)
					</span>
					<span class="total-price-factor">
						هزینه هر نفر اضافه <?php echo e(number_format($hostModel->one_person_price)); ?> تومان
					</span>
				<?php endif; ?>
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
		<?php 
			$total_price = 0;
		 ?>
		<?php $__currentLoopData = $array_price_date; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $key => $value): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
			<tr>
				<td><?php echo e($key+1); ?></td>
				<td><?php echo e(\Morilog\Jalali\Facades\jDate::forge($value['date'])->format('Y/m/d')); ?></td>
				<td><?php echo e($value['day_name']); ?></td>
				<td><?php echo e(number_format($value['day_price'])); ?></td>
				<td>
					<?php if($value['special'] == 1): ?>
						<i class="fas fa-check-circle text-success"></i>
					<?php else: ?>
						<i class="fas fa-times-circle text-danger"></i>
					<?php endif; ?>
				</td>
				<td>
					<?php if($value['special'] == 1): ?>
						<?php echo e(number_format($value['special_price'])); ?>

					<?php else: ?>
						------
					<?php endif; ?>
				</td>
				<td><?php echo e($value['percent']); ?></td>
				<td>
					<a class="text-primary" title="<?php echo e($value['description']); ?>">
						<i class="fas fa-info-circle"></i>
					</a>
				</td>
				<td>
					<?php if($value['extra_price_person'] == 0): ?>
						ظرفیت استاندارد
					<?php else: ?>
						<?php echo e(number_format($value['extra_price_person'])); ?>

					<?php endif; ?>
				</td>
				<td>
					<?php if($value['extra_price_person'] == 0): ?>
						<?php echo e(number_format($value['final_price'])); ?>

					<?php else: ?>
						<?php echo e(number_format($value['final_price'] + $value['extra_price_person'])); ?>

					<?php endif; ?>
				</td>
			</tr>
		<?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
		<tr>
			<td colspan="1"><?php echo e($key+2); ?></td>
			<td colspan="7" class="text-danger">نفرات اضافی</td>
			<td colspan="2" class="text-danger">
				<?php echo e(number_format($extraPriceForPerson * count($array_price_date))); ?> تومان
			</td>
		</tr>
		<tr>
			<td colspan="1"><?php echo e($key+3); ?></td>
			<td colspan="7" class="text-danger">قیمت کل</td>
			<td colspan="2" class="text-danger">
				<?php echo e(number_format($total_price_reserve + ($extraPriceForPerson * count($array_price_date)))); ?> تومان
			</td>
		</tr>
	</tbody>
</table>