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
                    <tbody>
                        <tr>
                            <td class="hidden"> </td>
                            <td> </td>
                            <td> </td>
                            <td> </td>
                            <td> </td>
                            <td>
                                <div class="row">
                                    <div class="col-xs-3"> Material:</div>
                                    <div class="col-xs-9"> _____________</div>
                                </div>
                                <div class="row">
                                    <div class="col-xs-12">
                                        Texture
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="col-xs-offset-1 col-xs-11">
                                        <ul class="list-inline">
                                            <li>
                                                <label for="matte">
                                                    <input id="matte" type="checkbox"> Matte
                                                </label>
                                            </li>
                                            <li>
                                                <label for="glossy">
                                                    <input id="glossy" type="checkbox"> Glossy
                                                </label>
                                            </li>
                                        </ul>
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="col-xs-12">
                                        Rendetion:
                                        <ul style="list-style: none;">
                                            <li>
                                                <label for="sintra">
                                                    <input type="checkbox" id="sintra"> Sticker on sintra board
                                                </label>
                                            </li>
                                            <li>
                                                <label for="sintra">
                                                    <input type="checkbox" id="sintra"> Sticker on foam board
                                                </label>
                                            </li>
                                            <li>
                                                <label for="sintra">
                                                    <input type="checkbox" id="sintra"> Sticker on wood
                                                </label>
                                            </li>
                                        </ul>
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="col-xs-12">
                                        Others:
                                    </div>
                                </div>
                            </td>
                        </tr>
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</div>