<?php ($positionTypeModel = App\Modules\Possibilities\Controllers\PossibilitiesController::GetPositionType()); ?>

    <style>
        input#Latitude,
        input#Longitude {
            height: 0px;
            width: 0px;
            opacity: 0;
        }
    </style>
    <div class="panel-body">
        <div class="row">
            <div class="col-md-3">
                <div class="form-group">
                    <label>استان</label><span style="font-size: 18px;" class="text-danger">*</span>
                    <select name="province_id" id="SelectProvince" class="form-control SelectProvince">
                        <option value="" hidden>انتخاب کنید</option>
                        <?php $__currentLoopData = $provinceModel; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $key => $value): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                            <option value="<?php echo e($value->id); ?>" <?php if($hostModel->province_id == $value->id): ?> selected <?php endif; ?>><?php echo e($value->name); ?></option>
                        <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                    </select>
                </div>
            </div>
            <div class="col-md-3">
                <div class="form-group">
                    <label>شهرستان</label><span style="font-size: 18px;" class="text-danger">*</span>
                    <select name="township_id" id="SelectTownship" class="form-control SelectTownship">
                        <option value="" hidden>انتخاب کنید</option>
                        <?php $__currentLoopData = $townshipModel; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $key => $value): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                            <option value="<?php echo e($value->id); ?>" <?php if($value->id == $hostModel->township_id): ?> selected <?php endif; ?>><?php echo e($value->name); ?></option>
                        <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                    </select>
                </div>
            </div>
            <div class="col-md-6">
                <div class="form-group">
                    <label for="InputDistrict">محله</label><span style="font-size: 18px;"
                                                                 class="text-danger">*</span>
                    <input type="text" class="form-control" value="<?php echo e($hostModel->district); ?>" name="district" id="InputDistrict"
                           placeholder="نام محله را وارد کنید"/>
                </div>
            </div>
        </div>
        <div class="row">
            <div class="col-md-12">
                <div class="form-group">
                    <label for="InputAddress">آدرس</label><span style="font-size: 18px;"
                                                                class="text-danger">*</span>
                    <input type="text" class="form-control" value="<?php echo e($hostModel->address); ?>" name="address" id="InputAddress"
                           placeholder="آدرس محل را وارد کنید">
                </div>
            </div>
        </div>
        <div class="row">
            <div class="col-md-12">
                <div class="form-group">
                    <label>موقعیت </label><span style="font-size: 18px;" class="text-danger">*</span>(حداقل یک مورد را انتخاب کنید)
                    <div class="row">
                        <?php $__currentLoopData = $positionTypeModel; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $key => $value): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                            <div class="col-md-2">
                                <?php if(in_array($value->id,unserialize($hostModel->position_array))): ?>
                                    <input id="InputCheckBox<?php echo e($key+1); ?>" class="chk" type="checkbox" value="<?php echo e($value->id); ?>" checked /><label for="InputCheckBox<?php echo e($key+1); ?>"><?php echo e($value->name); ?></label>
                                <?php else: ?>
                                    <input id="InputCheckBox<?php echo e($key+1); ?>" class="chk" type="checkbox" value="<?php echo e($value->id); ?>" /><label for="InputCheckBox<?php echo e($key+1); ?>"><?php echo e($value->name); ?></label>
                                <?php endif; ?>
                            </div>
                        <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                    </div>
                </div>
            </div>
        </div>

































        <div class="row">
            <div class="col-md-12">
                <p>موقعیت خود را روی نقشه انتخاب کنید(پین آبی را حرکت دهید)</p>
            </div>
        </div>
        <div class="row">
            <div class="col-md-12">
                <div id="mapid" style="width: 100%; height: 400px;"></div>
            </div>
        </div>
        <div class="row">
            <section class="col col-3">
                <label class="input">
                    <input id="Latitude" placeholder="Latitude" value="<?php echo e($hostModel->latitude); ?>" name="latitude" />
                    
                    
                </label>
            </section>
            <section class="col col-3">
                <label class="input">
                    <input id="Longitude" placeholder="Longitude" value="<?php echo e($hostModel->longitude); ?>" name="longitude" />
                    
                    
                </label>
            </section>
        </div>
    </div>

    <div class="row">
        <div class="col-md-3 col-md-offset-3">
            <button type="button" id="BtnEdit" class="btn btn-default  btn-block">ثبت ویرایش</button>
        </div>
        <div class="col-md-3">
            <button type="button" id="BtnCancelUpdate" class="btn btn-default btn-block" data-dismiss="modal">انصراف</button>
        </div>
    </div>
    <br />
<script src="<?php echo e(asset('backend/js/leaflet.js')); ?>"
        integrity="sha512-QVftwZFqvtRNi0ZyCtsznlKSWOStnDORoefr1enyq5mVL4tmKB3S/EnC3rRJcxCPavG10IcrVGSmPh6Qw5lwrg=="
        crossorigin=""></script>


