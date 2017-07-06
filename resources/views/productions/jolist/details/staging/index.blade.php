<div class="tab-pane" id="staging">
    <div class="form-horizontal">
        <div class="box box-info">
            <div class="box-header">
                @include('productions.common.supplier')
            </div>
            <div class="box-body">
                <table id="tbl_staging" class="table table-striped" border="1">
                    <thead>
                    <tr>
                        <th class="text-center">Description</th>
                        <th class="text-center">Visual peg per file and size</th>
                        <th class="text-center">Quantity</th>
                        <th class="text-center">Other details</th>
                        <th class="text-center" width="150"> </th>
                    </tr>
                    </thead>
                    <tfoot>
                        <form class="form_staging" method="POST" enctype="multipart/form-data">
                            {{ csrf_field() }}
                            <input type="hidden" name="production_staging" value="staging" />
                            <tr>
                                <td>
                                    <select class="form-control" name="staging_description" id="staging_description" onchange="loadStagingInputs( this.value )">
                                        <option value="none">Select...</option>
                                        <option value="led">LED</option>
                                        <option value="stage">Stage</option>
                                        <option value="tents">Tents</option>
                                        <option value="iwata">Iwata Fans</option>
                                        <option value="clothes">Black / Blue Clothes</option>
                                        <option value="wire">Wire Clips</option>
                                        <option value="sound">Sound System</option>
                                        <option value="microphones">Microphones</option>
                                        <option value="tables">Tables</option>
                                        <option value="accordions">Accordions</option>
                                        <option value="others">Others</option>
                                    </select>
                                </td>
                                <td><input class="form-control" type="file" name="staging_file" id="staging_file" /></td>
                                <td><input class="form-control" type="integer" name="staging_quantity" id="staging_quantity" placeholder="quantity" /></td>
                                <td id="event_staging_details">
                                    {{--<input class="form-control" type="text" name="staging_details" id="staging_details" placeholder="details" />--}}

                                </td>
                                <td>
                                    <button type="button" onclick="saveStaging()" class="btn btn-primary btn-sm">
                                        <i class="glyphicon glyphicon-plus"></i>
                                    </button>
                                </td>
                            </tr>
                        </form>
                    </tfoot>
                    <tbody id="tbody_staging">
                    @foreach( $productionDatas as $productionData)

                        @if( $productionData->type == 'staging' )
                            <tr id="stagingRow{{ $productionData->id }}">
                                <td>
                                    <span class="spanstaging{{ $productionData->id }} stagingDescription{{ $productionData->id }}">{{ $productionData->description }}</span>
                                    <input class="form-control hidden-not-important stagingInputs{{ $productionData->id }}" type="integer" name="staging_description_edit{{ $productionData->id }}" id="staging_description_edit{{ $productionData->id }}" value="{{ $productionData->description }}"/>

                                </td>
                                <td>
                                    <a href="{{ storage_path('productions/'.$productionData->visuals) }}" class="spanstaging{{ $productionData->id }} stagingVisuals{{ $productionData->id }}" target="_blank">{{ $productionData->visuals }}</a>
                                    <input class="form-control file_upload stagingInputs{{ $productionData->id }}" style="display: none;" type="file" name="staging_file_edit{{ $productionData->id }}" id="staging_file_edit{{ $productionData->id }}" value="{{ storage_path('productions/'.$productionData->visuals) }}"/>
                                </td>
                                {{--<td>--}}
                                {{--<span class="spanBooth{{ $productionData->id }} boothSizes{{ $productionData->id }}">{{ $productionData->sizes }}</span>--}}
                                {{--<input class="form-control hidden-not-important boothInputs{{ $productionData->id }}" type="text" name="booth_size_edit{{ $productionData->id }}" id="booth_size_edit{{ $productionData->id }}" placeholder="size" value="{{ $productionData->sizes }}"/>--}}
                                {{--</td>--}}
                                <td>
                                    <span class="spanstaging{{ $productionData->id }} stagingQty{{ $productionData->id }}">{{ $productionData->qty }}</span>
                                    <input class="form-control hidden-not-important stagingInputs{{ $productionData->id }}" type="integer" name="staging_quantity_edit{{ $productionData->id }}" id="staging_quantity_edit{{ $productionData->id }}" placeholder="quantity" value="{{ $productionData->qty }}"/>
                                </td>
                                <td id="event_staging_details{{ $productionData->id }}">
                                    <span class="spanstaging{{ $productionData->id }} stagingDetails{{ $productionData->id }}">{!! $productionData->details !!}</span>
                                    <input class="form-control hidden-not-important stagingInputs{{ $productionData->id }}" type="text" name="staging_details_edit{{ $productionData->id }}" id="staging_details_edit{{ $productionData->id }}" placeholder="details" value="{{ $productionData->details }}"/>
                                </td>
                                <td>
                                    <div id="col1">
                                        <button class="btn btn-warning glyphicon glyphicon-floppy-disk hidden-not-important stagingUpdate{{ $productionData->id }}" onclick="updateProduction( 'staging', {{ $productionData->id }} )" aria-hidden="true"></button>
                                        <button class="btn glyphicon glyphicon-edit stagingEdit{{ $productionData->id }}" aria-hidden="true" onclick="editProduction( 'staging', {{ $productionData->id }} )"></button>
                                    </div>
                                    <div id="col2">
                                        <button class="btn btn-danger glyphicon glyphicon-trash stagingTrash{{ $productionData->id }}" onclick="trashProduction( 'staging', {{ $productionData->id }} )" aria-hidden="true"></button>
                                        <button class="btn btn-danger hidden-not-important stagingDelete{{ $productionData->id }}" aria-hidden="true">Delete</button>
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