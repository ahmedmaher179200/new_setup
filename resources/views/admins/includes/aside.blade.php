  <!-- Main Sidebar Container -->
  <aside class="main-sidebar sidebar-dark-primary elevation-4">
    <!-- Sidebar -->
    <div class="sidebar">
      <!-- Sidebar user panel (optional) -->
      <div class="user-panel mt-3 pb-3 mb-3 d-flex">
        <div class="image">
          <img src="{{auth('user')->user()->getImage()}}" class="img-circle elevation-2" alt="User Image">
        </div>
        <div class="info">
          <a href="#" class="d-block">{{auth('user')->user()->username}}</a>
        </div>
      </div>

      <!-- SidebarSearch Form -->
      <div class="form-inline">
        <div class="input-group" data-widget="sidebar-search">
          <input class="form-control form-control-sidebar" type="search" placeholder="Search" aria-label="Search">
          <div class="input-group-append">
            <button class="btn btn-sidebar">
              <i class="fas fa-search fa-fw"></i>
            </button>
          </div>
        </div>
      </div>

      <!-- Sidebar Menu -->
      <nav class="mt-2">
        <ul class="nav nav-pills nav-sidebar flex-column" data-widget="treeview" role="menu" data-accordion="false">
          <!-- Add icons to the links using the .nav-icon class
               with font-awesome or any other icon font library -->
          <li class="nav-item">
            <a href="{{url('dashboard')}}" class="nav-link {{request()->is('*/dashboard')? 'active':''}}">
              <i class="nav-icon fas fa-tachometer-alt"></i>
              <p>
                {{ trans('admin.Dashboard') }}
              </p>
            </a>
          </li>

          {{-- menu-open --}}
          @if (auth('user')->user()->isAbleTo('read-users'))
            <li class="nav-item {{(request()->is('*/dashboard/users') || request()->is('*/dashboard/users/*') || request()->is('*/dashboard/roles') || request()->is('*/dashboard/roles/*'))? 'menu-open':''}}">
              <a href="#" class="nav-link">
                <i class="nav-icon fas fa-tachometer-alt"></i>
                <p>
                  {{ trans('admin.Users Mangement') }}
                  <i class="right fas fa-wreath"></i>
                </p>
              </a>
              <ul class="nav nav-treeview">
                <li class="nav-item">
                  <a href="{{url('dashboard/users')}}" class="nav-link {{(request()->is('*/dashboard/users') || request()->is('*/dashboard/users/*'))? 'active':''}}">
                    <i class="far fa-circle nav-icon"></i>
                    <p>{{ trans('admin.Users') }}</p>
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
          
          @if (auth('user')->user()->super == 1)
            <li class="nav-item">
              <a href="{{url('dashboard/settings/edit')}}" class="nav-link {{request()->is('*/dashboard/settings/edit')? 'active':''}}">
                <i class="nav-icon fas fa-tachometer-alt"></i>
                <p>
                  {{ trans('admin.Settings') }}
                </p>
              </a>
            </li>
          @endif
        </ul>
      </nav>
      <!-- /.sidebar-menu -->
    </div>
    <!-- /.sidebar -->
  </aside>