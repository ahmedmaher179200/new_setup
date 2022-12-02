@extends('layouts.admin')

@section('title', "edit Role")


@section('content')
    <!-- Content Header (Page header) -->
    <div class="content-header">
        <div class="container-fluid">
        <div class="row mb-2">
            <div class="col-sm-6">
            <h1 class="m-0">{{ trans('admin.Roles') }}</h1>
            </div><!-- /.col -->
            <div class="col-sm-6">
            <ol class="breadcrumb float-sm-right">
                <li class="breadcrumb-item"><a href="{{url('dashboard')}}">{{ trans('admin.Home') }}</a> / <a href="{{url('dashboard/roles')}}">{{ trans('admin.Roles') }}</a> / {{ trans('admin.Edit') }}</li>
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
                  <h3 class="card-title">{{ trans('admin.Edit') }}</h3>
                </div>
                <!-- /.card-header -->
                <!-- form start -->
                <form method="post" action="">
                    @csrf
                    @include('admins.roles.form')

                    {{-- <div class="card-body">
                      <div class="row">
                        <div class="col-lg-6">
                            <x-form.input type="text" class="form-control"
                                name="name" value="{{ $role->name }}"
                                label="{{ trans('admin.Name') }}" attribute="required"/>
                        </div>
    
                        <div class="col-lg-6">
                            <x-form.input type="text" class="form-control"
                                name="description" value="{{ $role->description }}"
                                label="{{ trans('admin.Description') }}" attribute="required"/>
                        </div>
                      </div>
    
                      <div class="row">
                          @foreach (config('global.roles') as $key => $values)
                              <div class="col-lg-3">
                                  <div class="card card-primary">
                                  <div class="card-header">
                                      <h3 class="card-title">{{$key}}</h3>
                                  </div>
                                  
                                  <div class="card-body">
                                      @foreach ($values as $value)
                                        <x-form.checkbox class="form-control" name="permissions[]"
                                          label="{{$value}}" tag="{{$value . '-' . $key}}"
                                          value="{{$value . '-' . $key}}" attribute="{{$role->hasPermission($value . '-' . $key) ? 'checked' : ''}}"/>
                                      @endforeach
                                  </div>
                                  </div>
                              </div>
                          @endforeach
                      </div>
    
                    </div> --}}
                  <div class="card-footer">
                    <button type="submit" class="btn btn-primary">{{ trans('admin.Save') }}</button>
                  </div>
                </form>
              </div>
              <!-- /.card -->
            </div>
        </div><!-- /.container-fluid -->
      </section>

@endsection
