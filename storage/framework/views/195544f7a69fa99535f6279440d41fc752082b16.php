
<?php $__env->startSection('title',TitlePage($userModel->first_name. ' ' .$userModel->last_name)); ?>
<?php $__env->startSection('style'); ?>
	<style>
		div#ExtraContent {
			margin-top: 75px;
		}

		img.medal {
			width: 25px;
			height: 30px;
		}
	</style>
<?php $__env->stopSection(); ?>
<?php $__env->startSection('content'); ?>
	<div class="container">
		<div class="row">
			<div class="col-md-offset-2 col-md-2">
				<?php if($userModel->avatar != Null): ?>
					<div class="box-img">
						<img alt="<?php echo e($userModel->first_name. ' ' .$userModel->last_name); ?>" title="<?php echo e($userModel->first_name. ' ' .$userModel->last_name); ?>" src="<?php echo e(asset(\App\ImageManager::resize('Uploaded/User/Profile/'.$userModel->avatar,['width' => 200, 'height' => 200]))); ?>">
					</div>
				<?php else: ?>
					<div class="box-img">
						<img alt="<?php echo e($userModel->first_name. ' ' .$userModel->last_name); ?>" title="<?php echo e($userModel->first_name. ' ' .$userModel->last_name); ?>" src="<?php echo e(asset(\App\ImageManager::resize('Uploaded/User/Profile/default-user.png',['width' => 200, 'height' => 200]))); ?>">
					</div>
				<?php endif; ?>
				<?php if($userModel->confirm_user == 3): ?>
					<img src="<?php echo e(asset('frontend/images/medal.png')); ?>" class="medal">
					کاربر ویژه
				<?php endif; ?>
			</div>
			<div class="col-md-4">
				<div class="detail-profile">
					<h1><?php echo e($userModel->first_name. ' ' .$userModel->last_name); ?></h1>
                    <p><?php echo e($userModel->first_name); ?></p>
				</div>
			</div>
		</div>
	</div>

<?php $__env->stopSection(); ?>

<?php $__env->startSection('script'); ?>

<?php $__env->stopSection(); ?>

<?php echo $__env->make('frontend.MasterPage.Layout', array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>