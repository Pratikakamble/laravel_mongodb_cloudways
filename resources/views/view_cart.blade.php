@extends('layouts.front_online_store', ['categories' => $categories])
@section('content')
	@php $total=0 @endphp
		<div class="container">
			<h4 class="mt-3">Cart Details</h4>
			@if(!empty($cart_detail))
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
						@foreach($cart_detail as $key => $cart)
						@php $quantity =  (is_numeric($cart['quantity'])) ? $cart['quantity'] :1;  @endphp
							@if($cart['variation'] != null)
								@php
						            $cart_id = $cart['_id'];
						            $name = $cart['variation']['variation_name'];
						            $image = $cart['variation']['pro_image'];
						            $mrp = $cart['variation']['mrp'];
						            $amount = $cart['variation']['selling_price'];
						        @endphp
					        @elseif($cart['product'] != null)
					        	@php
						            $name = $cart['product']['product_name'];
						            $image = $cart['product']['image'];
						            $mrp = $cart['product']['mrp_amount'];
						            $amount = $cart['product']['selling_amount'];
					            @endphp
					        @endif

					        <tr class="tr" id="tr-{{$key+1}}">
					        	<td class="sr_no">{{ $key+1 }}</td>
					        	<td class="align-center"><img src="{{asset($image)}}" class="img-responsive p-3"  height="90px" style="cursor: pointer; margin-top:0px; margin-bottom:0px;"></td>
					        	<td>{{$name}}</td>
					        	<td><input type="number" min="0" name="qnt" id="qnt" onkeyup="updateQnt('{{$cart["_id"]}}', this.value, '{{$amount}}','{{$key+1}}')" style="width:30%" value="{{$quantity}}"></td>
					        	<td>{{ $amount }}</td>
					        	@php $ttl = $quantity * $amount; 
					        	$total += $ttl;
					        	@endphp
					        	<td class="ttl" id="ttl-{{$key+1}}">{{ $ttl }}</td>
					        	<td><button class="btn btn-danger" onclick="dltCartItem('{{$cart["_id"]}}', '{{$key+1}}')"><i class="fa fa-trash"></i></button></td>
					        </tr>
						@endforeach
						<tr>
							<td align="center" colspan="5">Total</td>
							<td id="total_amount">{{$total}}</td>
							<td><a href="{{url('stripe/'.$total)}}" class="btn btn-success">Proceed to Buy</a></td>
						</tr>
					</tbody>
							
				</table>
			</div>
			@else 
			<h6>Your cart is empty.<a href="/online-store"> Go to cart. </a></h6>
			@endif		
		</div>
	
@endsection

@section('script')
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
@endsection