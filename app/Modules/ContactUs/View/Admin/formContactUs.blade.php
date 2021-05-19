@extends('backend.MasterPage.Layout')

@section('title', TitlePage('تماس با ما'))

@section('style')

@endsection

@section('content')

    <div class="row back-url">
        <div class="col-md-12">
            <a class="" href="{{ route('AdminDashboard') }}">صفحه اصلی</a><span class="now-url"> / تماس با ما</span>
        </div>
    </div>
    <div class="row">
        <div class="col-md-12">
            @include('message.Message')
            @include('message.ErrorReporting')
        </div>
    </div>
    <div class="row">
        <div class="col-md-12" style="margin-bottom: 10px;">
            <a href="{{ route('IndexContactMessage') }}" class="btn btn-default">نمایش پیام های دریافتی <i style="font-size: 18px;" class="text-success fa fa-eye"></i> </a>
        </div>
        <div class="col-md-12">
            <div class="panel panel-default">
                <div class="panel-heading text-right">
                    <h3 class="panel-title"> تماس با ما </h3>
                </div>
                <form action="{{ route('UpdateFormContactUs') }}" method="Post" id="FormUpdateContact">
                    {{ csrf_field() }}
                    <div class="panel-body">
                        <div class="widget-body">
                            <fieldset class="gllpLatlonPicker">
                                <div class="row">
                                    <div class="row-fluid">
                                        <div class="span10 col-md-9">
                                            <input type="text" class="gllpSearchField span12 autocomplete form-control" id="autocomplete" placeholder="جستجوی مکان">
                                        </div>
                                        <div class="span2 col-md-3">
                                            <input type="button" class="gllpSearchButton form-control filestyle" value="جستجو" data-icon="false" data-classbutton="btn btn-default" data-classinput="form-control inline">
                                        </div>
                                    </div>
                                </div>
                                <br />
                                <div class="row-fluid">
                                    <div class="span12">
                                        <div class="gllpMap">موقعیت مکانی</div>
                                        <input type="hidden" class="gllpZoom" value="15"/>
                                        <input type="hidden" name="latitude" class="gllpLatitude form-control" id="Latitude" value="{{$contactModel->latitude}}"/>
                                        <input type="hidden" name="longitude" class="gllpLongitude form-control" id="Longitude" value="{{$contactModel->longitude}}"/>
                                    </div>

                                </div>
                            </fieldset>
                        </div>
                        <div class="row">
                            <div class="col-md-12">
                                <div class="form-group">
                                    <label for="InputPhone">تلفن</label>
                                    <input type="text" name="phone" class="form-control" value="{{ $contactModel->phone }}" id="InputPhone" placeholder="شماره تلفن خود را وارد کنید" />
                                    @if($errors->has('phone'))
                                        <span style="color:red;">{{ $errors->first('phone') }}</span>
                                    @endif
                                </div>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-md-12">
                                <div class="form-group">
                                    <label for="InputAbout">درباره</label>
                                    <textarea name="about" rows="3" class="form-control" id="InputAbout" placeholder="درباره خانه رو ...">{{ $contactModel->about }}</textarea>
                                    @if($errors->has('about'))
                                        <span style="color:red;">{{ $errors->first('about') }}</span>
                                    @endif
                                </div>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-md-12">
                                <div class="form-group">
                                    <label for="InputEmail">پست الکترونیکی</label>
                                    <input type="text" name="email" class="form-control" value="{{ $contactModel->email }}" id="InputEmail" placeholder="پست الکترونیکی خود را وارد کنید" />
                                    @if($errors->has('email'))
                                        <span style="color:red;">{{ $errors->first('email') }}</span>
                                    @endif
                                </div>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-md-12">
                                <div class="form-group">
                                    <label for="InputAddress">آدرس</label>
                                    <input type="text" name="address" class="form-control" value="{{ $contactModel->address }}" id="InputAddress" placeholder="آدرس موقعیت خود را وارد کنید" />
                                    @if($errors->has('address'))
                                        <span style="color:red;">{{ $errors->first('address') }}</span>
                                    @endif
                                </div>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label for="InputWhatsapp">Whatsapp</label>
                                    <input type="text" name="whatsapp" class="form-control" value="{{ $contactModel->whatsapp }}" id="InputWhatsapp" placeholder="Whatsapp Link" />
                                    @if($errors->has('whatsapp'))
                                        <span style="color:red;">{{ $errors->first('whatsapp') }}</span>
                                    @endif
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label for="InputAparat">Aparat</label>
                                    <input type="text" name="aparat" class="form-control" value="{{ $contactModel->aparat }}" id="InputAparat" placeholder="Aparat Link" />
                                    @if($errors->has('aparat'))
                                        <span style="color:red;">{{ $errors->first('aparat') }}</span>
                                    @endif
                                </div>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label for="InputInstagram">Instagram</label>
                                    <input type="text" name="instagram" class="form-control" value="{{ $contactModel->instagram }}" id="InputInstagram" placeholder="Instagram Link" />
                                    @if($errors->has('instagram'))
                                        <span style="color:red;">{{ $errors->first('instagram') }}</span>
                                    @endif
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label for="InputTelegram">Telegram</label>
                                    <input type="text" name="telegram" class="form-control" value="{{ $contactModel->telegram }}" id="InputTelegram" placeholder="Instagram Link" />
                                    @if($errors->has('telegram'))
                                        <span style="color:red;">{{ $errors->first('telegram') }}</span>
                                    @endif
                                </div>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-md-12">
                                <div class="form-group">
                                    <button type="button" id="BtnUpdateFormContact" class="btn btn-success btn-block">ثبت ویرایش</button>
                                </div>
                            </div>
                        </div>

                    </div>
                </form>
            </div>
        </div>
    </div>

@endsection

@section('script')

    <!-- Map -->
    <script src="https://maps.googleapis.com/maps/api/js?key=AIzaSyCBUcxNAzDyoiTXUXpLwd1a-3jOwkQpDUs&sensor=false&libraries=places&language=en"></script>
    <script type="text/javascript" src="{{asset('backend/assets/map/jquery-gmaps-latlon-picker.js')}}"></script>
    <link rel="stylesheet" href="{{asset('backend/assets/map/jquery-gmaps-latlon-picker.css')}}">

    <!-- search -->
    <script>
        var input = document.getElementById('autocomplete');
        var autocomplete = new google.maps.places.Autocomplete(input);

        var input = document.getElementById('autocomplete1');
        var autocomplete = new google.maps.places.Autocomplete(input);
    </script>

    <script>
        $('#BtnUpdateFormContact').click(function () {
            var inputPhone = $('#InputPhone').val();
            var inputEmail = $('#InputEmail').val();
            var inputAddress = $('#InputAddress').val();
            if(inputPhone == "" || inputEmail == "" || inputAddress == "")
            {
                alert('پر کردن فیلدهای ستاره دار الزامی میباشد');
            }
            else
            {
                $('#FormUpdateContact').submit();
            }
        });
    </script>
@endsection