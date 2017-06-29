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
                    <tfoot>
                    <form class="form_booth" method="POST" enctype="multipart/form-data">
                        {{ csrf_field() }}
                        <input type="hidden" name="production_booth" value="booth" />
                        <tr>
                            <td><input class="form-control" type="text" name="booth_description" id="booth_description" placeholder="description" /></td>
                            <td><input class="form-control" type="file" name="booth_file" id="booth_file" /></td>
                            <td><input class="form-control" type="integer" name="booth_quantity" id="booth_quantity" placeholder="quantity" /></td>
                            <td><input class="form-control" type="text" name="booth_details" id="booth_details" placeholder="details" /></td>
                            <td>
                                <button type="button" onclick="saveBooth()" class="btn btn-primary btn-sm">
                                    <i class="glyphicon glyphicon-plus"></i>
                                </button>
                            </td>
                        </tr>
                    </form>
                    </tfoot>
                    <tbody>
                    @foreach( $productionDatas as $productionData)

                        @if( $productionData->type == 'booth' )
                            <tr>
                                <td>{{ $productionData->description }}</td>
                                <td>{{ $productionData->visuals }}</td>
                                <td>{{ $productionData->qty }}</td>
                                <td>{{ $productionData->details }}</td>

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
                                </td>
                            </tr>
                        @endif

                    @endforeach
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</div>