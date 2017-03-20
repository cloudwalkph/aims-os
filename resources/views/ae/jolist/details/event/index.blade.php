<div class="tab-pane" id="event-details">
    <div class="col-md-12">
        <div class="box box-info">
            <div class="box-header">
                <h3 class="box-title">Event Details</h3>
            </div>
            <div class="box-body">

                <form class="form-horizontal" id="eventDetails">
                    <div class="row">
                        {{ csrf_field() }}
                        <div class="col-md-12 form-group text-input-container">
                            <label class="control-label col-sm-2" for="what">What</label>
                            <div class="col-md-10">
                                <input type="text" value="{{ $detail->what or '' }}" required name="what" placeholder="What" class="form-control eventDataField" />
                            </div>
                        </div>

                        <div class="col-md-12 form-group text-input-container">
                            <label class="control-label col-sm-2" for="when">When</label>
                            <div class="col-md-10">
                                <input type="date" value="{{ isset($detail['when']) ? \Carbon\Carbon::createFromTimestamp(strtotime($detail->when))->toDateString() : '' }}" required name="when" placeholder="When" class="form-control eventDataField" />
                            </div>
                        </div>

                        <div class="col-md-12 form-group text-input-container">
                            <label class="control-label col-sm-2" for="where">Where</label>
                            <div class="col-md-10">
                                <input type="text" value="{{ $detail->where or '' }}" required name="where" placeholder="Where" class="form-control eventDataField" />
                            </div>
                        </div>

                        <div class="col-md-12 form-group text-input-container">
                            <label for="expected_guest" class="control-label col-sm-2">Expected Guest</label>

                            <div class="col-md-10">
                                <input type="text" value="{{ $detail->expected_guest or '' }}" required name="expected_guest" placeholder="Expected Guest" class="form-control eventDataField" />
                            </div>
                        </div>

                        <div class="col-md-12 form-group text-area-container">
                            <label for="event_specifications" class="col-md-12">Event Specifications</label>
                            <div class="col-md-12">
                                <textarea class="form-control eventDataField" required name="event_specifications" placeholder="Event Specifications">{{ $detail->event_specifications or '' }}</textarea>
                            </div>
                        </div>

                        <div class="col-md-12 text-right">
                            <button type="button" class="btn btn-primary" onclick="eventSave()" style="width: 200px">Save</button>
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
                <div class="col-md-12" style="margin-bottom: 10px">
                    <div class="col-sm-3 col-sm-offset-9">
                        <button class="btn btn-default pull-right"
                                type="button" data-toggle="modal" data-target="#createAnimationDetails">
                            <i class="fa fa-plus"></i> Add Details
                        </button>
                    </div>

                    <animation-details-table></animation-details-table>
                </div>
                <div class="col-md-12">
                    <hr>
                </div>

            </div>
        </div>
        <hr/>
        <div class="box box-info">
            <div class="box-header">
                <h3 class="box-title">Departments Involved</h3>
            </div>
            <div class="box-body">
                <div class="col-md-12">
                    <department-involvement-form></department-involvement-form>
                    <department-involvement-table></department-involvement-table>
                </div>
                <div class="col-md-12">
                    <hr>
                </div>
            </div>
        </div>

        <div class="box box-info hide">
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