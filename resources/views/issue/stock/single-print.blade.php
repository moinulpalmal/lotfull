@extends('layouts.admin.admin-master')
@section('title')
    Stock Report
@endsection
@section('content')
    <style>
       /* th{
            font-size: xx-small;
        }
        td{
            font-size: xx-small;
            !*font-weight: 500;*!
        }*/

        #customers {
            font-family: Arial, Helvetica, sans-serif;
            border-collapse: collapse;
            width: 100%;
            font-size: x-small;
        }
       #customers td{
           font-weight: 500;
       }

        #customers td, #customers th {
            border: 1px solid #ddd;
            padding: 4px;
        }

        #customers tr:nth-child(even){background-color: #f2f2f2;}

        #customers tr:hover {background-color: #ddd;}

        #customers th {
            padding-top: 12px;
            padding-bottom: 12px;
            text-align: center;
            background-color: #0ABCB8;
            color: white;
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
                            <li class="breadcrumb-item"><a href="{{route('issue.stock.current')}}">Current Stock</a>
                            </li>
                            <li class="breadcrumb-item active"><a href="{{route('issue.stock.current.print-view', ['master_id' => $master_id, 'detail_id' => $detail_id])}}">Single Print View</a>
                            </li>
                        </ol>
                    </div>
                </div>
            </div>
        </div>
        <div class="content-body">
            <div class="row">
                <!-- buttons section -->
                <div class="col-xl-12 col-md-12 col-12 action-btns">
                    <div class="card">
                        <div class="card-body p-2">
                            <div class="row">
                                <div class="col-md-offset-8 col-md-4">
                                    <a href="#" class="btn btn-info btn-block mb-1 print-invoice"> <i class="feather icon-printer mr-25 common-size"></i> Print</a>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <section class="app-invoice-wrapper">
                <div class="row">
                    <div class="col-xl-12 col-md-12 col-12 printable-content">
                        <div class="card">
                            <!-- card body -->
                            <div class="card-body p-2">
                                <!-- card-header -->
                                <div class="card-header px-0">
                                    <div class="invoice-logo-title row py-2">
                                        <div class="col-6 d-flex flex-column justify-content-center align-items-start">
                                            <h2 class="text-black text-bold-700">Palmal Group of Industries</h2>
                                            <span><strong>Corporate Head Office:</strong> 9/Kha Confidence Center, Shahazadpur, Gulshan, Dhaka-1212</span>
                                        </div>
                                        <div class="col-6 d-flex justify-content-end">
                                            <h4 class="text-black text-bold-700">Individual Stock Report</h4>
                                        </div>
                                    </div>
                                </div>
                               {{-- <!-- invoice address and contacts -->
                                <div class="row invoice-adress-info py-2">
                                    <div class="col-6 mt-1 from-info">
                                        <div class="info-title mb-1">
                                            <span>Receive Date Info</span>
                                        </div>
                                        @if(!empty($request->receive_from_date))
                                            <div class="company-name mb-1">
                                                <span class="text-muted">Receive From Date:{{\Carbon\Carbon::parse($request->receive_from_date)->format('d-M-Y')}}</span>
                                            </div>
                                        @endif
                                        <div class="company-address mb-1">
                                            <span class="text-muted">Receive Date Up To:{{\Carbon\Carbon::parse($request->receive_to_date)->format('d-M-Y')}}</span>
                                        </div>
                                    </div>
                                </div>--}}
                                <hr>
                                <!--product details table -->
                                <div class="product-details-table py-2 {{--table-responsive--}}">
                                    <div class="info-title mb-1">
                                        <span class="text-bold" style="font-size: large">Stock Summary</span>
                                    </div>
                                    <table id="customers" {{--class="table table-striped table-bordered table-condensed table-info table-responsive"--}}>
                                        <thead>
                                            <tr style="background-color: #08a6e8 !important;">
                                                <th scope="col" colspan="5">COMMON</th>
                                                <th scope="col" colspan="9">RECEIVE INFO</th>
                                                <th scope="col" colspan="3">STORE INFO</th>
                                                <th scope="col" colspan="6">ISSUE SUMMARY</th>
                                                <th scope="col" colspan="6">BALANCE SUMMARY</th>
                                            </tr>
                                            <tr>
                                                <th scope="col">Sl#</th>
                                                <th scope="col">BUYER</th>
                                                <th scope="col">STYLE</th>
                                                <th scope="col">GARMENTS TYPE</th>
                                                <th scope="col">UNIT</th>
                                                <th scope="col">FROM</th>
                                                <th scope="col">CHALLAN No</th>
                                                <th scope="col">RC. DATE</th>
                                                <th scope="col">TOTAL</th>
                                                <th scope="col">GRADE-A</th>
                                                <th scope="col">GRADE-B</th>
                                                <th scope="col">GRADE-C</th>
                                                <th scope="col">GRADE-D</th>
                                                <th scope="col">GRADE-T</th>
                                                <th scope="col">LOCATION</th>
                                                <th scope="col">AGE</th>
                                                <th scope="col">REMARKS</th>
                                                <th scope="col">GRADE-A</th>
                                                <th scope="col">GRADE-B</th>
                                                <th scope="col">GRADE-C</th>
                                                <th scope="col">GRADE-D</th>
                                                <th scope="col">GRADE-T</th>
                                                <th scope="col">TOTAL</th>
                                                <th scope="col">GRADE-A</th>
                                                <th scope="col">GRADE-B</th>
                                                <th scope="col">GRADE-C</th>
                                                <th scope="col">GRADE-D</th>
                                                <th scope="col">GRADE-T</th>
                                                <th scope="col">TOTAL</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            @if(!empty($stocks))
                                                @php($i=1)
                                                @foreach($stocks as $media)
                                                    <tr>
                                                        <td class="text-center">{{$i++}}</td>

                                                        <td class="text-center">
                                                            {{$media->buyer_name}}
                                                        </td>
                                                        <td class="text-center">
                                                            {{$media->style_no}}
                                                        </td>
                                                        <td class="text-center">
                                                            {{$media->garments_type}}
                                                        </td>
                                                        <td class="text-center">
                                                            {{$media->short_unit}}
                                                        </td>
                                                        <td class="text-left">
                                                            {{$media->receive_from_short_name}}
                                                        </td>
                                                        <td class="text-center">
                                                            {{$media->reference_no}}
                                                        </td>
                                                        <td class="text-center">
                                                            {{\Carbon\Carbon::parse($media->receive_date)->format('d-m-Y')}}
                                                        </td>
                                                        <td class="text-right">
                                                            {{$media->received_total_quantity}}
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
                                                        <td class="text-center">
                                                            {{$media->location_name}}
                                                        </td>
                                                        <td class="text-center text-bold-700">
                                                            {{$media->age}}
                                                        </td>
                                                        <td class="text-right text-bold-700" style="background-color: {{\App\Model\StockThreshold::returnColorCode($media->age)}}; color: black;">
                                                            {{\App\Model\StockThreshold::returnStatus($media->age)}}
                                                        </td>
                                                        <td class="text-right">
                                                            {{$media->issued_grade_a}}
                                                        </td>
                                                        <td class="text-right">
                                                            {{$media->issued_grade_b}}
                                                        </td>
                                                        <td class="text-right">
                                                            {{$media->issued_grade_c}}
                                                        </td>
                                                        <td class="text-right">
                                                            {{$media->issued_grade_d}}
                                                        </td>
                                                        <td class="text-right">
                                                            {{$media->issued_grade_t}}
                                                        </td>
                                                        <td class="text-right">
                                                            {{$media->issued_total_quantity}}
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
                                                            {{$media->received_total_quantity - $media->issued_total_quantity}}
                                                        </td>
                                                    </tr>
                                                @endforeach
                                            @endif
                                        </tbody>
                                    </table>
                                </div>
                                <hr>
                                <div class="product-details-table py-2 {{--table-responsive--}}">
                                    <div class="info-title mb-1">
                                        <span class="text-bold" style="font-size: large">Stock Images</span>
                                        <div class="row">
                                            @if(!empty($stock_images))
                                                @foreach($stock_images AS $media)
                                                    @if($media->image == null)
                                                    @else
                                                        <div class="col-md-2">
                                                            <img src="{{ asset('/') }}{!! $media->image !!}" class="img-border img-thumbnail text-center" height="200" width="200">

                                                        </div>
                                                    @endif
                                                @endforeach

                                            @endif
                                        </div>
                                    </div>
                                </div>
                                <!-- invoice total -->
                                <div class="invoice-total py-2">
                                    <div class="row">
                                        <div class="col-4 col-sm-6 mt-75">
                                            <p>Report generated from Lotfull software; Date: {{\Carbon\Carbon::now()->format('d-M-Y')}}</p>
                                        </div>
                                    </div>
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

        $(document).ready(function () {
           /* CKEDITOR.replace( 'description',{
                uiColor: '#CCEAEE'
            });*/
            $(".select2").select2({
                dropdownAutoWidth: true,
                width: '100%'
            });
        });
    </script>
@endsection


