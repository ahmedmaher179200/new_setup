@extends('layouts.admin')

@section('title', trans('admin.Users'))


@section('content')
    <!-- Content Header (Page header) -->
    <div class="content-header">
        <div class="container-fluid">
        <div class="row mb-2">
            <div class="col-sm-6">
            <h1 class="m-0">{{ trans('admin.Users') }}</h1>
            </div><!-- /.col -->
            <div class="col-sm-6">
            <ol class="breadcrumb float-sm-right">
                <li class="breadcrumb-item"><a href="{{url('dashboard')}}">{{ trans('admin.Home') }}</a> / {{ trans('admin.Users') }}</li>
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
              @if (auth('user')->user()->has_permission('create-users'))
                <a href="{{url('dashboard/users/create')}}" type="button" class="btn btn-info">{{ trans('admin.Add') }}</a>
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
                  <th>{{ trans('admin.Username') }}</th>
                  <th>{{ trans('admin.Name') }}</th>
                  <th>{{ trans('admin.Role') }}</th>
                  <th>{{ trans('admin.Created at') }}</th>
                  <th>{{ trans('admin.Actions') }}</th>
                </tr>
                </thead>
                <tbody>
                    @foreach ($users as $user)
                        <tr>
                            <td>{{$user->id}}</td>
                            <td>{{$user->username}}</td>
                            <td>{{$user->name}}</td>
                            <td>{{$user->getRole()}}</td>
                            <td>{{$user->created_at}}</td>
                            <td>
                                <div class="btn-group">
                                  <button type="button" class="btn btn-success">{{ trans('admin.Actions') }}</button>
                                  <button type="button" class="btn btn-success dropdown-toggle" data-toggle="dropdown">
                                  </button>
                                  <div class="dropdown-menu" role="menu">
                                    @if (auth('user')->user()->has_permission('update-users'))
                                      <a class="dropdown-item" href="{{url('dashboard/users/edit/' . $user->id)}}">{{ trans('admin.Edit') }}</a>
                                    @endif

                                    @if (auth('user')->user()->has_permission('update-users'))
                                      <a class="dropdown-item" href="{{url('dashboard/users/activity_logs/' . $user->id)}}">{{ trans('admin.Activity logs') }}</a>
                                    @endif

                                    @if (auth('user')->user()->has_permission('delete-users'))
                                      <a class="dropdown-item" href="#" data-toggle="modal" data-target="#modal-default-{{$user->id}}">{{ trans('admin.Delete') }}</a>
                                    @endif
                                  </div>
                                </div>

                                @include('partials.delete_confirmation', [
                                  'url' => url('dashboard/users/destroy/' . $user->id),
                                  'modal_id'  => 'modal-default-' . $user->id,
                                ])
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
<script>
  $(function () {

  $("#example1").DataTable({
      "responsive": true, "lengthChange": true, "autoWidth": false,
      "buttons": ["excel", "print", "colvis"],
      "oLanguage": {
          "sSearch": "{{__('admin.search')}} : ",
          "sLoadingRecords": "{{__('admin.loading')}}",
          "sInfo": "{{__('admin.Showing')}} _START_ {{__('admin.to')}} _END_ {{__('admin.of')}} _TOTAL_ {{__('admin.entries')}}",
          "sInfoEmpty": "{{__('admin.no_result')}}",
          "sEmptyTable": "{{__('admin.no_result')}}"
      },

      'buttons': [
          {
              extend: 'excel', text: '{{__('admin.excel')}}'
          },
          {
              extend: 'print', text: '{{__('admin.print')}}'
          },
          {
              extend: 'colvis', text: '{{__('admin.column_visibility')}}'
          },
      ],
      "language": {
          "paginate": {
              "previous": "{{__('admin.previous')}}",
              "next": "{{__('admin.next')}}",
          }
      }
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
@endsection
