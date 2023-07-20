@extends('layouts.default')

@section('content')
    @php
        $module = 'Settings';
    @endphp
    <div class="card">
        <h5 class="card-header">{{ $module }}</h5>
        <div class="card-body">
            @include('components.alert.error-field')
            <form method="post" action="{{ route('web.settings.update', ['id' => $list[0]->uuid]) }}"
                enctype="multipart/form-data">
                @csrf
                @method('put')
                <input type="hidden" name="slug" value="{{ $list[0]->slug }}">
                <div class="row">
                    <div class="col-6">
                        @include('components.form.input', [
                            'class_group' => 'mb-3',
                            'field_name' => 'value',
                            'label' => 'Absensi Reward',
                            'value' => old('value', $list[0]->value),
                            'placeholder' => 'value',
                            'show' => true,
                            'disable' => false,
                        ])
                    </div>
                </div>
                <div class="form-group">
                    <button type="submit" class="btn btn-primary">Save</button>
                </div>
            </form>
            <form method="post" action="{{ route('web.settings.update', ['id' => $list[1]->uuid]) }}"
                enctype="multipart/form-data">
                @csrf
                @method('put')
                <input type="hidden" name="slug" value="{{ $list[1]->slug }}">
                <div class="row">
                    <div class="col-6">
                        @include('components.form.input', [
                            'class_group' => 'mb-3',
                            'field_name' => 'value',
                            'label' => 'Lembur Fee',
                            'value' => old('value', $list[1]->value),
                            'placeholder' => 'value',
                            'show' => true,
                            'disable' => false,
                        ])
                    </div>
                </div>
                <div class="form-group">
                    <button type="submit" class="btn btn-primary">Save</button>
                </div>
            </form>
        </div>
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