<!-- search -->
<script>
    // var input = document.getElementById('autocomplete');
    // var autocomplete = new google.maps.places.Autocomplete(input);
    //
    // var input = document.getElementById('autocomplete1');
    // var autocomplete = new google.maps.places.Autocomplete(input);

    $(function() {
        // use below if you want to specify the path for leaflet's images
        //L.Icon.Default.imagePath = '@Url.Content("~/Content/img/leaflet")';

        var curLocation = [0, 0];
        // use below if you have a model
        // var curLocation = [@Model.Location.Latitude, @Model.Location.Longitude];

        if (curLocation[0] == 0 && curLocation[1] == 0) {
            curLocation = [<?php echo e($hostModel->latitude); ?>, <?php echo e($hostModel->longitude); ?>];
        }

        var map = L.map('mapid').setView(curLocation, 10);

        L.tileLayer('http://{s}.tile.osm.org/{z}/{x}/{y}.png', {
            attribution: '&copy; <a href="http://osm.org/copyright">OpenStreetMap</a> contributors'
        }).addTo(map);

        map.attributionControl.setPrefix(false);

        var marker = new L.marker(curLocation, {
            draggable: 'true'
        });

        marker.on('dragend', function(event) {
            var position = marker.getLatLng();
            marker.setLatLng(position, {
                draggable: 'true'
            }).bindPopup(position).update();
            $("#Latitude").val(position.lat);
            $("#Longitude").val(position.lng).keyup();
        });

        $("#Latitude, #Longitude").change(function() {
            var position = [parseInt($("#Latitude").val()), parseInt($("#Longitude").val())];
            marker.setLatLng(position, {
                draggable: 'true'
            }).bindPopup(position).update();
            map.panTo(position);
        });

        map.addLayer(marker);
    })
</script>


<script>
    $('#BtnEdit').click(function () {
        $(".box-loading-step").fadeIn("slow", function () {
            $(this).show();
        });


        var chkArray = [];
        /* look for all checkboes that have a class 'chk' attached to it and check if it was checked */
        $(".chk:checked").each(function() {
            chkArray.push($(this).val());
        });
        /* we join the array separated by the comma */
        var selected;
        selected = chkArray.join(',') ;


        if(selected.length > 0) {

            // alert(selected);

            var formData = new FormData();
            formData.append('host_id', <?php echo e($hostModel->id); ?>);
            formData.append('step', 2);
            formData.append('province_id', $('#SelectProvince').val());
            formData.append('township_id', $('#SelectTownship').val());
            formData.append('district', $('#InputDistrict').val());
            formData.append('address', $('#InputAddress').val());
            formData.append('latitude', $('#Latitude').val());
            formData.append('longitude', $('#Longitude').val());
            formData.append('select_array', selected);
            // for (var pair of formData.entries()) {
            //     console.log(pair[0]+ ', ' + pair[1]);
            // }
            $.ajaxSetup({
                headers: {
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                }
            });
            $.ajax({
                url: '<?php echo e(route('UpdateHostStep')); ?>',
                type: 'post',
                data: formData,
                processData: false,
                contentType: false,
                success: function (data) {
                    console.log(data);
                    if(data.Success == 0)
                    {
                        $(".box-loading-step").fadeOut("slow", function() {
                            $('.box-loading-step').hide();
                        });
                        $.Toast("<p>ویرایش</p>", "<p>"+data.Message+" .</p>", "warning", {
                            has_icon: true,
                            has_close_btn: true,
                            stack: true,
                            fullscreen: false,
                            timeout: 4000,
                            sticky: false,
                            has_progress: true,
                            rtl: true,
                        });
                    }
                    else if(data.Success == 1){
                        $(".box-loading-step").fadeOut("slow", function() {
                            $('.box-loading-step').hide();
                        });
                        $.Toast("<p>ویرایش</p>", "<p>ثبت ویرایش موفقیت آمیز بود .</p>", "success", {
                            has_icon: true,
                            has_close_btn: true,
                            stack: true,
                            fullscreen: false,
                            timeout: 4000,
                            sticky: false,
                            has_progress: true,
                            rtl: true,
                        });
                        $('#BtnCancelUpdate').click();
                    }
                }
            });
        } else {
            $(".box-loading-step").fadeOut("slow", function() {
                $('.box-loading-step').hide();
            });
            $.Toast("<p>ویرایش</p>", "<p>حداقل انتخاب یکی از فیلد های موقعیت اجباری میباشد .</p>", "warning", {
                has_icon: true,
                has_close_btn: true,
                stack: true,
                fullscreen: false,
                timeout: 4000,
                sticky: false,
                has_progress: true,
                rtl: true,
            });
        }
    });
</script>

