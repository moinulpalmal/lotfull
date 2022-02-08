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
                                                    <td class="text-left">
                                                        {{$media->buyer_name}}
                                                    </td>
                                                    <td class="text-left">
                                                        {{$media->style_no}}
                                                    </td>
                                                    <td class="text-center">
                                                        {{$media->garments_type}}
                                                    </td>
                                                    <td class="text-center">
                                                        {{$media->short_unit}}
                                                    </td>
                                                    <td class="text-right">
                                                        {{$media->grade_a - $media->issued_grade_a}}
                                                    </td>
                                                    <td class="text-right">
                                                        {{$media->grade_b - $media->issued_grade_b}}
                                                    </td>
                                                    <td class="text-right">
                                                        {{$media->grade_c - $media->issued_grade_c}}
                                                    </td>
                                                    <td class="text-right">
                                                        {{$media->grade_d - $media->issued_grade_d}}
                                                    </td>
                                                    <td class="text-right">
                                                        {{$media->grade_t - $media->issued_grade_t}}
                                                    </td>
                                                    <td class="text-right">
                                                        {{$media->grade_a + $media->grade_b + $media->grade_c + $media->grade_d +  $media->grade_t - ($media->issued_grade_a + $media->issued_grade_b + $media->issued_grade_c + $media->issued_grade_d + $media->issued_grade_t)}}
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
                                                        @if(Auth::user()->hasTaskPermission('stock_manager', Auth::user()->id))
                                                            @if($media->stock_status == 'A')
                                                                <a class="btn btn-danger btn-sm btn-round fa fa-times DeActivateWorkExp" data-id="{{$media->receive_master_id."-".$media->receive_detail_id}}" title="De-Activate Stock"></a>
                                                            @elseif($media->stock_status == 'I')
                                                                <a class="btn btn-success btn-sm btn-round fa fa-check ActivateWorkExp" data-id="{{$media->receive_master_id."-".$media->receive_detail_id}}" title="Activate Stock"></a>
                                                            @endif
                                                        @endif
                                                    </td>
                                                </tr>
                                            @endforeach
                                        @endif
                                        </tbody>
                                        <tfoot>
                                            <tr>
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

        $('#social-media-table').on('click',".ActivateWorkExp", function(){
            var button = $(this);
            var id = button.attr("data-id");
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

        $('#social-media-table').on('click',".DeActivateWorkExp", function(){
            var button = $(this);
            var id = button.attr("data-id");
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


