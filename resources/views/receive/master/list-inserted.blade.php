@extends('layouts.admin.admin-master')
@section('title')
    Receive List
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
                            <li class="breadcrumb-item active"><a href="{{route('receive.list.master.inserted')}}">Receive List (Inserted)</a>
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
                                <h4 class="card-title">Receive  List (Inserted)</h4>
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
                                    <table id="social-media-table" class="table table-striped table-bordered table-condensed social-media table-info">
                                        <thead>
                                            <tr>
                                                <th class="text-center">Receive Date</th>
                                                <th class="text-center">Age</th>
                                                <th class="text-center">Challan No</th>
                                                <th class="text-center">Receive From</th>
                                                <th class="text-center">Receive Type</th>
                                                <th class="text-center">Location</th>
                                                <th class="text-center">Action</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                        @if(!empty($departments))
                                            @foreach($departments as $media)
                                                <tr>
                                                    <td class="text-center">
                                                        {{\Carbon\Carbon::parse($media->receive_date)->format('d-M-Y')}}
                                                    </td>
                                                    <td class="text-center" style="background-color: {{\App\Model\StockThreshold::returnColorCode(\App\Helpers\Helper::ageInDays($media->receive_date))}}">
                                                        {{\App\Helpers\Helper::ageInDays($media->receive_date)}}
                                                    </td>
                                                    <td class="text-center">
                                                        {{$media->reference_no}}
                                                    </td>
                                                    <td class="text-left">
                                                        @if($media->receive_type == 'r')
                                                            {{\App\Helpers\Helper::IDwiseData('factories', 'id', $media->receive_from)->factory_name." "."-"." ".\App\Helpers\Helper::IDwiseData('factories', 'id', $media->receive_from)->unit_name}}
                                                        @else
                                                            {{\App\Helpers\Helper::IDwiseData('locations', 'id', $media->receive_from)->name}}
                                                        @endif
                                                    </td>
                                                    <td class="text-left">
                                                        @if($media->receive_type == 'r')
                                                            New Receive
                                                        @else
                                                            Transfer Receive
                                                        @endif
                                                    </td>
                                                    <td class="text-left">
                                                        {{\App\Helpers\Helper::IDwiseData('locations', 'id', $media->location_id)->name}}
                                                    </td>
                                                    <td class="text-center">
                                                        @if(\App\Model\ReceiveMaster::checkUpdateAccess($media->id) == true)
                                                            @if(Auth::user()->hasTaskPermission('receive_delete', Auth::user()->id))
                                                                <a class="btn btn-danger btn-sm btn-round fa fa-trash DeleteWorkExp" data-id="{{$media->id}}" title="Delete Factory"></a>
                                                            @endif
                                                            @if(Auth::user()->hasTaskPermission('receive_update', Auth::user()->id))
                                                                <a class="btn btn-warning btn-sm btn-round fa fa-edit" onclick=" $('#UpdateMaster{{$media->id}}').modal({backdrop: 'static', keyboard: false});" data-toggle="modal" {{-- data-target="#NewFactory"--}} title="Issue Entry"></a>
                                                                @endif
                                                                    {{-- @if($media->status == 'A')
                                                                <a class="btn btn-warning btn-sm btn-round fa fa-times DeActivateWorkExp" data-id="{{$media->id}}" title="De-Activate Factory"></a>
                                                                @elseif($media->status == 'I')
                                                                <a class="btn btn-cyan btn-sm btn-round fa fa-check ActivateWorkExp" data-id="{{$media->id}}" title="Activate Factory"></a>
                                                                @else
                                                            @endif--}}
                                                        @endif
                                                    </td>
                                                </tr>
                                            @endforeach
                                        @endif
                                        </tbody>
                                        <tfoot>
                                            <tr>
                                                <th class="text-center">Receive Date</th>
                                                <th class="text-center">Age</th>
                                                <th class="text-center">Challan No</th>
                                                <th class="text-center">Receive From</th>
                                                <th class="text-center">Receive Type</th>
                                                <th class="text-center">Location</th>
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
    @if(!empty($departments))
        @foreach($departments as $media)
            <div class="modal fade text-left" id="UpdateMaster{{$media->id}}" tabindex="-1" role="dialog" aria-labelledby="myModalLabel16" aria-hidden="true">
                <div class="modal-dialog modal-xl" role="document">
                    <div class="modal-content">
                        <div class="modal-header bg-gradient-radial-cyan white">
                            <h4 class="modal-title text-bold-700" id="myModalLabel16">Update Receive Master</h4>
                            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                <span aria-hidden="true">&times;</span>
                            </button>
                        </div>
                        <form class="form" id="UpdateMasterForm{{$media->id}}" method="post" action="#">
                            <div class="modal-body">
                                @csrf
                                <input type="hidden" id="MasterIDT" class="form-control" name="id" value="{{old('id', $media->id)}}">
                                <div class="form-body">
                                    <div class="row">
                                        <div class="col-md-3 no-padding" style="padding-left: 10px !important;">
                                            <div class="form-group">
                                                <label for="Factory{{$media->id}}" class="text-bold-700">Receive From</label>
                                                <select id="Factory{{$media->id}}" class="select2 form-control" name="receive_from" required>
                                                    <option value="" >- - - Select - - -</option>
                                                    @if(!empty($factories))
                                                        @foreach($factories AS $item)
                                                            @if($factories->count() > 1)
                                                                <option value="{{$item->id}}" @if($item->id == $media->receive_from) selected = "selected" @endif>{{$item->name}}</option>
                                                            @else
                                                                <option value="{{$item->id}}" @if($item->id == $media->receive_from) selected = "selected" @endif>{{$item->name}}</option>
                                                            @endif
                                                        @endforeach
                                                    @endif
                                                </select>
                                            </div>
                                        </div>
                                        <div class="col-md-3 no-padding">
                                            <div class="form-group">
                                                <label for="Locations{{$media->id}}" class="text-bold-700">Location</label>
                                                <select id="Locations{{$media->id}}" class="select2 form-control" name="location" required>
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
                                        <div class="col-md-2 no-padding">
                                            <div class="form-group">
                                                <label for="ReceiveDate{{$media->id}}" class="text-bold-700">Receive Date</label>
                                                <input type="date" id="ReceiveDate" class="form-control" name="receive_date" required value="{{old('receive_date', $media->receive_date)}}">
                                            </div>
                                        </div>
                                        <div class="col-md-4 no-padding" style="padding-right: 10px !important;">
                                            <div class="form-group">
                                                <label for="ChallanNo{{$media->id}}" class="text-bold-700">Challan No</label>
                                                <input type="text" id="ChallanNo" class="form-control" name="reference_no" required value="{{old('reference_no', $media->reference_no)}}">
                                            </div>
                                        </div>
                                        <div class="col-md-12 no-padding" style="padding-left: 10px !important; padding-right: 10px !important;">
                                            <div class="form-group">
                                                <label for="Remarks{{$media->id}}" class="text-bold-700">Remarks</label>
                                                <input type="text" id="Remarks" maxlength="250" class="form-control" name="remarks" value="{{old('remarks', $media->remarks)}}">
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="modal-footer">
                                <button type="button" class="btn btn-outline-danger" data-dismiss="modal"><i class="fa fa-times"></i> Close</button>
                                <div {{--class="form-actions right"--}}>
                                    <button type="submit" id="submit_button_new_buyerT{{$media->id}}" class="btn btn-outline-primary">
                                        <i class="fa fa-check"></i> Update Receive Master
                                    </button>
                                </div>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        @endforeach
    @endif
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
            $('#UpdateMasterForm{{$media->id}}').submit(function(e){
                e.preventDefault();
                /* for ( instance in CKEDITOR.instances ) {
                     CKEDITOR.instances[instance].updateElement();
                 }*/
                var data = $(this).serialize();
                // var id = $('#HiddenFactoryID').val();
                var url = '{{ route('receive.master.update') }}';
                //console.log(data);
               // return;
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
            var url = '{{ route('receive.master.delete') }}';
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
            var url = '{{ route('settings.buyer.setup.de-activate') }}';
            swal({
                title: 'Are you sure?',
                text: 'This record will be de-activated temporarily!',
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
                            if(data === '1'){
                                swalSuccessFullWithRefresh();
                            }
                            else if(data === '0'){
                                swalUnSuccessFull();
                            }
                            else{
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

        $('#social-media-table').on('click',".ActivateWorkExp", function(){
            var button = $(this);
            var id = button.attr("data-id");
            var url = '{{ route('settings.buyer.setup.activate') }}';
            swal({
                title: 'Are you sure?',
                text: 'This record will be activated permanently!',
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
                            if(data === '1'){
                                //console.log(data);
                                swalSuccessFullWithRefresh();
                            }
                            else if(data === '0'){
                                swalUnSuccessFull();
                            }
                            else{
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


