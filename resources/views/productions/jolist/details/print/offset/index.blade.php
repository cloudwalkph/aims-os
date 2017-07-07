

<div class="tab-pane" id="offset">

    <div class="form-horizontal">
        <div class="box box-info">
            <div class="box-header">
                <div class="col-md-10 printpg">
                    <table style="margin: 10px;">
                        <tr>
                            <td><h4 class="box-title">Supplier </h4></td>
                            <td><input class="form-control costing-input" type="text" name="offset_supplier" id="offset_supplier"></td>
                        </tr>
                        <tr>
                            <td><h4 class="box-title">Point Person &nbsp&nbsp&nbsp</h4></td>
                            <td><input class="form-control costing-input" type="text" name="offset_person" id="offset_person"></td>
                        </tr>
                        <tr>
                            <td><h4 class="box-title">Contact No. </h4></td>
                            <td><input class="form-control costing-input" type="text" name="offset_contact" id="offset_contact"></td>
                        </tr>
                        <tr>
                            <td> </td>
                            <td class="text-center">
                                <button type="button" class="btn btn-success" data-toggle="modal" data-target=".supplier-modal-offset">View Suppliers</button>
                                <button type="button" class="btn btn-primary" onclick="saveCosting( 'offset', '{{ $jo->job_order_no }}' );">Save</button>
                            </td>
                        </tr>
                    </table>
                </div>

                <!-- Modal -->
                <div class="modal fade supplier-modal-offset" id="supplier-modal-offset" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
                    <div class="modal-dialog" role="document">
                        <div class="modal-content">
                            <div class="modal-header">
                                <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                                <h4 class="modal-title" id="myModalLabel">Suppliers for offset and/or Digital</h4>
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
                                    <tbody id="tbody_offset_supplier">

                                    @foreach( $suppliers as $supplier)

                                        @if( $supplier->production_type == 'offset' )

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
                    <a href="/productions/jo/costing/{{ $jo->job_order_no }}/offset" class="btn btn-primary btn-lg btn-costing">Costing</a>
                </div>
            </div>

            <div class="box-body">

                <div class="row hidden">
                    <div class="col-md-offset-10 col-md-2">
                        <button type="button" style="margin-bottom: 15px; margin-left: 32px;" class="btn btn-primary btn-create"
                                data-toggle="modal" data-target="#addPrint">
                            <i class="fa fa-plus"></i> ADD
                        </button>
                    </div>
                </div>


                <div class="row">
                    <div class="col-md-offset-10 col-md-2">
                        <ul class="list-inline">
                            <li>
                                <label for="chk-offset">
                                    <input id="chk-offset" type="checkbox"> Offset
                                </label>
                            </li>
                            <li>
                                <label for="chk-digital">
                                    <input id="chk-digital" type="checkbox"> Digital
                                </label>
                            </li>
                        </ul>
                    </div>
                </div>
                <div class="row">
                    <table class="table table-striped text-center" border="1" id="tbl-offset">
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
                            <form class="form_offset" method="POST" enctype="multipart/form-data">
                                {{ csrf_field() }}
                                <input type="hidden" name="production_offset" value="offset" />
                                <tr>
                                    <td><input class="form-control" type="text" name="offset_description" id="offset_description" placeholder="description" /></td>
                                    <td><input class="form-control" type="file" name="offset_file" id="offset_file" /></td>
                                    <td><input class="form-control" type="text" name="offset_size" id="offset_size" placeholder="size" /></td>
                                    <td><input class="form-control" type="integer" name="offset_quantity" id="offset_quantity" placeholder="quantity" /></td>
                                    <td><input class="form-control" type="text" name="offset_details" id="offset_details" placeholder="details" /></td>
                                    <td>
                                        <button type="button" onclick="saveOffset()" class="btn btn-primary btn-sm">
                                            <i class="glyphicon glyphicon-plus"></i>
                                        </button>
                                    </td>
                                </tr>
                            </form>
                        </tfoot>
                        <tbody id="tbody_offset">
                        @foreach( $productionDatas as $productionData)

                            @if( $productionData->type == 'offset' )
                                <tr id="offsetRow{{ $productionData->id }}">
                                    <td>
                                        <span class="spanoffset{{ $productionData->id }} offsetDescription{{ $productionData->id }}">{{ $productionData->description }}</span>
                                        <input class="form-control hidden-not-important offsetInputs{{ $productionData->id }}" type="text" name="offset_description_edit{{ $productionData->id }}" id="offset_description_edit{{ $productionData->id }}" placeholder="description"  value="{!! $productionData->description  !!} "/>
                                    </td>
                                    <td>
                                        <a href="{{ storage_path('productions/'.$productionData->visuals) }}" class="spanoffset{{ $productionData->id }} offsetVisuals{{ $productionData->id }}" target="_blank">{{ $productionData->visuals }}</a>
                                        <input class="form-control file_upload offsetInputs{{ $productionData->id }}" style="display: none;" type="file" name="offset_file_edit{{ $productionData->id }}" id="offset_file_edit{{ $productionData->id }}" value="{{ storage_path('productions/'.$productionData->visuals) }}"/>
                                    </td>
                                    <td>
                                        <span class="spanoffset{{ $productionData->id }} offsetSizes{{ $productionData->id }}">{{ $productionData->sizes }}</span>
                                        <input class="form-control hidden-not-important offsetInputs{{ $productionData->id }}" type="text" name="offset_size_edit{{ $productionData->id }}" id="offset_size_edit{{ $productionData->id }}" placeholder="size" value="{{ $productionData->sizes }}"/>
                                    </td>
                                    <td>
                                        <span class="spanoffset{{ $productionData->id }} offsetQty{{ $productionData->id }}">{{ $productionData->qty }}</span>
                                        <input class="form-control hidden-not-important offsetInputs{{ $productionData->id }}" type="integer" name="offset_quantity_edit{{ $productionData->id }}" id="offset_quantity_edit{{ $productionData->id }}" placeholder="quantity" value="{{ $productionData->qty }}"/>
                                    </td>
                                    <td>
                                        <span class="spanoffset{{ $productionData->id }} offsetDetails{{ $productionData->id }}">{!! $productionData->details !!}</span>
                                        <input class="form-control hidden-not-important offsetInputs{{ $productionData->id }}" type="text" name="offset_details_edit{{ $productionData->id }}" id="offset_details_edit{{ $productionData->id }}" placeholder="details" value="{{ $productionData->details }}"/>
                                    </td>
                                    <td>
                                        <div id="col1">
                                            <button class="btn btn-warning glyphicon glyphicon-floppy-disk hidden-not-important offsetUpdate{{ $productionData->id }}" onclick="updateProduction( 'offset', {{ $productionData->id }} )" aria-hidden="true"></button>
                                            <button class="btn glyphicon glyphicon-edit offsetEdit{{ $productionData->id }}" aria-hidden="true" onclick="editProduction( 'offset', {{ $productionData->id }} )"></button>
                                        </div>
                                        <div id="col2">
                                            <button class="btn btn-danger glyphicon glyphicon-trash offsetTrash{{ $productionData->id }}" onclick="trashProduction( 'offset', {{ $productionData->id }} )" aria-hidden="true"></button>
                                            <button class="btn btn-danger hidden-not-important offsetDelete{{ $productionData->id }}" onclick="deleteProduction('offset', {{ $productionData->id }})" aria-hidden="true">Delete</button>
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
</div>