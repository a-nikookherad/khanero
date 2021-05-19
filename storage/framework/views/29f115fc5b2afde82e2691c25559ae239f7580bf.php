<?php ($positionTypeModel1 = App\Modules\Possibilities\Controllers\PossibilitiesController::GetPositionType1()); ?>
<?php ($positionTypeModel2 = App\Modules\Possibilities\Controllers\PossibilitiesController::GetPositionType2()); ?>

<style>
    .progress .bar {
        width: 18%;
        background-color: #879dc0;
    }

    input#Latitude,
    input#Longitude {
        height: 0px;
        width: 0px;
        opacity: 0;
    }
</style>
<div class="address">
    <div class="col-md-12">
        <p>
            <button data-value="1" id="BtnEditStep1" class="btn btn-enable">مشخصات اقامتگاه</button>
            <button data-value="4" id="BtnEditStep4" class="btn btn-enable">موقعیت اقامتگاه</button>
            <button data-value="2" id="BtnEditStep2" class="btn btn-disable" disabled>تصاویر</button>
            <button data-value="7" id="BtnEditStep7" class="btn btn-disable" disabled>اطلاعات اقامتگاه</button>
            <button data-value="3" id="BtnEditStep3" class="btn btn-disable" disabled>ظرفیت</button>
            <button data-value="6" id="BtnEditStep6" class="btn btn-disable" disabled>قیمت گذاری</button>
            <button data-value="2" id="BtnEditStep2" class="btn btn-disable" disabled>آدرس</button>
            <button data-value="5" id="BtnEditStep5" class="btn btn-disable" disabled>قوانین اقامتگاه</button>
        </p>
    </div>
