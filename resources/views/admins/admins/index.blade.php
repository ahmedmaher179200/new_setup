@extends('layouts.admin')

@section('title', 'admins')


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
            <h1 class="m-0">{{ trans('admin.Dashboard') }}</h1>
            </div><!-- /.col -->
            <div class="col-sm-6">
            <ol class="breadcrumb float-sm-right">
                <li class="breadcrumb-item"><a href="{{url('dashboard')}}">{{ trans('admin.Home') }}</a> / {{ trans('admin.Admins') }}</li>
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
                <a href="{{url('dashboard/admins/create')}}" type="button" class="btn btn-info">{{ trans('admin.Add') }}</a>
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
                  <th>{{ trans('admin.Role') }}</th>
                  <th>{{ trans('admin.Actions') }}</th>
                </tr>
                </thead>
                <tbody>
                    @foreach ($admins as $admin)
                        <tr>
                            <td>{{$admin->id}}</td>
                            <td>{{$admin->username}}</td>
                            <td>{{$admin->getRole()}}</td>
                            <td>
                                    <div class="btn-group">
                                    <button type="button" class="btn btn-success">{{ trans('admin.Actions') }}</button>
                                    <button type="button" class="btn btn-success dropdown-toggle" data-toggle="dropdown">
                                        <span class="sr-only">Toggle Dropdown</span>
                                    </button>
                                    <div class="dropdown-menu" role="menu">
                                      @if (auth('admin')->user()->isAbleTo('update-admins'))
                                        <a class="dropdown-item" href="{{url('dashboard/admins/edit/' . $admin->id)}}">{{ trans('admin.Edit') }}</a>
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
