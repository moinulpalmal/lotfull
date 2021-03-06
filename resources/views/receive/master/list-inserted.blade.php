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
                                        <li><a data-action="reload" onclick="loadDataTable()" id="DataTableButton"><i class="feather icon-rotate-cw"></i></a></li>
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
                                                <th class="text-center">Age</th>
                                                <th class="text-center">Receive Date</th>
                                                <th class="text-center">Challan No</th>
                                                <th class="text-center">Receive From</th>
                                                <th class="text-center">Receive Type</th>
                                                <th class="text-center">Location</th>
                                                <th class="text-center">Action</th>
                                            </tr>
                                        </thead>
                                        <tbody>

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
    <div class="modal fade text-left" id="UpdateMasterModal" tabindex="-1" role="dialog" aria-labelledby="myModalLabel16" aria-hidden="true">
       <div class="modal-dialog modal-xl" role="document">
           <div class="modal-content">
               <div class="modal-header bg-gradient-radial-cyan white">
                   <h4 class="modal-title text-bold-700" id="myModalLabel16">Update Receive Master</h4>
                   <button type="button" class="close" data-dismiss="modal" aria-label="Close" {{--onclick="clearForm('UpdateMasterForm')"--}}>
                       <span aria-hidden="true">&times;</span>
                   </button>
               </div>
               <form class="form" id="UpdateMasterForm" method="post" action="#">
                   <div class="modal-body">
                       @csrf
                       <input type="hidden" id="MasterIDT" class="form-control" name="id" >
                       <div class="form-body">
                           <div class="row">
                               <div class="col-md-3 no-padding" style="padding-left: 10px !important;">
                                   <div class="form-group">
                                       <label for="Factory" class="text-bold-700">Receive From</label>
                                       <select id="Factory" class="select2 form-control" name="receive_from" required>
                                           <option value="" >- - - Select - - -</option>
                                           @if(!empty($factories))
                                               @foreach($factories AS $item)
                                                   @if($factories->count() > 1)
                                                       <option value="{{$item->id}}" >{{$item->name}}</option>
                                                   @else
                                                       <option value="{{$item->id}}" selected = "selected">{{$item->name}}</option>
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
                                               @foreach($locations AS $item)
                                                   @if($locations->count() > 1)
                                                       <option value="{{$item->id}}">{{$item->name}}</option>
                                                   @else
                                                       <option value="{{$item->id}}" selected = "selected">{{$item->name}}</option>
                                                   @endif
                                               @endforeach
                                           @endif
                                       </select>
                                   </div>
                               </div>
                               <div class="col-md-2 no-padding">
                                   <div class="form-group">
                                       <label for="ReceiveDate" class="text-bold-700">Receive Date</label>
                                       <input type="date" id="ReceiveDate" class="form-control" name="receive_date" required >
                                   </div>
                               </div>
                               <div class="col-md-4 no-padding" style="padding-right: 10px !important;">
                                   <div class="form-group">
                                       <label for="ChallanNo" class="text-bold-700">Challan No</label>
                                       <input type="text" id="ChallanNo" class="form-control" name="reference_no" required >
                                   </div>
                               </div>
                               <div class="col-md-12 no-padding" style="padding-left: 10px !important; padding-right: 10px !important;">
                                   <div class="form-group">
                                       <label for="Remarks" class="text-bold-700">Remarks</label>
                                       <input type="text" id="Remarks" maxlength="250" class="form-control" name="remarks" >
                                   </div>
                               </div>
                           </div>
                       </div>
                   </div>
                   <div class="modal-footer">
                       <button type="button" {{--onclick="clearForm('UpdateMasterForm')"--}} class="btn btn-outline-danger" data-dismiss="modal"><i class="fa fa-times"></i> Close</button>
                       <button type="submit" id="update_master_button" class="btn btn-outline-primary"><i class="fa fa-check"></i> Update Receive Master</button>
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

        $(document).ready(function () {
            sessionStorage.clear();
            $(".select2").select2({
                dropdownAutoWidth: true,
                width: '100%'
            });
            loadDataTable();
            //makeTableSearchAble();
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

        function loadDataTable() {
            dataTable.destroy();
            var free_table = '<tr><td class="text-center" colspan="7">--- Please Wait... Loading Data  ----</td></tr>';

            $('.social-media').find('tbody').append(free_table);

            dataTable = $('.social-media').DataTable({
                ajax: {
                    url: "/lotfull/public/api/receive/list/master/inserted/{{ Auth::user()->id}}",
                    dataSrc: ""
                },
                columns: [
                    {
                        render: function(data, type, api_item){
                            if(api_item.age === null){
                                return "<p class = 'text-left'></p>";
                            }else{
                                return "<p class = 'text-left text-bold' style='color: "+ api_item.color_code +"; font-weight: bold '>"+ api_item.age +"</p>";
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
                            if(api_item.stock_location === null){
                                return "<p class = 'text-left'></p>";
                            }else{
                                return "<p class = 'text-left'>"+ api_item.stock_location + "</p>";
                            }
                        }
                    },
                    {
                        render: function(data, type, api_item) {
                            if(parseInt(api_item.update_access) === 1){
                                if(parseInt(api_item.age)  < 46){
                                    return "<p class='text-center'>" +
                                        @if(Auth::user()->hasTaskPermission('receive_delete', Auth::user()->id))
                                            "<a title= 'Delete' class= 'btn btn-danger btn-sm btn-round fa fa-trash DeleteWorkExp' data-id = "+ api_item.id +"></a>" +
                                            " &nbsp;" +
                                        @endif
                                            @if(Auth::user()->hasTaskPermission('receive_update', Auth::user()->id))
                                            "<a title= 'Update Master' class= 'btn btn-warning btn-sm btn-round fa fa-edit UpdateMaster' data-toggle='modal' onclick='openUpdateMasterModal();'  data-id = "+ api_item.id +"></a>" +
                                            " &nbsp;" +
                                            @endif
                                            "</p>";
                                }
                                else{

                                    return "<p class='text-center'>" +
                                    @if(Auth::user()->hasPermission('administrator', Auth::user()->id))
                                        "<a title= 'Delete' class= 'btn btn-danger btn-sm btn-round fa fa-trash DeleteWorkExp' data-id = "+ api_item.id +"></a>" +
                                    " &nbsp;" +
                                    @endif
                                        @if(Auth::user()->hasTaskPermission('receive_update', Auth::user()->id))
                                        "<a title= 'Update Master' class= 'btn btn-warning btn-sm btn-round fa fa-edit UpdateMaster' onclick='openUpdateMasterModal();' data-toggle='modal'  data-id = "+ api_item.id +"></a>" +
                                        " &nbsp;" +
                                        @endif
                                        "</p>";
                                }

                            }
                            else{
                                return "<p class='text-center'></p>";
                            }
                        }
                     }
                ],
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
            makeTableSearchAble();
        }

        $(function(){
            $.ajaxSetup({
                headers: { 'X-CSRF-TOKEN' : '{{ csrf_token() }}' }
            });
            $('#UpdateMasterForm').submit(function(e){
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
                        if(data === '2')
                        {
                            swal({
                                title: "Data Updated Successfully!",
                                icon: "success",
                                button: "Ok!",
                            }).then(function (value) {
                                if(value){
                                    hitTableRefresh();
                                    $("#UpdateMasterModal").modal('hide');
                                    //clearFormWithoutDelay('WorkExperienceForm');
                                    //changeButtonText(' Save', 'submit_button', 3);
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
                                    //clearFormWithoutDelay('WorkExperienceForm');
                                    //changeButtonText(' Save', 'submit_button', 3);
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
                            //console.log(error);
                            swalError(error);
                        }
                    })
                }
            });
        });

        $('#social-media-table').on('click',".UpdateMaster", function(){
            var button = $(this);
            var id = button.attr("data-id");
            var url = '{{ route('receive.master.edit') }}';
            $.ajax({
                url: url,
                method:'POST',
                data:{id: id, _token: '{{csrf_token()}}'},
                success:function(data){
                    $('select[name=receive_from]').val(data.receive_from).change();
                    $('select[name=location]').val(data.location).change();
                    $('input[name=receive_date]').val(data.receive_date);
                    $('input[name=reference_no]').val(data.reference_no);
                    $('input[name=remarks]').val(data.remarks);
                    $('input[name=id]').val(data.id);
                    //moveToTop();
                    //changeButtonText(' Update', 'submit_button', 3);
                },
                error:function(error){
                    //moveToTop();
                    swalError(error);
                    //clearForm('UpdateMasterForm');
                   // changeButtonText(' Save', 'submit_button', 3);
                }
            })
        });

        function openUpdateMasterModal() {
            $('#UpdateMasterModal').modal({backdrop: 'static', keyboard: false});
        }

    </script>
@endsection


