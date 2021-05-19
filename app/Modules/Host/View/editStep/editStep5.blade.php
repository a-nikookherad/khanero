@php($rulesModel = App\Modules\Rules\Controllers\RulesController::GetRules())

<style>
    .progress .bar {
        width: 60%;
        background-color: #bcae77;
    }
    .none {
        cursor: default;
        opacity: 0;
        transition: .2s;
    }
    .show {
        cursor: auto;
        opacity: 1;
        transition: .2s;
    }
    .row.rows {
        margin-bottom: 15px;
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
                <div class="poly">
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
                <div class="poly active">
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
                <h3 class="panel-title">قوانین صاحبخانه<span class="information-step"><i class="fas fa-info-circle"></i></span></h3>
            </div>
            @php
                $g = $hostModel->getHostRules;
                $arr = [];
                foreach ($g as $key => $value) {
                    $arr[] = $value->rule_id;
                }
            @endphp
            <div class="panel-body">
                <div class="row">
                    <div class="col-md-8">
                        @foreach($rulesModel as $key => $value)
                            <div class="row rows">
                                <div class="col-md-1">
                                    <input type="checkbox" @if(in_array($value->id, $arr)) checked @endif value="{{$value->id}}" class="chk check-description" data-value="{{$key+1}}" id="slideThree_{{$key+1}}" name="check{{$key+1}}" />
                                </div>
                                <div class="col-md-6">
                                    <label for="slideThree_{{$key+1}}">{{$value->name}}</label>
                                </div>
                                <div class="col-md-5">
                                    <input type="text" class="form-control @if(!in_array($value->id, $arr)) none @endif  description input{{$key+1}}" name="" id="" placeholder="{{$value->description}}" />
                                </div>
                            </div>
                        @endforeach
                        <hr />
                        <div class="row">
                            <div class="col-md-12">
                                <div class="form-group">
                                    <label for="InputNewRules">اضافه کردن قوانین</label>
                                    <textarea class="form-control textarea" rows="4" id="InputNewRules" placeholder="قوانین خود را وارد کنید">{{$hostModel->new_rule}}</textarea>
                                </div>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-md-3">
                                <div class="form-group">
                                    <label for="SelectTimeEnterFrom">ساعت ورود از</label>
                                    <select id="SelectTimeEnterFrom" class="form-control">
                                        @for($i = 1; $i<= 24; $i++)
                                            <option value="{{$i}}" @if($i == $hostModel->time_enter_from) selected @endif>
                                                @if($i > 0 && $i > 12)
                                                    {{$i - 12}}
                                                @else
                                                    {{$i}}
                                                @endif
                                                @if($i > 0 && $i < 12)
                                                    صبح
                                                @elseif($i == 12)
                                                    ظهر
                                                @elseif($i > 12 && $i < 18)
                                                    بعد از ظهر
                                                @elseif($i > 17 && $i < 21)
                                                    عصر
                                                @else
                                                    شب
                                                @endif
                                            </option>
                                        @endfor
                                    </select>
                                </div>
                            </div>
                            <div class="col-md-3">
                                <div class="form-group">
                                    <label for="SelectTimeEnterTo">ساعت ورود تا</label>
                                    <select id="SelectTimeEnterTo" class="form-control">
                                        <option value="0">نا محدود</option>
                                        @for($i = 1; $i<= 24; $i++)
                                            <option value="{{$i}}" @if($i == $hostModel->time_enter_to) selected @endif>
                                                @if($i > 0 && $i > 12)
                                                    {{$i - 12}}
                                                @else
                                                    {{$i}}
                                                @endif
                                                @if($i > 0 && $i < 12)
                                                    صبح
                                                @elseif($i == 12)
                                                    ظهر
                                                @elseif($i > 12 && $i < 18)
                                                    بعد از ظهر
                                                @elseif($i > 17 && $i < 21)
                                                    عصر
                                                @else
                                                    شب
                                                @endif
                                            </option>
                                        @endfor
                                    </select>
                                </div>
                            </div>
                            <div class="col-md-3">
                                <div class="form-group">
                                    <label for="SelectTimeExit">ساعت خروج</label>
                                    <select id="SelectTimeExit" class="form-control">
                                        @for($i = 1; $i<= 24; $i++)
                                            <option value="{{$i}}" @if($i == $hostModel->time_exit) selected @endif>
                                                @if($i > 0 && $i > 12)
                                                    {{$i - 12}}
                                                @else
                                                    {{$i}}
                                                @endif
                                                @if($i > 0 && $i < 12)
                                                    صبح
                                                @elseif($i == 12)
                                                    ظهر
                                                @elseif($i > 12 && $i < 18)
                                                    بعد از ظهر
                                                @elseif($i > 17 && $i < 21)
                                                    عصر
                                                @else
                                                    شب
                                                @endif
                                            </option>
                                        @endfor
                                    </select>
                                </div>
                            </div>
                            <div class="col-md-3">
                                <div class="form-group">
                                    <label for="SelectMinReserve">حداقل شب اقامت</label>
                                    <select id="SelectMinReserve" class="form-control">
                                        @for($i = 1; $i<= 10; $i++)
                                            <option value="{{$i}}" @if($i == $hostModel->min_reserve_day) selected @endif>{{$i}} روز</option>
                                        @endfor
                                    </select>
                                </div>
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
                </div>
                <br />
                <div class="row">
                    <div class="col-md-2 col-md-offset-5">
                        <button type="button" id="step5" class="btn btn-primary BtnRegAll btn-block">ثبت ویرایش</button>
                    </div>
                </div>
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
        formData.append('edit_host',1);
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
                } else if(data.Success == 1) {
                    $(".box-loading-step").fadeOut("slow", function () {
                        $('.box-loading-step').hide();
                    });
                    AlertToast('ویرایش اقامتگاه', data.Message, 'success');
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

