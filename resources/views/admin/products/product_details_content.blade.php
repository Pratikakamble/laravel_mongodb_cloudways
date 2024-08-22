@if(isset($product_details))
 <div class="row mb-3 append_input">
    @foreach($product_details as $key => $dtl)
        @php
        $key = $key+1;
        @endphp
        <div class="row" id="row-{{$key}}">
                                <div class="col-sm-1 text-center" style="align-content: center;">
                                    <span class="dtl_attr_cnt">{{$key}}.</span>
                                    <input type="hidden"  class="hidden_details" name="product_details[{{$key}}][details_id]" value="{{$dtl['_id']}}">
                                </div>
                                <div class="col-sm-5">
                                    <label>Attribute<span class="text-danger">*</span></label>
                                    <input type="text" name="product_details[{{$key}}][attr]"  class="form-control select_attribute" value="{{$dtl['attribute']}}">
                                    <span class="text-danger err"></span>
                                </div>
                                <div class="col-sm-5">
                                    <label>Value<span class="text-danger">*</span></label>
                                    <input type="text" name="product_details[{{$key}}][val]" class="form-control input_value" value="{{$dtl['value']}}">
                                    <span class="text-danger err"></span>
                                </div>
                                <div class="col-sm-1" style="align-content: center;">
                                    @if($key == 1)
                                    <button type="button" class="btn btn-success" id="add_attr">+</button>
                                    @else
                                    <button type="button" class="btn btn-danger" id="add_attr" onclick="rmvDetailAttr(this)">-</button>
                                    @endif
                                </div>
                            </div>
                        
    @endforeach
</div>
@else

<div class="row mb-3 append_input">
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
                                    <button type="button" class="btn btn-success" id="add_attr">+</button>
                                </div>
                            </div>
                        </div>
@endif