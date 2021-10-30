<div class="item">
    <a href="{{route('DetailHost', ['id' => $value->id])}}">
    <div class="item1">
            <img src="{{asset('Uploaded/Gallery/Img/'. $value->getGalleryFirst->img)}}" alt="logo">
        <div class="icon-item">
{{--            <span class="discount sale1"> 20% </span>--}}
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
        <h4>
            <a href="">
                {{$value->title}}
            </a>
        </h4>
        <div class="d-flex justify-content-between align-items-center mb-10">
            <div class="location">
                <i class="fas fa-map-marker-alt"></i>
                <span>
                    {{$value->getProvince->name}} ، {{$value->getTownship->name}}
                </span>
            </div>
            <div>
                <i class="fas fa-star"></i>
                <span> 4/9 </span>
                <span> ( 3 نظر) </span>
            </div>
        </div>
        
        
        <div class="description1">
            <ul class="items-des">
                <li>
                    <i class="fas fa-bed"></i>
                    <span>
                        {{$value->count_room}} خوابه
                    </span>
                </li>
                <li>
                    <i class="fa fa-user"></i>
                    <span> تا {{$value->count_guest}} نفر</span>
                </li>
            </ul>
{{--            <p class="boldtextblue">--}}
{{--                ضدعفونی شده--}}
{{--            </p>--}}


            <div class="d-flex align-items-center justify-content-between pt-2 mt-2 border-top">
               
                <div class="price-item">
                    هر شب از
                    <span>{{number_format(GetMinPrice($value->id))}}</span>
                    تومان
                </div>
               
                <div>
                    <li class="buy">
                        <a target="_blank" href="{{route('DetailHost', ['id' => $value->id])}}">
                            درخواست رزرو
                        </a>
                    </li>
                </div>
            </div>


        </div>
    </div>
    </a>
</div>