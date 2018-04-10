<div class="form-group {{$errors->has($input['name'])?'has-error':''}}">
    <label for="{{ $input['name'] }}">{{title_case(str_replace('_', ' ',$input['name']))}}</label>
    <input class="form-control input-sm"
    	   id="input_text_{{ $input['name'] }}"
    	   name="{{ $input['name'] }}"
    	   type="text"
    	   placeholder="{{ title_case(str_replace('_', ' ',$input['name'])) }}"
    	   value="{{old($input['name'])}}" 
    	   autocomplete="off">
    @include('HTML.error', ['name' => $input['name'] ])
</div>