@extends('frontend.MasterPage.Layout')
<meta name="viewport" content="width=device-width, initial-scale=1">
@section('title','املاک برتر :: ثبت نام')

@section('content')


    <form method="post" action="{{route('UserRegister')}}" enctype="multipart/form-data">
        {{csrf_field()}}

        <div class="row">

            <div class="col-md-12 col-sm-12">

                <div class="panel panel-default">

                    <div class="panel-body">

                    @include('message.Message')

                        <div class="page-header">
                            <h4>اطلاعات فردی</h4>
                        </div>

                    <!-- Row # 1 -->
                        <div class="row RegisterCode">

                            <div class="form-group col-sm-12{{ ($errors->has('name') ? ' has-error' : '') }}">
                                <div class="row">
                                    <div class="col-sm-2 col-md-2">
                                       <i class="fa fa-user"></i> نام و نام خانوادگی :
                                    </div>
                                    <div class="col-sm-10 col-md-10">
                                        <input type="text" name="name" value="{{old('name')}}" class="form-control " placeholder="نام و نام خانوادگی">
                                        @if($errors->has('name'))
                                            <div class="help-block">{{ $errors->first('name') }}</div>
                                        @endif
                                    </div>

                                </div>
                            </div>

                            <div class="form-group col-sm-12{{ ($errors->has('email') ? ' has-error' : '') }}">
                                <div class="col-sm-2 col-md-2">
                                    <i class="fa fa-envelope"></i>
                                    ایمیل:
                                </div>
                                <div class="col-sm-10 col-md-10">
                                    <input type="text" name="email" value="{{old('email')}}" class="form-control " placeholder="ایمیل">
                                    @if($errors->has('email'))
                                        <div class="help-block">{{ $errors->first('email') }}</div>
                                    @endif
                                </div>
                            </div>

                            <div class="form-group col-sm-12{{ ($errors->has('mobile') ? ' has-error' : '') }}">
                                <div class="col-sm-2 col-md-2">
                                    <i class="fa fa-mobile"></i>
                                    موبایل:
                                </div>
                                <div class="col-sm-10 col-md-10">
                                    <input type="text" name="mobile" value="{{old('mobile')}}" class="form-control " placeholder="شماره موبایل">
                                    @if($errors->has('mobile'))
                                        <div class="help-block">{{ $errors->first('subject') }}</div>
                                    @endif
                                </div>

                            </div>

                        </div>

                        <!-- Row # 2 -->
                        <div class="row RegisterCode">

                            <div class="form-group col-sm-12{{ ($errors->has('password') ? ' has-error' : '') }}">
                                <div class="col-sm-2 col-md-2">
                                    <i class="fa fa-key"></i>
                                    رمز عبور:
                                </div>
                                <div class="col-sm-10 col-md-10">
                                    <input type="password" name="password"  class="form-control " placeholder="رمز عبور">
                                    @if($errors->has('password'))
                                        <div class="help-block">{{ $errors->first('password') }}</div>
                                    @endif
                                </div>

                            </div>
                        </div>


                        <div class="row Company">

                            <div class="form-group RegisterCode col-sm-12{{ ($errors->has('company_name') ? ' has-error' : '') }}">
                                <div class="col-sm-2 col-md-2">
                                    <i class="fa fa-building"></i>نام بنگاه:
                                </div>

                                <div class="col-sm-10 col-md-10">
                                    <input type="text" name="company_name" value="{{old('company_name')}}" class="form-control " placeholder="نام بنگاه">
                                    @if($errors->has('company_name'))
                                        <div class="help-block">{{ $errors->first('company_name') }}</div>
                                    @endif
                                </div>
                            </div>

                            <div class="form-group RegisterCode col-sm-12{{ ($errors->has('company_phone') ? ' has-error' : '') }}">
                                <div class="col-sm-2 col-md-2">
                                    <i class="fa fa-phone"></i>
                                    شماره تماس بنگاه :
                                </div>
                                <div class="col-sm-10 col-md-10">
                                    <input type="text" name="company_phone" value="{{old('company_phone')}}" class="form-control " placeholder="شماره تماس">
                                    @if($errors->has('company_phone'))
                                        <div class="help-block">{{ $errors->first('company_phone') }}</div>
                                    @endif
                                </div>
                            </div>

                            <div class="form-group RegisterCode col-sm-12{{ ($errors->has('zone') ? ' has-error' : '') }}">
                                <div class="col-sm-2 col-md-2">
                                    <i class="fa fa-map-marker"></i>
                                    منطقه:
                                </div>
                                <div class="col-sm-10 col-md-10">
                                    <select name="zone" id="Zone" class="form-control">
                                        @foreach($Zone as $Item)
                                            <option value="{{$Item->id}}">{{$Item->title}}</option>
                                        @endforeach
                                    </select>
                                    @if($errors->has('zone'))
                                        <div class="help-block">{{ $errors->first('zone') }}</div>
                                    @endif
                                </div>

                            </div>

                            <div class="form-group RegisterCode col-sm-12{{ ($errors->has('district') ? ' has-error' : '') }}">
                                <div class="col-sm-2 col-md-2">
                                    <i class="fa fa-map-marker"></i>
                                    محله:
                                </div>
                                <div class="col-sm-10 col-md-10">
                                    <select name="district" id="District" class="form-control">
                                        @foreach($District as $Item)
                                            <option value="{{$Item->id}}">{{$Item->name}}</option>
                                        @endforeach
                                    </select>
                                    @if($errors->has('district'))
                                        <div class="help-block">{{ $errors->first('district') }}</div>
                                    @endif
                                </div>
                            </div>

                            <div class="form-group RegisterCode col-sm-12{{ ($errors->has('company_address') ? ' has-error' : '') }}">
                                <div class="col-sm-2 col-md-2">
                                    <i class="fa fa-map"></i>
                                    آدرس بنگاه :
                                </div>
                                <div class="col-sm-10 col-md-10">
                                    <textarea name="company_address" class="form-control " placeholder="آدرس">{{old('company_address')}}</textarea>
                                    @if($errors->has('company_address'))
                                        <div class="help-block">{{ $errors->first('company_address') }}</div>
                                    @endif
                                </div>

                            </div>

                            <div class="form-group col-sm-12{{ ($errors->has('company_address') ? ' has-error' : '') }}">
                                <div class="col-sm-2 col-md-2">
                                    <input type="checkbox" value="0" name="RegisterCode" id="RegisterCode">
                                    کد ثبت دریافت کرده ام
                                </div>
                                <div class="col-sm-10 col-md-10">
                                    <input type="text" name="register_code" class="form-control" placeholder="در صورتیکه کد ثبت نام از مدیریت سایت دریافت کرده اید، کد را در این قسمت وارد کنید">
                                </div>

                            </div>

                        </div>


                        <div class="row RegisterCode">
                            <div class="form-group col-sm-12">

                                <div class="col-sm-2 col-md-2"></div>

                                <div class="col-sm-10 col-md-10">

                                    <div class="row">
                                        <div class="col-md-4 col-sm-4">
                                            <input type="radio" name="type" value="4" checked class="user">
                                            کاربر عادی
                                        </div>
                                        <div class="col-md-3 col-sm-3">
                                            <input type="radio" name="type" value="3" @if(old('type')=='3') checked @endif class="user">
                                            مباشر
                                        </div>
                                        <div class="col-md-5 col-sm-5">
                                            <input type="radio" name="type" value="2"  @if(old('type')=='2') checked @endif id="Company">
                                            مشاور املاک
                                        </div>

                                    </div>

                                </div>


                            </div>
                        </div>


                        <div class="row">
                            <div class="col-sm-12 col-md-12 text-center">
                                <button class="btn btn-info">ثبت اطلاعات</button>
                            </div>
                        </div>



                    </div>


                </div>

            </div>

        </div>

    </form>



    @if(old('type')!='2')
        <style>
            .Company{display: none;}
        </style>
    @endif


