<style>
    .box-host-slide.item img {
        border-top-right-radius: 8px;
        border-top-left-radius: 8px;
    }
    .slick-dots {
        display: none !important;
    }
</style>
<div class="slider main-slide1">
    @foreach($hostModel as $key => $value)
        <div class="item box-host-slide" style="margin: 0px 10px;">
            <div class="Box-34">
                <a href="{{route('DetailHost', ['id' => $value->id])}}" class="thumbnail">
                <div class="owl-carousel owl-theme owl-slider">
                    @if(count($value->getGallery) > 0)
                        @foreach($value->getGallery as $item => $index)
                            <div class="item">
                                <div class="img-product">
                                    <img src="{{ asset(\App\ImageManager::resize('Uploaded/Gallery/Img/'.$index->img,['width' => 300, 'height' => 200])) }}">
                                </div>
                            </div>
                        @endforeach
                    @else
                        <div class="item">
                            <div class="img-product">
                                <img src="{{ asset(\App\ImageManager::resize('frontend/images/logo-rent-latin.png',['width' => 300, 'height' => 200])) }}">
                            </div>
                        </div>
                    @endif
                </div>
                @if(auth()->check())
                    <div class="quick-btn">
                        <div class="list btn-favorite" data-id="{{$value->id}}">
                            <p class="list-menu">
                                <button type="button" data-toggle="tooltip" title=""
                                        onclick="wishlist.add('#');"
                                        data-original-title="افزودن به لیست دلخواه">
                                    <i class="fas fa-heart" style="color: #fff;"></i>
                                </button>
                            </p>
                        </div>
                    </div>
                @endif
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
                    <p class="cost-product">
                                            <span>از
                                                @foreach($priceModel as $index => $item)
                                                    @if($value->id == $item->host_id)
                                                        {{$item->price}}
                                                    @endif
                                                @endforeach
                                            </span> تومان
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
            
        </div>
    @endforeach

</div>

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