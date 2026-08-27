
  <!-- Navbar -->
  <nav class="main-header navbar navbar-expand navbar-white navbar-light">
    <!-- Left navbar links -->
    <ul class="navbar-nav">
      <li class="nav-item">
        <a class="nav-link navbar-toggle" data-widget="pushmenu" href="#" role="button" aria-label="{{ trans('admin.Toggle sidebar') }}">
          <i class="fas fa-bars"></i>
        </a>
      </li>
    </ul>

    <!-- Right navbar links -->
    <ul class="navbar-nav ml-auto">
      <li class="nav-item dropdown">
        <a class="nav-link navbar-lang-link" data-toggle="dropdown" href="#">
          <i class="fas fa-globe"></i>
          <span class="navbar-lang-code">{{ strtoupper(LaravelLocalization::getCurrentLocale()) }}</span>
          <i class="fas fa-chevron-down navbar-user-caret"></i>
        </a>
        <div class="dropdown-menu dropdown-menu-lg dropdown-menu-right">
          @foreach(LaravelLocalization::getSupportedLocales() as $localeCode => $properties)
              <a href="{{ LaravelLocalization::getLocalizedURL($localeCode, null, [], true) }}" class="dropdown-item {{ $localeCode == LaravelLocalization::getCurrentLocale() ? 'dropdown-item-active' : '' }}">
                {{ $properties['native'] }}
                @if ($localeCode == LaravelLocalization::getCurrentLocale())
                  <i class="fas fa-check navbar-lang-check"></i>
                @endif
              </a>
          @endforeach
        </div>
      </li>

      <li class="navbar-divider"></li>

      <li class="nav-item dropdown">
        <a class="nav-link navbar-user-link" data-toggle="dropdown" href="#">
          <img src="{{auth('user')->user()->getImage()}}" class="navbar-user-avatar" alt="{{auth('user')->user()->name}}">
          <span class="navbar-user-name">{{auth('user')->user()->name}}</span>
          <i class="fas fa-chevron-down navbar-user-caret"></i>
        </a>
        <div class="dropdown-menu dropdown-menu-lg dropdown-menu-right">
          <a href="{{route('dashboard.profile.edit')}}" class="dropdown-item">
            <i class="fas fa-user"></i> {{ trans('admin.Profile') }}
          </a>
          <div class="dropdown-divider"></div>
          <a href="{{route('dashboard.logout')}}" class="dropdown-item dropdown-item-danger">
            <i class="fas fa-right-from-bracket"></i> {{ trans('admin.logout') }}
          </a>
        </div>
      </li>
    </ul>
  </nav>
  <!-- /.navbar -->
