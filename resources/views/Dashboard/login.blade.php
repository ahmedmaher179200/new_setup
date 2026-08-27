<!DOCTYPE html>
<html lang="{{ app()->getLocale() }}" dir="{{ app()->getLocale() == 'ar' ? 'rtl' : 'ltr' }}">
<head>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <title>Login</title>

  <!-- Fonts -->
  <link rel="stylesheet" href="https://fonts.googleapis.com/css2?family=Inter:wght@400;500;600;700;800&display=swap">
  @if (app()->getLocale() == 'ar')
    <link rel="stylesheet" href="https://fonts.googleapis.com/css2?family=Cairo:wght@400;600;700;800&display=swap">
  @endif
  <!-- Font Awesome -->
  <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/@fortawesome/fontawesome-free@6.5.1/css/all.min.css">
  <!-- App theme -->
  <link rel="stylesheet" href="{{ asset('assets/admin/css/theme.css') }}">
</head>
<body class="hold-transition login-page">
  <div class="login-orb login-orb-1"></div>
  <div class="login-orb login-orb-2"></div>

  <div class="login-box">
    <div class="login-logo">
      <span class="login-brand-icon">{{ mb_substr(getSiteName(), 0, 1) }}</span>
      <a>{{ getSiteName() }}</a>
      <p class="login-brand-sub">{{ trans('admin.Login') }}</p>
    </div>
    <!-- /.login-logo -->

    <div class="card login-card">
      <div class="card-body login-card-body">

        @if (session('error'))
          <div class="alert alert-danger py-2 mb-3">username or password is wrong</div>
        @endif

        <form action="" method="post">
          @csrf

          <div class="form-group login-field">
            <label>{{ trans('admin.Username') }}</label>
            <div class="login-input">
              <i class="fas fa-user"></i>
              <input type="text" class="form-control" placeholder="username" name="username" autocomplete="username" required autofocus>
            </div>
          </div>

          <div class="form-group login-field">
            <label>{{ trans('admin.Password') }}</label>
            <div class="login-input">
              <i class="fas fa-lock"></i>
              <input type="password" class="form-control" placeholder="••••••••" name="password" id="loginPassword" autocomplete="current-password" required>
              <button type="button" class="login-input-toggle" id="toggleLoginPassword" aria-label="Show password">
                <i class="fas fa-eye"></i>
              </button>
            </div>
          </div>

          <button type="submit" class="btn btn-primary btn-block login-submit">
            {{ trans('admin.Sign In') }}
          </button>
        </form>
      </div>
      <!-- /.login-card-body -->
    </div>

    <p class="login-footnote">&copy; {{ date('Y') }} {{ getSiteName() }}</p>
  </div>
  <!-- /.login-box -->

  <!-- jQuery -->
  <script src="https://code.jquery.com/jquery-3.6.4.min.js"></script>
  <script>
    document.getElementById('toggleLoginPassword').addEventListener('click', function () {
      var input = document.getElementById('loginPassword');
      var icon = this.querySelector('i');
      var isHidden = input.type === 'password';
      input.type = isHidden ? 'text' : 'password';
      icon.classList.toggle('fa-eye', !isHidden);
      icon.classList.toggle('fa-eye-slash', isHidden);
    });
  </script>
</body>
</html>
