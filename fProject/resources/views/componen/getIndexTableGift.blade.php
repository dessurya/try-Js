@foreach($toView as $row)
<tr id="{{ $row['id'] }}">
	<td>{{ $row['name'] }}</td>
	<td>{{ $row['point'] }}</td>
	<td>{{ $row['description'] }}</td>
</tr>
@endforeach