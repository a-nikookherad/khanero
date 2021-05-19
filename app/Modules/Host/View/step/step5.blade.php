@php($rulesModel = App\Modules\Rules\Controllers\RulesController::GetRules())

<div class="Titl-step-S rows-address row">
    <div class="col-md-2 each-step register"><div class="Numbr-Step">1</div><span class="after-finish"><i class="far fa-check"></i></span><div class="poly"><a href="{{route('CreateHostStep', ['id' => $hostModel->id, 'step' => 0])}}">مشخصات اقامتگاه</a></div></div>
    <div class="col-md-2 each-step register"><div class="Numbr-Step">2</div><span class="after-finish"><i class="far fa-check"></i></span><div class="poly"><a href="{{route('CreateHostStep', ['id' => $hostModel->id, 'step' => 1])}}">موقعیت</a></div></div>
    <div class="col-md-2 each-step register"><div class="Numbr-Step">3</div><span class="after-finish"><i class="far fa-check"></i></span><div class="poly"><a href="{{route('CreateHostStep', ['id' => $hostModel->id, 'step' => 2])}}">امکانات و خدمات</a></div></div>
    <div class="col-md-2 each-step register"><div class="Numbr-Step">4</div><span class="after-finish"><i class="far fa-check"></i></span><div class="poly"><a href="{{route('CreateHostStep', ['id' => $hostModel->id, 'step' => 3])}}">تصاویر</a></div></div>
    <div class="col-md-2 each-step active"><div class="Numbr-Step">5</div><div class="poly">قوانین صاحبخانه</div></div>
    <div class="col-md-2 each-step"><div class="Numbr-Step">6</div><div class="poly">قیمت گذاری</div></div>
