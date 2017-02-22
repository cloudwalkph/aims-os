<div class="tab-pane" id="event-details">
    <div class="col-md-12">
        <div class="box box-info">
            <div class="box-header">
                <h3 class="box-title">Event Details</h3>
            </div>
            <div class="box-body">

                <form action="" class="form-horizontal">
                    <div class="row">

                        <div class="col-md-12 form-group text-input-container">
                            <label class="control-label col-sm-2" for="what">What</label>
                            <div class="col-md-10">
                                <input type="text" name="what" placeholder="What" class="form-control" />
                            </div>
                        </div>

                        <div class="col-md-12 form-group text-area-container">
                            <label for="what_notes" class="control-label col-md-2"></label>
                            <div class="col-md-10">
                                <textarea class="form-control" name="what_notes" placeholder="Notes" ></textarea>
                            </div>
                        </div>

                        <div class="col-md-12 form-group text-input-container">
                            <label class="control-label col-sm-2" for="when">When</label>
                            <div class="col-md-10">
                                <input type="text" name="when" placeholder="When" class="form-control" />
                            </div>
                        </div>

                        <div class="col-md-12 form-group text-input-container">
                            <label class="control-label col-sm-2" for="where">Where</label>
                            <div class="col-md-10">
                                <input type="text" name="where" placeholder="Where" class="form-control" />
                            </div>
                        </div>

                        <div class="col-md-12 form-group text-input-container">
                            <label for="expected_guest" class="control-label col-sm-2">Expected Guest</label>

                            <div class="col-md-10">
                                <input type="text" name="expected_guest" placeholder="Expected Guest" class="form-control" />
                            </div>
                        </div>

                        <div class="col-md-12 form-group text-area-container">
                            <label for="event_specifications" class="col-md-12">Event Specifications</label>
                            <div class="col-md-12">
                                <textarea class="form-control" name="event_specifications" placeholder="Event Specifications"></textarea>
                            </div>
                        </div>

                        <div class="col-md-12 text-right">
                            <button type="button" class="btn btn-primary">Add</button>
                        </div>
                    </div>
                </form>

            </div>
        </div>
        <hr/>
        <div class="box box-info">
            <div class="box-header">
                <h3 class="box-title">Animation Details</h3>
            </div>
            <div class="box-body">
                <div class="row" style="margin-bottom: 10px">
                    <div class="col-sm-3">
                        <input type="text" class="form-control" id="search" placeholder="Search..." />
                    </div>

                    <div class="col-sm-3 col-sm-offset-6">
                        <button class="btn btn-default pull-right"
                                type="button" data-toggle="modal" data-target="#createAnimationDetails">
                            <i class="fa fa-plus"></i> Add Details
                        </button>
                    </div>

                    @include('ae.jolist.details.event.modals.animation')
                </div>

                <table class="table table-striped table-bordered animation-details ">
                    <thead>
                    <tr>
                        <th rowSpan="2">Particulars</th>
                        <th rowSpan="2">Target Activity</th>
                        <th colSpan="5">Target Hits</th>
                        <th rowSpan="2">Target Duration</th>
                        <th rowSpan="2">Areas</th>
                    </tr>

                    <tr>
                        <th> Selling </th>
                        <th> Flyering</th>
                        <th> Survey</th>
                        <th> Experiment</th>
                        <th> Other</th>
                    </tr>
                    </thead>
                    <tbody>
                        <tr class="text-center">
                            <td>particular</td>
                            <td>target_activity</td>
                            <td>target_selling</td>
                            <td>target_flyering</td>
                            <td>target_survey</td>
                            <td>target_experiment</td>
                            <td>target_others</td>
                            <td>target_duration</td>
                            <td>target_areas</td>
                        </tr>
                    </tbody>
                </table>

            </div>
        </div>
        <hr/>
        <div class="box box-info">
            <div class="box-header">
                <h3 class="box-title">Departments Involved</h3>
            </div>
            <div class="box-body">

                <div class="form-group">
                    <div class="row">

                        <div class="col-md-3 form-group text-input-container">
                            <label class="control-label col-sm-12" for="department_id">Departments</label>
                            <div class="col-md-12">
                                <select name="department_id" id="department_id" class="form-control">
                                    <option value="1">Accounting</option>
                                    <option value="2">Account Executives</option>
                                    <option value="3">CMTUVA</option>
                                    <option value="4">Creatives</option>
                                </select>
                            </div>
                        </div>

                        <div class="col-md-3 form-group text-input-container">
                            <label class="control-label col-sm-12" for="deadline">Deadline</label>
                            <div class="col-md-12">
                                <input type="date" name="deadline" placeholder="Deadline" class="form-control" />
                            </div>
                        </div>

                        <div class="col-md-3 form-group select-input-container">
                            <button type="button" class="btn btn-primary btn-add">Add </button>
                        </div>

                    </div>
                </div>

                <table class="table table-striped">
                    <thead>
                    <tr>
                        <th>Departments</th>
                        <th>Deadline</th>
                        <th>Actions</th>
                    </tr>
                    </thead>

                    <tbody>
                    <tr>
                        <td>department name</td>
                        <td>deadline</td>
                        <td>
                            <button class="btn btn-danger">
                                <i class="fa fa-trash"></i> Remove
                            </button>
                        </td>
                    </tr>
                    </tbody>
                </table>
            </div>
        </div>

        <div class="box box-info">
            <div class="box-header">
                <h3 class="box-title">Inventory</h3>
            </div>

            <div class="inventory">
                <div class="col-sm-12">
                    <button class="btn btn-default pull-right" type="button"
                            data-toggle="modal" data-target="#createItemInventory">
                        <i class="fa fa-plus"></i> Add Item
                    </button>
                </div>

                @include('ae.jolist.details.event.modals.items')

                <table class="table table-striped">
                    <thead>
                    <tr>
                        <th>Item Name</th>
                        <th>Expected Quantity</th>
                        <th>Total Delivered</th>
                    </tr>
                    </thead>

                    <tbody>
                    <tr>
                        <td>itemName</td>
                        <td>quantity</td>
                        <td>delivered</td>
                    </tr>
                    </tbody>
                </table>
            </div>

            <div class="release-schedules">
                <div class="col-sm-2">
                    <label for="release_schedules" class="col-sm-12 control-label">Release Schedules</label>
                </div>
                <div class="col-sm-3">
                    <label for="total_remaining" class="col-sm-12 control-label">Total Remaining Items: 10,000</label>
                </div>
                <div class="col-sm-6 col-sm-offset-1">
                    <button class="btn btn-default pull-right" type="button"><i class="fa fa-plus"></i> Add Release Schedule</button>
                </div>

                <table class="table table-striped">
                    <thead>
                    <tr>
                        <th>Release Date</th>
                        <th>Item Name</th>
                        <th>Venue</th>
                        <th>Quantity</th>
                        <th>Status</th>
                    </tr>
                    </thead>

                    <tbody>

                    <tr>
                        <td>releaseDate</td>
                        <td>itemName</td>
                        <td>venue</td>
                        <td>quantity</td>
                        <td>status</td>
                    </tr>
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</div>