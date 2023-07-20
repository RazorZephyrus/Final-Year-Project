<div class="col-12">
    <div class="row">

        @forelse ($row as $item)
            <div class="col-md-12"
                style="
                /* background-color: #f3f6f4; */
                padding: 20px;
                margin-bottom: 15px;
                border-radius: 25px;
                border-left: 1px solid #999999;">
                <div class="mb-3">
                    <div class="row g-0">
                        {{-- <div class="col-md-4"> --}}
                        {{-- <img class="card-img card-img-left" src="" alt="Card image" /> --}}
                        {{-- </div> --}}
                        <div class="col-md-12">
                            <div class="demo-inline-spacing" style="float: right;">
                                <div class="btn-group" id="dropdown-icon-demo">
                                    <button type="button" class="btn btn-primary dropdown-toggle"
                                        data-bs-toggle="dropdown" aria-expanded="false">
                                        <i class="bx bx-menu"></i>
                                    </button>
                                    <ul class="dropdown-menu">
                                        <li>
                                            <a href="{{ route('web.contents.show', ['slug' => $content->slug, 'uuid' => $item->uuid]) }}"
                                                class="dropdown-item d-flex align-items-center"><i
                                                    class="bx bxs-door-open scaleX-n1-rtl"></i>Detail</a>
                                        </li>
                                        <li>
                                            <a href="{{ route('web.contents.edit', ['slug' => $content->slug, 'uuid' => $item->uuid]) }}"
                                                class="dropdown-item d-flex align-items-center"><i
                                                    class="bx bx-edit scaleX-n1-rtl"></i>Edit</a>
                                        </li>
                                        <li>
                                            <form id="form_delete_{{ $item->uuid }}"
                                                action="{{ route('web.contents.destroy', ['slug' => $content->slug, 'uuid' => $item->uuid]) }}"
                                                method="POST">
                                                {{ csrf_field() }}
                                                {{ method_field('DELETE') }}
                                                <a href="javascript:void(0);"
                                                    class="dropdown-item d-flex align-items-center"
                                                    onclick="deleteAction('{{ $item->uuid }}', '{{ route('web.contents.destroy', ['slug' => $content->slug, 'uuid' => $item->uuid]) }}')"><i
                                                        class="bx bx-trash scaleX-n1-rtl"></i>Delete</a>
                                            </form>
                                        </li>
                                    </ul>
                                </div>
                            </div>
                            <div class="col-md-10 list-group">
                                <h5 class="title">{{ ucfirst($item->title) }}</h5>
                                <a href="javascript:void(0);"
                                    class="list-group-item list-group-item-action flex-column align-items-start">
                                    <div class="d-flex justify-content-between w-100">
                                        <small class="text-muted"><label
                                                class="badge bg-info">{{ ucfirst($item->status) }}</label></small>
                                    </div>
                                </a>
                                <a href="javascript:void(0);"
                                    class="list-group-item list-group-item-action flex-column align-items-start">
                                    <div class="d-flex">
                                        @foreach ($item->files()->limit(3)->get() as $file)
                                            @if ($file->file->extension == 'jpg' ||
                                                $file->file->extension == 'jpeg' ||
                                                $file->file->extension == 'png' ||
                                                $file->file->extension == 'svg')
                                                <div class="me-4">
                                                    @php
                                                        $imgSrc = ($file->file->storage == 'local') ? url()->to('uploads' . $file->file->url_real) : '//'.$file->file->url;

                                                        if ($file->file?->storage == 'gcs') {
                                                            $imgSrc = 'https://storage.googleapis.com/'.$file->file->url;
                                                        }
                                                    @endphp
                                                    <img src="{{ $imgSrc }}"
                                                        style="object-fit: cover"
                                                        height="200rem" width="200rem"
                                                        onerror="this.onerror=null;this.src='{{ asset('uploads/default/no-image.jpeg') }}';"
                                                         />
                                                </div>
                                            @else
                                                <div class="me-4">
                                                    <img src="{{ url()->to('uploads/default/document.png') }}"
                                                        height="200rem" width="200rem" onerror="this.onerror=null;this.src='{{ asset('uploads/default/no-image.jpeg') }}';"/>
                                                </div>
                                            @endif
                                        @endforeach
                                    </div>
                                    <p class="card-text">
                                        <small class="text-muted">Created At:
                                            {{ $item->created_at }}</small>
                                    </p>
                                </a>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        @empty

            <div class="card mb-4">
                <div class="card-body">
                    <p class="card-text">No Data {{ ucfirst($content->title) }}</p>
                </div>
            </div>
        @endforelse

    </div>
    {{ $row->links() }}
</div>