@endsection

@section('script')
    <script type="text/javascript">
        $(document).ready(function(e){


            // all select tag render to select2
            $('select').select2({
                dir: 'rtl',
                width: '100%',
                tags: true,
                language: {
                    noResults: function () {
                        return "هیچ نتیجه ای یافت نشد.";
                    }
                }
            });



            /*
             * recaptcah
             * */

            $("body").delegate("#captcha","click",function (e) {
                e.preventDefault();

                $('.captcha-button').find('i').addClass('fa-spin');
                $.ajaxSetup({
                    headers: {
                        'X-CSRF-TOKEN': $('meta[name="_token"]').attr('content')
                    }});

                $.ajax({
                    url:'{{route('Captcha')}}',
                    type:'get',
                    success:function(data) {
                        $('.captcha-button').find('i').removeClass('fa-spin');
                        $('.captcha').html(data);
                    }
                });

            });




            /*company Information*/
            $("body").delegate("#Company",'click',function (e) {

                $(".Company").slideDown(500);

            });

            $("body").delegate(".user",'click',function (e) {

                $(".Company").slideUp(500);

            });


            //get district
            $("body").delegate("#Zone",'change',function (e) {

                var id=$(this).val();

                $.ajaxSetup({
                    headers: {
                        'X-CSRF-TOKEN': $('meta[name="_token"]').attr('content')
                    }
                });
                $.ajax({
                    url: '{{route('GetZoneDistrict')}}',
                    type: 'post',
                    data: {
                        zone: id
                    },
                    success: function (data) {
                        $("#District").html(data);

                    }
                });


            });



            $("body").delegate("#RegisterCode","click",function (e) {

                if($(this).prop("checked")==true)
                {
                    $(".RegisterCode").slideUp(1000);
                }
                else
                {
                    $(".RegisterCode").slideDown(1000);
                }

            });


        });
    </script>
@endsection
