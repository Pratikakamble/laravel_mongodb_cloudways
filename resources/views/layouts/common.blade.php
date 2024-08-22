<!DOCTYPE html>
<html>
<head>
	<meta charset="utf-8">
	<meta http-equiv="x-ua-compatible" content="ie=edge">
	<meta name="viewport" content="width=device-width,initial-scale=1">
	<meta name="csrf-token" content="{{ csrf_token() }}">
	<link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css">
	<link rel="styleheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.2/css/all.min.css">

	<link rel="stylesheet" href="{{asset('admin_style.css')}}">
	<title>Admin</title>
	<link rel="stylesheet" href="https://cdn.datatables.net/2.0.8/css/dataTables.dataTables.min.css">
	<style>
	 #sidebar .custom-link{
			padding-left: 40px;
		}
	#sidebar .active{
			color:lime !important;
		}

	</style>
</head>
<body>
	<div class="wrapper">

		@include('layouts.admin_sidebar')

		<div class="main">
			@include('layouts.admin_navbar')

			<main class=" px-3 py-2">
				<div class="container-fluid">
					<div class="mb-3">
						@yield('content')
				    </div>
			    </div>
			</main>
			
		</div>
	</div>

<script src="https://code.jquery.com/jquery-3.7.1.min.js" integrity="sha256-/JqT3SQfawRcv/BIHPThkBvs0OEvtFFmqPF/lYI/Cxo=" crossorigin="anonymous"></script>
<script src="{{asset('script.js')}}"></script>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.2/js/all.min.js"></script>
<script src="https://cdn.datatables.net/2.0.8/js/dataTables.min.js"></script>
  <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery-validate/1.19.3/jquery.validate.min.js" ></script>
@yield('script')
<script>
	$(document).ready(function(){
	 	var url = window.location.href;
	    $('ul li.sidebar-item a.sidebar-link').each(function(){
	        var link = $(this).attr("href");
	        if(link == url){
	            $(this).closest('ul').addClass('show');
	            $(this).addClass("active");
	        }
	    })
	})
</script>
</body>
</html>

