<div class="tab-pane" id="photowall">
    <div class="form-horizontal">
        <div class="box box-info">
            <div class="box-header">
                @include('productions.common.supplier')
            </div>

            <button type="button" style="margin-bottom: 15px; margin-left: 32px;" class="btn btn-primary btn-create hidden"
                    data-toggle="modal" data-target="#addPhotowall">
                <i class="fa fa-plus"></i> ADD
            </button>
            <div class="box-body">
                <table class="table table-striped" border="1" id="tbl-photowall">
                    <thead>
                    <tr>
                        <th class="text-center">Description</th>
                        <th class="text-center">Visual Peg per File and Size</th>
                        <th class="text-center">Quantity</th>
                        <th class="text-center">Materials to be used and other details</th>
                    </tr>
                    </thead>
                    <tfoot>
                    <form class="form_photowall" method="POST" enctype="multipart/form-data">
                        {{ csrf_field() }}
                        <input type="hidden" name="production_photowall" value="photowall" />
                        <tr>
                            <td><input class="form-control" type="text" name="photowall_description" id="photowall_description" placeholder="description" /></td>
                            <td><input class="form-control" type="file" name="photowall_file" id="photowall_file" /></td>
                            <td><input class="form-control" type="integer" name="photowall_quantity" id="photowall_quantity" placeholder="quantity" /></td>
                            <td><input class="form-control" type="text" name="photowall_details" id="photowall_details" placeholder="details" /></td>
                            <td>
                                <button type="button" onclick="savePhotowall()" class="btn btn-primary btn-sm">
                                    <i class="glyphicon glyphicon-plus"></i>
                                </button>
                            </td>
                        </tr>
                    </form>
                    </tfoot>
                    <tbody>
                        {{--<tr>--}}
                            {{--<td colspan="4">no details</td>--}}
                        {{--</tr>--}}

                        <td>
                            <div class="row">
                                <div class="col-xs-4">
                                    <button class="glyphicon glyphicon-floppy-disk" aria-hidden="true"></button>
                                </div>
                                <div class="col-xs-4">
                                    <button class="glyphicon glyphicon-edit" aria-hidden="true"></button>
                                </div>
                                <div class="col-xs-4">
                                    <button class="glyphicon glyphicon-trash" aria-hidden="true"></button>
                                </div>
                            </div>

                    </tbody>
                </table>
            </div>
        </div>
    </div>
</div>