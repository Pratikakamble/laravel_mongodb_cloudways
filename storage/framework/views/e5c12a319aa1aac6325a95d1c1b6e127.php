


<p id="prod_vartn" class="text-danger"></p>
<?php if(isset($variation)): ?>

  <?php if(count($variation) > 0): ?>
  <div class="form-check form-switch">
    <input class="form-check-input" type="checkbox" role="switch" id="flexSwitchCheckChecked" checked>
    <label class="form-check-label" for="flexSwitchCheckChecked">Add Variations</label>
  </div> 
  <?php else: ?>
   <div class="form-check form-switch">
    <input class="form-check-input" type="checkbox" id="flexSwitchCheckDefault">
    <label class="form-check-label" for="flexSwitchCheckDefault">Add Variations</label>
  </div>
  <?php endif; ?>

  <div class="content-wrapper" id="variations" <?php if(count($variation) == 0): ?>  style="display:none;" <?php endif; ?>>
    <div class="col-12 grid-margin stretch-card">
      <div class="card">
        <div class="card-body">
          <div class="card-panel">
            <div class="row pb-2"><div class="col-6 text-left"><b>Product Variations</b></div><div class="col-6 text-right" align="right"><button type="button" class="btn btn-success btn-sm" id="add-card">Add Variation</button></div></div>
            <?php $__currentLoopData = $variation; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $key => $vrtn): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
              <?php
                $index = $key;
                $key = $key+1;
              ?>
                <div class="card card-field" id="card_field-<?php echo e($key); ?>">
                  <div class="card-header row mt-3 mb-3">
                    <div class="col-6 text-left"><b>Variation<span class="text-danger asteric">*</span>: <span class="count"><?php echo e($key); ?></span></b></div>
                    <div class="col-6 text-right"></div>
                  </div>
                  <div class="card-body form-row " style="padding:20px;" >
                    <div class="row">
                      <div class="col-md-5">
                        <input type="hidden" class="pro_name" name="variation[<?php echo e($index); ?>][variation_id]" data-name="variation_id" value="<?php echo e($vrtn['_id']); ?>">

                        <input type="hidden" class="pro_name" name="variation[<?php echo e($index); ?>][prev_variation_img]" data-name="prev_variation_img" value="<?php echo e($vrtn['pro_image'] ?? ''); ?>">

                        <div class="form-group">
                          <label>Variation Name<span class="text-danger asteric">*</span></label>
                          <input type="text" name="variation[<?php echo e($index); ?>][name]" value="<?php echo e($vrtn['variation_name']); ?>" data-name="name" id="variation_name-<?php echo e($key); ?>" class="form-control input pro_name">
                          <span class="text-danger err"></span>
                        </div>
                      </div>
                      <div class="col-md-2 product_img vrtn_img" id="product_img-<?php echo e($key); ?>">
                        <?php if(isset($vrtn["pro_image"])): ?>
                          <img src='<?php echo e(asset($vrtn["pro_image"])); ?>' width='50%'>
                        <?php else: ?>
                        <div class="text-center" valign="middle" style="border:1px solid #ccc; background:#efefef; width:100%; height: 100%; align-content: center; border-radius:5px;">Image</div>
                        <?php endif; ?>
                      </div>
                      <div class="col-md-5">
                        <div class="form-group">
                          <label>Product Image<span class="text-danger asteric">*</span></label>
                          <input type="file" name="variation[<?php echo e($index); ?>][pro_image]" data-name="pro_image" required id="image-<?php echo e($key); ?>" class="form-control input pro_name"  accept="image/*" onchange="loadFile(event, this, 'vrtn')">
                          <span class="text-danger err"></span>
                        </div>
                      </div>
                    </div>
                    <div class="row mt-2">
                      <div class="col-md-4">
                        <div class="form-group">
                          <label>Product MRP<span class="text-danger asteric">*</span></label>
                          <input type="text" name="variation[<?php echo e($index); ?>][mrp]" id="mrp-<?php echo e($key); ?>" data-name="mrp" value="<?php echo e($vrtn['mrp']); ?>" onkeyup="countDiscount(this.id)" class="form-control input pro_name" >
                          <span class="text-danger err"></span>
                        </div>
                      </div>

                      <div class="col-md-4">
                        <div class="form-group">
                          <label>Selling Price<span class="text-danger asteric">*</span></label>
                          <input type="text" name="variation[<?php echo e($index); ?>][sell_price]" id="sell_price-<?php echo e($key); ?>" data-name="sell_price" class="form-control input pro_name" value="<?php echo e($vrtn['selling_price']); ?>" onkeyup="countDiscount(this.id)">
                          <span class="text-danger err"></span>
                        </div>
                      </div>

                      <div class="col-md-4">
                        <div class="form-group">
                          <label>Discount <span class="text-danger asteric">*</span></label>
                          <input type="text" name="variation[<?php echo e($index); ?>][discount]" id="discount-<?php echo e($key); ?>" data-name="discount" class="form-control input pro_name" value="<?php echo e($vrtn['discount']); ?>" readonly>
                          <span class="text-danger err"></span>
                        </div>
                      </div>
                    </div>
                    <div class="col-12">
                      <div class="form-group services multi-frm" id="services-<?php echo e($key); ?>">
                        <table width="100%" class="mt-3">
                          <tr>
                            <th colspan="6">Attributes Variations</th>
                          </tr>
                          <tr>
                              <td width="5%"></td>
                              <td width="25%" class="px-2" style="font-size:13px;"><b>Attributes<span class="text-danger asteric">*</span></b></td>
                              <td width="25%" class="px-2" style="font-size:13px;"><b>Values<span class="text-danger asteric">*</span></b></td>
                             <!--  <td width="20%" style="font-size:12px;"><b>Price</b></td> -->
                              <td width="15%" class="px-2" style="font-size:13px;"><b>Img View<span class="text-danger asteric">*</span></b></td>
                              <td width="25%" class="px-2" style="font-size:13px;"><b>Image</b></td>
                              <td width="5%" align="right"><button type="button" value="+"  class="btn btn-success btn-sm add_service" id="add_service-<?php echo e($key); ?>" onclick="addService(this)" style="padding-inline:13px;">+</button></td>
                          </tr>
                        </table>

                        <?php
                          $key1 = 0;
                        ?>
                        <?php $__currentLoopData = $vrtn['variation_attribute']; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $key_name => $variation_attribute): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                          <?php
                            $index1 = $key1;
                            $key1 = $key1 + 1;
                          ?>
                          <table width="100%" class="service_table frm-elm" id="service_table-<?php echo e($key1); ?>">
                              <tr>
                                <td width="5%">
                                  <button class="btn btn-info btn-xs service_count" >1</button>
                                </td>

                                <td width="25%" class="px-2 py-1">
                                  <input type="hidden" class="attr_name" name="variation[<?php echo e($index); ?>][<?php echo e($index1); ?>][pro_attr_id]" data-name="pro_attr_id" value="<?php echo e($variation_attribute['_id']); ?>">

                                  <input type="hidden" class="attr_name" name="variation[<?php echo e($index); ?>][<?php echo e($index1); ?>][prev_attr_img]" data-name="prev_attr_img" value="<?php echo e($variation_attribute['image'] ?? ''); ?>">

                                  <select name="variation[<?php echo e($index); ?>][<?php echo e($index1); ?>][attr_id]" data-name="attr_id" class="form-control attribzutes input attr_name" id="attr_id-<?php echo e($index); ?>-<?php echo e($index1); ?>">

                                    <option value="">Select Attribute</option>
                                    <?php $__currentLoopData = $attributes; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $attr): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                      <option value="<?php echo e($attr['_id']); ?>" 
                                      <?php if($variation_attribute['attr_id'] == $attr['_id']): ?> 
                                        selected
                                      <?php endif; ?>
                                      ><?php echo e($attr['name']); ?>

                                      </option>
                                    <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>              
                                  </select>
                                  <span class="text-danger err"></span>
                                </td>

                                <td width="25%" class="px-2 py-1">
                                  <input type="text" name="variation[<?php echo e($index); ?>][<?php echo e($index1); ?>][attr_val]" data-name="attr_val" value="<?php echo e($variation_attribute['attr_val']); ?>" class="form-control show input attr_name" id="attr_val-<?php echo e($index); ?>-<?php echo e($index1); ?>" >
                                  <span class="text-danger err"></span>
                                </td>

                                <td width="15%" class="px-2 product_img attr_product_img" id="attr_product_img-<?php echo e($index); ?>-<?php echo e($index1); ?>">
                                  <?php if(isset($variation_attribute["image"])): ?>
                                    <img src='<?php echo e(asset($variation_attribute["image"])); ?>' width='50%'>
                                  <?php else: ?>
                                  <div class="text-center" valign="middle" style="border:1px solid #ccc; background:#efefef; width:100%; height: 100%; align-content: center; border-radius:5px;">Image</div>
                                  <?php endif; ?>
                                </td>

                                <td width="25%" class="px-2 py-1">
                                  <input type="file" name="variation[<?php echo e($index); ?>][<?php echo e($index1); ?>][attr_image]" class="form-control show input attr_name" data-name="attr_image" id="attr_image-<?php echo e($index); ?>-<?php echo e($index1); ?>" onchange="loadFile(event, this, 'attr')">
                                  <span class="text-danger err"></span>
                                </td>
                                <td align="right" width="5%">
                                  <button type="button" class="btn btn-danger btn-sm rmv" <?php if($index1 == 0): ?> disabled <?php endif; ?> onclick="removeTable(this)">-</button>
                                </td>
                              </tr>
                          </table>
                        <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                      </div>
                    </div>
                    <div class="col-12">

                      <div class="form-group pro_details multi-frm" id="pro_details-<?php echo e($key); ?>">
                        <table width="100%" class="mt-3">
                          <tr>
                            <th colspan="6">Other Product Details</th>
                          </tr>
                          <tr>
                              <td width="5%"></td>
                              <td width="45%" class="px-2" style="font-size:13px;"><b>Attributes<span class="text-danger asteric">*</span></b></td>
                              <td width="45%" class="px-2" style="font-size:13px;"><b>Values<span class="text-danger asteric">*</span></b></td>
                              <td width="5%" align="right"><button type="button" value="+"  class="btn btn-success btn-sm add_service" id="add_service-<?php echo e($key); ?>" onclick="addDetails(this)" style="padding-inline:13px;">+</button></td>
                          </tr>
                        </table>
                        
                        <?php
                          $key2 = 0;
                        ?>
                        <?php $__currentLoopData = $vrtn['variation_detail']; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $key_dtl => $variation_dtl): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                        <?php
                          $index2 = $key2;
                          $key2 = $key2 + 1;
                        ?>
                        <table width="100%" class="pro_details_table frm-elm" id="pro_details_table-<?php echo e($key2); ?>">
                          <tr>
                            <td width="5%">
                              <button class="btn btn-info btn-xs pro_details_count"><?php echo e($key2); ?></button>
                            </td>
                            <td width="45%" class="px-2 py-1">
                              <input type="hidden" class="dtl_attr_name" name="variation[<?php echo e($index); ?>][<?php echo e($index2); ?>][pro_attr_dtl_id]" data-name="pro_attr_dtl_id" value="<?php echo e($variation_dtl['_id']); ?>">

                              <input type="text" name="variation[<?php echo e($index); ?>][<?php echo e($index2); ?>][dtl_attr_name]" data-name="dtl_attr_name" class="form-control show input dtl_attr_name" id="dtl_attr_name-<?php echo e($index); ?>-<?php echo e($index2); ?>" value="<?php echo e($variation_dtl['attr_name']); ?>">
                              <span class="text-danger err"></span>
                            </td>
                            <td width="45%" class="px-2 py-1">
                              <input type="text" name="variation[<?php echo e($index); ?>][<?php echo e($index2); ?>][dtl_attr_val]" data-name="dtl_attr_val" class="form-control show input dtl_attr_name" id="dtl_attr_val-<?php echo e($index); ?>-<?php echo e($index2); ?>"  value="<?php echo e($variation_dtl['attr_val']); ?>">
                              <span class="text-danger err"></span>
                            </td>
                            <td align="right" width="5%">
                              <button type="button" class="btn btn-danger btn-sm rmv" <?php if($index2 == 0): ?> disabled <?php endif; ?> onclick="removeDetails(this)">-</button>
                            </td>
                          </tr>
                        </table>
                        <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                      </div>
                      

                    </div>
                    <div class="col-12 text-right mt-4" align="right">
                        <button type="button" style="background-color:#dc3545; color:white" class="btn btn-sm remove_card" id = "remove_card-<?php echo e($key); ?>" onclick = "removeCard(this.id)">Remove Variation</button>
                    </div>
                  </div>
                </div>
            <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
          </div>
        </div>
      </div>
    </div>
  </div>
