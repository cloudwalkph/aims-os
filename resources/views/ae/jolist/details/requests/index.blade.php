<div class="tab-pane" id="request-forms">
    <div class="panel-group accordion" style="margin-top: 20px">
        <div class="panel panel-default">
            <div class="panel-heading" role="tab" id="manpowerForm">
                <h3 class="panel-title" data-toggle="collapse" data-parent="#accordion"
                    href="#collapseManpower" aria-expanded="true" aria-controls="collapseManpower" style="cursor: pointer;">
                    Manpower Request Form
                </h3>
            </div>
            <div id="collapseManpower" class="panel-collapse collapse in" role="tabpanel" aria-labelledby="manpowerForm">
                <div class="panel-body">
                    <div class="col-md-12">
                        <button class="btn btn-default pull-right" onclick="frames['frameManpower'].print()">
                            <i class="fa fa-print fa-lg"></i> Print Manpower Requests
                        </button>
                    </div>

                    <manpower-request-form></manpower-request-form>
                    <manpower-request-table></manpower-request-table>

                </div>
            </div>
        </div>

        <div class="panel panel-default hide">
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
                                        @foreach($vehicleTypes as $type)
                                            <option value={{ $type->id }}>{{ $type->name }}</option>
                                        @endforeach
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
                            @foreach($vehicle_request as $vehicle)
                                <tr>
                                    <td>{{ $vehicle->vehicleType->name }}</td>
                                    <td>{{ $vehicle->vehicle_needed }}</td>
                                    <td>{{ $vehicle->rate }}</td>
                                    <td>{{ $vehicle->remarks }}</td>
                                    <td>{{ $vehicle->status }}</td>
                                </tr>
                            @endforeach
                        </tbody>
                    </table>

                </div>
            </div>
        </div>

        <div class="panel panel-default">
            <div class="panel-heading" role="tab" id="foodForm">
                <h3 class="panel-title" data-toggle="collapse" data-parent="#accordion"
                    href="#collapseFood" aria-expanded="true" aria-controls="collapseFood" style="cursor: pointer;">
                    Meal Request Form
                </h3>
            </div>
            <div id="collapseFood" class="panel-collapse collapse in" role="tabpanel" aria-labelledby="foodForm">
                <div class="panel-body">

                    <div class="col-md-12">
                        <button class="btn btn-default pull-right" onclick="frames['frameMeal'].print()">
                            <i class="fa fa-print fa-lg"></i> Print Meal Requests
                        </button>
                    </div>

                    <meal-request-form></meal-request-form>
                    <meal-request-table></meal-request-table>

                </div>
            </div>
        </div>
    </div>
</div>