@extends('frontend.MasterPage.Layout')
@section('title')
	ویلا :: {{$infoProvinceModel->getProvince->name}}
@endsection
@section('style')
	<style>
		.title-section {
			color: #6f6f6f;
			padding-bottom: 10px;
		}
		
		.title-section span {
			font-size: 18px;
			padding-left: 5px;
		}
		.title-section p {
			font-size: 15px;
			line-height: 30px;
		}
		.content-province {
			line-height: 30px;
			text-align: justify;
		}
		.container-section .row.top {
			padding: 15px 0px;
		}
		img.image-province {
			border-radius: 6px;
			border: 1px solid #e4e4e4;
			padding: 2px;
			box-shadow: 1px 0px 16px #dedede;
		}
		p.rows-detail {
			padding: 5px 0px;
		}
		.background-top {
			background-image: url("{{asset('Uploaded/InfoCity/Province/'.$infoProvinceModel->img)}}");
			height: 200px;
			background-position: center;
			background-size: cover;
			filter: blur(2px);
			box-shadow: -2px 9px 13px #00000063;
			margin-bottom: 17px;
			border-radius: 15px;
			margin: 5px;
		}
		.container-section.box-detail {
			background-image: url("{{asset('Uploaded/info-province.png')}}");
			background-position: top;
			background-repeat: no-repeat;
			background-size: contain;
		}
		
		.box-title h3 {
			line-height: 125px;
		}
		.box-title {
			position: absolute;
			left: 50%;
			top: 95px;
			font-size: 12px;
			transform: translate(-50%, -50%);
			background: #230c0059;
			height: 170px;
			width: 170px;
			text-align: center;
			border-radius: 50%;
			/* border: 1px solid #fe5512; */
			color: #f1f1f1;
			box-shadow: 0px 11px 19px 0px #000000cf;
		}
		.city-title {
			font-size: 13px;
		}
	</style>
@endsection
@section('content')
	<div class="background-top">
	
	</div>
	<div class="box-title">
		<h3 class="title-name">
			{{$infoProvinceModel->getProvince->name}}
		</h3>
	</div>
	<div class="container-section box-detail">
		<div class="row top">
			<div class="col-md-8 title-section">
				
				<p class="rows-detail">
					<span class="text-green">مرکز استان :</span> {{$infoProvinceModel->center_province}}
				</p>
				<p class="rows-detail">
					<span class="text-green">جمعیت :</span> {{$infoProvinceModel->population}}
				</p>
				<p class="rows-detail">
					<span class="text-green">مساحت :</span> {{$infoProvinceModel->area}}
				</p>
				<p class="rows-detail">
					<span class="text-green">زبان :</span> {{$infoProvinceModel->speech_language}}
				</p>
				<p class="rows-detail">
					<span class="text-green">شهر های مهم :</span> {{$infoProvinceModel->important_city}}
				</p>
				<p class="rows-detail">
					<span class="text-green">جاذبه های گردشگری :</span> {{$infoProvinceModel->important_attractions}}
				</p>
			</div>
			<div class="col-md-4 text-left">
				<img class="image-province" src="{{asset('Uploaded/InfoCity/Province/'.$infoProvinceModel->img)}}" />
			</div>
		</div>
		<div class="row">
			<div class="col-md-12">
				<div class="content-province">
					{!! $infoProvinceModel->content !!}
				</div>
			</div>
		</div>
		@if(count($infoTownshipModel) > 0)
			<hr />
			<div class="row">
				<div class="col-md-12">
					<h4>شهرهای {{$infoProvinceModel->getProvince->name}} <span class="city-title">(مقاله های سایت رنت)</span></h4>
					<div class="owl-carousel owl-theme owl-city">
						@foreach($infoTownshipModel as $key => $value)
							<item>
								<a href="{{route('DetailTownship', ['id' => $value->id])}}" target="_blank">
									<img src="{{asset('Uploaded/InfoCity/Township/'.$value->img)}}"/>
									<div class="welcome-popular-cities-desc ">
										<div class="name">{{$value->getTownship->name}}</div>
									</div>
								</a>
							</item>
						@endforeach
					</div>
					<script>

                        var owl = $('.owl-city');
                        owl.owlCarousel({
                            loop:true,
                            rtl:true,
                            dots:false,
                            navText: ["<i class='fas fa-angle-left'></i>", "<i class='fas fa-angle-right'></i>"],
                            autoplayTimeout: 3000,
                            autoplayHoverPause: true,
                            responsiveClass:true,

                            responsive:{
                                0:{
                                    items:1,
                                    nav:false
                                },

                                320:{
                                    items:2,
                                    nav:false,
                                    stagePadding: 30,
                                    margin:8
                                },
                                800:{
                                    items:3,
                                    nav:false,
                                    stagePadding: 20,
                                    margin: 12
                                },
                                1000:{
                                    items:6,
                                    nav:true,
                                    stagePadding: 30,
                                    margin: 10
                                }
                            }
                        });
					
					</script>
				</div>
			</div>
		@endif
	</div>
	
@endsection

@section('script')

@endsection
