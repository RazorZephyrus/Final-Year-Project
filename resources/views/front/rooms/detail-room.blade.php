<!DOCTYPE html>

<!-- beautify ignore:start -->
@include('front.include.header')

<body>
    @php
        $roomImages = [];
        // foreach ($row->images as $key => $value) {
        //     $roomImages[] = $value;
        // }

        $roomTypeImages = [];
        if (!empty($row->roomType->images)) {
            foreach ($row->roomType->images as $key => $value) {
                $roomTypeImages[] = $value;
            }
        }

        $asramaImages = [];
        // if (!empty($row->asrama->images)) {
        //     foreach ($row->asrama->images as $key => $value) {
        //         $asramaImages[] = $value;
        //     }
        // }
        
        $images = array_merge($roomImages, $roomTypeImages, $asramaImages);
        // dd($images);
    @endphp
    <!-- Layout wrapper -->
    <div class="layout-wrapper layout-content-navbar  layout-without-menu">
        <div class="layout-container">
            <!-- Layout container -->
            <div class="layout-page">
                <!-- Navbar -->
                @include('front.include.navbar')
                <!-- / Navbar -->
                <!-- Content wrapper -->
                <div class="content-wrapper">

                    <!-- Content -->

                    <div class="container-xxl flex-grow-1 container-p-y">
                        <div class="row">
                            <div class="col-6">
                                <h4 class="fw-bold py-3 mb-4"><span class="text-muted fw-light">{{ $row->asrama->title }} /</span> {{ $row->title }}</h4>
                            </div>
                            <div class="col-6 text-end">
                                <a href="{{ url('/landing') }}" class="btn btn-primary">Kembali</a>
                            </div>
                        </div>
                        <!-- Layout Demo -->
                        <div class="row mb-5">
                            <div class="col-md-12 mb-3">
                                <div class="card">
                                    <div class="card-body">
                                        <div class="row">
                                            <div class="col-8">
                                                 <!-- Bootstrap crossfade carousel -->
                                                 <div id="carouselExample-cf" class="carousel carousel-dark slide carousel-fade" data-bs-ride="carousel">
                                                    <ol class="carousel-indicators">
                                                      <li data-bs-target="#carouselExample-cf" data-bs-slide-to="0" class="active"></li>
                                                      <li data-bs-target="#carouselExample-cf" data-bs-slide-to="1"></li>
                                                      <li data-bs-target="#carouselExample-cf" data-bs-slide-to="2"></li>
                                                    </ol>
                                                    <div class="carousel-inner">
                                                        @if ($images != null)
                                                            @foreach ($images as $kimg => $item)
                                                                <div class="carousel-item {{ $kimg == 0 ? 'active' : null }}">
                                                                <a href="#" data-bs-toggle="modal" data-bs-target="#backDropModal-{{ $item->uuid }}"><img class="d-block w-100" src="{{ url('files').'?_path='.$item->path }}" alt="First slide" /></a>
                                                                </div>
                                                                <div class="modal fade" id="backDropModal-{{ $item->uuid }}" data-bs-backdrop="static" tabindex="-1">
                                                                    <div class="modal-dialog">
                                                                      <form class="modal-content">
                                                                        <div class="modal-header">
                                                                          {{-- <h5 class="modal-title" id="backDropModalTitle">Modal title</h5> --}}
                                                                          <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                                                                        </div>
                                                                        <div class="modal-body">
                                                                          <div class="row">
                                                                            <img class="d-block w-100" src="{{ url('files').'?_path='.$item->path }}" alt="First slide" />
                                                                          </div>
                                                                        </div>
                                                                        <div class="modal-footer">
                                                                          <button type="button" class="btn btn-outline-secondary" data-bs-dismiss="modal">Close</button>
                                                                        </div>
                                                                      </form>
                                                                    </div>
                                                                  </div>
                                                            @endforeach
                                                        @else
                                                            <div class="carousel-item">
                                                                <img class="d-block w-100" src="../assets/img/elements/kamar.jpg" alt="Second slide" />
                                                            </div>
                                                        @endif
                                                    </div>
                                                    <a class="carousel-control-prev" href="#carouselExample-cf" role="button" data-bs-slide="prev">
                                                      <span class="carousel-control-prev-icon" aria-hidden="true"></span>
                                                      <span class="visually-hidden">Previous</span>
                                                    </a>
                                                    <a class="carousel-control-next" href="#carouselExample-cf" role="button" data-bs-slide="next">
                                                      <span class="carousel-control-next-icon" aria-hidden="true"></span>
                                                      <span class="visually-hidden">Next</span>
                                                    </a>
                                                  </div>
                                                <!-- {{-- <img class="card-img-top" src="../assets/img/elements/kamar.jpg"
                                                    alt="Card image cap" /> --}} -->
                                                <!-- {{-- <div class="row mt-2">
                                                    <div class="col-6">
                                                        <img class="card-img-top"
                                                            src="../assets/img/elements/kamar.jpg"
                                                            alt="Card image cap" />
                                                    </div>
                                                    <div class="col-6">
                                                        <img class="card-img-top"
                                                            src="../assets/img/elements/kamar.jpg"
                                                            alt="Card image cap" />
                                                    </div>
                                                </div> --}} -->
                                            </div>
                                            <div class="col-4">
                                                <h3 class="card-title">{{ $row->title }}</h3>
                                                <h4 class="card-title">Fasilitas</h4>
                                                
                                                <ul class="list-unstyled mt-2">
                                                    @forelse ($row->RoomFasilitas as $item)
                                                        <li>
                                                            <ul>
                                                                <li>{{ $item?->fasilitas?->title }}</li>
                                                            </ul>
                                                        </li>
                                                    @empty
                                                    <li>Tidak Ada Fasilitas, Hubungi Administrator untuk informasi lebih tentang Kamar ini</li>
                                                    @endforelse
                                                </ul>
                                                <hr/>
                                                @if (auth()->user() != null)
                                                <form method="post" action="{{ route('web.homepage.room-booking.front') }}" enctype="multipart/form-data">
                                                @csrf
                                                <input type="hidden" name="room_id" value="{{ $row->uuid }}">
                                                    <div class="row">
                                                            <div class="col-12"> <label>Check In</label>
                                                                <input class="form-control" id="checkin-input" type="date" data-date="" data-date-format="DD MMMM YYYY" name="start_date">
                                                            </div>
                                                            
                                                            <div class="col-12">
                                                                <div>
                                                                    <label for="defaultSelect" class="form-label">Jenis Sewa</label>
                                                                    <select id="jenisSewaselected" name="type_harga" class="form-select">
                                                                      <option value="">Pilih Sewa</option>
                                                                      <option value="perhari">Harian</option>
                                                                      <option value="perbulan">Bulanan</option>
                                                                      <option value="persemester">Semester</option>
                                                                    </select>
                                                                  </div>
                                                            </div>
                                                            <div class="col-12"> <label>Lama Menginap</label>
                                                                <input class="form-control" type="number" name="lenght_of_stay" value="0"  onchange="generateCheckout(this.value)">
                                                            </div>
                                                            {{-- <div class="col-6"> <label>Check Out</label>
                                                                <input class="form-control" type="date" name="end_date">
                                                            </div> --}}
                                                            <div class="col-12 mb-3"> <label>Check Out</label>
                                                                <input class="form-control date-checkout" type="text" disabled value="MM/DD/YYYY">
                                                                <input type="hidden" name="end_date" id="checkout-date-input">
                                                            </div>
                                                            <div class="card-title mt-2 mb-0">
                                                                <h5 class="m-0 me-2">Rp. {{ number_format($row->perhari) }} / {{ ' Hari' }}</h5>
                                                                <h5 class="m-0 me-2">Rp. {{ number_format($row->perbulan) }} / {{ ' Bulan' }}</h5>
                                                                <h5 class="m-0 me-2">Rp. {{ number_format($row->persemester) }} / {{ ' Semester' }}</h5>
                                                                @if ($row->stock == 0)
                                                                    <small class="text-muted">Stok Tidak Tersedia</small>
                                                                @else   
                                                                    <small class="text-muted">Stok Kamar Tersedia</small>
                                                                    <br>
                                                                    <small class="text-muted">{{ $row->stock == 0 ? 'Kamar Tidak Tersedia' : $row->stock.' Bed Tersedia ' }}</small>
                                                                @endif
                                                            </div>
                                                            <div class="col-6">
                                                                @if ($row->stock != 0)
                                                                <button @if (!auth()->user()->hasRole(\App\Constants\RoleConst::STUDENT))
                                                                    disabled
                                                                @endif type="submit" class="btn btn-success">Booking Sekarang</button>
                                                                @endif
                                                            </div>
                                                        </div>
                                                    </form>
                                                    {{-- {{ dd($row->Booking, auth()->user()->id); }} --}}
                                                    @if (auth()->user()->id == $row?->Booking?->user_id)
                                                        <small class="text-info">{{ $row->Booking->status == 0 ? "Lakukan Pembayaran Anda Sekarang" : "Pesanan Anda Sedang diproses oleh Admin" }}</small>
                                                    @endif
                                                @else
                                                    <div class="row">
                                                        <div class="col-12 mb-2 mt-2"> 
                                                            <div class="card-title mt-2 mb-0">
                                                                <h5 class="m-0 me-2">Rp. {{ number_format($row->harga) }} / {{ $row->type_harga }}</h5>
                                                                @if ($row->Booking != null)
                                                                    <small class="text-muted">Stok Tidak Tersedia</small>
                                                                @else   
                                                                    <small class="text-muted">Stok Kamar Tersedia</small>
                                                                @endif
                                                            </div>
                                                            Lakukan Login Untuk pesan kamar ini.
                                                        </div>
                                                        <div class="col-12"> 
                                                            <a href="{{ url('login') }}" class="navbar-brand btn btn-outline-primary">Login</a>
                                                        </div>
                                                    </div>
                                                @endif
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
 @php
     $kamar = \App\Models\Room::where('asrama_id',$row->asrama_id)->where('id', '!=', $row->id)->inRandomOrder()->limit(4)->get();
 @endphp                           
                            
                            <h3 class="mt-5">Kamar Lainya</h5>
                            <hr/>
                            @if (count($kamar) > 0)
                            @foreach ($kamar as $item)
                            <div class="col-md-6 col-lg-3 mb-3">
                                <div class="card h-100">
                                    <img class="card-img-top" style="height: 250px;" src="{{ url('files').'?_path='.$item->RoomType->image->path }}"
                                    alt="Card image cap" />
                                    <div class="card-body">
                                        <h5 class="card-title">{{ $item->title }}</h5>
                                        <p class="card-text">
                                            @forelse ($item->RoomFasilitas as $i)
                                                {{ $i?->fasilitas?->title }},
                                            @empty
                                            Tidak Ada Fasilitas, Hubungi Administrator untuk informasi lebih tentang Kamar ini
                                            @endforelse 
                                        </p>
                                        <a href="{{ route('web.homepage.room-detail.front', ['id' => $item->uuid]) }}" class="btn btn-outline-primary">Lebih Detail</a>
                                    </div>
                                </div>
                            </div>
                            @endforeach
                            @else
                            Tidak Ada Data
                            @endif
                            
                        </div>
                            <!--/ Order Statistics -->
                        <!--/ Layout Demo -->
                    </div>
                    <!-- / Content -->
                    <!-- Footer -->
                    @include('front.include.footer')
                    <!-- / Footer -->


                    <div class="content-backdrop fade"></div>
                </div>
                <!-- Content wrapper -->
            </div>
            <!-- / Layout page -->
        </div>
    </div>
    <!-- / Layout wrapper -->
    <!-- Core JS -->
    <!-- build:js assets/vendor/js/core.js -->
    <script src="{{ asset('assets/vendor/libs/jquery/jquery.js') }}"></script>
    <script src="{{ asset('assets/vendor/libs/popper/popper.js') }}"></script>
    <script src="{{ asset('assets/vendor/js/bootstrap.js') }}"></script>
    <script src="{{ asset('assets/vendor/libs/perfect-scrollbar/perfect-scrollbar.js') }}"></script>

    <script src="{{ asset('assets/vendor/js/menu.js') }}"></script>
    <!-- endbuild -->

    <!-- Vendors JS -->

    <!-- Main JS -->
    <script src="{{ asset('assets/js/main.js') }}"></script>

    <!-- Page JS -->

    <!-- Place this tag in your head or just before your close body tag. -->
    <script async defer src="https://buttons.github.io/buttons.js"></script>
    <script>
        function generateCheckout(val) {
            let checkin = $("#checkin-input").val()
            if(checkin == '') {
                alert('Pilih tanggal Check In terlebih Dahulu.')
                return
            }
            let jenisSewa = $("#jenisSewaselected").val()
            if(jenisSewa == '') {
                alert('Pilih Jenis sewa anda.')
                return
            }
            
            
            var date = new Date(checkin);
            // add a day
            if(jenisSewa == 'perhari') {
                date.setDate(date.getDate() + (1*val))
            } else if (jenisSewa == 'perbulan') {
                date.setDate(date.getDate() + (30*val))
            } else if (jenisSewa == 'persemester') {
                date.setDate(date.getDate() + (180 * val))
            }

            var dateArray =  date.toISOString().split('T')[0].split('-').concat( date.toISOString().split('T')[1].split(':') );
            
            $(".date-checkout").val(`${dateArray[1]}/${dateArray[2]}/${dateArray[0]}`)
            $("#checkout-date-input").val(`${dateArray[0]}-${dateArray[1]}-${dateArray[2]}`)
        }
    </script>
</body>

</html>