<style>
    .box-host-slide.item img {
        border-top-right-radius: 8px;
        border-top-left-radius: 8px;
    }
    .slick-dots {
        display: none !important;
    }
</style>
<div class="slider main-slide10">
    @foreach($integratedModel as $key => $value)
        <div class="item box-host-slide" style="margin: 0px 10px;">
            <div class="Box-34">
                <a href="{{route('DetailIntegrated', ['id' => $value->id])}}" class="thumbnail">
                    <div class="owl-carousel owl-theme owl-slider">
                        @foreach($value->getGallery as $item => $index)
                            <div class="item">
                                <div class="img-product">
                                    <img src="{{ asset(\App\ImageManager::resize('Uploaded/Gallery/Integrated/File/'.$index->url,['width' => 300, 'height' => 200])) }}">
                                </div>
                            </div>
                        @endforeach
                    </div>
{{--                    @if(auth()->check())--}}
{{--                        <div class="quick-btn">--}}
{{--                            <div class="list btn-favorite" data-id="{{$value->id}}">--}}
{{--                                <p class="list-menu">--}}
{{--                                    <button type="button" data-toggle="tooltip" title=""--}}
{{--                                            onclick="wishlist.add('#');"--}}
{{--                                            data-original-title="افزودن به لیست دلخواه">--}}
{{--                                        <i class="fas fa-heart" style="color: #fff;"></i>--}}
{{--                                    </button>--}}
{{--                                </p>--}}
{{--                            </div>--}}
{{--                        </div>--}}
{{--                    @endif--}}
                </a>
                <div class="row">
                    <div class="box-texts">
                        <h4 class="product-name">
                            {{$value->title}}
                        </h4>
                        <span class="low-price">از {{getMinPriceIntegrated($value->id)}}</span>
                        <p class="short-desc">
                            <i class="fa fa-location-arrow"></i>
                            @if($Province = $value->getHost[0]->getProvince)
                                {{ $Province->name }}
                            @else
                                -
                            @endif
                            -
                            @if($Township = $value->getHost[0]->getTownship)
                                {{ $Township->name }}
                            @else
                                -
                            @endif
                            تعداد اقامتگاه : {{$value->count_host}}
                        </p>
                    </div>
                </div>
            </div>

        </div>
    @endforeach

</div>

<script>
    $('.main-slide10').slick({
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