@extends('layouts.common')
@section('content')

			<h3 class="text-center mt-4">Categories</h3>
			<div align="right">
				<button type="button" class="btn btn-primary mb-3" data-bs-toggle="modal" data-bs-target="#addCategory">
				  Add Category
				</button>
			</div>
<div id="ctg_datatable">
	
</div>
			
			<div class="modal fade" id="addCategory" tabindex="-1" aria-labelledby="addCategoryLabel" aria-hidden="true">
			  <div class="modal-dialog">
			  	<form action="" method="post" id="category_form">
				    <div class="modal-content">
				      <div class="modal-header">
				        <h5 class="modal-title" id="addCategoryLabel">Add Category</h5>
				        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
				      </div>
				      <div class="modal-body">
				       <input type="hidden" id="cid">
				       <input type="hidden" id="action">
				       <div class="form-group">
				       	<label>Category</label>
				       		<input type="text" name="category" id="category" class="form-control" autocomplete="off">
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

@endsection

@section('script')
<script>
	$(document).ready(function(){
		reload_datatable();
	});

	function reload_datatable(){
		 $.ajax({
            	url:"{{route('category-datatable')}}",
                type:"post",
                success:function(data){
                	if(data.success){
                		$('#ctg_datatable').html(data.data_table);
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
   
    var form_data = $('#category_form').validate({
        rules:{
            category:{
                required:true,
                remote:{
                    url:"{{route('category-exists')}}",
                    type:"post",
                }
            },
        },messages:{
            category:{
               required: "Please enter a Category",
               remote: "Category Already Exists."
            },
            
        },
    });

    $('#save').click(function(e){
        e.preventDefault();
        var ctg = $('#category').val();
        var action = $('#action').val();
        if(action == 'edit'){
        	edtForm();
        }else{
        if($('#category_form').valid()){
            $.ajax({
            	url:"{{route('save-category')}}",
                type:"post",
                data: {category : ctg},
                beforeSend: function(){
                    $('#save').text('Saving ...');
                    $('#save').attr('disabled',true);
                },
                success:function(data){
                	if(data.success){
	                	reload_datatable();
	                	$('#category_form')[0].reset();
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
   
   function edtCtg(eid){
   	 $.ajax({
            	url:"{{route('edt-category')}}",
                type:"get",
                data: {eid : eid},
                success:function(data){
                	if(data.success){
	                	$('#addCategory').modal('show');
	                	$('#category').val(data.ctg);
	                	$('#cid').val(eid);
	                	$('#action').val('edit');

                	}
                },
            }); 
   
   }

   function edtForm(){
   	var eid = $('#cid').val();
   	var category = $('#category').val();
   	$.ajax({
            	url:"{{route('upd-category')}}",
                type:"post",
                data: {eid : eid, category: category},
                success:function(data){
                	if(data.success){
	                	alert(data.message);
	                	reload_datatable();
                	}
                },
            });

   }

   function dltCtg(eid){
    var cnfm = confirm('Are you sure you want to delete this record?');
    if(cnfm){
  	    $.ajax({
            	url:"{{route('dlt-category')}}",
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
@endsection
		
