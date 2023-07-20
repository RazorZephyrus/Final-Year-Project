@extends('layouts.default')

@section('content')
    @php
        $module = 'Paid Kamar Anda';
    @endphp
    <h4 class="fw-bold py-3 mb-4">
        <span class="text-muted fw-light">{{ $module }} /</span> Bayar {{ $row->Room->title }}
    </h4>
    <div class="card mb-4">
        <div class="card-body">
            @include('components.alert.error-field')
            <form method="post" action="{{ route('web.pesanan.update', ['id' => $row->uuid]) }}"
                enctype="multipart/form-data">
                @csrf
                @method('put')
                <div class="row">
                    <div class="col-md-6">

                        @include('components.form.input', [
                            'class_group' => 'mb-3',
                            'field_name' => 'asrama',
                            'label' => 'Nama Asrama',
                            'value' => old('asrama', $row->Room->Asrama->title),
                            'placeholder' => 'Nama Asrama',
                            'type' => 'text',
                            'show' => true,
                            'disabled' => true,
                        ])

                        @include('components.form.input', [
                            'class_group' => 'mb-3',
                            'field_name' => 'room',
                            'label' => 'Room',
                            'value' => old('room', $row->Room->title),
                            'placeholder' => 'Room',
                            'type' => 'text',
                            'show' => true,
                            'disabled' => true,
                        ])

                        @include('components.form.input', [
                            'class_group' => 'mb-3',
                            'field_name' => 'harga_kamar',
                            'label' => 'Harga Sewa',
                            'value' => old(
                                'harga_kamar',
                                number_format($row->Room[$row['type_harga']], 2, '.', ',')),
                            'placeholder' => 'Total Dibayarkan',
                            'type' => 'text',
                            'show' => true,
                            'disabled' => true,
                            'min' => 0,
                            'max' => 9999999999,
                            'accept' => 'disable-minus',
                        ])

                        @include('components.form.input', [
                            'class_group' => 'mb-3',
                            'field_name' => 'length_of_stay',
                            'label' => 'Lama Tinggal',
                            'value' => old(
                                'length_of_stay',
                                $row->length_of_stay),
                            'placeholder' => 'Total Dibayarkan',
                            'type' => 'text',
                            'show' => true,
                            'disabled' => true,
                            'min' => 0,
                            'max' => 9999999999,
                            'accept' => 'disable-minus',
                        ])
                        <div class="row">
                            <div class="col-md-6">
                                @include('components.form.input', [
                                    'class_group' => 'mb-3',
                                    'field_name' => 'bank',
                                    'label' => 'Nama Bank',
                                    'value' => old('no_rekening', $row->Room->Asrama->bank),
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
                                    'value' => old('no_rekening', $row->Room->Asrama->no_rekening),
                                    'placeholder' => 'Nomor Rekening',
                                    'type' => 'text',
                                    'show' => true,
                                    'disabled' => true,
                                ])
                            </div>
                        </div>

                        @include('components.form.input', [
                            'class_group' => 'mb-3',
                            'field_name' => 'type_harga',
                            'label' => 'Yang Harus Dibayarkan',
                            'value' => old('type_harga', number_format($row->total_price, 2, '.', ',')),
                            'placeholder' => 'Yang Harus Dibayarkan',
                            'type' => 'text',
                            'show' => true,
                            'disabled' => true,
                            'min' => 0,
                            'max' => 9999999999,
                            'accept' => 'disable-minus',
                        ])

                    </div>
                    <div class="col-md-6">
                        
                        @include('components.form.input', [
                            'class_group' => 'mb-3',
                            'field_name' => 'nik',
                            'label' => 'NIK',
                            'value' => old('nik', $row->User->nik),
                            'placeholder' => 'NIK',
                            'type' => 'text',
                            'show' => true,
                            'disabled' => true,
                        ])

                        @include('components.form.input', [
                            'class_group' => 'mb-3',
                            'field_name' => 'fakultas',
                            'label' => 'Fakultas',
                            'value' => old('fakultas', $row->User->fakultas),
                            'placeholder' => 'Fakultas',
                            'type' => 'text',
                            'show' => true,
                            'disabled' => true,
                        ])

                        @include('components.form.input', [
                            'class_group' => 'mb-3',
                            'field_name' => 'pemesan',
                            'label' => 'Pemesan',
                            'value' => old('pemesan', $row->User->name),
                            'placeholder' => 'Pemesan',
                            'type' => 'text',
                            'show' => true,
                            'disabled' => true,
                        ])

                        @include('components.form.input', [
                            'class_group' => 'mb-3',
                            'field_name' => 'email',
                            'label' => 'Email',
                            'value' => old('pemesan', $row->User->email),
                            'placeholder' => 'Email',
                            'type' => 'text',
                            'show' => true,
                            'disabled' => true,
                        ])

                        @include('components.form.input', [
                            'class_group' => 'mb-3',
                            'field_name' => 'length_of_stay',
                            'label' => 'Jenis Sewa',
                            'value' => old(
                                'length_of_stay',
                                $row->type_harga),
                            'placeholder' => 'Total Dibayarkan',
                            'type' => 'text',
                            'show' => true,
                            'disabled' => true,
                            'min' => 0,
                            'max' => 9999999999,
                            'accept' => 'disable-minus',
                        ])
                        
                        @if ($row->status == 0)
                            @include('components.form.image', [
                                'class_group' => 'mb-3',
                                'field_name' => 'image',
                                'label' => 'Bukti Pembayaran',
                                'value' => '',
                                'placeholder' => 'Bukti Pembayaran',
                                'type' => 'text',
                                'show' => true,
                                'disable' => false,
                                'multiple' => false,
                            ])
                            
                            @include('components.form.number', [
                                'class_group' => 'mb-3',
                                'field_name' => 'ammount',
                                'label' => 'Total Dibayarkan',
                                'value' => old('ammount', 0),
                                'placeholder' => 'Total Dibayarkan',
                                'type' => 'text',
                                'show' => true,
                                'disabled' => false,
                                'min' => 0,
                                'max' => 9999999999,
                                'accept' => 'disable-minus',
                                'format' => 'currency'
                            ])
                            
                        @else
                        @include('components.form.number', [
                            'class_group' => 'mb-3',
                            'field_name' => 'ammount',
                            'label' => 'Total Dibayarkan',
                            'value' => old('ammount', number_format($row->payment->ammount, 2, '.', ',')),
                            'placeholder' => 'Total Dibayarkan',
                            'type' => 'text',
                            'show' => true,
                            'disabled' => true,
                            'min' => 0,
                            'max' => 9999999999,
                            'accept' => 'disable-minus',
                            'format' => 'currency'
                        ])
                        @endif

                    </div>
                </div>
                <div class="form-group">
                    @if ($row->status == 0)
                    <button type="submit" class="btn btn-primary">Simpan</button>
                    @endif
                    <a type="button" class="btn btn-secondary" href="{{ route('web.pesanan.index') }}">Batal</a>
                </div>
            </form>
        </div>
    @endsection
