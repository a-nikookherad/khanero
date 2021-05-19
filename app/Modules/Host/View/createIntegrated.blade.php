@extends('backend.MasterPage.Layout')
@section('title')
    {{TitlePage('ثبت مجتمع')}}
@endsection
@php
    $buildingTypeModel = App\Modules\Possibilities\Controllers\PossibilitiesController::GetBuildingType();
    $positionTypeModel = App\Modules\Possibilities\Controllers\PossibilitiesController::GetPositionType();
@endphp
@section('style')
    <link rel="stylesheet" href="{{asset('backend/css/dataTables.bootstrap.css')}}">
    <link rel="stylesheet" href="{{asset('backend/css/TableTools.css')}}">
    <link rel="stylesheet" href="{{asset('backend/assets/checkbox/css/style.css')}}">
    <style>
        .btn-file {
            position: relative;
            overflow: hidden;
        }
        .btn-file input[type=file] {
            position: absolute;
            top: 0;
            right: 0;
            min-width: 100%;
            min-height: 100%;
            font-size: 100px;
            text-align: right;
            filter: alpha(opacity=0);
            opacity: 0;
            outline: none;
            background: white;
            cursor: inherit;
            display: block;
        }
        h6.title-form {
            color: #fe5912;
            border-bottom: 1px solid #fe59126b;
            padding-bottom: 5px;
            display: inline-block;
        }
        input#Latitude,
        input#Longitude {
            height: 0px;
            width: 0px;
            opacity: 0;
        }
    </style>
