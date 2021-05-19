
<?php $__env->startSection('title'); ?>
	<?php echo e(TitlePage('مهمان های من')); ?>

<?php $__env->stopSection(); ?>

<?php $__env->startSection('style'); ?>
	<link rel="stylesheet" href="<?php echo e(asset('backend/css/dataTables.bootstrap.css')); ?>">
	<link rel="stylesheet" href="<?php echo e(asset('backend/css/TableTools.css')); ?>">
	<style>
		#ToolTables_DataTables_Table_0_0 {
			display: none;
		}

		.img-host {
			width: 100%;
			transition: 0.5s;
			border-radius: 10px;
		}

		.img-host:hover {
			/*width: 100%;*/
			transition: 0.5s;
		}

		.box-reserve {
			padding: 15px 8px;
			border: 1px solid #ddd;
			margin: 10px 0px;
			border-radius: 5px;
			transition: .3s;
			cursor: pointer;
			background: #fcfcfc;
			box-shadow: none;
		



		}

		.box-reserve:hover {
			box-shadow: 1px 1px 4px 1px #13131340;
			transition: .3s;
			background: #fff;
		}

		.padding-top h5 {
			color: #ea6722;
			padding-top: 3px;
		}

		/*progress*/

		/* ============================= */

		.progressBar {
			/*background: #e77e5c;*/
			margin: 10px 0 0 0;
			padding: 0px;
			list-style: none;
			overflow: hidden;
		}

		.progressBar-item {
			display: inline-block;
			width: 24%;
			height: 44px;
			line-height: 44px;
			background-color: #c0c0c0;
			text-align: center;
			position: relative;
		}

		.progressBar-step {
			display: inline-block;
			line-height: 44px;
			text-indent: -9999px;
			width: 32px;
			height: 27px;
			background-color: #c04000;
			margin-top: 8px;
			direction: rtl;
		}

		.progressBar-item + .progressBar-item .progressBar-step {
			margin-left: 32px;
		}

		.progressBar-item:first-child {
			width: 20%;
		}

		.progressBar-item:last-child {
			width: 30%;
		}

		@media  only screen and (min-width: 768px) {
			.progressBar-step {
				width: 42px;
			}

			.progressBar-item:first-child,
			.progressBar-item:last-child {
				width: 24%;
			}
		}

		@media  only screen and (min-width: 1024px) {
			.progressBar-step {
				display: block;
				line-height: 44px;
				text-indent: 0;
				width: auto;
				height: auto;
				margin: 0;
				background-color: transparent;
			}
		}

		.progressBar-item.active {
			background-color: #36454f;
			color: #FFF;
		}

		.progressBar-item::before,
		.progressBar-item::after {
			content: " ";
			position: absolute;
			left: 0;
			top: -10px;
		}

		.progressBar-item + .progressBar-item::before {
			border-top: 32px solid transparent;
			border-bottom: 32px solid transparent;
			border-left: 32px solid #FFF;
			left: 0px;
		}

		.progressBar-item + .progressBar-item::after {
			border-top: 32px solid transparent;
			border-bottom: 32px solid transparent;
			border-left: 32px solid #c0c0c0;
			left: -10px;
		}

		.progressBar-item.active + .progressBar-item::after {
			border-left: 32px solid #36454f;
		}

		.progressBar {
			counter-reset: cartStep -1;
			direction: ltr;
		}

		.progressBar-item {
			counter-increment: cartStep;
		}

		.payment {
			padding: 10px 0px;
		}
		
		
		
		
		
		
		/*animate*/
		.animated-step {
			-webkit-animation-name: example; /* Safari 4.0 - 8.0 */
			-webkit-animation-duration: 4s; /* Safari 4.0 - 8.0 */
			-webkit-animation-iteration-count: infinite; /* Safari 4.0 - 8.0 */
			animation-name: example-animate;
			animation-duration: 2s;
			animation-iteration-count: infinite;
		}
		
		/* Safari 4.0 - 8.0 */
		@-webkit-keyframes example-animate {
			0%   {color: #e73f05;}
			50% {color:#36454f;}
			100% {color:#e73f05;}
		}
		
		/* Standard syntax */
		@keyframes  example-animate {
			0%   {color:#e73f05;}
			50% {color:#36454f;}
			100% {color:#e73f05;}
		}
		
		.img-guest-user {
			cursor: pointer;
			display: inline-block;
			/*position: absolute;*/
			/*bottom: 0px;*/
			/*left: -80px;*/
			border-radius: 50%;
			border: 1px solid #e77e5c;
			background: #fcfcfc;
			padding: 2px;
			margin-bottom: 10px;
		}
		.img-guest-user img {
			border-radius: 50%;
		}
	</style>
	<link rel="stylesheet" href="<?php echo e(asset('backend/css/bootstrap-datepicker.min.css')); ?>"/>
<?php $__env->stopSection(); ?>

<?php $__env->startSection('content'); ?>
	
	
	
	
	
	<div class="row">
		<div class="col-md-12">
			<?php echo $__env->make('message.Message', array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>
			<?php echo $__env->make('message.ErrorReporting', array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>
		</div>
	</div>
	<div class="row">
		<div class="col-md-12">
			<div class="panel panel-default">
				<div class="panel-heading">
					<h3 class="panel-title">مهمان های من</h3>
				</div>
				<div class="panel-body">
					<?php if(count($array_reserve) == 0): ?>
						<div class="row">
							<div class="alert alert-warning">
								<p>اقامتگاه خودتو ثبت کردی؟ اگه هنوز این کار رو نکردی زودتر از <a href="<?php echo e(route('CreateHost')); ?>">این قسمت</a> ثبتش کن تا مهمونا نرسیدن...!</p>
							</div>
						</div>
					<?php endif; ?>
					<?php  $i = 1;  ?>
					<?php $__currentLoopData = $array_reserve; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $key => $value): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
						<?php 
							$dateReserve = \Carbon\Carbon::parse($value['date_reserve'][0]);
							$dateNow = \Carbon\Carbon::parse(date('Y-m-d 00:00:00'));
							$countReserveDate_NowDate = $dateReserve->diffInDays($dateNow);
							$str = strtotime($dateReserve) - strtotime($dateNow);
							if($str > 0) {
								$countReserveDate_NowDate = 0;
							}
						 ?>
							<div class="box-reserve text-center" <?php if($value['status'] == -1 || $value['status'] == -2): ?> style="background: #ececec;" <?php endif; ?>>
							<div class="row">
								<div class="col-md-3">
									<a href="<?php echo e(route('DetailHost', ['id' => $value['host_detail']->id])); ?>" target="_blank">
										<div class="box-img-host">
											<img class="img-host" src="<?php echo e(asset(\App\ImageManager::resize('Uploaded/Gallery/Img/'.$value['host_detail']->getGallery[0]->img,['width' => 280, 'height' => 190]))); ?>">
										</div>
									</a>
									<div class="text-center">
										<?php if($value['submit_rate'] == 1 || $countReserveDate_NowDate >= 3): ?>
											منقضی شده
										<?php endif; ?>
									</div>
								</div>
								<div class="col-md-1">
									<div class="row">
										<div class="col-md-12 padding-top">
											<div class="row">
												<?php if($value['reserve_user']->avatar != Null): ?>
													<a href="<?php echo e(route('DetailUserProfile', ['id' => $value['reserve_user']->id])); ?>" target="_blank">
														<div class="img-guest-user">
															<img title="<?php echo e($value['reserve_user']->first_name. ' ' .$value['reserve_user']->last_name); ?>" src="<?php echo e(asset(\App\ImageManager::resize('Uploaded/User/Profile/'.$value['reserve_user']->avatar,['width' => 50, 'height' => 50]))); ?>">
														</div>
													</a>
												<?php else: ?>
													<a href="<?php echo e(route('DetailUserProfile', ['id' => $value['reserve_user']->id])); ?>" target="_blank">
														<div class="img-guest-user">
															<img title="<?php echo e($value['reserve_user']->first_name. ' ' .$value['reserve_user']->last_name); ?>" src="<?php echo e(asset(\App\ImageManager::resize('Uploaded/User/Profile/default-user.png',['width' => 50, 'height' => 50]))); ?>">
														</div>
													</a>
												<?php endif; ?>
												<?php echo e($value['reserve_user']->first_name. ' ' .$value['reserve_user']->last_name); ?>

											</div>
										</div>
									</div>
								</div>
								<div class="col-md-8">
									<div class="row">
										<div class="col-md-3 padding-top">
											<div class="row">
												<h5>نام اقامتگاه</h5>
												<?php echo e($value['host_detail']->name); ?>

											</div>
											<div class="row">
                                                کد آگهی : <?php echo e($value['host_detail']->id); ?>

											</div>
										</div>
										<div class="col-md-3 padding-top">
											<div class="row" style="line-height: 22px;">
												<h5>تاریخ</h5>
												<?php echo e(\Morilog\Jalali\Facades\jDate::forge(min($value['date_reserve']))->format('Y/m/d')); ?>

												<h5 style="display: inline; padding: 0px 5px;">الی</h5>
												<?php ($to_date = date('Y-m-d H:i:s', strtotime(max($value['date_reserve']) . ' +1 day'))); ?>
												<?php echo e(\Morilog\Jalali\Facades\jDate::forge($to_date)->format('Y/m/d')); ?>

											</div>
											<div class="row" style="line-height: 22px;">
												<h5 style="display: inline; padding: 0px 5px;">ساعت ورود</h5>
												<?php echo e($value['host_detail']->time_enter); ?>

												<h5 style="display: inline; padding: 0px 5px;">ساعت خروج</h5>
												<?php echo e($value['host_detail']->time_exit); ?>

											</div>
										</div>
										<div class="col-md-3 padding-top">
											<h5>قیمت نهایی</h5>
											<?php  $totalPrice = 0;  ?>
											<?php $__currentLoopData = $value['final_price']; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $index => $item): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
												<?php  $totalPrice = $totalPrice+$item;  ?>
											<?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
											<?php echo e(number_format($totalPrice)); ?> تومان
											<br>
											 برای <?php echo e(count($value['date_reserve'])); ?> شب
											<br>
											<h6 class="btn btn-default input-sm" style="font-size: 11px;" data-toggle="modal"
											    data-target="#myModalDetailPrice" onclick="AjaxDetailPrice('<?php echo e($key); ?>')">
												جزئیات بیشتر <i class="fa fa-angle-double-left"></i> </h6>
										</div>
										<div class="col-md-3 padding-top">
											<?php if($value['status'] == 0): ?>
												<button <?php if($value['status'] == 0): ?> onclick="AjaxConfirmReserve('<?php echo e($key); ?>', <?php echo e($value['id']); ?>)" <?php endif; ?> class="btn btn-default btn-block btn-<?php echo e($key); ?> btn-id-reserve-<?php echo e($value['id']); ?> <?php if($value['status'] == 1): ?> disabled <?php endif; ?>">
													<span class="<?php if($value['status'] == 1): ?> text-primary <?php else: ?> text-primary <?php endif; ?>">
														<i class="fa fa-check"></i> تایید رزرو (SMS)
													</span>
												</button>
												<button data-toggle="modal"
												        data-target="#myModalCancel" onclick="AjaxCancelReserve('<?php echo e($key); ?>')"
												        class="btn btn-default btn-block">
													<span class="text-danger"><i
																class="fa fa-trash-o"></i> رد درخواست (SMS)</span>
												</button>
											<?php endif; ?>

											<?php if($value['status'] == 0): ?>
												<button class="btn btn-default btn-block  disabled">
													<span class="text-success"><i
																class="fa fa-money"></i> تایید نشده </span>
												</button>
											<?php elseif($value['status'] == 1): ?>
												<button class="btn btn-default btn-block  disabled">
													<span class="text-success"><i class="fa fa-money"></i> در انتظار پرداخت </span>
												</button>
											<?php elseif($value['status'] == 2): ?>
												<button class="btn btn-default btn-block  disabled">
													<span class="text-success"><i
																class="fa fa-money"></i> پرداخت شده </span>
												</button>
											<?php else: ?>
												<button class="btn btn-default btn-block  disabled">
													<span class="text-danger"><i class="fa fa-money"></i> <?php if($value['status'] == -1): ?> انصراف میزبان <?php else: ?> انصراف میهمان <?php endif; ?> </span>
												</button>
											<?php endif; ?>
										</div>
									</div>
									<?php if($value['payment'] != null && $value['status'] != -1  && $value['status'] != -2 ): ?>
										<div class="row">
											<div class="col-md-3 col-md-offset-9">
												<div class="payment">
													<span class="text-success">پرداختی : <?php echo e(number_format($value['payment']->price)); ?> تومان</span><br />
													<span class="text-primary" title="به صورت نقدی دریافت شود"><i class="fas fa-info-circle"></i> باقیمانده : <?php echo e(number_format($value['payment']->remaining_price)); ?> تومان </span>
												</div>
											</div>
										</div>
									<?php endif; ?>
									<div class="row">
										<div class="col-xs-12">
											<ol class="progressBar">
												
												
												
												<li class="progressBar-item active">
													<span class="progressBar-step">1- ثبت درخواست</span>
												</li>
												
												
												<?php if($value['step'] == 1): ?>
													<?php if($value['status'] == 0): ?>
														<li class="progressBar-item">
															<span class="progressBar-step animated-step">2- در انتظار تایید</span>
														</li>
													<?php elseif($value['status'] == -1): ?>
														<li class="progressBar-item active" style="color: #f13f3f;">
															<span class="progressBar-step">2- رد درخواست توسط شما</span>
														</li>
													<?php elseif($value['status'] == -2): ?>
														<li class="progressBar-item active" style="color: #f13f3f;">
															<span class="progressBar-step">2- لغو توسط میهمان</span>
														</li>
													<?php elseif($value['status'] == -100): ?>
														<li class="progressBar-item active" style="color: #f13f3f;">
															<span class="progressBar-step">2- منقضی شده</span>
														</li>
													<?php endif; ?>
												<?php else: ?>
													<li class="progressBar-item active">
														<span class="progressBar-step">2- تایید میزبان</span>
													</li>
												<?php endif; ?>
												
												
												
												
												
												
												<?php if($value['step'] == 2): ?>
													<?php if($value['status'] == 2): ?>
														<li class="progressBar-item active">
															<span class="progressBar-step">3- پرداخت شده</span>
														</li>
													<?php elseif($value['status'] == -2): ?>
														<li class="progressBar-item active" style="color: #f13f3f;">
															<span class="progressBar-step">3- لغو توسط میهمان</span>
														</li>
													<?php elseif($value['status'] == -100): ?>
														<li class="progressBar-item active" style="color: #f13f3f;">
															<span class="progressBar-step">3- منقضی شده</span>
														</li>
													<?php else: ?>
														<li class="progressBar-item">
															<span class="progressBar-step animated-step">3- پرداخت</span>
														</li>
													<?php endif; ?>
												<?php elseif($value['step'] < 2): ?>
													<li class="progressBar-item">
														<span class="progressBar-step">3- پرداخت</span>
													</li>
												<?php elseif($value['step'] > 2): ?>
													<li class="progressBar-item active">
														<span class="progressBar-step">3- پرداخت شده</span>
													</li>
												<?php endif; ?>
												

												
												<?php if($value['step'] == 3): ?>
													<?php if($value['status'] == 2): ?>
														<li class="progressBar-item active">
															<span class="progressBar-step">4- تحویل کلید</span>
														</li>
													<?php elseif($value['status'] == -2): ?>
														<li class="progressBar-item active" style="color: #f13f3f;">
															<span class="progressBar-step">4- لغو توسط میهمان</span>
														</li>
													<?php endif; ?>
												<?php elseif($value['step'] < 3): ?>
													<li class="progressBar-item">
														<span class="progressBar-step">3- تحویل کلید</span>
													</li>
												<?php endif; ?>
											
												
												
												
											</ol>
										</div>
									</div>
								</div>
							</div>
						</div>
					<?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>

					
					<div class="modal fade" id="myModal" role="dialog">
						<div class="modal-dialog modal-md">
							<!-- Modal content-->
							<div class="modal-content">
								<div class="modal-header">
									<button type="button" class="close" data-dismiss="modal">&times;</button>
									<h4 class="modal-title">پروفایل کاربر</h4>
								</div>
								<div class="modal-body" id="ExtraModalEdit">

								</div>
							</div>
						</div>
					</div>
					
					<div class="modal fade" id="myModalCancel" role="dialog">
						<div class="modal-dialog modal-md">
							<!-- Modal content-->
							<div class="modal-content">
								<div class="modal-header">
									<button type="button" class="close" data-dismiss="modal">&times;</button>
									<h4 class="modal-title">انصراف رزرو</h4>
								</div>
								<div class="modal-body" id="ExtraModalCancel">

								</div>
							</div>
						</div>
					</div>

					
					<div class="modal fade" id="myModalDetailPrice" role="dialog">
						<div class="modal-dialog modal-md">
							<!-- Modal content-->
							<div class="modal-content">
								<div class="modal-header">
									<button type="button" class="close" data-dismiss="modal">&times;</button>
									<h5 class="modal-title">جزئیات قیمت</h5>
								</div>
								<div class="modal-body" id="ExtraModalDetailPrice">

								</div>
							</div>
						</div>
					</div>
				</div>
			</div>
		</div>
	</div>
<?php $__env->stopSection(); ?>


<?php $__env->startSection('script'); ?>
	<script src="<?php echo e(asset('frontend/js/script.js')); ?>" type="text/javascript"></script>
	<script type="text/javascript" src="<?php echo e(asset('backend/js/jquery.dataTables.min.js')); ?>"></script>
	<script type="text/javascript" src="<?php echo e(asset('backend/js/TableTools.min.js')); ?>"></script>
	<script type="text/javascript" src="<?php echo e(asset('backend/js/dataTables.bootstrap.js')); ?>"></script>
	<script type="text/javascript" src="<?php echo e(asset('backend/js/editable-datatables.js')); ?>"></script>
	<script src="<?php echo e(asset('backend/js/bootstrap-datepicker.min.js')); ?>"></script>
	<script src="<?php echo e(asset('backend/js/bootstrap-datepicker.fa.min.js')); ?>"></script>

	<script>


        function AjaxDetailPrice(id) {
            var img = '<div class="text-center"><img style="height:50px;width:auto;" src="<?php echo e(asset('backend/img/img_loading/orange_circles.gif')); ?>" /></div>';
            $('#ExtraModalDetailPrice').html(img);
            $.ajax({
                url: "<?php echo e(url('detail/price-reserve').'/'); ?>" + id,
                method: "get",
            }).done(function (returnData) {
                $('#ExtraModalDetailPrice').html(returnData);
            })
        }


        function AjaxGetUser(id) {
            var img = '<div class="text-center"><img style="height:50px;width:auto;" src="<?php echo e(asset('backend/img/img_loading/orange_circles.gif')); ?>" /></div>';
            $('#ExtraModalEdit').html(img);
            $.ajax({
                url: "<?php echo e(url('get/user-detail').'/'); ?>" + id,
                method: "get",
            }).done(function (returnData) {
                $('#ExtraModalEdit').html(returnData);
            })
        }

        function AjaxCancelReserve(id) {
            var img = '<div class="text-center"><img style="height:50px;width:auto;" src="<?php echo e(asset('backend/img/img_loading/orange_circles.gif')); ?>" /></div>';
            $('#ExtraModalCancel').html(img);
            $.ajax({
                url: "<?php echo e(url('reserve/cancel-host').'/'); ?>" + id,
                method: "get",
            }).done(function (returnData) {
                $('#ExtraModalCancel').html(returnData);
            })
        }

        function AjaxConfirmReserve(code, id) {
            $.ajax({
                url: "<?php echo e(url('reserve/confirm-sms').'/'); ?>" + code,
                method: "get",
            }).done(function (returnData) {
                if(returnData.Success == 1) {
                	alert(11);
                    $('.btn-id-reserve-'+id).attr("disabled",true);
                    $('.btn-id-reserve-'+id).find('span').removeClass('text-primary');
                    $('.btn-id-reserve-'+id).find('span').addClass('text-success');
                    AlertReserve('تاییدیه رزرو', returnData.Message, 'success');
                    setTimeout(function()
                    {
                        window.location.href = "<?php echo e(route('IndexReserveMyHost')); ?>";
                    }, 4500);
				}
                else {
                    AlertReserve('تاییدیه رزرو', returnData.Message, 'warning');
				}
            })
        }

        function AlertReserve(Title, Message, Status) {
            $.Toast("<p>"+ Title +"</p>", "<p>"+ Message +"</p>", ""+ Status +"", {
                has_icon: true,
                has_close_btn: true,
                stack: true,
                fullscreen: false,
                timeout: 4000,
                sticky: false,
                has_progress: true,
                rtl: true,
            });
        }

	</script>
<?php $__env->stopSection(); ?>
<?php echo $__env->make('backend.MasterPage.Layout', array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>