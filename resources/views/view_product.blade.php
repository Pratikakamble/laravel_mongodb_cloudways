@extends('layouts.front_online_store', ['categories' => $categories])
@section('content')
<style>
	.product_images img{
		cursor:pointer;
	}
</style>
	<div class="container-fluid">

		<input type="text" id="pro_id" value="{{$product['_id']}}">
		<input type="text" id="vrtn_id" value="">

		
		@if(!empty($product['variation']))
			<div class="row mt-4">
				<div class="col-md-12 ">
					<div style="display:flex; justify-content:initial;flex-wrap:wrap; cursor: pointer;">

						<div class="div_btn" data-pid="{{$product['_id']}}" style="border:1px solid #ccc; padding:5px; border-radius:5px;margin-left:10px;" onclick='viewProduct("{{$product['_id']}}")'>
							{{$product['product_name']}}

						</div>
					@foreach($product['variation'] as $key=>$val)
						<div  class="div_btn" data-vid="{{$val['_id']}}" style="border:1px solid #ccc; padding:5px; border-radius:5px;margin-left:10px;" onclick='displayVariation("{{$val['_id']}}")'>
							{{$val['variation_name']}}


						</div>
					@endforeach
				   </div>
				</div>
			</div>
		@endif
		<div id="view-product">
			
		</div>
	</div>
@endsection
@section('script')
<script>
	$.ajaxSetup({
        headers: {
            'X-CSRF-TOKEN' : $('meta[name="csrf-token"]').attr('content')
        }
    });


	$(document).ready(function(){
		var pid = "<?= $id ?>";
		viewProduct(pid);
	});

	function viewProduct(pid){
		$('#vrtn_id').val('pro_id');
		$.ajax({
			url: '/product-content/product/'+pid,
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


	function displayVariation(vid){
		$('#vrtn_id').val(vid);
		$.ajax({
			url: '/product-content/variation/'+vid,
			type: "get",
			success:function(data){
				if(data.success){
					$('#view-product').html(data.content);
				}
			}
		});
	}

	$('.div_btn').click(function(){
		$('.div_btn').css('background-color','#fff');
		$(this).css('background-color','#efefef');
	});

	function addToCart(){
		var pro_id = $('#pro_id').val();
		var vrtn_id = $('#vrtn_id').val();
		var atr_val = [];
		$('.tab-pane').each(function(){
			if($(this).hasClass('active')){
				atr_val.push($(this).find('input.atr_val').val());
			}
		});
		var selling_amount = $('#selling_amount').val();
		$.ajax({
			url: '/add-to-cart',
			type: "post",
			data: {pro_id:pro_id, vrtn_id:vrtn_id, atr_val:atr_val, selling_amount:selling_amount},
			success:function(data){
				if(data.success){
					$('#cart_content').html(data.content);
				}
			}
		});
	}

	

</script>
@endsection
