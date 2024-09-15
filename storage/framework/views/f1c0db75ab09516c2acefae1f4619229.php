<aside id="sidebar" style="background-color:  #B833FF;">
			<div class="h-100">
				<div class="sidebar-logo"></div>
				<h4 class="p-3"><a href="#" class="text-white"><i class="fa fa-globe"></i> Online Store </a></h4>
				<ul class="sidebar-nav mt-3">
					<li class="sidebar-item">
						<a href="#" class="sidebar-link collapsed" data-bs-toggle="collapse" data-bs-target="#categories" aria-expanded="false" aria-controls="categories">
							<i class="fa fa-list-alt" aria-hidden="true"></i> Categories
						</a>
						<ul id="categories" class="sidebar-dropdown list-unstyled collapse pl-3" data-bs-parent="#sidebar">
							<li class="sidebar-item">
								<a href="<?php echo e(route('view-categories')); ?>" class="sidebar-link custom-link">
									<i class="fa fa-eye"></i> View Categories
								</a>
							</li>
							<li class="sidebar-item">
								<a href="<?php echo e(route('view-sub-categories')); ?>" class="sidebar-link custom-link">
									<i class="fa fa-eye"></i> View Sub Categories
								</a>
							</li>
						</ul>
					</li>

					<li class="sidebar-item">
						<a href="#" class="sidebar-link collapsed" data-bs-toggle="collapse" data-bs-target="#attributes" aria-expanded="false" aria-controls="attributes">
							<i class="fa fa-list-alt" aria-hidden="true"></i> Attributes
						</a>
						<ul id="attributes" class="sidebar-dropdown list-unstyled collapse" data-bs-parent="#sidebar">
							<li class="sidebar-item">
								<a href="<?php echo e(route('view-attributes')); ?>" class="sidebar-link custom-link">
									<i class="fa fa-eye"></i> View Attributes
								</a>
							</li>
						</ul>
					</li>

					<li class="sidebar-item">
						<a href="#" class="sidebar-link collapsed" data-bs-toggle="collapse" data-bs-target="#products" aria-expanded="false" aria-controls="products">
							<i class="fa fa-list-alt" aria-hidden="true"></i> Products
						</a>
						<ul id="products" class="sidebar-dropdown list-unstyled collapse" data-bs-parent="#sidebar">
							<li class="sidebar-item">
								<a href="<?php echo e(route('view-products')); ?>" class="sidebar-link custom-link">
									<i class="fa fa-eye"></i> View Products
								</a>
							</li>
						</ul>
					</li>
					<!-- <li class="sidebar-item">
						<a href="#" class="sidebar-link collapsed" data-bs-toggle="collapse" data-bs-target="#dashboard" aria-expanded="false" aria-controls="dashboard">
							Dashboard
						</a>
						<ul id="dashboard" class="sidebar-dropdown list-unstyled collapse" data-bs-parent="#sidebar">
							<li class="sidebar-item">
								<a href="#" class="sidebar-link">
									Analytics
								</a>
							</li>
							<li class="sidebar-item">
								<a href="#" class="sidebar-link">
									Ecommerce
								</a>
							</li>
							<li class="sidebar-item">
								<a href="#" class="sidebar-link">
									Crypto
								</a>
							</li>
						</ul>
					</li> -->

					<li class="sidebar-item">
						<a href="#" class="sidebar-link">
							<i class="fa fa-list-alt" aria-hidden="true"></i> Customers
						</a>
					</li>

					<li class="sidebar-item">
						<a href="#" class="sidebar-link">
							<i class="fa fa-list-alt" aria-hidden="true"></i> Orders
						</a>
					</li>
				</ul>
			</div>
		</aside><?php /**PATH D:\Laravel_Mongodb\resources\views/layouts/admin_sidebar.blade.php ENDPATH**/ ?>