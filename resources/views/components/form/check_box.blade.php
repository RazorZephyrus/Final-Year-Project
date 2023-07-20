<div class="app-form-check form-check mb-4 d-flex align-items-center">
    <input {{ !empty($disabled) ? 'disabled' : '' }} class="form-check-input {{ !empty($size) ? $size : '' }}" name="{{ $field }}" type="checkbox" value="{{ $value }}"
        {{ !empty($id) ? 'id=' . $id : '' }} {{ $checked ?? false ? 'checked' : '' }}>
    @if (!empty($label))
        <label class="form-check-label font-bold ps-2" for="{{ $id ?? '' }}">
            {{ str_replace('_', ' ', $label) }}
        </label>
    @endif

</div>
@error($error_field ?? $field)
    <span class="app-invalid-feedback invalid-feedback" role="alert">
        <strong>{{ $message }}</strong>
    </span>
@enderror
