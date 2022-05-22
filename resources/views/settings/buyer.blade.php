@extends('layouts.admin.admin-master')
@section('title')
    Buyer
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
                            <li class="breadcrumb-item active"><a href="{{route('settings.buyer.setup')}}">Buyer List</a>
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
                                <h4 class="card-title">Buyer Insert/Update Form</h4>
                                <a class="heading-elements-toggle"><i class="fa fa-ellipsis-v font-medium-3"></i></a>
                                <div class="heading-elements">
                                    <ul class="list-inline mb-0">
                                        <li><a data-action="collapse"><i class="feather icon-minus"></i></a></li>
                                        <li><a data-action="reload" onclick="clearForm('WorkExperienceForm'); changeButtonText(' Save', 'submit_button', 3); /*clearCheckBox(); *//*resetCkeditor('Description');*/"><i class="feather icon-rotate-cw"></i></a></li>
                                        <li><a data-action="expand"><i class="feather icon-maximize"></i></a></li>
                                        {{-- <li><a data-action="close"><i class="feather icon-x"></i></a></li>--}}
                                    </ul>
                                </div>
                            </div>
                            <div class="card-content collapse show">
                                <div class="card-body card-dashboard">
                                    <form class="form" id="WorkExperienceForm" method="post" action="#">
                                        @csrf
                                        <input type="hidden" id="HiddenFactoryID" class="form-control" name="id" >
                                        <div class="form-body">
                                            <div class="row">
                                                <div class="col-md-12">
                                                    <div class="form-group">
                                                        <label for="Degree" class="">Buyer Name</label>
                                                        <input type="text" id="Degree" maxlength="150" class="form-control" placeholder="Enter Buyer Name" name="name" required>
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
            <section id="configuration">
                <div class="row">
                    <div class="col-12">
                        <div class="card">
                            <div class="card-header">
                                <h4 class="card-title">Buyer  List</h4>
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
                                                <th class="text-center">Name</th>
                                                <th class="text-center">Action</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                       {{-- @if(!empty($departments))
                                            @foreach($departments as $media)
                                                <tr @if($media->status == 'I') class="bg-warning" @endif>
                                                    <td class="text-left">
                                                        {{$media->name}}
                                                    </td>
                                                    <td class="text-center">
                                                        <a class="btn btn-danger btn-sm btn-round fa fa-trash DeleteWorkExp" data-id="{{$media->id}}" title="Delete Factory"></a>
                                                        <a class="btn btn-info btn-sm btn-round fa fa-edit EditWorkExp" data-id="{{$media->id}}" title="Edit Factory"></a>
                                                        @if($media->status == 'A')
                                                            <a class="btn btn-warning btn-sm btn-round fa fa-times DeActivateWorkExp" data-id="{{$media->id}}" title="De-Activate Factory"></a>
                                                        @elseif($media->status == 'I')
                                                            <a class="btn btn-cyan btn-sm btn-round fa fa-check ActivateWorkExp" data-id="{{$media->id}}" title="Activate Factory"></a>
                                                        @else
                                                        @endif
                                                    </td>
                                                </tr>
                                            @endforeach
                                        @endif--}}
                                        </tbody>
                                        <tfoot>
                                            <tr>
                                                <th class="text-center">Name</th>
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
            /* CKEDITOR.replace( 'description',{
                 uiColor: '#CCEAEE'
             });*/

            $(".select2").select2({
                dropdownAutoWidth: true,
                width: '100%'
            });
            loadDataTable();
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


        function loadDataTable() {
            dataTable.destroy();
            var free_table = '<tr><td class="text-center" colspan="2">--- Please Wait... Loading Data  ----</td></tr>';

            $('.social-media').find('tbody').append(free_table);

            dataTable = $('.social-media').DataTable({
                ajax: {
                    url: "/lotfull/public/api/settings/buyer/setup/not-deleted-list",
                    dataSrc: ""
                },
                columns: [
                    {
                        render: function(data, type, api_item){
                            if(api_item.name === null){
                                return "<p class = 'text-left'></p>";
                            }else{
                                return "<p class = 'text-left'>"+ api_item.name +"</p>";
                            }
                        }
                    },
                    {
                        /*data: "id",*/
                        render: function(data, type, api_item) {
                            if(api_item.status === "A"){
                                return "<p class='text-center'>" +
                                        "<a title= 'De-Activate Factory' class= 'btn btn-warning btn-sm btn-round fa fa-times DeActivateWorkExp' data-id = "+ api_item.id +"></a>&nbsp;" +
                                        "<a title= 'Delete' class= 'btn btn-danger btn-sm btn-round fa fa-trash DeleteWorkExp' data-id = "+ api_item.id +"></a>&nbsp;" +
                                        "<a title= 'Edit' class= 'EditWorkExp btn btn-warning btn-sm btn-round fa fa-edit' data-id = "+ api_item.id +"></a>&nbsp;</p>";
                            }
                            else if(api_item.status === "I"){
                                return "<p class='text-center'>" +
                                        "<a title= 'Activate Factory' class= 'btn btn-cyan btn-sm btn-round fa fa-check ActivateWorkExp' data-id = "+ api_item.id +"></a>&nbsp;" +
                                        "<a title= 'Delete' class= 'btn btn-danger btn-sm btn-round fa fa-trash DeleteWorkExp' data-id = "+ api_item.id +"></a>&nbsp;</p>";
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
                            swal({
                                title: "Data Updated Successfully!",
                                icon: "success",
                                button: "Ok!",
                            }).then(function (value) {
                                if(value){
                                    hitTableRefresh();
                                    clearFormWithoutDelay('WorkExperienceForm');
                                    changeButtonText(' Save', 'submit_button', 3);
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
                                    clearFormWithoutDelay('WorkExperienceForm');
                                    changeButtonText(' Save', 'submit_button', 3);
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
            var url = '{{ route('settings.buyer.setup.delete') }}';
            swal({
                title: 'Are you sure?',
                text: 'This record will be removed permanently!',
                icon: 'warning',
                buttons: ["Cancel", "Yes!"],
            }).then(function(value) {
                if (value) {
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
                            else{
                                swalUnSuccessFull();
                            }
                        },
                        error:function(error){
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
                            else{
                                swalUnSuccessFull();
                            }
                        },
                        error:function(error){
                            swalError(error);
                        }
                    })
                }
            });
        });

        $('#social-media-table').on('click',".EditWorkExp", function(){
            var button = $(this);
            var id = button.attr("data-id");
            var url = '{{ route('settings.buyer.setup.edit') }}';
            $.ajax({
                url: url,
                method:'POST',
                data:{id: id, _token: '{{csrf_token()}}'},
                success:function(data){
                    $('input[name=name]').val(data.name);
                    $('input[name=id]').val(data.id);
                    moveToTop();
                    changeButtonText(' Update', 'submit_button', 3);
                },
                error:function(error){
                    moveToTop();
                    swalError(error);
                    clearForm('WorkExperienceForm');
                    changeButtonText(' Save', 'submit_button', 3);
                }
            })
        });

        /* function clearCheckBox() {
             //console.log('hit');
            $('input[name=department_applicable]').prop('checked', false);
         }*/
    </script>
@endsection


