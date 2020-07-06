@foreach($toView as $row)
<tr id="{{ $row['id'] }}">
	<td>{{ $row['created_at'] }}</td>
	<td>{{ $row['customer'] }}</td>
	<td>{{ $row['amount'] }}</td>
</tr>
@endforeach