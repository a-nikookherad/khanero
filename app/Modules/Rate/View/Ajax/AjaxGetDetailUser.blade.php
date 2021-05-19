
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
                        نام کاربر :
                    </label>
                </div>
            </div>
            <div class="col-md-6">
                <div class="form-group">
                    <label>
                        {{$userModel->first_name.' '.$userModel->last_name}}
                    </label>
                </div>
            </div>
        </div>
        <div class="row">
            <div class="col-md-6">
                <div class="form-group">
                    <label>
                        شماره تماس :
                    </label>
                </div>
            </div>
            <div class="col-md-6">
                <div class="form-group">
                    <label>
                        {{$userModel->mobile}}
                    </label>
                </div>
            </div>
        </div>
    </div>
    <div class="col-md-6">
        <div class="row">
            <div class="col-md-12">
                <div class="form-group">
                    <img class="img-detail" src="{{asset('Uploaded/User/Profile').'/'.$userModel->avatar}}"/>
                </div>
            </div>
        </div>
    </div>
</div>