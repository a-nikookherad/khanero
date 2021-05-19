<form role="form" action="{{ route('UpdateArea') }}" method="post" enctype="multipart/form-data" id="FormUpdateArea">
    {{ csrf_field() }}
    <input type="hidden" name="area_id" value="{{ $areaModel->id }}" />
    <input type="text" name="name" value="{{ $areaModel->name }}" class="form-control" />
    <br />
    <input type="submit" class="btn btn-primary btn-block" value="ثبت ویرایش" />
</form>