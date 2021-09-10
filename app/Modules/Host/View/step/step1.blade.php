@php($buildingTypeModel = App\Modules\Possibilities\Controllers\PossibilitiesController::GetBuildingType())
@php($homeTypeModel = App\Modules\Possibilities\Controllers\PossibilitiesController::GetHomeType())

<div class="Titl-step-S rows-address row">
    <div class="col-md-2 each-step active"><div class="Numbr-Step">1</div><div class="poly">مشخصات اقامتگاه</div></div>
    <div class="col-md-2 each-step"><div class="Numbr-Step">2</div><div class="poly">موقعیت</div></div>
    <div class="col-md-2 each-step"><div class="Numbr-Step">3</div><div class="poly">امکانات</div></div>
    <div class="col-md-2 each-step"><div class="Numbr-Step">4</div><div class="poly">تصاویر</div></div>
    <div class="col-md-2 each-step"><div class="Numbr-Step">5</div><div class="poly">قوانین صاحبخانه</div></div>
    <div class="col-md-2 each-step"><div class="Numbr-Step">6</div><div class="poly">قیمت گذاری</div></div>
</div>
<div class="Body-step-S">
    <div class="panel-heading">
        <h3 class="panel-title">
            مشخصات اقامتگاه
            <span class="information-step"><i class="fas fa-info-circle"></i></span>
        </h3>
    </div>
    <div class="panel-body row">
        <div class="col-md-8">
            <div class="row">
                <div class="each-item col-md-12">
                    <label class="title-S" for="SelectBuildingType">نوع اقامتگاه خود را مشخص کنید</label>
                    <select class="each-Qt form-control" id="SelectBuildingType" name="building_type">
{{--                        <option hidden value="">انتخاب کنید</option>--}}
                        @foreach($buildingTypeModel as $key => $value)
                            <option value="{{$value->id}}"
                                    @if($value->id == $hostModel->building_type_id) selected @endif >
                                {{$value->name}}
                            </option>
                        @endforeach
                    </select>
                    @if($errors->has('building_type'))
                        <span style="color:red;">{{ $errors->first('building_type') }}</span>
                    @endif
                </div>
                <div class="each-item col-md-12">
                    <label class="title-S">عنوان اقامتگاه خود را مشخص کنید</label>
                    <input type="text" class="each-Qt form-control" value="{{$hostModel->name}}" name="" id="InputHostName" placeholder="نام اقامتگاه - برای مثال : ویلای ۴۰۰ متری دوبلکس دماوند"/>
                </div>
                <div class="each-item col-md-6">
                    <label class="title-S" for="InputMeter">متراژ اقامتگاه</label>
                    <input type="text" name="meter" value="{{$hostModel->meter}}" class="each-Qt form-control" id="InputMeter" placeholder="متراژ را وارد کنید"/>
                </div>
                <div class="each-item col-md-6 meter-total" style="@if($hostModel->building_type_id != 6 && $hostModel->building_type_id != 7) display: none @endif">
                    <label class="title-S" for="InputMeterTotal">متراژ کل زمین</label>
                    <input type="text" name="meter_total" value="{{$hostModel->meter_total}}" class="each-Qt form-control" id="InputMeterTotal" placeholder="متراژ کل بنا را وارد کنید"/>
                </div>
                <div class="each-item col-md-6">
                    <label class="title-S" for="InputYear">سال ساخت</label>
                    <select class="each-Qt form-control" id="InputYear">
                        @for($i = 1400; $i >= 1360; $i--)
                            <option value="{{$i}}" @if($i == $hostModel->reconstruction) selected @endif>
                                {{$i}}
                            </option>
                        @endfor
                    </select>
                </div>
                <div class="each-item col-md-6">
                    <label class="title-S" for="InputBuildingFloors">تعداد طبقات کل ساختمان</label>
                    <select class="each-Qt form-control" id="InputBuildingFloors">
                        @for($i = 1; $i <= 30; $i++)
                            <option value="{{$i}}" @if($i == $hostModel->building_floor) selected @endif>
                                {{$i}}
                            </option>
                        @endfor
                        <option value="100">
                            بیشتر از 30
                        </option>
                    </select>
                </div>
                <div class="each-item col-md-6">
                    <label class="title-S" for="InputUnitsPerFloor">تعداد واحد در هر طبقه</label>
                    <select class="each-Qt form-control" id="InputUnitsPerFloor">
                        @for($i = 1; $i <= 10; $i++)
                            <option value="{{$i}}"
                                    @if($i == $hostModel->units_per_floor) selected @endif>{{$i}}
                            </option>
                        @endfor
                        <option value="100">
                            بیشتر از 10
                        </option>
                    </select>
                </div>
                <div class="each-item col-md-6 has-radio">
                    <label class="title-S" for="InputReconstruction">سال بازسازی</label>
                    <select class="each-Qt form-control" id="InputReconstruction">
                        <option value="0">انتخاب کنید</option>
                        @for($i = 1400; $i >= 1360; $i--)
                            <option value="{{$i}}" @if($i == $hostModel->reconstruction) selected @endif>
                                {{$i}}
                            </option>
                        @endfor
                    </select>
                </div>
                <div class="each-item col-md-6 has-radio">
                    <label class="title-S" for="">نوع مورد اجاره</label>
                    <div class="each-Qt flex align-items-center oth-er">
                        <div class="position-relative">
                            <input type="radio" value="1" name="type_rent" @if($hostModel->type_rent == 1) checked @elseif($hostModel->type_rent == null) checked @endif id="InputTypeRent1"/>
                            <div class="check"></div>
                            <label for="InputTypeRent1"> واحد مجزا </label>
                        </div>
                        <div class="position-relative">
                            <input type="radio" value="2" name="type_rent" @if($hostModel->type_rent == 2) checked @endif id="InputTypeRent2"/>
                            <div class="check"></div>
                            <label for="InputTypeRent2"> دربستی </label>
                        </div>
                        <div class="position-relative">
                            <input type="radio" value="3" name="type_rent" @if($hostModel->type_rent == 3) checked @endif id="InputTypeRent3"/>
                            <div class="check"></div>
                            <label for="InputTypeRent3"> اتاق خصوصی </label>
                        </div>
                    </div>
                </div>
                <div class="each-item col-md-6 has-radio">
                    <label class="title-S" for="">ثبت اقامتگاه توسط</label>
                    <div class="each-Qt flex align-items-center oth-er">
                        <div class="position-relative">
                            <input type="radio" value="1" name="register_by" @if($hostModel->register_by == 1) checked @endif id="InputRegisterBy1"/>
                            <div class="check"></div>
                            <label for="InputRegisterBy1"> مالک </label>
                        </div>
                        <div class="position-relative">
                            <input type="radio" value="2" name="register_by" @if($hostModel->register_by == 2) checked @endif id="InputRegisterBy2"/>
                            <div class="check"></div>
                            <label for="InputRegisterBy2"> تحویل دار </label>
                        </div>
                    </div>
                </div>
                <div class="each-item col-md-6 has-radio">
                    <label class="title-S" for="">شکل اقامتگاه</label>
                    <div class="each-Qt flex align-items-center oth-er">
                        <div class="position-relative">
                            <input type="radio" value="1" name="shape_host" @if($hostModel->shape_host == 1) checked @elseif($hostModel->shape_host == null) checked @endif id="InputShapeHost1"/>
                            <div class="check"></div>
                            <label for="InputShapeHost1"> مسطح </label>
                        </div>
                        <div class="position-relative">
                            <input type="radio" value="2" name="shape_host" @if($hostModel->shape_host == 2) checked @endif id="InputShapeHost2"/>
                            <div class="check"></div>
                            <label for="InputShapeHost2"> دوبلکس </label>
                        </div>
                        <div class="position-relative">
                            <input type="radio" value="3" name="shape_host" @if($hostModel->shape_host == 3) checked @endif id="InputShapeHost3"/>
                            <div class="check"></div>
                            <label for="InputShapeHost3"> تریبلکس </label>
                        </div>
                    </div>
                </div>
                <div class="each-item col-md-6">
                    <label class="title-S" for="InputStandardCapacity">ظرفیت استاندارد</label>
                    <div class="each-Qt number">
                        <span class="icon-number"></span>
                        <span class="plus oo"><i class="fas fa-plus"></i></span>
                        <input type="text" value="@if($hostModel->standard_guest == '') 1 @else {{$hostModel->standard_guest}} @endif" class="input-text"
                               id="InputStandardCapacity" readonly>
                        <span class="minus oo"><i class="fas fa-minus"></i></span>
                    </div>
                </div>
                <div class="each-item col-md-6">
                    <label class="title-S" for="InputMaximumCapacity">ظرفیت حداکثر</label>
                    <div class="each-Qt number">
                        <span class="icon-number"></span>
                        <span class="plus"><i class="fas fa-plus"></i></span>
                        <input type="text" value="@if($hostModel->count_guest == '') 1 @else {{$hostModel->count_guest}} @endif" class="input-text" id="InputMaximumCapacity" readonly>
                        <span class="minus gg"><i class="fas fa-minus"></i></span>
                    </div>
                </div>
                <div class="each-item col-md-6">
                    <label class="title-S" for="">تعداد اتاق</label>
                    <div class="each-Qt number">
                        <span class="icon-number"></span>
                        <span class="plus plus-room"><i class="fas fa-plus"></i></span>
                        <input type="text" value="{{count($hostModel->getRoom)}}" class="input-text" id="InputCountRoom" readonly placeholder="تعداد نفرات">
                        <span class="minus minus-room"><i class="fas fa-minus"></i></span>
                    </div>
                </div>
                <div class="each-item col-md-12">
                    <script>
                                $(document).ready(function () {
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
                                        return false;
                                    });
                                });

                                $('.plus-room').click(function () {
                                    // var textbox = $(this).parent().find('.input-text');
                                    // var value  = textbox[0].defaultValue;
                                    var numItems = $('.box').length + 1;
                                    // textbox[0].defaultValue = parseFloat(value)+1;
                                    var box = '<div class="each-item col-md-12 box">\n' +
                                        '          <p class="some-title">اتاق شماره ' + numItems + '</p>\n' +
                                        '          <div class="boxs">\n' +
                                        '              <div class="each-item col-md-3">\n' +
                                        '                  <label class="title-S">تخت یک نفره</label>\n' +
                                        '                      <select class="each-Qt form-control" name="single_bed" id="InputSingleBed">\n' +
                                        '                           <option value="0" selected>ندارد</option>' +
                                        '                           @for($i = 1; $i <= 10; $i++)\n' +
                                        '                               <option value="{{$i}}">{{$i}}</option>\n' +
                                        '                           @endfor \n' +
                                        '                       </select>' +
                                        '              </div>\n' +
                                        '              <div class="each-item col-md-3">\n' +
                                        '                  <label class="title-S">تخت دونفره</label>\n' +
                                        '                      <select class="each-Qt form-control" name="double_bed" id="InputDoubleBed">\n' +
                                        '                           <option value="0" selected>ندارد</option>' +
                                        '                           @for($i = 1; $i <= 10; $i++)\n' +
                                        '                               <option value="{{$i}}">{{$i}}</option>\n' +
                                        '                           @endfor \n' +
                                        '                       </select>' +
                                        '              </div>\n' +
                                        '              <div class="each-item col-md-3">\n' +
                                        '                  <label class="title-S">مبل تخت خواب شو</label>\n' +
                                        '                      <select class="each-Qt form-control" name="sofa_bed" id="InputSofaBed">\n' +
                                        '                           <option value="0" selected>ندارد</option>' +
                                        '                           @for($i = 1; $i <= 10; $i++)\n' +
                                        '                               <option value="{{$i}}">{{$i}}</option>\n' +
                                        '                           @endfor \n' +
                                        '                       </select>' +
                                        '              </div>\n' +
                                        '              <div class="each-item col-md-3">\n' +
                                        '                  <label class="title-S">رخت خواب کف</label>\n' +
                                        '                      <select class="each-Qt form-control" name="traditional_bedding" id="InputTraditionalBedding">\n' +
                                        '                           <option value="0" selected>ندارد</option>' +
                                        '                           @for($i = 1; $i <= 10; $i++)\n' +
                                        '                               <option value="{{$i}}">{{$i}}</option>\n' +
                                        '                           @endfor \n' +
                                        '                       </select>' +
                                        '              </div>\n' +
                                        '          </div>\n' +
                                        '       </div>';
                                    $('.boxRoom').append(box);

                                });


                                $('.minus-room').click(function () {
                                    var textbox = $(this).parent().parent().find('.input-text');
                                    var value = textbox[0].defaultValue;
                                    if (value == 0) {
                                        value = 1;
                                    }
                                    textbox[0].defaultValue = parseFloat(value) - 1;
                                    var element = $('.boxRoom .box:last-child');
                                    element.remove();
                                });
                            </script>
                    <div class="boxRoom">


                        @foreach($hostModel->getRoom as $key => $value)

                            <div class="each-item col-md-12 box">
                                <p class="some-title">اتاق شماره {{$key+1}}</p>
                                <div class="boxs">
                                    <div class="each-item col-md-3">
                                        <label class="title-S">تخت یک نفره</label>
                                        <select class="each-Qt form-control" name="single_bed" id="InputSingleBed">
                                            <option value="0" selected>ندارد</option>
                                            @for($i = 1; $i <= 10; $i++)
                                                <option value="{{$i}}" {{ ($value->single_beds==$i)?'selected':'' }}>{{$i}}</option>
                                            @endfor
                                        </select>
                                    </div>
                                    <div class="each-item col-md-3">
                                        <label class="title-S">تخت دونفره</label>
                                        <select class="each-Qt form-control" name="double_bed" id="InputDoubleBed">
                                            <option value="0" selected>ندارد</option>
                                            @for($i = 1; $i <= 10; $i++)
                                                <option value="{{$i}}" {{ ($value->double_beds==$i)?'selected':'' }}>{{$i}}</option>
                                            @endfor
                                        </select>
                                    </div>
                                    <div class="each-item col-md-3">
                                        <label class="title-S">مبل تخت خواب شو</label>
                                        <select class="each-Qt form-control" name="sofa_bed" id="InputSofaBed">
                                            <option value="0" selected>ندارد</option>
                                            @for($i = 1; $i <= 10; $i++)
                                                <option value="{{$i}}" {{ ($value->sofa_bed==$i)?'selected':'' }}>{{$i}}</option>
                                            @endfor
                                        </select>
                                    </div>
                                    <div class="each-item col-md-3">
                                        <label class="title-S">رخت خواب کف</label>
                                        <select class="each-Qt form-control" name="traditional_bedding"
                                                id="InputTraditionalBedding">
                                            <option value="0" selected>ندارد</option>
                                            @for($i = 1; $i <= 10; $i++)
                                                <option value="{{$i}}" {{ ($value->traditional_bedding==$i)?'selected':'' }}>{{$i}}</option>
                                            @endfor
                                        </select>
                                    </div>
                                </div>
                            </div>
                        @endforeach
                    </div>
                </div>
                <div class="col-md-12 box-reception">
                    <label class="some-title">فضای حال</label>
                    <div class="boxs_reception row">
                        <div class="each-item col-md-3">
                            <label class="title-S">تخت یک نفره</label>
                            <select class="each-Qt form-control" name="single_bed_reception"
                                                        id="InputSingleBedReception">
                                                    <option value="0"
                                                            @if($hostModel->single_bed_reception == 0) selected @endif>
                                                        ندارد
                                                    </option>
                                                    @for($i = 1; $i <= 6; $i++)
                                                        <option value="{{$i}}"
                                                                @if($hostModel->single_bed_reception == $i) selected @endif>
                                                            {{$i}}
                                                        </option>
                                                    @endfor
                                                </select>
                        </div>
                        <div class="each-item col-md-3">
                            <label class="title-S">تخت دونفره</label>
                            <select class="each-Qt form-control" name="double_bed_reception"
                                            id="InputDoubleBedReception">
                                        <option value="0"
                                                @if($hostModel->double_bed_reception == 0) selected @endif>
                                            ندارد
                                        </option>
                                @for($i = 1; $i <= 6; $i++)
                                    <option value="{{$i}}"
                                            @if($hostModel->double_bed_reception == $i) selected @endif>
                                        {{$i}}
                                            </option>
                                        @endfor
                                    </select>
                        </div>
                        <div class="each-item col-md-3">
                            <label class="title-S">مبل تخت خواب شو</label>
                            <select class="each-Qt form-control" name="sofa_bed_reception"
                                            id="SofaBedReception">
                                        <option value="0"
                                                @if($hostModel->sofa_bed_reception == 0) selected @endif>
                                            ندارد
                                        </option>
                                        @for($i = 1; $i <= 6; $i++)
                                            <option value="{{$i}}"
                                                    @if($hostModel->sofa_bed_reception == $i) selected @endif>
                                                {{$i}}
                                            </option>
                                        @endfor
                                    </select>
                        </div>
                        <div class="each-item col-md-3">
                            <label class="title-S">رخت خواب کف</label>
                            <select class="each-Qt form-control" name="traditional_bedding_reception"
                                            id="TraditionalBeddingReception">
                            <option value="0"
                                    @if($hostModel->traditional_bedding_reception == 0) selected @endif>
                                ندارد
                            </option>
                                        @for($i = 1; $i <= 6; $i++)
                                            <option value="{{$i}}"
                                                    @if($hostModel->traditional_bedding_reception == $i) selected @endif>
                                                {{$i}}
                                            </option>
                                        @endfor
                                    </select>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="col-md-4">
                        <div class="box-information">
                            <p class="title-info">
                                مشخصات ملک
                            </p>
                            <p>
                                لورم ایپسوم متن ساختگی با تولید سادگی نامفهوم از صنعت چاپ و با استفاده از طراحان گرافیک
                                است چاپگرها و متون بلکه روزنامه و مجله در ستون و سطرآنچنان که لازم است و برای شرایط فعلی
                                تکنولوژی مورد نیاز و کاربردهای متنوع با هدف بهبود ابزارهای کاربردی می باشد کتابهای زیادی
                                در شصت و سه درصد گذشته حال و آینده شناخت فراوان جامعه و متخصصان را می طلبد تا با نرم
                                افزارها شناخت بیشتری را برای طراحان رایانه ای علی الخصوص طراحان خلاقی و فرهنگ پیشرو در
                                زبان فارسی ایجاد کرد
                            </p>
                            <p class="title-info">
                                فضای حال
                            </p>
                            <p>
                                در این صورت می توان امید داشت که تمام و دشواری موجود در ارائه راهکارها و شرایط سخت تایپ
                                به پایان رسد و زمان مورد نیاز شامل حروفچینی دستاوردهای اصلی و جوابگوی سوالات پیوسته اهل
                                دنیای موجود طراحی اساسا مورد استفاده قرار گیرد. و جوابگوی سوالات پیوسته اهل دنیای موجود
                                طراحی اساسا مورد استفاده قرار گیرد. و جوابگوی سوالات پیوسته اهل دنیای موجود طراحی اساسا
                                مورد استفاده قرار گیرد.
                            </p>
                        </div>
                    </div>
        <div class="col-md-12 row btn-footer">
                    <div class="col-md-12 text-left">
                        <button type="button" id="step1" class="nxt-btn btn btn-default BtnRegAll btn-block">&nbsp; بعدی
                            <i class="fa fa-angle-left"></i><i class="fa fa-angle-left"></i>
                        </button>
                    </div>
                </div>
    </div>
