<!DOCTYPE html>
<html>
<head>
	<meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
	<meta charset="utf-8">
	<meta http-equiv="X-UA-Compatible" content="IE=edge">
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<title>Login Area</title>
	<link href="{{ asset('vendor/bootstrap/dist/css/bootstrap.min.css') }}" rel="stylesheet">
	<link href="{{ asset('asset/styleCss.css') }}" rel="stylesheet">
</head>
<body style="background-color: rgb(160,160,160);">
	<div style="position: relative; width: 60%; margin: 60px auto; padding: 20px; background-color: white;">
		<center><h3>Login Area</h3></center>
		<hr>
		<form method="post" action="{{ route('login.excute') }}">
			@if(!empty(Session::get('session')))
				<div class="alert alert-warning alert-dismissible fade show in" role="alert">
					<strong>Info!</strong> {{ Session::get('session')['msg'] }}
				</div>
			@endif
			{{ csrf_field() }}
			<div class="col-md-6">
				<div class="form-group">
					<label for="exampleInputEmail">Email</label>
					<input required name="email" type="email" class="form-control" id="exampleInputEmail">
				</div>
			</div>
			<div class="col-md-6">
				<div class="form-group">
					<label for="exampleInputPassword">Password</label>
					<input required name="password" type="password" class="form-control" id="exampleInputPassword">
				</div>
			</div>
			<div class="col-md-6">
				<button type="submit" class="btn btn-success">Sign In</button>
			</div>
			<div class="clearfix"></div>
		</form>
	</div>
</body>
</html>