<style>
    .box-price {
        border: 1px solid #fe884a;
        border-radius: 10px;
        margin: 10px 0px;
        padding: 10px;
    }
    .modal-backdrop {
        display: none;
    }
    div#myModalShodDetail {
        background: #333333d1;
        padding-top: 50px;
    }
</style>
<div class="box-price">
    <div class="row">
        <div class="col-md-6 text-right">
            تعداد شب های اقامت
        </div>
        <div class="col-md-6 text-left">
            <span class="text-danger"><?php echo e(count($array_price_date)); ?> شب</span>
        </div>
</div>
    <?php if($extraPriceForPerson != 0): ?>
        <div class="row">
            <div class="col-md-6 text-right">
                نفرات اضافه
            </div>
            <div class="col-md-6 text-left">
                <span class="text-danger"><?php echo e(number_format($extraPriceForPerson * count($array_price_date))); ?> تومان</span>
            </div>
        </div>
    <?php endif; ?>
    <hr />
    <div class="row">
        <div class="col-md-6 text-right">
            جمع کل (<span data-toggle="modal" data-target="#myModalShodDetail">جزئیات</span>)
        </div>
        <div class="col-md-6 text-left">
            <span class="text-danger"><?php echo e(number_format($total_price_reserve + ($extraPriceForPerson * count($array_price_date)))); ?> تومان</span>
        </div>
    </div>
</div>

<!-- Modal -->
<div id="myModalShodDetail" class="modal fade" role="dialog">
    <div class="modal-dialog modal-lg">

        <!-- Modal content-->
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal">&times;</button>
                <h4 class="modal-title">جزئیات فاکتور</h4>
            </div>
            <div class="modal-body">
                <div class="row">
                    <div class="col-md-12">
                        <?php echo $factor; ?>

                    </div>
                </div>
                <div class="row">
                    <div class="col-md-12">
                        <div class="form-group text-left">
                            <button type="button" class="btn btn-primary" data-dismiss="modal">مشاهده شد</button>
                        </div>
                    </div>
                </div>
            </div>
        </div>

    </div>
</div>