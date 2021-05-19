@extends('backend.MasterPage.LayoutCreateHost')
@section('title', TitlePage('ویرایش اقامتگاه'))
@section('style')
    <link rel="stylesheet" href="{{asset('backend/css/dataTables.bootstrap.css')}}">
    <link rel="stylesheet" href="{{asset('backend/css/TableTools.css')}}">
    <link rel="stylesheet" href="{{asset('backend/assets/checkbox/css/style.css')}}">
    <link rel="stylesheet" href="{{asset('backend/css/create-edit-host.css')}}">
@endsection

@section('content')
    <div class="row">
        <div class="col-md-12">
            @include('message.Message')
            @include('message.ErrorReporting')
        </div>
    </div>
    <input type="hidden" id="host_id" value="{{$hostModel->id}}"/>
    <div id="ExtraFormHost">
        @include('Host::editStep.editStep'.$step)
    </div>

    <div class="text-center box-loading-step">
        <img style="" src="{{ asset('backend/img/img_loading/blue_circles.gif') }}"/>
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
@endsection
@section('script')
    <!-- Map -->
    <script src="https://maps.googleapis.com/maps/api/js?key=AIzaSyCBUcxNAzDyoiTXUXpLwd1a-3jOwkQpDUs&sensor=false&libraries=places&language=en"></script>

    <link rel="stylesheet" href="https://unpkg.com/leaflet@1.4.0/dist/leaflet.css"
          integrity="sha512-puBpdR0798OZvTTbP4A8Ix/l+A4dHDD0DGqYW6RQ+9jxkRFclaxxQb/SJAWZfWAkuyeQUytO7+7N4QKrDh+drA=="
          crossorigin=""/>
    <script src="https://unpkg.com/leaflet@1.4.0/dist/leaflet.js"
            integrity="sha512-QVftwZFqvtRNi0ZyCtsznlKSWOStnDORoefr1enyq5mVL4tmKB3S/EnC3rRJcxCPavG10IcrVGSmPh6Qw5lwrg=="
            crossorigin=""></script>
    <script type="text/javascript" src="{{asset('backend/js/jquery.dataTables.min.js')}}"></script>
    <script type="text/javascript" src="{{asset('backend/js/TableTools.min.js')}}"></script>
    <script type="text/javascript" src="{{asset('backend/js/dataTables.bootstrap.js')}}"></script>
    <script type="text/javascript" src="{{asset('backend/js/editable-datatables.js')}}"></script>
    <script type="text/javascript" src="{{asset('backend/js/editable-datatables.js')}}"></script>
    <script type="text/javascript" src="{{asset('backend/assets/checkbox/js/script.css')}}"></script>
    <script type="text/javascript" src="{{asset('backend/js/number.js')}}"></script>

    <script>
        $('#SelectBuildingType').change(function () {
            if ($(this).val() == 6 || $(this).val() == 7) {
                $('.form-room').css('display', 'block');
                $('.meter-total').css('display', 'block');
                $('.boxRoom').css('display', 'block');
            } else if ($(this).val() == 2) {
                $('.form-room').css('display', 'block');
                $('.meter-total').css('display', 'none');
                $('.boxRoom').css('display', 'none');
                $('.boxRoom').html('');
                $('#InputCountRoom').val(1);
            } else {
                $('.form-room').css('display', 'block');
                $('.meter-total').css('display', 'none');
                $('.boxRoom').css('display', 'block');
            }
        });

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
                    url: '{{route('GetAjaxTownship')}}',
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
                    url: '{{route('GetAjaxCity')}}',
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
                    url: '{{route('GetAjaxDistrict')}}',
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
                url: '{{route('RemoveImageHost')}}',
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
@endsection