@endsection
@section('content')
    {{--<div class="row back-url">--}}
    {{--<div class="col-md-12">--}}
    {{--<a class="" href="{{ route('UserDashboard') }}">صفحه اصلی</a>--}}
    {{--<span class="now-url"> / ثبت میزبانی جدید</span>--}}
    {{--</div>--}}
    {{--</div>--}}
    <div class="row">
        <div class="col-md-12">
            @include('message.Message')
            @include('message.ErrorReporting')
        </div>
    </div>
    <div class="row">
        <div class="col-md-12">
            <div class="panel panel-default">
                <div class="panel-heading">
                    <h3 class="panel-title">ثبت مجتمع اقامتگاهی</h3>
                </div>
                <div class="panel-body">
                    <form action="{{route('StoreIntegrated')}}" method="post" enctype="multipart/form-data" id="FormStoreIntegrated">
                        {{ csrf_field() }}
                        <div class="row">
                            <div class="col-md-12">
                                <h6 class="title-form">اطلاعات مجتمع اقامتگاهی</h6>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label for="InputTitle">اسم مجتمع</label><span style="font-size: 21px;"
                                                                               class="text-danger">*</span>
                                    <input type="text" value="{{ old('title') }}" name="title" id="InputTitle"
                                           class="form-control" placeholder="اسم مجتمع را وارد کنید"/>
                                </div>
                                @if($errors->has('title'))
                                    <span style="color:red;">{{ $errors->first('title') }}</span>
                                @endif
                            </div>
                            <div class="col-md-3">
                                <div class="form-group">
                                    <label for="InputCount">تعداد اقامتگاه موجود</label><span style="font-size: 21px;"
                                                                                              class="text-danger">*</span>
                                    <input type="text" value="{{ old('count') }}" placeholder="0" name="count"
                                           id="InputCount" class="form-control"/>
                                </div>
                                @if($errors->has('count'))
                                    <span style="color:red;">{{ $errors->first('count') }}</span>
                                @endif
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-md-2">
                                <div class="form-group">
                                    <button type="button" class="btn btn-info" id="BtnCreateImg">بارگذاری عکس<i
                                                class="fa fa-plus-square"></i>
                                        <span style="color: #d5d5d5;font-size: 12px;">(حداکثر10عکس)</span>
                                    </button>
                                </div>
                            </div>
                        </div>
                        <div class="row" id="ExtraGallery">

                        </div>
                        <div class="row">
                            <div class="col-md-12">
                                <div class="form-group">
                                    <label for="InputFileImg">توضیحات</label>
                                    <textarea class="form-control" rows="10" name="description">{{old('description')}}</textarea>
                                </div>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-md-12">
                                <h6 class="title-form">اطلاعات اقامتگاه ها</h6>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-md-4">
                                <div class="form-group">
                                    <label>استان</label><span style="font-size: 18px;" class="text-danger">*</span>
                                    <select name="province_id" id="SelectProvince" class="form-control SelectProvince">
                                        <option value="" hidden>انتخاب کنید</option>
                                        @foreach($provinceModel as $key => $value)
                                            <option value="{{$value->id}}">{{ $value->name }}</option>
                                        @endforeach
                                    </select>
                                </div>
                            </div>
                            <div class="col-md-4">
                                <div class="form-group">
                                    <label>شهرستان</label><span style="font-size: 18px;" class="text-danger">*</span>
                                    <select name="township_id" id="SelectTownship" class="form-control SelectTownship">
                                        <option value="" hidden>انتخاب کنید</option>
                                    </select>
                                </div>
                            </div>
                            <div class="col-md-4">
                                <div class="form-group">
                                    <label for="InputDistrict">محله</label><span style="font-size: 18px;"
                                                                                 class="text-danger">*</span>
                                    <input type="text" class="form-control" name="district" id="InputDistrict"
                                           placeholder="نام محله را وارد کنید"/>
                                </div>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-md-12">
                                <div class="form-group">
                                    <label for="InputAddress">آدرس</label><span style="font-size: 18px;"
                                                                                class="text-danger">*</span>
                                    <input type="text" class="form-control" name="address" id="InputAddress"
                                           placeholder="آدرس محل را وارد کنید">
                                </div>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-md-3">
                                <div class="form-group">
                                    <label for="SelectBuildingType">نوع ساختمان</label><span style="font-size: 18px;" class="text-danger">*</span>
                                    <br />
                                    <select class="form-control" id="SelectBuildingType" name="building_type">
                                        <option hidden value="">انتخاب کنید</option>
                                        @foreach($buildingTypeModel as $key => $value)
                                            <option value="{{$value->id}}">{{$value->name}}</option>
                                        @endforeach
                                    </select>
                                </div>
                                @if($errors->has('building_type'))
                                    <span style="color:red;">{{ $errors->first('building_type') }}</span>
                                @endif
                            </div>
                            <div class="col-md-9">
                                <div class="form-group">
                                    <label>موقعیت </label><span style="font-size: 18px;" class="text-danger">*</span>(حداقل یک مورد را انتخاب کنید)
                                    <div class="row">
                                        @foreach($positionTypeModel as $key => $value)
                                            <div class="col-md-2">
                                                <input id="InputCheckBox{{$key+1}}" class="chk" type="checkbox" name="position[]" value="{{$value->id}}" /><label for="InputCheckBox{{$key+1}}">{{$value->name}}</label>
                                            </div>
                                        @endforeach
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-md-12">
                                <div id="mapid" style="width: 100%; height: 400px;"></div>
                            </div>
                        </div>
                        <div class="row">
                            <section class="col col-3">
                                <label class="input">
                                    <input id="Latitude" placeholder="Latitude" value="36.5686664" name="latitude" />
                                    <!-- @Html.TextBoxFor(m => m.Location.Latitude, new {id = "Latitude", placeholder = "Latitude"}) -->
                                </label>
                            </section>
                            <section class="col col-3">
                                <label class="input">
                                    <input id="Longitude" placeholder="Longitude" value="51.9392395" name="longitude" />
                                    <!-- @Html.TextBoxFor(m => m.Location.Longitude, new {id = "Longitude", placeholder = "Longitude"}) -->
                                </label>
                            </section>
                        </div>
                        <div class="row">
                            <div class="col-md-12">
                                <button type="submit" id="BtnIntegrated" class="btn btn-block btn-default">ثبت اطلاعات</button>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>

@endsection

