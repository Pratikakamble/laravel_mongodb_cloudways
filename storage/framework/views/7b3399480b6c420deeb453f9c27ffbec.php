<table id="myTable" class="display">
				<thead style="text-align: left;">
					<tr>
						<th width="10%">Sr. No.</th>
						<th width="30%">Category</th>
						<th width="30%">Sub Category</th>
						<th width="15%">Attribute</th>
						<th width="15%">Action</th>
					</tr>
				</thead>
				<tbody>
					<?php $__currentLoopData = $attributes; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $key => $attr): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
						<tr>
							<td><?php echo e($key+1); ?></td>
							<td><?php echo e($attr['sub_category']['category']['name'] ?? ''); ?></td>
							<td><?php echo e($attr['sub_category']['name'] ?? ''); ?></td>
							<td>
								<?php echo e($attr['name']); ?>

							</td>
							<td>
								<button type="button" onclick="edtAttribute('<?php echo $attr["_id"]; ?>')" class="btn btn-success">Edit</button>
								<button type="button" onclick="dltAttribute('<?php echo $attr["_id"]; ?>')"class="btn btn-danger">Delete</button>
							</td>
						</tr>
					<?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>	
				</tbody>
			</table>
<?php /**PATH D:\Laravel_Mongodb\resources\views/admin/attributes/attribute_datatable.blade.php ENDPATH**/ ?>