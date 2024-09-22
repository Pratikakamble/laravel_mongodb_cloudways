<!DOCTYPE html>
<html>
<head>
	<meta charset="utf-8">
	<meta http-equiv="x-ua-compatible" content="ie=edge">
	<meta name="viewport" content="width=device-width,initial-scale=1">
	<meta name="csrf-token" content="{{ csrf_token() }}">
	<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">
	<style>
		p span {
			font-weight:bold;
			margin-right:40px;
		}
		.product_details p{
			margin:0px;
		}
		.pro_dtl table tr td{
			font-size:12px;
			padding:4px;
		}
		.card-body p{
			padding:0px;
			margin:0px;
		}
	</style>
</head>
<body>
	<nav class="navbar navbar-expand-lg navbar-light" style="background:navy;">
	  <div class="container-fluid px-5">
	    <a class="navbar-brand text-white" href="#"><b> <i class="fa fa-globe" ></i> Online Store</b></a>

	    <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNav" aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation">
	      <span class="navbar-toggler-icon"></span>
	    </button>

	    <div class="collapse navbar-collapse d-lg-flex justify-content-center clearfix" id="navbarNav">
		    <form class="d-flex">
		        <input class="form-control me-2" style="width:800px;" type="search" placeholder="Search" aria-label="Search">
		        <button class="btn btn-outline-success text-white" type="submit" style="border:1px solid lime;">Search</button>
	        </form>
	    </div>

	    <div class="text-white"><a href="{{route('view-cart-content')}}" style="color:white; text-decoration:none;"><i class="fa-solid fa-cart-shopping fa-2xl"></i>(<span id="cart_count"> {{$cart_count}} </span>)</a></div>
	  </div>
	</nav>



@isset($categories)
	@include('layouts.front_menu_navbar', ['categories' => $categories])
@endisset

@yield('content')
<script src="https://code.jquery.com/jquery-3.7.1.min.js" integrity="sha256-/JqT3SQfawRcv/BIHPThkBvs0OEvtFFmqPF/lYI/Cxo=" crossorigin="anonymous"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.2/js/all.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-MrcW6ZMFYlzcLA8Nl+NtUVF0sA7MsXsP1UyJoMp4YLEuNSfAP+JcXn/tWtIaxVXM" crossorigin="anonymous"></script>

@yield('script')
</body>
</html>