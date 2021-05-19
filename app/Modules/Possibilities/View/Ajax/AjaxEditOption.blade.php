<form role="form" action="{{ route('UpdateOption') }}" method="post" enctype="multipart/form-data" id="FormUpdate">
    {{ csrf_field() }}
    <input type="hidden" name="option_id" value="{{ $optionModel->id }}" />
    <div class="row">
        <div class="form-group">
            <div class="col-md-6">
                <input type="text" name="name" placeholder="نام امکانات" value="{{ $optionModel->name }}" class="form-control" />
            </div>
            <div class="col-md-3">
                <input type="text" name="priority" placeholder="اولویت" value="{{ $optionModel->priority }}" class="form-control" />
            </div>
            <div class="col-md-3">
            <span class="btn btn-primary btn-block btn-file">
                انتخاب کنید ...
                <input type="file" name="file" value="{{ old('file') }}" dir="rtl" id="InputFileImg" />
            </span>
            </div>
        </div>
    </div>
    <br />
    <div class="row">
        <div class="form-group">
            <div class="col-md-12">
                <input type="text" name="description" placeholder="توضیحات" value="{{ $optionModel->description }}" class="form-control" />
            </div>
        </div>
    </div>
    <br />
    <div class="row">
        <div class="col-md-12">
            <input type="submit" class="btn btn-primary btn-block" value="ثبت ویرایش" />
        </div>
    </div>

</form>