<div class="form-group {{$errors->has($input['name'])?'has-error':''}}">
	<label for="{{ $input['name'] }}">{{title_case(str_replace('_', ' ',$input['name']))}}</label>
	<div class="input-group date">
		<div class="input-group-addon">
		    <i class="fa fa-calendar"></i>
		</div>
		<input type="text" 
			   class="form-control pull-right input-sm" 
			   id="date_picker_{{$input['name']}}"
			   readonly=""
			   name="{{$input['name']}}"
			   value="{{old($input['name'])}}">
	</div>
	@include('HTML.error', ['name' => $input['name'] ])
</div>	

@section('local-script')
	@parent
    <script>
	  	$( function() {
	  		$('#date_picker_{{$input['name']}}').datepicker({
                autoclose: true,
                format: 'yyyy-mm-dd',
                language:'es'
            });
	  	});
	</script>
@endsection