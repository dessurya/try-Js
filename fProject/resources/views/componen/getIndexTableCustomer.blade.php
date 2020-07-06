@foreach($toView as $row)
<tr id="{{ $row['id'] }}">
	<td>{{ $row['name'] }}</td>
	<td>{{ $row['email'] }}</td>
	<td>{{ $row['address'] }}</td>
	<td>{{ $row['phone'] }}</td>
	<td>{{ $row['point'] }}</td>
</tr>
@endforeach