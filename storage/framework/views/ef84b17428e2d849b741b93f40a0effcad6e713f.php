<?php if(auth()->user()->credit >= $arrayPrice['totalPrice']): ?>
	<form method="post" action="<?php echo e(route('PaymentReserveWithWallet')); ?>">
		<?php echo e(csrf_field()); ?>

		<input type="hidden" value="<?php echo e($arrayPrice['code']); ?>" name="code">
		<h4 class="text-success">موجودی کافی</h4>
		<h5>موجودی شما : <?php echo e(number_format(auth()->user()->credit)); ?> تومان</h5>
		<h5>هزینه پرداختی : <?php echo e($arrayPrice['totalPrice']); ?> تومان</h5>
		<button type="submit" class="btn btn-green btn-block">پرداخت</button>
	</form>
<?php else: ?>
	<h4 class="text-danger">موجودی کافی نیست</h4>
	<h5>موجودی شما : <?php echo e(number_format(auth()->user()->credit)); ?> تومان</h5>
	<h5>هزینه پرداختی : <?php echo e($arrayPrice['totalPrice']); ?> تومان</h5>
	<h5>میزان اعتبار مورد نیاز : <?php echo e(number_format($arrayPrice['totalPrice'] - auth()->user()->credit)); ?> تومان </h5>
	<a href="<?php echo e(route('IndexChargeWallet')); ?>" class="btn btn-green btn-block">افزایش اعتبار</a>
<?php endif; ?>
