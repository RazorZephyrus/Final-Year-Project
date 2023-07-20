{{--
var =   class_group,
        field_name,
        type,
        label,
        value,
        placeholder
    --}}
{{-- {{ dd($item) }} --}}
<div class="{{ $class_group ?? null }}" @if (!$show) style="display: none" @endif>
    <label class="form-label" for="{{ $field_name }}">{{ strtoupper(str_replace('_', ' ', $label)) }}</label>
    <input min="{{ $min }}" max="{{ $max }}"
        oninput="if (this.value < {{ $min }}) this.value = {{ $min }}; if (this.value > {{ $max }}) this.value = {{ $max }}"
        type="{{ isset($format) && $format == 'currency' ? 'text' : 'number' }}" name="{{ strtolower($field_name) }}"
        {{ isset($disabled) && $disabled ? 'disabled' : '' }} {{ isset($required) && $required ? 'required' : '' }}
        class="form-control" id="{{ $field_name }}" value="{{ $value ?? null }}"
        placeholder="{{ $placeholder ? str_replace('_', ' ', $placeholder) : null }}">
</div>

@if ($accept == 'disable-minus')
    @section('script')
        @parent
        <script>
            $('#{{ $field_name }}').on('keyup', function() {
                let value = Math.abs(this.value)
                $(this).val(value)
            });
        </script>
    @endsection
@endif
@if (isset($format) && $format == 'currency')
    @section('script')
        @parent
        <script>
            $("#{{ $field_name }}").on("change", null, function() {
                var $input = $(this),
                    value = this.value,
                    num = parseFloat(value).toFixed(2).replace(/(\d)(?=(\d{3})+\.)/g, '$1,');
                $input.val(num);
            });
        </script>
    @endsection
@endif
