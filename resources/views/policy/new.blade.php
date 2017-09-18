<form action="{{ $method == 'post' ? url('policy') : url('policy/' . $policy->id) }}" method="post">

	@if($method == 'put')
		<input type="hidden" name="_method" value="put">
	@endif

 	{{ csrf_field() }}

 	<input type="hidden" name="assessment_id" value="{{ Request::get('assessment') }}" />

	<div class="form-group">
		<label>Name</label>
		<input type="text" class="form-control" name="name" value="{{ $policy->name }}" required />
	</div>

	<div class="form-group">
		<label>Type</label>
		<select name="policytype_id" class="form-control" required>
			@foreach(\App\Models\PolicyType::all() as $type)
				<option value="{{ $type->id }}" <?php echo $type->id == $policy->policytype_id ? 'selected="selected"' : ''; ?>>{{ $type->name }}</option>
			@endforeach
		</select>
	</div>
    
    <button class="btn btn-default" data-dismiss="modal" type="button">Cancel</button>

    <input type="submit" value="Save" class="btn btn-primary pull-right">

</form>