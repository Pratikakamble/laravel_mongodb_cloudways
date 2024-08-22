<p id="prod_vartn" class="text-danger"></p>
@if(isset($variation))
  <div class="content-wrapper" id="variations">
    <div class="col-12 grid-margin stretch-card">
      <div class="card">
        <div class="card-body">
          <div class="card-panel">
            <div class="row pb-2"><div class="col-6 text-left"><b>Product Variations</b></div><div class="col-6 text-right" align="right"><button type="button" class="btn btn-success btn-sm" id="add-card">Add Variation</button></div></div>
            @foreach($variation as $key => $vrtn)
              @php
                $index = $key;
                $key = $key+1;
              @endphp
                <div class="card card-field" id="card_field-{{$key}}">
                  <div class="card-header row mt-3 mb-3">
                    <div class="col-6 text-left"><b>Variation<span class="text-danger asteric">*</span>: <span class="count">{{$key}}</span></b></div>
                    <div class="col-6 text-right"></div>
                  </div>
                  <div class="card-body form-row " style="padding:20px;" >
                    <div class="row">
                      <div class="col-md-5">
                        <input type="hidden" class="pro_name" name="variation[{{$index}}][variation_id]" data-name="variation_id" value="{{$vrtn['_id']}}">

                        <input type="hidden" class="pro_name" name="variation[{{$index}}][prev_variation_img]" data-name="prev_variation_img" value="{{$vrtn['pro_image']}}">

                        <div class="form-group">
                          <label>Variation Name<span class="text-danger asteric">*</span></label>
                          <input type="text" name="variation[{{$index}}][name]" value="{{$vrtn['variation_name']}}" data-name="name" id="variation_name-{{$key}}" class="form-control input pro_name">
                          <span class="text-danger err"></span>
                        </div>
                      </div>
                      <div class="col-md-2 product_img vrtn_img" id="product_img-{{$key}}">
                        @if(isset($vrtn["pro_image"]))
                          <img src='{{asset($vrtn["pro_image"])}}' width='50%'>
                        @else
                        <div class="text-center" valign="middle" style="border:1px solid #ccc; background:#efefef; width:100%; height: 100%; align-content: center; border-radius:5px;">Image</div>
                        @endif
                      </div>
                      <div class="col-md-5">
                        <div class="form-group">
                          <label>Product Image<span class="text-danger asteric">*</span></label>
                          <input type="file" name="variation[{{$index}}][pro_image]" data-name="pro_image" required id="image-{{$key}}" class="form-control input pro_name"  accept="image/*" onchange="loadFile(event, this, 'vrtn')">
                          <span class="text-danger err"></span>
                        </div>
                      </div>
                    </div>
                    <div class="row mt-2">
                      <div class="col-md-4">
                        <div class="form-group">
                          <label>Product MRP<span class="text-danger asteric">*</span></label>
                          <input type="text" name="variation[{{$index}}][mrp]" id="mrp-{{$key}}" data-name="mrp" value="{{$vrtn['mrp']}}" onkeyup="countDiscount(this.id)" class="form-control input pro_name" >
                          <span class="text-danger err"></span>
                        </div>
                      </div>

                      <div class="col-md-4">
                        <div class="form-group">
                          <label>Selling Price<span class="text-danger asteric">*</span></label>
                          <input type="text" name="variation[{{$index}}][sell_price]" id="sell_price-{{$key}}" data-name="sell_price" class="form-control input pro_name" value="{{$vrtn['selling_price']}}" onkeyup="countDiscount(this.id)">
                          <span class="text-danger err"></span>
                        </div>
                      </div>

                      <div class="col-md-4">
                        <div class="form-group">
                          <label>Discount <span class="text-danger asteric">*</span></label>
                          <input type="text" name="variation[{{$index}}][discount]" id="discount-{{$key}}" data-name="discount" class="form-control input pro_name" value="{{$vrtn['discount']}}" readonly>
                          <span class="text-danger err"></span>
                        </div>
                      </div>
                    </div>
                    <div class="col-12">
                      <div class="form-group services multi-frm" id="services-{{$key}}">
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
                              <td width="5%" align="right"><button type="button" value="+"  class="btn btn-success btn-sm add_service" id="add_service-{{$key}}" onclick="addService(this)" style="padding-inline:13px;">+</button></td>
                          </tr>
                        </table>

                        @php
                          $key1 = 0;
                        @endphp
                        @foreach($vrtn['variation_attribute'] as $key_name => $variation_attribute)
                          @php
                            $index1 = $key1;
                            $key1 = $key1 + 1;
                          @endphp
                          <table width="100%" class="service_table frm-elm" id="service_table-{{$key1}}">
                              <tr>
                                <td width="5%">
                                  <button class="btn btn-info btn-xs service_count" >1</button>
                                </td>

                                <td width="25%" class="px-2 py-1">
                                  <input type="hidden" class="attr_name" name="variation[{{$index}}][{{$index1}}][pro_attr_id]" data-name="pro_attr_id" value="{{$variation_attribute['_id']}}">

                                  <input type="hidden" class="attr_name" name="variation[{{$index}}][{{$index1}}][prev_attr_img]" data-name="prev_attr_img" value="{{$variation_attribute['image'] ?? ''}}">

                                  <select name="variation[{{$index}}][{{$index1}}][attr_id]" data-name="attr_id" class="form-control attributes input attr_name" id="attr_id-{{$index}}-{{$index1}}">

                                    <option value="">Select Attribute</option>
                                    @foreach($attributes as $attr)
                                      <option value="{{$attr['_id']}}" 
                                      @if($variation_attribute['attr_id'] == $attr['_id']) 
                                        selected
                                      @endif
                                      >{{$attr['name']}}
                                      </option>
                                    @endforeach              
                                  </select>
                                  <span class="text-danger err"></span>
                                </td>

                                <td width="25%" class="px-2 py-1">
                                  <input type="text" name="variation[{{$index}}][{{$index1}}][attr_val]" data-name="attr_val" value="{{$variation_attribute['attr_val']}}" class="form-control show input attr_name" id="attr_val-{{$index}}-{{$index1}}" >
                                  <span class="text-danger err"></span>
                                </td>

                                <td width="15%" class="px-2 product_img attr_product_img" id="attr_product_img-{{$index}}-{{$index1}}">
                                  @if(isset($variation_attribute["image"]))
                                    <img src='{{asset($variation_attribute["image"])}}' width='50%'>
                                  @else
                                  <div class="text-center" valign="middle" style="border:1px solid #ccc; background:#efefef; width:100%; height: 100%; align-content: center; border-radius:5px;">Image</div>
                                  @endif
                                </td>

                                <td width="25%" class="px-2 py-1">
                                  <input type="file" name="variation[{{$index}}][{{$index1}}][attr_image]" class="form-control show input attr_name" data-name="attr_image" id="attr_image-{{$index}}-{{$index1}}" onchange="loadFile(event, this, 'attr')">
                                  <span class="text-danger err"></span>
                                </td>
                                <td align="right" width="5%">
                                  <button type="button" class="btn btn-danger btn-sm rmv" @if($index1 == 0) disabled @endif onclick="removeTable(this)">-</button>
                                </td>
                              </tr>
                          </table>
                        @endforeach
                      </div>
                    </div>
                    <div class="col-12">

                      <div class="form-group pro_details multi-frm" id="pro_details-{{$key}}">
                        <table width="100%" class="mt-3">
                          <tr>
                            <th colspan="6">Other Product Details</th>
                          </tr>
                          <tr>
                              <td width="5%"></td>
                              <td width="45%" class="px-2" style="font-size:13px;"><b>Attributes<span class="text-danger asteric">*</span></b></td>
                              <td width="45%" class="px-2" style="font-size:13px;"><b>Values<span class="text-danger asteric">*</span></b></td>
                              <td width="5%" align="right"><button type="button" value="+"  class="btn btn-success btn-sm add_service" id="add_service-{{$key}}" onclick="addDetails(this)" style="padding-inline:13px;">+</button></td>
                          </tr>
                        </table>
                        
                        @php
                          $key2 = 0;
                        @endphp
                        @foreach($vrtn['variation_detail'] as $key_dtl => $variation_dtl)
                        @php
                          $index2 = $key2;
                          $key2 = $key2 + 1;
                        @endphp
                        <table width="100%" class="pro_details_table frm-elm" id="pro_details_table-{{$key2}}">
                          <tr>
                            <td width="5%">
                              <button class="btn btn-info btn-xs pro_details_count">{{$key2}}</button>
                            </td>
                            <td width="45%" class="px-2 py-1">
                              <input type="hidden" class="dtl_attr_name" name="variation[{{$index}}][{{$index2}}][pro_attr_dtl_id]" data-name="pro_attr_dtl_id" value="{{$variation_dtl['_id']}}">

                              <input type="text" name="variation[{{$index}}][{{$index2}}][dtl_attr_name]" data-name="dtl_attr_name" class="form-control show input dtl_attr_name" id="dtl_attr_name-{{$index}}-{{$index2}}" value="{{$variation_dtl['attr_name']}}">
                              <span class="text-danger err"></span>
                            </td>
                            <td width="45%" class="px-2 py-1">
                              <input type="text" name="variation[{{$index}}][{{$index2}}][dtl_attr_val]" data-name="dtl_attr_val" class="form-control show input dtl_attr_name" id="dtl_attr_val-{{$index}}-{{$index2}}"  value="{{$variation_dtl['attr_val']}}">
                              <span class="text-danger err"></span>
                            </td>
                            <td align="right" width="5%">
                              <button type="button" class="btn btn-danger btn-sm rmv" @if($index2 == 0) disabled @endif onclick="removeDetails(this)">-</button>
                            </td>
                          </tr>
                        </table>
                        @endforeach
                      </div>
                      

                    </div>
                    <div class="col-12 text-right mt-4" align="right">
                        <button type="button" style="background-color:#dc3545; color:white" class="btn btn-sm remove_card" id = "remove_card-{{$key}}" onclick = "removeCard(this.id)">Remove Variation</button>
                    </div>
                  </div>
                </div>
            @endforeach
          </div>
        </div>
      </div>
    </div>
  </div>
@else
  <div class="content-wrapper" id="variations">
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
                                          @foreach($attributes as $attr)
                                          <option value="{{$attr['_id']}}">{{$attr['name']}}</option>
                                          @endforeach              
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
@endif