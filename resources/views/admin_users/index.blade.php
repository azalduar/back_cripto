@extends('adminlte::layouts.app')

@section('htmlheader_title')
    Users
@endsection

@section('contentheader_title')
    Users
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
                                    <th>Name</th>
                                    <th>Email</th>
                                    
                                    @if(Auth::user()->can('admin_users_update'))
                                    <th width="5%">{{trans('message.edit')}}</th>
                                    @endif
                                    @if(Auth::user()->can('admin_users_delete'))
                                    <th width="5%">{{trans('message.delete')}}</th>
                                    @endif
                                </tr>
                            </thead>
                            <tbody>
                            @foreach($admin_users_items as $admin_users)
                                <tr>
                                    <td>{{ $admin_users->id }}</td>
                                    <td>{{ $admin_users->name }}</td>
                                    <td>{{ $admin_users->email }}</td>
                                    
                                    @if(Auth::user()->can('admin_users_update'))
                                    <td>
                                        <a href="{{url('admin_users/'.$admin_users->id.'/edit')}}">
                                            <i class="fa fa-pencil-square-o"></i>
                                        </a>
                                    </td>
                                    @endif
                                    @if(Auth::user()->can('admin_users_delete'))
                                    <td>
                                        <a href="#" data-toggle="modal" data-target="#deleteModal" data-id="{{$admin_users->id}}">
                                            <i class="fa fa-trash"></i>
                                        </a>
                                    </td>
                                    @endif
                                </tr>
                            @endforeach
                            </tbody>
                        </table>
                    </div>
                </div>      
            </div>
            @if(Auth::user()->can('admin_users_create'))
            <a class="btn btn-primary" href="{{url('/admin_users/create')}}" role="button">{{trans('message.create')}}</a>
            @endif
        </div>
    </div>        
    @if(Auth::user()->can('admin_users_delete'))
    <div class="modal fade" id="deleteModal">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">×</span></button>
                    <h4 class="modal-title"><i class="icon fa fa-warning fa-lg text-yellow"></i> {{trans('message.warning')}}</h4>
                </div>
                <div class="modal-body">
                    <h5>{{trans('message.warning_delete')}} <b><span id="admin_usersId"></span></b> ?</h5>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn pull-left" data-dismiss="modal">{{trans('message.close')}}</button>
                    <form action="/" method="POST" id="deleteForm">
                        <input type="hidden" name="_method" value="DELETE">
                        <input type="hidden" name="_token" value="{{ csrf_token() }}">
                        <button type="submit" class="btn btn-warning">{{trans('message.continue')}}</button>
                    </form>
                </div>
            </div>
            <!-- /.modal-content -->
        </div>
      <!-- /.modal-dialog -->
    </div>
    @endif
@endsection

@section('local-css')
    <link href="{{ asset('/plugins/datatables/dataTables.bootstrap.css') }}" rel="stylesheet" type="text/css"/>
    <link href="{{ asset('/plugins/datatables/extensions/Buttons/css/buttons.dataTables.min.css') }}" rel="stylesheet" type="text/css"/>
    <link href="{{ asset('/plugins/datatables/extensions/Buttons/css/buttons.bootstrap.min.css') }}" rel="stylesheet" type="text/css"/>
@endsection

@section('local-script')
    <script src="{{ asset('/plugins/jQuery/jQuery-2.1.4.min.js') }}"></script>
    <script src="{{ asset('/plugins/bootstrap-3.3.7/js/bootstrap.min.js') }}"></script>
    <script src="{{ asset('/plugins/datatables/jquery.dataTables.min.js') }}"></script>
    <script src="{{ asset('/plugins/datatables/dataTables.bootstrap.min.js') }}"></script>
    <script src="{{ asset('/plugins/datatables/extensions/Buttons/js/dataTables.buttons.min.js') }}"></script>
    <script src="{{ asset('/plugins/datatables/extensions/Buttons/js/buttons.bootstrap.min.js') }}"></script>
    <script src="{{ asset('/plugins/datatables/extensions/Buttons/js/buttons.flash.min.js') }}"></script>
    <script src="{{ asset('/plugins/datatables/extensions/Buttons/js/jszip.min.js') }}"></script>
    <script src="{{ asset('/plugins/datatables/extensions/Buttons/js/pdfmake.min.js') }}"></script>
    <script src="{{ asset('/plugins/datatables/extensions/Buttons/js/vfs_fonts.js') }}"></script>    
    <script src="{{ asset('/plugins/datatables/extensions/Buttons/js/buttons.html5.js') }}"></script>
    <script src="{{ asset('/plugins/datatables/extensions/Buttons/js/buttons.print.min.js') }}"></script>
    <script src="{{ asset('/plugins/datatables/extensions/Buttons/js/buttons.colVis.min.js') }}"></script>
    
    <script type="text/javascript">
        $(function(){
            @if(Auth::user()->can('admin_users_delete'))
            $('#deleteModal').on('show.bs.modal', function (event) {

                var link = $(event.relatedTarget); 
                var admin_users_id = link.data('id');
                                
                var modal = $(this);
                modal.find('#deleteForm').attr('action', '{{url('admin_users')}}/'+admin_users_id);
                modal.find('#admin_usersId').text(admin_users_id);
            });
            @endif

            @if(Auth::user()->can('admin_users_update'))
                @if(Auth::user()->can('admin_users_delete'))
                    var indices= [-1,-2];
                @else
                    var indices= [-1];
                @endif
            @else
                @if(Auth::user()->can('admin_users_delete'))
                    var indices= [-1];
                @else
                    var indices=[];
                @endif
            @endif
            
            var table= $('#dataTable').DataTable({
                dom: 'lBfrtip',
                buttons: [
                    {
                        extend: 'copy',
                        exportOptions: {
                            columns: ':visible'
                        }
                    },
                    {
                        extend: 'excel',
                        exportOptions: {
                            columns: ':visible'
                        }
                    },
                    {
                        extend: 'pdf',
                        exportOptions: {
                            columns: ':visible'
                        }
                    },
                    {
                        extend: 'print',
                        exportOptions: {
                            columns: ':visible'
                        }
                    },'colvis'
                ],                
                "columnDefs": [
                    { "orderable": false, "targets": indices }
                ]
            });
        });
    </script>
@endsection
