{{-- var =   class_group,
        field_name,
        label,
        value,
        placeholder,

        options,
        key_option_value,
        key_option_lable, --}}
        {{-- {{dd($options)}} --}}
        <div class="{{ $class_group ?? null }}" @if (!$show) style="display: none" @endif>

            <label for="{{ $field_name }}" class="form-label">{{ strtoupper(str_replace('_', ' ', $label)) }}</label>
            <br>
            <select id="{{ $field_name }}" name="{{ $field_name }}[]" class="form-select select2-{{ $field_name }}"
                    {{ (isset($disabled) && $disabled) ? 'disabled' : ''}}
                    {{ (isset($required) && $required) ? 'required' : ''}} multiple="multiple">
                <option disabled="true">Select {{ str_replace('_', ' ', $label) }}</option>
                @if (isset($options) AND !is_string($options))
                
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
@section('script')
@parent

    <script>
        $(document).ready(function() {
            $('.select2-{{ $field_name }}').select2({
                tags: true,
                width: '100%',
                @if ($value != null)
                data: {!!json_encode($value, true)!!},
                @endif
                tokenSeparators: [',']
            })
            @if ($value != null)
                $('.select2-{{ $field_name }}').val({!!json_encode($value, true)!!}).trigger('change')
            @endif
        });
    </script>
@endsection
