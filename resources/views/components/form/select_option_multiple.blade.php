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
    <select id="{{ $field_name }}" name="{{ $field_name }}[]" class="form-select select2" {{ $disable ?? 'disabled' }} multiple="multiple">
        <option disabled="true">Select {{ str_replace('_', ' ', $label) }}</option>
        @foreach ($options as $key => $item)
            @php
                $selected = '';
                $item = is_array($item) ? (object) $item : $item;
                if(!empty($value)) {
                    foreach ($value as $vk => $val) {
                       if($val->{$key_option_value} == $item->{$key_option_value}) {
                           $selected = 'selected';
                       }
                    }
                }
            @endphp
            <option value={{ $item->$key_option_value }} {{ $selected }}>
                {{ $item->{$key_option_label} }}</option>
        @endforeach
    </select>
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