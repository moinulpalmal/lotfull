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
                                        {{--<li><a data-action="reload"><i class="feather icon-rotate-cw"></i></a></li>--}}
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
                                                <th class="text-center">QC Qty</th>
                                                <th class="text-center">QC Short/Access</th>
                                                <th class="text-center">Status</th>
                                                <th class="text-center">Location</th>
                                                <th class="text-center">Day Passed</th>
                                                <th class="text-center">Remarks</th>
                                                <th class="text-center">Action</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                        @if(!empty($departments))
                                            @foreach($departments as $media)
                                                <tr>
                                                    <td class="text-center">
                                                        {{\Carbon\Carbon::parse($media->receive_date)->format('d-m-Y')}}
                                                    </td>
                                                    <td class="text-center">
                                                        {{$media->reference_no}}
                                                    </td>
                                                    <td class="text-left">
                                                        @if($media->receive_type == 'r')
                                                            {{\App\Helpers\Helper::IDwiseData('factories', 'id', $media->receive_from)->factory_short_name." "."-"." ".\App\Helpers\Helper::IDwiseData('factories', 'id', $media->receive_from)->unit_short_name}}
                                                        @else
                                                            {{\App\Helpers\Helper::IDwiseData('locations', 'id', $media->receive_from)->name}}
                                                        @endif
                                                    </td>
                                                    <td class="text-center">
                                                        @if($media->receive_type == 'r')
                                                            New Receive
                                                        @else
                                                            Transfer Receive
                                                        @endif
                                                    </td>
                                                    <td class="text-center">
                                                        {{$media->buyer_name}}
                                                    </td>
                                                    <td class="text-center">
                                                        {{$media->garments_type}}
                                                    </td>
                                                    <td class="text-center">
                                                        {{$media->style_no}}
                                                    </td>
                                                    <td class="text-center">
                                                        {{$media->short_unit}}
                                                    </td>
                                                    <td class="text-right">
                                                        {{$media->received_total_quantity}}
                                                    </td>
                                                    <td class="text-center">
                                                        @if($media->qc_date != null)
                                                        {{\Carbon\Carbon::parse($media->qc_date)->format('d-M-Y')}}
                                                            @endif
                                                    </td>
                                                    <td class="text-right">
                                                        {{$media->grade_a}}
                                                    </td>
                                                    <td class="text-right">
                                                        {{$media->grade_b}}
                                                    </td>
                                                    <td class="text-right">
                                                        {{$media->grade_c}}
                                                    </td>
                                                    <td class="text-right">
                                                        {{$media->grade_d}}
                                                    </td>
                                                    <td class="text-right">
                                                        {{$media->grade_a + $media->grade_b + $media->grade_c + $media->grade_d}}
                                                    </td>
                                                    <td class="text-right">
                                                        {{$media->received_total_quantity - ($media->grade_a + $media->grade_b + $media->grade_c + $media->grade_d)}}
                                                    </td>
                                                    <td class="text-right">
                                                        @if($media->receive_detail_status == 'I')
                                                            Inserted
                                                            @elseif($media->receive_detail_status == 'QCI')
                                                            QC Inserted
                                                            @elseif($media->receive_detail_status == 'QCF')
                                                            QC Completed
                                                        @else

                                                        @endif
                                                    </td>
                                                    <td class="text-left">
                                                        {{$media->location_short_name}}
                                                    </td>
                                                    <td class="text-center text-bold-700">
                                                        {{\App\Helpers\Helper::ageInDays($media->receive_date)}}
                                                    </td>
                                                    <td class="text-left text-bold-700" style="background-color: {{\App\Model\StockThreshold::returnColorCode(\App\Helpers\Helper::ageInDays($media->receive_date))}}">
                                                        {{\App\Model\StockThreshold::returnStatus(\App\Helpers\Helper::ageInDays($media->receive_date))}}{{--{{\App\Helpers\Helper::ageInDays($media->receive_date)}}--}}
                                                    </td>
                                                    <td class="text-center">
                                                        @if(Auth::user()->hasTaskPermission('receive_insert', Auth::user()->id))
                                                        <a class="btn btn-success btn-sm btn-round fa fa-eye " href="{{route('receive.image-upload-form', ['master_id' => $media->receive_master_id, 'detail_id' => $media->counter])}}" title="Go to Image Upload Form"></a>
                                                        @endif
                                                    @if(Auth::user()->hasTaskPermission('qc_insert', Auth::user()->id))
                                                        <a class="btn btn-warning btn-sm btn-round fa fa-edit" onclick=" $('#QCInsert{{$media->receive_master_id."-".$media->counter}}').modal({backdrop: 'static', keyboard: false});" data-toggle="modal" {{--data-target="#NewFactory"--}} title="Insert QC Data"></a>
                                                        @endif
                                                        @if(Auth::user()->hasTaskPermission('receive_delete', Auth::user()->id))
                                                        <a class="btn btn-danger btn-sm btn-round fa fa-trash DeleteWorkExp" data-id="{{$media->receive_master_id."-".$media->counter}}" title="Delete"></a>
                                                        @endif
                                                    </td>
                                                </tr>
                                            @endforeach
                                        @endif
                                        </tbody>
                                        <tfoot>
                                            <tr>
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
                                                <th class="text-center">QC Qty</th>
                                                <th class="text-center">QC Short/Access</th>
                                                <th class="text-center">Status</th>
                                                <th class="text-center">Location</th>
                                                <th class="text-center">Day Passed</th>
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
    {{--new department modal--}}
    @if(!empty($departments))
    @foreach($departments AS $media)
        <div class="modal fade text-left" id="QCInsert{{$media->receive_master_id."-".$media->counter}}" tabindex="-1" role="dialog" aria-labelledby="myModalLabel16" aria-hidden="true">
        <div class="modal-dialog modal-xl" role="document">
            <div class="modal-content">
                <div class="modal-header bg-warning white">
                    <h4 class="modal-title text-bold-700" id="myModalLabel16">QC Info Insert-{{$media->receive_master_id."-".$media->counter}}</h4>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <form class="form" id="QCInsertForm{{$media->receive_master_id."-".$media->counter}}" method="post" action="#">
                    <div class="modal-body">
                        @csrf
                        <input type="hidden" id="MasterID" class="form-control" name="receive_master_id" value="{{old('receive_master_id', $media->receive_master_id)}}">
                        <input type="hidden" id="DetailsID" class="form-control" name="counter" value="{{old('counter', $media->counter)}}">
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
                                                <td class="text-center">
                                                    {{\Carbon\Carbon::parse($media->receive_date)->format('d-m-Y')}}
                                                </td>
                                                <td class="text-center">
                                                    {{$media->reference_no}}
                                                </td>
                                                <td class="text-left">
                                                    @if($media->receive_type == 'r')
                                                        {{\App\Helpers\Helper::IDwiseData('factories', 'id', $media->receive_from)->factory_short_name." "."-"." ".\App\Helpers\Helper::IDwiseData('factories', 'id', $media->receive_from)->unit_short_name}}
                                                    @else
                                                        {{\App\Helpers\Helper::IDwiseData('locations', 'id', $media->receive_from)->name}}
                                                    @endif
                                                </td>
                                                <td class="text-center">
                                                    @if($media->receive_type == 'r')
                                                        New Receive
                                                    @else
                                                        Transfer Receive
                                                    @endif
                                                </td>
                                                <td class="text-center">
                                                    {{$media->buyer_name}}
                                                </td>
                                                <td class="text-center">
                                                    {{$media->garments_type}}
                                                </td>
                                                <td class="text-center">
                                                    {{$media->style_no}}
                                                </td>
                                                <td class="text-center">
                                                    {{$media->short_unit}}
                                                </td>
                                            </tr>
                                        </tbody>
                                    </table>
                                </div>
                                <div class="col-md-2 no-padding" style="padding-left: 10px !important;">
                                    <div class="form-group">
                                        <label for="ReceiveQuantity" class="text-bold-700">Receive Quantity</label>
                                        <input type="number" id="ReceiveQuantity" class="form-control" name="received_total_quantity" value="{{old('received_total_quantity', $media->received_total_quantity)}}" required>
                                    </div>
                                </div>
                                <div class="col-md-2 no-padding">
                                    <div class="form-group">
                                        <label for="QCDate" class="text-bold-700">QC Date</label>
                                        <input type="date" id="QCDate" class="form-control" name="qc_date" @if(!empty($media->qc_date)) value="{{old('qc_date', $media->qc_date)}}" @endif required>
                                    </div>
                                </div>
                                <div class="col-md-2 no-padding">
                                    <div class="form-group">
                                        <label for="GradeA" class="text-bold-700">Grade A</label>
                                        <input type="number" id="GradeA" min="0" class="form-control" name="grade_a" value="{{old('grade_a', $media->grade_a)}}" required>
                                    </div>
                                </div>
                                <div class="col-md-2 no-padding">
                                    <div class="form-group">
                                        <label for="GradeB" class="text-bold-700">Grade B</label>
                                        <input type="number" id="GradeB" min="0" class="form-control" name="grade_b" value="{{old('grade_b', $media->grade_b)}}" required>
                                    </div>
                                </div>
                                <div class="col-md-2 no-padding">
                                    <div class="form-group">
                                        <label for="GradeC" class="text-bold-700">Grade C</label>
                                        <input type="number" id="GradeC" min="0" class="form-control" name="grade_c" value="{{old('grade_c', $media->grade_c)}}" required>
                                    </div>
                                </div>
                                <div class="col-md-2 no-padding" style="padding-right: 10px !important;">
                                    <div class="form-group">
                                        <label for="GradeD" class="text-bold-700">Grade D</label>
                                        <input type="number" id="GradeD" min="0" class="form-control" name="grade_d" value="{{old('grade_d', $media->grade_d)}}" required>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-outline-danger" data-dismiss="modal"><i class="fa fa-times"></i> Close</button>
                        <div {{--class="form-actions right"--}}>
                            <button type="submit" id="submit_button_new_buyer" class="btn btn-outline-primary">
                                <i class="fa fa-check"></i> Insert QC Info
                            </button>
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </div>
    @endforeach
    @endif
    {{-- end new department modal--}}
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
        });
        @if(!empty($departments))
        @foreach($departments AS $media)
        $(function(){
            $.ajaxSetup({
                headers: { 'X-CSRF-TOKEN' : '{{ csrf_token() }}' }
            });
            $('#QCInsertForm{{$media->receive_master_id."-".$media->counter}}').submit(function(e){
                e.preventDefault();
               /* for ( instance in CKEDITOR.instances ) {
                    CKEDITOR.instances[instance].updateElement();
                }*/
                var data = $(this).serialize();
               // var id = $('#HiddenFactoryID').val();
                var url = '{{ route('receive.list.detail.insert-qc') }}';
                //console.log(data);
                //return;
                $.ajax({
                    url: url,
                    method:'POST',
                    data:data,
                    success:function(data){
                      //console.log(data);
                      //return;
                        if(data === '2')
                        {
                            swalUpdateSuccessfulWithRefresh();
                        }
                        else if(data === '1')
                        {
                            swalInsertSuccessfulWithRefresh();
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
        @endforeach
        @endif

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
                    //window.location.href = url;
                    //console.log(id);
                    $.ajax({
                        method:'DELETE',
                        url: url,
                        data:{id: id, _token: '{{csrf_token()}}'},
                        success:function(data){
                           // console.log(data);
                           // return;
                            if(data === '1'){
                                //console.log(data);
                                swalSuccessFullWithRefresh();
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


