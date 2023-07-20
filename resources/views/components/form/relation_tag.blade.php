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
$content = \App\Models\Content::where('slug', $relation)
    ->where('site_id', session()->get('site')->id)
    ->first();
if ($content != null) {
    $values = $content->contentValues;
    $options = $values;
    $key_option_value = 'id';
    $key_option_label = 'title';
} else {
    $options = [];
}
@endphp
<div class="{{ $class_group ?? null }}" @if (!$show) style="display: none" @endif>

    <label for="{{ $field_name }}" class="form-label">{{ strtoupper(str_replace('_', ' ', $label)) }}</label>
    <br>
    <select id="select2-relation-tag-{{ $field_name }}" name="{{ $field_name }}[]" class="form-select select2-relation-tag-{{ $field_name }} select2-tags"
            {{ (isset($disabled) && $disabled) ? 'disabled' : ''}} multiple="multiple">
        <option disabled="true">Select {{ str_replace('_', ' ', $label) }}</option>
        @if (isset($options))
            @foreach ($options as $key => $item)
                {{-- @php
                        $selected = '';
                        $item = is_array($item) ? (object) $item : $item;
                        if(!empty($value)) {
                            foreach ($value as $vk => $val) {
                               if($val == $item->{$key_option_value}) {
                                   $selected = 'selected';
                               }
                            }
                        }
                    @endphp --}}
                <option value={{ $item->$key_option_value }}>
                    {{ $item->{$key_option_label} }}</option>
            @endforeach
        @endif
    </select>
</div>
@section('script_inner_tag_js')
{{-- <script> --}}
    @parent
    $(document).ready(function() {
        $('#select2-relation-tag-{{ $field_name }}').select2({
                tags: true,
                width: '100%',
                @if ($value != null)
                data: {!!json_encode($value, true)!!},
                @endif
                tokenSeparators: [',', ' ']
            })
        @if ($value != null)
            $('#select2-relation-tag-{{ $field_name }}').val({!!json_encode($value, true)!!}).trigger('change')
        @endif
    });
{{-- </script> --}}
@endsection
