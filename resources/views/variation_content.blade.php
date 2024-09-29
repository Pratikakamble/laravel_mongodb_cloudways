
<input type="hidden" id="variation_id" value="">
<div class="row mt-2">
				<div class="col-md-1 text-center product_images">

					@php
						$images = array_column($product['variation_attribute'],'image');
					@endphp


					@if(!empty($images))
					@foreach($images as $img)
						<img src="{{asset($img)}}" class="img-responsive p-3" width="100%" height="90px" style="cursor: pointer;">
					@endforeach
					@endif
				</div>

				<div class="col-md-4 bg-light ">
					<img src = "{{asset($product['pro_image'] ?? '')}}" class="img-fluid mt-3" id="image" style="width:475px; cursor: pointer;">
				</div>
				<input type="hidden" id="selling_amount" value="{{$product['selling_price'] ?? ''}}"> 

				<div class="col-md-5 px-4">
					<div class="product_details product_images">
						<div class="row">
							<div class="col-md-8">
								<p><h5><strong>Brand</strong></h5><p>
								<p><b>Product Name </b>: {{$product['variation_name'] ?? ''}} <p>
								<p><b>Price </b>: {{$product['selling_price'] ?? ''}} Rs,
									<small>M.R.P.:<strike>{{$product['mrp']}}</strike></small>
								</p>
								<p>
									<b>Discount</b>:{{$product['discount'] ?? ''}} Rs
								<p>

						    </div>
							<div class="col-md-4">
								
									<p>Delivery Date</p>
									<p>Delivery Charges</p>
									
								
							</div>
<div class="row">
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


			    	<input type="hidden" class="form-control atr_val" value="{{$atr['attr_id'].':'.$atr['attr_val']}}"> 
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

</div>

<div class="row">
	@foreach($data as $key => $val)
		@if(count($val) == 1)
			@foreach($val as $k => $atr)
			   <p><b>{{$atr['attribute']['name'] ?? ''}}</b>: <span>{{$atr['attr_val'] ?? ''}}</span></p>
			@endforeach
		@endif
	@endforeach
</div>
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

<div style="display: flex">
						<button class="btn btn-primary btn-sm mt-2" onclick="addToCart()"  style="width:20%; ">Add To Cart</button>
						<a href="{{url('stripe/'.$product['selling_price'])}}"><button class="pl-2 btn btn-success mt-2">Buy Now</button></a>
					</div>
					</div>
				</div>
				

			
				<div class="col-md-2 cart_div">
					
					<div class="shadow p-3 mb-5 bg-white rounded cart_count">
						<p style="margin:0px; padding:0px;  text-align: center;"><button type="button" class="btn btn-outline-success" style="padding:5px 4px; font-size:11px; font-weight: bold;" onclick="viewCartProducts()">View Cart</button></p>
						<div id="cart_content" ></div>
					</div>
					
				</div>
				
				
			</div>



