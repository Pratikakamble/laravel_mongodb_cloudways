@extends('layouts.front_online_store', ['categories' => $categories])
@section('content')
<div class="row">
					    <div class="col-md-10 mx-auto">
					    	<div class="row">
					    			@foreach($products as $key => $val)
							    	<div class="col-md-3 mb-3">
								    	<div class="card" style="width: 18rem;">
										    @if(isset($val['image']))
											<img src="{{asset($val['image'])}}"  style="padding:20px;" height="180" class="card-img-top" >
											@endif
										  <div class="card-body text-center">
										    <h5 class="card-title">{{$val['brand_or_store'] ?? ''}}</h5>
										    <p class="card-text">Price : ${{$val['selling_amount']}}</p>
										    <p><strike>MRP : ${{$val['mrp_amount']}}</strike></p>
										    <a href="/view-product/product/{{$val['_id']}}" class="btn btn-primary text-center">View</a>
										  </div>
										</div>
									</div>
								@endforeach
							</div>
						</div>
	  	
</div>

@endsection


@section('script')
<script>
	$('#search').click(function(){
		var keyword = $('#keyword').val();
		var url_path ="/search-products/"+keyword;
		window.open(url_path,"_self");
	});
</script>
@endsection