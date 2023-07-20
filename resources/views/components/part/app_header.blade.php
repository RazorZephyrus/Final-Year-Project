<div class="page-header d-flex justify-content-between align-items-center">
    {{ $slot }}
    <div class="d-flex  align-items-center">

        <div>
            <a href="{{ route('web.profile.show') }}">
                Profile
            </a>

            <a href="{{ route('logout') }}" onclick="event.preventDefault();
            document.getElementById('logout-form').submit();" class="link-logout ms-1">
                Logout
            </a>


            <form id="logout-form" action="{{ route('logout') }}" method="POST" style="display: none;">
                @csrf
            </form>
        </div>
    </div>
</div>
