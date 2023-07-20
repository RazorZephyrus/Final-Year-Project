<!DOCTYPE html>
<!-- beautify ignore:start -->
@include('front.include.header')

<body>

    <!-- Layout wrapper -->
    <div class="layout-wrapper layout-content-navbar  layout-without-menu">
        <div class="layout-container">
            <!-- Layout container -->
            <div class="layout-page">
                @include('front.include.navbar')
                <!-- Content wrapper -->
                <div class="content-wrapper">

                    <!-- Content -->

                    <div class="container-xxl flex-grow-1 container-p-y">
                        <div style="padding-bottom: 20px;">
                            <h3>Mau Cari Tempat Menginap?</h3>
                            <p>Yuk! langsung dibooking di sini!</p>
                        </div>
                        <!-- Layout Demo -->
                        <!-- Examples -->
                        <div class="row mb-5">
                            @foreach ($room as $item)
                            @php
                                $roomImages = [];
                                foreach ($item->images as $key => $value) {
                                    $roomImages[] = $value;
                                }

                                $roomTypeImages = [];
                                if (!empty($item->roomType->images)) {
                                    foreach ($item->roomType->images as $key => $value) {
                                        $roomTypeImages[] = $value;
                                    }
                                }

                                $asramaImages = [];
                                if (!empty($item->asrama->images)) {
                                    foreach ($item->asrama->images as $key => $value) {
                                        $asramaImages[] = $value;
                                    }
                                }
                                $images = array_merge($roomImages, $roomTypeImages, $asramaImages);
                            @endphp    
                            <div class="col-md-6 col-lg-3 mb-3">
                                <div class="card h-100">
                                    @if(empty($images))
                                    <img class="card-img-top" style="height: 203px;" src="../assets/img/elements/kamar.jpg"
                                        alt="Card image cap" />
                                    @else
                                    <img class="card-img-top" style="height: 203px;" src="{{ url('files').'?_path='.$images[0]->path }}"
                                        alt="Card image cap" />
                                    @endif
                                    <div class="card-body">
                                        <h5 class="card-title">{{ $item->title }}</h5>
                                        <p class="card-text"><small>

                                            @forelse ($item->RoomFasilitas as $items)
                                            {{ $items?->fasilitas?->title }},
                                            @empty
                                            Tidak Ada Fasilitas, Hubungi Administrator untuk informasi lebih tentang Kamar ini
                                            @endforelse
                                        </small>
                                        </p>
                                        <p class="card-text">
                                            {{ number_format($item->perbulan) }} / {{ ' Bulan' }}
                                        </p>
                                        <a href="{{ route('web.homepage.room-detail.front', ['id' => $item->uuid]) }}" class="btn btn-outline-primary">Lebih Detail</a>
                                    </div>
                                </div>
                            </div>
                            @endforeach
                        </div>
                        <div class="row">
                            <div class="col-lg mb-4 order-0">
                                <div class="card">
                                    <div class="d-flex align-items-end row">
                                        <div class="col-sm-7">
                                            <div class="card-body">
                                                <h5 class="card-title text-primary">Asrama dikelola Book It, Terjamin Nyaman  🎉</h5>
                                                <p class="mb-4">Booking kamar untuk Mahasiswa/i berada dalam genggaman anda.</p>
                                            </div>
                                        </div>
                                        <div class="col-sm-5 text-center text-sm-left">
                                            <div class="card-body pb-0 px-0 px-md-4">
                                                <img src="../assets/img/illustrations/bbb.png" height="120"
                                                    alt="View Badge User" data-app-dark-img="illustrations/man-with-laptop-dark.png"
                                                    data-app-light-img="illustrations/man-with-laptop-light.png">
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            @if (auth()->user() != null AND auth()->user()->hasRole(\App\Constants\RoleConst::STUDENT))
                               
                            @endif
                        </div>

                        <h5 class="pb-1 mb-4">Asrama Favorit</h5>
                        <div class="row mb-1">
                            @php
                                $asrama = \App\Models\Asramas::get();
                            @endphp
                            @foreach ($asrama as $item)
                                <div class="col-md-6" href="">
                                    <div class="card mb-3">
                                        <div class="row g-0">
                                            <div class="col-md-4">
                                                <a href="{{ route('web.homepage.detail-asrama.front',['id'=>$item->uuid]) }}">
                                                @if(isset($item->image->path))
                                                <img class="card-img card-img-left" src="{{ url('files').'?_path='.$item->image->path }}" style="width: 180px; height: 180px;" alt="Card image" />
                                                @else
                                                <img class="card-img card-img-right" src="../assets/img/elements/17.jpg"  style="width: 180px; height: 180px;" alt="Card image" />
                                                @endif
                                            </a>
                                            </div>
                                            <div class="col-md-8">
                                            <div class="card-body">
                                                <a href="{{ route('web.homepage.detail-asrama.front',['id'=>$item->uuid]) }}">
                                                <h5 class="card-title">{{ $item->title }}</h5>
                                                </a>
                                                <p class="card-text">
                                                    {{ $item->description }}
                                                {{-- Merupakan Asrama yang terletak di sekitar kawasan kampus Universitas Riau, yang memiliki fasilitas yang nyaman untuk penginapan untuk Mahasiswa/i Universitas Riau. --}}
                                                </p>
                                                {{-- <p class="card-text"><small class="text-muted">Last updated 3 mins ago</small></p> --}}
                                            </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                
                            @endforeach
                            
                        </div>
                        
                        <!--/ Layout Demo -->
                    </div>
                    <!-- / Content -->
                    @include('front.include.footer')


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
    <script src="../assets/vendor/libs/jquery/jquery.js"></script>
    <script src="../assets/vendor/libs/popper/popper.js"></script>
    <script src="../assets/vendor/js/bootstrap.js"></script>
    <script src="../assets/vendor/libs/perfect-scrollbar/perfect-scrollbar.js"></script>

    <script src="../assets/vendor/js/menu.js"></script>
    <!-- endbuild -->

    <!-- Vendors JS -->

    <!-- Main JS -->
    <script src="../assets/js/main.js"></script>

    <!-- Page JS -->

    <!-- Place this tag in your head or just before your close body tag. -->
    <script async defer src="https://buttons.github.io/buttons.js"></script>

</body>

</html>
