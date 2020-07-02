<thead>
	<tr role="row">
		@foreach($table as $row)
		<th class="@if($row['order'] == true) orderTrue @endif" data-order="{{ $row['name'] }}">
			{{ Str::title($row['field']) }}
		</th>
		@endforeach
	</tr>
</thead>
<tfoot>
	<tr role="row">
		@foreach($table as $row)
		<th>
			@if($row['search'] == true)
			<input type="text" name="{{ $row['name'] }}" placeholder="Search {{ $row['field'] }}" class="form-control">
			@endif
		</th>
		@endforeach
	</tr>
</tfoot>
<tbody></tbody>