@extends('layouts.common')
@section('content')
    <h3 class="text-center mt-4">Attributes</h3>
	<div align="right">
		<button type="button" class="btn btn-primary mb-3" data-bs-toggle="modal" data-bs-target="#addAttribute">Add Category</button>
    </div>
    <div id="attribute_datatable">
    </div>
	<div class="modal fade" id="addAttribute" tabindex="-1" aria-labelledby="addAttributeLabel" aria-hidden="true">
			  <div class="modal-dialog">
			  	<form action="" method="post" id="add_attribute_form">
				    <div class="modal-content">
				      <div class="modal-header">
				        <h5 class="modal-title" id="addAttributeLabel">Modal title</h5>
				        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
				      </div>
				      <div class="modal-body">
				       <input type="hidden" id="cid">
				       <input type="hidden" id="action">
                       <div class="form-group">
                            <label> Category</label>
                            <select name="category" id="category" class="form-control">
                                <option value=""></option>
                                @foreach($categories as $ctg)
                                <option value="{{$ctg['_id']}}">{{$ctg['name']}}</option>
                                @endforeach
                            </select>
                       </div>
                       <div class="form-group">
                            <label>Sub Category</label>
                            <select name="sub_category" id="sub_category" class="form-control">
                                <option value=""></option>
                                @foreach($sub_categories as $ctg)
                                <option value="{{$ctg['_id']}}">{{$ctg['name']}}</option>
                                @endforeach
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

@endsection

@section('script')
<script>
	$(document).ready(function(){
		reload_datatable();
	});

	function reload_datatable(){
		 $.ajax({
            	url:"{{route('attribute-datatable')}}",
                type:"post",
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
   
    var form_data = $('#add_attribute_form').validate({
        rules:{
            category:{
                required:true,
            },
            sub_category:{
                required:true,
                remote:{
                    url:"{{route('subctg-exists')}}",
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
        if($('#add_attribute_form').valid()){
            $.ajax({
            	url:"{{route('save-sub-category')}}",
                type:"post",
                data: {category : ctg, sub_category : sub_ctg},
                beforeSend: function(){
                    $('#save').text('Saving ...');
                    $('#save').attr('disabled',true);
                },
                success:function(data){
                	if(data.success){
	                	reload_datatable();
	                	$('#add_attribute_form')[0].reset();
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
            	url:"{{route('edt-sub-category')}}",
                type:"get",
                data: {eid : eid},
                success:function(data){
                	if(data.success){
	                	$('#addAttribute').modal('show');
	                	$('#sub_category').val(data.sub_ctg.name);
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
            	url:"{{route('upd-sub-category')}}",
                type:"post",
                data: {eid : eid, sub_category: sub_category},
                success:function(data){
                	if(data.success){
	                	alert(data.message);
	                	reload_datatable();
                	}
                },
            });

   }

    function dltSubCtg(eid){
        var cnfm = confirm('Are you sure you want to delete this record?');
        if(cnfm){
            $.ajax({
            url:"{{route('dlt-sub-category')}}",
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
		
