@extends('ae.jolist.details.index')

@section('job-order-content')
<div class="tab-pane" id="event-details">
    <div class="col-md-12">
        <div class="box box-info">
            <div class="box-header">
                <h3 class="box-title pull-left">Event Details</h3>
                <button class="btn btn-default pull-right"
                    data-toggle="modal" data-target="#createEventSchedule">
                    <i class="fa fa-plus"></i> Add Schedule</button>
            </div>
            <div class="box-body">

                {{--<form class="form-horizontal" id="eventDetails">--}}
                    {{--<div class="row">--}}
                        {{--{{ csrf_field() }}--}}
                        {{--<div class="col-md-12 form-group text-input-container">--}}
                            {{--<label class="control-label col-sm-2" for="what">What <span class="required-field">*</span></label>--}}
                            {{--<div class="col-md-10">--}}
                                {{--<input type="text" value="{{ $detail->what or '' }}" required name="what" placeholder="What" class="form-control eventDataField" />--}}
                            {{--</div>--}}
                        {{--</div>--}}

                        {{--<div class="col-md-12 form-group text-input-container">--}}
                            {{--<label class="control-label col-sm-2" for="when">When <span class="required-field">*</span></label>--}}
                            {{--<div class="col-md-10">--}}
                                {{--<input type="text" id="event_when" value="{{ isset($detail['when']) ? \Carbon\Carbon::createFromTimestamp(strtotime($detail->when))->toDateString() : '' }}" required name="when" placeholder="When" class="form-control eventDataField" />--}}
                            {{--</div>--}}
                        {{--</div>--}}

                        {{--<div class="col-md-12 form-group text-input-container">--}}
                            {{--<label class="control-label col-sm-2" for="where">Where <span class="required-field">*</span></label>--}}
                            {{--<div class="col-md-10">--}}
                                {{--<input type="text" value="{{ $detail->where or '' }}" required name="where" placeholder="Where" class="form-control eventDataField" />--}}
                            {{--</div>--}}
                        {{--</div>--}}

                        {{--<div class="col-md-12 form-group text-input-container">--}}
                            {{--<label for="expected_guest" class="control-label col-sm-2">Expected Attendees <span class="required-field">*</span></label>--}}

                            {{--<div class="col-md-10">--}}
                                {{--<input type="text" value="{{ $detail->expected_guest or '' }}" required name="expected_guest" placeholder="Attendees Profile" class="form-control eventDataField" />--}}
                            {{--</div>--}}
                        {{--</div>--}}

                        {{--<div class="col-md-12 form-group text-area-container">--}}
                            {{--<label for="event_specifications" class="col-md-12">Event Specifications</label>--}}
                            {{--<div class="col-md-12">--}}
                                {{--<textarea class="form-control eventDataField" required name="event_specifications" placeholder="Event Specifications">{{ $detail->event_specifications or '' }}</textarea>--}}
                            {{--</div>--}}
                        {{--</div>--}}

                        {{--<div class="col-md-12 text-right">--}}
                            {{--<button type="button" class="btn btn-primary" onclick="eventSave()" style="width: 200px">Save</button>--}}
                        {{--</div>--}}
                    {{--</div>--}}
                {{--</form>--}}


                <table class="table table-bordered">
                    <thead>
                        <tr>
                            <td>Date</td>
                            <td>Venue</td>
                            <td>Remarks</td>
                            <td>Status</td>
                        </tr>
                    </thead>

                    <tbody>
                        @foreach ($schedules as $schedule)
                            <tr>
                                <td>{{ \Carbon\Carbon::createFromTimestamp(strtotime($schedule->jo_datetime))->toFormattedDateString() }}</td>
                                @if($schedule->venue_id)
                                    <td>{{ $schedule->venue->category }} : {{ $schedule->venue->subcategory }} : {{ $schedule->venue->venue }}</td>
                                @else
                                    <td></td>
                                @endif
                                <td>{{ $schedule->remarks }}</td>
                                <td>{{ $schedule->status }}</td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>

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

        <div class="box box-info">
            <div class="box-header">
                <h3 class="box-title">Inventory</h3>
            </div>

            <div class="box-body">
                <div class="col-md-12">
                    <jo-inventory-form></jo-inventory-form>
                    <jo-inventory-table></jo-inventory-table>
                </div>
                <div class="col-md-12">
                    <hr>
                </div>
            </div>

            <div class="release-schedules hide">
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

    @include('ae.jolist.details.event.modals.event-schedule')
</div>
@endsection