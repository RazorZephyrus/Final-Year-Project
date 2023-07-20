@extends('layouts.default')

@section('content')
    @php
        $module = 'Users';
    @endphp
    <h4 class="fw-bold py-3 mb-4">
        <span class="text-muted fw-light">{{ $module }} /</span> Ubah {{ $row->title }}
    </h4>
    <div class="card mb-4">
        <div class="card-body">
            @include('components.alert.error-field')
            <form method="post" action="{{ route('web.users.update', ['id' => $row->uuid]) }}" enctype="multipart/form-data">
                @csrf
                @method('put')
                <div class="row">
                    <div class="col-md-6">
                        @include('components.form.input', [
                            'class_group' => 'mb-3',
                            'field_name' => 'name',
                            'label' => 'Fullname',
                            'value' => old('name', $row->name),
                            'placeholder' => 'Fullname',
                            'show' => true,
                            'disable' => false,
                        ])

                        @include('components.form.input', [
                            'class_group' => 'mb-3',
                            'field_name' => 'username',
                            'label' => 'Username',
                            'value' => old('username', $row->username),
                            'placeholder' => 'Username',
                            'show' => true,
                            'disable' => false,
                        ])

                        @include('components.form.input', [
                            'class_group' => 'mb-3',
                            'field_name' => 'email',
                            'label' => 'Email',
                            'value' => old('email', $row->email),
                            'placeholder' => 'email',
                            'type' => 'email',
                            'show' => true,
                            'disable' => false,
                        ])

                        @include('components.form.select_option', [
                            'class_group' => 'mb-3',
                            'field_name' => 'role',
                            'label' => 'Role',
                            'value' => old('role', $row->roles[0]->name),
                            'placeholder' => '',
                            'options' => \DB::Table('roles')->get(),
                            'key_option_value' => 'name',
                            'key_option_label' => 'name',
                            'show' => true,
                            'disable' => false,
                        ])

                        @include('components.form.select_option', [
                            'class_group' => 'mb-3',
                            'field_name' => 'asrama_id',
                            'label' => 'Asrama',
                            'value' => old('asrama_id', $row->asrama->uuid ?? null),
                            'placeholder' => '',
                            'options' => \DB::Table('asrama')->whereNull('deleted_at')->get(),
                            'key_option_value' => 'uuid',
                            'key_option_label' => 'title',
                            'show' => true,
                            'disable' =>
                                $row->roles[0]->name == 'student' or
                                ($row->roles[0]->name == 'super-admin' ? true : false),
                        ])
                    </div>
                    <div class="col-md-6">

                        @include('components.form.input', [
                            'class_group' => 'mb-3',
                            'field_name' => 'nik',
                            'label' => 'nik',
                            'value' => old('nik', $row->nik),
                            'placeholder' => 'NIK',
                            'show' => true,
                            'disable' => false,
                        ])

                        @include('components.form.select_option', [
                            'class_group' => 'mb-3',
                            'field_name' => 'gender',
                            'label' => 'gender',
                            'value' => old('gender', $row->gender),
                            'placeholder' => 'Gender',
                            'show' => true,
                            'options' => [
                                ['label' => 'Laki-laki', 'value' => 'L'],
                                ['label' => 'Perempuan', 'value' => 'P'],
                            ],
                            'key_option_value' => 'value',
                            'key_option_label' => 'label',
                            'required' => true,
                            'disable' => false,
                            'accept' => null,
                        ])

                        @include('components.form.input', [
                            'class_group' => 'mb-3',
                            'field_name' => 'fakultas',
                            'label' => 'Fakultas',
                            'value' => old('fakultas', $row->fakultas),
                            'placeholder' => 'Fakultas',
                            'show' => true,
                            'disable' => false,
                        ])

                        @include('components.form.input', [
                            'class_group' => 'mb-3',
                            'field_name' => 'password',
                            'label' => 'Password',
                            'value' => '',
                            'placeholder' => 'Password',
                            'type' => 'password',
                            'show' => true,
                            'disable' => false,
                        ])

                        @include('components.form.input', [
                            'class_group' => 'mb-3',
                            'field_name' => 'password_confirm',
                            'label' => 'Password Confirm',
                            'value' => '',
                            'placeholder' => 'Password Confirm',
                            'type' => 'password',
                            'show' => true,
                            'disable' => false,
                        ])

                        @include('components.form.select_option', [
                            'class_group' => 'mb-3',
                            'field_name' => 'is_enabled',
                            'label' => 'is_enabled',
                            'value' => old('is_enabled', $row->is_enabled),
                            'placeholder' => 'is_enabled',
                            'show' => true,
                            'options' => [
                                ['label' => 'Active', 'value' => 1],
                                ['label' => 'Inactive', 'value' => 0],
                            ],
                            'key_option_value' => 'value',
                            'key_option_label' => 'label',
                            'required' => true,
                            'disable' => false,
                            'accept' => null,
                        ])
                    </div>
                </div>
                <div class="form-group">
                    <button type="submit" class="btn btn-primary">Save</button>
                    <a type="button" class="btn btn-secondary" href="{{ route('web.users.index') }}">Cancel</a>
                </div>
            </form>
        </div>
    @endsection
    @section('script')
        @parent
        <script>
            $('#role').on('change', function() {
                if (this.value == 'student' || this.value == 'super-admin') {
                    $('#asrama_id').prop('disabled', 'disabled')
                } else {
                    $('#asrama_id').prop('disabled', false)
                }
            });
        </script>
    @endsection
