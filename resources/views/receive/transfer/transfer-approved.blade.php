@extends('layouts.admin.admin-master')
@section('title')
    Transfer Detail
@endsection
@section('content')
    <style>
        th{
            font-size: small;
        }
        td{
            font-size: small;
            /*font-weight: 500;*/
        }
    </style>
    <div class="content-overlay"></div>
    <div class="content-wrapper">
        <div class="content-header row">
            <div class="content-header-left col-md-6 col-12">
                <h2 class="content-header-title mb-0">Dashboard</h2>
                <div class="row breadcrumbs-top">
                    <div class="breadcrumb-wrapper col-12">
                        <ol class="breadcrumb">
                            <li class="breadcrumb-item"><a href="{{route('home')}}">Home</a>
                            </li>
                            <li class="breadcrumb-item active"><a href="{{route('receive.list.transfer.approved')}}">Transfer Detail List (Approved)</a>
                            </li>
                        </ol>
                    </div>
                </div>
            </div>
        </div>
        <div class="content-body">
            <section id="configuration">
                <div class="row">
                    <div class="col-12">
                        <div class="card">
                            <div class="card-header">
                                <h4 class="card-title">Transfer Detail List (Approved)</h4>
                                <a class="heading-elements-toggle"><i class="fa fa-ellipsis-v font-medium-3"></i></a>
                                <div class="heading-elements">
                                    <ul class="list-inline mb-0">
                                        <li><a data-action="collapse" title="minimize"><i class="feather icon-minus"></i></a></li>
                                        <li><a data-action="reload" onclick="loadDataTable()" id="DataTableButton"><i class="feather icon-rotate-cw"></i></a></li>
                                        <li><a data-action="expand" title="maximize"><i class="feather icon-maximize"></i></a></li>
                                        {{--<li><a data-action="close"><i class="feather icon-x"></i></a></li>--}}
                                    </ul>
                                </div>
                            </div>
                            <div class="card-content collapse show">
                                <div class="card-body card-dashboard">
                                    <table id="social-media-table" class="table table-striped table-bordered table-condensed table-responsive social-media table-info">
                                        <thead>
                                            <tr>
                                                <th class="text-center">Transfer Date</th>
                                                <th class="text-center">Challan No</th>
                                                <th class="text-center">Transferred From</th>
                                                <th class="text-center">Issue Type</th>
                                                <th class="text-center">Buyer</th>
                                                <th class="text-center">Garments Type</th>
                                                <th class="text-center">Style No</th>
                                                <th class="text-center">Unit</th>
                                                <th class="text-center">Total Qty</th>
                                                <th class="text-center">Grade-A</th>
                                                <th class="text-center">Grade-B</th>
                                                <th class="text-center">Grade-C</th>
                                                <th class="text-center">Grade-D</th>
                                                <th class="text-center">Grade-T</th>
                                                <th class="text-center">Location</th>
                                                <th class="text-center">Remarks</th>
                                                <th class="text-center">Action</th>
                                            </tr>
                                        </thead>
                                        <tbody>

                                        </tbody>
                                        <tfoot>
                                            <tr>
                                                <th class="text-center">Transfer Date</th>
                                                <th class="text-center">Challan No</th>
                                                <th class="text-center">Transferred From</th>
                                                <th class="text-center">Issue Type</th>
                                                <th class="text-center">Buyer</th>
                                                <th class="text-center">Garments Type</th>
                                                <th class="text-center">Style No</th>
                                                <th class="text-center">Unit</th>
                                                <th class="text-center">Total Qty</th>
                                                <th class="text-center">Grade-A</th>
                                                <th class="text-center">Grade-B</th>
                                                <th class="text-center">Grade-C</th>
                                                <th class="text-center">Grade-D</th>
                                                <th class="text-center">Grade-T</th>
                                                <th class="text-center">Location</th>
                                                <th class="text-center">Remarks</th>
                                                <th class="text-center">Action</th>
                                            </tr>
                                        </tfoot>
                                    </table>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </section>
        </div>
    </div>
