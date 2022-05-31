@extends('layouts.admin.admin-master')
@section('title')
    In-Active Stock
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
                            <li class="breadcrumb-item active"><a href="{{route('issue.stock.in-active')}}">In-Active Stock</a>
                            </li>
                        </ol>
                    </div>
                </div>
            </div>
        </div>
        <div class="content-body">
            <section id="configuration">
                <div class="row" id="MyRow">
                    <div class="col-12">
                        <div class="card">
                            <div class="card-header">
                                <h4 class="card-title">In-Active Stock</h4>
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
                                                <th class="text-center">Day Passed</th>
                                                <th class="text-center">Remarks</th>
                                                <th class="text-center">Action</th>
                                                <th class="text-center">Location</th>
                                                <th class="text-center">RC Date</th>
                                                <th class="text-center">Buyer</th>
                                                <th class="text-center">Style No</th>
                                                <th class="text-center">Garments Type</th>
                                                <th class="text-center">Unit</th>
                                                <th class="text-center">Grade-A</th>
                                                <th class="text-center">Grade-B</th>
                                                <th class="text-center">Grade-C</th>
                                                <th class="text-center">Grade-D</th>
                                                <th class="text-center">Grade-T</th>
                                                <th class="text-center">Total Qty</th>
                                            </tr>
                                        </thead>
                                        <tbody>

                                        </tbody>
                                        <tfoot>
                                            <tr>
                                                <th class="text-center">Day Passed</th>
                                                <th class="text-center">Remarks</th>
                                                <th class="text-center">Action</th>
                                                <th class="text-center">RC Date</th>
                                                <th class="text-center">Location</th>
                                                <th class="text-center">Buyer</th>
                                                <th class="text-center">Style No</th>
                                                <th class="text-center">Garments Type</th>
                                                <th class="text-center">Unit</th>
                                                <th class="text-center">Grade-A</th>
                                                <th class="text-center">Grade-B</th>
                                                <th class="text-center">Grade-C</th>
                                                <th class="text-center">Grade-D</th>
                                                <th class="text-center">Grade-T</th>
                                                <th class="text-center">Total Qty</th>
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



        $(document).ready(function () {
           /* CKEDITOR.replace( 'description',{
                uiColor: '#CCEAEE'
            });*/

            sessionStorage.clear();
            $(".select2").select2({
                dropdownAutoWidth: true,
                width: '100%'
            });
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
            var free_table = '<tr><td class="text-center" colspan="15">--- Please Wait... Loading Data  ----</td></tr>';

            $('.social-media').find('tbody').append(free_table);

            dataTable = $('.social-media').DataTable({
                ajax: {
                    url: "/lotfull/public/api/issue/stock/current-in-active/{{ Auth::user()->id}}",
                    dataSrc: ""
                },
                columns: [
                    {
                        render: function(data, type, api_item){
                            if(api_item.age === null){
                                return "<p class = 'text-center'></p>";
                            }else{
                                return "<p class = 'text-center text-bold' style='color: "+ api_item.color_code +"; font-weight: bold '>"+ api_item.age +"</p>";
                            }
                        }
                    },
                    {
                        render: function(data, type, api_item){
                            if(api_item.stock_threshold_status === null){
                                return "<p class = 'text-left'></p>";
                            }else{
                                return "<p class = 'text-left text-bold' style='color: "+ api_item.color_code +"; font-weight: bold '>"+ api_item.stock_threshold_status +"</p>";
                            }
                        }
                    },
                    {
                        render: function(data, type, api_item) {
                            if(api_item.stock_status  === 'A'){
                                return "<p class='text-center'>" +
                                        @if(Auth::user()->hasTaskPermission('stock_manager', Auth::user()->id))
                                        "<a title= 'De-Activate Stock' class= 'btn btn-danger btn-sm btn-round fa fa-times DeActivateWorkExp' data-id = "+ api_item.receive_master_id +" data-detail-id = "+ api_item.receive_detail_id +"></a>" +
                                    " &nbsp;" +
                                    @endif
                                        "</p>";
                            }
                            else if(api_item.stock_status  === 'I'){
                                return "<p class='text-center'>" +
                                    @if(Auth::user()->hasTaskPermission('stock_manager', Auth::user()->id))
                                        "<a title= 'Activate Stock' class= 'btn btn-success btn-sm btn-round fa fa-check ActivateWorkExp' data-id = "+ api_item.receive_master_id +" data-detail-id = "+ api_item.receive_detail_id +"></a>" +
                                    " &nbsp;" +
                                    @endif
                                        "</p>";
                            }
                            else{

                                return "<p class='text-center'></p>" ;
                            }

                        }
                    },
                    {
                        render: function(data, type, api_item){
                            if(api_item.receive_date === null){
                                return "<p class = 'text-center'></p>";
                            }else{
                                return "<p class = 'text-center'>"+ returnBDStringFormatDate(api_item.receive_date) +"</p>";
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
                            if(api_item.buyer_name === null){
                                return "<p class = 'text-left'></p>";
                            }else{
                                return "<p class = 'text-left'>"+ api_item.buyer_name +"</p>";
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
                            if(api_item.garments_type === null){
                                return "<p class = 'text-left'></p>";
                            }else{
                                return "<p class = 'text-left'>"+ api_item.garments_type + "</p>";
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
                            if(api_item.current_grade_a === null){
                                return "<p class = 'text-right'></p>";
                            }else{
                                return "<p class = 'text-right'>"+ api_item.current_grade_a + "</p>";
                            }
                        }
                    },
                    {
                        render: function(data, type, api_item){
                            if(api_item.current_grade_b === null){
                                return "<p class = 'text-right'></p>";
                            }else{
                                return "<p class = 'text-right'>"+ api_item.current_grade_b + "</p>";
                            }
                        }
                    },
                    {
                        render: function(data, type, api_item){
                            if(api_item.current_grade_c === null){
                                return "<p class = 'text-right'></p>";
                            }else{
                                return "<p class = 'text-right'>"+ api_item.current_grade_c + "</p>";
                            }
                        }
                    },
                    {
                        render: function(data, type, api_item){
                            if(api_item.current_grade_d === null){
                                return "<p class = 'text-right'></p>";
                            }else{
                                return "<p class = 'text-right'>"+ api_item.current_grade_d + "</p>";
                            }
                        }
                    },
                    {
                        render: function(data, type, api_item){
                            if(api_item.current_grade_t === null){
                                return "<p class = 'text-right'></p>";
                            }else{
                                return "<p class = 'text-right'>"+ api_item.current_grade_t + "</p>";
                            }
                        }
                    },
                    {
                        render: function(data, type, api_item){
                            if(api_item.total_current_stock === null){
                                return "<p class = 'text-right'></p>";
                            }else{
                                return "<p class = 'text-right'>"+ api_item.total_current_stock + "</p>";
                            }
                        }
                    }
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

        $('#social-media-table').on('click',".ActivateWorkExp", function(){
            var button = $(this);
            var master_id = button.attr("data-id");
            var detail_id = button.attr("data-detail-id");
            var url = '{{ route('issue.stock.current.activate') }}';
            swal({
                title: 'Are you sure?',
                text: 'This record will be updated permanently!',
                icon: 'warning',
                buttons: ["Cancel", "Yes!"],
            }).then(function(value) {
                if (value) {
                    //window.location.href = url;
                    //console.log(id);
                    $.ajax({
                        method:'DELETE',
                        url: url,
                        data:{master_id: master_id, detail_id: detail_id, _token: '{{csrf_token()}}'},
                        success:function(data){
                            if(data === '1'){
                                swal({
                                    title: "Operation Successful!",
                                    icon: "success",
                                    button: "Ok!",
                                }).then(function (value) {
                                    if(value){
                                        hitTableRefresh();
                                    }
                                });
                            }
                            else if(data === '0'){
                                swalUnSuccessFull();
                            }
                        },
                        error:function(error){
                            //console.log(error);
                            swalError(error);
                        }
                    })
                }
            });
        });

        $('#social-media-table').on('click',".DeActivateWorkExp", function(){
            var button = $(this);
            var master_id = button.attr("data-id");
            var detail_id = button.attr("data-detail-id");
            var url = '{{ route('issue.stock.current.de-activate') }}';
            swal({
                title: 'Are you sure?',
                text: 'This record will be updated permanently!',
                icon: 'warning',
                buttons: ["Cancel", "Yes!"],
            }).then(function(value) {
                if (value) {
                    //window.location.href = url;
                    //console.log(id);
                    $.ajax({
                        method:'DELETE',
                        url: url,
                        data:{master_id: master_id, detail_id: detail_id, _token: '{{csrf_token()}}'},
                        success:function(data){
                            if(data === '1'){
                                swal({
                                    title: "Operation Successful!",
                                    icon: "success",
                                    button: "Ok!",
                                }).then(function (value) {
                                    if(value){
                                        hitTableRefresh();
                                    }
                                });
                            }
                            else if(data === '0'){
                                swalUnSuccessFull();
                            }
                        },
                        error:function(error){
                            //console.log(error);
                            swalError(error);
                        }
                    })
                }
            });
        });




    </script>
@endsection


