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
		<select name="policytype_id" id="policytype-dropdown" class="form-control" required>
			@foreach(\App\Models\PolicyType::all() as $type)
				<option value="{{ $type->id }}" <?php echo $type->id == $policy->policytype_id ? 'selected="selected"' : ''; ?>>{{ $type->name }}</option>
			@endforeach
		</select>
	</div>

	@foreach(\App\Models\PolicyType::all() as $type)
		
		<div class="form-group policyvalues-group" style="display: none;" id="policyvalues-{{ $type->id }}">
			<label>Value</label>
			<select name="policytype_{{ $type-> id }}_id" id="policytype-dropdown" class="form-control" required>
				@foreach($type->policyvalues as $value)
					<option value="{{ $value->id }}">{{ $value->variant }}</option>
				@endforeach
			</select>
		</div>

	@endforeach

    <button class="btn btn-default" data-dismiss="modal" type="button">Cancel</button>

    <input type="submit" value="Save" class="btn btn-primary pull-right">

</form>

<script type="text/javascript">

$(function() {

$('#policytype-dropdown').trigger('change');

});
$('#policytype-dropdown').change(function() {
	$('.policyvalues-group').hide();
	var id = $('#policytype-dropdown').val();
	$('#policyvalues-' + id).show();
});

</script>