
<?php $__env->startSection('content'); ?>
	<?php $total=0 ?>
		<div class="container">
			<h4 class="mt-3">Cart Details</h4>
			<?php if(!empty($cart_detail)): ?>
			<div class="table-responsive">
				<table class="table">
					<thead>
						<tr>
							<th width="10%">Sr. No.</th>
							<th width="10%">Image</th>
							<th width="20%">Product Details</th>
							<th width="15%">Quantity</th>
							<th width="15%">Price</th>
							<td width="15%">Amount</td>
							<td width="15%">Action</td>
						</tr>
					</thead>

					
					<tbody>
						<?php $__currentLoopData = $cart_detail; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $key => $cart): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
						<?php $quantity =  (is_numeric($cart['quantity'])) ? $cart['quantity'] :1;  ?>
							<?php if($cart['variation'] != null): ?>
								<?php
						            $cart_id = $cart['_id'];
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

					        <tr class="tr" id="tr-<?php echo e($key+1); ?>">
					        	<td class="sr_no"><?php echo e($key+1); ?></td>
					        	<td class="align-center"><img src="<?php echo e(asset($image)); ?>" class="img-responsive p-3"  height="90px" style="cursor: pointer; margin-top:0px; margin-bottom:0px;"></td>
					        	<td><?php echo e($name); ?></td>
					        	<td><input type="number" min="0" name="qnt" id="qnt" onkeyup="updateQnt('<?php echo e($cart["_id"]); ?>', this.value, '<?php echo e($amount); ?>','<?php echo e($key+1); ?>')" style="width:30%" value="<?php echo e($quantity); ?>"></td>
					        	<td><?php echo e($amount); ?></td>
					        	<?php $ttl = $quantity * $amount; 
					        	$total += $ttl;
					        	?>
					        	<td class="ttl" id="ttl-<?php echo e($key+1); ?>"><?php echo e($ttl); ?></td>
					        	<td><button class="btn btn-danger" onclick="dltCartItem('<?php echo e($cart["_id"]); ?>', '<?php echo e($key+1); ?>')"><i class="fa fa-trash"></i></button></td>
					        </tr>
						<?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
						<tr>
							<td align="center" colspan="5">Total</td>
							<td id="total_amount"><?php echo e($total); ?></td>
						</tr>
					</tbody>
							
				</table>
			</div>
			<?php else: ?> 
			<h6>Your cart is empty.<a href="/online-store"> Go to cart. </a></h6>
			<?php endif; ?>		
		</div>
	
<?php $__env->stopSection(); ?>

<?php $__env->startSection('script'); ?>
<script>
	$.ajaxSetup({
        headers: {
            'X-CSRF-TOKEN' : $('meta[name="csrf-token"]').attr('content')
        }
    });

	function updateQnt(cart_id, qnt, price, identy){
		var amount = qnt * price;
		$.ajax({
			url: '/update-qnt',
			type: "post",
			data: {cart_id: cart_id, qnt: qnt},
			success:function(data){
				if(data.success){
					$('#ttl-'+identy).text(amount);
					total_amount();
				}
			},
		});
	}

	function dltCartItem(cart_id, identy){
		$.ajax({
			url: '/dlt-cart',
			type: "post",
			data: {cart_id: cart_id},
			success:function(data){
				if(data.success){
					$('#cart_count').text(data.cart_count);
					$('#tr-'+identy).remove();
					total_amount();
					if($('tr.tr').length == 0){
						window.location.reload();
					}

				}
			},
		});
	}

	function total_amount(){
		$('.sr_no').each(function(k, v){
			$(this).text(parseInt(k)+1);
		});
		var total_amount = 0;
		$('.ttl').each(function(k,v){
			total_amount = parseInt(total_amount) + parseInt($(this).text());
		});
		$('#total_amount').text(total_amount);
	}
	
</script>
<?php $__env->stopSection(); ?>
<?php echo $__env->make('layouts.front_online_store', ['categories' => $categories], \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH D:\Laravel_Mongodb\resources\views/view_cart.blade.php ENDPATH**/ ?>