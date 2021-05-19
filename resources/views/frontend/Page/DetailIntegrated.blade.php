@extends('frontend.MasterPage.Layout')
@section('title',TitlePage($integratedModel->title))
@section('style'){{$integratedModel->title}}
<link rel="stylesheet" href="{{ asset('backend/css/bootstrap-datepicker.min.css')}}"/>
<link rel="stylesheet" href="{{ asset('frontend/css/style-detail.css')}}"/>
<style>
    .display-block {
        display: none;
        position: absolute;
        width: 100%;
        height: 100%;
        background: #f9fff86b;
        top: 0;
        left: 0;
        z-index: 9999999;
    }

    span.tooltip-span {
        padding: 5px;
        color: #fe5512;
        cursor: pointer;
        border: 1px solid #fe5f11;
        width: 20px;
        height: 20px;
        display: inline-block;
        line-height: 12px;
        text-align: center;
        border-radius: 50%;
        margin: 0px 5px;
    }

    .tooltip {
        font-family: Yekan !important;
    }

    .box-calendar {
        display: block;
    }



    .box-time {
        display: inline-block;
        padding: 10px;
        border: 4px solid #f5987b;
        border-radius: 5px;
    }
    .input-date-reserve {
        opacity: 1;
        border: none;
        box-shadow: none;
        background-color: #fff!important;
    }

    .box-count-guest .btn-add,
    .box-count-guest .btn-sub {
        width: 25%;
        height: 100%;
        font-size: 14px;
        padding: 5px;
        background: #fff7f3;
        color: #808080;
    }

    .box-count-guest .number input {
        width: 15px;
    }

    .box-count-guest .number {
        text-align: center;
        width: 50%;
        font-size: 15px;
        display: inline-block;
        padding: 5px;
        pointer-events: none;
    }

    .box-count-guest .btn-add {
        float: right;
        border-top-right-radius: 10px;
        border-bottom-right-radius: 10px;
        border-left: 1px solid #fe884a;
    }

    .box-count-guest .btn-sub {
        float: left;
        border-top-left-radius: 10px;
        border-bottom-left-radius: 10px;
        border-right: 1px solid #fe884a;
    }
    div#ExtraContent {
        margin-top: 75px;
    }


    .box-medal img.medal {
        width: 25px;
        height: 30px;
        border-radius: 50%;
        box-shadow: none;
        position: absolute;
        left: 10px;
        top: -26px;
    }
    .box-medal {
        position: relative;
    }
    .item-2 img{
        width: 100%;
        height: auto;
    }
    .box-margin-top {
        margin-bottom: 30px !important;
    }
    .box-user img {
        width: 50px;
        border-radius: 50%;
    }
</style>
@endsection

@section('content')

    <div class="content-home">
        <div class="row">
{{--            {{dd($integratedModel->getGallery)}}--}}
            <div class="container">
                <div class="row box-margin-top">
                    <div class="col-md-4">
                        <div id="myCarousel" class="carousel slide" data-ride="carousel">
                            <!-- Indicators -->
                            <ol class="carousel-indicators">
                                @foreach($integratedModel->getGallery as $key => $value)
                                    <li data-target="#myCarousel" data-slide-to="{{$key}}" class="@if($key == 0) active @endif"></li>
                                @endforeach
                            </ol>

                            <!-- Wrapper for slides -->
                            <div class="carousel-inner">
                                @foreach($integratedModel->getGallery as $key => $value)
                                    <div class="item @if($key == 0) active @endif">
                                        <img src="{{asset('Uploaded/Gallery/Integrated/File/'.$value->url)}}" alt="Los Angeles" style="width:100%;">
                                    </div>
                                @endforeach
                            </div>

                            <!-- Left and right controls -->
                            <a class="left carousel-control" href="#myCarousel" data-slide="prev">
                                <span class="glyphicon glyphicon-chevron-left"></span>
                                <span class="sr-only">Previous</span>
                            </a>
                            <a class="right carousel-control" href="#myCarousel" data-slide="next">
                                <span class="glyphicon glyphicon-chevron-right"></span>
                                <span class="sr-only">Next</span>
                            </a>
                        </div>
                    </div>
                    <div class="col-md-8">
                        <div class="box-user">
                            @php
                                if($integratedModel->getUser->avatar != '') {
                                    $avatar = $integratedModel->getUser->avatar;
                                } else {
                                    $avatar = 'default-user.png';
                                }
                            @endphp
                            <img src="{{asset('Uploaded/User/Profile/'.$avatar)}}">
                            <span class="name-user">
                                {{$integratedModel->getUser->first_name}}
                            </span>
                        </div>
                        <h4>{{$integratedModel->title}}</h4>
                        <p>
                            {{$integratedModel->description}}
                        </p>
                    </div>
                </div>
                <hr />
                <div class="row">
                    @foreach($integratedModel->getHost as $key => $value)
                        <div class="col-md-3 box-margin-top">
                            <a href="{{route('DetailHost', ['id' => $value->id])}}" class="thumbnail">
                                <div class="">
                                    @if(count($value->getGallery) > 0)
                                        <div class="item item-2">
                                            <div class="img-product">
                                                <img src="{{ asset(\App\ImageManager::resize('Uploaded/Gallery/Img/'.$value->getGallery[0]->img,['width' => 300, 'height' => 200])) }}">
                                            </div>
                                        </div>
                                    @else
                                        <div class="item item-2">
                                            <div class="img-product">
                                                <img src="{{ asset(\App\ImageManager::resize('frontend/images/logo-rent-latin.png',['width' => 300, 'height' => 200])) }}">
                                            </div>
                                        </div>
                                    @endif
                                </div>
                            </a>
                            <div class="row">
                                <div class="box-texts">
                                    <h4 class="product-name">
                                        {{$value->name}}
                                    </h4>
                                    <p class="short-desc">
                                        <i class="fa fa-location-arrow"></i>
                                        @if($Province = $value->getProvince)
                                            {{ $Province->name }}
                                        @else
                                            -
                                        @endif
                                        -
                                        @if($Township = $value->getTownship)
                                            {{ $Township->name }}
                                        @else
                                            -
                                        @endif
                                        -
                                        {{ $value->district }}
                                    </p>
                                    <p class="rate">
                                        @if(count($value->getRate) > 0)
                                            @php
                                                $total = 0;
                                                $count = count($value->getRate);
                                            @endphp
                                            @foreach($value->getRate as $index => $item)
                                                @php $total = $total+$item->rate; @endphp
                                            @endforeach
                                            @php($width = ($total/$count)*30)
                                            <span class="event_star star_small" data-starnum="2">
                                                   <i></i>
                                                </span>
                                        @else
                                            <span class="event_star star_small" data-starnum="2">
                                                   <i></i>
                                                </span>
                                        @endif
                                    </p>
                                </div>
                            </div>
                        </div>
                    @endforeach
                </div>
                </div>
            </div>





