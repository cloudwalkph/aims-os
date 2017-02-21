<div class="modal fade" id="createItemInventory" tabIndex="-1" role="dialog" aria-labelledby="myModalLabel">
    <div class="modal-dialog modal-lg" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                <h4 class="modal-title" id="myModalLabel">Add Items</h4>
            </div>
            <div class="modal-body">
                <form>
                    <div class="row">

                        <div class="col-md-12 form-group text-input-container">
                            <label class="control-label" for="item_name">Item Name</label>
                            <input type="text" name="item_name" placeholder="Item Name" class="form-control" />
                        </div>

                        <div class="col-md-12 form-group text-input-container">
                            <label class="control-label" for="expected_quantity">Expected Quantity</label>
                            <input type="text" name="expected_quantity" placeholder="Expected Quantity" class="form-control" />
                        </div>

                    </div>
                </form>

            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
                <button type="button" class="btn btn-primary">Add</button>
            </div>
        </div>
    </div>
</div>