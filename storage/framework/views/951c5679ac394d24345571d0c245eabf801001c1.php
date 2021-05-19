
<?php $__env->startSection('title', TitlePage('ثبت میزبانی جدید')); ?>
<?php $__env->startSection('style'); ?>
    <link rel="stylesheet" href="<?php echo e(asset('backend/css/dataTables.bootstrap.css')); ?>">
    <link rel="stylesheet" href="<?php echo e(asset('backend/css/TableTools.css')); ?>">
    <link rel="stylesheet" href="<?php echo e(asset('backend/assets/checkbox/css/style.css')); ?>">
    <style>
        .btn-file {
            position: relative;
            overflow: hidden;
        }

        .btn-file input[type=file] {
            position: absolute;
            top: 0;
            right: 0;
            min-width: 100%;
            min-height: 100%;
            font-size: 100px;
            text-align: right;
            filter: alpha(opacity=0);
            opacity: 0;
            outline: none;
            background: white;
            cursor: inherit;
            display: block;
        }

        .icon-adds {
            font-size: 20px;
            cursor: pointer;
            -webkit-transition: 0.5s;
            -moz-transition: 0.5s;
            -ms-transition: 0.5s;
            -o-transition: 0.5s;
            transition: 0.5s;
            position: absolute;
            left: -10px;
            top: 0px;
        }

        .msgLabel {
            font-size: 11px;
            color: #3c763d;
        }

        .BtnAddSub {
            border: 1px solid white;
            /*background: #f1c40f;*/
            color: #253341;
            border-radius: 50%;
            /*width: 20px;*/
            height: 20px;
            text-align: center;
            line-height: 18px;
            font-size: 19px;
            margin: 0 10px;
            cursor: pointer;
            transition: 0.5s;
        }

        .BtnAddSub:hover {
            background: white;
            border: 1px solid #3ba0ff;
            color: #3ba0ff;
            transition: 0.5s;
        }

        #ExtraBuildingType input[type="text"], .boxRooms input[type="text"], .boxRoom input[type="text"] {
            width: 25px;
            text-align: center;
        }

        .rows {
            margin: 1px 0px;
        }

        .boxRoom {
            border: 1px solid #ddd;
            border-radius: 5px;
            padding-top: 8px;
            padding-left: 12px;
            min-height: 183px;
            max-height: 381px;
            overflow-y: auto;
        }

        .boxRoom i {
            font-size: 16px;
        }

        .boxs {
            border: 1px solid #ddd;
            border-radius: 5px;
            padding: 5px;
            background-color: #f8f8f8;
            float: right;
            width: 100%;
            margin-bottom: 10px;
        }

        .boxs img {
            width: 40px;
            margin-bottom: 10px;
        }

        .textarea {
            height: 120px;
        }

        .msg {
            padding: 10px 15px;
            line-height: 25px;
        }

        .box-days {
            display: inline;
        }

        .box-days input {
            width: 14%;
            display: inline;
        }

        .box-loading-step {
            display: none;
            background-color: #00000070;
            height: 100%;
            position: absolute;
            width: 100%;
            left: 0;
            top: 0;
            z-index: 9999;
        }

        .box-loading-step img {
            height: 80px;
            position: absolute;
            top: 50%;
            left: 50%;
            width: auto;
            transform: translate(-50%, -50%);
        }

        .address button {
            color: #444;
            font-size: 13px;
        }

        span.information-step {
            padding: 0px 10px;
            margin: 0px !important;
            float: left;
            cursor: pointer;
        }

        span.information-step i:hover {
            color: #cb5f21;
            transition: 0.5s;
        }

        span.information-step i {
            color: #ea6722;
            font-size: 20px;
            transition: 0.5s;
            -webkit-animation: myColor 5s infinite; /* Safari 4.0 - 8.0 */
            animation: myColor 3s infinite;
        }

        @keyframes  myColor {
            0% {
                color: #ea6722
            }
            50% {
                color: #8ddbee
            }
            100% {
                color: #ea6722
            }
        }

        @-webkit-keyframes myColor {
            0% {
                color: #ea6722
            }
            50% {
                color: #8ddbee
            }
            100% {
                color: #ea6722
            }
        }

        .box-information {
            display: none;
            z-index: 9999;
            position: absolute;
            left: 40px;
            top: 45px;
            width: 300px;
            background: #fcfcfcbf;
            padding: 8px;
            border: 1px solid #ea69269c;
            border-radius: 5px;
            box-shadow: 0px 0px 15px #e8e8e8;
        }

        .box-information p {
            text-align: justify;
            line-height: 20px;
            color: #777777;
        }

        .show-information {
            display: block;
        }

        .block-description {
            display: block;
        }
        .none-description {
            display: none;
        }
        .box-information .title-information {
            color: #ec6621;
            font-weight: bold;
            line-height: 25px;
        }

        .box-img-host img {
            width: 100%;
            border-radius: 5px;
        }

        .box-img-remove {
            position: absolute;
            bottom: 0px;
        }

        .box-img-remove button {
            background: #ff3b3b8c;
            color: #cecece;
            border: 1px solid #c7c7c7;
            border-radius: 10px 0px 0px 0px;
        }
        .img-create-integrated {
            width: 30px;
        }
        .alert-dark {
            color: #31708f;
            background-color: #6767670d;
            border-color: #007b8c;
        }
        a.btn-create-integrated {
            border: 1px solid #007b8c;
            padding: 2px 10px;
            border-radius: 15px;
            background: #007b8c17;
            color: #007b8c;
            transition: .5s;
        }
        a.btn-create-integrated:hover {
            transition: .5s;
            background: #007b8c50;
            color: #fff;
        }
    </style>
