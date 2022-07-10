  <!-- Main Sidebar Container -->
  <aside class="main-sidebar sidebar-dark-primary elevation-4">
    <!-- Sidebar -->
    <div class="sidebar">
      <!-- Sidebar user panel (optional) -->
      <div class="user-panel mt-3 pb-3 mb-3 d-flex">
        <div class="image">
          <img src="{{auth('admin')->user()->getImage()}}" class="img-circle elevation-2" alt="User Image">
        </div>
        <div class="info">
          <a href="#" class="d-block">{{auth('admin')->user()->username}}</a>
        </div>
      </div>

      <!-- Sidebar Menu -->
      <nav class="mt-2">
        <ul class="nav nav-pills nav-sidebar flex-column" data-widget="treeview" role="menu" data-accordion="false">
          <!-- Add icons to the links using the .nav-icon class
               with font-awesome or any other icon font library -->
          <li class="nav-item">
          <a href="{{url('dashboard')}}" class="nav-link {{request()->is('*/dashboard')? 'active':''}}">
            <i class="nav-icon fas fa-th"></i>
            <p>
              {{ trans('admin.Dashboard') }}
            </p>
          </a>
        </li>
          {{-- menu-open --}}
          @if (auth('admin')->user()->isAbleTo('read-admins'))
            <li class="nav-item">
              <a href="#" class="nav-link">
                <i class="nav-icon fas fa-tachometer-alt"></i>
                <p>
                  {{ trans('admin.Users Mangement') }}
                  <i class="right fas fa-angle-left"></i>
                </p>
              </a>
              <ul class="nav nav-treeview">
                <li class="nav-item">
                  <a href="{{url('dashboard/admins')}}" class="nav-link {{(request()->is('*/dashboard/admins') || request()->is('*/dashboard/admins/*'))? 'active':''}}">
                    <i class="far fa-circle nav-icon"></i>
                    <p>{{ trans('admin.Admins') }}</p>
                  </a>
                </li>

                <li class="nav-item">
                  <a href="{{url('dashboard/roles')}}" class="nav-link {{(request()->is('*/dashboard/roles') || request()->is('*/dashboard/roles/*'))? 'active':''}}">
                    <i class="far fa-circle nav-icon"></i>
                    <p>{{ trans('admin.Roles') }} </p>
                  </a>
                </li>
              </ul>
            </li>
          @endif
          
        </ul>
      </nav>
      <!-- /.sidebar-menu -->
    </div>
    <!-- /.sidebar -->
  </aside>