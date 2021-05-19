
<?php $__env->startSection('title'); ?>
	ویلا :: معرفی شهرها
<?php $__env->stopSection(); ?>

<?php $__env->startSection('style'); ?>
	<link rel="stylesheet" href="<?php echo e(asset('backend/css/dataTables.bootstrap.css')); ?>">
	<link rel="stylesheet" href="<?php echo e(asset('backend/css/TableTools.css')); ?>">
	<link rel="stylesheet" href="<?php echo e(asset('backend/css/bootstrap-datepicker.min.css')); ?>"/>
	<style>
		.btn-group.pull-right.tabletools-btn {
			display: none;
		}
		
		.img-host {
			width: 80px;
			transition: 0.5s;
		}
		
		.img-host:hover {
			width: 120px;
			transition: 0.5s;
		}
		.btn-danger-status {
			border-color: #e74c3c;
		}
		.btn-success-status {
			border-color: #1abc9c;
		}
		.img-province-info {
			width: 60px;
			transition: .5s;
		}
		.img-province-info:hover {
			width: 260px;
			transition: .5s;
		}
		body .mce-ico {
			font-family: 'tinymce', Arial !important;
		}
	</style>
<?php $__env->stopSection(); ?>

<?php $__env->startSection('content'); ?>
	<script src="<?php echo e(asset('backend/assets/tinymcenew/tinymce.min.js')); ?>"></script>
	<script src="<?php echo e(asset('backend/assets/tinymcenew/editor.js')); ?>"></script>
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
					<h3 class="panel-title">معرفی شهرها</h3>
				</div>
				<div class="panel-body">
					<ul class="nav nav-tabs">
						<li class="active"><a data-toggle="tab" href="#province">نمایش استان ها</a></li>
						<li class=""><a data-toggle="tab" href="#township">نمایش شهرستان ها</a></li>
					</ul>
					
					<div class="tab-content">
						<div id="province" class="tab-pane fade in active">
							<form action="<?php echo e(route('StoreInfoProvince')); ?>" method="post" enctype="multipart/form-data" >
								<?php echo e(csrf_field()); ?>

								<div class="row">
									<div class="col-md-3">
										<div class="form-group">
											<label for="SelectProvince">انتخاب استان</label>
											<select name="province_id" class="form-control input-sm" id="SelectProvince">
												<option hidden>انتخاب کنید</option>
												<?php $__currentLoopData = $provinceModel; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $key => $value): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
													<option value="<?php echo e($value->id); ?>"><?php echo e($value->name); ?></option>
												<?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
											</select>
										</div>
									</div>
									<div class="col-md-3">
										<div class="form-group">
											<label for="InputCenterProvince">مرکز استان</label>
											<input type="text" class="form-control input-sm" value="<?php echo e(old('center_province')); ?>" placeholder="مرکز استان" name="center_province" id="InputCenterProvince" />
										</div>
									</div>
									<div class="col-md-3">
										<div class="form-group">
											<label for="InputArea">مساحت استان</label>
											<input type="text" class="form-control input-sm" value="<?php echo e(old('area')); ?>" placeholder="مساحت استان را وارد کنید" name="area" id="InputArea" />
										</div>
									</div>
									<div class="col-md-3">
										<div class="form-group">
											<label for="InputSpeech">زبان و گویش</label>
											<input type="text" class="form-control input-sm" value="<?php echo e(old('speech_language')); ?>" placeholder="زبان و گویش را وارد کنید" name="speech_language" id="InputSpeech" />
										</div>
									</div>
								</div>
								<div class="row">
									<div class="col-md-3">
										<div class="form-group">
											<label for="InputImportantCity">شهرهای مهم</label>
											<input type="text" class="form-control input-sm" value="<?php echo e(old('important_city')); ?>" placeholder="شهرهای مهم را وارد کنید" name="important_city" id="InputImportantCity" />
										</div>
									</div>
									<div class="col-md-9">
										<div class="form-group">
											<label for="InputImportantAttractions">جاذبه های گردشگری</label>
											<input type="text" class="form-control input-sm" value="<?php echo e(old('important_attractions')); ?>" placeholder="جاذبه های استان را وارد کنید" name="important_attractions" id="InputImportantAttractions" />
										</div>
									</div>
								</div>
								<div class="row">
									<div class="col-md-3">
										<div class="form-group">
											<label for="InputImageProvince">تصویر استان</label>
											<input type="file" class="form-control input-sm" name="img" id="InputImageProvince" />
										</div>
									</div>
									<div class="col-md-3">
										<div class="form-group">
											<label for="InputCenterPopulation">جمعیت</label>
											<input type="text" class="form-control input-sm" value="<?php echo e(old('population')); ?>" placeholder="جمعیت را وارد کنید" name="population" id="InputCenterPopulation" />
										</div>
									</div>
								</div>
								<div class="row">
									<div class="col-md-12">
										<div class="form-group">
											<label for="InputContent">توضیحات</label>
											<textarea style="height: 500px" class="editor form-control" name="content" id="InputContent"><?php echo e(old('content')); ?></textarea>
										</div>
									</div>
								</div>
								<div class="row">
									<div class="col-md-12">
										<button type="submit" class="btn btn-block btn-success">
											ثبت اطلاعات
										</button>
									</div>
								</div>
							</form>
							<hr />
							<table cellpadding="0" cellspacing="0" border="0"
							       class="table table-striped table-bordered editable-datatable">
								<thead>
								<tr>
									<th>ردیف</th>
									<th>نام استان</th>
									<th>تصویر</th>
									<th>ویرایش</th>
									<th>وضعیت</th>
									<th>تاریخ ایجاد</th>
								</tr>
								</thead>
								<tbody>
									<?php $__currentLoopData = $infoProvince; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $key => $value): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
										<tr class="1">
											<td>
												<?php echo e($key+1); ?>

											</td>
											<td>
												<?php if($Province = $value->getProvince): ?>
													<?php echo e($Province->name); ?>

												<?php else: ?>
													-
												<?php endif; ?>
											</td>
											<td>
												<img class="img-province-info" src="<?php echo e(asset('Uploaded/InfoCity/Province/'.$value->img)); ?>" />
											</td>
											<td>
												<a href="<?php echo e(route('EditInfoProvince', ['id' => $value->id])); ?>" class="btn btn-default btn-block">
													<i class="fa fa-edit"></i>
												</a>
											</td>
											<td>
												<label id="btnActiveProvince<?php echo e($key+1); ?>" onclick="ajaxActiveProvince('<?php echo e($value->id); ?>','<?php echo e($key+1); ?>');" class="<?php if($value->active == 1): ?> btn btn-default btn-success-status btn-block <?php else: ?> btn btn-default btn-danger-status btn-block <?php endif; ?>">
													<?php if($value->active == 1): ?> فعال <?php else: ?> غیرفعال <?php endif; ?>
												</label>
											</td>
											<td>
												<?php echo e(Morilog\Jalali\Facades\jDate::forge($value->created_at)->format('Y/m/d')); ?>

											</td>
										</tr>
									<?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
								</tbody>
							</table>
						</div>
						<div id="township" class="tab-pane fade">
							<form action="<?php echo e(route('StoreInfoTownship')); ?>" method="post" enctype="multipart/form-data" >
								<?php echo e(csrf_field()); ?>

								<div class="row">
									<div class="col-md-3">
										<div class="form-group">
											<label for="SelectProvince">انتخاب استان</label>
											<select name="province_id" class="form-control input-sm select-province" id="SelectProvince">
												<option hidden>انتخاب کنید</option>
												<?php $__currentLoopData = $provinceModel; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $key => $value): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
													<option value="<?php echo e($value->id); ?>"><?php echo e($value->name); ?></option>
												<?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
											</select>
										</div>
									</div>
									<div class="col-md-3">
										<div class="form-group">
											<label for="SelectTownship">انتخاب شهرستان</label>
											<select name="township_id" class="form-control input-sm select-township" id="SelectTownship">
											
											</select>
										</div>
									</div>
									<div class="col-md-3">
										<div class="form-group">
											<label for="InputImageTownship">تصویر شهرستان</label>
											<input type="file" class="form-control input-sm" name="img" id="InputImageTownship" />
										</div>
									</div>
									<div class="col-md-3">
										<div class="form-group">
											<label for="InputCenterPopulation">جمعیت</label>
											<input type="text" class="form-control input-sm" value="<?php echo e(old('population')); ?>" placeholder="جمعیت را وارد کنید" name="population" id="InputCenterPopulation" />
										</div>
									</div>
								</div>
								<div class="row">
									<div class="col-md-3">
										<div class="form-group">
											<label for="InputAreaCity">مساحت</label>
											<input type="text" class="form-control input-sm" value="<?php echo e(old('area')); ?>" placeholder="مساحت را وارد کنید" name="area" id="InputAreaCity" />
										</div>
									</div>
									<div class="col-md-3">
										<div class="form-group">
											<label for="InputAreaCode">پیش شماره تلفن</label>
											<input type="text" class="form-control input-sm" value="<?php echo e(old('area_code')); ?>" placeholder="پیش شماره تلفن را وارد کنید" name="area_code" id="InputAreaCode" />
										</div>
									</div>
									<div class="col-md-3">
										<div class="form-group">
											<label for="InputPlateCar">پلاک خودروها</label>
											<input type="text" class="form-control input-sm" value="<?php echo e(old('plate_car')); ?>" placeholder="پلاک خودروها را وارد کنید" name="plate_car" id="InputPlateCar" />
										</div>
									</div>
								</div>
								<div class="row">
									<div class="col-md-12">
										<div class="form-group">
											<label for="InputImportantAttractions">جاذبه های گردشگری</label>
											<input type="text" class="form-control input-sm" value="<?php echo e(old('important_attractions')); ?>" placeholder="جاذبه های شهرستان را وارد کنید" name="important_attractions" id="InputImportantAttractions" />
										</div>
									</div>
								</div>
								<div class="row">
									<div class="col-md-12">
										<div class="form-group">
											<label for="InputContent">توضیحات</label>
											<textarea style="height: 500px" class="editor form-control" name="content" id="InputContent"><?php echo e(old('content')); ?></textarea>
										</div>
									</div>
								</div>
								<div class="row">
									<div class="col-md-12">
										<button type="submit" class="btn btn-block btn-success">
											ثبت اطلاعات
										</button>
									</div>
								</div>
							</form>
							<hr />
							<table cellpadding="0" cellspacing="0" border="0"
							       class="table table-striped table-bordered editable-datatable">
								<thead>
								<tr>
									<th>ردیف</th>
									<th>نام استان</th>
									<th>نام شهرستان</th>
									<th>تصویر</th>
									<th>ویرایش</th>
									<th>وضعیت</th>
									<th>تاریخ ایجاد</th>
								</tr>
								</thead>
								<tbody>
									<?php $__currentLoopData = $infoTownship; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $key => $value): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
										<tr class="1">
											<td>
												<?php echo e($key+1); ?>

											</td>
											<td>
												<?php if($Province = $value->getProvince): ?>
													<?php echo e($Province->name); ?>

												<?php else: ?>
													-
												<?php endif; ?>
											</td>
											<td>
												<?php if($Township = $value->getTownship): ?>
													<?php echo e($Township->name); ?>

												<?php else: ?>
													-
												<?php endif; ?>
											</td>
											<td>
												<img class="img-province-info" src="<?php echo e(asset('Uploaded/InfoCity/Township/'.$value->img)); ?>" />
											</td>
											<td>
												<a href="<?php echo e(route('EditInfoTownship', ['id' => $value->id])); ?>" class="btn btn-default btn-block">
													<i class="fa fa-edit"></i>
												</a>
											</td>
											<td>
												<label id="btnActiveTownship<?php echo e($key+1); ?>" onclick="ajaxActiveTownship('<?php echo e($value->id); ?>','<?php echo e($key+1); ?>');" class="<?php if($value->active == 1): ?> btn btn-default btn-success-status btn-block <?php else: ?> btn btn-default btn-danger-status btn-block <?php endif; ?>">
													<?php if($value->active == 1): ?> فعال <?php else: ?> غیرفعال <?php endif; ?>
												</label>
											</td>
											<td>
												<?php echo e(Morilog\Jalali\Facades\jDate::forge($value->created_at)->format('Y/m/d')); ?>

											</td>
										</tr>
									<?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
								</tbody>
							</table>
						</div>
					</div>
				</div>
			</div>
		</div>
	</div>
	
	<script>
        initSample();
        var options = {
            language: 'fa',
            /*toolbarGroups: [
				{"name":"basicstyles","groups":["basicstyles"]},
				{"name":"links","groups":["links"]},
				{"name":"paragraph","groups":["list","blocks"]},
			],*/
            // Remove the redundant buttons from toolbar groups defined above.
            removeButtons: 'Underline,Strike,Subscript,Superscript,Anchor,Styles,Specialchar',
            filebrowserImageBrowseUrl: '/laravel-filemanager?type=Images',
            // filebrowserImageUploadUrl: '/laravel-filemanager/upload?type=Images&_token='+CSRFToken,
            filebrowserBrowseUrl: '/laravel-filemanager?type=Files',
            filebrowserUploadUrl: '/laravel-filemanager/upload?type=Files&_token=+CSRFToken'
        };
        CKEDITOR.replace('editor', options);
        CKEDITOR.replace('editor2', options);
	</script>

