<div class="modal" tabindex="-1" role="dialog">
  <div class="modal-dialog modal-lg" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title">Transaction Modal</h5>
      </div>
      <div class="modal-body" style="max-height: 480px; overflow-y: auto;">
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-default">Close</button>
        <button type="button" class="btn btn-primary">Get This Selected Row</button>
      </div>
    </div>
  </div>
</div>

<div style="float: right;">
	<div id="actionToolsGroupWrapper" class="btn-group">
		<button type="button" data-conf="false" data-model="App\Models\Transaction" data-actype="getForm" data-action="add" data-select="false"
		title="Add"
		class="btn btn-info">Add</button>
		<button type="button" data-conf="false" data-model="App\Models\Transaction" data-actype="getForm" data-action="view" data-select="true"
		title="Open"
		class="btn btn-info">Open</button>
		<button type="button" data-conf="true" data-model="App\Models\Transaction" data-actype="destroyData" data-action="delete" data-select="true"
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