@section('script')

    <link rel="stylesheet" href="https://unpkg.com/leaflet@1.4.0/dist/leaflet.css" integrity="sha512-puBpdR0798OZvTTbP4A8Ix/l+A4dHDD0DGqYW6RQ+9jxkRFclaxxQb/SJAWZfWAkuyeQUytO7+7N4QKrDh+drA==" crossorigin=""/>
    <script src="https://unpkg.com/leaflet@1.4.0/dist/leaflet.js" integrity="sha512-QVftwZFqvtRNi0ZyCtsznlKSWOStnDORoefr1enyq5mVL4tmKB3S/EnC3rRJcxCPavG10IcrVGSmPh6Qw5lwrg==" crossorigin=""></script>
    <script>
        $( document ).ready(function() {

            // use below if you want to specify the path for leaflet's images
            //L.Icon.Default.imagePath = '@Url.Content("~/Content/img/leaflet")';

            var curLocation = [0, 0];
            // use below if you have a model
            // var curLocation = [@Model.Location.Latitude, @Model.Location.Longitude];

            if (curLocation[0] == 0 && curLocation[1] == 0) {
                curLocation = [36.5690917, 51.938365];
            }

            var map = L.map('mapid').setView(curLocation, 9);

            L.tileLayer('http://{s}.tile.osm.org/{z}/{x}/{y}.png', {
                attribution: '&copy; <a href="http://osm.org/copyright">OpenStreetMap</a> contributors'
            }).addTo(map);

            map.attributionControl.setPrefix(false);

            var marker = new L.marker(curLocation, {
                draggable: 'true'
            });

            marker.on('dragend', function(event) {
                var position = marker.getLatLng();
                marker.setLatLng(position, {
                    draggable: 'true'
                }).bindPopup(position).update();
                $("#Latitude").val(position.lat);
                $("#Longitude").val(position.lng).keyup();
            });

            $("#Latitude, #Longitude").change(function() {
                var position = [parseInt($("#Latitude").val()), parseInt($("#Longitude").val())];
                marker.setLatLng(position, {
                    draggable: 'true'
                }).bindPopup(position).update();
                map.panTo(position);
            });

            map.addLayer(marker);




            //get township
            $("body").delegate(".SelectProvince", "change", function (e) {

                var id = $(this).val();
                getTownship(id);
            });

            //get township
            function getTownship(id) {
                $.ajaxSetup({
                    headers: {
                        'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                    }
                });
                $.ajax({
                    url: '{{route('GetAjaxTownship')}}',
                    type: 'post',
                    data: {
                        id: id
                    },
                    success: function (data) {
                        $(".SelectTownship").html(data);
                    }
                });

            }


            //get city
            $("body").delegate(".SelectTownship", "change", function (e) {
                var text = $(".SelectTownship option:selected").text();
                $('.gllpSearchField').val(text);
                $('.gllpSearchButton').click();

                var id = $(this).val();
                getCity(id);
            });

            //get city
            function getCity(id) {
                $.ajaxSetup({
                    headers: {
                        'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                    }
                });
                $.ajax({
                    url: '{{route('GetAjaxCity')}}',
                    type: 'post',
                    data: {
                        id: id
                    },
                    success: function (data) {
                        $(".SelectCity").html(data);
                    }
                });
            }

        });


        $('#BtnCreateImg').click(function () {

            var numItems = $('.add-image').length + 1;

            if (numItems <= 10) {
                var file = '<div class="col-md-3 add-image box-img-'+numItems+'">\n' +

                    '          <div class="form-group">\n' +

                    '               <img style="border-radius: 5px; margin-bottom: 5px; width: 70%;" id="blah' + numItems + '" src="{{asset('frontend/images/logo-gallery.png')}}" alt="your image" />\n' +

                    '              <span class="btn btn-primary btn-file">انتخاب کنید ... \n' +

                    '                  <input type="file" onchange="readURLs(this,' + numItems + ');" name="file[]"   accept="image/jpeg,image/jpg,image/png,image/gif"  />\n' +

                    '              </span>\n' +
                    '              <button type="button" class="btn" onclick="DeleteBoxImg('+numItems+')"><i class="fa fa-trash-o text-danger"></i></button\n' +

                    '          </div>\n' +

                    '     </div>';

                $('#ExtraGallery').append(file);
            } else {
                alert('شما بیش از 10 عکس نمی توانید انتخاب کنید');
            }
        });

        function readURLs(input, num) {
            if (input.files && input.files[0]) {
                var reader = new FileReader();

                reader.onload = function (e) {
                    $('#blah' + num)
                        .attr('src', e.target.result)
                        .width(145)
                        .height(100);
                };

                reader.readAsDataURL(input.files[0]);
            }
        }

        $('#BtnIntegrated').click(function () {
            $(this).remove();
            $('#FormStoreIntegrated').submit();
        });

        function DeleteBoxImg(id) {
            $('.box-img-'+id).remove();
        }

    </script>
@endsection