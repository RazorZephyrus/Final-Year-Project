<aside id="layout-menu" class="layout-menu menu-vertical menu bg-menu-theme">
    <div class="app-brand demo">
        <a href="/" class="app-brand-link">
            <span class="app-brand-logo demo">
            <img src="{{asset('images/logo.png')}}" alt class="w-px-40 h-auto" />
            </span>
            <span class="app-brand-text demo menu-text fw-bolder ms-2">{{config('app.name')}}</span>
        </a>

        <a href="javascript:void(0);" class="layout-menu-toggle menu-link text-large ms-auto d-block d-xl-none">
            <i class="bx bx-chevron-left bx-sm align-middle"></i>
        </a>
    </div>

    <div class="menu-inner-shadow"></div>

    @include('layouts.includes.menu-roles')

</aside>
