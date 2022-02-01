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
                            <li class="breadcrumb-item active"><a href="{{route('receive.list.detail.qc-finished')}}">Receive Detail List (QC-Finished)</a>
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
                                <h4 class="card-title">Receive Detail List (QC-Finished)</h4>
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
                                               {{-- <th class="text-center">Action</th>--}}
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
                                                  {{--  <td class="text-center">
                                                        <a class="btn btn-success btn-sm btn-round fa fa-check ApproveWorkExp" data-id="{{$media->receive_master_id."-".$media->counter}}" title="Approve"></a>
                                                        <a class="btn btn-warning btn-sm btn-round fa fa-edit" onclick=" $('#QCInsert{{$media->receive_master_id."-".$media->counter}}').modal({backdrop: 'static', keyboard: false});" data-toggle="modal" --}}{{--data-target="#NewFactory"--}}{{-- title="Insert QC Data"></a>
                                                        <a class="btn btn-danger btn-sm btn-round fa fa-trash DeleteWorkExp" data-id="{{$media->receive_master_id."-".$media->counter}}" title="Delete"></a>
                                                         --}}{{--
                                                         <a class="btn btn-info btn-sm btn-round fa fa-edit EditWorkExp" data-id="{{$media->id}}" title="Edit Factory"></a>
                                                         @if($media->receive_detail_status == 'A')
                                                             <a class="btn btn-warning btn-sm btn-round fa fa-times DeActivateWorkExp" data-id="{{$media->id}}" title="De-Activate Factory"></a>
                                                         @elseif($media->receive_detail_status == 'I')
                                                             <a class="btn btn-cyan btn-sm btn-round fa fa-check ActivateWorkExp" data-id="{{$media->id}}" title="Activate Factory"></a>
                                                         @else
                                                         @endif--}}{{--
                                                    </td>--}}
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
                                               {{-- <th class="text-center">Action</th>--}}
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
                'pageLength',

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

        $(function(){
            $.ajaxSetup({
                headers: { 'X-CSRF-TOKEN' : '{{ csrf_token() }}' }
            });
            $('#WorkExperienceForm').submit(function(e){
                e.preventDefault();
               /* for ( instance in CKEDITOR.instances ) {
                    CKEDITOR.instances[instance].updateElement();
                }*/
                var data = $(this).serialize();
                var id = $('#HiddenFactoryID').val();
                var url = '{{ route('settings.buyer.setup.save') }}';
                //console.log(data);
                $.ajax({
                    url: url,
                    method:'POST',
                    data:data,
                    success:function(data){
                      //  console.log(data);
                       // return;
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

    </script>
@endsection


