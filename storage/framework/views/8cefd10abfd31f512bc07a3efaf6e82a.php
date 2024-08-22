
<?php if(!empty($product['variation'])): ?>
<div class="row mt-4">
	<div class="col-md-12 ">
		<div style="display:flex; justify-content:initial;flex-wrap:wrap; cursor: pointer;">
		<?php $__currentLoopData = $product['variation']; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $key=>$val): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
			<div style="border:1px solid #ccc; padding:5px; border-radius:5px;margin-left:10px;">
				<?php echo e($val['variation_name']); ?>

			</div>
		<?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
	   </div>
	</div>
</div>
<?php endif; ?>
<div class="row mt-2">
				<div class="col-md-1 text-center product_images">
					<?php $__currentLoopData = $product['product_images']; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $key => $img): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
						<img src="<?php echo e(asset($img['image'])); ?>" class="img-responsive p-3" width="100%" height="90px" style="cursor: pointer;">
					<?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
				</div>

				<div class="col-md-4 bg-light ">
					<img src = "<?php echo e(asset($product['image'])); ?>" class="img-fluid mt-3" id="image" style="width:475px; cursor: pointer;">
				</div>

				<div class="col-md-4 px-4">
					<div class="product_details product_images">
						<p><h5><strong><?php echo e($product['brand_or_store']); ?></strong></h5><p>
						<p><b>Product Name </b>: <?php echo e($product['product_name'] ?? ''); ?> <p>
						<p><b>Price </b>: <?php echo e($product['selling_amount'] ?? ''); ?> Rs,
							<small>M.R.P.:<strike><?php echo e($product['mrp_amount']); ?></strike></small>
						</p>
						<p>
							<b>Discount</b>:<?php echo e($product['discount_amount'] ?? ''); ?> Rs
						<p>

						<?php
						    $data = collect($product['value_attribute'])->groupBy('attribute_id')->toArray();
						?>

						

						<div >
							<?php $__currentLoopData = $data; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $key => $val): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
								<?php if(count($val) > 1): ?>
									<?php $__currentLoopData = $val; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $k => $atr): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>

									<?php if($k == 0): ?>
										<p><b><?php echo e($atr['attribute']['name']); ?></b>: <span>val</span></p>
									<?php endif; ?>

										<?php if(array_key_exists('image', $atr) && ($k == 0 || $k == 1) ): ?>
											<img src="<?php echo e(asset($atr['image'])); ?>" class="img-responsive p-3" height="100px" style="cursor: pointer;">
										<?php else: ?>
											<div height="100px" class="bg-light" style="cursor: pointer; border:1px solid #ccc; text-align: center; margin-top:15px; margin-bottom:15px; padding:22px; display: inline;"><?php echo e($atr['value']); ?></div>
										<?php endif; ?>

									<?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
								<?php endif; ?>
							<?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
						</div>

						
						
						<div style="border-top:1px solid #efefef;">
						<?php $__currentLoopData = $product['value_attribute']; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $val): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
							<?php if(count($data[$val['attribute_id']]) < 2): ?>
								<p><b><?php echo e($val['attribute']['name']); ?></b> : <?php echo e($val['value']); ?></p>
								<?php if(array_key_exists('image', $val)): ?>
									<img src="<?php echo e(asset($val['image'])); ?>" class="img-responsive p-3" height="100px" style="cursor: pointer;">
								<?php endif; ?>
							<?php endif; ?>
						<?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
						</div>


						<?php if(!empty($product['product_details'])): ?>
							<div class="row pro_dtl">
								<h6 class="mb-2 mt-5"><strong>Product Details</strong></h6>
								<div class="table-responsive">
									<table class="table ">
									<?php $__currentLoopData = $product['product_details']; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $key => $dtl): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
										<tr>
											<td><b><?php echo e($dtl['attribute']); ?></b></td>
											<td><?php echo e($dtl['value']); ?></td>
										</tr>
									<?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
								    </table>
								</div>
							</div>
						<?php endif; ?>

						<button class="btn btn-primary mt-2">Add To Cart</button>
						<a href="<?php echo e(url('stripe/'.$product['selling_amount'])); ?>"><button class="btn btn-success mt-2">Buy Now</button></a>
					</div>
				</div>
				
				<div class="col-md-2 bg-light px-3">
					<p>Delivery Date</p>
					<p>Delivery Charges</p>
				</div>
				
			</div><?php /**PATH D:\Laravel_Mongodb\resources\views/product_content.blade.php ENDPATH**/ ?>