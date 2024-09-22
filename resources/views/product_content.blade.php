



<input type="hidden" id="variation_id" value="">

<div class="row mt-2">
				<div class="col-md-1 text-center product_images">
					@foreach($product['product_images'] as $key => $img)
						<img src="{{asset($img['image'])}}" class="img-responsive p-3" width="100%" height="90px" style="cursor: pointer;">
					@endforeach
				</div>

				<div class="col-md-4 bg-light ">
					<img src = "{{ asset($product['image']) }}" class="img-fluid mt-3" id="image" style="width:475px; cursor: pointer;">
				</div>

				<input type="hidden" id="selling_amount" value="{{$product['selling_amount'] ?? ''}}"> 

				<div class="col-md-5 px-4">
					<div class="product_details product_images">
						<div class="row">
							<div class="col-md-8">
								<p><h5><strong>{{ $product['brand_or_store'] }}</strong></h5><p>
								<p><b>Product Name </b>: {{$product['product_name'] ?? ''}} <p>
								<p><b>Price </b>: {{$product['selling_amount'] ?? ''}} Rs,
									<small>M.R.P.:<strike>{{$product['mrp_amount']}}</strike></small>
								</p>
								<p>
									<b>Discount</b>:{{$product['discount_amount'] ?? ''}} Rs
								<p>
							</div>
							<div class="col-md-4">
								
									<p>Delivery Date</p>
									<p>Delivery Charges</p>
									
								
							</div>
						</div>

						<div class="row">
							@php
							    $data = collect($product['value_attribute'])->groupBy('attribute_id')->toArray();
							@endphp
							<!-- Tab panes -->
							<div class="tab-content">
								@foreach($data as $key => $val)
									@if(count($val) > 1)
										@foreach($val as $k => $atr)
										    <div id="{{'identy'}}{{$k+1}}" class="container tab-pane @if($k == 0) active @endif" style="padding:0px;">
										    	<p><b>{{$atr['attribute']['name']}}</b>: <span>{{$atr['value']}}</span></p>
										    	<input type="text" class="form-control atr_val" value="{{$atr['attribute_id'].':'.$atr['value']}}"> 
										    	
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

						@if(!empty($product['product_details']))
							<div class="row pro_dtl">
								<h6 class="mb-2 mt-5"><strong>Product Details</strong></h6>
								<div class="table-responsive">
									<table class="table ">
									@foreach($product['product_details'] as $key => $dtl)
										<tr>
											<td><b>{{$dtl['attribute']}}</b></td>
											<td>{{$dtl['value']}}</td>
										</tr>
									@endforeach
								    </table>
								</div>
							</div>
						@endif

						<button class="btn btn-primary mt-2" onclick="addToCart()">Add To Cart</button>
						<a href="{{url('stripe/'.$product['selling_amount'])}}"><button class="btn btn-success mt-2">Buy Now</button></a>
					</div>
				</div>
				
		
				
				<div class="col-md-2 cart_div">
					
					<div class="shadow p-3 mb-5 bg-white rounded cart_count">
						<p style="margin:0px; padding:0px; text-align: center;"><button type="button" class="btn btn-outline-success" style="padding:5px 4px; font-size:11px; font-weight: bold;" onclick="viewCartProducts()">View Cart </button></p>
						<div id="cart_content" ></div>
					</div>
					
				</div>
				
				
			</div>


;
			