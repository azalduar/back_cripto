<div class="form-group bootstrap-timepicker timepicker {{$errors->has($input['name'])?'has-error':''}}">
	<label for="{{ $input['name'] }}">{{title_case(str_replace('_', ' ',$input['name']))}}</label>
	<div class="input-group">
		<div class="input-group-addon">
		    <i class="fa fa-clock-o"></i>
		</div>
		<input type="text" 
			   class="form-control pull-right input-sm timepicker"
			   id="time_picker_{{$input['name']}}"
			   name="{{$input['name']}}"
			   value="{{old($input['name'])}}">
	</div>
	@include('HTML.error', ['name' => $input['name'] ])
</div>	

@section('local-script')
	@parent
    <script>
	  	$( function() {
	  		$('#time_picker_{{$input['name']}}').timepicker({
              	showInputs: false
            })
	  	});
	</script>
@endsection