<form role="form" action="{{ route('UpdateBuildingType') }}" method="post" enctype="multipart/form-data" id="FormUpdate">
    {{ csrf_field() }}
    <input type="hidden" name="buildingType_id" value="{{ $buildingTypeModel->id }}" />
    <input type="text" name="name" value="{{ $buildingTypeModel->name }}" class="form-control" />
    <br />
    <input type="submit" class="btn btn-primary btn-block" value="ثبت ویرایش" />

</form>