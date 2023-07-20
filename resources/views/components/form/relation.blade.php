{{-- var =   class_group, 
        field_name, 
        label, 
        value, 
        placeholder,

        options,
        key_option_value,
        key_option_lable, --}}
@php
    $relation = $options;
    $content = \App\Models\Content::where('slug', $relation)->where('site_id', session()->get('site')->id)->first();
    if ($content != null) {
        $values = $content->contentValues;
        $options = $values;
        $key_option_value = 'id';
        $key_option_label = 'title';
    } else {
        $options = [];
    }

    $disable = '';
    if(isset($disabled)) {
        $disable = 'disabled';
    }
@endphp
<div class="{{ $class_group ?? null }}" @if (!$show) style="display: none" @endif>
    <label for="{{ $field_name }}" class="form-label">{{ strtoupper(str_replace('_', ' ', $label)) }}</label>
    <select id="{{ $field_name }}" name="{{ $field_name }}" class="form-select select2" {{ $disable }}>
        <option disabled="true" {{ $value != null ? 'selected' : null }}>Select {{ str_replace('_', ' ', $label) }}</option>
        @if (isset($options) && count($options) > 0)    
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
