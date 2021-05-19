<div class="col-md-12">
    {{--<p>قیمت گذاری به دو بخش وسط هفته و آخر هفته تقسیم بندی می شود .</p>--}}
    {{--<br />--}}
    <div class="row">
        <div class="col-md-2">
            <label for="InputPriceFirstWeek">قیمت وسط هفته</label>
        </div>
        <div class="col-md-4">
            <div class="form-group">
                <input type="text" class="form-control" onkeyup="Seprator(this);" id="InputPriceFirstWeek" name="" placeholder="از شنبه تا سه شنبه" />تومان
            </div>
        </div>
    </div>
    <div class="row">
        <div class="col-md-2">
            <label for="InputPriceLastWeek">قیمت آخر هفته</label>
        </div>
        <div class="col-md-4">
            <div class="form-group">
                <input type="text" class="form-control" onkeyup="Seprator(this);" id="InputPriceLastWeek" name="" placeholder="از چهارشنبه تا جمعه" />تومان
            </div>
        </div>
    </div>
</div>
<hr />