</div>

<script>

    $('#InputFileImg').on('change', function () {
        $('.PercentUpload').html('');
        $('.count-upload').text('');
        var img = '<div class="text-center box-loading"><img style="height:50px;width:auto;" src="{{ asset('backend/img/img_loading/loading_calendar.gif') }}" /></div>';
        $('.btn-file').append(img);
        var file = $(this)[0].files[0];
        var hostId = $('#host_id').val();
        var formData = new FormData();
        formData.append('img', file);
        formData.append('id', hostId);
        $.ajaxSetup({
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            }
        });
        $.ajax({
            url: '{{route('StoreImageHost')}}',
            type: 'post',
            data: formData,
            processData: false,
            contentType: false,
            xhr: function () {
                //upload Progress
                var xhr = $.ajaxSettings.xhr();
                if (xhr.upload) {
                    xhr.upload.addEventListener('progress', function (event) {
                        var percent = 0;
                        var position = event.loaded || event.position;
                        var total = event.total;
                        if (event.lengthComputable) {
                            percent = Math.ceil(position / total * 100);
                        }
                        //update progressbar
                        $('.PercentUpload').text(percent + "%");
                    }, true);
                }
                return xhr;
            },
            success: function (data) {
                if (data.Success == '1') {
                    $('#ExtraGallery').append(data.url.original);
                    $('.box-loading').remove();
                    $('.PercentUpload').html('');
                } else if (data.Success == '0' && data.Message == 'false') {
                    $('.count-upload').text('خطا در ذخیره سازی تصویر ، لطفا مجددا تلاش کنید');
                    $('.box-loading').remove();
                } else if (data.Success == '0' && data.Message == 'error') {
                    $('.count-upload').text('خطا در ارسال داده ها');
                    $('.box-loading').remove();
                } else if (data.Success == '0' && data.Message == 'none') {
                    $('.count-upload').text('تصویری ارسال نشده است');
                    $('.box-loading').remove();
                } else if (data.Success == '0' && data.Message == 'count_upload') {
                    $('.count-upload').text('محدودیت در تعداد ارسال تصاویر');
                    $('.box-loading').remove();
                } else if (data.Success == '0' && data.Message == 'count_upload') {
                    $('.count-upload').text('محدودیت در تعداد ارسال تصاویر');
                    $('.box-loading').remove();
                } else {
                    $('.count-upload').text(data.Message);
                    $('.box-loading').remove();
                }
            }
        });
    });




    $('#step1').click(function () {
        meter=$('#InputMeter').val();
            // if (typeof meter != 'number')
            // {
            //     alert("متراژ باید عدد باشد"+meter);
            //     return false;
            // }
        $(".box-loading-step").fadeIn("slow", function () {
            $(this).show();
        });
        var formData = new FormData();
        formData.append('host_id', $('#host_id').val());
        // formData.append('home_type_id', $('#SelectHomeType option:selected').val());
        formData.append('building_type_id', $('#SelectBuildingType option:selected').val()); // نوع اقامتگاه
        formData.append('meter', $('#InputMeter').val()); // متراژ اقامتگاه
        formData.append('meter_total', $('#InputMeterTotal').val()); // متراژ کل زمین
        formData.append('host_name', $('#InputHostName').val()); // عنوان اقامتگاه
        formData.append('year', $('#InputYear').val()); // سال ساخت
        formData.append('reconstruction', $('#InputReconstruction').val()); // مدل بازسازی
        formData.append('building_floor', $('#InputBuildingFloors').val()); // تعداد طبقات کل ساختمان
        formData.append('units_per_floor', $('#InputUnitsPerFloor').val()); // تعداد واحد در هر طبقه
        formData.append('type_rent', $('input[name="type_rent"]:checked').val()); // نوع فضای اجاره
        formData.append('register_by', $('input[name="register_by"]:checked').val()); // ثبت شده توسط
        formData.append('shape_host', $('input[name="shape_host"]:checked').val()); // شکل اقامتگاه
        formData.append('standard_guest', $('#InputStandardCapacity').val()); // ظرفیت استاندارد
        formData.append('count_guest', $('#InputMaximumCapacity').val()); // حداکثر ظرفیت
        formData.append('count_room', $('#InputCountRoom').val()); // تعداد اتاق خواب
        formData.append('single_bed_reception', $('#InputSingleBedReception').val()); // تخت یک نفره
        formData.append('double_bed_reception', $('#InputDoubleBedReception').val()); // تخت دو نفره
        formData.append('sofa_bed_reception', $('#SofaBedReception').val()); // مبل تخت خواب شو
        formData.append('traditional_bedding_reception', $('#TraditionalBeddingReception').val()); // رخت خواب سنتی پذیرایی

        // محاسبه تعداد اتاق خواب
        var countRoom = $('#InputCountRoom').val();
        var arrayBox = $(".boxs");

        var myArray = [];
        for (var i = 0; i < countRoom; i++) {
            myArray.push([]);
        }
        for (var i = 0; i < countRoom; i++) {
            // for (var j = 0; j < 3; j++) {
                myArray[i][0] = (arrayBox.eq(i).find('#InputSingleBed').val());
                myArray[i][1] = (arrayBox.eq(i).find('#InputDoubleBed').val());
                myArray[i][2] = (arrayBox.eq(i).find('#InputSofaBed').val());
                myArray[i][3] = (arrayBox.eq(i).find('#InputTraditionalBedding').val());
            // }
        }

            console.log(myArray);
        formData.append('rooms', JSON.stringify(myArray));

        $.ajaxSetup({
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            }
        });
        $.ajax({
            url: '{{route('StoreHostStep1')}}',
            type: 'post',
            data: formData,
            processData: false,
            contentType: false,
            success: function (data) {
                if (data.Success == 0) {
                    $(".box-loading-step").fadeOut("slow", function () {
                        $('.box-loading-step').hide();
                    });
                    $('#myModal').modal('show');
                    $('#MsgErrorStep').text(data.Message);
                } else {
                    $(".box-loading-step").fadeOut("slow", function () {
                        $('.box-loading-step').hide();
                    });
                    $('#ExtraFormHost').html(data.Message.original);
                }
            }
        });
    });


    $('#BtnSubCountRoom').click(function () {
        var textbox = $(this).parent().parent().find('.input-text');
        var value = textbox[0].defaultValue;
        if (value == 0) {
            value = 1;
        }
        textbox[0].defaultValue = parseFloat(value) - 1;
        var element = $('.boxRoom .box:last-child');
        element.remove();
    });


    $('.BtnAdd').click(function () {
        var textbox = $(this).parent().parent().find('.input-text');
        var value = textbox[0].defaultValue;
        textbox[0].defaultValue = parseFloat(value) + 1;
        return false;
    });
    $('.BtnSub').click(function () {
        var textbox = $(this).parent().parent().find('.input-text');
        console.log(textbox[0].id);
        if (textbox[0].id == 'InputGuest') {
            var value = textbox[0].defaultValue;
            if (value == 1) {
                value = 2;
            }
            textbox[0].defaultValue = parseFloat(value) - 1;
            return false;
        }
        var value = textbox[0].defaultValue;
        if (value == 0) {
            value = 1;
        }
        textbox[0].defaultValue = parseFloat(value) - 1;
        return false;
    });
    $('span.information-step').click(function () {
        $('.box-information').toggleClass('show-information');
    });

</script>
