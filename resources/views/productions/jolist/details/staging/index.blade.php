<div class="tab-pane" id="staging">
    <div class="form-horizontal">
        <div class="box box-info">
            <div class="box-header">
                @include('productions.common.supplier')
            </div>
            <div class="box-body">
                <table class="table table-striped" border="1">
                    <thead>
                    <tr>
                        <th class="text-center">Description</th>
                        <th class="text-center">Visual peg per file and size</th>
                        <th class="text-center">Quantity</th>
                        <th class="text-center">Other details</th>
                    </tr>
                    </thead>
                    <tbody>
                    <tr>
                        <td>LED</td>
                        <td> </td>
                        <td> </td>
                        <td>
                            <div class="row">
                                <div class="col-xs-12">
                                    Elevation Trussing :
                                </div>
                                <div class="col-xs-12">
                                    Hanged Trusses :
                                </div>
                                <div class="col-xs-12">
                                    Others :
                                </div>
                            </div>
                        </td>
                    </tr>

                    <tr>
                        <td>Stage</td>
                        <td></td>
                        <td></td>
                        <td>
                            <div class="row">
                                <div class="col-xs-12">
                                    With Roofing :
                                </div>
                                <div class="col-xs-12">
                                    <ul class="list-inline">
                                        <li>
                                            <label for="roofingY">
                                                <input id="roofingY" type="radio" name="roofing"> Yes
                                            </label>
                                        </li>
                                        <li>
                                            <label for="roofingN">
                                                <input id="roofingN" type="radio" name="roofing"> No
                                            </label>
                                        </li>
                                    </ul>
                                </div>
                                <div class="col-xs-12">
                                    Trusses :
                                </div>
                                <div class="col-xs-12">
                                    <ul class="list-inline">
                                        <li>
                                            <label for="trussesY">
                                                <input id="trussesY" type="radio" name="trusses"> Yes
                                            </label>
                                        </li>
                                        <li>
                                            <label for="roofingN">
                                                <input id="trussesN" type="radio" name="trusses"> No
                                            </label>
                                        </li>
                                    </ul>
                                </div>
                                <div class="col-xs-12">Materials to be used :</div>
                            </div>
                        </td>
                    </tr>
                    <tr>
                        <td>Tents</td>
                        <td></td>
                        <td></td>
                        <td>
                            <div class="row">
                                <div class="col-xs-12">
                                    With Aircon :
                                </div>
                                <div class="col-xs-12">
                                    <ul class="list-inline">
                                        <li>
                                            <label for="airconY">
                                                <input id="airconY" type="radio" name="aircon"> Yes
                                            </label>
                                        </li>
                                        <li>
                                            <label for="roofingN">
                                                <input id="airconN" type="radio" name="aircon"> No
                                            </label>
                                        </li>
                                    </ul>
                                </div>
                                <div class="col-xs-12">Supplier :</div>
                            </div>
                        </td>
                    </tr>

                    <tr>
                        <td>Iwata Fans</td>
                        <td></td>
                        <td></td>
                        <td>
                            <div class="row">
                                <div class="col-xs-12">Supplier :</div>
                            </div>
                        </td>

                    </tr>

                    <tr>
                        <td>Black / Blue Clothes</td>
                        <td></td>
                        <td></td>
                        <td> </td>
                    </tr>

                    <tr>
                        <td>Wire Clips</td>
                        <td></td>
                        <td></td>
                        <td> </td>
                    </tr>

                    <tr>
                        <td>Sound System</td>
                        <td></td>
                        <td></td>
                        <td>
                            <div class="row">
                                <div class="col-xs-12">
                                    <label for="table_selection">
                                        <input type="radio" name="table_selection" id="table_selection"> Internal
                                    </label>
                                </div>
                                <div class="col-xs-12">
                                    <label for="table_selection1">
                                        <input type="radio" name="table_selection" id="table_selection1"> External or Rental
                                    </label>
                                </div>
                                <div class="col-xs-12">Supplier :</div>
                            </div>
                        </td>
                    </tr>

                    <tr>
                        <td>Microphones</td>
                        <td></td>
                        <td></td>
                        <td>
                            <div class="row">
                                <div class="col-xs-12 text-center">INTERNAL</div>
                            </div>
                            <div class="row">
                                <div class="col-xs-4">
                                    <label for="wireless">
                                        <input type="checkbox" id="wireless" name="wires"> Wireless
                                    </label>
                                </div>
                                <div class="col-xs-4">
                                    <label for="wired">
                                        <input type="checkbox" id="wired" name="wires"> Wired
                                    </label>
                                </div>
                                <div class="col-xs-4">
                                    <label for="mic-stand">
                                        <input type="checkbox" id="mic-stand" name="wires"> Mic Stand
                                    </label>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-xs-4">
                                    QTY :
                                </div>
                                <div class="col-xs-4">
                                    QTY :
                                </div>
                                <div class="col-xs-4">
                                    QTY :
                                </div>
                            </div>

                            <hr>

                            <div class="row">
                                <div class="col-xs-12">EXTERNAL OR RENTAL</div>
                                <div class="col-xs-6">
                                    <label for="e-wireless">
                                        <input type="checkbox" name="e-wireless" id="e-wireless"> Wireless
                                    </label>
                                </div>
                                <div class="col-xs-6">
                                    <label for="wired">
                                        <input type="checkbox" name="e-wired" id="e-wired"> Wired
                                    </label>
                                </div>
                                <div class="col-xs-6">
                                    QTY :
                                </div>
                                <div class="col-xs-6">
                                    QTY :
                                </div>
                            </div>
                        </td>
                    </tr>
                    <tr>
                        <td>Tables</td>
                        <td></td>
                        <td></td>
                        <td>
                            <div class="row">
                                <div class="col-xs-12">
                                    <label for="t-internal">
                                        <input type="checkbox" id="t-internal" name="t-internal"> Internal
                                    </label>
                                </div>
                                <div class="col-xs-12">
                                    <label for="t-external">
                                        <input type="checkbox" id="t-external" name="t-external"> External
                                    </label>
                                </div>
                                <div class="col-xs-12">Supplier :</div>
                            </div>
                        </td>
                    </tr>

                    <tr>
                        <td>Accordions</td>
                        <td></td>
                        <td></td>
                        <td></td>
                    </tr>

                    <tr>
                        <td>Others</td>
                        <td></td>
                        <td></td>
                        <td></td>
                    </tr>
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</div>