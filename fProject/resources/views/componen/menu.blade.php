@foreach($arr as $row)
<li class="nav-item getContentExe @if($row['active'] == true) active @endif">
	<a class="nav-link @if($row['active'] == true) active @endif" data-action="{{ $row['action'] }}">{{ $row['name'] }}</a>
</li>
@endforeach
<li class="nav-item">
	<a class="nav-link" data-action="SignOut">Sign Out</a>
</li>