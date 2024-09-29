
<?php $__env->startSection('content'); ?>

			<h3 class="text-center mt-4">Categories</h3>
			<div align="right">
				<button type="button" class="btn btn-primary mb-3" data-bs-toggle="modal" data-bs-target="#addSubCategory">
				  Add Sub Category
				</button>
			</div>
<div id="sub_ctg_datatable">
	
</div>
			
			<div class="modal fade" id="addSubCategory" tabindex="-1" aria-labelledby="addSubCategoryLabel" aria-hidden="true">
			  <div class="modal-dialog">
			  	<form action="" method="post" id="sub_category_form">
				    <div class="modal-content">
				      <div class="modal-header">
				        <h5 class="modal-title" id="addSubCategoryLabel">Add SubCategory</h5>
				        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
				      </div>
				      <div class="modal-body">
				       <input type="hidden" id="cid">
				       <input type="hidden" id="action">
                       <div class="form-group">
                        <label> Category</label>
                            <select name="category" id="category" class="form-control">
                                <option value=""></option>
                                <?php $__currentLoopData = $categories; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $ctg): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                <option value="<?php echo e($ctg['_id']); ?>"><?php echo e($ctg['name']); ?></option>
                                <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                            </select>
                       </div>
				       <div class="form-group">
				       	<label>Sub Category</label>
				       		<input type="text" name="sub_category" id="sub_category" class="form-control" autocomplete="off">
				       </div>
				      </div>
				      <div class="modal-footer">
				        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
				        <button type="button" class="btn btn-primary" id="save">Save</button>
				      </div>
				    </div>
				</form>
			  </div>
			</div>

<?php $__env->stopSection(); ?>

<?php $__env->startSection('script'); ?>
<script>
	$(document).ready(function(){
		reload_datatable();
	});

	function reload_datatable(){
		 $.ajax({
            	url:"<?php echo e(route('sub-category-datatable')); ?>",
                type:"post",
                success:function(data){
                	if(data.success){
                		$('#sub_ctg_datatable').html(data.data_table);
                		$('#myTable').dataTable();
                	}
                },
            }); 
	}

	$.ajaxSetup({
        headers: {
            'X-CSRF-TOKEN' : $('meta[name="csrf-token"]').attr('content')
        }
    });

	$('#myTable').dataTable();
   
    var form_data = $('#sub_category_form').validate({
        rules:{
            category:{
                required:true,
            },
            sub_category:{
                required:true,
                remote:{
                    url:"<?php echo e(route('subctg-exists')); ?>",
                    type:"post",
                }
            },
        },messages:{
            category:{
                required: "Please enter a Category",
            },
            sub_category:{
               required: "Please enter a Sub Category",
               remote: "Sub Category Already Exists."
            },
            
        },
    });

    $('#save').click(function(e){
        e.preventDefault();
        var ctg = $('#category').val();
        var sub_ctg = $('#sub_category').val();
        var action = $('#action').val();
        if(action == 'edit'){
        	edtForm();
        }else{
        if($('#sub_category_form').valid()){
            $.ajax({
            	url:"<?php echo e(route('save-sub-category')); ?>",
                type:"post",
                data: {category : ctg, sub_category : sub_ctg},
                beforeSend: function(){
                    $('#save').text('Saving ...');
                    $('#save').attr('disabled',true);
                },
                success:function(data){
                	if(data.success){
	                	reload_datatable();
	                	$('#sub_category_form')[0].reset();
                        $('#sub_category_form select').val('');
                        $('#sub_category_form input').val('');
	                	alert(data.message);
                	}
                },
                complete: function(){
                    $('#save').text('Save');
                    $('#save').attr('disabled',false);
                },
            }); 
        }
    	}
    });
   
   function edtSubCtg(eid){
   	 $.ajax({
            	url:"<?php echo e(route('edt-sub-category')); ?>",
                type:"get",
                data: {eid : eid},
               
                success:function(data){
                	if(data.success){
	                	$('#addSubCategory').modal('show');
                        $('#sub_category').val(data.sub_ctg);
	                	$('#category').val(data.ctg);
	                	$('#cid').val(eid);
	                	$('#action').val('edit');
                	}
                },
                
            }); 
   
   }

   function edtForm(){
   	var eid = $('#cid').val();
   	var sub_category = $('#sub_category').val();
   	$.ajax({
            	url:"<?php echo e(route('upd-sub-category')); ?>",
                type:"post",
                data: {eid : eid, sub_category: sub_category},
                beforeSend: function(){
                    $('#save').text('Saving ...');
                    $('#save').attr('disabled',true);
                },
                success:function(data){
                	if(data.success){
	                	alert(data.message);
                        $('#sub_category_form select').val('');
                        $('#sub_category_form input').val('');
	                	reload_datatable();
                	}
                },
                complete: function(){
                    $('#save').text('Save');
                    $('#save').attr('disabled',false);
                },
            });

   }

    function dltSubCtg(eid){
        var cnfm = confirm('Are you sure you want to delete this record?');
        if(cnfm){
            $.ajax({
            url:"<?php echo e(route('dlt-sub-category')); ?>",
            type:"post",
            data: {eid : eid},
            success:function(data){
                if(data.success){
                       alert(data.message);
                       reload_datatable();
                }
            },
            });
        }
    }

</script>
<?php $__env->stopSection(); ?>
		

<?php echo $__env->make('layouts.common', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH D:\Laravel_Mongodb\resources\views/admin/sub_categories/sub_categories.blade.php ENDPATH**/ ?>