@endsection
@section('page-modals')

@endsection

@section('pageScripts')
    {{--<script src="{{ asset('/stack-admin/app-assets/js/scripts/modal/components-modal.js') }}"></script>--}}
    <script src="{{ asset('/js/custom/common.js') }}"></script>
    <script>
        var dataTable = $('.social-media').DataTable({
            dom: 'Bfrtip',
            pagingType: 'full_numbers',
            className: 'my-1',
            lengthMenu: [
                [ 10, 25, 50, 100, -1 ],
                [ '10 rows', '25 rows', '50 rows', '100 rows', 'Show all' ]
            ],
            buttons: [
                {
                    extend: 'copyHtml5',
                    fieldSeparator: '\t',
                    extension: '.tsv',
                    exportOptions: {
                        columns: [ 0, ':visible' ]
                    }
                },
                {
                    extend: 'excelHtml5',
                    exportOptions: {
                        columns: [ 0, ':visible' ]
                    }
                },
                {
                    extend: 'csvHtml5',
                    exportOptions: {
                        columns: [ 0, ':visible' ]
                    }
                },
                {
                    extend: 'pdfHtml5',
                    orientation: 'portrait',
                    pageSize: 'A4',
                    exportOptions: {
                        columns: [ 0, ':visible' ]
                    }
                },
                {
                    extend: 'print',
                    exportOptions: {
                        columns: [ 0, ':visible' ]
                    },
                    customize: function(win)
                    {
                        var css = '@page { size: landscape; }',
                            head = win.document.head || win.document.getElementsByTagName('head')[0],
                            style = win.document.createElement('style');

                        style.type = 'text/css';
                        style.media = 'print';

                        if (style.styleSheet)
                        {
                            style.styleSheet.cssText = css;
                        }
                        else
                        {
                            style.appendChild(win.document.createTextNode(css));
                        }

                        head.appendChild(style);
                    }
                },
                'colvis',
                'pageLength'
            ]
        });


        $(document).ready(function () {
           /* CKEDITOR.replace( 'description',{
                uiColor: '#CCEAEE'
            });*/
            sessionStorage.clear();
            loadDataTable();
        });

        function hitTableRefresh() {
            document.getElementById("DataTableButton").click();
        }

        function makeTableSearchAble(){
            $('.social-media tfoot th').each( function () {
                var title = $(this).text();
                $(this).html( '<input type="text" placeholder="Search '+title+'" />' );
            } );

            dataTable.columns().every( function () {
                var that = this;

                $( 'input', this.footer() ).on( 'keyup change', function () {
                    if ( that.search() !== this.value ) {
                        that
                            .search( this.value )
                            .draw();
                    }
                } );
            } );
        }

        function returnStringFormatDate(_date) {
            let targetDate = Date.parse(_date);
            let currentDate = new Date(targetDate);
            return currentDate.toDateString();
            //return targetDate.('en')
        }

        function returnBDStringFormatDate(_date) {
            let targetDate = Date.parse(_date);
            let currentDate = new Date(targetDate);
            let date = currentDate.getDate();
            if(date < 10){
                date = '0' + date;
            }
            let month = currentDate.getMonth() + 1;
            if(month < 10){
                month = '0'+month;
            }
            let year = currentDate.getFullYear();
            return date + '/' + month + '/' + year;
        }

        function loadDataTable() {
            dataTable.destroy();
            var free_table = '<tr><td class="text-center" colspan="17">--- Please Wait... Loading Data  ----</td></tr>';

            $('.social-media').find('tbody').append(free_table);

            dataTable = $('.social-media').DataTable({
                ajax: {
                    url: "/lotfull/public/api/receive/list/transfer/approved/5000/{{ Auth::user()->id}}",
                    dataSrc: ""
                },
                columns: [
                    {
                        render: function(data, type, api_item){
                            if(api_item.issue_date === null){
                                return "<p class = 'text-center'></p>";
                            }else{
                                return "<p class = 'text-center'>"+ returnBDStringFormatDate(api_item.issue_date) +"</p>";
                            }
                        }
                    },
                    {
                        render: function(data, type, api_item){
                            if(api_item.reference_no === null){
                                return "<p class = 'text-left'></p>";
                            }else{
                                return "<p class = 'text-left'>"+ api_item.reference_no + "</p>";
                            }
                        }
                    },
                    {
                        render: function(data, type, api_item){
                            if(api_item.location_short_name === null){
                                return "<p class = 'text-left'></p>";
                            }else{
                                return "<p class = 'text-left'>"+ api_item.location_short_name + "</p>";
                            }
                        }
                    },
                    {
                        render: function(data, type, api_item){
                            if(api_item.issue_type === null){
                                return "<p class = 'text-center'></p>";
                            }else{
                                if(api_item.issue_type === 'v'){
                                    return "<p class = 'text-center'>Vendor Issue</p>";
                                }
                                else{
                                    return "<p class = 'text-center'>Transfer</p>";
                                }
                            }
                        }
                    },
                    {
                        render: function(data, type, api_item){
                            if(api_item.buyer_name === null){
                                return "<p class = 'text-left'></p>";
                            }else{
                                return "<p class = 'text-left'>"+ api_item.buyer_name +"</p>";
                            }
                        }
                    },
                    {
                        render: function(data, type, api_item){
                            if(api_item.garments_type === null){
                                return "<p class = 'text-left'></p>";
                            }else{
                                return "<p class = 'text-left'>"+ api_item.garments_type + "</p>";
                            }
                        }
                    },
                    {
                        render: function(data, type, api_item){
                            if(api_item.style_no === null){
                                return "<p class = 'text-left'></p>";
                            }else{
                                return "<p class = 'text-left'>"+ api_item.style_no +"</p>";
                            }
                        }
                    },
                    {
                        render: function(data, type, api_item){
                            if(api_item.short_unit === null){
                                return "<p class = 'text-center'></p>";
                            }else{
                                return "<p class = 'text-center'>"+ api_item.short_unit + "</p>";
                            }
                        }
                    },
                    {
                        render: function(data, type, api_item){
                            if(api_item.issued_total_quantity === null){
                                return "<p class = 'text-right'></p>";
                            }else{
                                return "<p class = 'text-right'>"+ api_item.issued_total_quantity + "</p>";
                            }
                        }
                    },
                    {
                        render: function(data, type, api_item){
                            if(api_item.grade_a === null){
                                return "<p class = 'text-right'></p>";
                            }else{
                                return "<p class = 'text-right'>"+ api_item.grade_a + "</p>";
                            }
                        }
                    },
                    {
                        render: function(data, type, api_item){
                            if(api_item.grade_b === null){
                                return "<p class = 'text-right'></p>";
                            }else{
                                return "<p class = 'text-right'>"+ api_item.grade_b + "</p>";
                            }
                        }
                    },
                    {
                        render: function(data, type, api_item){
                            if(api_item.grade_c === null){
                                return "<p class = 'text-right'></p>";
                            }else{
                                return "<p class = 'text-right'>"+ api_item.grade_c + "</p>";
                            }
                        }
                    },
                    {
                        render: function(data, type, api_item){
                            if(api_item.grade_d === null){
                                return "<p class = 'text-right'></p>";
                            }else{
                                return "<p class = 'text-right'>"+ api_item.grade_d + "</p>";
                            }
                        }
                    },
                    {
                        render: function(data, type, api_item){
                            if(api_item.grade_t === null){
                                return "<p class = 'text-right'></p>";
                            }else{
                                return "<p class = 'text-right'>"+ api_item.grade_t + "</p>";
                            }
                        }
                    },
                    {
                        render: function(data, type, api_item){
                            if(api_item.issued_to_name === null){
                                return "<p class = 'text-right'></p>";
                            }else{
                                return "<p class = 'text-right'>"+ api_item.issued_to_name + "</p>";
                            }
                        }
                    },
                    {
                        render: function(data, type, api_item){
                            if(api_item.remarks === null){
                                return "<p class = 'text-right'></p>";
                            }else{
                                return "<p class = 'text-right'>"+ api_item.remarks + "</p>";
                            }
                        }
                    },
                    {
                        render: function(data, type, api_item) {
                            if(parseInt(api_item.is_issue_accepted) === 1){
                                if(parseInt(api_item.age) < 46){
                                    return "<p class='text-center'>" +
                                        @if(Auth::user()->hasTaskPermission('receive_insert', Auth::user()->id))
                                            "<a title= 'Go to Image Upload Form' class= 'btn btn-success btn-sm btn-round fa fa-eye ImageUpload' data-id = "+ api_item.receive_master_id +" data-detail-id = "+ api_item.counter +" ></a>" +
                                        " &nbsp;" +
                                        @endif
                                            "</p>";
                                }
                                else{
                                    return "<p class='text-center'>" +
                                        @if(Auth::user()->hasTaskPermission('receive_insert', Auth::user()->id))
                                            "<a title= 'Go to Image Upload Form' class= 'btn btn-success btn-sm btn-round fa fa-eye ImageUpload' data-id = "+ api_item.receive_master_id +" data-detail-id = "+ api_item.counter +" ></a>" +
                                        " &nbsp;" +
                                        @endif
                                            "</p>";
                                }
                            }
                            else{
                                return "<p class='text-center'></p>" ;
                            }
                        }
                    },
                ],
                dom: 'Bfrtip',
                pagingType: 'full_numbers',
                className: 'my-1',
                ordering: false,
                lengthMenu: [
                    [ 10, 25, 50, 100, -1 ],
                    [ '10 rows', '25 rows', '50 rows', '100 rows', 'Show all' ]
                ],
                buttons: [
                    {
                        extend: 'copyHtml5',
                        fieldSeparator: '\t',
                        extension: '.tsv',
                        exportOptions: {
                            columns: [ 0, ':visible' ]
                        }
                    },
                    {
                        extend: 'excelHtml5',
                        exportOptions: {
                            columns: [ 0, ':visible' ]
                        }
                    },
                    {
                        extend: 'csvHtml5',
                        exportOptions: {
                            columns: [ 0, ':visible' ]
                        }
                    },
                    {
                        extend: 'pdfHtml5',
                        orientation: 'portrait',
                        pageSize: 'A4',
                        exportOptions: {
                            columns: [ 0, ':visible' ]
                        }
                    },
                    {
                        extend: 'print',
                        exportOptions: {
                            columns: [ 0, ':visible' ]
                        },
                        customize: function(win)
                        {
                            var css = '@page { size: landscape; }',
                                head = win.document.head || win.document.getElementsByTagName('head')[0],
                                style = win.document.createElement('style');

                            style.type = 'text/css';
                            style.media = 'print';

                            if (style.styleSheet)
                            {
                                style.styleSheet.cssText = css;
                            }
                            else
                            {
                                style.appendChild(win.document.createTextNode(css));
                            }

                            head.appendChild(style);
                        }
                    },
                    'colvis',
                    'pageLength'
                ]
            });
            makeTableSearchAble();
        }

        $('#social-media-table').on('click',".ImageUpload", function(){
            var button = $(this);
            var id = button.attr("data-id");
            var detail_id = button.attr("data-detail-id");
            var url = '{{ route('receive.image-upload-form', ['master_id' =>  'pid', 'detail_id' =>  'pd_id']) }}';
            url = url.replace('pid', id);
            url = url.replace('pd_id', detail_id);
            // console.log(url);
            // return;
            window.open(url, "_blank");
        });


    </script>
@endsection


