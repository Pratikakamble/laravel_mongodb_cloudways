
<?php $__env->startSection('content'); ?>
<div id="carouselExampleSlidesOnly" class="carousel slide" data-bs-ride="carousel">
	<div class="carousel-inner pt-4" style="height:380px; background-color:#efefef;">
	<?php if(count($products) >= 1): ?>
	  	<?php for($i = 0; $i < count($products); $i++): ?>
	  		
		  			<div class="carousel-item  <?php echo e(($i == 0) ? 'active'  : ''); ?> ">
					    <div class="col-md-10 mx-auto">
					    	<div class="row">
					    		<?php $__currentLoopData = $products[$i]; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $key => $val): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
							    	<div class="col-md-3">
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
			
	  	<?php endfor; ?>
	<?php else: ?>

	<div class="carousel-item active">
					    <div class="col-md-10 mx-auto">
					    	<div class="row">
					    		<div class="col-md-4 mx-auto bg-light">
					    		No Products Found of this Category.
					    		</div>
					    	</div>
					    </div>
					</div>
	<?php endif; ?>




	</div>
</div>


<div class="row pt-3">
	<?php $__currentLoopData = $all_products; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $key => $value): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?> 
        <?php if(count($value['products']) >= 1): ?>
            <?php $products = $value['products']; 
            shuffle($value['products']);
            ?> 
            <div class="col-md-3 text-center">

            	<div class="card text-center">
            		<h6 class="card-title text-center pt-3"><?php echo e($value['name']); ?></h6>
            		<div class="row p-1">
            				<?php
            				 $products = (count($products) >= 4) ? array_slice($products, 0, 4) : array_slice($products, 0, 2);
            				?>
							<?php $__currentLoopData = $products; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $k => $v): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
					            <div class="col-md-6">
					               	<div class="card text-center m-1">
					                	<?php if(isset($v['image'])): ?>
											<img src="<?php echo e(asset($v['image'])); ?>"  style="padding:20px;" height="150" class="card-img-top" >
										<?php endif; ?>
										<p style="font-size:12px; font-weight:bold; margin:0px;" class="card-title"><?php echo e($v['brand_or_store'] ?? ''); ?></p>
										<p style="font-size:12px; font-weight:bold; margin:0px;" class="card-text">Price : $<?php echo e($v['selling_amount']); ?></p>
										<p style="font-size:12px; font-weight:bold; margin:0px;" ><strike>MRP : $<?php echo e($v['mrp_amount']); ?></strike></p>
									</div>
					            </div>
					        <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
		        	</div>
		        	<a href="/online-store/<?php echo e($value['products'][0]['category_id']); ?>"><button class="btn btn-primary btn-sm mx-auto pb-2" style="width:20%; margin:auto ">View All</button></a>
		        </div>
		        
        	</div>
        <?php endif; ?>
    <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
</div>
<?php $__env->stopSection(); ?>

<?php $__env->startSection('script'); ?>
<script>
	
	function displayVariation($vid){
		alert($vid);
	}

	$('#search').click(function(){
		var keyword = $('#keyword').val();
		var url_path ="/search-products/"+keyword;
		window.open(url_path,"_self");
		
	});
</script>
<?php $__env->stopSection(); ?>
<?php echo $__env->make('layouts.front_online_store', ['categories' => $categories], \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH D:\Laravel_Mongodb\resources\views/online_store.blade.php ENDPATH**/ ?>