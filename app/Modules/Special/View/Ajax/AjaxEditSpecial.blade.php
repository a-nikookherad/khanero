<form action="{{route('UpdateSpecial')}}" method="post">
    {{csrf_field()}}
    <input type="hidden" value="{{$specialModel->id}}" name="special_id" />
    <div class="row">
        <div class="col-md-12">
            <div class="form-group">
                <label for="InputPrice">قیمت</label>
                <input type="text" class="form-control" value="{{ $specialModel->price }}" id="InputPrice" name="price" placeholder="قیمت را وارد کنید" />
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