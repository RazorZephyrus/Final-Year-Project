<div style="width:160px; height:160px; margin-top:15px;" id="qrcode_{{ $id }}"></div>
@section('script')
    @parent
    <script src="https://cdn.jsdelivr.net/gh/davidshimjs/qrcodejs@gh-pages/qrcode.min.js"></script>
    <script>
        var qrcode = new QRCode("qrcode_{{ $id }}");

        function makeCode() {
            var elText = "{{ $value }}";

            qrcode.makeCode(elText, {
                text: elText,
                width: 128,
                height: 128,
            });
        }

        makeCode();
    </script>
@endsection