</div>
<div class="Body-step-S">
    <div class="panel-heading"><h3 class="panel-title">قوانین صاحبخانه<span class="information-step"><i class="fas fa-info-circle"></i></span></h3></div>
    @php
        $g = $hostModel->getHostRules;
        $arr = [];
        foreach ($g as $key => $value) {
            $arr[] = $value->rule_id;
        }
    @endphp
    <div class="panel-body row">
        <div class="col-md-8">
                        @foreach($rulesModel as $key => $value)
                            <div class="each-item row">
                                <div class="col-md-7 each-option-1">
                                    <input type="checkbox" @if(in_array($value->id, $arr)) checked @endif value="{{$value->id}}" class="chk check-description" data-value="{{$key+1}}" id="slideThree_{{$key+1}}" name="check{{$key+1}}" />
                                    <span class="checkmark"></span>
                                    <label class="title-S" for="slideThree_{{$key+1}}">{{$value->name}}</label>
                                </div>
                                <div class="col-md-5">
                                    <input type="text" class="each-Qt form-control @if(!in_array($value->id, $arr)) none @endif  description input{{$key+1}}" name="" id="" placeholder="{{$value->description}}" />
                                </div>
                            </div>
                        @endforeach
                        <hr />
                        <div class="row">
                            <div class="each-item col-md-12">
                                    <label class="title-S" for="InputNewRules">اضافه کردن قوانین</label>
                                    <textarea class="each-Qt form-control textarea" rows="4" id="InputNewRules" placeholder="قوانین خود را وارد کنید">{{$hostModel->new_rule}}</textarea>
                            </div>
                        </div>
                        <div class="row">
                            <div class="each-item col-md-3">
                                    <label class="title-S" for="SelectTimeEnterFrom">ساعت ورود از</label>
                                    <select id="SelectTimeEnterFrom" class="each-Qt form-control">
                                        @for($i = 14; $i<= 16; $i++)
                                            <option value="{{$i}}">
                                                {{$i}}:00
                                            </option>
                                        @endfor
{{--                                        @for($i = 1; $i<= 24; $i++)--}}
{{--                                            <option value="{{$i}}" @if($i == 14) selected @endif>--}}
{{--                                                @if($i > 0 && $i > 12)--}}
{{--                                                    {{$i - 12}}--}}
{{--                                                @else--}}
{{--                                                    {{$i}}--}}
{{--                                                @endif--}}
{{--                                                @if($i > 0 && $i < 12)--}}
{{--                                                    صبح--}}
{{--                                                @elseif($i == 12)--}}
{{--                                                    ظهر--}}
{{--                                                @elseif($i > 12 && $i < 18)--}}
{{--                                                    بعد از ظهر--}}
{{--                                                @elseif($i > 17 && $i < 21)--}}
{{--                                                    عصر--}}
{{--                                                @else--}}
{{--                                                    شب--}}
{{--                                                @endif--}}
{{--                                            </option>--}}
{{--                                        @endfor--}}
                                    </select>
                            </div>
                            <div class="each-item col-md-3">
                                    <label class="title-S" for="SelectTimeEnterTo">ساعت ورود تا</label>
                                    <select id="SelectTimeEnterTo" class="each-Qt form-control">
                                        <option value="0">بدون محدودیت</option>
                                            @for($i = 21; $i<= 23; $i++)
                                                <option value="{{$i}}">
                                                    {{$i}}:00
                                                </option>
                                            @endfor
{{--                                        @for($i = 1; $i<= 24; $i++)--}}
{{--                                            <option value="{{$i}}">--}}
{{--                                                @if($i > 0 && $i > 12)--}}
{{--                                                    {{$i - 12}}--}}
{{--                                                @else--}}
{{--                                                    {{$i}}--}}
{{--                                                @endif--}}
{{--                                                @if($i > 0 && $i < 12)--}}
{{--                                                    صبح--}}
{{--                                                @elseif($i == 12)--}}
{{--                                                    ظهر--}}
{{--                                                @elseif($i > 12 && $i < 18)--}}
{{--                                                    بعد از ظهر--}}
{{--                                                @elseif($i > 17 && $i < 21)--}}
{{--                                                    عصر--}}
{{--                                                @else--}}
{{--                                                    شب--}}
{{--                                                @endif--}}
{{--                                            </option>--}}
{{--                                        @endfor--}}
                                    </select>
                            </div>
                            <div class="each-item col-md-3">
                                    <label class="title-S" for="SelectTimeExit">ساعت خروج</label>
                                    <select id="SelectTimeExit" class="each-Qt form-control">
                                        @for($i = 11; $i<= 13; $i++)
                                            <option value="{{$i}}">
                                                {{$i}}:00
                                            </option>
                                        @endfor
{{--                                        @for($i = 1; $i<= 24; $i++)--}}
{{--                                            <option value="{{$i}}" @if($i == 12) selected @endif>--}}
{{--                                                @if($i > 0 && $i > 12)--}}
{{--                                                    {{$i - 12}}--}}
{{--                                                @else--}}
{{--                                                    {{$i}}--}}
{{--                                                @endif--}}
{{--                                                @if($i > 0 && $i < 12)--}}
{{--                                                    صبح--}}
{{--                                                @elseif($i == 12)--}}
{{--                                                    ظهر--}}
{{--                                                @elseif($i > 12 && $i < 18)--}}
{{--                                                    بعد از ظهر--}}
{{--                                                @elseif($i > 17 && $i < 21)--}}
{{--                                                    عصر--}}
{{--                                                @else--}}
{{--                                                    شب--}}
{{--                                                @endif--}}
{{--                                            </option>--}}
{{--                                        @endfor--}}
                                    </select>
                            </div>
                            <div class="each-item col-md-3">
                                    <label class="title-S" for="SelectMinReserve">حداقل مدت اقامت</label>
                                    <select id="SelectMinReserve" class="each-Qt form-control">
                                        @for($i = 1; $i<= 10; $i++)
                                            <option value="{{$i}}">{{$i}} شب</option>
                                        @endfor
                                    </select>
                            </div>
                        </div>
                    </div>
        <div class="col-md-4">
                        <div class="box-information">
                            <p class="title-info">
                                قوانین صاحبخانه
                            </p>
                            <p>
                                لورم ایپسوم متن ساختگی با تولید سادگی نامفهوم از صنعت چاپ و با استفاده از طراحان گرافیک است چاپگرها و متون بلکه روزنامه و مجله در ستون و سطرآنچنان که لازم است و برای شرایط فعلی تکنولوژی مورد نیاز و کاربردهای متنوع با هدف بهبود ابزارهای کاربردی می باشد کتابهای زیادی در شصت و سه درصد گذشته حال و آینده شناخت فراوان جامعه و متخصصان را می طلبد تا با نرم افزارها شناخت بیشتری را برای طراحان رایانه ای علی الخصوص طراحان خلاقی و فرهنگ پیشرو در زبان فارسی ایجاد کرد
                            </p>
                        </div>
                    </div>
        <div class="col-md-12 row btn-footer">
            <div class="col-md-6 text-right">
                <a href="{{route('CreateHostStep', ['id' => $hostModel->id, 'step' => 3])}}" class="prv-btn btn btn-default btn-block"> <i class="fa fa-angle-right"></i><i class="fa fa-angle-right"></i> مرحله قبلی </a>
            </div>
            <div class="col-md-6 text-left">
                <button type="button" id="step5" class="nxt-btn btn btn-default BtnRegAll btn-block">&nbsp; بعدی  <i class="fa fa-angle-left"></i><i class="fa fa-angle-left"></i></button>
            </div>
        </div>
    </div>
</div>


<script>

    $('#step5').click(function () {
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

        var formData = new FormData();
        formData.append('host_id', $('#host_id').val());
        formData.append('time_enter_from', $('#SelectTimeEnterFrom').val());
        formData.append('time_enter_to', $('#SelectTimeEnterTo').val());
        formData.append('time_exit', $('#SelectTimeExit').val());
        formData.append('min_reserve', $('#SelectMinReserve').val());
        formData.append('new_rule', $('#InputNewRules').val());
        formData.append('select_array', selected);
        formData.append('description_array', description);
        $.ajaxSetup({
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            }
        });
        $.ajax({
            url: '{{route('StoreHostStep5')}}',
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
        input.toggleClass('show');
    });

</script>

