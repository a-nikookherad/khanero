<form role="form" action="{{ route('UpdatePositionType') }}" method="post" enctype="multipart/form-data" id="FormUpdate">
    {{ csrf_field() }}
    <input type="hidden" name="positionType_id" value="{{ $positionTypeModel->id }}" />
    <input type="text" name="name" value="{{ $positionTypeModel->name }}" class="form-control" />
    <br />
    <input type="submit" class="btn btn-primary btn-block" value="ثبت ویرایش" />

</form>