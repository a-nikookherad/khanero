<form action="{{route('SpecialDelete')}}" method="post">
    {{csrf_field()}}
    <input type="hidden" value="{{$specialModel->id}}" name="special_id" />
    <div class="row">
        <div class="col-md-12">
            <div class="form-group">
                <h4>آیا از حذف این تاریخ مطمئن هستید ؟</h4>
            </div>
        </div>
    </div>
    <br />
    <div class="row">
        <div class="col-md-6">
            <div class="form-group">
                <button type="submit" class="btn btn-block btn-danger">حذف</button>
            </div>
        </div>
        <div class="col-md-6">
            <div class="form-group">
                <button type="button" class="btn btn-block btn-default" data-dismiss="modal">انصراف</button>
            </div>
        </div>
    </div>

</form>