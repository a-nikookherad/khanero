<form role="form" action="{{ route('UpdateHomeType') }}" method="post" enctype="multipart/form-data" id="FormUpdate">
    {{ csrf_field() }}
    <input type="hidden" name="homeType_id" value="{{ $homeTypeModel->id }}" />
    <input type="text" name="name" value="{{ $homeTypeModel->name }}" class="form-control" />
    <br />
    <input type="submit" class="btn btn-primary btn-block" value="ثبت ویرایش" />

</form>