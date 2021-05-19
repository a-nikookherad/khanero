<div class="row">
    <div class="col-md-6">
        <div class="form-group">
            <label>
                محیط اطراف :
            </label>
        </div>
    </div>
    <div class="col-md-6 text-center">
        <div class="form-group">
            <span class="event_star star_big" data-starnum="{{$rateModel->rate1}}">
               <i></i>
            </span>
        </div>
    </div>
</div>
<div class="row">
    <div class="col-md-6">
        <div class="form-group">
            <label>
                سهولت دسترسی :
            </label>
        </div>
    </div>
    <div class="col-md-6 text-center">
        <div class="form-group">
            <span class="event_star star_big" data-starnum="{{$rateModel->rate2}}">
               <i></i>
            </span>
        </div>
    </div>
</div>
<div class="row">
    <div class="col-md-6">
        <div class="form-group">
            <label>
                نظافت :
            </label>
        </div>
    </div>
    <div class="col-md-6 text-center">
        <div class="form-group">
            <span class="event_star star_big" data-starnum="{{$rateModel->rate3}}">
               <i></i>
            </span>
        </div>
    </div>
</div>
<div class="row">
    <div class="col-md-6">
        <div class="form-group">
            <label>
                ارزش نسبت به قیمت :
            </label>
        </div>
    </div>
    <div class="col-md-6 text-center">
        <div class="form-group">
            <span class="event_star star_big" data-starnum="{{$rateModel->rate4}}">
               <i></i>
            </span>
        </div>
    </div>
</div>
<div class="row">
    <div class="col-md-6">
        <div class="form-group">
            <label>
                کیفیت میزبانی :
            </label>
        </div>
    </div>
    <div class="col-md-6 text-center">
        <div class="form-group">
            <span class="event_star star_big" data-starnum="{{$rateModel->rate5}}">
               <i></i>
            </span>
        </div>
    </div>
</div>
<hr />
<div class="row">
    <label>نظر کاربر :</label>
    <label>{{$rateModel->comment}}</label>
</div>