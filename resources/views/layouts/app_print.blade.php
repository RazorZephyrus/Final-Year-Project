<!doctype html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">

<head>
    @component('components.part.app_head')@endcomponent
</head>

<body class="body-print">
    @yield('content')
    
    @yield('modal')
    @yield('script')
</body>

</html>