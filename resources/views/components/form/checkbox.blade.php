{{-- var =   class_group,
        field_name,
        label,
        value,
        placeholder,

        options,
        key_option_value,
        key_option_lable, --}}

<div class="{{ $class_group ?? null }}" @if (!$show) style="display: none" @endif>

    <label for="{{ $field_name }}" class="form-label">{{ strtoupper(str_replace('_', ' ', $label)) }}</label>
    <div class="form-check mt-3">
        @if(isset($options) AND !is_string($options))
        @foreach ($options as $key => $item)
            @php
                $selected = '';
                $item = is_array($item) ? (object) $item : $item;
                if(!empty($value)) {
                    foreach ($value as $vk => $val) {
                    if($val->{$key_option_value} == $item->{$key_option_value}) {
                        $selected = 'checked';
                    }
                    }
                }
            @endphp
            <input class="form-check-input" name="{{ $field_name }}[]" type="checkbox" value="{{ $item->$key_option_value }}" id="{{ 'checkbox-'.$item->{$key_option_label}.$key }}"
                {{ (isset($disabled) && $disabled) ? 'disabled' : ''}}
                {{ (isset($required) && $required) ? 'required' : ''}} {{ $selected }}>
            <label class="form-check-label" for="{{ 'checkbox-'.$item->{$key_option_label}.$key }}">{{ $item->{$key_option_label} }}
            </label>
        @endforeach
        @endif
      </div>
</div>
@section('script')
@parent
    <link href="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/css/select2.min.css" rel="stylesheet" />
    <script src="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/js/select2.min.js"></script>
    <script>
        $(document).ready(function() {
            $('.select2').select2();
        });
    </script>
@endsection
