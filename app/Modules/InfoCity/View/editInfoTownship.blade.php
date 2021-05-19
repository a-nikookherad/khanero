@extends('backend.MasterPage.Layout')
@section('title')
	ویلا :: ویرایش اطلاعات شهرستان
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
					<h3 class="panel-title">ویرایش شهرستان</h3>
				</div>
				<div class="panel-body">
					<form action="{{ route('UpdateInfoTownship') }}" method="post" enctype="multipart/form-data" >
						{{csrf_field()}}
						<input type="hidden" value="{{$infoTownship->id}}" name="township_model_id" />
						<div class="row">
							<div class="col-md-3">
								<div class="form-group">
									<label for="SelectProvince">انتخاب استان</label>
									<select name="province_id" class="form-control input-sm select-province" id="SelectProvince">
										<option hidden>انتخاب کنید</option>
										@foreach($provinceModel as $key => $value)
											<option value="{{$value->id}}" @if($value->id == $infoTownship->province_id) selected @endif>{{$value->name}}</option>
										@endforeach
									</select>
								</div>
							</div>
							<div class="col-md-3">
								<div class="form-group">
									<label for="SelectTownship">انتخاب شهرستان</label>
									<select name="township_id" class="form-control input-sm select-township" id="SelectTownship">
										@foreach($townshipModel as $key => $value)
											<option value="{{$value->id}}" @if($value->id == $infoTownship->township_id) selected @endif>{{$value->name}}</option>
										@endforeach
									</select>
								</div>
							</div>
							<div class="col-md-3">
								<div class="form-group">
									<img style="width: 100%" src="{{asset('Uploaded/InfoCity/Township/'.$infoTownship->img)}}">
									<label for="InputImageTownship">تصویر شهرستان</label>
									<input type="file" class="form-control input-sm" name="img" id="InputImageTownship" />
								</div>
							</div>
							<div class="col-md-3">
								<div class="form-group">
									<label for="InputCenterPopulation">جمعیت</label>
									<input type="text" class="form-control input-sm" value="{{$infoTownship->population}}" placeholder="جمعیت را وارد کنید" name="population" id="InputCenterPopulation" />
								</div>
							</div>
						</div>
						<div class="row">
							<div class="col-md-3">
								<div class="form-group">
									<label for="InputAreaCity">مساحت</label>
									<input type="text" class="form-control input-sm" value="{{$infoTownship->area}}" placeholder="مساحت را وارد کنید" name="area" id="InputAreaCity" />
								</div>
							</div>
							<div class="col-md-3">
								<div class="form-group">
									<label for="InputAreaCode">پیش شماره تلفن</label>
									<input type="text" class="form-control input-sm" value="{{$infoTownship->area_code}}" placeholder="پیش شماره تلفن را وارد کنید" name="area_code" id="InputAreaCode" />
								</div>
							</div>
							<div class="col-md-3">
								<div class="form-group">
									<label for="InputPlateCar">پلاک خودروها</label>
									<input type="text" class="form-control input-sm" value="{{$infoTownship->plate_car}}" placeholder="پلاک خودروها را وارد کنید" name="plate_car" id="InputPlateCar" />
								</div>
							</div>
						</div>
						<div class="row">
							<div class="col-md-12">
								<div class="form-group">
									<label for="InputImportantAttractions">جاذبه های شهرستان</label>
									<input type="text" class="form-control input-sm" value="{{$infoTownship->important_attractions}}" placeholder="جاذبه های شهرستان را وارد کنید" name="important_attractions" id="InputImportantAttractions" />
								</div>
							</div>
						</div>
						<div class="row">
							<div class="col-md-12">
								<div class="form-group">
									<label for="InputContent">توضیحات</label>
									<textarea style="height: 500px" class="editor form-control" name="content" id="InputContent">{{$infoTownship->content}}</textarea>
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
				</div>
			</div>
		</div>
	</div>
	<script>
        initSample();
	</script>
@endsection

@section('script')


@endsection