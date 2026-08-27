@extends('layouts.admin')

@section('title', trans('admin.Users'))


@section('content')
    <!-- Content Header (Page header) -->
    <div class="content-header">
        <div class="row mb-2">
            <div class="col-sm-6">
            <h1 class="m-0">{{ trans('admin.Users') }}</h1>
            </div><!-- /.col -->
            <div class="col-sm-6">
            <ol class="breadcrumb float-sm-right">
                <li class="breadcrumb-item"><a href="{{route('dashboard.home')}}">{{ trans('admin.Home') }}</a> / {{ trans('admin.Users') }}</li>
            </ol>
            </div><!-- /.col -->
        </div><!-- /.row -->
    </div>
    <!-- /.content-header -->

    <!--start filter-->
    @include('Dashboard.users.filter')
    <!--end filter-->

    <!-- Main content -->
    <section class="content">
        <div class="card">
          <div class="card-header">
            @if (auth('user')->user()->has_permission('create-users'))
              <a href="{{route('dashboard.users.create')}}" type="button" class="btn btn-info">{{ trans('admin.Add') }}</a>
            @else
              <a href="#" type="button" class="btn btn-info disabled">{{ trans('admin.Add') }}</a>
            @endif
            
            <button type="button" class="btn btn-success" id="export-excel">
                <i class="fas fa-file-excel"></i> {{ trans('admin.Export to Excel') }}
            </button>

          </div>
          <!-- /.card-header -->
          <div class="card-body">
            <table class="table table-bordered table-striped data-table responsive">
              <thead>
              <tr>
                <th>#</th>
                <th>{{ trans('admin.Username') }}</th>
                <th>{{ trans('admin.Name') }}</th>
                <th>{{ trans('admin.Role') }}</th>
                <th>{{ trans('admin.Created at') }}</th>
                <th>{{ trans('admin.Actions') }}</th>
              </tr>
              </thead>
              <tbody>

              </tbody>
            </table>
          </div>
          <!-- /.card-body -->
        </div>
    </section>
    <!-- /.content -->
@endsection

@section('script')
<script src="{{ asset('assets/admin/js/excel-export.js') }}"></script>

<script type="text/javascript">
    var table = $('.data-table').DataTable({
        processing: true,
        serverSide: true,
        ajax: {
          "url": "{{ route('dashboard.users.index') }}",
          "data": function ( d ) {
            d.role = $('#role').val();
          }
        },
        columns: [
            {data: 'id', name: 'id'},
            {data: 'username', name: 'username'},
            {data: 'name', name: 'name'},
            {data: 'role', name: 'role'},
            {data: 'created_at', name: 'created_at'},
            {data: 'action', name: 'action', orderable: false, searchable: false},
        ],
        dom: 'lBfrtip',
        buttons: [
                    { extend: 'copy',   text: '<i class="fas fa-copy"></i> {{__('admin.copy')}}',        exportOptions: {search: 'none',columns: ':visible'}},
                    { extend: 'excel',  text: '<i class="fas fa-file-excel"></i> {{__('admin.excel')}}',  exportOptions: {search: 'none',columns: ':visible'}},
                    { extend: 'csv',    text: '<i class="fas fa-file-csv"></i> {{__('admin.csv')}}',      exportOptions: {search: 'none',columns: ':visible'}},
                    { extend: 'pdf',    text: '<i class="fas fa-file-pdf"></i> {{__('admin.pdf')}}',      exportOptions: {search: 'none',columns: ':visible'}},
                    { extend: 'print',  text: '<i class="fas fa-print"></i> {{__('admin.print')}}',       exportOptions: {search: 'none',columns: ':visible'}},
                    { extend: 'colvis', text: '<i class="fas fa-table-columns"></i> {{__('admin.column_visibility')}}', exportOptions: {search: 'none',columns: ':visible'}},
                ],
        // "lengthMenu": [ [10, 25, 50, -1], [10, 25, 50, 'All'] ]
    });

  $(document).on('change', '#role', function() {
    table.ajax.reload();
  });

  $(document).on('click', '#export-excel', function() {
      const role = $('#role').val();
      ExcelExportService.export("{{ route('dashboard.users.export') }}", 'users_export.xlsx', {
          role: role
      });
  });
</script>

@endsection
