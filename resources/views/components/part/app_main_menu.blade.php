<div class="app-toggle-main-menu">
    <div class=" d-flex  justify-content-between align-items-center">
        <a href="#">Toggle Menu</a>
    </div>
</div>
<div class="app-main-menu">

    @component('components.part.nav_logo')
    @endcomponent

    <ul class="list-unstyled list-menu">
        <?php
        $user = auth()->user();
        $permission = \App\Constants\PermissionConst::class;
        $menus = [
            [
                'route_selected' => 'web.dashboard',
                'route_name' => 'web.dashboard',
                'title' => 'Beranda',
                'permission' => null,
            ],
        ];
        ?>
        @foreach ($menus as $item)
            {{-- @if ($item['permission']) --}}
            @component('components.part.nav_item', $item)
            @endcomponent
            {{-- @endif --}}
        @endforeach

    </ul>
</div>
