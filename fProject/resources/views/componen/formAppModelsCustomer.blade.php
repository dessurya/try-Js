<div class="x_panel">
	<form id="PostRequest">
		<div class="x_title">
			<h3 align="center">Form {{ !empty($toView) ? 'Show & Update' : 'Add'  }}</h3>
			<div class="clearfix"></div>
		</div>
		<div class="x_content">
			<div class="row">
				<input type="hidden" name="actionType" value="storeDataAMC">
				<input type="hidden" name="model" value="App\Models\Customer">
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
						Email
						<input 
							required
							name="email" 
							type="email" 
							value="{{ !empty($toView) ? $toView['email'] : '' }}" 
							class="form-control">
					</div>
				</div>
				<div class="col-sm-6">
					<div class="form-group">
						Address
						<input 
							required
							name="address" 
							type="text" 
							value="{{ !empty($toView) ? $toView['address'] : '' }}" 
							class="form-control">
					</div>
				</div>
				<div class="col-sm-6">
					<div class="form-group">
						Phone
						<input 
							required
							name="phone" 
							type="text" 
							value="{{ !empty($toView) ? $toView['phone'] : '' }}" 
							class="form-control">
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