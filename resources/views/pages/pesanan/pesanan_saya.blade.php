@extends('layouts.default')

@section('content')
    <div class="col-xl-12">
        <h6 class="text-muted"></h6>
        <div class="nav-align-top mb-4">
            <ul class="nav nav-pills mb-3 nav-fill" role="tablist">
                <li class="nav-item">
                    <button type="button" class="nav-link active" role="tab" data-bs-toggle="tab"
                        data-bs-target="#navs-pills-justified-messages" aria-controls="navs-pills-justified-messages"
                        aria-selected="false"><i class="tf-icons bx bx-briefcase-alt-2"></i> Kamar Saya
                    </button>
                </li>
            </ul>
            <div class="tab-content">
                <div class="tab-pane fade show active" id="navs-pills-justified-messages" role="tabpanel">
                    <!-- Striped Rows -->
                    <div class="table-responsive text-nowrap" style="height: 500px;">
                    <table class="table table-striped">
                        <thead>
                            <tr>
                                <th>Room</th>
                                <th>Type</th>
                                <th>Asrama</th>
                                <th>Tanggal Payment</th>
                                <th>Tanggal Verifikasi</th>
                                <th>Verifikasi</th>
                                <th>Status</th>
                                <th>CheckIn</th>
                                <th>CheckOut</th>
                            </tr>
                        </thead>
                        <tbody class="table-border-bottom-0">
                            @foreach ($list as $item)
                            <tr>
                                <td>{{ $item->Room->title }}</td>
                                <td>{{ $item->Room->RoomType->title }}</td>
                                <td>{{ $item->Room->Asrama->title }}</td>
                                <td>{{ $item->Payment->created_at ? date('d-m-Y H:i', strtotime($item->Payment->created_at)) : '-' }}</td>
                                <td>{{ $item->Payment->approve_date ? date('d-m-Y H:i', strtotime($item->Payment->approve_date)) : '-' }}</td>
                                <td>{{ $item->Payment->ApproveBy->name ?? '-' }}</td>
                                <td>{{ $item->status == 2 ? "Verified" : "Rejected" }}</td>
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
