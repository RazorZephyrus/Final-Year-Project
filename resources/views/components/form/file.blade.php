{{-- var =   class_group,
        field_name,
        type,
        label,
        value,
        placeholder --}}
@php
    $multiple = $multiple ?? false;
    $information = isset($info) ? $info : null;
@endphp
<div class="{{ $class_group ?? null }}" @if (!$show) style="display: none" @endif>
    <label class="form-label" for="{{ $field_name }}">{{ strtoupper(str_replace('_', ' ', $label)) }}</label>
    @if ($multiple)
        <input
            class="form-control"
            type="file"
            id="{{ $field_name }}"
            name="{{ $field_name }}"
            {{ (isset($disabled) && $disabled) ? 'disabled' : ''}}
            {{ (isset($required) && $required && !isset($src)) ? 'required' : ''}}
            accept="{{ $accept ?? '*' }}"
            multiple>
    @else
        <input
            class="form-control"
            type="file"
            id="{{ $field_name }}"
            name="{{ $field_name }}"
            {{ (isset($disabled) && $disabled) ? 'disabled' : ''}}
            {{ (isset($required) && $required && !isset($src)) ? 'required' : ''}}
            accept="{{ $accept ?? 'image/*' }}">
    @endif
    @if ($information != null)
        <div class="mt-2 alert alert-secondary" role="alert">
            <small>
                @foreach ($information as $k => $item)
                    {{ $k }}: {{ $item }}<br>
                @endforeach
            </small>
        </div>
    @endif
</div>
