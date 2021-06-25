@php
    $optionModel = App\Modules\Possibilities\Controllers\PossibilitiesController::GetOption();
    $serviceModel = App\Modules\Possibilities\Controllers\PossibilitiesController::GetService();
@endphp

<div class="Titl-step-S rows-address row">
    <div class="col-md-2 each-step register"><div class="Numbr-Step">1</div><span class="after-finish"><i class="far fa-check"></i></span><div class="poly"><a href="{{route('CreateHostStep', ['id' => $hostModel->id, 'step' => 0])}}">مشخصات اقامتگاه</a></div></div>
    <div class="col-md-2 each-step register"><div class="Numbr-Step">2</div><span class="after-finish"><i class="far fa-check"></i></span><div class="poly"><a href="{{route('CreateHostStep', ['id' => $hostModel->id, 'step' => 1])}}">موقعیت</a></div></div>
    <div class="col-md-2 each-step active"><div class="Numbr-Step">3</div><div class="poly">امکانات و خدمات</div></div>
    <div class="col-md-2 each-step"><div class="Numbr-Step">4</div><div class="poly">تصاویر</div></div>
    <div class="col-md-2 each-step"><div class="Numbr-Step">5</div><div class="poly">قوانین صاحبخانه</div></div>
    <div class="col-md-2 each-step"><div class="Numbr-Step">6</div><div class="poly">قیمت گذاری</div></div>
</div>
<div class="Body-step-S">
    <div class="panel-heading"><h3 class="panel-title">امکانات<span class="information-step"><i class="fas fa-info-circle"></i></span></h3></div>
    @php
        $g = $hostModel->getHostPossibilities;
        $arr = [];
        $arrval = [];
        foreach ($g as $key => $value) {
            $arr[] = $value->option_id;
            $arrval[$value->option_id] = $value->description;
        }
    @endphp
    <div class="panel-body row">
        @php($counter = 0)
        <div class="col-md-12">
            <div class="row line-height-35">
                <div class="col-md-12"><h4 class="some-title">امکانات اقامتگاه</h4></div>
                @foreach($optionModel as $key => $value)
                    @if($counter == 2)
                        @php($counter = 0)

                @endif
                <div class="each-item col-md-4 rows row">
                    <div class="col-md-3 text-right each-option-1">
                        <input type="checkbox" value="{{$value->id}}" @if(in_array($value->id, $arr)) checked @endif class="chk check-description" data-value="{{$key+1}}" id="slideThree{{$key+1}}" name="check{{$key+1}}" />
                        <span class="checkmark"></span>
                        <label class="title-S m-0" title="{{$value->description}}" for="slideThree{{$key+1}}">{{$value->name}}</label>
                    </div>
                    <div class="col-md-9">
                        <input type="text" class="each-Qt form-control @if(!in_array($value->id, $arr)) none @endif description input{{$key+1}}" name="" id="" placeholder="{{$value->description. ' ' . $value->name}}" @if(in_array($value->id, $arr)) value="{!! $arrval[$value->id] !!}" @endif />
                    </div>
                </div>
                @php($counter++)
                @endforeach
            </div>
            <hr />
            @php($counter = 0)
            <div class="row line-height-35">
                <div class="col-md-12"><h4 class="some-title">خدمات و موارد بهداشتی</h4></div>
                @foreach($serviceModel as $key => $value)
                    @if($counter == 2)
                        @php($counter = 0)
                    @endif
                    <div class="each-item col-md-6 rows row">
                        <div class="col-md-3 text-right each-option-1">
                            <input type="checkbox" value="{{$value->id}}" @if(in_array($value->id, $arr)) checked @endif  class="chk check-description" data-value="{{$key+1}}" id="slideThree_{{$key+1}}" name="check{{$key+1}}" />
                            <span class="checkmark"></span>
                            <label class="title-S m-0" title="{{$value->description}}" for="slideThree_{{$key+1}}">{{$value->name}}</label>
                        </div>
                        <div class="col-md-9">
                            <input type="text" class="each-Qt form-control @if(!in_array($value->id, $arr)) none @endif  description input{{$key+1}}" name="" id="" placeholder="{{$value->description}}" @if(in_array($value->id, $arr)) value="{!! $arrval[$value->id] !!}" @endif  />
                        </div>
                    </div>
                    @php($counter++)
                @endforeach
            </div>
        </div>
{{--    <div class="col-md-4">--}}
{{--                        <div class="box-information">--}}
{{--                            <p class="title-info">--}}
{{--                                امکانات--}}
{{--                            </p>--}}
{{--                            <p>--}}
{{--                                لورم ایپسوم متن ساختگی با تولید سادگی نامفهوم از صنعت چاپ و با استفاده از طراحان گرافیک است چاپگرها و متون بلکه روزنامه و مجله در ستون و سطرآنچنان که لازم است و برای شرایط فعلی تکنولوژی مورد نیاز و کاربردهای متنوع با هدف بهبود ابزارهای کاربردی می باشد کتابهای زیادی در شصت و سه درصد گذشته حال و آینده شناخت فراوان جامعه و متخصصان را می طلبد تا با نرم افزارها شناخت بیشتری را برای طراحان رایانه ای علی الخصوص طراحان خلاقی و فرهنگ پیشرو در زبان فارسی ایجاد کرد--}}
{{--                            </p>--}}
{{--                            <p class="title-info">--}}
{{--                                خدمات--}}
{{--                            </p>--}}
{{--                            <p>--}}
{{--                                در این صورت می توان امید داشت که تمام و دشواری موجود در ارائه راهکارها و شرایط سخت تایپ به پایان رسد و زمان مورد نیاز شامل حروفچینی دستاوردهای اصلی و جوابگوی سوالات پیوسته اهل دنیای موجود طراحی اساسا مورد استفاده قرار گیرد. و جوابگوی سوالات پیوسته اهل دنیای موجود طراحی اساسا مورد استفاده قرار گیرد. و جوابگوی سوالات پیوسته اهل دنیای موجود طراحی اساسا مورد استفاده قرار گیرد.--}}
{{--                            </p>--}}
{{--                        </div>--}}
{{--                    </div>--}}
        <div class="col-md-12 row line-height-35"></div>
        <div class="col-md-12 row btn-footer">
                    <div class="col-md-6 text-right">
                        <a href="{{route('CreateHostStep', ['id' => $hostModel->id, 'step' => 1])}}" class="prv-btn btn btn-default btn-block"> <i class="fa fa-angle-right"></i><i class="fa fa-angle-right"></i> مرحله قبلی </a>
                    </div>
                    <div class="col-md-6 text-left">
                        <button type="button" id="step3" class="nxt-btn btn btn-default BtnRegAll btn-block">&nbsp; بعدی  <i class="fa fa-angle-left"></i><i class="fa fa-angle-left"></i></button>
                    </div>
                </div>
    </div>
