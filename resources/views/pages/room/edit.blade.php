@extends('layouts.default')

@section('content')
    @php
        $module = 'Kamar';
    @endphp
    <h4 class="fw-bold py-3 mb-4">
        <span class="text-muted fw-light">{{ $module }} /</span> Ubah {{ $row->title }}
    </h4>
    <div class="card mb-4">
        <div class="card-body">
            @include('components.alert.error-field')
            <form method="post" action="{{ route('web.room.update', ['id' => $row->uuid]) }}" enctype="multipart/form-data">
                @csrf
                @method('put')
                <div class="row">
                    <div class="col-md-12">

                        @include('components.form.input', [
                            'class_group' => 'mb-3',
                            'field_name' => 'title',
                            'label' => 'Kamar',
                            'value' => old('title', $row->title),
                            'placeholder' => 'Kamar',
                            'type' => 'text',
                            'show' => true,
                            'disable' => false,
                        ])

                        {{-- @include('components.form.image', [
                            'class_group' => 'mb-3',
                            'field_name' => 'images[]',
                            'label' => 'Gambar',
                            'value' => '',
                            'placeholder' => 'Gambar',
                            'type' => 'text',
                            'show' => true,
                            'disable' => false,
                            'multiple' => true,
                        ]) --}}

                        @php
                            if (auth()->user()->hasRole(\App\Constants\RoleConst::STAFF)) {
                                $asrama = \App\Models\Asramas::where('id', auth()->user()->asrama_id)->get();
                                $roomType = \App\Models\RoomType::where('asrama_id', auth()->user()->asrama_id)->get();
                            } else {
                                $asrama = \App\Models\Asramas::get();
                                $roomType = \App\Models\RoomType::get();
                            }
                            $fasilitas = \App\Models\Fasilitas::get();
                        @endphp
                        @include('components.form.select_option', [
                            'class_group' => 'mb-3',
                            'field_name' => 'asrama_id',
                            'label' => 'Asrama',
                            'value' => old('asrama_id', $row->Asrama->uuid),
                            'placeholder' => 'asrama',
                            'options' => $asrama,
                            'key_option_value' => 'uuid',
                            'key_option_label' => 'title',
                            'show' => true,
                            'accept' => null,
                            'disable' => false,
                        ])

                        @include('components.form.select_option', [
                            'class_group' => 'mb-3',
                            'field_name' => 'room_type_id',
                            'label' => 'Room Tipe',
                            'value' => old('room_type_id', $row->RoomType->uuid),
                            'placeholder' => 'Room Tipe',
                            'options' => $roomType,
                            'key_option_value' => 'uuid',
                            'key_option_label' => 'title',
                            'show' => true,
                            'accept' => null,
                            'disable' => false,
                        ])
                        @php
                            $resFas = [];
                            $fas = $row->RoomFasilitas;
                            foreach ($fas as $key => $value) {
                                $resFas[] = $value->Fasilitas->uuid;
                            }
                        @endphp
                        @include('components.form.tag', [
                            'class_group' => 'mb-3',
                            'field_name' => 'fasilitas',
                            'label' => 'Fasilitas',
                            'value' => old('fasilitas', $resFas),
                            'placeholder' => 'Fasilitas',
                            'options' => $fasilitas,
                            'key_option_value' => 'uuid',
                            'key_option_label' => 'title',
                            'show' => true,
                            'accept' => null,
                            'disable' => false,
                        ])

                        @include('components.form.number', [
                            'class_group' => 'mb-3',
                            'field_name' => 'perhari',
                            'label' => 'Harga Per Hari',
                            'value' => old('perhari', number_format($row->perhari, 2, '.', ',')),
                            'placeholder' => 'Harga Perhari',
                            'type' => 'text',
                            'show' => true,
                            'disable' => false,
                            'min' => 0,
                            'max' => 99999999999,
                            'accept' => 'disable-minus',
                            'format' => 'currency'
                        ])

                        @include('components.form.number', [
                            'class_group' => 'mb-3',
                            'field_name' => 'perbulan',
                            'label' => 'Harga Per Bulan',
                            'value' => old('perbulan', number_format($row->perbulan, 2, '.', ',')),
                            'placeholder' => 'Harga Per Bulan',
                            'type' => 'text',
                            'show' => true,
                            'disable' => false,
                            'min' => 0,
                            'max' => 99999999999,
                            'accept' => 'disable-minus',
                            'format' => 'currency'
                        ])

                        @include('components.form.number', [
                            'class_group' => 'mb-3',
                            'field_name' => 'persemester',
                            'label' => 'Harga Per Semester',
                            'value' => old('persemester', number_format($row->persemester, 2, '.', ',')),
                            'placeholder' => 'Harga Per Semester',
                            'type' => 'text',
                            'show' => true,
                            'disable' => false,
                            'min' => 0,
                            'max' => 99999999999,
                            'accept' => 'disable-minus',
                            'format' => 'currency'
                        ])
                        {{-- @include('components.form.select_option', [
                            'class_group' => 'mb-3',
                            'field_name' => 'type_harga',
                            'label' => 'Tipe Harga',
                            'value' => old('type_harga', $row->type_harga),
                            'placeholder' => 'Tipe Harga',
                            'options' => [
                                ['value' => 'Harian', 'label' => 'Harian'],
                                ['value' => 'Mingguan', 'label' => 'Mingguan'],
                                ['value' => 'Bulanan', 'label' => 'Bulanan'],
                                ['value' => 'Semester', 'label' => 'Semester'],
                                ['value' => 'Tahunan', 'label' => 'Tahunan'],
                            ],
                            'key_option_value' => 'value',
                            'key_option_label' => 'label',
                            'show' => true,
                            'accept' => null,
                            'disable' => false,
                        ]) --}}
                    </div>
                </div>
                <div class="form-group">
                    <button type="submit" class="btn btn-primary">Simpan</button>
                    <a type="button" class="btn btn-secondary" href="{{ route('web.room.index') }}">Batal</a>
                </div>
            </form>
        </div>
    @endsection
