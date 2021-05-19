@extends('frontend.MasterPage.Layout')
@section('title',TitlePage($userModel->first_name. ' ' .$userModel->last_name))
@section('style')
	<style>
		div#ExtraContent {
			margin-top: 75px;
		}

		img.medal {
			width: 25px;
			height: 30px;
		}
	</style>
@endsection
@section('content')
	<div class="container">
		<div class="row">
			<div class="col-md-offset-2 col-md-2">
				@if($userModel->avatar != Null)
					<div class="box-img">
						<img alt="{{$userModel->first_name. ' ' .$userModel->last_name}}" title="{{$userModel->first_name. ' ' .$userModel->last_name}}" src="{{ asset(\App\ImageManager::resize('Uploaded/User/Profile/'.$userModel->avatar,['width' => 200, 'height' => 200])) }}">
					</div>
				@else
					<div class="box-img">
						<img alt="{{$userModel->first_name. ' ' .$userModel->last_name}}" title="{{$userModel->first_name. ' ' .$userModel->last_name}}" src="{{ asset(\App\ImageManager::resize('Uploaded/User/Profile/default-user.png',['width' => 200, 'height' => 200])) }}">
					</div>
				@endif
				@if($userModel->confirm_user == 3)
					<img src="{{asset('frontend/images/medal.png')}}" class="medal">
					کاربر ویژه
				@endif
			</div>
			<div class="col-md-4">
				<div class="detail-profile">
					<h1>{{$userModel->first_name. ' ' .$userModel->last_name}}</h1>
                    <p>{{$userModel->first_name}}</p>
				</div>
			</div>
		</div>
	</div>

@endsection

@section('script')

@endsection
