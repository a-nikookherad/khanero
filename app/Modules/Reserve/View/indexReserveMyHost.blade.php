@extends('backend.MasterPage.Layout')
@section('title')
	{{TitlePage('مهمان های من')}}
@endsection

@section('style')
	<link rel="stylesheet" href="{{asset('backend/css/dataTables.bootstrap.css')}}">
	<link rel="stylesheet" href="{{asset('backend/css/TableTools.css')}}">
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
		{{--background-image: url("{{asset('backend/css/5.png')}}");--}}



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

		@media only screen and (min-width: 768px) {
			.progressBar-step {
				width: 42px;
			}

			.progressBar-item:first-child,
			.progressBar-item:last-child {
				width: 24%;
			}
		}

		@media only screen and (min-width: 1024px) {
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
		@keyframes example-animate {
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
	<link rel="stylesheet" href="{{ asset('backend/css/bootstrap-datepicker.min.css')}}"/>
@endsection

@section('content')
	{{--<div class="row back-url">--}}
	{{--<div class="col-md-12">--}}
	{{--<a class="" href="{{ route('UserDashboard') }}">صفحه اصلی</a><span class="now-url"> / رزرو اقامتگاه های من</span>--}}
	{{--</div>--}}
	{{--</div>--}}
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
					<h3 class="panel-title">مهمان های من</h3>
				</div>
				<div class="panel-body">
				    
                    
                    <div class="nav nav-tabs head-tab1">
                        <a class="d-block position-relative" data-toggle="tab" href="#tab1">سفرهای پیشرو</a>
                        <a class="d-block position-relative" data-toggle="tab" href="#tab2">سفرهای لغو شده</a>
                        <a class="d-block position-relative" data-toggle="tab" href="#tab3">همه ی سفرها </a>
                    </div>
                    <div class="tab-content-1 body-tab1">
                        <div id="tab1" class="tab-pane fade active show in">
                            <div class="bx-Residence my-trip row">
                                <div class="col-sm-4">
                                    <div class="owl-carousel owl-theme slid-1">
                                        <div class="item">
                                            <a class="d-block box-sl slide" href="#"><img class="mw-100" src="http://nonegar14.ir/jahesh/images/pc7.jpg" alt="image" /></a>
                                        </div>
                                        <div class="item">
                                            <a class="d-block box-sl slide" href="#"><img class="mw-100" src="http://nonegar14.ir/jahesh/images/pc7.jpg" alt="image" /></a>
                                        </div>
                                    </div>
                                    <nav class="nav-slider mt-3">
                                        <ul class="item-slider owl-carousel R-sl1">
                    
                                        </ul>
                                    </nav>
                                    <ul class="can-click row">
                                        <li class="col-sm-12 date-Rsdnc text-right"><span>آخرین بروزرسانی :</span>12/12/1400</li>
                                        <li class="col-sm-6 clck-btn clck-01"><a class="each-clck" href="#"> جزئیات صورتحساب<i class="fas fa-chevron-left"></i></a></li>
                                        <li class="col-sm-6 clck-btn clck-01"><a class="each-clck" href="#"> جزئیات اقامتگاه<i class="fas fa-chevron-left"></i></a></li>
                                        <li class="col-sm-6 clck-btn clck-01"><a class="each-clck" href="#"> قوانین اقامتگاه<i class="fas fa-chevron-left"></i></a></li>
                                        <li class="col-sm-6 clck-btn clck-01"><a class="each-clck" href="#"> قوانین لغو<i class="fas fa-chevron-left"></i></a></li>
                                    </ul>
                                </div>
                                <div class="col-sm-8">
                                    <div class="bx-subject row">
                                        <div class="col-sm-6 px-0">
                                            <h2 class="title-Rsdnc">نمونه تیتر نام اقامتگاه</h2>
                                            <div class="ratin-g text-right">
                                                <i class="far fa-star"></i>
                                                <i class="far fa-star"></i>
                                                <i class="fas fa-star"></i>
                                                <i class="fas fa-star"></i>
                                                <i class="fas fa-star"></i>
                                                <a class="send-idea" href="#">نظر دهی</a>
                                            </div>
                                        </div>
                                        <div class="col-sm-6 px-0 d-flex align-items-center host-info">
                                            <h6 class="name-host">نمونه تیتر نام میزبان</h6>
                                            <img class="pc-host" src="http://nonegar14.ir/jahesh/images/pc7.jpg" />
                                        </div>
                                    </div>
                                    <div class="list-item row">
                                        <div class="col-sm-12 vzyt-Rsdnc"><div class="btn-vzyt">لغو شده توسط میزبان</div></div>
                                        <div class="col-sm-6 som-inf">
                                            <li class="info-Rsdnc"><i class="fas fa-square"></i><span>شماره رزرو  :</span><label>32423423</label></li>
                                            <li class="info-Rsdnc"><i class="fas fa-square"></i><span>کد اقامتگاه   :</span><label>345345345</label></li>
                                            <li class="info-Rsdnc"><i class="fas fa-square"></i><span>مدت اقامت  :</span><label> 2 شب</label></li>
                                            <li class="info-Rsdnc"><i class="fas fa-square"></i><span>تعداد نفرات  :</span><label>5 نفر</label></li>
                                        </div>
                                        <div class="col-sm-6 som-inf">
                                            <ul class="each-01">
                                                <li class="info-trip"><i class="fas fa-calendar-alt"></i>تاریخ ورود :</span><label><span class="day">پنج شنبه</span><span class="date">12/12/1300</span></label></li>
                                                <li class="info-trip"><i class="fas fa-calendar-alt"></i>تاریخ خروج :</span><label><span class="day">پنج شنبه</span><span class="date">12/12/1300</span></label></li>
                                            </ul>
                                            <ul class="each-01">
                                                <li class="info-trip"><i class="fas fa-tags"></i>قیمت هرشب:</span><label><span class="price">120,000</span><span class="unit">تومان</span></label></li>
                                                <li class="info-trip"><i class="fas fa-tags"></i>مجموع هزینه:</span><label><span class="price">120,000</span><span class="unit">تومان</span></label></li>
                                            </ul>
                                            <ul class="speak-host">
                                                <li><a class="speak-link" href="#">گفتوگوی اضطراری با میزبان</a></li>
                                            </ul>
                                        </div>
                                    </div>
                                    <div class="table-responsive table1-info-trip">
                                        <table class="table-bordered table-hover" cellspacing="1" cellpadding="1" width="100%" align="center">
                                            <tbody>
                                            <tr align="center">
                                                <th class="each-td">شرح</th>
                                                <th class="each-td">تعداد</th>
                                                <th class="each-td">مبلغ واحد</th>
                                                <th class="each-td">مجموع</th>
                                            </tr>
                                            <tr align="center">
                                                <td class="each-td">روز عادی</td>
                                                <td class="each-td">2 روز</td>
                                                <td class="each-td">40,000</td>
                                                <td class="each-td">340,000</td>
                                            </tr>
                                            <tr align="center">
                                                <td class="each-td">ایام پیک</td>
                                                <td class="each-td">4 روز</td>
                                                <td class="each-td">90,000</td>
                                                <td class="each-td">120,000</td>
                                            </tr>
                                            <tr align="center">
                                                <td class="each-td">نفر اضافه</td>
                                                <td class="each-td">2 نفر</td>
                                                <td class="each-td">34.000</td>
                                                <td class="each-td">50,000</td>
                                            </tr>
                                            <tr align="center">
                                                <td class="each-td">مجموع</td>
                                                <td class="each-td" colspan="3">890,000 تومان</td>
                                            </tr>
                                            </tbody>
                                        </table>
                                    </div>
                                    <ul class="stp-prgsbar">
                                        <li class="active"><div class="nam-stp">ثبت درخواست</div></li>
                                        <li class="active"><div class="nam-stp">لغو توسط شما</div></li>
                                        <li class=""><div class="nam-stp">پرداخت</div></li>
                                        <li class=""><div class="nam-stp">تحویل کلید</div></li>
                                    </ul>
                                </div>
                            </div>
                        </div>
                        <div id="tab2" class="tab-pane fade"></div>
                        <div id="tab3" class="tab-pane fade"></div>
                    </div>
				    
				    
				    
				    
					@if(count($array_reserve) == 0)
						<div class="row">
							<div class="alert alert-warning">
								<p>اقامتگاه خودتو ثبت کردی؟ اگه هنوز این کار رو نکردی زودتر از <a href="{{route('CreateHost')}}">این قسمت</a> ثبتش کن تا مهمونا نرسیدن...!</p>
							</div>
						</div>
					@endif
					@php $i = 1; @endphp
					@foreach($array_reserve as $key => $value)
						@php
							$dateReserve = \Carbon\Carbon::parse($value['date_reserve'][0]);
							$dateNow = \Carbon\Carbon::parse(date('Y-m-d 00:00:00'));
							$countReserveDate_NowDate = $dateReserve->diffInDays($dateNow);
							$str = strtotime($dateReserve) - strtotime($dateNow);
							if($str > 0) {
								$countReserveDate_NowDate = 0;
							}
						@endphp
							<div class="box-reserve text-center" @if($value['status'] == -1 || $value['status'] == -2) style="background: #ececec;" @endif>
							<div class="row">
								<div class="col-md-3">
									<a href="{{route('DetailHost', ['id' => $value['host_detail']->id])}}" target="_blank">
										<div class="box-img-host">
											<img class="img-host" src="{{ asset(\App\ImageManager::resize('Uploaded/Gallery/Img/'.$value['host_detail']->getGallery[0]->img,['width' => 280, 'height' => 190])) }}">
										</div>
									</a>
									<div class="text-center">
										@if($value['submit_rate'] == 1 || $countReserveDate_NowDate >= 3)
											منقضی شده
										@endif
									</div>
								</div>
								<div class="col-md-1">
									<div class="row">
										<div class="col-md-12 padding-top">
											<div class="row">
												@if($value['reserve_user']->avatar != Null)
													<a href="{{route('DetailUserProfile', ['id' => $value['reserve_user']->id])}}" target="_blank">
														<div class="img-guest-user">
															<img title="{{$value['reserve_user']->first_name. ' ' .$value['reserve_user']->last_name}}" src="{{ asset(\App\ImageManager::resize('Uploaded/User/Profile/'.$value['reserve_user']->avatar,['width' => 50, 'height' => 50])) }}">
														</div>
													</a>
												@else
													<a href="{{route('DetailUserProfile', ['id' => $value['reserve_user']->id])}}" target="_blank">
														<div class="img-guest-user">
															<img title="{{$value['reserve_user']->first_name. ' ' .$value['reserve_user']->last_name}}" src="{{ asset(\App\ImageManager::resize('Uploaded/User/Profile/default-user.png',['width' => 50, 'height' => 50])) }}">
														</div>
													</a>
												@endif
												{{$value['reserve_user']->first_name. ' ' .$value['reserve_user']->last_name}}
											</div>
										</div>
									</div>
								</div>
								<div class="col-md-8">
									<div class="row">
										<div class="col-md-3 padding-top">
											<div class="row">
												<h5>نام اقامتگاه</h5>
												{{$value['host_detail']->name}}
											</div>
											<div class="row">
                                                کد آگهی : {{$value['host_detail']->id}}
											</div>
										</div>
										<div class="col-md-3 padding-top">
											<div class="row" style="line-height: 22px;">
												<h5>تاریخ</h5>
												{{\Morilog\Jalali\Facades\jDate::forge(min($value['date_reserve']))->format('Y/m/d')}}
												<h5 style="display: inline; padding: 0px 5px;">الی</h5>
												@php($to_date = date('Y-m-d H:i:s', strtotime(max($value['date_reserve']) . ' +1 day')))
												{{\Morilog\Jalali\Facades\jDate::forge($to_date)->format('Y/m/d')}}
											</div>
											<div class="row" style="line-height: 22px;">
												<h5 style="display: inline; padding: 0px 5px;">ساعت ورود</h5>
												{{$value['host_detail']->time_enter}}
												<h5 style="display: inline; padding: 0px 5px;">ساعت خروج</h5>
												{{$value['host_detail']->time_exit}}
											</div>
										</div>
										<div class="col-md-3 padding-top">
											<h5>قیمت نهایی</h5>
											@php $totalPrice = 0; @endphp
											@foreach($value['final_price'] as $index => $item)
												@php $totalPrice = $totalPrice+$item; @endphp
											@endforeach
											{{number_format($totalPrice)}} تومان
											<br>
											 برای {{count($value['date_reserve'])}} شب
											<br>
											<h6 class="btn btn-default input-sm" style="font-size: 11px;" data-toggle="modal"
											    data-target="#myModalDetailPrice" onclick="AjaxDetailPrice('{{$key}}')">
												جزئیات بیشتر <i class="fa fa-angle-double-left"></i> </h6>
										</div>
										<div class="col-md-3 padding-top">
											@if($value['status'] == 0)
												<button @if($value['status'] == 0) onclick="AjaxConfirmReserve('{{$key}}', {{$value['id']}})" @endif class="btn btn-default btn-block btn-{{$key}} btn-id-reserve-{{$value['id']}} @if($value['status'] == 1) disabled @endif">
													<span class="@if($value['status'] == 1) text-primary @else text-primary @endif">
														<i class="fa fa-check"></i> تایید رزرو (SMS)
													</span>
												</button>
												<button data-toggle="modal"
												        data-target="#myModalCancel" onclick="AjaxCancelReserve('{{$key}}')"
												        class="btn btn-default btn-block">
													<span class="text-danger"><i
																class="fa fa-trash-o"></i> رد درخواست (SMS)</span>
												</button>
											@endif

											@if($value['status'] == 0)
												<button class="btn btn-default btn-block  disabled">
													<span class="text-success"><i
																class="fa fa-money"></i> تایید نشده </span>
												</button>
											@elseif($value['status'] == 1)
												<button class="btn btn-default btn-block  disabled">
													<span class="text-success"><i class="fa fa-money"></i> در انتظار پرداخت </span>
												</button>
											@elseif($value['status'] == 2)
												<button class="btn btn-default btn-block  disabled">
													<span class="text-success"><i
																class="fa fa-money"></i> پرداخت شده </span>
												</button>
											@else
												<button class="btn btn-default btn-block  disabled">
													<span class="text-danger"><i class="fa fa-money"></i> @if($value['status'] == -1) انصراف میزبان @else انصراف میهمان @endif </span>
												</button>
											@endif
										</div>
									</div>
									@if($value['payment'] != null && $value['status'] != -1  && $value['status'] != -2 )
										<div class="row">
											<div class="col-md-3 col-md-offset-9">
												<div class="payment">
													<span class="text-success">پرداختی : {{number_format($value['payment']->price)}} تومان</span><br />
													<span class="text-primary" title="به صورت نقدی دریافت شود"><i class="fas fa-info-circle"></i> باقیمانده : {{number_format($value['payment']->remaining_price)}} تومان </span>
												</div>
											</div>
										</div>
									@endif
									<div class="row">
										<div class="col-xs-12">
											<ol class="progressBar">
												
												
												
												<li class="progressBar-item active">
													<span class="progressBar-step">1- ثبت درخواست</span>
												</li>
												
												
												@if($value['step'] == 1)
													@if($value['status'] == 0)
														<li class="progressBar-item">
															<span class="progressBar-step animated-step">2- در انتظار تایید</span>
														</li>
													@elseif($value['status'] == -1)
														<li class="progressBar-item active" style="color: #f13f3f;">
															<span class="progressBar-step">2- رد درخواست توسط شما</span>
														</li>
													@elseif($value['status'] == -2)
														<li class="progressBar-item active" style="color: #f13f3f;">
															<span class="progressBar-step">2- لغو توسط میهمان</span>
														</li>
													@elseif($value['status'] == -100)
														<li class="progressBar-item active" style="color: #f13f3f;">
															<span class="progressBar-step">2- منقضی شده</span>
														</li>
													@endif
												@else
													<li class="progressBar-item active">
														<span class="progressBar-step">2- تایید میزبان</span>
													</li>
												@endif
												
												
												
												
												
												
												@if($value['step'] == 2)
													@if($value['status'] == 2)
														<li class="progressBar-item active">
															<span class="progressBar-step">3- پرداخت شده</span>
														</li>
													@elseif($value['status'] == -2)
														<li class="progressBar-item active" style="color: #f13f3f;">
															<span class="progressBar-step">3- لغو توسط میهمان</span>
														</li>
													@elseif($value['status'] == -100)
														<li class="progressBar-item active" style="color: #f13f3f;">
															<span class="progressBar-step">3- منقضی شده</span>
														</li>
													@else
														<li class="progressBar-item">
															<span class="progressBar-step animated-step">3- پرداخت</span>
														</li>
													@endif
												@elseif($value['step'] < 2)
													<li class="progressBar-item">
														<span class="progressBar-step">3- پرداخت</span>
													</li>
												@elseif($value['step'] > 2)
													<li class="progressBar-item active">
														<span class="progressBar-step">3- پرداخت شده</span>
													</li>
												@endif
												

												
												@if($value['step'] == 3)
													@if($value['status'] == 2)
														<li class="progressBar-item active">
															<span class="progressBar-step">4- تحویل کلید</span>
														</li>
													@elseif($value['status'] == -2)
														<li class="progressBar-item active" style="color: #f13f3f;">
															<span class="progressBar-step">4- لغو توسط میهمان</span>
														</li>
													@endif
												@elseif($value['step'] < 3)
													<li class="progressBar-item">
														<span class="progressBar-step">3- تحویل کلید</span>
													</li>
												@endif
											
												
												
												
											</ol>
										</div>
									</div>
								</div>
							</div>
						</div>
					@endforeach

					{{--edit menu modal--}}
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
					{{-- modal cancel--}}
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

					{{-- modal detail price --}}
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
@endsection


@section('script')
	<script src="{{asset('frontend/js/script.js')}}" type="text/javascript"></script>
	<script type="text/javascript" src="{{asset('backend/js/jquery.dataTables.min.js')}}"></script>
	<script type="text/javascript" src="{{asset('backend/js/TableTools.min.js')}}"></script>
	<script type="text/javascript" src="{{asset('backend/js/dataTables.bootstrap.js')}}"></script>
	<script type="text/javascript" src="{{asset('backend/js/editable-datatables.js')}}"></script>
	<script src="{{asset('backend/js/bootstrap-datepicker.min.js')}}"></script>
	<script src="{{asset('backend/js/bootstrap-datepicker.fa.min.js')}}"></script>
    <!--//============ Multi-gallery-slider-->
    <script>
        $(document).ready(function () {
            var image = $(".slide img");
            image.each(function (i) {
                var container = $(".nav-slider .item-slider");
                var imageUrl = image[i].src;

                container.append(getimage(imageUrl));
            });
            $(".nav-slider li img", this).click(function () {
                var nav = $(this);
                var url = nav.attr("src");
                image.fadeOut().fadeIn().attr("src", url);
            });
            function getimage(imageUrl) {
                return '<li class="item m-0"><img class="mw-100 p-1 rounded" src=" ' + imageUrl + ' " alt=""></li>';
            }

            $('.owl-carousel.slid-1').owlCarousel({
                rtl:true,
                loop: true,
                nav: false,
                dots:false,
                margin: 0,
                items: 1
            })
            $('.owl-carousel.R-sl1').owlCarousel({
                autoplay:true,
                autoplayTimeout:5000,
                rtl:true,
                loop: true,smartSpeed:3000,
		        lazyLoad: true,
                margin: 0, 
                responsiveClass: true,
                responsive: {
                    0: {
                        items: 4,
                        nav: true
                    },
                    600: {
                        items: 4,
                        nav: false
                    },
                    1000: {
                        items: 5,
                        nav: true
                    }
                }
            })
        });
    </script>
	<script>


        function AjaxDetailPrice(id) {
            var img = '<div class="text-center"><img style="height:50px;width:auto;" src="{{ asset('backend/img/img_loading/orange_circles.gif') }}" /></div>';
            $('#ExtraModalDetailPrice').html(img);
            $.ajax({
                url: "{{ url('detail/price-reserve').'/'}}" + id,
                method: "get",
            }).done(function (returnData) {
                $('#ExtraModalDetailPrice').html(returnData);
            })
        }


        function AjaxGetUser(id) {
            var img = '<div class="text-center"><img style="height:50px;width:auto;" src="{{ asset('backend/img/img_loading/orange_circles.gif') }}" /></div>';
            $('#ExtraModalEdit').html(img);
            $.ajax({
                url: "{{ url('get/user-detail').'/'}}" + id,
                method: "get",
            }).done(function (returnData) {
                $('#ExtraModalEdit').html(returnData);
            })
        }

        function AjaxCancelReserve(id) {
            var img = '<div class="text-center"><img style="height:50px;width:auto;" src="{{ asset('backend/img/img_loading/orange_circles.gif') }}" /></div>';
            $('#ExtraModalCancel').html(img);
            $.ajax({
                url: "{{ url('reserve/cancel-host').'/'}}" + id,
                method: "get",
            }).done(function (returnData) {
                $('#ExtraModalCancel').html(returnData);
            })
        }

        function AjaxConfirmReserve(code, id) {
            $.ajax({
                url: "{{ url('reserve/confirm-sms').'/'}}" + code,
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
                        window.location.href = "{{route('IndexReserveMyHost')}}";
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
@endsection