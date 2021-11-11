<div class="slider">
    <div class="container-fluid">
        <div class="col-xs-12 col-md-12 col-sm-12 no-padding">
            <div class="phone-slide hidden-lg hidden-md hidden-sm">
                <a href="">
                    <span><img src="{{asset('frontend/images/icon-t1.png')}}" alt="logo"></span>
                    <span> 0910 698 66 86 </span>

                </a>
            </div>
            <div id="myCarousel" class="carousel slide carousel-fade" data-ride="carousel">
                <!-- Indicators -->

                <!-- Wrapper for slides -->
                <div class="carousel-inner">
                    <div class="item active" data-slide-to="0"><img src="{{asset('frontend/images/SLIDER22.jpg')}}" alt="Los Angeles"
                                                                    style="width:100%;"></div>

                </div>

                <!-- Left and right controls
                <a class="left carousel-control" href="#myCarousel" data-slide="prev">
                    <span class="fa fa-chevron-left"></span>
                    <span class="sr-only">Previous</span>
                  </a>
                  <a class="right carousel-control" href="#myCarousel" data-slide="next">
                      <span class="fa fa-chevron-right"></span>
                      <span class="sr-only">Next</span>
                  </a>
                  -->
            </div>
        </div>

        <div class="box-search">
            <div class="row">
                <div class="col-xs-12">
                    <h1 class="title-site"> اجاره و رزرو آنلاین ویلا، سوییت واقامتگاه در سراسر ایران </h1>
                </div>
            </div>
            <div class="row">
                <div class="col-xs-12">
                    <div id="search">
                        <form class="search" action="{{route('SearchHost')}}">
                            <div class="input-search d-flex align-items-center">
                                <i class="fas fa-map-marker-alt"></i>
                                <span class="search2">
{{--					 <input class="" type="text" placeholder=" شهر مقصد یا کد اقامتگاه" name="city">--}}
                                    <select class="js-example-basic-single" name="state">
                                        <option></option>
                                      <optgroup label="مقاصد پر تردد">
                                        <option value="AK">Alaska</option>
                                        <option value="HI">Hawaii</option>
                                      </optgroup>
                                      <optgroup label="سایر شهرها">
                                        <option value="AK">Alaska</option>
                                        <option value="HI">Hawaii</option>
                                      </optgroup>
                                    </select>
				     </span>
                            </div>

                            <div class="date">
                                <div class="datepersian">
                                    <i class="fal fa-calendar-alt"></i>
                                    <span class="input-calender">
                                    <input class="range-from" placeholder=" تاریخ ورود" name="date_from"/>
						 <!-- <input class="Q-bx date-enter input-date1" type="" id="InputFromDate" placeholder=" تاریخ ورود" name=""> -->
					 </span>
                                </div>
                                <div class="datepersian">
                                    <i class="fal fa-calendar-alt"></i>
                                    <span class="input-calender">
                                
                                    <input class="range-to" placeholder=" تاریخ خروج" name="date_to"/>
						   <!-- <input class="Q-bx date-exit input-date2" type="" id="InputToDate" placeholder=" تاریخ خروج" name=""> -->
					 </span>
                                </div>
                                <div class="number">
                                    <i class="fa fa-users"></i>
                                    <span class="minus"><i class="fas fa-minus"></i></span>
                                    <input type="text" value="1" placeholder="تعداد نفرات" name="number">
                                    <span class="text-number"> نفر</span>
                                    <span class="plus"><i class="fas fa-plus"></i></span>
                                </div>


                                <script>
                                    $(document).ready(function () {
                                        $('.minus').click(function () {
                                            var $input = $(this).parent().find('input');
                                            var count = parseInt($input.val()) - 1;
                                            count = count < 1 ? 1 : count;
                                            $input.val(count);
                                            $input.change();
                                            return false;
                                        });
                                        $('.plus').click(function () {
                                            var $input = $(this).parent().find('input');
                                            $input.val(parseInt($input.val()) + 1);
                                            $input.change();
                                            return false;
                                        });
                                    });
                                </script>

                            </div>
                            <button class="btn-search">جستجو</button>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
