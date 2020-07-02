<form id="PostRequest" method="post" action="{{ route('login.excute') }}">
	<div class="col-md-6">
		<div class="form-group">
			<label for="exampleInputEmail">Email</label>
			<input required value="{{ $getViewData['email'] }}" name="email" type="email" class="form-control" id="exampleInputEmail">
		</div>
	</div>
	<div class="col-md-6">
		<div class="form-group">
			<label for="exampleInputPassword">Name</label>
			<input required value="{{ $getViewData['name'] }}" name="name" type="text" class="form-control" id="exampleInputPassword">
		</div>
	</div>
	<div class="col-md-6">
		<button type="submit" class="btn btn-success">Sign In</button>
	</div>
	<div class="clearfix"></div>
</form>