@foreach($toView as $row)
<tr id="{{ $row['id'] }}">
	<td>{{ $row['name'] }}</td>
	<td>{{ $row['price'] }}</td>
	<td>{{ $row['description'] }}</td>
</tr>
@endforeach