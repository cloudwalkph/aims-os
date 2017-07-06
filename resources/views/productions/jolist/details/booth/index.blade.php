<div class="tab-pane" id="booth">
    <div class="form-horizontal">
        <div class="box box-info">
            <div class="box-header">
                <div class="col-md-10 printpg">
                    <table style="margin: 10px;">
                        <tr>
                            <td><h4 class="box-title">Supplier </h4></td>
                            <td><input class="form-control costing-input" type="text" name="booth_supplier" id="booth_supplier"></td>
                        </tr>
                        <tr>
                            <td><h4 class="box-title">Point Person &nbsp&nbsp&nbsp</h4></td>
                            <td><input class="form-control costing-input" type="text" name="booth_person" id="booth_person"></td>
                        </tr>
                        <tr>
                            <td><h4 class="box-title">Contact No. </h4></td>
                            <td><input class="form-control costing-input" type="text" name="booth_contact" id="booth_contact"></td>
                        </tr>
                        <tr>
                            <td> </td>
                            <td class="text-center">
                                <button type="button" class="btn btn-success" data-toggle="modal" data-target=".supplier-modal-booth">View Suppliers</button>
                                <button type="button" class="btn btn-primary" onclick="saveCosting( 'booth', '{{ $jo->job_order_no }}' );">Save</button>
                            </td>
                        </tr>
                    </table>
                </div>

                <!-- Modal -->
                <div class="modal fade supplier-modal-booth" id="supplier-modal-booth" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
                    <div class="modal-dialog" role="document">
                        <div class="modal-content">
                            <div class="modal-header">
                                <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                                <h4 class="modal-title" id="myModalLabel">Suppliers for booth</h4>
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
                                    <tbody id="tbody_booth_supplier">

                                    @foreach( $suppliers as $supplier)

                                        @if( $supplier->production_type == 'booth' )

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
                    <a href="/productions/jo/costing/{{ $jo->job_order_no }}/booth" class="btn btn-primary btn-lg btn-costing">Costing</a>
                </div>
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
                            <th class="text-center" width="150"> </th>
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
                    <tbody id="tbody_booth">
                    @foreach( $productionDatas as $productionData)

                        @if( $productionData->type == 'booth' )
                            <tr id="boothRow{{ $productionData->id }}">
                                <td>
                                    <span class="spanbooth{{ $productionData->id }} boothDescription{{ $productionData->id }}">{{ $productionData->description }}</span>
                                    <input class="form-control hidden-not-important boothInputs{{ $productionData->id }}" type="text" name="booth_description_edit{{ $productionData->id }}" id="booth_description_edit{{ $productionData->id }}" placeholder="description" value="{!! $productionData->description  !!}" />
                                </td>
                                <td>
                                    <a href="{{ storage_path('productions/'.$productionData->visuals) }}" class="spanbooth{{ $productionData->id }} boothVisuals{{ $productionData->id }}" target="_blank">{{ $productionData->visuals }}</a>
                                    <input class="form-control file_upload boothInputs{{ $productionData->id }}" style="display: none;" type="file" name="booth_file_edit{{ $productionData->id }}" id="booth_file_edit{{ $productionData->id }}" value="{{ storage_path('productions/'.$productionData->visuals) }}"/>
                                </td>
                                {{--<td>--}}
                                    {{--<span class="spanBooth{{ $productionData->id }} boothSizes{{ $productionData->id }}">{{ $productionData->sizes }}</span>--}}
                                    {{--<input class="form-control hidden-not-important boothInputs{{ $productionData->id }}" type="text" name="booth_size_edit{{ $productionData->id }}" id="booth_size_edit{{ $productionData->id }}" placeholder="size" value="{{ $productionData->sizes }}"/>--}}
                                {{--</td>--}}
                                <td>
                                    <span class="spanbooth{{ $productionData->id }} boothQty{{ $productionData->id }}">{{ $productionData->qty }}</span>
                                    <input class="form-control hidden-not-important boothInputs{{ $productionData->id }}" type="integer" name="booth_quantity_edit{{ $productionData->id }}" id="booth_quantity_edit{{ $productionData->id }}" placeholder="quantity" value="{{ $productionData->qty }}"/>
                                </td>
                                <td>
                                    <span class="spanbooth{{ $productionData->id }} boothDetails{{ $productionData->id }}">{!! $productionData->details !!}</span>
                                    <input class="form-control hidden-not-important boothInputs{{ $productionData->id }}" type="text" name="booth_details_edit{{ $productionData->id }}" id="booth_details_edit{{ $productionData->id }}" placeholder="details" value="{{ $productionData->details }}"/>
                                </td>
                                <td>
                                    <div id="col1">
                                        <button class="btn btn-warning glyphicon glyphicon-floppy-disk hidden-not-important boothUpdate{{ $productionData->id }}" onclick="updateProduction( 'booth', {{ $productionData->id }} )" aria-hidden="true"></button>
                                        <button class="btn glyphicon glyphicon-edit boothEdit{{ $productionData->id }}" aria-hidden="true" onclick="editProduction( 'booth', {{ $productionData->id }} )"></button>
                                    </div>
                                    <div id="col2">
                                        <button class="btn btn-danger glyphicon glyphicon-trash boothTrash{{ $productionData->id }}" onclick="trashProduction( 'booth', {{ $productionData->id }} )" aria-hidden="true"></button>
                                        <button class="btn btn-danger hidden-not-important boothDelete{{ $productionData->id }}" onclick="deleteProduction('booth', {{ $productionData->id }})" aria-hidden="true">Delete</button>
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