</div>
<div class="row">
    <div class="col-md-12">
        <div class="panel panel-default">
            <div class="panel-heading">
                <h3 class="panel-title">موقعیت اقامتگاه<span class="information-step"><i class="fas fa-info-circle"></i></span>
                </h3>
                <div class="box-information show-information">
                    <p>
                        موقعیت اقامتگاه<br/>
                        وارد کردن موقعیت اقامتگاه و همچنین موقعیت در منطقه
                    </p>
                </div>
            </div>
            <div class="panel-body">
                <div class="row">
                    <div class="col-md-3">
                        <div class="form-group">
                            <label for="SelectProvince">استان</label>
                            <select name="province_id" id="SelectProvince" class="form-control SelectProvince">
                                <option value="" hidden>انتخاب کنید</option>
                                <?php $__currentLoopData = $provinceModel; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $key => $value): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                    <option value="<?php echo e($value->id); ?>"><?php echo e($value->name); ?></option>
                                <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                            </select>
                        </div>
                    </div>
                    <div class="col-md-3">
                        <div class="form-group">
                            <label for="SelectTownship">شهرستان</label>
                            <select name="township_id" id="SelectTownship" class="form-control SelectTownship">
                                <option value="" hidden>انتخاب کنید</option>
                            </select>
                        </div>
                    </div>
                    <div class="col-md-3">
                        <div class="form-group">
                            <label for="InputDistrict">محله یا روستا</label>
                            <input type="text" class="form-control" name="district" id="InputDistrict"
                                   placeholder="نام محله یا روستا را وارد کنید"/>
                        </div>
                    </div>
                </div>
                <div class="row">
                    <div class="col-md-3">
                        <div class="form-group">
                            <label for="InputPostalCode">کد پستی</label>
                            <input type="text" class="form-control" name="postal_code" id="InputPostalCode"
                                   placeholder="کد پستی را وارد کنید"/>
                        </div>
                    </div>
                    <div class="col-md-3">
                        <div class="form-group">
                            <label for="InputFloor">طبقه</label>
                            <input type="text" class="form-control" name="floor" id="InputFloor"
                                   placeholder="طبقه را وارد کنید"/>
                        </div>
                    </div>
                    <div class="col-md-3">
                        <div class="form-group">
                            <label for="InputUnit">واحد</label>
                            <input type="text" class="form-control" name="unit" id="InputUnit"
                                   placeholder="واحد را وارد کنید"/>
                        </div>
                    </div>
                </div>
                <div class="row">
                    <div class="col-md-6">
                        <div class="form-group">
                            <label for="InputAddress">آدرس</label>
                            <input type="text" class="form-control" name="address" id="InputAddress"
                                   placeholder="آدرس محل را وارد کنید">
                        </div>
                    </div>
                    <div class="col-md-3">
                        <div class="form-group">
                            <label for="InputPlaque">پلاک</label>
                            <input type="text" class="form-control" name="plaque" id="InputPlaque"
                                   placeholder="پلاک را وارد کنید">
                        </div>
                    </div>
                </div>
                <div class="row">
                    <div class="col-md-12">
                        <div class="form-group">
                            <label>بافت محوطه</label>
                            <div class="row">
                                <?php $__currentLoopData = $positionTypeModel1; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $key => $value): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                    <div class="col-md-2">
                                        <input id="InputCheckBox1<?php echo e($key+1); ?>" class="chk1" type="checkbox"
                                               value="<?php echo e($value->id); ?>"/> <label
                                                for="InputCheckBox1<?php echo e($key+1); ?>"><?php echo e($value->name); ?></label>
                                    </div>
                                <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="row">
                    <div class="col-md-12">
                        <div class="form-group">
                            <label>چشم انداز</label>
                            <div class="row">
                                <?php $__currentLoopData = $positionTypeModel2; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $key => $value): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                    <div class="col-md-2">
                                        <input id="InputCheckBox2<?php echo e($key+1); ?>" class="chk2" type="checkbox"
                                               value="<?php echo e($value->id); ?>"/> <label
                                                for="InputCheckBox2<?php echo e($key+1); ?>"><?php echo e($value->name); ?></label>
                                    </div>
                                <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                            </div>
                        </div>
                    </div>
                    <div class="col-md-12">
                        <div class="form-group">
                            <label for="TextAreaOtherPosition">اطلاعات جغرافیایی دیگر</label>
                            <textarea id="TextAreaOtherPosition" rows="6" class="form-control" placeholder="مثلا مسیر دسترسی خاکی است ، ..."></textarea>
                        </div>
                    </div>
                    <div class="col-md-12">
                        <p>موقعیت خود را روی نقشه انتخاب کنید(پین آبی را حرکت دهید)</p>
                    </div>
                    <div class="col-md-12">
                        <div id="mapid" style="width: 100%; height: 400px;"></div>
                    </div>
                    <div class="col col-3">
                        <label class="input">
                            <input id="Latitude" placeholder="Latitude" value="35.7115095" name="latitude"/>
                            
                            
                        </label>
                    </div>
                    <div class="col col-3">
                        <label class="input">
                            <input id="Longitude" placeholder="Longitude" value="51.3904767" name="longitude"/>
                            
                            
                        </label>
                    </div>
                    <br/>
                    <div class="col-md-2 col-md-offset-5">
                        <button type="button" id="step2" class="btn btn-default BtnRegAll btn-block">&nbsp; بعدی <i class="fa fa-angle-left"></i><i class="fa fa-angle-left"></i></button>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>



<!-- Map -->
<script type="text/javascript" src="<?php echo e(asset('backend/assets/map/jquery-gmaps-latlon-picker.js')); ?>"></script>
<link rel="stylesheet" href="<?php echo e(asset('backend/assets/map/jquery-gmaps-latlon-picker.css')); ?>">


<script>

    $(function () {
        // use below if you want to specify the path for leaflet's images
        //L.Icon.Default.imagePath = '@Url.Content("~/Content/img/leaflet")';

        var curLocation = [0, 0];
        // use below if you have a model
        // var curLocation = [@Model.Location.Latitude, @Model.Location.Longitude];

        if (curLocation[0] == 0 && curLocation[1] == 0) {
            curLocation = [35.7115095, 51.3904767];
        }

        var map = L.map('mapid').setView(curLocation, 9);

        L.tileLayer('http://{s}.tile.osm.org/{z}/{x}/{y}.png', {
            attribution: '&copy; <a href="http://osm.org/copyright">OpenStreetMap</a> contributors'
        }).addTo(map);

        map.attributionControl.setPrefix(false);

        var marker = new L.marker(curLocation, {
            draggable: 'true'
        });

        marker.on('dragend', function (event) {
            var position = marker.getLatLng();
            marker.setLatLng(position, {
                draggable: 'true'
            }).bindPopup(position).update();
            $("#Latitude").val(position.lat);
            $("#Longitude").val(position.lng).keyup();
        });

        $("#Latitude, #Longitude").change(function () {
            var position = [parseInt($("#Latitude").val()), parseInt($("#Longitude").val())];
            marker.setLatLng(position, {
                draggable: 'true'
            }).bindPopup(position).update();
            map.panTo(position);
        });

        map.addLayer(marker);
    })

