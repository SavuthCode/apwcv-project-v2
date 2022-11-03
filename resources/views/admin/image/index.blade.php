@extends('layout.main')
@section('content')

    <section>
        <div class="container-fluid">
                <a href="{{route('image.create')}}" class="btn btn-info"><i class="dripicons-plus"></i> {{__('file.add_product')}}</a>
                <a href="#" data-toggle="modal" data-target="#importProduct" class="btn btn-primary"><i class="dripicons-copy"></i> {{__('file.import_product')}}</a>
        </div>
        <div class="table-responsive">
            <table id="image-table" class="table" style="width: 100%">
                <thead>
                <tr>
                    <th class="not-exported"></th>
                    <th>{{trans('file.Image')}}</th>
                    <th>{{trans('file.Title')}}</th>
                    <th>{{trans('file.description')}}</th>
                    <th class="not-exported">{{trans('file.action')}}</th>
                </tr>
                </thead>
            </table>
        </div>
    </section>

    <script type="text/javascript">
        $("ul#product").siblings('a').attr('aria-expanded','true');
        $("ul#product").addClass("show");
        $("ul#product #product-list-menu").addClass("active");

        $('[data-toggle="tooltip"]').tooltip();

        function confirmDelete() {
            if (confirm("If you delete category all products under this category will also be deleted. Are you sure want to delete?")) {
                return true;
            }
            return false;
        }

        var image_id = [];
        var user_verified = <?php echo json_encode(env('USER_VERIFIED')) ?>;

        $.ajaxSetup({
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            }
        });

        $('#image-table').DataTable( {
            "processing": true,
            "serverSide": true,
            "ajax":{
                type:"post",
                url:"{{ route('image.data') }}",
                dataType: "json",
            },
            "createdRow": function( row, data, dataIndex ) {
                $(row).attr('data-id', data['id']);
            },
            "columns": [
                {"data": "key"},
                {"data": "data"},
                {"data": "title"},
                {"data": "description"},
                {"data": "options"},
            ],
            'language': {
                'lengthMenu': '_MENU_ {{trans("file.records per page")}}',
                "info":      '<small>{{trans("file.Showing")}} _START_ - _END_ (_TOTAL_)</small>',
                "search":  '{{trans("file.Search")}}',
                'paginate': {
                    'previous': '<i class="dripicons-chevron-left"></i>',
                    'next': '<i class="dripicons-chevron-right"></i>'
                }
            },
            order:[['2', 'asc']],
            'columnDefs': [
                {
                    "orderable": false,
                    'targets': [0,1,3]
                },
                {
                    'render': function(data, type, row, meta){
                        if(type === 'display'){
                            data = '<div class="checkbox"><input type="checkbox" class="dt-checkboxes"><label></label></div>';
                        }

                        return data;
                    },
                    'checkboxes': {
                        'selectRow': true,
                        'selectAllRender': '<div class="checkbox"><input type="checkbox" class="dt-checkboxes"><label></label></div>'
                    },
                    'targets': [0]
                }
            ],
            'select': { style: 'multi',  selector: 'td:first-child'},
            'lengthMenu': [[10, 25, 50, -1], [10, 25, 50, "All"]],

            dom: '<"row"lfB>rtip',
            buttons: [
                {
                    extend: 'pdf',
                    text: '{{trans("file.PDF")}}',
                    exportOptions: {
                        columns: ':visible:Not(.not-exported)',
                        rows: ':visible'
                    },
                    footer:true
                },
                {
                    extend: 'csv',
                    text: '{{trans("file.CSV")}}',
                    exportOptions: {
                        columns: ':visible:Not(.not-exported)',
                        rows: ':visible'
                    },
                    footer:true
                },
                {
                    extend: 'print',
                    text: '{{trans("file.Print")}}',
                    exportOptions: {
                        columns: ':visible:Not(.not-exported)',
                        rows: ':visible'
                    },
                    footer:true
                },
                {
                    text: '{{trans("file.delete")}}',
                    className: 'buttons-delete',
                    action: function ( e, dt, node, config ) {
                        if(user_verified == '1') {
                            image_id.length = 0;
                            $(':checkbox:checked').each(function(i){
                                if(i){
                                    image_id[i-1] = $(this).closest('tr').data('id');
                                }
                            });
                            if(image_id.length && confirm("If you delete category all products under this category will also be deleted. Are you sure want to delete?")) {
                                $.ajax({
                                    type:'POST',
                                    url:'image/deletebyselection',
                                    data:{
                                        imageIdArray: image_id
                                    },
                                    success:function(data){
                                        dt.rows({ page: 'current', selected: true }).deselect();
                                    }
                                });
                                dt.rows({ page: 'current', selected: true }).remove().draw(false);
                            }
                            else if(!image_id.length)
                                alert('No category is selected!');
                        }
                        else
                            alert('This feature is disable for demo!');
                    }
                },
                {
                    extend: 'colvis',
                    text: '{{trans("file.Column visibility")}}',
                    columns: ':gt(0)'
                },
            ],
        } );

    </script>
@endsection

