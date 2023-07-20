@extends('layouts.default')

@section('content')
    <div class="row">
        <div class="col-lg mb-4 order-0">
            <div class="card">
                <div class="d-flex align-items-end row">
                    <div class="col-sm-7">
                        <div class="card-body">
                            <h5 class="card-title text-primary">Selamat Datang, {{ auth()->user()->name }}! 🎉</h5>
                            <p class="mb-4">Semoga anda selalu bersemangat untuk menjalani kegiatan hari ini ... :) </p>
                        </div>
                    </div>
                    <div class="col-sm-5 text-center text-sm-left">
                        <div class="card-body pb-0 px-0 px-md-4">
                            <img src="../assets/img/illustrations/man-with-laptop-light.png" height="140"
                                alt="View Badge User" data-app-dark-img="illustrations/man-with-laptop-dark.png"
                                data-app-light-img="illustrations/man-with-laptop-light.png">
                        </div>
                    </div>
                </div>
            </div>
        </div>
        {{-- <div class="col-lg-4 col-md-4 order-1"> --}}
        <div class="row">
            @if (auth()->user()->hasRole(\App\Constants\RoleConst::SUPER_ADMIN))
            <div class="col-lg-3 col-md-12 col mb-4">
                <div class="card">
                    <div class="card-body">
                        <div class="card-title d-flex align-items-start justify-content-between">
                            <div class="avatar flex-shrink-0">
                                <img src="../assets/img/icons/unicons/cc-primary.png" alt="Credit Card" class="rounded">
                            </div>
                            <div class="dropdown">
                                <button class="btn p-0" type="button" id="cardOpt6" data-bs-toggle="dropdown"
                                    aria-haspopup="true" aria-expanded="false">
                                    <i class="bx bx-dots-vertical-rounded"></i>
                                </button>
                                <div class="dropdown-menu dropdown-menu-end" aria-labelledby="cardOpt6">
                                    <a class="dropdown-item" href="javascript:void(0);">View More</a>
                                    <a class="dropdown-item" href="javascript:void(0);">Delete</a>
                                </div>
                            </div>
                        </div>
                        <span>Total Asrama</span>
                        <h3 class="card-title text-nowrap mb-1">{{ $asrama }}</h3>
                    </div>
                </div>
            </div>
            <div class="col-lg-3 col-md-12 col mb-4">
                <div class="card">
                    <div class="card-body">
                        <div class="card-title d-flex align-items-start justify-content-between">
                            <div class="avatar flex-shrink-0">
                                <img src="../assets/img/icons/unicons/wallet-info.png" alt="Credit Card" class="rounded">
                            </div>
                            <div class="dropdown">
                                <button class="btn p-0" type="button" id="cardOpt6" data-bs-toggle="dropdown"
                                    aria-haspopup="true" aria-expanded="false">
                                    <i class="bx bx-dots-vertical-rounded"></i>
                                </button>
                                <div class="dropdown-menu dropdown-menu-end" aria-labelledby="cardOpt6">
                                    <a class="dropdown-item" href="javascript:void(0);">View More</a>
                                    <a class="dropdown-item" href="javascript:void(0);">Delete</a>
                                </div>
                            </div>
                        </div>
                        <span>Total Kamar</span>
                        <h3 class="card-title text-nowrap mb-1">{{ $kamar }}</h3>
                    </div>
                </div>
            </div>
            <div class="col-lg-3 col-md-12 col mb-4">
                <div class="card">
                    <div class="card-body">
                        <div class="card-title d-flex align-items-start justify-content-between">
                            <div class="avatar flex-shrink-0">
                                <img src="../assets/img/icons/unicons/chart-success.png" alt="Credit Card" class="rounded">
                            </div>
                            <div class="dropdown">
                                <button class="btn p-0" type="button" id="cardOpt6" data-bs-toggle="dropdown"
                                    aria-haspopup="true" aria-expanded="false">
                                    <i class="bx bx-dots-vertical-rounded"></i>
                                </button>
                                <div class="dropdown-menu dropdown-menu-end" aria-labelledby="cardOpt6">
                                    <a class="dropdown-item" href="javascript:void(0);">View More</a>
                                    <a class="dropdown-item" href="javascript:void(0);">Delete</a>
                                </div>
                            </div>
                        </div>
                        <span>Total Tamu</span>
                        <h3 class="card-title text-nowrap mb-1">{{ $tamu }}</h3>
                    </div>
                </div>
            </div>
            <div class="col-lg-3 col-md-12 col mb-4">
                <div class="card">
                    <div class="card-body">
                        <div class="card-title d-flex align-items-start justify-content-between">
                            <div class="avatar flex-shrink-0">
                                <img src="../assets/img/icons/unicons/paypal.png" alt="Credit Card" class="rounded">
                            </div>
                            <div class="dropdown">
                                <button class="btn p-0" type="button" id="cardOpt6" data-bs-toggle="dropdown"
                                    aria-haspopup="true" aria-expanded="false">
                                    <i class="bx bx-dots-vertical-rounded"></i>
                                </button>
                                <div class="dropdown-menu dropdown-menu-end" aria-labelledby="cardOpt6">
                                    <a class="dropdown-item" href="javascript:void(0);">View More</a>
                                    <a class="dropdown-item" href="javascript:void(0);">Delete</a>
                                </div>
                            </div>
                        </div>
                        <span>Total Booking</span>
                        <h3 class="card-title text-nowrap mb-1">{{ $booking }}</h3>
                    </div>
                </div>
            </div>
            @elseif(auth()->user()->hasRole(\App\Constants\RoleConst::STAFF))
            <div class="col-lg-4 col-md-12 col mb-4">
                <div class="card">
                    <div class="card-body">
                        <div class="card-title d-flex align-items-start justify-content-between">
                            <div class="avatar flex-shrink-0">
                                <img src="../assets/img/icons/unicons/wallet-info.png" alt="Credit Card" class="rounded">
                            </div>
                            <div class="dropdown">
                                <button class="btn p-0" type="button" id="cardOpt6" data-bs-toggle="dropdown"
                                    aria-haspopup="true" aria-expanded="false">
                                    <i class="bx bx-dots-vertical-rounded"></i>
                                </button>
                                <div class="dropdown-menu dropdown-menu-end" aria-labelledby="cardOpt6">
                                    <a class="dropdown-item" href="javascript:void(0);">View More</a>
                                    <a class="dropdown-item" href="javascript:void(0);">Delete</a>
                                </div>
                            </div>
                        </div>
                        <span>Total Kamar</span>
                        <h3 class="card-title text-nowrap mb-1">{{ $kamar }}</h3>
                    </div>
                </div>
            </div>
            <div class="col-lg-4 col-md-12 col mb-4">
                <div class="card">
                    <div class="card-body">
                        <div class="card-title d-flex align-items-start justify-content-between">
                            <div class="avatar flex-shrink-0">
                                <img src="../assets/img/icons/unicons/chart-success.png" alt="Credit Card" class="rounded">
                            </div>
                            <div class="dropdown">
                                <button class="btn p-0" type="button" id="cardOpt6" data-bs-toggle="dropdown"
                                    aria-haspopup="true" aria-expanded="false">
                                    <i class="bx bx-dots-vertical-rounded"></i>
                                </button>
                                <div class="dropdown-menu dropdown-menu-end" aria-labelledby="cardOpt6">
                                    <a class="dropdown-item" href="javascript:void(0);">View More</a>
                                    <a class="dropdown-item" href="javascript:void(0);">Delete</a>
                                </div>
                            </div>
                        </div>
                        <span>Total Tamu</span>
                        <h3 class="card-title text-nowrap mb-1">{{ $tamu }}</h3>
                    </div>
                </div>
            </div>
            <div class="col-lg-4 col-md-12 col mb-4">
                <div class="card">
                    <div class="card-body">
                        <div class="card-title d-flex align-items-start justify-content-between">
                            <div class="avatar flex-shrink-0">
                                <img src="../assets/img/icons/unicons/paypal.png" alt="Credit Card" class="rounded">
                            </div>
                            <div class="dropdown">
                                <button class="btn p-0" type="button" id="cardOpt6" data-bs-toggle="dropdown"
                                    aria-haspopup="true" aria-expanded="false">
                                    <i class="bx bx-dots-vertical-rounded"></i>
                                </button>
                                <div class="dropdown-menu dropdown-menu-end" aria-labelledby="cardOpt6">
                                    <a class="dropdown-item" href="javascript:void(0);">View More</a>
                                    <a class="dropdown-item" href="javascript:void(0);">Delete</a>
                                </div>
                            </div>
                        </div>
                        <span>Total Booking</span>
                        <h3 class="card-title text-nowrap mb-1">{{ $booking }}</h3>
                    </div>
                </div>
            </div>
            @endif
        </div>
        {{-- </div> --}}

        <!-- Transactions -->
        {{-- <div class="col-md-6 col-lg-4 order-2 mb-4">
            <div class="card h-100">
            <div class="card-header d-flex align-items-center justify-content-between">
                <h5 class="card-title m-0 me-2">Transactions</h5>
                <div class="dropdown">
                <button class="btn p-0" type="button" id="transactionID" data-bs-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                    <i class="bx bx-dots-vertical-rounded"></i>
                </button>
                <div class="dropdown-menu dropdown-menu-end" aria-labelledby="transactionID">
                    <a class="dropdown-item" href="javascript:void(0);">Last 28 Days</a>
                    <a class="dropdown-item" href="javascript:void(0);">Last Month</a>
                    <a class="dropdown-item" href="javascript:void(0);">Last Year</a>
                </div>
                </div>
            </div>
            <div class="card-body">
                <ul class="p-0 m-0">
                <li class="d-flex mb-4 pb-1">
                    <div class="avatar flex-shrink-0 me-3">
                    <img src="../assets/img/icons/unicons/paypal.png" alt="User" class="rounded">
                    </div>
                    <div class="d-flex w-100 flex-wrap align-items-center justify-content-between gap-2">
                    <div class="me-2">
                        <small class="text-muted d-block mb-1">Paypal</small>
                        <h6 class="mb-0">Send money</h6>
                    </div>
                    <div class="user-progress d-flex align-items-center gap-1">
                        <h6 class="mb-0">+82.6</h6> <span class="text-muted">USD</span>
                    </div>
                    </div>
                </li>
                <li class="d-flex mb-4 pb-1">
                    <div class="avatar flex-shrink-0 me-3">
                    <img src="../assets/img/icons/unicons/wallet.png" alt="User" class="rounded">
                    </div>
                    <div class="d-flex w-100 flex-wrap align-items-center justify-content-between gap-2">
                    <div class="me-2">
                        <small class="text-muted d-block mb-1">Wallet</small>
                        <h6 class="mb-0">Mac'D</h6>
                    </div>
                    <div class="user-progress d-flex align-items-center gap-1">
                        <h6 class="mb-0">+270.69</h6> <span class="text-muted">USD</span>
                    </div>
                    </div>
                </li>
                <li class="d-flex mb-4 pb-1">
                    <div class="avatar flex-shrink-0 me-3">
                    <img src="../assets/img/icons/unicons/chart.png" alt="User" class="rounded">
                    </div>
                    <div class="d-flex w-100 flex-wrap align-items-center justify-content-between gap-2">
                    <div class="me-2">
                        <small class="text-muted d-block mb-1">Transfer</small>
                        <h6 class="mb-0">Refund</h6>
                    </div>
                    <div class="user-progress d-flex align-items-center gap-1">
                        <h6 class="mb-0">+637.91</h6> <span class="text-muted">USD</span>
                    </div>
                    </div>
                </li>
                <li class="d-flex mb-4 pb-1">
                    <div class="avatar flex-shrink-0 me-3">
                    <img src="../assets/img/icons/unicons/cc-success.png" alt="User" class="rounded">
                    </div>
                    <div class="d-flex w-100 flex-wrap align-items-center justify-content-between gap-2">
                    <div class="me-2">
                        <small class="text-muted d-block mb-1">Credit Card</small>
                        <h6 class="mb-0">Ordered Food</h6>
                    </div>
                    <div class="user-progress d-flex align-items-center gap-1">
                        <h6 class="mb-0">-838.71</h6> <span class="text-muted">USD</span>
                    </div>
                    </div>
                </li>
                <li class="d-flex mb-4 pb-1">
                    <div class="avatar flex-shrink-0 me-3">
                    <img src="../assets/img/icons/unicons/wallet.png" alt="User" class="rounded">
                    </div>
                    <div class="d-flex w-100 flex-wrap align-items-center justify-content-between gap-2">
                    <div class="me-2">
                        <small class="text-muted d-block mb-1">Wallet</small>
                        <h6 class="mb-0">Starbucks</h6>
                    </div>
                    <div class="user-progress d-flex align-items-center gap-1">
                        <h6 class="mb-0">+203.33</h6> <span class="text-muted">USD</span>
                    </div>
                    </div>
                </li>
                <li class="d-flex">
                    <div class="avatar flex-shrink-0 me-3">
                    <img src="../assets/img/icons/unicons/cc-warning.png" alt="User" class="rounded">
                    </div>
                    <div class="d-flex w-100 flex-wrap align-items-center justify-content-between gap-2">
                    <div class="me-2">
                        <small class="text-muted d-block mb-1">Mastercard</small>
                        <h6 class="mb-0">Ordered Food</h6>
                    </div>
                    <div class="user-progress d-flex align-items-center gap-1">
                        <h6 class="mb-0">-92.45</h6> <span class="text-muted">USD</span>
                    </div>
                    </div>
                </li>
                </ul>
            </div>
            </div>
        </div> --}}
        <!--/ Transactions -->
        {{-- @if (auth()->user()->hasRole(\App\Constants\RoleConst::STAFF))
            <div class="col-lg-4 mb-4 order-0">
                <div class="card">
                    <div class="d-flex align-items-end row">
                        <div class="col-sm-7">
                            <div class="card-body">
                                <h5 class="card-title text-primary">Total Saldo</h5>
                                <p class="fw-bold mb-4">{{ number_format(auth()->user()->employee->point) ?? 0 }}</p>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-lg-12 mb-4 order-0">
                <div class="card">
                    <div class="d-flex align-items-end row">
                        <div class="col-sm-12">
                            <div class="card-body">
                                @php
                                    $fieldBeritas = [
                                        [
                                            'label' => 'Title',
                                            'field' => 'title',
                                        ],
                                        [
                                            'label' => 'Descriptions',
                                            'field' => 'description',
                                        ],
                                        [
                                            'label' => 'Publish Oleh',
                                            'field' => 'updated_at',
                                        ],
                                        [
                                            'label' => 'Tanggal Dibuat',
                                            'field' => 'created_at',
                                        ],
                                    ];
                                @endphp
                                <h5 class="card-title text-primary">Berita / Informasi</h5>
                                <div class="table-responsive text-nowrap">
                                    <table class="table">
                                        <thead>
                                            <tr>
                                                @foreach ($fieldBeritas as $item)
                                                    <th>{{ $item['label'] }}</th>
                                                @endforeach
                                            </tr>
                                        </thead>
                                        <tbody class="table-border-bottom-0">
                                            @forelse ($berita as $item)
                                                <tr class="table-info">
                                                    <td><i class="fab fa-angular fa-lg text-danger me-3"></i>
                                                        <strong>{{ $item->title }}</strong>
                                                    </td>
                                                    <td>{{ $item->description }}</td>
                                                    <td>{{ $item->updatedBy->name }}</td>
                                                    <td><i class="fab fa-angular fa-lg text-danger me-3"></i>
                                                        <strong>{{ date('d-m-Y H:i', strtotime($item->created_at)) }}</strong>
                                                    </td>
                                                </tr>
                                            @empty
                                                <tr class="table-danger">
                                                    <td colspan="{{ count($fieldBeritas) }}">Berita Tidak Ditemukan!</td>
                                                </tr>
                                            @endforelse
                                        </tbody>
                                    </table>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-lg-12 mb-4 order-0">
                <div class="card">
                    <div class="d-flex align-items-end row">
                        <div class="col-sm-12">
                            <div class="card-body">
                                @php
                                    $fields = [
                                        [
                                            'label' => 'Date',
                                            'field' => 'date',
                                        ],
                                        [
                                            'label' => 'Employee',
                                            'field' => 'employee',
                                        ],
                                        [
                                            'label' => 'Status',
                                            'field' => 'status',
                                        ],
                                    ];
                                @endphp
                                <h5 class="card-title text-primary">Your Attendence {{ auth()->user()->name }}</h5>
                                <div class="table-responsive text-nowrap">
                                    <table class="table">
                                        <thead>
                                            <tr>
                                                @foreach ($fields as $item)
                                                    <th>{{ $item['label'] }}</th>
                                                @endforeach
                                            </tr>
                                        </thead>
                                        <tbody class="table-border-bottom-0">
                                            @forelse ($absen as $item)
                                                <tr class="{{ $item->status == 1 ? 'table-primary' : 'table-success' }}">
                                                    <td><i class="fab fa-angular fa-lg text-danger me-3"></i>
                                                        <strong>{{ date('d-m-Y H:i', strtotime($item->absence_date)) }}</strong>
                                                    </td>
                                                    <td><i class="fab fa-angular fa-lg text-danger me-3"></i>
                                                        <strong>{{ $item->employee->name }}</strong>
                                                    </td>
                                                    <td>{!! $item->status == 1
                                                        ? '<span class="badge bg-primary">IN</span>'
                                                        : '<span class="badge bg-warning">OUT</span>' !!}</td>
                                                </tr>
                                            @empty
                                                <tr class="table-danger">
                                                    <td colspan="{{ count($fields) }}">You are not present yet!</td>
                                                </tr>
                                            @endforelse
                                        </tbody>
                                    </table>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-lg-12 mb-4 order-0">
                <div class="card">
                    <div class="d-flex align-items-end row">
                        <div class="col-sm-12">
                            <div class="card-body">
                                @php
                                    $fieldRewards = [
                                        [
                                            'label' => 'Date',
                                            'field' => 'date',
                                        ],
                                        [
                                            'label' => 'Reward Code',
                                            'field' => 'reward_code',
                                        ],
                                        [
                                            'label' => 'Reward',
                                            'field' => 'rewardd',
                                        ],
                                        [
                                            'label' => 'Type',
                                            'field' => 'Type',
                                        ],
                                        [
                                            'label' => 'Point',
                                            'field' => 'point',
                                        ],
                                        [
                                            'label' => 'Left Quota Reward',
                                            'field' => 'reward_quota',
                                        ],
                                    ];
                                @endphp
                                <h5 class="card-title text-primary">Your Rewards</h5>
                                <div class="table-responsive text-nowrap">
                                    <table class="table">
                                        <thead>
                                            <tr>
                                                @foreach ($fieldRewards as $rfitem)
                                                    <th>{{ $rfitem['label'] }}</th>
                                                @endforeach
                                            </tr>
                                        </thead>
                                        <tbody class="table-border-bottom-0">
                                            @forelse ($rewards as $ritem)
                                                <tr class="table-success">
                                                    <td><i class="fab fa-angular fa-lg text-danger me-3"></i>
                                                        <strong>{{ date('d-m-Y H:i', strtotime($ritem->created_at)) }}</strong>
                                                    </td>
                                                    <td><i class="fab fa-angular fa-lg text-danger me-3"></i>
                                                        <strong>{{ $ritem->reward->code ?? '-' }}</strong>
                                                    </td>
                                                    <td><i class="fab fa-angular fa-lg text-danger me-3"></i>
                                                        <strong>{{ $ritem->reward->title ?? '-' }}</strong>
                                                    </td>
                                                    <td><i class="fab fa-angular fa-lg text-danger me-3"></i>
                                                        <strong>{{ $ritem->reward->type->title ?? '-' }}</strong>
                                                    </td>
                                                    <td><i class="fab fa-angular fa-lg text-danger me-3"></i>
                                                        <strong>{{ $ritem->reward->point ?? 0 }}</strong>
                                                    </td>
                                                    <td><i class="fab fa-angular fa-lg text-danger me-3"></i>
                                                        <strong>{{ $ritem->reward->total ?? 0 }}</strong>
                                                    </td>
                                                </tr>
                                            @empty
                                                <tr class="table-danger">
                                                    <td colspan="{{ count($fieldRewards) }}">You don't have any rewards
                                                        that have been claimed!</td>
                                                </tr>
                                            @endforelse
                                        </tbody>
                                    </table>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        @endif --}}
    </div>
@endsection
