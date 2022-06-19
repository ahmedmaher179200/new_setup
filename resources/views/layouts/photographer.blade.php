
@include('photographers.includes.header')

@include('admins.includes.ajax')

@include('photographers.includes._navbar')

@include('photographers.includes._aside')

@yield('content')

@include('photographers.partials._session')

@stack('char')

@include('photographers.includes._footer')
