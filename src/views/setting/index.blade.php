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
                    <th>
                        <input type="checkbox" id="check-all">
                    </th>
                    <th>ID</th>
                    <th class="no-sort" style="padding-right: 8px;">Active</th>
                    <th>Name</th>
                    <th>Type</th>
                    <th>Key</th>
                    <th class="no-sort">Value</th>
                    <th>Created</th>
                    <th style="width: 120px;" class="text-center">Actions</th>
                </tr>
                </thead>
                <tbody></tbody>
                <tfoot>
                <tr>
                    <th></th>
                    <th>ID</th>
                    <th>Active</th>
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
    <script src="{{ asset('icp/js/datatablejs.js?v10') }}"></script>

    <script type="text/javascript">
        var expandValue = function(link){
            $(link).closest('.preview').hide();
            $(link).closest('td').find('pre').show();

            return false;
        };

        var dt = new DataTableJs('#table-list');
        var checkboxSlavesSel = '#table-list [name="ids[]"]';
        var initCompleteCallback = function(data){
            var onToggle = function () {
                var disabled = !($(checkboxSlavesSel+':checked').length > 0);
                $('#delete-button').prop('disabled', disabled);
            };
            Icp.iCheck(checkboxSlavesSel);
            $('#check-all').iCheck('uncheck');

            $(checkboxSlavesSel).on('ifToggled', function (event) {
                onToggle();
            });

            onToggle();
        };
        dt.setInitCompleteCallback(initCompleteCallback);

        $(document).ready(function() {
            Icp.assignCheckAll('#check-all', checkboxSlavesSel);

            $(dt.selector()).DataTable({
                paging: true,
                stateSave: true,
                lengthChange: true,
                lengthMenu: [ 10, 25, 50, 75, 100 ],
                pageLength: 25,
                searching: true,
                ordering: true,
                ajax: {
                    url: "{{icp_route('settings.json')}}",
                    complete: function(response){
                        if(response.responseJSON && response.responseJSON.csrf_token) {
                            Icp.token(response.responseJSON.csrf_token);
                        }
                    }
                },
                columns: [
                    {data: "checkbox", name: "checkbox", orderable: false },
                    {data: "id", name: "id", orderable: true },
                    {data: "active", name: "active", orderable: true, className: 'text-center' },
                    {data: "name", name: "name", orderable: true },
                    {data: "type", name: "type", orderable: true },
                    {data: "key", name: "key", orderable: true },
                    {data: "value", name: "value", orderable: false },
                    {data: "updated_at", name: "updated_at", orderable: true },
                    {data: "actions", name: "actions", orderable: false, className: 'text-center' },
                ],
                order: [[ 1, "desc" ]],
                initComplete: dt.initComplete
            });

            $('#delete-button').click(function(){
                if(confirm('Are you sure to DELETE this item?')) {
                    dt.postReload(
                        '{{icp_route('setting.delete')}}',
                        $(checkboxSlavesSel).serialize() + '&_method=DELETE&_token={{csrf_token()}}',
                        dt.initComplete
                    )
                }
            });
        });
    </script>

@endsection