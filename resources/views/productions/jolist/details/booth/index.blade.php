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