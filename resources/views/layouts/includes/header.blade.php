@php
    $user = auth()->user();
    // dd($user);
@endphp

<nav class="layout-navbar container-fluid navbar navbar-expand-xl navbar-detached align-items-center bg-navbar-theme"
    id="layout-navbar">
    <div class="layout-menu-toggle navbar-nav align-items-xl-center me-3 me-xl-0 d-xl-none">
        <a class="nav-item nav-link px-0 me-xl-4" href="javascript:void(0)">
            <i class="bx bx-menu bx-sm"></i>
        </a>
    </div>

    <div class="navbar-nav-right d-flex align-items-center" id="navbar-collapse">

        <ul class="navbar-nav flex-row align-items-center ms-auto">
            <!-- Place this tag where you want the button to render. -->

            <!-- User -->
            <li class="nav-item navbar-dropdown dropdown-user dropdown">
                <a class="nav-link dropdown-toggle hide-arrow" href="javascript:void(0);" data-bs-toggle="dropdown">
                    <div class="avatar avatar-online">
                        {{-- @if (isset(
        auth()->user()->avatar()->first('path')->path,
    ))
                            <img src="{{asset('uploads/'.auth()->user()->avatar()->first('path')->path)}}" alt class="w-80 h-auto rounded-circle" />
                        @else --}}
                        @php
                            $avatar = auth()
                                ->user()
                                ->avatar()
                                ->first();
                            $imagePath = asset('images/avatar-empty.png');
                            if ($avatar != null) {
                                $imagePath = route('web.getfiles') . '?_path=' . $avatar->path;
                            }
                        @endphp
                        <img src="{{ $imagePath }}" alt class="w-80 h-auto rounded-circle" />
                        {{-- @endif --}}
                    </div>
                </a>
                <ul class="dropdown-menu dropdown-menu-end">
                    <li>
                        <a class="dropdown-item" href="#">
                            <div class="d-flex">
                                <div class="flex-shrink-0 me-3">
                                    <div class="avatar avatar-online">
                                        <img src="{{ $imagePath }}" alt
                                            class="w-80 h-auto rounded-circle" />
                                    </div>
                                </div>
                                <div class="flex-grow-1">
                                    <span class="fw-semibold d-block">{{ $user->name }}</span>
                                    <small class="text-muted">{{ $user->email }}</small>
                                </div>
                            </div>
                        </a>
                    </li>
                    <li>
                        <div class="dropdown-divider"></div>
                    </li>
                    <li>
                        <a class="dropdown-item" href="{{ url('user/profile') }}">
                            <i class="bx bx-home-smile me-2"></i>
                            <span class="align-middle">My Profile</span>
                        </a>
                    </li>
                    <li>
                        <a class="dropdown-item"  href="{{ url('/landing') }}">
                            <i class="bx bxs-layout me-2"></i>
                            <span class="align-middle">Home</span>
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
        </ul>
    </div>
</nav>
