
<style>
    .img-detail {
        width: 100%;
        border-radius: 5px;
    }
</style>
<div class="row">
    <div class="col-md-6">
        <div class="row">
            <div class="col-md-6">
                <div class="form-group">
                    <label>
                        نام اقامتگاه :
                    </label>
                </div>
            </div>
            <div class="col-md-6">
                <div class="form-group">
                    <label>
                        <a href="{{route('DetailHost', ['id' => $hostModel->id])}}" target="_blank">{{$hostModel->name}}</a>
                    </label>
                </div>
            </div>
        </div>
        <div class="row">
            <div class="col-md-6">
                <div class="form-group">
                    <label>
                        نام مالک :
                    </label>
                </div>
            </div>
            <div class="col-md-6">
                <div class="form-group">
                    <label>
                        {{$hostModel->getUser->first_name.' '.$hostModel->getUser->last_name}}
                    </label>
                </div>
            </div>
        </div>
    </div>
    <div class="col-md-6">
        <div class="row">
            <div class="col-md-12">
                <div class="form-group">
                    <img class="img-detail" src="{{asset('Uploaded/Gallery/Img').'/'.$hostModel->getGallery[0]->img}}"/>
                </div>
            </div>
        </div>
    </div>
</div>