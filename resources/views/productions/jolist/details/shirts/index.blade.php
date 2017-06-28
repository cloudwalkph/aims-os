<div class="tab-pane" id="shirts">
    <div class="form-horizontal">
        <div class="box box-info">
            <div class="box-header">
                @include('productions.common.supplier')
            </div>

            <button type="button" style="margin-bottom: 15px; margin-left: 32px;" class="btn btn-primary btn-create hidden"
                    data-toggle="modal" data-target="#addShirts">
                <i class="fa fa-plus"></i> ADD
            </button>
            <div class="box-body">
                <table class="table table-striped" border="1" id="tbl-shirts">
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
                        <input type="hidden" name="production_shirts" value="shirts" />
                        <tr>
                            <td><input class="form-control" type="text" name="shirts_description" id="shirts_description" placeholder="description" /></td>
                            <td><input class="form-control" type="file" name="shirts_file" id="shirts_file" /></td>
                            <td><input class="form-control" type="integer" name="shirts_quantity" id="shirts_quantity" placeholder="quantity" /></td>
                            <td><input class="form-control" type="text" name="shirts_details" id="shirts_details" placeholder="details" /></td>
                            <td>
                                <button type="button" onclick="saveShirts()" class="btn btn-primary btn-sm">
                                    <i class="glyphicon glyphicon-plus"></i>
                                </button>
                            </td>
                        </tr>
                    </form>
                    </tfoot>
                    <tbody>
                    @foreach( $productionDatas as $productionData)

                        @if( $productionData->type == 'shirts' )
                            <tr>
                                <td>{{ $productionData->description }}</td>
                                <td>{{ $productionData->visuals }}</td>
                                <td>{{ $productionData->qty }}</td>
                                <td>{{ $productionData->details }}</td>
                            </tr>
                        @endif

                    @endforeach
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</div>