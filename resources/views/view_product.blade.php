@extends('layouts.front_online_store', ['categories' => $categories])
@section('content')
<style>
	.product_images img{
		cursor:pointer;
	}
</style>
	<div class="container-fluid">
		<div id="view-product">
			
		</div>
	</div>
@endsection
@section('script')
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
@endsection
