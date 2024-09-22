
@if(count($cart_detail) > 0)
<div class="row side_cart">
@foreach($cart_detail as $key => $cart)
@php $quantity = $cart['quantity'];
  $cart_id = $cart['_id'];  @endphp
		@if($cart['variation'] != null)
			@php
	          
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
        <div id="div-{{$key+1}}">
        <img src="{{asset($image)}}" class="img-responsive p-3" width="100%" height="90px" style="cursor: pointer; margin-top:0px; margin-bottom:0px;">
        <p>{{$name}}</p>
        <p><strike>${{$amount}}</strike></p>
        <p style="border-bottom:1px solid #ccc; padding-bottom:5px;">${{$mrp}} <i class="fa fa-trash btn-sm btn-danger" style="font-size:10px;"  onclick="dltCartItem('{{$cart_id}}', '{{$key+1}}')"></i></p>
    </div>
@endforeach
</div>
@endif