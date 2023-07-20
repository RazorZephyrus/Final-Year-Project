{{-- var =   class_group,
        field_name,
        type,
        label,
        value,
        placeholder --}}
<div class="{{ $class_group ?? null }}">
    <label class="form-label" for="{{ $field_name }}">{{ strtoupper(str_replace('_', ' ', $label)) }}</label>
    <textarea
        id="{{ $field_name }}"
        name="{{ strtolower($field_name) }}"
        class="form-control"
        placeholder="{{ $placeholder ? str_replace('_', ' ', $placeholder) : null }}"
        maxlength="{{ $length ?? null }}"
        {{ (isset($required) && $required) ? 'required' : ''}}
        {{ (isset($disabled) && $disabled) ? 'disabled' : ''}}>{{ $value ?? null }}</textarea>
</div>
