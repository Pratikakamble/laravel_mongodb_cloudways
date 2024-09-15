
<div class="row">
<?php $__currentLoopData = $cart_detail; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $cart): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
		<?php if($cart['variation'] != null): ?>
			<?php
	            $cart_id = $cart->_id;
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
        
        <img src="<?php echo e(asset($image)); ?>" class="img-responsive p-3" width="100%" height="90px" style="cursor: pointer;">
        <p><?php echo e($name); ?></p>
        <p>$<?php echo e($mrp); ?></p>
        <p>$<?php echo e($amount); ?></p>
<?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
</div><?php /**PATH D:\Laravel_Mongodb\resources\views/cart_content.blade.php ENDPATH**/ ?>