@extends('frontend.MasterPage.Layout')
@section('title', TitlePage('صفحه اصلی'))
@section('meta')
    <meta name="description" content="">
    <meta name="twitter:description" content="">
    <meta name="twitter:title" content="{{TitlePage('صفحه اصلی')}}">
    <meta property="og:description" content="">
    <meta property="keyword" content="">
@endsection
@section('style')
@endsection
@section('slide')
@endsection
@section('content')
    @include('frontend.Page.SlideShow.SlideHomePage')
    <div class="main0" >
        <div class="container">
            <div class="row ">
                <div class="col-xs-12 col-sm-12 px-0">
                    <div id="demos">
                        <div class="large-12 columns category-section ">
                            <div class="owl-carousel owl-theme owl-vila">
                                <div class="item p-0">
                                    <div class="item1">
                                        <a href="" class="img-vila">
                                            <img src="{{asset('frontend/images/ct1.jpg')}}" alt="logo" >
                                            <span class="vila-name">آپارتمان مبله</span>
                                        </a>
                                    </div>
                                    <div class="description col-xs-12">
                                        <div class="row">
                                            <div class="col-md-6 col-xs-12 text-center pr-2">
                                                <a class="categori-name" href="">آپارتمان مبله در تهران</a>
                                            </div>
                                            <div class="col-md-6 col-xs-12 text-center pl-2">
                                                <a class="categori-name" href="">آپارتمان مبله در تهران</a>
                                            </div>
                                        </div>
                                        <div class="row">
                                            <div class="col-md-6 col-xs-12 text-center pr-2">
                                                <a class="categori-name" href="">آپارتمان مبله دراصفهان</a>
                                            </div>
                                            <div class="col-md-6 col-xs-12 text-center pl-2">
                                                <a class="categori-name" href="">آپارتمان مبله درمشهد</a>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="item p-0">
                                    <div class="item1">
                                        <a href="" class="img-vila">
                                            <img src="{{asset('frontend/images/ct2.jpg')}}" alt="logo" >
                                            <span class="vila-name">ویلا</span>
                                        </a>
                                    </div>
                                    <div class="description col-xs-12">
                                        <div class="row">
                                            <div class="col-md-6 col-xs-12 text-center pr-2">
                                                <a class="categori-name" href="">آپارتمان مبله در تهران</a>
                                            </div>
                                            <div class="col-md-6 col-xs-12 text-center pl-2">
                                                <a class="categori-name" href="">آپارتمان مبله در تهران</a>
                                            </div>
                                        </div>
                                        <div class="row">
                                            <div class="col-md-6 col-xs-12 text-center pr-2">
                                                <a class="categori-name" href="">آپارتمان مبله دراصفهان</a>
                                            </div>
                                            <div class="col-md-6 col-xs-12 text-center pl-2">
                                                <a class="categori-name" href="">آپارتمان مبله درمشهد</a>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="item p-0">
                                    <div class="item1">
                                        <a href="" class="img-vila">
                                            <img src="{{asset('frontend/images/ct3.jpg')}}" alt="logo" >
                                            <span class="vila-name">خانه بوم گردی</span>
                                        </a>
                                    </div>
                                    <div class="description col-xs-12">
                                        <div class="row">
                                            <div class="col-md-6 col-xs-12 text-center pr-2">
                                                <a class="categori-name" href="">آپارتمان مبله در تهران</a>
                                            </div>
                                            <div class="col-md-6 col-xs-12 text-center pl-2">
                                                <a class="categori-name" href="">آپارتمان مبله در تهران</a>
                                            </div>
                                        </div>
                                        <div class="row">
                                            <div class="col-md-6 col-xs-12 text-center pr-2">
                                                <a class="categori-name" href="">آپارتمان مبله دراصفهان</a>
                                            </div>
                                            <div class="col-md-6 col-xs-12 text-center pl-2">
                                                <a class="categori-name" href="">آپارتمان مبله درمشهد</a>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="item p-0">
                                    <div class="item1">
                                        <a href="" class="img-vila">
                                            <img src="{{asset('frontend/images/ct4.jpg')}}" alt="logo" >
                                            <span class="vila-name">هتل</span>
                                        </a>
                                    </div>
                                    <div class="description col-xs-12">
                                        <div class="row">
                                            <div class="col-md-6 col-xs-12 text-center pr-2">
                                                <a class="categori-name" href="">آپارتمان مبله در تهران</a>
                                            </div>
                                            <div class="col-md-6 col-xs-12 text-center pl-2">
                                                <a class="categori-name" href="">آپارتمان مبله در تهران</a>
                                            </div>
                                        </div>
                                        <div class="row">
                                            <div class="col-md-6 col-xs-12 text-center pr-2">
                                                <a class="categori-name" href="">آپارتمان مبله دراصفهان</a>
                                            </div>
                                            <div class="col-md-6 col-xs-12 text-center pl-2">
                                                <a class="categori-name" href="">آپارتمان مبله درمشهد</a>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>

            </div>
        </div>
    </div>
    <div class="box-item" >
        <div class="container">
            <div class="row ">
                <div class="col-xs-12 col-lg-11 mx-auto p-0 px-0">
                    <div class="owl-carousel owl-theme owl-service">
                        <div class="item text-center" >
                            <div class="d-block" data-toggle="modal" data-target="#service-modal1">
                                <div class="box-img">
                                    <img src="{{asset('frontend/images/img1.png')}}" alt="logo" >
                                </div>
                                <h3> اطلاعات کامل اقامتگاه </h3>

                            </div>

                        </div>
                        <div class="item text-center">
                            <div class="d-block" data-toggle="modal" data-target="#service-modal2">
                                <div class="box-img">
                                    <img src="{{asset('frontend/images/img2.png')}}" alt="logo" >
                                </div>
                                <h3> ضمانت بازگشت وجه</h3>

                            </div>

                        </div>
                        <div class="item text-center">
                            <div class="d-block" data-toggle="modal" data-target="#service-modal3">
                                <div class="box-img">
                                    <img src="{{asset('frontend/images/img3.png')}}" alt="logo" >
                                </div>
                                <h3> پشتیبانی در طول اقامت </h3>

                            </div>

                        </div>
                        <div class="item text-center">
                            <div class="d-block" data-toggle="modal" data-target="#service-modal4">
                                <div class="box-img">
                                    <img src="{{asset('frontend/images/img21.png')}}" alt="logo" >
                                </div>
                                <h3> پوشش تمامی شهر ها   </h3>

                            </div>

                        </div>
                    </div>
                </div>

            </div>
        </div>
    </div>
    <div class="main0" >
        <div class="container">
            <div class="row ">
                <div class="col-xs-12 col-sm-12 px-0">
                    <h3> <img src="{{asset('frontend/images/icon5.png')}}" alt="logo" > <span> ویلا و آپارتمان های پیشنهادی </span> <a href="" class="all-place"> همه اقامتگاه ها </a> </h3>
                    <div id="demos">
                        <div class="large-12 columns">
                            <div class="owl-carousel owl-theme demos carusel2">
                                @foreach(GetHost('default') as $key => $value)
                                    @include('frontend.Content.HostBox')
                                @endforeach
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-xs-12 col-sm-12 px-0 col-city">
                    <h3> <img src="{{asset('frontend/images/icon1.jpg')}}" alt="logo" > <span> محبوبترین مقصدها </span> </h3>
                    <div id="demos" class="carousel1">
                        <div class="large-12 columns">
                            <div class="owl-carousel owl-theme demos2 carusel2">
                                <div class="item">
                                    <div class="item1">
                                        <img src="{{asset('frontend/images/city1.jpg')}}" alt="logo" >
                                        <a href="" class="layer">
                                            <div class="description2">
                                                <h4> تهران </h4>
                                                <span> 20 خانه </span>
                                            </div>
                                        </a>
                                    </div>
                                </div>
                                <div class="item">
                                    <div class="item1">
                                        <img src="{{asset('frontend/images/city2.jpg')}}" alt="logo" >
                                        <a href="" class="layer">
                                            <div class="description2">
                                                <h4> شیراز </h4>
                                                <span> 24 خانه </span>
                                            </div>
                                        </a>
                                    </div>
                                </div>
                                <div class="item">
                                    <div class="item1">
                                        <img src="{{asset('frontend/images/city2.jpg')}}" alt="logo" >
                                        <a href="" class="layer">
                                            <div class="description2">
                                                <h4> یزد </h4>
                                                <span> 20 خانه </span>
                                            </div>
                                        </a>
                                    </div>
                                </div>
                                <div class="item">
                                    <div class="item1">
                                        <img src="{{asset('frontend/images/city4.jpg')}}" alt="logo" >
                                        <a href="" class="layer">
                                            <div class="description2">
                                                <h4> رامسر </h4>
                                                <span> 20 خانه </span>
                                            </div>
                                        </a>
                                    </div>
                                </div>
                                <div class="item">
                                    <div class="item1">
                                        <img src="{{asset('frontend/images/city5.jpg')}}" alt="logo" >
                                        <a href="" class="layer">
                                            <div class="description2">
                                                <h4> قشم </h4>
                                                <span> 24 خانه </span>
                                            </div>
                                        </a>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-xs-12 col-sm-12 px-0">
                    <h3> <img src="{{asset('frontend/images/icon4.png')}}" alt="logo" > <span> اقامتگاه های استخردار </span> <a href="" class="all-place"> همه اقامتگاه ها </a> </h3>
                    <div id="demos">
                        <div class="large-12 columns">
                            <div class="owl-carousel owl-theme demos carusel2">
                                <div class="item">
                                    <div class="item1">
                                        <a href="" class="img-pro"> <img src="{{asset('frontend/images/est1.jpg')}}" alt="" ></a>
                                        <div class="icon-item">
                                            <span class="discount sale1"> 20% </span>
                                            <span class="favorite"><i class="far fa-heart"></i></span>
                                            <div class="card__share">
                                                <div class="card__social">
                                                    <a class="share-icon whatsapp" href="#">
                                                        <span class="fab fa-whatsapp"></span>
                                                    </a>
                                                    <a class="share-icon telegram" href="#">
                                                        <span class="fab fa-telegram-plane"></span>
                                                    </a>
                                                    <a class="share-icon instagram" href="#">
                                                        <span class="fab fa-instagram"></span>
                                                    </a>
                                                </div>

                                                <a id="share" class="share-toggle share-icon" href="#">

                                                </a>
                                            </div>

                                        </div>
                                    </div>
                                    <div class="description col-xs-12">
                                        <div class="location"> <i class="img-marker"></i> <span> گیلان، بندر انزلی، ویلایی </span> </div>
                                        <h4><a href=""> اقامتگاه بوم‌گردی ماه‌سو (خیام) </a></h4>
                                        <div class="description1">
                                            <div class="row">
                                                <div class="col-xs-12 col-sm-8 padding1">
                                                    <div class="price-item"> هر شب از <span> 220/000</span> تومان </div>
                                                </div>
                                                <div class="col-xs-12 col-sm-4 padding1">
                                                    <div class="price-item-old">220/000 تومان</div>
                                                </div>
                                            </div>
                                            <ul class="items-des">
                                                <li> <i class="img-bed"></i> <span> 2خوابه</span> </li>
                                                <li> <i class="img-user"></i> <span> تا 3 نفر</span> </li>
                                            </ul>

                                            <ul class="starcomment">
                                                <li> <i class="fas fa-star"></i><i class="fas fa-star"></i><i class="fas fa-star"></i> <i class="far fa-star"></i><i class="far fa-star"></i> </li>
                                                <li><span>( 3 نظر)</span> <span> مهمان نواز</span>    </li>
                                                <li class="buy"> <a href=""> خرید آنی </a> </li>
                                            </ul>
                                        </div>
                                    </div>
                                </div>
                                <div class="item">
                                    <div class="item1">
                                        <a href="" class="img-pro"> <img src="{{asset('frontend/images/est2.jpg')}}" alt="" ></a>
                                        <div class="icon-item">
                                            <span class="discount sale1"> 20% </span>
                                            <span class="favorite"><i class="far fa-heart"></i></span>
                                            <div class="card__share">
                                                <div class="card__social">
                                                    <a class="share-icon whatsapp" href="#">
                                                        <span class="fab fa-whatsapp"></span>
                                                    </a>
                                                    <a class="share-icon telegram" href="#">
                                                        <span class="fab fa-telegram-plane"></span>
                                                    </a>
                                                    <a class="share-icon instagram" href="#">
                                                        <span class="fab fa-instagram"></span>
                                                    </a>
                                                </div>

                                                <a id="share" class="share-toggle share-icon" href="#">

                                                </a>
                                            </div>

                                        </div>
                                    </div>
                                    <div class="description col-xs-12">
                                        <div class="location"> <i class="img-marker"></i> <span> گیلان، بندر انزلی، ویلایی </span> </div>
                                        <h4><a href=""> اقامتگاه بوم‌گردی ماه‌سو (خیام) </a></h4>
                                        <div class="description1">
                                            <div class="row">
                                                <div class="col-xs-12 col-sm-8 padding1">
                                                    <div class="price-item"> هر شب از <span> 220/000</span> تومان </div>
                                                </div>
                                                <div class="col-xs-12 col-sm-4 padding1">
                                                    <div class="price-item-old">220/000 تومان</div>
                                                </div>
                                            </div>
                                            <ul class="items-des">
                                                <li> <i class="img-bed"></i> <span> 2خوابه</span> </li>
                                                <li> <i class="img-user"></i> <span> تا 3 نفر</span> </li>
                                            </ul>

                                            <ul class="starcomment">
                                                <li> <i class="fas fa-star"></i><i class="fas fa-star"></i><i class="fas fa-star"></i> <i class="far fa-star"></i><i class="far fa-star"></i> </li>
                                                <li><span>( 3 نظر)</span> <span> مهمان نواز</span>    </li>
                                                <li class="buy"> <a href=""> خرید آنی </a> </li>
                                            </ul>
                                        </div>
                                    </div>
                                </div>
                                <div class="item">
                                    <div class="item1">
                                        <a href="" class="img-pro"> <img src="{{asset('frontend/images/est3.jpg')}}" alt="" ></a>
                                        <div class="icon-item">
                                            <span class="discount sale1"> 20% </span>
                                            <span class="favorite"><i class="far fa-heart"></i></span>
                                            <div class="card__share">
                                                <div class="card__social">
                                                    <a class="share-icon whatsapp" href="#">
                                                        <span class="fab fa-whatsapp"></span>
                                                    </a>
                                                    <a class="share-icon telegram" href="#">
                                                        <span class="fab fa-telegram-plane"></span>
                                                    </a>
                                                    <a class="share-icon instagram" href="#">
                                                        <span class="fab fa-instagram"></span>
                                                    </a>
                                                </div>

                                                <a id="share" class="share-toggle share-icon" href="#">

                                                </a>
                                            </div>

                                        </div>
                                    </div>
                                    <div class="description col-xs-12">
                                        <div class="location"> <i class="img-marker"></i> <span> گیلان، بندر انزلی، ویلایی </span> </div>
                                        <h4><a href=""> اقامتگاه بوم‌گردی ماه‌سو (خیام) </a></h4>
                                        <div class="description1">
                                            <div class="row">
                                                <div class="col-xs-12 col-sm-8 padding1">
                                                    <div class="price-item"> هر شب از <span> 220/000</span> تومان </div>
                                                </div>
                                                <div class="col-xs-12 col-sm-4 padding1">
                                                    <div class="price-item-old">220/000 تومان</div>
                                                </div>
                                            </div>
                                            <ul class="items-des">
                                                <li> <i class="img-bed"></i> <span> 2خوابه</span> </li>
                                                <li> <i class="img-user"></i> <span> تا 3 نفر</span> </li>
                                            </ul>

                                            <ul class="starcomment">
                                                <li> <i class="fas fa-star"></i><i class="fas fa-star"></i><i class="fas fa-star"></i> <i class="far fa-star"></i><i class="far fa-star"></i> </li>
                                                <li><span>( 3 نظر)</span> <span> مهمان نواز</span>    </li>
                                                <li class="buy"> <a href=""> خرید آنی </a> </li>
                                            </ul>
                                        </div>
                                    </div>
                                </div>
                                <div class="item">
                                    <div class="item1">
                                        <a href="" class="img-pro"> <img src="{{asset('frontend/images/est4.jpg')}}" alt="" ></a>
                                        <div class="icon-item">
                                            <span class="discount sale1"> 20% </span>
                                            <span class="favorite"><i class="far fa-heart"></i></span>
                                            <div class="card__share">
                                                <div class="card__social">
                                                    <a class="share-icon whatsapp" href="#">
                                                        <span class="fab fa-whatsapp"></span>
                                                    </a>
                                                    <a class="share-icon telegram" href="#">
                                                        <span class="fab fa-telegram-plane"></span>
                                                    </a>
                                                    <a class="share-icon instagram" href="#">
                                                        <span class="fab fa-instagram"></span>
                                                    </a>
                                                </div>

                                                <a id="share" class="share-toggle share-icon" href="#">

                                                </a>
                                            </div>

                                        </div>
                                    </div>
                                    <div class="description col-xs-12">
                                        <div class="location"> <i class="img-marker"></i> <span> گیلان، بندر انزلی، ویلایی </span> </div>
                                        <h4><a href=""> اقامتگاه بوم‌گردی ماه‌سو (خیام) </a></h4>
                                        <div class="description1">
                                            <div class="row">
                                                <div class="col-xs-12 col-sm-8 padding1">
                                                    <div class="price-item"> هر شب از <span> 220/000</span> تومان </div>
                                                </div>
                                                <div class="col-xs-12 col-sm-4 padding1">
                                                    <div class="price-item-old">220/000 تومان</div>
                                                </div>
                                            </div>
                                            <ul class="items-des">
                                                <li> <i class="img-bed"></i> <span> 2خوابه</span> </li>
                                                <li> <i class="img-user"></i> <span> تا 3 نفر</span> </li>
                                            </ul>

                                            <ul class="starcomment">
                                                <li> <i class="fas fa-star"></i><i class="fas fa-star"></i><i class="fas fa-star"></i> <i class="far fa-star"></i><i class="far fa-star"></i> </li>
                                                <li><span>( 3 نظر)</span> <span> مهمان نواز</span>    </li>
                                                <li class="buy"> <a href=""> خرید آنی </a> </li>
                                            </ul>
                                        </div>
                                    </div>
                                </div>
                                <div class="item">
                                    <div class="item1">
                                        <a href="" class="img-pro"> <img src="{{asset('frontend/images/est1.jpg')}}" alt="" ></a>
                                        <div class="icon-item">
                                            <span class="discount sale1"> 20% </span>
                                            <span class="favorite"><i class="far fa-heart"></i></span>
                                            <div class="card__share">
                                                <div class="card__social">
                                                    <a class="share-icon whatsapp" href="#">
                                                        <span class="fab fa-whatsapp"></span>
                                                    </a>
                                                    <a class="share-icon telegram" href="#">
                                                        <span class="fab fa-telegram-plane"></span>
                                                    </a>
                                                    <a class="share-icon instagram" href="#">
                                                        <span class="fab fa-instagram"></span>
                                                    </a>
                                                </div>

                                                <a id="share" class="share-toggle share-icon" href="#">

                                                </a>
                                            </div>

                                        </div>
                                    </div>
                                    <div class="description col-xs-12">
                                        <div class="location"> <i class="img-marker"></i> <span> گیلان، بندر انزلی، ویلایی </span> </div>
                                        <h4><a href=""> اقامتگاه بوم‌گردی ماه‌سو (خیام) </a></h4>
                                        <div class="description1">
                                            <div class="row">
                                                <div class="col-xs-12 col-sm-8 padding1">
                                                    <div class="price-item"> هر شب از <span> 220/000</span> تومان </div>
                                                </div>
                                                <div class="col-xs-12 col-sm-4 padding1">
                                                    <div class="price-item-old">220/000 تومان</div>
                                                </div>
                                            </div>
                                            <ul class="items-des">
                                                <li> <i class="img-bed"></i> <span> 2خوابه</span> </li>
                                                <li> <i class="img-user"></i> <span> تا 3 نفر</span> </li>
                                            </ul>

                                            <ul class="starcomment">
                                                <li> <i class="fas fa-star"></i><i class="fas fa-star"></i><i class="fas fa-star"></i> <i class="far fa-star"></i><i class="far fa-star"></i> </li>
                                                <li><span>( 3 نظر)</span> <span> مهمان نواز</span>    </li>
                                                <li class="buy"> <a href=""> خرید آنی </a> </li>
                                            </ul>
                                        </div>
                                    </div>
                                </div>
                                <div class="item">
                                    <div class="item1">
                                        <a href="" class="img-pro"> <img src="{{asset('frontend/images/est2.jpg')}}" alt="" ></a>
                                        <div class="icon-item">
                                            <span class="discount sale1"> 20% </span>
                                            <span class="favorite"><i class="far fa-heart"></i></span>
                                            <div class="card__share">
                                                <div class="card__social">
                                                    <a class="share-icon whatsapp" href="#">
                                                        <span class="fab fa-whatsapp"></span>
                                                    </a>
                                                    <a class="share-icon telegram" href="#">
                                                        <span class="fab fa-telegram-plane"></span>
                                                    </a>
                                                    <a class="share-icon instagram" href="#">
                                                        <span class="fab fa-instagram"></span>
                                                    </a>
                                                </div>

                                                <a id="share" class="share-toggle share-icon" href="#">

                                                </a>
                                            </div>

                                        </div>
                                    </div>
                                    <div class="description col-xs-12">
                                        <div class="location"> <i class="img-marker"></i> <span> گیلان، بندر انزلی، ویلایی </span> </div>
                                        <h4><a href=""> اقامتگاه بوم‌گردی ماه‌سو (خیام) </a></h4>
                                        <div class="description1">
                                            <div class="row">
                                                <div class="col-xs-12 col-sm-8 padding1">
                                                    <div class="price-item"> هر شب از <span> 220/000</span> تومان </div>
                                                </div>
                                                <div class="col-xs-12 col-sm-4 padding1">
                                                    <div class="price-item-old">220/000 تومان</div>
                                                </div>
                                            </div>
                                            <ul class="items-des">
                                                <li> <i class="img-bed"></i> <span> 2خوابه</span> </li>
                                                <li> <i class="img-user"></i> <span> تا 3 نفر</span> </li>
                                            </ul>

                                            <ul class="starcomment">
                                                <li> <i class="fas fa-star"></i><i class="fas fa-star"></i><i class="fas fa-star"></i> <i class="far fa-star"></i><i class="far fa-star"></i> </li>
                                                <li><span>( 3 نظر)</span> <span> مهمان نواز</span>    </li>
                                                <li class="buy"> <a href=""> خرید آنی </a> </li>
                                            </ul>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <div class="main" style="background: url('{{asset('frontend/images/bimg1.jpg')}}');">
        <div class="container-fluid">
            <div class="container">
                <div class="row ">
                    <div class="col-xs-12 col-sm-6">
                        <div class="text-img">
                            <h3> اقامتـــگاه‌های آنـــی </h3>
                            <p> بدون انتظار تایید میزبان </p>
                            <p> برای رزرو این اقامتگاه‌ها نیاز به تایید میزبان نیست و می‌توانید </p>
                            <span> بدون انتظار اقامتگاه خود را رزرو کنید </span> </div>
                    </div>
                    <div class="col-xs-12 col-sm-6 sale-inside-col">
                        <div class="sale-inside"> <a href=""> مشاهده اقامتگاه آنی </a> </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <div id="main1" class="main0">
        <div class="container">
            <div class="row">
                <div class="col-xs-12 col-sm-12 px-0">
                    <h3> <img src="{{asset('frontend/images/icon1.png')}}" alt="logo" > <span> اقامتگاه های مقرون به صرفه </span> <a href="" class="all-place"> همه اقامتگاه ها </a> </h3>
                    <div id="demos">
                        <div class="large-12 columns">
                            <div class="owl-carousel owl-theme demos carusel2">
                                <div class="item">
                                    <div class="item1">
                                        <a href="" class="img-pro"> <img src="{{asset('frontend/images/villa1.jpg')}}" alt="" ></a>
                                        <div class="icon-item">
                                            <span class="discount sale1"> 20% </span>
                                            <span class="favorite"><i class="far fa-heart"></i></span>
                                            <div class="card__share">
                                                <div class="card__social">
                                                    <a class="share-icon whatsapp" href="#">
                                                        <span class="fab fa-whatsapp"></span>
                                                    </a>
                                                    <a class="share-icon telegram" href="#">
                                                        <span class="fab fa-telegram-plane"></span>
                                                    </a>
                                                    <a class="share-icon instagram" href="#">
                                                        <span class="fab fa-instagram"></span>
                                                    </a>
                                                </div>

                                                <a id="share" class="share-toggle share-icon" href="#">

                                                </a>
                                            </div>

                                        </div>
                                    </div>
                                    <div class="description col-xs-12">
                                        <div class="location"> <i class="img-marker"></i> <span> گیلان، بندر انزلی، ویلایی </span> </div>
                                        <h4><a href=""> اقامتگاه بوم‌گردی ماه‌سو (خیام) </a></h4>
                                        <div class="description1">
                                            <div class="row">
                                                <div class="col-xs-12 col-sm-8 padding1">
                                                    <div class="price-item"> هر شب از <span> 220/000</span> تومان </div>
                                                </div>
                                                <div class="col-xs-12 col-sm-4 padding1">
                                                    <div class="price-item-old">220/000 تومان</div>
                                                </div>
                                            </div>
                                            <ul class="items-des">
                                                <li> <i class="img-bed"></i> <span> 2خوابه</span> </li>
                                                <li> <i class="img-user"></i> <span> تا 3 نفر</span> </li>
                                            </ul>

                                            <ul class="starcomment">
                                                <li> <i class="fas fa-star"></i><i class="fas fa-star"></i><i class="fas fa-star"></i> <i class="far fa-star"></i><i class="far fa-star"></i> </li>
                                                <li><span>( 3 نظر)</span> <span> مهمان نواز</span>    </li>
                                                <li class="buy"> <a href=""> خرید آنی </a> </li>
                                            </ul>
                                        </div>
                                    </div>
                                </div>
                                <div class="item">
                                    <div class="item1">
                                        <a href="" class="img-pro"> <img src="{{asset('frontend/images/villa2.jpg')}}" alt="" ></a>
                                        <div class="icon-item"> <span class="discount sale1"> 20% </span> <span class="favorite"><i class="far fa-heart"></i></span>
                                            <div class="card__share">
                                                <div class="card__social">
                                                    <a class="share-icon whatsapp" href="#">
                                                        <span class="fab fa-whatsapp"></span>
                                                    </a>
                                                    <a class="share-icon telegram" href="#">
                                                        <span class="fab fa-telegram-plane"></span>
                                                    </a>
                                                    <a class="share-icon instagram" href="#">
                                                        <span class="fab fa-instagram"></span>
                                                    </a>
                                                </div>

                                                <a id="share" class="share-toggle share-icon" href="#">

                                                </a>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="description col-xs-12">
                                        <div class="location">  <i class="img-marker"></i> <span> گیلان، بندر انزلی، ویلایی </span> </div>
                                        <h4><a href=""> اقامتگاه بوم‌گردی ماه‌سو (خیام) </a></h4>
                                        <div class="description1">
                                            <div class="row">
                                                <div class="col-xs-12 col-sm-8 padding1">
                                                    <div class="price-item"> هر شب از <span> 220/000</span> تومان </div>
                                                </div>
                                                <div class="col-xs-12 col-sm-4 padding1">
                                                    <div class="price-item-old">220/000 تومان</div>
                                                </div>
                                            </div>
                                            <ul class="items-des">
                                                <li> <i class="img-bed"></i> <span> 2خوابه</span> </li>
                                                <li> <i class="img-user"></i> <span> تا 3 نفر</span> </li>
                                            </ul>

                                            <ul class="starcomment">
                                                <li> <i class="fas fa-star"></i><i class="fas fa-star"></i><i class="fas fa-star"></i> <i class="far fa-star"></i><i class="far fa-star"></i> </li>
                                                <li> <span>( 3 نظر)</span> <span> مهمان نواز</span>    </li>
                                                <li class="buy"> <a href=""> خرید آنی </a> </li>
                                            </ul>
                                        </div>
                                    </div>
                                </div>
                                <div class="item">
                                    <div class="item1">
                                        <a href="" class="img-pro"> <img src="{{asset('frontend/images/villa3.jpg')}}" alt="" ></a>
                                        <div class="icon-item"> <span class="discount sale1"> 20% </span> <span class="favorite"><i class="far fa-heart"></i></span>
                                            <div class="card__share">
                                                <div class="card__social">
                                                    <a class="share-icon whatsapp" href="#">
                                                        <span class="fab fa-whatsapp"></span>
                                                    </a>
                                                    <a class="share-icon telegram" href="#">
                                                        <span class="fab fa-telegram-plane"></span>
                                                    </a>
                                                    <a class="share-icon instagram" href="#">
                                                        <span class="fab fa-instagram"></span>
                                                    </a>
                                                </div>

                                                <a id="share" class="share-toggle share-icon" href="#">

                                                </a>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="description col-xs-12">
                                        <div class="location">  <i class="img-marker"></i> <span> گیلان، بندر انزلی، ویلایی </span> </div>
                                        <h4><a href=""> اقامتگاه بوم‌گردی ماه‌سو (خیام) </a></h4>
                                        <div class="description1">
                                            <div class="row">
                                                <div class="col-xs-12 col-sm-8 padding1">
                                                    <div class="price-item"> هر شب از <span> 220/000</span> تومان </div>
                                                </div>
                                                <div class="col-xs-12 col-sm-4 padding1">
                                                    <div class="price-item-old">220/000 تومان</div>
                                                </div>
                                            </div>
                                            <ul class="items-des">
                                                <li> <i class="img-bed"></i> <span> 2خوابه</span> </li>
                                                <li> <i class="img-user"></i> <span> تا 3 نفر</span> </li>
                                            </ul>

                                            <ul class="starcomment">
                                                <li> <i class="fas fa-star"></i><i class="fas fa-star"></i><i class="fas fa-star"></i> <i class="far fa-star"></i><i class="far fa-star"></i> </li>
                                                <li><span>( 3 نظر)</span><span> مهمان نواز</span>   </li>
                                                <li class="buy"> <a href=""> خرید آنی </a> </li>
                                            </ul>
                                        </div>
                                    </div>
                                </div>
                                <div class="item">
                                    <div class="item1">
                                        <a href="" class="img-pro"> <img src="{{asset('frontend/images/villa4.jpg')}}" alt="" ></a>
                                        <div class="icon-item"> <span class="discount sale1"> 20% </span> <span class="favorite"><i class="far fa-heart"></i></span>
                                            <div class="card__share">
                                                <div class="card__social">
                                                    <a class="share-icon whatsapp" href="#">
                                                        <span class="fab fa-whatsapp"></span>
                                                    </a>
                                                    <a class="share-icon telegram" href="#">
                                                        <span class="fab fa-telegram-plane"></span>
                                                    </a>
                                                    <a class="share-icon instagram" href="#">
                                                        <span class="fab fa-instagram"></span>
                                                    </a>
                                                </div>

                                                <a id="share" class="share-toggle share-icon" href="#">

                                                </a>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="description col-xs-12">
                                        <div class="location">  <i class="img-marker"></i> <span> گیلان، بندر انزلی، ویلایی </span> </div>
                                        <h4><a href=""> اقامتگاه بوم‌گردی ماه‌سو (خیام) </a></h4>
                                        <div class="description1">
                                            <div class="row">
                                                <div class="col-xs-12 col-sm-8 padding1">
                                                    <div class="price-item"> هر شب از <span> 220/000</span> تومان </div>
                                                </div>
                                                <div class="col-xs-12 col-sm-4 padding1">
                                                    <div class="price-item-old">220/000 تومان</div>
                                                </div>
                                            </div>
                                            <ul class="items-des">
                                                <li> <i class="img-bed"></i> <span> 2خوابه</span> </li>
                                                <li> <i class="img-user"></i> <span> تا 3 نفر</span> </li>
                                            </ul>

                                            <ul class="starcomment">
                                                <li> <i class="fas fa-star"></i><i class="fas fa-star"></i><i class="fas fa-star"></i> <i class="far fa-star"></i><i class="far fa-star"></i> </li>
                                                <li><span>( 3 نظر)</span> <span> مهمان نواز</span>   </li>
                                                <li class="buy"> <a href=""> خرید آنی </a> </li>
                                            </ul>
                                        </div>
                                    </div>
                                </div>
                                <div class="item">
                                    <div class="item1">
                                        <a href="" class="img-pro"> <img src="{{asset('frontend/images/villa1.jpg')}}" alt="" ></a>
                                        <div class="icon-item"> <span class="discount sale1"> 20% </span> <span class="favorite"><i class="far fa-heart"></i></span>
                                            <div class="card__share">
                                                <div class="card__social">
                                                    <a class="share-icon whatsapp" href="#">
                                                        <span class="fab fa-whatsapp"></span>
                                                    </a>
                                                    <a class="share-icon telegram" href="#">
                                                        <span class="fab fa-telegram-plane"></span>
                                                    </a>
                                                    <a class="share-icon instagram" href="#">
                                                        <span class="fab fa-instagram"></span>
                                                    </a>
                                                </div>

                                                <a id="share" class="share-toggle share-icon" href="#">

                                                </a>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="description col-xs-12">
                                        <div class="location">  <i class="img-marker"></i> <span> گیلان، بندر انزلی، ویلایی </span> </div>
                                        <h4><a href=""> اقامتگاه بوم‌گردی ماه‌سو (خیام) </a></h4>
                                        <div class="description1">
                                            <div class="row">
                                                <div class="col-xs-12 col-sm-8 padding1">
                                                    <div class="price-item"> هر شب از <span> 220/000</span> تومان </div>
                                                </div>
                                                <div class="col-xs-12 col-sm-4 padding1">
                                                    <div class="price-item-old">220/000 تومان</div>
                                                </div>
                                            </div>
                                            <ul class="items-des">
                                                <li> <i class="img-bed"></i> <span> 2خوابه</span> </li>
                                                <li> <i class="img-user"></i> <span> تا 3 نفر</span> </li>
                                            </ul>

                                            <ul class="starcomment">
                                                <li> <i class="fas fa-star"></i><i class="fas fa-star"></i><i class="fas fa-star"></i> <i class="far fa-star"></i><i class="far fa-star"></i> </li>
                                                <li> <span>( 3 نظر)</span> <span> مهمان نواز</span>   </li>
                                                <li class="buy"> <a href=""> خرید آنی </a> </li>
                                            </ul>
                                        </div>
                                    </div>
                                </div>
                                <div class="item">
                                    <div class="item1">
                                        <a href="" class="img-pro"> <img src="{{asset('frontend/images/villa2.jpg')}}" alt="" ></a>
                                        <div class="icon-item"> <span class="discount sale1"> 20% </span> <span class="favorite"><i class="far fa-heart"></i></span>
                                            <div class="card__share">
                                                <div class="card__social">
                                                    <a class="share-icon whatsapp" href="#">
                                                        <span class="fab fa-whatsapp"></span>
                                                    </a>
                                                    <a class="share-icon telegram" href="#">
                                                        <span class="fab fa-telegram-plane"></span>
                                                    </a>
                                                    <a class="share-icon instagram" href="#">
                                                        <span class="fab fa-instagram"></span>
                                                    </a>
                                                </div>

                                                <a id="share" class="share-toggle share-icon" href="#">

                                                </a>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="description col-xs-12">
                                        <div class="location">  <i class="img-marker"></i> <span> گیلان، بندر انزلی، ویلایی </span> </div>
                                        <h4><a href=""> اقامتگاه بوم‌گردی ماه‌سو (خیام) </a></h4>
                                        <div class="description1">
                                            <div class="row">
                                                <div class="col-xs-12 col-sm-8 padding1">
                                                    <div class="price-item"> هر شب از <span> 220/000</span> تومان </div>
                                                </div>
                                                <div class="col-xs-12 col-sm-4 padding1">
                                                    <div class="price-item-old">220/000 تومان</div>
                                                </div>
                                            </div>
                                            <ul class="items-des">
                                                <li> <i class="img-bed"></i> <span> 2خوابه</span> </li>
                                                <li> <i class="img-user"></i> <span> تا 3 نفر</span> </li>
                                            </ul>

                                            <ul class="starcomment">
                                                <li> <i class="fas fa-star"></i><i class="fas fa-star"></i><i class="fas fa-star"></i> <i class="far fa-star"></i><i class="far fa-star"></i> </li>
                                                <li> <span>( 3 نظر)</span>  <span> مهمان نواز</span> </li>
                                                <li class="buy"> <a href=""> خرید آنی </a> </li>
                                            </ul>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
