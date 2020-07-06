@foreach($toView as $row)
<tr id="{{ $row['id'] }}">
	<td>{{ $row['name'] }}</td>
	<td>{{ $row['email'] }}</td>
</tr>
@endforeach