</script>


<script type="text/javascript">


    // mymap.on('click', onMapClick);
    $('#step2').click(function () {
        $(".box-loading-step").fadeIn("slow", function () {
            $(this).show();
        });


        var chkArray_1 = [];
        var chkArray_2 = [];
        /* look for all checkboes that have a class 'chk' attached to it and check if it was checked */
        $(".chk1:checked").each(function () {
            chkArray_1.push($(this).val());
        });
        $(".chk2:checked").each(function () {
            chkArray_2.push($(this).val());
        });
        /* we join the array separated by the comma */
        var selected_1;
        var selected_2;
        selected_1 = chkArray_1.join(',');
        selected_2 = chkArray_2.join(',');


        if (selected_1.length > 0 && selected_2.length > 0) {


            var formData = new FormData();
            formData.append('host_id', $('#host_id').val());
            formData.append('province_id', $('#SelectProvince').val());
            formData.append('township_id', $('#SelectTownship').val());
            formData.append('district', $('#InputDistrict').val());
            formData.append('postal_code', $('#InputPostalCode').val());
            formData.append('floor', $('#InputFloor').val());
            formData.append('unit', $('#InputUnit').val());
            formData.append('address', $('#InputAddress').val());
            formData.append('plaque', $('#InputPlaque').val());
            formData.append('other_position', $('#TextAreaOtherPosition').val());
            formData.append('latitude', $('#Latitude').val());
            formData.append('longitude', $('#Longitude').val());
            formData.append('select_array_1', selected_1);
            formData.append('select_array_2', selected_2);
            // for (var pair of formData.entries()) {
            //     console.log(pair[0]+ ', ' + pair[1]);
            // }
            $.ajaxSetup({
                headers: {
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                }
            });
            $.ajax({
                url: '<?php echo e(route('StoreHostStep2')); ?>',
                type: 'post',
                data: formData,
                processData: false,
                contentType: false,
                success: function (data) {
                    if (data.Success == 0) {
                        $(".box-loading-step").fadeOut("slow", function () {
                            $('.box-loading-step').hide();
                        });
                        $('#myModal').modal('show');
                        $('#MsgErrorStep').text(data.Message);
                    } else {
                        $(".box-loading-step").fadeOut("slow", function () {
                            $('.box-loading-step').hide();
                        });
                        $('#ExtraFormHost').html(data.Message.original);
                    }
                }
            });
        } else {
            $('#myModal').modal('show');
            $('#MsgErrorStep').text('حداقل انتخاب یکی از فیلد های بافت محوطه و چشم انداز اجباری میباشد');
            $(".box-loading-step").fadeOut("slow", function () {
                $('.box-loading-step').hide();
            });
        }
    });


    /****************************************
     *         Edit By Step Address         *
     ***************************************/


    $('.BtnEditStep').click(function () {
        $(".box-loading-step").fadeIn("slow", function () {
            $(this).show();
        });
        var step = $(this).attr('data-value');
        var host_id = $('#host_id').val();
        $.ajaxSetup({
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            }
        });
        $.ajax({
            url: '<?php echo e(route('EditStep')); ?>',
            type: 'post',
            data: {
                host_id: host_id,
                step: step
            },
            success: function (data) {
                if (data.Success == 1) {
                    $(".box-loading-step").fadeOut("slow", function () {
                        $('.box-loading-step').hide();
                    });
                    $('#myModalEdit').modal('show');
                    $('#ExtraBoxEditStep').html(data.Message.original);
                }
            }
        });
    });
    $('span.information-step').click(function () {
        $('.box-information').toggleClass('show-information');
    });
</script>

