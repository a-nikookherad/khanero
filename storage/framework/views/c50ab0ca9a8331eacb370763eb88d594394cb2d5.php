
<?php $__env->startSection('title'); ?>
	ویلا :: <?php echo e($infoTownshipModel->getTownship->name); ?>

<?php $__env->stopSection(); ?>
<?php $__env->startSection('style'); ?>
	<style>
		.title-section {
			color: #6f6f6f;
			padding-bottom: 10px;
		}

		.title-section span {
			font-size: 18px;
			padding-left: 5px;
		}
		.title-section p {
			font-size: 15px;
			line-height: 30px;
		}
		.content-Township {
			line-height: 30px;
			text-align: justify;
		}
		.container-section .row.top {
			padding: 15px 0px;
		}
		img.image-Township {
			border-radius: 6px;
			border: 1px solid #e4e4e4;
			padding: 2px;
			box-shadow: 1px 0px 16px #dedede;
		}
		p.rows-detail {
			padding: 5px 0px;
		}
		.background-top {
			background-image: url("<?php echo e(asset('Uploaded/InfoCity/Township/'.$infoTownshipModel->img)); ?>");
			height: 200px;
			background-position: center;
			background-size: cover;
			filter: blur(2px);
			box-shadow: -2px 9px 13px #00000063;
			margin-bottom: 17px;
			border-radius: 15px;
			margin: 5px;
		}
		.container-section.box-detail {
			background-image: url("<?php echo e(asset('Uploaded/info-province.png')); ?>");
			background-position: top;
			background-repeat: no-repeat;
			background-size: contain;
		}
		
		.box-title h3 {
			line-height: 125px;
		}
		.box-title {
			position: absolute;
			left: 50%;
			top: 95px;
			font-size: 12px;
			transform: translate(-50%, -50%);
			background: #230c0059;
			height: 170px;
			width: 170px;
			text-align: center;
			border-radius: 50%;
			/* border: 1px solid #fe5512; */
			color: #f1f1f1;
			box-shadow: 0px 11px 19px 0px #000000cf;
		}
	</style>
<?php $__env->stopSection(); ?>
<?php $__env->startSection('content'); ?>
	<div class="background-top">
	
	</div>
	<div class="box-title">
		<h3 class="title-name">
			<?php echo e($infoTownshipModel->getTownship->name); ?>

		</h3>
	</div>
	<div class="container-section box-detail">
		<div class="row top">
			<div class="col-md-8 title-section">
				
				<p class="rows-detail">
					<span class="text-green">جمعیت :</span> <?php echo e($infoTownshipModel->population); ?>

				</p>
				<p class="rows-detail">
					<span class="text-green">مساحت :</span> <?php echo e($infoTownshipModel->area); ?>

				</p>
				<p class="rows-detail">
					<span class="text-green">پیش شماره تلفن :</span> <?php echo e($infoTownshipModel->area_code); ?>

				</p>
				<p class="rows-detail">
					<span class="text-green">پلاک خودروها :</span> <?php echo e($infoTownshipModel->plate_car); ?>

				</p>
				<p class="rows-detail">
					<span class="text-green">جاذبه های گردشگری :</span> <?php echo e($infoTownshipModel->important_attractions); ?>

				</p>
				<p>
				<br />
				<div id="openweathermap-widget-19"></div>
				<script>window.myWidgetParam ? window.myWidgetParam : window.myWidgetParam = [];  window.myWidgetParam.push({id: 19,cityid: '112931',appid: 'c5a9a224f7a59d89cff7b56131af4a6f',units: 'metric',containerid: 'openweathermap-widget-19',  });  (function() {var script = document.createElement('script');script.async = true;script.charset = "utf-8";script.src = "//openweathermap.org/themes/openweathermap/assets/vendor/owm/js/weather-widget-generator.js";var s = document.getElementsByTagName('script')[0];s.parentNode.insertBefore(script, s);  })();</script>

				</p>
			</div>
			<div class="col-md-4 text-left">
				<img class="image-Township" src="<?php echo e(asset('Uploaded/InfoCity/Township/'.$infoTownshipModel->img)); ?>" />
			</div>
		</div>





		<div class="row">
			<div class="col-md-12">
				<div class="content-Township">
					<?php echo $infoTownshipModel->content; ?>

				</div>
			</div>
		</div>
	</div>

<?php $__env->stopSection(); ?>

<?php $__env->startSection('script'); ?>

<?php $__env->stopSection(); ?>

<?php echo $__env->make('frontend.MasterPage.Layout', array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>