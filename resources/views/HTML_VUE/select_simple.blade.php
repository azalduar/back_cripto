<div class="form-group" :class="{'has-error': errors.has('{{ $name }}') }">
	<label for="{{ $name }}">{!!$label!!}</label>

	{!! Form::select($name,[''=>trans('message.select_one')]+$options,null,['class'=> 'form-control input-sm', 'v-model'=>$model, 'v-validate'=>$validate]) !!}
	<span class="help-block" v-if="errors.has('{{ $name }}')">{{ "{{errors.first('".$name."')".'}'.'}' }}</span>
</div>	