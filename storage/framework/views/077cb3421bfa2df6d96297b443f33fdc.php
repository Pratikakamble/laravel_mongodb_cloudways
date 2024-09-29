
<input type="hidden" id="variation_id" value="">
<div class="row mt-2">
				<div class="col-md-1 text-center product_images">

					<?php
						$images = array_column($product['variation_attribute'],'image');
					?>


					<?php if(!empty($images)): ?>
					<?php $__currentLoopData = $images; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $img): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
						<img src="<?php echo e(asset($img)); ?>" class="img-responsive p-3" width="100%" height="90px" style="cursor: pointer;">
					<?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
					<?php endif; ?>
				</div>

				<div class="col-md-4 bg-light ">
					<img src = "<?php echo e(asset($product['pro_image'] ?? '')); ?>" class="img-fluid mt-3" id="image" style="width:475px; cursor: pointer;">
				</div>
				<input type="hidden" id="selling_amount" value="<?php echo e($product['selling_price'] ?? ''); ?>"> 

				<div class="col-md-5 px-4">
					<div class="product_details product_images">
						<div class="row">
							<div class="col-md-8">
								<p><h5><strong>Brand</strong></h5><p>
								<p><b>Product Name </b>: <?php echo e($product['variation_name'] ?? ''); ?> <p>
								<p><b>Price </b>: <?php echo e($product['selling_price'] ?? ''); ?> Rs,
									<small>M.R.P.:<strike><?php echo e($product['mrp']); ?></strike></small>
								</p>
								<p>
									<b>Discount</b>:<?php echo e($product['discount'] ?? ''); ?> Rs
								<p>

						    </div>
							<div class="col-md-4">
								
									<p>Delivery Date</p>
									<p>Delivery Charges</p>
									
								
							</div>
<div class="row">
								<?php
								    $data = collect($product['variation_attribute'])->groupBy('attr_id')->toArray();
								?>
<!-- Tab panes -->
<div class="tab-content">
	<?php $__currentLoopData = $data; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $key => $val): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
		<?php if(count($val) > 1): ?>
			<?php $__currentLoopData = $val; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $k => $atr): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
			    <div id="<?php echo e('identy'); ?><?php echo e($k+1); ?>" class="container tab-pane <?php if($k == 0): ?> active <?php endif; ?>" style="padding:0px;">
			    	<p><b><?php echo e($atr['attr_id']); ?></b>: <span><?php echo e($atr['attr_val']); ?></span></p>


			    	<input type="hidden" class="form-control atr_val" value="<?php echo e($atr['attr_id'].':'.$atr['attr_val']); ?>"> 
			    </div>
			<?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
		<?php endif; ?>
	<?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
</div>

<ul class="nav nav-tabs" role="tablist">
	<?php $__currentLoopData = $data; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $key => $val): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
		<?php if(count($val) > 1): ?>
			<?php $__currentLoopData = $val; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $k => $atr): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
			    <li class="nav-item" >
			      <a class="nav-link <?php if($k == 0): ?> active <?php endif; ?>" data-bs-toggle="tab" href="#<?php echo e('identy'); ?><?php echo e($k+1); ?>" style="margin:0px !important; padding:0px !important;">
			      	
			      	<?php if(array_key_exists('image', $atr)): ?>
						<img src="<?php echo e(asset($atr['image'])); ?>" class="img-responsive p-3" height="100px" style="cursor: pointer;">
					<?php else: ?>
						<div height="100px" class="bg-light" style="cursor: pointer; border:1px solid #ccc; text-align: center; margin-top:15px; margin-bottom:15px; padding:22px; display: inline;"><?php echo e($atr['value']); ?></div>
					<?php endif; ?>

			      </a>
			    </li>
    		<?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
		<?php endif; ?>
	<?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
</ul>

</div>

<div class="row">
	<?php $__currentLoopData = $data; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $key => $val): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
		<?php if(count($val) == 1): ?>
			<?php $__currentLoopData = $val; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $k => $atr): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
			   <p><b><?php echo e($atr['attribute']['name'] ?? ''); ?></b>: <span><?php echo e($atr['attr_val'] ?? ''); ?></span></p>
			<?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
		<?php endif; ?>
	<?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
</div>
						<?php if(!empty($product['variation_detail'])): ?>
							<div class="row pro_dtl">
								<h6 class="mb-2 mt-5"><strong>Product Details</strong></h6>
								<div class="table-responsive">
									<table class="table ">
									<?php $__currentLoopData = $product['variation_detail']; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $key => $dtl): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
										<tr>
											<td><b><?php echo e($dtl['attr_name']); ?></b></td>
											<td><?php echo e($dtl['attr_val']); ?></td>
										</tr>
									<?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
								    </table>
								</div>
							</div>
						<?php endif; ?>

<div style="display: flex">
						<button class="btn btn-primary btn-sm mt-2" onclick="addToCart()"  style="width:20%; ">Add To Cart</button>
						<a href="<?php echo e(url('stripe/'.$product['selling_price'])); ?>"><button class="pl-2 btn btn-success mt-2">Buy Now</button></a>
					</div>
					</div>
				</div>
				

			
				<div class="col-md-2 cart_div">
					
					<div class="shadow p-3 mb-5 bg-white rounded cart_count">
						<p style="margin:0px; padding:0px;  text-align: center;"><button type="button" class="btn btn-outline-success" style="padding:5px 4px; font-size:11px; font-weight: bold;" onclick="viewCartProducts()">View Cart</button></p>
						<div id="cart_content" ></div>
					</div>
					
				</div>
				
				
			</div>



<?php /**PATH D:\Laravel_Mongodb\resources\views/variation_content.blade.php ENDPATH**/ ?>