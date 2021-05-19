<form action="{{route('UpdateDiscount')}}" method="post">
    {{csrf_field()}}
    <input type="hidden" value="{{$discountModel->id}}" name="discount_id" />
    <div class="row">
        <div class="col-md-6">
            <div class="form-group">
                <label for="InputNumberDays">تعداد روز</label>
                <input type="text" class="form-control" value="{{ $discountModel->number_days }}" id="InputNumberDays" name="number_days" placeholder="تعداد روز را وارد کنید" />
            </div>
        </div>
        <div class="col-md-6">
            <div class="form-group">
                <label for="InputPercent">درصد تخفیف</label>
                <input type="text" class="form-control" value="{{ $discountModel->percent }}" id="InputPercent" name="percent" placeholder="میزان تخفیف را وارد کنید" />
            </div>
        </div>
    </div>
    <div class="row">
        <div class="col-md-12">
            <div class="form-group">
                <input type="submit" class="btn btn-block btn-info" value="ثبت تغییرات" />
            </div>
        </div>
    </div>

</form>