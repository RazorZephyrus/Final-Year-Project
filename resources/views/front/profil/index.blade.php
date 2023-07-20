@extends('layouts.default')

@section('content')
<div class="row">
    <div class="col-lg mb-4 order-0">
        <div class="card">
            <div class="d-flex align-items-end row">
                <div class="col-sm-7">
                    <div class="card-body">
                        <h5 class="card-title text-primary">Congratulations {{ auth()->user()->name }}! 🎉</h5>
                        <p class="mb-4">Welcome, Don't forget to be absent today, so that your points increase.
                            Immediately claim your point to get another attractive prize opportunity</p>
                    </div>
                </div>
                <div class="col-sm-5 text-center text-sm-left">
                    <div class="card-body pb-0 px-0 px-md-4">
                        <img src="../assets/img/illustrations/man-with-laptop-light.png" height="140" alt="View Badge User" data-app-dark-img="illustrations/man-with-laptop-dark.png" data-app-light-img="illustrations/man-with-laptop-light.png">
                    </div>
                </div>
            </div>
        </div>
    </div>
    @if (auth()->user()->hasRole(\App\Constants\RoleConst::STAFF))
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
    @endif
</div>
@endsection


<div class="col-xl-6">
    <h6 class="text-muted">Filled Pills</h6>
    <div class="nav-align-top mb-4">
        <ul class="nav nav-pills mb-3 nav-fill" role="tablist">
            <li class="nav-item">
                <button type="button" class="nav-link active" role="tab" data-bs-toggle="tab" data-bs-target="#navs-pills-justified-home" aria-controls="navs-pills-justified-home" aria-selected="true"><i class="tf-icons bx bx-home"></i> Home <span class="badge rounded-pill badge-center h-px-20 w-px-20 bg-danger">3</span></button>
            </li>
            <li class="nav-item">
                <button type="button" class="nav-link" role="tab" data-bs-toggle="tab" data-bs-target="#navs-pills-justified-profile" aria-controls="navs-pills-justified-profile" aria-selected="false"><i class="tf-icons bx bx-user"></i> Profile</button>
            </li>
            <li class="nav-item">
                <button type="button" class="nav-link" role="tab" data-bs-toggle="tab" data-bs-target="#navs-pills-justified-messages" aria-controls="navs-pills-justified-messages" aria-selected="false"><i class="tf-icons bx bx-message-square"></i> Messages</button>
            </li>
        </ul>
        <div class="tab-content">
            <div class="tab-pane fade show active" id="navs-pills-justified-home" role="tabpanel">
                <p>
                    Icing pastry pudding oat cake. Lemon drops cotton candy caramels cake caramels sesame snaps powder. Bear
                    claw
                    candy topping.
                </p>
                <p class="mb-0">
                    Tootsie roll fruitcake cookie. Dessert topping pie. Jujubes wafer carrot cake jelly. Bonbon jelly-o
                    jelly-o ice
                    cream jelly beans candy canes cake bonbon. Cookie jelly beans marshmallow jujubes sweet.
                </p>
            </div>
            <div class="tab-pane fade" id="navs-pills-justified-profile" role="tabpanel">
                <p>
                    Donut dragée jelly pie halvah. Danish gingerbread bonbon cookie wafer candy oat cake ice cream. Gummies
                    halvah
                    tootsie roll muffin biscuit icing dessert gingerbread. Pastry ice cream cheesecake fruitcake.
                </p>
                <p class="mb-0">
                    Jelly-o jelly beans icing pastry cake cake lemon drops. Muffin muffin pie tiramisu halvah cotton candy
                    liquorice caramels.
                </p>
            </div>
            <div class="tab-pane fade" id="navs-pills-justified-messages" role="tabpanel">
                <p>
                    Oat cake chupa chups dragée donut toffee. Sweet cotton candy jelly beans macaroon gummies cupcake gummi
                    bears
                    cake chocolate.
                </p>
                <p class="mb-0">
                    Cake chocolate bar cotton candy apple pie tootsie roll ice cream apple pie brownie cake. Sweet roll icing
                    sesame snaps caramels danish toffee. Brownie biscuit dessert dessert. Pudding jelly jelly-o tart brownie
                    jelly.
                </p>
            </div>
        </div>
    </div>
</div>