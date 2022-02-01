@extends('layouts.admin.admin-master')
@section('title')
    New Receive
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
                            <li class="breadcrumb-item active"><a href="{{route('receive.new')}}">New Receive</a>
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
                                <h4 class="card-title">Receive Insert Form</h4>
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
                                    <form class="form" id="WorkExperienceForm" method="post" action="#">
                                        @csrf
                                       {{-- <input type="hidden" id="HiddenFactoryID" class="form-control" name="id" >--}}
                                        <div class="form-body">
                                            <h4 class="form-section"><i class="feather icon-eye"></i> Challan Information</h4>
                                            <div class="row">
                                                <div class="col-md-3 no-padding">
                                                    <div class="form-group">
                                                        <label for="Factory" class="text-bold-700">Receive From</label>
                                                        <select id="Factory" class="select2 form-control" name="receive_from" required>
                                                            <option value="" >- - - Select - - -</option>
                                                            @if(!empty($factories))
                                                                @foreach($factories AS $media)
                                                                    @if($factories->count() > 1)
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
                                                        <label for="Locations" class="text-bold-700">Location</label>
                                                        <select id="Locations" class="select2 form-control" name="location" required>
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
                                                <div class="col-md-2 no-padding">
                                                    <div class="form-group">
                                                        <label for="ReceiveDate" class="text-bold-700">Receive Date</label>
                                                        <input type="date" id="ReceiveDate" class="form-control" name="receive_date" required>
                                                    </div>
                                                </div>
                                                <div class="col-md-4 no-padding">
                                                    <div class="form-group">
                                                        <label for="ChallanNo" class="text-bold-700">Challan No</label>
                                                        <input type="text" id="ChallanNo" class="form-control" name="reference_no" required>
                                                    </div>
                                                </div>
                                                <div class="col-md-12 no-padding">
                                                    <div class="form-group">
                                                        <label for="Remarks" class="text-bold-700">Remarks</label>
                                                        <input type="text" id="Remarks" maxlength="250" class="form-control" name="remarks">
                                                    </div>
                                                </div>
                                            </div>
                                            <h4 class="form-section"><i class="feather icon-eye"></i> Garments List</h4>
                                            <div class="row">
                                                <div class="col-md-12 no-padding">
                                                    <div class="form-group">
                                                        <table id="myTable" class="table table-info table-bordered table-responsive table-condensed">
                                                            <thead>
                                                                <tr>
                                                                    <th class="text-bold-700 text-center">Buyer</th>
                                                                    <th class="text-bold-700 text-center">Garments Type</th>
                                                                    <th class="text-bold-700 text-center">Unit</th>
                                                                    <th class="text-bold-700 text-center">Style No</th>
                                                                    <th class="text-bold-700 text-center">Receive Qty</th>
                                                                    <th class="text-bold-700 text-center">Remarks</th>
                                                                    <th class="text-center text-bold-700"><a style="text-align: center;color: white;" href="#" class="addRow Scroll"><i class="fa fa-plus text-bold-700" style="color: #0c1d2f"></i></a></th>
                                                                </tr>
                                                            </thead>
                                                            <tbody>
                                                            </tbody>
                                                        </table>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="form-actions right">
                                            <button type="submit" id="submit_button" class="btn btn-outline-primary">
                                                <i class="feather icon-check"></i> Save
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

        $('.addRow').on('click',function(){
            addRow();
        });

        function addRow()
        {
            var rowID=sessionStorage.getItem("rowID");
            if(rowID){
                rowID = parseInt(rowID);
                rowID++;
            }else{
                rowID = 0;
            }
            sessionStorage.setItem("rowID", rowID);
            var tr = '<tr>'+
                '<td width="15%">'+
                '<select style="width: 100%;" class="form-control select2 BuyerID" data-id = "'+rowID+'" name="buyer_id['+rowID+']" id="BuyerID'+rowID+'" required="">'+
                '<option value="">- Select -</option>'+
                '@if(!empty($buyers))'+
                '@foreach($buyers as $group)'+
                '@if($buyers->count() > 1)'+
                '<option value="{{ $group->id }}">{{ $group->name }}</option>'+
                '@else'+
                '<option value="{{ $group->id }}" selected = "selected">{{ $group->name }}</option>'+
                '@endif'+
                '@endforeach'+
                '@endif'+
                '</select>'+
                '</td>'+
                '<td width="20%">'+
                '<select style="width: 100%;" class="form-control select2 GarmentsTypeID" data-id = "'+rowID+'" name="garments_type_id['+rowID+']" id="GarmentsTypeID'+rowID+'"required="">'+
                '<option value = "">- Select -</option>'+
                '@if(!empty($garments_types))'+
                '@foreach($garments_types as $group)'+
                '@if($garments_types->count() > 1)'+
                '<option value="{{ $group->id }}">{{ $group->name }}</option>'+
                '@else'+
                '<option value="{{ $group->id }}" selected = "selected">{{ $group->name }}</option>'+
                '@endif'+
                '@endforeach'+
                '@endif'+
                '</select>'+
                '</td>'+
                '<td width="15%">'+
                '<select style="width: 100%;" class="form-control select2 UnitID" data-id = "'+rowID+'" name="unit_id['+rowID+']" id="UnitID'+rowID+'" required="">'+
                '<option value = "">- - Select - -</option>'+
                '@if(!empty($units))'+
                '@foreach($units as $group)'+
                '@if($units->count() > 1)'+
                '<option value="{{ $group->id }}">{{ $group->full_unit }}</option>'+
                '@else'+
                '<option value="{{ $group->id }}" selected = "selected">{{ $group->full_unit }}</option>'+
                '@endif'+
                '@endforeach'+
                '@endif'+
                '</select>'+
                '</td>'+
                '<td><input type="text" class="form-control StyleNo" name="buyer_style_no['+rowID+']" required=""></td>'+
                '<td><input type="number" min="1" class="form-control qty" name="received_total_quantity['+rowID+']" required=""></td>'+
                '<td><input type="text" class="form-control Remarks" name="detail_remarks['+rowID+']" ></td>'+
                '<td><a href="#" class="btn-danger btn-sm remove"><i class="fa fa-trash"></i></a></td>'+
                '</tr>';

            $('#myTable').find('tbody:last').append(tr);
            $(".select2").select2({
                dropdownAutoWidth: true,
                width: '100%'
            });
        };

        $('body').delegate('.remove','click',function(){

            var l = $('#myTable >tbody >tr').length;
            if(l == 1)
            {
                $(".select2").select2({
                    dropdownAutoWidth: true,
                    width: '100%'
                });
                //alert('Not allowed to remove this row!');
                swal({
                    title: "Not allowed to remove this row!",
                    icon: "warning",
                    button: "Ok!",
                })
            }
            else
            {
                $(this).parent().parent().remove();
                $(".select2").select2({
                    dropdownAutoWidth: true,
                    width: '100%'
                });

            }
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
                var url = '{{ route('receive.save') }}';
                //console.log(data);
                var l = $('#myTable >tbody >tr').length;
                if(parseInt(l) > 0){
                    $.ajax({
                        url: url,
                        method:'POST',
                        data:data,
                        success:function(data){
                            // console.log(data);
                            //return;
                            if(data === '1')
                            {
                                clearTableTbody();
                                swalInsertSuccessFullWithClearForm('WorkExperienceForm');
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
                }
                else{
                    swal({
                        title: "Error!",
                        text: "Empty Garments List",
                        icon: "error",
                        button: "Ok!",
                        className: "myClass",
                    });
                }


            })
        });

        function clearTableTbody(){
            $("#myTable > tbody").empty();
            sessionStorage.clear();
        }
    </script>
@endsection


