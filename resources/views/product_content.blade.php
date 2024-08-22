
@if(!empty($product['variation']))
<div class="row mt-4">
	<div class="col-md-12 ">
		<div style="display:flex; justify-content:initial;flex-wrap:wrap; cursor: pointer;">
		@foreach($product['variation'] as $key=>$val)
			<div style="border:1px solid #ccc; padding:5px; border-radius:5px;margin-left:10px;">
				{{$val['variation_name']}}
			</div>
		@endforeach
	   </div>
	</div>
</div>
@endif
<div class="row mt-2">
				<div class="col-md-1 text-center product_images">
					@foreach($product['product_images'] as $key => $img)
						<img src="{{asset($img['image'])}}" class="img-responsive p-3" width="100%" height="90px" style="cursor: pointer;">
					@endforeach
				</div>

				<div class="col-md-4 bg-light ">
					<img src = "{{ asset($product['image']) }}" class="img-fluid mt-3" id="image" style="width:475px; cursor: pointer;">
				</div>

				<div class="col-md-4 px-4">
					<div class="product_details product_images">
						<p><h5><strong>{{ $product['brand_or_store'] }}</strong></h5><p>
						<p><b>Product Name </b>: {{$product['product_name'] ?? ''}} <p>
						<p><b>Price </b>: {{$product['selling_amount'] ?? ''}} Rs,
							<small>M.R.P.:<strike>{{$product['mrp_amount']}}</strike></small>
						</p>
						<p>
							<b>Discount</b>:{{$product['discount_amount'] ?? ''}} Rs
						<p>

						@php
						    $data = collect($product['value_attribute'])->groupBy('attribute_id')->toArray();
						@endphp

						

						<div >
							@foreach($data as $key => $val)
								@if(count($val) > 1)
									@foreach($val as $k => $atr)

									@if($k == 0)
										<p><b>{{$atr['attribute']['name']}}</b>: <span>val</span></p>
									@endif

										@if(array_key_exists('image', $atr) && ($k == 0 || $k == 1) )
											<img src="{{asset($atr['image'])}}" class="img-responsive p-3" height="100px" style="cursor: pointer;">
										@else
											<div height="100px" class="bg-light" style="cursor: pointer; border:1px solid #ccc; text-align: center; margin-top:15px; margin-bottom:15px; padding:22px; display: inline;">{{$atr['value']}}</div>
										@endif

									@endforeach
								@endif
							@endforeach
						</div>

						
						
						<div style="border-top:1px solid #efefef;">
						@foreach($product['value_attribute'] as $val)
							@if(count($data[$val['attribute_id']]) < 2)
								<p><b>{{ $val['attribute']['name'] }}</b> : {{$val['value']}}</p>
								@if(array_key_exists('image', $val))
									<img src="{{asset($val['image'])}}" class="img-responsive p-3" height="100px" style="cursor: pointer;">
								@endif
							@endif
						@endforeach
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

						<button class="btn btn-primary mt-2">Add To Cart</button>
						<a href="{{url('stripe/'.$product['selling_amount'])}}"><button class="btn btn-success mt-2">Buy Now</button></a>
					</div>
				</div>
				
				<div class="col-md-2 bg-light px-3">
					<p>Delivery Date</p>
					<p>Delivery Charges</p>
				</div>
				
			</div>