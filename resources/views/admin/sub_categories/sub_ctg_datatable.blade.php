<table id="myTable" class="display">
				<thead style="text-align: left;">
					<tr>
						<th width="10%">Sr. No.</th>
						<th width="30%">Category</th>
						<th width="30%">Sub Category</th>
						<th width="15%">Action</th>
					</tr>
				</thead>
				<tbody>
					@foreach($sub_categories as $key => $sub_ctg)
						<tr>
							<td>{{$key+1}}</td>
							<td>{{$sub_ctg->category['name'] ?? ""}}</td>
							<td>{{$sub_ctg['name']}}</td>
							<td>
								<button type="button" onclick="edtSubCtg('<?php echo $sub_ctg["_id"]; ?>')" class="btn btn-success">Edit</button>
								<button type="button" onclick="dltSubCtg('<?php echo $sub_ctg["_id"]; ?>')"class="btn btn-danger">Delete</button>
							</td>
						</tr>
					@endforeach	
				</tbody>
			</table>
