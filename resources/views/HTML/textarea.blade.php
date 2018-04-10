<div class="form-group {{$errors->has($input['name'])?'has-error':''}}">
	<label for="{{ $input['name'] }}">{{title_case(str_replace('_', ' ',$input['name']))}}</label>
	<textarea class="form-control"
			  name="{{ $input['name'] }}"
			  id="text_editor_{{$input['name']}}"
			  placeholder="{{ title_case(str_replace('_', ' ',$input['name'])) }}"
			  rows="3" style="resize: vertical;">{{old($input['name'])}}</textarea>
	@include('HTML.error', ['name' => $input['name'] ])
</div>

