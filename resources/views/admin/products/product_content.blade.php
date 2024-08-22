
@if(isset($product))
<input type="hidden" name="product_id" value="{{ $product['_id'] }}">
<div class="row mb-3">
                                <label class="col-sm-2 col-form-label">Category <span class="text-danger">*</span></label>
                                <div class="col-sm-10">
                                    <select  name="category_id" id="category_id" class="form-control" onchange="fetchSubCategory(this.value)" style="pointer-events: none;" >
                                        <option value="">Select Category</option>
                                        @foreach($categories as $ctg)
                                        <option value="{{$ctg['_id']}}"

                                        @if($product['category_id'] == $ctg['_id'])
                                            selected
                                        @endif
                                        >{{$ctg['name']}}</option>
                                        @endforeach
                                    </select>

                                </div>
                            </div>
                            <div class="row mb-3">
                                <label class="col-sm-2 col-form-label">Sub Category<span class="text-danger">*</span></label>
                                <div class="col-sm-10">
                                    <select name="sub_category_id" id="sub_category_id" class="form-control" style="pointer-events: none;">
                                    <option value="">Select Sub Category</option>
                                    @foreach($subcategories as $subctg)
                                    <option value="{{$subctg['_id']}}"
                                    @if($product['sub_category_id'] == $subctg['_id'])
                                        selected
                                    @endif
                                    >{{$subctg['name']}}</option>
                                    @endforeach
                                    </select>
                                </div>
                            </div>
<div class="row mb-3">
                                <label class="col-sm-2 col-form-label">Product Image<span class="text-danger">*</span></label>

                                <div class="col-sm-1 product_img" id="product_img">
                                    @isset($product["image"])
                                        <img src='{{asset($product["image"])}}'  width='100%' height='100%'>
                                    @endisset
                                </div>

                                <div class="col-sm-9">
                                    <input type="file" class="form-control" name = "image" id="image"  onchange="loadFile(event, this, 'content')">
                                </div>
                            </div>
                            <div class="row mb-3">
                                <label class="col-sm-2 col-form-label">Store Or Brand Name<span class="text-danger">*</span></label>
                                <div class="col-sm-10">
                                    <input type="text" class="form-control" name = "store_or_brand" id="store_or_brand" placeholder="Store Or Brand Name" value="{{$product['brand_or_store'] ?? ''}}">
                                </div>
                            </div>
                            <div class="row mb-3">
                                <label class="col-sm-2 col-form-label">Product Name<span class="text-danger">*</span></label>
                                <div class="col-sm-10">
                                    <input type="text" class="form-control" name = "product_name" id="product_name" placeholder="Product Name" value="{{$product['product_name'] ?? ''}}">
                                </div>
                            </div>
                           
                             <div class="row mb-3">
                                <label class="col-sm-2 col-form-label">Product MRP<span class="text-danger">*</span></label>
                                <div class="col-sm-10">
                                  <input type="text" value="{{$product['mrp_amount']}}" name="mrp_amount" id="mrp_amount" onkeyup="countDiscount(this.id)" class="form-control input" >
                                   <span class="text-danger err"></span>
                                </div>
                            </div>
                           
                            <div class="row mb-3">
                                <label class="col-sm-2 col-form-label">Selling Amount<span class="text-danger">*</span></label>
                                <div class="col-sm-10">
                                  <input type="text"  value="{{$product['selling_amount']}}" name="sell_amount" id="sell_amount"  class="form-control input" value="" onkeyup="countDiscount(this.id)">
                                   <span class="text-danger err"></span>
                                </div>
                            </div>

                            <div class="row mb-3">
                                <label class="col-sm-2 col-form-label">Discount Amount<span class="text-danger">*</span></label>
                                <div class="col-sm-10">
                                  <input type="text"  value="{{$product['discount_amount']}}" name="discount_amount" id="discount_amount"  class="form-control input" value="" readonly>
                                   <span class="text-danger err"></span>
                                </div>
                            </div>



@else
<div class="row mb-3">
                                <label class="col-sm-2 col-form-label">Category<span class="text-danger">*</span></label>
                                <div class="col-sm-10">
                                     <select required  name="category_id" id="category_id" class="form-control" onchange="fetchSubCategory(this.value)" >
                                <option value="">Select Category</option>
                                @foreach($categories as $ctg)
                                <option value="{{$ctg['_id']}}">{{$ctg['name']}}</option>
                                @endforeach
                            </select>
                            <span class="text-danger category_id"></span>
                                </div>
                            </div>
                            <div class="row mb-3">
                                <label class="col-sm-2 col-form-label">Sub Category<span class="text-danger">*</span></label>
                                <div class="col-sm-10">
                                    <select name="sub_category_id" id="sub_category_id" class="form-control">
                                <option value="">Select Sub Category</option>
                                    </select>
                                      <span class="text-danger sub_category_id"></span>
                                </div>
                            </div>
<div class="row mb-3">
                                <label class="col-sm-2 col-form-label">Product Image<span class="text-danger">*</span></label>
                                <div class="col-sm-1 product_img" id="product_img">
                                   <div class="text-center" valign="middle" style="border:1px solid #ccc; background:#efefef; width:100%; height: 100%; align-content: center; border-radius:5px;">Image</div>
                                </div>
                                <div class="col-sm-9">
                                    <input type="file" class="form-control" name = "image" id="image" onchange="loadFile(event, this, 'content')">
                                    <span class="text-danger image"></span>
                                </div>
                            </div>
                            <div class="row mb-3">
                                <label class="col-sm-2 col-form-label">Store Or Brand Name<span class="text-danger">*</span></label>
                                <div class="col-sm-10">
                                    <input type="text" class="form-control" name = "store_or_brand" id="store_or_brand" placeholder="Store Or Brand Name" >
                                    <span class="text-danger store_or_brand"></span>
                                </div>
                            </div>

                            <div class="row mb-3">
                                <label class="col-sm-2 col-form-label">Product Name<span class="text-danger">*</span></label>
                                <div class="col-sm-10">
                                    <input type="text" class="form-control" name = "product_name" id="product_name" placeholder="Product Name" >
                                    <span class="text-danger product_name"></span>
                                </div>
                            </div>

                            <div class="row mb-3">
                                <label class="col-sm-2 col-form-label">Product MRP<span class="text-danger">*</span></label>
                                <div class="col-sm-10">
                                  <input type="text" name="mrp_amount" id="mrp_amount" onkeyup="countDiscount(this.id)" class="form-control input" >
                                   <span class="text-danger mrp_amount"></span>
                                </div>
                            </div>
                           
                            <div class="row mb-3">
                                <label class="col-sm-2 col-form-label">Selling Amount<span class="text-danger">*</span></label>
                                <div class="col-sm-10">
                                  <input type="text" name="sell_amount" id="sell_amount"  class="form-control input" value="" onkeyup="countDiscount(this.id)">
                                   <span class="text-danger sell_amount"></span>
                                </div>
                            </div>

                            <div class="row mb-3">
                                <label class="col-sm-2 col-form-label">Discount Amount<span class="text-danger">*</span></label>
                                <div class="col-sm-10">
                                  <input type="text" name="discount_amount" id="discount_amount"  class="form-control input" value="" readonly>
                                   <span class="text-danger discount_amount"></span>
                                </div>
                            </div>

                            
@endif