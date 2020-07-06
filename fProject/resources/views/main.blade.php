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
	<script type="text/javascript" src="{{ asset('vendor/bootstrap/dist/js/bootstrap.min.js') }}"></script>
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

		$(document).on('click', '#table-data tbody tr', function(){
			$(this).toggleClass('selected');
		});

		$(document).on('click', '#SignOut', function(){
			postData(null,urlLogout);
		});

		$(document).on('click', '#table-data thead th.orderTrue', function(){
			var order = $(this).data('order');
			var conf = sessionStorage.getItem('tabelConfig');
			conf = JSON.parse(conf);
			var sort = 'asc';
			if (conf.order !== undefined) {
				if (conf.order.key == order) {
					if (conf.order.value == 'asc') {
						sort = 'desc';
					}
				}
			}
			conf['order'] = {};
			conf['order']['key'] = order;
			conf['order']['value'] = sort;
			getIndexTable(conf);
			sessionStorage.setItem('tabelConfig', JSON.stringify(conf));
		});

		$(document).on('change', '#table-data-info select[name=page]', function(){
			var page = $(this).val();
			var conf = sessionStorage.getItem('tabelConfig');
			conf = JSON.parse(conf);
			conf['page'] = page;
			getIndexTable(conf);
			sessionStorage.setItem('tabelConfig', JSON.stringify(conf));
		});

		$(document).on('change', '#table-data tfoot input', function(){
			var json = {};
			$('#table-data tfoot input').each(function() {
				var field = $(this).attr('name');
				var searc = $(this).val();
				if (searc != null || searc != '' || searc.length != 0) {
					json[field] = searc;
				}
			});
			console.log(json);
			var conf = sessionStorage.getItem('tabelConfig');
			conf = JSON.parse(conf);
			conf['search'] = json;
			getIndexTable(conf);
			sessionStorage.setItem('tabelConfig', JSON.stringify(conf));
		});

		$(document).on('click', '.indexOfSearch', function(){
			$('.modal').modal('show');
			var data = {};
			postData(data,urlAction);
		});

		$(document).on('click', '.modal button.btn-default', function(){
			$('.modal').modal('hide');
		});

		$(document).on('click', '#actionToolsGroupWrapper button', function(){
			var data = {};
			data['model'] = $(this).data('model');
			data['action'] = $(this).data('action');
			data['actionType'] = $(this).data('actype');
			data['select'] = $(this).data('select');
			data['conf'] = $(this).data('conf');
			actionToolsExcute(data);
		});

		function actionToolsExcute(data) {
			var id = getDataId(data.select, false);
			if(id == false){ return false; }
			data['id'] = id;
			var val = {};
			if(data.conf == true){
				val['title'] = 'Warning';
				val['type'] = 'info';
				val['text'] = 'Are You Sure Do '+data.action+' On Selected Data?';
				val['input'] = {};
				val['input'] = data;
				pnotifyConfirm(val);
			}else if(data.conf == false){
				postData(data,urlAction);
			}
		}

		function getDataId(select){
			if(select == false){ return true; }
			var idData = "";
			$('table#table-data tbody tr.selected').each(function(){
				idData += $(this).attr('id')+'^';
			});
			var getLength = idData.length-1;
			idData = idData.substr(0, getLength);
			var pndata = {};
			if(idData === null || idData === '' || idData === undefined){
				pndata['title'] = 'Info';
				pndata['type'] = 'error';
				pndata['text'] = 'No Data Selected!';
				pnotify(pndata);
				return false;
			}else if( idData.indexOf('^') > -1){
				pndata['title'] = 'Info';
				pndata['type'] = 'error';
				pndata['text'] = 'You only can selected one data!';
				pnotify(pndata);
				return false;
			}
			return idData;
		}

		$(document).on('submit', 'form#PostRequest', function(){
			var data = $(this).serializeArray();
			postData(data,urlAction);
			return false;
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
					responsePostData(data);
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
			if (data.getIndexTable == true) { 
				var conf = { 'model' : data.getIndexModel, 'page' : 1 };
				getIndexTable(conf);
				sessionStorage.setItem('tabelConfig', JSON.stringify(conf));
			}
			if (data.indexTabInfo == true) {
				$(data.indexTabInfoTarget).html(atob(data.indexTabInfoRender));
			}
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
				postData(data.input,urlAction);
			});
		}
	</script>
</body>
</html>