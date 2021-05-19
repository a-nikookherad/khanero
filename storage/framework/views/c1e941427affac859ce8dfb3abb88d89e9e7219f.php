<?php $__env->startSection('title', TitlePage('تراکنش ها')); ?>
<?php $__env->startSection('style'); ?>
	<link rel="stylesheet" href="<?php echo e(asset('backend/css/dataTables.bootstrap.css')); ?>">
	<link rel="stylesheet" href="<?php echo e(asset('backend/css/TableTools.css')); ?>">
	<style>
		#ToolTables_DataTables_Table_0_0 {
			display: none;
		}
		
		.img-advertising {
			width: 20%;
			transition: 0.5s;
		}
		
		.img-advertising:hover {
			width: 40%;
			transition: 0.5s;
		}
		
		.border-red {
			border: 1px solid #f17676;
			background: #fff7f7;
		}
		
		.border-green {
			border: 1px solid #2ece31;
			background: #f7fff7;
		}
		
		.border-blue {
			border: 1px solid #2ececc;
			background: #f3fdff;
		}
		li.li-payment {
			background: #ffe9cf;
		}
		.row-account {
			background: #f9f9f9;
			margin: 10px;
			padding: 10px;
			border: 1px solid #d2d2d2;
			border-radius: 5px;
		}
	</style>
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
					<h3 class="panel-title">تراکنش های بانکی</h3>
				</div>
				<div class="panel-body">
					
					
					<ul id="myTab" class="nav nav-tabs">
						<li class="active"><a href="#payment_tab" data-toggle="tab"><i class="fa fa-home"></i> تراکنش ها</a>
						</li>
						<li class=""><a href="#settings_tab" data-toggle="tab"><i class="fa fa-gears"></i> اطلاعات حساب</a>
						</li>
					</ul>
					<div id="myTabContent" class="tab-content">
						<div class="tab-pane fade active in" id="payment_tab">
							<?php if(count($paymentModel) == 0): ?>
								<div class="row">
									<div class="col-md-12">
										<div class="alert alert-warning">
											<p>گزارشی در سیستم ثبت نشده است.</p>
										</div>
									</div>
								</div>
							<?php else: ?>
								<table cellpadding="0" cellspacing="0" border="0"
								       class="table table-striped table-bordered editable-datatable">
									<thead>
									<tr>
										<th scope="col">ردیف</th>
										<th scope="col">کد رهگیری</th>
										<th scope="col">مبلغ پرداخت شده(تومان)</th>
										<th scope="col">وضعیت</th>
										<th scope="col">تاریخ ثبت</th>
									</tr>
									</thead>
									<tbody>
									<?php $__currentLoopData = $paymentModel; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $key => $value): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
										<tr class="<?php if($value->status == 1): ?> text-success <?php else: ?> text-danger <?php endif; ?>">
											<td>
												<?php echo e($key+1); ?>

											</td>
											<td>
												<?php echo e($value->tracking_code); ?>

											</td>
											<td>
												<?php echo e($value->price); ?>

											</td>
											<td>
												<?php if($value->status == 1): ?>
													<label>پرداخت شده</label>
												<?php else: ?>
													<label>پرداخت نشده</label>
												<?php endif; ?>
											</td>
											<td>
												<?php (
														$dateCreated = \Morilog\Jalali\Facades\jDate::forge($paymentModel[$key]->created_at)->format('Y/m/d')
													); ?>
												<label><?php echo e($dateCreated); ?></label>
											</td>
										</tr>
									<?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
									</tbody>
								</table>
							<?php endif; ?>
						</div>
						
						
						<div class="tab-pane fade" id="settings_tab">
							<div class="row">
								<div class="col-md-12">
									<button class="btn btn-default" data-toggle="modal" data-target="#myModal">+ ثبت حساب</button>
								</div>
							</div>
							<?php $__currentLoopData = auth()->user()->getAccount; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $key => $value): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
								<div class="row row-account">
									<div class="col-md-3">
										<label>نام صاحب حساب : <?php echo e($value->full_name); ?></label>
									</div>
									<div class="col-md-3">
										<label>شماره کارت : <?php echo e($value->number_card); ?></label>
									</div>
									<div class="col-md-5">
										<label>شبا : <?php echo e($value->shaba); ?></label>
									</div>
									<div class="col-md-1">
										<a href="<?php echo e(route('DeleteAccount', ['id' => $value->id])); ?>" class="btn btn-danger">حذف</a>
									</div>
								</div>
							<?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
						</div>
					</div>
				</div>
			</div>
		</div>
	</div>
	<div id="myModal" class="modal fade" role="dialog">
		<div class="modal-dialog">

			<!-- Modal content-->
			<div class="modal-content">
				<div class="modal-header">
					<button type="button" class="close" data-dismiss="modal">&times;</button>
					<h4 class="modal-title">افزودن حساب</h4>
				</div>
				<div class="modal-body">
					<form action="<?php echo e(route('StoreAccount')); ?>" method="post">
						<?php echo e(csrf_field()); ?>

						<div class="row">
							<div class="col-md-12">
								<div class="form-group">
									<label for="InputFullName">نام ونام خانوادگی صاحب حساب</label>
									<input type="text" name="full_name" id="InputFullName" class="form-control" placeholder="نام و نام خانوادگی صاحب حساب">
								</div>
							</div>
							<div class="col-md-12">
								<div class="form-group">
									<label for="InputNumberCard">شماره کارت</label>
									<input type="text" name="number_card" id="InputNumberCard" class="form-control" placeholder="شماره کارت">
								</div>
							</div>
							<div class="col-md-12">
								<div class="form-group">
									<label for="InputShaba">شماره شبا</label>
									<input type="text" name="shaba" id="InputShaba" class="form-control" placeholder="شماره شبا">
								</div>
							</div>
							<div class="col-md-6">
								<div class="form-group">
									<button class="btn btn-success">ثبت حساب</button>
								</div>
							</div>
							<div class="col-md-6">
								<div class="form-group text-left">
									<button type="button" class="btn btn-default" data-dismiss="modal">بستن</button>
								</div>
							</div>
						</div>
					</form>
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
	<script>
        (function($, undefined) {

            "use strict";

            // When ready.
            $(function() {

                var $input = $( "#InputCardBankNumber" );

                $input.on( "keyup", function( event ) {


                    // When user select text in the document, also abort.
                    var selection = window.getSelection().toString();
                    if ( selection !== '' ) {
                        return;
                    }

                    // When the arrow keys are pressed, abort.
                    if ( $.inArray( event.keyCode, [38,40,37,39] ) !== -1 ) {
                        return;
                    }

                    var $this = $(this);
                    var input = $this.val();
                    input = input.replace(/[\W\s\._\-]+/g, '');

                    var split = 4;
                    var chunk = [];

                    for (var i = 0, len = input.length; i < len; i += split) {
                        split = ( i >= 8 && i <= 16 ) ? 4 : 4;
                        chunk.push( input.substr( i, split ) );
                    }

                    $this.val(function() {
                        return chunk.join(" - ").toUpperCase();
                    });

                } );

                /**
                 * ==================================
                 * When Form Submitted
                 * ==================================
                 */
                $form.on( "submit", function( event ) {

                    var $this = $( this );
                    var arr = $this.serializeArray();

                    for (var i = 0; i < arr.length; i++) {
                        arr[i].value = arr[i].value.replace(/[($)\s\._\-]+/g, ''); // Sanitize the values.
                    };

                    console.log( arr );

                    event.preventDefault();
                });

            });
        })(jQuery);
        
        
        
        
        // $(function () {
        //     $('#InputCardBankNumber').on('keyup', function () {
        //         var culture = $(this).val();
        //         var formattedNumber = formatNumber(2132, culture);
        //         $("#txtNum").val(formattedNumber);
        //     });
        // });
		//
        // function formatNumber(num, currentculture) {
        //     Globalize.culture(currentculture);
        //     if (isNaN(num))
        //         return('Number not valid');
        //     return (Globalize.format(num, "n2"));
        // }
	</script>
<?php $__env->stopSection(); ?>
<?php echo $__env->make('backend.MasterPage.Layout', array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>