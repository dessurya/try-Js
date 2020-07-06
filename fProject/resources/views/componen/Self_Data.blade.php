<form id="PostRequest" method="post">
	<input type="hidden" name="actionType" value="selfStoreData">
	<div class="col-md-6">
		<div class="form-group">
			<label>Email</label>
			<input required value="{{ $getViewData['email'] }}" name="email" type="email" class="form-control">
		</div>
	</div>
	<div class="col-md-6">
		<div class="form-group">
			<label>Name</label>
			<input required value="{{ $getViewData['name'] }}" name="name" type="text" class="form-control">
		</div>
	</div>
	<div class="col-md-6">
		<div class="form-group">
			<label>Old Password</label>
			<input required name="old_password" type="password" class="form-control">
		</div>
	</div>
	<div class="col-md-6">
		<div class="form-group">
			<label>New Password</label>
			<input name="new_password" type="password" class="form-control">
		</div>
	</div>
	<div class="col-md-6">
		<div class="form-group">
			<label>Confirm Password</label>
			<input name="confirm_password" type="password" class="form-control">
		</div>
	</div>
	<div class="col-md-6">
		<button type="submit" class="btn btn-success">Save</button>
	</div>
	<div class="clearfix"></div>
</form>