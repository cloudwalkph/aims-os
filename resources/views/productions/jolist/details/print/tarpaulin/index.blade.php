<div class="active tab-pane" id="tarpaulin">
    <div class="form-horizontal">
        <div class="box box-info">
            <div class="box-header row">
                {{--@include('productions.common.supplier')--}}
                <div class="col-md-10 printpg">
                    <table style="margin: 10px;">
                        <tr>
                            <td><h4 class="box-title">Supplier </h4></td>
                            <td><input class="form-control costing-input" type="text" name="tarpaulin_supplier" id="tarpaulin_supplier"></td>
                        </tr>
                        <tr>
                            <td><h4 class="box-title">Point Person &nbsp&nbsp&nbsp</h4></td>
                            <td><input class="form-control costing-input" type="text" name="tarpaulin_person" id="tarpaulin_person"></td>
                        </tr>
                        <tr>
                            <td><h4 class="box-title">Contact No. </h4></td>
                            <td><input class="form-control costing-input" type="text" name="tarpaulin_contact" id="tarpaulin_contact"></td>
                        </tr>
                        <tr>
                            <td> </td>
                            <td class="text-center">
                                <button type="button" class="btn btn-success" data-toggle="modal" data-target=".supplier-modal">View Suppliers</button>
                                <button type="button" class="btn btn-primary" onclick="saveCosting( 'tarpaulin', '{{ $jo->job_order_no }}' );">Save</button>
                            </td>
                        </tr>
                    </table>
                </div>

                    <!-- Modal -->
                    <div class="modal fade supplier-modal" id="supplier-modal" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
                        <div class="modal-dialog" role="document">
                            <div class="modal-content">
                                <div class="modal-header">
                                    <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                                    <h4 class="modal-title" id="myModalLabel">Suppliers for tarpaulin</h4>
                                </div>
                                <div class="modal-body">
                                    <table class="table">
                                        <thead>
                                        <tr>
                                            <th>Supplier</th>
                                            <th>Point Person</th>
                                            <th>Contact No.</th>
                                            <th> </th>
                                        </tr>
                                        </thead>
                                        <tbody id="tbody_tarpaulin_supplier">

                                        @foreach( $suppliers as $supplier)

                                            @if( $supplier->production_type == 'tarpaulin' )

                                                <tr id="{{$supplier->production_type}}RowCosting{{$supplier->id}}">
                                                    <td>{{$supplier->company_name}}</td>
                                                    <td>{{$supplier->point_person}}</td>
                                                    <td>{{$supplier->contact}}</td>
                                                    <td>
                                                        <div id="col2">
                                                            <button class="btn btn-danger glyphicon glyphicon-trash {{$supplier->production_type}}TrashCosting{{$supplier->id}}" onclick="trashCosting('{{$supplier->production_type}}','{{$supplier->id}}')" aria-hidden="true"></button>
                                                            <button class="btn btn-danger hidden-not-important {{$supplier->production_type}}DeleteCosting{{$supplier->id}}" onclick="deleteCosting('{{$supplier->production_type}}', '{{$supplier->id}}')" aria-hidden="true">Delete</button>
                                                        </div>
                                                    </td>
                                                </tr>

                                            @endif

                                        @endforeach
                                        </tbody>
                                    </table>
                                </div>
                                <div class="modal-footer">
                                    <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
                                </div>
                            </div>
                        </div>
                    </div>

                <div class="col-md-1">
                    <a href="/productions/jo/costing/{{ $jo->job_order_no }}/tarpaulin" class="btn btn-primary btn-lg btn-costing">Costing</a>
                </div>

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
                                    <span class="spantarpaulin{{ $productionData->id }} tarpaulinDescription{{ $productionData->id }}">{{ $productionData->description }}</span>
                                    <select class="form-control hidden-not-important tarpaulinInputs{{ $productionData->id }}" name="tarpaulin_description_edit{{ $productionData->id }}" id="tarpaulin_description_edit{{ $productionData->id }}">
                                        <option value="0">Select...</option>
                                        <option value="tarpaulin">Tarpaulin Tent Headers</option>
                                        <option value="barricade">Barricade and Streamers</option>
                                        <option value="boards">A Boards</option>
                                    </select>
                                </td>
                                <td>
                                    <a href="{{ storage_path('productions/'.$productionData->visuals) }}" class="spantarpaulin{{ $productionData->id }} tarpaulinVisuals{{ $productionData->id }}" target="_blank">{{ $productionData->visuals }}</a>
                                    <input class="form-control file_upload tarpaulinInputs{{ $productionData->id }}" style="display: none;" type="file" name="tarpaulin_file_edit{{ $productionData->id }}" id="tarpaulin_file_edit{{ $productionData->id }}" value="{{ storage_path('productions/'.$productionData->visuals) }}"/>
                                </td>
                                <td>
                                    <span class="spantarpaulin{{ $productionData->id }} tarpaulinSizes{{ $productionData->id }}">{{ $productionData->sizes }}</span>
                                    <input class="form-control hidden-not-important tarpaulinInputs{{ $productionData->id }}" type="text" name="tarpaulin_size_edit{{ $productionData->id }}" id="tarp_size_edit{{ $productionData->id }}" placeholder="size" value="{{ $productionData->sizes }}"/>
                                </td>
                                <td>
                                    <span class="spantarpaulin{{ $productionData->id }} tarpaulinQty{{ $productionData->id }}">{{ $productionData->qty }}</span>
                                    <input class="form-control hidden-not-important tarpaulinInputs{{ $productionData->id }}" type="integer" name="tarpaulin_quantity_edit{{ $productionData->id }}" id="tarp_quantity_edit{{ $productionData->id }}" placeholder="quantity" value="{{ $productionData->qty }}"/>
                                </td>
                                <td>
                                    <span class="spantarpaulin{{ $productionData->id }} tarpaulinDetails{{ $productionData->id }}">{!! $productionData->details !!}</span>
                                    <input class="form-control hidden-not-important tarpaulinInputs{{ $productionData->id }}" type="text" name="tarpaulin_details_edit{{ $productionData->id }}" id="tarp_details_edit{{ $productionData->id }}" placeholder="details" value="{{ $productionData->details }}"/>
                                </td>
                                <td>
                                    <div id="col1">
                                        <button class="btn btn-warning glyphicon glyphicon-floppy-disk hidden-not-important tarpaulinUpdate{{ $productionData->id }}" onclick="updateProduction( 'tarpaulin', {{ $productionData->id }} );" aria-hidden="true"></button>
                                        <button class="btn glyphicon glyphicon-edit tarpaulinEdit{{ $productionData->id }}" aria-hidden="true" onclick="editProduction( 'tarpaulin', {{ $productionData->id }} );"></button>
                                    </div>
                                    <div id="col2">
                                        <button class="btn btn-danger glyphicon glyphicon-trash tarpaulinTrash{{ $productionData->id }}" onclick="trashProduction( 'tarpaulin', {{ $productionData->id }} );" aria-hidden="true"></button>
                                        <button class="btn btn-danger hidden-not-important tarpaulinDelete{{ $productionData->id }}" onclick="deleteProduction('tarpaulin', {{ $productionData->id }})" aria-hidden="true">Delete</button>
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