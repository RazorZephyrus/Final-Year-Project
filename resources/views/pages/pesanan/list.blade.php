@extends('layouts.default')

@section('content')
{{-- Process --}}
@php
    $booking = [];
    $payment = [];
    $paid = [];
    
    if(count($list) > 0) {
        foreach ($list as $key => $value) {
            if($value->status == 0) {
                $booking[] = $value;
            }

            if($value->status == 1) {
                $payment[] = $value;
            }

            if($value->status == 2) {
                $paid[] = $value;
            }
        }
    }
@endphp
    <div class="col-xl-12">
        <h6 class="text-muted">Kelola Pesanan</h6>
        <div class="nav-align-top mb-4">
            <ul class="nav nav-pills mb-3 nav-fill" role="tablist">
                <li class="nav-item">
                    <button type="button" class="nav-link active" role="tab" data-bs-toggle="tab"
                        data-bs-target="#navs-pills-justified-home" aria-controls="navs-pills-justified-home"
                        aria-selected="true"><i class="tf-icons bx bx-book"></i> Booking <span
                            class="badge rounded-pill badge-center h-px-20 w-px-20 bg-danger">{{ count($booking) }}</span></button>
                </li>
                <li class="nav-item">
                    <button type="button" class="nav-link" role="tab" data-bs-toggle="tab"
                        data-bs-target="#navs-pills-justified-profile" aria-controls="navs-pills-justified-profile"
                        aria-selected="false"><i class="tf-icons bx bx-money"></i> Payment
                        <span
                            class="badge rounded-pill badge-center h-px-20 w-px-20 bg-danger">{{ count($payment) }}</span>
                    </button>
                </li>
                <li class="nav-item">
                    <button type="button" class="nav-link" role="tab" data-bs-toggle="tab"
                        data-bs-target="#navs-pills-justified-messages" aria-controls="navs-pills-justified-messages"
                        aria-selected="false"><i class="tf-icons bx bx-briefcase-alt-2"></i> Verifikasi
                        <span
                            class="badge rounded-pill badge-center h-px-20 w-px-20 bg-danger">{{ count($paid) }}</span>
                    </button>
                </li>
            </ul>
            <div class="tab-content">
                <div class="tab-pane fade show active" id="navs-pills-justified-home" role="tabpanel">
                    <!-- Striped Rows -->
                    <div class="table-responsive text-nowrap" style="height: 500px;">
                        <table class="table table-striped">
                            <thead>
                                <tr>
                                    <th>Student</th>
                                    <th>Email</th>
                                    <th>Room</th>
                                    <th>Type</th>
                                    <th>Asrama</th>
                                    <th>Tanggal Booking</th>
                                    <th>Start Date</th>
                                    <th>End Date</th>
                                    <th>Prosess</th>
                                </tr>
                            </thead>
                            <tbody class="table-border-bottom-0">
                                @foreach ($booking as $item)
                                <tr>
                                    <td><i class="fab fa-angular fa-lg text-danger me-3"></i> <strong>{{ ucfirst($item->User->name) }}</strong></td>
                                    <td>{{ $item->User->email }}</td>
                                    <td>{{ $item->Room->title }}</td>
                                    <td>{{ $item->Room->RoomType->title }}</td>
                                    <td>{{ $item->Room->Asrama->title }}</td>
                                    <td>{{ date('d-m-Y H:i', strtotime($item->created_at)) }}</td>
                                    <td>{{ date('d-m-Y', strtotime($item->start_date)) }}</td>
                                    <td>{{ date('d-m-Y', strtotime($item->end_date)) }}</td>
                                    <td>
                                        @if(auth()->user()->hasRole(\App\Constants\RoleConst::STUDENT))
                                        <div class="dropdown">
                                            <button type="button" class="btn p-0 dropdown-toggle hide-arrow"
                                                data-bs-toggle="dropdown"><i
                                                    class="bx bx-dots-vertical-rounded"></i></button>
                                            <div class="dropdown-menu">
                                                <a class="dropdown-item" href="{{ route('web.pesanan.edit', ['id' => $item->uuid]) }}"><i
                                                        class="bx bx-edit-alt me-1"></i> Proses Pembayaran</a>
                                                <a class="dropdown-item" href="{{ route('web.pesanan.destroy',  ['id' => $item->uuid]) }}"><i
                                                    class="bx bx-window-close me-1"></i> Batalkan Pemesanan</a>
                                            </div>
                                        </div>
                                        @endif
                                    </td>
                                </tr>
                                @endforeach
                            </tbody>
                        </table>
                    </div>
                    <!--/ Striped Rows -->
                </div>
                <div class="tab-pane fade" id="navs-pills-justified-profile" role="tabpanel">
                    <!-- Striped Rows -->
                    <div class="table-responsive text-nowrap" style="height: 500px;">
                        <table class="table table-striped">
                            <thead>
                                <tr>
                                    <th>Student</th>
                                    <th>Email</th>
                                    <th>Room</th>
                                    <th>Type</th>
                                    <th>Asrama</th>
                                    <th>Dibayarkan</th>
                                    <th>Tanggal Payment</th>
                                    <th>Start Date</th>
                                    <th>End Date</th>
                                    <th>Actions</th>
                                </tr>
                            </thead>
                            <tbody class="table-border-bottom-0">
                                @foreach ($payment as $item)
                                <tr>
                                    <td><i class="fab fa-angular fa-lg text-danger me-3"></i> <strong>{{ ucfirst($item->User->name) }}</strong></td>
                                    <td>{{ $item->User->email }}</td>
                                    <td>{{ $item->Room->title }}</td>
                                    <td>{{ $item->Room->RoomType->title }}</td>
                                    <td>{{ $item->Room->Asrama->title }}</td>
                                    <td>{{ number_format($item->Payment->ammount, 2, '.', ',') }}</td>
                                    <td>{{ date('d-m-Y H:i', strtotime($item->Payment->created_at)) }}</td>
                                    <td>{{ date('d-m-Y', strtotime($item->start_date)) }}</td>
                                    <td>{{ date('d-m-Y', strtotime($item->end_date)) }}</td>
                                    <td>
                                        <div class="dropdown">
                                            <button type="button" class="btn p-0 dropdown-toggle hide-arrow"
                                                data-bs-toggle="dropdown"><i
                                                    class="bx bx-dots-vertical-rounded"></i></button>
                                            <div class="dropdown-menu">
                                                <a class="dropdown-item" target="_blank" href="{{ url('files').'?_path='.$item->image->path }}"><i class='bx bx-file me-1'></i>Bukti Bayar</a>
                                                        @if (auth()->user()->hasRole(\App\Constants\RoleConst::STAFF))
                                                        <a class="dropdown-item" href="{{ route('web.pesanan.edit', ['id' => $item->uuid]) }}"><i
                                                            class="bx bx-show me-1"></i>Detail</a>             
                                                        <a class="dropdown-item" href="{{ route('web.pesanan.verifikasi', ['id' => $item->uuid]) }}"><i
                                                                    class="bx bx-edit-alt me-1"></i> Verifikasi</a>
                                                        <a class="dropdown-item" href="{{ route('web.pesanan.canceled',  ['id' => $item->uuid]) }}"><i
                                                                        class="bx bx-window-close me-1"></i> Batalkan Pembayaran</a>
                                                        @endif
                                            </div>
                                        </div>
                                    </td>
                                </tr>
                                @endforeach
                            </tbody>
                        </table>
                    </div>
                    <!--/ Striped Rows -->
                </div>
                <div class="tab-pane fade" id="navs-pills-justified-messages" role="tabpanel">
                    <!-- Striped Rows -->
                    <div class="table-responsive text-nowrap" style="height: 500px;">
                    <table class="table table-striped">
                        <thead>
                            <tr>
                                <th>Student</th>
                                <th>Email</th>
                                <th>Room</th>
                                <th>Type</th>
                                <th>Asrama</th>
                                <th>Tanggal Payment</th>
                                <th>Tanggal Verifikasi</th>
                                <th>Verifikasi</th>
                                <th>Start Date</th>
                                <th>End Date</th>
                            </tr>
                        </thead>
                        <tbody class="table-border-bottom-0">
                            @foreach ($paid as $item)
                            <tr>
                                <td><i class="fab fa-angular fa-lg text-danger me-3"></i> <strong>{{ ucfirst($item->User->name) }}</strong></td>
                                <td>{{ $item->User->email }}</td>
                                <td>{{ $item->Room->title }}</td>
                                <td>{{ $item->Room->RoomType->title }}</td>
                                <td>{{ $item->Room->Asrama->title }}</td>
                                <td>{{ date('d-m-Y H:i', strtotime($item->Payment->created_at)) }}</td>
                                <td>{{ date('d-m-Y H:i', strtotime($item->Payment->approve_date)) }}</td>
                                <td>{{ $item->Payment->ApproveBy->name }}</td>
                                <td>{{ date('d-m-Y', strtotime($item->start_date)) }}</td>
                                <td>{{ date('d-m-Y', strtotime($item->end_date)) }}</td>
                            </tr>
                            @endforeach
                        </tbody>
                    </table>
                    </div>
                    <!--/ Striped Rows -->
                </div>
            </div>
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
