<?php ($positionTypeModel = App\Modules\Possibilities\Controllers\PossibilitiesController::GetPositionType()); ?>

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
            <button data-value="1" id="BtnEditStep1" class="btn BtnEditStep">اطلاعات اولیه</button>
            <button data-value="2" id="BtnEditStep2" class="btn" disabled>موقعیت اقامتگاه</button>
        </p>
    </div>
</div>
<div class="row">
    <div class="col-md-12">
        <div class="panel panel-default">
            <div class="panel-heading">
                <h3 class="panel-title">موقعیت اقامتگاه<span class="information-step"><i class="fas fa-info-circle"></i></span></h3>
                <div class="box-information">
                    <p>
                        موقعیت اقامتگاه<br />
                        وارد کردن موقعیت اقامتگاه و همچنین موقعیت در منطقه
                    </p>
                </div>
            </div>
            <div class="panel-body">
                <div class="row">
                    <div class="col-md-3">
                        <div class="form-group">
                            <label>استان</label><span style="font-size: 18px;" class="text-danger">*</span>
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
                            <label>شهرستان</label><span style="font-size: 18px;" class="text-danger">*</span>
                            <select name="township_id" id="SelectTownship" class="form-control SelectTownship">
                                <option value="" hidden>انتخاب کنید</option>
                                
                                
                                
                            </select>
                        </div>
                    </div>
                    <div class="col-md-6">
                        <div class="form-group">
                            <label for="InputDistrict">محله</label><span style="font-size: 18px;"
                                                                         class="text-danger">*</span>
                            <input type="text" class="form-control" name="district" id="InputDistrict"
                                   placeholder="نام محله را وارد کنید"/>
                        </div>
                    </div>
                </div>
                <div class="row">
                    <div class="col-md-12">
                        <div class="form-group">
                            <label for="InputAddress">آدرس</label><span style="font-size: 18px;"
                                                                        class="text-danger">*</span>
                            <input type="text" class="form-control" name="address" id="InputAddress"
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
                                        <input id="InputCheckBox<?php echo e($key+1); ?>" class="chk" type="checkbox" value="<?php echo e($value->id); ?>" /><label for="InputCheckBox<?php echo e($key+1); ?>"><?php echo e($value->name); ?></label>
                                    </div>
                                <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                            </div>
                        </div>
                    </div>
                </div>
                
                    
                        
                            
                            
                                
                                
                                    
                                
                            
                        
                    
                
                <div class="row">
                    
                        
                            
                                
                                    
                                        
                                               
                                    
                                
                                
                                    
                                        
                                               
                                               
                                    
                                
                            
                        
                        
                        
                            
                                
                                
                                
                                       
                                
                                       
                            

                        
                    
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
                                <input id="Latitude" placeholder="Latitude" name="latitude" />
                                
                                
                            </label>
                        </section>
                        <section class="col col-3">
                            <label class="input">
                                <input id="Longitude" placeholder="Longitude" name="longitude" />
                                
                                
                            </label>
                        </section>
                    </div>
                    <br/>
                    <div class="col-md-2 col-md-offset-5">
                        <button type="button" id="step2" class="btn btn-default BtnRegAll btn-block">&nbsp; بعدی <i
                                    class="fa fa-angle-left"></i><i class="fa fa-angle-left"></i></button>
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

    $(function() {
        // use below if you want to specify the path for leaflet's images
        //L.Icon.Default.imagePath = '@Url.Content("~/Content/img/leaflet")';

        var curLocation = [0, 0];
        // use below if you have a model
        // var curLocation = [@Model.Location.Latitude, @Model.Location.Longitude];

        if (curLocation[0] == 0 && curLocation[1] == 0) {
            curLocation = [36.5690917, 51.938365];
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


<script type="text/javascript">



    // mymap.on('click', onMapClick);
    $('#step2').click(function () {
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


            var formData = new FormData();
            formData.append('host_id', $('#host_id').val());
            formData.append('province_id', $('#SelectProvince').val());
            formData.append('township_id', $('#SelectTownship').val());
            formData.append('district', $('#InputDistrict').val());
            formData.append('address', $('#InputAddress').val());
            // formData.append('position_id', $('#SelectPosition').val());
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
                    }
                    else {
                        $(".box-loading-step").fadeOut("slow", function () {
                            $('.box-loading-step').hide();
                        });
                        $('#ExtraFormHost').html(data.Message.original);
                    }
                }
            });
        } else {
            $('#myModal').modal('show');
            $('#MsgErrorStep').text('حداقل انتخاب یکی از فیلد های موقعیت اجباری میباشد');
            $(".box-loading-step").fadeOut("slow", function() {
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

