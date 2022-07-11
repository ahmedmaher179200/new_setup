@extends('layouts.admin')

@section('title', "Add Role")


@section('content')
    <!-- Content Header (Page header) -->
    <div class="content-header">
        <div class="container-fluid">
        <div class="row mb-2">
            <div class="col-sm-6">
            <h1 class="m-0">{{ trans('admin.Dashboard') }}</h1>
            </div><!-- /.col -->
            <div class="col-sm-6">
            <ol class="breadcrumb float-sm-right">
                <li class="breadcrumb-item"><a href="{{url('dashboard')}}">{{ trans('admin.Home') }}</a> / <a href="{{url('dashboard/roles')}}">{{ trans('admin.Roles') }}</a> / {{ trans('admin.Create') }}</li>
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
                          <label for="exampleInputEmail1">{{ trans('admin.Name') }}</label>
                          <input type="text" class="form-control" id="exampleInputEmail1" placeholder="{{ trans('admin.Name') }}" name="name">
                          @error('name')
                            <span style="color: red; margin: 20px;">
                                {{ $message }}
                            </span>
                          @enderror
                        </div>
                      </div>
  
                      <div class="col-lg-6">
                        <div class="form-group">
                            <label for="exampleInputEmail1">{{ trans('admin.Description') }}</label>
                            <input type="text" class="form-control" id="exampleInputEmail1" placeholder="{{ trans('admin.Description') }}" name="description">
                            @error('description')
                            <span style="color: red; margin: 20px;">
                                {{ $message }}
                            </span>
                            @enderror
                        </div>
                      </div>
                    </div>
  
                    <div class="row">
                        @foreach (config('global.roles') as $role)
                            <div class="col-lg-3">
                                <div class="card card-primary">
                                <div class="card-header">
                                    <h3 class="card-title">{{$role}}</h3>
                                </div>
                                
                                <div class="card-body">
                                    @foreach (config('global.maps') as $map)
                                        <div class="form-group clearfix">
                                            <div class="icheck-success d-inline">
                                                <input type="checkbox" id="{{$map . '-' . $role}}" name="permissions[]" value="{{$map . '-' . $role}}">
                                                <label for="{{$map . '-' . $role}}">
                                                {{$map}}
                                                </label>
                                            </div>
                                        </div>
                                    @endforeach
                                </div>
                                </div>
                            </div>
                        @endforeach
                    </div>
  
                  </div>
                  <div class="card-footer">
                    <button type="submit" class="btn btn-primary">save</button>
                  </div>
                </form>
              </div>
              <!-- /.card -->
            </div>
        </div><!-- /.container-fluid -->
      </section>

@endsection