<?php $__env->stopSection(); ?>


<?php $__env->startSection('script'); ?>
	<script>
        $( document ).ready(function() {

            
            
            //get township
            $("body").delegate(".select-province", "change", function (e) {

                var id = $(this).val();
                getTownship(id);
            });

            //get township
            function getTownship(id) {
                $.ajaxSetup({
                    headers: {
                        'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                    }
                });
                $.ajax({
                    url: '<?php echo e(route('GetAjaxTownship')); ?>',
                    type: 'post',
                    data: {
                        id: id
                    },
                    success: function (data) {
                        $(".select-township").html(data);
                    }
                });

            }
        });
        
        
        function ajaxActiveProvince(id,idInput) {
            
            $.ajax({
                url:"<?php echo e(url('active/info-province').'/'); ?>"+id,
                method:"get",
            }).done(function(returnData){
                // console.log(returnData);
                if(returnData == 'active')
                {
                    // console.log('active');
                    $("#btnActiveProvince"+idInput).addClass('btn-success-status');
                    $("#btnActiveProvince"+idInput).removeClass('btn-danger-status');
                    $("#btnActiveProvince"+idInput).css("transition", "0.5s");
                    $("#btnActiveProvince"+idInput).text('');
                    $("#btnActiveProvince"+idInput).append('فعال');
                    alarmStatus("success");
                }
                else if(returnData == 'deactive')
                {
                    // console.log('deactive');
                    $("#btnActiveProvince"+idInput).addClass('btn-danger-status');
                    $("#btnActiveProvince"+idInput).removeClass('btn-success-status');
                    $("#btnActiveProvince"+idInput).css("transition", "0.5s");
                    $("#btnActiveProvince"+idInput).text('');
                    $("#btnActiveProvince"+idInput).append('غیرفعال');
                    alarmStatus("warning");
                }
            });
        }


        function ajaxActiveTownship(id,idInput) {
            $.ajax({
                url:"<?php echo e(url('active/info-township').'/'); ?>"+id,
                method:"get",
            }).done(function(returnData){
                // console.log(returnData);
                if(returnData == 'active')
                {
                    // console.log('active');
                    $("#btnActiveTownship"+idInput).addClass('btn-success-status');
                    $("#btnActiveTownship"+idInput).removeClass('btn-danger-status');
                    $("#btnActiveTownship"+idInput).css("transition", "0.5s");
                    $("#btnActiveTownship"+idInput).text('');
                    $("#btnActiveTownship"+idInput).append('فعال');
                    alarmStatus("success");
                }
                else if(returnData == 'deactive')
                {
                    // console.log('deactive');
                    $("#btnActiveTownship"+idInput).addClass('btn-danger-status');
                    $("#btnActiveTownship"+idInput).removeClass('btn-success-status');
                    $("#btnActiveTownship"+idInput).css("transition", "0.5s");
                    $("#btnActiveTownship"+idInput).text('');
                    $("#btnActiveTownship"+idInput).append('غیرفعال');
                    alarmStatus("warning");
                }
            });
        }
        
        
        function alarmStatus(status) {
            $.Toast("<p>وضعیت</p>", "<p>تغییر وضعیت موفقیت آمیز بود .</p>", ""+ status +"", {
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