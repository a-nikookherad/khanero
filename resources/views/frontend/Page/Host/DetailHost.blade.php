@extends('frontend.MasterPage.Layout')
@section('title',TitlePage($hostModel->name))
@section('style')
    <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.3.1/css/all.css" integrity="sha384-mzrmE5qonljUremFsqc01SB46JvROS7bZs3IO2EmfFsd15uHvIt+Y8vEf7N7fWAU" crossorigin="anonymous">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/lightgallery/1.3.9/css/lightgallery.min.css">
    <link rel="stylesheet" href="/khosravi/frontend/css/lightgallery.min.css" />
    <style>
        .container-fluid,.top {width: 100%;float: none;}
        body {font-size: 14px;}
        @media screen and (max-width:767.99px){
            body {font-size: 13px;}
        }
        /*=*=*=*=*=*= * --- tooltip --  * ======================== */
        [tooltip] {position: relative; }
        [tooltip]::before,
        [tooltip]::after {text-transform: none; font-size: .9em;line-height: 1;user-select: none;pointer-events: none;position: absolute;display: none;opacity: 0;}
        [tooltip]::before {content: '';border: 5px solid transparent; z-index: 1001;}
        [tooltip]::after {content: attr(tooltip);text-align: center;min-width: 3em;max-width: 21em;white-space: nowrap;overflow: hidden;text-overflow: ellipsis;padding: 1ch 1.5ch;border-radius: 3px;box-shadow: 0 1em 2em -0.5em rgb(0 0 0 / 35%);background: #ebf7fa;color: #fff;z-index: 1000;font-size: 12px;border: 1px solid #7064b3;}
        [tooltip]:hover::before,
        [tooltip]:hover::after {display: block;}
        [tooltip='']::before,
        [tooltip='']::after {display: none !important;}
        [tooltip]:not([flow])::before,
        [tooltip][flow^="up"]::before {bottom: 118%;border-bottom-width: 0;border-top-color: #7064b3;}
        [tooltip]:not([flow])::after,
        [tooltip][flow^="up"]::after {bottom: calc(100% + 10px);}
        [tooltip]:not([flow])::after,
        [tooltip][flow^="up"]::before,
        [tooltip][flow^="up"]::after {color:#000;background: #fff;left: 50%;transform: translate(-50%, -.5em);}
        [tooltip]:not([flow])::before,{color:#000;background: transparent !important;left: 50%;transform: translate(-50%, -.5em);}
        @keyframes tooltips-vert {
            to {opacity: .9;transform: translate(-50%, 0);}
        }
        @keyframes tooltips-horz {
            to {opacity: .9;transform: translate(0, -50%);}
        }
        [tooltip]:not([flow]):hover::before,
        [tooltip]:not([flow]):hover::after,
        [tooltip][flow^="up"]:hover::before,
        [tooltip][flow^="up"]:hover::after,
        [tooltip][flow^="down"]:hover::before,
        [tooltip][flow^="down"]:hover::after {animation: tooltips-vert 300ms ease-out forwards;}
        [tooltip][flow^="left"]:hover::before,
        [tooltip][flow^="left"]:hover::after,
        [tooltip][flow^="right"]:hover::before,
        [tooltip][flow^="right"]:hover::after {animation: tooltips-horz 300ms ease-out forwards;}
.fab {
    font-family: "Font Awesome 5 Brands" !important;
}
        .nav-slider img {
            width: 100%;
        }
        img.option-img {
            width: 25px;
        }



        .display-none {
            display: none;
        }
        .link-clear-date {
            text-decoration: underline !important;
            color: #007b8c;
            font-size: 12px;
        }
        #InputDateFrom ,
        #InputDateTo {
            cursor: pointer;
        }
    </style>
@endsection

@section('content')

<section class="text-right position-relative mb-3 P-GalleryPc container-fluid p-0">
    <div class="buttn-option">
        <button class="each-btn-1"><i class="fas fa-share-alt"></i><span class="non-mob"> اشتراک گذاری</span></button>
        <ul class="share-01">
            <li><a class="social-link" href="#"><i class="far fa-paper-plane"></i></a></li>
            <li><a class="social-link" href="#"><i class="fab fa-whatsapp"></i></a></li>
            <li><a class="social-link" href="#"><i class="fab fa-instagram"></i></a></li>
            <li><a class="social-link" href="#"><i class="far fa-envelope"></i></a></li>
        </ul>
        <button class="each-btn-1" onclick="SetFavorite($(this),{{$hostModel->id}})">
            @if(auth()->check() && $hostModel->getFavorite != null)
                <i class="fas fa-heart"></i>
            @else
                <i class="far fa-heart"></i>
            @endif

                <span class="non-mob">افزودن به علاقه مندی ها</span>
        </button>
    </div>
    <div class="row">
        <div class="col-sm-6 p-0">
            <div id="lightgallery" class="list-unstyled owl-carousel R-sl owl-theme">
                @foreach($hostModel->getGallery as $key => $value)
                    <div class="item" data-responsive="{{asset('Uploaded/Gallery/Img/'. $value->img)}}" data-src="{{asset('Uploaded/Gallery/Img/'. $value->img)}}" data-sub-html="<p>Fading Light</p><p>Classic view from Rigwood Jetty on Coniston Water an old archive shot similar to an old post but a little later on.</p>">
                        <div class="slide over-hidden"><img class="mw-100 glryPc" src="{{asset('Uploaded/Gallery/Img/'. $value->img)}}" alt="image"></div>
                    </div>
                @endforeach
            </div>
        </div>
        <nav class="col-sm-6 p-0 nav-slider">
            <ul class="item-slider row">
            </ul>
        </nav>
    </div>
</section>
<div class="container p-0 pad-1">
    <div class="fiix-reserv-mobile row">
        <div class="col-xl-6">
            <div class="mob-price">
                <span class="night-price"> هر شب از :</span>
                <span class="number-price">500,000</span>
                <span class="unitq-price">تومان</span>
            </div>
            <div class="rating-homed-flex align-items-center">
                <span class="idea">( 22 نظر )</span>
                <span class="rate">4/8</span>
                <span class="star"><i class="fas fa-star"></i></span>
            </div>
        </div>
        <div class="col-xl-6">
            <div class="mob-price">
                <input type="button" id="BtnReserveHostMOB" class="btn btn-block btn-reservemobile" value="درخواست رزرو ">
            </div>
        </div>

    </div>
    <div class="row">
        <div class="col-sm-8 p-0">
            <section class="text-right position-relative P-MainTitle mb-3">
                <div class="row intro-bx d-flex align-items-center border-bottom pb-3">
                    <div class="col-sm-9 p-0">
                        <!--<ul class="breadcrumb-pg row align-items-center p-2">-->
                        <!--    <li class="font-weight-bold position-relative"><a class="px-1 itm-address" href="#">Home</a></li>-->
                        <!--    <li class="font-weight-bold position-relative"><a class="px-1 itm-address" href="#">Products</a></li>-->
                        <!--    <li class="font-weight-bold position-relative active">Accessories</li>-->
                        <!--</ul>-->
                        <h1 class="col-12 p-0 d-inline-block mb-2 text-dark maintitle">{{$hostModel->name}}</h1>
                        <div class="col-12 p-0 text-right">
                            <span class="px-1 font-weight-bold position-relative info1">{{$hostModel->getProvince->name}} ، {{$hostModel->getTownship->name}}</span>
                        </div> 
                        <div class="col-12 p-0 text-right">
                            <span class="px-1 font-weight-bold position-relative info2">کد اقامتگاه:</span>
                            <span class="px-1 font-weight-bold position-relative info1 text-theme">{{$hostModel->id + 5000}}</span>
                        </div>
                                               
                    </div>
                    <div class="col-sm-3 p-0 d-flex justify-content-flex-end">
                        <div class="text-center P-InfoHost">
                            <img class="mw-100 rounded-circle pic-host" src="{{asset('Uploaded/User/Profile/'.$hostModel->getUser->avatar)}}" alt="image"/>
                            <h5 class="px-2 name-host"><i class="ml-1 fas fa-check-circle"></i> {{$hostModel->getUser->first_name. ' ' .$hostModel->getUser->last_name}}</h5>
                        </div>
                    </div>
                </div>
            </section>
            <section class="text-right position-relative P-Possibilities1 my-3">
                <div class="row border-bottom py-3">
                    <ul class="col-sm-4 list-option">
                        <li class="p-2 p-lg-3 text-center d-flex align-items-center">
                            <svg class="icon-svg" class="icon-svg"  xmlns="http://www.w3.org/2000/svg class="icon-svg" class="icon-svg" " width="16" height="16" viewBox="0 0 32 32" icon="bedrooms-1" class="fxsh0 w16 h16 f-gray-extra-dark"><path d="M25.063 2.625a.694.694 0 0 0-.688-.688H7.5a.694.694 0 0 0-.688.688v22.938H.749v1.313h6.75c.188 0 .375-.063.5-.188s.188-.313.188-.438v-23H20.25l-6.188 2.063c-.313.125-.5.375-.5.688v23.625c0 .188.125.375.313.5.125.125.25.125.375.125h.25l10-3.375h6.625v-1.313h-6.063zm-10.125 15.5h2.688V16.75h-2.688V6.437l8.813-2.875V25.75l-8.813 2.938zM1.188.063v1.063h.313v.125h-.313l-.5.125H.625V.188h.063l.25-.125H.375v1.188H0v-.125h.313V.063C.313 0 .313 0 .376 0h.813v.063zm-.5.75v.5l.438-.125V.063L.688.251v.5h.188L.813.814z"></path></svg class="icon-svg" class="icon-svg" >
                            <p class="name-bx1"> {{$hostModel->getBuildingType->name}}</p>
                        </li>
                        <li class="p-2 p-lg-3 text-center d-flex align-items-center">
                            <svg class="icon-svg" class="icon-svg"  width="16" height="16" viewBox="0 0 16 16" icon="guests" class="fxsh0 w16 h16 f-gray-extra-dark"><path d="M5.688 2C4.125 2 2.844 3.266 2.844 4.81s1.281 2.81 2.844 2.81c1.562 0 2.843-1.266 2.843-2.81S7.25 2 5.688 2zm6.03.34a2.287 2.287 0 0 0-2.28 2.284 2.287 2.287 0 0 0 2.28 2.285 2.294 2.294 0 0 0 2.313-2.285A2.294 2.294 0 0 0 11.72 2.34zm-6.03.71c1 0 1.781.772 1.781 1.76a1.77 1.77 0 0 1-1.781 1.76c-1 0-1.782-.803-1.782-1.76 0-.988.782-1.76 1.782-1.76zm6.03.34c.72 0 1.25.555 1.25 1.234 0 .68-.53 1.235-1.25 1.235A1.22 1.22 0 0 1 10.5 4.624c0-.68.531-1.235 1.219-1.235zm0 3.859c-1.5 0-2.812.402-3.624 1.204a9.659 9.659 0 0 0-2.406-.308c-1.5 0-2.875.34-3.907.957C.75 9.689 0 10.584 0 11.665v2.81c0 .278.25.525.531.525h10.312a.544.544 0 0 0 .532-.525v-1.76h4.094A.544.544 0 0 0 16 12.19V9.905c0-.865-.594-1.544-1.375-1.976-.75-.433-1.781-.68-2.906-.68zm0 1.08c.97 0 1.813.186 2.407.525.563.31.813.68.813 1.05v1.76h-3.563c0-1.08-.75-1.976-1.781-2.563-.094-.061-.22-.123-.313-.185.563-.34 1.438-.587 2.438-.587zm-6.03.865c1.344 0 2.562.309 3.374.803.844.494 1.25 1.08 1.25 1.667v2.285h-9.25v-2.285c0-.587.407-1.173 1.25-1.667.844-.494 2.032-.803 3.376-.803z"></path></svg class="icon-svg" class="icon-svg" >
                            <p class="name-bx1">{{$hostModel->count_room}} اتاق </p>
                        </li>
                        <li class="p-2 p-lg-3 text-center d-flex align-items-center">
                            <svg class="icon-svg" class="icon-svg"  width="16" height="16" viewBox="0 0 16 16" icon="bath" class="fxsh0 w16 h16 f-gray-extra-dark"><path d="M10.54 0C8.137 0 6.18 1.774 6.112 3.96 3.299 4.184 1.069 6.306 1 8.967c0 .127 0 .444.48.444h10.191c.48 0 .48-.317.48-.444-.068-2.66-2.264-4.784-5.077-5.005C7.142 2.25 8.687.887 10.539.887c1.956 0 3.5 1.458 3.5 3.232v11.437c0 .254.24.444.48.444.275 0 .481-.19.481-.444V4.12C15 1.838 13.01 0 10.54 0zm.617 8.523H1.995c.31-2.091 2.23-3.675 4.564-3.675 2.368 0 4.29 1.584 4.598 3.675zM5.324 14.32c-.275 0-.48.19-.48.443v.792c0 .254.205.444.48.444.274 0 .48-.19.48-.444v-.792c0-.253-.206-.443-.48-.443zm2.505 0c-.275 0-.48.19-.48.443v.792c0 .254.205.444.48.444.24 0 .48-.19.48-.444v-.792c0-.253-.24-.443-.48-.443zm-3.74-2.25c-.275 0-.48.19-.48.444v.792c0 .222.205.444.48.444.274 0 .48-.222.48-.444v-.792c0-.254-.206-.444-.48-.444zm2.47 0c-.24 0-.48.19-.48.444v.792c0 .222.24.444.48.444.275 0 .48-.222.48-.444v-.792c0-.254-.205-.444-.48-.444zm2.505 0c-.274 0-.48.19-.48.444v.792c0 .222.206.444.48.444.275 0 .48-.222.48-.444v-.792c0-.254-.205-.444-.48-.444zm-6.21-2.28c-.275 0-.481.19-.481.443v.792c0 .254.206.444.48.444.24 0 .48-.19.48-.444v-.792c0-.254-.24-.444-.48-.444zm2.47 0c-.275 0-.48.19-.48.443v.792c0 .254.205.444.48.444.274 0 .48-.19.48-.444v-.792c0-.254-.206-.444-.48-.444zm2.505 0c-.275 0-.48.19-.48.443v.792c0 .254.205.444.48.444.24 0 .48-.19.48-.444v-.792c0-.254-.24-.444-.48-.444zm2.47 0c-.274 0-.48.19-.48.443v.792c0 .254.206.444.48.444.275 0 .48-.19.48-.444v-.792c0-.254-.205-.444-.48-.444z"></path></svg class="icon-svg" class="icon-svg" >
                            <p class="name-bx1">{{$hostModel->meter}} متر زیر بنا</p>
                        </li>
                        <li class="p-2 p-lg-3 text-center d-flex align-items-center">
                            <svg class="icon-svg" class="icon-svg"  width="16" height="16" viewBox="0 0 16 16" icon="tv" class="fxsh0 w16 h16 f-gray-extra-dark"><path d="M16 10.476c0 .73-.594 1.365-1.344 1.365h-4.531c0 .698.531 1.302.531 1.62a.531.531 0 0 1-.531.539h-4.25a.531.531 0 0 1-.531-.54c0-.317.531-.889.531-1.62H1.344C.594 11.84 0 11.207 0 10.477v-7.11C0 2.634.594 2 1.344 2h13.312c.75 0 1.343.635 1.343 1.365l.001 7.11zm-1.062-7.11c0-.128-.125-.287-.282-.287H1.344c-.156 0-.281.16-.281.286v7.047c0 .127.125.254.281.254h13.312c.157 0 .282-.127.282-.254V3.365z"></path></svg class="icon-svg" class="icon-svg" >
                            <p class="name-bx1"> ظرفیت {{$hostModel->standard_guest}} نفر </p>
                        </li>
                        <li class="p-2 p-lg-3 text-center d-flex align-items-center">
                            <svg class="icon-svg" class="icon-svg"  width="16" height="16" viewBox="0 0 16 16" icon="house" class="fxsh0 w16 h16 f-gray-extra-dark"><path d="M13.725 8.995v5.284c0 .412-.313.721-.626.721H9.252v-4.186H6.749V15H2.902c-.313 0-.626-.31-.626-.72V8.993l5.725-5.18 5.724 5.18zm2.158-1.167l-2.159-1.99v-4.46a.336.336 0 0 0-.344-.344h-1.877a.358.358 0 0 0-.344.343v2.128L8.75 1.309a1.067 1.067 0 0 0-1.501 0L.117 7.829c-.125.103-.156.342-.062.48l.625.79c.063.068.125.136.22.136a.547.547 0 0 0 .219-.068L8 2.887l6.881 6.28a.415.415 0 0 0 .188.068h.032c.094 0 .156-.068.219-.137l.625-.79c.094-.137.063-.377-.062-.48z"></path></svg class="icon-svg" class="icon-svg" >
                            <p class="name-bx1">{{$hostModel->double_bed}} تخت دو نفره</p>
                        </li>
                        <li class="p-2 p-lg-3 text-center d-flex align-items-center">
                            <svg class="icon-svg" class="icon-svg"  width="16" height="16" viewBox="0 0 16 16" icon="tv" class="fxsh0 w16 h16 f-gray-extra-dark"><path d="M16 10.476c0 .73-.594 1.365-1.344 1.365h-4.531c0 .698.531 1.302.531 1.62a.531.531 0 0 1-.531.539h-4.25a.531.531 0 0 1-.531-.54c0-.317.531-.889.531-1.62H1.344C.594 11.84 0 11.207 0 10.477v-7.11C0 2.634.594 2 1.344 2h13.312c.75 0 1.343.635 1.343 1.365l.001 7.11zm-1.062-7.11c0-.128-.125-.287-.282-.287H1.344c-.156 0-.281.16-.281.286v7.047c0 .127.125.254.281.254h13.312c.157 0 .282-.127.282-.254V3.365z"></path></svg class="icon-svg" class="icon-svg" >
                            <p class="name-bx1">حداقل اقامت {{$hostModel->min_reserve_day}} شب</p>
                        </li>
                    </ul>
                    <div class="col-sm-8">
                        <div class="box-map">
                            <link rel="stylesheet" href="https://unpkg.com/leaflet@1.7.1/dist/leaflet.css" integrity="sha512-xodZBNTC5n17Xt2atTPuE1HxjVMSvLVW9ocqUKLsCC5CXdbqCmblAshOMAS6/keqq/sMZMZ19scR4PsZChSR7A==" crossorigin=""/>
                            <script src="https://unpkg.com/leaflet@1.7.1/dist/leaflet.js" integrity="sha512-XQoYMqMTK8LvdxXYG3nZ448hOEQiglfqkJs1NOQV44cWnUrBc8PkAOcXy20w0vlaXaVUearIOBhiXZ5V3ynxwA==" crossorigin=""></script>
                            <div id="map-markers" style="height:300px; z-index: 0;"></div>
                            <script>
                                var tiles = L.tileLayer('https://{s}.tile.openstreetmap.org/{z}/{x}/{y}.png', {
                                        maxZoom: 18,
                                        attribution: '&copy; <a href="https://www.openstreetmap.org/copyright">OpenStreetMap</a> contributors, Points &copy 2012 LINZ'
                                    }),
                                    latlng = L.latLng({{$hostModel->latitude}}, {{$hostModel->longitude}}); // tehran
                                var map = L.map('map-markers', {center: latlng, zoom: 17, layers: [tiles]});
                                var title = 'عنوان مارکر';
                                var marker = L.marker(new L.LatLng({{$hostModel->latitude}}, {{$hostModel->longitude}}), {title: title});
                                marker.bindPopup(title);
                                map.addLayer(marker);
                                map.addLayer(markers);
                            </script>
                        </div>
                    </div>
                </div>
            </section>
            <section class="text-right position-relative P-Possibilities2 my-3">
                <div class="Possibilities2 border-bottom py-3">
                    <h3 class="title-prt">امکانات</h3>
                    <ul class="see-moreless row align-items-center">
                        @php $arr_opt = [] @endphp
                        @foreach($hostModel->getHostPossibilities as $key => $value)
                            @php $arr_opt[] = $value->option_id @endphp
                            <li class="col-sm-3 px-0 py-2 align-items-center Bx4 ">
                                <img class="option-img" src="{{asset('Uploaded/Possibilities/Option/'.$value->getOption->img)}}">
                                <p class="txt-09">{{$value->getOption->name}}</p>
                                @if($value->description != '')
                                    <span tooltip="{{$value->description}} " class="more-info">?</span>
                                @endif
                            </li>
                        @endforeach
                        @foreach(GetOption() as $key => $value)
                            @if(!in_array($value->id, $arr_opt))
                                <li class="col-sm-3 px-0 py-2 align-items-center Bx4 is-Not">
                                    <img class="option-img" src="{{asset('Uploaded/Possibilities/Option/'.$value->img)}}">
                                    <div class="titl-prt-01">
                                        <p class="txt-09">{{$value->name}}</p>
                                    </div>
                                </li>
                            @endif
                        @endforeach

                    </ul>
                    <!--<div class="decription-about">-->
                    <!--    <label>توضیحاتی در رابطه با امکانات :</label>-->
                    <!--    <p>-->
                    <!--      لورم ایپسوم متن ساختگی با تولید سادگی نامفهوم از صنعت چاپ، و با استفاده از طراحان گرافیک است، چاپگرها و متون بلکه روزنامه و مجله در ستون و سطرآنچنان که لازم است، و برای شرایط فعلی تکنولوژی مورد نیاز، و کاربردهای متنوع با هدف بهبود ابزارهای کاربردی می باشد، کتابهای زیادی در شصت و سه درصد گذشته حال و آینده، شناخت فراوان جامعه و متخصصان را می طلبد، تا با نرم افزارها شناخت بیشتری را برای طراحان رایانه ای علی الخصوص طراحان خلاقی، و فرهنگ پیشرو در زبان فارسی ایجاد کرد، .-->
                    <!--    </p>-->
                    <!--</div>-->
                </div>
            </section>
            <section class="text-right position-relative P-Summary my-3">
                <div class="border-bottom py-3">
                    <div class="raterow">
                        <h3 class="title-prt">درباره اقامتگاه </h3>
                        <p class="text-01">
                            {{$hostModel->description}}
                        </p>
                    </div>
                    <hr class="limit-hr">
                    <div class="P-pazirayi">
                            <ul class="see-moreless1 row align-items-center">
                                <li class="col-sm-4 px-0 py-2 align-items-center Bx4">
                                    <span class="text-pz"> طبقه واحد: </span>
                                    <span class="data-pz"> {{$hostModel->floor}}</span>
                                </li>
                                <li class="col-sm-4 px-0 py-2 align-items-center Bx4">
                                    <span class="text-pz"> سال ساخت: </span>
                                    <span class="data-pz">{{$hostModel->year}}</span>
                                </li>
                                <li class="col-sm-4 px-0 py-2 align-items-center Bx4">
                                    <span class="text-pz">نوع اجاره: </span>
                                    <span class="data-pz">
                                        @if($hostModel->type_rent == 1)
                                            مجزا
                                        @elseif($hostModel->type_rent == 2)
                                            دربستی
                                        @elseif($hostModel->type_rent == 3)
                                            اتاق خصوصی
                                        @endif
                                    </span>
                                </li>
                                <li class="col-sm-4 px-0 py-2 align-items-center Bx4">
                                    <span class="text-pz"> شکل اقامتگاه : </span>
                                    <span class="data-pz">
                                        @if($hostModel->shape_host == 1)
                                            مسطح
                                        @elseif($hostModel->shape_host == 2)
                                            دوبلکس
                                        @elseif($hostModel->shape_host == 3)
                                            تریبلکس
                                        @endif
                                    </span>
                                </li>
                                <li class="col-sm-4 px-0 py-2 align-items-center Bx4">
                                    <span class="text-pz">تعداد کل طبقات : </span>
                                    <span class="data-pz"> {{$hostModel->building_floor}} </span>
                                </li>
                                <li class="col-sm-4 px-0 py-2 align-items-center Bx4">
                                    <span class="text-pz">تعداد اتاق: </span>
                                    <span class="data-pz"> {{$hostModel->count_room}} </span>
                                </li>
                            </ul>
                        </div>
                </div>
            </section>
            <section class="text-right position-relative P-Rules-regulation">
                <div class="Rules-regulation border-bottom py-3">
                    <h3 class="title-prt">قوانین اقامتگاه </h3>
                    <div class="Arrivals-Departures py-3">
                        <li class="bx-entrexit d-flex align-items-center exist-1">
                            <svg data-id="SVG_GUEST_CHECKED_IN_COLOR__24" focusable="false" xmlns="http://www.w3.org/2000/svg" width="24" height="24" stroke="none" fill="none" viewBox="0 0 24 24"><path stroke="#2474DE" d="M3.492 11.998h11.316M12.058 8.996l3.002 3.002L12.058 15"></path><path stroke="#292929" d="M8.745 7.424V5.782c0-.71.576-1.287 1.286-1.287h7.19c.71 0 1.286.576 1.286 1.287v12.436c0 .71-.576 1.287-1.286 1.287h-7.19c-.71 0-1.286-.576-1.286-1.287v-1.642"></path></svg>
                            <p>ساعت ورود</p>
                            <p class="clock"> از {{$hostModel->time_enter_from}} تا {{$hostModel->time_enter_to}}</p>
                        </li>
                        <li class="bx-entrexit d-flex align-items-center">
                            <svg data-id="SVG_GUEST_CHECKED_IN_COLOR__24" focusable="false" xmlns="http://www.w3.org/2000/svg" width="24" height="24" stroke="none" fill="none" viewBox="0 0 24 24"><path stroke="#2474DE" d="M3.492 11.998h11.316M12.058 8.996l3.002 3.002L12.058 15"></path><path stroke="#292929" d="M8.745 7.424V5.782c0-.71.576-1.287 1.286-1.287h7.19c.71 0 1.286.576 1.286 1.287v12.436c0 .71-.576 1.287-1.286 1.287h-7.19c-.71 0-1.286-.576-1.286-1.287v-1.642"></path></svg>
                            <p>ساعت خروج</p>
                            <p class="clock"> تا {{$hostModel->time_exit}}</p>
                        </li>                    
                    </div>
                    <ul class="Rules-items">
                        @php
                            $att_rule = [];
                            $arr_rule = [];
                        @endphp
                        @foreach($hostModel->getHostRules as $key => $value)
                            @php $arr_rule[] = $value->rule_id @endphp
                            <li><i class="fas fa-check"></i>{{$value->getRules->name}}</li>
                        @endforeach
                        @foreach(GetRule() as $key => $value)
                            @if(!in_array($value->id, $arr_rule))
                                <li><i class="fas fa-times"></i>{{$value->name}}</li>
                            @endif
                        @endforeach
                        <hr />
                        <li><i class="fas fa-check"></i>هزینه گشت های اختیاری در منطقه بر عهده مسافر می باشد.</li>
                    </ul>
                    <hr class="limit-hr">
                    <div class="decription-about">
                        <h3 class="title-prt">اطلاعات جغرافیایی</h3>
                        <p>
                            {{$hostModel->other_position}}
                        </p>
                    </div>
                </div>
            </section>
            <section class="text-right position-relative P-off-regulation">
                <div class="off-regulation border-bottom py-3">
                    <h3 class="title-prt">تخفیف میزبان</h3>
                    <ul class="off-items">
                        @if(count($hostModel->getDiscount) > 0)
                            @foreach($hostModel->getDiscount as $key => $value)
                                <li>{{$value->percent}} % تخفیف برای اقامت بیشتر از {{$value->number_days}} روز</li>
                            @endforeach
                        @endif
                    </ul>
                </div>
            </section>
            <section class="text-right position-relative P-calc-regulation">
                <div class="calc-regulation border-bottom py-3">
                    <h3 class="title-prt"> تقویم  </h3>
                </div>
            </section>
            <section class="text-right position-relative P-csncel-regulation">
                <div class="csncel-regulation border-bottom py-3">
                    <h3 class="title-prt">قوانین لغو رزرو    </h3>
                    <ul class="csncel-items">
                        <li class="py-1"><i class="text-theme fas fa-square"></i>تا ۷۲ ساعت مانده به شروع رزرو کسر ۱۰% و برگشت باقی وجه</li>
                        <li class="py-1"><i class="text-theme fas fa-square"></i>کمتر از ۷۲ ساعت تا یک روز مانده به شروع رزرو کسر هزینه شب اول و برگشت باقی وجه</li>
                        <li class="py-1"><i class="text-theme fas fa-square"></i>در روز شروع رزرو کسر هزینه دو شب اول و برگشت باقی وجه</li>
                        <li class="py-1"><i class="text-theme fas fa-square"></i>در ایام پیک همانند تعطیلات نوروز و تعطیلات رسمی، تنها با رضایت میزبان امکان کنسلی وجود دارد</li>
                        <li class="py-1"><i class="text-theme fas fa-square"></i>در محدودیت های مرتبط با کرونا، تنها در صورت صدور بخشنامه از سوی مراجع دولتی امکان لغو رزرو بدون کسر وجه و خارج از چهارچوب قوانین سایت وجود دارد</li>
                    </ul>
                </div>
            </section>
            <section class="text-right position-relative P-Location my-3">
                <div class="Possibilities3 border-bottom py-3">
                    <h3 class="title-prt">موقعیت مکانی</h3>
                    <div class="box-map-mob">
                        <iframe class="w-100 map-loc" src="https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d1737.6221882978507!2d-98.48650795000005!3d29.421653200000023!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x865c58aa57e6a56f%3A0xf08a9ad66f03e879!2sHenry+B.+Gonzalez+Convention+Center!5e0!3m2!1sen!2sus!4v1393884854786" height="450" frameborder="0" style="border:0"></iframe>
                    </div>
                    <ul class="op-lc-1 d-flex">
                        <li class="baft-loc"><label>نوع بافت :</label><span class="no-baft">ییلاقی</span></li>
                        <li class="baft-loc"><label>چشم انداز  :</label><span class="no-baft">ییلاقی</span></li>
                    </ul>
                    <hr class="limit-hr">
                    <p class="loc-option">این اقامتگاه در استان خراسان جنوبی قرار دارد.</p>
                    <p class="loc-about">دمای هوای فردوس با توجه به نزدیکی آن به کویر و کمبود رطوبت، بین شب و روز و تابستان و زمستان، اختلاف زیادی دارد. هوا در تابستان گرم و خشک و در زمستان سرد و بارانی است. فاصله باغستان علیا تا مرکز شهر فردوس ۱۵ کیلومتر می باشد.</p>
                </div>
            </section>
            <section class="text-right position-relative P-host-regulation">
                <button class="btn btn-default" data-toggle="modal" data-target="#myModal">پیام به میزبان</button>
                <div class="host-regulation row border-bottom py-3">
                    <div class="col-sm-10">
                        <h3 class="title-prt"> میزبان حسین قطنی </h3>
                        <div class="register-date">
                            <span class="txt-regostre">تاریخ عضویت :</span>
                            <span class="dte-regostre">12/12/1300</span>
                        </div>
                        <ul class="host-items d-flex">
                            <li><span class="title-op">زمان پاسخگویی : </span><label class="info-op">بیش از ۲ ساعت</label></li>
                            <li><span class="title-op">میزان پاسخگویی : </span><label class="info-op">80 درصد</label></li>
                        </ul>                        
                    </div>
                    <div class="col-sm-2"><img class="mw-100 rounded-circle pic-host" src="https://www.otaghak.com/api/v1/Media/images/2093077/3/ProfileImage" alt="image"></div>
                </div>
            </section>
            <div class="modal" id="myModal">
                <div class="modal-dialog">
                    <div class="modal-content">

                        <!-- Modal Header -->
                        <div class="modal-header">
                            <h4 class="modal-title">ارسال پیام</h4>
                            <button type="button" class="close" data-dismiss="modal">&times;</button>
                        </div>

                        <!-- Modal body -->
                        <div class="modal-body">
                            <form action="{{route('StoreMessageForHostUser')}}" method="post">
                                {{csrf_field()}}
                                <div class="row">
                                    <div class="col-md-12">
                                        <div class="form-group">
                                            <label for="TextAreaMessage">متن پیام</label>
                                            <textarea id="TextAreaMessage" placeholder="متن پیام به میزبان را وارد کنید" class="form-control" name="message"></textarea>
                                        </div>
                                        <div class="form-group">
                                            <button type="submit" class="btn btn-success">
                                                ثبت و ارسال
                                            </button>
                                        </div>
                                    </div>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>
            </div>

            <section class="text-right position-relative P-Rateing1">
                <div class="Rateing1-regulation border-bottom py-3">
                    <div class="row each-rating">
                        <div class="col-sm-6 bc-1">
                            <div class="title-rate">دسترسی</div>
                            <div class="degre-rate">                        
                                <i class="far fa-star"></i>
                                <i class="fas fa-star-half-alt"></i>
                                <i class="fas fa-star"></i>
                                <i class="fas fa-star"></i>
                                <i class="fas fa-star"></i>
                            </div>
                        </div>
                        <div class="col-sm-6 bc-1">
                            <div class="title-rate">شباهت با اطلاعات سایت</div>
                            <div class="degre-rate">                        
                                <i class="far fa-star"></i>
                                <i class="fas fa-star-half-alt"></i>
                                <i class="fas fa-star"></i>
                                <i class="fas fa-star"></i>
                                <i class="fas fa-star"></i>
                            </div>
                        </div>
                        <div class="col-sm-6 bc-1">
                            <div class="title-rate">نظافت</div>
                            <div class="degre-rate">                        
                                <i class="far fa-star"></i>
                                <i class="fas fa-star-half-alt"></i>
                                <i class="fas fa-star"></i>
                                <i class="fas fa-star"></i>
                                <i class="fas fa-star"></i>
                            </div>
                        </div>
                        <div class="col-sm-6 bc-1">
                            <div class="title-rate">کیفیت منطقه</div>
                            <div class="degre-rate">                        
                                <i class="far fa-star"></i>
                                <i class="fas fa-star-half-alt"></i>
                                <i class="fas fa-star"></i>
                                <i class="fas fa-star"></i>
                                <i class="fas fa-star"></i>
                            </div>
                        </div>
                        <div class="col-sm-6 bc-1">
                            <div class="title-rate">ارزش نسبت به قیمت   </div>
                            <div class="degre-rate">                        
                                <i class="far fa-star"></i>
                                <i class="fas fa-star-half-alt"></i>
                                <i class="fas fa-star"></i>
                                <i class="fas fa-star"></i>
                                <i class="fas fa-star"></i>
                            </div>
                        </div>
                        <div class="col-sm-6 bc-1">
                            <div class="title-rate">برخورد میزبان</div>
                            <div class="degre-rate">                        
                                <i class="far fa-star"></i>
                                <i class="fas fa-star-half-alt"></i>
                                <i class="fas fa-star"></i>
                                <i class="fas fa-star"></i>
                                <i class="fas fa-star"></i>
                            </div>
                        </div>
                    </div>
                </div>
            </section>
            <section class="text-right position-relative P-StepS">
                <div class="border-bottom py-3">
                    <h3 class="title-prt">نظرات کاربران </h3>
                    <div class="col-12">
                        <div class="d-flex my-4 align-items-start">
                            <div class="mr-3 text-center mt-2">
                                <div class="p-1 rounded-circle parent-pic"><img class="mw-100 w-100 h-100 rounded-circle pc-user" src="https://www.otaghak.com/api/v1/Media/images/2093077/3/ProfileImage" alt=""></div>
                                <span class="text-nameUser ">نمونه نام نویسنده پیام</span>
                            </div>
                            <div class="rounded bg-light p-4">
                                <div class="date-trip d-inline-block px-2 mb-2"><span class="whichDay"><span dir="ltr">12/34/1236</span></span></div>
                                <p class="text-secondary font-weight-light">
                                    متن نمونه تستی میباشد نمونه تستی میباشد نمونه تستی میباشد نمونه تستی میباشد نمونه تستی میباشد نمونه تستی میباشد نمونه تستی میباشد نمونه تستی میباشد
                                </p>
                            </div>
                        </div>
                        <div class="d-flex my-4 align-items-start">
                            <div class="mr-3 text-center mt-2">
                                <div class="p-1 rounded-circle parent-pic"><img class="mw-100 w-100 h-100 rounded-circle pc-user" src="https://www.otaghak.com/api/v1/Media/images/2093077/3/ProfileImage" alt=""></div>
                                <span class="text-nameUser ">نمونه نام نویسنده پیام</span>
                            </div>
                            <div class="rounded bg-light p-4">
                                <div class="date-trip d-inline-block px-2 mb-2"><span class="whichDay"><span dir="ltr">12/34/1236</span></span></div>
                                <p class="text-secondary font-weight-light">
                                    متن نمونه تستی میباشد نمونه تستی میباشد نمونه تستی میباشد نمونه تستی میباشد نمونه تستی میباشد نمونه تستی میباشد نمونه تستی میباشد نمونه تستی میباشد
                                </p>
                            </div>
                        </div>
                    </div>                    
                </div>

            </section>
        </div>
        <div class="col-sm-4 pr-0 parent-fix">
            <div class="fx-side">
                <div class="row">
                    <div class="col-sm-12">
                        <div class=" d-flex align-items-center">
                            <span class="night-price"> هر شب از :</span>
                            <span class="number-price">{{number_format(GetMinPrice($hostModel->id))}}</span>
                            <span class="unitq-price">تومان</span>                            
                        </div>
                        <div class="rating-home border-bottom d-flex align-items-center">
                            <span class="idea">( 22 نظر )</span>
                            <span class="rate">4/8</span>
                            <span class="star"><i class="fas fa-star"></i></span>
                        </div>
                    </div>
                    <div class="col-sm-6 p-0">
                        <span>تاریخ سفر</span>
                    </div>
                    <div class="col-sm-6 p-0 text-left">
                        <a class="link-clear-date">پاک کردن تاریخ <i class="fa fa-trash"></i></a>
                    </div>
                    <div class="calendar-box display-none">
                        {!! $calendar !!}
                    </div>
                    <div class="detail-date-box">
                        <div class="col-sm-12 py-2 date-cal">
                            <h6 class="titl-02">تاریخ اقامتگاه</h6>
                            <div class="bx-dTER d-flex">
                                <input class="each-01 rounded" autocomplete="off" id="InputDateFrom" placeholder="تاریخ ورود" />
                                <input class="each-01 rounded" autocomplete="off" id="InputDateTo" placeholder="تاریخ خروج"/>
                            </div>
                        </div>
                        <div class="col-sm-12 numbr-gu">
                            <h6 class="titl-02">تعداد نفرات</h6>
                            <div class="bx-dTER number">
                                <span class="minus"><i class="fas fa-minus"></i></span>
                                <input type="text" value="1" id="InputCountGuest" placeholder="تعداد نفرات">
                                <span class="text-number"> نفر</span>
                                <span class="plus"><i class="fas fa-plus"></i></span>
                            </div>
                        </div>
                        <div class="col-sm-12 p-0">
                            <div id="PreFactor"></div>
                        </div>
                        <div class="col-md-12">
                            <input type="button" id="BtnReserveHost" class="btn btn-block btn-reserve" value="درخواست رزرو">
                        </div>
                        <div class="col-sm-12 extra-person">
                            <p>در صورت بیشتر بودن  از <span class="min-numb"> {{$hostModel->standard_guest}} </span> نفر , به ازای هر نفر <span class="price-extra"> {{number_format($hostModel->one_person_price)}} </span>تومان اضافه میگردد .</p>
                        </div>
                    </div>
                    <!--<div class="col-md-12 px-0">-->
                    <!--    <p class="children">کودکان بیش از 6 سال «یک نفر» محسوب می شوند.</p>-->
                    <!--</div>-->
                    <!--<div class="col-sm-12 suppoort-S">-->
                    <!--    <span class="txt-support">پشتیبانی</span>-->
                    <!--    <span class="num-support dir-ltr">021-33 640 134</span>-->
                    <!--</div>-->
                </div>
            </div>
        </div>
    </div>
</div>
@endsection

@section('script')
<script src="{{asset('frontend/js/jquery.min.js')}}"></script>
<script src="{{asset('frontend/js/owl.carousel.js')}}"></script>
<script src="https://rawgit.com/angular/bower-angular/master/angular.min.js"></script>
<script src="{{asset('frontend/js/gallery.js')}}"></script>
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
            return '<li class="col-sm-6 col-3 over-hidden p-0"><img class="mw-100 smalPc" src=" ' + imageUrl + ' " alt=""></li>';
        }
        
        $('.owl-carousel.R-sl').owlCarousel({
            autoplay:true,
            autoplayTimeout:7000,
            rtl:true,
            dots:false,
            loop: true,	
            smartSpeed:1000,
		    lazyLoad: true,
            margin: 0,
            items: 1,
    		responsiveClass: true,
    		responsive: {
    			0: {
    			    dots:true,
    				items: 1
    			},
    			500: {
    			    dots:true,
    				items: 1
    			},
    			600: {
    				items: 1
    			},
    			1000: {
    				items: 1
    			},
    			1250: {
    				items: 1
    			}
    		}
    	})
    });
