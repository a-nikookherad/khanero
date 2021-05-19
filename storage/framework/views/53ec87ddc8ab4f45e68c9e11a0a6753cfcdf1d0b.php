<div class="container-fluid row-bottom">
    <div class="container">
        <div class="row menu">
            <div class="col-sm-12 col-xs-12 gap-col">
                <?php echo $__env->make('frontend.Filter.Filter', array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>
            </div>
        </div>
    </div>
</div>