
<?php if(count($cart_detail) > 0): ?>
<div class="row side_cart">
<?php $__currentLoopData = $cart_detail; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $key => $cart): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
<?php $quantity = $cart['quantity'];
  $cart_id = $cart['_id'];  ?>
		<?php if($cart['variation'] != null): ?>
			<?php
	          
	            $name = $cart['variation']['variation_name'];
	            $image = $cart['variation']['pro_image'];
	            $mrp = $cart['variation']['mrp'];
	            $amount = $cart['variation']['selling_price'];
	        ?>
        <?php elseif($cart['product'] != null): ?>
        	<?php
	            $name = $cart['product']['product_name'];
	            $image = $cart['product']['image'];
	            $mrp = $cart['product']['mrp_amount'];
	            $amount = $cart['product']['selling_amount'];
            ?>
        <?php endif; ?>
        <div id="div-<?php echo e($key+1); ?>">
        <img src="<?php echo e(asset($image)); ?>" class="img-responsive p-3" width="100%" height="90px" style="cursor: pointer; margin-top:0px; margin-bottom:0px;">
        <p><?php echo e($name); ?></p>
        <p><strike>$<?php echo e($amount); ?></strike></p>
        <p style="border-bottom:1px solid #ccc; padding-bottom:5px;">$<?php echo e($mrp); ?> <i class="fa fa-trash btn-sm btn-danger" style="font-size:10px;"  onclick="dltCartItem('<?php echo e($cart_id); ?>', '<?php echo e($key+1); ?>')"></i></p>
    </div>
<?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
</div>
<?php endif; ?><?php /**PATH D:\Laravel_Mongodb\resources\views/cart_content.blade.php ENDPATH**/ ?>