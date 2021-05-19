<meta name="viewport" content="width=device-width, initial-scale=1">
<?php $__env->startSection('title'); ?>
     ورود به سیستم
<?php $__env->stopSection(); ?>

<?php $__env->startSection('content'); ?>

    <?php echo $__env->make('MultiAuth::Login.Admin', array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>

<?php $__env->stopSection(); ?>







<?php $__env->startSection('script'); ?>
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
                     url:'<?php echo e(route('Captcha')); ?>',
                     type:'get',
                     success:function(data) {
                         $('.captcha-button').find('i').removeClass('fa-spin');
                         $('.captcha').html(data);
                     }
                 });

             });

         });
     </script>
<?php $__env->stopSection(); ?>

<?php echo $__env->make('backend.MasterPage.Auth', array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>