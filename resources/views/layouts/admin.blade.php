
@include('admins.includes.header')

@include('admins.includes.navbar')

@include('admins.includes.aside')

<div class="content-wrapper">
    @yield('content')
</div>

@include('admins.includes.footer')

@include('admins.partials._session')