</script>
<!--//============ modal-gallery-slider-->
<script src="{{asset('frontend/js/gallery.js')}}"></script>
<script>
    $(document).ready(function(){
        $('#lightgallery').lightGallery();
    });
</script>
<!--//============ see-more-product   mobile -->
<script>
if (matchMedia('only screen and (min-width: 767px)').matches) {
    $(document).ready(function(){
        $('.see-moreless').on('click','.moore', function(){
        	if( $(this).hasClass('leess') ){
        		$(this).text('مشاهده بیشتر').removeClass('leess');
        	}else{
        		$(this).text('مشاهده کمتر').addClass('leess');
        	}
        	$(this).siblings('.toggleable').slideToggle( "linear" );
        });
        $('.see-moreless').each(function(){
        	var LiN = $(this).find('.Bx4').length;
        	if( LiN > 4){
        		$('.Bx4', this).eq(8).nextAll().hide().addClass('toggleable');
        		$(this).append('<li class="moore col-sm-12 text-center"><span class="more-op m-auto text-center">مشاهده بیشتر</span> </li>');
        	}
        });
        
    });
}
</script>
<!--//============ btn-read-more-->
<script>
    function moreLess(initiallyVisibleCharacters) {
	var visibleCharacters = initiallyVisibleCharacters;
	var paragraph = $(".text-01")

	paragraph.each(function() {
		var text = $(this).text();
		var wholeText = text.slice(0, visibleCharacters) + "<span class='ellipsis'>... </span><a href='#' class='more-01'>بیشتر بخوانید<i class='fa fa-arrow-circle-o-down' aria-hidden='true'></i></a>" + "<span style='display:none'>" + text.slice(visibleCharacters, text.length) + "<a href='#' class='less-01'> بستن<i class='fa fa-arrow-circle-o-up' aria-hidden='true'></i></a></span>"
		
		if (text.length < visibleCharacters) {
			return
		} else {
			$(this).html(wholeText)
		}
	});
	$(".more-01").click(function(e) {
		e.preventDefault();
		$(this).hide().prev().hide();
		$(this).next().show();
	});
	$(".less-01").click(function(e) {
		e.preventDefault();
		$(this).parent().hide().prev().show().prev().show();
	});
};

