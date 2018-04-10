@extends('adminlte::layouts.app')

@section('htmlheader_title')
    @lang('message.section')
@endsection

@section('contentheader_title')
    @lang('message.section')
@endsection

@section('contentheader_description')
    @lang('message.index')
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
            
            <div class="box box-primary">
                <div class="box-body">
                    <div class="table-responsive">
                        <table id="dataTable" class="table table-hover table-condensed">
                            <thead>
                                <tr>
                                    <th width="3%">ID</th>
                                    <th>NAME</th>
                                    <th width="5%">@lang('message.edit')</th>
                                    <th width="5%">@lang('message.delete')</th>
                                </tr>
                            </thead>
                            <tbody>
                            @foreach ($sections as $section)
                                <tr>
                                    <td>{{$section->id}}</td>
                                    <td>{{$section->name}}</td>
                                    <td>
                                        <a href="{{url('section/'.$section->id.'/edit')}}">
                                            <i class="fa fa-pencil-square-o"></i>
                                        </a>                                        
                                    </td>
                                    <td>
                                        <a href="#" data-toggle="modal" data-target="#deleteModal" data-section-id="{{$section->id}}">
                                            <i class="fa fa-trash"></i>
                                        </a>
                                    </td>
                                </tr>
                            @endforeach
                            </tbody>
                                                
                        </table>
                    </div>
                </div>      
            </div>
            <a class="btn btn-primary" href="{{url('/section/create')}}" role="button">@lang('message.create')</a>
        </div>
    </div>       
   
    <div class="modal fade" id="deleteModal">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">×</span></button>
                    <h4 class="modal-title"><i class="icon fa fa-warning fa-lg text-yellow"></i> @lang('message.warning')</h4>
                </div>
                <div class="modal-body">
                    <h5>@lang('message.warning_section_delete') <b><span id="sectionId"></span></b> ?</h5>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn pull-left" data-dismiss="modal">@lang('message.close')</button>
                    <form action="{{'/'}}" method="POST" id="deleteForm">
                        <input type="hidden" name="_method" value="DELETE">
                        <input type="hidden" name="_token" value="{{ csrf_token() }}">
                        <button type="submit" class="btn btn-warning">@lang('message.continue')</button>
                    </form>
                </div>
            </div>
            <!-- /.modal-content -->
        </div>
      <!-- /.modal-dialog -->
    </div>
@endsection

@section('local-css')
    <link href="{{ asset('/plugins/datatables/dataTables.bootstrap.css') }}" rel="stylesheet" type="text/css" />
@endsection

@section('local-script')    
    <script src="{{ asset('/plugins/datatables/jquery.dataTables.min.js') }}"></script>
    <script src="{{ asset('/plugins/datatables/dataTables.bootstrap.min.js') }}"></script>
    <script type="text/javascript">
        $(function(){
            
            $('#deleteModal').on('show.bs.modal', function (event) {

                var link = $(event.relatedTarget); 
                var section_id = link.data('section-id');
                var modal = $(this);
                modal.find('#deleteForm').attr('action', '/section/'+section_id);
                modal.find('#sectionId').text(section_id);
            });

            var table= $('#dataTable').DataTable({
                "columnDefs": [
                    { "orderable": false, "targets": [-1,-2] }
                ]
            });
        });
    </script>
@endsection