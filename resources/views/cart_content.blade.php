
<div class="row">
@foreach($cart_detail as $cart)
		@if($cart['variation'] != null)
			@php
	            $cart_id = $cart->_id;
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
        
        <img src="{{asset($image)}}" class="img-responsive p-3" width="100%" height="90px" style="cursor: pointer;">
        <p>{{$name}}</p>
        <p>${{$mrp}}</p>
        <p>${{$amount}}</p>
@endforeach
</div>