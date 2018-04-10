@extends('adminlte::layouts.app')

@section('htmlheader_title')
    Users
@endsection

@section('contentheader_title')
    Users
@endsection

@section('contentheader_description')
    @lang('message.create')
@endsection

@section('main-content')
    
    <div class="row">
        <div class="col-md-12">

            @if(session('alert'))
                <div class="alert alert-{{session('alert')['status']}} alert-dismissible">
                    <button type="button" class="close" data-dismiss="alert" aria-hidden="true">×</button>
                    {{session('alert')['message']}}
                </div>
            @endif
        </div>
        <form action="{{url('admin_users')}}" method="POST" enctype="multipart/form-data">
            <input type="hidden" name="_method" value="POST">
            <input type="hidden" name="_token" value="{{ csrf_token() }}">

            <div class="col-md-12">@include('HTML.input_text', ['input' => ['name'=>'name']])</div>
            <div class="col-md-12">@include('HTML.input_text', ['input' => ['name'=>'email']])</div>
            {{-- <div class="col-md-12">@include('HTML.textarea', ['input' => ['name'=>'permisos']])</div> --}}
            
            <div class="col-md-6">
                <div class="form-group {{$errors->has('permisos')?'has-error':''}}">
                    <label for="permisos">Permisos</label>
                    <div class="table-responsive">
                        <table class="table table-condensed">
                            <thead>
                                <th>Seccion</th>
                                <th width="15%">Ver</th>
                                <th width="15%">Crear</th>
                                <th width="15%">Editar</th>
                                <th width="15%">Eliminar</th>
                            </thead>
                            <tbody>

                                @foreach(App\Section::orderBy('display_name', 'asc')->get() as $section)
                                <tr>
                                    <td>{{$section->display_name}}</td>
                                    <td><input type="checkbox" name="permisos[]" value="{{$section->route}}_read" {{old('permisos')?(in_array($section->route.'_read',old('permisos'))?'checked':''):''}}></td>
                                    <td><input type="checkbox" name="permisos[]" value="{{$section->route}}_create" {{old('permisos')?(in_array($section->route.'_create',old('permisos'))?'checked':''):''}}></td>
                                    <td><input type="checkbox" name="permisos[]" value="{{$section->route}}_update" {{old('permisos')?(in_array($section->route.'_update',old('permisos'))?'checked':''):''}}></td>
                                    <td><input type="checkbox" name="permisos[]" value="{{$section->route}}_delete" {{old('permisos')?(in_array($section->route.'_delete',old('permisos'))?'checked':''):''}}></td>
                                </tr>
                                @endforeach                                    
                            </tbody>
                        </table>
                    </div>

                    @include('HTML.error', ['name' => 'permisos' ])
                </div>
            </div>                                       
                                  
            
            <div class="col-md-12"><button type="submit" class="btn btn-primary">{{trans('message.create')}}</button></div>
        </form>
        {{ session()->forget('_old_input') }}
        
    </div>
@endsection

@section('local-css')
@endsection

@section('local-script')
@endsection
