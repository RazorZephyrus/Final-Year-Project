@extends('layouts.default')

@section('content')
@php
$module = 'Asrama';
@endphp
<h4 class="fw-bold py-3 mb-4">
    <span class="text-muted fw-light">{{ $module }} /</span> Create New
</h4>
<div class="card mb-4">
    <div class="card-body">
        @include('components.alert.error-field')
        <form method="post" action="{{ route('web.asrama.store') }}" enctype="multipart/form-data">
            @csrf
            <div class="row">
                <div class="col-md-6">

                    @include('components.form.input', [
                    'class_group' => 'mb-3',
                    'field_name' => 'title',
                    'label' => 'Nama Asrama',
                    'value' => '',
                    'placeholder' => 'Nama Asrama',
                    'type' => 'text',
                    'show' => true,
                    'disable' => false,
                    ])

                    @include('components.form.text_area', [
                    'class_group' => 'mb-3',
                    'field_name' => 'description',
                    'label' => 'Description',
                    'value' => old('description', null),
                    'placeholder' => 'Description',
                    'show' => true,
                    'disable' => false,
                    ])

                    @include('components.form.input', [
                    'class_group' => 'mb-3',
                    'field_name' => 'address',
                    'label' => 'Alamat',
                    'value' => '',
                    'placeholder' => 'Alamat',
                    'type' => 'text',
                    'show' => true,
                    'disable' => false,
                    ])

                    @include('components.form.text_area', [
                    'class_group' => 'mb-3',
                    'field_name' => 'lokasi',
                    'label' => 'Lokasi',
                    'value' => old('lokasi', null),
                    'placeholder' => 'Lokasi',
                    'show' => true,
                    'disable' => false,
                    ])

                    @include('components.form.image', [
                    'class_group' => 'mb-3',
                    'field_name' => 'images[]',
                    'label' => 'Gambar',
                    'value' => '',
                    'placeholder' => 'Gambar',
                    'type' => 'text',
                    'show' => true,
                    'disable' => false,
                    'multiple' => true,
                    ])
                </div>
                <div class="col-md-6">
                    @include('components.form.input', [
                    'class_group' => 'mb-3',
                    'field_name' => 'no_kontak',
                    'label' => 'Nomor Kontak',
                    'value' => old('no_kontak', null),
                    'placeholder' => 'No Kontak Asrama',
                    'type' => 'text',
                    'show' => true,
                    'disable' => false,
                    ])
                    <div class="row">
                        <div class="col-md-6">
                            @include('components.form.input', [
                            'class_group' => 'mb-3',
                            'field_name' => 'bank',
                            'label' => 'Nama Bank',
                            'value' => old('bank', null),
                            'placeholder' => 'Nama Bank',
                            'type' => 'text',
                            'show' => true,
                            'disable' => false,
                            ])

                        </div>
                        <div class="col-md-6">
                            @include('components.form.input', [
                            'class_group' => 'mb-3',
                            'field_name' => 'no_rekening',
                            'label' => 'Nomor Rekening',
                            'value' => old('no_rekening', null),
                            'placeholder' => 'Nomor Rekening',
                            'type' => 'text',
                            'show' => true,
                            'disable' => false,
                            ])
                        </div>
                    </div>
                    <br />
                    <!-- <p>Rekening Lainnya</p>
                    <div class="row">
                        <div class="col-md-6">
                            @include('components.form.input', [
                            'class_group' => 'mb-3',
                            'field_name' => 'bank',
                            'label' => 'Nama Bank',
                            'value' => old('bank', null),
                            'placeholder' => 'Nama Bank',
                            'type' => 'text',
                            'show' => true,
                            'disable' => false,
                            ])

                        </div>
                        <div class="col-md-6">
                            @include('components.form.input', [
                            'class_group' => 'mb-3',
                            'field_name' => 'no_rekening',
                            'label' => 'Nomor Rekening',
                            'value' => old('no_rekening', null),
                            'placeholder' => 'Nomor Rekening',
                            'type' => 'text',
                            'show' => true,
                            'disable' => false,
                            ])
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-md-6">
                            @include('components.form.input', [
                            'class_group' => 'mb-3',
                            'field_name' => 'bank',
                            'label' => 'Nama Bank',
                            'value' => old('bank', null),
                            'placeholder' => 'Nama Bank',
                            'type' => 'text',
                            'show' => true,
                            'disable' => false,
                            ])

                        </div>
                        <div class="col-md-6">
                            @include('components.form.input', [
                            'class_group' => 'mb-3',
                            'field_name' => 'no_rekening',
                            'label' => 'Nomor Rekening',
                            'value' => old('no_rekening', null),
                            'placeholder' => 'Nomor Rekening',
                            'type' => 'text',
                            'show' => true,
                            'disable' => false,
                            ])
                        </div>
                    </div> -->
                </div>
                <div class="col-md-12">
                    @include('components.form.html', [
                    'class_group' => 'mb-3',
                    'field_name' => 'asrama_role',
                    'label' => 'Aturan',
                    'value' => old('asrama_role', null),
                    'placeholder' => 'Aturan',
                    'type' => 'text',
                    'show' => true,
                    'disable' => false,
                    ])

                    @include('components.form.html', [
                    'class_group' => 'mb-3',
                    'field_name' => 'informasi_lainnya',
                    'label' => 'Informasi Lainnya',
                    'value' => old('informasi_lainnya', null),
                    'placeholder' => 'Informasi Lainnya',
                    'type' => 'text',
                    'show' => true,
                    'disable' => false,
                    ])
                </div>
            </div>
            <div class="form-group">
                <button type="submit" class="btn btn-primary">Simpan</button>
                <a type="button" class="btn btn-secondary" href="{{ route('web.asrama.index') }}">Batal</a>
            </div>
        </form>
    </div>
    @endsection