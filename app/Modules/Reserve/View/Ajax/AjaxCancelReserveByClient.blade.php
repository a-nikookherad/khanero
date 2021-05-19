@if($result['status'] == 2)
    <form action="{{route('DeleteReserveByClient')}}" method="post">
        {{csrf_field()}}
        {{--@php(dd($reserveModel))--}}
        <input type="hidden" value="{{$code}}" name="group_code" />
        {{--@php--}}
        {{--dd($result);--}}
        {{--@endphp--}}
        <div class="row">
            <div class="col-md-12">
                <div class="form-group">
                    <h5>آیا از حذف مطمئن هستید ؟</h5>
                </div>
            </div>
        </div>
        <div class="row">
            <div class="col-md-6">
                <div class="form-group">
                    <h6> مبلغ کل رزرو : {{number_format($result['total'])}} تومان </h6>
                </div>
            </div>
            <div class="col-md-6">
                <div class="form-group">
                    <h6> مبلغ پرداخت شده : {{number_format($result['paid'])}} تومان </h6>
                </div>
            </div>
        </div>
        <div class="row">
            <div class="col-md-6">
                <div class="form-group">
                    <h6> درصد سایت + دعوت از دوستان : {{number_format($result['site_percent'])}} تومان </h6>
                </div>
            </div>
            <div class="col-md-6">
                <div class="form-group">
                    <h6> مبلغ جریمه : {{number_format($result['penalty'])}} تومان </h6>
                </div>
            </div>
        </div>
        <div class="row">
            <div class="col-md-6">
                <div class="form-group">
                    <h6> مبلغ کل جریمه : {{number_format($result['site_percent']+$result['penalty'])}} تومان </h6>
                </div>
            </div>
        </div>
        <div class="row">
            <div class="col-md-6">
                <div class="form-group">
                    <h5 class="text-green"> مبلغ بازگشتی : {{number_format($result['final'])}} تومان </h5>
                </div>
            </div>
        </div>
        <div class="row">
            <div class="col-md-12">
                <div class="form-group">
                    <h6>قوانین {{$result['cancel_rule']['name']}} :</h6>
                </div>
            </div>
            <div class="col-md-12">
                <div class="form-group">
                    <h6>{{$result['cancel_rule']['time'][1]['description']}}</h6>
                    <h6>{{$result['cancel_rule']['time'][2]['description']}}</h6>
                    <h6>{{$result['cancel_rule']['time'][3]['description']}}</h6>
                </div>
            </div>
        </div>
        <br />
        <div class="row">
            <div class="col-md-6">
                <div class="form-group">
                    <button type="submit" class="btn btn-block btn-danger input-sm">انصراف از رزرو</button>
                </div>
            </div>
            <div class="col-md-6">
                <div class="form-group">
                    <button type="button" class="btn btn-block btn-default input-sm" data-dismiss="modal">انصراف</button>
                </div>
            </div>
        </div>
    
    </form>
@elseif($result['status'] == -2)
    <div class="alert alert-warning">
        <p>در خواست شما برای انصراف قبلا در سیستم ثبت شده است.</p>
    </div>
@elseif($result['status'] == 400)
    <div class="alert alert-info">
        <p>دسترسی به انصراف با توجه به زمان رزرو بسته شده است.</p>
    </div>
@else
    <form action="{{route('DeleteReserveByClient')}}" method="post">
        {{csrf_field()}}
        <input type="hidden" value="{{$code}}" name="group_code" />
        <div class="row">
            <div class="col-md-12">
                <div class="alert alert-warning">
                    <p>آیا از لغو درخواست خود اطمینان دارید؟</p>
                </div>
            </div>
            <div class="col-md-6">
                <div class="form-group">
                    <button type="submit" class="btn btn-block btn-danger input-sm">بله</button>
                </div>
            </div>
            <div class="col-md-6">
                <div class="form-group">
                    <button type="button" class="btn btn-block btn-default input-sm" data-dismiss="modal">خیر</button>
                </div>
            </div>
        </div>
    </form>
@endif