<form action="{{route('UpdateSlideShow')}}" method="post" enctype="multipart/form-data">
    {{csrf_field()}}
    <input type="hidden" value="{{$slideShowModel->id}}" name="slideshow_id">
    <div class="row">
        <div class="col-md-6">
            <input type="text" name="title" class="form-control" value="{{$slideShowModel->title}}">
        </div>
        <div class="col-md-6">
            <input type="text" name="link" class="form-control" value="{{$slideShowModel->link}}">
        </div>
    </div>
    <br />
    <div class="row">
        <div class="col-md-6">
            <div class="form-group">
                <label>استان</label><span style="font-size: 18px;" class="text-danger">*</span>
                <select name="province_id" id="SelectProvince" class="form-control SelectProvince">
                    <option value="" hidden>انتخاب کنید</option>
                    @foreach($provinceModel as $key => $value)
                        <option value="{{$value->id}}" @if($slideShowModel->township_id != 0 && $slideShowModel->GetTownship->province_id == $value->id) selected @endif>{{ $value->name }}</option>
                    @endforeach
                </select>
            </div>
        </div>
        <div class="col-md-6">
            <div class="form-group">
                <label>شهرستان</label><span style="font-size: 18px;" class="text-danger">*</span>
                <select name="township_id" id="SelectTownship" class="form-control SelectTownship">
                    <option value="" hidden>انتخاب کنید</option>
                    @foreach($townshipModel as $key => $value)
                        <option value="{{$value->id}}" @if($value->id == $slideShowModel->township_id) selected @endif>{{ $value->name }}</option>
                    @endforeach
                </select>
            </div>
        </div>
    </div>
    <br />
    <div class="row">
        <div class="col-md-6">
            <input type="file" name="img" multiple>
        </div>
        <div class="col-md-6">
            <button type="submit" class="btn btn-block btn-info">
                به روز رسانی
            </button>
        </div>
    </div>
</form>