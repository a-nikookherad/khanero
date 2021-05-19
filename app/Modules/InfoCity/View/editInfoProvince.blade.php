@extends('backend.MasterPage.Layout')
@section('title')
	ویلا :: ویرایش اطلاعات استان
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
					<h3 class="panel-title">ویرایش استان</h3>
				</div>
				<div class="panel-body">
					<form action="{{ route('UpdateInfoProvince') }}" method="post" enctype="multipart/form-data">
						{{csrf_field()}}
						<input type="hidden" name="province_model_id" value="{{$infoProvince->id}}">
						<div class="row">
							<div class="col-md-3">
								<div class="form-group">
									<label for="SelectProvince">انتخاب استان</label>
									<select name="province_id" class="form-control input-sm" id="SelectProvince">
										<option hidden>انتخاب کنید</option>
										@foreach($provinceModel as $key => $value)
											<option value="{{$value->id}}" @if($value->id == $infoProvince->province_id) selected @endif>{{$value->name}}</option>
										@endforeach
									</select>
								</div>
							</div>
							<div class="col-md-3">
								<div class="form-group">
									<label for="InputCenterProvince">مرکز استان</label>
									<input type="text" class="form-control input-sm" value="{{$infoProvince->center_province}}"
									       placeholder="مرکز استان" name="center_province" id="InputCenterProvince"/>
								</div>
							</div>
							<div class="col-md-3">
								<div class="form-group">
									<label for="InputArea">مساحت استان</label>
									<input type="text" class="form-control input-sm" value="{{$infoProvince->area}}"
									       placeholder="مساحت استان را وارد کنید" name="area" id="InputArea"/>
								</div>
							</div>
							<div class="col-md-3">
								<div class="form-group">
									<label for="InputSpeech">زبان و گویش</label>
									<input type="text" class="form-control input-sm" value="{{$infoProvince->speech_language}}"
									       placeholder="زبان و گویش را وارد کنید" name="speech_language"
									       id="InputSpeech"/>
								</div>
							</div>
						</div>
						<div class="row">
							<div class="col-md-3">
								<div class="form-group">
									<label for="InputImportantCity">شهرهای مهم</label>
									<input type="text" class="form-control input-sm" value="{{$infoProvince->important_city}}"
									       placeholder="شهرهای مهم را وارد کنید" name="important_city"
									       id="InputImportantCity"/>
								</div>
							</div>
							<div class="col-md-9">
								<div class="form-group">
									<label for="InputImportantAttractions">جاذبه های استان</label>
									<input type="text" class="form-control input-sm"
									       value="{{$infoProvince->important_attractions}}"
									       placeholder="جاذبه های استان را وارد کنید" name="important_attractions"
									       id="InputImportantAttractions"/>
								</div>
							</div>
						</div>
						<div class="row">
							<div class="col-md-3">
								<div class="form-group">
									<img style="width: 100%" src="{{asset('Uploaded/InfoCity/Province/'.$infoProvince->img)}}">
									<label for="InputImageProvince">تصویر استان</label>
									<input type="file" class="form-control input-sm" name="img"
									       id="InputImageProvince"/>
								</div>
							</div>
							<div class="col-md-3">
								<div class="form-group">
									<label for="InputCenterPopulation">جمعیت</label>
									<input type="text" class="form-control input-sm" value="{{$infoProvince->population}}"
									       placeholder="جمعیت را وارد کنید" name="population"
									       id="InputCenterPopulation"/>
								</div>
							</div>
						</div>
						<div class="row">
							<div class="col-md-12">
								<div class="form-group">
									<label for="InputContent">توضیحات</label>
									<textarea style="height: 500px" class="editor form-control" name="content" id="InputContent">{{$infoProvince->content}}</textarea>
								</div>
							</div>
						</div>
						<div class="row">
							<div class="col-md-12">
								<button type="submit" class="btn btn-block btn-primary">
									ثبت ویرایش
								</button>
							</div>
						</div>
					</form>
				
				</div>
			</div>
		</div>
	</div>
	<script>
	
	</script>
@endsection

@section('script')


@endsection