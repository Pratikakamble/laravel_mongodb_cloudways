
<?php $__env->startSection('content'); ?>
<style>
	.product_images img{
		cursor:pointer;
	}
</style>
	<div class="container-fluid">
		<div id="view-product">
			
		</div>
	</div>
<?php $__env->stopSection(); ?>
<?php $__env->startSection('script'); ?>
<script>
	$(document).ready(function(){
		var pid = "<?= $id ?>";
		viewProduct(pid);
	});

	function viewProduct(pid){
		$.ajax({
			url: '/product-content/'+pid,
			type: "get",
			success:function(data){
				if(data.success){
					$('#view-product').html(data.content);
				}
			}
		});
	}

	$(document).on('click','.product_images img', function(){
		var src = $(this).attr('src');
		$('#image').attr('src', src);
	});
</script>
<?php $__env->stopSection(); ?>

<?php echo $__env->make('layouts.front_online_store', ['categories' => $categories], \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH D:\Laravel_Mongodb\resources\views/view_product.blade.php ENDPATH**/ ?>