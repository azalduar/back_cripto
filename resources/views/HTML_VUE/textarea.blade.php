<div class="form-group" :class="{'has-error': errors.has('{{ $name }}') }">
	<label for="{{ $name }}">{!!$label!!}</label>
	<textarea class="form-control"
			  v-model="{{$model}}"
			  name="{{ $name }}"
			  placeholder="{!! $label !!}"
			  v-validate="{{$validate}}"
			  rows="2" style="resize: vertical;">{{old($name)?:''}}</textarea>
	<span class="help-block" v-if="errors.has('{{ $name }}')">{{ "{{errors.first('".$name."')".'}'.'}' }}</span>
	{{-- @include('HTML.error', ['name' => $name ]) --}}
</div>

