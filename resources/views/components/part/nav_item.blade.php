<?php
$is_active = strpos(Route::currentRouteName(), $route_selected) === 0;
?>
<li class="{{ $is_active ? 'active' : '' }}">
    <a href="{{ route($route_name) }}">
        <div class="">{{ $title }}</div>
    </a>
</li>
