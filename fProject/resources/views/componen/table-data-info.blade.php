<div style="float: left; width: 50%;">
	<div class="col-md-12">
		<div class="form-group">
			<label>Page : </label>
			<select name="page" class="form-controller">
				@foreach($toView['page'] as $row)
				<option value="{{ $row }}" {{ $toView['curentPage'] == $row ? 'selected' : '' }}>{{$row}}</option>
				@endforeach
			</select>
		</div>
	</div>
</div>
<div style="float: right; width: 50%; text-align: right;">
	<div class="col-md-12">
		<div class="form-group">
			<label>Record : {{ $toView['startRecord'].' to '.$toView['endRecord'].' from '.$toView['allRecord'] }}</label>
		</div>
	</div>
</div>