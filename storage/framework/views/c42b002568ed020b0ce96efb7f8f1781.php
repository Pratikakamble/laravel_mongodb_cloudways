<!DOCTYPE html>
<html>
<head>
	<meta charset="utf-8">
	<meta http-equiv="x-ua-compatible" content="ie=edge">
	<meta name="viewport" content="width=device-width,initial-scale=1">
	<meta name="csrf-token" content="<?php echo e(csrf_token()); ?>">
	<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">
	<style>
		.form-group{
			margin:20px;
		}
	</style>
</head>


<body class="bg-light">
	<div class="col-lg-3 col-md-3 col-sm-3 col-xs-3 mx-auto mt-5 bg-white" style="border:1px solid black; padding:10px;">
	<h3 class="text-center">Login Form</h3>
	<?php if(Session::has('error')): ?>
	<p class="text-danger" style="margin-left: 20px;"><b><?php echo e(Session::get('error')); ?></b></p>
	<?php endif; ?>

	<form action="<?= route('signin') ?>" method="post">
		<?php echo csrf_field(); ?>
	  <div class="form-group">
	    <label for="email">Email address:</label>
	    <input type="email" name="email" class="form-control" placeholder="Enter email" id="email">
	    <?php $__errorArgs = ['email'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?>
	    <span class="text-danger"><?php echo e($message); ?></span>
	    <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>
	  </div>
	  <div class="form-group">
	    <label for="pwd">Password:</label>
	    <input type="password"  name="password" class="form-control" placeholder="Enter password" id="pwd">
	    <?php $__errorArgs = ['password'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?>
	    <span class="text-danger"><?php echo e($message); ?></span>
	    <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>
	  </div>
	  <div class="text-center">
	  	<button type="submit" class="btn btn-primary">Login</button>
	   <p><a href="<?php echo e(route('register')); ?>" >Create a Account</a></p>
	</div>
	
	</form>
</div>
</body>
</html><?php /**PATH D:\Laravel_Mongodb\resources\views/login.blade.php ENDPATH**/ ?>