<form action="<?php echo e(route('DeleteReserveByHostUser')); ?>" method="post">
    <?php echo e(csrf_field()); ?>

    <input type="hidden" value="<?php echo e($reserveModel->id); ?>" name="reserve_id" />
    <div class="row">
        <div class="col-md-12">
            <div class="form-group">
                <h4>آیا از رد درخواست اطمینان دارید ؟</h4>
            </div>
        </div>
    </div>
    <div class="row">
        <div class="col-md-12">
            <h5>در صورت نیاز میتوانید برای کاربر مورد نظر پیام خود را ارسال کنید .</h5>
            <div class="form-group">
                <textarea name="message" class="form-control" id="" cols="30" placeholder="متن پیام را وارد کنید" rows="3"></textarea>
            </div>
        </div>
    </div>
    <br />
    <div class="row">
        <div class="col-md-6">
            <div class="form-group">
                <button type="submit" class="btn btn-block btn-danger">بله و ارسال پیام</button>
            </div>
        </div>
        <div class="col-md-6">
            <div class="form-group">
                <button type="button" class="btn btn-block btn-default" data-dismiss="modal">خیر</button>
            </div>
        </div>
    </div>

</form>