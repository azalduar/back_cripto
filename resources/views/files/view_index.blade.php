<?php echo "@extends('adminlte::layouts.app')\n" ;?>

<?php echo "@section('htmlheader_title')\n"; ?>
    {{$view['display_name']}}
<?php echo "@endsection\n"; ?>

<?php echo "@section('contentheader_title')\n"; ?>
    {{$view['display_name']}}
<?php echo "@endsection\n"; ?>

<?php echo "@section('contentheader_description')\n"; ?>
    <?php echo"@lang('message.index')\n";?>
<?php echo "@endsection\n"; ?>

<?php echo "@section('main-content')\n"; ?>
    
    <div class="row">
        <div class="col-md-12">

            <?php echo "@if(session('alert'))\n"; ?>
                <div class="alert alert-<?php echo "{{session('alert')['status']}}"; ?> alert-dismissible">
                    <button type="button" class="close" data-dismiss="alert" aria-hidden="true">×</button>
                    <?php echo "{{session('alert')['message']}}\n"; ?>
                </div>
            <?php echo "@endif\n"; ?>
            
            <div class="box box-primary">
                <div class="box-body">
                    <div class="table-responsive">
                        <table id="dataTable" class="table table-hover table-condensed">
                            <thead>
                                <tr>
                                    <th width="3%">ID</th>
                                    @foreach($view['columns'] as $column)<th>{{title_case(str_replace('_', ' ', $column['name'] ))}}</th>
                                    @endforeach<?php echo "@if(Auth::user()->can('".$view['plural_name']."_update'))\n";?>
                                    <th width="5%"><?php echo "{{trans('message.edit')}}";?></th>
                                    <?php echo "@endif\n"; ?>
                                    <?php echo "@if(Auth::user()->can('".$view['plural_name']."_delete'))\n";?>
                                    <th width="5%"><?php echo "{{trans('message.delete')}}";?></th>
                                    <?php echo "@endif\n"; ?>
                                </tr>
                            </thead>
                            <tfoot>
                                <tr>
                                    <th></th>
                                    @foreach($view['columns'] as $column)<th><input class="form-control input-sm" type="text" placeholder="{{title_case(str_replace('_', ' ', $column['name'] ))}}"/></th>
                                    @endforeach<?php echo "@if(Auth::user()->can('".$view['plural_name']."_update'))\n";?>
                                    <th></th>
                                    <?php echo "@endif\n"; ?>
                                    <?php echo "@if(Auth::user()->can('".$view['plural_name']."_delete'))\n";?>
                                    <th></th>
                                    <?php echo "@endif\n"; ?>
                                </tr>
                            </tfoot>
                            <tbody>
                            <?php echo '@foreach($'.$view['plural_name'].' as $'.$view['single_name'].")\n"; ?>
                                <tr>
                                    <td><?php echo '{{ $'.$view['single_name'].'->id }}'; ?></td>
                                    @foreach($view['columns'] as $column)<td><?php echo '{{ $'.$view['single_name'].'->'.$column['name'].' }}';?></td>
                                    @endforeach<?php echo "@if(Auth::user()->can('".$view['plural_name']."_update'))\n";?>
                                    <td>
                                        <a href="<?php echo "{{url('".$view['plural_name']."/'.\$".$view['single_name']."->id.'/edit')}}"; ?>">
                                            <i class="fa fa-pencil-square-o"></i>
                                        </a>
                                    </td>
                                    <?php echo "@endif\n"; ?>
                                    <?php echo "@if(Auth::user()->can('".$view['plural_name']."_delete'))\n";?>
                                    <td>
                                        <a href="#" data-toggle="modal" data-target="#deleteModal" data-id="<?php echo '{{$'.$view['single_name']."->id}}"; ?>">
                                            <i class="fa fa-trash"></i>
                                        </a>
                                    </td>
                                    <?php echo "@endif\n"; ?>
                                </tr>
                            <?php echo "@endforeach\n"; ?>
                            </tbody>
                        </table>
                    </div>
                </div>      
            </div>
            <?php echo "@if(Auth::user()->can('".$view['plural_name']."_create'))\n";?>
            <a class="btn btn-primary" href="<?php echo "{{url('/".$view['plural_name']."/create')}}"; ?>" role="button"><?php echo "{{trans('message.create')}}";?></a>
            <?php echo "@endif\n"; ?>
        </div>
    </div>        
    <?php echo "@if(Auth::user()->can('".$view['plural_name']."_delete'))\n";?>
    <div class="modal fade" id="deleteModal">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">×</span></button>
                    <h4 class="modal-title"><i class="icon fa fa-warning fa-lg text-yellow"></i> <?php echo "{{trans('message.warning')}}";?></h4>
                </div>
                <div class="modal-body">
                    <h5><?php echo "{{trans('message.warning_delete')}}";?> <b><span id="{!!$view['single_name'].'Id'!!}"></span></b> ?</h5>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn pull-left" data-dismiss="modal"><?php echo "{{trans('message.close')}}";?></button>
                    <form action="/" method="POST" id="deleteForm">
                        <input type="hidden" name="_method" value="DELETE">
                        <input type="hidden" name="_token" value="<?php echo "{{ csrf_token() }}"; ?>">
                        <button type="submit" class="btn btn-warning"><?php echo "{{trans('message.continue')}}";?></button>
                    </form>
                </div>
            </div>
            <!-- /.modal-content -->
        </div>
      <!-- /.modal-dialog -->
    </div>
    <?php echo "@endif\n"; ?>
