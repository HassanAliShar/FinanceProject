<!-- BEGIN Page Footer -->
{{-- <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.4.1/jquery.min.js"></script> --}}
@include('includes.page_scripts')
<script>
   $(document).ready(function()
    {
        // Setup - add a text input to each footer cell
        //$('#dt-basic-example thead tr').clone(true).appendTo('#dt-basic-example thead');
        //$('#dt-basic-example thead tr:eq(1) th').each(function(i)
        //{
        //    var title = $(this).text();
        //    $(this).html('<input type="text" class="form-control form-control-sm product'+i+'" placeholder="Search ' + title + '" />');

        //    $('input', this).on('keyup change', function()
        //    {
        //        if (table.column(i).search() !== this.value)
        //        {
        //            table
        //                .column(i)
        //                .search(this.value)
        //                .draw();
        //        }
        //    });
        //});

        // initialize datatable
        $('#dt-basic-example').dataTable(
        {
            // "columnDefs": [
            //     {
            //         "targets": [ 2,3 ],
            //         "visible": false,
            //     },

            // ],
            orderCellsTop: true,
            responsive: true,
            lengthChange: true,
            processing: true,
            order: [[ 1, "desc" ]],
            dom:"<'row mb-3'<'col-sm-12 col-md-6 d-flex align-items-center justify-content-start'f><'col-sm-12 col-md-6 d-flex align-items-center justify-content-end'lB>>" +
                "<'row'<'col-sm-12'tr>>" +
                "<'row'<'col-sm-12 col-md-5'i><'col-sm-12 col-md-7'p>>",
            buttons: [
                /*{
                    extend:    'colvis',
                    text:      'Column Visibility',
                    titleAttr: 'Col visibility',
                    className: 'mr-sm-3'
                },*/
                {
                    extend: 'colvis',
                    text: 'Column Visibility',
                    titleAttr: 'Col visibility',
                    className: 'btn-outline-default'
                },
                // {
                //     extend: 'pdfHtml5',
                //     text: 'PDF',
                //     titleAttr: 'Generate PDF',
                //     className: 'btn-outline-danger btn-sm mr-1'
                // },
                // {
                //     extend: 'excelHtml5',
                //     text: 'Excel',
                //     titleAttr: 'Generate Excel',
                //     className: 'btn-outline-success btn-sm mr-1',
                //     exportOptions: {
                //     columns: [ 0, 1, 3, 4, ]
                //     }

                // },
                // {
                //     extend: 'csvHtml5',
                //     text: 'CSV',
                //     titleAttr: 'Generate CSV',
                //     className: 'btn-outline-primary btn-sm mr-1'
                // },
                // {
                //     extend: 'print',
                //     text: 'Print',
                //     titleAttr: 'Print Table',
                //     className: 'btn-outline-primary btn-sm'
                // }
            ]
        });
        $('#dt-basic-example2').dataTable(
        {
            // "columnDefs": [
            //     {
            //         "targets": [ 2,3 ],
            //         "visible": false,
            //     },

            // ],
            orderCellsTop: true,
            responsive: true,
            lengthChange: true,
            processing: true,
            order: [[ 1, "desc" ]],
            dom:"<'row mb-3'<'col-sm-12 col-md-6 d-flex align-items-center justify-content-start'f><'col-sm-12 col-md-6 d-flex align-items-center justify-content-end'lB>>" +
                "<'row'<'col-sm-12'tr>>" +
                "<'row'<'col-sm-12 col-md-5'i><'col-sm-12 col-md-7'p>>",
            buttons: [
                /*{
                    extend:    'colvis',
                    text:      'Column Visibility',
                    titleAttr: 'Col visibility',
                    className: 'mr-sm-3'
                },*/
                {
                    extend: 'colvis',
                    text: 'Column Visibility',
                    titleAttr: 'Col visibility',
                    className: 'btn-outline-default'
                },
                // {
                //     extend: 'pdfHtml5',
                //     text: 'PDF',
                //     titleAttr: 'Generate PDF',
                //     className: 'btn-outline-danger btn-sm mr-1'
                // },
                // {
                //     extend: 'excelHtml5',
                //     text: 'Excel',
                //     titleAttr: 'Generate Excel',
                //     className: 'btn-outline-success btn-sm mr-1',
                //     exportOptions: {
                //     columns: [ 0, 1, 3, 4, ]
                //     }

                // },
                // {
                //     extend: 'csvHtml5',
                //     text: 'CSV',
                //     titleAttr: 'Generate CSV',
                //     className: 'btn-outline-primary btn-sm mr-1'
                // },
                // {
                //     extend: 'print',
                //     text: 'Print',
                //     titleAttr: 'Print Table',
                //     className: 'btn-outline-primary btn-sm'
                // }
            ]
        });

    });

</script>
<!-- END Page Footer -->

