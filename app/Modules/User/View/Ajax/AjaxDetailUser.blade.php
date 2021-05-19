
<div class="row">
    <div class="col-md-6">
        <div class="row">
            <div class="col-md-6"><label> نام کاربر : </label></div>
            <div class="col-md-6"> {{$userModel->first_name}} - {{$userModel->last_name}} </div>
        </div>
        <br />
        <div class="row">
            <div class="col-md-6"> <label>شماره موبایل :</label>  </div>
            <div class="col-md-6">  {{$userModel->mobile}} </div>
        </div>
    </div>
    <div class="col-md-6">
        <div class="col-md-6"><img src="{{asset('Uploaded/User').'/'.$userModel->avatar}}" alt=""></div>
    </div>
</div>
<br />
<div class="row">
    <div class="col-md-12">
        <div class="row">
            <div class="col-md-3"> <label>آدرس :</label>  </div>
            <div class="col-md-9">  {{$userModel->address}} </div>
        </div>
    </div>
</div>