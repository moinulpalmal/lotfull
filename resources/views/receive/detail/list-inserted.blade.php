@extends('layouts.admin.admin-master')
@section('title')
    Receive Detail
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
                            <li class="breadcrumb-item active"><a href="{{route('receive.list.detail.inserted')}}">Receive Detail List (Inserted)</a>
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
                                <h4 class="card-title">Receive Detail List (Inserted)</h4>
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
                                                <th class="text-center">RC Location</th>
                                                <th class="text-center">RC Date</th>
                                                <th class="text-center">Challan No</th>
                                                <th class="text-center">RC. From</th>
                                                <th class="text-center">RC. Type</th>
                                                <th class="text-center">Buyer</th>
                                                <th class="text-center">Garments Type</th>
                                                <th class="text-center">Style No</th>
                                                <th class="text-center">Unit</th>
                                                <th class="text-center">Total RC Qty</th>
                                                <th class="text-center">QC Date</th>
                                                <th class="text-center">Grade-A</th>
                                                <th class="text-center">Grade-B</th>
                                                <th class="text-center">Grade-C</th>
                                                <th class="text-center">Grade-D</th>
                                                <th class="text-center">Grade-T</th>
                                                <th class="text-center">QC Qty</th>
                                                <th class="text-center">QC Short/Access</th>
                                                <th class="text-center">Status</th>
                                            </tr>
                                        </thead>
                                        <tbody>

                                        </tbody>
                                        <tfoot>
                                            <tr>
                                                <th class="text-center">Day Passed</th>
                                                <th class="text-center">Remarks</th>
                                                <th class="text-center">Action</th>
                                                <th class="text-center">RC Location</th>
                                                <th class="text-center">RC Date</th>
                                                <th class="text-center">Challan No</th>
                                                <th class="text-center">RC. From</th>
                                                <th class="text-center">RC. Type</th>
                                                <th class="text-center">Buyer</th>
                                                <th class="text-center">Garments Type</th>
                                                <th class="text-center">Style No</th>
                                                <th class="text-center">Unit</th>
                                                <th class="text-center">Total RC Qty</th>
                                                <th class="text-center">QC Date</th>
                                                <th class="text-center">Grade-A</th>
                                                <th class="text-center">Grade-B</th>
                                                <th class="text-center">Grade-C</th>
                                                <th class="text-center">Grade-D</th>
                                                <th class="text-center">Grade-T</th>
                                                <th class="text-center">QC Qty</th>
                                                <th class="text-center">QC Short/Access</th>
                                                <th class="text-center">Status</th>
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
    <div class="modal fade text-left" id="QCInsertModal" tabindex="-1" role="dialog" aria-labelledby="myModalLabel16" aria-hidden="true">
        <div class="modal-dialog modal-xl" role="document">
            <div class="modal-content">
                <div class="modal-header bg-warning white">
                    <h4 class="modal-title text-bold-700" id="myModalLabel16">QC Info Insert</h4>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <form class="form" id="QCInsertForm" method="post" action="#">
                    <div class="modal-body">
                        @csrf
                        <input type="hidden" id="MasterID" class="form-control" name="receive_master_id">
                        <input type="hidden" id="DetailsID" class="form-control" name="counter">
                        <div class="form-body">
                            <div class="row">
                                <div class="col-md-12">
                                    <h4 class="card-title">Invoice Detail Info</h4>
                                    <table style="float: left" class="table table-borderless table-info table-striped">
                                        <thead>
                                        <tr>
                                            <th class="text-center">RC Date</th>
                                            <th class="text-center">Challan No</th>
                                            <th class="text-center">RC. From</th>
                                            <th class="text-center">RC. Type</th>
                                            <th class="text-center">Buyer</th>
                                            <th class="text-center">Garments Type</th>
                                            <th class="text-center">Style No</th>
                                            <th class="text-center">Unit</th>
                                        </tr>
                                        </thead>
                                        <tbody>
                                        <tr>
                                            <td class="text-center" id="ModalTableRCDate">

                                            </td>
                                            <td class="text-center" id="ModalTableChallanNo">

                                            </td>
                                            <td class="text-left" id="ModalTableRCFrom">

                                            </td>
                                            <td class="text-center" id="ModalTableRType">

                                            </td>
                                            <td class="text-center" id="ModalTableBuyer">

                                            </td>
                                            <td class="text-center" id="ModalTableGarmentsType">

                                            </td>
                                            <td class="text-center" id="ModalTableStyleNo">

                                            </td>
                                            <td class="text-center" id="ModalTableShortUnit">

                                            </td>
                                        </tr>
                                        </tbody>
                                    </table>
                                </div>
                                <div class="col-md-8 no-padding" style="padding-left: 10px !important;">
                                    <div class="form-group">
                                        <label for="ReceiveQuantity" class="text-bold-700">Receive Quantity</label>
                                        <input type="number" id="ReceiveQuantity" class="form-control" name="received_total_quantity" required>
                                    </div>
                                </div>
                                <div class="col-md-4 no-padding" style="padding-right: 10px !important;">
                                    <div class="form-group">
                                        <label for="QCDate" class="text-bold-700">QC Date</label>
                                        <input type="date" id="QCDate" class="form-control" name="qc_date" required>
                                    </div>
                                </div>
                                <div class="col-md-2 no-padding" style="padding-left: 10px !important;">
                                    <div class="form-group">
                                        <label for="GradeA" class="text-bold-700">Grade A</label>
                                        <input type="number" id="GradeA" min="0" class="form-control" name="grade_a" required>
                                    </div>
                                </div>
                                <div class="col-md-2 no-padding">
                                    <div class="form-group">
                                        <label for="GradeB" class="text-bold-700">Grade B</label>
                                        <input type="number" id="GradeB" min="0" class="form-control" name="grade_b" required>
                                    </div>
                                </div>
                                <div class="col-md-2 no-padding">
                                    <div class="form-group">
                                        <label for="GradeC" class="text-bold-700">Grade C</label>
                                        <input type="number" id="GradeC" min="0" class="form-control" name="grade_c" required>
                                    </div>
                                </div>
                                <div class="col-md-2 no-padding">
                                    <div class="form-group">
                                        <label for="GradeD" class="text-bold-700">Grade D</label>
                                        <input type="number" id="GradeD" min="0" class="form-control" name="grade_d" required>
                                    </div>
                                </div>
                                <div class="col-md-2 no-padding" style="padding-right: 10px !important;">
                                    <div class="form-group">
                                        <label for="GradeT" class="text-bold-700">Grade T</label>
                                        <input type="number" id="GradeD" min="0" class="form-control" name="grade_t" required>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-outline-danger" data-dismiss="modal"><i class="fa fa-times"></i> Close</button>
                        <div>
                            <button type="submit" id="submit_button_new_buyer" class="btn btn-outline-primary">
                                <i class="fa fa-check"></i> Insert QC Info
                            </button>
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </div>
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


        $(function(){
            $.ajaxSetup({
                headers: { 'X-CSRF-TOKEN' : '{{ csrf_token() }}' }
            });
            $('#QCInsertForm').submit(function(e){
                e.preventDefault();
                var data = $(this).serialize();
                var url = '{{ route('receive.list.detail.insert-qc') }}';
                $.ajax({
                    url: url,
                    method:'POST',
                    data:data,
                    success:function(data){
                        if(data === '2')
                        {
                            swal({
                                title: "Data Updated Successfully!",
                                icon: "success",
                                button: "Ok!",
                            }).then(function (value) {
                                if(value){
                                    hitTableRefresh();
                                    $("#QCInsertModal").modal('hide');
                                }
                            });
                        }
                        else if(data === '1')
                        {
                            swal({
                                title: "Data Inserted Successfully!",
                                icon: "success",
                                button: "Ok!",
                            }).then(function (value) {
                                if(value){
                                    hitTableRefresh();
                                    $("#QCInsertModal").modal('hide');
                                }
                            });
                        }
                        else if(data === '0'){
                            swalDataNotSaved();
                        }
                        else{
                            swalDataNotSaved();
                        }
                    },
                    error:function(error){
                        swalError(error);
                    }
                })

            })
        });

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

        function returnTotalQCQty(grade_a, grade_b, grade_c, grade_d, grade_t) {
            return parseInt(parseInt(grade_a) + parseInt(grade_b) + parseInt(grade_c) + parseInt(grade_d) + parseInt(grade_t));
        }

        function returnTotalQCVariation(received_total_quantity, grade_a, grade_b, grade_c, grade_d, grade_t) {
            return parseInt( parseInt(received_total_quantity) - parseInt(grade_a) - parseInt(grade_b) - parseInt(grade_c) - parseInt(grade_d) - parseInt(grade_t));
        }

        function loadDataTable() {
            dataTable.destroy();
            var free_table = '<tr><td class="text-center" colspan="22">--- Please Wait... Loading Data  ----</td></tr>';

            $('.social-media').find('tbody').append(free_table);

            dataTable = $('.social-media').DataTable({
                ajax: {
                    url: "/lotfull/public/api/receive/list/detail/inserted/{{ Auth::user()->id}}",
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
                            if(parseInt(api_item.age)  < 46){
                                return "<p class='text-center'>" +
                                    @if(Auth::user()->hasTaskPermission('receive_insert', Auth::user()->id))
                                        "<a title= 'Go to Image Upload Form' class= 'btn btn-success btn-sm btn-round fa fa-eye ImageUpload' data-id = "+ api_item.receive_master_id +" data-detail-id = "+ api_item.counter +" ></a>" +
                                    " &nbsp;" +
                                    @endif
                                    @if(Auth::user()->hasTaskPermission('receive_delete', Auth::user()->id))
                                        "<a title= 'Delete' class= 'btn btn-danger btn-sm btn-round fa fa-trash DeleteWorkExp' data-id = "+ api_item.receive_master_id + "-" + api_item.counter + "></a>" +
                                    " &nbsp;" +
                                    @endif
                                        @if(Auth::user()->hasTaskPermission('qc_insert', Auth::user()->id))
                                        "<a title= 'Insert QC Data' class= 'btn btn-warning btn-sm btn-round fa fa-edit QCInsert' data-toggle='modal' onclick='openQCInsertModal();'  data-id = "+ api_item.receive_master_id +" data-detail-id = "+ api_item.counter +"></a>" +
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
                                    @if(Auth::user()->hasPermission('administrator', Auth::user()->id))
                                        "<a title= 'Delete' class= 'btn btn-danger btn-sm btn-round fa fa-trash DeleteWorkExp' data-id = "+ api_item.receive_master_id + "-" + api_item.counter + "></a>" +
                                    " &nbsp;" +
                                    @endif
                                        @if(Auth::user()->hasTaskPermission('qc_insert', Auth::user()->id))
                                        "<a title= 'Insert QC Data' class= 'btn btn-warning btn-sm btn-round fa fa-edit QCInsert' data-toggle='modal' onclick='openQCInsertModal();'  data-id = "+ api_item.receive_master_id +" data-detail-id = "+ api_item.counter +"></a>" +
                                        " &nbsp;" +
                                        @endif
                                        "</p>";
                            }

                        }
                    },
                    {
                        render: function(data, type, api_item){
                            if(api_item.stock_location === null){
                                return "<p class = 'text-left'></p>";
                            }else{
                                return "<p class = 'text-left'>"+ api_item.stock_location + "</p>";
                            }
                        }
                    },
                    {
                        render: function(data, type, api_item){
                            if(api_item.receive_date === null){
                                return "<p class = 'text-left'></p>";
                            }else{
                                return "<p class = 'text-left'>"+ returnBDStringFormatDate(api_item.receive_date) +"</p>";
                            }
                        }
                    },
                    {
                        render: function(data, type, api_item){
                            if(api_item.reference_no === null){
                                return "<p class = 'text-left'></p>";
                            }else{
                                return "<p class = 'text-left'>"+ api_item.reference_no +"</p>";
                            }
                        }
                    },
                    {
                        render: function(data, type, api_item){
                            if(api_item.receive_from_name === null){
                                return "<p class = 'text-left'></p>";
                            }else{
                                return "<p class = 'text-left'>"+ api_item.receive_from_name + " - " + api_item.receive_from_short_name + "</p>";
                            }
                        }
                    },
                    {
                        render: function(data, type, api_item){
                            if(api_item.receive_type === null){
                                return "<p class = 'text-left'></p>";
                            }else{
                                if(api_item.receive_type === 'r'){
                                    return "<p class = 'text-left'>New Receive</p>";
                                }
                                else{
                                    return "<p class = 'text-left'>Transfer Receive</p>";
                                }
                            }
                        }
                    },
                    {
                        render: function(data, type, api_item){
                            if(api_item.buyer_name === null){
                                return "<p class = 'text-left'></p>";
                            }else{
                                return "<p class = 'text-left'>"+ api_item.buyer_name + "</p>";
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
                                return "<p class = 'text-left'>"+ api_item.style_no + "</p>";
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
                            if(api_item.received_total_quantity === null){
                                return "<p class = 'text-right'></p>";
                            }else{
                                return "<p class = 'text-right'>"+ api_item.received_total_quantity + "</p>";
                            }
                        }
                    },
                    {
                        render: function(data, type, api_item){
                            if(api_item.qc_date === null){
                                return "<p class = 'text-center'></p>";
                            }else{
                                return "<p class = 'text-center'>"+ returnBDStringFormatDate(api_item.qc_date) +"</p>";
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
                            if(api_item.grade_a === null){
                                return "<p class = 'text-right'></p>";
                            }else{
                                return "<p class = 'text-right'>"+ returnTotalQCQty(api_item.grade_a, api_item.grade_b, api_item.grade_b, api_item.grade_d, api_item.grade_t) + "</p>";
                            }
                        }
                    },
                    {
                        render: function(data, type, api_item){
                            if(api_item.received_total_quantity === null){
                                return "<p class = 'text-right'></p>";
                            }else{
                                return "<p class = 'text-right'>"+ returnTotalQCVariation(api_item.received_total_quantity, api_item.grade_a, api_item.grade_b, api_item.grade_b, api_item.grade_d, api_item.grade_t) + "</p>";
                            }
                        }
                    },
                    {
                        render: function(data, type, api_item){
                            if(api_item.receive_detail_status === null){
                                return "<p class = 'text-right'></p>";
                            }else{
                                if(api_item.receive_detail_status === 'I'){
                                    return "<p class = 'text-right'>Inserted</p>";
                                }
                                else if(api_item.receive_detail_status === 'QCI'){
                                    return "<p class = 'text-right'>QC Inserted</p>";
                                }
                                else if(api_item.receive_detail_status === 'QCF'){
                                    return "<p class = 'text-right'>QC Completed</p>";
                                }
                                else{
                                    return "<p class = 'text-right'></p>";
                                }
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

        $('#social-media-table').on('click',".DeleteWorkExp", function(){
            var button = $(this);
            var id = button.attr("data-id");
            var url = '{{ route('receive.list.detail.delete') }}';
            swal({
                title: 'Are you sure?',
                text: 'This record will be removed permanently!',
                icon: 'warning',
                buttons: ["Cancel", "Yes!"],
            }).then(function(value) {
                if (value) {
                    $.ajax({
                        method:'DELETE',
                        url: url,
                        data:{id: id, _token: '{{csrf_token()}}'},
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
                            swalError(error);
                        }
                    })
                }
            });
        });

        function openQCInsertModal() {
            $('#QCInsertModal').modal({backdrop: 'static', keyboard: false});
        }

        $('#social-media-table').on('click',".QCInsert", function(){
            var button = $(this);
            var id = button.attr("data-id");
            var detail_id = button.attr("data-detail-id");
            var url = '{{ route('receive.list.detail.edit-qc') }}';
            $.ajax({
                url: url,
                method:'POST',
                data:{id: id, detail_id: detail_id, _token: '{{csrf_token()}}'},
                success:function(data){
                    if(data === '0' ){
                        swalError(error);
                    }
                    else{
                        $('input[name=qc_date]').val(data.qc_date);
                        $('input[name=received_total_quantity]').val(data.received_total_quantity);
                        $('input[name=grade_a]').val(data.grade_a);
                        $('input[name=grade_b]').val(data.grade_b);
                        $('input[name=grade_c]').val(data.grade_c);
                        $('input[name=grade_d]').val(data.grade_d);
                        $('input[name=grade_t]').val(data.grade_t);
                        $('input[name=receive_master_id]').val(data.id);
                        $('input[name=counter]').val(data.counter);

                        if(data.receive_date === null){
                            document.getElementById("ModalTableRCDate").innerHTML  = '';
                        }
                        else{
                            document.getElementById("ModalTableRCDate").innerHTML  = returnBDStringFormatDate(data.receive_date);
                        }

                        if(data.receive_type === null){
                            document.getElementById("ModalTableRType").innerHTML  = '';
                        }
                        else{
                            if(data.receive_type === 'r'){
                                document.getElementById("ModalTableRType").innerHTML  = 'New Receive';
                            }
                            else{
                                document.getElementById("ModalTableRType").innerHTML  = 'Transfer Receive';
                            }

                        }

                        if(data.reference_no === null){
                            document.getElementById("ModalTableChallanNo").innerHTML  = '';
                        }
                        else{
                            document.getElementById("ModalTableChallanNo").innerHTML  = data.reference_no;
                        }

                        if(data.receive_from_name === null){
                            document.getElementById("ModalTableRCFrom").innerHTML  = '';
                        }
                        else{
                            document.getElementById("ModalTableRCFrom").innerHTML  = data.receive_from_name + "-" + data.receive_from_short_name;
                        }

                        if(data.buyer_name === null){
                            document.getElementById("ModalTableBuyer").innerHTML  = '';
                        }
                        else{
                            document.getElementById("ModalTableBuyer").innerHTML  = data.buyer_name;
                        }

                        if(data.style_no === null){
                            document.getElementById("ModalTableStyleNo").innerHTML  = '';
                        }
                        else{
                            document.getElementById("ModalTableStyleNo").innerHTML  = data.style_no;
                        }

                        if(data.garments_type === null){
                            document.getElementById("ModalTableGarmentsType").innerHTML  = '';
                        }
                        else{
                            document.getElementById("ModalTableGarmentsType").innerHTML  = data.garments_type;
                        }

                        if(data.short_unit === null){
                            document.getElementById("ModalTableShortUnit").innerHTML  = '';
                        }else{
                            document.getElementById("ModalTableShortUnit").innerHTML  = data.short_unit;
                        }
                    }

                },
                error:function(error){
                    swalError(error);
                }
            })
        });

    </script>
@endsection


