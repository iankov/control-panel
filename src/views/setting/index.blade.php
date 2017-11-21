@extends('icp::master')

@section('title', 'Settings')

@section('content')

    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/datatables/1.10.16/css/dataTables.bootstrap.min.css" />

    <div class="box">
        <div class="box-header">
            <button type="button" onclick="document.location.href='{{icp_route('setting.create')}}'" class="btn btn-default">Add new</button>
            <!--<button type="submit" class="btn btn-danger" disabled>Delete</button>-->
        </div>

        <div class="box-body">
            <table id="table-list" class="table table-bordered table-striped">
                <thead>
                <tr>
                    <th>ID</th>
                    <th class="no-sort" style="padding-right: 8px;">Active</th>
                    <th>Name</th>
                    <th>Type</th>
                    <th>Key</th>
                    <th class="no-sort">Value</th>
                    <th>Created</th>
                    <th class="no-sort" style="width: 70px;">Actions</th>
                </tr>
                </thead>
                <tbody>
                    @foreach($settings as $setting)
                    <tr>
                        <td>{{$setting->id}}</td>
                        <td>
                            @include('icp::forms.active', ['active' => $setting->active,'action' => icp_route('setting.active.toggle', $setting->id)])
                        </td>
                        <td>{{$setting->name}}</td>
                        <td>{{$setting->typeName}}</td>
                        <td>{{$setting->key}}</td>
                        <td>
                            <div class="preview">
                                {{str_limit($setting->value, 50)}}
                                <a href="#" class="pull-right" onclick="return expandValue(this);">parse</a>
                            </div>
                            <pre style="display: none;">{{ print_r(setting($setting->key), true) }}</pre>
                        </td>
                        <td>{{$setting->created_at}}</td>
                        <td>
                            <form method="POST" action="{{icp_route('setting.delete', $setting->id)}}">
                                {{csrf_field()}}
                                <input type="hidden" name="_method" value="DELETE">
                                <a href="{{icp_route('setting.edit', $setting->id)}}" class="btn btn-xs btn-warning"><i class="fa fa-pencil" data-toggle="tooltip" data-placement="top" title="" data-original-title="Edit"></i></a>&nbsp;
                                <button onclick="return confirm('Are you sure you want to delete this config?')" type="submit" class="btn btn btn-xs btn-danger" data-toggle="tooltip" data-placement="top" title="" data-original-title="Delete">
                                    <i class="fa fa-trash"></i>
                                    <span class="sr-only">Delete</span>
                                </button>
                            </form>
                        </td>
                    </tr>
                    @endforeach
                </tbody>
                <tfoot>
                <tr>
                    <th>ID</th>
                    <th style="padding-right: 8px;">Active</th>
                    <th>Name</th>
                    <th>Type</th>
                    <th>Key</th>
                    <th>Value</th>
                    <th>Created</th>
                    <th>Actions</th>
                </tr>
                </tfoot>
            </table>
        </div>
        <!-- /.box-body -->
    </div>

    <!-- DataTables -->
    <script src="https://cdnjs.cloudflare.com/ajax/libs/datatables/1.10.16/js/jquery.dataTables.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/datatables/1.10.16/js/dataTables.bootstrap.min.js"></script>

    <script type="text/javascript">
        var expandValue = function(link){
            $(link).closest('.preview').hide();
            $(link).closest('td').find('pre').show();

            return false;
        };

        $(document).ready(function() {
            $('#table-list').DataTable({
                "paging": false,
                "lengthChange": false,
                "pageLength": 100,
                "searching": false,
                "ordering": true,
                "columnDefs": [ {
                    "targets": 'no-sort',
                    "orderable": false
                }]
            });
        });
    </script>

@endsection