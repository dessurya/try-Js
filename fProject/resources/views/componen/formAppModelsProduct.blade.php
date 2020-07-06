<div class="x_panel">
	<form id="PostRequest">
		<div class="x_title">
			<h3 align="center">Form {{ !empty($toView) ? 'Show & Update' : 'Add'  }}</h3>
			<div class="clearfix"></div>
		</div>
		<div class="x_content">
			<div class="row">
				<input type="hidden" name="actionType" value="storeDataAMP">
				<input type="hidden" name="model" value="App\Models\Product">
				<input type="hidden" name="id" value="{{ !empty($toView) ? $toView['id'] : ''  }}">
				<div class="col-sm-6">
					<div class="form-group">
						Name
						<input 
							required
							name="name" 
							type="text" 
							value="{{ !empty($toView) ? $toView['name'] : '' }}" 
							class="form-control">
					</div>
				</div>
				<div class="col-sm-6">
					<div class="form-group">
						Price
						<input 
							required
							name="price" 
							type="number" 
							value="{{ !empty($toView) ? $toView['price'] : '' }}" 
							class="form-control">
					</div>
				</div>
				<div class="col-sm-12">
					<div class="form-group">
						Description
						<textarea
							required
							name="description"
							class="form-control">{{ !empty($toView) ? $toView['description'] : '' }}</textarea> 
					</div>
				</div>
			</div>
			<div style="float: right;">
				<button class="btn btn-success" type="submit">Save</button>
			</div>
			<div class="clearfix"></div>
		</div>
	</form>
</div>