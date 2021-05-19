<?php $__env->startSection('title'); ?>
	ویلا :: تراکنش ها
<?php $__env->stopSection(); ?>

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
		#InputCardBankNumber {
			background-color: #007b8c17;
			letter-spacing: 1px;
			font-size: 18px;
			text-align: center;
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
						<li class=""><a href="#settings_tab" data-toggle="tab"><i class="fa fa-gears"></i> تنظیمات حساب</a>
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
							<form action="<?php echo e(route('UpdateAccountBank')); ?>" method="post">
								<?php echo e(csrf_field()); ?>

								<div class="row">
									<div class="col-md-4">
										<div class="form-group">
											<label for="InputAccountName">نام صاحب حساب </label>
											<input maxlength="25" name="account_name"
											       value="<?php echo e(auth()->user()->account_name); ?>" type="text"
											       class="form-control primary" dir="rtl" id="InputAccountName"
											       placeholder="نام شماره حساب را وارد کنید">
											<?php if($errors->has('account_name')): ?>
												<span style="color:red;"><?php echo e($errors->first('account_name')); ?></span>
											<?php endif; ?>
										</div>
									</div>
								</div>
								<div class="row">
									<div class="col-md-4">
										<div class="form-group">
											<label for="InputShabaNumber">شماره شبا </label>
											<input maxlength="25" name="shaba_number" style=""
											       value="<?php echo e(auth()->user()->shaba_number); ?>" type="text"
											       class="form-control primary" dir="rtl" id="InputShabaNumber"
											       placeholder="شماره شبا را وارد کنید">
											<?php if($errors->has('shaba_number')): ?>
												<span style="color:red;"><?php echo e($errors->first('shaba_number')); ?></span>
											<?php endif; ?>
										</div>
									</div>
								</div>
								<div class="row">
									<div class="col-md-4">
										<div class="form-group">
											<label for="InputCardBankNumber">شماره حساب بانکی <span style="font-size: 12px;color: #57be85;">(شماره حساب باید به نام خود شما باشد)</span></label>
											<input maxlength="25" name="card_bank_number" style=""
											       value="<?php echo e(auth()->user()->card_bank_number); ?>" type="text"
											       class="form-control primary" dir="rtl" id="InputCardBankNumber"
											       placeholder="شماره کارت بانکی را وارد کنید">
											<?php if($errors->has('card_bank_number')): ?>
												<span style="color:red;"><?php echo e($errors->first('card_bank_number')); ?></span>
											<?php endif; ?>
										</div>
									</div>
								</div>
								<div class="row">
									<div class="col-md-12">
										<button class="btn btn-green">
											ثبت اطلاعات
										</button>
									</div>
								</div>
							</form>
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