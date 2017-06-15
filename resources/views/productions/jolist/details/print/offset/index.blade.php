<div class="tab-pane" id="offset">
    <div class="form-horizontal">
        <div class="box box-info">
            <div class="box-header">
                @include('productions.common.supplier')
            </div>
            <div class="box-body">

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
                        <tbody id="tbody-offset">
                        <tr>
                            <td class="hidden"> </td>
                            <td>Camera</td>
                            <td>camera.zip</td>
                            <td>n/a</td>
                            <td>5</td>
                            <td>Canon DSLR lists</td>
                        </tr>
                        <tr>
                            <td class="hidden"> </td>
                            <td>Camera Stands</td>
                            <td>camera-stands.zip</td>
                            <td>n/a</td>
                            <td>5</td>
                            <td>Canon DSLR stand lists</td>
                        </tr>
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
</div>