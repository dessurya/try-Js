<div class="x_panel">
	<form id="PostRequestTransaction">
		<div class="x_title">
			<h3 align="center">Form {{ !empty($toView) ? 'Show & Update' : 'Add'  }}</h3>
			<div class="clearfix"></div>
		</div>
		<div class="x_content">
			<div class="row">
				<input type="hidden" name="actionType" value="storeDataAMT">
				<input type="hidden" name="model" value="App\Models\Transaction">
				<input type="hidden" name="id" value="{{ !empty($toView) ? $toView['id'] : ''  }}">
				<div class="col-sm-6">
					<div class="form-group">
						Created At
						<input 
							readonly 
							name="created_at" 
							type="text" 
							value="{{ !empty($toView) ? $toView['created_at'] : '' }}" 
							class="form-control">
					</div>
				</div>
				<div class="col-sm-6">
					<div class="form-group">
						Amount
						<input 
							readonly 
							name="amount" 
							type="text" 
							value="{{ !empty($toView) ? $toView['amount'] : '' }}" 
							class="form-control">
					</div>
				</div>
				<div class="col-sm-6">
					<div class="form-group">
						Customer
						<input 
							required
							name="customer" 
							type="text" 
							value="{{ !empty($toView) ? $toView['customer'] : '' }}" 
							data-model="App\Models\Customer"
							data-actctn="Master_User"
							data-parent=""
							data-target="input[name=customer]-name|input[name=customer_id]-id"
							class="form-control indexOfSearch">
						<input 
							name="customer_id" 
							type="hidden" 
							value="{{ !empty($toView) ? $toView['customer_id'] : '' }}" 
							class="form-control">
					</div>
				</div>
			</div>
			<div id="detilTrans" class="x_panel">
				<div class="x_content">
					<div style="float: right;">
						<span id="AddDetislTransaction" class="btn btn-info">Add Detils</span>
					</div>
					<div class="clearfix"></div>
					<hr>
					@if(!empty($toView))
					@foreach($toView['detil'] as $row)
					@include('componen.formAppModelsTransactionDetil', ['row' => $row])
					@endforeach
					@endif
				</div>
			</div>
			<div style="float: right;">
				<button class="btn btn-success" type="submit">Save</button>
			</div>
			<div class="clearfix"></div>
		</div>
	</form>
</div>