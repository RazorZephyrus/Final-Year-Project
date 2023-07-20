<!DOCTYPE html>
<!-- beautify ignore:start -->
@include('front.include.header')
<style>
    iframe {
        width: 100%;
    }
</style>
<body>

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
                            <div class="col-12">
                                {!! $row->lokasi !!}
                            </div>
                        </div>
                        <h4 class="pb-1 mt-4 mb-4">{{ $row->title }}</h4>
                        <div class="card mb-2">
                            <div class="card-body">
                                <div class="row md-5">
                                    <div class="col-8">
                                      <h5 class="card-title">Aturan :</h5>
                                      <p class="card-text">{!! $row->asrama_role !!}</p>
                                      <h5 class="card-title">Informasi Lainnya :</h5>
                                      <p class="card-text">{!! $row->informasi_lainnya !!}</p>
                                    </div>
                                    <div class="col-4">
                                        <img class="card-img-top" style="width: 250px;"
                                            src="{{ url('files') . '?_path=' . $row->image->path }}" alt="Card image cap" />
                                    </div>
                                </div>
                                <hr>
                                <div class="row mt-3">
                                    <div class="col-4">
                                      <h5 class="card-title">Alamat</h5>
                                      <p class="card-text">{{ $row->address }}</p>
                                    </div>
                                    <div class="col-4">
                                      <h5 class="card-title">Kontak</h5>
                                      <p class="card-text">{{ $row->no_kontak }}</p>
                                    </div>
                                    <div class="col-4">
                                      <h5 class="card-title">Rekening</h5>
                                      <p class="card-text">{{ $row->bank }} : {{ $row->no_rekening }}</p>
                                    </div>
                                </div>
                            </div>  
                          </div>
                        <nav class="navbar navbar-expand-lg navbar-light bg-light mb-3">
                            <div class="container-fluid">
                                <a class="navbar-brand" href="javascript:void(0)"><i class='bx bx-filter-alt'></i> Filter</a>
                                <button class="navbar-toggler" type="button" data-bs-toggle="collapse"
                                    data-bs-target="#navbarSupportedContent" aria-controls="navbarSupportedContent"
                                    aria-expanded="false" aria-label="Toggle navigation">
                                    <span class="navbar-toggler-icon"></span>
                                </button>
                                <div class="collapse navbar-collapse" id="navbarSupportedContent">
                                    <ul class="navbar-nav me-auto mb-2 mb-lg-0">
                                        <li class="nav-item dropdown">
                                            <a class="nav-link dropdown-toggle" href="javascript:void(0)"
                                                id="navbarDropdown" role="button" data-bs-toggle="dropdown"
                                                aria-expanded="false">
                                                {{ request('room_type') == null ? 'Tipe Kamar' : \App\Models\RoomType::where('uuid', request('room_type'))->where('asrama_id', $row->id)->first()->title }}
                                            </a>
                                            @php
                                                $roomType = \App\Models\RoomType::where('asrama_id', $row->id)->get();
                                            @endphp
                                            <ul class="dropdown-menu" aria-labelledby="navbarDropdown">
                                                <li><a class="dropdown-item" href="{{ url()->current() }}">{{ "Semua Tipe Kamar" }}</a></li>
                                                @foreach ($roomType as $item)
                                                    <li><a class="dropdown-item" href="{{ url()->current().'?room_type='.$item->uuid }}">{{ $item->title }}</a></li>
                                                @endforeach
                                            </ul>
                                        </li>
                                    </ul>
                                    <form class="d-flex" onsubmit="return false">
                                        <input class="form-control me-2" id="search-input" type="search" placeholder="Search"
                                            aria-label="Search" value="{{ request('q') }}">
                                        <button class="btn btn-outline-primary" onclick="doSearch()" type="submit">Search</button>
                                    </form>
                                </div>
                            </div>
                        </nav>
                        <!-- Layout Demo -->
                        <div class="row mb-2">
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
                            <div class="col-md-12 mb-4">
                                <div class="card">
                                    <div class="card-body">
                                        <div class="row">
                                            <div class="col-3">
                                                @if(empty($images))
                                                <img class="card-img-top" style="width: 300px; height: 218px;" src="../assets/img/elements/kamar.jpg"
                                                    alt="Card image cap" />
                                                @else
                                                <img class="card-img-top" style="width: 300px; height: 218px;" src="{{ url('files').'?_path='.$images[0]->path }}"
                                                    alt="Card image cap" />
                                                @endif
                                            </div>
                                            <div class="col">
                                                <div class="text-light small fw-semibold">Stok Kamar Tersedia</div>
                                                <h3 class="card-title">{{ $item->title }}</h2>
                                                <h5 class="card-title">Fasilitas</h5>
                                                <small>
                                                    <ul class="list-unstyled mt-2">
                                                        @if (isset($item->RoomFasilitas))
                                                            @foreach ($item->RoomFasilitas as $rf)
                                                            <li>
                                                                <ul>
                                                                    <li>{{ $rf?->fasilitas?->title }}</li>
                                                                </ul>
                                                            </li>
                                                            @endforeach
                                                        @else
                                                        <li>Tidak Ada Fasilitas, Hubungi Administrator untuk informasi lebih tentang Kamar ini</li>
                                                        @endif
                                                        
                                                    </ul>
                                                </small>
                                                    <div class="card-title mb-0">
                                                        <h5 class="m-2 me-2">Rp. {{ number_format($item->perhari) }} / Hari</h5>
                                                        <a href="{{ route('web.homepage.room-detail.front', ['id' => $item->uuid]) }}" class="btn btn-primary">Lihat Lebih Detail</a>
                                                    </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            @endforeach
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
    <script>
        function replaceUrlParam(paramName, paramValue){
            var url = window.location.href;

            if (paramValue == null) {
                paramValue = '';
            }

            var pattern = new RegExp('\\b('+paramName+'=).*?(&|#|$)');
            if (url.search(pattern)>=0) {
                return url.replace(pattern,'$1' + paramValue + '$2');
            }

            url = url.replace(/[?#]$/,'');
            return url + (url.indexOf('?')>0 ? '&' : '?') + paramName + '=' + paramValue;
        }

        function doSearch() {
            let value = $('#search-input').val();

            var url = "{{ url()->full() }}";  

            let a = replaceUrlParam('q', value)

            window.location.replace(a);
        }
    </script>
</body>

</html>
