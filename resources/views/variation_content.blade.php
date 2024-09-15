
<input type="hidden" id="variation_id" value="">
<div class="row mt-2">
				<div class="col-md-1 text-center product_images">

					@php
						$images = array_column($product['variation_attribute'],'image');
					@endphp

					@foreach($images as $key => $img)
						<img src="{{asset($img)}}" class="img-responsive p-3" width="100%" height="90px" style="cursor: pointer;">
					@endforeach
				</div>

				<div class="col-md-4 bg-light ">
					<img src = "{{ asset($images[0]) }}" class="img-fluid mt-3" id="image" style="width:475px; cursor: pointer;">
				</div>
				<input type="hidden" id="selling_amount" value="{{$product['selling_price'] ?? ''}}"> 

				<div class="col-md-4 px-4">
					<div class="product_details product_images">
						<p><h5><strong>Brand</strong></h5><p>
						<p><b>Product Name </b>: {{$product['variation_name'] ?? ''}} <p>
						<p><b>Price </b>: {{$product['selling_price'] ?? ''}} Rs,
							<small>M.R.P.:<strike>{{$product['mrp']}}</strike></small>
						</p>
						<p>
							<b>Discount</b>:{{$product['discount'] ?? ''}} Rs
						<p>

						@php
						    $data = collect($product['variation_attribute'])->groupBy('attr_id')->toArray();
						@endphp
<!-- Tab panes -->
<div class="tab-content">
	@foreach($data as $key => $val)
		@if(count($val) > 1)
			@foreach($val as $k => $atr)
			    <div id="{{'identy'}}{{$k+1}}" class="container tab-pane @if($k == 0) active @endif" style="padding:0px;">
			    	<p><b>{{$atr['attr_id']}}</b>: <span>{{$atr['attr_val']}}</span></p>


			    	<input type="text" class="form-control atr_val" value="{{$atr['attr_id'].':'.$atr['attr_val']}}"> 
			    </div>
			@endforeach
		@endif
	@endforeach
</div>

<ul class="nav nav-tabs" role="tablist">
	@foreach($data as $key => $val)
		@if(count($val) > 1)
			@foreach($val as $k => $atr)
			    <li class="nav-item" >
			      <a class="nav-link @if($k == 0) active @endif" data-bs-toggle="tab" href="#{{'identy'}}{{$k+1}}" style="margin:0px !important; padding:0px !important;">
			      	
			      	@if(array_key_exists('image', $atr))
						<img src="{{asset($atr['image'])}}" class="img-responsive p-3" height="100px" style="cursor: pointer;">
					@else
						<div height="100px" class="bg-light" style="cursor: pointer; border:1px solid #ccc; text-align: center; margin-top:15px; margin-bottom:15px; padding:22px; display: inline;">{{$atr['value']}}</div>
					@endif

			      </a>
			    </li>
    		@endforeach
		@endif
	@endforeach
</ul>




						@if(!empty($product['variation_detail']))
							<div class="row pro_dtl">
								<h6 class="mb-2 mt-5"><strong>Product Details</strong></h6>
								<div class="table-responsive">
									<table class="table ">
									@foreach($product['variation_detail'] as $key => $dtl)
										<tr>
											<td><b>{{$dtl['attr_name']}}</b></td>
											<td>{{$dtl['attr_val']}}</td>
										</tr>
									@endforeach
								    </table>
								</div>
							</div>
						@endif

						<button class="btn btn-primary mt-2" onclick="addToCart()">Add To Cart</button>
						<a href="{{url('stripe/'.$product['selling_price'])}}"><button class="btn btn-success mt-2">Buy Now</button></a>
					</div>
				</div>
				
				<div class="col-md-2 bg-light px-1">
					<p>Delivery Date</p>
					<p>Delivery Charges</p>
				</div>

				<div class="col-md-1" >
					<div class="shadow p-3 mb-5 bg-white rounded" style="height:100vh;">
						<p><b>Cart</b></p>
						<div id="cart_content" ></div>
					</div>
					
				</div>
				
			</div>



