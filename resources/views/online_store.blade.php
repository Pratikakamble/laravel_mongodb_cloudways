@extends('layouts.front_online_store', ['categories' => $categories])
@section('content')
<div id="carouselExampleSlidesOnly" class="carousel slide" data-bs-ride="carousel">
	<div class="carousel-inner pt-4" style="height:380px; background-color:#efefef;">
	@if(count($products) >= 1)
	  	@for($i = 0; $i < count($products); $i++)
	  		
		  			<div class="carousel-item  {{($i == 0) ? 'active'  : ''}} ">
					    <div class="col-md-10 mx-auto">
					    	<div class="row">
					    		@foreach($products[$i] as $key => $val)
							    	<div class="col-md-3">
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
			
	  	@endfor
	@else
	@endif




	</div>
</div>
@endsection

@section('script')
<script>
	
	function displayVariation($vid){
		alert($vid);
	}
</script>
@endsection