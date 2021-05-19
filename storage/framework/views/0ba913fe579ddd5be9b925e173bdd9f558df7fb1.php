<img id="thebox">
<button class="btn-upload-img btn btn-default" type="button" onclick="uploadEx()">ارسال</button>

<script>
    function uploadEx() {
        var canvas = document.getElementsByTagName("canvas");
        console.log(canvas);
        var dataURL = canvas[0].toDataURL("image/png");
        document.getElementById('hidden_data').value = dataURL;
        var fd = new FormData(document.forms["form1"]);
        var xhr = new XMLHttpRequest();
        $.ajaxSetup({
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            }
        });
        xhr.open('POST', '<?php echo e(route('UpdateImageProfile')); ?>', true);


        // $.ajax({
        //     type: "POST",
        //     url: "script.php",
        //     data: {
        //         imgBase64: dataURL
        //     }
        // }).done(function(data) {
        //
        // });

        console.log(xhr);
        xhr.upload.onprogress = function(e) {
            if (e.lengthComputable) {
                var percentComplete = (e.loaded / e.total) * 100;
                console.log(percentComplete + '% uploaded');
                alert('Succesfully uploaded');
            }
        };

        xhr.onload = function() {

        };
        xhr.send(fd);
    };
    $('#thebox').picEdit();
</script>