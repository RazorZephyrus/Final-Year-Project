<div class="col-12">
    <div class="row">
        @php
            $item = isset($row[0]) ? $row[0] : [];
            $row = $item;
        @endphp

        @if (isset($item->status))
            <div class="card-body">
                @include('components.alert.error-field')
                @php
                    $fields = $content->fields;
                @endphp

                @if (count($fields) > 0 and $fields != null)
                    @foreach ($fields as $item)
                        @if ($item['type'] == 'image' or $item['type'] == 'file')
                            @include('components.form.' . $item['type'], [
                                'class_group' => 'mb-3',
                                'field_name' => strtolower(
                                    trim(preg_replace('/[^A-Za-z0-9-]+/', '_', $item['name']))),
                                'label' => strtoupper($item['name']),
                                'value' => old(strtolower($item['name']), null),
                                'placeholder' => strtoupper($item['name']),
                                'show' => true,
                                'required' => $item['is_required'],
                                'disabled' => true,
                                'src' =>
                                    $row->file()->where('title', $item['name'])->first()?->file?->storage == 'local'
                                        ? url()->to(
                                            'uploads' .
                                                $row->file()->where('title', $item['name'])->first()?->file?->url_real)
                                        : '//' .
                                            $row->file()->where('title', $item['name'])->first()?->file?->url,
                            ])

                            @if ($row->file()->where('title', $item['name'])->first()?->file)
                                @if ($item['type'] == 'file')
                                    <a target="_blank" rel="noopener noreferrer"
                                        href="{{ $row->file()->where('title', $item['name'])->first()?->file?->storage == 'local'
                                            ? url()->to(
                                                'uploads' .
                                                    $row->file()->where('title', $item['name'])->first()?->file?->url_real,
                                            )
                                            : '//' .
                                                $row->file()->where('title', $item['name'])->first()?->file?->url }}"
                                        class="btn btn-link pb-4"><i class='bx bx-cloud-download'></i> SHOW</a>
                                @endif
                            @endif
                        @elseif ($item['is_relation'] and !$item['is_multiple'])
                            @include('components.form.relation', [
                                'class_group' => 'mb-3',
                                'field_name' => strtolower(
                                    trim(preg_replace('/[^A-Za-z0-9-]+/', '_', $item['name']))),
                                'label' => strtoupper($item['name']),
                                'value' => old(
                                    strtolower(trim(preg_replace('/[^A-Za-z0-9-]+/', '_', $item['name']))),
                                    $row->value[
                                        strtolower(trim(preg_replace('/[^A-Za-z0-9-]+/', '_', $item['name'])))
                                    ] ?? null),
                                'placeholder' => strtoupper($item['name']),
                                'show' => true,
                                'options' => $item['relation_with'],
                                'required' => $item['is_required'],
                                'disabled' => true,
                            ])
                        @elseif ($item['is_relation'] and !$item['is_multiple'])
                            @include('components.form.relation_multiple', [
                                'class_group' => 'mb-3',
                                'field_name' => strtolower(
                                    trim(preg_replace('/[^A-Za-z0-9-]+/', '_', $item['name']))),
                                'label' => strtoupper($item['name']),
                                'value' => old(
                                    strtolower(trim(preg_replace('/[^A-Za-z0-9-]+/', '_', $item['name']))),
                                    $row->value[
                                        strtolower(trim(preg_replace('/[^A-Za-z0-9-]+/', '_', $item['name'])))
                                    ] ?? null),
                                'placeholder' => strtoupper($item['name']),
                                'show' => true,
                                'options' => $item['relation_with'],
                                'required' => $item['is_required'],
                                'disabled' => true,
                            ])
                        @elseif ($item['is_relation'] and $item['is_multiple'] and $item['type'] == 'tag')
                            @include('components.form.relation_tag', [
                                'class_group' => 'mb-3',
                                'field_name' => strtolower(
                                    trim(preg_replace('/[^A-Za-z0-9-]+/', '_', $item['name']))),
                                'label' => strtoupper($item['name']),
                                'value' => old(
                                    strtolower(trim(preg_replace('/[^A-Za-z0-9-]+/', '_', $item['name']))),
                                    $row->value[
                                        strtolower(trim(preg_replace('/[^A-Za-z0-9-]+/', '_', $item['name'])))
                                    ] ?? null),
                                'placeholder' => strtoupper($item['name']),
                                'show' => true,
                                'options' => $item['relation_with'],
                                'required' => $item['is_required'],
                                'disabled' => true,
                            ])
                        @elseif (
                            !$item['is_relation'] and
                                $item['relation_with'] != null and
                                $item['relation_with'] != '' and
                                $item['type'] == 'select_option')
                            @include('components.form.' . $item['type'], [
                                'class_group' => 'mb-3',
                                'field_name' => strtolower(
                                    trim(preg_replace('/[^A-Za-z0-9-]+/', '_', $item['name']))),
                                'label' => strtoupper($item['name']),
                                'value' => old(
                                    strtolower(trim(preg_replace('/[^A-Za-z0-9-]+/', '_', $item['name'])))),
                                'placeholder' => strtoupper($item['name']),
                                'show' => true,
                                'options' => $item['relation_with'],
                                'required' => $item['is_required'],
                                'key_option_value' => 'value',
                                'key_option_label' => 'title',
                                'disabled' => true,
                                'accept' => $item['accept'] ?? null,
                            ])
                        @else
                            @include('components.form.' . $item['type'], [
                                'class_group' => 'mb-3',
                                'field_name' => strtolower(
                                    trim(preg_replace('/[^A-Za-z0-9-]+/', '_', $item['name']))),
                                'label' => strtoupper($item['name']),
                                'value' => old(
                                    strtolower(trim(preg_replace('/[^A-Za-z0-9-]+/', '_', $item['name']))),
                                    $row->value[
                                        strtolower(trim(preg_replace('/[^A-Za-z0-9-]+/', '_', $item['name'])))
                                    ] ?? null),
                                'placeholder' => strtoupper($item['name']),
                                'show' => true,
                                'required' => $item['is_required'],
                                'options' => $item['relation_with'],
                                'accept' => $item['accept'] ?? null,
                                'length' => $item['length'] ?? null,
                                'min' => $item['min'] ?? null,
                                'max' => $item['max'] ?? null,
                                'disabled' => true,
                            ])
                        @endif
                    @endforeach
                @endif

                @include('components.form.select_option', [
                    'class_group' => 'mb-3',
                    'field_name' => 'status',
                    'label' => 'Status',
                    'value' => $row->status,
                    'placeholder' => '',
                    'options' => App\Models\ContentValue::LIST_STATUS,
                    'key_option_value' => 'value',
                    'key_option_label' => 'label',
                    'show' => true,
                    'disabled' => true,
                ])
            </div>
        @else
            <div class="card-body">
                <p class="card-text">No Data {{ ucfirst($content->title) }}</p>
            </div>
        @endif
    </div>
</div>
