<div style="float: right;">
	<div id="actionToolsGroupWrapper" class="btn-group">
		<button type="button" data-conf="false" data-model="App\Models\Gift" data-actype="getForm" data-action="add" data-select="false"
		title="Add"
		class="btn btn-info">Add</button>
		<button type="button" data-conf="false" data-model="App\Models\Gift" data-actype="getForm" data-action="view" data-select="true"
		title="Open"
		class="btn btn-info">Open</button>
		<button type="button" data-conf="true" data-model="App\Models\Gift" data-actype="destroyData" data-action="delete" data-select="true"
		title="delete"
		class="btn btn-info">Delete</button>
	</div>
</div>
<div class="clearfix"></div>
<div id="fromRender"></div>
<hr>
<div id="componenTable" class="table-responsive">
	<table id="table-data" class="table table-striped table-bordered no-footer" width="100%">
		@include('componen.table_index', ['table' => $getViewData['index']['table']])
	</table>
	<div id="table-data-info"></div>
</div>