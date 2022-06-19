@extends('layouts.admin')

@section('title', 'dashboard')

@section('content')

    <div class="content-wrapper" style="min-height: 0">

        <section class="content-header">

            <h1>{{ trans('admin.dashboard') }}</h1>

            <ol class="breadcrumb">
                <li class="active"><i class="fa fa-dashboard"></i>{{ trans('admin.dashboard') }}</li>
            </ol>
        </section>

        <section class="content">
            <div class="row">
                <div class="col-lg-3 col-xs-6">
                    <div class="small-box bg-aqua">
                        <div class="inner">
                            <h3>{{App\Models\Admin::count()}}</h3>

                            <p>{{ trans('admin.admins') }}</p>
                        </div>
                        <div class="icon">
                            <i class="ion ion-bag"></i>
                        </div> 
                    </div>
                </div>

            </div><!-- end of row -->
        </section><!-- end of content -->
        {{-- @include('admins.includes._char') --}}
    </div><!-- end of content wrapper -->
@endsection

@push('script')


@endpush
