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
                            <h3>Apa Saja Syarat Menginap di Book It ?</h3>
                        </div>
                        <!-- Layout Demo -->
                        <div class="card border border-primary mb-3">
                            <div class="card-body">
                                <h5 class="card-title">Bagaimana cara membuat akun Book It?</h5>
                                <p class="card-text">Anda dapat mendaftarkan diri anda dengan cara mengklik tombol login dan silahkan isikan data pada form pendaftaran yang sudah disediakan.</p>
                            </div>
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