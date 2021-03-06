@extends('ae.jolist.details.index')

@section('job-order-content')
    <div class="active tab-pane" id="mom">
        <div class="form-horizontal">
            <div class="box box-info">
                <div class="box-header">
                    <h3 class="box-title">Minutes of the Meeting</h3>
                </div>
                <div class="box-body">
                    <form id="momForm">
                        {{ csrf_field() }}
                        <div class="form-group">
                            <label for="agenda" class="col-sm-2 control-label">Agenda <span class="required-field">*</span></label>
                            <div class="col-sm-10">
                                <input type="text" class="form-control dataField"
                                       required
                                       name="agenda" value="{{ $mom->agenda or '' }}"
                                       id="agenda" placeholder="Agenda" />
                            </div>
                        </div>
                        <div class="form-group">
                            <label for="date_time" class="col-sm-2 control-label">Date and Time <span class="required-field">*</span></label>
                            <div class="col-sm-10">
                                <input type="text" class="form-control dataField"
                                       required
                                       name="date_and_time" value="{{ isset($mom['date_and_time']) ? \Carbon\Carbon::createFromTimestamp(strtotime($mom->date_and_time))->toDateString() : '' }}"
                                       id="date_time" placeholder="Date and Time" />
                            </div>
                        </div>
                        <div class="form-group">
                            <label for="location" class="col-sm-2 control-label">Location <span class="required-field">*</span></label>
                            <div class="col-sm-10">
                                <input type="text" class="form-control dataField"
                                       required
                                       name="location" value="{{ $mom->location or '' }}"
                                       id="location" placeholder="Location" />
                            </div>
                        </div>
                        <div class="form-group">
                            <label for="attendees" class="col-sm-2 control-label">Attendees <span class="required-field">*</span></label>
                            <div class="col-sm-10">
                        <textarea class="attendees dataField"
                                  required
                                  name="attendees" placeholder="Place some text here"
                                  style="width: 100%; height: 100px; font-size: 14px;
                                      line-height: 18px; border: 1px solid #dddddd; padding: 10px" >{{ $mom->attendees or '' }}</textarea>
                            </div>
                        </div>

                        <div class="nav-tabs-custom">
                            <ul class="nav nav-tabs">
                                <li class="active"><a href="#campaign-overview" data-toggle="tab">Campaign Overview</a></li>
                                <li><a href="#activations-flow" data-toggle="tab">Activations Flow</a></li>
                                <li><a href="#next-step" data-toggle="tab">Next Step and Deliverables</a></li>
                                <li><a href="#other-details" data-toggle="tab">Other Details</a></li>
                            </ul>
                            <div class="tab-content">
                                @include('ae.jolist.details.mom.campaign')
                                @include('ae.jolist.details.mom.flow')
                                @include('ae.jolist.details.mom.step')
                                @include('ae.jolist.details.mom.others')
                            </div>
                        </div>

                        <div class="col-md-4 col-md-offset-8" style="margin-top: 20px">
                            <button type="button" onclick="momSave()" class="btn btn-primary btn-block pull-right">Save</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
@endsection