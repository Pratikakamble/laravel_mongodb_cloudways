<table id="myTable" class="display">
				<thead style="text-align: left;">
					<tr>
						<th width="10%">Sr. No.</th>
						<th width="30%">Category</th>
						<th width="30%">Sub Category</th>
						<th width="15%">Attribute</th>
						<th width="15%">Action</th>
					</tr>
				</thead>
				<tbody>
					@foreach($attributes as $key => $attr)
						<tr>
							<td>{{$key+1}}</td>
							<td>{{$attr['sub_category']['category']['name'] ?? ''}}</td>
							<td>{{$attr['sub_category']['name'] ?? ''}}</td>
							<td>
								{{$attr['name']}}
							</td>
							<td>
								<button type="button" onclick="edtAttribute('<?php echo $attr["_id"]; ?>')" class="btn btn-success">Edit</button>
								<button type="button" onclick="dltAttribute('<?php echo $attr["_id"]; ?>')"class="btn btn-danger">Delete</button>
							</td>
						</tr>
					@endforeach	
				</tbody>
			</table>