<?php else: ?>
  <div class="form-check form-switch">
    <input class="form-check-input" type="checkbox" id="flexSwitchCheckDefault">
    <label class="form-check-label" for="flexSwitchCheckDefault">Add Variations</label>
  </div>


  <div class="content-wrapper" id="variations" style="display:none;">
    <div class="col-12 grid-margin stretch-card">
      <div class="card">
        <div class="card-body">
          <div class="card-panel">
            <div class="row pb-2"><div class="col-6 text-left"><b>Product Variations</b></div><div class="col-6 text-right" align="right"><button type="button" class="btn btn-success btn-sm" id="add-card">Add Variation</button></div></div>
            <div class="card card-field" id="card_field-1">
              <div class="card-header row mt-3 mb-3">
                <div class="col-6 text-left"><b>Variation<span class="text-danger asteric">*</span>: <span class="count">1</span></b></div>
                <div class="col-6 text-right"></div>
              </div>
              <div class="card-body form-row " style="padding:20px;" >
                <div class="row">
                  <div class="col-md-5">
                    <div class="form-group">
                      <label>Variation Name<span class="text-danger asteric">*</span></label>
                      <input type="text" name="variation[0][name]" data-name="name" id="variation_name-1" class="form-control input pro_name">
                      <span class="text-danger err"></span>
                    </div>
                  </div>
                  <div class="col-md-2 product_img vrtn_img" id="product_img-1">
                    <div class="text-center" valign="middle" style="border:1px solid #ccc; background:#efefef; width:100%; height: 100%; align-content: center; border-radius:5px;">Image</div>
                  </div>
                  <div class="col-md-5">
                    <div class="form-group">
                      <label>Product Image<span class="text-danger asteric">*</span></label>
                      <input type="file" name="variation[0][pro_image]" data-name="pro_image" required id="image-1" class="form-control input pro_name" value="" accept="image/*" onchange="loadFile(event, this, 'vrtn')">
                      <span class="text-danger err"></span>
                    </div>
                  </div>
                </div>
                <div class="row mt-2">
                  <div class="col-md-4">
                    <div class="form-group">
                      <label>Product MRP<span class="text-danger asteric">*</span></label>
                      <input type="text" name="variation[0][mrp]" id="mrp-1" data-name="mrp" onkeyup="countDiscount(this.id)" class="form-control input pro_name" >
                      <span class="text-danger err"></span>
                    </div>
                  </div>

                  <div class="col-md-4">
                    <div class="form-group">
                      <label>Selling Price<span class="text-danger asteric">*</span></label>
                      <input type="text" name="variation[0][sell_price]" id="sell_price-1" data-name="sell_price" class="form-control input pro_name" value="" onkeyup="countDiscount(this.id)">
                      <span class="text-danger err"></span>
                    </div>
                  </div>

                  <div class="col-md-4">
                    <div class="form-group">
                      <label>Discount <span class="text-danger asteric">*</span></label>
                      <input type="text" name="variation[0][discount]" id="discount-1" data-name="discount" class="form-control input pro_name" value="" readonly>
                      <span class="text-danger err"></span>
                    </div>
                  </div>
                </div>

                <div class="col-12">
                  <div class="form-group services multi-frm" id="services-1">
                    <table width="100%" class="mt-3">
                      <tr>
                        <th colspan="6">Attributes Variations</th>
                      </tr>
                        <tr>
                          <td width="5%"></td>
                          <td width="25%" class="px-2" style="font-size:13px;"><b>Attributes<span class="text-danger asteric">*</span></b></td>
                          <td width="25%" class="px-2" style="font-size:13px;"><b>Values<span class="text-danger asteric">*</span></b></td>
                         <!--  <td width="20%" style="font-size:12px;"><b>Price</b></td> -->
                         <td width="15%" class="px-2" style="font-size:13px;"><b>Img View<span class="text-danger asteric">*</span></b></td>
                          <td width="25%" class="px-2" style="font-size:13px;"><b>Image</b></td>
                          <td width="5%" align="right"><button type="button" value="+"  class="btn btn-success btn-sm add_service" id="add_service-1" onclick="addService(this)" style="padding-inline:13px;">+</button></td>
                        </tr>
                      </table>
                      <table width="100%" class="service_table frm-elm" id="service_table-1">
                        <tr>
                          <td width="5%">
                            <button class="btn btn-info btn-xs service_count" >1</button>
                          </td>
                          <td width="25%" class="px-2 py-1">
                            <select name="variation[0][0][attr_id]" data-name="attr_id" class="form-control attributes input attr_name" id="attr_id-0-0">
                                <option value="">Select Attribute</option>
                                          <?php $__currentLoopData = $attributes; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $attr): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                          <option value="<?php echo e($attr['_id']); ?>"><?php echo e($attr['name']); ?></option>
                                          <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>              
                            </select>
                            <span class="text-danger err"></span>
                          </td>
                          <td width="25%" class="px-2 py-1"><input type="text" name="variation[0][0][attr_val]" data-name="attr_val" class="form-control show input attr_name" id="attr_val-0-0" >
                             <span class="text-danger err"></span>
                          </td>

                          <td width="15%" class="px-2 product_img attr_product_img" id="attr_product_img-0-0">
                            <div class="text-center" valign="middle" style="border:1px solid #ccc; background:#efefef; width:100%; height: 100%; align-content: center; border-radius:5px;">Image</div>         
                          </td>

                          <td width="25%" class="px-2 py-1"><input type="file" name="variation[0][0][attr_image]" class="form-control show input attr_name" data-name="attr_image" id="attr_image-0-0" onchange="loadFile(event, this, 'attr')">
                            <span class="text-danger err"></span>
                          </td>

                          <td align="right" width="5%">
                            <button type="button" class="btn btn-danger btn-sm rmv" disabled onclick="removeTable(this)">-</button>
                          </td>
                        </tr>

                      </table>
                    </div>
                  </div>

                  <div class="col-12">
                    <div class="form-group pro_details multi-frm" id="pro_details-1">
                      <table width="100%" class="mt-3">
                        <tr>
                          <th colspan="6">Other Product Details</th>
                        </tr>
                        <tr>
                          <td width="5%"></td>
                          <td width="45%" class="px-2" style="font-size:13px;"><b>Attributes<span class="text-danger asteric">*</span></b></td>
                          <td width="45%" class="px-2" style="font-size:13px;"><b>Values<span class="text-danger asteric">*</span></b></td>
                          <td width="5%" align="right"><button type="button" value="+"  class="btn btn-success btn-sm add_service" id="add_service-1" onclick="addDetails(this)" style="padding-inline:13px;">+</button></td>
                        </tr>
                      </table>

                      <table width="100%" class="pro_details_table frm-elm" id="pro_details_table-1">
                        <tr>
                          <td width="5%">
                            <button class="btn btn-info btn-xs pro_details_count" >1</button>
                          </td>
                          <td width="45%" class="px-2 py-1">
                            <input type="text" name="variation[0][0][dtl_attr_name]" data-name="dtl_attr_name" class="form-control show input dtl_attr_name" id="dtl_attr_name-0-0" >
                             <span class="text-danger err"></span>
                          </td>

                          <td width="45%" class="px-2 py-1"><input type="text" name="variation[0][0][dtl_attr_val]" data-name="dtl_attr_val" class="form-control show input dtl_attr_name" id="dtl_attr_val-0-0" >
                             <span class="text-danger err"></span>
                          </td>


                          <td align="right" width="5%">
                            <button type="button" class="btn btn-danger btn-sm rmv" disabled onclick="removeDetails(this)">-</button>
                          </td>
                        </tr>

                      </table>
                    </div>
                  </div>

                  <div class="col-12 text-right mt-4" align="right">
                    <button type="button" style="background-color:#dc3545; color:white" class="btn btn-sm remove_card" id = "remove_card-1" onclick = "removeCard(this.id)">Remove Variation</button>
                  </div>
              </div>
            </div>
          </div>
        </div>
      </div>
    </div>
  </div>
<?php endif; ?>




<?php /**PATH D:\Laravel_Mongodb\resources\views/admin/products/product_variation.blade.php ENDPATH**/ ?>