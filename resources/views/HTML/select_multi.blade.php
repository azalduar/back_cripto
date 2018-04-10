<div class="form-group {{$errors->has($input['name'])?'has-error':''}}">
    <label for="{{ $input['name'] }}">{{title_case(str_replace('_', ' ',$input['name']))}}</label>

    {!! Form::select($input['name'].'[]',$input['options'],old($input['name']),[
        'multiple' => true,
        //'class'=> 'form-control'
        'class'=> 'selectpicker form-control input-sm',
        'title'=>'Select '.$input['name'],
        'data-style'=>"btn-flat",
        'data-size'=>"10", 
        //'data-header'=>'Select '.$input['name'],
        //'data-actions-box'=>"true",
        'data-dropupAuto'=>"true"

    ]) !!}
    @include('HTML.error', ['name' => $input['name'] ])
</div>  