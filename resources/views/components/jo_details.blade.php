@if($mom)
    {{--jo MOM start--}}
    <div class="col-md-12">
        <h4><b>MINUTES OF THE MEETING:</b></h4>
        <ul>
            <li><b>Agenda:</b> {{ $mom->agenda }}</li>
            <li><b>Date and Time:</b> {{ $mom->date_and_time }}</li>
            <li><b>Location:</b> {{ $mom->location }}</li>
            <li><b>Attendees:</b> {{ $mom->attendees }}</li>
        </ul>
    </div>

    @if($mom->campaign_overview)
        <div class="col-md-12">
            <h5><b>CAMPAIGN OVERVIEW:</b></h5>
            <p>
                {{ $mom->campaign_overview }}
            </p>
        </div>
    @endif

    @if($mom->activations_flow)
        <div class="col-md-12">
            <h5><b>ACTIVATIONS FLOW:</b></h5>
            <p>
                {{ $mom->activations_flow }}
            </p>
        </div>
    @endif

    @if($mom->next_step_deliverables)
        <div class="col-md-12">
            <h5><b>NEXT STEP DELIVERABLES:</b></h5>
            <p>
                {{ $mom->next_step_deliverables }}
            </p>
        </div>
    @endif

    @if($mom->other_details)
        <div class="col-md-12">
            <h5><b>OTHER DETAILS:</b></h5>
            <p>
                {{ $mom->other_details }}
            </p>
        </div>
    @endif

    {{--jo MOM end--}}
    <hr>
@endif

@if($detail)
    {{--jo event details start--}}
    <div class="col-md-12">
        <h4><b>EVENT DETAILS:</b></h4>
        <ul>
            <li><b>What:</b> {{ $detail->what }}</li>
            <li><b>When:</b> {{ $detail->when }}</li>
            <li><b>Where:</b> {{ $detail->where }}</li>
            <li><b>Expected Guests:</b> {{ $detail->expected_guest }}</li>
        </ul>
    </div>
    {{--jo event details end--}}

    {{--jo event specification start--}}
    <div class="col-md-12">
        <h5><b>EVENT SPECIFICATION:</b></h5>
        <p>
            {{ $detail->event_specifications }}
        </p>
    </div>
    {{--jo event specification end--}}

    <hr>
@endif

@if( count($animations) )
    {{--animation details start--}}
    <div class="col-md-12">
        <h4><b>ANIMATION DETAILS:</b></h4>
        <table class="table table-striped table-bordered animation-details" style="font-size: 11px">
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
            @foreach($animations as $animation)
                <tr class="text-center">
                    <td>{{ $animation->particular }}</td>
                    <td>{{ $animation->target_activity }}</td>
                    <td>{{ $animation->target_selling }}</td>
                    <td>{{ $animation->target_flyering }}</td>
                    <td>{{ $animation->target_survey }}</td>
                    <td>{{ $animation->target_experiment }}</td>
                    <td>{{ $animation->target_others }}</td>
                    <td>{{ $animation->target_duration }}</td>
                    <td>{{ $animation->target_areas }}</td>
                </tr>
            @endforeach
            </tbody>
        </table>
    </div>
    {{--animation details end--}}
@endif

@if( count($departments) )
    {{--departments involved deadlines start--}}
    <div class="col-md-12">
        <h4><b>DEPARTMENTS INVOLVED:</b></h4>
        <table class="table table-condensed table-bordered">
            <thead>
            <tr>
                <th>DEPARTMENTS</th>
                <th>DELIVERABLES</th>
                <th>DEADLINE</th>
            </tr>
            </thead>

            <tbody>
            @foreach($departments as $d)
                <tr>
                    <td>{{ $d->department->name }}</td>
                    <td>{{ $d->deliverables }}</td>
                    <td>{{ $d->deadline }}</td>
                </tr>
            @endforeach
            </tbody>
        </table>
    </div>
    {{--departments involved deadlines end--}}
@endif

@if( count($products) )
    {{--project products start--}}
    <div class="col-md-12">
        <h4><b>CLIENT ITEMS:</b></h4>
        <table class="table table-condensed table-bordered">
            <thead>
            <tr>
                <th>ITEM</th>
                <th>QUANTITY</th>
                <th>DATE</th>
            </tr>
            </thead>

            <tbody>
            @foreach($products as $p)
                <tr>
                    <td>{{ $p->item_name }}</td>
                    <td>{{ $p->expected_quantity }}</td>
                    <td>{{ $p->created_at->toFormattedDateString() }}</td>
                </tr>
            @endforeach
            </tbody>
        </table>
    </div>
    {{--project products end--}}
