@extends('layouts.default')

@section('content')
    @php
        $module = 'Users';
    @endphp
    <h4 class="fw-bold py-3 mb-4">
        <span class="text-muted fw-light">{{ $module }} /</span> Create New
    </h4>
    <div class="card mb-4">
        <div class="card-body">
            @include('components.alert.error-field')
            <form method="post" action="{{ route('web.users.store') }}" enctype="multipart/form-data" autocomplete="off">
                @csrf
                <div class="row">
                    <div class="col-md-6">
                        @include('components.form.input', [
                            'class_group' => 'mb-3',
                            'field_name' => 'name',
                            'label' => 'Fullname',
                            'value' => old('name', null),
                            'placeholder' => 'Fullname',
                            'show' => true,
                            'disable' => false,
                        ])

                        @include('components.form.input', [
                            'class_group' => 'mb-3',
                            'field_name' => 'username',
                            'label' => 'Username',
                            'value' => old('username', null),
                            'placeholder' => 'Username',
                            'show' => true,
                            'disable' => false,
                        ])

                        @include('components.form.input', [
                            'class_group' => 'mb-3',
                            'field_name' => 'email',
                            'label' => 'Email',
                            'value' => old('email', null),
                            'placeholder' => 'email',
                            'type' => 'email',
                            'show' => true,
                            'disable' => false,
                        ])

                        @include('components.form.select_option', [
                            'class_group' => 'mb-3',
                            'field_name' => 'role',
                            'label' => 'Role',
                            'value' => 0,
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
                            'value' => 0,
                            'placeholder' => '',
                            'options' => \DB::Table('asrama')->whereNull('deleted_at')->get(),
                            'key_option_value' => 'uuid',
                            'key_option_label' => 'title',
                            'show' => true,
                            'disable' => false,
                        ])
                    </div>
                    <div class="col-md-6">

                        @include('components.form.input', [
                            'class_group' => 'mb-3',
                            'field_name' => 'nik',
                            'label' => 'nik',
                            'value' => old('nik', null),
                            'placeholder' => 'NIK',
                            'show' => true,
                            'disable' => false,
                        ])

                        @include('components.form.select_option', [
                            'class_group' => 'mb-3',
                            'field_name' => 'gender',
                            'label' => 'gender',
                            'value' => old('gender'),
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
                            'value' => old('fakultas', null),
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
                            'value' => old('is_enabled'),
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
                    $('#nik').prop('disabled', false)
                    $('#fakultas').prop('disabled', false)
                } else {
                    $('#nik').prop('disabled', 'disabled')
                    $('#fakultas').prop('disabled', 'disabled')
                    $('#asrama_id').prop('disabled', false)
                   
                }
            });
        </script>
    @endsection
