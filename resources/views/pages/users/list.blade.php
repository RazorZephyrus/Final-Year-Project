@extends('layouts.default')

@section('content')
    @php
        $module = 'Pengguna';
        $fields = [
            [
                'label' => 'Name',
                'field' => 'name',
            ],
            [
                'label' => 'Username',
                'field' => 'Username',
            ],
            [
                'label' => 'Email',
                'field' => 'email',
            ],
            [
                'label' => 'Roles',
                'field' => 'roles',
            ],
            [
                'label' => 'Active',
                'field' => 'is_enabled',
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
        <div class="table-responsive text-nowrap px-4 py-2" style="height: 600px;">
            <table class="table">
                <thead>
                    <tr>
                        @foreach ($fields as $item)
                            <th>{{ $item['label'] }}</th>
                        @endforeach
                    </tr>
                </thead>
                <tbody class="table-border-bottom-0">
                    @forelse ($list as $item)
                        <tr>
                            <td><i class="fab fa-angular fa-lg text-danger me-3"></i>
                                <strong>{{ $item->name ?? '-' }}</strong>
                            </td>
                            <td>{{ $item->username }}</td>
                            <td>{{ $item->email }}</td>
                            <td>{{ strtoupper($item->roles[0]->name) }}</td>
                            <td>{{ $item->is_enabled == 1 ? 'Active' : 'Inactive'  }}</td>
                            <td>{{ date('d-m-Y', strtotime($item->created_at)) }}</td>
                            <td>
                                <div class="dropdown">
                                    <button type="button" class="btn p-0 dropdown-toggle hide-arrow"
                                        data-bs-toggle="dropdown"><i class="bx bx-dots-vertical-rounded"></i></button>
                                    <div class="dropdown-menu">
                                        <a class="dropdown-item"
                                            href="{{ route('web.users.edit', ['id' => $item->uuid]) }}"><i
                                                class="bx bx-edit-alt me-1"></i>
                                            Edit</a>
                                        <form id="form_delete_{{ $item->uuid }}"
                                            action="{{ route('web.users.delete', ['id' => $item->uuid]) }}"
                                            method="POST">
                                            {{ csrf_field() }}
                                            {{ method_field('DELETE') }}
                                        </form>
                                        <a class="dropdown-item" href="javascript:void(0);"
                                            onclick="deleteAction(`{{ $item->uuid }}`, `{{ route('web.users.delete', ['id' => $item->uuid]) }}`)"><i
                                                class="bx bx-trash me-1"></i>
                                            Delete</a>
                                    </div>
                                </div>
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
    <div class="buy-now">
        <a href="{{ route('web.users.create') }}" class="btn btn-danger btn-buy-now">Tambah {{ $module }}</a>
    </div>
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
