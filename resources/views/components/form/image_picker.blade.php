<div class="mb-4">
    @if (!empty($image_url))
        <div class="app-btn-add-image has-image " style="background-image: url({{ $image_url }})">
            <a href="{{ $image_url }}" target="_blank">
                <div class="app-btn-add-image has-link"></div>
            </a>

            <div class="font-sm d-none app-file-dummy-label" id="input_{{ $field }}_placed_wrap">1 file </div>

            <div class="btn-actions p-2">
                <a href="#" class="btn btn-primary app-btn-icon app-btn-center-inline"
                    data-target="input_{{ $field }}">
                    @component('icons.btn.camera')
                    @endcomponent
                </a>
                <a href="{{ $delete_url }}" class="btn btn-primary app-btn-icon app-btn-center-inline">
                    @component('icons.btn.delete')
                    @endcomponent
                </a>
            </div>
        </div>
    @else
        <a href="#" class="app-btn-add-image text-decoration-none" data-target="input_{{ $field }}">
            <div>
                @component('icons.btn.add_image')
                @endcomponent
                <div class="font-sm d-none" id="input_{{ $field }}_placed">1 file </div>
            </div>
        </a>


    @endif

    <div class="py-4 d-none">
        <input type="file" name="{{ $field }}" id="input_{{ $field }}">
    </div>

    @error($error_field ?? $field)
        <span class="app-invalid-feedback invalid-feedback" role="alert">
            <strong>{{ $message }}</strong>
        </span>
    @enderror

</div>
