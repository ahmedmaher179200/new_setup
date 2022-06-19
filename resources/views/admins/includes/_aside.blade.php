<aside class="main-sidebar">

    <section class="sidebar">

        <div class="user-panel">
            <div class="pull-left image">
                <img src="{{auth('admin')->user()->getImage()}}" class="img-circle" alt="User Image">
            </div>
            <div class="pull-left info">
                <p>{{auth('admin')->user()->username}}</p>
                <a href="#"><i class="fa fa-circle text-success"></i>{{ trans('admin.statue') }}</a>
            </div>
        </div>

        <ul class="sidebar-menu" data-widget="tree">
            <li class="{{request()->is('dashboard')? 'active':''}}">
                <a href="{{url('dashboard')}}"><i class="fa fa-users"></i><span>{{ trans('admin.dashboard') }}</span></a>
            </li>

            @if (auth('admin')->user()->isAbleTo('read-admins'))
                <li class="treeview" style="height: auto;">
                    <a href=""><i class="fa fa-users"></i><span>{{ trans('admin.admins') }}</span></a>
                    <ul class="treeview-menu" style="display: none;">
                        <li class="{{(request()->is('*/dashboard/admins') || request()->is('*/dashboard/admins/*'))? 'active':''}}">
                            <a href="{{url('dashboard/admins')}}"><i class="fa fa-users"></i><span>{{ trans('admin.admins') }}</span></a>
                        </li>

                        <li class="{{(request()->is('*/dashboard/roles') || request()->is('*/dashboard/roles/*'))? 'active':''}}">
                            <a href="{{url('dashboard/roles')}}"><i class="fa fa-users"></i><span>{{ trans('admin.roles') }}</span></a>
                        </li>
                    </ul>
                </li>
            @endif

        </ul>
    </section>
</aside>