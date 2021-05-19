@extends('backend.MasterPage.Layout')
@section('title', TitlePage('نمایش قوانین'))
@section('style')
    <style>
        .box-rules img {
            width: 40%;
            margin: 10px auto;
        }
        .box-rules p {
            line-height: 21px;
            font-size: 12px;
            color: #444;
        }
        .text-confirm {
            font-size: 12px;
        }
        form .input-checkbox {
            width: 20px;
            margin-bottom: 15px;
        }

        .how {
            font-size: 12px;
            margin-right: 5px;
        }
    </style>
@endsection

@section('content')
    {{--<div class="row back-url">--}}
        {{--<div class="col-md-12">--}}
            {{--<a class="" href="@if(auth()->user()->role_id == 1) {{ route('AdminDashboard') }} @else {{ route('UserDashboard') }} @endif">صفحه اصلی</a>--}}
            {{--<span class="now-url"> / شروع میزبانی</span>--}}
        {{--</div>--}}
    {{--</div>--}}
    <div class="row">
        <div class="col-md-12">
            @include('message.Message')
            @include('message.ErrorReporting')
        </div>
    </div>
{{--    <div class="row">--}}
{{--        <div class="col-md-12">--}}
{{--            <div class="alert alert-info">--}}
{{--                <p>شما میتوانید برای ثبت اقامتگاه خود با واحد پشتیبانی ---- تماس بگیرید ولی اگر شرایط ثبت اقامتگاه خود را دارید مراحل زیر را انجام دهید</p>--}}
{{--            </div>--}}
{{--        </div>--}}
{{--    </div>--}}
    <div class="row">
        <div class="col-md-12">
            <div class="panel panel-default">
                <div class="panel-heading">
                    <h3 class="panel-title">قوانین میزبانی<span class="how"></span></h3>
                </div>
                <div class="panel-body">
                    <div class="row box-rules">
                        <div class="col-md-4">
                            <div class="row">
                                <img src="{{asset('frontend/images/them/rentt-1.jpg')}}" class="img-responsive" alt="">
                            </div>
                            <div class="row">
                                <h5 class="text-center">
                                    میهمانان اقامتگاه شمارا از لیست می یابند                                </h5>
                                <p>
                                    لورم ایپسوم متن ساختگی با تولید سادگی نامفهوم از صنعت چاپ، و با استفاده از طراحان گرافیک است، چاپگرها و متون بلکه روزنامه و مجله در ستون و سطرآنچنان که لازم است، و برای شرایط فعلی تکنولوژی مورد نیاز، و کاربردهای متنوع با هدف بهبود ابزارهای کاربردی می باشد، کتابهای زیادی در شصت و سه درصد گذشته حال و آینده، شناخت فراوان جامعه و متخصصان را می طلبد، تا با نرم افزارها شناخت بیشتری را برای طراحان رایانه ای علی الخصوص طراحان خلاقی، و فرهنگ پیشرو در زبان فارسی ایجاد کرد، در این صورت می توان امید داشت که تمام و دشواری موجود در ارائه راهکارها، و شرایط سخت تایپ به پایان رسد و زمان مورد نیاز شامل حروفچینی دستاوردهای اصلی، و جوابگوی سوالات پیوسته اهل دنیای موجود طراحی اساسا مورد استفاده قرار گیرد.
                                </p>
                            </div>
                        </div>
                        <div class="col-md-4">
                            <div class="row">
                                <img src="{{asset('frontend/images/them/rentt-2.jpg')}}" class="img-responsive" alt="">
                            </div>
                            <div class="row">
                                <h5 class="text-center">
                                    شما کنترل می کنید که چه کسی می تواند رزرو کند
                                </h5>
                                <p>
                                    لورم ایپسوم متن ساختگی با تولید سادگی نامفهوم از صنعت چاپ، و با استفاده از طراحان گرافیک است، چاپگرها و متون بلکه روزنامه و مجله در ستون و سطرآنچنان که لازم است، و برای شرایط فعلی تکنولوژی مورد نیاز، و کاربردهای متنوع با هدف بهبود ابزارهای کاربردی می باشد، کتابهای زیادی در شصت و سه درصد گذشته حال و آینده، شناخت فراوان جامعه و متخصصان را می طلبد، تا با نرم افزارها شناخت بیشتری را برای طراحان رایانه ای علی الخصوص طراحان خلاقی، و فرهنگ پیشرو در زبان فارسی ایجاد کرد، در این صورت می توان امید داشت که تمام و دشواری موجود در ارائه راهکارها، و شرایط سخت تایپ به پایان رسد و زمان مورد نیاز شامل حروفچینی دستاوردهای اصلی، و جوابگوی سوالات پیوسته اهل دنیای موجود طراحی اساسا مورد استفاده قرار گیرد.
                                </p>
                            </div>
                        </div>
                        <div class="col-md-4">
                            <div class="row">
                                <img src="{{asset('frontend/images/them/rentt-3.jpg')}}" class="img-responsive" alt="">
                            </div>
                            <div class="row">
                                <h5 class="text-center">
                                    تایید و پرداخت میهمان به شما اطلاع داده می شود
                                </h5>
                                <p>
                                    لورم ایپسوم متن ساختگی با تولید سادگی نامفهوم از صنعت چاپ، و با استفاده از طراحان گرافیک است، چاپگرها و متون بلکه روزنامه و مجله در ستون و سطرآنچنان که لازم است، و برای شرایط فعلی تکنولوژی مورد نیاز، و کاربردهای متنوع با هدف بهبود ابزارهای کاربردی می باشد، کتابهای زیادی در شصت و سه درصد گذشته حال و آینده، شناخت فراوان جامعه و متخصصان را می طلبد، تا با نرم افزارها شناخت بیشتری را برای طراحان رایانه ای علی الخصوص طراحان خلاقی، و فرهنگ پیشرو در زبان فارسی ایجاد کرد، در این صورت می توان امید داشت که تمام و دشواری موجود در ارائه راهکارها، و شرایط سخت تایپ به پایان رسد و زمان مورد نیاز شامل حروفچینی دستاوردهای اصلی، و جوابگوی سوالات پیوسته اهل دنیای موجود طراحی اساسا مورد استفاده قرار گیرد.
                                </p>
                            </div>
                        </div>
                    </div>

                    <hr />

                    <div class="row">
                        <div class="col-md-4 col-md-offset-4">
                            <form action="{{route('ConfirmRules')}}" method="post">
                                {{csrf_field()}}
                                <input id="InputCheckbox" type="checkbox" name="confirm" value="1" class="input-checkbox" />
                                با قوانین موافقم (<span class="text-default text-confirm">لطفا قوانین را بخوانید</span>)
                                <button id="BtnConfirmRules" type="submit" class="btn btn-default btn-block" disabled>شروع میزبانی</button>
                            </form>
                        </div>
                    </div>
                </div>

            </div>
        </div>
    </div>
@endsection

@section('script')

    <script>
        $( document ).ready(function() {
            $('#InputCheckbox').click(function () {
                if(document.getElementById('InputCheckbox').checked)
                {
                    $('#BtnConfirmRules').attr('disabled', false);
                    $('#BtnConfirmRules').addClass('btn-success');
                }
                else
                {
                    $('#BtnConfirmRules').attr('disabled', true);
                    $('#BtnConfirmRules').removeClass('btn-success');
                }
            });
        });
    </script>

@endsection

