<div class="form-group {{$errors->has($input['name'])?'has-error':''}}">
  	<div class="box box-primary">
		<div class="box-header">
		    <i class="ion ion-clipboard"></i>
		    <h3 class="box-title">{{title_case(str_replace('_', ' ',$input['name']))}}</h3>
		</div>
	    <div class="box-body">
		    <ul class="todo-list">
		    	@foreach($input['options']?:[] as $key => $value)
		        <li>
	              	<span class="handle">
		                <i class="fa fa-ellipsis-v"></i>
		                <i class="fa fa-ellipsis-v"></i>
	              	</span>
		         
		          	<input type="checkbox" name="{{$input['name'].'[]'}}" value="{{$key}}" {{old($input['name'])?(in_array($key, old($input['name']))?'checked':''):''}}>
		          
		          	<span class="text">{{strtoupper($value)}}</span>
		      	</li>
		      	@endforeach		      
		    </ul>
		    {{-- @include('HTML.error', ['name' => $input['name'] ]) --}}
	  	</div>
	</div>
</div>
