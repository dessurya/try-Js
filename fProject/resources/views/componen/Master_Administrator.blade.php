<div class="table-responsive">
	<table id="table-data" class="table table-striped table-bordered no-footer" width="100%">
		@include('componen.table_index', ['table' => $getViewData['index']['table']])
	</table>
	<div id="table-data-info"></div>
</div>
{{ json_encode($getViewData) }}