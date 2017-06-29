

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
                                <tr>
                                    <td>{{ $productionData->description }}</td>
                                    <td>{{ $productionData->visuals }}</td>
                                    <td>{{ $productionData->sizes }}</td>
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
</div>