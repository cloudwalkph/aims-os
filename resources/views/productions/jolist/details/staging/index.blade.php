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
                    <tbody>
                    @foreach( $productionDatas as $productionData)

                        @if( $productionData->type == 'staging' )
                            <tr>
                                <td>{{ $productionData->description }}</td>
                                <td>{{ $productionData->visuals }}</td>
                                <td>{{ $productionData->qty }}</td>
                                <td>{{ $productionData->details }}</td>
                                <td>
                                    <div class="row">
                                        <div class="col-xs-4">
                                            <button class="glyphicon glyphicon-floppy-disk" aria-hidden="true"></button>
                                        </div>
                                        <div class="col-xs-4">
                                            <button class="glyphicon glyphicon-edit" aria-hidden="true"></button>
                                        </div>
                                        <div class="col-xs-4">
                                            <button class="glyphicon glyphicon-trash" aria-hidden="true"></button>
                                        </div>
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