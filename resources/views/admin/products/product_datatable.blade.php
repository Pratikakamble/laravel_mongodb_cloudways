<table id="myTable" class="display">
				<thead style="text-align: left;">
					<tr>
						<th width="10%">Sr. No.</th>
						<th width="10%">Category</th>
						<th width="10%">Sub Category</th>
						<th width="10%">Brand or Store</th>
						<th width="10%">Image</th>
						<th width="10%">Product Name</th>
						<th width="10%">Amount</th>
						<th width="10%">Discount</th>
						<th width="10%">Action</th>
					</tr>
				</thead>
				<tbody>
					@foreach($products as $key => $product)
						<tr>
							<td>{{$key+1}}</td>
							<td>{{$product['subcategory']['name'] ?? ''}}</td>
							<td>
								{{$product['subcategory']['category']['name'] ?? ''}}
							</td>
							<td>
								{{$product['brand_or_store'] ?? ''}}
							</td>

							<td>
								@if(isset($product['image']))
								<img src="{{asset($product['image'])}}" width="50px" class="img-responsive">
								@endif
							</td>

							<td>
								{{$product['product_name'] ?? ''}}
							</td>

							<td>
								{{$product['selling_amount'] ?? ''}}
							</td>
							<td>
								{{$product['discount_amount'] ?? ''}}
							</td>
							<td>
								<a href="{{ url('/edit-product/'.$product['_id']) }}"><button type="button" class="btn btn-success" ><i class="fa fa-edit"></i></button><a>
								<button type="button" onclick="deleteProduct('{{$product["_id"]}}')" class="btn btn-danger" ><i class="fa fa-trash"></i></button>
							</td>
						</tr>
					@endforeach	
				</tbody>
			</table>
