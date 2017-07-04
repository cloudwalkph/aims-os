<div class="tab-pane" id="photowall">
    <div class="form-horizontal">
        <div class="box box-info">
            <div class="box-header">
                @include('productions.common.supplier')
            </div>

            <button type="button" style="margin-bottom: 15px; margin-left: 32px;" class="btn btn-primary btn-create hidden"
                    data-toggle="modal" data-target="#addPhotowall">
                <i class="fa fa-plus"></i> ADD
            </button>
            <div class="box-body">
                <table class="table table-striped" border="1" id="tbl-photowall">
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
                        <input type="hidden" name="production_photowall" value="photowall" />
                        <tr>
                            <td><input class="form-control" type="text" name="photowall_description" id="photowall_description" placeholder="description" /></td>
                            <td><input class="form-control" type="file" name="photowall_file" id="photowall_file" /></td>
                            <td><input class="form-control" type="integer" name="photowall_quantity" id="photowall_quantity" placeholder="quantity" /></td>
                            <td><input class="form-control" type="text" name="photowall_details" id="photowall_details" placeholder="details" /></td>
                            <td>
                                <button type="button" onclick="savePhotowall()" class="btn btn-primary btn-sm">
                                    <i class="glyphicon glyphicon-plus"></i>
                                </button>
                            </td>
                        </tr>
                    </form>
                    </tfoot>
                    <tbody>
                    @foreach( $productionDatas as $productionData)

                        @if( $productionData->type == 'photowall' )
                            <tr id="photowallRow{{ $productionData->id }}">
                                <td>
                                    <span class="spanPhotowall{{ $productionData->id }} photowallDescription{{ $productionData->id }}">{{ $productionData->description }}</span>
                                        <textarea class="form-control hidden-not-important photowallInputs{{ $productionData->id }}" name="photowall_description_edit{{ $productionData->id }}" id="photowall_description_edit{{ $productionData->id }}" value="{!! $productionData->description  !!} " cols="20"
                                                  rows="5">{!! $productionData->description !!} </textarea>
                                </td>
                                <td>
                                    <a href="{{ storage_path('productions/'.$productionData->visuals) }}" class="spanPhotowall{{ $productionData->id }} photowallVisuals{{ $productionData->id }}" target="_blank">{{ $productionData->visuals }}</a>
                                    <input class="form-control file_upload photowallInputs{{ $productionData->id }}" style="display: none;" type="file" name="photowall_file_edit{{ $productionData->id }}" id="photowall_file_edit{{ $productionData->id }}" value="{{ storage_path('productions/'.$productionData->visuals) }}"/>
                                </td>
                                {{--<td>--}}
                                    {{--<span class="spanPhotowall{{ $productionData->id }} photowallSizes{{ $productionData->id }}">{{ $productionData->sizes }}</span>--}}
                                    {{--<input class="form-control hidden-not-important photowallInputs{{ $productionData->id }}" type="text" name="photowall_size_edit{{ $productionData->id }}" id="photowall_size_edit{{ $productionData->id }}" placeholder="size" value="{{ $productionData->sizes }}"/>--}}
                                {{--</td>--}}
                                <td>
                                    <span class="spanPhotowall{{ $productionData->id }} photowallQty{{ $productionData->id }}">{{ $productionData->qty }}</span>
                                    <input class="form-control hidden-not-important photowallInputs{{ $productionData->id }}" type="integer" name="photowall_quantity_edit{{ $productionData->id }}" id="photowall_quantity_edit{{ $productionData->id }}" placeholder="quantity" value="{{ $productionData->qty }}"/>
                                </td>
                                <td>
                                    <span class="spanPhotowall{{ $productionData->id }} photowallDetails{{ $productionData->id }}">{!! $productionData->details !!}</span>
                                    <input class="form-control hidden-not-important photowallInputs{{ $productionData->id }}" type="text" name="photowall_details_edit{{ $productionData->id }}" id="photowall_details_edit{{ $productionData->id }}" placeholder="details" value="{{ $productionData->details }}"/>
                                </td>
                                <td>
                                    <div id="col1">
                                        <button class="btn btn-warning glyphicon glyphicon-floppy-disk hidden-not-important photowallUpdate{{ $productionData->id }}" onclick="updateProduction( 'photowall', {{ $productionData->id }} )" aria-hidden="true"></button>
                                        <button class="btn glyphicon glyphicon-edit photowallEdit{{ $productionData->id }}" aria-hidden="true" onclick="editProduction( 'photowall', {{ $productionData->id }} )"></button>
                                    </div>
                                    <div id="col2">
                                        <button class="btn btn-danger glyphicon glyphicon-trash photowallTrash{{ $productionData->id }}" onclick="trashProduction( 'photowall', {{ $productionData->id }} )" aria-hidden="true"></button>
                                        <button class="btn btn-danger hidden-not-important photowallDelete{{ $productionData->id }}" aria-hidden="true">Delete</button>
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