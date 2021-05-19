
    <div class="col-md-6">
        <div class="box-rate" style="margin: 3px 0px;">
            <div class="col-md-1">
                <div style="padding: 5px 0; font-size: 18px;">
                    <i class="fa fa-times-circle" style="cursor: pointer;"></i>
                </div>
            </div>
            <div class="col-md-6">
                <input type="text" name="skill_title[]" class="form-control" placeholder="مهارت خود را وارد کنید" />
            </div>
            <div class="col-md-5">
            <span class="event_star{{$num}} star_big" data-starnum="0">
                <i><input type="hidden" name="rate[]" id="rateStar{{$num}}" value="1"/></i>
            </span>
                <script type="text/javascript">
                    $(document).ready(function () {
                        $('.event_star{{$num}}').voteStar({
                            callback: function(starObj, starNum){
                                $('#rateStar{{$num}}').val(starNum);
                            }
                        })
                    });
                </script>
            </div>
        </div>
    </div>