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
        type="{{ $type ?? 'email' }}"
        name="{{ strtolower($field_name) }}"
        {{ (isset($disabled) && $disabled) ? 'disabled' : ''}}
        {{ (isset($required) && $required) ? 'required' : ''}}
        class="form-control"
        id="{{ $field_name }}"
        value="{{ $value ?? null }}"
        maxlength="{{ $length ?? null }}"
        placeholder="{{ $placeholder ? str_replace('_', ' ', $placeholder) : null }}">
</div>
