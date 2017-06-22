<div class="tab-pane" id="booth">
    <div class="form-horizontal">
        <div class="box box-info">
            <div class="box-header">
                @include('productions.common.supplier')
            </div>
            <button type="button" style="margin-bottom: 15px; margin-left: 32px;" class="btn btn-primary btn-create hidden"
                    data-toggle="modal" data-target="#addBooth">
                <i class="fa fa-plus"></i> ADD
            </button>
            <div class="box-body">
                <table class="table table-striped" border="1" id="tbl-booth">
                    <thead>
                        <tr>
                            <th class="text-center">Description</th>
                            <th class="text-center">Visual Peg per File and Size</th>
                            <th class="text-center">Quantity</th>
                            <th class="text-center">Materials to be used and other details</th>
                        </tr>
                    </thead>
                    <tbody>
                        <tr>
                            <td colspan="4">no details</td>
                        </tr>
                    </tbody>
                </table>
            </div>
        </div>
    </div>

    <div class="row">
        <div class="modal fade" id="addBooth" tabIndex="-1" role="dialog" aria-labelledby="myModalLabel">
            <div class="modal-dialog modal-lg" role="document">
                <div class="modal-content">
                    <div class="modal-header">
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                        <h4 class="modal-title" id="myModalLabel">Print Form</h4>
                    </div>
                    <div class="modal-body">
                        <form id="printForm">
                            <div class="row">
                                <div class="col-md-6 form-group text-input-container">
                                    <label class="control-label">Description</label>
                                    <input type="text" name="description"
                                    @input="inputChange" v-bind:value="description" id="description"
                                    placeholder="Enter Description" class="form-control" />
                                </div>
                                <div class="col-md-6 form-group text-input-container">
                                    <label class="control-label">Visual Peg per File</label>
                                    <input type="text" name="visual_peg_per_file"
                                    @input="inputChange" v-bind:value="visual_peg_per_file" id="visual_peg_per_file"
                                    placeholder="Enter Visual Peg per File" class="form-control" />
                                </div>
                                <div class="col-md-6 form-group text-input-container">
                                    <label class="control-label">Quantity</label>
                                    <input type="text" name="quantity"
                                    @input="inputChange" v-bind:value="quantity" id="quantity"
                                    placeholder="Enter quantity" class="form-control" />
                                </div>

                                <div class="col-md-6 form-group text-input-container">
                                    <label class="control-label">Material to be used and other details</label>
                                    <input type="text" name="quantity"
                                    @input="inputChange" v-bind:value="quantity" id="quantity"
                                    placeholder="Enter quantity" class="form-control" />
                                </div>

                            </div>
                        </form>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
                        <button type="button" class="btn btn-primary" @click="saveForm">Save</button>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>