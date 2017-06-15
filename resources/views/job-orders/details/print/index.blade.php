<!DOCTYPE html>
<html lang="{{ config('app.locale') }}">
<head>
    <style>
        .animation-details th, .animation-details td {
            vertical-align: middle !important;
        }
    </style>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <!-- CSRF Token -->
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>{{ config('app.name', 'AIMS') }}</title>

    <!-- Styles -->
    <link href="{{ asset('css/app.css') }}" rel="stylesheet">
    <link href="{{ asset('css/styles.css') }}" rel="stylesheet">
    <link href="{{ asset('css/login.css') }}" rel="stylesheet">

    <!-- Scripts -->
    <script>
        window.Laravel = {!! json_encode([
            'csrfToken' => csrf_token(),
        ]) !!};
    </script>
</head>
<body>


    <div class="col-md-12 col-xs-12 col-sm-12">
        <div style="text-align: center">
            <img src="/img/aai-logo.png" alt="aims logo" style="height: 100px"/>
        </div>

        {{--jo number and date end--}}
        <div class="row" style="padding-top: 50px">
            <div class="col-md-6 col-sm-6 col-xs-6">
                <h5>
                    <b>JOB ORDER NO.:</b> {{ $jo->job_order_no }}
                </h5>
            </div>
            <div class="col-md-6 col-sm-6 col-xs-6 text-right">
                <h5>
                    <b>DATE:</b> {{ $jo->created_at->toFormattedDateString() }}
                </h5>
            </div>
        </div>
        {{--jo number and date end--}}

        {{--project type checkbox start--}}
        <div class="row">
            @foreach(json_decode($jo->project_types) as $type)
                <div class="col-md-4 col-sm-6 col-xs-6">
                    <input type="checkbox" name="project_type" checked>
                    <label for="project_type">{{ $type->name }}</label>
                </div>
            @endforeach
        </div>
        {{--project type checkbox end--}}

        <div class="row">
            <hr>
        </div>

        {{--additional jo details start--}}
        <div class="row">
            <div class="col-md-12">
                <h5><b>CLIENT:</b> {{ isset($jo->clients[0]) ? $jo->clients[0]->client->company : "No Clients" }}</h5>
                <h5><b>PRODUCT:</b> {{ collect($brands)->implode(', ') }}</h5>
                <h5><b>PROJECT:</b> {{ $jo->project_name }}</h5>
                <h5><b>ACCOUNT HANDLER:</b> {{ $jo->user->profile->first_name }} {{ $jo->user->profile->last_name }}</h5>
            </div>
        </div>
        {{--additional jo details end--}}

        @if($mom)
            {{--jo MOM start--}}
            <div class="row">
                <div class="col-md-12">
                    <h4><b>MINUTES OF THE MEETING:</b></h4>
                    <ul>
                        <li><b>Agenda:</b> {{ $mom->agenda }}</li>
                        <li><b>Date and Time:</b> {{ $mom->date_and_time }}</li>
                        <li><b>Location:</b> {{ $mom->location }}</li>
                        <li><b>Attendees:</b> {{ $mom->attendees }}</li>
                    </ul>
                </div>
            </div>

            @if($mom->campaign_overview)
            <div class="row">
                <div class="col-md-12">
                    <h5><b>CAMPAIGN OVERVIEW:</b></h5>
                    <p>
                        {{ $mom->campaign_overview }}
                    </p>
                </div>
            </div>
            @endif

            @if($mom->activations_flow)
                <div class="row">
                    <div class="col-md-12">
                        <h5><b>ACTIVATIONS FLOW:</b></h5>
                        <p>
                            {{ $mom->activations_flow }}
                        </p>
                    </div>
                </div>
            @endif

            @if($mom->next_step_deliverables)
                <div class="row">
                    <div class="col-md-12">
                        <h5><b>NEXT STEP DELIVERABLES:</b></h5>
                        <p>
                            {{ $mom->next_step_deliverables }}
                        </p>
                    </div>
                </div>
            @endif

            @if($mom->other_details)
                <div class="row">
                    <div class="col-md-12">
                        <h5><b>OTHER DETAILS:</b></h5>
                        <p>
                            {{ $mom->other_details }}
                        </p>
                    </div>
                </div>
            @endif

            {{--jo MOM end--}}

            <div class="row">
                <hr>
            </div>
        @endif

        @if($detail)
            {{--jo event details start--}}
            <div class="row">
                <div class="col-md-12">
                    <h4><b>EVENT DETAILS:</b></h4>
                    <ul>
                        <li><b>What:</b> {{ $detail->what }}</li>
                        <li><b>When:</b> {{ $detail->when }}</li>
                        <li><b>Where:</b> {{ $detail->where }}</li>
                        <li><b>Expected Guests:</b> {{ $detail->expected_guest }}</li>
                    </ul>
                </div>
            </div>
            {{--jo event details end--}}

            {{--jo event specification start--}}
            <div class="row">
                <div class="col-md-12">
                    <h5><b>EVENT SPECIFICATION:</b></h5>
                    <p>
                        {{ $detail->event_specifications }}
                    </p>
                </div>
            </div>
            {{--jo event specification end--}}

            <div class="row">
                <hr>
            </div>
        @endif


        @if( count($animations) )
        {{--animation details start--}}
        <div class="row">
            <div class="col-md-12">
                <h5><b>ANIMATION DETAILS:</b></h5>
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
        </div>
        {{--animation details end--}}
        @endif

        @if( count($departments) )
        {{--departments involved deadlines start--}}
        <div class="row">
            <div class="col-md-12">
                <h5><b>REQUIREMENTS:</b></h5>
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
        </div>
        {{--departments involved deadlines end--}}
        @endif

        @if( count($products) )
        {{--project products start--}}
        <div class="row">
            <div class="col-md-12">
                <h5><b>INVENTORY REQUESTS:</b></h5>
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
        </div>
        {{--project products end--}}
        @endif

        @if( count($attachments) )
        {{--project attachment start--}}
        <div class="row">
            <div class="col-md-12">
                <h5><b>PROJECT ATTACHMENTS:</b></h5>
                @foreach($attachments as $a)
                    <div class="col-md-12">
                        <input type="checkbox" name="project_attachments">
                        <label for="project_attachments">{{ $a->reference_for }}</label>
                    </div>
                @endforeach
            </div>
        </div>
        {{--project attachment end--}}
        @endif

        {{--received by start--}}
        <div class="row">
            <div class="col-md-12">
                <h5><b>RECEIVED:</b></h5>
                <div class="col-md-3 col-sm-5 col-xs-5 text-center">
                    <hr>
                    <h5><b>Operations Division</b></h5>
                </div>

            </div>
        </div>
        {{--received by end--}}

    </div>

</body>
</html>
