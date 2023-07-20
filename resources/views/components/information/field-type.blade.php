<label>Format Possible field types:</label>
@php
$json = ['name' => 'title', 'type' => 'input', 'length' => 20, 'is_required' => true, 'is_multiple' => false, 'is_relation' => false, 'relation_with' => 'value: is Title Content if is relation true for relation'];
@endphp
<small>
<code>
    <pre>
{{ json_encode($json, JSON_PRETTY_PRINT) }}
    </pre>
</code>

<pre>
# Possible field types:
    # input - varchar(256) - input type text.
    # password - varchar(256) - input type Password.
    # number - double - Input field for numbers, with `mode: integer` or `mode: float`.
    # image - varchar(256) - image select/upload widget, stored as filename.
    # file - varchar(256) - file select/upload widget, stored as filename. * "accept" parameter must be provided
    # embed - text (65kb) - embed widget for video and audio. Stored as JSON.
    # html - text (65kb) - wysiwyg element.
    # json - JSON - JSON element.
    # text_area - varchar(32768) - Simple, plain < textarea > field.
    # date - datetime - date selector widget, with `mode: date` or `mode: datetime`
    # email - text(65kb) - Input type for email.
    # select_option - varchar(256) - select with predefined values
    # select_option_multiple - varchar(256) - select with predefined values
    # checkbox - integer - checkbox-field which is 1 (checked) or 0 (unchecked)
    # radio - integer - checkbox-field which is 1 (checked) or 0 (unchecked)
    # tag - varchar (255) - Input type for tags.

# Additional 
    #if using number you can add "min": "your_number_min" and "max": "your_number_max".
    
# "info" Atributes information For type Image Or File (Only Image / File / email) 
    # "info": { "size": "200MB", "type_file": "Hanya Image", "additional": "", "resolution": "300x400"},
    # "info": { "mailchimp": true },

# "accept" attributes values for file
    # file_extension - Specify the file extension(s) (e.g: .gif, .jpg, .png, .doc) the user can pick from
    # audio/* - The user can pick all sound files
    # video/* - The user can pick all video files
    # image/* - The user can pick all image files

# "accept" attributes values for Number
    # disable-minus

# "relation_with" Atributes Option (Only select_option) If not Relation
    # [{"title": "Show","value": "show"},{"title": "Hide","value": "hide"}]
</pre>
</small>
