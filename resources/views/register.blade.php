<!DOCTYPE html>
<html>
<head>
	<meta charset="utf-8">
	<meta http-equiv="x-ua-compatible" content="ie=edge">
	<meta name="viewport" content="width=device-width,initial-scale=1">
	<meta name="csrf-token" content="{{ csrf_token() }}">
	<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">
	<style>
		.form-group{
			margin:20px;
		}
	</style>
</head>


<body class="bg-light">
	<div class="col-lg-3 col-md-3 col-sm-3 col-xs-3 mx-auto mt-5 bg-white" style="border:1px solid black; padding:20px;">
	<h3 class="text-center">Register Form</h3>

	@if(Session::has('error'))
	<p class="text-danger" style="margin-left: 20px;" ><b>{{Session::get('error')}}</b></p>
	@endif

	<form action="<?= route('register') ?>" method="post">
		@csrf
	  <div class="form-group">
	    <label for="name">Name:</label>
	    <input type="text" name="name" class="form-control" placeholder="Enter name" id="name" autocomplete="nope">
	    @error('name')
	    <span class="text-danger">{{ $message }}</span>
	    @enderror
	  </div>
	  <div class="form-group">
	    <label for="email">Email address:</label>
	    <input type="email" name="email" value="" class="form-control" placeholder="Enter email" id="email" autocomplete="nope">
	    @error('email')
	    <span class="text-danger">{{ $message }}</span>
	    @enderror
	  </div>
	  <div class="form-group">
	    <label for="pwd">Password:</label>
	    <input type="password" value="" name="password" class="form-control" placeholder="Enter password" id="pwd" autocomplete="nope">
	     @error('password')
	    <span class="text-danger">{{ $message }}</span>
	    @enderror
	  </div>
	   <div class="form-group">
	    <label for="pwdconfm">Password:</label>
	    <input type="password" name="password_confirmation" class="form-control" placeholder="Enter confirm password" id="pwdconfm" autocomplete="nope">
	     @error('password_confirmation')
	    <span class="text-danger">{{ $message }}</span>
	    @enderror
	  </div>
	  <div class="text-center">
	  <button type="submit" class="btn btn-primary ">Submit</button>
	</div>
	</form>
</div>

<script src="https://code.jquery.com/jquery-3.7.1.min.js" integrity="sha256-/JqT3SQfawRcv/BIHPThkBvs0OEvtFFmqPF/lYI/Cxo=" crossorigin="anonymous"></script>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.min.js" integrity="sha384-cVKIPhGWiC2Al4u+LWgxfKTRIcfu0JTxR+EQDz/bgldoEyl4H0zUF0QKbrJ0EcQF" crossorigin="anonymous"></script>
<script>
	$(document).ready(function(){
		document.getElementById("email").defaultValue = "";
		$('#email').removeAttr('autocomplete');
		$('#password').removeAttr('autocomplete');
	});
</script>
</body>
</html>