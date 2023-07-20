@extends('layouts.default')

@section('content')
    @php
        $module = 'Tipe Kamar';
        $fields = [
            [
                'label' => 'Nama',
                'field' => 'title',
            ],
            [
                'label' => 'Description',
                'field' => 'description',
            ],
            [
                'label' => 'Created At',
                'field' => 'created_at',
            ],
            [
                'label' => 'Action',
                'field' => 'action',
            ],
        ];
    @endphp
    <div class="card">
        <h5 class="card-header">{{ $module }}</h5>
        <div class="table-responsive text-wrap px-4 py-2" style="height: 500px;">
            <table class="table">
                <thead>
                    <tr>
                        @foreach ($fields as $item)
                        @if ($item['field'] == "description")
                            <th width="20%">{{ $item['label'] }}</th>
                        @else
                            <th>{{ $item['label'] }}</th>
                        @endif
                        @endforeach
                    </tr>
                </thead>
                <tbody class="table-border-bottom-0">
                    @forelse ($list as $item)
                        <tr>
                            <td><i class="fab fa-angular fa-lg text-danger me-3"></i>
                                <strong>{{ $item->title ?? '-' }}</strong>
                            </td>
                            <td>{{ $item->description }}</td>
                            <td>{{ date('d-m-Y H:i', strtotime($item->created_at)) }}</td>
                            <td>
                                @if (auth()->user()->hasRole(\App\Constants\RoleConst::STAFF))
                                <div class="dropdown">
                                    <button type="button" class="btn p-0 dropdown-toggle hide-arrow"
                                        data-bs-toggle="dropdown"><i class="bx bx-dots-vertical-rounded"></i></button>
                                    <div class="dropdown-menu">
                                        <a class="dropdown-item"
                                            href="{{ route('web.room-type.edit', ['id' => $item->uuid]) }}"><i
                                                class="bx bx-edit-alt me-1"></i>
                                            Edit</a>
                                            <a class="dropdown-item"
                                            href="{{ route('web.room-type.show', ['id' => $item->uuid]) }}"><i
                                                class="bx bx-bullseye me-1"></i>
                                            Detail</a>
                                        <form id="form_delete_{{ $item->uuid }}"
                                            action="{{ route('web.room-type.delete', ['id' => $item->uuid]) }}"
                                            method="POST">
                                            {{ csrf_field() }}
                                            {{ method_field('DELETE') }}
                                        </form>
                                        <a class="dropdown-item" href="javascript:void(0);"
                                            onclick="deleteAction(`{{ $item->uuid }}`, `{{ route('web.room-type.delete', ['id' => $item->uuid]) }}`)"><i
                                                class="bx bx-trash me-1"></i>
                                            Delete</a>
                                    </div>
                                </div>
                                @elseif(auth()->user()->hasRole(\App\Constants\RoleConst::SUPER_ADMIN))
                                <div class="dropdown">
                                    <button type="button" class="btn p-0 dropdown-toggle hide-arrow"
                                        data-bs-toggle="dropdown"><i class="bx bx-dots-vertical-rounded"></i></button>
                                    <div class="dropdown-menu">
                                        <a class="dropdown-item"
                                            href="{{ route('web.room-type.show', ['id' => $item->uuid]) }}"><i
                                                class="bx bx-bullseye me-1"></i>
                                            Detail</a>
                                    </div>
                                </div>
                                @endif
                            </td>
                        </tr>
                    @empty
                        <tr>
                            <td colspan="{{ count($fields) }}" class="text-center">
                                <i class="fab fa-angular fa-lg text-danger me-3"></i> <strong>Not Found
                                    Data {{ $module }}</strong>
                            </td>
                        </tr>
                    @endforelse
                </tbody>
            </table>
            <div class="my-2">
            {{ $list->links("pagination::bootstrap-4") }}
            </div>
        </div>
    </div>
    @if (auth()->user()->hasRole(\App\Constants\RoleConst::STAFF))
    <div class="buy-now">
        <a href="{{ route('web.room-type.create') }}" class="btn btn-danger btn-buy-now">Tambah {{ $module }}</a>
    </div>
    @endif
@endsection
@section('script')
    <script>
        function deleteAction(id, url) {
            Swal.fire({
                title: 'Are you sure?',
                text: "You won't be able to revert this!",
                icon: 'warning',
                showCancelButton: true,
                confirmButtonColor: '#3085d6',
                cancelButtonColor: '#d33',
                confirmButtonText: 'Yes, delete it!'
            }).then((result) => {
                if (result.isConfirmed) {
                    Swal.fire(
                        'Deleted!',
                        'Data has been deleted.',
                        'success'
                    )
                    setTimeout(() => {
                        $('#form_delete_' + id).submit();
                    }, 1000);
                }
            })
        }
    </script>
@endsection
