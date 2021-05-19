<form role="form" action="{{ route('UpdateCity') }}" method="post" enctype="multipart/form-data" id="FormUpdateCity">
    {{ csrf_field() }}
    <input type="hidden" name="city_id" value="{{ $cityModel->id }}" />
    <input type="text" name="name" value="{{ $cityModel->name }}" class="form-control" />
    <br />
    <input type="submit" class="btn btn-primary btn-block" value="ثبت ویرایش" />
</form>