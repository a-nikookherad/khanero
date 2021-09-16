@php($positionTypeModel1 = App\Modules\Possibilities\Controllers\PossibilitiesController::GetPositionType1())
@php($positionTypeModel2 = App\Modules\Possibilities\Controllers\PossibilitiesController::GetPositionType2())

<style>
    .progress .bar {
        width: 18%;
        background-color: #879dc0;
    }

    input#Latitude,
    input#Longitude {
        height: 0px;
        width: 0px;
        opacity: 0;
    }
</style>

<div class="row text-center">
    <div class="col-md-12">
        <div class="row rows-address">
            <div class="col-md-2">
                <div class="poly">
                    <span>
                        @if($hostModel->step >= 0)
                            <a href="{{route('EditHost', ['id' => $hostModel->id, 'step' => 1])}}">مشخصات اقامتگاه</a>
                        @else
                            <a>مشخصات اقامتگاه</a>
                        @endif
                    </span>
                </div>
            </div>
            <div class="col-md-2">
                <div class="poly active">
                    <span>
                        @if($hostModel->step > 1)
                            <a href="{{route('EditHost', ['id' => $hostModel->id, 'step' => 2])}}">موقعیت</a>
                        @else
                            <a>موقعیت</a>
                        @endif
                    </span>
                </div>
            </div>
            <div class="col-md-2">
                <div class="poly">
                    <span>
                        @if($hostModel->step > 2)
                            <a href="{{route('EditHost', ['id' => $hostModel->id, 'step' => 3])}}">امکانات</a>
                        @else
                            <a>امکانات</a>
                        @endif
                    </span>
                </div>
            </div>
            <div class="col-md-2">
                <div class="poly">
                    <span>
                        @if($hostModel->step > 3)
                            <a href="{{route('EditHost', ['id' => $hostModel->id, 'step' => 4])}}">تصاویر</a>
                        @else
                            <a>تصاویر</a>
                        @endif
                    </span>
                </div>
            </div>
            <div class="col-md-2">
                <div class="poly">
                    <span>
                        @if($hostModel->step > 4)
                            <a href="{{route('EditHost', ['id' => $hostModel->id, 'step' => 5])}}">قوانین صاحبخانه</a>
                        @else
                            <a>قوانین صاحبخانه</a>
                        @endif
                    </span>
                </div>
            </div>
            <div class="col-md-2">
                <div class="poly">
                    <span>
                        @if($hostModel->step > 5)
                            <a href="{{route('EditHost', ['id' => $hostModel->id, 'step' => 6])}}">قیمت گذاری</a>
                        @else
                            <a>قیمت گذاری</a>
                        @endif
                    </span>
                </div>
            </div>
        </div>
    </div>
</div>

