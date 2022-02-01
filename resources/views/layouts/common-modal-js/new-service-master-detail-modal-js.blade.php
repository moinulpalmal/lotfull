<script>
    $(document).ready(function () {

        var dataTable = $('.PSHTable').DataTable({

        });

        var dataTable = $('.CSHTable').DataTable({

        });

        var dataTable = $('.AITable').DataTable({

        });

        resetSelect2();
         CKEDITOR.replace( 'assignment_description',{
                uiColor: '#CCEAEE'
            });

        CKEDITOR.replace( 'clearance_description',{
            uiColor: '#CCEAEE'
        });

        CKEDITOR.replace( 'solution_description',{
            uiColor: '#CCEAEE'
        });

        CKEDITOR.replace( 'requisition_email_description',{
            uiColor: '#CCEAEE'
        });

        CKEDITOR.replace( 'service_email_description',{
            uiColor: '#CCEAEE'
        });

        CKEDITOR.replace( 'ReasonOfPurchase',{
            uiColor: '#CCEAEE'
        });

        CKEDITOR.replace( 'ServiceComment',{
            uiColor: '#CCEAEE'
        });
    });

    function resetSelect2() {
        $(".select2").select2({
            dropdownAutoWidth: true,
            width: '100%'
        });
    }

    $(function(){
        $.ajaxSetup({
            headers: { 'X-CSRF-TOKEN' : '{{ csrf_token() }}' }
        });
        $('#NewAssignServicePersonForm').submit(function(e){
            e.preventDefault();
            for ( instance in CKEDITOR.instances ) {
                CKEDITOR.instances[instance].updateElement();
            }
            var data = $(this).serialize();
            var id = $('#HiddenAssignmentMasterId').val();
            var url = '{{ route('services.master.assign') }}';
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
                        swalUpdateSuccessfulWithRefresh();
                    }
                    else if(data === '1')
                    {
                        //resetCkeditor('AssignmentDescription');
                       // resetCkeditor('ClosingDescription');
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

    $(function(){
        $.ajaxSetup({
            headers: { 'X-CSRF-TOKEN' : '{{ csrf_token() }}' }
        });
        $('#AddRequisitionInfoForm').submit(function(e){
            e.preventDefault();
            for ( instance in CKEDITOR.instances ) {
                CKEDITOR.instances[instance].updateElement();
            }
            var data = $(this).serialize();
           // var id = $('#HiddenFactoryID').val();
            var url = '{{ route('services.master.requisition.save') }}';
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

    $(function(){
        $.ajaxSetup({
            headers: { 'X-CSRF-TOKEN' : '{{ csrf_token() }}' }
        });
        $('#ServiceCompleteForm').submit(function(e){
            e.preventDefault();
            for ( instance in CKEDITOR.instances ) {
                CKEDITOR.instances[instance].updateElement();
            }
            var data = $(this).serialize();
            // var id = $('#HiddenFactoryID').val();
            var url = '{{ route('services.master.solution.save') }}';
            //console.log(data);
            $.ajax({
                url: url,
                method:'POST',
                data:data,
                success:function(data){
                    // console.log(data);
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

    $(function(){
        $.ajaxSetup({
            headers: { 'X-CSRF-TOKEN' : '{{ csrf_token() }}' }
        });
        $('#ServiceCompleteMailForm').submit(function(e){
            e.preventDefault();
            for ( instance in CKEDITOR.instances ) {
                CKEDITOR.instances[instance].updateElement();
            }
            var data = $(this).serialize();
            // var id = $('#HiddenFactoryID').val();
            var url = '{{ route('services.master.solution.send') }}';
            //console.log(data);
            $.ajax({
                url: url,
                method:'POST',
                data:data,
                success:function(data){
                   // console.log(data);
                   // return;
                    if(data === '1')
                    {
                        swal({
                            title: "Successful!",
                            text: "Service Complete Mail Send Successful!",
                            icon: "success",
                            button: "Ok!",
                            className: "myClass",
                        }).then(function (value) {
                            if(value){
                                refresh();
                            }
                        });

                    }
                    else {
                        swal({
                            title: "Un-Successful!",
                            text: "Service Complete Mail Send Un-Successful!",
                            icon: "error",
                            button: "Ok!",
                            className: "myClass",
                        });
                    }
                },
                error:function(error){
                    swalError(error);
                }
            })

        })
    });

    $(function(){
        $.ajaxSetup({
            headers: { 'X-CSRF-TOKEN' : '{{ csrf_token() }}' }
        });
        $('#NeRequisitionRequestEmailForm').submit(function(e){
            e.preventDefault();
            for ( instance in CKEDITOR.instances ) {
                CKEDITOR.instances[instance].updateElement();
            }
            var data = $(this).serialize();
            var id = $('#HiddenFactoryID').val();
            var url = '{{ route('services.master.requisition-request.send') }}';
            //console.log(data);
            $.ajax({
                url: url,
                method:'POST',
                data:data,
                success:function(data){
                     //console.log(data);
                     //return;
                    if(data === '1')
                    {
                        swal({
                            title: "Successful!",
                            text: "Requisition Request Send Successful!",
                            icon: "success",
                            button: "Ok!",
                            className: "myClass",
                        }).then(function (value) {
                            if(value){
                                refresh();
                            }
                        });

                    }
                    else
                    {
                        swal({
                            title: "Un-Successful!",
                            text: "Requisition Request Send Un-Successful!",
                            icon: "error",
                            button: "Ok!",
                            className: "myClass",
                        });
                    }
                },
                error:function(error){
                    swalError(error);
                }
            })

        })
    });

    $(function(){
        $.ajaxSetup({
            headers: { 'X-CSRF-TOKEN' : '{{ csrf_token() }}' }
        });
        $('#CheckWarrantyForm').submit(function(e){
            e.preventDefault();
            var data = $(this).serialize();
            var url = '{{ route('settings.product.detail.get-warrant-detail') }}';
            //console.log(data);
            $.ajax({
                url: url,
                method:'POST',
                data:data,
                success:function(data){
                   // console.log(data);
                   // return;
                    if(data.has_data === true){
                        if(data.has_product_missed === true){
                            swal({
                                title: "Product Found!",
                                text: "Received product not matched with database!",
                                icon: "error",
                                button: "Ok!",
                                className: "myClass",
                            });
                        }
                        else{
                            if(data.has_warranty === true){
                                swal({
                                    title: "Product Information Found!",
                                    text: "The product has warranty; you can generate warranty request now!",
                                    icon: "success",
                                    button: "Ok!",
                                }).then(function (value) {
                                    if(value){
                                        refresh();
                                    }
                                });
                            }
                            else{
                                swal({
                                    title: "Product Information Found!",
                                    text: "The product has no warranty; you cannot generate warranty request now!",
                                    icon: "success",
                                    button: "Ok!",
                                }).then(function (value) {
                                    if(value){
                                        refresh();
                                    }
                                });
                            }
                        }

                    }
                    else{
                        swal({
                            title: "No Product Found!",
                            text: "Please Contact With Purchase Desk For Manual Check!",
                            icon: "error",
                            button: "Ok!",
                            className: "myClass",
                        });
                    }
                },
                error:function(error){
                    swalError(error);
                }
            })

        })
    });

    $('#ServiceMasterTable').on('click',".MakeUnderProcess", function(){
        var button = $(this);
        var id = button.attr("data-id");
        var url = '{{ route('services.master.make-under-process') }}';
        swal({
            title: 'Are you sure?',
            text: 'This service record will be moved to under-process state permanently!',
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
                            swalUpdateSuccessfulWithRefresh();
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

    $('#ServiceMasterTable').on('click',".SendForWarranty", function(){
        var button = $(this);
        var id = button.attr("data-id");
        var url = '{{ route('services.master.generate-warranty-request') }}';
        swal({
            title: 'Are you sure?',
            text: 'This service record will be moved to warranty request section!',
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
                            swalUpdateSuccessfulWithRefresh();
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

    $('#ServiceMasterTable').on('click',".ProceedWithoutWarranty", function(){
        var button = $(this);
        var id = button.attr("data-id");
        var url = '{{ route('services.master.proceed-without-warranty') }}';
        swal({
            title: 'Are you sure?',
            text: 'This service record can be proceeded without warranty check!',
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
                            swalUpdateSuccessfulWithRefresh();
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


    $('#ServiceMasterTable').on('click',".DeliveryComplete", function(){
        var button = $(this);
        var id = button.attr("data-id");
        var url = '{{ route('services.master.make-delivery') }}';
        swal({
            title: 'Are you sure?',
            text: 'This service record will be moved to delivery complete state permanently!',
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
                            swalUpdateSuccessfulWithRefresh();
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

    $('#UpdateMenus').on('click',".DeleteService", function(){
        var button = $(this);
        var id = button.attr("data-id");
        var url = '{{ route('services.master.delete') }}';
        swal({
            title: 'Are you sure?',
            text: 'This service record will be removed permanently!',
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
                            swalUpdateSuccessfulWithRefresh();
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

    function clearServiceMasterForm() {
        clearForm('NewAssignServicePersonForm');
        resetCkeditor('AssignmentDescription');
        resetCkeditor('ClosingDescription');
        resetSelect2();
    }

</script>

