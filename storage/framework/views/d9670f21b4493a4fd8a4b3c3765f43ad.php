<?php if(isset($product_images)): ?>
				<div class="row mb-3">
	                <label class="col-sm-2 col-form-label">Multiple Images<span class="text-danger">*</span></label>
	                <div class="col-sm-10">
	                    <input type="file" name="product_images[]" multiple id="image-1"  class="form-control" onchange="loadMultiple(event, this.id)">
	                </div>
                </div>
				<div class="row" id="image_preview" >
					<div class="row">
					<?php $__currentLoopData = $product_images; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $img): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
						<div class='col-2'><img src="<?php echo e(asset($img['image'])); ?>" class="img-fluid"></div>
					<?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
				    </div>
				</div>
<?php else: ?>
			<div class="row mb-3">
                <label class="col-sm-2 col-form-label">Multiple Images<span class="text-danger">*</span></label>
                <div class="col-sm-10">
                    <input type="file" name="product_images[]" multiple id="image-1"  class="form-control" onchange="loadMultiple(event, this.id)">
                    <span class="text-danger product_images"></span>
                </div>
            </div>
				<div class="row" id="image_preview" ></div>
<?php endif; ?><?php /**PATH D:\Laravel_Mongodb\resources\views/admin/products/product_image_content.blade.php ENDPATH**/ ?>