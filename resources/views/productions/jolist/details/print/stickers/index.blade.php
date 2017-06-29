<div class="tab-pane" id="stickers">
    <div class="form-horizontal">
        <div class="box box-info">
            <div class="box-header">
                @include('productions.common.supplier')
            </div>
            <div class="box-body">
                <table class="table table-striped" border="1" id="tbl-stickers">
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
                        <form class="form_tarpaulin" method="POST" enctype="multipart/form-data">
                            {{ csrf_field() }}
                            <input type="hidden" name="production_sticker" value="sticker" />
                            <tr>
                                {{--<td><input class="form-control" type="text" name="tarp_description" id="tarp_description" placeholder="description"></td>--}}
                                <td>
                                    <textarea name="sticker_description" id="sticker_description" cols="20"
                                              rows="5"></textarea>
                                </td>
                                <td><input class="form-control" type="file" name="sticker_file" id="sticker_file" /></td>
                                <td><input class="form-control" type="text" name="sticker_size" id="sticker_size" placeholder="size" /></td>
                                <td><input class="form-control" type="integer" name="sticker_quantity" id="sticker_quantity" placeholder="quantity" /></td>
                                <td>
                                    <div class="row">
                                        <div class="col-xs-3">
                                            Materials:
                                        </div>
                                        <div class="col-xs-9">
                                            <input type="text" name="sticker_materials" id="sticker_materials" class="form-control">
                                        </div>
                                    </div>
                                    <div class="row">
                                        <div class="col-xs-12">Texture</div>
                                    </div>
                                    <div class="row">
                                        <div class="col-xs-12">
                                            <ul class="list-inline">
                                                <li>
                                                    <label for="sticker_matte">
                                                        <input type="radio" name="sticker_texture" id="sticker_matte" value="Matte"> Matte
                                                    </label>
                                                </li>
                                                <li>
                                                    <label for="sticker_glossy">
                                                        <input type="radio" name="sticker_texture" id="sticker_glossy" value="Glossy"> Glossy
                                                    </label>
                                                </li>
                                            </ul>
                                        </div>
                                    </div>
                                    <div class="row">
                                        <div class="col-xs-12">Rendetion</div>
                                    </div>
                                    <div class="row">
                                        <div class="col-xs-12">
                                            <ul class="list-unstyled">
                                                <li>
                                                    <label for="sticker_sintra">
                                                        <input type="radio" name="sticker_rendetion" id="sticker_sintra" value="Sticker on sintra board">
                                                        Sticker on sintra board
                                                    </label>
                                                </li>
                                                <li>
                                                    <label for="sticker_foam">
                                                        <input type="radio" name="sticker_rendetion" id="sticker_foam" value="Sticker on foam board">
                                                        Sticker on foam board
                                                    </label>
                                                </li>
                                                <li>
                                                    <label for="sticker_wood">
                                                        <input type="radio" name="sticker_rendetion" id="sticker_wood" value="Sticker on wood">
                                                        Sticker on wood
                                                    </label>
                                                </li>
                                            </ul>
                                        </div>
                                    </div>
                                    <div class="row">
                                        <div class="col-xs-3">
                                            Others:
                                        </div>
                                        <div class="col-xs-9">
                                            <input type="text" name="sticker_others" id="sticker_others" class="form-control">
                                        </div>
                                    </div>
                                </td>
                                <td>
                                    <button type="button" onclick="saveStickers()" class="btn btn-primary btn-sm">
                                        <i class="glyphicon glyphicon-plus"></i>
                                    </button>
                                </td>
                            </tr>
                        </form>
                    </tfoot>

                    <tbody>
                        @foreach( $productionDatas as $productionData)

                            @if( $productionData->type == 'sticker' )
                                <tr>
                                    <td>{{ $productionData->description }}</td>
                                    <td>{{ $productionData->visuals }}</td>
                                    <td>{{ $productionData->sizes }}</td>
                                    <td>{{ $productionData->qty }}</td>
                                    <td>{{ $productionData->details }}</td>
                                </tr>
                            @endif

                        @endforeach

                    </tbody>
                </table>
            </div>
        </div>
    </div>
</div>