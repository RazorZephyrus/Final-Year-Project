@php
$json = '';

if ($value == null and $field_name == 'fields') {
    $json = [['name' => 'title', 'type' => 'input', 'length' => 20, 'is_required' => true, 'is_multiple' => false, 'is_relation' => false, 'relation_with' => 'value: is Title Content if is relation true for relation'], ['name' => 'description', 'type' => 'text_area', 'length' => 500, 'is_required' => true, 'is_multiple' => false, 'is_relation' => false, 'relation_with' => 'value: is Title Content if is relation true for relation']];
} else {
    $json = is_array($value) ? $value : json_decode($value, true);
}
@endphp
<div class="format-error-{{ $field_name }}">
</div>
<div class="{{ $class_group ?? null }}" @if (!$show) style="display: none" @endif>
    <label class="form-label" for="{{ $field_name }}">{{ strtoupper(str_replace('_', ' ', $label)) }}</label>
    <input type="hidden" name="{{ $field_name }}" id="id_form_{{ $field_name }}"
        value="{{ json_encode($json, JSON_PRETTY_PRINT) }}">
    <div id="target_{{ $field_name }}" style="min-height: 650px">
        {{ json_encode($json, JSON_PRETTY_PRINT) }}
    </div>
</div>

<script src="https://cdnjs.cloudflare.com/ajax/libs/ace/1.9.4/ace.min.js"
    integrity="sha512-+pbITAOcyxpUx2ZbdypWD0XRjdCzeACA9gsV8szSvoYPtbTWqAEE5uMtE3NQ4n7UgpC4qLcHz9URK5Pd2G4NJg=="
    crossorigin="anonymous" referrerpolicy="no-referrer"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/ace/1.9.4/theme-monokai.min.js"
    integrity="sha512-5BgDk4u9NoUz//sOUsNkyXacMYYG/40YcS+wr8OkQMcQYgNCNtmSwJsKVBfDeOBzEFxcOvLBZHS1W3xmlQzQkQ=="
    crossorigin="anonymous" referrerpolicy="no-referrer"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/ace/1.9.4/worker-json.min.js"
    integrity="sha512-rC0eN5w7amZ440Pxe6E+4PoKU/oMqfTjAcRdsiuDlFUzJoO/nLkuVQzRT+oWf58vbYA0a+oH+KzEaUj6w/gkHg=="
    crossorigin="anonymous" referrerpolicy="no-referrer"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/ace/1.9.4/mode-json.min.js"
    integrity="sha512-YXUz04sMmhEPQR5FLg4/6MFWcrTzZRobwv6cEVWsX9bfos1lm/Z5hfVz4WB3Z3XyhcVjWWUOvudJ+CCxecDI7Q=="
    crossorigin="anonymous" referrerpolicy="no-referrer"></script>

<script>
    var editor = ace.edit("target_{{ $field_name }}");
    editor.setTheme("ace/theme/monokai");
    editor.session.setMode("ace/mode/json");

    var input = document.getElementById('id_form_{{ $field_name }}');

    editor.getSession().setValue(input.value);
    editor.getSession().on('change', function() {
        try {
            console.log('ch.... Corrections');
            input.value = editor.getSession().getValue();
            JSON.stringify(JSON.parse(input.value))
        } catch (error) {
            let err = `<p class="mb-4">
                            <div class="alert alert-danger alert-dismissible" role="alert">
                                Format Error
                                <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                            </div>
                        </p>`;
            $(".format-error-{{ $field_name }}").html(err)
        }
    });

    // const handleChange = () => {
    //     document.getElementById('id_form_{{ $field_name }}').value = JSON.stringify(JSON.parse(editor
    // .getValue()));
    // }
</script>
