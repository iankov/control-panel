@extends('icp::master')

@section('title', 'Users')

@section('content')

    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/datatables/1.10.16/css/dataTables.bootstrap.min.css" />

    <div class="box">
        <div class="box-header">
            <button type="button" onclick="document.location.href='{{icp_route('admin.create')}}'" class="btn btn-default">Add new</button>
            <!--<button type="submit" class="btn btn-danger" disabled>Delete</button>-->
        </div>
        <!-- /.box-header -->
        <div class="box-body">

            @if(session()->has('success'))
            <div class="alert alert-success alert-dismissable">
                <button type="button" class="close" data-dismiss="alert" aria-hidden="true">×</button>
                {{session('success')}}
            </div>
            @endif

            @if($errors->count() > 0)
                <div class="alert alert-danger alert-dismissable">
                    <button type="button" class="close" data-dismiss="alert" aria-hidden="true">×</button>
                    {{$errors->first()}}
                </div>
            @endif

            <table id="table-list" class="table table-bordered table-striped">
                <thead>
                <tr>
                    <th style="width: 100px;">ID</th>
                    <th>Name</th>
                    <th>Email</th>
                    <th>Last modification</th>
                    <th style="width: 120px;" class="text-center no-sort">Actions</th>
                </tr>
                </thead>
                <tbody>
                <?php foreach($users as $user){ ?>
                <tr>
                    <td>{{$user->id}}</td>
                    <td>{{$user->name}}</td>
                    <td>{{$user->email}}</td>
                    <td>{{$user->updated_at->format('d M Y, H:i:s')}}</td>
                    <td class="text-center">
                        <form method="POST" action="{{icp_route('admin.delete', $user->id)}}">
                            {{csrf_field()}}
                            <input type="hidden" name="_method" value="DELETE">
                            <a href="{{icp_route('admin.edit', $user->id)}}" class="btn btn-xs btn-warning"><i class="fa fa-pencil" data-toggle="tooltip" data-placement="top" title="" data-original-title="Edit"></i></a>&nbsp;&nbsp;
                            <button onclick="return confirm('Are you sure you want to delete this item?')" type="submit" class="btn btn btn-xs btn-danger" data-toggle="tooltip" data-placement="top" title="" data-original-title="Delete">
                                <i class="fa fa-trash"></i>
                                <span class="sr-only">Delete</span>
                            </button>
                        </form>
                    </td>
                </tr>
                <?php } ?>
                </tbody>
                <tfoot>
                <tr>
                    <th>ID</th>
                    <th>Name</th>
                    <th>Email</th>
                    <th class="text-center">Actions</th>
                </tr>
                </tfoot>
            </table>
        </div>
    </div>

    <!-- DataTables -->
    <script src="https://cdnjs.cloudflare.com/ajax/libs/datatables/1.10.16/js/jquery.dataTables.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/datatables/1.10.16/js/dataTables.bootstrap.min.js"></script>

    <script type="text/javascript">
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
