@extends('layouts.admin')

@section('title', 'Roles')


@section('content')
    <!-- DataTables -->
    <link rel="stylesheet" href="{{asset('public/admin/dashboard/plugins/datatables-bs4/css/dataTables.bootstrap4.min.css')}}">
    <link rel="stylesheet" href="{{asset('public/admin/dashboard/plugins/datatables-responsive/css/responsive.bootstrap4.min.css')}}">
    <link rel="stylesheet" href="{{asset('public/admin/dashboard/plugins/datatables-buttons/css/buttons.bootstrap4.min.css')}}">
    <!-- Content Header (Page header) -->
    <div class="content-header">
        <div class="container-fluid">
        <div class="row mb-2">
            <div class="col-sm-6">
            <h1 class="m-0">{{ trans('admin.Roles') }}</h1>
            </div><!-- /.col -->
            <div class="col-sm-6">
            <ol class="breadcrumb float-sm-right">
                <li class="breadcrumb-item"><a href="{{url('dashboard')}}">{{ trans('admin.Home') }}</a> / {{ trans('admin.Roles') }}</li>
            </ol>
            </div><!-- /.col -->
        </div><!-- /.row -->
        </div><!-- /.container-fluid -->
    </div>
    <!-- /.content-header -->

    <!-- Main content -->
    <section class="content">
        <div class="container-fluid">
          <div class="card">
            <div class="card-header">
              @if (auth('admin')->user()->isAbleTo('create-admins'))
                <a href="{{url('dashboard/roles/create')}}" type="button" class="btn btn-info">{{ trans('admin.Add') }}</a>
              @else
                <a href="#" type="button" class="btn btn-info disabled">{{ trans('admin.Add') }}</a>
              @endif
            </div>
            <!-- /.card-header -->
            <div class="card-body">
              <table id="example1" class="table table-bordered table-striped">
                <thead>
                <tr>
                    <th>#</th>
                    <th>{{ trans('admin.Name') }}</th>
                    <th>{{ trans('admin.Description') }}</th>
                    <th>{{ trans('admin.Actions') }}</th>
                </tr>
                </thead>
                <tbody>
                    @foreach ($roles as $role)
                        <tr>
                            <td>{{$role->id}}</td>
                            <td>{{$role->name}}</td>
                            <td>{{$role->description}}</td>
                            <td>
                                <div class="btn-group">
                                    <button type="button" class="btn btn-success">{{ trans('admin.Actions') }}</button>
                                    <button type="button" class="btn btn-success dropdown-toggle" data-toggle="dropdown">
                                        <span class="sr-only">Toggle Dropdown</span>
                                    </button>
                                    <div class="dropdown-menu" role="menu">
                                      @if (auth('admin')->user()->isAbleTo('update-admins'))
                                        <a class="dropdown-item" href="{{url('dashboard/roles/edit/' . $role->id)}}">{{ trans('admin.Edit') }}</a>
                                      @endif

                                      @if (auth('admin')->user()->isAbleTo('delete-admins'))
                                        <a class="dropdown-item" href="{{url('dashboard/roles/delete/' . $role->id)}}">{{ trans('admin.Delete') }}</a>
                                      @endif
                                    </div>
                                  </div>
                            </td>
                        </tr>
                    @endforeach
                </tbody>
              </table>
            </div>
            <!-- /.card-body -->
          </div>
        </div><!-- /.container-fluid -->
      </section>
      <!-- /.content -->
@endsection
@section('script')
<!-- DataTables  & Plugins -->
<script src="{{asset('public/admin/dashboard/plugins/datatables/jquery.dataTables.min.js')}}"></script>
<script src="{{asset('public/admin/dashboard/plugins/datatables-bs4/js/dataTables.bootstrap4.min.js')}}"></script>
<script src="{{asset('public/admin/dashboard/plugins/datatables-responsive/js/dataTables.responsive.min.js')}}"></script>
<script src="{{asset('public/admin/dashboard/plugins/datatables-responsive/js/responsive.bootstrap4.min.js')}}"></script>
<script src="{{asset('public/admin/dashboard/plugins/datatables-buttons/js/dataTables.buttons.min.js')}}"></script>
<script src="{{asset('public/admin/dashboard/plugins/datatables-buttons/js/buttons.bootstrap4.min.js')}}"></script>
<script src="{{asset('public/admin/dashboard/plugins/jszip/jszip.min.js')}}"></script>
<script src="{{asset('public/admin/dashboard/plugins/pdfmake/pdfmake.min.js')}}"></script>
<script src="{{asset('public/admin/dashboard/plugins/pdfmake/vfs_fonts.js')}}')}}"></script>
<script src="{{asset('public/admin/dashboard/plugins/datatables-buttons/js/buttons.html5.min.js')}}"></script>
<script src="{{asset('public/admin/dashboard/plugins/datatables-buttons/js/buttons.print.min.js')}}"></script>
<script src="{{asset('public/admin/dashboard/plugins/datatables-buttons/js/buttons.colVis.min.js')}}"></script>

<script>
  $(function () {
    $("#example1").DataTable({
      "responsive": true, "lengthChange": false, "autoWidth": false,
      // "buttons": ["copy", "csv", "excel", "pdf", "print", "colvis"]
      "buttons": ["excel", "pdf", "print"]
    }).buttons().container().appendTo('#example1_wrapper .col-md-6:eq(0)');
    $('#example2').DataTable({
      "paging": true,
      "lengthChange": false,
      "searching": false,
      "ordering": true,
      "info": true,
      "autoWidth": false,
      "responsive": true,
    });
  });
</script>
<!--end data table-->
@endsection

