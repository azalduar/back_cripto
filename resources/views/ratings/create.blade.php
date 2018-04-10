@extends('adminlte::layouts.app')

@section('htmlheader_title')
    Ratings
@endsection

@section('contentheader_title')
    Ratings
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
        <form action="{{url('ratings')}}" method="POST" enctype="multipart/form-data">
            <input type="hidden" name="_method" value="POST">
            <input type="hidden" name="_token" value="{{ csrf_token() }}">

            <div class="col-md-12">@include('HTML.input_text', ['input' => ['name'=>'name']])</div>
                        
            
            <div class="col-md-12"><button type="submit" class="btn btn-primary">{{trans('message.create')}}</button></div>
        </form>
        {{ session()->forget('_old_input') }}
        
    </div>
@endsection

@section('local-css')
    <link href="{{ asset('/plugins/datepicker/datepicker3.css') }}" rel="stylesheet" type="text/css"/>
    <link href="{{ asset('/plugins/bootstrap-select/bootstrap-select.min.css') }}" rel="stylesheet" type="text/css">
    <style type="text/css">

        .container-admin-image {
            width: 100%;
            padding: 0px;
            display: flex;
            align-items: center;
            justify-content: center;
        }

        .admin-image-item{
            background-size: contain;
            background-position: 50% 50%;
            background-repeat: no-repeat;
            margin: 15px;
            border:solid 1px;
            width: 100%;
            box-sizing: border-box;
        }

        .sortable-admin-images .grid-image {
            width: 20%;
            padding: 0;
            float: left;
        }

        .new-grid-img{
            background-size: contain;
            background-position: 50% 50%;
            background-repeat: no-repeat;
            display: block;
            margin: 20px;            
            border:solid 1px;       
        }
    </style>
@endsection

@section('local-script')
    <script src="{{ asset('/plugins/ckeditor/ckeditor.js') }}"></script>
    <script src="{{ asset('/plugins/jquery-3.2.0.min.js') }}"></script>
    <script src="{{ asset('/plugins/jQueryUI/jquery-ui.min.js') }}"></script>   
    <script src="{{ asset('/plugins/jQueryUiTouchPunch/jquery.ui.touch-punch.min.js') }}"></script>
    <script src="{{ asset('/plugins/datepicker/bootstrap-datepicker.js') }}"></script>
    <script src="{{ asset('/plugins/datepicker/locales/bootstrap-datepicker.es.js') }}"></script>
    <script src="{{ asset('/plugins/bootstrap-select/bootstrap-select.min.js') }}"></script>
    <script type="text/javascript">
        $(function(){

            $(document).on('change', '.upload-admin-image', function(){
                    
                var input= $(this);
                var fileList = this.files;
                var container= input.parents('.admin-image').find('.container-admin-image');

                for(var i = 0; i < fileList.length; i++){

                    var reader = new FileReader();

                    reader.onload = (function (container) {
                        
                        return function(e) {
                            var valueImage= e.target.result;                            
                            container.find('.admin-image-item').last().css('background-image',"url('"+valueImage+"')");
                            container.find('.image-input').last().attr('value',valueImage);
                            $('.container-admin-image').css('height', $('.container-admin-image').width());
                            $('.admin-image-item').css('height', $('.admin-image-item').width());
                        };

                    })(container);
                    reader.readAsDataURL(fileList[i]);
                }
            })

            $(document).on('change', '.upload-admin-images', function(){
                
                var input= $(this);
                var fileList = this.files;
                var container= input.parents('.admin-images').find('.sortable-admin-images');
                var componente= input.parents('.admin-images');

                for(var i = 0; i < fileList.length; i++){

                    var reader = new FileReader();

                    reader.onload = (function (container) {
                        
                        return function(e) {

                            var valueImage= e.target.result;
                            var element= '<div class="grid-image"><input class="image-input" type="hidden" name="" value=""><div class="box-tools pull-right"><button type="button" class="btn btn-box-tool rm-grid-imagen"><i class="fa fa-times"></i></button></div><div class="new-grid-img"></div></div>';                            
                            container.append(element);
                            container.find('.new-grid-img').last().css('background-image',"url('"+valueImage+"')");
                            container.find('.image-input').last().attr('value',valueImage);
                            container.find('.image-input').last().attr('name',componente.data('input-name')+'[]');
                            $('.grid-image').css('height', $('.grid-image').width());
                            $('.new-grid-img').css('height', $('.new-grid-img').width());
                        };

                    })(container, componente);
                    reader.readAsDataURL(fileList[i]);

                }
                
                //$fileupload = $(this);
                //$fileupload.replaceWith($fileupload.clone(true));
            })


            $(document).on('click', '.rm-grid-imagen', function(){
                $(this).parents('.grid-image').remove();
            });

            $(".sortable-admin-images").sortable();
            $('.grid-image').css('height', $('.grid-image').width());
            $('.new-grid-img').css('height', $('.new-grid-img').width());
            $('.container-admin-image').css('height', $('.container-admin-image').width());
            $('.admin-image-item').css('height', $('.admin-image-item').width());

            $(".todo-list").sortable({
                placeholder: "sort-highlight",
                handle: ".handle",
                forcePlaceholderSize: true,
                zIndex: 999999
            });
        });
    </script>
@endsection
