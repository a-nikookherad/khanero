<div class="slider">
    <div class="container-fluid">
        <div class="col-xs-12 col-md-12 col-sm-12 no-padding">

            <div id="myCarousel" class="carousel slide carousel-fade" data-ride="carousel">
                <!-- Indicators -->


                <!-- Wrapper for slides -->
                <div class="carousel-inner">
                    <div class="item active" data-slide-to="0">
                        <img src="<?php echo e(asset('frontend/images/SLIDER22.jpg')); ?>" alt="Los Angeles" style="width:100%;">
                    </div>
                    <div class="item" data-slide-to="1">
                        <img src="<?php echo e(asset('frontend/images/SLIDER22.jpg')); ?>" alt="Chicago" style="width:100%;">


                    </div>
                    <div class="item" data-slide-to="2">
                        <img src="<?php echo e(asset('frontend/images/SLIDER22.jpg')); ?>" alt="Chicago" style="width:100%;">
                    </div>

                </div>

                <!-- Left and right controls -->
                <a class="left carousel-control" href="#myCarousel" data-slide="prev">
                    <span class="fa fa-chevron-left"></span>
                    <span class="sr-only">Previous</span>
                </a>
                <a class="right carousel-control" href="#myCarousel" data-slide="next">
                    <span class="fa fa-chevron-right"></span>
                    <span class="sr-only">Next</span>
                </a>
            </div>


        </div>

        <div class="box-search">
            <div class="row">
                <div class="col-xs-12">
                    <div id="logo"><img src="<?php echo e(asset('frontend/images/logo.png')); ?>" alt="logo"></div>
                </div>
                <div class="col-xs-12">
                    <p>
                        اجــاره آنــلاین ویــلا و سوئیـت در شمــال و سـراسـر ایــران
                    </p>
                </div>
                <div class="col-xs-12">
                    <div id="search">
                        <form class="search" action="/action_page.php">
                            <input class="input-search" type="text" placeholder=" مقصد" name="search2">
                            <div class="date">

                                <input class="input-date1 datepersian" type="" placeholder=" تاریخ ورود" name="">

                                <input class="input-date2 datepersian" type="" placeholder=" تاریخ خروج" name="">

                                <div class="number">
                                    <span class="minus">-</span>
                                    <input type="text" value="1" placeholder="تعداد نفرات">
                                    <span class="text-number"> مسافر</span>
                                    <span class="plus">+</span>
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


                                <!--                                      <div class="dropdown">
                                                                        <button class="btn-dropdown1 dropdown-toggle" type="button" data-toggle="dropdown">
                                تاریخ خروج
                                                                    <span class="caret"></span></button>
                                                                        <ul class="dropdown-menu">
                                                                          <li><a href="#">دسته بندی 1</a></li>
                                                                          <li><a href="#">دسته بندی 2</a></li>
                                                                          <li><a href="#">دسته بندی 3</a></li>
                                                                        </ul>
                                                                      </div> -->
                            </div>


                            <button class="btn-search" type="submit">جستجو</button>
                        </form>
                    </div>
                </div>

            </div>

        </div>


    </div>


</div>