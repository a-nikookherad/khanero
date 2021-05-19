<form role="form" action="{{ route('UpdateDistrict') }}" method="post" enctype="multipart/form-data" id="FormUpdateDistrict">
    {{ csrf_field() }}
    <input type="hidden" name="district_id" value="{{ $districtModel->id }}" />
    <input type="text" name="name" value="{{ $districtModel->name }}" class="form-control" />
    <br />
    <input type="submit" class="btn btn-primary btn-block" value="ثبت ویرایش" />
</form>