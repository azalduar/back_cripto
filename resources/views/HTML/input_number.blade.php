<div class="form-group {{$errors->has($input['name'])?'has-error':''}}">
    <label for="{{ $input['name'] }}">{{$input['name']}}</label>
    <input class="form-control input-sm"
    	   id="input_number_{{ $input['name'] }}"
    	   name="{{ $input['name'] }}"
    	   type="number"
    	   placeholder="{{ $input['name'] }}"
    	   value="{{old($input['name'])}}"
    	   autocomplete="off">
   	@include('HTML.error', ['name' => $input['name'] ])
</div>