{{--            <div class="btn-left">--}}
{{--                <div class="dropdown btn1">--}}
{{--                    <button class="btn btn-primary dropdown-toggle" type="button" data-toggle="dropdown"><i class="fas fa-share-alt"></i>--}}
{{--                        <span class=" btn3">اشتراک گذاری</span>--}}
{{--                    </button>--}}
{{--                    <ul class="dropdown-menu">--}}
{{--                        <li class="instagram"><a href=""> <i class="fab fa-instagram"></i> اینیستاگرام</a></li>--}}
{{--                        <li class="linkedin "><a href=""> <i class="fab fa-linkedin"></i> لینکدین</a></li>--}}
{{--                        <li class="whatsapp "><a href=""> <i class="fab fa-whatsapp"></i>واتزآپ </a></li>--}}
{{--                        <li class="facebook "><a href=""><i class="fab fa-facebook-f"></i> فیس بوک</a></li>--}}
{{--                        <li class="twitter "><a href=""> <i class="fab fa-twitter"></i>توییتر</a></li>--}}
{{--                    </ul>--}}
{{--                </div>--}}
{{--                <span class="btn1 btn2">  <i class="far fa-heart"></i> علاقه مندی </span>--}}
{{--            </div>--}}
{{--            <div class="slideshow">--}}

{{--                <div class="imglist">--}}
{{--                    <div class="box-right col-xs-12 col-sm-6 no-pad">--}}
{{--                        <a class="col-xs-12 no-pad"--}}
{{--                           href="{{asset('Uploaded/Gallery/Integrated/File/'.$integratedModel->getGallery[0]->img)}}" data-fancybox="images">--}}
{{--                            <img class="image-right"--}}
{{--                                 src="{{asset('Uploaded/Gallery/Integrated/File/'.$integratedModel->getGallery[0]->img)}}">--}}
{{--                        </a>--}}
{{--                        @foreach($integratedModel->getGallery as $key => $value)--}}
{{--                            <div class="hidden">--}}
{{--                                <a class="col-xs-12 no-pad image-slide-show"--}}
{{--                                   href="{{asset('Uploaded/Gallery/Integrated/File/'.$value->url)}}" data-fancybox="images">--}}
{{--                                    <img class=" image-slide-show"--}}
{{--                                         src="{{asset('Uploaded/Gallery/Integrated/File/'.$value->url)}}">--}}
{{--                                </a>--}}
{{--                            </div>--}}
{{--                        @endforeach--}}
{{--                    </div>--}}

{{--                </div>--}}
{{--                <div class="box-left col-xs-12 col-sm-6 no-pad">--}}
{{--                    @foreach($integratedModel->getGallery as $key => $value)--}}
{{--                        <div class="left col-xs-12 col-sm-6 no-pad">--}}
{{--                            <img class="image-slide-show" src="{{asset('Uploaded/Gallery/Integrated/File/'.$value->url)}}"/>--}}
{{--                        </div>--}}
{{--                    @endforeach--}}
{{--                </div>--}}
{{--            </div>--}}
{{--            <div class="container-fluid container-detail">--}}

{{--            </div>--}}
{{--        </div>--}}
{{--    </div>--}}




{{--    <div class="display-block"></div>--}}

@endsection

@section('script')


<script>
    $('.main-slide1').slick({
        rtl: true,
        margin: 10,
        dots: true,
        infinite: false,
        speed: 300,
        slidesToShow: 4,
        slidesToScroll: 2,
        loop: false,
        autoplay: false,
        autoplayTimeout: 3000,
        prevArrow: '<div class="slick-prev"><</div>',
        nextArrow: '<div class="slick-next">></div>',
        responsive: [
            {
                breakpoint: 1024,
                settings: {
                    slidesToShow: 3,
                    slidesToScroll: 3,
                    infinite: true,
                    dots: true
                }
            },
            {
                breakpoint: 600,
                settings: {
                    slidesToShow: 2,
                    slidesToScroll: 2
                }
            },
            {
                breakpoint: 480,
                settings: {
                    slidesToShow: 1,
                    slidesToScroll: 1
                }
            }

        ]
    });
</script>

@endsection