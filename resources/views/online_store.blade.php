@extends('layouts.front_online_store', ['categories' => $categories])
@section('content')
	<div id="carouselExampleSlidesOnly" class="carousel slide" data-bs-ride="carousel">
	  <div class="carousel-inner pt-4" style="height:380px; background-color:#efefef;">
	    <div class="carousel-item active ">
		    <div class="col-md-10 mx-auto">
		    	<div class="row">
			    	<div class="col-md-3">
				    	<div class="card" style="width: 18rem;">
						  <img src="{{asset('image/img4.jpg')}}" style="padding:20px;" height="180" class="card-img-top" alt="...">
						  <div class="card-body">
						    <h5 class="card-title">Card title</h5>
						    <p class="card-text">Some quick example</p>
						    <a href="#" class="btn btn-primary">Go somewhere</a>
						  </div>
						</div>
					</div>

					<div class="col-md-3">
						<div class="card" style="width: 18rem;">
						  <img src="{{asset('image/img5.jpg')}}" style="padding:20px;" height="180" class="card-img-top" alt="...">
						  <div class="card-body">
						    <h5 class="card-title">Card title</h5>
						    <p class="card-text">Some quick example</p>
						    <a href="#" class="btn btn-primary">Go somewhere</a>
						  </div>
						</div>
					</div>

					<div class="col-md-3">
						<div class="card" style="width: 18rem;">
						  <img src="{{asset('image/img6.jpg')}}" style="padding:20px;" height="180" class="card-img-top" alt="...">
						  <div class="card-body">
						    <h5 class="card-title">Card title</h5>
						    <p class="card-text">Some quick example</p>
						    <a href="#" class="btn btn-primary">Go somewhere</a>
						  </div>
						</div>
					</div>

					<div class="col-md-3">
						<div class="card" style="width: 18rem;">
						  <img src="{{asset('image/img11.jpg')}}" style="padding:20px;" height="180" class="card-img-top" alt="...">
						  <div class="card-body">
						    <h5 class="card-title">Card title</h5>
						    <p class="card-text">Some quick example</p>
						    <a href="#" class="btn btn-primary">Go somewhere</a>
						  </div>
						</div>
					</div>
				</div>
			</div>
	    </div>
	    <div class="carousel-item">
	        <div class="col-md-10 mx-auto">
		    	<div class="row">
			    	<div class="col-md-3">
				    	<div class="card" style="width: 18rem;">
						  <img src="{{asset('image/img1.jpg')}}" class="card-img-top" alt="...">
						  <div class="card-body">
						    <h5 class="card-title">Card title</h5>
						    <p class="card-text">Some quick example</p>
						    <a href="#" class="btn btn-primary">Go somewhere</a>
						  </div>
						</div>
					</div>

					<div class="col-md-3">
						<div class="card" style="width: 18rem;">
						  <img src="{{asset('image/img2.jpg')}}" class="card-img-top" alt="...">
						  <div class="card-body">
						    <h5 class="card-title">Card title</h5>
						    <p class="card-text">Some quick example</p>
						    <a href="#" class="btn btn-primary">Go somewhere</a>
						  </div>
						</div>
					</div>

					<div class="col-md-3">
						<div class="card" style="width: 18rem;">
						  <img src="{{asset('image/img3.jpg')}}" class="card-img-top" alt="...">
						  <div class="card-body">
						    <h5 class="card-title">Card title</h5>
						    <p class="card-text">Some quick example</p>
						    <a href="#" class="btn btn-primary">Go somewhere</a>
						  </div>
						</div>
					</div>

					<div class="col-md-3">
						<div class="card" style="width: 18rem;">
						  <img src="{{asset('image/img12.jpg')}}" style="padding:20px;" height="180" class="card-img-top" alt="...">
						  <div class="card-body">
						    <h5 class="card-title">Card title</h5>
						    <p class="card-text">Some quick example</p>
						    <a href="#" class="btn btn-primary">Go somewhere</a>
						  </div>
						</div>
					</div>
				</div>
		    </div>
	    </div>
	    <div class="carousel-item">
	      	<div class="col-md-10 mx-auto">
		    	<div class="row">
			    	<div class="col-md-3">
				    	<div class="card" style="width: 18rem;">
						  <img src="{{asset('image/img8.jpg')}}" class="card-img-top" alt="...">
						  <div class="card-body">
						    <h5 class="card-title">Card title</h5>
						    <p class="card-text">Some quick example</p>
						    <a href="#" class="btn btn-primary">Go somewhere</a>
						  </div>
						</div>
					</div>

					<div class="col-md-3">
						<div class="card" style="width: 18rem;">
						  <img src="{{asset('image/img9.jpg')}}" class="card-img-top" alt="...">
						  <div class="card-body">
						    <h5 class="card-title">Card title</h5>
						    <p class="card-text">Some quick example</p>
						    <a href="#" class="btn btn-primary">Go somewhere</a>
						  </div>
						</div>
					</div>

					<div class="col-md-3">
						<div class="card" style="width: 18rem;">
						  <img src="{{asset('image/img10.jpg')}}" class="card-img-top" alt="...">
						  <div class="card-body">
						    <h5 class="card-title">Card title</h5>
						    <p class="card-text">Some quick example</p>
						    <a href="#" class="btn btn-primary">Go somewhere</a>
						  </div>
						</div>
					</div>

					<div class="col-md-3">
						<div class="card" style="width: 18rem;">
						  <img src="{{asset('image/img13.jpg')}}" style="padding:20px;" height="180" class="card-img-top" alt="...">
						  <div class="card-body">
						    <h5 class="card-title">Card title</h5>
						    <p class="card-text">Some quick example</p>
						    <a href="#" class="btn btn-primary">Go somewhere</a>
						  </div>
						</div>
					</div>
				</div>
		    </div>
	    </div>
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