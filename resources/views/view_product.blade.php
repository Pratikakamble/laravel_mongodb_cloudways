@extends('layouts.front_online_store', ['categories' => $categories, 'cart_count'  => $cart_count])
@section('content')
<style>
	.product_images img{
		cursor:pointer;
	}
	.cart_div{
		position: absolute;
	    top: 112px;
	    right: -12px;
	    padding-left:90px !important;
	    height:100vh;
	    overflow-y: scroll;
	}
	.side_cart p{
		font-size:11px;
		margin:0px;
		text-align: center;
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
		cartView();
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
					cartView();
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
					$('#cart_count').text(data.cart_count);
					cartView();
				}
			}
		});
	}

	function cartView(){
		$.ajax({
			url: "{{route('cart-view')}}",
			type: "get",
			success:function(data){
				if(data.success){
					if(data.content == ""){
						$('#cart_content').parent('div').css('display','none')
					}else{
						$('#cart_content').parent('div').css('display','block')
					}
					$('#cart_content').html(data.content);
					$('#cart_count').text(data.cart_count);
				}
			},
		});
	}

	function viewCartProducts(){
		window.location.href = "{{route('view-cart-content')}}";
	}

	function dltCartItem(cart_id, identy){
		$.ajax({
			url: '/dlt-cart',
			type: "post",
			data: {cart_id: cart_id},
			success:function(data){
				if(data.success){
					$('#cart_count').text(data.cart_count);
					cartView();
				}
			},
		});
	}
</script>
@endsection