<div class="row">
    <div class="col-md-12">
        <div class="panel panel-default">
            <div class="panel-heading">
                <h3 class="panel-title">موقعیت اقامتگاه<span class="information-step"><i class="fas fa-info-circle"></i></span>
                </h3>
            </div>
            <div class="panel-body">
                <div class="row">
                    <div class="col-md-8">
                        <div class="row">
                            <div class="col-md-4">
                                <div class="form-group">
                                    <label for="SelectProvince">استان</label>
                                    <select name="province_id" id="SelectProvince" class="form-control SelectProvince">
                                        @if($hostModel->province_id != null)
                                            @foreach(GetProvince() as $key => $value)
                                                <option value="{{$value->id}}" @if($value->id == $hostModel->province_id) selected @endif>{{ $value->name }}</option>
                                            @endforeach
                                        @else
                                            <option value="" hidden>انتخاب کنید</option>
                                            @foreach($provinceModel as $key => $value)
                                                <option value="{{$value->id}}">{{ $value->name }}</option>
                                            @endforeach
                                        @endif
                                    </select>
                                </div>
                            </div>
                            <div class="col-md-4">
                                <div class="form-group">
                                    <label for="SelectTownship">شهرستان</label>
                                    <select name="township_id" id="SelectTownship" class="form-control SelectTownship">
                                        @if($hostModel->township_id != null)
                                            @foreach(GetTownship($hostModel->province_id) as $key => $value)
                                                <option value="{{$value->id}}" @if($value->id == $hostModel->township_id) selected @endif>{{ $value->name }}</option>
                                            @endforeach
                                        @else
                                            <option value="" hidden>انتخاب کنید</option>
                                        @endif
                                    </select>
                                </div>
                            </div>
                            <div class="col-md-4">
                                <div class="form-group">
                                    <label for="InputDistrict">محله یا روستا</label>
                                    <input type="text" class="form-control" name="district" value="{{$hostModel->district}}" id="InputDistrict"
                                           placeholder="نام محله یا روستا را وارد کنید"/>
                                </div>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-md-4">
                                <div class="row">
                                    <div class="col-md-12">
                                        <div class="form-group">
                                            <label for="InputAddress">آدرس دقیق ملک</label>
                                            <textarea class="form-control" rows="4" name="address" id="InputAddress" placeholder="آدرس را وارد کنید">{{$hostModel->address}}</textarea>
                                        </div>
                                    </div>
                                    <div class="col-md-12">
                                        <div class="form-group">
                                            <label for="InputPostalCode">کد پستی</label>
                                            <input type="text" maxlength="10" class="form-control" name="postal_code" value="{{$hostModel->postal_code}}" id="InputPostalCode"
                                                   placeholder="کد پستی"/>
                                        </div>
                                    </div>
                                    <div class="col-md-12">
                                        <div class="form-group">
                                            <label for="InputPlaque">پلاک</label>
                                            <input type="text" class="form-control" name="plaque" id="InputPlaque" value="{{$hostModel->plaque}}"
                                                   placeholder="پلاک">
                                        </div>
                                    </div>
                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <label for="InputFloor">طبقه</label>
                                            <select class="form-control" name="floor" id="InputFloor">
                                                @for($i = 1; $i <= 30; $i++)
                                                    <option value="{{$i}}" @if($hostModel->floor == $i) selected @endif>{{$i}}</option>
                                                @endfor
                                            </select>
                                        </div>
                                    </div>
                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <label for="InputUnit">واحد</label>
                                            <select class="form-control" name="unit" id="InputUnit">
                                                @for($i = 1; $i <= 10; $i++)
                                                    <option value="{{$i}}" @if($hostModel->unit == $i) selected @endif>{{$i}}</option>
                                                @endfor
                                            </select>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="col-md-8">
                                <p>موقعیت خود را روی نقشه انتخاب کنید(پین آبی را حرکت دهید)</p>
                                <div id="mapid" style="width: 100%; height: 300px;"></div>
                                <input id="Latitude" placeholder="Latitude" value="@if($hostModel->latitude != '') {{$hostModel->latitude}} @else 35.7115095 @endif" name="latitude"/>
                                <input id="Longitude" placeholder="Longitude" value="@if($hostModel->Longitude != '') {{$hostModel->Longitude}} @else 51.3904767 @endif" name="longitude"/>
                            </div>
                        </div>
                        @php
                            if($hostModel->position_array_1 != 'a:1:{i:0;s:0:"";}') {
                                $arr = unserialize($hostModel->position_array_1);
                            } else {
                                $arr = 0;
                            }
                        @endphp
                        <div class="row">
                            <div class="col-md-12">
                                <div class="form-group">
                                    <label>بافت منطقه</label>
                                    <div class="row">
                                        @foreach($positionTypeModel1 as $key => $value)
                                            @if($arr != 0)
                                                <div class="col-md-3">
                                                    <input id="InputCheckBox1{{$key+1}}" class="chk1" type="checkbox" @if(in_array($value->id, $arr)) checked @endif
                                                    value="{{$value->id}}"/> <label for="InputCheckBox1{{$key+1}}">{{$value->name}}</label>
                                                </div>
                                            @else
                                                <div class="col-md-3">
                                                    <input id="InputCheckBox1{{$key+1}}" class="chk1" type="checkbox"
                                                           value="{{$value->id}}"/> <label for="InputCheckBox1{{$key+1}}">{{$value->name}}</label>
                                                </div>
                                            @endif
                                        @endforeach
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="row">
                            <div class="each-item col-md-12">
                                <label class="title-S">چشم انداز</label>
                                <select class="each-Qt form-control" id="InputVision">
                                    @foreach($positionTypeModel2 as  $value)
                                        <option value="{!! $value->id !!}" {{ $value->id == $hostModel->vision ? 'selected' : '' }}>{!! $value->name !!}</option>
                                    @endforeach
                                </select>
                            <!--
                                    <div class="row">
                                        <textarea id="InputVision" rows="2" class="form-control" placeholder="چشم انداز اقامتگاه ...">{{$hostModel->vision}}</textarea>
                                    </div>
                                    -->
                            </div>

                            <div class="col-md-8">
                                <div class="form-group">
                                    <label>فاصله تا مرکز خرید این اقامتگاه</label>
                                    <div class="row">
                                        <textarea id="InputDistanceShopping" rows="4" class="form-control" placeholder="فاصله تا مرکز خرید">{{ $hostModel->distance_shopping }}</textarea>
                                    </div>
                                </div>
                            </div>
                            <div class="col-md-4">
                                <div class="form-group">
                                    <label for="">وضعیت پارکینگ عمومی و غیره</label>
                                    <br/>
                                    <input type="radio" value="1" name="parking" {{ $hostModel->parking == 1 ? 'checked' : '' }} id="InputParking1"/>
                                    <label for="InputParking1">  دارد </label>
                                    <input type="radio" value="2" name="parking" {{ $hostModel->parking == 2 ? 'checked' : '' }} id="InputParking2"/>
                                    <label for="InputParking2"> ندارد </label>
                                </div>
                            </div>
                            <div class="col-md-12">
                                <div class="form-group">
                                    <label for="TextAreaOtherPosition">اطلاعات جغرافیایی دیگر</label>
                                    <textarea id="TextAreaOtherPosition" rows="6" class="form-control" placeholder="مثلا مسیر دسترسی خاکی است ، ...">{{$hostModel->other_position}}</textarea>
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
                                لورم ایپسوم متن ساختگی با تولید سادگی نامفهوم از صنعت چاپ و با استفاده از طراحان گرافیک است چاپگرها و متون بلکه روزنامه و مجله در ستون و سطرآنچنان که لازم است و برای شرایط فعلی تکنولوژی مورد نیاز و کاربردهای متنوع با هدف بهبود ابزارهای کاربردی می باشد کتابهای زیادی در شصت و سه درصد گذشته حال و آینده شناخت فراوان جامعه و متخصصان را می طلبد تا با نرم افزارها شناخت بیشتری را برای طراحان رایانه ای علی الخصوص طراحان خلاقی و فرهنگ پیشرو در زبان فارسی ایجاد کرد
                            </p>
                            <p class="title-info">
                                فضای حال
                            </p>
                            <p>
                                در این صورت می توان امید داشت که تمام و دشواری موجود در ارائه راهکارها و شرایط سخت تایپ به پایان رسد و زمان مورد نیاز شامل حروفچینی دستاوردهای اصلی و جوابگوی سوالات پیوسته اهل دنیای موجود طراحی اساسا مورد استفاده قرار گیرد. و جوابگوی سوالات پیوسته اهل دنیای موجود طراحی اساسا مورد استفاده قرار گیرد. و جوابگوی سوالات پیوسته اهل دنیای موجود طراحی اساسا مورد استفاده قرار گیرد.
                            </p>
                        </div>
                    </div>
                </div>
                <div class="row">
                    <div class="col-md-12">

                    </div>
                    <div class="col-md-12">

                    </div>
                    <div class="col col-3">
                        <label class="input">


                            {{--<input id="Latitude" placeholder="Latitude" name="Location.Latitude" />--}}
                            {{-- @Html.TextBoxFor(m => m.Location.Latitude, new {id = "Latitude", placeholder = "Latitude"}) --}}
                        </label>
                    </div>
                    <div class="col col-3">
                        <label class="input">
                            {{--<input id="Longitude" placeholder="Longitude" name="Location.Longitude" />--}}
                            {{-- @Html.TextBoxFor(m => m.Location.Longitude, new {id = "Longitude", placeholder = "Longitude"}) --}}
                        </label>
                    </div>
                    <br/>
                    <div class="col-md-2 col-md-offset-5">
                        <button type="button" id="step2" class="btn btn-primary BtnRegAll btn-block">ثبت ویرایش</button>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

