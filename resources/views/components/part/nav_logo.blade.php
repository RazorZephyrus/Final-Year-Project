<?php
$is_active = strpos(Route::currentRouteName(), 'web.dashboard') === 0;
?>
 <div class="app-logo {{$is_active ? 'active' : ''}}">
    <a href="{{ route('web.dashboard') }}" >
         Logo
    </a>
</div>
 