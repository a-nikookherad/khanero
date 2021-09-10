@php
    $optionModel = App\Modules\Possibilities\Controllers\PossibilitiesController::GetOption();
    $serviceModel = App\Modules\Possibilities\Controllers\PossibilitiesController::GetService();
@endphp

<style>
    .progress .bar {
        width: 35%;
        background-color: #9987c0;
    }
    .box-description .right {
        display: inline-block;
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
    .line-height-35 {
        line-height: 35px;
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
                <div class="poly active">
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
                <h3 class="panel-title">امکانات و خدمات<span class="information-step"><i class="fas fa-info-circle"></i></span></h3>
            </div>
            @php
                $g = $hostModel->getHostPossibilities;

                $arr = [];
                $arr_description = [];
                foreach ($g as $key => $value) {
                    $arr[] = $value->option_id;
                    $arr_description[] = $value->description;
                }

                $array_combine = array_combine($arr,$arr_description);

            @endphp

            <div class="panel-body">
                @php($counter = 0)
                <div class="row">
                    <div class="col-md-12">
                        <div class="row line-height-35">
                            <div class="col-md-12">
                                <h4 class="text-primary">امکانات اقامتگاه</h4>
                            </div>
                            @foreach($optionModel as $key => $value)
                                @if($counter == 2)
                                    @php($counter = 0)

                        </div>

                        <div class="row line-height-35">
                            @endif
                            <div class="col-md-6 rows">
                                <div class="row">
                                    <div class="col-md-1 text-right">
                                        <input type="checkbox" value="{{$value->id}}" @if(in_array($value->id, $arr)) checked @endif class="chk check-description" data-value="{{$key+1}}" id="slideThree{{$key+1}}" name="check{{$key+1}}" />
                                    </div>
                                    <div class="col-md-3">
                                        <label title="{{$value->description}}" for="slideThree{{$key+1}}">{{$value->name}}</label>
                                    </div>
                                    <div class="col-md-8">
                                        <input type="text" class="form-control @if(!in_array($value->id, $arr)) none @endif description input{{$key+1}}" name="" id="" value="@if(in_array($value->id, $arr)) {{ $array_combine[$value->id] }} @else @endif" />
                                    </div>
                                </div>
                            </div>
                            @php($counter++)
                            @endforeach
                        </div>
                        <hr />

                        @php($counter = 0)
                        <div class="row line-height-35">
                            <div class="col-md-12">
                                <h4 class="text-primary">خدمات و موارد بهداشتی</h4>
                            </div>
                            @foreach($serviceModel as $key => $value)
                                @if($counter == 2)
                                    @php($counter = 0)
                        </div>
                        <div class="row line-height-35">
                            @endif
                            <div class="col-md-12 rows">
                                <div class="row">
                                    <div class="col-md-1 text-right">
                                        <input type="checkbox" value="{{$value->id}}" @if(in_array($value->id, $arr)) checked @endif class="chk check-description" data-value="{{$key+1}}" id="slideThree_{{$key+1}}" name="check{{$key+1}}" />
                                    </div>
                                    <div class="col-md-3">
                                        <label title="{{$value->description}}" for="slideThree_{{$key+1}}">{{$value->name}}</label>
                                    </div>
                                    <div class="col-md-8">
                                        <input type="text" class="form-control @if(!in_array($value->id, $arr)) none @endif description input{{$key+1}}" name="" id="" value="@if(in_array($value->id, $arr)) {{ $array_combine[$value->id] }} @else @endif" />
                                    </div>
                                </div>
                            </div>
                            @php($counter++)
                            @endforeach
                        </div>
                    </div>
                </div>
                <div class="row line-height-35">

                </div>
                <br />
                <div class="row">
                    <div class="col-md-2 col-md-offset-5">
                        <button type="button" id="step3" class="btn btn-primary BtnRegAll btn-block">ثبت ویرایش</button>
                    </div>
                </div>
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
            var description = $(this).parent().parent().parent().find('.description');
            chkArray.push($(this).val());
            descriptionArray.push( description.val());
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
            formData.append('edit_host',1);
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
        input.toggleClass('show');

    });
</script>

