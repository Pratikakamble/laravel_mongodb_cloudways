<?php if(isset($value_attribute)): ?>
<div class="row mb-3 append_single_val">

    <?php $__currentLoopData = $value_attribute; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $key => $val): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
    <?php if(!array_key_exists('has_multivalue', $val)): ?>
        <?php
        $key = $key+1;
        ?>
        <div class="row" id="row-<?php echo e($key); ?>">
                                    <div class="col-sm-1 text-center" style="align-content: center;">
                                        <span class="cnt"><?php echo e($key); ?>.</span>
                                        <input type="hidden"  class="hidden_attribute" name="value_attribute[<?php echo e($key); ?>][attribute_id]" value="<?php echo e($val['_id']); ?>">
                                    </div>
                                    <div class="col-sm-2">
                                        <label>Attribute<span class="text-danger">*</span></label>
                                        <select name="value_attribute[<?php echo e($key); ?>][attr]" class="form-control select_attr" >
                                            <option value="">Select Attribute</option>
                                            <?php $__currentLoopData = $attributes; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $attr): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                            <option value="<?php echo e($attr['_id']); ?>"

                                            <?php if($val['attribute_id'] == $attr['_id']): ?>
                                                selected
                                            <?php endif; ?>
                                            ><?php echo e($attr['name']); ?></option>
                                            <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                                        </select>
                                        <span class="err text-danger"></span>
                                    </div>
                                    <div class="col-sm-2">
                                        <label>Value<span class="text-danger">*</span></label>
                                        <input type="text" name="value_attribute[<?php echo e($key); ?>][val]" class="form-control input_val" value="<?php echo e($val['value']); ?>" >
                                        <span class="err text-danger"></span>
                                    </div>
                                   
                                    <div class="col-sm-2  product_img pro_atr_img" id="pro_atr_img-<?php echo e($key); ?>">
                                        <?php if(isset($val["image"])): ?>
                                          <img src='<?php echo e(asset($val["image"])); ?>' width='50%'>
                                        <?php else: ?>
                                        <div class="text-center" valign="middle" style="border:1px solid #ccc; background:#efefef; width:100%; height: 100%; align-content: center; border-radius:5px;">Image</div>
                                        <?php endif; ?>
                                    </div>
                                
                                    <div class="col-sm-2">
                                        <label>Image</label>
                                        <input type="file" name="value_attribute[<?php echo e($key); ?>][image]" class="form-control input_image" id="input_image-<?php echo e($key); ?>" onchange="loadFile(event, this, 'pro_atr')">
                                    </div>
                                    <div class="col-sm-2" style="align-content: center;">
                                        <?php if($key == 1): ?>
                                        <button type="button" class="btn btn-success" id="add_single_attr">+</button>
                                        <?php else: ?>
                                        <button type="button" class="btn btn-danger" onclick="rmvSingleVal(this)">-</button>
                                        <?php endif; ?>
                                    </div>
        </div>
    <?php endif; ?>
    <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
</div>

<?php else: ?>
<div class="row mb-3 append_single_val">
    <div class="row" id="row-1">
                                <div class="col-sm-1 text-center" style="align-content: center;">
                                       <span class="cnt">1.</span>
                                </div>
                                <div class="col-sm-2">
                                    <label>Attribute<span class="text-danger">*</span></label>
                                    <select name="value_attribute[0][attr]" class="form-control select_attr" >
                                        <option value="">Select Attribute</option>
                                        <?php $__currentLoopData = $attributes; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $attr): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                        <option value="<?php echo e($attr['_id']); ?>"><?php echo e($attr['name']); ?></option>
                                        <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                                    </select>
                                    <span class="text-danger err"></span>
                                </div>
                                <div class="col-sm-2">
                                    <label>Value<span class="text-danger">*</span></label>
                                    <input type="text" name="value_attribute[0][val]" class="form-control input_val" >
                                    <span class="text-danger err"></span>
                                </div>
                                <div class="col-sm-2  product_img pro_atr_img" id="pro_atr_img-1">
                                    <div class="text-center" valign="middle" style="border:1px solid #ccc; background:#efefef; width:100%; height: 100%; align-content: center; border-radius:5px;">Image</div>
                                </div>
                                <div class="col-sm-2">
                                    <label>Image</label>
                                    <input type="file" name="value_attribute[0][image]" class="form-control input_image" id="input_image-1" onchange="loadFile(event, this, 'pro_atr')">
                                </div>
                                <div class="col-sm-2" style="align-content: center;">
                                    <button type="button" class="btn btn-success" id="add_single_attr">+</button>
                                </div>
                        </div>
                    </div>
<?php endif; ?><?php /**PATH D:\Laravel_Mongodb\resources\views/admin/products/single_value_content.blade.php ENDPATH**/ ?>