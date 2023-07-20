{{-- var =   class_group,
        field_name,
        label,
        value,
        placeholder,

        options,
        key_option_value,
        key_option_lable, --}}
<div class="row {{ $class_group ?? null }} d-flex align-items-center"
    @if (!$show) style="display: none" @endif>
    <label for="{{ $field_name }}" class="form-label col-md-6"
        style="padding-top: 5px; padding-left: 5%;">{{ strtoupper(str_replace('_', ' ', $label)) }}</label>

    <div class="col-md-6">
        <div class="form-check">
            @if (isset($options))
                <div class="row">
                    @foreach ($options as $key => $item)
                        <div class="col-6">
                            @php
                                $item = is_array($item) ? (object) $item : $item;
                            @endphp
                            <input value="{{ $item->$key_option_value }}" name="{{ $field_name }}"
                                class="form-check-input" type="radio"
                                {{ $value == $item->$key_option_value ? 'checked' : null }}
                                id="{{ 'radio-' . $key . '-' . $field_name }}"
                                {{ isset($disabled) && $disabled ? 'disabled' : '' }}
                                {{ isset($required) && $required ? 'required' : '' }}>
                            <label class="form-check-label" id="{{ 'radio-' . $key . '-' . $field_name }}">
                                {{ $item->{$key_option_label} }}
                            </label>
                        </div>
                    @endforeach
                </div>
            @endif
        </div>
    </div>
</div>
