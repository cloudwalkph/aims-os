

<div class="tab-pane" id="offset">

    <div class="form-horizontal">
        <div class="box box-info">
            <div class="box-header">
                @include('productions.common.supplier')

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
                    <table class="table table-striped" border="1" id="tbl-offset">
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
                        <tbody id="tbody-offset">
                        @foreach( $productionDatas as $productionData)

                            @if( $productionData->type == 'offset' )
                                <tr id="offsetRow{{ $productionData->id }}">
                                    <td>
                                        <span class="spanOffset{{ $productionData->id }} offsetDescription{{ $productionData->id }}">{{ $productionData->description }}</span>
                                        <textarea class="form-control hidden-not-important offsetInputs{{ $productionData->id }}" name="offset_description_edit{{ $productionData->id }}" id="offset_description_edit{{ $productionData->id }}" value="{!! $productionData->description  !!} " cols="20"
                                                  rows="5">{!! $productionData->description !!} </textarea>
                                    </td>
                                    <td>
                                        <a href="{{ storage_path('productions/'.$productionData->visuals) }}" class="spanOffset{{ $productionData->id }} offsetVisuals{{ $productionData->id }}" target="_blank">{{ $productionData->visuals }}</a>
                                        <input class="form-control file_upload offsetInputs{{ $productionData->id }}" style="display: none;" type="file" name="offset_file_edit{{ $productionData->id }}" id="offset_file_edit{{ $productionData->id }}" value="{{ storage_path('productions/'.$productionData->visuals) }}"/>
                                    </td>
                                    <td>
                                        <span class="spanOffset{{ $productionData->id }} offsetSizes{{ $productionData->id }}">{{ $productionData->sizes }}</span>
                                        <input class="form-control hidden-not-important offsetInputs{{ $productionData->id }}" type="text" name="offset_size_edit{{ $productionData->id }}" id="offset_size_edit{{ $productionData->id }}" placeholder="size" value="{{ $productionData->sizes }}"/>
                                    </td>
                                    <td>
                                        <span class="spanOffset{{ $productionData->id }} offsetQty{{ $productionData->id }}">{{ $productionData->qty }}</span>
                                        <input class="form-control hidden-not-important offsetInputs{{ $productionData->id }}" type="integer" name="offset_quantity_edit{{ $productionData->id }}" id="offset_quantity_edit{{ $productionData->id }}" placeholder="quantity" value="{{ $productionData->qty }}"/>
                                    </td>
                                    <td>
                                        <span class="spanOffset{{ $productionData->id }} offsetDetails{{ $productionData->id }}">{!! $productionData->details !!}</span>
                                        <input class="form-control hidden-not-important offsetInputs{{ $productionData->id }}" type="text" name="offset_details_edit{{ $productionData->id }}" id="offset_details_edit{{ $productionData->id }}" placeholder="details" value="{{ $productionData->details }}"/>
                                    </td>
                                    <td>
                                        <div id="col1">
                                            <button class="btn btn-warning glyphicon glyphicon-floppy-disk hidden-not-important offsetUpdate{{ $productionData->id }}" onclick="updateProduction( 'offset', {{ $productionData->id }} )" aria-hidden="true"></button>
                                            <button class="btn glyphicon glyphicon-edit offsetEdit{{ $productionData->id }}" aria-hidden="true" onclick="editProduction( 'offset', {{ $productionData->id }} )"></button>
                                        </div>
                                        <div id="col2">
                                            <button class="btn btn-danger glyphicon glyphicon-trash offsetTrash{{ $productionData->id }}" onclick="trashProduction( 'offset', {{ $productionData->id }} )" aria-hidden="true"></button>
                                            <button class="btn btn-danger hidden-not-important offsetDelete{{ $productionData->id }}" aria-hidden="true">Delete</button>
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