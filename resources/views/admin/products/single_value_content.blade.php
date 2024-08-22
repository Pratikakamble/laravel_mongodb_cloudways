@if(isset($value_attribute))
<div class="row mb-3 append_single_val">

    @foreach($value_attribute as $key => $val)
    @if(!array_key_exists('has_multivalue', $val))
        @php
        $key = $key+1;
        @endphp
        <div class="row" id="row-{{$key}}">
                                    <div class="col-sm-1 text-center" style="align-content: center;">
                                        <span class="cnt">{{$key}}.</span>
                                        <input type="hidden"  class="hidden_attribute" name="value_attribute[{{$key}}][attribute_id]" value="{{$val['_id']}}">
                                    </div>
                                    <div class="col-sm-2">
                                        <label>Attribute<span class="text-danger">*</span></label>
                                        <select name="value_attribute[{{$key}}][attr]" class="form-control select_attr" >
                                            <option value="">Select Attribute</option>
                                            @foreach($attributes as $attr)
                                            <option value="{{$attr['_id']}}"

                                            @if($val['attribute_id'] == $attr['_id'])
                                                selected
                                            @endif
                                            >{{$attr['name']}}</option>
                                            @endforeach
                                        </select>
                                        <span class="err text-danger"></span>
                                    </div>
                                    <div class="col-sm-2">
                                        <label>Value<span class="text-danger">*</span></label>
                                        <input type="text" name="value_attribute[{{$key}}][val]" class="form-control input_val" value="{{$val['value']}}" >
                                        <span class="err text-danger"></span>
                                    </div>
                                   
                                    <div class="col-sm-2  product_img pro_atr_img" id="pro_atr_img-{{$key}}">
                                        @if(isset($val["image"]))
                                          <img src='{{asset($val["image"])}}' width='50%'>
                                        @else
                                        <div class="text-center" valign="middle" style="border:1px solid #ccc; background:#efefef; width:100%; height: 100%; align-content: center; border-radius:5px;">Image</div>
                                        @endif
                                    </div>
                                
                                    <div class="col-sm-2">
                                        <label>Image</label>
                                        <input type="file" name="value_attribute[{{$key}}][image]" class="form-control input_image" id="input_image-{{$key}}" onchange="loadFile(event, this, 'pro_atr')">
                                    </div>
                                    <div class="col-sm-2" style="align-content: center;">
                                        @if($key == 1)
                                        <button type="button" class="btn btn-success" id="add_single_attr">+</button>
                                        @else
                                        <button type="button" class="btn btn-danger" onclick="rmvSingleVal(this)">-</button>
                                        @endif
                                    </div>
        </div>
    @endif
    @endforeach
</div>

@else
<div class="row mb-3 append_single_val">
    <div class="row" id="row-1">
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
                                    <button type="button" class="btn btn-success" id="add_single_attr">+</button>
                                </div>
                        </div>
                    </div>
@endif