<?php echo "@endsection\n"; ?>

<?php echo "@section('local-css')\n"; ?>
    <link href="<?php echo "{{ asset('/plugins/datatables/dataTables.bootstrap.css') }}"; ?>" rel="stylesheet" type="text/css"/>
    <link href="<?php echo "{{ asset('/plugins/datatables/extensions/Buttons/css/buttons.dataTables.min.css') }}"; ?>" rel="stylesheet" type="text/css"/>
    <link href="<?php echo "{{ asset('/plugins/datatables/extensions/Buttons/css/buttons.bootstrap.min.css') }}"; ?>" rel="stylesheet" type="text/css"/>
    <style type="text/css">
        tfoot {
            display: table-header-group;
        }
    </style>
<?php echo "@endsection\n"; ?>

<?php echo "@section('local-script')\n"; ?>
    {{-- <script src="<?php echo "{{ asset('/plugins/jQuery/jQuery-2.1.4.min.js') }}";?>"></script> --}}
    {{-- <script src="<?php echo "{{ asset('/plugins/bootstrap-3.3.7/js/bootstrap.min.js') }}";?>"></script> --}}
    {{-- <script src="<?php echo "{{ asset('/plugins/datatables/jquery.dataTables.min.js') }}"; ?>"></script> --}}
    <script src="<?php echo "{{ asset('/plugins/datatables/dataTables.bootstrap.min.js') }}"; ?>"></script>
    <script src="<?php echo "{{ asset('/plugins/datatables/extensions/Buttons/js/dataTables.buttons.min.js') }}";?>"></script>
    <script src="<?php echo "{{ asset('/plugins/datatables/extensions/Buttons/js/buttons.bootstrap.min.js') }}";?>"></script>
    <script src="<?php echo "{{ asset('/plugins/datatables/extensions/Buttons/js/buttons.flash.min.js') }}";?>"></script>
    <script src="<?php echo "{{ asset('/plugins/datatables/extensions/Buttons/js/jszip.min.js') }}";?>"></script>
    <script src="<?php echo "{{ asset('/plugins/datatables/extensions/Buttons/js/pdfmake.min.js') }}";?>"></script>
    <script src="<?php echo "{{ asset('/plugins/datatables/extensions/Buttons/js/vfs_fonts.js') }}";?>"></script>    
    <script src="<?php echo "{{ asset('/plugins/datatables/extensions/Buttons/js/buttons.html5.js') }}";?>"></script>
    <script src="<?php echo "{{ asset('/plugins/datatables/extensions/Buttons/js/buttons.print.min.js') }}";?>"></script>
    <script src="<?php echo "{{ asset('/plugins/datatables/extensions/Buttons/js/buttons.colVis.min.js') }}";?>"></script>
    
    <script type="text/javascript">
        $(function(){
            <?php echo "@if(Auth::user()->can('".$view['plural_name']."_delete'))\n";?>
            $('#deleteModal').on('show.bs.modal', function (event) {

                var link = $(event.relatedTarget); 
                var {!!$view['single_name']!!}_id = link.data('id');
                                
                var modal = $(this);
                modal.find('#deleteForm').attr('action', '<?php echo "{{url('".$view['plural_name']."')}}"; ?>/'+{!!$view['single_name']!!}_id);
                modal.find('#{!!$view['single_name']!!}Id').text({!!$view['single_name']!!}_id);
            });
            <?php echo "@endif\n"; ?>

            <?php echo "@if(Auth::user()->can('".$view['plural_name']."_update'))\n";?>
                <?php echo "@if(Auth::user()->can('".$view['plural_name']."_delete'))\n";?>
                    var indices= [-1,-2];
                <?php echo "@else\n"; ?>
                    var indices= [-1];
                <?php echo "@endif\n"; ?>
            <?php echo "@else\n"; ?>
                <?php echo "@if(Auth::user()->can('".$view['plural_name']."_delete'))\n";?>
                    var indices= [-1];
                <?php echo "@else\n"; ?>
                    var indices=[];
                <?php echo "@endif\n"; ?>
            <?php echo "@endif\n"; ?>
            
            var table= $('#dataTable').DataTable({
                dom: 'lBrtip',
                buttons: [
                    {
                        extend: 'copyHtml5',
                        exportOptions: {
                            columns: ':visible'
                        }
                    },
                    {
                        extend: 'excelHtml5',
                        exportOptions: {
                            columns: ':visible'
                        }
                    },
                    {
                        extend: 'pdfHtml5',
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

            table.columns().every( function () {
                var that = this;
         
                $( 'input', this.footer() ).on( 'keyup change', function () {
                    if ( that.search() !== this.value ) {
                        that
                            .search( this.value )
                            .draw();
                    }
                } );
            } );
        });
    </script>
<?php echo "@endsection\n"; ?>