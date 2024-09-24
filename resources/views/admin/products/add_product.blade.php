@extends('layouts.common')
@section('content')
<style>
    .btn-danger{
        width:35px !important;
    }
    span.text-danger{
        font-size:13px;
    }
</style>
    <div class="container">
        <form method="post" id="add_product_form" name="add_product_form" enctype="multipart/form-data">
            <div class="card">
                <div class="card-header">
                     <nav>
                      <div class="nav nav-tabs" id="nav-tab" role="tablist">
                        <button class="nav-link active" id="product-tab" data-bs-toggle="tab" data-bs-target="#product" type="button" role="tab" aria-controls="product" aria-selected="true">Product</button>

                        <button class="nav-link" id="product-images-tab" data-bs-toggle="tab" data-bs-target="#product-images" type="button" role="tab" aria-controls="product-images" aria-selected="false">Product Images</button>

                        <button class="nav-link" id="single-val-tab" data-bs-toggle="tab" data-bs-target="#single-val" type="button" role="tab" aria-controls="single-val" aria-selected="false">Product Attributes</button>

                        <button class="nav-link" id="product_details-tab" data-bs-toggle="tab" data-bs-target="#product_details" type="button" role="tab" aria-controls="product_details" aria-selected="false">Product Details</button>

                        <button class="nav-link" id="variation-tab" data-bs-toggle="tab" data-bs-target="#variation-val" type="button" role="tab" aria-controls="variation-val" aria-selected="false">Product Variation</button>

                      </div>
                    </nav>
                </div>
                <div class="card-body">
                    <div class="tab-content pt-5" id="nav-tabContent">
                      <div class="tab-pane fade show active" id="product" role="tabpanel" aria-labelledby="product-tab" tabindex="0">
                            @include('admin.products.product_content')
                      </div>

                      <div class="tab-pane fade" id="product-images" role="tabpanel" aria-labelledby="product-images-tab" tabindex="0">                                                                   @include('admin.products.product_image_content')
                      </div>

                      <div class="tab-pane fade" id="single-val" role="tabpanel" aria-labelledby="single-val-tab" tabindex="0">
                        @include('admin.products.single_value_content')
                      </div>

                      <div class="tab-pane fade" id="product_details" role="tabpanel" aria-labelledby="product_details-tab" tabindex="0">
                        @include('admin.products.product_details_content') 
                      </div> 

                      <div class="tab-pane fade" id="variation-val" role="tabpanel" aria-labelledby="variation-val-tab" tabindex="0">
                        @include('admin.products.product_variation')
                      </div>
                </div>
                </div>
                <div class="card-footer">
                    <button class="btn btn-success" name="product_save" id="product_save">Save</button>
                </div>
            </div>
        </form> 



     <div style="display:none;" id="clone_input">
         <div class="row" id="row-1">
                                <div class="col-sm-1 text-center" style="align-content: center;">
                                      <span class="dtl_attr_cnt">1.</span>
                                </div>
                                <div class="col-sm-5">
                                    <label>Attribute<span class="text-danger">*</span></label>
                                    <input type="text" name="product_details[0][attr]"  class="form-control select_attribute" >
                                    <span class="text-danger err"></span>
                                </div>
                                <div class="col-sm-5">
                                    <label>Value<span class="text-danger">*</span></label>
                                    <input type="text" name="product_details[0][val]" class="form-control input_value">
                                    <span class="text-danger err"></span>
                                </div>
                                <div class="col-sm-1" style="align-content: center;">
                                    <button type="button" class="btn btn-danger" id="add_attr" onclick="rmvDetailAttr(this)">-</button>
                                </div>
                            </div>    
    </div>

    <div style="display:none;" id="clone_single_val">
         <div class="row">
                                <div class="col-sm-1 text-center" style="align-content: center;">
                                    <span class="cnt">1.</span>
                                    
                                </div>
                                <div class="col-sm-2">
                                    <label>Attribute<span class="text-danger">*</span></label>
                                    <select name="value_attribute[0][attr]" class="form-control select_attr" >
                                        <option value="">Select Attribute</option>
                                        @foreach($attributes as $attr)
                                        <option value="{{$attr['_id']}}">{{$attr['name']}}</option>
                                        @endforeach
                                    </select>
                                    <span class="text-danger err"></span>
                                </div>
                                <div class="col-sm-2">
                                    <label>Value<span class="text-danger">*</span></label>
                                    <input type="text" name="value_attribute[0][val]" class="form-control input_val" >
                                    <span class="text-danger err"></span>
                                </div>
                                <div class="col-sm-2  product_img pro_atr_img" id="pro_atr_img-1">
                                    <div class="text-center" valign="middle" style="border:1px solid #ccc; background:#efefef; width:100%; height: 100%; align-content: center; border-radius:5px;">Image</div>
                                </div>
                                <div class="col-sm-2">
                                    <label>Image</label>
                                    <input type="file" name="value_attribute[0][image]" class="form-control input_image" id="input_image-1" onchange="loadFile(event, this, 'pro_atr')">
                                </div>
                                <div class="col-sm-2" style="align-content: center;">
                                    <button type="button" class="btn btn-danger" onclick="rmvSingleVal(this)">-</button>
                                </div>
                        </div>
    </div>

 
