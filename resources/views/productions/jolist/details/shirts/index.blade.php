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
                <table class="table table-striped text-center" border="1" id="tbl-shirts">
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
                    <form class="form_photowall" method="POST" enctype="multipart/form-data">
                        {{ csrf_field() }}
                        <input type="hidden" name="production_shirts" value="shirts" />
                        <tr>
                            <td><input class="form-control" type="text" name="shirts_description" id="shirts_description" placeholder="description" /></td>
                            <td><input class="form-control file_upload" type="file" name="shirts_file" id="shirts_file" /></td>
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
                    <tbody id="tbody_shirts">
                    @foreach( $productionDatas as $productionData)

                        @if( $productionData->type == 'shirts' )
                            <tr id="shirtsRow{{ $productionData->id }}">
                                <td>
                                    <span class="spanshirts{{ $productionData->id }} shirtsDescription{{ $productionData->id }}">{{ $productionData->description }}</span>
                                    <input class="form-control hidden-not-important shirtsInputs{{ $productionData->id }}" type="text" name="shirts_description_edit{{ $productionData->id }}" id="shirts_description_edit{{ $productionData->id }}" placeholder="quantity" value="{{ $productionData->description }}"/>

                                </td>
                                <td>
                                    <a href="{{ storage_path('productions/'.$productionData->visuals) }}" class="spanshirts{{ $productionData->id }} shirtsVisuals{{ $productionData->id }}" target="_blank">{{ $productionData->visuals }}</a>
                                    <input class="form-control file_upload shirtsInputs{{ $productionData->id }}" style="display: none;" type="file" name="shirts_file_edit{{ $productionData->id }}" id="shirts_file_edit{{ $productionData->id }}" value="{{ storage_path('productions/'.$productionData->visuals) }}"/>
                                </td>
                                {{--<td>--}}
                                {{--<span class="spanBooth{{ $productionData->id }} boothSizes{{ $productionData->id }}">{{ $productionData->sizes }}</span>--}}
                                {{--<input class="form-control hidden-not-important boothInputs{{ $productionData->id }}" type="text" name="booth_size_edit{{ $productionData->id }}" id="booth_size_edit{{ $productionData->id }}" placeholder="size" value="{{ $productionData->sizes }}"/>--}}
                                {{--</td>--}}
                                <td>
                                    <span class="spanshirts{{ $productionData->id }} shirtsQty{{ $productionData->id }}">{{ $productionData->qty }}</span>
                                    <input class="form-control hidden-not-important shirtsInputs{{ $productionData->id }}" type="integer" name="shirts_quantity_edit{{ $productionData->id }}" id="shirts_quantity_edit{{ $productionData->id }}" placeholder="quantity" value="{{ $productionData->qty }}"/>
                                </td>
                                <td>
                                    <span class="spanshirts{{ $productionData->id }} shirtsDetails{{ $productionData->id }}">{!! $productionData->details !!}</span>
                                    <input class="form-control hidden-not-important shirtsInputs{{ $productionData->id }}" type="text" name="shirts_details_edit{{ $productionData->id }}" id="shirts_details_edit{{ $productionData->id }}" placeholder="details" value="{{ $productionData->details }}"/>
                                </td>
                                <td>
                                    <div id="col1">
                                        <button class="btn btn-warning glyphicon glyphicon-floppy-disk hidden-not-important shirtsUpdate{{ $productionData->id }}" onclick="updateProduction( 'shirts', {{ $productionData->id }} )" aria-hidden="true"></button>
                                        <button class="btn glyphicon glyphicon-edit shirtsEdit{{ $productionData->id }}" aria-hidden="true" onclick="editProduction( 'shirts', {{ $productionData->id }} )"></button>
                                    </div>
                                    <div id="col2">
                                        <button class="btn btn-danger glyphicon glyphicon-trash shirtsTrash{{ $productionData->id }}" onclick="trashProduction( 'shirts', {{ $productionData->id }} )" aria-hidden="true"></button>
                                        <button class="btn btn-danger hidden-not-important shirtsDelete{{ $productionData->id }}" onclick="deleteProduction('booth', {{ $productionData->id }})" aria-hidden="true">Delete</button>
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