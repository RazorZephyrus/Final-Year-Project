<!doctype html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">

<head>
    @component('components.part.app_head')@endcomponent
</head>

<body >
    <div>
        @component('components.part.app_main_menu')@endcomponent
        

        <main class="page-main-content with-nav">
            <div class="px-3">
                @yield('content')
            </div>
        </main>
    </div>


    @yield('modal')
    @yield('script')
</body>

</html>
