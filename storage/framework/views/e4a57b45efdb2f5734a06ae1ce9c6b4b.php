<table id="myTable" class="display">
				<thead style="text-align: left;">
					<tr>
						<th width="10%">Sr. No.</th>
						<th width="10%">Category</th>
						<th width="10%">Sub Category</th>
						<th width="10%">Brand or Store</th>
						<th width="10%">Image</th>
						<th width="10%">Product Name</th>
						<th width="10%">Amount</th>
						<th width="10%">Discount</th>
						<th width="10%">Action</th>
					</tr>
				</thead>
				<tbody>
					<?php $__currentLoopData = $products; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $key => $product): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
						<tr>
							<td><?php echo e($key+1); ?></td>
							<td><?php echo e($product['subcategory']['name'] ?? ''); ?></td>
							<td>
								<?php echo e($product['subcategory']['category']['name'] ?? ''); ?>

							</td>
							<td>
								<?php echo e($product['brand_or_store'] ?? ''); ?>

							</td>

							<td>
								<?php if(isset($product['image'])): ?>
								<img src="<?php echo e(asset($product['image'])); ?>" width="50px" class="img-responsive">
								<?php endif; ?>
							</td>

							<td>
								<?php echo e($product['product_name'] ?? ''); ?>

							</td>

							<td>
								<?php echo e($product['selling_amount'] ?? ''); ?>

							</td>
							<td>
								<?php echo e($product['discount_amount'] ?? ''); ?>

							</td>
							<td>
								<a href="<?php echo e(url('/edit-product/'.$product['_id'])); ?>"><button type="button" class="btn btn-success" ><i class="fa fa-edit"></i></button><a>
								<button type="button" onclick="deleteProduct('<?php echo e($product["_id"]); ?>')" class="btn btn-danger" ><i class="fa fa-trash"></i></button>
							</td>
						</tr>
					<?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>	
				</tbody>
			</table>
<?php /**PATH D:\Laravel_Mongodb\resources\views/admin/products/product_datatable.blade.php ENDPATH**/ ?>