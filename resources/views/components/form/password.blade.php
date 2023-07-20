{{--
var =   class_group,
        field_name,
        type,
        label,
        value,
        placeholder
    --}}
<div class="{{ $class_group ?? null }}" @if (!$show) style="display: none" @endif>
    <label class="form-label" for="{{ $field_name }}">{{ strtoupper(str_replace('_', ' ', $label)) }}</label>
    <input
        type="{{ $type ?? 'password' }}"
        name="{{ strtolower($field_name) }}"
        class="form-control"
        id="{{ $field_name }}"
        value="{{ $value ?? null }}"
        placeholder="{{ $placeholder ? str_replace('_', ' ', $placeholder) : null }}"
        maxlength="{{ $length ?? null }}"
        {{ (isset($required) && $required) ? 'required' : ''}}
        {{ (isset($disabled) && $disabled) ? 'disabled' : ''}}>
</div>
