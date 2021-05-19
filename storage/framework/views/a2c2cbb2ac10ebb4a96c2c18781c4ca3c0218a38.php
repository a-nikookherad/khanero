<form action="<?php echo e(route('UpdateSlideShow')); ?>" method="post" enctype="multipart/form-data">
    <?php echo e(csrf_field()); ?>

    <input type="hidden" value="<?php echo e($slideShowModel->id); ?>" name="slideshow_id">
    <div class="row">
        <div class="col-md-6">
            <input type="text" name="title" class="form-control" value="<?php echo e($slideShowModel->title); ?>">
        </div>
        <div class="col-md-6">
            <input type="text" name="link" class="form-control" value="<?php echo e($slideShowModel->link); ?>">
        </div>
    </div>
    <br />
    <div class="row">
        <div class="col-md-6">
            <div class="form-group">
                <label>استان</label><span style="font-size: 18px;" class="text-danger">*</span>
                <select name="province_id" id="SelectProvince" class="form-control SelectProvince">
                    <option value="" hidden>انتخاب کنید</option>
                    <?php $__currentLoopData = $provinceModel; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $key => $value): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                        <option value="<?php echo e($value->id); ?>" <?php if($slideShowModel->township_id != 0 && $slideShowModel->GetTownship->province_id == $value->id): ?> selected <?php endif; ?>><?php echo e($value->name); ?></option>
                    <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                </select>
            </div>
        </div>
        <div class="col-md-6">
            <div class="form-group">
                <label>شهرستان</label><span style="font-size: 18px;" class="text-danger">*</span>
                <select name="township_id" id="SelectTownship" class="form-control SelectTownship">
                    <option value="" hidden>انتخاب کنید</option>
                    <?php $__currentLoopData = $townshipModel; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $key => $value): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                        <option value="<?php echo e($value->id); ?>" <?php if($value->id == $slideShowModel->township_id): ?> selected <?php endif; ?>><?php echo e($value->name); ?></option>
                    <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                </select>
            </div>
        </div>
    </div>
    <br />
    <div class="row">
        <div class="col-md-6">
            <input type="file" name="img" multiple>
        </div>
        <div class="col-md-6">
            <button type="submit" class="btn btn-block btn-info">
                به روز رسانی
            </button>
        </div>
    </div>
</form>