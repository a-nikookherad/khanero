<?php
    $contactInfo = App\Modules\ContactUs\Controllers\ContactUsController::BottomInfo();
    $contentModel = App\Modules\Content\Controllers\ContentController::BottomLink();
    $contentModel_2 = App\Modules\Content\Controllers\ContentController::BottomLink_2();
?>
<div class="row">
    <div class="col-xs-12 col-sm-12 col-md-4 footer0 pr-md-0 px-0">
        <div class="row">
            <div class="col-lg-10 pr-md-0 px-0">
                <div class="d-block logo-footer">
                    <img src="{{asset('frontend/images/logo-f.png')}}" alt="logo" class="img-footer">
                </div>
                <div class="d-block about-company">
                    {{$contactInfo->about}}
                </div>
            </div>
        </div>
    </div>

    <div class="col-lg-4 col-md-4 col-sm-6 px-0 pupiular-service accordion-container">
        <div class="set">
        			<span class="service-icon">
						 <span class="title-footer lnk-footer un-link"><span> ارتباط با ما</span></span>

						 <i class="fa-chevron-down fas fa-chevron-up" aria-hidden="false"></i>
					</span>
            <div class="content">
                @foreach($contentModel->chunk(4) as $key => $value)
                    <ul class="lnk-footers">
                        @foreach($value as $index => $item)
                            <li><a href="{{route('PageContent', ['alias' => $item->alias])}}">{{$item->title}}</a></li>
                        @endforeach
                    </ul>
                @endforeach

            </div>
        </div>
    </div>

    <div class="col-lg-4 col-md-4 col-sm-6 px-0 pupiular-service accordion-container">
        <div class="set">
        			<span class="service-icon">
						 <span class="title-footer lnk-footer un-link"><span> دسترسی سریع</span></span>

						 <i class="fa-chevron-down fas fa-chevron-up" aria-hidden="false"></i>
				     </span>
            <div class="content">
                @foreach($contentModel_2->chunk(4) as $key => $value)
                    <ul class="lnk-footers">
                        @foreach($value as $index => $item)
                            <li><a href="{{route('PageContent', ['alias' => $item->alias])}}">{{$item->title}}</a></li>
                        @endforeach
                    </ul>
                @endforeach
            </div>
        </div>
    </div>

</div>