@endsection

@section('script')
<script>
    $.ajaxSetup({
        headers: {
            'X-CSRF-TOKEN' : $('meta[name="csrf-token"]').attr('content')
        }
    });

    $('#add_single_attr').click(function(e){
        e.preventDefault();
        var clone_single_val = $('#clone_single_val').html();
        $('.append_single_val').append(clone_single_val);
        single_attr_cnt();
    });

    function single_attr_cnt(){
        $('.append_single_val span.cnt').each(function(key, val){
          $(this).text(parseInt(key)+1);
        });

        $('.append_single_val .row').each(function(key, val){
            var key = parseInt(key) + 1;
            $(this).attr('id','row-'+key);
        });

        $('.append_single_val .row').each(function(key, val){
            $('.append_single_val .select_attr').each(function(k,v){
                $(this).attr('name', "value_attribute["+k+"][attr]");

            });
            $('.append_single_val .input_val').each(function(k,v){
                $(this).attr('name', "value_attribute["+k+"][val]");
            });
            

            $('.append_single_val .pro_atr_img').each(function(k,v){
                 $(this).attr('id', 'pro_atr_img-'+k);
            });

            $('.append_single_val .input_image').each(function(k,v){
                $(this).attr('name', "value_attribute["+k+"][image]");
                $(this).attr('id', 'input_image-'+k);
            });
        });
    }

    function rmvSingleVal(ths){
        $(ths).closest('div.row').remove();
        single_attr_cnt();
    }

    $('#multi_val_attr_add').click(function(){
        var attr_div =  $('.multi_val_content').html();
        $('.multi_val_inputs').append(attr_div);
        outer_attr_count();
    });

    function outer_attr_count(){
        $('.multi_val_inputs span.outer_attr_cnt').each(function(key, val){
              $(this).text(parseInt(key)+1);
            });
        $('.multi_val_inputs .attr_div').each(function(key, val){
            var key = parseInt(key);
            $(this).attr('id','card-'+key);
        });
        $('.multi_val_inputs select').each(function(key, val){
            $(this).attr('name', "multivalues_attribute["+key+"][attr][]");
        });
        innerAttr();
    }

    function innerAttr(){
        $('.multi_val_inputs .attr_div').each(function(key, val){
            var card_id = $(this).attr('id').split('-')[1];
            $('.multi_val_inputs #card-'+card_id+' input.val').each(function(k,v){
                $(this).attr('name', "multivalues_attribute["+card_id+"]["+k+"][val]");
            });
            $('.multi_val_inputs #card-'+card_id+' input.image').each(function(k,v){
                $(this).attr('name', "multivalues_attribute["+card_id+"]["+k+"][image]");
            });
        });
    }

    function rmvMultiValAttr(ths){
        $(ths).closest('div.card').remove();
        outer_attr_count();
    }

    function addValueMulti(ths){
        var multi_val = $('.multiple_val').html();
        $(ths).closest('.attr_values').append(multi_val);
        innerAttr();
    }

    function rmvValueMulti(ths){
        $(ths).closest('.multi_val').remove();
        innerAttr();
    }


    $('#add_attr').click(function(e){
        e.preventDefault();
        var clone_input = $('#clone_input').html();
        $('.append_input').append(clone_input);
        dtl_attr_cnt();
    });

    function dtl_attr_cnt(){
        $('.append_input span.dtl_attr_cnt').each(function(key, val){
          $(this).text(parseInt(key)+1);
        });

        $('.append_input .row').each(function(key, val){
            var key = parseInt(key) + 1;
            $(this).attr('id','row-'+key);
        });

        $('.append_input .row').each(function(key, val){
            var row_id = $(this).attr('id');
            $('.append_input .select_attribute').each(function(k,v){
                $(this).attr('name', "product_details["+k+"][attr]");
            });
            $('.append_input .input_value').each(function(k,v){
                $(this).attr('name', "product_details["+k+"][val]");
            });
        });
    }

    function rmvDetailAttr(ths){
        $(ths).closest('div.row').remove();
        dtl_attr_cnt();
    }

    function loadMultiple(event, identy){
      var total_file=document.getElementById(identy).files.length;
      $('#image_preview').html('');
      for(var i=0;i<total_file;i++){
        $('#image_preview').append("<div class='col-2'><img src='"+URL.createObjectURL(event.target.files[i])+"'  height='100'></div>");
      }
    }

    function loadFile(event, ths, tab_id){
        if(tab_id == 'content'){
            $('#product_img').html("<img src='"+URL.createObjectURL(event.target.files[0])+"'  width='100%' height='100%'>");
        }else if(tab_id == 'vrtn'){
            var id = $(ths).attr('id').split('-')[1];
            $('#product_img-'+id).html("<img src='"+URL.createObjectURL(event.target.files[0])+"'  width='100%' height='100%'>");
        }else if(tab_id == 'attr'){
            var ids = $(ths).attr('id').split('-');
            var id = ids[1]+'-'+ids[2];
            $('#attr_product_img-'+id).html("<img src='"+URL.createObjectURL(event.target.files[0])+"'  width='100%' height='100%'>");
        }else if(tab_id == 'pro_atr'){
            var id = $(ths).attr('id').split('-')[1];
            $('#pro_atr_img-'+id).html("<img src='"+URL.createObjectURL(event.target.files[0])+"'  width='100%' height='100%'>");
        }
    }

    $('#product_save').click(function(e){
        e.preventDefault();
        var validate = checkValidations();
        if(validate){
            var fd = new FormData($('#add_product_form')[0]);
            $.ajax({
                url:"{{route('save-product')}}",
                type:"post",
                dataType:'json',
                processData:false,
                contentType:false,
                data:fd,
                success:function(data){
                    if(data.success){
                        alert('Product Saved Successfully');
                    }else{
                        alert(data.message);
                    }
                },
            });
        }
    });

    function checkValidations(){
        var names = [];
        var details_err = 0;
        $('#product select, #product input').each(function(k,v){
            if($(this).val() == ''){ 
                var name = $(this).attr('name');
                if(name != 'discount'){
                    names.push(name);
                }else{
                    $(this).next('span').text('');
                }
            }
        });

        for(i in names){
            $('.'+names[i]).text('This field is required'); 
        }

        var images_err = false;
        if($('#image-1').val() == ''){
            $('.product_images').text('This field is required');
            var images_err = true; 
        }else{
            $('.product_images').text('');
        }

        var attr_err = 0;
        $('#single-val select.select_attr, #single-val input.input_val').each(function(k, v){
            if($(this).val() == ''){
                $(this).next('span').text('This field is required.');
                attr_err = parseInt(attr_err) + 1;
            }else{
                $(this).next('span').text('');
            }
        });

        var details_err = 0;
        $('#product_details input').each(function(k,v){
            if($(this).val() == ''){
                $(this).next('span').text('This field is required.');
                details_err = parseInt(details_err) + 1;
            }else{
                $(this).next('span').text('');
            }
        });

        var variations_err = 0;
        $('#variations .input').each(function(k,v){
            if($(this).data('name') != 'attr_image'){
                if($(this).val() == ''){
                    $(this).next('span').text('This field is required.');
                     variations_err = parseInt(variations_err) + 1;
                }else{
                    $(this).next('span').text('');
                }
            }
        });
       
        if(names.length != 0){
            $('#product-tab').trigger('click')
            return false;
        }

        if(images_err){
            $('#product-images-tab').trigger('click');
            return false;
        }
        
        if(attr_err > 0){
            $('#single-val-tab').trigger('click');
            return false;
        }

        if(details_err > 0){
            $('#product_details-tab').trigger('click');
            return false;
        }

        if(variations_err > 0 && $('#variations').is(':visible')){
            $('#prod_vartn').text('Atleast one variation is required.');
            prod_vartn
            $('#variation-tab').trigger('click');
            return false;
        }else{

            var add_vrtn = confirm('Do you want to add a variation?');
            if(add_vrtn){
                $('#variation-tab').trigger('click');
                return false;
            }else{
                $('#prod_vartn').text('');
            }
        }
        
        return true;
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

    $('#sub_category_id').change(function(k,v){
        var val = $(this).val();
        $.ajax({
            url:"{{route('fetch-attr')}}",
            type:"get",
            data: {sid : val},
            success:function(data){
                if(data.success){
                    $('.select_attr').html(data.html_content);
                    $('.attributes').html(data.html_content);
                }
            },
        });
    });

var c = 1;
$('#add-card').click(function(){
  c++;
  var data = $('.card-field:first').clone(true);
  var table = $('.service_table:first').clone(true);
  $('.card-panel').append(data);
  var res = $(data).attr('id').split('-');
  $(data).find('input').val('');
  $(table).find('input.show').val('');
  $(table).find('select.attributes').val('').trigger('change');


  $(table).find('.attr_product_img').html('<div class="text-center" valign="middle" style="border:1px solid #ccc; background:#efefef; width:100%; height: 100%; align-content: center; border-radius:5px;">Image</div>');


  $(data).find('span.text-danger').text('');
  $(data).find('.service_table').remove();
  $(data).find('.services').append(table);


  $(data).find('.vrtn_img').html('<div class="text-center" valign="middle" style="border:1px solid #ccc; background:#efefef; width:100%; height: 100%; align-content: center; border-radius:5px;">Image</div>');

  var details = $('.pro_details_table:first').clone(true);
  $(details).find('input').val('');
  $(data).find('.pro_details_table').remove();
  $(data).find('.pro_details').append(details);

  $(data).find('.err').text('');
  cardcount();
  cardorder();
 // orderids();
  $('span.asteric').text('*');
});

var s=1;
function addService(ths){
  s++;
  var data = $('.service_table:first').clone(true);
  var ide = $(ths).attr('id').split('-')[1];
  $(data).find('input.show').val('');
  $(data).find('select.attributes').val('').trigger('change');
  $(data).find('.attr_product_img').html('<div class="text-center" valign="middle" style="border:1px solid #ccc; background:#efefef; width:100%; height: 100%; align-content: center; border-radius:5px;">Image</div>');
  $(data).find('.rmv').attr('disabled', false);
  $(ths).closest('div').append(data);
  orderservice();
  //orderids();
}

var d=1;
function addDetails(ths){
  d++;
  var data = $('.pro_details_table:first').clone(true);
  var ide = $(ths).attr('id').split('-')[1];
  $(data).find('input.show').val('');
  $(data).find('select.attributes').val('').trigger('change');
   $(data).find('.rmv').attr('disabled', false);
  $(ths).closest('div').append(data);
  orderDetails();
  //orderDetailsIds();
}

function removeTable(ths){
  if(s>1){
    $(ths).closest('.service_table').remove();
    s--;
    orderservice();
    //orderids();
  }else{
    alert('Minimum one attribute is required');
  }
}

function removeDetails(ths){
  if(d>1){
    $(ths).closest('.pro_details_table').remove();
    d--;
    orderDetails();
    //orderDetailsIds();
  }else{
    alert('Minimum one product details is required');
  }
}

function cardcount(){
    $('span.count').each(function(key, element){
        $(this).text(key+1);
    })
    var as = 1;
    $('.add_service').each(function(key, val){
        $(this).attr('id', 'add_service-'+as);
      as++;
    });
    var rm = 1;
    $('.remove_card').each(function(key, val){
        $(this).attr('id', 'remove_card-'+rm);
      rm++;
    });
}

function orderservice(){
var os=1;
 $('.services').each(function (key, val){
    var id1 = $(this).attr('id').split('-'); 
    var ord = parseInt(id1[1])-1; 
    $(this).attr('id', id1[0]+'-'+os);
    $('#services-'+os+' button.service_count').each(function(key, val){
      $(this).text(key+1);
    });

    $('#services-'+os+' .service_table').each(function(k,v){
        $(this).attr('id', 'service_table-'+os);
        $(this).find('.attr_name').each(function(k1,v1){
            var name = $(this).data('name');
            var name_format = 'variation['+ord+']['+k+']['+name+']';
            $(this).attr('name', name_format);
            $(this).attr('id', name+'-'+ord+'-'+k);
        });

        $(this).find('.attr_product_img').each(function(k1,v1){
            $(this).attr('id', 'attr_product_img-'+ord+'-'+k);
        })
    });



    os++;
  })
}


function orderDetails(){
var od=1;
 $('.pro_details').each(function (key, val){
    var id1 = $(this).attr('id').split('-'); 
    var ord = parseInt(id1[1])-1; 
    $(this).attr('id', id1[0]+'-'+od);
    $('#pro_details-'+od+' button.pro_details_count').each(function(key, val){
      $(this).text(key+1);
    });

    $('#pro_details-'+od+' .pro_details_table').each(function(k,v){
        $(this).attr('id', 'pro_details_table-'+od);
        $(this).find('input.dtl_attr_name').each(function(k1,v1){
            var name = $(this).data('name');
            var name_format = 'variation['+ord+']['+k+']['+name+']';
            $(this).attr('name', name_format);
            $(this).attr('id', name+'-'+ord+'-'+k);
        });
    });
    od++;
  });
}


/*function orderids(){
    $('.attributes').each(function(key, val){
      var select = key+1;
      var id1 = $(this).attr('id').split('-'); 
      $(this).attr('id', id1[0]+'-'+select);
    })
      $('input.show').each(function(key, val){
      var input = key+1;
      var id2 = $(this).attr('id').split('-'); 
      $(this).attr('id', id2[0]+'-'+input);
    })
}*/


/*function orderDetailsIds(){

      $('.pro_details input.show').each(function(key, val){
      var input = key+1;
      var id2 = $(this).attr('id').split('-'); 
      $(this).attr('id', id2[0]+'-'+input);
    })

}*/


function cardorder(){
    var co = 1;
    $('.card-field').each(function(){
      $(this).attr('id','card_field-'+co);
      
        $('#card_field-'+co+' input').each(function(){
          var field = $(this).attr('id').split('-');
          $(this).attr('id', field[0]+'-'+co);
        })

        $('#card_field-'+co+' .frm_err').each(function (key, val){
          var err = $(this).attr('id').split('-'); 
          $(this).attr('id', err[0]+'-'+co);
        })

         $('#card_field-'+co+' .pro_name').each(function(){
          var name = $(this).data('name');
          var index = parseInt(co)-1;
          var format_name = 'variation['+index+']['+name+']'
          $(this).attr('name', format_name);
        })


        $('#card_field-'+co+' .vrtn_img').each(function(){
          $(this).attr('id', 'product_img-'+co);
        });

        orderservice();
        orderDetails();

      co++;
    });
  }

function removeCard(id){
 if(c>1){
   var res = id.split('-');
  $('#card_field-'+res[1]).remove();
  c--;
   cardcount();
   cardorder();
  }else{
    alert('Minimum One Variation is required to be Listed');
  }
}

function countDiscount(id){
  if(id == 'mrp_amount' || id == 'sell_amount'){
    var mrp = $('#mrp_amount').val();
    var sell_price = $('#sell_amount').val();
  }else{
    var ide = id.split('-')[1];
    var mrp = $('#mrp-'+ide).val();
    var sell_price = $('#sell_price-'+ide).val();
  }
  if(mrp!="" && sell_price!=""){
    var discount = mrp - sell_price;
  }else{
    var discount = 0;
  }
  if(id == 'mrp_amount' || id == 'sell_amount'){
    $('#discount_amount').val(discount);
  }else{
    $('#discount-'+ide).val(discount);
  }
}

$("#flexSwitchCheckDefault").click(function(){
  $("#variations").toggle();
  var vrtn = $('#display_on_switch').html();
  $("#variations").html(vrtn);
});


$("#flexSwitchCheckChecked").click(function(){
  $("#variations").toggle();
  var vrtn = $('#display_on_switch').html();
  $("#variations").html(vrtn);
});
</script>
@endsection