@extends('layouts.admin.admin-master')
@section('title')
    Current Stock
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
                            <li class="breadcrumb-item active"><a href="{{route('issue.stock.current')}}">Current Stock</a>
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
                                <h4 class="card-title">Current Stock</h4>
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
                                                        {{$media->grade_a + $media->grade_b + $media->grade_c + $media->grade_d + $media->grade_t -
                                                            ($media->issued_grade_a + $media->issued_grade_b + $media->issued_grade_c + $media->issued_grade_d +  $media->issued_grade_t)}}
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
                                                        @if($media->stock_status == 'A')
                                                            <a class="btn btn-danger btn-sm btn-round fa fa-file-pdf-o" target="_blank" href="{{route('issue.stock.current.print-view', ['master_id' => $media->receive_master_id, 'detail_id' => $media->receive_detail_id])}}" title="Got to Print View"></a>
                                                        @if(Auth::user()->hasTaskPermission('receive_insert', Auth::user()->id))
                                                            <a class="btn btn-success btn-sm btn-round fa fa-eye " href="{{route('receive.image-upload-form', ['master_id' => $media->receive_master_id, 'detail_id' => $media->receive_detail_id])}}" title="Go to Image Upload Form"></a>
                                                            @endif
                                                            @if(Auth::user()->hasTaskPermission('issue_insert', Auth::user()->id))
                                                                <a class="btn btn-warning btn-sm btn-round fa fa-edit" onclick=" $('#QCInsertI{{$media->receive_master_id."-".$media->receive_detail_id}}').modal({backdrop: 'static', keyboard: false});" data-toggle="modal" {{-- data-target="#NewFactory"--}} title="Issue Entry"></a>
                                                               @endif
                                                                @if(Auth::user()->hasTaskPermission('transfer_insert', Auth::user()->id))
                                                                    <a class="btn btn-info btn-sm btn-round fa fa-edit" onclick=" $('#QCInsertT{{$media->receive_master_id."-".$media->receive_detail_id}}').modal({backdrop: 'static', keyboard: false});" data-toggle="modal" {{-- data-target="#NewFactory"--}} title="Transfer Entry"></a>
                                                                @endif
                                                                    @if(Auth::user()->hasTaskPermission('stock_manager', Auth::user()->id))
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
   {{-- issue modal--}}
    @if(!empty($departments))
    @foreach($departments AS $media)
        <div class="modal fade text-left" id="QCInsertI{{$media->receive_master_id."-".$media->receive_detail_id}}" tabindex="-1" role="dialog" aria-labelledby="myModalLabel16" aria-hidden="true">
            <div class="modal-dialog modal-xl" role="document">
            <div class="modal-content">
                <div class="modal-header bg-gradient-radial-cyan white">
                    <h4 class="modal-title text-bold-700" id="myModalLabel16">Issue Insert Form</h4>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <form class="form" id="QCInsertFormI{{$media->receive_master_id."-".$media->receive_detail_id}}" method="post" action="#">
                    <div class="modal-body">
                        @csrf
                        <input type="hidden" id="MasterIDI" class="form-control" name="receive_master_id" value="{{old('receive_master_id', $media->receive_master_id)}}">
                        <input type="hidden" id="DetailsIDI" class="form-control" name="receive_detail_id" value="{{old('receive_detail_id', $media->receive_detail_id)}}">
                        <input type="hidden" id="IssueTypeIDI" class="form-control" name="issue_type" value="v">
                        <input type="hidden" id=LocationIDI" class="form-control" name="location_id" value="{{old('location_id', $media->location_id)}}">
                        <div class="form-body">
                            <div class="row">
                                <div class="col-md-12">
                                    <h4 class="card-title">Invoice Detail Info</h4>
                                    <table style="float: left" class="table table-borderless table-info table-striped">
                                        <thead>
                                            <tr>
                                                <th class="text-center">RC Date</th>
                                                <th class="text-center">Buyer</th>
                                                <th class="text-center">Style No</th>
                                                <th class="text-center">Garments Type</th>
                                                <th class="text-center">Unit</th>
                                            </tr>
                                        </thead>
                                        <tbody>
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
                                            </tr>
                                        </tbody>
                                    </table>
                                </div>
                                <div class="col-md-3 no-padding" style="padding-left: 10px !important;">
                                    <div class="form-group">
                                        <label for="QCDateI{{$media->receive_master_id."-".$media->receive_detail_id}}" class="text-bold-700">Issue Date</label>
                                        <input type="date" id="QCDateI{{$media->receive_master_id."-".$media->receive_detail_id}}" class="form-control" name="issue_date" required>
                                    </div>
                                </div>
                                <div class="col-md-3 no-padding">
                                    <div class="form-group">
                                        <label for="IssuedFromI{{$media->receive_master_id."-".$media->receive_detail_id}}" class="text-bold-700">Issued From</label>
                                        <select id="IssuedFromI{{$media->receive_master_id."-".$media->receive_detail_id}}" class="select2 form-control" name="location" required>
                                            <option value="" >- - - Select - - -</option>
                                            @if(!empty($locations))
                                                @foreach($locations AS $item)
                                                    @if($locations->count() > 1)
                                                        <option value="{{$item->id}}" @if($item->id == $media->location_id) selected = "selected" @endif>{{$item->name}}</option>
                                                    @else
                                                        <option value="{{$item->id}}" @if($item->id == $media->location_id) selected = "selected" @endif>{{$item->name}}</option>
                                                    @endif
                                                @endforeach
                                            @endif
                                        </select>
                                    </div>
                                </div>
                                <div class="col-md-3 no-padding">
                                    <div class="form-group">
                                        <label for="IssuedToI{{$media->receive_master_id."-".$media->receive_detail_id}}" class="text-bold-700">Issued To</label>
                                        <select id="IssuedToI{{$media->receive_master_id."-".$media->receive_detail_id}}" class="select2 form-control" name="issued_to" required>
                                            <option value="" >- - - Select - - -</option>
                                            @if(!empty($vendors))
                                                @foreach($vendors AS $item)
                                                    @if($vendors->count() > 1)
                                                        <option value="{{$item->id}}" >{{$item->name}}</option>
                                                    @else
                                                        <option value="{{$item->id}}" selected = "selected">{{$item->name}}</option>
                                                    @endif
                                                @endforeach
                                            @endif
                                        </select>
                                    </div>
                                </div>
                                <div class="col-md-3 no-padding" style="padding-right: 10px !important;">
                                    <div class="form-group">
                                        <label for="ChallanNoI{{$media->receive_master_id."-".$media->receive_detail_id}}" class="text-bold-700">Challan No</label>
                                        <input type="text" maxlength="150" id="ChallanNoI{{$media->receive_master_id."-".$media->receive_detail_id}}" class="form-control" name="reference_no" required>
                                    </div>
                                </div>
                                <div class="col-md-3 no-padding" style="padding-left: 10px !important;">
                                    <div class="form-group">
                                        <label for="GradeAI{{$media->receive_master_id."-".$media->receive_detail_id}}" class="text-bold-700">Grade A - [Stock: {{$media->grade_a - $media->issued_grade_a}}]</label>
                                        <input type="number" id="GradeAI{{$media->receive_master_id."-".$media->receive_detail_id}}" min="0"  max="{{$media->grade_a - $media->issued_grade_a}}" value="0" class="form-control" name="grade_a" required>
                                    </div>
                                </div>
                                <div class="col-md-3 no-padding">
                                    <div class="form-group">
                                        <label for="GradeBI{{$media->receive_master_id."-".$media->receive_detail_id}}B" class="text-bold-700">Grade B - [Stock: {{$media->grade_b - $media->issued_grade_b}}]</label>
                                        <input type="number" id="GradeBI{{$media->receive_master_id."-".$media->receive_detail_id}}" min="0"  max="{{$media->grade_b - $media->issued_grade_b}}" value="0" class="form-control" name="grade_b" required>
                                    </div>
                                </div>
                                <div class="col-md-3 no-padding">
                                    <div class="form-group">
                                        <label for="GradeCI{{$media->receive_master_id."-".$media->receive_detail_id}}" class="text-bold-700">Grade C - [Stock: {{$media->grade_c - $media->issued_grade_c}}]</label>
                                        <input type="number" id="GradeCI{{$media->receive_master_id."-".$media->receive_detail_id}}" min="0" max="{{$media->grade_c - $media->issued_grade_c}}" value="0" class="form-control" name="grade_c" required>
                                    </div>
                                </div>
                                <div class="col-md-3 no-padding" style="padding-right: 10px !important;">
                                    <div class="form-group">
                                        <label for="GradeDI{{$media->receive_master_id."-".$media->receive_detail_id}}" class="text-bold-700">Grade D - [Stock: {{$media->grade_d - $media->issued_grade_d}}]</label>
                                        <input type="number" id="GradeDI{{$media->receive_master_id."-".$media->receive_detail_id}}" min="0" class="form-control" max="{{$media->grade_d - $media->issued_grade_d}}" value="0" name="grade_d" required>
                                        <input type="hidden" id="GradeTT{{$media->receive_master_id."-".$media->receive_detail_id}}" min="0" class="form-control" max="{{$media->grade_t - $media->issued_grade_t}}" value="0" name="grade_t" required>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-outline-danger" data-dismiss="modal"><i class="fa fa-times"></i> Close</button>
                        <div {{--class="form-actions right"--}}>
                            <button type="submit" id="submit_button_new_buyerI{{$media->receive_master_id."-".$media->receive_detail_id}}" class="btn btn-outline-primary">
                                <i class="fa fa-check"></i> Save Issue
                            </button>
                        </div>
                    </div>
                </form>
            </div>
        </div>
        </div>
    @endforeach
    @endif
    {{-- end issue modal--}}
   {{-- transfer modal--}}
   @if(!empty($departments))
       @foreach($departments AS $media)
           <div class="modal fade text-left" id="QCInsertT{{$media->receive_master_id."-".$media->receive_detail_id}}" tabindex="-1" role="dialog" aria-labelledby="myModalLabel16" aria-hidden="true">
               <div class="modal-dialog modal-xl" role="document">
                   <div class="modal-content">
                       <div class="modal-header bg-gradient-radial-cyan white">
                           <h4 class="modal-title text-bold-700" id="myModalLabel16">Transfer Insert Form</h4>
                           <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                               <span aria-hidden="true">&times;</span>
                           </button>
                       </div>
                       <form class="form" id="QCInsertFormT{{$media->receive_master_id."-".$media->receive_detail_id}}" method="post" action="#">
                           <div class="modal-body">
                               @csrf
                               <input type="hidden" id="MasterIDT" class="form-control" name="receive_master_id" value="{{old('receive_master_id', $media->receive_master_id)}}">
                               <input type="hidden" id="DetailsIDT" class="form-control" name="receive_detail_id" value="{{old('receive_detail_id', $media->receive_detail_id)}}">
                               <input type="hidden" id="IssueTypeIDT" class="form-control" name="issue_type" value="t">
                               <input type="hidden" id=LocationIDT" class="form-control" name="location_id" value="{{old('location_id', $media->location_id)}}">
                               <div class="form-body">
                                   <div class="row">
                                       <div class="col-md-12">
                                           <h4 class="card-title">Invoice Detail Info</h4>
                                           <table style="float: left" class="table table-borderless table-info table-striped">
                                               <thead>
                                               <tr>
                                                   <th class="text-center">RC Date</th>
                                                   <th class="text-center">Buyer</th>
                                                   <th class="text-center">Style No</th>
                                                   <th class="text-center">Garments Type</th>
                                                   <th class="text-center">Unit</th>
                                               </tr>
                                               </thead>
                                               <tbody>
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
                                               </tr>
                                               </tbody>
                                           </table>
                                       </div>
                                       <div class="col-md-3 no-padding" style="padding-left: 10px !important;">
                                           <div class="form-group">
                                               <label for="QCDateT{{$media->receive_master_id."-".$media->receive_detail_id}}" class="text-bold-700">Issue Date</label>
                                               <input type="date" id="QCDateT{{$media->receive_master_id."-".$media->receive_detail_id}}" class="form-control" name="issue_date" required>
                                           </div>
                                       </div>
                                       <div class="col-md-3 no-padding">
                                           <div class="form-group">
                                               <label for="IssuedFromT{{$media->receive_master_id."-".$media->receive_detail_id}}" class="text-bold-700">Issued From</label>
                                               <select id="IssuedFromT{{$media->receive_master_id."-".$media->receive_detail_id}}" class="select2 form-control" name="location" required>
                                                   <option value="" >- - - Select - - -</option>
                                                   @if(!empty($locations))
                                                       @foreach($locations AS $item)
                                                           @if($locations->count() > 1)
                                                               <option value="{{$item->id}}" @if($item->id == $media->location_id) selected = "selected" @endif>{{$item->name}}</option>
                                                           @else
                                                               <option value="{{$item->id}}" @if($item->id == $media->location_id) selected = "selected" @endif>{{$item->name}}</option>
                                                           @endif
                                                       @endforeach
                                                   @endif
                                               </select>
                                           </div>
                                       </div>
                                       <div class="col-md-3 no-padding">
                                           <div class="form-group">
                                               <label for="IssuedToT{{$media->receive_master_id."-".$media->receive_detail_id}}" class="text-bold-700">Transferred To</label>
                                               <select id="IssuedToT{{$media->receive_master_id."-".$media->receive_detail_id}}" class="select2 form-control" name="issued_to" required>
                                                   <option value="" >- - - Select - - -</option>
                                                   @if(!empty($issue_locations))
                                                       @foreach($issue_locations AS $item)
                                                           @if($item->id != $media->location_id)
                                                               @if($issue_locations->count() > 1)
                                                                   <option value="{{$item->id}}" >{{$item->name}}</option>
                                                               @else
                                                                   <option value="{{$item->id}}" selected = "selected">{{$item->name}}</option>
                                                               @endif
                                                           @endif
                                                       @endforeach
                                                   @endif
                                               </select>
                                           </div>
                                       </div>
                                       <div class="col-md-3 no-padding" style="padding-right: 10px !important;">
                                           <div class="form-group">
                                               <label for="ChallanNoT{{$media->receive_master_id."-".$media->receive_detail_id}}" class="text-bold-700">Challan No</label>
                                               <input type="text" maxlength="150" id="ChallanNoT{{$media->receive_master_id."-".$media->receive_detail_id}}" class="form-control" name="reference_no" required>
                                           </div>
                                       </div>
                                       <div class="col-md-3 no-padding" style="padding-left: 10px !important;">
                                           <div class="form-group">
                                               <label for="GradeAT{{$media->receive_master_id."-".$media->receive_detail_id}}" class="text-bold-700">Grade A - [Stock: {{$media->grade_a - $media->issued_grade_a}}]</label>
                                               <input type="number" id="GradeAT{{$media->receive_master_id."-".$media->receive_detail_id}}" min="0"  max="{{$media->grade_a - $media->issued_grade_a}}" value="0" class="form-control" name="grade_a" required>
                                           </div>
                                       </div>
                                       <div class="col-md-3 no-padding">
                                           <div class="form-group">
                                               <label for="GradeBT{{$media->receive_master_id."-".$media->receive_detail_id}}B" class="text-bold-700">Grade B - [Stock: {{$media->grade_b - $media->issued_grade_b}}]</label>
                                               <input type="number" id="GradeBT{{$media->receive_master_id."-".$media->receive_detail_id}}" min="0"  max="{{$media->grade_b - $media->issued_grade_b}}" value="0" class="form-control" name="grade_b" required>
                                           </div>
                                       </div>
                                       <div class="col-md-3 no-padding">
                                           <div class="form-group">
                                               <label for="GradeCT{{$media->receive_master_id."-".$media->receive_detail_id}}" class="text-bold-700">Grade C - [Stock: {{$media->grade_c - $media->issued_grade_c}}]</label>
                                               <input type="number" id="GradeCT{{$media->receive_master_id."-".$media->receive_detail_id}}" min="0" max="{{$media->grade_c - $media->issued_grade_c}}" value="0" class="form-control" name="grade_c" required>
                                           </div>
                                       </div>
                                       <div class="col-md-3 no-padding" style="padding-right: 10px !important;">
                                           <div class="form-group">
                                               <label for="GradeDT{{$media->receive_master_id."-".$media->receive_detail_id}}" class="text-bold-700">Grade D - [Stock: {{$media->grade_d - $media->issued_grade_d}}]</label>
                                               <input type="number" id="GradeDT{{$media->receive_master_id."-".$media->receive_detail_id}}" min="0" class="form-control" max="{{$media->grade_d - $media->issued_grade_d}}" value="0" name="grade_d" required>
                                           </div>
                                       </div>
                                       <div class="col-md-3 no-padding" style="padding-left: 10px !important;">
                                           <div class="form-group">
                                               <label for="GradeTT{{$media->receive_master_id."-".$media->receive_detail_id}}" class="text-bold-700">Grade T - [Stock: {{$media->grade_t - $media->issued_grade_t}}]</label>
                                               <input type="number" id="GradeTT{{$media->receive_master_id."-".$media->receive_detail_id}}" min="0" class="form-control" max="{{$media->grade_t - $media->issued_grade_t}}" value="0" name="grade_t" required>
                                           </div>
                                       </div>
                                   </div>
                               </div>
                           </div>
                           <div class="modal-footer">
                               <button type="button" class="btn btn-outline-danger" data-dismiss="modal"><i class="fa fa-times"></i> Close</button>
                               <div {{--class="form-actions right"--}}>
                                   <button type="submit" id="submit_button_new_buyerT{{$media->receive_master_id."-".$media->receive_detail_id}}" class="btn btn-outline-primary">
                                       <i class="fa fa-check"></i> Save Transfer
                                   </button>
                               </div>
                           </div>
                       </form>
                   </div>
               </div>
           </div>
       @endforeach
   @endif
   {{-- end transfer modal--}}
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
            sessionStorage.clear();
            $(".select2").select2({
                dropdownAutoWidth: true,
                width: '100%'
            });
        });

        @if(!empty($departments))
        @foreach($departments AS $media)
            $(function(){
                $.ajaxSetup({
                    headers: { 'X-CSRF-TOKEN' : '{{ csrf_token() }}' }
                });
                $('#QCInsertFormI{{$media->receive_master_id."-".$media->receive_detail_id}}').submit(function(e){
                    e.preventDefault();
                    /* for ( instance in CKEDITOR.instances ) {
                         CKEDITOR.instances[instance].updateElement();
                     }*/
                    var data = $(this).serialize();
                    // var id = $('#HiddenFactoryID').val();
                    var url = '{{ route('issue.detail.save') }}';
                    //console.log(data);
                    //return;
                    $.ajax({
                        url: url,
                        method:'POST',
                        data:data,
                        success:function(data){
                            //console.log(data);
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
        @endforeach
        @endif

        @if(!empty($departments))
        @foreach($departments AS $media)
        $(function(){
            $.ajaxSetup({
                headers: { 'X-CSRF-TOKEN' : '{{ csrf_token() }}' }
            });
            $('#QCInsertFormT{{$media->receive_master_id."-".$media->receive_detail_id}}').submit(function(e){
                e.preventDefault();
                /* for ( instance in CKEDITOR.instances ) {
                     CKEDITOR.instances[instance].updateElement();
                 }*/
                var data = $(this).serialize();
                // var id = $('#HiddenFactoryID').val();
                var url = '{{ route('issue.detail.save') }}';
                //console.log(data);
                //return;
                $.ajax({
                    url: url,
                    method:'POST',
                    data:data,
                    success:function(data){
                        //console.log(data);
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
        @endforeach
        @endif

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