<?php $__env->stopSection(); ?>

<?php $__env->startSection('content'); ?>
    
    
    
    
    
    
    <div class="row">
        <div class="col-md-12">
            <?php echo $__env->make('message.Message', array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>
            <?php echo $__env->make('message.ErrorReporting', array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>
        </div>
    </div>
    <div class="row">
        <div class="col-md-12">
            <div class="progress progress-danger progress-striped active">
                <div class="bar" style=""></div>
            </div>
        </div>
    </div>
    <div class="row">
        <div class="col-md-12">
            <div class="alert alert-dark">
                <p><img class="img-create-integrated" src="<?php echo e(asset('frontend/icons/10rentt-eghamatgahejadid.png')); ?>">برای ثبت مجتمع اقامتی <a class="btn-create-integrated" href="<?php echo e(route('CreateIntegrated')); ?>">اینجا</a> را کلیک کنید</p>
            </div>
        </div>
    </div>
    </div>
    <input type="hidden" id="host_id" value="<?php echo e($hostModel->id); ?>"/>
    <div id="ExtraFormHost">
        <?php if($hostModel->step == 0): ?>
            <?php echo $__env->make('Host::step.step1', array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>
        <?php elseif($hostModel->step == 1): ?>
            <?php echo $__env->make('Host::step.step2', array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>
        <?php elseif($hostModel->step == 2): ?>
            <?php echo $__env->make('Host::step.step3', array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>
        <?php elseif($hostModel->step == 3): ?>
            <?php echo $__env->make('Host::step.step4', array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>
        <?php elseif($hostModel->step == 4): ?>
            <?php echo $__env->make('Host::step.step5', array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>
        <?php elseif($hostModel->step == 5): ?>
            <?php echo $__env->make('Host::step.step6', array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>
        <?php elseif($hostModel->step == 6): ?>
            <?php echo $__env->make('Host::step.step7', array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>
        <?php endif; ?>
    </div>


    <div class="text-center box-loading-step">
        <img style="" src="<?php echo e(asset('backend/img/img_loading/orange_circles.gif')); ?>"/>
    </div>



    <div class="modal fade" id="myModal" role="dialog">
        <div class="modal-dialog">

            <!-- Modal content-->
            <div class="modal-content">
                <div class="modal-header bg-green">
                    <button type="button" class="close" data-dismiss="modal">&times;</button>
                    <h4 class="modal-title" style="color: #efefef;">خطا در ارسال اطلاعات</h4>
                </div>
                <div class="modal-body">
                    <p id="MsgErrorStep"></p>
                </div>
                <div class="modal-footer">
                    <button type="button" id="BtnErrorStep" class="btn btn-default" data-dismiss="modal">بستن</button>
                </div>
            </div>

        </div>
    </div>



    <div class="modal fade" id="myModalEdit" role="dialog">
        <div class="modal-dialog modal-lg">

            <!-- Modal content-->
            <div class="modal-content">
                <div class="modal-header bg-green">
                    <button type="button" class="close" data-dismiss="modal">&times;</button>
                    <h4 class="modal-title" style="color: #efefef;">ویرایش اطلاعات</h4>
                </div>
                <div id="ExtraBoxEditStep"></div>
            </div>

        </div>
    </div>


<?php $__env->stopSection(); ?>


<?php $__env->startSection('script'); ?>

    <!-- Map -->
    <script src="https://maps.googleapis.com/maps/api/js?key=AIzaSyCBUcxNAzDyoiTXUXpLwd1a-3jOwkQpDUs&sensor=false&libraries=places&language=en"></script>

    <link rel="stylesheet" href="https://unpkg.com/leaflet@1.4.0/dist/leaflet.css"
          integrity="sha512-puBpdR0798OZvTTbP4A8Ix/l+A4dHDD0DGqYW6RQ+9jxkRFclaxxQb/SJAWZfWAkuyeQUytO7+7N4QKrDh+drA=="
          crossorigin=""/>
    <script src="https://unpkg.com/leaflet@1.4.0/dist/leaflet.js"
            integrity="sha512-QVftwZFqvtRNi0ZyCtsznlKSWOStnDORoefr1enyq5mVL4tmKB3S/EnC3rRJcxCPavG10IcrVGSmPh6Qw5lwrg=="
            crossorigin=""></script>




    <script type="text/javascript" src="<?php echo e(asset('backend/js/jquery.dataTables.min.js')); ?>"></script>
    <script type="text/javascript" src="<?php echo e(asset('backend/js/TableTools.min.js')); ?>"></script>
    <script type="text/javascript" src="<?php echo e(asset('backend/js/dataTables.bootstrap.js')); ?>"></script>
    <script type="text/javascript" src="<?php echo e(asset('backend/js/editable-datatables.js')); ?>"></script>
    <script type="text/javascript" src="<?php echo e(asset('backend/js/editable-datatables.js')); ?>"></script>
    <script type="text/javascript" src="<?php echo e(asset('backend/assets/checkbox/js/script.css')); ?>"></script>
    <script type="text/javascript" src="<?php echo e(asset('backend/js/number.js')); ?>"></script>

    <script>


        $(document).ready(function () {

            //get township
            $("body").delegate(".SelectProvince", "change", function (e) {

                var id = $(this).val();
                getTownship(id);
            });

            //get township
            function getTownship(id) {
                $.ajaxSetup({
                    headers: {
                        'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                    }
                });
                $.ajax({
                    url: '<?php echo e(route('GetAjaxTownship')); ?>',
                    type: 'post',
                    data: {
                        id: id
                    },
                    success: function (data) {
                        $(".SelectTownship").html(data);
                    }
                });

            }


            //get city
            $("body").delegate(".SelectTownship", "change", function (e) {
                var text = $(".SelectTownship option:selected").text();
                $('.gllpSearchField').val(text);
                $('.gllpSearchButton').click();

                var id = $(this).val();
                getCity(id);
            });

            //get city
            function getCity(id) {
                $.ajaxSetup({
                    headers: {
                        'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                    }
                });
                $.ajax({
                    url: '<?php echo e(route('GetAjaxCity')); ?>',
                    type: 'post',
                    data: {
                        id: id
                    },
                    success: function (data) {
                        $(".SelectCity").html(data);
                    }
                });

            }


            //get district
            $("body").delegate(".SelectCity", "change", function (e) {

                var id = $(this).val();
                getDistrict(id);
            });

            //get district
            function getDistrict(id) {
                $.ajaxSetup({
                    headers: {
                        'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                    }
                });
                $.ajax({
                    url: '<?php echo e(route('GetAjaxDistrict')); ?>',
                    type: 'post',
                    data: {
                        id: id
                    },
                    success: function (data) {
                        $(".SelectDistrict").html(data);
                    }
                });

            }


            $('#BtnCreateImg').click(function () {
                var file = '<div class="col-md-3">\n' +

                    '          <div class="form-group">\n' +

                    '               <span class="btn btn-default btn-file"> <i class="fa fa-picture-o"></i> &nbsp;انتخاب تصویر <input type="file" name="img[]" multiple /></span>\n' +

                    '          </div>\n' +

                    '          <div class="form-group ">\n' +

                    '               <input type="text" name="title_img[]" class="form-control" placeholder="عنوان را وارد کنید" />\n' +

                    '          </div>\n' +

                    '     </div>';

                $('#ExtraGallery').append(file);
            });




            $("body").delegate("#SelectHomeType", "change", function (e) {
                var Value = $(this).val();
                if (Value == 2 || Value == 3) {
                    $('#ExtraBuildingType').css('display', 'block');
                }
                else {
                    $('#ExtraBuildingType').css('display', 'none');
                    $('#InputMan').val(0);
                    $('#InputWoman').val(0);
                    $('#InputChild').val(0);
                }
            });
            //-_-_-_-_-_-_-_-_-_-_-_-_-_-_-_-_-_-_


            //_-_-_-_-_-_- BTN STEP _-_-_-_-_-_


            $('#step1').click(function () {
                $('#Tab1').removeClass('active');
                $('#1_tab').removeClass('active');
                // $('#1_tab').removeClass('in');

                $('#Tab2').addClass('active');
                $('#2_tab').addClass('active');
                // $('#2_tab').addClass('fade');
                // $('#2_tab').addClass('in');
            });
        });


        $(document).on('click', '.BtnAdds', function () {

            var textbox = $(this).parent().parent().find('.input-text');
            var value = textbox[0].defaultValue;
            textbox[0].defaultValue = parseFloat(value) + 1;
            return false;
        });

        $(document).on('click', '.BtnSubs', function () {

            var textbox = $(this).parent().parent().find('.input-text');
            var value = textbox[0].defaultValue;
            if (value == 0) {
                value = 1;
            }
            textbox[0].defaultValue = parseFloat(value) - 1;
            return false;
        });




        function removeGalleryHost(id, host_id) {
            // console.log(id, host_id);
            $.ajaxSetup({
                headers : {
                    'X-CSRF-TOKEN' : $('meta[name="csrf-token"]').attr('content')
                }
            });
            $.ajax({
                url: '<?php echo e(route('RemoveImageHost')); ?>',
                type: 'post',
                data: {
                    id: id,
                    host_id: host_id,
                },
                success: function (data) {
                    var ee = $('.box-gallery'+data).attr('data-first-img');
                    $('.box-gallery'+data).remove();
                    if(ee == 1) {
                        $('.box-gallery-selector:first').attr('data-first-img', 1);
                        var h = '<span class="first-img">\n' +
                            '                تصویر اصلی\n' +
                            '            </span>';
                        $('.box-gallery-selector:first .box-img-host').append(h);
                    }
                }
            });
        }


    </script>
<?php $__env->stopSection(); ?>
<?php echo $__env->make('backend.MasterPage.Layout', array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>