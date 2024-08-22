@extends('layouts.common')
@section('content')

			<h3 class="text-center mt-4">Products</h3>
			<div align="right">
				<a href="{{route('add-product')}}"><button type="button" class="btn btn-primary mb-3">
				  Add Product
				</button></a>
			</div>
            <div id="product_datatable">
            	
            </div>
			
@endsection

@section('script')
<script>
	$(document).ready(function(){
		reload_datatable();
	});

	function reload_datatable(){
		 $.ajax({
            	url:"{{route('product-datatable')}}",
                type:"post",
                success:function(data){
                	if(data.success){
                		$('#product_datatable').html(data.data_table);
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


    
    function fetchSubCategory(val){
         $.ajax({
            url:"{{route('fetch-sub-ctg')}}",
            type:"get",
            data: {eid : val},
            success:function(data){
                if(data.success){
                    $('#sub_category_id').html(data.html_content);
                }
            },
            });
    }


    function deleteProduct(pid){
        var dlt = confirm('Are you sure you want to delete this record?');
        if(dlt){
            $.ajax({
                url:"{{route('dlt-product')}}",
                type:"post",
                data:{pid:pid},
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
		
