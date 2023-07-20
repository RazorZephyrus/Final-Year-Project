<!-- Navbar -->
<nav class="layout-navbar container-xxl navbar navbar-expand-xl navbar-detached align-items-center bg-navbar-theme"
    id="layout-navbar">
    <div class="navbar-nav-right d-flex align-items-center" id="navbar-collapse">

        <!-- Search -->
        <div class="navbar-nav align-items-center">
            <div class="nav-item d-flex align-items-center">
                <a href="{{ url('/landing') }}">
                    <i class="bx bxl-bing mb-2"></i>
                    <span class="app-brand-text demo menu-text fw-bolder ms-2">BOOK IT</span>
                </a>
            </div>
        </div>
        <!-- /Search -->

        <ul class="navbar-nav flex-row align-items-center ms-auto">
            @php
                $asrama = \App\Models\Asramas::get();
            @endphp
            <!-- Place this tag where you want the button to render. -->
            <li class="nav-item dropdown lh-1 me-3">
                <a class="nav-link dropdown-toggle navbar-brand" href="javascript:void(0)" id="navbarDropdown"
                    role="button" data-bs-toggle="dropdown" aria-expanded="false">
                    Cari Asrama
                </a>
                <ul class="dropdown-menu" aria-labelledby="navbarDropdown">
                    @foreach ($asrama as $item)
                    <li><a class="dropdown-item" href="{{ route('web.homepage.detail-asrama.front',['id'=>$item->uuid]) }}"><i class='bx bxs-building'></i>{{ $item->title }}</a>
                    </li>
                        
                    @endforeach
                </ul>
                {{-- <a href="#" class="navbar-brand">Cari Asrama</a> --}}
            </li>
            
            <!-- <li class="nav-item lh-1 me-3">
                <a href="{{ url('/list-room') }}" class="navbar-brand">Cari Kamar</a>
            </li> -->

            <li class="nav-item lh-1 me-3">
                <a href="{{ url('/pusat-bantuan') }}" class="navbar-brand">Pusat Bantuan</a>
            </li>

            <li class="nav-item lh-1 me-3">
                <a href="{{ url('/syarat-dan-ketentuan') }}" class="navbar-brand">Syarat dan Ketentuan</a>
            </li>
            @if (auth()->user() != null)
                <!-- User -->
                <li class="nav-item navbar-dropdown dropdown-user dropdown">
                    <a class="nav-link dropdown-toggle hide-arrow" href="javascript:void(0);" data-bs-toggle="dropdown">
                        <div class="avatar avatar-online">
                            <img src="../assets/img/avatars/1.png" alt class="w-px-40 h-auto rounded-circle">
                        </div>
                    </a>
                    <ul class="dropdown-menu dropdown-menu-end">
                        <li>
                            <a class="dropdown-item" href="#">
                                <div class="d-flex">
                                    <div class="flex-shrink-0 me-3">
                                        <div class="avatar avatar-online">
                                            <img src="../assets/img/avatars/1.png" alt
                                                class="w-px-40 h-auto rounded-circle">
                                        </div>
                                    </div>
                                    <div class="flex-grow-1">
                                        <span class="fw-semibold d-block">{{ auth()->user()->name }}</span>
                                        <small class="text-muted">{{ strtoupper(auth()->user()->roles()->first()->name) }}</small>
                                    </div>
                                </div>
                            </a>
                        </li>
                        <li>
                            <div class="dropdown-divider"></div>
                        </li>
                        <li>
                            <a class="dropdown-item"  href="{{ url('user/profile') }}">
                                <i class="bx bx-user me-2"></i>
                                <span class="align-middle">My Profile</span>
                            </a>
                        </li>
                        <li>
                            <a class="dropdown-item"  href="{{ url('/dashboard') }}">
                                <i class="bx bxs-layout me-2"></i>
                                <span class="align-middle">Dashboard</span>
                            </a>
                        </li>
                        <li>
                            <div class="dropdown-divider"></div>
                        </li>
                        <li>
                            <a class="dropdown-item" href="#">
                                <form id="logout-form-do-logout" action="{{ route('logout') }}" method="POST"
                                    style="display: none;">
                                    @csrf
                                </form>
                                <div
                                    onclick="event.preventDefault(); document.getElementById('logout-form-do-logout').submit();">
                                    <i class="bx bx-power-off me-2"></i>
                                    <span class="align-middle" href="{{ route('logout') }}">
                                        Logout
                                    </span>
                                </div>
                            </a>
                        </li>
                    </ul>
                </li>
                <!--/ User -->
            @else
            <li class="nav-item lh-1 me-3">
                <a href="{{ url('login') }}" class="navbar-brand btn btn-outline-primary">Login</a>
            </li>
            @endif
        </ul>
    </div>
</nav>
<!-- / Navbar -->