</div>

<script>

    /* Get the checkboxes values based on the class attached to each check box */
    $('#step3').click(function () {
        $(".box-loading-step").fadeIn("slow", function() {
            $(this).show();
        });
        var chkArray = [];
        var descriptionArray = [];
        /* look for all checkboes that have a class 'chk' attached to it and check if it was checked */
        $(".chk:checked").each(function() {
            var description = $(this).parent().parent().find('.description');
            chkArray.push($(this).val());
            descriptionArray.push(description.val());
        });
        /* we join the array separated by the comma */
        var selected;
        var description;
        selected = chkArray.join(',') ;
        description = descriptionArray.join(',') ;

        // alert(selected);
        /* check if there is selected checkboxes, by default the length is 1 as it contains one single comma */
        if(selected.length > 0){
            var formData = new FormData();
            formData.append('host_id', $('#host_id').val());
            formData.append('select_array', selected);
            formData.append('description_array', description);
            $.ajaxSetup({
                headers: {
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                }
            });
            $.ajax({
                url: '{{route('StoreHostStep3')}}',
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
                    }
                    else {
                        $(".box-loading-step").fadeOut("slow", function () {
                            $('.box-loading-step').hide();
                        });
                        $('#ExtraFormHost').html(data.Message.original);
                    }
                }
            });
        }else{
            $('#myModal').modal('show');
            $('#MsgErrorStep').text('حداقل انتخاب یکی از فیلد های زیر اجباری میباشد');
            $(".box-loading-step").fadeOut("slow", function() {
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

    $('.check-description').click(function () {
        var key = $(this).attr('data-value');
        var input = $(this).parent().parent().parent().find('.input'+key);
        console.log(input);
        console.log(input.hasClass( "show" ));
        // if(!input.hasClass( "show" )){
            input.toggleClass('show');
        // }

    });
</script>

