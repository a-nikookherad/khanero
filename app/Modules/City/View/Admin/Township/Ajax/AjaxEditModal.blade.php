<form role="form" action="{{ route('UpdateTownship') }}" method="post" enctype="multipart/form-data" id="FormUpdateTownship">
    {{ csrf_field() }}
    <input type="hidden" name="township_id" value="{{ $townshipModel->id }}" />
    <div class="row">
        <div class="col-md-12">
            <label for="InputName">نام شهر</label>
            <input type="text" id="InputName" name="name" value="{{ $townshipModel->name }}" class="form-control" />
        </div>
    </div>
    <br />
    <div class="row">
        <div class="col-md-12">
            <label for="InputPriority">اولویت</label>
            <input type="text" id="InputPriority" name="priority" value="{{ $townshipModel->priority }}" class="form-control" />
        </div>
    </div>
    <br />
    <input type="submit" class="btn btn-primary btn-block" value="ثبت ویرایش" />

</form>