@endif

@if( count($attachments) )
    {{--project attachment start--}}
    <div class="col-md-12">
        <h4><b>PROJECT ATTACHMENTS:</b></h4>
        <table class="table table-condensed table-bordered">
            <thead>
            <tr>
                <th>REFERENCE FOR</th>
                <th>FILE NAME</th>
                <th>DATE</th>
                <th>ACTION</th>
            </tr>
            </thead>

            <tbody>
            @foreach($attachments as $a)
                <tr>
                    <td>{{ $a->reference_for }}</td>
                    <td>{{ $a->file_name }}</td>
                    <td>{{ $a->created_at->toFormattedDateString() }}</td>
                    <td>
                        <a href="/api/v1/job-order-project-attachments/{{ $a->id }}/download?api_token={{ Auth::user()->api_token }}"
                           class="btn btn-default"><i class="fa fa-download"></i> Download</a>
                    </td>
                </tr>
            @endforeach
            </tbody>
        </table>
    </div>
    {{--project attachment end--}}
@endif

@if( count($manpower_request) )
    {{--project manpower start--}}
    <div class="col-md-12">
        <h4><b>MANPOWER REQUEST:</b></h4>
        <table class="table table-condensed table-bordered">
            <thead>
            <tr>
                <th>MANPOWER TYPE</th>
                <th># MANPOWER NEEDED</th>
                <th>RATE</th>
                <th>REMARKS</th>
                <th>DATE</th>
            </tr>
            </thead>

            <tbody>
            @foreach($manpower_request as $man)
                <tr>
                    <td>{{ $man->manpowerType->name }}</td>
                    <td>{{ $man->manpower_needed }}</td>
                    <td>{{ $man->rate }}</td>
                    <td>{{ $man->remarks }}</td>
                    <td>{{ $man->created_at->toFormattedDateString() }}</td>
                </tr>
            @endforeach
            </tbody>
        </table>
    </div>
    {{--project manpower end--}}
@endif

@if( count($meal_request) )
    {{--project meal start--}}
    <div class="col-md-12">
        <h4><b>MEAL REQUEST:</b></h4>
        <table class="table table-condensed table-bordered">
            <thead>
            <tr>
                <th>MEAL TYPE</th>
                <th>QUANTITY</th>
                <th>SERVING TIME</th>
                <th>PICKUP BY</th>
                <th>REMARKS</th>
                <th>DATE</th>
            </tr>
            </thead>

            <tbody>
            @foreach($meal_request as $meal)
                <tr>
                    <td>{{ $meal->mealType->name }}</td>
                    <td>{{ $meal->quantity }}</td>
                    <td>{{ $meal->serving_time }}</td>
                    <td>{{ $meal->pickup_by }}</td>
                    <td>{{ $meal->remarks }}</td>
                    <td>{{ $meal->created_at->toFormattedDateString() }}</td>
                </tr>
            @endforeach
            </tbody>
        </table>
    </div>
    {{--project manpower end--}}
@endif

@if( count($vehicle_request) )
    {{--project manpower start--}}
    <div class="col-md-12">
        <h4><b>VEHICLE REQUEST:</b></h4>
        <table class="table table-condensed table-bordered">
            <thead>
            <tr>
                <th>VEHICLE TYPE</th>
                <th>VENUE</th>
                <th>VEHICLE NEEDED</th>
                <th>RATE</th>
                <th>REMARKS</th>
                <th>DATE</th>
            </tr>
            </thead>

            <tbody>
            @foreach($vehicle_request as $vehicle)
                <tr>
                    <td>{{ $vehicle->vehicleType->name }}</td>
                    <td>{{ $vehicle->venue->venue }}</td>
                    <td>{{ $vehicle->vehicle_needed }}</td>
                    <td>{{ $vehicle->rate }}</td>
                    <td>{{ $vehicle->remarks }}</td>
                    <td>{{ $vehicle->created_at->toFormattedDateString() }}</td>
                </tr>
            @endforeach
            </tbody>
        </table>
    </div>
    {{--project manpower end--}}
@endif