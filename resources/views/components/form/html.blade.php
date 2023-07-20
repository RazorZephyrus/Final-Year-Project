{{-- var =   class_group,
        field_name,
        type,
        label,
        value,
        placeholder --}}
{{-- @section('style') --}}
{{-- <link href="https://cdn.quilljs.com/1.3.6/quill.snow.css" rel="stylesheet"> --}}
{{-- @endsection --}}
<script src="{{ asset('assets/vendor/ckeditor/ckeditor.js') }}"></script>
<link rel="stylesheet" href="{{ asset('assets/vendor/ckeditor/toolbarconfigurator/lib/codemirror/neo.css') }}">
<div class="{{ $class_group ?? null }}">
    <label class="form-label" for="{{ $field_name }}">{{ strtoupper(str_replace('_', ' ', $label)) }}</label>
    @if ($disabled ?? false)
        <div id="{{ $field_name }}" class="form-control">{!! $value ?? null !!}</div>
    @else
        {{-- <div id="editor-html-{{ $field_name }}" class="form-control">{!! $value ?? null !!}</div>  --}}
        <textarea id="quill_html-{{ $field_name }}" name="{{ strtolower($field_name) }}">{!! $value ?? null !!}</textarea>
    @endif
</div>

@section('script')
@parent
    {{-- <script src="https://cdn.quilljs.com/1.3.6/quill.js"></script> --}}
    <script>
        $(document).ready(function() {
            // var quill = new Quill('#editor-html-{{ $field_name }}', {
            //     theme: 'snow'
            // });

            // quill.on('text-change', function(delta, oldDelta, source) {
            //     document.getElementById("quill_html-{{ $field_name }}").value = quill.root.innerHTML;
            // });
            CKEDITOR.replace( 'quill_html-{{ $field_name }}' );
            CKEDITOR.editorConfig = function( config ) {
                config.language = 'en';
                config.uiColor = '#F7B42C';
                config.height = 300;
                config.toolbarCanCollapse = true;
            };
        });
    </script>
@endsection
