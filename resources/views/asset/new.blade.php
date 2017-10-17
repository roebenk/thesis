<form action="{{ $method == 'post' ? url('asset') : url('asset/' . $asset->id) }}" method="post">

	@if($method == 'put')
		<input type="hidden" name="_method" value="put">
	@endif

 	{{ csrf_field() }}

 	<input type="hidden" name="assessment_id" value="{{ Request::get('assessment') }}" />

	<div class="form-group">
		<label>Name</label>
		<input type="text" class="form-control" name="name" value="{{ $asset->name }}" required />
	</div>

	<div class="form-group">
		<label>Type</label>
		<select name="assettype_id" class="form-control" required>
			@foreach(\App\Models\AssetType::all() as $type)
				<option value="{{ $type->id }}" <?php echo $type->id == $asset->assettype_id ? 'selected="selected"' : ''; ?>>{{ $type->name }}</option>
			@endforeach
		</select>
	</div>

	<div class="form-group">
		<label>Value of asset</label>
		<select name="value" class="form-control" required>
			@for($i = 1; $i <= 5; $i++)
				<option value="{{ $i }}" <?php echo $i == ($asset->value * 5) ? 'selected="selected"' : ''; ?>>{{ $i }}</option>
			@endfor
		</select>
	</div>

    
    <button class="btn btn-default" data-dismiss="modal" type="button">Cancel</button>

    <input type="submit" value="Save" class="btn btn-primary pull-right">

</form>