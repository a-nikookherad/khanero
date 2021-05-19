@extends('backend.MasterPage.Auth')
<meta name="viewport" content="width=device-width, initial-scale=1">
@section('title')
     ورود به سیستم
@endsection

@section('content')

    @include('MultiAuth::Login.Admin')

@endsection







@section('script')
     <script>
         $(document).ready(function (e) {

             /*
              * recaptcah
              * */

             $("body").delegate("#captcha","click",function (e) {
                 e.preventDefault();

                 $('.captcha-button').find('i').addClass('fa-spin');
                 $.ajaxSetup({
                     headers: {
                         'X-CSRF-TOKEN': $('meta[name="_token"]').attr('content')
                     }});

                 $.ajax({
                     url:'{{route('Captcha')}}',
                     type:'get',
                     success:function(data) {
                         $('.captcha-button').find('i').removeClass('fa-spin');
                         $('.captcha').html(data);
                     }
                 });

             });

         });
     </script>
@endsection
