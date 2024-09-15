<?php if(isset($product_details)): ?>
 <div class="row mb-3 append_input">
    <?php $__currentLoopData = $product_details; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $key => $dtl): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
        <?php
        $key = $key+1;
        ?>
        <div class="row" id="row-<?php echo e($key); ?>">
                                <div class="col-sm-1 text-center" style="align-content: center;">
                                    <span class="dtl_attr_cnt"><?php echo e($key); ?>.</span>
                                    <input type="hidden"  class="hidden_details" name="product_details[<?php echo e($key); ?>][details_id]" value="<?php echo e($dtl['_id']); ?>">
                                </div>
                                <div class="col-sm-5">
                                    <label>Attribute<span class="text-danger">*</span></label>
                                    <input type="text" name="product_details[<?php echo e($key); ?>][attr]"  class="form-control select_attribute" value="<?php echo e($dtl['attribute']); ?>">
                                    <span class="text-danger err"></span>
                                </div>
                                <div class="col-sm-5">
                                    <label>Value<span class="text-danger">*</span></label>
                                    <input type="text" name="product_details[<?php echo e($key); ?>][val]" class="form-control input_value" value="<?php echo e($dtl['value']); ?>">
                                    <span class="text-danger err"></span>
                                </div>
                                <div class="col-sm-1" style="align-content: center;">
                                    <?php if($key == 1): ?>
                                    <button type="button" class="btn btn-success" id="add_attr">+</button>
                                    <?php else: ?>
                                    <button type="button" class="btn btn-danger" id="add_attr" onclick="rmvDetailAttr(this)">-</button>
                                    <?php endif; ?>
                                </div>
                            </div>
                        
    <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
</div>
<?php else: ?>

<div class="row mb-3 append_input">
    <div class="row" id="row-1">
                                <div class="col-sm-1 text-center" style="align-content: center;">
                                      <span class="dtl_attr_cnt">1.</span>
                                </div>
                                <div class="col-sm-5">
                                    <label>Attribute<span class="text-danger">*</span></label>
                                    <input type="text" name="product_details[0][attr]"  class="form-control select_attribute" >
                                    <span class="text-danger err"></span>
                                </div>
                                <div class="col-sm-5">
                                    <label>Value<span class="text-danger">*</span></label>
                                    <input type="text" name="product_details[0][val]" class="form-control input_value">
                                    <span class="text-danger err"></span>
                                </div>
                                <div class="col-sm-1" style="align-content: center;">
                                    <button type="button" class="btn btn-success" id="add_attr">+</button>
                                </div>
                            </div>
                        </div>
<?php endif; ?><?php /**PATH D:\Laravel_Mongodb\resources\views/admin/products/product_details_content.blade.php ENDPATH**/ ?>