{{--</form>--}}

<!-- Map -->
<script type="text/javascript" src="{{asset('backend/assets/map/jquery-gmaps-latlon-picker.js')}}"></script>
<link rel="stylesheet" href="{{asset('backend/assets/map/jquery-gmaps-latlon-picker.css')}}">


<script>

    $(function () {
        // use below if you want to specify the path for leaflet's images
        //L.Icon.Default.imagePath = '@Url.Content("~/Content/img/leaflet")';

        var curLocation = [0, 0];
        // use below if you have a model
        // var curLocation = [@Model.Location.Latitude, @Model.Location.Longitude];

        if (curLocation[0] == 0 && curLocation[1] == 0) {
            @if($hostModel->latitude != '')
                curLocation = [{{$hostModel->latitude}}, {{$hostModel->longitude}}];
            @else
                curLocation = [35.7115095, 51.3904767];
            @endif
        }

        var map = L.map('mapid').setView(curLocation, 9);

        L.tileLayer('http://{s}.tile.osm.org/{z}/{x}/{y}.png', {
            attribution: '&copy; <a href="http://osm.org/copyright">OpenStreetMap</a> contributors'
        }).addTo(map);

        map.attributionControl.setPrefix(false);

        var marker = new L.marker(curLocation, {
            draggable: 'true'
        });

        marker.on('dragend', function (event) {
            var position = marker.getLatLng();
            marker.setLatLng(position, {
                draggable: 'true'
            }).bindPopup(position).update();
            $("#Latitude").val(position.lat);
            $("#Longitude").val(position.lng).keyup();
        });

        $("#Latitude, #Longitude").change(function () {
            var position = [parseInt($("#Latitude").val()), parseInt($("#Longitude").val())];
            marker.setLatLng(position, {
                draggable: 'true'
            }).bindPopup(position).update();
            map.panTo(position);
        });

        map.addLayer(marker);
    })

