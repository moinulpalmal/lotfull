@extends('layouts.admin.admin-master')
@section('title')
    Image Upload
@endsection
@section('content')
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
                            <li class="breadcrumb-item active"><a href="{{route('receive.image-upload')}}">New Receive</a>
                            </li>
                        </ol>
                    </div>
                </div>
            </div>
        </div>
        <div class="content-body">
            <section id="form-section">
                <div class="row">
                    <div class="col-12">
                        <div class="card">
                            <div class="card-header">
                                <h4 class="card-title">Search Form</h4>
                                <a class="heading-elements-toggle"><i class="fa fa-ellipsis-v font-medium-3"></i></a>
                                <div class="heading-elements">
                                    <ul class="list-inline mb-0">
                                        <li><a data-action="collapse"><i class="feather icon-minus"></i></a></li>
                                        <li><a data-action="reload" onclick="clearForm('WorkExperienceForm'); clearTableTbody(); changeButtonText(' Save', 'submit_button', 3); /*clearCheckBox(); *//*resetCkeditor('Description');*/"><i class="feather icon-rotate-cw"></i></a></li>
                                        <li><a data-action="expand"><i class="feather icon-maximize"></i></a></li>
                                        {{-- <li><a data-action="close"><i class="feather icon-x"></i></a></li>--}}
                                    </ul>
                                </div>
                            </div>
                            <div class="card-content collapse show">
                                <div class="card-body card-dashboard">
                                    <form class="form" id="WorkExperienceForm" method="post" action="{{route('receive.image-upload-search')}}">
                                        @csrf
                                       {{-- <input type="hidden" id="HiddenFactoryID" class="form-control" name="id" >--}}
                                        <div class="form-body">
                                            <h4 class="form-section"><i class="feather icon-eye"></i> Search Parameters</h4>
                                            <div class="row">
                                                <div class="col-md-4 no-padding">
                                                    <div class="form-group">
                                                        <label for="ReceiveDate" class="text-bold-700">Receive Date</label>
                                                        <input type="date" id="ReceiveDate" class="form-control" name="receive_date">
                                                    </div>
                                                </div>
                                                <div class="col-md-4 no-padding">
                                                    <div class="form-group">
                                                        <label for="ChallanNo" class="text-bold-700">Challan No</label>
                                                        <input type="text" id="ChallanNo" class="form-control" name="reference_no">
                                                    </div>
                                                </div>
                                                <div class="col-md-4 no-padding">
                                                    <div class="form-group">
                                                        <label for="StyleNo" class="text-bold-700">Buyer Style No</label>
                                                        <input type="text" id="StyleNo" class="form-control" name="style_no">
                                                    </div>
                                                </div>
                                                <div class="col-md-3 no-padding">
                                                    <div class="form-group">
                                                        <label for="Buyers" class="text-bold-700">Buyer</label>
                                                        <select id="Buyers" class="select2 form-control" name="buyer">
                                                            <option value="" >- - - Select - - -</option>
                                                            @if(!empty($buyers))
                                                                @foreach($buyers AS $media)
                                                                    @if($buyers->count() > 1)
                                                                        <option value="{{$media->id}}" >{{$media->name}}</option>
                                                                    @else
                                                                        <option value="{{$media->id}}" selected = "selected">{{$media->name}}</option>
                                                                    @endif
                                                                @endforeach
                                                            @endif
                                                        </select>
                                                    </div>
                                                </div>
                                                <div class="col-md-3 no-padding">
                                                    <div class="form-group">
                                                        <label for="GarmentsType" class="text-bold-700">Garments Type</label>
                                                        <select id="GarmentsType" class="select2 form-control" name="garments_type">
                                                            <option value="" >- - - Select - - -</option>
                                                            @if(!empty($garments_types))
                                                                @foreach($garments_types AS $media)
                                                                    @if($garments_types->count() > 1)
                                                                        <option value="{{$media->id}}" >{{$media->name}}</option>
                                                                    @else
                                                                        <option value="{{$media->id}}" selected = "selected">{{$media->name}}</option>
                                                                    @endif
                                                                @endforeach
                                                            @endif
                                                        </select>
                                                    </div>
                                                </div>
                                                <div class="col-md-3 no-padding">
                                                    <div class="form-group">
                                                        <label for="Factory" class="text-bold-700">Receive From</label>
                                                        <select id="Factory" class="select2 form-control" name="receive_from" >
                                                            <option value="" >- - - Select - - -</option>
                                                            @if(!empty($receive_froms))
                                                                @foreach($receive_froms AS $media)
                                                                    @if($receive_froms->count() > 1)
                                                                        <option value="{{$media->id}}" >{{$media->name}}</option>
                                                                    @else
                                                                        <option value="{{$media->id}}" selected = "selected">{{$media->name}}</option>
                                                                    @endif
                                                                @endforeach
                                                            @endif
                                                        </select>
                                                    </div>
                                                </div>
                                                <div class="col-md-3 no-padding">
                                                    <div class="form-group">
                                                        <label for="Locations" class="text-bold-700">My Location</label>
                                                        <select id="Locations" class="select2 form-control" name="location" >
                                                            <option value="" >- - - Select - - -</option>
                                                            @if(!empty($locations))
                                                                @foreach($locations AS $media)
                                                                    @if($locations->count() > 1)
                                                                        <option value="{{$media->id}}" >{{$media->name}}</option>
                                                                    @else
                                                                        <option value="{{$media->id}}" selected = "selected">{{$media->name}}</option>
                                                                    @endif
                                                                @endforeach
                                                            @endif
                                                        </select>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="form-actions right">
                                            <button type="submit" id="submit_button" class="btn btn-outline-primary">
                                                <i class="feather icon-check"></i> Search
                                            </button>
                                        </div>
                                    </form>
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
            sessionStorage.clear();
            $(".select2").select2({
                dropdownAutoWidth: true,
                width: '100%'
            });
        });
    </script>
@endsection


