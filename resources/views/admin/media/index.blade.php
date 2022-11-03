@extends('layout.main')
@section('content')

    <section>
        <div class="container-fluid">
            <button class="btn btn-info" data-toggle="modal" data-target="#createModal"><i class="dripicons-plus"></i> {{trans('file.Add Brand')}} </button>&nbsp;
            <button class="btn btn-primary" data-toggle="modal" data-target="#importBrand"><i class="dripicons-copy"></i> {{trans('file.Import Brand')}}</button>
        </div>
        <div class="table-responsive">
            <table id="media-table" class="table" style="width: 100%">
                <thead>
                <tr>
                    <th class="not-exported"></th>
                    <th>{{trans('file.Image')}}</th>
                    <th>{{trans('file.Brand')}}</th>
                    <th>{{trans('file.Brand')}}</th>
                    <th>{{trans('file.Brand')}}</th>
                    <th class="not-exported">{{trans('file.action')}}</th>
                </tr>
                </thead>
            </table>
        </div>
    </section>

    <script type="text/javascript">
        $("ul#media").siblings('a').attr('aria-expanded','true');
        $("ul#media").addClass("show");
        $("ul#media #media-list-menu").addClass("active");

        $('[data-toggle="tooltip"]').tooltip();

        function confirmDelete() {
            if (confirm("If you delete category all products under this category will also be deleted. Are you sure want to delete?")) {
                return true;
            }
            return false;
        }

        var media_id = [];
        var user_verified = <?php echo json_encode(env('USER_VERIFIED')) ?>;

        $.ajaxSetup({
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            }
        });

        $('#media-table').DataTable( {
            "processing": true,
            "serverSide": true,
            "ajax":{
                type:"post",
                url:"{{ route('media.data') }}",
                dataType: "json",
            },
            "createdRow": function( row, data, dataIndex ) {
                $(row).attr('data-id', data['id']);
            },
            "columns": [
                {"data": "key"},
                {"data": "title"},
                {"data": "description"},
                {"data": "data"},
                {"data": "type"},
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
                            media_id.length = 0;
                            $(':checkbox:checked').each(function(i){
                                if(i){
                                    media_id[i-1] = $(this).closest('tr').data('id');
                                }
                            });
                            if(media_id.length && confirm("If you delete category all products under this category will also be deleted. Are you sure want to delete?")) {
                                $.ajax({
                                    type:'POST',
                                    url:'media/deletebyselection',
                                    data:{
                                        brandIdArray: media_id
                                    },
                                    success:function(data){
                                        dt.rows({ page: 'current', selected: true }).deselect();
                                    }
                                });
                                dt.rows({ page: 'current', selected: true }).remove().draw(false);
                            }
                            else if(!media_id.length)
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

