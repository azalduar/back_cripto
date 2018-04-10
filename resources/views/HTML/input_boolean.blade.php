<div class="form-group {{$errors->has($input['name'])?'has-error':''}}">
    <label for="{{ $input['name'] }}">{{title_case(str_replace('_', ' ',$input['name']))}}</label>

    <div class="radio">
	  	<label>
	    	<input type="radio" name="{{ $input['name'] }}" value="1" {{old($input['name'])==1?'checked':''}}>
	    	Si
	  	</label>
	</div>
	<div class="radio">
	  	<label>
	    	<input type="radio" name="{{ $input['name'] }}" value="0" {{old($input['name'])==0?'checked':''}}>
	   		No
	  	</label>
	</div>
	@include('HTML.error', ['name' => $input['name'] ])
</div>