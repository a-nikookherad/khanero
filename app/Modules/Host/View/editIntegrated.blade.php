@extends('backend.MasterPage.Layout')
@section('title')
    {{TitlePage('ویرایش مجتمع')}}
@endsection

@section('style')
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
        input#Latitude,
        input#Longitude {
            height: 0px;
            width: 0px;
            opacity: 0;
        }
        .box-host a i {
            font-size: 20px;
            color: #3ba0ff;
        }
        .box-host a {
            border: 1px solid #3ba0ffa6;
            box-shadow: 0px 0px 11px #3ba0ffad;
        }
        .box-img img {
            width: 100%;
        }
        #ExtraHost div {
            margin-bottom: 10px;
        }
    </style>
@endsection
@section('content')
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
                    <h3 class="panel-title">ویرایش مجتمع</h3>
                </div>
                <div class="panel-body">
                    <div class="form-group">
                        <input type="hidden" id="host_id" value="{{ $integratedModel->id }}"/>
                        <form action="{{route('UpdateIntegrated')}}" method="post" enctype="multipart/form-data">
                            {{csrf_field()}}
                            <input type="hidden" name="integrated_id" value="{{$integratedModel->id}}" />
                            <div class="row">
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label for="InputTitle">اسم مجتمع</label><span style="font-size: 21px;"
                                                                                       class="text-danger">*</span>
                                        <input type="text" value="{{ $integratedModel->title }}" name="title" id="InputTitle"
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
                                        <input type="text" value="{{ count($hostModel) }}" readonly id="InputCount" class="form-control"/>
                                    </div>
                                    @if($errors->has('count'))
                                        <span style="color:red;">{{ $errors->first('count') }}</span>
                                    @endif
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-md-3">
                                    <img style="width: 40%;" id="blah" src="{{asset('Uploaded/Integrated/Img/'.$integratedModel->img)}}" alt=""/>
                                    <div class="form-group">
                                        <button type="button" class="btn btn-info" id="BtnCreateImg">بارگذاری عکس<i
                                                    class="fa fa-plus-square"></i>
                                            <span style="color: #d5d5d5;font-size: 12px;">(حداکثر10عکس)</span>
                                        </button>
                                    </div>
                                    @if($errors->has('file'))
                                        <span style="color:red;">{{ $errors->first('file') }}</span>
                                    @endif
                                </div>
                            </div>
                            <div class="row" id="ExtraGallery">
                                @foreach($integratedModel->getGallery as $key => $value)
                                    <div class="col-md-2 add-image box-img{{$key+1}}">
                                        <div class="box-img">
                                            <img src="{{asset('Uploaded/Gallery/Integrated/File'.'/'.$value->url)}}" />
                                        </div>
                                        <label class="btn btn-block"
                                               onclick="ajaxDeleteImg('{{ $value->id }}','{{$key+1}}');">
                                            <i class="text-danger fa fa-trash-o"></i>
                                        </label>
                                    </div>
                                @endforeach
                            </div>
                            <div class="row">
                                <div class="col-md-12">
                                    <div class="form-group">
                                        <label for="InputFileImg">توضیحات</label><span style="font-size: 21px;" class="text-danger">*</span>
                                        <textarea class="form-control" rows="10" name="description">{{ $integratedModel->description }}</textarea>
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
                                        <input id="Latitude" placeholder="Latitude" value="{{$integratedModel->latitude}}" name="latitude" />
                                        <!-- @Html.TextBoxFor(m => m.Location.Latitude, new {id = "Latitude", placeholder = "Latitude"}) -->
                                    </label>
                                </section>
                                <section class="col col-3">
                                    <label class="input">
                                        <input id="Longitude" placeholder="Longitude" value="{{$integratedModel->longitude}}" name="longitude" />
                                        <!-- @Html.TextBoxFor(m => m.Location.Longitude, new {id = "Longitude", placeholder = "Longitude"}) -->
                                    </label>
                                </section>
                            </div>
                            <div class="row">
                                <div class="col-md-12">
                                    <button type="submit" class="btn btn-primary btn-block">ثبت ویرایش</button>
                                </div>
                            </div>
                        </form>
                        <hr />
{{--                        <div class="row">--}}
{{--                            <div class="col-md-2">--}}
{{--                                <div class="form-group">--}}
{{--                                    <a href="#ExtraHost" id="BtnGo"></a>--}}
{{--                                    <button type="button" class="btn btn-default" id="BtnAddHost">افزودن اقامتگاه <i class="fa fa-home"></i></button>--}}
{{--                                </div>--}}
{{--                            </div>--}}
{{--                        </div>--}}
                        <div class="row box-host" id="ExtraHost">
                            @foreach($hostModel as $key => $value)
                                <div class="col-md-2">
                                    <a class="btn btn-default btn-block" href="{{route('EditHost', ['id' => $value->id])}}" target="_blank">
                                        <i class="fa fa-home"></i>
                                        <br />
                                        <h5>{{$value->name}}</h5>
                                    </a>
                                </div>
                            @endforeach
                        </div>
                    </div>
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
                curLocation = [{{$integratedModel->latitude}}, {{$integratedModel->longitude}}];
            }

            var map = L.map('mapid').setView(curLocation, 16);

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






            $('#BtnAddHost').click(function () {
                var img = '<div class="col-md-2 add-host-block text-center box-loading"><img style="height:50px;width:auto;" src="{{ asset('backend/img/img_loading/orange_circles.gif') }}" /></div>';
                $('#ExtraHost').append(img);
                var id = {{$integratedModel->id}};
                $.ajax({
                    url:"{{ url('add/host-integrated').'/'}}"+id,
                    method:"get",
                }).done(function(returnData){
                    $('.add-host-block').remove();
                    $('#ExtraHost').append(returnData);
                    $.Toast("<p>ثبت اقامتگاه</p>", "<p>ثبت اقامتگاه با موفقیت انجام شد .</p>", "success", {
                        has_icon: true,
                        has_close_btn: true,
                        stack: true,
                        fullscreen: false,
                        timeout: 4000,
                        sticky: false,
                        has_progress: true,
                        rtl: true,
                    });
                    // $("html, body").animate({ scrollTop: $(document).height() }, 2000);
                });
            });

        });

        $('#BtnCreateImg').click(function () {

            var numItems = $('.add-image').length + 1;

            if (numItems <= 10) {
                var file = '<div class="col-md-2 add-image box-img' + numItems + '"">\n' +

                    '          <div class="form-group">\n' +

                    '               <img style="width: 100%" id="blah' + numItems + '" src="{{asset('frontend/images/logo-gallery.png')}}" alt="your image" />\n' +

                    '              <span class="btn btn-primary btn-block btn-file">انتخاب کنید ... \n' +

                    '                  <input type="file" onchange="readURLs(this,' + numItems + ');" name="file[]"   accept="image/jpeg,image/jpg,image/png,image/gif"  />\n' +

                    '              </span>\n' +

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


        function ajaxDeleteImg(id, idInput) {
            var integrated_id = {{$integratedModel->id}};
            var formData = new FormData();
            formData.append('integrated_id', integrated_id);
            formData.append('img_id', id);
            $.ajaxSetup({
                headers: {
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                }
            });
            $.ajax({
                url: "{{ route('AjaxDeleteImgIntegrated') }}",
                method: "post",
                data: formData,
                processData: false,
                contentType: false,
            }).done(function (data) {
                console.log(data);
                if (data == 'deleted') {
                    $('.box-img' + idInput).remove();
                }
                else if (data == 'limited') {
                    $(".box-loading-step").fadeOut("slow", function () {
                        $('.box-loading-step').hide();
                    });
                    $.Toast("<p>ویرایش</p>", "<p>گالری نمی تواند خالی باشد .</p>", "warning", {
                        has_icon: true,
                        has_close_btn: true,
                        stack: true,
                        fullscreen: false,
                        timeout: 4000,
                        sticky: false,
                        has_progress: true,
                        rtl: true,
                    });
                }
            });
        }

    </script>
@endsection