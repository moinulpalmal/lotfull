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
             <section id="configuration">
               <div class="row" id="MyRow">
                   <div class="col-md-12">
                       <div class="card">
                           <div class="card-header">
                               <h4 class="card-title">Information</h4>
                           </div>
                           <div class="card-content collapse show">
                               <div class="card-body card-dashboard">
                                   <table class="table table-striped table-bordered table-condensed table-responsive table-info">
                                       <thead>
                                           <tr>
                                               <th class="text-center">Receive From</th>
                                               <th class="text-center">Challan No</th>
                                               <th class="text-center">Buyer</th>
                                               <th class="text-center">Style No</th>
                                               <th class="text-center">Garments Type</th>
                                           </tr>
                                       </thead>
                                       <tbody>
                                           <tr>
                                               <td class="text-left">
                                                   @if($target->receive_type == 'r')
                                                       {{\App\Helpers\Helper::IDwiseData('factories', 'id', $target->receive_from)->factory_short_name." "."-"." ".\App\Helpers\Helper::IDwiseData('factories', 'id', $target->receive_from)->unit_short_name}}
                                                   @else
                                                       {{\App\Helpers\Helper::IDwiseData('locations', 'id', $target->receive_from)->name}}
                                                   @endif
                                               </td>
                                               <td class="text-left">
                                                   {{$target->reference_no}}
                                               </td>
                                               <td class="text-left">
                                                   {{$target->buyer_name}}
                                               </td>
                                               <td class="text-left">
                                                   {{$target->style_no}}
                                               </td>
                                               <td class="text-center">
                                                   {{$target->garments_type}}
                                               </td>
                                           </tr>
                                       </tbody>
                                   </table>
                               </div>
                           </div>
                       </div>
                   </div>
                   <div class="col-md-12">
                       <div class="card">
                           <div class="card-header">
                               <h4 class="card-title">Image Insert Form</h4>
                           </div>
                           <div class="card-content collapse show">
                               <div class="card-body card-dashboard">
                                   <form class="form" id="WorkExperienceForm" method="post" enctype="multipart/form-data" action="{{route('receive.save-image-upload')}}">
                                       @csrf
                                       <input type="hidden" id="HiddenFactoryID" class="form-control" name="receive_master_id" value="{{old('receive_master_id', $target->receive_master_id)}}">
                                       <input type="hidden" id="HiddenFactoryDID" class="form-control" name="receive_detail_id" value="{{old('receive_detail_id', $target->counter)}}">
                                       <div class="form-body">
                                           @if (count($errors) > 0)
                                               <div class="row" style="padding: 0px 15px;">
                                                   <div class="col-md-12">
                                                       <div class="alert alert-icon-left alert-danger alert-dismissible mb-2" role="alert">
                                                           {{-- <span class="alert-icon"><i class="fa fa-info"></i></span>--}}
                                                           <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                                                               <span aria-hidden="true">×</span>
                                                           </button>
                                                           <strong>Whoops!</strong> There were some problems with your input.<br><br>
                                                           <ul>
                                                               @foreach ($errors->all() as $error)
                                                                   <li>{{ $error }}</li>
                                                               @endforeach
                                                           </ul>
                                                       </div>
                                                   </div>
                                               </div>
                                           @endif
                                           @if($message = Session::get('success'))
                                               <div class="row" style="padding: 0px 15px;">
                                                   <div class="col-md-12">
                                                       <div class="alert alert-icon-left alert-success alert-dismissible mb-2" role="alert">
                                                           {{--  <span class="alert-icon"><i class="fa fa-thumbs-up"></i></span>--}}
                                                           <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                                                               <span aria-hidden="true">×</span>
                                                           </button>
                                                           <strong>Success!</strong> {{ $message }}<br><br>
                                                       </div>
                                                   </div>
                                               </div>
                                           @endif
                                           @if($message = Session::get('error'))
                                               <div class="row" style="padding: 0px 15px;">
                                                   <div class="col-md-12">
                                                       <div class="alert alert-icon-left alert-danger alert-dismissible mb-2" role="alert">
                                                           {{-- <span class="alert-icon"><i class="fa fa-thumbs-down"></i></span>--}}
                                                           <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                                                               <span aria-hidden="true">×</span>
                                                           </button>
                                                           <strong>Whoops!</strong> {{ $message }}<br><br>
                                                       </div>
                                                   </div>
                                               </div>
                                           @endif
                                           <h4 class="form-section"><i class="feather icon-eye"></i> Image List</h4>
                                           <div class="row">
                                               <div class="col-md-12 no-padding">
                                                   <div class="form-group">
                                                       <table id="myTable" class="table table-info table-bordered table-condensed">
                                                           <thead>
                                                           <tr>
                                                               <th class="text-bold-700 text-center">Style No</th>
                                                               <th class="text-bold-700 text-center">Image</th>
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
                                               <i class="feather icon-check"></i> Upload
                                           </button>
                                       </div>
                                   </form>
                               </div>
                           </div>

                       </div>
                   </div>
                   <div class="col-md-12">
                       <div class="card">
                           <div class="card-header">
                               <h4 class="card-title">Uploaded Images</h4>
                           </div>
                           <div class="card-content collapse show">
                               <div class="card-body card-dashboard">
                                   <table id="social-media-table" class="table table-striped table-bordered table-condensed table-responsive social-media table-info">
                                       <thead>
                                       <tr>
                                           <th class="text-center">Sl</th>
                                           <th class="text-center">Image</th>
                                           <th class="text-center">Action</th>
                                       </tr>
                                       </thead>
                                       <tbody>
                                       @if(!empty($images))
                                           @php($i = 1)
                                           @foreach($images as $media)
                                               <tr>
                                                   <td class="text-center">{{$i++}}</td>
                                                   <td class="text-center">
                                                       @if($media->image == null)
                                                       @else
                                                           <img src="{{ asset('/') }}{!! $media->image !!}" class="img-border img-thumbnail text-center" height="120" width="120">
                                                       @endif
                                                   </td>
                                                   <td class="text-center">
                                                       <a class="btn btn-danger btn-sm btn-round fa fa-trash DeleteWorkExp" data-id="{{$media->id}}" title="Delete Image"></a>
                                                       @if($media->status == 'A')
                                                           <a class="btn btn-warning btn-sm btn-round fa fa-times DeActivateWorkExp" data-id="{{$media->id}}" title="De-Activate Image"></a>
                                                       @elseif($media->status == 'I')
                                                           <a class="btn btn-cyan btn-sm btn-round fa fa-check ActivateWorkExp" data-id="{{$media->id}}" title="Activate Image"></a>
                                                       @else
                                                       @endif
                                                   </td>
                                               </tr>
                                           @endforeach
                                       @endif
                                       </tbody>
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
        var dataTable = $('.social-media').DataTable();

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
                '<td><input type="hidden" class="form-control Style" name="style_no['+rowID+']" readonly value="1">' +
                '<td><input type="file" class="form-control Image" accept="image/png, image/jpg, image/jpeg" name="image['+rowID+']" required="">' +
                '</td>'+
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
        function clearTableTbody(){
            $("#myTable > tbody").empty();
            sessionStorage.clear();
        }

        $('#social-media-table').on('click',".DeleteWorkExp", function(){
            var button = $(this);
            var id = button.attr("data-id");
            var url = '{{ route('receive.delete-image') }}';
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
            var url = '{{ route('receive.de-activate-image') }}';
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
            var url = '{{ route('receive.activate-image') }}';
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


