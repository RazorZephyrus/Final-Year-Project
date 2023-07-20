<div class="col-12">
    <div class="row">
        @php
            $fields = $content->fields;
        @endphp
        <table id="datatable-table-list" class="display" style="width:100%">
            <thead>
                <tr>
                    <th>SLUG</th>
                    <th>TITLE</th>
                    <th>STATUS</th>
                    <th style="text-align: right;">ACTION</th>
                </tr>
            </thead>
        </table>

    </div>
</div>
@section('script')
    @parent
    <link href="https://cdn.datatables.net/1.12.1/css/jquery.dataTables.min.css" rel="stylesheet" />
    <script src="https://cdn.datatables.net/1.12.1/js/jquery.dataTables.min.js"></script>
    <script>
        $(function() {

            var table = $('#datatable-table-list').DataTable({
                processing: true,
                serverSide: true,
                ajax: function(data, callback, settings) {
                    let length = data.length;
                    let start = data.start;
                    let page = (start/length)+1;
                    console.log(page, length, start);
                    $.ajaxSetup({
                        headers: {
                            'x-site': `{{ session()->get('site')->uuid }}`
                        }
                    });
                    // make a regular ajax request using data.start and data.length
                    $.get(`{{ url('api/v1/contents') }}`, {
                        content_type: '{{ $content->slug }}',
                        type: 'pagination',
                        all_status: 1,
                        q: data.search.value,
                        page: page,
                        limit: data.length,
                    }, function(res) {
                        // map your server's response to the DataTables format and pass it to
                        // DataTables' callback

                        callback({
                            recordsTotal: res.meta.total,
                            recordsFiltered: res.meta.total,
                            data: res.data
                        });
                    });
                },
                columns: [{
                        data: 'slug'
                    },
                    {
                        data: 'title'
                    },
                    {
                        data: 'status',
                        render:function(data, type, row)
                        {
                            if(data == 'published') {
                                return `<small class="text-muted"><label class="badge bg-primary">${data}</label></small>`;
                            } else {
                                return `<small class="text-muted"><label class="badge bg-danger">${data}</label></small>`;
                            }
                        },
                    },
                    {
                        data: null,
                        render:function(data, type, row)
                        {
                            return `<div class="demo-inline-spacing" style="float: right;">
                                <div class="btn-group" id="dropdown-icon-demo">
                                    <button type="button" class="btn btn-primary dropdown-toggle"
                                        data-bs-toggle="dropdown" aria-expanded="false">
                                        <i class="bx bx-menu"></i>
                                    </button>
                                    <ul class="dropdown-menu">
                                        <li>
                                            <a href="{{ url('/contents/'.$content->slug.'/show') }}/${data.id}"
                                                class="dropdown-item d-flex align-items-center"><i
                                                    class="bx bxs-door-open scaleX-n1-rtl"></i>Detail</a>
                                        </li>
                                        <li>
                                            <a href="{{ url('/contents/'.$content->slug.'/edit') }}/${data.id}"
                                                class="dropdown-item d-flex align-items-center"><i
                                                    class="bx bx-edit scaleX-n1-rtl"></i>Edit</a>
                                        </li>
                                        <li>
                                            <form id="form_delete_${data.id}"
                                                action="{{ url('/contents/'.$content->slug.'/delete') }}/${data.id}"
                                                method="POST">
                                                {{ csrf_field() }}
                                                {{ method_field('DELETE') }}
                                                <a href="javascript:void(0);"
                                                    class="dropdown-item d-flex align-items-center"
                                                    onclick="deleteAction('${data.id}', 
                                                    '{{ url('/contents/'.$content->slug.'/delete') }}/${data.id}')"><i
                                                        class="bx bx-trash scaleX-n1-rtl"></i>Delete</a>
                                            </form>
                                        </li>
                                    </ul>
                                </div>
                            </div>`;
                        },
                    }
                ]
            });

        });
    </script>
@endsection
