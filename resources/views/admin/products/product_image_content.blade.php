@if(isset($product_images))
				<div class="row mb-3">
	                <label class="col-sm-2 col-form-label">Multiple Images<span class="text-danger">*</span></label>
	                <div class="col-sm-10">
	                    <input type="file" name="product_images[]" multiple id="image-1"  class="form-control" onchange="loadMultiple(event, this.id)">
	                </div>
                </div>
				<div class="row" id="image_preview" >
					<div class="row">
					@foreach($product_images as $img)
						<div class='col-2'><img src="{{asset($img['image'])}}" class="img-fluid"></div>
					@endforeach
				    </div>
				</div>
@else
			<div class="row mb-3">
                <label class="col-sm-2 col-form-label">Multiple Images<span class="text-danger">*</span></label>
                <div class="col-sm-10">
                    <input type="file" name="product_images[]" multiple id="image-1"  class="form-control" onchange="loadMultiple(event, this.id)">
                    <span class="text-danger product_images"></span>
                </div>
            </div>
				<div class="row" id="image_preview" ></div>
@endif