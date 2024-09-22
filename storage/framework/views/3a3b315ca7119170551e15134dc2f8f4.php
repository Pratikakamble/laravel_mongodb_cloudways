<table id="myTable" class="display">
				<thead style="text-align: left;">
					<tr>
						<th width="10%">Sr. No.</th>
						<th width="30%">Category</th>
						<th width="30%">Sub Category</th>
						<th width="15%">Action</th>
					</tr>
				</thead>
				<tbody>
					<?php $__currentLoopData = $sub_categories; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $key => $sub_ctg): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
						<tr>
							<td><?php echo e($key+1); ?></td>
							<td><?php echo e($sub_ctg->category['name'] ?? ""); ?></td>
							<td><?php echo e($sub_ctg['name']); ?></td>
							<td>
								<button type="button" onclick="edtSubCtg('<?php echo $sub_ctg["_id"]; ?>')" class="btn btn-success">Edit</button>
								<button type="button" onclick="dltSubCtg('<?php echo $sub_ctg["_id"]; ?>')"class="btn btn-danger">Delete</button>
							</td>
						</tr>
					<?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>	
				</tbody>
			</table>
<?php /**PATH D:\Laravel_Mongodb\resources\views/admin/sub_categories/sub_ctg_datatable.blade.php ENDPATH**/ ?>