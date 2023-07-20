<div class="dropdown">
    <button
        class="btn btn-secondary dropdown-toggle"
        type="button"
        id="dropdownMenuButton-{{ $row->uuid }}"
        data-bs-toggle="dropdown"
        aria-haspopup="true"
        aria-expanded="false">
        Options
    </button>
    <div class="dropdown-menu" aria-labelledby="dropdownMenuButton-{{ $row->uuid }}">
        <a class="dropdown-item" href="{{ route($route . '.edit', $row->uuid) }}">
            <i class="bx bx-pencil me-2"></i>Edit
        </a>
        @if($row->is_enabled)
            <a class="dropdown-item cursor-pointer" onclick="document.getElementById('set-status-row-{{ $row->uuid }}').submit()">
                <i class="bx bx-dislike me-2"></i>Disabled
            </a>
            <form method="post" id="set-status-row-{{ $row->uuid }}" action="{{ route($route . '.setStatus', [$row->uuid, 'disabled']) }}">
                @csrf
            </form>
        @else
            <a class="dropdown-item cursor-pointer" onclick="document.getElementById('set-status-row-{{ $row->uuid }}').submit()">
                <i class="bx bx-like me-2"></i>Enabled
            </a>
            <form method="post" id="set-status-row-{{ $row->uuid }}" action="{{ route($route . '.setStatus', [$row->uuid, 'enabled']) }}">
                @csrf
            </form>
        @endif
        {{-- <div class="dropdown-divider"></div>
        <a class="dropdown-item bg-danger text-white cursor-pointer" onclick="document.getElementById('delete-row-{{ $row->uuid }}').submit()">
            <i class="bx bx-trash me-2"></i>Delete
        </a>
        <form method="post" id="delete-row-{{ $row->uuid }}" action="{{ route($route . '.delete', $row->uuid) }}">
            @csrf
            @method('delete')
        </form> --}}
    </div>
</div>
