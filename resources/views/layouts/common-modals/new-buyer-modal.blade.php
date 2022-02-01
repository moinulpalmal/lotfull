{{--new department modal--}}
<div class="modal fade text-left" id="NewBuyer" tabindex="-1" role="dialog" aria-labelledby="myModalLabel16" aria-hidden="true">
    <div class="modal-dialog modal-xl" role="document">
        <div class="modal-content">
            <div class="modal-header bg-info white">
                <h4 class="modal-title" id="myModalLabel16">Add New Buyer</h4>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <form class="form" id="NewBuyerForm" method="post" action="#">
                <div class="modal-body">
                    @csrf
                    <input type="hidden" id="HiddenNewBuyerID" class="form-control" name="id" >
                    <div class="form-body">
                        <div class="row">
                            <div class="col-md-12">
                                <div class="form-group">
                                    <label for="BuyerName" class="text-bold-700">Buyer Name</label>
                                    <input type="text" id="BuyerName" maxlength="150" class="form-control" placeholder="Enter Buyer Name" name="name" required>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" onclick="clearFormWithoutDelay('NewBuyerForm');" class="btn btn-outline-danger" data-dismiss="modal"><i class="fa fa-times"></i> Close</button>
                    <div {{--class="form-actions right"--}}>
                        <button type="submit" id="submit_button_new_buyer" class="btn btn-outline-primary">
                            <i class="fa fa-check"></i> Save Buyer
                        </button>
                    </div>
                </div>
            </form>
        </div>
    </div>
</div>
{{-- end new department modal--}}

