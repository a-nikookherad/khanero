<style>
    span.star_big {
        cursor: pointer;
    }
</style>

<form action="{{ route('StoreRate') }}" method="post">
    {{ csrf_field() }}
    <input type="hidden" name="reserve_id" value="{{ $reserveModel->id }}" />
    <div class="row ">
        <div class="col-md-7">
            <div class="form-group">
                <label>محیط اطراف</label>
            </div>
        </div>
        <div class="col-md-5 text-center">
            <span class="event_star1 star_big" data-starnum="1">
                <i></i>
            </span>
        </div>
    </div>
    <input type="hidden" id="rateStar1" name="rate1" value="1" />
    <div class="row ">
        <div class="col-md-7">
            <div class="form-group">
                <label>سهولت دسترسی</label>
            </div>
        </div>
        <div class="col-md-5 text-center">
            <span class="event_star2 star_big" data-starnum="1">
                <i></i>
            </span>
        </div>
    </div>
    <input type="hidden" id="rateStar2" name="rate2" value="1" />
    <div class="row ">
        <div class="col-md-7">
            <div class="form-group">
                <label>نظافت</label>
            </div>
        </div>
        <div class="col-md-5 text-center">
            <span class="event_star3 star_big" data-starnum="1">
                <i></i>
            </span>
        </div>
    </div>
    <input type="hidden" id="rateStar3" name="rate3" value="1" />
    <div class="row ">
        <div class="col-md-7">
            <div class="form-group">
                <label>ارزش نسبت به قیمت</label>
            </div>
        </div>
        <div class="col-md-5 text-center">
            <span class="event_star4 star_big" data-starnum="1">
                <i></i>
            </span>
        </div>
    </div>
    <input type="hidden" id="rateStar4" name="rate4" value="1" />
    <div class="row ">
        <div class="col-md-7">
            <div class="form-group">
                <label>کیفیت میزبانی</label>
            </div>
        </div>
        <div class="col-md-5 text-center">
            <span class="event_star5 star_big" data-starnum="1">
                <i></i>
            </span>
        </div>
    </div>
    <input type="hidden" id="rateStar5" name="rate5" value="1" />
    <div class="row">
        <div class="col-md-12">
            <div class="form-group">
                <textarea class="form-control" name="comment" placeholder="نظر خود درباره این اقامتگاه چیست؟"></textarea>
            </div>
        </div>
    </div>
    <div class="row">
        <div class="col-md-12">
            <button type="submit" class="btn btn-default btn-block">ثبت امتیاز</button>
        </div>
    </div>
</form>
<script>
    $('.event_star1').voteStar({
        callback: function(starObj, starNum){
            $('#rateStar1').val(starNum);
        }
    });
    $('.event_star2').voteStar({
        callback: function(starObj, starNum){
            $('#rateStar2').val(starNum);
        }
    });
    $('.event_star3').voteStar({
        callback: function(starObj, starNum){
            $('#rateStar3').val(starNum);
        }
    });
    $('.event_star4').voteStar({
        callback: function(starObj, starNum){
            $('#rateStar4').val(starNum);
        }
    });
    $('.event_star5').voteStar({
        callback: function(starObj, starNum){
            $('#rateStar5').val(starNum);
        }
    });
</script>