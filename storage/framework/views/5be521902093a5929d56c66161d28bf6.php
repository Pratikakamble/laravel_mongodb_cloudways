
<?php $__env->startSection('content'); ?>
<div class="row">
					    <div class="col-md-10 mx-auto">
					    	<div class="row">
					    			<?php $__currentLoopData = $products; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $key => $val): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
							    	<div class="col-md-3 mb-3">
								    	<div class="card" style="width: 18rem;">
										    <?php if(isset($val['image'])): ?>
											<img src="<?php echo e(asset($val['image'])); ?>"  style="padding:20px;" height="180" class="card-img-top" >
											<?php endif; ?>
										  <div class="card-body text-center">
										    <h5 class="card-title"><?php echo e($val['brand_or_store'] ?? ''); ?></h5>
										    <p class="card-text">Price : $<?php echo e($val['selling_amount']); ?></p>
										    <p><strike>MRP : $<?php echo e($val['mrp_amount']); ?></strike></p>
										    <a href="/view-product/product/<?php echo e($val['_id']); ?>" class="btn btn-primary text-center">View</a>
										  </div>
										</div>
									</div>
								<?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
							</div>
						</div>
	  	
</div>

<?php $__env->stopSection(); ?>


<?php $__env->startSection('script'); ?>
<script>
	$('#search').click(function(){
		var keyword = $('#keyword').val();
		var url_path ="/search-products/"+keyword;
		window.open(url_path,"_self");
	});
</script>
<?php $__env->stopSection(); ?>
<?php echo $__env->make('layouts.front_online_store', ['categories' => $categories], \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH D:\Laravel_Mongodb\resources\views/search_products.blade.php ENDPATH**/ ?>