@extends('layouts.default')

@section('content')
@php
$module = 'Asrama';
@endphp
<h4 class="fw-bold py-3 mb-4">
    <span class="text-muted fw-light">{{ $module }} /</span> Detail {{ $row->title }}
</h4>
<div class="card mb-4">
    <div class="card-body">
        @include('components.alert.error-field')
        <form method="post" action="{{ route('web.asrama.show', ['id' => $row->uuid]) }}" enctype="multipart/form-data">
            @csrf
            @method('put')
            <div class="row">
                <div class="col-md-6">

                    @include('components.form.input', [
                    'class_group' => 'mb-3',
                    'field_name' => 'title',
                    'label' => 'Nama Asrama',
                    'value' => old('title', $row->title),
                    'placeholder' => 'Nama Asrama',
                    'type' => 'text',
                    'show' => true,
                    'disabled' => true,
                    ])

                    @include('components.form.text_area', [
                    'class_group' => 'mb-3',
                    'field_name' => 'description',
                    'label' => 'Deskripsi',
                    'value' => old('description', $row->description),
                    'placeholder' => 'Deskripsi',
                    'show' => true,
                    'disabled' => true,
                    ])
                    @include('components.form.input', [
                    'class_group' => 'mb-3',
                    'field_name' => 'address',
                    'label' => 'Alamat',
                    'value' => old('address', $row->address),
                    'placeholder' => 'Alamat',
                    'type' => 'text',
                    'show' => true,
                    'disabled' => true,
                    ])

                    @include('components.form.input', [
                    'class_group' => 'mb-3',
                    'field_name' => 'no_kontak',
                    'label' => 'Nomor Kontak',
                    'value' => old('no_kontak', $row->no_kontak),
                    'placeholder' => 'No Kontak Asrama',
                    'type' => 'text',
                    'show' => true,
                    'disabled' => true,
                    ])
                    <div class="row">
                        <div class="col-md-6">
                            @include('components.form.input', [
                            'class_group' => 'mb-3',
                            'field_name' => 'bank',
                            'label' => 'Nama Bank',
                            'value' => old('bank', $row->bank),
                            'placeholder' => 'Nama Bank',
                            'type' => 'text',
                            'show' => true,
                            'disabled' => true,
                            ])
                        </div>
                        <div class="col-md-6">
                            @include('components.form.input', [
                            'class_group' => 'mb-3',
                            'field_name' => 'no_rekening',
                            'label' => 'Nomor Rekening',
                            'value' => old('no_rekening', $row->no_rekening),
                            'placeholder' => 'Nomor Rekening',
                            'type' => 'text',
                            'show' => true,
                            'disabled' => true,
                            ])
                        </div>
                        <!-- <p> Rekening Lainnya</p>
                        <div class="row">
                            <div class="col-md-6">
                                @include('components.form.input', [
                                    'class_group' => 'mb-3',
                                    'field_name' => 'bank',
                                    'label' => 'Nama Bank',
                                    'value' => old('bank', $row->bank),
                                    'placeholder' => 'Nama Bank',
                                    'type' => 'text',
                                    'show' => true,
                                    'disabled' => true,
                                ])
                             </div>
                             <div class="col-md-6">
                                @include('components.form.input', [
                                    'class_group' => 'mb-3',
                                    'field_name' => 'no_rekening',
                                    'label' => 'Nomor Rekening',
                                    'value' => old('no_rekening', $row->no_rekening),
                                    'placeholder' => 'Nomor Rekening',
                                    'type' => 'text',
                                    'show' => true,
                                    'disabled' => true,
                                ])
                             </div>

                        </div>
                        <div class="row">
                            <div class="col-md-6">
                                @include('components.form.input', [
                                    'class_group' => 'mb-3',
                                    'field_name' => 'bank',
                                    'label' => 'Nama Bank',
                                    'value' => old('bank', $row->bank),
                                    'placeholder' => 'Nama Bank',
                                    'type' => 'text',
                                    'show' => true,
                                    'disabled' => true,
                                ])
                             </div>
                             <div class="col-md-6">
                                @include('components.form.input', [
                                    'class_group' => 'mb-3',
                                    'field_name' => 'no_rekening',
                                    'label' => 'Nomor Rekening',
                                    'value' => old('no_rekening', $row->no_rekening),
                                    'placeholder' => 'Nomor Rekening',
                                    'type' => 'text',
                                    'show' => true,
                                    'disabled' => true,
                                ])
                             </div>

                        </div> -->
                    </div>


                    <p><b>Aturan : </b></p>{!! $row->asrama_role !!}

                    <p><b>Informasi Lainnya : </b></p>{!! $row->informasi_lainnya !!}

                </div>
                <div class="col-md-6">
                    <img class="card-img-top" style="height: 450px;" src="{{ url('files') . '?_path=' . $row->image->path }}" alt="Card image cap" />
                </div>
            </div>
            <div class="form-group">
                {{-- <button type="submit" class="btn btn-primary">Simpan</button> --}}
                <a type="button" class="btn btn-secondary" href="{{ route('web.asrama.index') }}">Kembali</a>
            </div>
        </form>
    </div>
    @endsection