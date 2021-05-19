@extends('backend.MasterPage.Layout')
@section('title')
	ویلا :: معرفی شهرها
@endsection

@section('style')
	<link rel="stylesheet" href="{{asset('backend/css/dataTables.bootstrap.css')}}">
	<link rel="stylesheet" href="{{asset('backend/css/TableTools.css')}}">
	<link rel="stylesheet" href="{{ asset('backend/css/bootstrap-datepicker.min.css')}}"/>
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
@endsection

@section('content')
	<script src="{{asset('backend/assets/tinymcenew/tinymce.min.js')}}"></script>
	<script src="{{asset('backend/assets/tinymcenew/editor.js')}}"></script>
	<div class="row">
		<div class="col-md-12">
			@include('message.Message')
			@include('message.ErrorReporting')
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
							<form action="{{ route('StoreInfoProvince') }}" method="post" enctype="multipart/form-data" >
								{{csrf_field()}}
								<div class="row">
									<div class="col-md-3">
										<div class="form-group">
											<label for="SelectProvince">انتخاب استان</label>
											<select name="province_id" class="form-control input-sm" id="SelectProvince">
												<option hidden>انتخاب کنید</option>
												@foreach($provinceModel as $key => $value)
													<option value="{{$value->id}}">{{$value->name}}</option>
												@endforeach
											</select>
										</div>
									</div>
									<div class="col-md-3">
										<div class="form-group">
											<label for="InputCenterProvince">مرکز استان</label>
											<input type="text" class="form-control input-sm" value="{{old('center_province')}}" placeholder="مرکز استان" name="center_province" id="InputCenterProvince" />
										</div>
									</div>
									<div class="col-md-3">
										<div class="form-group">
											<label for="InputArea">مساحت استان</label>
											<input type="text" class="form-control input-sm" value="{{old('area')}}" placeholder="مساحت استان را وارد کنید" name="area" id="InputArea" />
										</div>
									</div>
									<div class="col-md-3">
										<div class="form-group">
											<label for="InputSpeech">زبان و گویش</label>
											<input type="text" class="form-control input-sm" value="{{old('speech_language')}}" placeholder="زبان و گویش را وارد کنید" name="speech_language" id="InputSpeech" />
										</div>
									</div>
								</div>
								<div class="row">
									<div class="col-md-3">
										<div class="form-group">
											<label for="InputImportantCity">شهرهای مهم</label>
											<input type="text" class="form-control input-sm" value="{{old('important_city')}}" placeholder="شهرهای مهم را وارد کنید" name="important_city" id="InputImportantCity" />
										</div>
									</div>
									<div class="col-md-9">
										<div class="form-group">
											<label for="InputImportantAttractions">جاذبه های گردشگری</label>
											<input type="text" class="form-control input-sm" value="{{old('important_attractions')}}" placeholder="جاذبه های استان را وارد کنید" name="important_attractions" id="InputImportantAttractions" />
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
											<input type="text" class="form-control input-sm" value="{{old('population')}}" placeholder="جمعیت را وارد کنید" name="population" id="InputCenterPopulation" />
										</div>
									</div>
								</div>
								<div class="row">
									<div class="col-md-12">
										<div class="form-group">
											<label for="InputContent">توضیحات</label>
											<textarea style="height: 500px" class="editor form-control" name="content" id="InputContent">{{old('content')}}</textarea>
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
									@foreach($infoProvince as $key => $value)
										<tr class="1">
											<td>
												{{ $key+1 }}
											</td>
											<td>
												@if($Province = $value->getProvince)
													{{ $Province->name }}
												@else
													-
												@endif
											</td>
											<td>
												<img class="img-province-info" src="{{asset('Uploaded/InfoCity/Province/'.$value->img)}}" />
											</td>
											<td>
												<a href="{{route('EditInfoProvince', ['id' => $value->id])}}" class="btn btn-default btn-block">
													<i class="fa fa-edit"></i>
												</a>
											</td>
											<td>
												<label id="btnActiveProvince{{$key+1}}" onclick="ajaxActiveProvince('{{ $value->id }}','{{$key+1}}');" class="@if($value->active == 1) btn btn-default btn-success-status btn-block @else btn btn-default btn-danger-status btn-block @endif">
													@if($value->active == 1) فعال @else غیرفعال @endif
												</label>
											</td>
											<td>
												{{ Morilog\Jalali\Facades\jDate::forge($value->created_at)->format('Y/m/d') }}
											</td>
										</tr>
									@endforeach
								</tbody>
							</table>
						</div>
						<div id="township" class="tab-pane fade">
							<form action="{{ route('StoreInfoTownship') }}" method="post" enctype="multipart/form-data" >
								{{csrf_field()}}
								<div class="row">
									<div class="col-md-3">
										<div class="form-group">
											<label for="SelectProvince">انتخاب استان</label>
											<select name="province_id" class="form-control input-sm select-province" id="SelectProvince">
												<option hidden>انتخاب کنید</option>
												@foreach($provinceModel as $key => $value)
													<option value="{{$value->id}}">{{$value->name}}</option>
												@endforeach
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
											<input type="text" class="form-control input-sm" value="{{old('population')}}" placeholder="جمعیت را وارد کنید" name="population" id="InputCenterPopulation" />
										</div>
									</div>
								</div>
								<div class="row">
									<div class="col-md-3">
										<div class="form-group">
											<label for="InputAreaCity">مساحت</label>
											<input type="text" class="form-control input-sm" value="{{old('area')}}" placeholder="مساحت را وارد کنید" name="area" id="InputAreaCity" />
										</div>
									</div>
									<div class="col-md-3">
										<div class="form-group">
											<label for="InputAreaCode">پیش شماره تلفن</label>
											<input type="text" class="form-control input-sm" value="{{old('area_code')}}" placeholder="پیش شماره تلفن را وارد کنید" name="area_code" id="InputAreaCode" />
										</div>
									</div>
									<div class="col-md-3">
										<div class="form-group">
											<label for="InputPlateCar">پلاک خودروها</label>
											<input type="text" class="form-control input-sm" value="{{old('plate_car')}}" placeholder="پلاک خودروها را وارد کنید" name="plate_car" id="InputPlateCar" />
										</div>
									</div>
								</div>
								<div class="row">
									<div class="col-md-12">
										<div class="form-group">
											<label for="InputImportantAttractions">جاذبه های گردشگری</label>
											<input type="text" class="form-control input-sm" value="{{old('important_attractions')}}" placeholder="جاذبه های شهرستان را وارد کنید" name="important_attractions" id="InputImportantAttractions" />
										</div>
									</div>
								</div>
								<div class="row">
									<div class="col-md-12">
										<div class="form-group">
											<label for="InputContent">توضیحات</label>
											<textarea style="height: 500px" class="editor form-control" name="content" id="InputContent">{{old('content')}}</textarea>
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
									@foreach($infoTownship as $key => $value)
										<tr class="1">
											<td>
												{{ $key+1 }}
											</td>
											<td>
												@if($Province = $value->getProvince)
													{{ $Province->name }}
												@else
													-
												@endif
											</td>
											<td>
												@if($Township = $value->getTownship)
													{{ $Township->name }}
												@else
													-
												@endif
											</td>
											<td>
												<img class="img-province-info" src="{{asset('Uploaded/InfoCity/Township/'.$value->img)}}" />
											</td>
											<td>
												<a href="{{route('EditInfoTownship', ['id' => $value->id])}}" class="btn btn-default btn-block">
													<i class="fa fa-edit"></i>
												</a>
											</td>
											<td>
												<label id="btnActiveTownship{{$key+1}}" onclick="ajaxActiveTownship('{{ $value->id }}','{{$key+1}}');" class="@if($value->active == 1) btn btn-default btn-success-status btn-block @else btn btn-default btn-danger-status btn-block @endif">
													@if($value->active == 1) فعال @else غیرفعال @endif
												</label>
											</td>
											<td>
												{{ Morilog\Jalali\Facades\jDate::forge($value->created_at)->format('Y/m/d') }}
											</td>
										</tr>
									@endforeach
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

@endsection


@section('script')
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
                    url: '{{route('GetAjaxTownship')}}',
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
                url:"{{ url('active/info-province').'/'}}"+id,
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
                url:"{{ url('active/info-township').'/'}}"+id,
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
@endsection