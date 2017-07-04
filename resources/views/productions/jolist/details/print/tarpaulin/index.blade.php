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
                            <th class="text-center" width="150"> </th>
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
                            <tr id="tarpaulinRow{{ $productionData->id }}">
                                <td>
                                    <span class="spanTarpaulin{{ $productionData->id }} tarpaulinDescription{{ $productionData->id }}">{{ $productionData->description }}</span>
                                    <select class="form-control hidden-not-important tarpaulinInputs{{ $productionData->id }}" name="tarpaulin_description_edit{{ $productionData->id }}" id="tarpaulin_description_edit{{ $productionData->id }}" value="{{ $productionData->description }}">
                                        <option value="">Select...</option>
                                        <option value="tarpaulin">Tarpaulin Tent Headers</option>
                                        <option value="barricade">Barricade and Streamers</option>
                                        <option value="boards">A Boards</option>
                                    </select>
                                </td>
                                <td>
                                    <a href="{{ storage_path('productions/'.$productionData->visuals) }}" class="spanTarpaulin{{ $productionData->id }} tarpaulinVisuals{{ $productionData->id }}" target="_blank">{{ $productionData->visuals }}</a>
                                    <input class="form-control file_upload tarpaulinInputs{{ $productionData->id }}" style="display: none;" type="file" name="tarpaulin_file_edit{{ $productionData->id }}" id="tarpaulin_file_edit{{ $productionData->id }}" value="{{ storage_path('productions/'.$productionData->visuals) }}"/>
                                </td>
                                <td>
                                    <span class="spanTarpaulin{{ $productionData->id }} tarpaulinSizes{{ $productionData->id }}">{{ $productionData->sizes }}</span>
                                    <input class="form-control hidden-not-important tarpaulinInputs{{ $productionData->id }}" type="text" name="tarpaulin_size_edit{{ $productionData->id }}" id="tarp_size_edit{{ $productionData->id }}" placeholder="size" value="{{ $productionData->sizes }}"/>
                                </td>
                                <td>
                                    <span class="spanTarpaulin{{ $productionData->id }} tarpaulinQty{{ $productionData->id }}">{{ $productionData->qty }}</span>
                                    <input class="form-control hidden-not-important tarpaulinInputs{{ $productionData->id }}" type="integer" name="tarpaulin_quantity_edit{{ $productionData->id }}" id="tarp_quantity_edit{{ $productionData->id }}" placeholder="quantity" value="{{ $productionData->qty }}"/>
                                </td>
                                <td>
                                    <span class="spanTarpaulin{{ $productionData->id }} tarpaulinDetails{{ $productionData->id }}">{!! $productionData->details !!}</span>
                                    <input class="form-control hidden-not-important tarpaulinInputs{{ $productionData->id }}" type="text" name="tarpaulin_details_edit{{ $productionData->id }}" id="tarp_details_edit{{ $productionData->id }}" placeholder="details" value="{{ $productionData->details }}"/>
                                </td>
                                <td>
                                    <div id="col1">
                                        <button class="btn btn-warning glyphicon glyphicon-floppy-disk hidden-not-important tarpaulinUpdate{{ $productionData->id }}" onclick="updateProduction( 'tarpaulin', {{ $productionData->id }} )" aria-hidden="true"></button>
                                        <button class="btn glyphicon glyphicon-edit tarpaulinEdit{{ $productionData->id }}" aria-hidden="true" onclick="editProduction( 'tarpaulin', {{ $productionData->id }} )"></button>
                                    </div>
                                    <div id="col2">
                                        <button class="btn btn-danger glyphicon glyphicon-trash tarpaulinTrash{{ $productionData->id }}" onclick="trashProduction( 'tarpaulin', {{ $productionData->id }} )" aria-hidden="true"></button>
                                        <button class="btn btn-danger hidden-not-important tarpaulinDelete{{ $productionData->id }}" aria-hidden="true">Delete</button>
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