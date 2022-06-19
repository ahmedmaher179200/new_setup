@extends('layouts.admin')

@section('title', 'roles')


@section('content')

    <div class="content-wrapper">

        <section class="content-header">

            <h1>{{ trans('admin.roles') }} </h1>

            <ol class="breadcrumb">
                <li> <a href="{{url('dashboard/roles')}}"><i class="fa fa-dashboard"></i>{{ trans('admin.dashboard') }}</a>
                </li>
                <li class="active"><i class="fa fa-users"></i>{{ trans('admin.roles') }}</li>
            </ol>
        </section>

        <section class="content">

            <div class="box box-primary">

                <div class="box-header with-border">
                    <form action="#" method="get">

                        <div class="row">

                            <div class="col-md-4">
                                 
                                @if (auth('admin')->user()->isAbleTo('create-admins'))
                                    <a href="{{url('dashboard/roles/create')}}"
                                    class="btn btn-primary"><i class="fa fa-plus"></i>{{ trans('admin.add') }}
                                    </a>
                                @else
                                    <button class="btn btn-primary"disabled><i class="fa fa-plus"></i>{{ trans('admin.add') }} </button>
                                @endif
                            </div>
                        </div>
                    </form>
                </div> {{-- end of box header --}}

                <div class="box-body">

                    <table class="table table-hover" id="myTable">

                        <thead class="thead-dark">
                                <tr>
                                    <th>#</th>
                                    <th>{{ trans('admin.name') }}</th>
                                    <th>{{ trans('admin.description') }}</th>
                                    <th>{{ trans('admin.action') }}</th>
                                </tr>
                            </thead>

                            <tbody>
                                @foreach ($roles as $role)
                                    <tr>
                                        <td>{{$role->id}}</td>
                                        <td>{{$role->name}}</td>
                                        <td>{{$role->description}}</td>
                                        <td>
                                            {{-- edit --}}
                                            @if (auth('admin')->user()->isAbleTo('update-admins'))
                                                <a href="{{url('dashboard/roles/edit/' . $role->id)}}" style="color: #fff;
                                                    background-color: #17a2b8;
                                                    border-color: #17a2b8;" rel="tooltip" title="" class="btn btn-info btn-sm "
                                                        data-original-title="edit">
                                                        <i class="fa fa-edit">{{ trans('admin.edit') }}</i>
                                                </a>
                                            @else
                                                <button class="btn btn-info btn-sm"type="submit" value="" disabled>
                                                    <i class="fa fa-edit">{{ trans('admin.edit') }}</i>
                                                </button>
                                            @endif

                                            {{-- delete --}}
                                            @if (auth('admin')->user()->isAbleTo('delete-admins'))
                                                <a href="{{url('dashboard/roles/delete/' . $role->id)}}" tyle="color:#fff!important;" rel="tooltip" title="" class="btn btn-danger  btn-sm">
                                                    <i class="fa fa-1x fa-trash">{{ trans('admin.delete') }}</i>
                                                </a> 
                                            @else
                                                <button class="btn btn-danger btn-sm"type="submit" value="" disabled>
                                                    <i class="fa fa-trash">{{ trans('admin.delete') }}</i>
                                                </button>
                                            @endif
                                        </td>
                                    </tr>
                                @endforeach
                                
                            </tbody>

                        </table> {{-- end of table --}}

                </div> {{-- end of box body --}}

            </div> {{-- end of box --}}

        </section><!-- end of content -->

    </div><!-- end of content wrapper -->

@endsection