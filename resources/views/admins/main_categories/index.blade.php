@extends('layouts.admin')

@section('title', 'main categories')


@section('content')

    <div class="content-wrapper">

        <section class="content-header">

            <h1>{{ trans('admin.main categories') }}</h1>

            <ol class="breadcrumb">
                <li> <a href="{{url('dashboard/main_categories')}}"><i class="fa fa-dashboard"></i>{{ trans('admin.main dashboard') }}</a>
                </li>
                <li class="active"><i class="fa fa-users"></i>{{ trans('admin.main categories') }}</li>
            </ol>
        </section>

        <section class="content">

            <div class="box box-primary">

                <div class="box-header with-border">
                    <form action="#" method="get">

                        <div class="row">

                            <div class="col-md-4">
                                @if (auth('admin')->user()->isAbleTo('create-categories'))
                                    <a href="{{url('dashboard/main_categories/create')}}"
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
                                    <th>{{ trans('admin.image') }}</th>
                                    <th>{{ trans('admin.status') }}</th>
                                    <th>{{ trans('admin.action') }}</th>
                                </tr>
                            </thead>

                            <tbody>
                                @foreach ($main_categories as $main_category)
                                    <tr>
                                        <td>{{$main_category->id}}</td>
                                        <td>{{$main_category->translate('en')->name}}</td>
                                        <td><img src="{{$main_category->getImage()}}" style="width: 70px;"></td>
                                        <td>{{$main_category->getStatus()}}</td>
                                        <td>
                                            {{-- edit --}}
                                            @if (auth('admin')->user()->isAbleTo('update-categories'))
                                                <a href="{{url('dashboard/main_categories/edit/' . $main_category->id)}}" style="color: #fff;
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
                                            @if (auth('admin')->user()->isAbleTo('delete-categories'))
                                                <a href="{{url('/dashboard/main_categories/delete/' . $main_category->id)}}" class="btn btn-danger btn-min-width box-shadow-5 mr-1 mb-1" style="min-width: 6.5rem; margin-right: 8px !important;">{{ trans('admin.delete') }}</a>
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
