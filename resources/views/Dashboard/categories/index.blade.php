@extends('layouts.admin')

@section('title', trans('admin.Categories'))


@section('content')
    <!-- Content Header (Page header) -->
    <div class="content-header">
        <div class="row mb-2">
            <div class="col-sm-6">
            <h1 class="m-0">{{ trans('admin.Categories') }}</h1>
            </div><!-- /.col -->
            <div class="col-sm-6">
            <ol class="breadcrumb float-sm-right">
                <li class="breadcrumb-item"><a href="{{route('dashboard.home')}}">{{ trans('admin.Home') }}</a> / {{ trans('admin.Categories') }}</li>
            </ol>
            </div><!-- /.col -->
        </div><!-- /.row -->
    </div>
    <!-- /.content-header -->

    <!-- Main content -->
    <section class="content">
        <div class="card">
          <div class="card-header">
            @if (auth('user')->user()->has_permission('create-Categories'))
              <a href="{{route('dashboard.categories.create')}}" type="button" class="btn btn-info">{{ trans('admin.Add') }}</a>
            @else
              <a href="#" type="button" class="btn btn-info disabled">{{ trans('admin.Add') }}</a>
            @endif
          </div>
          <!-- /.card-header -->
          <div class="card-body">
            <table id="example1" class="table table-bordered table-striped responsive">
              <thead>
              <tr>
                <th>#</th>
                <th>{{ trans('admin.Path') }}</th>
                <th>{{ trans('admin.Name') }}</th>
                <th>{{ trans('admin.Created at') }}</th>
                <th>{{ trans('admin.Actions') }}</th>
              </tr>
              </thead>
              <tbody>
                  @foreach ($categories as $category)
                      <tr>
                          <td>{{$category->id}}</td>
                          <td>{{$category->getPath()}}</td>
                          <td>{{$category->translate(LaravelLocalization::getCurrentLocale())->name}}</td>
                          <td>{{$category->created_at}}</td>
                          <td>
                              <div class="dropdown">
                                <button type="button" class="btn btn-icon" data-toggle="dropdown" aria-label="{{ trans('admin.Actions') }}">
                                    <i class="fas fa-ellipsis-vertical"></i>
                                </button>
                                <div class="dropdown-menu dropdown-menu-right" role="menu">
                                  @if (auth('user')->user()->has_permission('update-Categories'))
                                    <a class="dropdown-item" href="{{route('dashboard.categories.edit',$category->id)}}"><i class="fas fa-pen"></i> {{ trans('admin.Edit') }}</a>
                                  @endif

                                  @if (auth('user')->user()->has_permission('delete-Categories'))
                                    <div class="dropdown-divider"></div>
                                    <a class="dropdown-item dropdown-item-danger delete-popup" href="#" data-toggle="modal" data-target="#modal-default" data-url="{{route('dashboard.categories.destroy', $category->id)}}"><i class="fas fa-trash"></i> {{ trans('admin.Delete') }}</a>
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
    </section>
    <!-- /.content -->
@endsection

@section('script')
<script>
  $.fn.dataTable.ext.search.push(
      function( settings, data, dataIndex ) {
        //role filter
        var role = $('#role').val();
        if(data[3] === role || role == ''){ var role_status = true } else { var role_status = false};

        if(role_status)
          return true;

        return false;
      }
  );

  $(document).ready(function () {
      // filter
      $('#role').on('change', function () {
        table1.draw().buttons().container().appendTo('#example1_wrapper .col-md-6:eq(0)');
      });
  });
</script>
@endsection
