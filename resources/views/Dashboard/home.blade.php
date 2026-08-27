@extends('layouts.admin')

@section('title', "Home")

@section('content')
    <!-- Content Header (Page header) -->
    <div class="content-header">
        <div class="row mb-2">
            <div class="col-sm-6">
            <h1 class="m-0">{{ trans('admin.Dashboard') }}</h1>
            </div><!-- /.col -->
            <div class="col-sm-6">
            <ol class="breadcrumb float-sm-right">
                <li class="breadcrumb-item">{{ trans('admin.Home') }}</li>
            </ol>
            </div><!-- /.col -->
        </div><!-- /.row -->
    </div>
    <!-- /.content-header -->

    <!-- Main content -->
    <section class="content">

        <div class="welcome-banner">
            <div>
                <h2>{{ trans('admin.Welcome') }}, {{ auth('user')->user()->name }}</h2>
                <p>{{ now()->translatedFormat('l, d F Y') }}</p>
            </div>
            <img src="{{ auth('user')->user()->getImage() }}" class="welcome-avatar" alt="{{ auth('user')->user()->name }}">
        </div>

        <div class="row">
            <div class="col-lg-3 col-6">
                <div class="small-box">
                    <div class="icon-chip chip-info"><i class="fas fa-bag-shopping"></i></div>
                    <h3>150</h3>
                    <p>New Orders</p>
                </div>
            </div>
            <div class="col-lg-3 col-6">
                <div class="small-box">
                    <div class="icon-chip chip-success"><i class="fas fa-chart-bar"></i></div>
                    <h3>53<sup>%</sup></h3>
                    <p>Bounce Rate</p>
                </div>
            </div>
            <div class="col-lg-3 col-6">
                <div class="small-box">
                    <div class="icon-chip chip-warning"><i class="fas fa-user-plus"></i></div>
                    <h3>44</h3>
                    <p>User Registrations</p>
                </div>
            </div>
            <div class="col-lg-3 col-6">
                <div class="small-box">
                    <div class="icon-chip chip-danger"><i class="fas fa-chart-pie"></i></div>
                    <h3>65</h3>
                    <p>Unique Visitors</p>
                </div>
            </div>
        </div>
        <!-- /.row -->

        @if (auth('user')->user()->has_permission('read-users') || auth('user')->user()->has_permission('read-categories') || auth('user')->user()->has_permission('read-settings'))
            <h3 class="section-title">{{ trans('admin.Quick actions') }}</h3>
            <div class="row">
                @if (auth('user')->user()->has_permission('read-users'))
                    <div class="col-lg-3 col-6">
                        <a href="{{ route('dashboard.users.index') }}" class="quick-action">
                            <div class="icon-chip chip-info"><i class="fas fa-users"></i></div>
                            <h4>{{ trans('admin.Users') }}</h4>
                            <p>{{ trans('admin.Users Mangement') }}</p>
                        </a>
                    </div>
                    <div class="col-lg-3 col-6">
                        <a href="{{ route('dashboard.roles.index') }}" class="quick-action">
                            <div class="icon-chip chip-success"><i class="fas fa-user-shield"></i></div>
                            <h4>{{ trans('admin.Roles') }}</h4>
                            <p>{{ trans('admin.Users Mangement') }}</p>
                        </a>
                    </div>
                @endif

                @if (auth('user')->user()->has_permission('read-categories'))
                    <div class="col-lg-3 col-6">
                        <a href="{{ route('dashboard.categories.index') }}" class="quick-action">
                            <div class="icon-chip chip-warning"><i class="fas fa-folder-tree"></i></div>
                            <h4>{{ trans('admin.Categories') }}</h4>
                            <p>{{ trans('admin.Categories') }}</p>
                        </a>
                    </div>
                @endif

                @if (auth('user')->user()->has_permission('read-settings'))
                    <div class="col-lg-3 col-6">
                        <a href="{{ route('dashboard.settings.edit') }}" class="quick-action">
                            <div class="icon-chip chip-danger"><i class="fas fa-gear"></i></div>
                            <h4>{{ trans('admin.Settings') }}</h4>
                            <p>{{ trans('admin.Settings') }}</p>
                        </a>
                    </div>
                @endif
            </div>
            <!-- /.row -->
        @endif

    </section>
    <!-- /.content -->
@endsection
