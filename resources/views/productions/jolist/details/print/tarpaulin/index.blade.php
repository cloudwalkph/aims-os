<div class="active tab-pane" id="tarpaulin">
    <div class="form-horizontal">
        <div class="box box-info">
            <div class="box-header">
                @include('productions.common.supplier')
            </div>
            <div class="box-body">
                <table id="tbl-tarpaulin" class="table text-center table-striped" border="1">
                    <thead>
                        <tr>
                            <th class="text-center">Description</th>
                            <th class="text-center">Visual Peg per File</th>
                            <th class="text-center">Size</th>
                            <th class="text-center">Quantity</th>
                            <th class="text-center">Other Details</th>
                        </tr>
                    </thead>
                    <tfoot>
                    <form class="form_tarpaulin" method="POST" enctype="multipart/form-data">
                        {{ csrf_field() }}
                        <input type="hidden" name="production_type" value="tarpaulin" />
                        <tr>
                            {{--<td><input class="form-control" type="text" name="tarp_description" id="tarp_description" placeholder="description"></td>--}}
                            <td>
                                <select class="form-control" name="tarp_description" id="tarp_description">
                                    <option value="">Select...</option>
                                    <option value="tarpaulin">Tarpaulin Tent Headers</option>
                                    <option value="barricade">Barricade and Streamers</option>
                                    <option value="boards">A Boards</option>
                                </select>
                            </td>
                            <td><input class="form-control" type="file" name="tarp_file" id="tarp_file" /></td>
                            <td><input class="form-control" type="text" name="tarp_size" id="tarp_size" placeholder="size" /></td>
                            <td><input class="form-control" type="integer" name="tarp_quantity" id="tarp_quantity" placeholder="quantity" /></td>
                            <td><input class="form-control" type="text" name="tarp_details" id="tarp_details" placeholder="details" /></td>
                            <td>
                                <button type="button" onclick="saveTarpaulin()" class="btn btn-primary btn-sm">
                                    <i class="glyphicon glyphicon-plus"></i>
                                </button>
                            </td>
                        </tr>
                    </form>
                    </tfoot>
                    <tbody id="tbody_tarpaulin">

                    @foreach( $productionDatas as $productionData)

                        @if( $productionData->type == 'tarpaulin' )
                            <tr>
                                <td>{{ $productionData->description }}</td>
                                <td>{{ $productionData->visuals }}</td>
                                <td>{{ $productionData->sizes }}</td>
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