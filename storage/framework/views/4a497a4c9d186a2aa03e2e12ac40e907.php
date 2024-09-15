
<?php $__env->startSection('content'); ?>

            <h3 class="text-center mt-4">Attributes</h3>
            <div align="right">
                <button type="button" class="btn btn-primary mb-3" data-bs-toggle="modal" data-bs-target="#addAttribute">
                  Add Attribute
                </button>
            </div>
<div id="attribute_datatable">
    
</div>
            
            <div class="modal fade" id="addAttribute" tabindex="-1" aria-labelledby="addAttributeLabel" aria-hidden="true">
              <div class="modal-dialog">
                <form action="" method="post" id="attribute_form">
                    <div class="modal-content">
                      <div class="modal-header">
                        <h5 class="modal-title" id="addAttributeLabel">Add Attribute</h5>
                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                      </div>
                    <div class="modal-body">
                        <input type="hidden" id="cid">
                        <input type="hidden" id="action">
                        <div class="form-group">
                            <label> Category</label>
                            <select name="category" name="category_id" id="category_id" class="form-control" onchange="fetchSubCategory(this.value)" >
                                <option value="">Select Category</option>
                                <?php $__currentLoopData = $categories; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $ctg): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                <option value="<?php echo e($ctg['_id']); ?>"><?php echo e($ctg['name']); ?></option>
                                <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                            </select>
                        </div>
                        <div class="form-group">
                            <label>Sub Category</label>
                            <select name="sub_category_id" id="sub_category_id" class="form-control">
                                <option value="">Select Sub Category</option>
                            </select>
                        </div>
                       <div class="form-group">
                        <label>Attribute</label>
                            <input type="text" name="attribute" id="attribute" class="form-control" autocomplete="off">
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
                url:"<?php echo e(route('attribute-datatable')); ?>",
                type:"get",
                success:function(data){
                    if(data.success){
                        $('#attribute_datatable').html(data.data_table);
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
   
    var form_data = $('#attribute_form').validate({
        rules:{
            category_id:{
                required:true,
            },
            sub_category_id:{
                required:true,
            },
            attribute:{
                required:true,
                remote:{
                    url:"attribute-exists/"+category_id+"/"+sub_category_id,
                    type:"post",
                }
            },
        },messages:{
            category_id:{
                required: "Please enter a Category",
            },
            sub_category_id:{
                required: "Please enter a Sub Category",
            },
            attribute:{
               required: "Please enter an Attribute",
               remote: "Attribute Already Exists."
            },
            
        },
    });

    $('#save').click(function(e){
        e.preventDefault();
        var ctg = $('#category_id').val();
        var sub_ctg = $('#sub_category_id').val();
        var attribute = $('#attribute').val();
        var action = $('#action').val();
        if(action == 'edit'){
            edtForm();
        }else{
        if($('#attribute_form').valid()){
            $.ajax({
                url:"<?php echo e(route('save-attribute')); ?>",
                type:"post",
                data: {category_id : ctg, sub_category_id : sub_ctg, attribute:attribute},
                beforeSend: function(){
                    $('#save').text('Saving ...');
                    $('#save').attr('disabled',true);
                },
                success:function(data){
                    if(data.success){
                        reload_datatable();
                        $('#attribute_form')[0].reset();
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
   
   function edtAttribute(eid){
     $.ajax({
                url:"<?php echo e(route('edt-attribute')); ?>",
                type:"get",
                data: {eid : eid},
                success:function(data){
                    if(data.success){
                        $('#addAttribute').modal('show');
                        $('#attribute').val(data.attribute.name);
                        $('#cid').val(eid);
                        $('#action').val('edit');

                    }
                },
            }); 
   
   }

   function edtForm(){
    var eid = $('#cid').val();
    var attribute = $('#attribute').val();
    $.ajax({
                url:"<?php echo e(route('upd-attribute')); ?>",
                type:"post",
                data: {eid : eid, attribute: attribute},
                success:function(data){
                    if(data.success){
                        alert(data.message);
                        reload_datatable();
                    }
                },
        });
   }

    function dltAttribute(eid){
        var cnfm = confirm('Are you sure you want to delete this record?');
        if(cnfm){
            $.ajax({
            url:"<?php echo e(route('dlt-attribute')); ?>",
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

    function fetchSubCategory(val){
         $.ajax({
            url:"<?php echo e(route('fetch-sub-ctg')); ?>",
            type:"get",
            data: {eid : val},
            success:function(data){
                if(data.success){
                    $('#sub_category_id').html(data.html_content);
                }
            },
            });
    }

</script>
<?php $__env->stopSection(); ?>
        

<?php echo $__env->make('layouts.common', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH D:\Laravel_Mongodb\resources\views/admin/attributes/attributes.blade.php ENDPATH**/ ?>