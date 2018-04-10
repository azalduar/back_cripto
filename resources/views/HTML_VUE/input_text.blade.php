<div class="form-group" :class="{'has-error': errors.has('{{ $name }}') }">
    @if($label)
        <label for="{{ $name }}">{{$label}}</label>
    @endif
    <input class="form-control input-sm"
           v-model="{{$model}}"
    	   name="{{ $name }}"
    	   type="text"
    	   v-validate="{{ $validate }}"
    	   placeholder="{{ $label }}"
    	   autocomplete="off">
   	<span class="help-block" v-if="errors.has('{{ $name }}')">{{ "{{errors.first('".$name."')".'}'.'}' }}</span>
</div>