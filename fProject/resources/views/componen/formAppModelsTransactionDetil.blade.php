<div id="{{ !empty($row) ? $row['id'].'row' : $rand.'row' }}" class="row">
	<div class="col-sm-6">
		<div class="form-group">
			Product
			<input 
			name="product_id" 
			type="hidden" 
			value="{{ !empty($row) ? $row['product_id'] : '' }}">
			<input 
			required 
			name="product" 
			type="text" 
			value="{{ !empty($row) ? $row['product'] : '' }}" 
			data-model="App\Models\Product"
			data-actctn="Master_Product"
			data-parent="{{ !empty($row) ? '#'.$row['id'].'row' : '#'.$rand.'row' }}"
			data-target="input[name=product_id]-id|input[name=product]-name|input[name=price]-price"
			class="form-control indexOfSearch">
		</div>
	</div>
	<div class="col-sm-4">
		<div class="form-group">
			Price
			<input 
			readonly 
			name="price" 
			type="text" 
			value="{{ !empty($row) ? $row['price'] : '' }}" 
			class="form-control">
		</div>
	</div>
	<div class="col-sm-2">
		<div class="form-group">
			<span id="RemoveDetislTransaction" data-row="{{ !empty($row) ? '#'.$row['id'].'row' : '#'.$rand.'row' }}" class="btn btn-info">Remove</span>
		</div>
	</div>
</div>