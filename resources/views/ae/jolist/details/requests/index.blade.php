<div class="tab-pane" id="request-forms">
    <div class="panel-group accordion" style="margin-top: 20px">
        <div class="panel panel-default">
            <div class="panel-heading" role="tab" id="manpowerForm">
                <h3 class="panel-title" data-toggle="collapse" data-parent="#accordion"
                    href="#collapseManpower" aria-expanded="true" aria-controls="collapseManpower" style="cursor: pointer;">
                    Manpower Request Form
                </h3>
            </div>
            <div id="collapseManpower" class="panel-collapse collapse" role="tabpanel" aria-labelledby="manpowerForm">
                <div class="panel-body">

                    <form action="">
                        <div class="row">

                            <div class="col-md-3 form-group text-input-container">
                                <label class="control-label col-sm-12" for="manpower_type_id">Manpower Type</label>
                                <div class="col-md-12">
                                    <select name="manpower_type_id" id="manpower_type_id" class="form-control">
                                        <option value="1">BA</option>
                                        <option value="2">Promodizer</option>
                                        <option value="3">Sampling</option>
                                    </select>
                                </div>
                            </div>

                            <div class="col-md-2 form-group text-input-container">
                                <label class="control-label col-sm-12" for="manpower_needed"># Manpower Needed</label>
                                <div class="col-md-12">
                                    <input type="text" name="manpower_needed" placeholder="# Manpower Needed" class="form-control" />
                                </div>
                            </div>

                            <div class="col-md-2 form-group text-input-container">
                                <label class="control-label col-sm-12" for="rate">Rate</label>
                                <div class="col-md-12">
                                    <input type="text" name="rate" placeholder="Rate" class="form-control" />
                                </div>
                            </div>

                            <div class="col-md-2 form-group text-input-container">
                                <label class="control-label col-sm-12" for="remarks">Remarks</label>
                                <div class="col-md-12">
                                    <input type="text" name="remarks" placeholder="Remarks" class="form-control" />
                                </div>
                            </div>

                            <div class="col-md-2 form-group select-input-container">
                                <button type="button" class="btn btn-primary btn-add">Add </button>
                            </div>

                        </div>
                    </form>

                    <table class="table table-striped table-bordered" style="margin-top: 20px">
                        <thead>
                        <tr>
                            <th> Manpower </th>
                            <th> # Manpower Needed</th>
                            <th> Rate</th>
                            <th> Remarks</th>
                            <th> Status</th>
                        </tr>
                        </thead>
                        <tbody>
                            <tr>
                                <td>manpower_type name</td>
                                <td>manpower_needed</td>
                                <td>rate</td>
                                <td>remarks</td>
                                <td>status</td>
                            </tr>
                        </tbody>
                    </table>

                </div>
            </div>
        </div>

        <div class="panel panel-default">
            <div class="panel-heading" role="tab" id="vehicleForm">
                <h3 class="panel-title" data-toggle="collapse" data-parent="#accordion"
                    href="#collapseVehicle" aria-expanded="true" aria-controls="collapseVehicle" style="cursor: pointer;">
                    Vehicle Request Form
                </h3>
            </div>
            <div id="collapseVehicle" class="panel-collapse collapse" role="tabpanel" aria-labelledby="vehicleForm">
                <div class="panel-body">

                    <form class="">
                        <div class="row">

                            <div class="col-md-2 form-group text-input-container">
                                <label class="control-label col-sm-12" for="vehicle_type_id">Vehicle Type</label>
                                <div class="col-md-12">
                                    <select name="vehicle_type_id" id="vehicle_type_id" class="form-control">
                                        <option value="1">Small Truck</option>
                                        <option value="2">Big Truck</option>
                                    </select>
                                </div>
                            </div>

                            <div class="col-md-2 form-group text-input-container">
                                <label class="control-label col-sm-12" for="vehicle_needed"># Vehicle Needed</label>
                                <div class="col-md-12">
                                    <input type="text" name="vehicle_needed" placeholder="# Vehicle Needed" class="form-control" />
                                </div>
                            </div>

                            <div class="col-md-2 form-group text-input-container">
                                <label class="control-label col-sm-12" for="rate">Rate</label>
                                <div class="col-md-12">
                                    <input type="text" name="rate" placeholder="Rate" class="form-control" />
                                </div>
                            </div>

                            <div class="col-md-2 form-group text-input-container">
                                <label class="control-label col-sm-12" for="venue_id">Venue</label>
                                <div class="col-md-12">
                                    <select name="venue_id" id="venue_id" class="form-control">
                                        <option value="1">SM North</option>
                                        <option value="2">SM Megamall</option>
                                    </select>
                                </div>
                            </div>

                            <div class="col-md-2 form-group text-input-container">
                                <label class="control-label col-sm-12" for="remarks">Remarks</label>
                                <div class="col-md-12">
                                    <input type="text" name="remarks" placeholder="Remarks" class="form-control" />
                                </div>
                            </div>

                            <div class="col-md-2 form-group select-input-container">
                                <button type="button" class="btn btn-primary btn-add">Add </button>
                            </div>

                        </div>
                    </form>

                    <table class="table table-striped table-bordered" style="margin-top: 20px">
                        <thead>
                        <tr>
                            <th> Vehicle </th>
                            <th> # Vehicle Needed</th>
                            <th> Rate</th>
                            <th> Venue</th>
                            <th> Remarks</th>
                            <th> Status</th>
                        </tr>
                        </thead>
                        <tbody>
                        <tr>
                            <td>vehicle_type name</td>
                            <td>vehicle_needed</td>
                            <td>rate</td>
                            <td>venue.venue</td>
                            <td>remarks</td>
                            <td>status</td>
                        </tr>
                        </tbody>
                    </table>

                </div>
            </div>
        </div>

        <div class="panel panel-default">
            <div class="panel-heading" role="tab" id="foodForm">
                <h3 class="panel-title" data-toggle="collapse" data-parent="#accordion"
                    href="#collapseFood" aria-expanded="true" aria-controls="collapseFood" style="cursor: pointer;">
                    Food Request Form
                </h3>
            </div>
            <div id="collapseFood" class="panel-collapse collapse in" role="tabpanel" aria-labelledby="foodForm">
                <div class="panel-body">

                    <form class="">
                        <div class="row">

                            <div class="col-md-2 form-group text-input-container">
                                <label class="control-label col-sm-12" for="meal_type_id">Meal Type</label>
                                <div class="col-md-12">
                                    <select name="meal_type_id" id="meal_type_id" class="form-control">
                                        <option value="1">Breakfast</option>
                                        <option value="2">Lunch</option>
                                        <option value="2">Dinner</option>
                                    </select>
                                </div>
                            </div>

                            <div class="col-md-2 form-group text-input-container">
                                <label class="control-label col-sm-12" for="quantity">Quantity</label>
                                <div class="col-md-12">
                                    <input type="text" name="quantity" placeholder="Quantity" class="form-control" />
                                </div>
                            </div>

                            <div class="col-md-2 form-group text-input-container">
                                <label class="control-label col-sm-12" for="serving_time">Serving Time</label>
                                <div class="col-md-12">
                                    <input type="text" name="serving_time" placeholder="Serving Time" class="form-control" />
                                </div>
                            </div>

                            <div class="col-md-2 form-group text-input-container">
                                <label class="control-label col-sm-12" for="pickup_by">For Pickup By</label>
                                <div class="col-md-12">
                                    <input type="text" name="pickup_by" placeholder="For Pickup By" class="form-control" />
                                </div>
                            </div>

                            <div class="col-md-2 form-group text-input-container">
                                <label class="control-label col-sm-12" for="remarks">Remarks</label>
                                <div class="col-md-12">
                                    <input type="text" name="remarks" placeholder="Remarks" class="form-control" />
                                </div>
                            </div>

                            <div class="col-md-2 form-group select-input-container">
                                <button type="button" class="btn btn-primary btn-add">Add </button>
                            </div>

                        </div>
                    </form>

                    <table class="table table-striped table-bordered" style="margin-top: 20px">
                        <thead>
                        <tr>
                            <th> Meal Type </th>
                            <th> Quantity</th>
                            <th> Serving Time</th>
                            <th> For Pick-up by</th>
                            <th> Remarks</th>
                            <th> Status</th>
                        </tr>
                        </thead>
                        <tbody>
                        <tr>
                            <td>meal_type.name</td>
                            <td>quantity</td>
                            <td>serving_time</td>
                            <td>pickup_by</td>
                            <td>remarks</td>
                            <td>status</td>
                        </tr>
                        </tbody>
                    </table>

                </div>
            </div>
        </div>
    </div>
</div>