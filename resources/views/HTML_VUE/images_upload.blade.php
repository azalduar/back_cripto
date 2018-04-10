<div class="box box-primary admin-images" data-input-name="{{$input['name']}}">
	<div class="box-header with-border">
		<h3 class="box-title">{{title_case(str_replace('_', ' ',$input['name']))}}</h3>
		<div class="box-tools pull-right">
			<button type="button" class="btn btn-box-tool" data-widget="collapse">
				<i class="fa fa-minus"></i>
			</button>
		</div>
	</div>
	<div class="box-body">
		<input class="hidden-tipo" type="hidden" name="" value="slide">
		<div class="row">
			<div class="col-md-12">
				<label class="btn btn-primary pull-right">
					<span>Upload<input type="file" class="hidden upload-admin-images" multiple="true"></span>
				</label>
			</div>
		</div>

		<div class="sortable-admin-images">
		@if(old($input['name']))
			@foreach(old($input['name']) as $imagen)
			<div class="grid-image">
				<input class="image-input" type="hidden" name="{{$input['name'].'[]'}}" value="{{$imagen}}">
				<div class="box-tools pull-right">
					<button type="button" class="btn btn-box-tool rm-grid-imagen">
						<i class="fa fa-times"></i>
					</button>
				</div>
				<div class="new-grid-img" style="background-image: url('{{starts_with($imagen, 'http')?$imagen.'/150/150':$imagen}}'); "></div>
			</div>
			@endforeach
		@endif
		</div>

		<div>
			<div class="col-xs-12 form-group {{$errors->has($input['name'])?'has-error':''}}">
	            @include('HTML.error', ['name' => $input['name'] ])
	        </div>	
		</div>
		
	</div>
</div>