@php
$auth = auth()->user();
$authRole = $auth->roles[0]?->name;
@endphp
@if ($authRole == \App\Constants\RoleConst::SUPER_ADMIN)
<ul class="menu-inner py-1">
    <li class="menu-item {{ Route::currentRouteName() == 'web.dashboard' ? 'active' : null }}">
        <a href="{{ url('/dashboard') }}" class="menu-link">
            <i class="menu-icon tf-icons bx bx-home-circle"></i>
            <div data-i18n="Analytics">Beranda</div>
        </a>
    </li>

    <li class="menu-header small text-uppercase"><span class="menu-header-text">Manajemen</span></li>
    <!-- Cards -->
    <li class="menu-item">
        <a href="{{ route('web.users.index') }}" class="menu-link">
            <i class="menu-icon tf-icons bx bx-user"></i>
            <div data-i18n="Basic">Pengguna</div>
        </a>
    </li>
    <li class="menu-item">
        <a href="{{ route('web.asrama.index') }}" class="menu-link">
            <i class="menu-icon tf-icons bx bx-buildings"></i>  
            <div data-i18n="Basic">Asrama</div>
        </a>
    </li>
    <li class="menu-item">
        <a href="{{ route('web.room.index') }}" class="menu-link">
            <i class="menu-icon tf-icons bx bx-home-circle"></i>
            <div data-i18n="Basic">Kamar</div>
        </a>
    </li>
    <li class="menu-item">
        <a href="{{ route('web.room-type.index') }}" class="menu-link">
            <i class="menu-icon tf-icons bx bx-bed"></i>
            <div data-i18n="Basic">Tipe Kamar</div>
        </a>
    </li>
    <li class="menu-item">
        <a href="{{ route('web.fasilitas.index') }}" class="menu-link">
            <i class="menu-icon tf-icons bx bx-wifi"></i>
            <div data-i18n="Basic">Fasilitas</div>
        </a>
    </li>

    {{-- <li class="menu-header small text-uppercase"><span class="menu-header-text">Pengelolaan</span></li>

    <li class="menu-item">
        <a href="{{ route('web.pesanan.index') }}" class="menu-link">
            <i class="menu-icon tf-icons bx bx-home-circle"></i>
            <div data-i18n="Basic">Pesanan</div>
        </a>
    </li> --}}

</ul>
@elseif ($authRole == \App\Constants\RoleConst::STUDENT)
<ul class="menu-inner py-1">
    <li class="menu-item {{ Route::currentRouteName() == 'web.dashboard' ? 'active' : null }}">
        <a href="{{ url('/dashboard') }}" class="menu-link">
            <i class="menu-icon tf-icons bx bx-home-circle"></i>
            <div data-i18n="Analytics">Beranda</div>
        </a>
    </li>

    <li class="menu-header small text-uppercase"><span class="menu-header-text">Kelola Akun</span></li>
    <!-- Cards -->
    <li class="menu-item">
        <a href="{{ route('web.profile.index') }}" class="menu-link">
            <i class="menu-icon tf-icons bx bxs-face"></i>
            <div data-i18n="Basic">Profil</div>
        </a>
    </li>
    <li class="menu-item">
        <a href="{{ route('web.pesanan-saya.index', ['is_student' => true]) }}" class="menu-link">
            <i class="menu-icon tf-icons bx bx-home-circle"></i>
            <div data-i18n="Basic">Kamar Saya</div>
        </a>
    </li>
    @php
        $totalBooking = \App\Models\Booking::where('user_id', auth()->user()->id)->where('status', 2)->count();
    @endphp
    <li class="menu-item">
        <a href="{{ route('web.pesanan.index') }}" class="menu-link">
            <i class="menu-icon tf-icons bx bx-book-content"></i>
            <div data-i18n="Basic">Riwayat Booking 
                @if ($totalBooking > 0)
                <span
                class="badge rounded-pill badge-center h-px-20 w-px-20 bg-danger">{{ $totalBooking }}</span>
                @endif
            </div>
        </a>
    </li>
    {{-- <li class="menu-item">
        <a href="#" class="menu-link">
            <i class="menu-icon tf-icons bx bx-wallet"></i>
            <div data-i18n="Basic">Riwayat Transaksi</div>
        </a>
    </li> --}}
</ul>
@elseif ($authRole == \App\Constants\RoleConst::STAFF)
<ul class="menu-inner py-1">
    <li class="menu-item {{ Route::currentRouteName() == 'web.dashboard' ? 'active' : null }}">
        <a href="{{ url('/dashboard') }}" class="menu-link">
            <i class="menu-icon tf-icons bx bx-home-circle"></i>
            <div data-i18n="Analytics">Beranda</div>
        </a>
    </li>

    <li class="menu-header small text-uppercase"><span class="menu-header-text">Manajemen</span></li>
    <!-- Cards -->
    <li class="menu-item">
        <a href="{{ route('web.asrama.index') }}" class="menu-link">
            <i class="menu-icon tf-icons bx bx-buildings"></i>  
            <div data-i18n="Basic">Asrama</div>
        </a>
    </li>
    <li class="menu-item">
        <a href="{{ route('web.room.index') }}" class="menu-link">
            <i class="menu-icon tf-icons bx bx-home-circle"></i>
            <div data-i18n="Basic">Kamar</div>
        </a>
    </li>
    <li class="menu-item">
        <a href="{{ route('web.room-type.index') }}" class="menu-link">
            <i class="menu-icon tf-icons bx bx-bed"></i>
            <div data-i18n="Basic">Tipe Kamar</div>
        </a>
    </li>
    <li class="menu-item">
        <a href="{{ route('web.fasilitas.index') }}" class="menu-link">
            <i class="menu-icon tf-icons bx bx-wifi"></i>
            <div data-i18n="Basic">Fasilitas</div>
        </a>
    </li>
   

    <li class="menu-header small text-uppercase"><span class="menu-header-text">Pengelolaan</span></li>

    <li class="menu-item">
        <a href="{{ route('web.pesanan.index') }}" class="menu-link">
            <i class="menu-icon tf-icons bx bx-home-circle"></i>
            <div data-i18n="Basic">Pesanan</div>
        </a>
    </li>

</ul>
@else
<ul class="menu-inner py-1">
    <li class="menu-item {{ Route::currentRouteName() == 'web.dashboard' ? 'active' : null }}">
        <a href="{{ url('/dashboard') }}" class="menu-link">
            <i class="menu-icon tf-icons bx bx-home-circle"></i>
            <div data-i18n="Analytics">Beranda</div>
        </a>
    </li>

    
</ul>
@endif