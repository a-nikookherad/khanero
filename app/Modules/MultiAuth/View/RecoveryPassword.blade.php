@extends('backend.MasterPage.Auth')
<meta name="viewport" content="width=device-width, initial-scale=1">
@section('title')
	بازیابی رمز عبور
@endsection

@section('content')
	
	
	<div class="row box-message">
		<div class="col-sm-4 col-sm-offset-4">
			@include('message.Message')
			@include('message.ErrorReporting')
		</div>
	</div>
	<div class="main box-login">
		<div class="col-md-4 col-md-offset-4">
			<div class="panel panel-default">
				<div class="panel-heading text-right">
					<h3 class="panel-title">بازیابی رمز عبور</h3>
				</div>
				<div class="panel-body">
					<form action="{{ route('PasswordRecovery') }}" method="post" role="form" class="recovery">
						{{ csrf_field() }}
						<div class="input-group">
							<span class="input-group-addon"><i class="fa fa-user"></i></span>
							<input type="text" dir="rtl" id="Mobile" name="mobile" placeholder="شماره تماس خود را وارد کنید" class="form-control primary input-sm" autofocus />
						</div>
						<br />
						<div class="form-group">
							<button type="submit" class="btn btn-default btn-block">دریافت رمز عبور</button>
						</div>
					</form>
				</div>
			</div>
		</div>
	</div>


@endsection