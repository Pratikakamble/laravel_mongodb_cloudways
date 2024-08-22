<table id="myTable" class="display">
				<thead style="text-align: left;">
					<tr>
						<th width="10%">Sr. No.</th>
						<th width="30%">Category</th>
						<th width="30%">Action</th>
					</tr>
				</thead>
				<tbody>
					@foreach($categories as $key => $ctg)
						<tr>
							<td>{{$key+1}}</td>
							<td>{{$ctg['name']}}</td>
							<td>
								<button type="button" onclick="edtCtg('<?php echo $ctg["_id"]; ?>')" class="btn btn-success">Edit</button>
								<button type="button" onclick="dltCtg('<?php echo $ctg["_id"]; ?>')"class="btn btn-danger">Delete</button>
							</td>
						</tr>
					@endforeach	
				</tbody>
			</table>
