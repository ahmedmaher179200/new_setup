@extends('layouts.admin')

@section('title', "Add Admin")


@section('content')
    <!-- Bootstrap Color Picker -->
    <link rel="stylesheet" href="{{ asset('public/admin/dashboard/plugins/bootstrap-colorpicker/css/bootstrap-colorpicker.min.css')}}">
    <!-- Select2 -->
    <link rel="stylesheet" href="{{ asset('public/admin/dashboard/plugins/select2/css/select2.min.css')}}">
    <link rel="stylesheet" href="{{ asset('public/admin/dashboard/plugins/select2-bootstrap4-theme/select2-bootstrap4.min.css')}}">
    <!-- Bootstrap4 Duallistbox -->
    <link rel="stylesheet" href="{{ asset('public/admin/dashboard/plugins/bootstrap4-duallistbox/bootstrap-duallistbox.min.css')}}">
    <!-- BS Stepper -->
    <link rel="stylesheet" href="{{ asset('public/admin/dashboard/plugins/bs-stepper/css/bs-stepper.min.css')}}">
    <!-- dropzonejs -->
    <link rel="stylesheet" href="{{ asset('public/admin/dashboard/plugins/dropzone/min/dropzone.min.css')}}">
    <!-- Theme style -->
    <link rel="stylesheet" href="{{ asset('public/admin/dashboard/dist/css/adminlte.min.css')}}">

    <!-- Content Header (Page header) -->
    <div class="content-header">
        <div class="container-fluid">
        <div class="row mb-2">
            <div class="col-sm-6">
            <h1 class="m-0">{{ trans('admin.Dashboard') }}</h1>
            </div><!-- /.col -->
            <div class="col-sm-6">
            <ol class="breadcrumb float-sm-right">
                <li class="breadcrumb-item"><a href="{{url('dashboard')}}">{{ trans('admin.Home') }}</a> / <a href="{{url('dashboard/admins')}}">{{ trans('admin.Admins') }}</a> / {{ trans('admin.Create') }}</li>
            </ol>
            </div><!-- /.col -->
        </div><!-- /.row -->
        </div><!-- /.container-fluid -->
    </div>
    <!-- /.content-header -->

    <section class="content">
        <div class="container-fluid">
        <div class="row">
            <!-- left column -->
            <div class="col-md-12">
            <!-- general form elements -->
            <div class="card card-primary">
                <div class="card-header">
                <h3 class="card-title">{{ trans('admin.Create') }}</h3>
                </div>
                <!-- /.card-header -->
                <!-- form start -->
                <form method="post" action="">
                    @csrf
                    <div class="card-body">
                        <div class="row">
                            <div class="col-lg-6">
                                <div class="form-group">
                                    <label for="exampleInputEmail1">{{ trans('admin.Username') }}</label>
                                    <input type="text"  value="{{ old('username') }}" class="form-control" id="exampleInputEmail1" placeholder="{{ trans('admin.Username') }}" name="username">
                                    @error('username')
                                        <span style="color: red; margin: 20px;">
                                            {{ $message }}
                                        </span>
                                    @enderror
                                </div>
                            </div>

                            <div class="col-lg-6">
                                <div class="form-group">
                                    <label for="exampleInputPassword1">{{ trans('admin.Password') }}</label>
                                    <input type="password" class="form-control" id="exampleInputPassword1" placeholder="{{ trans('admin.Password') }}" name="password">
                                    @error('password')
                                        <span style="color: red; margin: 20px;">
                                            {{ $message }}
                                        </span>
                                    @enderror
                                </div>
                            </div>

                            <div class="col-lg-6">
                                <div class="form-group">
                                    <label>{{ trans('admin.Roles') }}</label>
                                    <select class="form-control select2" style="width: 100%;" name="role_id">
                                        @foreach ($roles as $role)
                                            <option value="{{$role->id}}">{{$role->name}}</option>
                                        @endforeach>
                                    </select>
                                    @error('role_id')
                                        <span style="color: red; margin: 20px;">
                                            {{ $message }}
                                        </span>
                                    @enderror
                                </div>
                            </div>
                        </div>
                    </div>
                    <!-- /.card-body -->

                    <div class="card-footer">
                        <button type="submit" class="btn btn-primary">{{ trans('admin.Add') }}</button>
                    </div>
                </form>
            </div>
            <!-- /.card -->
            </div>
        </div><!-- /.container-fluid -->
    </section>
@endsection
