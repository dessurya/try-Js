<!DOCTYPE html>
<html>
<head>
	<meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
	<meta charset="utf-8">
	<meta http-equiv="X-UA-Compatible" content="IE=edge">
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<meta name="csrf-token" content="{{ csrf_token() }}">
	<title>Application Area</title>
	<link href="{{ asset('vendor/bootstrap/dist/css/bootstrap.min.css') }}" rel="stylesheet">
	<link rel="stylesheet" href="{{ asset('vendor/pnotify/pnotify.custom.min.css') }}">
	<link href="{{ asset('asset/styleCss.css') }}" rel="stylesheet">
	<style type="text/css">
		ul#navigation a{
			cursor: pointer;
		}
	</style>
</head>
<body style="background-color: rgb(160,160,160);">
	<div style="position: relative; width: 95%; margin: 30px auto; padding: 20px; background-color: white;">
		<center><h3>Application Area</h3></center>
		<hr>
		<ul id="navigation" class="nav nav-tabs"></ul>
		<div id="renderContent" style="padding: 10px;"></div>
	</div>

	<div id="loading-page">
		<div class="dis-table">
			<div class="row">
				<div class="cel">
					<img src="{{ asset('vendor/loading_1.gif') }}">
				</div>
			</div>
		</div>
	</div>
	
	<script type="text/javascript" src="{{ asset('vendor/jquery/dist/jquery.min.js') }}"></script>
	<script type="text/javascript" src="{{ asset('vendor/pnotify/pnotify.custom.min.js') }}"></script>
	<script type="text/javascript">
		var urlAction = "{{ route('action.exe') }}";
		var urlLogout = "{{ route('logout.excute') }}";
		$( document ).ready(function() {
			$('#loading-page').hide();
			postData({ 'actionType' : 'getMenu' },urlAction);
		});

		$(document).on('click', 'ul#navigation li.getContentExe', function(){
			$('ul#navigation li.getContentExe').removeClass('active');
			$('ul#navigation li.getContentExe a').removeClass('active');
			$(this).addClass('active');
			$(this).children('a').addClass('active');
			getContentFM();
		});


		function postData(data,url) {
			$.ajaxSetup({ headers: { 'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content') } });
			$.ajax({
				url: url,
				type: 'post',
				dataType: 'json',
				data: data,
				beforeSend: function() {
					$('#loading-page').show();
				},
				success: function(data) {
					$.when(responsePostData(data)).done(function(){
						return true;
					});
					
					$('#loading-page').hide();
				}
			});
		}

		function responsePostData(data) {
			if (data.respnType == 'info') {
				var pndata = { 'title' : 'Info', 'text' : data.msg, 'type' : 'Warning' };
				pnotify(pndata);
			}else if (data.respnType == 'render') {
				var render = atob(data.renderContent);
				if (data.renderType == 'replace') {
					$(data.renderTarget).html(render);
				}
			}

			if (data.respnReload == true) { window.setTimeout(function() { location.reload(); }, 1550); }
			if (data.signoutExe == true) { postData(null,urlLogout); }
			if (data.getContentFM == true) { getContentFM(); }
			if (data.getIndexTable == true) { getIndexTable({ 'model' : data.getIndexModel }); }
			return true;
		}

		function getIndexTable(config) {
			postData({ 'actionType' : 'getIndexTable', 'config' : config },urlAction);
		}

		function getContentFM() {
			var dataAct = $('ul#navigation a.active').data('action');
			postData({ 'actionType' : 'getContent', 'actionContent' : dataAct },urlAction);
		}

		function pnotify(data) {
			new PNotify({
				title: data.title,
				text: data.text,
				type: data.type,
				delay: 3000
			});
		}

		function pnotifyConfirm(data) {
			new PNotify({
				after_open: function(ui){
					$(".true", ui.container).focus();
					$('#loading-page').show();
				},
				after_close: function(){
					$('#loading-page').hide();
				},
				title: data.title,
				text: data.text,
				type: data.type,
				delay: 3000,
				confirm: {
					confirm: true,
					buttons:[
					{ text: 'Yes', addClass: 'true btn-primary', removeClass: 'btn-default'},
					{ text: 'No', addClass: 'false'}
					]
				}
			}).get().on('pnotify.confirm', function(){
				postData(data,urlAction);
			});
		}
	</script>
</body>
</html>