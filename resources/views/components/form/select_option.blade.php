{{-- var =   class_group,
        field_name,
        label,
        value,
        placeholder,

        options,
        key_option_value,
        key_option_lable, --}}
        @php
            if(isset($value) AND is_bool($value)) {
                $value = var_export($value, 1);
            }
        @endphp
<div class="{{ $class_group ?? null }}" @if (!$show) style="display: none" @endif>
    
    <label for="{{ $field_name }}" class="form-label">{{ strtoupper(str_replace('_', ' ', $label)) }}</label>
    <select id="{{ $field_name }}" name="{{ $field_name }}" class="form-select select2"
        {{ (isset($disabled) && $disabled) ? 'disabled' : ''}}
        {{ (isset($required) && $required) ? 'required' : ''}}>
        <option disabled="true" {{ $value != null ? 'selected' : null }}>Select {{ str_replace('_', ' ', $label) }}</option>
        <option value="" {{ $value != null ? 'selected' : null }}>No {{ str_replace('_', ' ', $label) }}</option>
        @if(isset($options) AND !is_string($options))
            @foreach ($options as $item)
                @php
                    $item = is_array($item) ? (object) $item : $item;
                @endphp
                <option value={{ $item->$key_option_value }} {{ $item->{$key_option_value} == $value ? 'selected' : null }}>
                    {{ $item->{$key_option_label} }}</option>
            @endforeach
        @endif
    </select>
</div>
