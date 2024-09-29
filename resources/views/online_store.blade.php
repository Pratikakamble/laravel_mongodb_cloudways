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

	<div class="carousel-item active">
					    <div class="col-md-10 mx-auto">
					    	<div class="row">
					    		<div class="col-md-4 mx-auto bg-light">
					    		No Products Found of this Category.
					    		</div>
					    	</div>
					    </div>
					</div>
	@endif




	</div>
</div>


<div class="row pt-3">
	@foreach ($all_products as $key => $value) 
        @if(count($value['products']) >= 1)
            @php $products = $value['products']; 
            shuffle($value['products']);
            @endphp 
            <div class="col-md-3 text-center">

            	<div class="card text-center">
            		<h6 class="card-title text-center pt-3">{{$value['name']}}</h6>
            		<div class="row p-1">
            				@php
            				 $products = (count($products) >= 4) ? array_slice($products, 0, 4) : array_slice($products, 0, 2);
            				@endphp
							@foreach($products as $k => $v)
					            <div class="col-md-6">
					               	<div class="card text-center m-1">
					                	@if(isset($v['image']))
											<img src="{{asset($v['image'])}}"  style="padding:20px;" height="150" class="card-img-top" >
										@endif
										<p style="font-size:12px; font-weight:bold; margin:0px;" class="card-title">{{$v['brand_or_store'] ?? ''}}</p>
										<p style="font-size:12px; font-weight:bold; margin:0px;" class="card-text">Price : ${{$v['selling_amount']}}</p>
										<p style="font-size:12px; font-weight:bold; margin:0px;" ><strike>MRP : ${{$v['mrp_amount']}}</strike></p>
									</div>
					            </div>
					        @endforeach
		        	</div>
		        	<a href="/online-store/{{$value['products'][0]['category_id']}}"><button class="btn btn-primary btn-sm mx-auto pb-2" style="width:20%; margin:auto ">View All</button></a>
		        </div>
		        
        	</div>
        @endif
    @endforeach
</div>
@endsection

@section('script')
<script>
	
	function displayVariation($vid){
		alert($vid);
	}

	$('#search').click(function(){
		var keyword = $('#keyword').val();
		var url_path ="/search-products/"+keyword;
		window.open(url_path,"_self");
		
	});
</script>
@endsection