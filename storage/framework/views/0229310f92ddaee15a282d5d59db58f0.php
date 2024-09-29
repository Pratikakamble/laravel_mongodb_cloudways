<nav class="navbar navbar-expand-lg navbar-light" style="background-color: #2E86C1  
; border-bottom:1px solid lime;" >
  <div class="container-fluid">
    <a class="navbar-brand" href="#"></a>

    <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNav" aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation">
      <span class="navbar-toggler-icon"></span>
    </button>

    <div class="collapse navbar-collapse d-lg-flex justify-content-center" id="navbarNav">
      <ul class="navbar-nav ">
        <?php $__currentLoopData = $categories; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $key => $ctg): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?> 
          <li class="nav-item">
            <a class="nav-link text-white" href="/online-store/<?php echo e($ctg->_id); ?>"><?php echo e($ctg->name); ?></a>
          </li>
        <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
      </ul>
    </div>

  </div>
</nav>

<?php /**PATH D:\Laravel_Mongodb\resources\views/layouts/front_menu_navbar.blade.php ENDPATH**/ ?>