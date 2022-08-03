
  <!-- Navbar -->
  <nav class="main-header navbar navbar-expand navbar-white navbar-light">
    <!-- Left navbar links -->
    <ul class="navbar-nav">
      <li class="nav-item">
        <a class="nav-link" data-widget="pushmenu" href="#" role="button"><i class="fas fa-bars"></i></a>
      </li>
      <li class="nav-item d-none d-sm-inline-block">
        <a href="{{url('dashboard')}}" class="nav-link">{{ trans('admin.Home') }}</a>
      </li>
    </ul>

    <!-- Right navbar links -->
    <ul class="navbar-nav ml-auto">
      <li class="nav-item dropdown">
        <a class="nav-link" data-toggle="dropdown" href="#">
          <i class="fas fa-th-large"></i>
        </a>
        <div class="dropdown-menu dropdown-menu-lg dropdown-menu-right">
          @foreach(LaravelLocalization::getSupportedLocales() as $localeCode => $properties)
              <a href="{{ LaravelLocalization::getLocalizedURL($localeCode, null, [], true) }}" class="dropdown-item">
                {{ $properties['native'] }}
              </a>
          @endforeach
        </div>
      </li>

      <li class="nav-item dropdown">
        <a class="nav-link" data-toggle="dropdown" href="#">
          <div style=" position: relative;top: -10px;">
            <img src="{{auth('admin')->user()->getImage()}}" style="width: 41px;" class="img-circle" alt="User Image">
            {{auth('admin')->user()->username}}
          </div>
        </a>
        <div class="dropdown-menu dropdown-menu-lg dropdown-menu-right">
          <a href="{{url('dashboard/logout')}}" class="dropdown-item">
            {{ trans('admin.logout') }}
          </a>
        </div>
      </li>
    </ul>
  </nav>
  <!-- /.navbar -->