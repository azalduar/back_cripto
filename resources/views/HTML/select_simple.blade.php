<div class="form-group {{$errors->has($input['name'])?'has-error':''}}">
	<label for="{{ $input['name'] }}">{{title_case(str_replace('_', ' ',$input['name']))}}</label>

	{!! Form::select($input['name'],[''=>trans('message.select_one')]+$input['options'],old($input['name']),['class'=> 'form-control input-sm']) !!}
	@include('HTML.error', ['name' => $input['name'] ])
</div>	