moreLess(280);
</script>
<!--//============ see-more-product   desctop -->
    <script>
        if (matchMedia('only screen and (max-width: 767px)').matches) {
            $(document).ready(function(){
                $('.see-moreless').on('click','.moore', function(){
                    if( $(this).hasClass('leess') ){
                        $(this).text('مشاهده بیشتر').removeClass('leess');
                    }else{
                        $(this).text('مشاهده کمتر').addClass('leess');
                    }
                    $(this).siblings('.toggleable').slideToggle( "linear" );
                });
                $('.see-moreless').each(function(){
                    var LiN = $(this).find('.Bx4').length;
                    if( LiN > 4){
                        $('.Bx4', this).eq(4).nextAll().hide().addClass('toggleable');
                        $(this).append('<li class="moore col-sm-12 text-center"><span class="more-op m-auto text-center">مشاهده بیشتر</span> </li>');
                    }
                });
            });
            $(document).ready(function(){
                $('.see-moreless1').on('click','.moore', function(){
                    if( $(this).hasClass('leess') ){
                        $(this).text('مشاهده بیشتر').removeClass('leess');
                    }else{
                        $(this).text('مشاهده کمتر').addClass('leess');
                    }
                    $(this).siblings('.toggleable').slideToggle( "linear" );
                });
                $('.see-moreless1').each(function(){
                    var LiN = $(this).find('.Bx4').length;
                    if( LiN > 2){
                        $('.Bx4', this).eq(1).nextAll().hide().addClass('toggleable');
                        $(this).append('<li class="moore col-sm-12 text-center"><span class="more-op m-auto text-center">مشاهده بیشتر</span> </li>');
                    }
                });
                $('#BtnReserveHostMOB').click( function(){
                    $('.parent-fix').toggleClass('right-open12');
                });
            });
        }

        $('#BtnReserveHost, .btn-reserve').click(function () {
            CalculateFactor('reserve');
        });
        function CalculateFactor(type) { // type => محاسبه یا ثبت رزرو

            if (type == 'calculate') {

                $('#PreFactor').html('<img style="width: 55px; margin: 0 auto;" src="{{asset('backend/img/img_loading/loading-register.gif')}}" />');

            } else if (type == 'reserve') {

                $('.form-reserve').css('opacity', '0.6');
                $('.display-block').css('display', 'block');
                $('#SpanLoading').html('<img style="width: 80px; margin: 0 auto;" src="{{asset('backend/img/img_loading/loading-register.gif')}}" />');

            }

            $.ajaxSetup({
                headers: {
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                }
            });
            $.ajax({
                url: '{{route('CalculateReserveHostByDateAjax')}}',
                type: 'post',
                data: {
                    type: type,
                    from_date: $('#InputDateFrom').val(),
                    to_date: $('#InputDateTo').val(),
                    count_guest: $('#InputCountGuest').val(),
                    host_id: {{$hostModel->id}},
                },
                success: function (data) {
                    if (type == 'reserve') {
                        $('.display-block').css('display', 'none');
                        $('#SpanLoading').html('');
                        $('.form-reserve').css('opacity', '1');
                        if (data.Success == -1) { // login
                            $('#myModalRegister').modal('show');
                            AlertToast('خطا در ارسال اطلاعات', data.Message, 'warning');
                        } else if (data.Success == 0) {
                            AlertToast('خطا در ارسال اطلاعات', data.Message, 'warning');
                        } else {
                            AlertToast('رزرو اقامتگاه', 'رزرو اقامتگاه با موفقیت انجام شد ، برای مشاهده وضعیت رزرو به پنل کاربری مراجعه کنید .', 'success');
                            $('#InputDateTo').val('');
                            $('#InputDateFrom').val('');
                            $('#MsgCalculatePrice').html('');
                            $('#PreFactor').html('');
                        }
                    } else if (type == 'calculate') {
                        if (data.Success == 0) {
                            $('#PreFactor').html(data.Message);
                            AlertToast('ثبت رزرو', data.Message, 'warning');
                        }
                        $('#PreFactor').html('');
                        $('#PreFactor').html(data.Message.original);
                    }
                }
            });
        }

        $('.minus').click(function () {
            var $input = $(this).parent().find('input');
            if($(this).hasClass('gg')) {
                if($input.val() <= $('#InputStandardCapacity').val()) {
                    return false;
                }
            }
            if($(this).hasClass('oo')) {
                // alert((parseInt($input.val()) - 1));
                if((parseInt($input.val()) - 1) == 0) {
                    return false;
                }
            }
            var count = parseInt($input.val()) - 1;
            count = count < 1 ? 0 : count;
            $input.val(count);
            $input.change();
            if($(this).hasClass('oo')) {
                // $('#InputMaximumCapacity').val($input.val());
            }
            CalculateFactor('calculate');
            return false;
        });
        $('.plus').click(function () {
            var $input = $(this).parent().find('input');
            $input.val(parseInt($input.val()) + 1);
            $input.change();
            if($(this).hasClass('oo')) {
                if($('#InputMaximumCapacity').val() > $('#InputStandardCapacity').val()) {
                    return false;
                } else {
                    $('#InputMaximumCapacity').val($input.val());
                }
            }
            CalculateFactor('calculate');
            return false;
        });







        // calendar

        $('#InputDateFrom').click(function () {
            $('.calendar-box').removeClass('display-none');
            $('.detail-date-box').addClass('display-none');
            $('#InputDateFrom').val('');
            $('#InputDateTo').val('');
        });


        $('.link-clear-date').click(function () {
            $('.calendar-box').addClass('display-none');
            $('.detail-date-box').removeClass('display-none');
            $('#InputDateFrom').val('');
            $('#InputDateTo').val('');
            var day_item = $('.temporary-block');
            $.each(day_item, function(index, element) {
                $(element).removeClass('temporary-block');
                $(element).removeClass('last-day-item');
            });
        });


    </script>
@endsection