</script>


<script type="text/javascript">


    // mymap.on('click', onMapClick);
    $('#step2').click(function () {
        $(".box-loading-step").fadeIn("slow", function () {
            $(this).show();
        });


        var chkArray_1 = [];
        /* look for all checkboes that have a class 'chk' attached to it and check if it was checked */
        $(".chk1:checked").each(function () {
            chkArray_1.push($(this).val());
        });
        /* we join the array separated by the comma */
        var selected_1;
        selected_1 = chkArray_1.join(',');


        if (1) {


            var formData = new FormData();
            formData.append('host_id', $('#host_id').val());
            formData.append('province_id', $('#SelectProvince').val());
            formData.append('township_id', $('#SelectTownship').val());
            formData.append('district', $('#InputDistrict').val());
            formData.append('postal_code', $('#InputPostalCode').val());
            formData.append('floor', $('#InputFloor').val());
            formData.append('unit', $('#InputUnit').val());
            formData.append('address', $('#InputAddress').val());
            formData.append('plaque', $('#InputPlaque').val());
            formData.append('other_position', $('#TextAreaOtherPosition').val());
            formData.append('latitude', $('#Latitude').val());
            formData.append('longitude', $('#Longitude').val());
            formData.append('select_array_1', selected_1);
            formData.append('vision', $('#InputVision').val());
            formData.append('distance_shopping', $('#InputDistanceShopping').val());
            formData.append('parking', $('input[name="parking"]:checked').val());
            formData.append('edit_host',1);
            // for (var pair of formData.entries()) {
            //     console.log(pair[0]+ ', ' + pair[1]);
            // }
            $.ajaxSetup({
                headers: {
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                }
            });
            $.ajax({
                url: '{{route('StoreHostStep2')}}',
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
                    } else if(data.Success == 1) {
                        $(".box-loading-step").fadeOut("slow", function () {
                            $('.box-loading-step').hide();
                        });
                        AlertToast('ویرایش اقامتگاه', data.Message, 'success');
                    }
                }
            });
        } else {
            $('#myModal').modal('show');
            $('#MsgErrorStep').text('حداقل انتخاب یکی از فیلد های بافت منطقه اجباری میباشد');
            $(".box-loading-step").fadeOut("slow", function () {
                $('.box-loading-step').hide();
            });
        }
    });


    /****************************************
     *         Edit By Step Address         *
     ***************************************/


    $('.BtnEditStep').click(function () {
        $(".box-loading-step").fadeIn("slow", function () {
            $(this).show();
        });
        var step = $(this).attr('data-value');
        var host_id = $('#host_id').val();
        $.ajaxSetup({
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            }
        });
        $.ajax({
            url: '{{route('EditStep')}}',
            type: 'post',
            data: {
                host_id: host_id,
                step: step
            },
            success: function (data) {
                if (data.Success == 1) {
                    $(".box-loading-step").fadeOut("slow", function () {
                        $('.box-loading-step').hide();
                    });
                    $('#myModalEdit').modal('show');
                    $('#ExtraBoxEditStep').html(data.Message.original);
                }
            }
        });
    });
    $('span.information-step').click(function () {
        $('.box-information').toggleClass('show-information');
    });
</script>

