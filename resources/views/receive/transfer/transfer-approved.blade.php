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
                                            </tr>
                                        </thead>
                                        <tbody>
                                        @if(!empty($departments))
                                            @foreach($departments as $media)
                                                <tr>
                                                    <td class="text-center">
                                                        {{\Carbon\Carbon::parse($media->issue_date)->format('d-m-Y')}}
                                                    </td>
                                                    <td class="text-center">
                                                        {{$media->reference_no}}
                                                    </td>
                                                    <td class="text-left">
                                                        @if($media->issue_type == 'v')
                                                            {{\App\Helpers\Helper::IDwiseData('vendors', 'id', $media->issued_to)->name}}
                                                        @else
                                                            {{\App\Helpers\Helper::IDwiseData('locations', 'id', $media->location_id)->name}}
                                                        @endif
                                                    </td>
                                                    <td class="text-center">
                                                        @if($media->issue_type == 'v')
                                                            Vendor Issue
                                                        @else
                                                            Transfer
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
                                                        {{$media->issued_total_quantity}}
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
                                                        {{$media->grade_t}}
                                                    </td>
                                                    <td class="text-left">
                                                        {{\App\Helpers\Helper::IDwiseData('locations', 'id', $media->issued_to)->name}}
                                                    </td>
                                                    <td class="text-left">
                                                        {{$media->remarks}}
                                                    </td>
                                                </tr>
                                            @endforeach
                                        @endif
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


    </script>
@endsection


